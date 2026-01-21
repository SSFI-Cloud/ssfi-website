<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Adjust path if needed

$errors = [];

// Function to sanitize input
define('FILTER_SANITIZE', FILTER_SANITIZE_STRING);
function sanitizeInput($data) {
    return filter_var(trim($data), FILTER_SANITIZE);
}

// Required fields
$requiredFields = [
    'full_name', 'father_name', 'mobile_number', 'date_of_birth', 'category_type_id', 'gender',
    'blood_group', 'school_name', 'aadhar_number', 'email_address', 'club_id', 'coach_name',
    'coach_mobile_number', 'state_id', 'district_id', 'residential_address','i_am','nominee_relation','nominee_age','nominee_name'
];
$postData = [];
foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        $errors[] = "Field '$field' is required";
    } else {
        $postData[$field] = sanitizeInput($_POST[$field]);
    }
}

// Validate foreign keys
$foreignTables = [
    'state_id' => 'tbl_states',
    'district_id' => 'tbl_districts',
    'club_id' => 'tbl_clubs',
    'category_type_id' => 'tbl_category_type'
];
foreach ($foreignTables as $field => $table) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM $table WHERE id = ?");
    $stmt->execute([$postData[$field]]);
    if ($stmt->fetchColumn() == 0) {
        $errors[] = "Invalid $field";
    }
}

// Generate membership ID
/*$stmt = $pdo->query("SELECT MAX(id) FROM tbl_skaters");
$maxId = $stmt->fetchColumn();
$nextId = ($maxId !== null) ? $maxId + 1 : 1; // If no records exist, start from 1
$membership_id = sprintf("SSFI/BS/%04d", $nextId);*/

    $stmt = $pdo->query("SELECT code FROM tbl_states where id = ".$postData['state_id']);
    $stcode = $stmt->fetchColumn();
    $year = date('y');

    $lr_prefix="SSFI/BS/".$stcode."/".$year."/S" ?? '';
    $st_length=strlen($lr_prefix)+1;
    
    $query = "SELECT membership_id FROM tbl_skaters WHERE membership_id LIKE '".$lr_prefix."%'   ORDER BY CAST(SUBSTRING(membership_id, ".$st_length.") AS UNSIGNED) DESC LIMIT 1";
    $stmt = $pdo->query($query);
    $last_member_id = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($last_member_id) {
        $last_number = intval(substr($last_member_id['membership_id'],strlen($lr_prefix))); 
        $new_number = $last_number + 1;
        $membership_id = $lr_prefix . str_pad($new_number, 4, '0', STR_PAD_LEFT);
    } else {
        $membership_id = $lr_prefix.'0001';
    }




// File upload
function uploadFile($file, $type) {
    global $errors;
    $year = date('Y');
    $month = date('m');
    $uploadDir = "../../uploads/skaters/$type/$year/$month/";
    
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
    if (!in_array($fileExt, $allowedExtensions)) {
        $errors[] = "Invalid file type for $type";
        return null;
    }
    
    if ($fileSize > 2 * 1024 * 1024) {
        $errors[] = "$type file exceeds 2MB limit";
        return null;
    }
    
    $newFileName = uniqid("$type_") . ".$fileExt";
    $filePath = "$uploadDir$newFileName";
    
    if (!move_uploaded_file($fileTmpName, $filePath)) {
        $errors[] = "Failed to upload $type";
        return null;
    }
    
    return "uploads/skaters/$type/$year/$month/$newFileName";
}

$identityProofPath = !empty($_FILES['identity_proof']['name']) ? uploadFile($_FILES['identity_proof'], 'identity_proof') : null;
$profilePhotoPath = !empty($_FILES['profile_photo']['name']) ? uploadFile($_FILES['profile_photo'], 'profile_photo') : null;

if (!$identityProofPath || !$profilePhotoPath) {
    $errors[] = "File uploads failed";
}

if (!empty($errors)) {
        if (!empty($identityProofPath) && file_exists("../../".$identityProofPath)) {
            unlink("../../".$identityProofPath);
        }
        if (!empty($profilePhotoPath) && file_exists("../../".$profilePhotoPath)) {
            unlink("../../".$profilePhotoPath);
        }
    echo json_encode(['status' => 'error', 'message' => $errors]);
    exit;
}

try {
    $pdo->beginTransaction();
    $stmt = $pdo->prepare("INSERT INTO tbl_skaters 
        (membership_id, full_name, father_name, mobile_number, date_of_birth, category_type_id, gender, blood_group, school_name, aadhar_number, email_address, club_id, coach_name, coach_mobile_number, state_id, district_id, residential_address, identity_proof, profile_photo, created_at, updated_at,i_am,nominee_relation,nominee_age,nominee_name) 
        VALUES (:membership_id, :full_name, :father_name, :mobile_number, :date_of_birth, :category_type_id, :gender, :blood_group, :school_name, :aadhar_number, :email_address, :club_id, :coach_name, :coach_mobile_number, :state_id, :district_id, :residential_address, :identity_proof, :profile_photo, NOW(), NOW(), :i_am, :nominee_relation, :nominee_age, :nominee_name)");

    $stmt->bindParam(':membership_id', $membership_id);
    foreach ($postData as $key => $value) {
        $stmt->bindParam(":$key", $postData[$key]);
    }
    $stmt->bindParam(':identity_proof', $identityProofPath);
    $stmt->bindParam(':profile_photo', $profilePhotoPath);
$stmt->execute();
$lastInsertId = $pdo->lastInsertId();
$skater_id=$lastInsertId;
    
$stmt_ = $pdo->prepare("SELECT id FROM tbl_session WHERE is_active = 1");
$stmt_->execute();
$session_id = $stmt_->fetchColumn();
    
    
// Step 1: Check if the record exists
$checkStmt = $pdo->prepare("SELECT COUNT(*) FROM tbl_session_renewal WHERE skater_id = :skater_id AND session_id = :session_id");
$checkStmt->bindParam(':skater_id', $skater_id);
$checkStmt->bindParam(':session_id', $session_id);
$checkStmt->execute();
$recordExists = $checkStmt->fetchColumn() > 0;

if ($recordExists) {
    // Step 2: Record exists – perform UPDATE
    $stmts = $pdo->prepare("UPDATE tbl_session_renewal SET 
        age = :age, 
        age_category = :age_category,
        updated_at = NOW() 
        WHERE skater_id = :skater_id AND session_id = :session_id");

    $stmts->bindParam(':age', sanitizeInput($_POST['age']));
    $stmts->bindParam(':age_category', sanitizeInput($_POST['agecat']));
    $stmts->bindParam(':skater_id', $skater_id);
    $stmts->bindParam(':session_id', $session_id);
} else {
    // Step 3: Record does not exist – perform INSERT
    $stmts = $pdo->prepare("INSERT INTO tbl_session_renewal 
    (skater_id, session_id, age, age_category, payment_id, order_id, payment_status)
    VALUES (:skater_id, :session_id, :age, :age_category, :payment_id, :order_id, :payment_status)");

    $stmts->bindParam(':skater_id', $skater_id);
    $stmts->bindParam(':session_id', $session_id);
    $stmts->bindParam(':age', sanitizeInput($_POST['age']));
    $stmts->bindParam(':age_category', sanitizeInput($_POST['agecat']));
    $stmts->bindValue(':payment_id', 'BACKEND-ENTRY' . $skater_id);
    $stmts->bindValue(':order_id', 'BACKEND-ENTRY' . $skater_id);
    $stmts->bindValue(':payment_status', 'captured');

}

    if ($lastInsertId && $stmts->execute()) {
        //Mail Send Start...
    $idsString = $skater_id;
    
    $statement = $pdo->prepare("SELECT sk.* ,sr.age,sr.age_category,sr.payment_id as transaction_id,p.amount as amounts,c.club_name,ct.cat_name,d.district_name,date(sr.updated_at) as paid_date
FROM tbl_skaters sk
LEFT JOIN tbl_session_renewal sr ON sk.id = sr.skater_id and sr.session_id=(SELECT id FROM tbl_session WHERE is_active = 1)
LEFT JOIN payments p ON p.order_id = sr.order_id
left join tbl_clubs c on c.id=sk.club_id
LEFT JOIN tbl_category_type ct on ct.id=sk.category_type_id
LEFT JOIN tbl_districts d on d.id=sk.district_id
WHERE sk.id  in ($idsString) and sr.payment_id!=''");
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    
foreach($results as $result){   
    
    $subject=$result['membership_id']." - Skater Confirmation Certificate";
    $email="ganesan.firstmatrix@gmail.com";
    
    $email=$result['email_address'];
    $message="";
    
    $download_name=  str_replace('/', '-', $result['membership_id']);;
    $created_at = !empty($result['paid_date']) ? date("d-m-Y", strtotime($result['paid_date'])) : date("d-m-Y") ;
$htmldata='
<br>
<center>
<a href="https://ssfibharatskate.com/registers/pdf.php?id='.$result['id'].'">Download Certificate</button>
</center>
<br>
<br>

<div style="border:1px solid gray;min-height:295mm;">
<table style="width:100%;">
    <tr>
        <td>
            <table style="text-align: center;">
                <tbody>
                    <tr>
                    
                   <td><img src="https://ssfibharatskate.com/registers/image/logo.jpg" alt="SSFI" style="width:98%;"></td>
                    
                            
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="4" style="text-align:center; font-size:25px">
             SSFI ANNUAL SKATER REGISTRATION 2025-2026</b><br>
           
        </td>
    </tr>
</table>
<table style="width:100%;border-top:1px solid gray;">
    <tr>
        <td style="padding:2px 20px;width:50%;vertical-align:top;">
            <table style="width:100%;font-size:13px;">
                <tr>
                    <td style="width:30%;">Name</td><td>: '.$result['full_name'].'</td>
                </tr>
                <tr>
                    <td>Father Name</td><td>: '.$result['father_name'].'</td>
                </tr><tr>
                    <td>Date of Birth</td><td>:  '.date("d-m-Y", strtotime($result['date_of_birth'])).'</td>
                </tr>
                <tr>
                    <td style="vertical-align:top;">Club Name</td> <td>: '.$result['club_name'].'</td>
                </tr>
                <tr>
                    <td>Age & Gender</td><td>: '.$result['age'].' / '.$result['gender'].'</td>
                </tr>
                
                <tr>
                    <td>Blood Group</td><td>: '.$result['blood_group'].'</td>
                </tr>
                <tr>
                    <td>Phone & Email</td><td>:  '.$result['mobile_number'].' | '.$result['email_address'].'</td>
                </tr>
                <tr>
                    <td style="vertical-align:top;">Res. Address</td>
                    <td>: 
                        '.$result['residential_address'].'
                    </td>
                </tr>
                
            </table>
        </td>
        <td style="vertical-align:top;width:50%;">
            <table style="width:100%;font-size:13px;">
                <tr>
                    <td style="width:25%;" rowspan="5">
                        <img src="https://ssfibharatskate.com/admin/'.$result['profile_photo'].'" style="width:70px;">
                    </td>
                    <td style="width:25%;">Skater ID</td> <td >: '.$result['membership_id'].'</td>
                </tr>
                <tr>
                    <td >Age Group</td><td>: '.$result['age_category'].'</td>
                </tr>
                
                <tr>
                    <td>Category</td> <td>: '.$result['cat_name'].'</td>
                </tr>
                <tr>
                    <td>District</td> <td>: '.$result['district_name'].'</td>
                </tr>
   
   
                
                <tr>
                    <td>Register Date<br>&nbsp;</td> <td style="vertical-align:top;">: '.date("d-m-Y", strtotime($result['created_at'])).'</td>
                </tr>
                <tr>
                    <td colspan="3">*****************************************************<br>
                   SKATER REGISTRATION PAYMENT DETAILS:</td>
                </tr>'; 
                
                
                if($result['transaction_id']=='' || $result['transaction_id']=='without payment'){
                }else{
                    $htmldata.=' <tr>
                    <td>Transaction ID</td><td colspan="2">: '.$result['transaction_id'].'</td>
                    </tr>';
                }
               $htmldata.=' <tr>
                    <td>Mode</td><td colspan="2">: Online Payment</td>
                </tr>
                <tr>
                    <td>Date</td><td colspan="2">: '.$created_at.'</td>
                </tr>
                
            </table>
            
        </td>
    </tr>
    

</table>

</div>
<style>
@page { margin: 5mm; }
body { margin: 0px; }
</style>';

$message=$htmldata;
 
/*E-Mail Send Source Code Start*/
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://fmsbilling.xyz/0-mails/index.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('subject' => $subject,'email' => $email,'message' => $message),
  CURLOPT_HTTPHEADER => array(
    'JWTToken: '
  ),
));
$response = curl_exec($curl);
curl_close($curl);
$response = json_decode($response, true);
if(isset($response)){
    $response_status=$response['status'];
    $response_message=$response['message'];
}
/*E-Mail Send Source Code End*/


}
        //Mail Send End...
        
        
        $pdo->commit(); // ✅ Commit the transaction
        echo json_encode(["status" => 'success', "message" => "Skater registered successfully", "membership_id" => $membership_id]);
    } else {
        if (!empty($identityProofPath) && file_exists("../../".$identityProofPath)) {
            unlink("../../".$identityProofPath);
        }
        if (!empty($profilePhotoPath) && file_exists("../../".$profilePhotoPath)) {
            unlink("../../".$profilePhotoPath);
        }
         $pdo->rollBack(); // ❌ Rollback if any error occurs
        echo json_encode(["status" => 'error', 'message' => 'Error executing query']);
    }
} catch (PDOException $e) {
    if (!empty($identityProofPath) && file_exists("../../".$identityProofPath)) {
            unlink("../../".$identityProofPath);
        }
        if (!empty($profilePhotoPath) && file_exists("../../".$profilePhotoPath)) {
            unlink("../../".$profilePhotoPath);
        }
         $pdo->rollBack(); // ❌ Rollback if any error occurs
    echo json_encode(["status" => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>

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
    'coach_mobile_number', 'state_id', 'district_id', 'residential_address','nominee_name','nominee_age','nominee_relation','i_am'
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


if (empty($_POST['aadhar_number'])) {
        $errors[] = "Field 'aadhar_number' is required";
        echo json_encode(['status' => 'error', 'message' => $errors]);
        exit;
}else{
    $aadhar_number=sanitizeInput($_POST['aadhar_number']);
}



$stmt = $pdo->query("SELECT id FROM tbl_session where is_active=1");
$session_id = $stmt->fetchColumn();




$stmt = $pdo->prepare("SELECT COUNT(*) FROM tbl_skaters WHERE aadhar_number = ?");
$stmt->execute([$aadhar_number]);
$count = $stmt->fetchColumn();
if($count){
        /*$errors[] = "Skater Already Registered!!!";
        echo json_encode(['status' => 'error', 'message' => $errors]);
        exit;*/
        
        /*****************************************/
        $skater_registered = 0;
        $skater_payment_order = 0;
        $skater_payment = 0;
        $skater_id = 0;

        // Fetch Active Session ID
        $stmt = $pdo->prepare("SELECT id FROM tbl_session WHERE is_active = 1");
        $stmt->execute();
        $session_id = $stmt->fetchColumn();

        // Fetch Skater Info
        $stmt = $pdo->prepare("SELECT st.*,d.district_name,s.state_name,c.club_name,ct.cat_name FROM tbl_skaters st 
        left join tbl_states s on s.id=st.state_id 
        left join tbl_clubs c on c.id=st.club_id 
        left join tbl_category_type ct on ct.id=st.category_type_id 
        left join tbl_districts d on d.id=st.district_id WHERE st.aadhar_number = ?");
        $stmt->execute([$aadhar_number]);
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        $skattor_info = $results;
$skattor_info['level_category']='';
        if ($results) {
            $skater_registered = 1;
            $skater_id = $results['id'];
        }

        // Fetch Skater Payment Status
        $stmt = $pdo->prepare("SELECT order_id, payment_id,age_category FROM tbl_session_renewal WHERE skater_id = ? AND session_id = ?");
        $stmt->execute([$skater_id, $session_id]);
        $results_session = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($results_session) {
            $skattor_info['level_category']=$results_session['age_category'];
            if (!empty($results_session['payment_id'])) {
                $skater_payment = 1;
            }
            if (!empty($results_session['order_id'])) {
                $skater_payment_order = 1;
            }
        }

        // Response Logic
        if ($skater_registered == 1 && $skater_payment == 1) {
            echo json_encode([
                "status" => "error",
                "message" => "Your Annual Skater Registeration Already Completed, Kindly Download Your Confirmation Certificate",
                "data" => $skattor_info,
                "type" => 1
            ]);
            exit;
        } elseif ($skater_registered == 1 && $skater_payment_order == 0) {
            echo json_encode([
                "status" => "error",
                "message" => "Your Annual Skater Registered Already Completed, your payment, order incomplete",
                "data" => $skattor_info,
                "type" => 2
            ]);
            exit;
        }  elseif ($skater_registered == 1 && $skater_payment == 0) {
            echo json_encode([
                "status" => "error",
                "message" => "Your Annual Skater Registeration Already Completed,To Activate Account Make the Payment",
                "data" => $skattor_info,
                "type" => 3
            ]);
            exit;
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Skater  Not Registered Go for Register",
                "data" => $skattor_info,
                "type" => 4
            ]);
            exit;
        }
        /*****************************************/
        
        
        
}



// Generate membership ID
/*$stmt = $pdo->query("SELECT MAX(id) FROM tbl_skaters");
$maxId = $stmt->fetchColumn();
$nextId = ($maxId !== null) ? $maxId + 1 : 1; // If no records exist, start from 1
$membership_id = sprintf("SSFI/BS/%04d", $nextId);*/



//Smaple Format : SSFI/BS/TN/25/S001

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
    
    if ($fileSize > 2 * 1024 * 5024) {
        $errors[] = "$type file exceeds 4MB limit";
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
    $stmt = $pdo->prepare("INSERT INTO tbl_skaters 
        (membership_id, full_name, father_name, mobile_number, date_of_birth, category_type_id, gender, blood_group, school_name, aadhar_number, email_address, club_id, coach_name, coach_mobile_number, state_id, district_id, residential_address, identity_proof, profile_photo, created_at, updated_at,nominee_name,nominee_age,nominee_relation,i_am) 
        VALUES (:membership_id, :full_name, :father_name, :mobile_number, :date_of_birth, :category_type_id, :gender, :blood_group, :school_name, :aadhar_number, :email_address, :club_id, :coach_name, :coach_mobile_number, :state_id, :district_id, :residential_address, :identity_proof, :profile_photo, NOW(), NOW(),:nominee_name, :nominee_age, :nominee_relation, :i_am)");

    $stmt->bindParam(':membership_id', $membership_id);
    foreach ($postData as $key => $value) {
        $stmt->bindParam(":$key", $postData[$key]);
    }
    $stmt->bindParam(':identity_proof', $identityProofPath);
    $stmt->bindParam(':profile_photo', $profilePhotoPath);

    if ($stmt->execute()) {
        
        $lastInsertId = $pdo->lastInsertId();

        $stmt = $pdo->query("SELECT skater_fees FROM tbl_fees");
        $fees = $stmt->fetchColumn();
        
        
        /*Payment Order Id Create*/
        $order_data = [
            "amount" => $fees*100,  // ₹10.00 in paise
            "currency" => "INR",
            "receipt" => $membership_id,
           // "payment_capture" => 1, // Auto capture
            "notes" => [  // Custom Parameters
                "member_id" => $membership_id,
                "email_id" => $postData['email_address'],
                "full_name" => $postData['full_name'],
                "father_name" => $postData['father_name'],
                "mobile_number" => $postData['mobile_number'],
                "date_of_birth" => $postData['date_of_birth'],
                "category_type_id" => $postData['category_type_id'],
                "gender" => $postData['gender'],
                "blood_group" => $postData['blood_group'],
                "aadhar_number" => $postData['aadhar_number'],
                "club_id" => $postData['club_id'],
                "state_id" => $postData['state_id'],
                "district_id" => $postData['district_id'],
                "register_type" => "Skater Annual Register-2025"
            ]
        ];
        
        $ch = curl_init("https://api.razorpay.com/v1/orders");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "$Razorpay_api_key:$Razorpay_api_secret");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($order_data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        
        $response = curl_exec($ch);
        
        error_log($response);
        
        $order_response = json_decode($response, true);
        curl_close($ch);
        
        
        $p_id='';$p_status='';$p_status='success';
        if($postData['state_id']==1){
            $p_id='MANUAL RECEIVED BY STATE';
            $p_status='Done-By-Secretory';
            $p_status='error';
        }
        
        
        
        $order_id='';
        if (isset($order_response['id'])) {
           // echo json_encode($order_response); // Send order_id to frontend
            $order_id=$order_response['id'];
                $stmt = $pdo->prepare("INSERT INTO tbl_session_renewal (order_id, payment_id, payment_status, session_id, skater_id,age,age_category) VALUES (?, ?, ?, ?, ?,?,?)");
                $stmt->execute([
                    $order_id,
                    $p_id,
                    $p_status,
                    $session_id ?? 0, // Make sure to define $session_id
                    $lastInsertId,   // Make sure to define $skater_id
                    $_POST['age'],
                    $_POST['agecat']
                ]);
            
        }
        
        
        echo json_encode(["status" => $p_status,"type" => 1, "message" => "Skater registered successfully to Activate Account complete the payment", "membership_id" => $membership_id,"order_id"=>$order_id,"amount"=>$fees,'razorpay_api_secret'=>$Razorpay_api_secret]);
    } else {
        if (!empty($identityProofPath) && file_exists("../../".$identityProofPath)) {
            unlink("../../".$identityProofPath);
        }
        if (!empty($profilePhotoPath) && file_exists("../../".$profilePhotoPath)) {
            unlink("../../".$profilePhotoPath);
        }
        echo json_encode(["status" => 'error', 'message' => 'Error executing query']);
    }
} catch (PDOException $e) {
    error_log($e);
    if (!empty($identityProofPath) && file_exists("../../".$identityProofPath)) {
            unlink("../../".$identityProofPath);
        }
        if (!empty($profilePhotoPath) && file_exists("../../".$profilePhotoPath)) {
            unlink("../../".$profilePhotoPath);
        }
    echo json_encode(["status" => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>

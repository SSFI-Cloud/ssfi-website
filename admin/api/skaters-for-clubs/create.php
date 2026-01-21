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
    // $pdo->beginTransaction();
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
$recordExists = $checkStmt->fetchColumn();

if ($recordExists==0) {
        if(1){
        $skater_id = $pdo->lastInsertId();

        $stmt = $pdo->query("SELECT skater_fees FROM tbl_fees");
        $fees = $stmt->fetchColumn();
        
        $stmt1 = $pdo->query("SELECT * FROM tbl_skaters where id=$skater_id");
        $skater_details = $stmt1->fetchColumn();
        
        
        /*Payment Order Id Create*/
        $order_data = [
            "amount" => $fees*100,  // ₹10.00 in paise
            "currency" => "INR",
            "receipt" => $membership_id,
           // "payment_capture" => 1, // Auto capture
            "notes" => [  // Custom Parameters
                "member_id" => $membership_id,
                "email_id" => $skater_details['email_address'],
                "full_name" => $skater_details['full_name'],
                "father_name" => $skater_details['father_name'],
                "mobile_number" => $skater_details['mobile_number'],
                "date_of_birth" => $skater_details['date_of_birth'],
                "category_type_id" => $skater_details['category_type_id'],
                "gender" => $skater_details['gender'],
                "blood_group" => $skater_details['blood_group'],
                "aadhar_number" => $skater_details['aadhar_number'],
                "club_id" => $skater_details['club_id'],
                "state_id" => $skater_details['state_id'],
                "district_id" => $skater_details['district_id'],
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
        
        
        $order_id='';
        if (isset($order_response['id'])) {
           // echo json_encode($order_response); // Send order_id to frontend
           error_log('working inside');
           error_log($order_response['id']);
            $order_id=$order_response['id'];
            
            
                $stmt = $pdo->prepare("INSERT INTO tbl_session_renewal (order_id, payment_id, payment_status, session_id, skater_id,age,age_category) VALUES (?, ?, ?, ?, ?,?,?)");
                $stmt->execute([
                    $order_id,
                    '',
                    '',
                    $session_id ?? 0, // Make sure to define $session_id
                    $lastInsertId,   // Make sure to define $skater_id
                    $_POST['age'],
                    $_POST['agecat']
                ]);
            
        }
        }
        if(0){
            $stmt = $pdo->prepare("INSERT INTO tbl_session_renewal (order_id, payment_id, payment_status, session_id, skater_id,age,age_category) VALUES (?, ?, ?, ?, ?,?,?)");
                $stmt->execute([
                    NULL,
                    NULL,
                    NULL,
                    $session_id ?? 0, // Make sure to define $session_id
                    $skater_id,   // Make sure to define $skater_id
                    $_POST['age'],
                    $_POST['agecat']
                ]);
            
        }
        
        
        echo json_encode(["status" => 'success', "message" => "Skater registered successfully to Activate Account complete the payment", "membership_id" => $membership_id,"order_id"=>$order_id,"amount"=>$fees,'razorpay_api_secret'=>$Razorpay_api_secret]);

    } else {
        if (!empty($identityProofPath) && file_exists("../../".$identityProofPath)) {
            unlink("../../".$identityProofPath);
        }
        if (!empty($profilePhotoPath) && file_exists("../../".$profilePhotoPath)) {
            unlink("../../".$profilePhotoPath);
        }
        //  $pdo->rollBack(); // ❌ Rollback if any error occurs
        echo json_encode(["status" => 'error', 'message' => 'Error executing query']);
    }
} catch (PDOException $e) {
    if (!empty($identityProofPath) && file_exists("../../".$identityProofPath)) {
            unlink("../../".$identityProofPath);
        }
        if (!empty($profilePhotoPath) && file_exists("../../".$profilePhotoPath)) {
            unlink("../../".$profilePhotoPath);
        }
        //  $pdo->rollBack(); // ❌ Rollback if any error occurs
    echo json_encode(["status" => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>

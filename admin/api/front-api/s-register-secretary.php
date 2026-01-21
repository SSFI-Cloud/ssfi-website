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
$requiredFields = ['full_name', 'mobile_number', 'gender', 'aadhar_number', 'email_address', 'state_id', 'residential_address'];
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
    'state_id' => 'tbl_states'
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




$stmt = $pdo->prepare("SELECT COUNT(*) FROM tbl_user WHERE aadhar_number = ?");
$stmt->execute([$aadhar_number]);
$count = $stmt->fetchColumn();
if($count){
        $errors[] = "Secretary Already Registered!!!";
        echo json_encode(['status' => 'error', 'message' => $errors]);
        exit;
}

//error_log($postData['state_id']);

$stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM tbl_user WHERE state_id = ? and role_id=3");
$stmt->execute([$postData['state_id']]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result['count'] > 0) {
    $errors[] = "State ID Secretary Already Registered!!!";
    echo json_encode([
        'status' => 'error',
        'message' => $errors
    ]);
    exit;
}




// File upload function
function uploadFile($file, $type) {
    global $errors;
    
    if (!isset($file['name']) || $file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $year = date('Y');
    $month = date('m');
    $uploadDir = "../../uploads/s-secretary/$type/$year/$month/";

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

    if ($fileSize > 2 * 1024 * 1024) {  // 2MB limit
        $errors[] = "$type file exceeds 2MB limit";
        return null;
    }

    $newFileName = uniqid("$type_") . ".$fileExt";
    $filePath = "$uploadDir$newFileName";

    if (!move_uploaded_file($fileTmpName, $filePath)) {
        $errors[] = "Failed to upload $type";
        return null;
    }

    return "uploads/s-secretary/$type/$year/$month/$newFileName";
}

// Handle file uploads
$identityProofPath = !empty($_FILES['secretary_proof']['name']) ? uploadFile($_FILES['secretary_proof'], 'secretary_proof') : null;
$profilePhotoPath = !empty($_FILES['profile_photo']['name']) ? uploadFile($_FILES['profile_photo'], 'profile_photo') : null;


$presidentPath = !empty($_FILES['president']['name']) ? uploadFile($_FILES['president'], 'president') : null;
$treasurerPath = !empty($_FILES['treasurer']['name']) ? uploadFile($_FILES['treasurer'], 'treasurer') : null;
$association_certificatePath = !empty($_FILES['association_certificate']['name']) ? uploadFile($_FILES['association_certificate'], 'association_certificate') : null;
$association_logoPath = !empty($_FILES['association_logo']['name']) ? uploadFile($_FILES['association_logo'], 'association_logo') : null;




$role_id=3;

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
        
        if (!empty($presidentPath) && file_exists("../../".$presidentPath)) {
            unlink("../../".$presidentPath);
        }
        if (!empty($treasurerPath) && file_exists("../../".$treasurerPath)) {
            unlink("../../".$treasurerPath);
        }
        if (!empty($association_certificatePath) && file_exists("../../".$association_certificatePath)) {
            unlink("../../".$association_certificatePath);
        }
        if (!empty($association_logoPath) && file_exists("../../".$association_logoPath)) {
            unlink("../../".$association_logoPath);
        }
        
        
        
    echo json_encode(['status' => 'error', 'message' => $errors]);
    exit;
}

try {
    
    // Generate membership ID
    $stmt = $pdo->query("SELECT MAX(id) FROM tbl_user");
    $maxId = $stmt->fetchColumn();
    
    $stmt = $pdo->query("SELECT code FROM tbl_states where id = ".$postData['state_id']);
    $stcode = $stmt->fetchColumn();
    
    
    $nextId = ($maxId !== null) ? $maxId + 1 : 1; // If no records exist, start from 1
    // $membership_id = sprintf("SSFI/BS/$stcode/date('y')", $nextId);
    $year = date('y');
    $membership_id = sprintf("SSFI/BS/%s/%s/%s", $stcode, $year, 0001);

    
    function generateUniquePassword($length = 8) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $password;
    }
    $password = generateUniquePassword();
    $aadhar_no = $postData['aadhar_number'];

    $stmt = $pdo->prepare("INSERT INTO tbl_user 
        (username,password,role_id,full_name, mobile_number, gender, aadhar_number, email_address, state_id, residential_address, identity_proof, profile_photo, member_id, created_at, updated_at,president,treasurer,association_certificate,association_logo) 
        VALUES (:username,:password,:role_id,:full_name, :mobile_number, :gender, :aadhar_number, :email_address, :state_id, :residential_address, :identity_proof, :profile_photo, :member_id, NOW(), NOW(),:president,:treasurer,:association_certificate,:association_logo)");
    
    

    
    $stmt->bindParam(':username', $postData['email_address']);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role_id', $role_id);
    $stmt->bindParam(':full_name', $postData['full_name']);
    $stmt->bindParam(':mobile_number', $postData['mobile_number']);
    $stmt->bindParam(':gender', $postData['gender']);
    $stmt->bindParam(':aadhar_number', $aadhar_no);
    $stmt->bindParam(':email_address', $postData['email_address']);
    $stmt->bindParam(':state_id', $postData['state_id']);
    $stmt->bindParam(':residential_address', $postData['residential_address']);
    $stmt->bindParam(':identity_proof', $identityProofPath);
    $stmt->bindParam(':profile_photo', $profilePhotoPath);
    $stmt->bindParam(':member_id', $membership_id);
    $stmt->bindParam(':president', $presidentPath);
    $stmt->bindParam(':treasurer', $treasurerPath);
    $stmt->bindParam(':association_certificate', $association_certificatePath);
    $stmt->bindParam(':association_logo', $association_logoPath);
    


    if ($stmt->execute()) {
        
            
        // Fetch Skater Info
        $stmts = $pdo->prepare("SELECT st.*,d.district_name,s.state_name FROM tbl_user st 
                    left join tbl_states s on s.id=st.state_id 
                    left join tbl_districts d on d.id=st.district_id WHERE st.aadhar_number = ?");
        $stmts->execute([$aadhar_no]);
        $results = $stmts->fetch(PDO::FETCH_ASSOC);
        $skattor_info = $results;
        
        echo json_encode(["status" => 'success', "message" => "Your State Association Registered Successfully, To activate Profile, please make the payment", "data" => $skattor_info ]);
    } else {
        if (!empty($identityProofPath) && file_exists("../../".$identityProofPath)) {
            unlink("../../".$identityProofPath);
        }
        if (!empty($profilePhotoPath) && file_exists("../../".$profilePhotoPath)) {
            unlink("../../".$profilePhotoPath);
        }
         if (!empty($presidentPath) && file_exists("../../".$presidentPath)) {
            unlink("../../".$presidentPath);
        }
        if (!empty($treasurerPath) && file_exists("../../".$treasurerPath)) {
            unlink("../../".$treasurerPath);
        }
        if (!empty($association_certificatePath) && file_exists("../../".$association_certificatePath)) {
            unlink("../../".$association_certificatePath);
        }
        if (!empty($association_logoPath) && file_exists("../../".$association_logoPath)) {
            unlink("../../".$association_logoPath);
        }
        echo json_encode(["status" => 'error', 'message' => 'Error executing query']);
    }
} catch (PDOException $e) {
        if (!empty($identityProofPath) && file_exists("../../".$identityProofPath)) {
            unlink("../../".$identityProofPath);
        }
        if (!empty($profilePhotoPath) && file_exists("../../".$profilePhotoPath)) {
            unlink("../../".$profilePhotoPath);
        }
         if (!empty($presidentPath) && file_exists("../../".$presidentPath)) {
            unlink("../../".$presidentPath);
        }
        if (!empty($treasurerPath) && file_exists("../../".$treasurerPath)) {
            unlink("../../".$treasurerPath);
        }
        if (!empty($association_certificatePath) && file_exists("../../".$association_certificatePath)) {
            unlink("../../".$association_certificatePath);
        }
        if (!empty($association_logoPath) && file_exists("../../".$association_logoPath)) {
            unlink("../../".$association_logoPath);
        }
    echo json_encode(["status" => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>

<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Database connection

$errors = [];

// Function to sanitize input
function sanitizeInput($data) {
    return htmlspecialchars(trim($data));
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
$identityProofPath = !empty($_FILES['identity_proof']['name']) ? uploadFile($_FILES['identity_proof'], 'identity_proof') : null;
$profilePhotoPath = !empty($_FILES['profile_photo']['name']) ? uploadFile($_FILES['profile_photo'], 'profile_photo') : null;
$role_id=3;
if (!empty($errors)) {
    echo json_encode(['status' => 'error', 'message' => $errors]);
    exit;
}


// Generate membership ID
$stmt = $pdo->query("SELECT MAX(id) FROM tbl_skaters");
$maxId = $stmt->fetchColumn();
$nextId = ($maxId !== null) ? $maxId + 1 : 1; // If no records exist, start from 1
$membership_id = sprintf("SSFI/BS/DIS/%04d", $nextId);

try {
    
    function generateUniquePassword($length = 8) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $password;
    }
    $password = generateUniquePassword();
    
    
    // Insert into database
    $stmt = $pdo->prepare("INSERT INTO tbl_user 
        (role_id,full_name, mobile_number, gender, aadhar_number, email_address, state_id, residential_address, identity_proof, profile_photo,username, password, member_id, created_at, updated_at) 
        VALUES (:role_id,:full_name, :mobile_number, :gender, :aadhar_number, :email_address, :state_id, :residential_address, :identity_proof, :profile_photo,:username, :password, :member_id, NOW(), NOW())");

    // Bind parameters
    $stmt->bindParam(':role_id', $role_id);
    $stmt->bindParam(':full_name', $postData['full_name']);
    $stmt->bindParam(':mobile_number', $postData['mobile_number']);
    $stmt->bindParam(':gender', $postData['gender']);
    $stmt->bindParam(':aadhar_number', $postData['aadhar_number']);
    $stmt->bindParam(':email_address', $postData['email_address']);
    $stmt->bindParam(':state_id', $postData['state_id']);
    // $stmt->bindParam(':district_id', $postData['district_id']);
    $stmt->bindParam(':residential_address', $postData['residential_address']);
    $stmt->bindParam(':identity_proof', $identityProofPath);
    $stmt->bindParam(':profile_photo', $profilePhotoPath);
    $stmt->bindParam(':member_id', $membership_id);
    $stmt->bindParam(':username', $postData['email_address']);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
        echo json_encode(["status" => 'success', "message" => "State Secretary registered successfully"]);
    } else {
        echo json_encode(["status" => 'error', 'message' => 'Error executing query']);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>

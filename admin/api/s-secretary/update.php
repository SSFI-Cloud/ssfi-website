<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Adjust path if needed

$errors = [];

// Function to sanitize input
function sanitizeInput($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Validate skater ID
if (empty($_POST['id'])) {
    echo json_encode(['status' => 'error', 'message' => "Secretary ID is required"]);
    exit;
}
$id = sanitizeInput($_POST['id']);

// Fetch existing file paths
$stmt = $pdo->prepare("SELECT identity_proof, profile_photo FROM tbl_user WHERE id = ?");
$stmt->execute([$id]);
$existingData = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$existingData) {
    echo json_encode(['status' => 'error', 'message' => "Secretary ID is invalid"]);
    exit;
}

// Required fields
$requiredFields = [
    'full_name', 'mobile_number', 'gender', 'aadhar_number', 'email_address', 'state_id', 'residential_address'];
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

// File upload function
function uploadFile($file, $type) {
    global $errors;
    $year = date('Y');
    $month = date('m');
    $uploadDir = "../../uploads/s-secretary/$type/$year/$month/";

    if (!is_dir($uploadDir) && !mkdir($uploadDir, 0777, true) && !is_dir($uploadDir)) {
        $errors[] = "Failed to create upload directory for $type";
        return null;
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

    return "uploads/s-secretary/$type/$year/$month/$newFileName";
}

$identityProofPath = !empty($_FILES['identity_proof']['name']) ? uploadFile($_FILES['identity_proof'], 'identity_proof') : $existingData['identity_proof'];
$profilePhotoPath = !empty($_FILES['profile_photo']['name']) ? uploadFile($_FILES['profile_photo'], 'profile_photo') : $existingData['profile_photo'];

if (!empty($errors)) {
    if ($identityProofPath !== $existingData['identity_proof'] && file_exists("../../" . $identityProofPath)) {
        unlink("../../" . $identityProofPath);
    }
    if ($profilePhotoPath !== $existingData['profile_photo'] && file_exists("../../" . $profilePhotoPath)) {
        unlink("../../" . $profilePhotoPath);
    }
    echo json_encode(['status' => 'error', 'message' => $errors]);
    exit;
}

// Update skater details
try {
    $stmt = $pdo->prepare("UPDATE tbl_user SET 
            full_name = :full_name, 
            mobile_number = :mobile_number, 
            gender = :gender, 
            aadhar_number = :aadhar_number, 
            email_address = :email_address, 
            state_id = :state_id, 
            residential_address = :residential_address, 
            identity_proof = :identity_proof, 
            profile_photo = :profile_photo, 
            updated_at = NOW() 
            WHERE id = :id");

    $stmt->bindParam(':id', $id);

    foreach ($postData as $key => $value) {
        $stmt->bindParam(":$key", $postData[$key]);
    }

    $stmt->bindParam(':identity_proof', $identityProofPath);
    $stmt->bindParam(':profile_photo', $profilePhotoPath);

    if ($stmt->execute()) {
        if ($identityProofPath !== $existingData['identity_proof'] && file_exists("../../" . $existingData['identity_proof'])) {
            unlink("../../" . $existingData['identity_proof']);
        }
        if ($profilePhotoPath !== $existingData['profile_photo'] && file_exists("../../" . $existingData['profile_photo'])) {
            unlink("../../" . $existingData['profile_photo']);
        }
        echo json_encode(["status" => 'success', "message" =>"Secretary updated successfully"]);
    } else {
        if ($identityProofPath !== $existingData['identity_proof'] && file_exists("../../" . $identityProofPath)) {
            unlink("../../" . $identityProofPath);
        }
        if ($profilePhotoPath !== $existingData['profile_photo'] && file_exists("../../" . $profilePhotoPath)) {
            unlink("../../" . $profilePhotoPath);
        }
        echo json_encode(["status" => 'error', 'message' => 'Error executing query']);
    }
} catch (PDOException $e) {
    if ($identityProofPath !== $existingData['identity_proof'] && file_exists("../../" . $identityProofPath)) {
        unlink("../../" . $identityProofPath);
    }
    if ($profilePhotoPath !== $existingData['profile_photo'] && file_exists("../../" . $profilePhotoPath)) {
        unlink("../../" . $profilePhotoPath);
    }
    echo json_encode(["status" => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>

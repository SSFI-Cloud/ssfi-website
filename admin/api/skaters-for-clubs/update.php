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
    echo json_encode(['status' => 'error', 'message' => "Skater ID is required"]);
    exit;
}
$skater_id = sanitizeInput($_POST['id']);

// Fetch existing file paths
$stmt = $pdo->prepare("SELECT membership_id,identity_proof, profile_photo FROM tbl_skaters WHERE id = ?");
$stmt->execute([$skater_id]);
$existingData = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$existingData) {
    echo json_encode(['status' => 'error', 'message' => "Skater ID is invalid"]);
    exit;
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

// File upload function
function uploadFile($file, $type) {
    global $errors;
    $year = date('Y');
    $month = date('m');
    $uploadDir = "../../uploads/skaters/$type/$year/$month/";

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

    return "uploads/skaters/$type/$year/$month/$newFileName";
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
    $stmt = $pdo->prepare("UPDATE tbl_skaters SET 
            full_name = :full_name, 
            father_name = :father_name, 
            mobile_number = :mobile_number, 
            date_of_birth = :date_of_birth, 
            category_type_id = :category_type_id, 
            gender = :gender, 
            blood_group = :blood_group, 
            school_name = :school_name, 
            aadhar_number = :aadhar_number, 
            email_address = :email_address, 
            club_id = :club_id, 
            i_am = :i_am, 
            nominee_relation = :nominee_relation, 
            nominee_age = :nominee_age, 
            nominee_name = :nominee_name, 
            coach_name = :coach_name, 
            coach_mobile_number = :coach_mobile_number, 
            state_id = :state_id, 
            district_id = :district_id, 
            residential_address = :residential_address, 
            identity_proof = :identity_proof, 
            profile_photo = :profile_photo, 
            updated_at = NOW() 
            WHERE id = :skater_id");

    $stmt->bindParam(':skater_id', $skater_id);

    foreach ($postData as $key => $value) {
        $stmt->bindParam(":$key", $postData[$key]);
    }

    $stmt->bindParam(':identity_proof', $identityProofPath);
    $stmt->bindParam(':profile_photo', $profilePhotoPath);
    
    
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
        (skater_id, session_id, age, age_category)
        VALUES (:skater_id, :session_id, :age, :age_category)");

    $stmts->bindParam(':skater_id', $skater_id);
    $stmts->bindParam(':session_id', $session_id);
    $stmts->bindParam(':age', sanitizeInput($_POST['age']));
    $stmts->bindParam(':age_category', sanitizeInput($_POST['agecat']));
}

    if ($stmt->execute() && $stmts->execute()) {
        if ($identityProofPath !== $existingData['identity_proof'] && file_exists("../../" . $existingData['identity_proof'])) {
            unlink("../../" . $existingData['identity_proof']);
        }
        if ($profilePhotoPath !== $existingData['profile_photo'] && file_exists("../../" . $existingData['profile_photo'])) {
            unlink("../../" . $existingData['profile_photo']);
        }
        echo json_encode(["status" => 'success', "message" => $existingData['membership_id']." - Skater updated successfully"]);
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

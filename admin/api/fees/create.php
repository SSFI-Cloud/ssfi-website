<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Adjust this path if necessary

// Log request data
error_log("Club creation request received");
error_log(json_encode($_POST));

$errors = [];

// Function to sanitize input
define('FILTER_SANITIZE', FILTER_SANITIZE_STRING);
function sanitizeInput($data) {
    return filter_var(trim($data), FILTER_SANITIZE);
}

// Required fields
$requiredFields = ['club_name', 'contact_person', 'mobile_number', 'district_id', 'state_id'];
$postData = [];
foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        $errors[] = "Field '$field' is required";
    } else {
        $postData[$field] = sanitizeInput($_POST[$field]);
    }
}

// Validate optional fields
$optionalFields = ['registration_number', 'email_address', 'club_address', 'established_year', 'status', 'created_by', 'updated_by'];
foreach ($optionalFields as $field) {
    $postData[$field] = !empty($_POST[$field]) ? sanitizeInput($_POST[$field]) : null;
}

// Validate email
if (!empty($postData['email_address']) && !filter_var($postData['email_address'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format";
}

// Validate mobile number
if (!empty($postData['mobile_number']) && !preg_match('/^\+?[0-9]{10,15}$/', $postData['mobile_number'])) {
    $errors[] = "Invalid mobile number format";
}

// Validate established_year
if (!empty($postData['established_year']) && !preg_match('/^\d{4}$/', $postData['established_year'])) {
    $errors[] = "Invalid established year format";
}

// Validate district_id
$stmt = $pdo->prepare("SELECT COUNT(*) FROM tbl_districts WHERE id = ?");
$stmt->execute([$postData['district_id']]);
if ($stmt->fetchColumn() == 0) {
    $errors[] = "Invalid district_id";
}

// Validate state_id
$stmt = $pdo->prepare("SELECT COUNT(*) FROM tbl_states WHERE id = ?");
$stmt->execute([$postData['state_id']]);
if ($stmt->fetchColumn() == 0) {
    $errors[] = "Invalid state_id";
}

// Handle logo upload
$uploadDir = '../../uploads/clubs/';
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
$logoPath = null;

if (!empty($_FILES['logo']['name'])) {
    $fileName = $_FILES['logo']['name'];
    $fileTmpName = $_FILES['logo']['tmp_name'];
    $fileSize = $_FILES['logo']['size'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Validate file type
    if (!in_array($fileExt, $allowedExtensions)) {
        $errors[] = "Invalid file type. Allowed types: jpg, jpeg, png, gif.";
    }

    // Validate file size (max 2MB)
    if ($fileSize > 2 * 1024 * 1024) {
        $errors[] = "File size exceeds 2MB.";
    }

    // Create directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Generate unique filename
    $newFileName = uniqid('club_logo_') . '.' . $fileExt;
    $logoPath = $uploadDir . $newFileName;

    // Move file to upload directory
    if (!move_uploaded_file($fileTmpName, $logoPath)) {
        $errors[] = "Failed to upload logo.";
    } else {
        // Store only relative path in DB
        $logoPath = 'uploads/clubs/' . $newFileName;
    }
}

// If validation fails, return errors
if (!empty($errors)) {
    echo json_encode(['status' => 'error', 'message' => $errors]);
    exit;
}

// Default values
$postData['created_by'] = $postData['created_by'] ?? 0;
$postData['updated_by'] = $postData['updated_by'] ?? 0;
$postData['status'] = $postData['status'] ?? 'active';

try {
    $stmt = $pdo->prepare("INSERT INTO tbl_clubs 
        (club_name, registration_number, contact_person, mobile_number, email_address, district_id, state_id, club_address, established_year, logo_path, status, created_by, updated_by, created_at, updated_at) 
        VALUES (:club_name, :registration_number, :contact_person, :mobile_number, :email_address, :district_id, :state_id, :club_address, :established_year, :logo_path, :status, :created_by, :updated_by, NOW(), NOW())");

    $stmt->bindParam(':club_name', $postData['club_name']);
    $stmt->bindParam(':registration_number', $postData['registration_number']);
    $stmt->bindParam(':contact_person', $postData['contact_person']);
    $stmt->bindParam(':mobile_number', $postData['mobile_number']);
    $stmt->bindParam(':email_address', $postData['email_address']);
    $stmt->bindParam(':district_id', $postData['district_id']);
    $stmt->bindParam(':state_id', $postData['state_id']);
    $stmt->bindParam(':club_address', $postData['club_address']);
    $stmt->bindParam(':established_year', $postData['established_year']);
    $stmt->bindParam(':logo_path', $logoPath);
    $stmt->bindParam(':status', $postData['status']);
    $stmt->bindParam(':created_by', $postData['created_by']);
    $stmt->bindParam(':updated_by', $postData['updated_by']);

    if ($stmt->execute()) {
        echo json_encode(["status" => 'success', "message" => "Club created successfully"]);
    } else {
        echo json_encode(["status" => 'error', 'message' => 'Error executing query']);
    }
} catch (PDOException $e) {
    error_log("Error adding club: " . $e->getMessage());
    echo json_encode(["status" => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>

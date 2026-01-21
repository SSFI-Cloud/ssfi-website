<?php
header('Content-Type: application/json');
include '../../config/config.php';

error_log("Club update request received");
error_log(json_encode($_POST));

$errors = [];
$is_old_image_unlink = false;

// Function to sanitize input
function sanitizeInput($data)
{
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Validate club ID
if (empty($_POST['id'])) {
    echo json_encode(['status' => 'error', 'message' => "Club ID is required"]);
    exit;
}
$club_id = sanitizeInput($_POST['id']);

// Fetch old logo path
$stmt = $pdo->prepare("SELECT logo_path FROM tbl_clubs WHERE id = ?");
$stmt->execute([$club_id]);
$oldLogo = $stmt->fetchColumn();

// Required fields
$requiredFields = ['club_name', 'contact_person', 'mobile_number', 'district_id', 'state_id'];
$updateData = [];
foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        $errors[] = "Field '$field' is required";
    } else {
        $updateData[$field] = sanitizeInput($_POST[$field]);
    }
}

// Optional fields
$optionalFields = ['registration_number', 'email_address', 'club_address', 'established_year', 'status'];
foreach ($optionalFields as $field) {
    $updateData[$field] = !empty($_POST[$field]) ? sanitizeInput($_POST[$field]) : null;
}

$updateData['updated_by'] = !empty($_POST['updated_by']) ? sanitizeInput($_POST['updated_by']) : 0;

// Validate email
if (!empty($updateData['email_address']) && !filter_var($updateData['email_address'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format";
}

// Validate mobile number
if (!empty($updateData['mobile_number']) && !preg_match('/^\+?[0-9]{10,15}$/', $updateData['mobile_number'])) {
    $errors[] = "Invalid mobile number format";
}

// Validate established_year
if (!empty($updateData['established_year']) && !preg_match('/^\d{4}$/', $updateData['established_year'])) {
    $errors[] = "Invalid established year format";
}

// Validate district_id and state_id
foreach (['district_id' => 'tbl_districts', 'state_id' => 'tbl_states'] as $key => $table) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM $table WHERE id = ?");
    $stmt->execute([$updateData[$key]]);
    if ($stmt->fetchColumn() == 0) {
        $errors[] = "Invalid $key";
    }
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

    if (!in_array($fileExt, $allowedExtensions)) {
        $errors[] = "Invalid file type. Allowed types: jpg, jpeg, png, gif.";
    }

    if ($fileSize > 2 * 1024 * 1024) {
        $errors[] = "File size exceeds 2MB.";
    }

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $newFileName = uniqid('club_logo_') . '.' . $fileExt;
    $logoPath = $uploadDir . $newFileName;

    if (!move_uploaded_file($fileTmpName, $logoPath)) {
        $errors[] = "Failed to upload logo.";
    } else {
        $is_old_image_unlink = true;
        $updateData['logo_path'] = 'uploads/clubs/' . $newFileName;
    }
}

if (!empty($errors)) {
    echo json_encode(['status' => 'error', 'message' => $errors]);
    exit;
}

$updateFields = [];
$filteredData = [];

foreach ($updateData as $key => $value) {
    $updateFields[] = "`$key` = :$key";
    $filteredData[$key] = $value ?? "";
}

$updateFields = implode(', ', $updateFields);

try {
    $stmt = $pdo->prepare("UPDATE tbl_clubs SET $updateFields, updated_at = NOW() WHERE id = :club_id");
    $filteredData['club_id'] = $club_id;

    if ($stmt->execute($filteredData)) {
        if (!empty($oldLogo) && file_exists('../../' . $oldLogo) && $is_old_image_unlink) {
            unlink('../../' . $oldLogo);
        }

        echo json_encode(["status" => 'success', "message" => "Club updated successfully"]);
    } else {
        if (!empty($logoPath) && file_exists($logoPath)) {
            unlink($logoPath);
        }
        echo json_encode(["status" => 'error', 'message' => 'Error executing query']);
    }
} catch (PDOException $e) {
    error_log("Error updating club: " . $e->getMessage());
    if (!empty($logoPath) && file_exists($logoPath)) {
        unlink($logoPath);
    }
    echo json_encode(["status" => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>

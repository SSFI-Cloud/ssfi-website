<?php
header('Content-Type: application/json');
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

include '../../config/config.php'; // Ensure correct path

$errors = [];
$postData = [];

// Function to sanitize input
function sanitizeInput($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Check if id is provided
if (!isset($_POST['id']) || empty($_POST['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Event ID is required.']);
    exit;
}

$id = sanitizeInput($_POST['id']);

// Fields to update
$updateFields = ['event_name', 'event_date', 'reg_start_date', 'reg_end_date', 'event_fees', 'venue', 'association_name', 'reg_no', 'title_of_championship', 'date','date1', 'event_description', 'status', 'event_remarks'];

$updateData = [];
$queryParams = [];

foreach ($updateFields as $field) {
    if (isset($_POST[$field]) && $_POST[$field] !== '') {
        $updateData[$field] = sanitizeInput($_POST[$field]);
        $queryParams[] = "$field = :$field";
    }
}

// Convert date fields to correct format
if (!empty($updateData['event_date'])) {
    $updateData['event_date'] = date('Y-m-d', strtotime($updateData['event_date']));
}
if (!empty($updateData['reg_start_date'])) {
    $updateData['reg_start_date'] = date('Y-m-d H:i:s', strtotime($updateData['reg_start_date']));
}
if (!empty($updateData['reg_end_date'])) {
    $updateData['reg_end_date'] = date('Y-m-d H:i:s', strtotime($updateData['reg_end_date']));
}
if (!empty($updateData['date'])) {
    $updateData['date'] = date('Y-m-d', strtotime($updateData['date']));
}
if (!empty($updateData['date1'])) {
    $updateData['date1'] = date('Y-m-d', strtotime($updateData['date1']));
}

// File Uploads
$uploadDir = '../../uploads/n-events/';
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

function uploadFile($fileKey, $uploadDir, $allowedExtensions) {
    if (!isset($_FILES[$fileKey]) || $_FILES[$fileKey]['error'] != 0) {
        return null; // No file uploaded
    }

    $fileName = $_FILES[$fileKey]['name'];
    $fileTmpName = $_FILES[$fileKey]['tmp_name'];
    $fileSize = $_FILES[$fileKey]['size'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (!in_array($fileExt, $allowedExtensions)) {
        return "Invalid file type for $fileKey.";
    }

    if ($fileSize > 2 * 1024 * 1024) { // 2MB limit
        return "File size exceeds 2MB for $fileKey.";
    }

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $newFileName = uniqid($fileKey . '_') . '.' . $fileExt;
    $filePath = $uploadDir . $newFileName;

    if (!move_uploaded_file($fileTmpName, $filePath)) {
        return "Failed to upload $fileKey.";
    }

    return 'uploads/n-events/' . $newFileName; // Store relative path in DB
}

// Handle file uploads (only if a new file is uploaded)
$fileKeys = ['event_image' => 'event_image', 'secretory_sign' => 'secretory_sign', 'president_sign' => 'president_sign'];
foreach ($fileKeys as $inputName => $dbColumn) {
    $fileUploadResult = uploadFile($inputName, $uploadDir, $allowedExtensions);
    if (is_string($fileUploadResult) && strpos($fileUploadResult, 'Failed') !== false) {
        $errors[] = $fileUploadResult;
    } elseif ($fileUploadResult) {
        $updateData[$dbColumn] = $fileUploadResult;
        $queryParams[] = "$dbColumn = :$dbColumn";
    }
}

// If validation fails, return errors
if (!empty($errors)) {
    echo json_encode(['status' => 'error', 'message' => $errors]);
    exit;
}

// Ensure there's at least one field to update
if (empty($updateData)) {
    echo json_encode(['status' => 'error', 'message' => 'No fields provided for update.']);
    exit;
}

// Construct the SQL query dynamically
$query = "UPDATE tbl_events SET " . implode(', ', $queryParams) . ", updated_at = NOW() WHERE id = :id";
$updateData['id'] = $id;

// Execute the update query
try {
    $stmt = $pdo->prepare($query);
    foreach ($updateData as $key => $value) {
        $stmt->bindValue(":$key", $value);
    }

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "National Event updated successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error executing update query"]);
    }
} catch (PDOException $e) {
    error_log("Error updating event: " . $e->getMessage());
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}
?>

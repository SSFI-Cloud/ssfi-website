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

// Validate required fields
$requiredFields = ['event_name', 'event_date', 'reg_start_date', 'reg_end_date', 'event_fees', 'venue', 'association_name', 'reg_no', 'title_of_championship', 'date','date1'];
foreach ($requiredFields as $field) {
    $postData[$field] = isset($_POST[$field]) ? sanitizeInput($_POST[$field]) : null;
    if (!$postData[$field]) {
        $errors[] = "Field '$field' is required.";
    }
}

// Validate optional fields
$optionalFields = ['event_description', 'status', 'event_level_type_id', 'event_remarks'];
foreach ($optionalFields as $field) {
    $postData[$field] = isset($_POST[$field]) ? sanitizeInput($_POST[$field]) : null;
}

// Ensure `event_level_type_id` has a default value
$postData['event_level_type_id'] =  3;

// Convert dates
$postData['event_date'] = date('Y-m-d', strtotime($postData['event_date']));
$postData['reg_start_date'] = date('Y-m-d H:i:s', strtotime($postData['reg_start_date']));
$postData['reg_end_date'] = date('Y-m-d H:i:s', strtotime($postData['reg_end_date']));
$postData['date'] = date('Y-m-d', strtotime($postData['date']));

// File Uploads
$uploadDir = '../../uploads/n-events/';
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

function uploadFile($fileKey, $uploadDir, $allowedExtensions) {
    if (!isset($_FILES[$fileKey]) || $_FILES[$fileKey]['error'] != 0) {
        return null;
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

$postData['event_image'] = uploadFile('event_image', $uploadDir, $allowedExtensions);
$postData['secretory_sign'] = uploadFile('secretory_sign', $uploadDir, $allowedExtensions);
$postData['president_sign'] = uploadFile('president_sign', $uploadDir, $allowedExtensions);

// Check for file upload errors
foreach (['event_image', 'secretory_sign', 'president_sign'] as $fileKey) {
    if (is_string($postData[$fileKey]) && strpos($postData[$fileKey], 'Failed') !== false) {
        $errors[] = $postData[$fileKey];
        $postData[$fileKey] = null;
    }
}

// If validation fails, return errors
if (!empty($errors)) {
    echo json_encode(['status' => 'error', 'message' => $errors]);
    exit;
}

// Insert event into the database
try {
    $stmt = $pdo->prepare("INSERT INTO tbl_events 
        (event_name, event_level_type_id, event_date, reg_start_date, reg_end_date, event_fees,event_remarks, venue, title_of_championship, date,date1, association_name, reg_no, event_description, status, event_image, secretory_sign, president_sign, created_at, updated_at) 
        VALUES (:event_name, :event_level_type_id, :event_date, :reg_start_date, :reg_end_date, :event_fees,:event_remarks, :venue, :title_of_championship, :date,:date1, :association_name, :reg_no, :event_description, :status, :event_image, :secretory_sign, :president_sign, NOW(), NOW())");

    $stmt->bindParam(':event_name', $postData['event_name']);
    $stmt->bindParam(':event_level_type_id', $postData['event_level_type_id']);
    // $stmt->bindParam(':state_id', $postData['state_id']);
    // $stmt->bindParam(':district_id', $postData['district_id']);
    $stmt->bindParam(':event_date', $postData['event_date']);
    $stmt->bindParam(':reg_start_date', $postData['reg_start_date']);
    $stmt->bindParam(':reg_end_date', $postData['reg_end_date']);
    $stmt->bindParam(':event_fees', $postData['event_fees']);
    $stmt->bindParam(':event_remarks', $postData['event_remarks']);
    $stmt->bindParam(':venue', $postData['venue']);
    $stmt->bindParam(':title_of_championship', $postData['title_of_championship']);
    $stmt->bindParam(':date', $postData['date']);
    $stmt->bindParam(':date1', $postData['date1']);
    $stmt->bindParam(':association_name', $postData['association_name']);
    $stmt->bindParam(':reg_no', $postData['reg_no']);
    $stmt->bindParam(':event_description', $postData['event_description']);
    $stmt->bindParam(':status', $postData['status']);
    $stmt->bindParam(':event_image', $postData['event_image']);
    $stmt->bindParam(':secretory_sign', $postData['secretory_sign']);
    $stmt->bindParam(':president_sign', $postData['president_sign']);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "National Event created successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error executing query"]);
    }
} catch (PDOException $e) {
    error_log("Error adding event: " . $e->getMessage());
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}
?>

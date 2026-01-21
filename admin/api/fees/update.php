<?php
header('Content-Type: application/json');
include '../../config/config.php';

error_log("Fees update request received");
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
    echo json_encode(['status' => 'error', 'message' => "Fees ID is required"]);
    exit;
}
$id = sanitizeInput($_POST['id']);



// Required fields
$requiredFields = ['state_fees','district_fees','skater_fees'];
$updateData = [];
foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        $errors[] = "Field '$field' is required";
    } else {
        $updateData[$field] = sanitizeInput($_POST[$field]);
    }
}



// $updateData['updated_by'] = !empty($_POST['updated_by']) ? sanitizeInput($_POST['updated_by']) : 0;





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
    $stmt = $pdo->prepare("UPDATE tbl_fees SET $updateFields, updated_at = NOW() WHERE id = :id");
    $filteredData['id'] = $id;

    if ($stmt->execute($filteredData)) {
        

        echo json_encode(["status" => 'success', "message" => "Fees updated successfully"]);
    } else {
        
        echo json_encode(["status" => 'error', 'message' => 'Error executing query']);
    }
} catch (PDOException $e) {
    error_log("Error updating Fees: " . $e->getMessage());
    
    echo json_encode(["status" => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>

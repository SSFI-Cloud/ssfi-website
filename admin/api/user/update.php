<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Adjust this path if necessary

// Read JSON input
$inputData = json_decode(file_get_contents('php://input'), true);

// Sanitize and validate functions
function sanitizeText($text) {
    return htmlspecialchars(trim($text));
}

$errors = [];
$requiredFields = ['id', 'branch_id', 'user_id', 'username', 'status'];

// Initialize variables
$id = $branch_id = $user_id = $username = $password = $status = $updated_by = '';
$updated_at = date('Y-m-d H:i:s');
$updated_by=1;

// Validate and sanitize input
foreach ($requiredFields as $field) {
    if (isset($inputData[$field]) && !empty($inputData[$field])) {
        $$field = sanitizeText($inputData[$field]);
    } else {
        $errors[] = "Field '$field' is required";
    }
}

// Validate status
if (!in_array($status, ['active', 'inactive'])) {
    $errors[] = "Invalid status value. Allowed values are 'active' or 'inactive'";
}

// If validation fails, return errors
if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

// Update user in the database
try {
    $stmt = $pdo->prepare("UPDATE tbl_user SET branch_id = :branch_id, user_id = :user_id, username = :username, status = :status, updated_at = :updated_at, updated_by = :updated_by WHERE id = :id");
    
    // Bind parameters
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':branch_id', $branch_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':updated_at', $updated_at);
    $stmt->bindParam(':updated_by', $updated_by);
    
    // Execute the query
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "User updated successfully"]);
    } else {
        echo json_encode(["success" => false, 'message' => 'Error executing query']);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>

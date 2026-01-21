<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Adjust this path if necessary

// Log the request
error_log("Role deletion request received");

// Read JSON input
$inputData = json_decode(file_get_contents('php://input'), true);

// Declare variables and initialize
$id = $deleted_by = '';
$errors = [];

// Sanitize and validate functions
function sanitizeText($text) {
    return htmlspecialchars(trim($text));
}

function validateRequiredField($field, $fieldName) {
    global $errors;
    if (empty($field)) {
        $errors[] = "Field '$fieldName' is required";
    }
}

// Validate and sanitize required fields
$id = isset($inputData['id']) ? sanitizeText($inputData['id']) : '';
validateRequiredField($id, 'id');

// Sanitize user data (deleted_by)
// $deleted_by = isset($inputData['deleted_by']) ? sanitizeText($inputData['deleted_by']) : 1;

// If validation fails, return errors
if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

try {
   
    $stmt = $pdo->prepare("DELETE FROM roles WHERE id = :id");
    if ($stmt->execute([':id' => $id])) {
        

        echo json_encode(["success" => true, "message" => "Role deleted successfully"]);
    } else {
        echo json_encode(["success" => false, 'message' => 'Failed to delete Role']);
    }

} catch (PDOException $e) {
    error_log("Error deleting club: " . $e->getMessage());
    echo json_encode(["success" => false, 'error' => 'Database error: ' . $e->getMessage()]);
}
?>

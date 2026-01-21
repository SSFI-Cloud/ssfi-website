<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Adjust this path if necessary

// Log the request
error_log("Customer deletion request received");

// Read JSON input
$inputData = json_decode(file_get_contents('php://input'), true);

// Declare variables and initialize
$id = $status = $deleted_by = '';
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
$deleted_by = isset($inputData['deleted_by']) ? sanitizeText($inputData['deleted_by']) : 1;

// If validation fails, return errors
if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

// Prepare and execute the query to delete awb series data
try {
    
    
    // Check if the user exists in the database
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM awb_series_allocation WHERE id = :id");
        $checkStmt->execute([':id' => $id]);
        $userExists = $checkStmt->fetchColumn();

        if ($userExists > 0) {
            $stmt = $pdo->prepare("DELETE FROM awb_series_allocation WHERE id = :id");
            $stmt->execute([':id' => $id]);
            echo json_encode(["success" => true, "message" => "AWB Series  deleted successfully"]);
        } else {
            echo json_encode(["success" => false, 'message' => 'No awb series found or already deleted']);
        }
} catch (PDOException $e) {
    error_log("Error deleting awb series: " . $e->getMessage());
    echo json_encode(["success" => false, 'error' => 'Error deleting awb series: ' . $e->getMessage()]);
}
?>

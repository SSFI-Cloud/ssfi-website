<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Adjust path if needed

// Log the request
error_log("Event registration deletion request received");

// Read JSON input
$inputData = json_decode(file_get_contents('php://input'), true);

// Initialize variables
$id = $deleted_by = $event_id = '';
$errors = [];

// Sanitize input
function sanitizeText($text) {
    return htmlspecialchars(trim($text), ENT_QUOTES, 'UTF-8');
}

// Validate required fields
function validateRequiredField($value, $fieldName) {
    global $errors;
    if (empty($value)) {
        $errors[] = "Field '$fieldName' is required.";
    }
}

// Extract and sanitize input
$id         = isset($inputData['id'])         ? sanitizeText($inputData['id'])         : '';
$event_id   = isset($inputData['event_ids'])  ? sanitizeText($inputData['event_ids'])  : ''; // Should ideally be renamed to 'event_id'
$deleted_by = isset($inputData['deleted_by']) ? sanitizeText($inputData['deleted_by']) : '1';

// Validate required inputs
validateRequiredField($id, 'id');
validateRequiredField($event_id, 'event_id');

// If validation fails, return error
if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

try {
    // Prepare DELETE query
    $stmt = $pdo->prepare("DELETE FROM tbl_event_registration WHERE skater_id = :id AND event_id = :event_id");

    $success = $stmt->execute([
        ':id' => $id,
        ':event_id' => $event_id
    ]);

    if ($success) {
        echo json_encode([
            "success" => true,
            "message" => "Event registration deleted successfully."
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            "success" => false,
            "message" => "Failed to delete event registration."
        ]);
    }

} catch (PDOException $e) {
    error_log("Error deleting event registration: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "error" => "Database error: " . $e->getMessage()
    ]);
}
?>

<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Adjust this path if necessary

// Log the request
error_log("Skaters deletion request received");

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
$deleted_by = isset($inputData['deleted_by']) ? sanitizeText($inputData['deleted_by']) : 1;

// If validation fails, return errors
if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

try {
    // Check if the club exists in the database and fetch the logo path
    // $checkStmt = $pdo->prepare("SELECT logo_path FROM tbl_events WHERE id = :id");
    // $checkStmt->execute([':id' => $id]);
    // $clubData = $checkStmt->fetch(PDO::FETCH_ASSOC);

    // if (!$clubData) {
    //     echo json_encode(["success" => false, 'message' => 'Events not found or already deleted']);
    //     exit;
    // }

    // $logoPath = $clubData['logo_path']; // Get the logo path

    // Delete the club record from the database
    $stmt = $pdo->prepare("DELETE FROM tbl_skaters WHERE id = :id");
    // $stmt->execute([':id' => $id]);
     if ($stmt->execute([':id' => $id])) {
    //   if(1){  
        // Unlink (delete) the logo file if it exists
        /*if (!empty($logoPath) && file_exists('../../' . $logoPath)) {
            unlink('../../' . $logoPath);
        }*/

        echo json_encode(["success" => true, "message" => "Skaters deleted successfully, logo removed"]);
    } else {
        echo json_encode(["success" => false, 'message' => 'Failed to delete Skaters']);
    }

} catch (PDOException $e) {
    error_log("Error deleting club: " . $e->getMessage());
    echo json_encode(["success" => false, 'error' => 'Database error: ' . $e->getMessage()]);
}
?>

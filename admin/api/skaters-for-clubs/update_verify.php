<?php
header('Content-Type: application/json');
include '../../config/config.php';

error_log("Skater verification update request received");

// Read incoming data correctly
$input = json_decode(file_get_contents("php://input"), true);
if (!$input) {
    $input = $_POST; // Fallback to $_POST if not JSON
}

error_log("Received data: " . json_encode($input));

// Function to sanitize input
function sanitizeInput($data)
{
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Validate skater ID
if (!isset($input['id']) || trim($input['id']) === '') {
    echo json_encode(['status' => 'error', 'message' => "Skater ID is required"]);
    exit;
}

$skater_id = (int) $input['id']; // Convert ID to integer

// Assign verified status (default to 1)
$verified_status = isset($input['verified']) ? (int) $input['verified'] : 1;
$verified_by = isset($input['verified_by']) ? sanitizeInput($input['verified_by']) : 0;

try {
    // Prepare SQL query
    $stmt = $pdo->prepare("UPDATE tbl_skaters 
                          SET verified = :verified, 
                              verified_by = :verified_by, 
                              updated_at = NOW() 
                          WHERE id = :skater_id");

    // Bind values
    $stmt->bindParam(':verified', $verified_status, PDO::PARAM_INT);
    $stmt->bindParam(':verified_by', $verified_by, PDO::PARAM_INT);
    $stmt->bindParam(':skater_id', $skater_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(["status" => 'success', "message" => "Skater verified successfully"]);
    } else {
        echo json_encode(["status" => 'error', 'message' => 'Error updating skater verification status']);
    }
} catch (PDOException $e) {
    error_log("Error updating skater verification: " . $e->getMessage());
    echo json_encode(["status" => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>

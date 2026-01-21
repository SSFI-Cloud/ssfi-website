<?php
include '../../config/config.php'; // Ensure correct path
// Read the raw POST data (JSON format)
$data = json_decode(file_get_contents("php://input"), true);

// Check if the 'id' is provided
if (!empty($data['id']) && is_numeric($data['id'])) {
    $id = (int)$data['id'];  // Casting to integer for security

    try {
        // Check if the user exists in the database
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM tbl_city WHERE id = :id");
        $checkStmt->execute([':id' => $id]);
        $userExists = $checkStmt->fetchColumn();

        if ($userExists > 0) {
            $stmt = $pdo->prepare("DELETE FROM tbl_city WHERE id = :id");
            $stmt->execute([':id' => $id]);
            // echo json_encode(["message" => "Location deleted successfully"]);
             echo json_encode(["success" => true, "message" => "Location created successfully"]);
        } else {
            // echo json_encode(["error" => "Location not found"]);
            echo json_encode(['success' => false, 'error' => 'Error executing query']);
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => "Error deleting user: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "Invalid or missing 'id' in input data"]);
}
?>

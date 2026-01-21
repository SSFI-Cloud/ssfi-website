<?php
include '../../config/config.php'; // Ensure correct path
// Read the raw POST data (JSON format)
$data = json_decode(file_get_contents("php://input"), true);

// Check if the 'id' is provided
if (!empty($data['id']) && is_numeric($data['id'])) {
    $id = (int)$data['id'];  // Casting to integer for security

    try {
        // Check if the user exists in the database
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM tbl_products WHERE id = :id");
        $checkStmt->execute([':id' => $id]);
        $userExists = $checkStmt->fetchColumn();

        if ($userExists > 0) {
            $stmt = $pdo->prepare("DELETE FROM tbl_products WHERE id = :id");
            $stmt->execute([':id' => $id]);
            echo json_encode(["message" => "User deleted successfully"]);
        } else {
            echo json_encode(["error" => "User not found"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => "Error deleting user: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "Invalid or missing 'id' in input data"]);
}
?>

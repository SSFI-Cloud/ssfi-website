<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Ensure correct path

// Read JSON input
$inputData = json_decode(file_get_contents('php://input'), true);

// Log the request
error_log("Product update request received: " . json_encode($inputData));

$errors = [];

// Function to sanitize input
function sanitizeText($text) {
    return htmlspecialchars(trim($text));
}

// Validate input
if (!isset($inputData['id']) || empty($inputData['id'])) {
    $errors[] = "Field 'id' is required";
} else {
    $id = sanitizeText($inputData['id']);
}

if (!isset($inputData['name']) || empty($inputData['name'])) {
    $errors[] = "Field 'name' is required";
} else {
    $name = sanitizeText($inputData['name']);
}

if (!isset($inputData['status']) || !in_array($inputData['status'], ['active', 'inactive'])) {
    $errors[] = "Field 'status' is required and must be 'active' or 'inactive'";
} else {
    $status = sanitizeText($inputData['status']);
}

// Default static values
$inputData['updated_by'] = $inputData['updated_by'] ?? 1;

if (!isset($inputData['updated_by']) || empty($inputData['updated_by'])) {
    $errors[] = "Field 'updated_by' is required";
} else {
    $updated_by = sanitizeText($inputData['updated_by']);
}

// Return validation errors if any
if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

// Prepare SQL statement
$sql = "UPDATE tbl_products SET name = :name, status = :status, updated_by = :updated_by, updated_at = NOW() WHERE id = :id";
$params = [
    ':id' => $id,
    ':name' => $name,
    ':status' => $status,
    ':updated_by' => $updated_by
];

try {
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute($params)) {
        echo json_encode(["success" => true, "message" => "Product updated successfully"]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error executing update query']);
    }
} catch (PDOException $e) {
    error_log("Error updating product: " . $e->getMessage());
    echo json_encode(['success' => false, 'error' => 'Database error: ' . $e->getMessage()]);
}
?>

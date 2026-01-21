<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Ensure correct path

// Read JSON input
$inputData = json_decode(file_get_contents('php://input'), true);

// Log the request
error_log("Product create request received: " . json_encode($inputData));

$errors = [];

// Function to sanitize input
function sanitizeText($text) {
    return htmlspecialchars(trim($text));
}

// Validate input
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
$inputData['created_by'] = $inputData['created_by'] ?? 1;

if (!isset($inputData['created_by']) || empty($inputData['created_by'])) {
    $errors[] = "Field 'created_by' is required";
} else {
    $created_by = sanitizeText($inputData['created_by']);
}

// Return validation errors if any
if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

// Prepare SQL statement
$sql = "INSERT INTO tbl_city (name, status, created_by, created_at) VALUES (:name, :status, :created_by, NOW())";
$params = [
    ':name' => $name,
    ':status' => $status,
    ':created_by' => $created_by
];

try {
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute($params)) {
        echo json_encode(["success" => true, "message" => "Location created successfully"]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error executing query']);
    }
} catch (PDOException $e) {
    error_log("Error creating product: " . $e->getMessage());
    echo json_encode(['success' => false, 'error' => 'Database error: ' . $e->getMessage()]);
}
?>

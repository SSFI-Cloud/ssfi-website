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
$requiredFields = ['branch_id', 'user_id', 'username', 'password', 'status'];

// Initialize variables
$branch_id = $user_id = $username = $password = $status = $created_by = '';
$created_at = date('Y-m-d H:i:s');
$created_by=1;
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

// Hash the password


// Insert user into the database
try {
    $stmt = $pdo->prepare("INSERT INTO tbl_user (`branch_id`, `user_id`, `username`, `password`, `status`, `created_at`, `created_by`,`updated_by`) 
                            VALUES (:branch_id, :user_id, :username, :password, :status, :created_at, :created_by, :updated_by)");
    
    // Bind parameters
    $stmt->bindParam(':branch_id', $branch_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':created_at', $created_at);
    $stmt->bindParam(':created_by', $created_by);
    $stmt->bindParam(':updated_by', $updated_by);
    
    // Execute the query
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "User created successfully"]);
    } else {
        echo json_encode(["success" => false, 'message' => 'Error executing query']);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>

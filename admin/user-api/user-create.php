<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Adjust this path if necessary

// Log the request
error_log("Branch creation request received STEPHEN"); 
error_log(json_encode($_POST));
// `id`, `branch_id`, `user_id`, `username`, `password`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`
// Declare all variables at the top
$id = $branch_id = $user_id = $username = $password = $status = $created_at = $updated_at = $created_by = $updated_by = '';
$errors = [];

// Sanitize and validate functions
function sanitizeText($text) {
    return htmlspecialchars(trim($text));
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL); 
}

function validatePhone($phone) {
    return preg_match('/^\+?[0-9]{10,15}$/', $phone);  // Allowing optional "+" and 10-15 digits
}

// Validate and sanitize POST data
$requiredFields = ['branch_id', '$user_id', 'username', 'password', 'status'];
$timezone = 1;
$created_by = 1;
foreach ($requiredFields as $field) {
    if (isset($_POST[$field]) && !empty($_POST[$field])) {
        $$field = sanitizeText($_POST[$field]);  // Sanitize input
    } else {
        $errors[] = "Field '$field' is required";
    }
}

// Additional validation
if (!empty($email) && !validateEmail($email)) {
    $errors[] = "Invalid email format";
}

if (!empty($mobile_number1) && !validatePhone($mobile_number1)) {
    $errors[] = "Invalid primary phone number format";
}

if (!empty($mobile_number2) && !validatePhone($mobile_number2)) {
    $errors[] = "Invalid secondary phone number format";
}

// If validation fails, return errors
if (!empty($errors)) {
    echo json_encode(['status' => 'error' ,'message' => $errors]);
    exit;
}
  
// Prepare and execute the query to insert branch data


// `id`, `branch_id`, `user_id`, `username`, `password`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`
try {
    $stmt = $pdo->prepare("INSERT INTO tbl_branch 
        (branch_id, user_id, username, password, status, created_at, updated_at, created_by, updated_by, ) VALUES 
        (:branch_id, :user_id, :username, :password, :status, :created_at, :updated_at, :created_by, :updated_by, NOW())");

    // Bind parameters after ensuring all POST values are sanitized
    $stmt->bindParam(':branch_id', $branch_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':username', $username);
    // $stmt->bindParam(':address', sanitizeText($_POST['address']));
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':created_at', $created_at);
    $stmt->bindParam(':updated_at', $updated_at);
    $stmt->bindParam(':created_by', $created_by);
    $stmt->bindParam(':updated_by', $updated_by);
    
    // $stmt->bindParam(':mobile_number2', $mobile_number2);
    // $stmt->bindParam(':email', $email);
    // $stmt->bindParam(':alternate_email', sanitizeText($_POST['alternate_email']));
    // $stmt->bindParam(':timezone', $timezone);
    // $stmt->bindParam(':remarks', sanitizeText($_POST['remarks']));
    // $stmt->bindParam(':status', $status);
    // $stmt->bindParam(':created_by', $created_by);

    if ($stmt->execute()) {
        echo json_encode(["status" => 'success', "message" => "Branch created successfully"]);
    } else {
        error_log("Query execution failed: " . implode(", ", $stmt->errorInfo()));
        echo json_encode(["status" => 'error' , 'message' => 'Error executing query']);
    }
} catch (PDOException $e) {
    error_log("Error adding branch: " . $e->getMessage());
    echo json_encode(["status" => 'error' ,'message' => 'Error adding branch: ' . $e->getMessage()]);
}
?>

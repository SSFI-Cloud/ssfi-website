<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Adjust this path if necessary

// Log the request

// Read JSON input
$inputData = json_decode(file_get_contents('php://input'), true);


error_log("Customer creation request received");

// Declare variables and initialize
$name = $mobile = $pincode = $address1 = $address2 = $status = $created_by = $updated_by = '';
$errors = [];

// Sanitize and validate functions
function sanitizeText($text) {
    return htmlspecialchars(trim($text));
}

function validatePhone($phone) {
    return preg_match('/^\+?[0-9]{10,15}$/', $phone); // Allowing optional "+" and 10-15 digits
}

// Validate and sanitize required fields
if (isset($inputData['name']) && !empty($inputData['name'])) {
    $name = sanitizeText($inputData['name']);
} else {
    $errors[] = "Field 'name' is required";
}

if (isset($inputData['mobile']) && !empty($inputData['mobile'])) {
    $mobile = sanitizeText($inputData['mobile']);
    if (!validatePhone($mobile)) {
        $errors[] = "Invalid mobile number format";
    }
} else {
    $errors[] = "Field 'mobile' is required";
}

if (isset($inputData['pincode']) && !empty($inputData['pincode'])) {
    $pincode = sanitizeText($inputData['pincode']);
} else {
    $errors[] = "Field 'pincode' is required";
}

// Sanitize optional fields
$address1 = isset($inputData['address1']) ? sanitizeText($inputData['address1']) : null;
$address2 = isset($inputData['address2']) ? sanitizeText($inputData['address2']) : null;

// Validate the 'status' field (must be 'active' or 'inactive')
if (isset($inputData['status']) && !empty($inputData['status'])) {
    $status = sanitizeText($inputData['status']);
    if (!in_array($status, ['active', 'inactive'])) {
        $errors[] = "Invalid status value. Allowed values are 'active' or 'inactive'";
    }
} else {
    $status = 'active'; // Default to 'active' if not provided
}

// Sanitize optional fields for user data
$created_by = isset($inputData['created_by']) ? sanitizeText($inputData['created_by']) : 1;
$updated_by = isset($inputData['updated_by']) ? sanitizeText($inputData['updated_by']) : 1;

// If validation fails, return errors
if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

// Check if the mobile number already exists
try {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM tbl_customer WHERE mobile = :mobile");
    $stmt->bindParam(':mobile', $mobile);
    $stmt->execute();
    $mobileExists = $stmt->fetchColumn();

    if ($mobileExists > 0) {
        echo json_encode(['success' => false, 'message' => 'Mobile number already exists']);
        exit;
    }

} catch (PDOException $e) {
    error_log("Error checking mobile number: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error checking mobile number']);
    exit;
}

// Prepare and execute the query to insert customer data
try {
    $stmt = $pdo->prepare("INSERT INTO tbl_customer 
        (name, mobile, pincode, address1, address2, status, created_at, created_by, updated_at, updated_by) 
        VALUES 
        (:name, :mobile, :pincode, :address1, :address2, :status, NOW(), :created_by, NOW(), :updated_by)");

    // Bind parameters
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':mobile', $mobile);
    $stmt->bindParam(':pincode', $pincode);
    $stmt->bindParam(':address1', $address1);
    $stmt->bindParam(':address2', $address2);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':created_by', $created_by);
    $stmt->bindParam(':updated_by', $updated_by);

    // Log the query and bound parameters for debugging
    error_log("Executing query: " . $stmt->queryString);
    error_log("Bound parameters: name=$name, mobile=$mobile, pincode=$pincode, address1=$address1, address2=$address2, status=$status, created_by=$created_by, updated_by=$updated_by");

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Customer created successfully"]);
    } else {
        error_log("Query execution failed: " . implode(", ", $stmt->errorInfo()));
        echo json_encode(["success" => false, 'message' => 'Error executing query']);
    }
} catch (PDOException $e) {
    error_log("Error adding customer: " . $e->getMessage());
    echo json_encode(["success" => false, 'message' => 'Error adding customer: ' . $e->getMessage()]);
}
?>

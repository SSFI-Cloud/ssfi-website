<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Adjust this path if necessary

// Log the request
error_log("Pickup Center Creation request received");

// Read JSON input
$inputData = json_decode(file_get_contents('php://input'), true);

// Declare variables and initialize
$name = $address = $city = $state = $pincode = $mobile_number = $status = $branch_id = $created_by = '';
$errors = [];

// Sanitize and validate functions
function sanitizeText($text) {
    return htmlspecialchars(trim($text));
}

// Validate and sanitize POST data
$requiredFields = ['name', 'address', 'city', 'state', 'pincode', 'mobile_number', 'branch_id'];
$created_by = 1; // Default created_by if not provided
$status = 'active'; // Default status if not provided

foreach ($requiredFields as $field) {
    if (isset($inputData[$field]) && !empty($inputData[$field])) {
        $$field = sanitizeText($inputData[$field]);  // Sanitize input
    } else {
        $errors[] = "Field '$field' is required";
    }
}

// Validate the 'status' field (must be 'active' or 'inactive')
if (isset($inputData['status']) && !empty($inputData['status'])) {
    $status = sanitizeText($inputData['status']);
    if (!in_array($status, ['active', 'inactive'])) {
        $errors[] = "Invalid status value. Allowed values are 'active' or 'inactive'";
    }
}

// Sanitize optional fields for user data
$created_by = isset($inputData['created_by']) ? sanitizeText($inputData['created_by']) : 1;

// If validation fails, return errors
if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

// Prepare and execute the query to insert pickup center data
try {
    $stmt = $pdo->prepare("INSERT INTO tbl_pickup_center 
        (`name`, `address`, `city`, `state`, `pincode`, `mobile_number`, `status`, `branch_id`, `created_by`, `created_at`) 
        VALUES 
        (:name, :address, :city, :state, :pincode, :mobile_number, :status, :branch_id, :created_by, NOW())");

    // Bind parameters
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':state', $state);
    $stmt->bindParam(':pincode', $pincode);
    $stmt->bindParam(':mobile_number', $mobile_number);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':branch_id', $branch_id);
    $stmt->bindParam(':created_by', $created_by);

    // Log the query and bound parameters for debugging
    error_log("Executing query: " . $stmt->queryString);
    error_log("Bound parameters: name=$name, address=$address, city=$city, state=$state, pincode=$pincode, mobile_number=$mobile_number, status=$status, branch_id=$branch_id, created_by=$created_by");

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Pickup Center created successfully"]);
    } else {
        error_log("Query execution failed: " . implode(", ", $stmt->errorInfo()));
        echo json_encode(["success" => false, 'message' => 'Error executing query']);
    }
} catch (PDOException $e) {
    error_log("Error adding pickup center: " . $e->getMessage());
    echo json_encode(["success" => false, 'message' => 'Error adding pickup center: ' . $e->getMessage()]);
}
?>

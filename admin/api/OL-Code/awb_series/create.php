<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Adjust this path if necessary

// Log the request

// Read JSON input
$inputData = json_decode(file_get_contents('php://input'), true);


error_log("AWB Series Creation request received");

// Declare variables and initialize
$branch_id = $product_id = $consignment_type_id = $start = $end = $status = $created_by = '';
$errors = [];

// Sanitize and validate functions
function sanitizeText($text) {
    return htmlspecialchars(trim($text));
}


// Validate and sanitize POST data
$requiredFields = ['branch_id', 'product_id', 'consignment_type_id', 'start', 'end'];
$timezone = 1;
$created_by = 1;
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
} else {
    $status = 'active'; // Default to 'active' if not provided
}

// Sanitize optional fields for user data
$created_by = isset($inputData['created_by']) ? sanitizeText($inputData['created_by']) : 1;

// If validation fails, return errors
if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}


$query = "SELECT * FROM awb_series_allocation 
          WHERE (start <= :new_end AND end >= :new_start)";

$stmt = $pdo->prepare($query);
$stmt->execute(['new_start' => $start, 'new_end' => $end]);

if ($stmt->rowCount() > 0) {
    $errors[] = "Series Between Number Already Allocated";
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
} 




// Prepare and execute the query to insert customer data
try {
    $stmt = $pdo->prepare("INSERT INTO awb_series_allocation 
        (`branch_id`, `product_id`, `consignment_type_id`, `start`, `end`, `created_at`, `created_by`, `status`) 
        VALUES 
        (:branch_id, :product_id, :consignment_type_id, :start, :end, NOW(), :created_by,:status)");

    // Bind parameters
    $stmt->bindParam(':branch_id', $branch_id);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->bindParam(':consignment_type_id', $consignment_type_id);
    $stmt->bindParam(':start', $start);
    $stmt->bindParam(':end', $end); 
    $stmt->bindParam(':created_by', $created_by);
    $stmt->bindParam(':status', $status); 

    // Log the query and bound parameters for debugging
    error_log("Executing query: " . $stmt->queryString);
    error_log("Bound parameters: branch_id=$branch_id, product_id=$product_id, consignment_type_id=$consignment_type_id, start=$start, end=$end, status=$status, created_by=$created_by, status=$status");

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "AWB Series created successfully"]);
    } else {
        error_log("Query execution failed: " . implode(", ", $stmt->errorInfo()));
        echo json_encode(["success" => false, 'message' => 'Error executing query']);
    }
} catch (PDOException $e) {
    error_log("Error adding customer: " . $e->getMessage());
    echo json_encode(["success" => false, 'message' => 'Error adding customer: ' . $e->getMessage()]);
}
?>

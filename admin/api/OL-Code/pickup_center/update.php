<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Adjust this path if necessary

// Log the request
error_log("Pickup Center Update request received");

// Read JSON input
$inputData = json_decode(file_get_contents('php://input'), true);

// Declare variables and initialize
$id = $name = $address = $city = $state = $pincode = $mobile_number = $status = $branch_id = $updated_by = '';
$errors = [];

// Sanitize and validate functions
function sanitizeText($text) {
    return htmlspecialchars(trim($text));
}

// Validate and sanitize POST data
$requiredFields = ['id', 'name', 'address', 'city', 'state', 'pincode', 'mobile_number', 'branch_id'];
$updated_by = 1; // Default updated_by if not provided
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
$updated_by = isset($inputData['updated_by']) ? sanitizeText($inputData['updated_by']) : 1;

// If validation fails, return errors
if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

// Prepare and execute the query to update pickup center data
try {
    $stmt = $pdo->prepare("UPDATE tbl_pickup_center SET 
        name = :name, 
        address = :address, 
        city = :city, 
        state = :state, 
        pincode = :pincode, 
        mobile_number = :mobile_number, 
        status = :status, 
        branch_id = :branch_id, 
        updated_by = :updated_by, 
        updated_at = NOW()
        WHERE id = :id");

    // Bind parameters
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':state', $state);
    $stmt->bindParam(':pincode', $pincode);
    $stmt->bindParam(':mobile_number', $mobile_number);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':branch_id', $branch_id);
    $stmt->bindParam(':updated_by', $updated_by);

    // Log the query and bound parameters for debugging
    error_log("Executing query: " . $stmt->queryString);
    error_log("Bound parameters: id=$id, name=$name, address=$address, city=$city, state=$state, pincode=$pincode, mobile_number=$mobile_number, status=$status, branch_id=$branch_id, updated_by=$updated_by");

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Pickup Center updated successfully"]);
    } else {
        error_log("Query execution failed: " . implode(", ", $stmt->errorInfo()));
        echo json_encode(["success" => false, 'message' => 'Error executing query']);
    }
} catch (PDOException $e) {
    error_log("Error updating pickup center: " . $e->getMessage());
    echo json_encode(["success" => false, 'message' => 'Error updating pickup center: ' . $e->getMessage()]);
}
?>

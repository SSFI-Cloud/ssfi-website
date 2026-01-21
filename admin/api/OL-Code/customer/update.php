<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Adjust this path if necessary

// Log the request
error_log("Customer update request received....");

// Read JSON input
$inputData = json_decode(file_get_contents('php://input'), true);

// Declare variables and initialize
$id = $name = $mobile = $pincode = $address1 = $address2 = $status = $updated_by = '';
$errors = [];

// Sanitize and validate functions
function sanitizeText($text) {
    return htmlspecialchars(trim($text));
}

function validatePhone($phone) {
    return preg_match('/^\+?[0-9]{10,15}$/', $phone); // Allowing optional "+" and 10-15 digits
}

// Validate and sanitize required fields
if (isset($inputData['id']) && !empty($inputData['id'])) {
    $id = sanitizeText($inputData['id']);
} else {
    $errors[] = "Field 'id' is required for updating a customer";
}

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
}

// Sanitize optional fields for user data
$updated_by = isset($inputData['updated_by']) ? sanitizeText($inputData['updated_by']) : null;

// Return validation errors if any
if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

// Prepare and execute the query to update customer data
try {
    $stmt = $pdo->prepare("UPDATE tbl_customer 
        SET 
            name = :name, 
            mobile = :mobile, 
            pincode = :pincode, 
            address1 = :address1, 
            address2 = :address2, 
            status = :status, 
            updated_at = NOW(), 
            updated_by = :updated_by 
        WHERE id = :id");

    // Bind parameters
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':mobile', $mobile);
    $stmt->bindParam(':pincode', $pincode);
    $stmt->bindParam(':address1', $address1);
    $stmt->bindParam(':address2', $address2);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':updated_by', $updated_by);

    // Execute the query
    if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
            echo json_encode(["success" => true, "message" => "Customer updated successfully"]);
        } else {
            echo json_encode(["success" => false, "message" => "No changes made or customer not found"]);
        }
    } else {
        error_log("Query execution failed: " . implode(", ", $stmt->errorInfo()));
        echo json_encode(["success" => false, 'message' => 'Error executing query']);
    }
} catch (PDOException $e) {
    error_log("Error updating customer: " . $e->getMessage());
    echo json_encode(["false" => true, 'message' => 'Error updating customer: ' . $e->getMessage()]);
}
?>

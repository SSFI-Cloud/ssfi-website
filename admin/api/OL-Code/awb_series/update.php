<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Adjust this path if necessary

// Log the request
error_log("Customer update request received....");

// Read JSON input
$inputData = json_decode(file_get_contents('php://input'), true);

// Declare variables and initialize
$branch_id = $product_id = $consignment_type_id = $start = $end = $status = $updated_by = '';
$errors = [];

// Sanitize and validate functions
function sanitizeText($text) {
    return htmlspecialchars(trim($text));
}

// Validate and sanitize required fields
$requiredFields = ['id','branch_id', 'product_id', 'consignment_type_id', 'start', 'end'];
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
}

// Sanitize optional fields for user data
$updated_by = isset($inputData['updated_by']) ? sanitizeText($inputData['updated_by']) : 1;
$re_allocate = isset($inputData['re_allocate']) ? sanitizeText($inputData['re_allocate']) : 0;

$query = "SELECT * FROM awb_series_allocation WHERE (start <= :new_end AND end >= :new_start)";
$stmt = $pdo->prepare($query);
$stmt->execute(['new_start' => $start, 'new_end' => $end]);

if ($stmt->rowCount() > 0) {
    $errors[] = "Series Between Number Already Allocated";
} 

// Return validation errors if any
if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

// Prepare and execute the query to update customer data
try {
    if($re_allocate != 1){
        
        $stmt = $pdo->prepare("UPDATE awb_series_allocation 
            SET 
                branch_id = :branch_id, 
                product_id = :product_id, 
                consignment_type_id = :consignment_type_id, 
                start = :start, 
                end = :end, 
                status = :status, 
                updated_at = NOW(), 
                updated_by = :updated_by 
            WHERE id = :id");
    
        // Bind parameters
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':branch_id', $branch_id);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':consignment_type_id', $consignment_type_id);
        $stmt->bindParam(':start', $start);
        $stmt->bindParam(':end', $end);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':updated_by', $updated_by);
    
        // Execute the query
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo json_encode(["success" => true, "message" => "AWB Series updated successfully"]);
            } else {
                echo json_encode(["success" => false, "message" => "No changes made or awb series not found"]);
            }
        } else {
            error_log("Query execution failed: " . implode(", ", $stmt->errorInfo()));
            echo json_encode(["success" => false, 'message' => 'Error executing query']);
        }
    }else{
        
        $stmt = $pdo->prepare("UPDATE awb_series_allocation 
            SET 
                end = :end, 
                updated_at = NOW(), 
                updated_by = :updated_by 
            WHERE id = :id");
    
        // Bind parameters
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':end', $end);
        $stmt->bindParam(':updated_by', $updated_by);
    
        // Execute the query
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo json_encode(["success" => true, "message" => "AWB Reallocate updated successfully"]);
            } else {
                echo json_encode(["success" => false, "message" => "No changes made or awb reallocate not found"]);
            }
        } else {
            error_log("Query execution failed: " . implode(", ", $stmt->errorInfo()));
            echo json_encode(["success" => false, 'message' => 'Error executing query']);
        }
        
    }
    
} catch (PDOException $e) {
    error_log("Error updating awb series: " . $e->getMessage());
    echo json_encode(["false" => true, 'message' => 'Error updating awb series: ' . $e->getMessage()]);
}
?>

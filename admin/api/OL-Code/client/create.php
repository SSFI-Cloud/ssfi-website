<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Adjust this path if necessary

// Log the request
error_log("Client creation request received");
error_log(json_encode($_POST));

// Declare all variables at the top
$id = $name = $name_prefix = $prefix = $client_code = $address = $telephone = $postal_code = $email = $mobile1 = $mobile2 = $branch_id = $group_id = $employee_id = $remarks = $pan = $gst = $discount_percentage = $constitution_of_business = $receipt_bank_id = $tax_mode = $contract_period_start = $contract_period_end = $client_type = $status = $created_by = $updated_by = '';
$errors = [];
$group_id=0;
$employee_id=1;
$employee_id=1;
$_POST['updated_by'] = 1;
$created_by=1;
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
$requiredFields = ['name', 'client_code', 'email', 'status'];

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

if (!empty($mobile1) && !validatePhone($mobile1)) {
    $errors[] = "Invalid primary phone number format";
}

if (!empty($mobile2) && !validatePhone($mobile2)) {
    $errors[] = "Invalid secondary phone number format";
}

// If validation fails, return errors
if (!empty($errors)) {
    echo json_encode(['error' => $errors]);
    exit;
}

$pan = isset($_POST['pan']) ? sanitizeText($_POST['pan']) : null;
$branch_id = isset($_POST['branch']) ? sanitizeText($_POST['branch']) : null;

// Prepare and execute the query to insert client data
try {
    $stmt = $pdo->prepare("INSERT INTO tbl_client 
        (name, name_prefix, prefix, client_code, address, telephone, postal_code, email, mobile1, mobile2, branch_id, group_id, employee_id, remarks, pan, gst, discount_percentage, constitution_of_business, receipt_bank_id, tax_mode, contract_period_start, contract_period_end, client_type, status, created_by, created_at, updated_by, updated_at) 
        VALUES 
        (:name, :name_prefix, :prefix, :client_code, :address, :telephone, :postal_code, :email, :mobile1, :mobile2, :branch_id, :group_id, :employee_id, :remarks, :pan, :gst, :discount_percentage, :constitution_of_business, :receipt_bank_id, :tax_mode, :contract_period_start, :contract_period_end, :client_type, :status, :created_by, NOW(), :updated_by, NOW())");

    // Bind parameters after ensuring all POST values are sanitized
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':name_prefix', sanitizeText($_POST['name_prefix']));
    $stmt->bindParam(':prefix', sanitizeText($_POST['prefix']));
    $stmt->bindParam(':client_code', $client_code);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':telephone', sanitizeText($_POST['telephone']));
    $stmt->bindParam(':postal_code', sanitizeText($_POST['postal_code']));
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mobile1', $mobile1);
    $stmt->bindParam(':mobile2', sanitizeText($_POST['mobile2']));
    $stmt->bindParam(':branch_id', $branch_id);
    $stmt->bindParam(':group_id', $group_id);
    $stmt->bindParam(':employee_id', $employee_id);
    $stmt->bindParam(':remarks', sanitizeText($_POST['remarks']));
    $stmt->bindParam(':pan', sanitizeText($pan));
    $stmt->bindParam(':gst', sanitizeText($_POST['gst']));
    $stmt->bindParam(':discount_percentage', sanitizeText($_POST['discount_percentage']));
    $stmt->bindParam(':constitution_of_business', sanitizeText($_POST['constitution_of_business']));
    $stmt->bindParam(':receipt_bank_id', sanitizeText($_POST['receipt_bank_id']));
    $stmt->bindParam(':tax_mode', sanitizeText($_POST['tax_mode']));
    $stmt->bindParam(':contract_period_start', sanitizeText($_POST['contract_period_start']));
    $stmt->bindParam(':contract_period_end', sanitizeText($_POST['contract_period_end']));
    $stmt->bindParam(':client_type', sanitizeText($_POST['client_type']));
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':created_by', $created_by);
    $stmt->bindParam(':updated_by', sanitizeText($_POST['updated_by']));

    if ($stmt->execute()) {
        echo json_encode(["status" => 'success', "message" => "Client created successfully"]);
    } else {
        error_log("Query execution failed: " . implode(", ", $stmt->errorInfo()));
        echo json_encode(["status" => 'error' , 'message' => 'Error executing query']);
    }
} catch (PDOException $e) {
    error_log("Error adding client: " . $e->getMessage());
     echo json_encode(["status" => 'error' ,'message' => 'Error adding Client: ' . $e->getMessage()]);
}
?>

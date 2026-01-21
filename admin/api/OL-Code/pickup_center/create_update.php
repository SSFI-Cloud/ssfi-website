<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Adjust the path if necessary

// Sanitize and validate functions
function sanitizeText($text) {
    return htmlspecialchars(trim($text));
}

function validateEnum($value, $allowedValues) {
    return in_array($value, $allowedValues, true);
}

// Common error handler
function respondWithError($errors) {
    echo json_encode(["error" => $errors]);
    exit;
}

// Prepare response structure
$response = [];

// Determine API operation
$action = $_GET['action'] ?? null;
if (!in_array($action, ['create', 'update'])) {
    respondWithError(["Invalid action. Use 'create' or 'update'."]);
}

// Declare all variables
$id = $name = $city = $state = $pincode = $mobile = $branch_id = $created_by = $updated_by = $status = null;
$address = $created_at = $updated_at = null;
$errors = [];

// Required fields
$requiredFields = ['name', 'city', 'state', 'pincode', 'mobile', 'branch_id', 'created_by'];
$optionalFields = ['address', 'status', 'updated_by'];
$allowedStatusValues = ['active', 'inactive'];

// Sanitize and validate POST data
foreach ($requiredFields as $field) {
    if (isset($_POST[$field]) && !empty($_POST[$field])) {
        $$field = sanitizeText($_POST[$field]);
    } else {
        $errors[] = "Field '$field' is required";
    }
}

foreach ($optionalFields as $field) {
    if (isset($_POST[$field])) {
        $$field = sanitizeText($_POST[$field]);
    }
}

// Validate status if provided
if ($status && !validateEnum($status, $allowedStatusValues)) {
    $errors[] = "Invalid value for 'status'. Allowed values are 'active' or 'inactive'.";
}

// If validation fails, return errors
if (!empty($errors)) {
    respondWithError($errors);
}

// Prepare SQL query based on action
if ($action === 'create') {
    $sql = "INSERT INTO tbl_pickup_center (name, address, city, state, pincode, mobile_number, status, branch_id, created_by, created_at)
            VALUES (:name, :address, :city, :state, :pincode, :mobile, :status, :branch_id, :created_by, NOW())";
    $params = [
        'name' => $name,
        'address' => $address,
        'city' => $city,
        'state' => $state,
        'pincode' => $pincode,
        'mobile' => $mobile,
        'status' => $status ?? 'active',
        'branch_id' => $branch_id,
        'created_by' => $created_by
    ];
} elseif ($action === 'update') {
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        respondWithError(["Field 'id' is required for update."]);
    }
    $id = sanitizeText($_POST['id']);

    $sql = "UPDATE tbl_pickup_center SET
                name = :name,
                address = :address,
                city = :city,
                state = :state,
                pincode = :pincode,
                mobile_number = :mobile,
                status = :status,
                branch_id = :branch_id,
                updated_by = :updated_by,
                updated_at = NOW()
            WHERE id = :id";

    $params = [
        'id' => $id,
        'name' => $name,
        'address' => $address,
        'city' => $city,
        'state' => $state,
        'pincode' => $pincode,
        'mobile' => $mobile,
        'status' => $status,
        'branch_id' => $branch_id,
        'updated_by' => $updated_by
    ];
}

// Execute query
try {
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute($params)) {
        if ($action === 'create') {
            $response["message"] = "Pickup center created successfully";
            $response["id"] = $pdo->lastInsertId();
        } elseif ($action === 'update') {
            $response["message"] = $stmt->rowCount() > 0 ? "Pickup center updated successfully" : "No changes made or record not found";
        }
    } else {
        error_log("Query execution failed: " . implode(", ", $stmt->errorInfo()));
        respondWithError(["Error executing query"]);
    }
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    respondWithError(["Database error: " . $e->getMessage()]);
}

// Send success response
echo json_encode($response);
?>

<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Adjust this path if necessary

// Log the request
error_log("Employee creation request received");
error_log(json_encode($_POST));

// Declare all variables at the top
$employee_id = $name = $age = $designation_id = $role_id  = $department_id = $address = $salary = $doj = $doe = $role= $email= $password= $status  = '';
$errors = [];

$branch_id=$created_by=1;

// Sanitize and validate functions
function sanitizeText($text) {
    return htmlspecialchars(trim($text));
}

function validateDate($date) {
    return (bool)strtotime($date);
}

function validateNumber($number) {
    return is_numeric($number) ? $number : false;
}

// Validate and sanitize POST data
$requiredFields = [ 'name', 'age', 'designation_id', 'role_id', 'department_id', 'address', 'salary', 'doj', 'role','email','password', 'status'];
foreach ($requiredFields as $field) {
    if (isset($_POST[$field]) && !empty($_POST[$field])) {
        $$field = sanitizeText($_POST[$field]); // Sanitize input
    } else {
        $errors[] = "Field '$field' is required";
    }
}

// Additional validation
if (!validateNumber($age)) {
    $errors[] = "Invalid age format";
}

if (!validateNumber($salary)) {
    $errors[] = "Invalid salary format";
}

if (!validateDate($doj)) {
    $errors[] = "Invalid date of joining format";
}

if (!empty($doe) && !validateDate($doe)) {
    $errors[] = "Invalid date of exit format";
}

// If validation fails, return errors
if (!empty($errors)) {
    echo json_encode(['status' => 'error', 'message' => $errors]);
    exit;
}

// Prepare and execute the query to insert employee data
try {
    $stmt = $pdo->prepare("INSERT INTO tbl_employee 
        (employee_id, name, age, designation_id, role_id, branch_id, department_id, address, salary, doj, doe,role,email,password, status, created_by, created_at) 
        VALUES 
        (:employee_id, :name, :age, :designation_id, :role_id, :branch_id, :department_id, :address, :salary, :doj, :doe,:role,:email,:password, :status, :created_by, NOW())");

    // Bind parameters after ensuring all POST values are sanitized
    $stmt->bindParam(':employee_id', $employee_id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':designation_id', $designation_id);
    $stmt->bindParam(':role_id', $role_id);
    $stmt->bindParam(':branch_id', $branch_id);
    $stmt->bindParam(':department_id', $department_id);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':salary', $salary);
    $stmt->bindParam(':doj', $doj);
    $stmt->bindParam(':doe', $doe);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':created_by', $created_by);

    if ($stmt->execute()) {
        echo json_encode(["status" => 'success', "message" => "Employee created successfully"]);
    } else {
        error_log("Query execution failed: " . implode(", ", $stmt->errorInfo()));
        echo json_encode(["status" => 'error', 'message' => 'Error executing query']);
    }
} catch (PDOException $e) {
    error_log("Error adding employee: " . $e->getMessage());
    echo json_encode(["status" => 'error', 'message' => 'Error adding employee: ' . $e->getMessage()]);
}
?>
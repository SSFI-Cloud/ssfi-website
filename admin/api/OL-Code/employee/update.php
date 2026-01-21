<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Adjust this path if necessary

// Log the request
error_log("Employee update request received");
error_log(json_encode($_POST));

// Declare all variables at the top
$id = $employee_id = $name = $age = $designation_id = $role_id = $branch_id = $department_id = $address = $salary = $doj = $doe = $role= $email= $password= $status = $updated_by = '';
$errors = [];
$updated_by=$branch_id=1;
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
$requiredFields = ['id', 'employee_id', 'name', 'age', 'designation_id', 'role_id', 'department_id', 'address', 'salary', 'doj','role','email','password', 'status'];
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

// Prepare and execute the query to update employee data
try {
    $stmt = $pdo->prepare("UPDATE tbl_employee SET 
        employee_id = :employee_id, 
        name = :name, 
        age = :age, 
        designation_id = :designation_id, 
        role_id = :role_id, 
        branch_id = :branch_id, 
        department_id = :department_id, 
        address = :address, 
        salary = :salary, 
        doj = :doj, 
        doe = :doe, 
        role=:role,
        email=:email,
        password=:password,
        status = :status, 
        updated_by = :updated_by, 
        updated_at = NOW()
        WHERE id = :id");

    // Bind parameters after ensuring all POST values are sanitized
    $stmt->bindParam(':id', $id);
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
    $stmt->bindParam(':updated_by', $updated_by);

    if ($stmt->execute()) {
        echo json_encode(["status" => 'success', "message" => "Employee updated successfully"]);
    } else {
        error_log("Query execution failed: " . implode(", ", $stmt->errorInfo()));
        echo json_encode(["status" => 'error', 'message' => 'Error executing query']);
    }
} catch (PDOException $e) {
    error_log("Error updating employee: " . $e->getMessage());
    echo json_encode(["status" => 'error', 'message' => 'Error updating employee: ' . $e->getMessage()]);
}
?>

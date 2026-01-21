<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$role_id = $_SESSION['role_id'] ?? 0; // Default role_id is 1 (Admin)
$session_state_id=$_SESSION['state_id'] ?? 0;
$session_district_id=$_SESSION['district_id'] ?? 0;
$session_all=$_SESSION['ssfi'] ?? 0;



function get_permission($permission, $can)
{
    global $role_id; // Ensure access to global $role_id

    if ($role_id === 1) {
        return true; // Admin has all permissions
    }
    
    $permissions = get_staff_permissions();

    foreach ($permissions as $permObject) {
        if ($permObject['permission_prefix'] === $permission) {
            return !empty($can) && isset($permObject[$can]) && $permObject[$can] == '1';
        }
    }
    
    return false;
}

function get_staff_permissions()
{
    global $pdo, $role_id; // Access global variables

    try {
        $sql = "SELECT sp.*, p.id AS permission_id, p.prefix AS permission_prefix 
                FROM staff_privileges sp
                JOIN permission p ON p.id = sp.permission_id 
                WHERE sp.role_id = ?";
    
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$role_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: []; // Return empty array if no permissions found
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return []; // Return empty array on error
    }
}

function access_denied()
{
    global $site_url; 

    $redirect_url = 'index.php';
    echo "<script>alert('Access Denied'); window.location.href='$redirect_url';</script>";
    exit();
}

function ajax_access_denied()
{
    echo json_encode(['status' => 'access_denied']);
    exit();
}

?>

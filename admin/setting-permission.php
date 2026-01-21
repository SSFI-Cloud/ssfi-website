<?php
require_once 'header.php';
require_once 'config/config.php'; // Ensure database connection is included
ini_set('display_errors',1);
// Function to get roles
function getRoleList() {
    global $pdo;
    
    if (!$pdo) {
        error_log("Database connection is missing.");
        return []; // Return an empty array to prevent further errors
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM roles WHERE id NOT IN (1,6,7)");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error fetching roles: " . $e->getMessage());
    }
}

// Function to get modules
function getModulesList() {
    global $pdo;
    
    if (!$pdo) {
        error_log("Database connection is missing.");
        return []; // Return an empty array to prevent further errors
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM permission_modules ORDER BY sorted ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error fetching modules: " . $e->getMessage());
    }
}

// Saving permissions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    if (!$pdo) {
        die("Database connection is missing.");
    }

    try {
        $role_id = intval($_POST['role_id']);
        $privileges = $_POST['privileges'] ?? [];
// print_r($_POST); die;
        // Fetch existing privileges for comparison
        $stmt = $pdo->prepare("SELECT permission_id FROM staff_privileges WHERE role_id = ?");
        $stmt->execute([$role_id]);
        $existing_permissions = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'permission_id');

        foreach ($privileges as $permission_id => $value) {
            $permission_id = intval($permission_id);
            
            $is_add = isset($value['add']) && !empty($value['add']) ? 1 : 0;
            $is_edit = isset($value['edit']) && !empty($value['edit']) ? 1 : 0;
            $is_view = isset($value['view']) && !empty($value['view']) ? 1 : 0;
            $is_delete = isset($value['delete']) && !empty($value['delete']) ? 1 : 0;

            if (in_array($permission_id, $existing_permissions)) {
                // Update existing record
                $update_query = "UPDATE staff_privileges 
                                 SET is_add = ?, is_edit = ?, is_view = ?, is_delete = ? 
                                 WHERE role_id = ? AND permission_id = ?";
                $stmt = $pdo->prepare($update_query);
                $stmt->execute([$is_add, $is_edit, $is_view, $is_delete, $role_id, $permission_id]);
            } else {
                // Insert new record
                $insert_query = "INSERT INTO staff_privileges 
                                 (role_id, permission_id, is_add, is_edit, is_view, is_delete) 
                                 VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($insert_query);
                $stmt->execute([$role_id, $permission_id, $is_add, $is_edit, $is_view, $is_delete]);
            }
        }

        echo "<script>alert('Information updated successfully'); window.location.href='setting-permission.php?id=$role_id';</script>";
    } catch (PDOException $e) {
        die("Error updating permissions: " . $e->getMessage());
    }
}

$role_id = intval($_GET['id'] ?? 210);
$modules = getModulesList();
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <section class="panel">
        <div class="panel-heading">
            <h4 class="panel-title"><i class="fab fa-buromobelexperte"></i> Role Permission for: <?php echo htmlspecialchars($role_id); ?></h4>
        </div>
        <form action="" method="post">
            <input type="hidden" name="role_id" value="<?php echo $role_id; ?>">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-condensed mt-sm">
                        <thead>
                            <tr>
                                <th>Feature</th>
                                <th><input type="checkbox" id="all_view"> View</th>
                                <th><input type="checkbox" id="all_add"> Add</th>
                                <th><input type="checkbox" id="all_edit"> Edit</th>
                                <th><input type="checkbox" id="all_delete"> Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($modules as $module): ?>
                                <tr>
                                    <th colspan="5" style="text-align: center; font-weight: bold;">
                                        <?php echo htmlspecialchars($module['name']); ?>
                                    </th>

                                </tr>
                                <?php
                                if (!$pdo) {
                                    error_log("Database connection is missing.");
                                    continue;
                                }

                                $stmt = $pdo->prepare("SELECT p.*, 
                                        COALESCE(sp.is_add, 0) AS is_add, 
                                        COALESCE(sp.is_edit, 0) AS is_edit, 
                                        COALESCE(sp.is_view, 0) AS is_view, 
                                        COALESCE(sp.is_delete, 0) AS is_delete
                                     FROM permission p
                                     LEFT JOIN staff_privileges sp 
                                     ON p.id = sp.permission_id AND sp.role_id = ?
                                     WHERE p.module_id = ?");
                                $stmt->execute([$role_id, $module['id']]);

                                while ($permission = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($permission['name']); ?></td>
                                        <td>  
                                            <input type="hidden" name="privileges[<?php echo $permission['id']; ?>][view]" value="0">
                                            <input type="checkbox" class="view" name="privileges[<?php echo $permission['id']; ?>][view]" value="1" <?php echo ($permission['is_view'] ? 'checked' : ''); ?>>
                                        </td>
                                        <td>
                                            <input type="hidden" name="privileges[<?php echo $permission['id']; ?>][add]" value="0">
                                            <input type="checkbox" class="add" name="privileges[<?php echo $permission['id']; ?>][add]" value="1" <?php echo ($permission['is_add'] ? 'checked' : ''); ?>>
                                        </td>
                                        <td>
                                            <input type="hidden" name="privileges[<?php echo $permission['id']; ?>][edit]" value="0">
                                            <input type="checkbox" class="edit" name="privileges[<?php echo $permission['id']; ?>][edit]" value="1" <?php echo ($permission['is_edit'] ? 'checked' : ''); ?>>
                                        </td>
                                        <td>
                                            <input type="hidden" name="privileges[<?php echo $permission['id']; ?>][delete]" value="0">
                                            <input type="checkbox" class="delete" name="privileges[<?php echo $permission['id']; ?>][delete]" value="1" <?php echo ($permission['is_delete'] ? 'checked' : ''); ?>>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div> 
            <footer class="panel-footer mt-5 text-center">
                <button type="submit" name="save" class="btn btn-primary">Update</button>
            </footer>
        </form>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function toggleColumn(className, checkboxId) {
        document.getElementById(checkboxId).addEventListener('change', function() {
            document.querySelectorAll('.' + className).forEach(cb => cb.checked = this.checked);
        });
    }
    toggleColumn('view', 'all_view');
    toggleColumn('add', 'all_add');
    toggleColumn('edit', 'all_edit');
    toggleColumn('delete', 'all_delete');
});
</script>

<?php require_once 'footer.php'; ?>

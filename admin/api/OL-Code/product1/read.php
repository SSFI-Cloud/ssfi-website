<?php
// Include the database connection file
require_once '../../config/config.php';

try {
    // Get query parameters from DataTables
    $isExport = isset($_GET['isExport']) && $_GET['isExport'] === 'true';
    $limit = isset($_GET['length']) ? (int)$_GET['length'] : 10;
    $offset = isset($_GET['start']) ? (int)$_GET['start'] : 0;
    $orderColumnIndex = isset($_GET['order'][0]['column']) ? (int)$_GET['order'][0]['column'] : 0;
    $orderDir = isset($_GET['order'][0]['dir']) && in_array(strtolower($_GET['order'][0]['dir']), ['asc', 'desc'])
                ? $_GET['order'][0]['dir'] 
                : 'asc';
    $searchValue = isset($_GET['search']['value']) ? trim($_GET['search']['value']) : '';

    // Map column indices to actual database columns
    $columns = ['id', 'name', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'];
    $orderBy = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'id';

    // Build SQL query
    $whereClause = '';
    $bindings = [];

    if (!empty($searchValue)) {
        $whereClause = "WHERE name LIKE :search OR id LIKE :search";
        $bindings[':search'] = "%$searchValue%";
    }

    $sqlData = "SELECT id, name, status, created_by, updated_by, created_at, updated_at FROM tbl_products $whereClause ORDER BY $orderBy $orderDir";

    if (!$isExport) {
        $sqlData .= " LIMIT :limit OFFSET :offset";
        $bindings[':limit'] = $limit;
        $bindings[':offset'] = $offset;
    }

    // Execute query
    $stmt = $pdo->prepare($sqlData);
    foreach ($bindings as $key => $value) {
        $stmt->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
    }
    
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Get total record count
    $sqlTotal = "SELECT COUNT(*) as total FROM tbl_products";
    $totalRecords = $pdo->query($sqlTotal)->fetchColumn();

    // Get total filtered record count
    $sqlFiltered = "SELECT COUNT(*) as total FROM tbl_products $whereClause";
    $stmtFiltered = $pdo->prepare($sqlFiltered);
    foreach ($bindings as $key => $value) {
        if ($key !== ':limit' && $key !== ':offset') {
            $stmtFiltered->bindValue($key, $value, PDO::PARAM_STR);
        }
    }
    $stmtFiltered->execute();
    $totalFilteredRecords = $stmtFiltered->fetchColumn();

    // Prepare response
    if ($isExport) {
        echo json_encode(["data" => $data, "export" => true]);
    } else {
        echo json_encode([
            "draw" => isset($_GET['draw']) ? (int)$_GET['draw'] : 0,
            "recordsTotal" => (int)$totalRecords,
            "recordsFiltered" => (int)$totalFilteredRecords,
            "data" => $data
        ]);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
    error_log("Database error: " . $e->getMessage());
    exit;
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => "An unexpected error occurred: " . $e->getMessage()]);
    error_log("Error: " . $e->getMessage());
    exit;
}
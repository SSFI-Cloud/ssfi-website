<?php
// Include the database connection file
require_once '../../config/config.php';

try {
    // Get the query parameters sent by DataTables
    $isExport = isset($_GET['isExport']) && $_GET['isExport'] === 'true'; // Check if export is requested
    $limit = isset($_GET['length']) ? (int)$_GET['length'] : 10;   // Number of records per page
    $offset = isset($_GET['start']) ? (int)$_GET['start'] : 0;     // The starting point for the query (page)
    $orderColumnIndex = isset($_GET['order'][0]['column']) ? (int)$_GET['order'][0]['column'] : 0; // Column index for ordering
    $orderDir = isset($_GET['order'][0]['dir']) && in_array(strtolower($_GET['order'][0]['dir']), ['asc', 'desc']) 
                ? $_GET['order'][0]['dir'] 
                : 'asc'; // Validate order direction
    $searchValue = isset($_GET['search']['value']) ? trim($_GET['search']['value']) : ''; // Search term





//  `branch_code`, `branch_name`, `prefix`, `logo`, `invoice_logo`, `address`, 
//  `city`, `state`, `country`, `postal_code`, `gst`, `mobile_number1`, `mobile_number2`, `email`, `alternate_email`, `timezone`, `remarks`, `status`,
    // Map column indices to actual database columns
    // $columns = [`id`, `name`, `name_prefix`, `prefix`, `client_code`, `address`, `telephone`, `postal_code`, `email`, `mobile1`, `mobile2`, `branch_id`,`group_id`, `employee_id`, `remarks`, `pan`, `gst`, `discount_percentage`, `constitution_of_business`, `receipt_bank_id`,`tax_mode`, `contract_period_start`, `contract_period_end`, `client_type`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by];

$columns = ['id', 'name', 'name_prefix', 'prefix', 'client_code', 'address', 'telephone', 'postal_code', 'email', 'mobile1', 'mobile2', 'branch_id', 'group_id', 'employee_id', 'remarks', 'pan', 'gst', 'discount_percentage', 'constitution_of_business', 'receipt_bank_id', 'tax_mode', 'contract_period_start', 'contract_period_end', 'client_type', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'];





    $orderBy = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'id'; // Fallback to 'id'

    // Base SQL query for fetching data
    $whereClause = '';
    $bindings = [];

    if (!empty($searchValue)) {
        $whereClause = "WHERE branch_code LIKE :search OR branch_name LIKE :search OR mobile_number1 LIKE :search";
        $bindings[':search'] = "%$searchValue%";
    }

    // Fetch data query
    $sqlData = "SELECT * FROM tbl_branch  $whereClause ORDER BY $orderBy $orderDir";

    // Apply pagination for non-export requests
    if (!$isExport) {
        $sqlData .= " LIMIT :limit OFFSET :offset";
        $bindings[':limit'] = $limit;
        $bindings[':offset'] = $offset;
    }

    // Prepare and execute the query
    $stmt = $pdo->prepare($sqlData);

    foreach ($bindings as $key => $value) {
        $stmt->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
    }

    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Total records count (without filtering)
    $sqlTotal = "SELECT COUNT(*) as total FROM tbl_branch";
    $totalRecords = $pdo->query($sqlTotal)->fetchColumn();

    // Total filtered records count (with filtering)
    $sqlFiltered = "SELECT COUNT(*) as total FROM tbl_branch $whereClause";
    $stmtFiltered = $pdo->prepare($sqlFiltered);

    foreach ($bindings as $key => $value) {
        if ($key !== ':limit' && $key !== ':offset') { // Skip limit and offset for filtered count
            $stmtFiltered->bindValue($key, $value, PDO::PARAM_STR);
        }
    }

    $stmtFiltered->execute();
    $totalFilteredRecords = $stmtFiltered->fetchColumn();

    // Prepare response for DataTables and export mode
    if ($isExport) {
        // Return all data for export, ignoring pagination
        echo json_encode([
            "data" => $data,
            "export" => true // Optional flag to indicate export mode
        ]);
    } else {
        // Paginated response for DataTables
        echo json_encode([
            "draw" => isset($_GET['draw']) ? (int)$_GET['draw'] : 0,
            "recordsTotal" => (int)$totalRecords,
            "recordsFiltered" => (int)$totalFilteredRecords,
            "data" => $data
        ]);
    }
} catch (PDOException $e) {
    // Handle database errors
    http_response_code(500);
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
    error_log("Database error: " . $e->getMessage());
    exit;
} catch (Exception $e) {
    // Handle general errors
    http_response_code(500);
    echo json_encode(["error" => "An unexpected error occurred: " . $e->getMessage()]);
    error_log("Error: " . $e->getMessage());
    exit;
}

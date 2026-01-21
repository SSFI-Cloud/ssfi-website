<?php
// Include the database connection file
require_once '../../config/config.php';

try {
    if (!isset($pdo)) {
        throw new Exception("Database connection is missing.");
    }

    // Get the query parameters sent by DataTables
    $isExport = isset($_GET['isExport']) && $_GET['isExport'] === 'true'; // Check if export is requested
    $limit = isset($_GET['length']) ? (int)$_GET['length'] : 10;   // Number of records per page
    $offset = isset($_GET['start']) ? (int)$_GET['start'] : 0;     // The starting point for the query (page)
    $orderColumnIndex = isset($_GET['order'][0]['column']) ? (int)$_GET['order'][0]['column'] : 0; // Column index for ordering
    $orderDir = isset($_GET['order'][0]['dir']) && in_array(strtolower($_GET['order'][0]['dir']), ['asc', 'desc']) 
                ? $_GET['order'][0]['dir'] 
                : 'asc'; // Validate order direction
    $searchValue = isset($_GET['search']['value']) ? trim($_GET['search']['value']) : ''; // Search term

    // Define column mapping
    $columns = [
        'branch_id', 'product_id', 'pickup_center_id', 'cn_no', 'ref_no', 'booking_date', 'consignor_id', 
        'consignor_name', 'consignor_address1', 'consignor_address2', 'consignor_mobile', 'consignor_gst', 
        'consignee_id', 'consignee_name', 'consignee_address1', 'consignee_address2', 'consignee_mobile', 
        'consignee_gst', 'consignee_email', 'destination', 'destination_content', 'declared_value', 'postal_code', 
        'payment_mode', 'payment_mode_details', 'is_volumetric_weight', 'consignment_type', 'mode_type', 'no_of_pieces', 
        'weight', 'gst_percentage', 'gst_amount', 'cross_amount', 'total_amount', 'is_pod', 'status', 'created_at', 
        'updated_at', 'created_by', 'updated_by', 'branch_name', 'products_name', 'pickup_center'
    ];

    $orderBy = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'cn_no'; // Default order by cn_no

    // Base SQL query for fetching data
    $whereClause = '';
    $bindings = [];

    if (!empty($searchValue)) {
        $whereClause = "WHERE cn_no LIKE :search OR consignor_name LIKE :search OR consignee_name LIKE :search";
        $bindings[':search'] = "%$searchValue%";
    }

    // Fetch data query
    $sqlData = "SELECT bk.*, bh.branch_name, pc.name AS pickup_center, p.name AS products_name 
                FROM tbl_booking bk 
                LEFT JOIN tbl_branch bh ON bh.id = bk.branch_id
                LEFT JOIN tbl_pickup_center pc ON pc.id = bk.pickup_center_id
                LEFT JOIN tbl_products p ON p.id = bk.product_id 
                $whereClause 
                ORDER BY $orderBy $orderDir";

    // Apply pagination for non-export requests
    if (!$isExport) {
        $sqlData .= " LIMIT $limit OFFSET $offset";
    }

    // Prepare and execute the query
    $stmt = $pdo->prepare($sqlData);

    foreach ($bindings as $key => $value) {
        $stmt->bindValue($key, $value, PDO::PARAM_STR);
    }

    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Total records count (without filtering)
    $sqlTotal = "SELECT COUNT(*) as total FROM tbl_booking";
    $totalRecords = $pdo->query($sqlTotal)->fetchColumn();

    // Total filtered records count (with filtering)
    $sqlFiltered = "SELECT COUNT(*) as total FROM tbl_booking $whereClause";
    $stmtFiltered = $pdo->prepare($sqlFiltered);

    foreach ($bindings as $key => $value) {
        $stmtFiltered->bindValue($key, $value, PDO::PARAM_STR);
    }

    $stmtFiltered->execute();
    $totalFilteredRecords = $stmtFiltered->fetchColumn();

    // Prepare response for DataTables and export mode
    $response = [
        "draw" => isset($_GET['draw']) ? (int)$_GET['draw'] : 0,
        "recordsTotal" => (int)$totalRecords,
        "recordsFiltered" => (int)$totalFilteredRecords,
        "data" => $data
    ];

    if ($isExport) {
        $response["export"] = true; // Optional flag to indicate export mode
    }

    echo json_encode($response);
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

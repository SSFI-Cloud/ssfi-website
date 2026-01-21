<?php
// Include the database connection file
require_once '../../config/config.php';
ini_set('display_errors',1);
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

    // Map column indices to actual database columns
    $columns = [
        'id',                     // Unique identifier for the consignment
        'branch_id',              // Branch ID
        'product_id',             // Product ID
        'pickup_center_id',       // Pickup center ID (for pickup center information)
        'cn_no',                  // Consignment Number (CN No)
        'ref_no',                 // Reference Number (Ref No)
        'booking_date',           // Booking Date
        'consignor_id',           // Consignor ID
        'consignor_name',         // Consignor Name
        'consignor_address1',     // Consignor Address Line 1
        'consignor_address2',     // Consignor Address Line 2
        'consignor_mobile',       // Consignor Mobile Number
        'consignor_gst',          // Consignor GST Number
        'consignee_id',           // Consignee ID
        'consignee_name',         // Consignee Name
        'consignee_address1',     // Consignee Address Line 1
        'consignee_address2',     // Consignee Address Line 2
        'consignee_mobile',       // Consignee Mobile Number
        'consignee_gst',          // Consignee GST Number
        'consignee_email',        // Consignee Email
        'destination',            // Destination
        'destination_content',    // Destination Content
        'declared_value',         // Declared Value
        'postal_code',            // Postal Code
        'client',                 // Client Information
        'state',                  // State
        'payment_mode',           // Payment Mode
        'payment_mode_details',   // Payment Mode Details
        'is_volumetric_weight',   // Whether it's volumetric weight
        'consignment_type',       // Consignment Type
        'mode_type',              // Mode of Transport (Air/Sea/Truck, etc.)
        'no_of_pieces',           // Number of Pieces
        'weight',                 // Weight
        'gst_percentage',         // GST Percentage
        'gst_amount',             // GST Amount
        'cross_amount',           // Cross Amount (perhaps total amount pre-GST)
        'total_amount',           // Total Amount (including GST)
        'is_pod',                 // Proof of Delivery (POD)
        'status',                 // Status (e.g., delivered, in transit, etc.)
        'created_at',             // Timestamp when the record was created
        'updated_at',             // Timestamp when the record was last updated
        'created_by',             // Who created the record
        'updated_by',             // Who last updated the record
    ];


    $orderBy = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'id'; // Fallback to 'id'

    // Base SQL query for fetching data
    $whereClause = '';
    $bindings = [];

    if (!empty($searchValue)) {
        $whereClause = "WHERE name LIKE :search OR mobile LIKE :search OR id LIKE :search";
        $bindings[':search'] = "%$searchValue%";
    }

    // Fetch data query
    $sqlData = "SELECT b.*,br.branch_name,p.name AS 'product_name',
                pi.name AS 'pickup_center_name'
                FROM tbl_booking AS b
                LEFT JOIN tbl_branch AS br ON b.branch_id = br.id
                LEFT JOIN tbl_products AS p ON b.product_id = p.id
                LEFT JOIN tbl_pickup_center AS pi ON b.pickup_center_id = pi.id  $whereClause ORDER BY $orderBy $orderDir";

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
    $sqlTotal = "SELECT COUNT(*) as total FROM tbl_booking";
    $totalRecords = $pdo->query($sqlTotal)->fetchColumn();

    // Total filtered records count (with filtering)
    $sqlFiltered = "SELECT COUNT(*) as total FROM tbl_booking $whereClause";
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

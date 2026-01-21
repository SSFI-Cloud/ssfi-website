<?php
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
    
    // Session/user variables (should be set from session)
    $role_id = $_SESSION['role_id'] ?? null;
    $session_state_id = $_SESSION['state_id'] ?? null;
    $session_district_id = $_SESSION['district_id'] ?? null;
    $session_club_id = $_SESSION['club_id'] ?? null;
    

    // Map column indices to actual database columns
    // 'id', 'event_level_type_id', 'state_id', 'district_id', 'event_name', 'event_image', 'event_date', 'reg_start_date', 'reg_end_date', 'event_description', 'event_fees', 'event_remarks', 'status', 'title_of_championship', 'association_name', 'reg_no', 'date', 'venue', 'secretory_sign', 'president_sign'
    $columns = ['id','id','id','id','reg_start_date', 'reg_end_date', 'event_level_type_id', 'state_id', 'district_id', 'event_name', 'event_image', 'event_date',  'event_description', 'event_fees', 'event_remarks', 'status', 'title_of_championship', 'association_name', 'reg_no', 'date', 'venue', 'secretory_sign', 'president_sign'];
    $orderBy = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'id'; // Fallback to 'id'


    $state_id = $_GET['state_id'] ?? "";
    $district_id = $_GET['district_id'] ?? "";


    // Base SQL query for fetching data
$whereClause = 'WHERE 1=1 and event_level_type_id=1 ';
$bindings = [];

if (!empty($searchValue)) {
    $whereClause .= " AND (event_name LIKE :search 
                          OR title_of_championship LIKE :search 
                          OR association_name LIKE :search)";
    $bindings['search'] = "%{$searchValue}%";
}


if (!empty($state_id)) {
    $whereClause .= " AND e.state_id = :state_id";
    $bindings['state_id'] = $state_id;
}

if (!empty($district_id)) {
    $whereClause .= " AND e.district_id = :district_id";
    $bindings['district_id'] = $district_id;
}

    $count_condition='';

    // Role-based access filters
    if (($role_id == 3 || $role_id == 4) && $session_state_id) {
        $whereClause .= " and e.state_id = :session_state_id";
        $bindings['session_state_id'] = $session_state_id;
        
        $count_condition .= " and s1.state_id=$session_state_id";
    }

    if (($role_id == 2 || $role_id == 4) && $session_district_id) {
        $whereClause .= " and e.district_id = :session_district_id";
        $bindings['session_district_id'] = $session_district_id;
        $count_condition .= " and s1.district_id=$session_district_id";
    }
    
    if (($role_id == 2 || $role_id == 4) && $session_club_id) {
        $count_condition .= " and s1.club_id=$session_club_id";
    }


    // Fetch data query
    $sqlData = "SELECT e.*, s.state_name, d.district_name,
    (
        SELECT COUNT(s1.id)
        FROM tbl_skaters s1
        LEFT JOIN tbl_session_renewal sr1 
            ON s1.id = sr1.skater_id
        WHERE s1.district_id = e.district_id $count_condition 
          AND sr1.session_id = e.session_id and (sr1.payment_id is null or sr1.payment_id!='')
    ) AS eligible,
    (
        SELECT COUNT(DISTINCT tbl_event_registration.skater_id)
        FROM tbl_event_registration left join tbl_skaters s1 on s1.id=tbl_event_registration.skater_id
        WHERE tbl_event_registration.event_id = e.id $count_condition
    ) AS register
FROM tbl_events e
LEFT JOIN tbl_districts d ON e.district_id = d.id
LEFT JOIN tbl_states s ON d.state_id = s.id $whereClause 
            ORDER BY $orderBy $orderDir";
error_log($sqlData);

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
    $sqlTotal = "SELECT COUNT(*) as total FROM tbl_events e WHERE 1=1 and event_level_type_id=1 ";
    $totalRecords = $pdo->query($sqlTotal)->fetchColumn();

    // Total filtered records count (with filtering)
    $sqlFiltered = "SELECT COUNT(*) as total FROM tbl_events e $whereClause";
    
   // error_log($sqlFiltered);
    
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

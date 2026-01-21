<?php
// Include the database connection file
require_once '../../config/config.php';

try {
    // Get the query parameters sent by DataTables
    $isExport = isset($_GET['isExport']) && $_GET['isExport'] === 'true';
    $limit = isset($_GET['length']) ? (int)$_GET['length'] : 10;
    $offset = isset($_GET['start']) ? (int)$_GET['start'] : 0;
    $orderColumnIndex = isset($_GET['order'][0]['column']) ? (int)$_GET['order'][0]['column'] : 0;
    $orderDir = isset($_GET['order'][0]['dir']) && in_array(strtolower($_GET['order'][0]['dir']), ['asc', 'desc'])
                ? $_GET['order'][0]['dir']
                : 'asc';
    $searchValue = isset($_GET['search']['value']) ? trim($_GET['search']['value']) : '';


    $state_id = isset($_GET['state_id']) ? $_GET['state_id'] : "";
    $district_id = isset($_GET['district_id']) ? $_GET['district_id'] : "";
    $verify_id = isset($_GET['verify_id']) ? $_GET['verify_id'] : "";
    
    // Map column indices to actual database columns
    $columns = ['id', 'full_name', 'district_id','state_id','mobile_number', 'gender', 'aadhar_number', 'email_address', 'state_name', 'district_name', 'residential_address', 'identity_proof', 'profile_photo', 'created_at', 'updated_at'];
    $orderBy = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'id';

    // Base SQL query
    $whereClauses = ['1=1 and role_id=3'];
    // $whereClauses[] = 'role_id=2';
    $bindings = [];
    
    if (!empty($state_id)) {
        $whereClauses[] = "u.state_id = :state_id";
        $bindings[':state_id'] = $state_id;
    }
    if (!empty($district_id)) {
        $whereClauses[] = "u.district_id = :district_id";
        $bindings[':district_id'] = $district_id;
    }
    if ($verify_id!='' && $verify_id!=null) {
        $whereClauses[] = "u.verified = :verify_id";
        $bindings[':verify_id'] = $verify_id;
    }
    
    
    if($role_id && $role_id==3){ //State Login Access
        $whereClauses[] = "u.state_id = :state_id";
        $bindings[':state_id'] = $session_state_id;
    }
    if($role_id && $role_id==2){ //District Login Access
        $whereClauses[] = "u.district_id = :district_id";
        $bindings[':district_id'] = $session_district_id;
    }
    
    
    
     if (!empty($searchValue)) {
        $whereClauses[] = "(u.full_name LIKE :search OR u.mobile_number LIKE :search 
                            OR u.aadhar_number LIKE :search 
                            OR u.member_id LIKE :search
                            OR u.mobile_number LIKE :search
                            OR u.email_address LIKE :search )";
        $bindings[':search'] = "%{$searchValue}%";
    }
    
    $whereClause = "WHERE " . implode(" AND ", $whereClauses);

    // Fetch data query
    $sqlData = "SELECT u.*, st.state_name, d.district_name
                FROM tbl_user u
                LEFT JOIN tbl_states st ON u.state_id = st.id
                LEFT JOIN tbl_districts d ON u.district_id = d.id
                $whereClause ORDER BY $orderBy $orderDir";
    //error_log($sqlData);
    if (!$isExport) {
        $sqlData .= " LIMIT :limit OFFSET :offset";
        $bindings[':limit'] = $limit;
        $bindings[':offset'] = $offset;
    }

    $stmt = $pdo->prepare($sqlData);
    foreach ($bindings as $key => $value) {
        $stmt->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
    }
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Total records count
    $sqlTotal = "SELECT COUNT(*) as total FROM tbl_user u where role_id=3";
    $totalRecords = $pdo->query($sqlTotal)->fetchColumn();

    // Total filtered records count
    $sqlFiltered = "SELECT COUNT(*) as total FROM tbl_user u $whereClause";
    $stmtFiltered = $pdo->prepare($sqlFiltered);
    foreach ($bindings as $key => $value) {
        if ($key !== ':limit' && $key !== ':offset') {
            $stmtFiltered->bindValue($key, $value, PDO::PARAM_STR);
        }
    }
    $stmtFiltered->execute();
    $totalFilteredRecords = $stmtFiltered->fetchColumn();

    // Response for DataTables and export
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


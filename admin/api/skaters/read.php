<?php
require_once '../../config/config.php';

try {
    // Session/user variables (should be set from session)
    $role_id = $_SESSION['role_id'] ?? null;
    $session_state_id = $_SESSION['state_id'] ?? null;
    $session_district_id = $_SESSION['district_id'] ?? null;
    $session_club_id = $_SESSION['club_id'] ?? null;

    $isExport = isset($_GET['isExport']) && $_GET['isExport'] === 'true';
    $limit = isset($_GET['length']) ? (int)$_GET['length'] : 10;
    $offset = isset($_GET['start']) ? (int)$_GET['start'] : 0;

    $orderColumnIndex = $_GET['order'][0]['column'] ?? 0;
    $orderDir = in_array(strtolower($_GET['order'][0]['dir'] ?? ''), ['asc', 'desc']) ? $_GET['order'][0]['dir'] : 'desc';
    $searchValue = trim($_GET['search']['value'] ?? '');

    $columns = ['id','id','id','id','id', 'full_name', 'father_name', 'mobile_number', 'date_of_birth', 'verified', 'ct.cat_name', 'gender', 'blood_group', 'school_name', 'aadhar_number', 'email_address', 'club_name', 'coach_name', 'coach_mobile_number', 'district_id', 'state_id', 'state_name', 'district_name', 'residential_address', 'identity_proof', 'profile_photo', 'created_at', 'updated_at'];
    $orderBy = $columns[$orderColumnIndex] ?? 'id';

    $state_id = $_GET['state_id'] ?? '';
    $district_id = $_GET['district_id'] ?? '';
    $club_id = $_GET['club_id'] ?? '';
    $verify_id = $_GET['verify_id'] ?? '';
    $filter_payment = $_GET['filter_payment'] ?? '';
    
    $filter_category_id = $_GET['filter_category_id'] ?? '';
    $filter_agecategory = $_GET['filter_agecategory'] ?? '';
    $filter_gender = $_GET['filter_gender'] ?? '';
    $start_date = $_GET['start_date'] ?? '';
    $end_date = $_GET['end_date'] ?? '';
    
    $stmt = $pdo->prepare("SELECT id FROM tbl_session WHERE is_active = 1 ORDER BY id DESC limit 1");
    $stmt->execute();
    $session_id = $stmt->fetchColumn();
    
    $filter_year = $_GET['filter_year'] ?? $session_id;
    

    $whereClauses = ['1=1'];
    $bindings = [];

    if (!empty($state_id)) {
        $whereClauses[] = "s.state_id = :state_id";
        $bindings[':state_id'] = $state_id;
    }
    
// Optional created_at range filter
if (!empty($start_date) && !empty($end_date)) {
    $whereClauses[] = "DATE(s.created_at) BETWEEN :start_date AND :end_date";
    $bindings[':start_date'] = $start_date;
    $bindings[':end_date'] = $end_date;
} elseif (!empty($start_date)) {
    $whereClauses[] = "DATE(s.created_at) >= :start_date";
    $bindings[':start_date'] = $start_date;
} elseif (!empty($end_date)) {
    $whereClauses[] = "DATE(s.created_at) <= :end_date";
    $bindings[':end_date'] = $end_date;
}
    
    if (!empty($filter_year)) {
        $whereClauses[] = "sr.session_id = :session_id";
        $bindings[':session_id'] = $filter_year;
    }
    
    
    if (!empty($filter_gender)) {
        $whereClauses[] = "s.gender = :gender";
        $bindings[':gender'] = $filter_gender;
    }
    if (!empty($filter_category_id)) {
        $whereClauses[] = "s.category_type_id = :category_type_id";
        $bindings[':category_type_id'] = $filter_category_id;
    }
    if (!empty($filter_agecategory)) {
        $whereClauses[] = "sr.age_category = :age_category";
        $bindings[':age_category'] = $filter_agecategory;
    }

    if (!empty($district_id)) {
        $whereClauses[] = "s.district_id = :district_id";
        $bindings[':district_id'] = $district_id;
    }

    if (!empty($club_id)) {
        $whereClauses[] = "s.club_id = :club_id";
        $bindings[':club_id'] = $club_id;
    }

    if ($verify_id !== '') {
        $whereClauses[] = "s.verified = :verify_id";
        $bindings[':verify_id'] = $verify_id;
    }

    if ($filter_payment !== '') {
        if ($filter_payment == 1) {
            $whereClauses[] = " (sr.payment_id IS NULL OR sr.payment_id = '' ) ";
        } elseif ($filter_payment == 0) {
            $whereClauses[] = "sr.payment_id IS NOT NULL AND sr.payment_id != ''";
        }
    }
$count_condition='';

    // Role-based access filters
    if ($role_id == 3 && $session_state_id) {
        $whereClauses[] = "s.state_id = :session_state_id";
        $bindings[':session_state_id'] = $session_state_id;
        $count_condition .=" and state_id = $session_state_id";
        
    }

    if ($role_id == 2 && $session_district_id) {
        $whereClauses[] = "s.district_id = :session_district_id";
        $bindings[':session_district_id'] = $session_district_id;
        $count_condition .=" and district_id = $session_district_id";
    }

    if ($role_id == 4 && $session_club_id) {
        $whereClauses[] = "s.club_id = :session_club_id";
        $bindings[':session_club_id'] = $session_club_id;
        
        $count_condition .=" and club_id = $session_club_id";
    }

    if (!empty($searchValue)) {
        $whereClauses[] = "(s.full_name LIKE :search OR s.father_name LIKE :search OR s.school_name LIKE :search OR s.aadhar_number LIKE :search OR s.membership_id LIKE :search)";
        $bindings[':search'] = "%{$searchValue}%";
    }

    $whereClause = 'WHERE ' . implode(' AND ', $whereClauses);

    // Data Query
    $sqlData = "
        SELECT s.*, st.state_name, d.district_name, c.club_name, ct.cat_name, sr.payment_id,sr.age_category
        FROM tbl_skaters s
        LEFT JOIN tbl_states st ON s.state_id = st.id
        LEFT JOIN tbl_districts d ON s.district_id = d.id
        LEFT JOIN tbl_clubs c ON s.club_id = c.id
        LEFT JOIN tbl_category_type ct ON s.category_type_id = ct.id
        LEFT JOIN tbl_session_renewal sr ON sr.skater_id = s.id and sr.session_id=".$filter_year."
        $whereClause
        GROUP BY s.membership_id
        ORDER BY $orderBy $orderDir
    ";

    if (!$isExport) {
        $sqlData .= " LIMIT :limit OFFSET :offset";
        $bindings[':limit'] = $limit;
        $bindings[':offset'] = $offset;
    }

    $stmt = $pdo->prepare($sqlData);
    foreach ($bindings as $key => $value) {
        $paramType = (in_array($key, [':limit', ':offset']) && is_int($value)) ? PDO::PARAM_INT : PDO::PARAM_STR;
        $stmt->bindValue($key, $value, $paramType);
    }
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Total records
    $totalRecords = $pdo->query("SELECT COUNT(*) FROM tbl_skaters where 1=1 $count_condition")->fetchColumn();

    // Total filtered records
    $sqlFiltered = "SELECT COUNT(*) FROM tbl_skaters s
        LEFT JOIN tbl_session_renewal sr ON sr.skater_id = s.id
        $whereClause";

    $stmtFiltered = $pdo->prepare($sqlFiltered);
    foreach ($bindings as $key => $value) {
        if (!in_array($key, [':limit', ':offset'])) {
            $stmtFiltered->bindValue($key, $value, PDO::PARAM_STR);
        }
    }
    $stmtFiltered->execute();
    $totalFilteredRecords = $stmtFiltered->fetchColumn();

    // Output
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

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => "An unexpected error occurred: " . $e->getMessage()]);
    error_log("Error: " . $e->getMessage());
    exit;
}

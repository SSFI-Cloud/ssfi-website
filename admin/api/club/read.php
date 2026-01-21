<?php
require_once '../../config/config.php';

try {
    // Get query parameters from DataTables request
    $isExport = isset($_GET['isExport']) && $_GET['isExport'] === 'true';
    $limit = isset($_GET['length']) ? (int)$_GET['length'] : 10;
    $offset = isset($_GET['start']) ? (int)$_GET['start'] : 0;
    $orderColumnIndex = isset($_GET['order'][0]['column']) ? (int)$_GET['order'][0]['column'] : 0;
    $orderDir = isset($_GET['order'][0]['dir']) && in_array(strtolower($_GET['order'][0]['dir']), ['asc', 'desc']) 
                ? $_GET['order'][0]['dir'] 
                : 'asc';
    $searchValue = isset($_GET['search']['value']) ? trim($_GET['search']['value']) : '';

    // Define column mapping for ordering
    $columns = ['id', 'club_name', 'registration_number', 'contact_person', 'mobile_number', 'email_address', 
                'district_id', 'state_id', 'verified', 'club_address', 'established_year', 'logo_path', 'status', 'created_at', 'updated_at'];
    $orderBy = $columns[$orderColumnIndex] ?? 'id';

    // Get filter parameters
    $state_id = $_GET['state_id'] ?? "";
    $district_id = $_GET['district_id'] ?? "";
    $verify_id = $_GET['verify_id'] ?? "";
    $payment_status = $_GET['payment_status'] ?? "";

    // Assuming session values (define properly if needed)
    $role_id = $_SESSION['role_id'] ?? null;
    $session_state_id = $_SESSION['state_id'] ?? null;
    $session_district_id = $_SESSION['district_id'] ?? null;

    $whereClauses = ['1=1'];
    $bindings = [];

    if (!empty($state_id)) {
        $whereClauses[] = "c.state_id = :state_id";
        $bindings[':state_id'] = $state_id;
    }

    if (!empty($district_id)) {
        $whereClauses[] = "c.district_id = :district_id";
        $bindings[':district_id'] = $district_id;
    }

    if ($verify_id !== '') {
        $whereClauses[] = "c.verified = :verify_id";
        $bindings[':verify_id'] = $verify_id;
    }

    if ($payment_status !== '') {
        if ($payment_status == 1) {
            $whereClauses[] = "sr.payment_id IS NOT NULL AND sr.payment_id != ''";
        } else {
            $whereClauses[] = "(sr.payment_id IS NULL OR sr.payment_id = '')";
        }
    }

    if ($role_id == 3 && $session_state_id) {
        $whereClauses[] = "c.state_id = :session_state_id";
        $bindings[':session_state_id'] = $session_state_id;
    }

    if ($role_id == 2 && $session_district_id) {
        $whereClauses[] = "c.district_id = :session_district_id";
        $bindings[':session_district_id'] = $session_district_id;
    }

    if (!empty($searchValue)) {
        $whereClauses[] = "(c.club_name LIKE :search OR c.registration_number LIKE :search 
                            OR c.contact_person LIKE :search OR c.mobile_number LIKE :search 
                            OR c.email_address LIKE :search OR c.club_address LIKE :search 
                            OR c.established_year LIKE :search OR c.status LIKE :search)";
        $bindings[':search'] = "%{$searchValue}%";
    }

    $whereClause = "WHERE " . implode(" AND ", $whereClauses);

    // Data query
    $sqlData = "SELECT sr.payment_id, c.*, s.state_name, d.district_name, sr.club_id
                FROM tbl_clubs c
                LEFT JOIN tbl_states s ON c.state_id = s.id
                LEFT JOIN tbl_districts d ON c.district_id = d.id
                LEFT JOIN tbl_session_renewal sr ON sr.club_id = c.id
                $whereClause 
                ORDER BY $orderBy $orderDir";

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

    // Total records (unfiltered)
    $sqlTotal = "SELECT COUNT(*) as total FROM tbl_clubs c";
    $totalRecords = $pdo->query($sqlTotal)->fetchColumn();

    // Total filtered records
    $sqlFiltered = "SELECT COUNT(*) as total 
                    FROM tbl_clubs c 
                    LEFT JOIN tbl_session_renewal sr ON sr.club_id = c.id 
                    $whereClause";
    $stmtFiltered = $pdo->prepare($sqlFiltered);
    foreach ($bindings as $key => $value) {
        if (!in_array($key, [':limit', ':offset'])) {
            $stmtFiltered->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
    }
    $stmtFiltered->execute();
    $totalFilteredRecords = $stmtFiltered->fetchColumn();

    // Output response
    $response = $isExport
        ? ["data" => $data, "export" => true]
        : [
            "draw" => isset($_GET['draw']) ? (int)$_GET['draw'] : 0,
            "recordsTotal" => (int)$totalRecords,
            "recordsFiltered" => (int)$totalFilteredRecords,
            "data" => $data
        ];

    echo json_encode($response);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
    error_log("Database error: " . $e->getMessage());
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => "An unexpected error occurred: " . $e->getMessage()]);
    error_log("Error: " . $e->getMessage());
}

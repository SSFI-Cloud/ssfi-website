<?php
require_once '../../config/config.php';

try {
    $isExport = isset($_GET['isExport']) && $_GET['isExport'] === 'true';
    $limit = isset($_GET['length']) ? (int)$_GET['length'] : 10;
    $offset = isset($_GET['start']) ? (int)$_GET['start'] : 0;
    $orderColumnIndex = isset($_GET['order'][0]['column']) ? (int)$_GET['order'][0]['column'] : 0;
    $orderDir = isset($_GET['order'][0]['dir']) && in_array(strtolower($_GET['order'][0]['dir']), ['asc', 'desc']) ? $_GET['order'][0]['dir'] : 'asc';
    $searchValue = isset($_GET['search']['value']) ? trim($_GET['search']['value']) : '';

    $event_id = isset($_GET['event_id']) ? (int)$_GET['event_id'] : 28;
    
    $filter_club_id = isset($_GET['filter_club_id']) ? (int)$_GET['filter_club_id'] : '';
    
    $filter_payment = isset($_GET['filter_payment']) ? $_GET['filter_payment'] : '';
    $filter_category_id = isset($_GET['filter_category_id']) ? $_GET['filter_category_id'] : '';
    $filter_agecategory = isset($_GET['filter_agecategory']) ? $_GET['filter_agecategory'] : '';
    $filter_gender = isset($_GET['filter_gender']) ? $_GET['filter_gender'] : '';
    
     $state_id = $_GET['filter_state_id'] ?? '';
    $district_id = $_GET['filter_district_id'] ?? '';
    

    // Define searchable/orderable columns
    $columns = ['s.membership_id', 's.full_name', 's.date_of_birth', 'ct.cat_name', 'sr.age', 'sr.age_category'];
  //  $orderBy = $columns[$orderColumnIndex] ?? 's.id';
  
    $orderBy = 's.gender';

    $whereClauses = ['er.event_id = :event_id'];
    $bindings = [':event_id' => $event_id];

    if (!empty($searchValue)) {
        $whereClauses[] = "(s.membership_id LIKE :search OR s.full_name LIKE :search OR s.date_of_birth LIKE :search OR ct.cat_name LIKE :search OR sr.age_category LIKE :search)";
        $bindings[':search'] = "%{$searchValue}%";
    }
    
    if($filter_payment!=''){
        if($filter_payment==1){
            $whereClauses[] = "er.payment_id!=:payment_id";
            $bindings[':payment_id'] = "";
        }else if ($filter_payment==0) {
            $whereClauses[] = "er.payment_id IS NULL";
        }
        
        /*else{
            $whereClauses[] = "er.payment_id=:payment_id";
            $bindings[':payment_id'] = "";
        }*/
    }
    
    if (!empty($state_id)) {
        $whereClauses[] = "s.state_id = :state_id";
        $bindings[':state_id'] = $state_id;
    }
    
    if (!empty($district_id)) {
        $whereClauses[] = "s.district_id = :district_id";
        $bindings[':district_id'] = $district_id;
    }
    
    if($filter_category_id!=""){
        $whereClauses[] = "eel.category_type_id=:category_type_id";
        $bindings[':category_type_id'] = $filter_category_id;
    }
    
    if($filter_club_id!=""){
        $whereClauses[] = "s.club_id=:club_id";
        $bindings[':club_id'] = $filter_club_id;
    }
    
    if($filter_agecategory!=""){
        $whereClauses[] = "sr.age_category=:age_category";
        $bindings[':age_category'] = $filter_agecategory;
    }
    if($filter_gender!=""){
        $whereClauses[] = "s.gender=:gender";
        $bindings[':gender'] = $filter_gender;
    }
    
// Session/user variables (should be set from session)
    $role_id = $_SESSION['role_id'] ?? null;
    $session_state_id = $_SESSION['state_id'] ?? null;
    $session_district_id = $_SESSION['district_id'] ?? null;
    $session_club_id = $_SESSION['club_id'] ?? null;
    
$count_condition='';   
 // Role-based access filters
    if (($role_id == 3 || $role_id == 4) && $session_state_id) {
        $whereClauses[] = "s.state_id=:session_state_id";
        $bindings[':session_state_id'] = $session_state_id;
        
        $count_condition .= " and s.state_id=$session_state_id";
    }

    if (($role_id == 2 || $role_id == 4) && $session_district_id) {
        $whereClauses[] = "s.district_id=:session_district_id";
        $bindings[':session_district_id'] = $session_district_id;
        
        $count_condition .= " and s.district_id=$session_district_id";
    }
    
    if (($role_id == 2 || $role_id == 4) && $session_club_id) {
        $whereClauses[] = "s.club_id=:session_club_id";
        $bindings[':session_club_id'] = $session_club_id;
        
        $count_condition .= " and s.club_id=$session_club_id";
    }
    
    

    $whereClause = "WHERE " . implode(" AND ", $whereClauses); //and er.payment_id is not null

    $sqlData = "SELECT
                    s.id,sr.session_id,er.event_id,
                    s.membership_id,
                    s.full_name,
                    s.date_of_birth,
                    ct.cat_name,c.club_name,ddd.district_name,
                    sr.age,
                    sr.age_category,s.gender,er.payment_id,er.created_at,er.suit_size
                FROM tbl_event_registration er
                LEFT JOIN tbl_skaters s ON er.skater_id = s.id
                LEFT JOIN tbl_clubs c ON s.club_id = c.id
                LEFT JOIN tbl_districts ddd ON ddd.id = s.district_id
                LEFT JOIN tbl_eligible_event_level eel ON eel.id = er.eligible_event_level_id
                LEFT JOIN tbl_category_type ct ON ct.id = eel.category_type_id
                LEFT JOIN tbl_session_renewal sr ON sr.skater_id = s.id AND sr.session_id = er.session_id
                $whereClause 
                GROUP BY s.id
                ORDER BY s.gender ASC,ct.id,CASE 
    WHEN sr.age_category = 'Under 4' THEN 1
    WHEN sr.age_category = 'Under 6' THEN 2
    WHEN sr.age_category = 'Under 8' THEN 3
    WHEN sr.age_category = 'Under 10' THEN 4
    WHEN sr.age_category = 'Under 12' THEN 5
    WHEN sr.age_category = 'Under 14' THEN 6
    WHEN sr.age_category = 'Under 16' THEN 7
    WHEN sr.age_category = 'Above 16' THEN 8
    ELSE 9
  END";
                //echo $sqlData;$orderBy $orderDir

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
    
$f = 0;
foreach ($data as $d) {
    // Step 1: Fetch event levels
    $sql = "SELECT eel.event_level
            FROM tbl_event_registration er 
            LEFT JOIN tbl_eligible_event_level eel ON eel.id = er.eligible_event_level_id 
            WHERE er.skater_id = :skater_id 
              AND er.event_id = :event_id 
              AND er.session_id = :session_id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':skater_id' => $d['id'],
        ':event_id' => $d['event_id'],
        ':session_id' => $d['session_id']
    ]);
    $eventLevels = $stmt->fetchAll(PDO::FETCH_COLUMN); // ['200M', 'POINTTOPOINT', etc.]

    // Step 2: Initialize all event level keys as empty
    $levels = ['200 M', '400 M', '1000 M', 'Road Race 100 M', 'Point to Point', 'Road Race 2000 M'];
    foreach ($levels as $key) {
        $data[$f][$key] = ''; // default empty
    }

    // Step 3: Mark ✔ if present
    foreach ($eventLevels as $level) {
        if (in_array($level, $levels)) {
            $data[$f][$level] = 'YES'; // or 'Yes', or $level
        }
    }
    $f++;
}

    
    

    // Total records
    $sqlTotal = "SELECT COUNT(DISTINCT s.id) FROM tbl_event_registration er
                 LEFT JOIN tbl_skaters s ON er.skater_id = s.id
                 WHERE er.event_id = :event_id $count_condition";
    $stmtTotal = $pdo->prepare($sqlTotal);
    $stmtTotal->bindValue(':event_id', $event_id, PDO::PARAM_INT);
    $stmtTotal->execute();
    $totalRecords = $stmtTotal->fetchColumn();

    // Filtered records
    $sqlFiltered = "SELECT COUNT(DISTINCT s.id)
                    FROM tbl_event_registration er
                    LEFT JOIN tbl_skaters s ON er.skater_id = s.id
                    LEFT JOIN tbl_eligible_event_level eel ON eel.id = er.eligible_event_level_id
                    LEFT JOIN tbl_category_type ct ON ct.id = eel.category_type_id
                    LEFT JOIN tbl_session_renewal sr ON sr.skater_id = s.id AND sr.session_id = er.session_id
                    $whereClause ";//and er.payment_id is not null
    $stmtFiltered = $pdo->prepare($sqlFiltered);
    foreach ($bindings as $key => $value) {
        if (!in_array($key, [':limit', ':offset'])) {
            $stmtFiltered->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
    }
    $stmtFiltered->execute();
    $totalFilteredRecords = $stmtFiltered->fetchColumn();

    // Return response
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
    echo json_encode(["error" => "Unexpected error: " . $e->getMessage()]);
    error_log("Error: " . $e->getMessage());
}

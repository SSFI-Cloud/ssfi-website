<?php
session_start();
header('Content-Type: application/json');
include '../../config/config.php'; // Adjust path if necessary


/**
 * Fetch data dynamically with error handling
 */
function fetchData($pdo, $table, $columns = '*', $conditions = [], $orderBy = '',$is_front) {
    try {
        $role_id = $_SESSION['role_id'] ?? 0; // Default role_id is 1 (Admin)
        $session_state_id=$_SESSION['state_id'] ?? 0;
        $session_district_id=$_SESSION['district_id'] ?? 0;
        $session_club_id=$_SESSION['club_id'] ?? 0;
        $session_all=$_SESSION['ssfi'] ?? '';
        
        // Validate table existence
        if (!tableExists($pdo, $table)) {
            return json_encode(["success" => false, "error" => "Table '$table' does not exist."]);
        }

        // Validate columns
        if (is_array($columns)) {
            $validColumns = getTableColumns($pdo, $table);
            foreach ($columns as $col) {
                if (!in_array($col, $validColumns)) {
                    return json_encode(["success" => false, "error" => "Column '$col' does not exist in table '$table'."]);
                }
            }
            $columns = implode(', ', $columns);
        } else {
            $columns = '*'; // Default to all columns if not provided
        }

        // Build WHERE clause dynamically
        $whereClause = "";
        if (!empty($conditions)) {
            $whereParts = [];
            foreach ($conditions as $column => $value) {
                $whereParts[] = "$column = :$column";
            }
            $whereClause = "WHERE " . implode(" AND ", $whereParts);
        }
//Extra Code Condition Start        
    $state_ids_string='-';$district_ids_string='-';$club_ids_string='-';
    if($is_front==1){
        if($whereClause==''){$whereClause="where 1=1";}
        /*if($table=="tbl_states"){
            $verified_state_ids = [];
            $sql = "SELECT DISTINCT state_id FROM tbl_user WHERE verified = 1 AND state_id IS NOT NULL";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $verified_state_ids[] = $row['state_id'];
            }
            $state_ids_string = implode(',', $verified_state_ids);
            if($state_ids_string==""){$state_ids_string=0;}
            $whereClause.=" and id in (".$state_ids_string.")";
        }
        if($table=="tbl_districts"){
            $verified_district_ids = [];
            $sql = "SELECT DISTINCT district_id FROM tbl_user WHERE verified = 1 AND district_id IS NOT NULL";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $verified_district_ids[] = $row['district_id'];
            }
            $district_ids_string = implode(',', $verified_district_ids);
            if($district_ids_string==""){$district_ids_string=0;}
            $whereClause.=" and id in (".$district_ids_string.")";
        }*/
        if($table=="tbl_clubs"){
            $verified_club_ids = [];
            $sql = "SELECT DISTINCT id FROM tbl_clubs WHERE verified = 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $verified_club_ids[] = $row['id'];
            }
            $club_ids_string = implode(',', $verified_club_ids);
            if($club_ids_string==""){$club_ids_string=0;}
            $whereClause.=" and id in (".$club_ids_string.")";
        }
    }    
        
        
        
    if($is_front==0){    
        if(($role_id==3 || $role_id==2 || $role_id==4) && $session_state_id && $table=="tbl_states"){
            if($whereClause==''){$whereClause="where 1=1";}
            $whereClause.=" and id=".$session_state_id;
        }
        
        if(($role_id==2 || $role_id==4) && $session_state_id && $table=="tbl_districts"){
            if($whereClause==''){$whereClause="where 1=1";}
            $whereClause.=" and id=".$session_district_id;
        }
        if($role_id==4 && $session_state_id && $table=="tbl_clubs"){
            if($whereClause==''){$whereClause="where 1=1";}
            $whereClause.=" and id=".$session_club_id;
        }
    }
    
    //error_log($whereClause);
    
//Extra Code Condition End    
    
    
    
        // Construct final SQL query
        $query = "SELECT $columns FROM $table $whereClause";
        if (!empty($orderBy)) {
            $query .= " ORDER BY $orderBy";
        }


        $stmt = $pdo->prepare($query);
        error_log($query);

        // Bind values dynamically
        foreach ($conditions as $column => $value) {
            $stmt->bindValue(":$column", $value);
        }

        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return json_encode(["success" => true, "data" => $data]);
    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        return json_encode(["success" => false, "error" => "Database error occurred."]);
    }
}

/**
 * Check if the given table exists in the database
 */
function tableExists($pdo, $table) {
    try {
        $stmt = $pdo->prepare("SHOW TABLES LIKE :table");
        $stmt->bindValue(':table', $table);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Get all columns of a table
 */
function getTableColumns($pdo, $table) {
    try {
        $stmt = $pdo->prepare("SHOW COLUMNS FROM `$table`");
        $stmt->execute();
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $columns ?: [];
    } catch (PDOException $e) {
        return [];
    }
}

// Example usage
// $table = "tbl_client";
// $columns = ["id", "name"]; // Specify columns
// $conditions = ["status" => "active"]; // Optional WHERE conditions
// $orderBy = "name ASC"; // Optional ORDER BY

if(!isset($_GET['table']) || $_GET['table']==""){
    echo json_encode(["success" => false, "error" => "Table name required."]);
    return 0 ;
}

$table = $_GET['table'] ?? '';
$columns = isset($_GET['columns']) ? explode(',', $_GET['columns']) : ['id', 'name'];
$conditions = isset($_GET['conditions']) ? json_decode($_GET['conditions'], true) : [];
$orderBy = $_GET['orderby'] ?? '';
$is_front = $_GET['is_front'] ?? 0;



echo fetchData($pdo, $table, $columns, $conditions, $orderBy,$is_front);
?>
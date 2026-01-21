<?php
header('Content-Type: application/json');
include '../../config/config.php';

try {
    $stmt = $pdo->prepare("SELECT id, state_id FROM tbl_districts WHERE state_id != 23");
    $stmt->execute();
    $districts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$districts) {
        echo json_encode(["status" => "error", "message" => "No districts found"]);
        exit;
    }

    // Prepare insert statement
    // $insertStmt = $pdo->prepare("
    //     INSERT INTO tbl_clubs (club_name, district_id, state_id, created_at)
    //     VALUES (:club_name, :district_id, :state_id, NOW())
    // ");
    $s=0;
    foreach ($districts as $district) {
        $s++;
        // $insertStmt->execute([
        //     ':club_name' => 'OPEN',
        //     ':district_id' => $district['id'],
        //     ':state_id' => $district['state_id']
        // ]);
    print_r($district);
    }
    print_r($s);
    error_log('dsffdffgfgfgfgfg'.$s);
    echo json_encode(["status" => "success", "message" => "Clubs created successfully".$s]);

} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}
?>

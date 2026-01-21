<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Adjust this path if necessary

if (isset($_GET['event_id']) && isset($_GET['level_id']) && isset($_GET['age_category']) && isset($_GET['gender'])) {
    $event_id = intval($_GET['event_id']);
    $level_id = intval($_GET['level_id']);
    $age_category = $_GET['age_category'];
    $gender = $_GET['gender'];

    $response = [
        'selected' => ['all' => [], 'preselected' => []],
        'absent'   => ['all' => [], 'preselected' => []],
        'first'    => [],
        'second'   => [],
        'third'    => [],
        'forth'    => [],
        'fifth'    => []
    ];

    // Base query: all eligible members
    $baseSQL = "
        SELECT s.membership_id, s.full_name, er.*
        FROM tbl_event_registration er
        LEFT JOIN tbl_skaters s ON s.id = er.skater_id
        LEFT JOIN tbl_session_renewal sr ON sr.skater_id = s.id
        WHERE er.event_id = :event_id
          AND er.eligible_event_level_id = :level_id
          AND sr.age_category = :age_category
          AND s.gender = :gender
    ";

    // Fetch all eligible members for selected list
    $stmt = $pdo->prepare($baseSQL);
    $stmt->execute([
        ':event_id' => $event_id,
        ':level_id' => $level_id,
        ':age_category' => $age_category,
        ':gender' => $gender
    ]);
    error_log("SELECT s.membership_id, s.full_name, er.*
        FROM tbl_event_registration er
        LEFT JOIN tbl_skaters s ON s.id = er.skater_id
        LEFT JOIN tbl_session_renewal sr ON sr.skater_id = s.id
        WHERE er.event_id = $event_id
          AND er.eligible_event_level_id = $level_id
          AND sr.age_category = '".$age_category."'
          AND s.gender = '".$gender."'");
    
    $allMembers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($allMembers as $row) {
        $memberData = [
            'id' => $row['id'],
            'text' => $row['membership_id']
        ];

        // All eligible members for selected & absent
        $response['selected']['all'][] = $memberData;
        $response['absent']['all'][]   = $memberData;

        // Preselected for selected list
        if ($row['result'] == 1) {
            $response['selected']['preselected'][] = $row['id'];
        }

        // Preselected for absent list
        if ($row['is_present'] == 0) {
            $response['absent']['preselected'][] = $row['id'];
        }

        // First place
        if ($row['prize_announcement_place'] == 1) {
            $response['first'][] = $row['id'];
        }
        // Second place
        if ($row['prize_announcement_place'] == 2) {
            $response['second'][] = $row['id'];
        }
        // Third place
        if ($row['prize_announcement_place'] == 3) {
            $response['third'][] = $row['id'];
        }
        if ($row['prize_announcement_place'] == 4) {
            $response['forth'][] = $row['id'];
        }
        if ($row['prize_announcement_place'] == 5) {
            $response['fifth'][] = $row['id'];
        }
    }

    echo json_encode($response);
} else {
    echo json_encode(['error' => 'Missing parameters']);
}

<?php
include '../admin/config/config.php';

if (isset($_POST['district_id'])) {
    $district_id = $_POST['district_id'];

    $stmt = $pdo->prepare("SELECT event_name, event_date, event_venue FROM tbl_events WHERE district_id = ? LIMIT 1");
    $stmt->execute([$district_id]);

    if ($stmt->rowCount() > 0) {
        $event = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode(['success' => true, 'data' => $event]);
    } else {
        echo json_encode(['success' => false, 'error' => 'No event found']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}
?>

<?php
include '../../config/db.php'; // must return a PDO instance as $pdo

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

$id        = $data['id'] ?? 0;
$event_id  = $data['event_id'] ?? 0;
$suit_size = $data['suit_size'] ?? '';

if ($id && $event_id && $suit_size) {

    try {
        $sql = "
            UPDATE tbl_event_registration
            SET suit_size = :suit_size
            WHERE skater_id = :skater_id
              AND event_id  = :event_id
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':suit_size', $suit_size, PDO::PARAM_STR);
        $stmt->bindParam(':skater_id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);

        $stmt->execute();

        echo json_encode([
            'status'  => true,
            'message' => 'Suit size updated successfully'
        ]);

    } catch (PDOException $e) {
        echo json_encode([
            'status'  => false,
            'message' => 'Database error',
            'error'   => $e->getMessage()
        ]);
    }

} else {
    echo json_encode([
        'status'  => false,
        'message' => 'Invalid parameters'
    ]);
}

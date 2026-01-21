<?php
header('Content-Type: application/json');
require_once '../../config/config.php'; // Adjust if path differs

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo->beginTransaction(); // Start DB transaction

        // Basic input
        $event_id   = intval($_POST['event_id']);
        $level_id   = intval($_POST['level_id']);

        // Arrays
        $all_memberId = $_POST['all_memberId'] ?? [];
        $selected     = $_POST['selected_memberId'] ?? [];
        $absent       = $_POST['absent_memberId'] ?? [];

        // Place winners: ensure arrays even if one value
        $first  = isset($_POST['first_place_memberId']) ? (array)$_POST['first_place_memberId'] : [];
        $second = isset($_POST['second_place_memberId']) ? (array)$_POST['second_place_memberId'] : [];
        $third  = isset($_POST['third_place_memberId']) ? (array)$_POST['third_place_memberId'] : [];
        $forth  = isset($_POST['forth_place_memberId']) ? (array)$_POST['forth_place_memberId'] : [];
        $fifth  = isset($_POST['fifth_place_memberId']) ? (array)$_POST['fifth_place_memberId'] : [];

        // Clean up and merge all IDs to reset
        $ids_to_reset = array_unique(array_merge(
            $all_memberId, $selected, $absent,
            $first, $second, $third, $forth, $fifth
        ));
        $ids_to_reset = array_filter($ids_to_reset, 'is_numeric'); // Filter only valid IDs

        // Reset all matching IDs to default
        if (!empty($ids_to_reset)) {
            $inPlaceholders = implode(',', array_map('intval', $ids_to_reset));
            $reset_sql = "
                UPDATE tbl_event_registration
                SET result = 1, is_present = 1, prize_announcement_place = 0
                WHERE id IN ($inPlaceholders)
            ";
            $pdo->exec($reset_sql);
        }

        // Mark absent skaters
        if (!empty($absent)) {
            $absentPlaceholders = implode(',', array_map('intval', $absent));
            $absent_sql = "
                UPDATE tbl_event_registration
                SET is_present = 0, result = 1, prize_announcement_place = 0
                WHERE id IN ($absentPlaceholders)
            ";
            $pdo->exec($absent_sql);
        }

        // Function to update winners
        function updatePrizePlace(PDO $pdo, array $ids, int $place)
        {
            $stmt = $pdo->prepare("
                UPDATE tbl_event_registration
                SET prize_announcement_place = :place, result = 1, is_present = 1
                WHERE id = :id
            ");

            foreach ($ids as $id) {
                $id = intval($id);
                if ($id > 0) {
                    $stmt->execute([
                        ':id' => $id,
                        ':place' => $place
                    ]);
                }
            }
        }

        // Call updates for each place
        updatePrizePlace($pdo, $first, 1);
        updatePrizePlace($pdo, $second, 2);
        updatePrizePlace($pdo, $third, 3);
        updatePrizePlace($pdo, $forth, 4);
        updatePrizePlace($pdo, $fifth, 5);

        $pdo->commit();

        echo json_encode(['success' => true, 'message' => 'Event results updated successfully.']);

    } catch (Exception $e) {
        $pdo->rollBack();
        error_log('Event Update Error: ' . $e->getMessage());
        echo json_encode(['error' => 'Update failed: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}

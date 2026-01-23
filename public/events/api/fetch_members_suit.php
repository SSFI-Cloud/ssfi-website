<?php
// Include the database configuration file
include '../../../admin/config/config.php';

// Check if the query parameter is set and not empty
if (isset($_POST['query']) && !empty(trim($_POST['query']))) {
    $query = trim($_POST['query']);

    try {
        // Prepare the SQL statement to prevent SQL injection
    //   $stmt = $pdo->prepare("SELECT membership_id FROM tbl_skaters WHERE membership_id LIKE ? LIMIT 5");
      $stmt = $pdo->prepare("SELECT DISTINCT s.membership_id as membership_id
FROM tbl_event_registration er 
LEFT JOIN tbl_skaters s
    ON er.skater_id = s.id 
    where er.event_id=14 and membership_id LIKE ? LIMIT 5");
    // AND er.is_present=1 and er.result =1

        $stmt->execute(["%$query%"]);

        // Fetch all matching results as associative array
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Check if any results were found
        if (!empty($results)) {
            echo '<ul>';
            foreach ($results as $row) {
                echo '<li class="suggestion-item">' . htmlspecialchars($row['membership_id'], ENT_QUOTES, 'UTF-8') . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<ul><li class="suggestion-item" style="color:gray;">No match found</li></ul>';
        }
    } catch (PDOException $e) {
        // Log the error or handle it as needed
        echo '<ul><li class="suggestion-item" style="color:red;">Database error occurred</li></ul>';
        // Optionally log: error_log($e->getMessage());
    }
} else {
    // If query is not set or empty, show no match message
    echo '<ul><li class="suggestion-item" style="color:gray;">Enter membership ID</li></ul>';
}
?>

<?php
include '../config/config.php'; // Make sure this sets up $pdo properly

$event_id = $_GET['event_id'] ?? 0; // Avoid undefined index

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=state_selection_list.xls");

$sql = "
SELECT er.id, s.membership_id, s.full_name, c.club_name, e.event_name,
       er.prize_announcement_place, sr.age_category, eel.event_level,
       ct.cat_name, s.gender,
       (
        SELECT GROUP_CONCAT(DISTINCT eel2.event_level ORDER BY eel2.event_level SEPARATOR ', ')
        FROM tbl_event_registration er2
        LEFT JOIN tbl_eligible_event_level eel2 ON eel2.id = er2.eligible_event_level_id
        WHERE er2.skater_id = s.id
    ) AS all_part_events
FROM tbl_event_registration er
LEFT JOIN tbl_skaters s ON s.id = er.skater_id
LEFT JOIN tbl_clubs c ON c.id = s.club_id
LEFT JOIN tbl_events e ON e.id = er.event_id
LEFT JOIN tbl_eligible_event_level eel ON eel.id = er.eligible_event_level_id
LEFT JOIN tbl_category_type ct ON ct.id = eel.category_type_id
LEFT JOIN tbl_session_renewal sr ON sr.skater_id = er.skater_id AND sr.session_id = er.session_id
WHERE er.result = 1 AND er.prize_announcement_place != 0 AND er.event_id = :event_id
GROUP BY s.membership_id
ORDER BY er.event_id,
    CASE 
        WHEN sr.age_category = 'Under 4' THEN 1
        WHEN sr.age_category = 'Under 6' THEN 2
        WHEN sr.age_category = 'Under 8' THEN 3
        WHEN sr.age_category = 'Under 10' THEN 4
        WHEN sr.age_category = 'Under 12' THEN 5
        WHEN sr.age_category = 'Under 14' THEN 6
        WHEN sr.age_category = 'Under 16' THEN 7
        WHEN sr.age_category = 'Above 16' THEN 8
        ELSE 9
    END,
    er.prize_announcement_place,
    er.eligible_event_level_id
";

// Use prepared statements for safety
$stmt = $pdo->prepare($sql);
$stmt->execute(['event_id' => $event_id]);

echo "<table border='1'>";
echo "<tr>
        <th>Membership ID</th>
        <th>Full Name</th>
        <th>Club Name</th>
        <th>Event Name</th>
        <th>Age Category</th>
        <th>Event Level</th>
        <th>Category</th>
        <th>Gender</th>
      </tr>";

// Output rows
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>
            <td>{$row['membership_id']}</td>
            <td>{$row['full_name']}</td>
            <td>{$row['club_name']}</td>
            <td>{$row['event_name']}</td>
            <td>{$row['age_category']}</td>
            <td>{$row['all_part_events']}</td>
            <td>{$row['cat_name']}</td>
            <td>{$row['gender']}</td>
          </tr>";
}

echo "</table>";

$pdo = null; // Close the connection
?>

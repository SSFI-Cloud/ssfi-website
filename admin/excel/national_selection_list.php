<?php
include '../config/config.php'; // Ensure $pdo is set properly

$event_id = $_GET['event_id'] ?? 0;

// Set headers for CSV download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=National_selection_list.csv');

// Open output stream
$output = fopen('php://output', 'w');

// Write header row
fputcsv($output, [
    'Membership ID',
    'Full Name',
    'Club Name',
    'District Name',
    'Event Name',
    'Age Category',
    'Event Level(s)',
    'Category',
    'Gender'
]);

// SQL Query
$sql = "
SELECT s.district_id, dd.district_name, er.id, s.membership_id, s.full_name, 
       c.club_name, e.event_name, sr.age_category, eel.event_level, 
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
LEFT JOIN tbl_districts dd ON dd.id = s.district_id
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

$stmt = $pdo->prepare($sql);
$stmt->execute(['event_id' => $event_id]);

// Output each row as CSV
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($output, [
        $row['membership_id'],
        $row['full_name'],
        $row['club_name'],
        $row['district_name'],
        $row['event_name'],
        $row['age_category'],
        $row['all_part_events'],
        $row['cat_name'],
        $row['gender']
    ]);
}

// Close output
fclose($output);
exit;
?>

<?php
header('Content-Type: application/json');
require_once '../../config/config.php';


error_log('function called');

// Check if the 'id' parameter is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the SQL query to fetch the user with the given ID
    $sql = "SELECT c.*,s.state_name,d.district_name FROM `tbl_clubs` c
LEFT JOIN tbl_states s on s.id=c.state_id
LEFT JOIN tbl_districts d on d.id=c.district_id WHERE c.id = :id";
    $stmt = $pdo->prepare($sql);

    // Bind the 'id' parameter
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the query  
    $stmt->execute();

    // Fetch the user data
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // If the user is found, return the data as JSON
    if ($user) {
        echo json_encode($user);
    } else {
        echo json_encode(['error' => 'Club not found']);
    }
} else {
    echo json_encode(['error' => 'No ID provided']);
}
?>

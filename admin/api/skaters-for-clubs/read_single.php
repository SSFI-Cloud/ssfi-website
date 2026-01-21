<?php
header('Content-Type: application/json');
require_once '../../config/config.php';


error_log('function called');

// Check if the 'id' parameter is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the SQL query to fetch the user with the given ID
    $sql = "SELECT st.*,d.district_name,s.state_name,c.club_name,ct.cat_name FROM tbl_skaters st 
left join tbl_states s on s.id=st.state_id 
left join tbl_clubs c on c.id=st.club_id 
left join tbl_category_type ct on ct.id=st.category_type_id 
left join tbl_districts d on d.id=st.district_id WHERE st.id = :id";
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
        echo json_encode(['error' => 'Skater not found']);
    }
} else {
    echo json_encode(['error' => 'No ID provided']);
}
?>

<?php
header("Content-Type: application/json");
include '../../config/config.php'; // Adjust this path if necessary

// Capture JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['order_id']) || !isset($data['amount'])) {
    echo json_encode(["status" => "error", "message" => "Invalid Request"]);
    exit;
}

$order_id = $data['order_id'];
$amount = $data['amount'];
$skater_id=$data['skater_id'];

// Check if the payment already exists in the database
$stmt = $pdo->prepare("SELECT * FROM payments WHERE order_id = ?");
$stmt->execute([$order_id]);
$existing_payment = $stmt->fetch(PDO::FETCH_ASSOC);

// if ($existing_payment) {
//     echo json_encode(["status" => "success", "message" => "Payment already recorded", "order_id" => $order_id]);
//     exit;
// }


// Fetch skater details
$stmt = $pdo->prepare("SELECT st.*, d.district_name, s.state_name, c.club_name, ct.cat_name 
                      FROM tbl_skaters st
                      LEFT JOIN tbl_states s ON s.id = st.state_id
                      LEFT JOIN tbl_clubs c ON c.id = st.club_id
                      LEFT JOIN tbl_category_type ct ON ct.id = st.category_type_id
                      LEFT JOIN tbl_districts d ON d.id = st.district_id
                      WHERE st.id = ?");
$stmt->execute([$skater_id]);
$skater_info = $stmt->fetch(PDO::FETCH_ASSOC);

if ($skater_info) {
    echo json_encode([
        "status" => "success",
        "message" => "Payment recorded successfully",
        "order_id" => $order_id,
        "data" => $skater_info
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Skater not found"]);
}

$pdo = null; // Close the database connection
?>

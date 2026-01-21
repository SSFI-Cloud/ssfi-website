<?php
include '../../config/config.php'; // Adjust path if needed

$club_id=$_POST['club_id'] ?? 0;

$stmt = $pdo->query("SELECT id FROM tbl_session where is_active=1");
$session_id = $stmt->fetchColumn();

$stmt = $pdo->query("SELECT club_fees FROM tbl_fees");
$fees = $stmt->fetchColumn();


$stmt = $pdo->query("SELECT order_id FROM tbl_session_renewal where session_id=$session_id and club_id=$club_id");
$stmt->execute();
$order_id = $stmt->fetchColumn();

echo json_encode([
                "status" => "success",
                "message" => "done",
                "order_id" => $order_id,
                "amount" => $fees,
                "razorpay_api_key" => $Razorpay_api_key
            ]);
            
            
?>
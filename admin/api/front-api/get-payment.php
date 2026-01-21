<?php
include '../../config/config.php'; // Adjust path if needed

$skater_id=$_POST['skater_id'] ?? 0;

error_log("Skater\Idss:".$skater_id);

$stmt = $pdo->query("SELECT id FROM tbl_session where is_active=1");
$session_id = $stmt->fetchColumn();


error_log($session_id."-".$skater_id);
$stmt = $pdo->query("SELECT skater_fees FROM tbl_fees");
$fees = $stmt->fetchColumn();


$stmt = $pdo->query("SELECT order_id FROM tbl_session_renewal where session_id=$session_id and skater_id=$skater_id");
$stmt->execute();
$order_id = $stmt->fetchColumn();


error_log($fees."--".$order_id."--".$Razorpay_api_secret);

echo json_encode([
                "status" => "success",
                "message" => "done",
                "order_id" => $order_id,
                "amount" => $fees,
                "razorpay_api_key" => $Razorpay_api_key
            ]);
            
            
?>
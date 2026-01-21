<?php
include '../../config/config.php'; // Adjust path if needed

$Razorpay_api_secret='bC7hjMrTn61YSi7BzzaaJxFd'; // tnssa
$Razorpay_api_key='rzp_live_RIb0oARWG5CcDw';

$event_id=$_POST['event_id'] ?? 0;
$skater_id=$_POST['skater_id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM `tbl_events` WHERE id=?");
$stmt->execute([$event_id]);
$e_results = $stmt->fetch(PDO::FETCH_ASSOC);

error_log("SELECT * FROM tbl_event_registration where session_id=".$e_results['session_id']." and skater_id=".$skater_id." and event_id=".$event_id." limit 1");

/*$stmt = $pdo->query("SELECT * FROM tbl_event_registration where session_id=? and skater_id=? and event_id=? limit 1");
$stmt->execute([$e_results['session_id'],$skater_id,$event_id]);*/
$stmt = $pdo->query("SELECT * FROM tbl_event_registration where session_id=".$e_results['session_id']." and skater_id=".$skater_id." and event_id=".$event_id." limit 1");
$stmt->execute();
$eresults = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode([
                "status" => "success",
                "message" => "done",
                "order_id" => $eresults['order_id'],
                "amount" => $e_results['event_fees'],
                "razorpay_api_key" => $Razorpay_api_key
            ]);
            
            
?>
<?php
session_start();
header('Content-Type: application/json');
include ("./ssfi/admin/config/config.php");

$mobile_no = $_POST['mobile_no'] ?? '';
$email = $_POST['email'] ?? '';
$otp = $_POST['otp'] ?? '';
$aadhar_number = $_POST['aadhar_number'] ?? '';

if (!isset($_SESSION['ssfi']) || $_SESSION['ssfi']['email'] !== $email || $_SESSION['ssfi']['otp'] != $otp) {
    echo json_encode(["status" => "error", "message" => "Invalid OTP"]);
    exit;
}

unset($_SESSION['ssfi']['otp']);



$skater_registered = 0;
$skater_payment_order = 0;
$skater_payment = 0;

$skater_id=0;


$stmt = $pdo->query("SELECT id FROM tbl_session where is_active=1");
$session_id = $stmt->fetchColumn();


$stmt = $pdo->prepare("SELECT COUNT(*),id FROM tbl_skaters WHERE aadhar_number = ?");
$stmt->execute([$aadhar_number]);
$count = $stmt->fetchColumn();
if($count){
       $skater_registered=1;
       $skater_id=$count['id'];
}


$stmt = $pdo->prepare("SELECT order_id, payment_id FROM tbl_session_renewal WHERE skater_id = ?,session_id=?");
$stmt->execute([$skater_id,$session_id]);
$count = $stmt->fetchColumn();
if($count){
       if($count['payment_id']!=""){
           $skater_payment=1;
       }
       if($count['order_id']!=""){
           $skater_payment_order=1;
       }
}







$sql = "SELECT skater_id FROM tbl_skaters WHERE aadhar_number = '$aadhar_number'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $skater_registered = 1;
    $row = $result->fetch_assoc();
    $skater_id = $row['skater_id'];

    $sql = "SELECT order_id, payment_id FROM tbl_session_renewal WHERE skater_id = '$skater_id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (!empty($row['order_id'])) {
            $skater_payment_order = 1;
        }
        if (!empty($row['payment_id'])) {
            $skater_payment = 1;
        }
    }
}

$conn->close();

echo json_encode([
    "status" => "success",
    "message" => "OTP Verified",
    "skater_registered" => $skater_registered,
    "skater_payment_order" => $skater_payment_order,
    "skater_payment" => $skater_payment
]);
?>

<?php
session_start();
include '../../admin/config/config.php';
header('Content-Type: application/json');


$mobile_no = $_POST['mobile_no'] ?? '';
 $email = $_POST['email'] ?? '';

$type = $_POST['type'] ?? 'Skater';


// if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//     echo json_encode(["status" => "error", "message" => "Invalid email"]);
//     exit;
// }

$otp = rand(100000, 999999); // Generate OTP
$_SESSION['ssfi']['otp'] = $otp;
 $_SESSION['ssfi']['email'] = $email;
$_SESSION['ssfi']['mobile_no'] = $mobile_no;

// ---- Send OTP via Email ----
// $subject = "Your OTP Code for ".$type." Registration";
// $message = "
//     <html>
//     <head>
//         <title>OTP Verification</title>
//     </head>
//     <body style='font-family: Arial, sans-serif; text-align: center; padding: 20px;'>
//         <h2 style='color: #2C3E50;'>".$type." Registration - OTP Verification</h2>
//         <p>Thank you for registering with us! To complete your registration, please use the One-Time Password (OTP) below:</p>
//         <h1 style='background: #f4f4f4; display: inline-block; padding: 10px 20px; border-radius: 5px; color: #02520a;'>$otp</h1>
//         <p>This OTP is valid for a limited time. Please do not share it with anyone for security reasons.</p>
//         <p>If you did not request this OTP, please ignore this message.</p>
//         <br>
//         <p>Best regards,<br><strong>SSFI BHARAT SKATE</strong></p>
//         <p><a href='https://ssfibharatskate.com/' style='color: #2980B9;'>Visit our website</a> | Contact: support@ssfibharatskate.com</p>
//     </body>
//     </html>
// ";

// $headers = "MIME-Version: 1.0" . "\r\n";
// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
// $headers .= "From: firstmatrix01@gmail.com" . "\r\n";

// mail($email, $subject, $message, $headers);

// ---- Send OTP via WhatsApp ----
$stmt = $pdo->prepare("SELECT access_token, instance_id FROM `whatsapp_api`");

// Execute the statement
$stmt->execute();

// Fetch a single row from the result
$idss = $stmt->fetch(PDO::FETCH_ASSOC);


// ---- Send OTP via WhatsApp ----
$instance_id = $idss['instance_id'];
$access_token = $idss['access_token'];
$whatsapp_number = "91" . $mobile_no; // Ensure correct format

$whatsapp_message = "
 *SSFI ".$type." Registration - OTP Verification* 

Thank you for registering with us! To complete your registration, please use the One-Time Password (OTP) below:

*OTP:* *$otp*

⚠️ This OTP is valid for a limited time. Please do not share it with anyone for security reasons.

If you did not request this OTP, please ignore this message.

";




$subject = "Your OTP Code for ".$type." Registration";
$message = "
    <html>
    <head>
        <title>OTP Verification</title>
    </head>
    <body style='font-family: Arial, sans-serif; text-align: center; padding: 20px;'>
        <h2 style='color: #2C3E50;'>".$type." Registration - OTP Verification</h2>
        <p>Thank you for registering with us! To complete your registration, please use the One-Time Password (OTP) below:</p>
        <center><h1 style='background: #f4f4f4; display: inline-block; padding: 10px 20px; border-radius: 5px; color: #02520a;'>$otp</h1></center>
        <p>This OTP is valid for a limited time. Please do not share it with anyone for security reasons.</p>
        <p>If you did not request this OTP, please ignore this message.</p>
        <br>
        <p>Best regards,<br><strong>SSFI BHARAT SKATE</strong></p>
        <p><a href='https://ssfibharatskate.com/' style='color: #2980B9;'>Visit our website</a> | Contact: support@ssfibharatskate.com</p>
    </body>
    </html>
";
/*E-Mail Send Source Code Start*/
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://fmsbilling.xyz/0-mails/index.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('subject' => $subject,'email' => $email,'message' => $message),
  CURLOPT_HTTPHEADER => array(
    'JWTToken: '
  ),
));
$response = curl_exec($curl);
curl_close($curl);
$response = json_decode($response, true);
if(isset($response)){
    $response_status=$response['status'];
    $response_message=$response['message'];
}
/*E-Mail Send Source Code End*/









$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://chatbot.bulkwaapi.in/api/send?number='.$whatsapp_number.'&type=text&message='.urlencode($whatsapp_message).'&instance_id='.$instance_id.'&access_token='.$access_token,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: stackpost_session=3mvr2k2pnnr59povf187lko7246oilv5'
  ),
));

$response = curl_exec($curl);
curl_close($curl);
// Log Full Response for Debugging
$response_data = json_decode($response, true);


    echo json_encode([
        "status" => "success",
        "otp" => $otp,
        "message" => "OTP sent via WhatsApp & Email",
    ]);

?>

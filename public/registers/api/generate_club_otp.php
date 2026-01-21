<?php
session_start();
include '../../admin/config/config.php';

header('Content-Type: application/json');

// === Get Input Data ===
$mobile_no = $_POST['mobile_no'] ?? '';
$email     = $_POST['email'] ?? '';
$type      = 'Club';

$otp = rand(100000, 999999); // Generate OTP
$_SESSION['ssfi']['otp'] = $otp;
$_SESSION['ssfi']['email'] = $email;

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


echo json_encode([
        "status" => "success",
        "message" => "OTP sent via Email",
        "whatsapp_response" => $response_message
    ]);
/*E-Mail Send Source Code End*/
?>

<?php
session_start();
header('Content-Type: application/json');

$email = 'TESTING@gmail.com';
$mobile_no = '768'; // Ensure correct format

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "error", "message" => "Invalid email"]);
    exit;
}

$otp = rand(100000, 999999); // Generate OTP
$_SESSION['ssfi']['otp'] = $otp;
$_SESSION['ssfi']['email'] = $email;
$_SESSION['ssfi']['mobile_no'] = $mobile_no;

// ---- Send OTP via Email ----
$subject = "Your OTP Code for Skater Registration";
$message = "
    <html>
    <head>
        <title>OTP Verification</title>
    </head>
    <body style='font-family: Arial, sans-serif; text-align: center; padding: 20px;'>
        <h2 style='color: #2C3E50;'>Skater Registration - OTP Verification</h2>
        <p>Thank you for registering with us! To complete your registration, use the One-Time Password (OTP) below:</p>
        <h1 style='background: #f4f4f4; display: inline-block; padding: 10px 20px; border-radius: 5px; color: #E74C3C;'>$otp</h1>
        <p>This OTP is valid for a limited time. Please do not share it with anyone for security reasons.</p>
        <p>If you did not request this OTP, please ignore this message.</p>
        <br>
        <p>Best regards,<br><strong>Your Organization Name</strong></p>
        <p><a href='https://yourwebsite.com' style='color: #2980B9;'>Visit our website</a> | Contact: support@yourorganization.com</p>
    </body>
    </html>
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: no-reply@yourorganization.com" . "\r\n";

// Send Email
$mail_sent = mail($email, $subject, $message, $headers);
if (!$mail_sent) {
    echo json_encode(["status" => "error", "message" => "Failed to send email. Check mail server settings."]);
    exit;
}

// ---- Send OTP via WhatsApp ----
$instance_id = "45";
$access_token = "55";
$whatsapp_number = "91" . $mobile_no; // Ensure correct format

// **Formatted WhatsApp Message**
$whatsapp_message = "
🌟 *Skater Registration - OTP Verification* 🌟

Thank you for registering with us! To complete your registration, please use the One-Time Password (OTP) below:

🔢 *OTP:* *$otp*

⚠️ This OTP is valid for a limited time. Please do not share it with anyone for security reasons.

If you did not request this OTP, please ignore this message.

Best regards,  
*Your Organization Name*  
🌍 [Visit our website](https://yourwebsite.com)  
📩 Contact: support@yourorganization.com
";

$whatsapp_api_url = 'https://bulkwaapi.in/api/send';
$whatsapp_data = [
    "number" => $whatsapp_number,
    "type" => "text",
    "message" => $whatsapp_message,
    "instance_id" => $instance_id,
    "access_token" => $access_token
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $whatsapp_api_url . '?' . http_build_query($whatsapp_data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

// **Check if WhatsApp message was sent successfully**
$response_data = json_decode($response, true);

if ($response === false || empty($response_data)) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to send WhatsApp message",
        "error" => $error,
        "http_code" => $http_code,
        "response_raw" => $response
    ]);
    exit;
}

echo json_encode([
    "status" => "success",
    "message" => "OTP sent via email & WhatsApp",
    "whatsapp_response" => $response_data,
    "http_code" => $http_code
]);
?><?php
session_start();
header('Content-Type: application/json');

$email = 'TESTING@gmail.com';
$mobile_no = '768'; // Ensure correct format

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "error", "message" => "Invalid email"]);
    exit;
}

$otp = rand(100000, 999999); // Generate OTP
$_SESSION['ssfi']['otp'] = $otp;
$_SESSION['ssfi']['email'] = $email;
$_SESSION['ssfi']['mobile_no'] = $mobile_no;

// ---- Send OTP via Email ----
$subject = "Your OTP Code for Skater Registration";
$message = "
    <html>
    <head>
        <title>OTP Verification</title>
    </head>
    <body style='font-family: Arial, sans-serif; text-align: center; padding: 20px;'>
        <h2 style='color: #2C3E50;'>Skater Registration - OTP Verification</h2>
        <p>Thank you for registering with us! To complete your registration, use the One-Time Password (OTP) below:</p>
        <h1 style='background: #f4f4f4; display: inline-block; padding: 10px 20px; border-radius: 5px; color: #E74C3C;'>$otp</h1>
        <p>This OTP is valid for a limited time. Please do not share it with anyone for security reasons.</p>
        <p>If you did not request this OTP, please ignore this message.</p>
        <br>
        <p>Best regards,<br><strong>Your Organization Name</strong></p>
        <p><a href='https://yourwebsite.com' style='color: #2980B9;'>Visit our website</a> | Contact: support@yourorganization.com</p>
    </body>
    </html>
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: no-reply@yourorganization.com" . "\r\n";

// Send Email
$mail_sent = mail($email, $subject, $message, $headers);
if (!$mail_sent) {
    echo json_encode(["status" => "error", "message" => "Failed to send email. Check mail server settings."]);
    exit;
}

// ---- Send OTP via WhatsApp ----
$instance_id = "45";
$access_token = "55";
$whatsapp_number = "91" . $mobile_no; // Ensure correct format

// **Formatted WhatsApp Message**
$whatsapp_message = "
🌟 *Skater Registration - OTP Verification* 🌟

Thank you for registering with us! To complete your registration, please use the One-Time Password (OTP) below:

🔢 *OTP:* *$otp*

⚠️ This OTP is valid for a limited time. Please do not share it with anyone for security reasons.

If you did not request this OTP, please ignore this message.

Best regards,  
*Your Organization Name*  
🌍 [Visit our website](https://yourwebsite.com)  
📩 Contact: support@yourorganization.com
";

$whatsapp_api_url = 'https://bulkwaapi.in/api/send';
$whatsapp_data = [
    "number" => $whatsapp_number,
    "type" => "text",
    "message" => $whatsapp_message,
    "instance_id" => $instance_id,
    "access_token" => $access_token
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $whatsapp_api_url . '?' . http_build_query($whatsapp_data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

// **Check if WhatsApp message was sent successfully**
$response_data = json_decode($response, true);

if ($response === false || empty($response_data)) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to send WhatsApp message",
        "error" => $error,
        "http_code" => $http_code,
        "response_raw" => $response
    ]);
    exit;
}

echo json_encode([
    "status" => "success",
    "message" => "OTP sent via email & WhatsApp",
    "whatsapp_response" => $response_data,
    "http_code" => $http_code
]);
?><?php
session_start();
header('Content-Type: application/json');

$email = 'TESTING@gmail.com';
$mobile_no = '768'; // Ensure correct format

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "error", "message" => "Invalid email"]);
    exit;
}

$otp = rand(100000, 999999); // Generate OTP
$_SESSION['ssfi']['otp'] = $otp;
$_SESSION['ssfi']['email'] = $email;
$_SESSION['ssfi']['mobile_no'] = $mobile_no;

// ---- Send OTP via Email ----
$subject = "Your OTP Code for Skater Registration";
$message = "
    <html>
    <head>
        <title>OTP Verification</title>
    </head>
    <body style='font-family: Arial, sans-serif; text-align: center; padding: 20px;'>
        <h2 style='color: #2C3E50;'>Skater Registration - OTP Verification</h2>
        <p>Thank you for registering with us! To complete your registration, use the One-Time Password (OTP) below:</p>
        <h1 style='background: #f4f4f4; display: inline-block; padding: 10px 20px; border-radius: 5px; color: #E74C3C;'>$otp</h1>
        <p>This OTP is valid for a limited time. Please do not share it with anyone for security reasons.</p>
        <p>If you did not request this OTP, please ignore this message.</p>
        <br>
        <p>Best regards,<br><strong>Your Organization Name</strong></p>
        <p><a href='https://yourwebsite.com' style='color: #2980B9;'>Visit our website</a> | Contact: support@yourorganization.com</p>
    </body>
    </html>
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: no-reply@yourorganization.com" . "\r\n";

// Send Email
$mail_sent = mail($email, $subject, $message, $headers);
if (!$mail_sent) {
    echo json_encode(["status" => "error", "message" => "Failed to send email. Check mail server settings."]);
    exit;
}

// ---- Send OTP via WhatsApp ----
$instance_id = "45";
$access_token = "55";
$whatsapp_number = "91" . $mobile_no; // Ensure correct format

// **Formatted WhatsApp Message**
$whatsapp_message = "
🌟 *Skater Registration - OTP Verification* 🌟

Thank you for registering with us! To complete your registration, please use the One-Time Password (OTP) below:

🔢 *OTP:* *$otp*

⚠️ This OTP is valid for a limited time. Please do not share it with anyone for security reasons.

If you did not request this OTP, please ignore this message.

Best regards,  
*Your Organization Name*  
🌍 [Visit our website](https://yourwebsite.com)  
📩 Contact: support@yourorganization.com
";

$whatsapp_api_url = 'https://bulkwaapi.in/api/send';
$whatsapp_data = [
    "number" => $whatsapp_number,
    "type" => "text",
    "message" => $whatsapp_message,
    "instance_id" => $instance_id,
    "access_token" => $access_token
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $whatsapp_api_url . '?' . http_build_query($whatsapp_data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

// **Check if WhatsApp message was sent successfully**
$response_data = json_decode($response, true);

if ($response === false || empty($response_data)) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to send WhatsApp message",
        "error" => $error,
        "http_code" => $http_code,
        "response_raw" => $response
    ]);
    exit;
}

echo json_encode([
    "status" => "success",
    "message" => "OTP sent via email & WhatsApp",
    "whatsapp_response" => $response_data,
    "http_code" => $http_code
]);
?>
<?php
header('Content-Type: application/json');
include '../../config/config.php';

error_log("Club RESEND update request received");

// Parse input JSON or fallback to POST
$input = json_decode(file_get_contents("php://input"), true) ?? $_POST;
error_log("Received data: " . json_encode($input));

// Utility Functions
function sanitizeInput($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

function sendJsonResponse($status, $message, $extra = []) {
    echo json_encode(array_merge(['status' => $status, 'message' => $message], $extra));
    exit;
}

// Validate required ID
if (!isset($input['id']) || !is_numeric($input['id'])) {
    sendJsonResponse('error', 'Valid Club ID is required');
}

$club_id = (int)$input['id'];


try {
     $sqlData = "SELECT 
                    u.member_id AS membership_id, 
                    u.password AS passwords, 
                    u.username AS username, 
                    c.mobile_number as mobile_number,
                    c.email_address as email_address,
                    c.club_name as club_name
                FROM tbl_user u 
                LEFT JOIN tbl_clubs c ON c.membership_id = u.member_id 
                WHERE c.id = :club_id";
    $stmt = $pdo->prepare($sqlData);
    $stmt->bindParam(':club_id', $club_id, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
   
    $mobile_no=$results['mobile_number'];
    $mobile_no=$results['mobile_number'];
    $membership_id=$results['membership_id'];
    $email=$results['email_address'];
    $cleaned=$results['username'];
    $randomNumber=$results['passwords'];
    $club_name=$results['club_name'];

    // --- Send WhatsApp Message ---
    $whatsapp_number = '91' . $mobile_no;
$whatsapp_message = 
    "*🎉 Congratulations!* Your Club Verification is *Successful!*\n\n" .
    "Thank you for registering with us, *{$club_name}*! We are excited to welcome you to the *SSFI Family!*\n\n" .
    "*📝 Membership Details:*\n" .
    "*• Membership ID :* {$membership_id}\n" .
    "*• User Name :* {$cleaned}\n" .
    "*• Password:* {$randomNumber}\n\n" .
    "*🔐 Login Credentials:*\n" .
    "*• Access Link:* https://ssfibharatskate.com/admin\n\n" .
    "Please *keep these credentials safe and secure.* If you have any questions or need assistance, feel free to reach out to us.\n\n" .
    "Best regards,\n" .
    "*Team SSFI*";
    
    
    $mail_message = '
<html>
<head>
  <style>
    body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }
    .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
    .header { font-size: 22px; font-weight: bold; color: #2E86C1; }
    .section-title { font-size: 18px; font-weight: bold; margin-top: 20px; color: #1C2833; }
    .details { background: #f9f9f9; padding: 15px; border-radius: 8px; margin-top: 10px; }
    .footer { margin-top: 30px; font-size: 14px; color: #555; }
  </style>
</head>
<body>
  <div class="container">
    <p class="header">🎉 Congratulations! Your Club Verification is <strong>Successful!</strong></p>

    <p>Thank you for registering with us, <strong>' . htmlspecialchars($club_name) . '</strong>!<br>
    We are excited to welcome you to the <strong>SSFI Family</strong>.</p>

    <p class="section-title">📝 Membership Details:</p>
    <div class="details">
      <p><strong>• Membership ID:</strong> ' . htmlspecialchars($membership_id) . '</p>
      <p><strong>• User Name:</strong> ' . htmlspecialchars($cleaned) . '</p>
      <p><strong>• Password:</strong> ' . htmlspecialchars($randomNumber) . '</p>
    </div>

    <p class="section-title">🔐 Login Credentials:</p>
    <div class="details">
      <p><strong>• Access Link:</strong> <a href="https://ssfibharatskate.com/admin" target="_blank">https://ssfibharatskate.com/admin</a></p>
    </div>

    <p>Please <strong>keep these credentials safe and secure.</strong> If you have any questions or need assistance, feel free to reach out to us.</p>

    <p class="footer">Best regards,<br><strong>Team SSFI</strong></p>
  </div>
</body>
</html>';

    //$email="ganesan.firstmatrix@gmail.com";
    if (!empty($email)) {
        $subject = "Club Registration Verified Successfully";
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
          CURLOPT_POSTFIELDS => array('subject' => $subject,'email' => $email,'message' => $mail_message),
          CURLOPT_HTTPHEADER => array(
            'JWTToken: '
          ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);
        // error_log($response);
/*E-Mail Send Source Code End*/
    }
    
    // error_log('hii');
$stmt = $pdo->prepare("SELECT access_token, instance_id FROM `whatsapp_api`");
$stmt->execute();
$idss = $stmt->fetch(PDO::FETCH_ASSOC);
$instance_id = $idss['instance_id'];
$access_token = $idss['access_token'];


    $api_params = [
        'number' => $whatsapp_number,
        'type' => 'text',
        'message' => $whatsapp_message,
        'instance_id' => $instance_id,
        'access_token' => $access_token
    ];
    $url = 'https://chatbot.bulkwaapi.in/api/send?' . http_build_query($api_params);

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ]);

    $response = curl_exec($curl);
    $curl_error = curl_error($curl);
    curl_close($curl);

    /*if ($response === false) {
        error_log("WhatsApp API curl error: $curl_error");
        sendJsonResponse('warning', 'Club verified successfully, but failed to send WhatsApp message.', ['error' => $curl_error]);
    }*/

    $response_data = json_decode($response, true);
    
    sendJsonResponse('success', 'Club verified and message sent successfully.', ['whatsapp_response' => $response_data]);
    
    /*if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("WhatsApp API response decode error: " . json_last_error_msg());
        sendJsonResponse('warning', 'Club verified, but invalid response from WhatsApp API.', ['response_raw' => $response]);
    }

    if (!empty($response_data['success'])) {
        sendJsonResponse('success', 'Club verified and WhatsApp message sent successfully.', ['whatsapp_response' => $response_data]);
    } else {
        sendJsonResponse('warning', 'Club verified, but WhatsApp API reported an error.', ['whatsapp_response' => $response_data]);
    }*/

// resend what's app message


} catch (Exception $e) {
    error_log("Exception: " . $e->getMessage());
    sendJsonResponse('error', 'Server error: ' . $e->getMessage());
}

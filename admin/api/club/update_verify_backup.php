<?php
header('Content-Type: application/json');
include '../../config/config.php';

error_log("Club verification update request received");

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
$verified_status = isset($input['verified']) ? (int)$input['verified'] : 1;

// Validate verified_by
$verified_by = 0;
if (isset($input['verified_by'])) {
    if (is_numeric($input['verified_by'])) {
        $verified_by = (int)$input['verified_by'];
    } else {
        sendJsonResponse('error', 'Invalid verified_by value');
    }
}

try {
    // Update verification status
    $stmt = $pdo->prepare("
        UPDATE tbl_clubs
        SET verified = :verified,
            verified_by = :verified_by,
            updated_at = NOW()
        WHERE id = :club_id
    ");
    $stmt->execute([
        ':verified' => $verified_status,
        ':verified_by' => $verified_by,
        ':club_id' => $club_id
    ]);

    // Retrieve updated club data
    $stmt = $pdo->prepare("
        SELECT *, email_address AS email
        FROM tbl_clubs
        WHERE id = :club_id
    ");
    $stmt->execute([':club_id' => $club_id]);
    $clubData = $stmt->fetch(PDO::FETCH_ASSOC);

    $club_name = sanitizeInput($clubData['club_name']);
    $mobile_no = preg_replace('/\D/', '', $clubData['mobile_number']);
    $registration_number = $clubData['registration_number'];
    $membership_id = $clubData['membership_id'];
    $email = isset($clubData['email']) ? sanitizeInput($clubData['email']) : '';

/*role createion starts*/
    $role_id =4;
    $randomNumber = rand(10000000, 99999999);
    $original = $membership_id;
$cleaned = preg_replace('/[^a-zA-Z0-9_]/', '', $original);
    
      $stmt = $pdo->prepare("INSERT INTO tbl_user 
        (role_id,full_name, mobile_number,  club_id, email_address, state_id, district_id,  username, password, member_id, created_at, updated_at) 
        VALUES (:role_id,:full_name, :mobile_number, :club_id, :email_address, :state_id, :district_id, :username, :password, :member_id, NOW(), NOW())");

    $stmt->bindParam(':role_id', $role_id);
    $stmt->bindParam(':full_name', $clubData['club_name']);
    $stmt->bindParam(':mobile_number', $clubData['mobile_number']);
    $stmt->bindParam(':club_id', $clubData['club_id']);
    $stmt->bindParam(':email_address', $clubData['email_address']);
    $stmt->bindParam(':state_id', $clubData['state_id']);
    $stmt->bindParam(':district_id', $clubData['district_id']);
    $stmt->bindParam(':member_id', $membership_id);
    $stmt->bindParam(':username', $cleaned);
    $stmt->bindParam(':password', $randomNumber);
    
    $stmt->execute();

/*role createion ends*/














    if (!$clubData) {
        sendJsonResponse('error', 'Club not found after update');
    }



    if (strlen($mobile_no) < 10) {
        sendJsonResponse('error', 'Invalid mobile number format');
    }

    // --- Send Verification Email ---
    if (!empty($email)) {
        $subject = "Club Registration Verified Successfully";
        $message = "
            <html>
            <head><title>Club Verified</title></head>
            <body style='font-family: Arial, sans-serif; text-align: center; padding: 20px;'>
                <h1 style='background: #f4f4f4; display: inline-block; padding: 10px 20px; border-radius: 5px; color: #02520a;'>
                    Club {$club_name} has been successfully verified!
                </h1>
                <p>Best regards,<br><strong>SSFI BHARAT SKATE</strong></p>
                <p><a href='https://ssfibharatskate.com/' style='color: #2980B9;'>Visit our website</a> | Contact: support@ssfibharatskate.com</p>
            </body>
            </html>";

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: info@ssfibharatskate.com\r\n";  

        mail($email, $subject, $message, $headers);
    }

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


    $api_params = [
        'number' => $whatsapp_number,
        'type' => 'text',
        'message' => $whatsapp_message,
        'instance_id' => '67DBF0D1203B7',
        'access_token' => '67dbeb2e78895'
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

    if ($response === false) {
        error_log("WhatsApp API curl error: $curl_error");
        sendJsonResponse('warning', 'Club verified successfully, but failed to send WhatsApp message.', ['error' => $curl_error]);
    }

    $response_data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("WhatsApp API response decode error: " . json_last_error_msg());
        sendJsonResponse('warning', 'Club verified, but invalid response from WhatsApp API.', ['response_raw' => $response]);
    }

    if (!empty($response_data['success'])) {
        sendJsonResponse('success', 'Club verified and WhatsApp message sent successfully.', ['whatsapp_response' => $response_data]);
    } else {
        sendJsonResponse('warning', 'Club verified, but WhatsApp API reported an error.', ['whatsapp_response' => $response_data]);
    }

// resend what's app message


} catch (Exception $e) {
    error_log("Exception: " . $e->getMessage());
    sendJsonResponse('error', 'Server error: ' . $e->getMessage());
}

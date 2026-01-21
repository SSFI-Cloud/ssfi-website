<?php
session_start();

include '../../admin/config/config.php';
try{
$mobile_no = $_POST['mobile_no'] ?? '';
$email = $_POST['email'] ?? '';
$member_id = $_POST['member_id'] ?? '';
$type = $_POST['type'] ?? 'Skater Event';

$otp = rand(100000, 999999); // Generate OTP
$_SESSION['ssfi_event']['otp'] = $otp;
$_SESSION['ssfi_event']['mobile_no'] = $mobile_no;

$normalized_member_id = strtoupper(str_replace(' ', '', $member_id));

$stmt = $pdo->prepare("SELECT * FROM tbl_skaters WHERE UPPER(REPLACE(membership_id, ' ', '')) = ?");
$stmt->execute([$normalized_member_id]);
$member_result = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$member_result){
    echo json_encode([
        "status" => "failed",
        "message" => 'Member Id Invalid...',
    ]);
    exit; 
}else{
    /*if($member_result['email_address']!=$email){
        echo json_encode([
            "status" => "failed",
            "message" => 'Invalid Email Id, Use Your Registered Email ID...',
        ]);
        exit;
    }else if($member_result['mobile_number']!=$mobile_no){
        echo json_encode([
            "status" => "failed",
            "message" => 'Invalid Mobile Number, Use Your Registered Mobile Number...',
        ]);
        exit;
    }*/
}

if($member_result){
        $stmt = $pdo->prepare("SELECT id FROM tbl_session WHERE is_active = 1 ORDER BY id DESC limit 1");
        $stmt->execute();
        $session_id = $stmt->fetchColumn();
        
        $stmt = $pdo->prepare("SELECT * FROM `tbl_session_renewal` WHERE skater_id=? and session_id=?");
        $stmt->execute([$member_result['id'],$session_id]);
        $session_results = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if(!$session_results){
            echo json_encode([
                    "status" => "failed",
                    "message" => 'Member is '.$session_results['name']." Renewal Amount Not Completed Completed First.. ",
                ]);
            exit; 
        }else if($session_results['payment_id']==""){
            echo json_encode([
                    "status" => "failed",
                    "message" => "Your Account Payment Not yet Completed,Pls Go Skater Register Make The Payment, After only Register Event...",
                ]);
            exit; 
        }
}


/*echo json_encode([
        "status" => "success",
        "message" => $otp,
    ]);
exit; */

/*---- Send OTP via Email ----*/
/*$subject = "Your OTP Code for ".$type." Event Registration";
$message = "
    <html>
    <head>
        <title>OTP Verification</title>
    </head>
    <body style='font-family: Arial, sans-serif; text-align: center; padding: 20px;'>
        <h2 style='color: #2C3E50;'>".$type." Event Registration - OTP Verification</h2>
        <p>Thank you for registering with us! To complete your registration, please use the One-Time Password (OTP) below:</p>
        <center><h1 style='background: #f4f4f4; display: inline-block; padding: 10px 20px; border-radius: 5px; color: #02520a;'>$otp</h1></center>
        <p>This OTP is valid for a limited time. Please do not share it with anyone for security reasons.</p>
        <p>If you did not request this OTP, please ignore this message.</p>
        <br>
        <p>Best regards,<br><strong>SSFI BHARAT SKATE</strong></p>
        <p><a href='https://ssfibharatskate.com/' style='color: #2980B9;'>Visit our website</a> | Contact: support@ssfibharatskate.com</p>
    </body>
    </html>
";*/

$response_status='failed';$response_message='something went wrong...';
/*E-Mail Send Source Code Start*/
/*$curl = curl_init();
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
}*/
/*E-Mail Send Source Code End*/


/*Whatsapp Send Source Code Start*/
/*$stmt = $pdo->prepare("SELECT access_token, instance_id FROM `whatsapp_api`");
$stmt->execute();
$idss = $stmt->fetch(PDO::FETCH_ASSOC);
$instance_id = $idss['instance_id'];
$access_token = $idss['access_token'];
$whatsapp_number = "91" . $mobile_no; // Ensure correct format
$whatsapp_message = "
 *SSFI ".$type." Registration - OTP Verification* 

Thank you for registering with us! To complete your registration, please use the One-Time Password (OTP) below:

*OTP:* *$otp*

⚠️ This OTP is valid for a limited time. Please do not share it with anyone for security reasons.

If you did not request this OTP, please ignore this message.

";*/
/*$curl = curl_init();

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
$response_data = json_decode($response, true);
if ($response === false || empty($response_data)) {
    $response_status="failed";
    $response_message .="Failed to Send Whatsapp Message";
}else{
    $response_status="success";
    $response_message .="Whatsapp message Sended Succesfully...";
}*/
/*Whatsapp Send Source Code Start*/

$response_status="success";


    echo json_encode([
        "status" => $response_status,
        "otp" => $otp,
        "message" => $response_message,
    ]);

}catch(exception $e){
    echo json_encode([
        "status" => "failed",
        "message" => 'Somthing Went Wrng..',
    ]);
}
?>
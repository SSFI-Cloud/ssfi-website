<?php
header('Content-Type: application/json');
include '../../config/config.php';

error_log("secretary verification update request received");

// Read incoming data correctly
$input = json_decode(file_get_contents("php://input"), true);
if (!$input) {
    $input = $_POST; // Fallback to $_POST if not JSON
}

error_log("Received data: " . json_encode($input));

// Function to sanitize input
function sanitizeInput($data)
{
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Validate skater ID
if (!isset($input['id']) || trim($input['id']) === '') {
    echo json_encode(['status' => 'error', 'message' => "Secretary ID is required"]);
    exit;
}

$id = (int) $input['id']; // Convert ID to integer



function sendWhatsappMessage($mobile_no,$username,$password,$instance_id,$access_token){
    
    // ---- Send OTP via WhatsApp ----
    //$instance_id = "67DBF0D1203B7";
    //$access_token = "67dbeb2e78895";
    $whatsapp_number = "91" . $mobile_no;
    
    $whatsapp_message = "
*District Secretory Registration - Verification Completed*
        
Congratulations! Your registration has been successfully verified. Here are your login credentials:

*Username:* *$username*  
*Password:* *$password*

🔐 Please keep your login credentials secure and do not share them with anyone.

If you did not request this message, please ignore it.
";
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
    
    if ($response === false || empty($response_data)) {
       $msg = 'Failed to send WhatsApp message'; 
    } else {
       $msg = 'OTP sent via WhatsApp'; 
    }
    return $msg;
}





try {
    
          
                // $stmts = $pdo->prepare("SELECT u.* FROM tbl_user u WHERE u.id = ?");
                // $stmts->execute([$id]);
                // $results = $stmts->fetch(PDO::FETCH_ASSOC);
                // $secretory_info = $results;
                
                // $username = $secretory_info['username'];
                // $password = $secretory_info['password'];
                // $email_address = $secretory_info['email_address'];
                // $mobile_no = $secretory_info['mobile_number'];
                
                // Prepare and execute the query
                    $stmt = $pdo->prepare("SELECT * FROM tbl_user WHERE id = ?");
                    $stmt->execute([$id]);
                    
                    // Fetch the result as an associative array
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                    // error_log(print_r($user,true));
                    // error_log(print_r($user['email_address'],true));
                    // Check if user exists before accessing fields
                    if ($user) {
                        $username      = $user['username'];
                        $password      = $user['password'];
                        $email_address = $user['email_address'];
                        // $email_address = 'praveenbarath123@gmail.com';
                        $mobile_no     = $user['mobile_number'];
                    } else {
                        $username = $password = $email_address = $mobile_no = null;
                    }

                
                //$mobile_no=8124455952;
                
                $stmt = $pdo->prepare("SELECT access_token, instance_id FROM `whatsapp_api`");
                $stmt->execute();
                $idss = $stmt->fetch(PDO::FETCH_ASSOC);
                $instance_id = $idss['instance_id'];
                $access_token = $idss['access_token'];

              
                if($mobile_no){
                    sendWhatsappMessage($mobile_no,$username,$password,$instance_id,$access_token);
                    
                }
                if ($email_address) {
                            $subject = "D-Secretary Registration Verified Successfully";
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
                                                <p class="header">🎉 Congratulations! Your District Secretary Verification is <strong>Successful!</strong></p>
                                            
                                                <p>Congratulations! Your registration has been successfully verified. Here are your login credentials:</p>
                                            
                                                <p class="section-title">📝 Membership Details:</p>
                                                <div class="details">
                                                  <p><strong>• User Name:</strong> ' . $username . '</p>
                                                  <p><strong>• Password:</strong> ' . $password . '</p>
                                                 
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
                              CURLOPT_POSTFIELDS => array('subject' => $subject,'email' => $email_address,'message' => $mail_message),
                              CURLOPT_HTTPHEADER => array(
                                'JWTToken: '
                              ),
                            ));
                            $response = curl_exec($curl);
                            curl_close($curl);
                            $response = json_decode($response, true);
                            // error_log('sent'.print_r($response, true));
                    /*E-Mail Send Source Code End*/
                        }
                        //  error_log('not sent');
                
                echo json_encode(["status" => 'success', "message" => "District Secretary verified successfully"]);
            
} catch (PDOException $e) {
    error_log("Error updating Secretary verification: " . $e->getMessage());
    echo json_encode(["status" => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>

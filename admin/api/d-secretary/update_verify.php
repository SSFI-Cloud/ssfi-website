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

// Assign verified status (default to 1)
$verified_status = isset($input['verified']) ? (int) $input['verified'] : 1;
$verified_by = isset($input['verified_by']) ? sanitizeInput($input['verified_by']) : 0;

$get_session = $pdo->query("SELECT id FROM tbl_session where is_active=1");
$session_id = $get_session->fetchColumn();

function sendMail($email,$username,$password){
    
    $subject = "Your Registration Verification is Completed - Login Credentials";
    $message = "
        <html>
        <head>
            <title>Registration Verification Completed</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    text-align: center;
                    padding: 20px;
                    background-color: #f9f9f9;
                }
                .container {
                    background-color: #ffffff;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    max-width: 500px;
                    margin: auto;
                }
                h2 {
                    color: #2C3E50;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin: 20px 0;
                }
                th, td {
                    padding: 12px;
                    text-align: left;
                    border-bottom: 1px solid #ddd;
                }
                th {
                            background-color: #2980B9;
                    color: white;
                }
                tr:hover {
                    background-color: #f1f1f1;
                }
                a {
                    color: #2980B9;
                    text-decoration: none;
                }
                a:hover {
                    text-decoration: underline;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>District Secretary Registration - Verification Completed</h2>
                <p>Congratulations! Your registration has been successfully verified. Here are your login credentials:</p>
        
                <table>
                    <tr>
                        <th>Username</th>
                        <td>".$username."</td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <td>".$password."</td>
                    </tr>
                </table>
        
                <p>🔐 Please keep your login credentials secure and do not share them with anyone.</p>
                <p>If you did not request this email, please ignore it.</p>
                
                <br>
                <p>Best regards,<br><strong>SSFI BHARAT SKATE</strong></p>
                <p><a href='https://ssfibharatskate.com/'>Visit our website</a> | Contact: support@ssfibharatskate.com</p>
            </div>
        </body>
        </html>
        ";

    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: firstmatrix01@gmail.com" . "\r\n";
    
    // Send the email
    if (mail($email, $subject, $message, $headers)) {
        $msg = "Verification complete email sent successfully!";
    } else {
        $msg =  "Failed to send verification email.";
    }
    
    return $msg;
}

function sendWhatsappMessage($mobile_no,$username,$password){
    
    // ---- Send OTP via WhatsApp ----
    $instance_id = "67DBF0D1203B7";
    $access_token = "67dbeb2e78895";
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
    // Prepare SQL query
    $stmt = $pdo->prepare("UPDATE tbl_user
                          SET verified = :verified, 
                              verified_by = :verified_by, 
                              updated_at = NOW() 
                          WHERE id = :id");

    // Bind values
    $stmt->bindParam(':verified', $verified_status, PDO::PARAM_INT);
    $stmt->bindParam(':verified_by', $verified_by, PDO::PARAM_INT);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
            $order_id   = 'ORD'.rand(9999999999,1000000000);
            $payment_id = 'PAY'.rand(9999999999,1000000000);
            $statement_session = $pdo->prepare("INSERT INTO tbl_session_renewal (order_id, payment_id, payment_status, session_id, user_id) VALUES (?, ?, ?, ?, ?)");
            $statement_session->execute([
                                    $order_id,
                                    $payment_id,
                                    'Done-By-District',
                                    $session_id ?? 0,
                                    $id ?? 0 
                                ]);
                                
            if($statement_session){
                
                 // Fetch Secretory Info
                $stmts = $pdo->prepare("SELECT u.* FROM tbl_user u WHERE u.id = ?");
                $stmts->execute([$id]);
                $results = $stmts->fetch(PDO::FETCH_ASSOC);
                $secretory_info = $results;
                
                $username = $secretory_info['username'];
                $password = $secretory_info['password'];
                $email_address = $secretory_info['email_address'];
                $mobile_no = $secretory_info['mobile_number'];
                
                if($email_address){
                    sendMail($email_address,$username,$password);
                }
                if($mobile_no){
                    sendWhatsappMessage($mobile_no,$username,$password);
                }
                
                echo json_encode(["status" => 'success', "message" => "District Secretary verified successfully"]);
            }else{
                echo json_encode(["status" => 'error', 'message' => 'Error updating Session renewal..']);
            }
    } else {
        echo json_encode(["status" => 'error', 'message' => 'Error updating District Secretary verification status']);
    }
} catch (PDOException $e) {
    error_log("Error updating Secretary verification: " . $e->getMessage());
    echo json_encode(["status" => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>

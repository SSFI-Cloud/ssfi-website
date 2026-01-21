<?php
session_start();
header('Content-Type: application/json');

include('../../admin/config/config.php');

// Get input values safely
$mobile_no = $_POST['mobile_no'] ?? '';
// $email = $_POST['email'] ?? '';
$otp = $_POST['otp'] ?? '';
$aadhar_number = $_POST['aadhar_number'] ?? '';
//error_log("otp:".$otp."  Adr_num :".$aadhar_number);


if (!$aadhar_number) {
    echo json_encode(["status" => "error", "message" => "Missing required parameters"]);
    exit;
}

// Check if database connection is established
if (!isset($pdo)) {
    error_log("Database connection failed!");
    echo json_encode(["status" => "error", "message" => "Database connection failed"]);
    exit;
}

// Debugging (Can be removed in production)
error_log("Database is connected!");

// Check if session exists before accessing it
// if (!isset($_SESSION['ssfi']['email'], $_SESSION['ssfi']['otp'])) {
//     echo json_encode(["status" => "error", "message" => "Session expired or invalid"]);
//     exit;
// }

// Validate OTP and email
if (1) { //$_SESSION['ssfi']['otp'] == $otp || 

    // Unset OTP after verification for security
    //unset($_SESSION['ssfi']['otp']);

    try {
        $skater_registered = 0;
        $skater_payment_order = 0;
        $skater_payment = 0;
        $skater_id = 0;

        // Fetch Active Session ID
        $stmt = $pdo->prepare("SELECT id FROM tbl_session WHERE is_active = 1");
        $stmt->execute();
        $session_id = $stmt->fetchColumn();

        // Fetch Skater Info
        $stmt = $pdo->prepare("SELECT st.*,d.district_name,s.state_name,c.club_name,ct.cat_name FROM tbl_skaters st 
        left join tbl_states s on s.id=st.state_id 
        left join tbl_clubs c on c.id=st.club_id 
        left join tbl_category_type ct on ct.id=st.category_type_id 
        left join tbl_districts d on d.id=st.district_id WHERE st.aadhar_number = ?");
        $stmt->execute([$aadhar_number]);
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        $skattor_info = $results;

        if ($results) {
            $skater_registered = 1;
            $skater_id = $results['id'];
        }
        
        $skattor_info['level_category']='';

        // Fetch Skater Payment Status
        $stmt = $pdo->prepare("SELECT order_id, payment_id,age_category FROM tbl_session_renewal WHERE skater_id = ? AND session_id = ?");
        $stmt->execute([$skater_id, $session_id]);
        $results_session = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($results_session) {
            $skattor_info['level_category']=$results_session['age_category'];
            
            if (!empty($results_session['payment_id'])) {
                $skater_payment = 1;
            }
            if (!empty($results_session['order_id'])) {
                $skater_payment_order = 1;
            }
        }

        // Response Logic
        if ($skater_registered == 1 && $skater_payment == 1) {
            echo json_encode([
                "status" => "success",
                "message" => "Your Annual Skater Registered Already Completed, Download Your Confirmation Certificate",
                "data" => $skattor_info,
                "type" => 1
            ]);
        } elseif ($skater_registered == 1 && $skater_payment_order == 0) {
            
        $stmt = $pdo->query("SELECT skater_fees FROM tbl_fees");
        $fees = $stmt->fetchColumn();
        
        $stmt = $pdo->query("SELECT * FROM tbl_skaters where aadhar_number=".$aadhar_number);
        $resul = $stmt->fetch(PDO::FETCH_ASSOC);
        $postData = $resul;
        
        
        $membership_id=$postData['membership_id'];
        
        /*Payment Order Id Create*/
        $order_data = [
            "amount" => $fees*100,  // ₹10.00 in paise
            "currency" => "INR",
            "receipt" => $membership_id,
           // "payment_capture" => 1, // Auto capture
            "notes" => [  // Custom Parameters
                "member_id" => $membership_id,
                "email_id" => $postData['email_address'],
                "full_name" => $postData['full_name'],
                "father_name" => $postData['father_name'],
                "mobile_number" => $postData['mobile_number'],
                "date_of_birth" => $postData['date_of_birth'],
                "category_type_id" => $postData['category_type_id'],
                "gender" => $postData['gender'],
                "blood_group" => $postData['blood_group'],
                "aadhar_number" => $postData['aadhar_number'],
                "club_id" => $postData['club_id'],
                "state_id" => $postData['state_id'],
                "district_id" => $postData['district_id'],
                "register_type" => "Skater Annual Register-2025"
            ]
        ];
        
        $ch = curl_init("https://api.razorpay.com/v1/orders");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "$Razorpay_api_key:$Razorpay_api_secret");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($order_data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        
        $response = curl_exec($ch);
        
        $order_response = json_decode($response, true);
        curl_close($ch);
        $order_id='';
        if (isset($order_response['id'])) {
           // echo json_encode($order_response); // Send order_id to frontend
            $order_id=$order_response['id'];
            
            
                $stmt = $pdo->prepare("INSERT INTO tbl_session_renewal (order_id, payment_id, payment_status, session_id, skater_id,age,age_category) VALUES (?, ?, ?, ?, ?,?,?)");
                $stmt->execute([
                    $order_id,
                    '',
                    '',
                    $session_id ?? 0, // Make sure to define $session_id
                    $postData['id'],   // Make sure to define $skater_id
                    0,
                    0
                ]);
            
        }
            
            echo json_encode([
                "status" => "success",
                "message" => "Your Annual Skater Registered Already Completed,To Activate Account Completed the Payment",
                "data" => $skattor_info,
                "type" => 3
            ]);
            
           /* echo json_encode([
                "status" => "success",
                "message" => "Your Annual Skater Registered Already Completed, your payment, order incomplete",
                "data" => $skattor_info,
                "type" => 2
            ]);*/
        }  elseif ($skater_registered == 1 && $skater_payment == 0) {
            echo json_encode([
                "status" => "success",
                "message" => "Your Annual Skater Registered Already Completed,To Activate Account Completed the Payment",
                "data" => $skattor_info,
                "type" => 3
            ]);
        } else {
            echo json_encode([
                "status" => "success",
                "message" => "Skater  Not Registered Go for Register",
                "data" => $skattor_info,
                "type" => 4
            ]);
        }
    } catch (PDOException $e) {
        error_log("Database Query Error: " . $e->getMessage());
        echo json_encode(["status" => "error", "message" => "Database error occurred"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid Confirmation..."]);
}
?>

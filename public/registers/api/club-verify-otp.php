<?php
session_start();
header('Content-Type: application/json');

include('../../admin/config/config.php');

// Get input values safely
//$mobile_no = $_POST['mobile_no'] ?? '';
$email = $_POST['email'] ?? '';
$otp = $_POST['otp'] ?? '';
$aadhar_number = $_POST['aadhar_number'] ?? '';

if (!$otp || !$aadhar_number) {
    echo json_encode(["status" => "error", "message" => "Missing required parameters"]);
    exit;
}

// Check if database connection is established
if (!isset($pdo)) {
    error_log("Database connection failed!");
    echo json_encode(["status" => "error", "message" => "Database connection failed.."]);
    exit;
}

// Debugging (Can be removed in production)
//error_log("Database is connected!");

// Check if session exists before accessing it
if (!isset($_SESSION['ssfi']['email'], $_SESSION['ssfi']['otp'])) {
    echo json_encode(["status" => "error", "message" => "Session expired or invalid...."]);
    exit;
}

// Validate OTP and email
if ($_SESSION['ssfi']['otp'] == $otp) {

    // Unset OTP after verification for security
    unset($_SESSION['ssfi']['otp']);

    try {
        $club_registered = 0;
        $club_payment_order = 0;
        $club_payment = 0;
        $club_id = 0;

        // Fetch Active Session ID
        $stmt = $pdo->prepare("SELECT id FROM tbl_session WHERE is_active = 1");
        $stmt->execute();
        $session_id = $stmt->fetchColumn();

        // Fetch Club Info
        $stmt = $pdo->prepare("SELECT c.*,d.district_name,s.state_name FROM tbl_clubs c 
        left join tbl_states s on s.id=c.state_id 
        left join tbl_districts d on d.id=c.district_id WHERE c.aadhar_number = ?");
        $stmt->execute([$aadhar_number]);
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        $club_info = $results;

        if ($results) {
            $club_registered = 1;
            $club_id = $results['id'];
        }

        // Fetch Club Payment Status
        $stmt = $pdo->prepare("SELECT order_id, payment_id FROM tbl_session_renewal WHERE club_id = ? AND session_id = ?");
        $stmt->execute([$club_id, $session_id]);
        $results_session = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($results_session) {
            if (!empty($results_session['payment_id'])) {
                $club_payment = 1;
            }
            if (!empty($results_session['order_id'])) {
                $club_payment_order = 1;
            }
        }

        // Response Logic
        if ($club_registered == 1 && $club_payment == 1) {
            $ds='Kindly Download Your Confirmation Certificate';
            if($club_info['verified']==0){
                $club_info['membership_id']='*****';
                $ds="Your Account Not Yet Verfied,Wait For Approval,After Approval you can download the Certicate";
            }
            
            echo json_encode([
                "status" => "success",
                "message" => "Your Annual Club Registered Already Completed, ".$ds,
                "data" => $club_info,
                "type" => 1
            ]);
        } elseif ($club_registered == 1 && $club_payment_order == 0) {
            echo json_encode([
                "status" => "success",
                "message" => "Your Annual Club Registered Already Completed, your payment, order incomplete",
                "data" => $club_info,
                "type" => 2
            ]);
        }  elseif ($club_registered == 1 && $club_payment == 0) {
            echo json_encode([
                "status" => "success",
                "message" => "Your Annual Club Registered Already Completed,To Activate Account Completed the Payment",
                "data" => $club_info,
                "type" => 3
            ]);
        } else {
            echo json_encode([
                "status" => "success",
                "message" => "Club  Not Registered Go for Register",
                "data" => $club_info,
                "type" => 4
            ]);
        }
    } catch (PDOException $e) {
        error_log("Database Query Error: " . $e->getMessage());
        echo json_encode(["status" => "error", "message" => "Database error occurred"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid OTP...".$_SESSION['ssfi']['otp']]);
}
?>

<?php
session_start();
header('Content-Type: application/json');

include('../../admin/config/config.php');

// Get input values safely
$mobile_no = $_POST['mobile_no'] ?? '';
// $email = $_POST['email'] ?? '';
$otp = $_POST['otp'] ?? '';
$aadhar_number = $_POST['aadhar_number'] ?? '';

if (!$otp || !$aadhar_number) {
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
if (!isset($_SESSION['ssfi']['mobile_no'], $_SESSION['ssfi']['otp'])) {
    echo json_encode(["status" => "error", "message" => "Session expired or invalid"]);
    exit;
}

// Validate OTP and email
if ($_SESSION['ssfi']['mobile_no'] === $mobile_no && $_SESSION['ssfi']['otp'] == $otp) {

    // Unset OTP after verification for security
    unset($_SESSION['ssfi']['otp']);

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
        $stmt = $pdo->prepare("SELECT st.*,d.district_name,s.state_name FROM tbl_user st 
        left join tbl_states s on s.id=st.state_id 
        left join tbl_districts d on d.id=st.district_id WHERE st.aadhar_number = ?");
        $stmt->execute([$aadhar_number]);
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        $skattor_info = $results;


        if ($results) {
            $skater_registered = 1;
            $skater_id = $results['id'];
        }

        // Fetch Skater Payment Status
        $stmt = $pdo->prepare("SELECT order_id, payment_id FROM tbl_session_renewal WHERE skater_id = ? AND session_id = ?");
        $stmt->execute([$skater_id, $session_id]);
        $results_session = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($results_session) {
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
                "message" => "Your Annual Sec Registered Already Completed, Download Your Confirmation Certificate",
                "data" => $skattor_info,
                "type" => 1
            ]);
        } elseif ($skater_registered == 1 && $skater_payment_order == 0) {
            echo json_encode([
                "status" => "success",
                "message" => "Your Annual Sec Registered Already Completed, To activate your account, please make the required payment",
                "data" => $skattor_info,
                "type" => 2
            ]);
        }  elseif ($skater_registered == 1 && $skater_payment == 0) {
            echo json_encode([
                "status" => "success",
                "message" => "Your Annual Sec Registered Already Completed,To Activate Account Completed the Payment",
                "data" => $skattor_info,
                "type" => 3
            ]);
        } else {
            echo json_encode([
                "status" => "success",
                "message" => "Sec  Not Registered Go for Register",
                "data" => $skattor_info,
                "type" => 4
            ]);
        }
    } catch (PDOException $e) {
        error_log("Database Query Error: " . $e->getMessage());
        echo json_encode(["status" => "error", "message" => "Database error occurred"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid OTP...".$_SESSION['ssfi']['otp'].$_SESSION['ssfi']['mobile_no']]);
}
?>

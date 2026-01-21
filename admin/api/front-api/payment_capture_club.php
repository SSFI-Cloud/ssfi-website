<?php
header("Content-Type: application/json");
include '../../config/config.php'; // Adjust this path if necessary

// Capture JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["status" => "error", "message" => "Invalid Request"]);
    exit;
}

if (isset($data['razorpay_payment_id']) && isset($data['razorpay_order_id'])) {
    $payment_id = $data['razorpay_payment_id'];
    $amount = $data['amount'] * 100;
    
    // Check if the payment already exists in the database
    $stmt = $pdo->prepare("SELECT * FROM payments WHERE payment_id = ?");
    $stmt->execute([$payment_id]);
    $existing_payment = $stmt->fetch(PDO::FETCH_ASSOC);
    
    

    if ($existing_payment) {
        echo json_encode(["status" => "success", "message" => "Payment already recorded", "payment_id" => $payment_id]);
        exit;
    }

    // Fetch payment details from Razorpay API
    $payment_check_url = "https://api.razorpay.com/v1/payments/$payment_id";
    $ch = curl_init($payment_check_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, $Razorpay_api_key . ":" . $Razorpay_api_secret);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);

    $response = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $payment_response = json_decode($response, true);

    if ($http_status === 200 && isset($payment_response['status'])) {
        if ($payment_response['status'] == "captured") {
            // Insert the already captured payment
            $stmt = $pdo->prepare("INSERT INTO payments (order_id, payment_id, signature, status, amount) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([
                $data['razorpay_order_id'],
                $data['razorpay_payment_id'],
                $data['razorpay_signature'] ?? null,
                $payment_response['status'],
                $payment_response['amount']/100
            ]);
            
            
            ///
            $stmt = $pdo->prepare("UPDATE tbl_session_renewal 
                    SET payment_id = ?, payment_status = ? WHERE order_id = ?");
                $stmt->execute([
                    $data['razorpay_payment_id'],
                    $payment_response['status'],
                    $data['razorpay_order_id']
                ]);
                
     
                // Prepare the SQL statement
$stmt = $pdo->prepare("SELECT club_id FROM tbl_session_renewal WHERE payment_id = :payment_id");

// Execute the query with the parameter
$stmt->execute([':payment_id' => $data['razorpay_payment_id']]);

// Fetch the skater_id
$club_id = $stmt->fetchColumn();

                
            $stmt = $pdo->prepare("SELECT c.*,d.district_name,s.state_name FROM tbl_clubs c 
            left join tbl_states s on s.id=c.state_id 
            left join tbl_districts d on d.id=c.district_id WHERE c.id = ?");
                    $stmt->execute([$club_id]);
                    $results = $stmt->fetch(PDO::FETCH_ASSOC);
                    $club_info = $results;        
                
                
                
                
            
            

            echo json_encode(["status" => "success", "message" => "Your payment has been successfully completed. Once your profile is approved by SSFI, a confirmation message will be sent to you via WhatsApp.", "payment_id" => $payment_id,"data" => $club_info]);
        } else {
            // Attempt to capture the payment
            $capture_url = "https://api.razorpay.com/v1/payments/$payment_id/capture";
            $ch = curl_init($capture_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERPWD, $api_key . ":" . $api_secret);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["amount" => $amount, "currency" => "INR"]));
            curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);

            $capture_response = curl_exec($ch);
            $capture_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            $capture_result = json_decode($capture_response, true);

            if ($capture_status === 200 && isset($capture_result['status']) && $capture_result['status'] == "captured") {
                // Store captured payment details
                $stmt = $pdo->prepare("INSERT INTO payments (order_id, payment_id, signature, status, amount) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([
                    $data['razorpay_order_id'],
                    $data['razorpay_payment_id'],
                    $data['razorpay_signature'] ?? null,
                    $capture_result['status'],
                    $capture_result['amount']/100
                ]);
                
                
                
                ///
                $stmt = $pdo->prepare("UPDATE tbl_session_renewal 
                    SET payment_id = ?, payment_status = ?
                    WHERE order_id = ?");
                $stmt->execute([
                    $data['razorpay_payment_id'],
                    $capture_result['status'],
                    $data['razorpay_order_id']
                ]);
                
// Prepare the SQL statement
$stmt = $pdo->prepare("SELECT club_id FROM tbl_session_renewal WHERE payment_id = :payment_id");

// Execute the query with the parameter
$stmt->execute([':payment_id' => $data['razorpay_payment_id']]);

// Fetch the skater_id
$club_id = $stmt->fetchColumn();

            $stmt = $pdo->prepare("SELECT c.*,d.district_name,s.state_name FROM tbl_clubs c 
            left join tbl_states s on s.id=c.state_id 
            left join tbl_districts d on d.id=c.district_id WHERE c.id = ?");
                    $stmt->execute([$club_id]);
                    $results = $stmt->fetch(PDO::FETCH_ASSOC);
                    $club_info = $results; 
                    
                    
                    


                echo json_encode(["status" => "success", "message" => "Your Payment has Been Successfully Completed", "payment_id" => $payment_id,"data" => $club_info]);
            } else {
                echo json_encode(["status" => "error", "message" => "Payment capture failed", "razorpay_response" => $capture_result]);
            }
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to fetch payment details", "razorpay_response" => $payment_response]);
    }
} elseif (isset($data['status']) && $data['status'] === "failed") {
    // Handle payment failure using PDO
    $stmt = $pdo->prepare("INSERT INTO payment_failures (reason, code, source, step) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $data['reason'],
        $data['code'],
        $data['source'],
        $data['step']
    ]);

    echo json_encode(["status" => "failed", "message" => "Payment Failed", "reason" => $data['reason']]);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid Data Received"]);
}

$pdo = null; // Close the database connection
?>

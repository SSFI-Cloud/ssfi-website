<?php
header("Content-Type: application/json");
include '../../config/config.php'; // Adjust this path if necessary

$Razorpay_api_secret='bC7hjMrTn61YSi7BzzaaJxFd'; // tnssa
$Razorpay_api_key='rzp_live_RIb0oARWG5CcDw';


$api_secret=$Razorpay_api_secret; // tnssa
$api_key=$Razorpay_api_key;

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
            
            $stmt = $pdo->prepare("UPDATE tbl_event_registration SET payment_id = ? WHERE order_id = ?");
            $stmt->execute([$data['razorpay_payment_id'],$data['razorpay_order_id']]);
                
            // Prepare the SQL statement
            $stmt = $pdo->prepare("SELECT skater_id FROM tbl_event_registration WHERE payment_id = :payment_id limit 1");
            $stmt->execute([':payment_id' => $data['razorpay_payment_id']]);
            $skater_id = $stmt->fetchColumn();
            
            $stmt = $pdo->prepare("SELECT event_id FROM tbl_event_registration WHERE payment_id = :payment_id limit 1");
            $stmt->execute([':payment_id' => $data['razorpay_payment_id']]);
            $event_id = $stmt->fetchColumn();
            
            
            
        // Fetch Active Session ID
        $stmt = $pdo->prepare("SELECT id FROM tbl_session WHERE is_active = 1 ORDER BY id DESC limit 1");
        $stmt->execute();
        $session_id = $stmt->fetchColumn();

        // Fetch Skater Info
        $stmt = $pdo->prepare("SELECT st.*,d.district_name,s.state_name,c.club_name,ct.cat_name FROM tbl_skaters st 
        left join tbl_states s on s.id=st.state_id 
        left join tbl_clubs c on c.id=st.club_id 
        left join tbl_category_type ct on ct.id=st.category_type_id 
        left join tbl_districts d on d.id=st.district_id WHERE st.id = ?");
        $stmt->execute([$skater_id]);
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $stmt = $pdo->prepare("SELECT * FROM `tbl_session_renewal` WHERE skater_id=? and session_id=?");
        $stmt->execute([$results['id'],$session_id]);
        $session_results = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $stmt = $pdo->prepare("SELECT * FROM `tbl_events` WHERE id=?");
        $stmt->execute([$event_id]);
        $e_results = $stmt->fetch(PDO::FETCH_ASSOC);
        
        //$stmt = $pdo->prepare("SELECT * FROM `tbl_event_registration` WHERE skater_id=? and event_id=? and session_id=?");
        $stmt = $pdo->prepare("SELECT eel.event_level FROM `tbl_event_registration` er LEFT JOIN tbl_eligible_event_level eel on er.eligible_event_level_id=eel.id WHERE er.skater_id=? and er.event_id=? and er.session_id=?");
        $stmt->execute([$results['id'],$event_id,$session_id]);
        $event_results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $results['level_category']=$session_results['age_category'];
        $results['age']=$session_results['age'];
        $results['event_id']=$event_id;
        $results['session_id']=$e_results['session_id'];
        $results['event_level_type_id']=$e_results['event_level_type_id'];
                
        $levels="";
                foreach($event_results as $rfd){
                    $levels .="--".$rfd['event_level'];
                }
                $results['levels']=$levels;        
            

            echo json_encode(["status" => "success", "message" => "Your Payment has Been Successfully Completed.", "payment_id" => $payment_id,"data" => $results]);
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
                
                
                
            $stmt = $pdo->prepare("UPDATE tbl_event_registration SET payment_id = ? WHERE order_id = ?");
            $stmt->execute([$data['razorpay_payment_id'],$data['razorpay_order_id']]);
                
            // Prepare the SQL statement
            $stmt = $pdo->prepare("SELECT skater_id FROM tbl_event_registration WHERE payment_id = :payment_id limit 1");
            $stmt->execute([':payment_id' => $data['razorpay_payment_id']]);
            $skater_id = $stmt->fetchColumn();
            
            $stmt = $pdo->prepare("SELECT event_id FROM tbl_event_registration WHERE payment_id = :payment_id limit 1");
            $stmt->execute([':payment_id' => $data['razorpay_payment_id']]);
            $event_id = $stmt->fetchColumn();
            
                // Fetch Active Session ID
                $stmt = $pdo->prepare("SELECT id FROM tbl_session WHERE is_active = 1 ORDER BY id DESC limit 1");
                $stmt->execute();
                $session_id = $stmt->fetchColumn();
        
                // Fetch Skater Info
                $stmt = $pdo->prepare("SELECT st.*,d.district_name,s.state_name,c.club_name,ct.cat_name FROM tbl_skaters st 
                left join tbl_states s on s.id=st.state_id 
                left join tbl_clubs c on c.id=st.club_id 
                left join tbl_category_type ct on ct.id=st.category_type_id 
                left join tbl_districts d on d.id=st.district_id WHERE st.id = ?");
                $stmt->execute([$skater_id]);
                $results = $stmt->fetch(PDO::FETCH_ASSOC);
                
                $stmt = $pdo->prepare("SELECT * FROM `tbl_session_renewal` WHERE skater_id=? and session_id=?");
                $stmt->execute([$results['id'],$session_id]);
                $session_results = $stmt->fetch(PDO::FETCH_ASSOC);
                
                $stmt = $pdo->prepare("SELECT * FROM `tbl_events` WHERE id=?");
                $stmt->execute([$event_id]);
                $e_results = $stmt->fetch(PDO::FETCH_ASSOC);
                
                $stmt = $pdo->prepare("SELECT eel.event_level,event_id FROM `tbl_event_registration` er LEFT JOIN tbl_eligible_event_level eel on er.eligible_event_level_id=eel.id WHERE er.skater_id=? and er.event_id=? and er.session_id=?");
               // $stmt = $pdo->prepare("SELECT * FROM `tbl_event_registration` WHERE skater_id=? and event_id=? and session_id=?");
                $stmt->execute([$results['id'],$event_id,$session_id]);
                $event_results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $results['level_category']=$session_results['age_category'];
                $results['age']=$session_results['age'];
                $results['event_id']=$event_id;
                $results['session_id']=$e_results['session_id'];
                $results['event_level_type_id']=$e_results['event_level_type_id'];
                
                $levels="";
                foreach($event_results as $rfd){
                    $levels .="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$rfd['event_level'];
                }
                $results['levels']=$levels;

                echo json_encode(["status" => "success", "message" => "Your Payment has Been Successfully Completed", "payment_id" => $payment_id,"data" => $results]);
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

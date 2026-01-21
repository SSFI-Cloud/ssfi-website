<?php
header("Content-Type: application/json");
include '../../config/config.php'; // Adjust this path if necessary

$Razorpay_api_secret='bC7hjMrTn61YSi7BzzaaJxFd'; // tnssa
$Razorpay_api_key='rzp_live_RIb0oARWG5CcDw';

$api_key=$Razorpay_api_key;
$api_secret=$Razorpay_api_secret;
$payment_id='pay_RjsciXZAgLvS5G';
$amount=1*100;


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

            echo $capture_result = json_decode($capture_response, true);
            
            print_r($capture_result);
            
            ?>
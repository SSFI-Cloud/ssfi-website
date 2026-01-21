<?php
// include '../config/config.php'; 
$host = 'localhost';
$dbname = 'ssfibharat_dashboard';
$username = 'ssfibharat_dashboard';
$password = 'ssfibharat_dashboard';

// Set up a PDO connection 

// Define global variable for database connection
global $pdo;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get current SQL mode
    $stmt = $pdo->query("SELECT @@sql_mode");
    $currentModes = $stmt->fetchColumn();
    $modesArray = explode(',', $currentModes);

    // Remove ONLY_FULL_GROUP_BY if present
    $newModesArray = array_diff($modesArray, ['ONLY_FULL_GROUP_BY']);
    $newModeString = implode(',', $newModesArray);

    // Set the new SQL mode
    $pdo->exec("SET sql_mode = '$newModeString'");
    
    
    
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}


$order_id = "order_QzgTzV4mXVuAOw"; // Replace with actual Razorpay order ID
$key_id = "rzp_live_R3m4Iq0cnItOxJ";
$key_secret = "d1BWaxbvSYCVEX6fMc4EwEmE";


$key_secret='bC7hjMrTn61YSi7BzzaaJxFd'; // tnssa
$key_id='rzp_live_RIb0oARWG5CcDw';


// error_log(" key_secret = ".$key_secret);
    $sql = "SELECT * FROM `tbl_session_renewal`  WHERE skater_id!=0 and (payment_id is null or payment_id='');";
    $stmt = $pdo->prepare($sql);
    // Execute the query  
    $stmt->execute();

    // Fetch the user data
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($user as $u){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.razorpay.com/v1/orders/".$u['order_id']."/payments");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERPWD, "$key_id:$key_secret");

$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

// Check if payment is done
if (!empty($data['items'])) {
    $count_of=0;
    foreach ($data['items'] as $payment) {
        
        if ($payment['status'] == 'captured') {
            echo "<br>✅ Payment done. Payment ID: " . $payment['id'];
            
        $stmt = $pdo->prepare("UPDATE tbl_session_renewal SET payment_id='".$payment['id']."',payment_status='captured', updated_at = NOW() WHERE order_id='".$u['order_id']."'");
        $stmt->execute();
        

        } else {
            
            echo "<br>".$u['order_id']."❌ Payment not completed. Status: " . $payment['status'];
            
        }
        
    }
    error_log('done-order-id'.$count_of);
} else {
    echo "<br>❌ No payment found for this order ID.";
    error_log('no payment');
    
}

}
?>
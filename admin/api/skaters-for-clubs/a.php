<?php
 
include '../../config/config.php';



$stmt = $pdo->prepare("SELECT s.id,s.membership_id,sr.skater_id,sr.age,sr.age_category,s.date_of_birth FROM `tbl_skaters` s LEFT join tbl_session_renewal sr on s.id=sr.skater_id WHERE (sr.age_category is null or sr.age_category='' or sr.age='' or sr.age=0)");
$stmt->execute();
$results_session = $stmt->fetchAll(PDO::FETCH_ASSOC);
$endDate = new DateTime('2025-01-01');

foreach($results_session as $postData){
    $dob = new DateTime($postData['date_of_birth']);
    $age = $dob->diff($endDate)->y; // calculate age as of 01-01-2025

    // Determine age category
    if ($age < 4) {
        $category = 'Under 4';
    } elseif ($age < 6) {
        $category = 'Under 6';
    }elseif ($age < 8) {
        $category = 'Under 8';
    }elseif ($age < 10) {
        $category = 'Under 10';
    }elseif ($age < 12) {
        $category = 'Under 12';
    }elseif ($age < 14) {
        $category = 'Under 14';
    } elseif ($age < 16) {
        $category = 'Under 16';
    } else {
        $category = 'Above 16';
    }

    echo "<br>".$postData['membership_id']." DOB: ".$postData['date_of_birth']." | Age: $age | Category: $category";
    
    $session_id=4;$skater_id=$postData['id'];
    $stmt = $pdo->prepare("UPDATE tbl_session_renewal SET age = :age, age_category = :age_category WHERE skater_id = :skater_id AND session_id = :session_id");
    $stmt->execute([
        ':age' => $age,
        ':age_category' => $category,
        ':skater_id' => $skater_id,
        ':session_id' => $session_id
    ]);
}







//         $stmt = $pdo->prepare("SELECT s.* FROM `tbl_skaters` s LEFT join tbl_session_renewal sr on s.id=sr.skater_id WHERE sr.id is null");
//         $stmt->execute();
//         $results_session = $stmt->fetchAll(PDO::FETCH_ASSOC);
// foreach($results_session as $postData){
//         $stmt = $pdo->query("SELECT skater_fees FROM tbl_fees");
//         $fees = $stmt->fetchColumn();
        
//         $stmt = $pdo->query("SELECT * FROM tbl_skaters where id=".$postData['id']);
//         $resul = $stmt->fetch(PDO::FETCH_ASSOC);
//         $postData = $resul;
        
        
//         $membership_id=$postData['membership_id'];
        
//         /*Payment Order Id Create*/
//         $order_data = [
//             "amount" => $fees*100,  // ₹10.00 in paise
//             "currency" => "INR",
//             "receipt" => $membership_id,
//           // "payment_capture" => 1, // Auto capture
//             "notes" => [  // Custom Parameters
//                 "member_id" => $membership_id,
//                 "email_id" => $postData['email_address'],
//                 "full_name" => $postData['full_name'],
//                 "father_name" => $postData['father_name'],
//                 "mobile_number" => $postData['mobile_number'],
//                 "date_of_birth" => $postData['date_of_birth'],
//                 "category_type_id" => $postData['category_type_id'],
//                 "gender" => $postData['gender'],
//                 "blood_group" => $postData['blood_group'],
//                 "aadhar_number" => $postData['aadhar_number'],
//                 "club_id" => $postData['club_id'],
//                 "state_id" => $postData['state_id'],
//                 "district_id" => $postData['district_id'],
//                 "register_type" => "Skater Annual Register-2025"
//             ]
//         ];
        
//         $ch = curl_init("https://api.razorpay.com/v1/orders");
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//         curl_setopt($ch, CURLOPT_USERPWD, "$Razorpay_api_key:$Razorpay_api_secret");
//         curl_setopt($ch, CURLOPT_POST, true);
//         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($order_data));
//         curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        
//         $response = curl_exec($ch);
        
//         $order_response = json_decode($response, true);
//         curl_close($ch);
//         $order_id='';
//         if (isset($order_response['id'])) {
//           // echo json_encode($order_response); // Send order_id to frontend
//             $order_id=$order_response['id'];
            
            
//                 $stmt = $pdo->prepare("INSERT INTO tbl_session_renewal (order_id, payment_id, payment_status, session_id, skater_id,age,age_category) VALUES (?, ?, ?, ?, ?,?,?)");
//                 $stmt->execute([
//                     $order_id,
//                     '',
//                     '',
//                     $session_id ?? 0, // Make sure to define $session_id
//                     $postData['id'],   // Make sure to define $skater_id
//                     0,
//                     0
                
//                 ]);
            
//         }
// }

?>
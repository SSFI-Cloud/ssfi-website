<?php
error_reporting(E_ALL);
ini_set("display_errors",1);

include '../../../admin/config/config.php';

$skater_id = $_POST['skater_id']!="" ? $_POST['skater_id'] : 0;
$event_level_type_id = $_POST['event_level_type_id']!="" ? $_POST['event_level_type_id'] : 0;
$event_id = $_POST['event_id']!="" ? $_POST['event_id'] : 0;
$eligible_event_level_id = isset($_POST['state_event_level_type_id']) && $_POST['state_event_level_type_id'] != "" 
    ? explode(',', $_POST['state_event_level_type_id']) 
    : [];

$stmt = $pdo->prepare("SELECT * FROM `tbl_events` WHERE id=?");
$stmt->execute([$event_id]);
$e_results = $stmt->fetch(PDO::FETCH_ASSOC);
$session_id= $e_results['session_id'];

//$stmt = $pdo->prepare("SELECT * FROM `tbl_event_registration` WHERE skater_id = ? and event_level_type_id=? and event_id=? and session_id=?");
 $stmt = $pdo->prepare("SELECT eel.event_level,er.* FROM `tbl_event_registration` er LEFT JOIN tbl_eligible_event_level eel on er.eligible_event_level_id=eel.id 
 WHERE er.skater_id=? and er.event_level_type_id=? and er.event_id=? and er.session_id=?");
$stmt->execute([$skater_id,$event_level_type_id,$event_id,$e_results['session_id']]);

//error_log("Ganena:".$skater_id."-".$event_level_type_id."-".$event_id."-".$e_results['session_id']);

$_results = $stmt->fetchAll(PDO::FETCH_ASSOC);
if($_results){
    $ss="pay_completed";
    // if($_results[0]['payment_id']==""){ $ss="success"; } 
        $stmt = $pdo->prepare("SELECT st.*,d.district_name,s.state_name,c.club_name,ct.cat_name FROM tbl_skaters st 
        left join tbl_states s on s.id=st.state_id 
        left join tbl_clubs c on c.id=st.club_id 
        left join tbl_category_type ct on ct.id=st.category_type_id 
        left join tbl_districts d on d.id=st.district_id WHERE st.id = ?");
        $stmt->execute([$skater_id]);
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        $skattor_info = $results;
        
        $fees =$e_results['event_fees'] ?? 1;
            $stmt = $pdo->prepare("SELECT * FROM `tbl_session_renewal` WHERE skater_id=? and session_id=?");
            $stmt->execute([$results['id'],$session_id]);
            $session_results = $stmt->fetch(PDO::FETCH_ASSOC);
            
            //error_log($results['id'],$session_id);
                $results['level_category']=$session_results['age_category'];
                $results['age']=$session_results['age'];
                $results['event_id']=$event_id;
                $results['session_id']=$e_results['session_id'];
                $results['event_level_type_id']=$e_results['event_level_type_id'];
                
                $levels="";
                foreach($_results as $rfd){
                    $levels .="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$rfd['event_level'];
                }
                $results['levels']=$levels;
                
                
  
        echo json_encode(["status" => $ss,"data"=>$results, "message" => "success", "membership_id" => $skattor_info['membership_id'],"order_id"=>$_results[0]['order_id'],"amount"=>$fees,'razorpay_api_secret'=>$Razorpay_api_secret]);
        exit;
}




$stmt = $pdo->prepare("SELECT st.*,d.district_name,s.state_name,c.club_name,ct.cat_name FROM tbl_skaters st 
left join tbl_states s on s.id=st.state_id 
left join tbl_clubs c on c.id=st.club_id 
left join tbl_category_type ct on ct.id=st.category_type_id 
left join tbl_districts d on d.id=st.district_id WHERE st.id = ?");
$stmt->execute([$skater_id]);
$results = $stmt->fetch(PDO::FETCH_ASSOC);
$skattor_info = $results;

$fees =$e_results['event_fees'] ?? 1;

$receipt = $event_id."Event - ".$skattor_info['membership_id'];

try{
  $pdo->beginTransaction();  
        $s='INSERT INTO `tbl_event_registration`(`skater_id`,`event_level_type_id`,`event_id`,`eligible_event_level_id`,session_id,order_id,payment_id) VALUES ';
        for($i=0;$i<count($eligible_event_level_id);$i++){
            $sq[]="('".$skater_id."','".$event_level_type_id."','".$event_id."','".$eligible_event_level_id[$i]."','".$e_results['session_id']."','manual-entry','manual-entry')";
        }
        $s.= implode(',', $sq);
        //error_log($s);
		$statement = $pdo->prepare($s);
        $result=$statement->execute();
        
            $stmt = $pdo->prepare("SELECT * FROM `tbl_session_renewal` WHERE skater_id=? and session_id=?");
            $stmt->execute([$results['id'],$session_id]);
            $session_results = $stmt->fetch(PDO::FETCH_ASSOC);
            
        
         /*Payment Order Id Create*/
        $order_data = [
            "amount" => $fees*100,  // ₹10.00 in paise
            "currency" => "INR",
            "receipt" => $receipt,
          // "payment_capture" => 1, // Auto capture
            "notes" => [  // Custom Parameters
                "user_id" => $skattor_info['membership_id'] ?? 0,
                "email" => $skattor_info['email_address'],
                "product" => $e_results['event_name']." Event Register..."
            ]
        ];
        
        // $ch = curl_init("https://api.razorpay.com/v1/orders");
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_USERPWD, "$Razorpay_api_key:$Razorpay_api_secret");
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($order_data));
        // curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        
        // $response = curl_exec($ch);
        // $order_response = json_decode($response, true);
        // curl_close($ch);
        // error_log($response);
        
        // $order_id='';
        // if (isset($order_response['id'])) {
        //     $order_id=$order_response['id'];
        //         $stmt = $pdo->prepare("UPDATE tbl_event_registration SET order_id = ? WHERE skater_id = ? and event_level_type_id=? and event_id=? and session_id=?");
        //         $stmt->execute([$order_id,$skater_id,$event_level_type_id,$event_id,$e_results['session_id']]);
        // }else{
        //     $pdo->rollBack();
        //     echo json_encode(["status" => "error", "message" => "Something Went Wrong Try Again...","event_status" =>"0"]);
        //     exit;
        // }
        
        
        
$stmt = $pdo->prepare("SELECT eel.event_level,er.* FROM `tbl_event_registration` er LEFT JOIN tbl_eligible_event_level eel on er.eligible_event_level_id=eel.id 
 WHERE er.skater_id=? and er.event_level_type_id=? and er.event_id=? and er.session_id=?");
$stmt->execute([$skater_id,$event_level_type_id,$event_id,$e_results['session_id']]);
$_results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                $results['level_category']=$session_results['age_category'];
                $results['age']=$session_results['age'];
                $results['event_id']=$event_id;
                $results['session_id']=$e_results['session_id'];
                $results['event_level_type_id']=$e_results['event_level_type_id'];
                
                $levels="";
                foreach($_results as $rfd){
                    $levels .="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$rfd['event_level'];
                }
                $results['levels']=$levels;
        
        
        
        $pdo->commit();
        echo json_encode(["status" => 'pay_completed',"data"=>$results, "message" => "Success", "membership_id" => $skattor_info['membership_id'],"order_id"=>'manual-entry',"amount"=>$fees,'razorpay_api_secret'=>$Razorpay_api_secret]);
           
}catch (PDOException $e) {
    $pdo->rollBack();
    error_log("Database Query Error: " . $e->getMessage());
    echo json_encode(["status" => "error", "message" => "Database error occurred".$e,"event_status" =>"0"]);
}


?>
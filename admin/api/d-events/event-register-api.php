<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
include '../../config/config.php'; // Ensure correct path

$skater_id = $_POST['skater_id']!="" ? $_POST['skater_id'] : 0;
$event_level_type_id = $_POST['event_level_type_id']!="" ? $_POST['event_level_type_id'] : 0;
$event_id = $_POST['event_id']!="" ? $_POST['event_id'] : 0;
$eligible_event_level_id = $_POST['eligible_event_level_id']!="" ? $_POST['eligible_event_level_id'] : []; // events ids

$stmt = $pdo->prepare("SELECT * FROM `tbl_events` WHERE id=?");
$stmt->execute([$event_id]);
$e_results = $stmt->fetch(PDO::FETCH_ASSOC);
$session_id= $e_results['session_id'];

 $stmt = $pdo->prepare("SELECT eel.event_level,er.* FROM `tbl_event_registration` er LEFT JOIN tbl_eligible_event_level eel on er.eligible_event_level_id=eel.id 
 WHERE er.skater_id=? and er.event_level_type_id=? and er.event_id=? and er.session_id=?");
$stmt->execute([$skater_id,$event_level_type_id,$event_id,$e_results['session_id']]);
$_results = $stmt->fetchAll(PDO::FETCH_ASSOC);


$stmt = $pdo->prepare("SELECT st.*,d.district_name,s.state_name,c.club_name,ct.cat_name FROM tbl_skaters st 
left join tbl_states s on s.id=st.state_id 
left join tbl_clubs c on c.id=st.club_id 
left join tbl_category_type ct on ct.id=st.category_type_id 
left join tbl_districts d on d.id=st.district_id WHERE st.id = ?");
$stmt->execute([$skater_id]);
$results = $stmt->fetch(PDO::FETCH_ASSOC);
$skattor_info = $results;

$fees =$e_results['event_fees'] ?? 1;



try{
  $pdo->beginTransaction(); 
  $order_id = 'NA';
  $payment_id = 'NA';
        if($_results){
            $logFilename = "log/".$skater_id.".txt";
            //$logFile = fopen($logFilename, "a"); // Append mode
            foreach ($_results as $row) {
                $order_id = $row['order_id'];
                $payment_id = $row['payment_id'];
                $deleted_id = $row['id'];
                
                $logEntry = "Deleted Record (ID: $deleted_id): " . json_encode($row) . "\n";
                error_log($logEntry);
                //fwrite($logFile, $logEntry);
        
        
                // Delete the record
                $deleteStmt = $pdo->prepare("DELETE FROM tbl_event_registration WHERE id = ?");
                $deleteStmt->execute([$row['id']]);
            }
            //fclose($logFile); // Close the file
        }
  
  
  
        $s='INSERT INTO `tbl_event_registration`(`skater_id`,`event_level_type_id`,`event_id`,`eligible_event_level_id`,session_id,order_id,payment_id) VALUES ';
        for($i=0;$i<count($eligible_event_level_id);$i++){
            $sq[]="('".$skater_id."','".$event_level_type_id."','".$event_id."','".$eligible_event_level_id[$i]."','".$e_results['session_id']."','".$order_id."','".$payment_id."')";
        }
        $s.= implode(',', $sq);
		$statement = $pdo->prepare($s);
        $result=$statement->execute();
        
    $pdo->commit();
    echo json_encode(["data"=>$results,"status" => 'success', "message" => "To Complete Event Registration, Kindly make the Payment Offline", "membership_id" => $skattor_info['membership_id'],"order_id"=>$order_id,"amount"=>$fees,'razorpay_api_secret'=>$Razorpay_api_secret]);
           
}catch (PDOException $e) {
    $pdo->rollBack();
    error_log("Database Query Error: " . $e->getMessage());
    echo json_encode(["status" => "error", "message" => "Database error occurred".$e,"event_status" =>"0"]);
}


?>
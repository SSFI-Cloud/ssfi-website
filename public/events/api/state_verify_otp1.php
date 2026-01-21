<?php


session_start();
header('Content-Type: application/json');
include('../../admin/config/config.php');

$mobile_no = $_POST['mobile_no'] ?? '';
$email = $_POST['email'] ?? '';
$otp = $_POST['otp'] ?? '';
$member_id = $_POST['member_id'] ?? '';
$event_id = 12;

if (!$otp || !$member_id) {
    echo json_encode(["status" => "error", "message" => "Missing required parameters"]);
    exit;
}

// Check if database connection is established
if (!isset($pdo)) {
    error_log("Database connection failed!");
    echo json_encode(["status" => "error", "message" => "Database connection failed"]);
    exit;
}
if ($_SESSION['ssfi_event']['mobile_no'] === $mobile_no && $_SESSION['ssfi_event']['otp'] == $otp) {
    unset($_SESSION['ssfi_event']['otp']);
    try {
        // Fetch Active Session ID
        $stmt = $pdo->prepare("SELECT id FROM tbl_session WHERE is_active = 1 ORDER BY id DESC limit 1");
        $stmt->execute();
        $session_id = $stmt->fetchColumn();
        
        // Fetch Skater Info
        $stmt = $pdo->prepare("SELECT 
GROUP_CONCAT(er.eligible_event_level_id ORDER BY er.event_level_type_id SEPARATOR ',') as event_level_type_ids,
GROUP_CONCAT(eel.event_level ORDER BY eel.event_level SEPARATOR ',') as event_levels,
er.eligible_event_level_id,eel.event_level,st.*,d.district_name,s.state_name,c.club_name,ct.cat_name
FROM tbl_skaters st 
        left join tbl_states s on s.id=st.state_id 
        left join tbl_clubs c on c.id=st.club_id 
        left join tbl_category_type ct on ct.id=st.category_type_id 
        left join tbl_districts d on d.id=st.district_id 
        LEFT JOIN tbl_event_registration er on er.skater_id=st.id
        LEFT JOIN tbl_eligible_event_level eel on eel.id=er.eligible_event_level_id
        WHERE st.membership_id = ?");
        // $stmt = $pdo->prepare("SELECT st.*,d.district_name,s.state_name,c.club_name,ct.cat_name FROM tbl_skaters st 
        // left join tbl_states s on s.id=st.state_id 
        // left join tbl_clubs c on c.id=st.club_id 
        // left join tbl_category_type ct on ct.id=st.category_type_id 
        // left join tbl_districts d on d.id=st.district_id 
        // WHERE st.membership_id = ?");
        $stmt->execute([$member_id]);
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        $skattor_info = $results;

        if ($results) {
            $stmt = $pdo->prepare("SELECT * FROM `tbl_session_renewal` WHERE skater_id=? and session_id=?");
            $stmt->execute([$results['id'],$session_id]);
            $session_results = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $stmt = $pdo->prepare("SELECT * FROM `tbl_events` WHERE id=?");
            $stmt->execute([$event_id]);
            $e_results = $stmt->fetch(PDO::FETCH_ASSOC);
            
            
            if($results['state_id']!=$e_results['state_id']){
                echo json_encode(["status" => "error", "message" => "Your Trying to Register in Another State, Which is Not Allowed...","event_status" =>"0"]);
                exit;
            }
            
            $update = $pdo->prepare("UPDATE tbl_event_registration 
                         SET payment_id = 'manual-entry' 
                         WHERE session_id = :session_id 
                           AND skater_id = :skater_id 
                           AND event_id = :event_id");

                $update->execute([
                    ':session_id' => $session_id,
                    ':skater_id' => $results['id'],
                    ':event_id' => $event_id
                ]);
            
            
            
            
            if($session_results && $session_results['payment_id']!="" && $session_results['payment_id']!=null){
                $stmt = $pdo->prepare("SELECT eel.event_level,er.* FROM `tbl_event_registration` er LEFT JOIN tbl_eligible_event_level eel on er.eligible_event_level_id=eel.id WHERE er.skater_id=? and er.event_id=? and er.session_id=?");
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
                
                
                
                if(!$event_results){
                    echo json_encode(["status" => "success", "message" => "Register Your Events Levels","event_status" =>"1","data"=>$results]);
                }else if($event_results && $event_results[0]['order_id']==""){
                    echo json_encode(["status" => "success", "message" => "Event Register Already Done..Need Generate Order Id","event_status" =>"2","data"=>$results]);
                }else if($event_results && $event_results[0]['payment_id']==""){
                    echo json_encode(["status" => "success", "message" => "Event Register Already Done..Need Make Payment","event_status" =>"3","data"=>$results]);
                }else{
                    echo json_encode(["status" => "success", "message" => "Event Register Already Done,Download Your Event Confirmation Certificate...","event_status" =>"4","data"=>$results]);
                }
            }else{
                echo json_encode(["status" => "error", "message" => "Payment Not yet Done for Skater Registration Complete the Payment...","event_status" =>"0"]);
            }
        }else{
            echo json_encode(["status" => "error", "message" => "Invalid Member Id...","event_status" =>"0"]);
        }
    } catch (PDOException $e) {
        error_log("Database Query Error: " . $e->getMessage());
        echo json_encode(["status" => "error", "message" => "Database error occurred".$e,"event_status" =>"0"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid CAPTCHA...","event_status" =>"0"]);
}
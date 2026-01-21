<?php
include ("../admin/config/config.php");


// print_r($id);
$id= $_GET['id'] ?? 0;
$event_id= $_GET['event_id'] ?? 0;
$statement = $pdo->prepare("SELECT sk.* ,sr.age_category,sr.payment_id as transaction_id,sr.age,p.amount as amounts,c.club_name,ct.cat_name,d.district_name,date(sr.updated_at) as paid_date
FROM tbl_skaters sk
LEFT JOIN tbl_session_renewal sr ON sk.id = sr.skater_id and sr.session_id=(SELECT id FROM tbl_session WHERE is_active = 1)
LEFT JOIN payments p ON p.order_id = sr.order_id
left join tbl_clubs c on c.id=sk.club_id
LEFT JOIN tbl_category_type ct on ct.id=sk.category_type_id
LEFT JOIN tbl_districts d on d.id=sk.district_id
WHERE sk.id = $id");
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);
$totalrow = $statement->rowCount();


$stmt12 = $pdo->prepare("SELECT * FROM `tbl_events` WHERE id=?");
$stmt12->execute([$event_id]);
$e_results12 = $stmt12->fetch(PDO::FETCH_ASSOC);  
$event_meet=$e_results12['event_level_type_id'];
$meet_level='';
if($event_meet==1){
    $meet_level='DISTRICT';
}
else if ($event_meet==2){
    $meet_level='STATE';
}
else{
    $meet_level='NATIONAL';
}

if($result){
    
    function getMyage($dob){
        // Get the current date
        $currentDate = date("Y-m-d");
        
        // Calculate the age using DateTime objects
        $dob = new DateTime($dob);
        $currentDate = new DateTime($currentDate);
        
        // Calculate the difference
        $age = $dob->diff($currentDate);
        $age_year = $age->y;
        return $age_year;
    }
    
    $download_name=  str_replace('/', '-', $result['membership_id']);;
    $date_of_birth = getMyage($result['date_of_birth']);
    $created_at = !empty($result['paid_date']) ? date("d-m-Y", strtotime($result['paid_date'])) : date("d-m-Y") ;
$htmldata='
<div style="border:1px solid gray;min-height:295mm;">
<table style="width:100%;">
    <tr>
        <td>
            
            <table style="text-align: center;">
                        <tbody>
                            <tr>
                            
                           <td><img src="https://ssfibharatskate.com/registers/image/logo.jpg" alt="SSFI" style="width:98%;"></td>
                            
                                    
                            </tr>
                        </tbody>
                    </table>
        </td>
        
        
        
       
       
    </tr>
    <tr>
        <td colspan="4" style="text-align:center; font-size:25px">
             SSFI '.$meet_level.' MEET EVENT  REGISTRATION 2025</b><br>
           
        </td>
    </tr>
</table>
<table style="width:100%;border-top:1px solid gray;">
    <tr>
        <td style="padding:2px 20px;width:50%;vertical-align:top;">
            <table style="width:100%;font-size:13px;">
                <tr>
                    <td style="width:40%;">Name</td><td>: '.$result['full_name'].'</td>
                </tr>
                <tr>
                    <td>Father Name</td><td>: '.$result['father_name'].'</td>
                </tr><tr>
                    <td>Date of Birth</td><td>:  '.date("d-m-Y", strtotime($result['date_of_birth'])).'</td>
                </tr>
                <tr>
                    <td style="vertical-align:top;">Club Name</td> <td>: '.$result['club_name'].'</td>
                </tr>
                <tr>
                    <td>Age & Gender</td><td>: '.$result['age'].' / '.$result['gender'].'</td>
                </tr>
                
                <tr>
                    <td>Blood Group</td><td>: '.$result['blood_group'].'</td>
                </tr>
                <tr>
                    <td>Phone & Email</td><td>:  '.$result['mobile_number'].' | '.$result['email_address'].'</td>
                </tr>
                <tr>
                    <td style="vertical-align:top;">Res. Address</td>
                    <td>: 
                        '.$result['residential_address'].'
                    </td>
                </tr>
            </table>
        </td>
        <td style="vertical-align:top;width:50%;">
            <table style="width:100%;font-size:13px;">
                <tr>
                    <td style="width:25%;" rowspan="5">
                        <img src="https://ssfibharatskate.com/admin/'.$result['profile_photo'].'" style="width:70px;">
                    </td>
                    <td style="width:25%;">Skater ID</td> <td >: '.$result['membership_id'].'</td>
                </tr>
                <tr>
                    <td >Age Group</td><td>: '.$result['age_category'].'</td>
                </tr>
                
                <tr>
                        <td>Category</td> <td>: '.$result['cat_name'].'</td>
                </tr>
                <tr>
                    <td>District</td> <td>: '.$result['district_name'].'</td>
                </tr>
   
   
                
                <tr>
                    <td>Register Date<br>&nbsp;</td> <td style="vertical-align:top;">: '.date("d-m-Y", strtotime($result['created_at'])).'</td>
                </tr>
                
                
                <tr>
                    <td colspan="3">**************<br>
                   EVENT REGISTRATION PAYMENT DETAILS:</td>
                </tr>'; 
                
            $stmt = $pdo->prepare("SELECT * FROM `tbl_events` WHERE id=?");
            $stmt->execute([$event_id]);
            $e_results = $stmt->fetch(PDO::FETCH_ASSOC);    
                
            $stmt = $pdo->prepare("SELECT eel.event_level,er.*,ty.cat_name FROM `tbl_event_registration` er LEFT JOIN tbl_eligible_event_level eel on er.eligible_event_level_id=eel.id left join tbl_category_type ty on ty.id=eel.category_type_id WHERE er.skater_id=? and er.event_id=? and er.session_id=?");
            $stmt->execute([$id,$event_id,$e_results['session_id']]);
            $event_results = $stmt->fetchAll(PDO::FETCH_ASSOC); 
                
                
            $stmt = $pdo->prepare("SELECT * FROM `payments` WHERE order_id=? and payment_id=? limit 1");
            $stmt->execute([$event_results[0]['order_id'],$event_results[0]['payment_id']]);
            $p_results = $stmt->fetch(PDO::FETCH_ASSOC);
                
                
                
                $created_ats = !empty($p_results['created_at']) ? date("d-m-Y h:i A", strtotime($result['created_at'])) : date("d-m-Y h:i A") ;
                
                if($event_results[0]['payment_id']=='' || $event_results[0]['payment_id']=='without payment'){
                    //$htmldata.='<tr><td>Transaction ID</td><td colspan="2">: Rs.'.$result['amounts'].'</td></tr>';
                }else{
                    $htmldata.=' <tr>
                    <td>Transaction ID</td><td colspan="2">: '.$event_results[0]['payment_id'].'</td>
                    </tr>';
                }
               $htmldata.=' <tr>
                    <td>Mode</td><td colspan="2">: Online Payment</td>
                </tr>
                <tr>
                    <td>Amount</td><td colspan="2">: '.$p_results['amount'].'</td>
                </tr>
                <tr>
                    <td>Date & Time</td><td colspan="2">: '.$created_ats.'</td>
                </tr>
                
                
                
                
                
                
                
            </table>
            
        </td>
    </tr>
    

</table>
<table style="width:100%;font-size:13px;padding:2px 20px;">
               
               <tr>
                    <td colspan="3">**************************<br>
                   EVENT REGISTRATION DETAILS:</td>
                </tr>'; 
                
              $levels="";
              $f=1;
                foreach($event_results as $rfd){
                    if($f==1){
                        $levels .="&nbsp;".$rfd['event_level'];
                    }else{
                        $levels .="<br>&nbsp;&nbsp;&nbsp;".$rfd['event_level'];
                    }
                    
                    
                    $f++;
                }  
                
                
                
                
            
               $htmldata.=' 
             
                
                  <tr>
                    <td>Event Name</td> <td>: '.$e_results['event_name'].'</td>
                </tr>
                                <tr>
                    <td>Event date</td> <td>: '.$e_results['event_date'].'</td>
                </tr>
                <tr>
                    <td>Event Place</td> <td>: '.$e_results['venue'].'</td>
                </tr>
                                <tr>
                    <td>Register Event Category:</td> <td>: '.$event_results[0]['cat_name'].'</td>
                </tr>
               <tr>
                    <td >Age Group</td><td>: '.$result['age_category'].'</td>
                </tr>
                <tr>
                    <td style="vertical-align:top;">Register Event Level:</td> <td>: '.$levels.'</td>
                </tr>

                
            </table>

</div>
<style>
@page { margin: 5mm; }
body { margin: 0px; }
</style>';
}else { $htmldata='<center>no data</center>';}


echo $htmldata;

?>
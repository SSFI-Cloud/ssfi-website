<?php 
include "config/config.php";

/*namespace Dompdf;
require_once 'pdf/autoload.inc.php';*/
ini_set('memory_limit', '-1');

$user_id=0;
if(isset($_GET)){
    $get_key=array_keys($_GET);
   $user_id= $get_key[0];
}
$meet_type=1;$download_name='';
        $statement = $pdo->prepare("SELECT *,(select city from tbl_district WHERE tbl_district.id=tbl_skaters.district) as district,(select organization from tbl_organization WHERE tbl_organization.id=tbl_skaters.clubname) as clubname FROM `tbl_skaters` WHERE id='".$user_id."'");
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		$totalrow = $statement->rowCount();
		
		$statement = $pdo->prepare("SELECT * FROM `tbl_events_level` WHERE event_type=3 and user_id='".$user_id."'");
        $statement->execute();
        $event_result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        $statement = $pdo->prepare("SELECT tbl_events_level.*,tbl_events_cat.cat_level,tbl_category_type.cat_name FROM `tbl_events_level` inner join tbl_events_cat on tbl_events_level.event_cat_id=tbl_events_cat.id inner JOIN tbl_category_type on tbl_events_cat.cat_type=tbl_category_type.id WHERE tbl_events_level.user_id='".$user_id."' and tbl_events_level.event_type=$meet_type");
        $statement->execute();
		$event_result_types = $statement->fetchAll(PDO::FETCH_ASSOC);

if($result && $event_result){
$download_name.=$result[0]['member_id'].'('.$result[0]['name'].')';
$htmldata='
<div style="border:1px solid gray;min-height:295mm;">
<table style="width:100%;">
    <tr>
        <td>
            <img src="https://tnssa.in/icons/logo/new-logo.png" style="max-width:350px;">
        </td>
        <td style="border-left:1px solid gray;padding-left:20px;">
            <img src="https://tnssa.in/icons/logo/clientlogo.png" style="max-width:70px;">
        </td>
        <td>
            <img src="https://tnssa.in/icons/logo/clientlogo1.png" style="max-width:70px;">
        </td>
        <td>
            <img src="https://tnssa.in/images/ssfi-logo.png" style="max-width:70px;">
        </td>
       
    </tr>
    <tr>
        <td colspan="4" style="text-align:center;">
            <b>24<sup>th</sup> NATIONAL SPEED SKATING CHAMPIONSHIP 2024-2025</b><br>
            INTERNATIONAL SELECTION MEET 2025 - NATIONAL MEET CONFIRMATION FORM
        </td>
    </tr>
</table>
<table style="width:100%;border-top:1px solid gray;">
    <tr>
        <td style="padding:2px 20px;width:50%;vertical-align:top;">
            <table style="width:100%;font-size:13px;">
                <tr>
                    <td style="width:30%;">Name</td><td>: '.$result[0]['name'].'</td>
                </tr>
                <tr>
                    <td>Father Name</td><td>: '.$result[0]['fname'].'</td>
                </tr><tr>
                    <td>Date of Birth</td><td>:  '.date("d-m-Y", strtotime($result[0]['dob'])).'</td>
                </tr>
                <tr>
                    <td style="vertical-align:top;">Club Name</td> <td>: '.$result[0]['clubname'].'</td>
                </tr>
                <tr>
                    <td>Age & Gender</td><td>: '.$result[0]['age'].' / '.$result[0]['gender'].'</td>
                </tr>
                
                <tr>
                    <td>Blood Group</td><td>: '.$result[0]['blgroup'].'</td>
                </tr>
                <tr>
                    <td>Phone & Email</td><td>:  '.$result[0]['mobile'].' | '.$result[0]['email'].'</td>
                </tr>
                <tr>
                    <td style="vertical-align:top;">Res. Address</td>
                    <td>: 
                        '.$result[0]['address'].'
                    </td>
                </tr>
                
            </table>
        </td>
        <td style="vertical-align:top;width:50%;">
            <table style="width:100%;font-size:13px;">
                <tr>
                    <td style="width:25%;" rowspan="5">
                        <img src="https://tnssa.in/registration/api/'.$result[0]['photo'].'" style="width:70px;">
                    </td>
                    <td style="width:25%;">Skater ID</td> <td >: '.$result[0]['member_id'].'</td>
                </tr>
                <tr>
                    <td >Age Group</td><td>: '.$result[0]['agecategory'].' (as on 01-01-2023)</td>
                </tr>
                
                <tr>
                    <td>Category</td> <td>: '.$result[0]['category'].'</td>
                </tr>
                <tr>
                    <td>District</td> <td>: '.$result[0]['district'].'</td>
                </tr>
   
   
                
                <tr>
                    <td>Register Date<br>&nbsp;</td> <td style="vertical-align:top;">: '.date("d-m-Y", strtotime($result[0]['created_at'])).'</td>
                </tr>
                <tr>
                    <td colspan="3">*****************************************************<br>
                    National Meet Event Registration Info:</td>
                </tr>';
                if($event_result[0]['paid_amount']!=0){
                    $htmldata.='<tr><td>Fee</td><td colspan="2">: Rs.'.$event_result[0]['paid_amount'].'/- for National Meet Participation</td></tr>';
                }else{
                    $htmldata.=' <tr>
                    <td>Fee</td><td colspan="2">: Rs.1250/- for National Meet Participation</td>
                    </tr>';
                }
                
                if($event_result[0]['transaction_id']=='' || $event_result[0]['transaction_id']=='without payment'){
                    $htmldata.='<tr><td>Transaction ID</td><td colspan="2">: Rs.----</td></tr>';
                }else{
                    $htmldata.=' <tr>
                    <td>Transaction ID</td><td colspan="2">: '.$event_result[0]['transaction_id'].'</td>
                    </tr>';
                }
               $htmldata.=' <tr>
                    <td>Mode</td><td colspan="2">: Online Payment</td>
                </tr>
                <tr>
                    <td>Date</td><td colspan="2">: '.date("d-m-Y", strtotime($event_result[0]['created_at'])).'</td>
                </tr>
                
            </table>
            
        </td>
    </tr>
    <tr>
        <td colspan="2" style="padding:2px 25px;font-size:13px;">
            <b>Eligible National Meet Race Details:</b>';
 foreach($event_result_types as $ev){           
    $htmldata.='<b style="padding-left:30px;padding-right:30px;">'.$ev['cat_level'].'M</b>';
 }
$htmldata.='</td>
    </tr>
    
    
    <tr>
        <td colspan="2" style="padding:2px 15px;font-size:12px;">
           <b>Declaration</b><br>
I hereby declare that<br>
1.  Above details are genuine with my knowledge.
<br>2. . I have attached the age proof document as per TNSSA guidelines and i will produce necessary original document whenever asked by state association / district association.
<br>3.  I accept to share the information provided by me to TNSSA and any service providers associated with TNSSA.
<br>4.  I accept to receive any communications from TNSSA in a form of Mail, Phone call, SMS.
<br>5.  I Will accept any decision taken by TNSSA if any of the information given above found wrong and the fee paid will not be refunded. TNSSA has rights to reject or cancel the registration of the skater anytime.
<br>6.  I / My ward aware that Rules & Regulations are subject to change.
<br>7.   I Understand and acknowledge that my son / daughter participating in the National Meet, aware on the risk of possible injuries during the event for which I ( directly or indirectly ) will not hold the organizer or host responsible for injuries and will not claim in any form towards the loss/damages/expenses against the same.
</td></tr>
</table>
</div>
<style>
@page { margin: 5mm; }
body { margin: 0px; }
</style>';
 }else { $htmldata='<center>no data</center>';}
?>
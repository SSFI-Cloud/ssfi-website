<?php
header('Content-Type: application/json');
require_once '../../config/config.php';
    
if (isset($_POST['ids']) && is_array($_POST['ids'])) {
    $idsString = implode(',', $_POST['ids']);
    
    $statement = $pdo->prepare("SELECT sk.* ,sr.age,sr.age_category,sr.payment_id as transaction_id,p.amount as amounts,c.club_name,ct.cat_name,d.district_name,date(sr.updated_at) as paid_date
FROM tbl_skaters sk
LEFT JOIN tbl_session_renewal sr ON sk.id = sr.skater_id and sr.session_id=(SELECT id FROM tbl_session WHERE is_active = 1)
LEFT JOIN payments p ON p.order_id = sr.order_id
left join tbl_clubs c on c.id=sk.club_id
LEFT JOIN tbl_category_type ct on ct.id=sk.category_type_id
LEFT JOIN tbl_districts d on d.id=sk.district_id
WHERE sk.id  in ($idsString) and sr.payment_id!=''");
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    
foreach($results as $result){   
    
    $subject=$result['membership_id']." - Skater Confirmation Certificate";
    $email="ganesan.firstmatrix@gmail.com";
    
    $email=$result['email_address'];
    $message="";
    
    $download_name=  str_replace('/', '-', $result['membership_id']);;
    $created_at = !empty($result['paid_date']) ? date("d-m-Y", strtotime($result['paid_date'])) : date("d-m-Y") ;
$htmldata='
<br>
<center>
<a href="https://ssfibharatskate.com/registers/pdf.php?id='.$result['id'].'">Download Certificate</button>
</center>
<br>
<br>

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
             SSFI ANNUAL SKATER REGISTRATION 2025-2026</b><br>
           
        </td>
    </tr>
</table>
<table style="width:100%;border-top:1px solid gray;">
    <tr>
        <td style="padding:2px 20px;width:50%;vertical-align:top;">
            <table style="width:100%;font-size:13px;">
                <tr>
                    <td style="width:30%;">Name</td><td>: '.$result['full_name'].'</td>
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
                    <td colspan="3">*****************************************************<br>
                   SKATER REGISTRATION PAYMENT DETAILS:</td>
                </tr>'; 
                
                
                if($result['transaction_id']=='' || $result['transaction_id']=='without payment'){
                }else{
                    $htmldata.=' <tr>
                    <td>Transaction ID</td><td colspan="2">: '.$result['transaction_id'].'</td>
                    </tr>';
                }
               $htmldata.=' <tr>
                    <td>Mode</td><td colspan="2">: Online Payment</td>
                </tr>
                <tr>
                    <td>Date</td><td colspan="2">: '.$created_at.'</td>
                </tr>
                
            </table>
            
        </td>
    </tr>
    

</table>

</div>
<style>
@page { margin: 5mm; }
body { margin: 0px; }
</style>';

$message=$htmldata;
 
/*E-Mail Send Source Code Start*/
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://fmsbilling.xyz/0-mails/index.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('subject' => $subject,'email' => $email,'message' => $message),
  CURLOPT_HTTPHEADER => array(
    'JWTToken: '
  ),
));
$response = curl_exec($curl);
curl_close($curl);
$response = json_decode($response, true);
if(isset($response)){
    $response_status=$response['status'];
    $response_message=$response['message'];
}
/*E-Mail Send Source Code End*/


}
    echo json_encode(["status" => "error", "message" => "Success"]);
}
    
?>
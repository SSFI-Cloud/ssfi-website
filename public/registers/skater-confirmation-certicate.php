<?php
include ("../admin/config/config.php");


// print_r($id);
$id= $_GET['id'] ?? 0;
$statement = $pdo->prepare("SELECT sk.* ,sr.age_category,sr.age,sr.payment_id as transaction_id,p.amount as amounts,c.club_name,ct.cat_name,d.district_name,date(sr.updated_at) as paid_date
FROM tbl_skaters sk
LEFT JOIN tbl_session_renewal sr ON sk.id = sr.skater_id and sr.session_id=(SELECT id FROM tbl_session WHERE is_active = 1)
LEFT JOIN payments p ON p.order_id = sr.order_id
left join tbl_clubs c on c.id=sk.club_id
LEFT JOIN tbl_category_type ct on ct.id=sk.category_type_id
LEFT JOIN tbl_districts d on d.id=sk.district_id
WHERE sk.id = $id and sr.payment_id!=''");
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);
$totalrow = $statement->rowCount();
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
                
                // if($result['paid_amount']!=0){
                //     $htmldata.='<tr><td>Fee</td><td colspan="2">: Rs.'.$result['amount'].'/- </td></tr>';
                // }else{
                //     $htmldata.=' <tr>
                //     <td>Fee</td><td colspan="2">: Rs.350/- </td>
                //     </tr>';
                // }
                
                
                if($result['transaction_id']=='' || $result['transaction_id']=='without payment'){
                    //$htmldata.='<tr><td>Transaction ID</td><td colspan="2">: Rs.'.$result['amounts'].'</td></tr>';
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
}else { $htmldata='<center>no data</center>';}


echo $htmldata;

?>
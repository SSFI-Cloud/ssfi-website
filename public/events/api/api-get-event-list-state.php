<?php
include '../../admin/config/config.php';
$state_id= $_GET['state_id'] ?? 0;
// $district_id=$_GET['district_id'] ?? 0;
$event_type_id=$_GET['event_type_id'] ?? 2;
$search=$_GET['search'] ?? '';
$session_id=$_GET['session_id'] ?? 4;

$condition=" and state_id=".$state_id." and event_level_type_id=".$event_type_id ." AND NOW() BETWEEN reg_start_date AND reg_end_date";

if($search!=''){
    $condition .=" and event_name like '%".$search."%'";
}


$stmt = $pdo->prepare("SELECT * FROM `tbl_events` where 1=1 $condition");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if($results){
    foreach($results as $res){
?>



<div class="col-lg-4 col-md-6 col-sm-12" >
    <div style="border: 1px solid gray;border-style: dotted;border-radius: 10px;padding: 12px 15px;margin:2px;">
        Event Name : <b><?=$res['event_name']?></b><br>
        Event Date : <b><?=$res['event_date']?></b><br>
        <?php if($state_id==23){ ?>
        <center><a onclick=Link("state-events.php?event_id=<?=$res['id']?>");>Register Now</a></center>
        <?php } else {?>
        <center><a onclick=Link("s-events-2526-ui.php?event_id=<?=$res['id']?>");>Register Now</a></center>
        <?php }?>
    </div>
</div>
<?php } }else{ ?>

<center>No Event Found....</center>
<?php } ?>
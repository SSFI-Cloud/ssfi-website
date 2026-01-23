<?php
include '../../../admin/config/config.php';

$age = $_POST['age'] ?? 0;
$event_level_type_id = $_POST['event_level_type_id'] ?? 1;
$event_level_type_id=1;
$category_type_id = $_POST['category_type_id']!="" ? $_POST['category_type_id'] : 0;

$query="SELECT * FROM tbl_eligible_event_level WHERE category_type_id=$category_type_id and event_level_type_id=$event_level_type_id and age_from<=$age and age_to>=$age";
error_log($query);
$stmt = $pdo->prepare($query);
$stmt->execute();
$event_results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$content='';
if($event_results){
    $content .='<div class="mt-3 category-box"><div class="row">';
    foreach($event_results as $ev){
        $class="normal_race";
        if (strpos($ev['event_level'], "Road Race") !== false) { $class="ring_race";}
        $content .='<div class="col-md-4 col-sm-6">
            <div class="form-check"><input class="form-check-input '.$class.'" type="checkbox" name="events[]" id="events_'.$ev['id'].'" value="'.$ev['id'].'"><label class="form-check-label" for="events_'.$ev['id'].'">'.$ev['event_level'].'</label></div>
        </div>';
    }
    $content .='</div></div>
    <style>
    /* Optional: make checkbox labels align nicely */
    .form-check-label {
        white-space: nowrap;
    }

    /* Optional: center checkboxes evenly */
    .form-check {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    }
</style>';
}else{
    $content='<center><b style="color:red;">Selected Category Events Currently Not Avaialble try another Category or try After Some Time...</b></center>';
}

echo $content;

?>
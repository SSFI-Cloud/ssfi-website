<?php include 'header.php' ?>
<!-- Vendors CSS -->
<link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
<link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />
<link rel="stylesheet" href="assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
<link rel="stylesheet" href="assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
<link rel="stylesheet" href="assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
<link rel="stylesheet" href="assets/vendor/libs/select2/select2.css" />
<link rel="stylesheet" href="assets/vendor/libs/@form-validation/form-validation.css" />
<?php
    //include '../config/config.php';
       
    $sql = "SELECT * FROM `tbl_category_type` order by id desc";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $tbl_category_type = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $categories = [4  => 'Under 4',6  => 'Under 6',8  => 'Under 8',10 => 'Under 10',12 => 'Under 12',14 => 'Under 14',16 => 'Under 16',100 => 'Above 16'];
    
    $lightColors = [
    "#FFCCCC", "#FFE5CC", "#FFFFCC", "#CCFFCC", "#CCFFFF",
    "#CCE5FF", "#E5CCFF", "#FFCCE5", "#F0E5CC", "#E5F0CC"
];

?>

<div class="container-xxl flex-grow-1" style="padding: 0px 10px;">
    <div class="card mb-2">
        <div class="row p-2">
            <div class="col-md-8">
                <h6 class="card-header"><i class="ri-building-line"></i> District Event Details</h6>
            </div>
            <div class="col-md-4 text-end">
                <button type="button" class="btn btn-xs btn-warning rounded-pill back_btn">
                    <i class="ri-file-add-fill"></i> Back to Event List
                </button>
            </div>
        </div>
    </div>
    
    <div class="card mb-2">
        <div class="nav-align-top">
            <ul class="nav nav-tabs mb-4" role="tablist">
                <?php $i=1; foreach($tbl_category_type as $category_type){ ?>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link <?php if($i==1){ echo 'active';}  ?>" data-bs-toggle="tab" href="#cate<?=$category_type['id']?>" role="tab">
                            <i class="ri-group-line me-2"></i><?=$category_type['cat_name']?>
                        </a>
                    </li>
                <?php $i++; } ?>  
            </ul>
        </div>
        <div class="tab-content">
            <?php $i=1; foreach($tbl_category_type as $category_type){ ?>
            <div class="tab-pane fade <?php if($i==1){ echo 'show active';}  ?>" id="cate<?=$category_type['id']?>" role="tabpanel">
                <div class="row mb-1">
                <?php $r=0; foreach($categories as $cat){ ?>
                
                    <div class="col-sm-4" style="padding-bottom: 10px;">
                        <div class="card" style="background: <?=$lightColors[$r]?>;border-radius: 15px;padding: 2px 10px;">
                            <center><b style="padding:5px;margin:5px;"><?=$cat?></b> </center>
                            <div class="row mb-1">
                                <?php
                                    
                                    $condition=" and age_to=100"; if($r<=2 && $i>2){$condition=" and age_to=7";}
                                
                                $sql = "SELECT * FROM `tbl_eligible_event_level` where category_type_id=".$category_type['id']."".$condition;
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute();
                                $tbl_mtr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach($tbl_mtr as $mt){
                                ?>
                                
                                <div class="col-sm-6" style="padding:5px;">
                                    <div class="card" style="margin:2px;padding:5px;">
                                        <center style="padding:5px;"><b><?=$mt['event_level']?></b></center>
                                        <?php
                                       $e_id= $_GET['event_id'] ?? 0;        
                                        $event_level_id=$mt['id'] ?? 0;
                                        $cat_name=$cat ?? '';
                                        
$sql = "SELECT 
    SUM(CASE WHEN s.gender = 'Male' THEN 1 ELSE 0 END) AS male_total,
    SUM(CASE WHEN s.gender = 'Male' AND er.result = 1 THEN 1 ELSE 0 END) AS male_result,
    SUM(CASE WHEN s.gender = 'Female' THEN 1 ELSE 0 END) AS female_total,
    SUM(CASE WHEN s.gender = 'Female' AND er.result = 1 THEN 1 ELSE 0 END) AS female_result
FROM tbl_event_registration er
LEFT JOIN tbl_session_renewal sr 
    ON er.skater_id = sr.skater_id 
    AND er.session_id = sr.session_id
LEFT JOIN tbl_skaters s 
    ON s.id = er.skater_id
WHERE er.event_id = $e_id
  AND er.eligible_event_level_id = $event_level_id
  AND sr.age_category = '$cat'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
                                
                                        
                                        
                                        
                                        ?>
                                        
                                        
                                            <table >
                                                <thead>
                                                    <tr>
                                                        <th style="width: 40%; text-align: left;">&nbsp;</th>
                                                        <th>Total</th>
                                                        <th>Result</th>
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>
                                                    <tr onclick="deleteSkater(<?=$e_id?>,<?=$event_level_id?>,'<?=$cat?>','Male','<?=$category_type['cat_name']?>','<?=$mt['event_level']?>')">
                                                        <td style="text-align: left;" >Male</td>
                                                        <td style="text-align:center;font-weight: bold"><?=$result['male_total'] ?? '-';?></td>
                                                        <td style="text-align:center;font-weight: bold" ><?=$result['male_result'] ?? '-';?></td>
                                                    </tr>
                                                    <tr onclick="deleteSkater(<?=$e_id?>,<?=$event_level_id?>,'<?=$cat?>','Female','<?=$category_type['cat_name']?>','<?=$mt['event_level']?>')">
                                                        <td style="text-align: left;">Female</td>
                                                        <td style="text-align:center;font-weight: bold"><?=$result['female_total'] ?? '-';?></td>
                                                        <td style="text-align:center;font-weight: bold"><?=$result['female_result'] ?? '-';?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                    </div>
                                </div>
                               <?php } ?> 
                                
                            </div>
                        </div>
                    </div>
                
                <?php $r++; } ?>
                </div>
            </div>
            <?php $i++; } ?> 
        </div>
    </div>
    
    
    
    
    
    

</div>





<!-- Delete Confirmation Modal -->
<div class="modal fade" id="ResultModel" tabindex="-1" aria-labelledby="ResultModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="ResultModelLabel" style="font-size: 16px;">
                    <!--Event Name : <span style="color: darkgreen;font-weight: 900;" id='span_event_name'>----</span> <br>-->
                    Event Category : <span style="color: darkgreen;font-weight: 900;" id='span_event_category'></span> &nbsp;&nbsp;&nbsp;&nbsp;
                    Age Category : <span style="color: darkgreen;font-weight: 900;" id='span_category'></span> &nbsp;&nbsp;&nbsp;&nbsp;
                    Event Level : <span style="color: darkgreen;font-weight: 900;" id='span_level'></span> &nbsp;&nbsp;&nbsp;&nbsp;
                    Gender : <span style="color: darkgreen;font-weight: 900;" id='span_gender'></span> </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Update Event Result Here...
                        <div class="row p-2">
                            <div class="row mb-1">
                                
                                 <div class="col-sm-12" hidden>
                                    <span style="font-size:12px;color: blue;">All Member ID</span>
                                    <select id="all_memberId" name="all_memberId" class="form-select" required multiple>
                                    </select>
                                </div>
                                 
                                <div class="col-sm-12" hidden>
                                    <span style="font-size:12px;color: blue;">Choose Selected Member ID</span>
                                    <select id="selected_memberId" name="selected_memberId" class="form-select" required multiple>
                                    </select>
                                </div>
                                <div class="col-sm-12">
                                    <span style="font-size:12px;color: blue;">Choose Absent Member ID</span>
                                    <select id="absent_memberId" name="absent_memberId" class="form-select" required multiple>
                                        <option value="">All Year</option>
                                    </select>
                                </div>
                                
                                <div class="col-sm-4">
                                    <span style="font-size:12px;color: blue;">Choose First Place Selected Member ID</span>
                                    <select id="first_place_memberId" name="first_place_memberId[]" class="form-select" required multiple>
                                        <option value="">--</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <span style="font-size:12px;color: blue;">Choose Second Place Selected Member ID</span>
                                    <select id="second_place_memberId" name="second_place_memberId[]" class="form-select" required multiple>
                                        <option value="">--</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <span style="font-size:12px;color: blue;">Choose Third Place Selected Member ID</span>
                                    <select id="third_place_memberId" name="third_place_memberId[]" class="form-select" required multiple>
                                        <option value="">--</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <span style="font-size:12px;color: blue;">Choose Forth Place Selected Member ID</span>
                                    <select id="forth_place_memberId" name="forth_place_memberId[]" class="form-select" required multiple>
                                        <option value="">--</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <span style="font-size:12px;color: blue;">Choose Fifth Place Selected Member ID</span>
                                    <select id="fifth_place_memberId" name="fifth_place_memberId[]" class="form-select" required multiple>
                                        <option value="">--</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                
                
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmUpdate">Update Result</button>
            </div>
        </div>
    </div>
</div>




<?php include 'footer.php' ?>

<script src="assets/vendor/libs/jquery/jquery.js"></script>
<script src="assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="assets/vendor/libs/select2/select2.js"></script>

<script>

$(document).ready(function () {
    $('#selected_memberId, #absent_memberId')
    .find('option[value=""]').remove() // remove null/empty option
    .end()
    .select2({
        dropdownParent: $('#ResultModel'),
        width: '100%'
    });
    $('#first_place_memberId, #second_place_memberId, #third_place_memberId,#forth_place_memberId,#fifth_place_memberId')
    .find('option[value=""]').remove()
    .end()
    .select2({
        dropdownParent: $('#ResultModel'),
        width: '100%'
    });
    
    $('#first_place_memberId, #second_place_memberId, #third_place_memberId,#forth_place_memberId,#fifth_place_memberId')
    .end()
    .select2({
        dropdownParent: $('#ResultModel'),
        width: '100%'
    });

});


    var event_id = null;var level_id = null;var category = null;var gender = null;var event_cat=null;
    var ResultModel = new bootstrap.Modal(document.getElementById('ResultModel'));
    function deleteSkater(event_ids,level_ids,categorys,genders,event_cats,level_name) { //event_id,level_id,category,gender
        event_id = event_ids;level_id = level_ids;category = categorys;gender = genders;event_cat=event_cats;
        
        $('#span_event_category').text(event_cat);
        $('#span_category').text(categorys);
        $('#span_level').text(level_name);
        $('#span_gender').text(genders);
        loadEventMembers(event_id,level_id,category,gender);
        
        $('#ResultModel').modal('show'); // Show the modal
    }
    $('#confirmUpdate').click(function () {
        if (event_id && level_id) {
            UpdateResult(event_id,level_id);
        }else{
            alert('Missing');
        }
    });
    
    function loadEventMembers(event_id, level_id, age_category, gender) {
        
        // $('').empty();
        $('#selected_memberId,#absent_memberId,#first_place_memberId, #second_place_memberId, #third_place_memberId,#forth_place_memberId,#fifth_place_memberId').empty();
        
    $.ajax({
        url: 'api/d-events/get-event-result-list.php',
        type: 'GET',
        dataType: 'json',
        data: {
            event_id: event_id,
            level_id: level_id,
            age_category: age_category,
            gender: gender
        },
        success: function(data) {
            if (!data.error) {
                
                
                
$('#all_memberId').empty().select2({
    data: data.selected.all,
    dropdownParent: $('#ResultModel'),
    width: '100%'
});

// Get all IDs from the loaded data
let allIds = data.selected.all.map(item => item.id);
// Preselect all
$('#all_memberId').val(allIds).trigger('change');

                
                
                
                // Populate Selected Members list
                $('#selected_memberId').empty().select2({
                    data: data.selected.all,
                    dropdownParent: $('#ResultModel'),
                    width: '100%'
                }).val(data.selected.preselected).trigger('change');

                // Populate Absent Members list
                $('#absent_memberId').empty().select2({
                    data: data.selected.all,
                    dropdownParent: $('#ResultModel'),
                    width: '100%'
                }).val(data.absent.preselected).trigger('change');
                
                $('#first_place_memberId').select2({
                    data: data.selected.all,
                    dropdownParent: $('#ResultModel'),
                    width: '100%'
                }).val(data.first).trigger('change');
                $('#second_place_memberId').select2({
                    data: data.selected.all,
                    dropdownParent: $('#ResultModel'),
                    width: '100%'
                }).val(data.second).trigger('change');
                $('#third_place_memberId').select2({
                    data: data.selected.all,
                    dropdownParent: $('#ResultModel'),
                    width: '100%'
                }).val(data.third).trigger('change');
                $('#forth_place_memberId').select2({
                    data: data.selected.all,
                    dropdownParent: $('#ResultModel'),
                    width: '100%'
                }).val(data.forth).trigger('change');
                $('#fifth_place_memberId').select2({
                    data: data.selected.all,
                    dropdownParent: $('#ResultModel'),
                    width: '100%'
                }).val(data.fifth).trigger('change');
            } else {
                console.error(data.error);
            }
        }
    });
}



$(document).ready(function () {
    // When selected list changes, remove from absent
    $('#selected_memberId').on('change', function () {
        let selectedVals = $(this).val() || [];
        $('#absent_memberId option').each(function () {
            if (selectedVals.includes($(this).val())) {
                $(this).prop('selected', false);
            }
        });
        $('#absent_memberId').trigger('change.select2'); // refresh UI if using select2
    });

    // When absent list changes, remove from selected
    $('#absent_memberId').on('change', function () {
        let absentVals = $(this).val() || [];
        $('#selected_memberId option').each(function () {
            if (absentVals.includes($(this).val())) {
                $(this).prop('selected', false);
            }
        });
        $('#selected_memberId').trigger('change.select2');
    });
});



function UpdateResult(event_id,level_id){
    let dataToSend = {
            event_id: event_id,
            level_id: level_id,
            all_memberId: $('#all_memberId').val() || [],
            selected_memberId: $('#selected_memberId').val() || [],
            absent_memberId: $('#absent_memberId').val() || [],
            first_place_memberId: $('#first_place_memberId').val() || [],
            second_place_memberId: $('#second_place_memberId').val() || [],
            third_place_memberId: $('#third_place_memberId').val() || [],
            forth_place_memberId: $('#forth_place_memberId').val() || [],
            fifth_place_memberId: $('#fifth_place_memberId').val() || []
        };

        $.ajax({
            url: 'api/d-events/update-event-result.php',
            type: 'POST',
            data: dataToSend,
            dataType: 'json',
            beforeSend: function () {
                $('#confirmUpdate').prop('disabled', true).text('Saving...');
            },
            success: function (res) {
                if (res.success) {
                    alert('Members updated successfully');
                    ResultModel.hide();
                } else {
                    $('#ResultModel').modal('show');
                    alert(res.error || 'Something went wrong');
                }
            },
            error: function (xhr, status, error) {
                alert('AJAX Error: ' + error);
                $('#ResultModel').modal('show');
            },
            complete: function () {
                $('#confirmUpdate').prop('disabled', false).text('Save');
            }
        });
}




</script>
<style>
    .select2-selection__choice {
        color: #ffffff;
        background-color: #179b05;
    }
</style>
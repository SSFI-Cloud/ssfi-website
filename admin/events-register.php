<?php include('header.php');?>
<!-- Vendors CSS -->
<link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
<link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />
<link rel="stylesheet" href="assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
<link rel="stylesheet" href="assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
<link rel="stylesheet" href="assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
<link rel="stylesheet" href="assets/vendor/libs/select2/select2.css" />
<link rel="stylesheet" href="assets/vendor/libs/@form-validation/form-validation.css" />
<div class="container-xxl flex-grow-1" style="padding: 0px 10px;">
<?php if(isset($_SESSION) && $_SESSION['user_id']!=1 ){ echo '<center><img src="dist/access-denied.png" style="width:200px;"/><center>'; }else{  ?>
    <div class="card mb-2">
        <div class="row p-2">
            <div class="col-md-8">
                <h6 class="card-header"><i class="ri-building-line"></i> Skater Event Register Details</h6>
            </div>
            <div class="col-md-4 text-end">
                <button type="button" class="btn btn-xs btn-warning rounded-pill back_btn">
                <i class="ri-file-add-fill"></i> Back to Event List
                </button>
            </div>
        </div>
        <div class="row p-2">
            <div class="row mb-1">
                <div class="row p-2">
                    <div class="row mb-1">
                        <div class="col-sm-2">
                            <span style="font-size:12px;color: blue;"> State</span>
                            <select id="filter_state_id" name="filter_state_id" class="form-select" required>
                                <option value="">Select State</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <span style="font-size:12px;color: blue;">District</span>
                            <select id="filter_district_id" name="filter_district_id" class="form-select" required>
                                <option value="">Select District</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <span style="font-size:12px;color: blue;">Event</span>
                            <select id="filter_event_id" name="filter_event_id" class="form-select" required>
                                <option value="">Select Event</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <span style="font-size:12px;color: blue;">Member Id</span>
                            <select id="filter_member_id" name="filter_member_id" class="form-select" required>
                                <option value="">Select Member Id</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <br>
                            <button onClick="getEventInfo()" id="submitbtn" type="button" class="btn btn-xs btn-info rounded-pill">
                                <i class="ri-file-add-fill"></i> Show
                            </button>       
                        </div>
                        
                        
                    </div>
                </div>
                
                
                
            </div>
        </div>
    </div>
    <div class="card mb-2">
    <div class="row p-2">
        
        <div data-role="main" class="ui-content" id="event_confirmation">
                <div class="col-xs">
                      <div class="box">
                        <div class="nd2-card">
                            <div class="row">
                              <div class="col-xs-12" style="padding:10px 20px;">
                                <div class="box">
                                  <center>
                                    <h6 class="txt_title">Your Annual Skater Registered Already Completed, Download Your Confirmation Certificate</h6>
                                  </center>
                                  <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                      <div style="border: 1px solid gray;border-style: dashed;padding:5px;border-radius:10px;">
                                        <table style="width: 100%;">
                                          <tbody>
                                            <tr>
                                              <td rowspan="1" style="width:20%;">
                                                <img id="confirm_profile" src="https://ssfibharatskate.com/images/Skatathon%20Poster%20(1)%20(2).jpg" style="width:100px;height:120px;border-radius: 10px;">
                                              </td>

                                            <td style="vertical-align:top; line-height:25px; padding-left:10px;">
                                              Name : <b class="confirm_name"></b><br>
                                              Member Id: <b class="confirm_member_id"></b><br>
                                              Dob / Gender : <b class="confirm_age_gender"></b><br>
                                              Age: <b class="confirm_age"></b><br>
                                              Age Category : <b class="confirm_category"></b><br>
                                              Level Category : <b class="confirm_level_category"></b><br>
                                              Registered Category Level:<br>
                                              <b class="levels"></b>
        
                                            </td>

                                            </tr>
                                            <tr>
                                              <td colspan="2" style="text-align:center;">
                                                <a  id="confirm_certicate_download" class="btn btn-primary btn-sm" target="_blank">
                                                  <i class="fa fa-download"></i> Download Confirmation Certificate </a>
                                                  
                                                  <a id="contiue_with_payment" class="btn btn-primary btn-sm" onclick="ShowReg()">
                                                  <i class="fa fa-download"></i> Update Event Details </a> 
                                                  
                                                  
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                  
                                </div>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
            </div>
        <div data-role="main" class="ui-content" id="event_register">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xs-12 col-sm-10 col-md-12">
                <div class="box">
                    <div style="text-align:center;">
                        <div class="rows">
                            <div class="col-12s" style="padding:10px 20px;">
                                <div class="boxs">
                                    <center>
                                        <h6 class="txt_title">Kindly Register Your Event Category Level</h6>
                                    </center>
                            <form id="eventForm">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12 reg">
                                            <div style="padding: 19px;border-radius:10px;">
                                                <h6>Hi <b class="confirm_name"></b>,</h6>
                                                   <p class="mt-3" style="font-size: 14px;text-align:left;">
                                                      <strong>Here is your Registered, <br> Membership ID:</strong> <span style="color: #3e4095;"><b class="confirm_member_id"></b></span>. 
                                                      <strong> <br> Dob / Gender:</strong> <span style="color: #3e4095;"><b class="confirm_age_gender"></b></span>.
                                                      <strong> <br> Age:</strong> <span style="color: #3e4095;"><b class="confirm_age" id="age_unique"></b></span>.
                                                      <strong> <br> Category :</strong> <span style="color: #3e4095;"><b class="confirm_category"></b></span>. 
                                                      <strong> <br> Category Age Group :</strong> <span style="color: #3e4095;"><b class="confirm_level_category"></b></span>. 
                                                     <!--<br><br> Kindly select the registered category in <strong>Skater</strong> to proceed with the event registration.-->
                                                    </p>
                                        <div class="row">
                                                <div class="col-md-6 col-sm-12"> 
                                                    <label for="blood_group">Select Event Category Level</label>
                                                        <select name="event_category" id="event_category" class="form-control" required>
                                                            <option value="">-- Select --</option>
                                                            <option value="1">Speed Quad</option>
                                                            <option value="2">Speed Inline</option>
                                                            <option value="3">Recreational Inline (Fancy)</option>
                                                            <option value="4">Adjustable/Tenatity</option>
                                                    </select>
                                                    <input type="hidden" id="_session_id" value="" required/>
                                                    <input type="hidden" id="_skater_id" value="" required/>
                                                    <input type="hidden" id="_event_id" value="" required/>
                                                    <input type="hidden" id="_event_level_type_id" value="" required/><!--Distric,State,National-->
                                                    
                                                </div>
                                        </div>
                                        
                                        
                                        <div id="event_selection_div">
                                            <br>
                                        </div>

                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <div>
                                        <button  class="btn btn-xs btn-warning rounded-pill">
                                           Submit >>>
                                        </button>
                                    </div>
                             </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        
    </div>
</div>
<?php } ?>
</div>
<?php include 'footer.php' ?>
<!-- Vendors JS -->
<script src="assets/vendor/libs/jquery/jquery.js"></script>
<script src="assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="assets/vendor/libs/select2/select2.js"></script>
<script>
  
    
    $(document).ready(function () {
        
        $('#filter_state_id').select2();
        $('#filter_district_id').select2();
        $('#filter_event_id').select2();
        $('#filter_member_id').select2();
        //getDropDown('tbl_events','filter_event_id','event_name',{});
        getDropDown('tbl_skaters','filter_member_id','membership_id',{});
        
        getDropDown('tbl_states','filter_state_id','state_name');
        $('#filter_state_id').on('change',function(){
            var state_id = $('#filter_state_id').val();
            getDropDown('tbl_districts','filter_district_id','district_name',{'state_id':state_id});
        });
        $('#filter_district_id').on('change',function(){
            var district_id = $('#filter_district_id').val();
            getDropDown('tbl_events','filter_event_id','event_name',{'district_id':district_id});
            getDropDown('tbl_skaters','filter_member_id','membership_id',{'district_id':district_id});
        });
        
        
        $("#event_register").hide();
        $("#event_confirmation").hide();
        
        
        
        
        
        
        $('.back_btn').on('click', function() {
            window.location.href = 'district-events-list.php';
        });
        
        $('#event_category').on('change',function(){
            getEvents();
        });
    });
    
function getEvents(){
    var event_level_type_id = $("#event_category").val();
    var category_type_id = $("#event_category").val();
    var age = $('.confirm_age').first().text();
    $('#event_selection_div').empty();
    $.ajax({
        url: 'api/d-events/get-event-list.php',
        type: 'post',
        data: {event_level_type_id:event_level_type_id,age:age,category_type_id:category_type_id},
        success: function (response) {
               $('#event_selection_div').append(response);
        }
    });
}

function ShowReg(){
    $("#event_register").show();
}
    
    function getEventInfo(){
        let member_id = $('#filter_member_id').val().trim();
        let event_id= $('#filter_event_id').val().trim();
        let selected_member_id = $('#filter_member_id option:selected').text().trim();
        $('#submitbtn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Loading Pls Wait...');
        if(member_id!='' && event_id!=''){
            $.ajax({
                url: "api/d-events/event-register-check.php",  // Replace with your actual API endpoint
                type: "POST",
                data: {member_id:member_id,event_id:event_id },
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    let res = response;
                    if(res.status === "success") {
                        $("#loader").hide();
                        $('#otpForm').show();
                        //alert(res.message);
                         
                        $("#_skater_id").val(res.data.id);
                        $("#_event_id").val(res.data.event_id);
                        $("#_event_level_type_id").val(res.data.event_level_type_id);
                        $("#_session_id").val(res.data.session_id);
                         
                        if(res.event_status==1){ // new event register
                            $('.txt_title').text(res.message);
                            $('.confirm_name').text(res.data.full_name);
                            $('.confirm_member_id').text(res.data.membership_id);
                            $('.confirm_age').text(res.data.age);
                            $('.confirm_age_gender').text(res.data.date_of_birth+' / '+res.data.gender);
                            $('.confirm_category').text(res.data.cat_name);
                            $('.confirm_level_category').text(res.data.level_category);
                            $("#event_register").show();
                            $("#event_confirmation").hide();
                        }else if(res.event_status==2){ //call order create api
                            alert('Option Coming Soon...');
                        }else if(res.event_status==3 || res.event_status==4){ //go for payment
                            //go for register confirmation only download prooof
                            $("#member_verification_otp").hide();
                            $('.txt_title').text(res.message);
                            $('.confirm_name').text(res.data.full_name);
                            $('.confirm_age').text(res.data.age);
                            $('.confirm_member_id').text(res.data.membership_id);
                            $('.confirm_age_gender').text(res.data.date_of_birth+' / '+res.data.gender);
                            $('.confirm_category').text(res.data.cat_name);
                            $('.confirm_level_category').text(res.data.level_category);
                            $('#confirm_profile').attr('src', "../admin/" + res.data.profile_photo);
                            $('#confirm_certicate_download').attr('href', "../events/event-confirmation-pdf.php?id=" + res.data.id+"&event_id="+res.data.event_id);
                            $('.levels').html(res.data.levels);
                            $('#confirm_certicate_download').show();
                            $("#event_register").hide();
                            $("#event_confirmation").show();
                        }
                    } else {
                        $('#submitbtn').prop('disabled', false).html('Submit >>');
                        alert(res.message);
                    }
                },
                error: function (xhr) {
                        $('#submitbtn').prop('disabled', false).html('Submit >>');
                    },
                    complete: function () {
                        // Re-enable button and restore original text
                        $('#submitbtn').prop('disabled', false).html('Submit >>');
                    }
            });
        }else{
            alert('Select Skater Id & Event Id..');
        }
    }
    
$("#eventForm").submit(function (e) {
        e.preventDefault();
        var category_type_id = $("#event_category").val();
        var confirm_age = $("#age_unique").text();
        var searchIDs = $("input:checkbox:checked").map(function(){
                return this.value;
            }).toArray();
        var checked_count = $('[name="events[]"]:checked').length  ;
        var normal_race = $('.normal_race:checked').length;
        var ring_race = $('.ring_race:checked').length;
      $("#loader").show();  
        if(checked_count<2){
            alert("Min 2 Event Level Required...");
        }else if((category_type_id==1 || category_type_id==2) && confirm_age<8 && checked_count!=2){
            alert("Max 2 Event Level Only Allowed...");
            // alert("cat"+category_type_id+"    "+"age"+confirm_age+"      "+"count "+checked_count);
        }else if((category_type_id==1 || category_type_id==2) && confirm_age>=8 && checked_count<3){
            alert("Min 3 Event Level Required...");
            // alert("cat"+category_type_id+"    "+"age"+confirm_age+"      "+"count "+checked_count);
        }else if((category_type_id==1 || category_type_id==2) && confirm_age>=8 && checked_count>3){
            alert("Max 3 Event Level Only Allowed...");
        }else if((category_type_id==1 || category_type_id==2) && confirm_age>=8 && ring_race>1){
            alert("Max One Road Race Only Allowed...");
        }else if(checked_count>2 && (category_type_id==3 || category_type_id==4)){
            alert("Max 2 Event Level Only Allowed...");
        }
        else{
            //Ready to insert the event levels
            $('.btn-submit').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Loading Pls Wait...');
            $("#loader").show();
            
            let skater_id = $('#_skater_id').val().trim();
            let event_level_type_id = $('#_event_level_type_id').val().trim();
            let event_id = $('#_event_id').val().trim();
            let eligible_event_level_id = searchIDs; 
            
            $.ajax({
                url: "api/d-events/event-register-api.php",  // Replace with your actual API endpoint
                type: "POST",
                data: {  skater_id: skater_id,event_level_type_id:event_level_type_id,event_id:event_id,eligible_event_level_id:eligible_event_level_id },
                dataType: "json",
                success: function(response) {
                    //console.log(response)
                    let res = response;
                    if(res.status === "success") {
                        $("#loader").hide();
                        $("#loader").hide();alert(res.message);
                       // alert(res.message);
                        $('.txt_title').text(res.message);
                        $('.confirm_name').text(res.data.full_name);
                        $('.confirm_age').text(res.data.age);
                        $('.confirm_member_id').text(res.data.membership_id);
                        $('.confirm_age_gender').text(res.data.date_of_birth+' / '+res.data.gender);
                        $('.confirm_category').text(res.data.cat_name);
                        $('.confirm_level_category').text(res.data.level_category);
                        $('#confirm_profile').attr('src', "../admin/" + res.data.profile_photo);
                        $('#confirm_certicate_download').attr('href', "../events/event-confirmation-pdf.php?id=" + res.data.id+"&event_id="+res.data.event_id);
                        $('#contiue_with_payment').hide();
                        $("#event_register").hide();
                        $("#event_confirmation").show();
                        getEventInfo();
                    } else {
                        $('#submitbtn').prop('disabled', false).html('Submit >>');
                        $("#loader").hide();
                        $('#event_register').show();
                        alert(res.message);
                    }
                },
                error: function (xhr) {
                    //console.error('Request failed:', xhr);
                    $('.btn-submit').prop('disabled', false).html('Submit >>');
                    $("#loader").hide();
                    $('#event_register').show();
                },
                complete: function () {
                    $('.btn-submit').prop('disabled', false).html('Submit >>');
                    $('#event_register').show();
                }
            });
        }
    });

document.addEventListener("DOMContentLoaded", function () {    
    let selectedId = getQueryParam("event_id");
    
    
    if (selectedId) {
        GetInfo(selectedId);
    }
    function getQueryParam(param) {
        let urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }
    function GetInfo(id) {
        if (!id) {
                    console.error("Invalid ID provided.");
                    return;
                }
                $.get(`api/d-events/read_single.php?id=${encodeURIComponent(id)}`, function (data) {
                    console.log(data);
            if (data) {
                $('#event_name').text(data.event_name);
                $('#venue').text(data.venue);
            } else {
                console.error("No data received for the given ID.");
            }
        }).fail(function (xhr) {
            console.error("Error fetching event details:", xhr.responseText);
        });

    }
});    
    
</script>


<style>
#loader {
    display: none;
    border-radius: 50%;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

</style>
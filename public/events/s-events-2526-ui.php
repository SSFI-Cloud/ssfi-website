<?php include "header.php";
include '../admin/config/config.php';

$event_id= $_GET['event_id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM `tbl_events` WHERE id=?");
$stmt->execute([$event_id]);
$e_results = $stmt->fetch(PDO::FETCH_ASSOC);

if($e_results && strtotime($e_results['reg_end_date']) >= time()){ ?>

<style>
/*#loader {
    display: none;
    width: 40px;
    height: 40px;
    border: 4px solid #f3f3f3;
    border-top: 4px solid #3498db;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}*/
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
            
            <div data-role="main" class="ui-content" id="member_verification">
                    <div class="col-xs">    
                      <div class="box">
                        <div class="nd2-card">
                          <form id="emailForm">
                            <div class="row">
                              <div class="col-xs-12" style="padding:10px 20px;">
                                <div class="box">
                                    
                                    
                                  <center><h6>Skater Event Regsiter</h6></center>
                                    <div class="row">
                                            <!--<div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="mob">Email ID<br>
                                                <small>(OTP will be sent to this email ID.)</small></label>
                                                    <input required="required" type="email" name="verify_email_id" id="verify_email_id" value="" data-clear-btn="true" data-clear-btn="true" placeholder="Type Email Address...">
                                                    
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="mob">Mobile No<br>
                                                <small>(OTP will be sent to this whatsapp mobile number.)</small></label>
                                                    <input required="required" type="number" name="verify_mobile_no"  maxlength="10" id="verify_mobile_no" value="" data-clear-btn="true" data-clear-btn="true" placeholder="Type Mobile Number...">
                                                    
                                            </div>-->
                                         <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="verify_member_id">Member Register ID<br>
                                                    <small style="color:green;font-weight:bold;">(SSFI/BS/TN/25/S000 or ssfi/Bs/Tn/25/S000)</small>
                                                </label>
                                                <input type="text" name="verify_member_id" id="verify_member_id" value="" placeholder="Member Register ID" required="required" autocomplete="off">
                                            </div>
                                        <div id="member_suggestion" style="position: relative;"></div>
                                    </div>
                                    <div>
                                        <button type="submit" id="mobBtn" style="color:white;" class="ui-btn ui-corner-all ui-shadow clr-btn-green ui-btn-icon-left ui-icon-pen clr-white">Continue >>></button>
                                    </div>
              
                                    
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
            </div>
            
            <div id="loader">
                <img src="https://i.imgur.com/sFnCUAW.gif" alt="Loading..." style="width: 200px;"/>
                <center>Loading Pls Wait...</center>
            </div>
            
            <div data-role="main" class="ui-content" id="member_verification_otp">
                    <div class="col-xs">
                      <div class="box">
                        <div class="nd2-card">
                            <div class="spinner" id="spinner"></div>
                          <form id="otpForm">
                            <div class="row">
                              <div class="col-xs-12" style="padding:10px 20px;">
                                <div class="box">
                                  <center><h6>Verification Process</h6></center>
                                  
                                    <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="mob">Verification<br>
                                                <small>(enter below CAPTCHA...)</small></label>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12" style="padding: 6px 10px;">
                                                <b id="confirmation_email_id"></b>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="sname">CAPTCHA:<br>
                                                <small></small></label>
                                                <input required="required" type="number" name="otp" id="otp" value="" data-clear-btn="true" data-clear-btn="true" placeholder="00000">
                                            </div>
                                    </div>
                                    <div class="box" style="text-align: end;">
                                        <a style="color:white;" class="ui-btn ui-btn-inline ui-corner-all ui-shadow clr-btn-pink clr-white"> << Go Back </a>
                                        <button id='submitbtn' type="submit" class="ui-btn ui-btn-inline ui-corner-all ui-shadow clr-btn-green clr-white"> Verifiy CAPTCHA >></button>
                                    </div>
                                    
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
            </div>

            
           
            
   <style>
    /* Make the select box always full width */
    select.form-control {
        width: 100%;
        max-width: 100%;
        display: block;
        padding: 10px;
        font-size: 16px;
        border-radius: 6px;
        border: 1px solid #ccc;
        box-shadow: none;
    }

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

    /* Optional: style back button consistently */
    #go_home {
        width: 100%;
        background-color: #28a745;
        font-weight: bold;
        padding: 10px;
        border: none;
        border-radius: 5px;
    }
    @media only screen and (min-width: 75em) {
    .reg{
        max-width:98%;
    }
    }
</style>

            
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
                                                <h4>Hi <b class="confirm_name"></b>,</h4>
                                                   <p class="mt-3" style="font-size: 16px;text-align:left;">
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
                                        <button style="color:white;" class="ui-btn ui-corner-all ui-shadow clr-btn-green ui-btn-icon-left ui-icon-pen clr-white btn-submit">
                                           Submit>>>
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

<style>
    
@media only screen and (min-width: 62em) {
    .event {
    max-width:7%
    }
</style>

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
                                                <a  id="contiue_with_payment" class="btn btn-primary btn-sm" target="_blank">
                                                  <i class="fa fa-download"></i> Continue Payment </a> 
                                                  
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                  <br>
                                  <div>
                                    <button id="go_home" style="color:white;" class="ui-btn ui-corner-all ui-shadow clr-btn-green ui-btn-icon-left ui-icon-pen clr-white">
                                      <<< Back To register Page </button>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
            </div>

        </div>
    </body>
</html>


<script>

$('#go_home').click(function() {
    window.location.href = '';
});



function pay(skater_id,event_id) {
    $.ajax({
        url: '../admin/api/front-api/get-event-payment.php',
        type: 'POST',
        dataType: 'json',
        data: {skater_id:skater_id,event_id:event_id},
        success: function (response) {
           //console.log(response);
                if (response.status == "success") {
                    openPaymentGateWay(response.order_id,response.amount,response.razorpay_api_key);
                } else {
                    alert(response.message);
                }
        },
        error: function (xhr) {
            alert('Something Went Wrong...');
            //console.error('Request failed:', xhr);
        },
        complete: function () {
        }
    });
};



    $(document).ready(function () {
    // Initially show member_verification and hide member_verification_otp
    $("#member_verification").show();
    $("#member_verification_otp").hide();
    $("#event_register").hide();
    $("#event_confirmation").hide();
    
    // On form submit, show OTP verification and hide email verification
    $("#emailForm").submit(function (e) {
        e.preventDefault(); // Prevent form submission
        let member_id = $('#verify_member_id').val().trim();
        /*let email = $('#verify_email_id').val().trim();
        let mobile_no = $('#verify_mobile_no').val().trim();*/
        $("#member_verification").hide();
        // Send AJAX request to backend to generate OTP (optional)
        
        $('#mobBtn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Loading Pls Wait...');
        $("#loader").show();
            $.ajax({
                url: "api/generate-otp.php",  // Replace with your actual API endpoint
                type: "POST",
                data: {member_id:member_id },
                dataType: "json",
                success: function(response) {
                    let res = response;
                    //console.log(response);
                    if(res.status === "success") {
                        $("#member_verification").hide();
                        $("#loader").hide();
                        $("#member_verification_otp").show();
                        $('#confirmation_email_id').text(res.otp);
                        $('#mobBtn').prop('disabled', false).html('Continue >>>');
                    } else {
                        alert(res.message);
                        $('#mobBtn').prop('disabled', false).html('Continue >>>');
                        $("#loader").hide();
                        $("#member_verification").show();
                    }
                }
            });
        
    });
    
    // OTP verification
    $("#otpForm").submit(function (e) {
            e.preventDefault(); // Prevent default form submission
                $('#submitbtn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Loading Pls Wait...');
                $("#loader").show();
                $('#otpForm').hide();
            let member_id = $('#verify_member_id').val().trim();
            /*let email = $('#verify_email_id').val().trim();
            let mobile_no = $('#verify_mobile_no').val().trim();*/    
            let otp = $('#otp').val().trim();
            let event_id= <?php if(isset($_GET["event_id"]) && $_GET["event_id"]!= ""){echo $_GET["event_id"];}else{echo 0;} ?>;
            
            // Validate OTP via AJAX
            $.ajax({
                url: "api/verify_otp_another_state.php",  // Replace with your actual API endpoint
                type: "POST",
                data: {  otp: otp,member_id:member_id,event_id:event_id },
                dataType: "json",
                success: function(response) {
                    //console.log(response)
                    let res = response;
                    if(res.status === "success") {
                        $("#loader").hide();
                        $('#otpForm').show();
                        alert(res.message);
                         
                        $("#_skater_id").val(res.data.id);
                        $("#_event_id").val(res.data.event_id);
                        $("#_event_level_type_id").val(res.data.event_level_type_id);
                        $("#_session_id").val(res.data.session_id);
                         
                        if(res.event_status==1){ // new event register
                        //console.log(res.data);
                        //console.log(res.data.full_name);
                            $("#member_verification_otp").hide();
                            $('.txt_title').text(res.message);
                            $('.confirm_name').text(res.data.full_name);
                            $('.confirm_member_id').text(res.data.membership_id);
                            $('.confirm_age').text(res.data.age);
                            $('.confirm_age_gender').text(res.data.date_of_birth+' / '+res.data.gender);
                            $('.confirm_category').text(res.data.cat_name);
                            $('.confirm_level_category').text(res.data.level_category);
                            $("#event_register").show();
                        }else if(res.event_status==2){ //call order create api
                            alert('Option Coming Soon...');
                        }else if(res.event_status==3){ //go for payment
                            $('.txt_title').text(res.message);
                            $('.confirm_name').text(res.data.full_name);
                            $('.confirm_member_id').text(res.data.membership_id);
                            $('.confirm_age_gender').text(res.data.date_of_birth+' / '+res.data.gender);
                            $('.confirm_category').text(res.data.cat_name);
                            $('.confirm_age').text(res.data.age);
                            $('.confirm_level_category').text(res.data.level_category);
                            $('#confirm_profile').attr('src', "../admin/" + res.data.profile_photo);
                            //$('#confirm_certicate_download').hide();
                            //$('#contiue_with_payment').attr('onclick', 'pay(' + res.data.id + ',' + res.data.event_id + ')');
                            $('.levels').html(res.data.levels);
                            
                            $('#confirm_certicate_download').attr('href', "event-confirmation-pdf.php?id=" + res.data.id+"&event_id="+res.data.event_id);
                            $('#confirm_certicate_download').show();
                            $('#contiue_with_payment').hide();
                            
                            $("#member_verification_otp").hide();
                            $("#event_register").hide();
                            $("#event_confirmation").show();
                        }else{ //go for register confirmation only download prooof
                            $("#member_verification_otp").hide();
                            $('.txt_title').text(res.message);
                            $('.confirm_name').text(res.data.full_name);
                            $('.confirm_age').text(res.data.age);
                            $('.confirm_member_id').text(res.data.membership_id);
                            $('.confirm_age_gender').text(res.data.date_of_birth+' / '+res.data.gender);
                            $('.confirm_category').text(res.data.cat_name);
                            $('.confirm_level_category').text(res.data.level_category);
                            $('#confirm_profile').attr('src', "../admin/" + res.data.profile_photo);
                            $('#confirm_certicate_download').attr('href', "event-confirmation-pdf.php?id=" + res.data.id+"&event_id="+res.data.event_id);
                            $('.levels').html(res.data.levels);
                            $('#confirm_certicate_download').show();
                            $('#contiue_with_payment').hide();
                            $("#event_register").hide();
                            $("#event_confirmation").show();
                        }
                    } else {
                        $('#submitbtn').prop('disabled', false).html('Verifiy CAPTCHA >>');
                        $("#loader").hide();
                        $('#otpForm').show();
                        alert(res.message);
                    }
                },
                error: function (xhr) {
                        //showtoastt('Something Went Wrong...', 'error');
                        //console.error('Request failed:', xhr);
                        $('#submitbtn').prop('disabled', false).html('Verifiy CAPTCHA >>');
                        $("#loader").hide();
                        $('#otpForm').show();
                    },
                    complete: function () {
                        // Re-enable button and restore original text
                        $('#submitbtn').prop('disabled', false).html('Verifiy CAPTCHA >>');
                        $('#otpForm').show();
                    }
            });
        });
        
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
        //console.log("Checked Count :"+checked_count);
        //console.log("normal_race Count :"+normal_race);
        //console.log("ring_race Count :"+ring_race);
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
                url: "api/another-state-event-register-api.php",  // Replace with your actual API endpoint
                type: "POST",
                data: {  skater_id: skater_id,event_level_type_id:event_level_type_id,event_id:event_id,eligible_event_level_id:eligible_event_level_id },
                dataType: "json",
                success: function(response) {
                    //console.log(response)
                    let res = response;
                    if(res.status === "success") {
                        /*$("#loader").hide();
                        openPaymentGateWay(response.order_id,response.amount,response.razorpay_api_key);
                        $('#event_register').show();
                         alert(res.message);
                    }else if(res.status === "pay_completed") {*/
                        $("#loader").hide();
                        alert(res.message);
                        //alert(data.message);
                        $('.txt_title').text(res.message);
                        $('.confirm_name').text(res.data.full_name);
                        $('.confirm_age').text(res.data.age);
                        $('.confirm_member_id').text(res.data.membership_id);
                        $('.confirm_age_gender').text(res.data.date_of_birth+' / '+res.data.gender);
                        $('.confirm_category').text(res.data.cat_name);
                        $('.confirm_level_category').text(res.data.level_category);
                        $('#confirm_profile').attr('src', "../admin/" + res.data.profile_photo);
                        $('#confirm_certicate_download').attr('href', "event-confirmation-pdf.php?id=" + res.data.id+"&event_id="+res.data.event_id);
                        $('#contiue_with_payment').hide();
                        $("#event_register").hide();
                        $("#event_confirmation").show();
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
                    //$('#event_register').show();
                }
            });
        }
    });
        
        
    
    // Go back button functionality
    $(".ui-btn.clr-btn-pink").click(function () {
        $("#member_verification").show();
        $("#member_verification_otp").hide();
    });
});


</script>

<script>
    $(document).ready(function () {
        getDropDown('tbl_states','state_id','state_name');
        getDropDown('tbl_category_type','category_type_id','cat_name');
    });
    $('#state_id').on('change',function(){
        var state_id = $('#state_id').val();
        getDropDown('tbl_districts','district_id','district_name',{'state_id':state_id});
    });
    $('#district_id').on('change',function(){
        var district_id = $('#district_id').val();
        getDropDown('tbl_clubs','club_id','club_name',{'district_id':district_id});
    });
    
    $('#event_category').on('change',function(){
        getEvents();
    });

function getEvents(){
    var event_level_type_id = $("#event_category").val();
    var category_type_id = $("#event_category").val();
    var age = $('.confirm_age').first().text();
    //console.log("age"+age);
    $('#event_selection_div').empty();
    $.ajax({
        url: 'api/get-event-list.php',
        type: 'post',
        data: {event_level_type_id:event_level_type_id,age:age,category_type_id:category_type_id},
        success: function (response) {
               $('#event_selection_div').append(response);
        }
    });
}
    
    
function getDropDown(tablename, id, value, conditions = {}, selected_id = null) {
    $.ajax({
        url: `../admin/api/helper/drop-down.php?is_front=1&table=${tablename}&columns=id,${value}&orderby=${value}&conditions=${encodeURIComponent(JSON.stringify(conditions))}`,
        type: "GET",
        dataType: "json",
        success: function (response) {
            //console.log(selected_id);
            if (response.success) {
                let dropdown = $(`#${id}`);
                dropdown.empty(); // Clear previous options
                dropdown.append('<option value="">Select</option>'); // Default option

                response.data.forEach(function (item) {
                    let isSelected = (selected_id && item.id == selected_id) ? 'selected' : '';
                    dropdown.append(`<option  value="${item.id}" ${isSelected}>${item[value]}</option>`);
                });
                
                dropdown.trigger("change");
            } else {
                //console.error("Error:", response.error);
            }
        },
        error: function (xhr, status, error) {
            //console.error("AJAX Error:", error);
        }
    });
}

function openPaymentGateWay(order_id, amount, razorpay_api_key) {
    var phone = $("#mobile_number").val();
    var email = $("#email_address").val();
    
    var options = {
        "key": razorpay_api_key,
        "amount": (amount * 100), // Convert to paise
        "name": "SSFI-EVENT REGISTER",
        "description": "Event Registration Fees",
        "image": "../admin/assets/img/favicon/SSFI_main.png",
        "order_id": order_id, // Pass the order_id received from PHP
        "handler": function (response) {
            fetch("../admin/api/front-api/event-payment-capture.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    razorpay_payment_id: response.razorpay_payment_id,
                    razorpay_order_id: response.razorpay_order_id,
                    razorpay_signature: response.razorpay_signature,
                    amount: amount
                })
            })
            .then(res => res.json())
            .then(data => {
                //console.log("Server Response:", data);
                alert(data.message);
                $('.txt_title').text(data.message);
                $('.confirm_name').text(data.data.full_name);
                $('.confirm_age').text(data.data.confirm_age);
                $('.confirm_member_id').text(data.data.membership_id);
                $('.confirm_age_gender').text(data.data.date_of_birth+' / '+data.data.gender);
                $('.confirm_category').text(data.data.cat_name);
                $('.levels').html(data.data.levels);
                $('.confirm_level_category').text(data.data.level_category);
                $('#confirm_profile').attr('src', "../admin/" + data.data.profile_photo);
                $('#confirm_certicate_download').attr('href', "event-confirmation-pdf.php?id=" + data.data.id+"&event_id="+data.data.event_id);
                $('#contiue_with_payment').hide();
                $("#event_register").hide();
                $("#event_confirmation").show();
            })
            .catch(error => {
                //console.error("Error:", error);
            });
        },
        "prefill": {
            "contact": phone,
            "email": email,
        },
        "theme": {
            "color": "#528FF0"
        }
    };

    var rzp1 = new Razorpay(options);

    rzp1.on('payment.failed', function (response) {
        //console.log("Payment Failed!", response);
        
        fetch("../admin/api/front-api/event-payment-capture.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                status: "failed",
                reason: response.error.description,
                code: response.error.code,
                source: response.error.source,
                step: response.error.step
            })
        })
        .then(res => res.json())
        .then(data => {
            //console.log("Failure Response:", data);
            alert("Payment Failed! Reason: " + data.reason);
        })
        .catch(error => {
            //console.error("Error:", error);
        });
    });
    
    rzp1.open();
}


</script>

<script>
$(document).ready(function () {
    $('#verify_member_id').on('keyup', function () {
        var input = $(this).val();
        if (input.length >= 4) {
            $.ajax({
                url: 'api/fetch_members_another_state.php',
                method: 'POST',
                data: { query: input },
                success: function (data) {
                    $('#member_suggestion').fadeIn().html(data);
                }
            });
        } else {
            $('#member_suggestion').fadeOut();
        }
    })

    $(document).on('click', '.suggestion-item', function () {
        $('#verify_member_id').val($(this).text());
        $('#member_suggestion').fadeOut();
    });

    $(document).click(function (e) {
        if (!$(e.target).closest('#verify_member_id, #member_suggestion').length) {
            $('#member_suggestion').fadeOut();
        }
    });
});
</script>

<?php }else{ ?>
<center>
    <br><br>Invalid Page Access..<br><br>
    <a onclick="Home()"  style="color: white;padding: 3px 7px;background: #d55353;" class="inline-btn"> << Back to Home</a>
</center>


<?php  } ?>
<script>
    function Home(){
        window.location.href = '../../';
    }
</script>
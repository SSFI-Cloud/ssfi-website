<?php include "header.php";?>

<style>
    #loader {
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
                                    
                                  <center><h6>Login with Email ID.</h6></center>
                                    <div class="row">
                                            <!--<div class="col-xs-12 col-sm-12 col-md-12">-->
                                            <!--    <label for="mob">Email ID<br>-->
                                            <!--    <small>(OTP will be sent to this email ID.)</small></label>-->
                                            <!--        <input required="required" type="email" name="verify_email_id" id="verify_email_id" value="" data-clear-btn="true" data-clear-btn="true" placeholder="Type Email Address...">-->
                                                    
                                            <!--</div>-->
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="mob">Mobile No<br>
                                                <small>(OTP will be sent to this whatsapp mobile number.)</small></label>
                                                    <input required="required" type="number" name="verify_mobile_no"  maxlength="10" id="verify_mobile_no" value="" data-clear-btn="true" data-clear-btn="true" placeholder="Type Mobile Number...">
                                                    
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="aadhar_number">Aadhar Number</label>
                                                <input type="number" name="verify_aadhar_number" id="verify_aadhar_number"  value="" data-clear-btn="true" placeholder="Aadhar Number"  maxlength="12" required="required">
                                                
                                            </div>
                                    </div>
                                    <div>
                                        <button type="submit" style="color:white;" class="ui-btn ui-corner-all ui-shadow clr-btn-green ui-btn-icon-left ui-icon-pen clr-white">Continue >>></button>
                                    </div>
              
                                    
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
            </div>
            
            <div id="loader" style="display: none;">
                <!--<img src="image/loader.gif" alt="Loading..." />-->
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
                                                <label for="mob">Mobile No<br>
                                                <small>(below Mobile Number otp has been sended...)</small></label>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12" style="padding: 6px 10px;">
                                                <b id="confirmation_email_id"></b>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="sname">OTP (One Time Password):<br>
                                                <small>(enter received otp below...)</small></label>
                                                <input required="required" type="number" name="otp" id="otp" value="" data-clear-btn="true" data-clear-btn="true" placeholder="00000">
                                            </div>
                                    </div>
                                    <div class="box" style="text-align: end;">
                                        <a style="color:white;" class="ui-btn ui-btn-inline ui-corner-all ui-shadow clr-btn-pink clr-white"> << Go Back </a>
                                        <button id='submitbtn' type="submit" class="ui-btn ui-btn-inline ui-corner-all ui-shadow clr-btn-green clr-white"> Verifiy Otp >></button>
                                    </div>
                                    
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
            </div>
            
            <div data-role="main" class="ui-content" id="member_regsiter">
                <div class="nd2-no-menu-swipe">
                    <div class="ui-content" data-inset="false">
                        <form id="skaterForm" autocorrect="off" spellcheck="false" autocomplete="false">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <center><b style="font-size: 14px;color: #3e4095;">Skater Personal Information</b><br><br></center>
                                    <div class="box">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="sname">FullName - As per Aadhaar:</label>
                                                <input autocomplete="off" required="required" type="text" name="full_name" id="full_name" value="" data-clear-btn="true" placeholder="Type Skater Name here...">
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="fathername">Fathername</label>
                                                <input type="text" name="father_name" id="father_name" value="" data-clear-btn="true" placeholder="Father Name" required="required">
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="phone">Mobile : <small>(SKATER / PARENT'S MOBILE NUMBER AS PER AADHAAR.. COACH'S PHONE NUMBER STRICTLY NOT ALLOWED.)</small></label>
                                                <input required="required" type="number" name="mobile_number" id="mobile_number" value="" data-clear-btn="true" placeholder="Mobile" minlength="10" maxlength="10">
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="email">Email :</label>
                                                <input required="required" type="email" name="email_address" id="email_address" value="" data-clear-btn="true" placeholder="Email">
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="date_of_birth">Date of Birth</label>
                                                <input type="date" name="date_of_birth" id="date_of_birth" value="" data-clear-btn="true" placeholder="DOB" required="required">
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="gender" class="d-block">Gender</label>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input class="form-check-input me-1" type="radio" name="gender" id="male" value="Male" checked required>
                                                        <label class="form-check-label me-3" for="male">Male</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input class="form-check-input me-1" type="radio" name="gender" id="female" value="Female" required>
                                                        <label class="form-check-label me-3" for="female">Female</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input class="form-check-input me-1" type="radio" name="gender" id="other" value="Other" required>
                                                        <label class="form-check-label" for="other">Other</label>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="blood">Blood Group</label>
                                                <select name="blood_group" id="blood_group" class="form-control" required="">
                                                    <option value="">Select Blood Group  <span style="text-fill-color: red;">*</span></option>
                                                    <option value="O Positive(+)">O Positive(+)</option>
                                                    <option value="O Negative(-)">O Negative(-)</option>
                                                    <option value="A Positive(+)">A Positive(+)</option>
                                                    <option value="A Negative(-)">A Negative(-)</option>
                                                    <option value="B Positive(+)">B Positive(+)</option>
                                                    <option value="B Negative(-)">B Negative(-)</option>
                                                    <option value="AB Positive(+)">AB Positive(+)</option>
                                                    <option value="AB Negative(-)">AB Negative(-)</option>
                                                    <option value="A1 Positive(+)">A1 Positive(+)</option>
                                                    <option value="A1 Negative(-)">A1 Negative(-)</option>
                                                    <option value="A2 Positive(+)">A2 Positive(+)</option>
                                                    <option value="A2 Negative(-)">A2 Negative(-)</option>
                                                    <option value="A1B Positive(+)">A1B Positive(+)</option>
                                                    <option value="A1B Negative(-)">A1B Negative(-)</option>
                                                    <option value="A2B Positive(+)">A2B Positive(+)</option>
                                                    <option value="A2B Negative(-)">A2B Negative(-)</option>
                                                    <option value="Rh Null">Rh Null</option>

                                                </select>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="Category">Category</label>
                                                <select name="category_type_id" id="category_type_id" class="form-control" required="">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <center><b style="font-size: 14px;color: #3e4095;">Fill Skater Club & Coach Information Details</b><br><br></center>
                                    <div class="box">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="state_id">State :</label>
                                                <select name="state_id" id="state_id" class="form-control" required="">
                                                </select>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="district_id">District :</label>
                                                <select name="district_id" id="district_id" class="form-control" required="">
                                                </select>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="club_id">Select Club :</label>
                                                <select name="club_id" id="club_id" class="form-control" required="">
                                                    <option value="1">Salem Scate Academy <span style="text-fill-color: red;">*</span></option>
                                                </select>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="school_name">School Name</label>
                                                <input type="text" name="school_name" id="school_name" value="" data-clear-btn="true" placeholder="School Name" required="required">
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="coach_name">Coach Name</label>
                                                <input type="text" name="coach_name" id="coach_name" value="" data-clear-btn="true" placeholder="Coach Name" required="required">
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="coach_mobile_number">Coach Number</label>
                                                <input type="number" name="coach_mobile_number" id="coach_mobile_number" value="" data-clear-btn="true" placeholder="Coach Number" required="required">
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="syllabus">I am</label>
                                                    <select required="required" name="syllabus" id="syllabus" data-theme="a" data-clear-btn="true">
                                                        <option>Studying in School - STATE Board</option>
                                                        <option>Studying in School - CBSE</option>
                                                        <option>Studying in School - ICSE</option>
                                                        <option>Studying in School - ISE</option>
                                                        <option>Studying in School/ College / University</option>
                                                        <option>Studying in School / College / University - Private / Open</option>
                                                        <option>Working</option>
                                                        <option>Self-Employed / Business</option>
                                                        <option>Others</option>
                                                    </select>
                                            </div>
                                            
                                            
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <label for="clubname">Representing Address :</label>
                                                    <textarea cols="40" rows="4" name="residential_address" required="required" id="residential_address" placeholder="type here(Maximum 4 Lines)" value="" data-clear-btn="true" class="ui-input-text ui-shadow-inset ui-body-inherit ui-corner-all ui-textinput-autogrow" style="height: 33px;"></textarea>
                                                    
                                            </div>
                                            
                                            
                                            
                                        </div> 
                                        
                                        
                                        
                                        
                                        
                                        
                                        <div id="paystat"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <center><b style="font-size: 14px;color: #3e4095;">Proof & Skater Photo</b><br><br></center>
                                    <div class="box">
                                        
                                        
                                         <div class="row">
                                             <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="aadhar_number">Aadhar Number</label>
                                                <input type="text" name="aadhar_number" id="aadhar_number" value="" data-clear-btn="true" placeholder="Aadhar Number" required="required">
                                                
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="box">
                                                    <div class="ui-field-contain">
                                                        <label for="dobfile1">PROFILE PHOTO (IMAGE):</label>
                                                        <input type="file" name="profile_photo" id="profile_photo" accept="application/pdf,image/jpeg" max-size=1024 required="required" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="ui-field-contain">
                                                    <label for="dobfile">Upload AADHAAR</label>
                                                    <input type="file" name="identity_proof" id="identity_proof" accept="application/pdf,image/jpeg" max-size=1024 required="required" />
                                                </div>
                                            </div>
                                            
                                         </div>
                                        
                                        
                                        
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs"></div>
                            </div>
                            <div class="row">
                                <div class="col-xs">
                                    <div class="box">
                                        <p align="justify">
                                        <center>
                                            <strong>Declaration</strong>
                                        </center>
                                        <br /> I hereby declare that
                                        </p>
                                        <p align="justify"> 1. I am/was not a registered skater with any State/U.T. Unit other than the present one.
                                            <br /> I hereby consent to provide my/myward's Aadhaar Offline KYC Data and Passcode for Aadhaar based authentication for 
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs">
                                    <div class="ui-field-contain">
                                        <label for="regstatus">I Read Fully and Agree to Terms & Conditions</label>
                                        <input id="regstatus" name="regstatus" type="checkbox" required="required" />
                                        <br />
                                        <br />
                                    </div>
                                    <div>
                                        <input type="hidden" value="1" name="plan" id="plan" />
                                    </div>
                                    <input type="submit" id="submitBtn" value="I agree to abide by SSFI Rules & Submit" class="ui-btn clr-btn-green" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div data-role="main" class="ui-content" id="member_confirmation">
                <div class="col-xs">
                      <div class="box">
                        <div class="nd2-card">
                            <div class="row">
                              <div class="col-xs-12" style="padding:10px 20px;">
                                <div class="box">
                                  <center>
                                    <h6 id="txt_title">Your Annual Skater Registered Already Completed, Download Your Confirmation Certificate</h6>
                                  </center>
                                  <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                      <div style="border: 1px solid gray;border-style: dashed;padding:5px;border-radius:10px;">
                                        <table style="width: 100%;">
                                          <tbody>
                                            <tr>
                                              <td rowspan="1" style="width:20%;">
                                                <img id="confirm_profile" src="" style="width:100px;border-radius: 10px;">
                                              </td>
                                              <td style="vertical-align:top;line-height: 25px;padding-left:10px;"> Name : <b id="confirm_name"></b>
                                                <br> Member Id: <b id="confirm_member_id"></b>
                                                <br> Age / Gender : <b id="confirm_age_gender"></b>
                                                <br> Age Category : <b id="confirm_category"></b>
                                                <br> Level Category : <b id="confirm_level_category"></b>
                                                <br>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td colspan="2" style="text-align:center;">
                                                <a  id="confirm_certicate_download" class="btn btn-primary btn-sm" target="_blank">
                                                  <i class="fa fa-download"></i> Download Confirmation Certificate </a>
                                                
                                                   <!--<a href="https://tnssa.in/admin/event-confirmation-national-pdf.php?<?=$res['id']?>" class="btn btn-primary btn-sm" target="_blank">-->
                                                   <!--    <i class="fa fa-download"></i> Download National Meet Registeration Confirmation</a>-->
                                                  
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
            
            <div data-role="main" class="ui-content" id="upi_payment">
                <div class="col-xs">
                    <div class="box">
                        <div class="nd2-card">
                            <form id="paymentForm">
                                <div class="row">
                                    <div class="col-xs-12" style="padding:10px 20px;">
                                        <div class="box">
                                            <center><h6>UPI Payment</h6></center>
                                            <input type="hidden" name="skater_id_form" id="skater_id_form" value="">
                                            
                               
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <label>UPI Number</label>
                                                    <h3 id="upi_id">8438286555@upi</h3>
                                                </div>
            
                 
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <label for="transaction_no">Transaction No</label>
                                                    <input required type="text" name="transaction_no" id="transaction_no" placeholder="Enter Transaction Number" data-clear-btn="true">
                                                </div>
            

                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <label for="payment_screenshot">Upload Payment Screenshot</label>
                                                    <input required type="file" name="payment_screenshot" id="payment_screenshot" accept="image/*" data-clear-btn="true">
                                                </div>
                                            </div>
                                            
                                            <div>
                                                <!--<button type="button" id="payWithPhonePe" class="ui-btn ui-corner-all ui-shadow clr-btn-blue ui-btn-icon-left ui-icon-carat-r">-->
                                                <!--    Pay with PhonePe-->
                                                <!--</button>-->
                                                <button onclick="openPhonePe()">Pay Now</button>
                                            </div>
                                            <br>
                                            <br>
            
                                            <div>
                                                <button type="submit" class="ui-btn ui-corner-all ui-shadow clr-btn-green ui-btn-icon-left ui-icon-pen">
                                                    Continue >>>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
            
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

// $(document).ready(function() {
//     $("#payWithPhonePe").click(function() {
//         let upiID = $("#upi_id").text();
//         let upiURL = `upi://pay?pa=${upiID}&pn=Merchant&mc=&tid=&tr=&tn=Payment&cu=INR`;
//         window.location.href = upiURL;
//     });
// });

    

function openPhonePe() {
    var upiId = "receiver@upi";
    var amount = "100";
    var note = "Payment for order";
    var url = "phonepe://pay?pa=${upiId}&pn=ReceiverName&am=${amount}&cu=INR&tn=${note}";
    window.location.href = url;
}


function pay(id) {
    $.ajax({
        url: '../ssfi/admin/api/front-api/get-payment.php',
        type: 'POST',
        dataType: 'json',
        processData: false,  // Required for FormData
        contentType: false,  // Required for FormData
        data: {skater_id:id},
        success: function (response) {
           console.log(response);
                if (response.status == "success") {
                    openPaymentGateWay(response.order_id,response.amount,response.razorpay_api_key);
                } else {
                    alert(response.message);
                }
        },
        error: function (xhr) {
            alert('Something Went Wrong...');
            console.error('Request failed:', xhr);
        },
        complete: function () {
        }
    });
};




    $(document).ready(function () {
    // Initially show member_verification and hide member_verification_otp
    $("#member_verification").show();
    $("#member_verification_otp").hide();
    $("#member_regsiter").hide();
    $("#member_confirmation").hide();
    $("#upi_payment").hide();
    // $("#paymentModal").modal("hide");
    // $('#paymentModal').modal('show');
    
    // On form submit, show OTP verification and hide email verification
    $("#emailForm").submit(function (e) {
        e.preventDefault(); // Prevent form submission
        // let email = $('#verify_email_id').val().trim();
        let mobile_no = $('#verify_mobile_no').val().trim();
        // Send AJAX request to backend to generate OTP (optional)
        $("#loader").show();
            $.ajax({
                url: "api/generate_otp.php",  // Replace with your actual API endpoint
                type: "POST",
                data: {mobile_no:mobile_no },
                dataType: "json",
                success: function(response) {
                    let res = response;
                    console.log(response);
                    if(res.status === "success") {
                        $("#member_verification").hide();
                        $("#loader").hide();
                        $("#member_verification_otp").show();
                        $('#confirmation_email_id').text(mobile_no);
                    } else {
                        alert("Error sending OTP. Try again.");
                    }
                }
            });
        
    });
    
    // OTP verification
    $("#otpForm").submit(function (e) {
            e.preventDefault(); // Prevent default form submission
            
                $('#submitbtn').prop('disabled', true);
                $('#spinner').show();
                $('#otpForm').hide();
                
            let otp = $('#otp').val().trim();
            console.log(otp);
            
            
            // let email = $('#verify_email_id').val().trim();
            let mobile_no = $('#verify_mobile_no').val().trim();
            let aadhar_number = $('#verify_aadhar_number').val().trim();
            
            // Validate OTP via AJAX
            $.ajax({
                url: "api/verify_otp.php",  // Replace with your actual API endpoint
                type: "POST",
                data: {  otp: otp,mobile_no:mobile_no,aadhar_number:aadhar_number },
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    let res = response;
                    if(res.status === "success") {
                           $('#spinner').hide();
                             $('#otpForm').show();
                        // alert(res.message);
                        
                        if(res.type==1){ //go for register confirmation only download prooof
                            $("#member_verification_otp").hide();
                            $('#aadhar_number').val(aadhar_number).prop('readonly', true);
                            $('#mobile_number').val(mobile_no);
                            // $('#email_address').val(email).prop('readonly', true);
 
                            $('#txt_title').text(res.message);
                            
                            $('#confirm_name').text(res.data.full_name);
                            $('#confirm_member_id').text(res.data.membership_id);
                            $('#confirm_age_gender').text(res.data.date_of_birth+' / '+res.data.gender);
                            $('#confirm_category').text(res.data.cat_name);
                            $('#confirm_level_category').text(res.data.cat_name);
                            $('#confirm_profile').attr('src', "../ssfi/admin/" + res.data.profile_photo);
                            $('#confirm_certicate_download').attr('href', "pdf.php?id=" + res.data.id);
                            
                            $('#contiue_with_payment').hide();
                            
                            $("#member_confirmation").show();
                            
                        }else if(res.type==2){ //call order create api
                            alert('Option Coming Soon...');
                        }else if(res.type==3){ //go for payment
                            $('#txt_title').text(res.message);
                            $('#confirm_name').text(res.data.full_name);
                            $('#confirm_member_id').text(res.data.membership_id);
                            $('#confirm_age_gender').text(res.data.date_of_birth+' / '+res.data.gender);
                            $('#confirm_category').text(res.data.cat_name);
                            $('#confirm_level_category').text(res.data.cat_name);
                            $('#confirm_profile').attr('src', "../ssfi/admin/" + res.data.profile_photo);
                            $('#confirm_certicate_download').hide();
                            $('#contiue_with_payment').attr('onclick', 'pay(' + res.data.id + ')');
                            $("#member_confirmation").show();
                            
                        }else{ //new Register
                            $("#member_verification_otp").hide();
                            $('#aadhar_number').val(aadhar_number).prop('readonly', true);;
                            $('#mobile_number').val(mobile_no);
                            // $('#email_address').val(email).prop('readonly', true);;
                            $("#member_regsiter").show();
                        }
                        
                        
                        
                        
                    } else {
                $('#submitbtn').prop('disabled', false);
                $('#spinner').hide();
                 $('#otpForm').show();
                        alert("Invalid OTP. Please try again.");
                    }
                    
                    
                    
                    
                }
            });
        });
        
    //Skater Register Form
    $("#skaterForm").submit(function (e) {
            e.preventDefault();
            let form = $("#skaterForm");
                let submitButton = $("#submitBtn"); // Ensure the submit button has an ID
                let formData = new FormData(form[0]); // Use FormData for file uploads
                let url = '../ssfi/admin/api/front-api/register-skater.php';
                
                /*if (selectedId) {
                    formData.append('id', selectedId); // Append ID for update
                }*/
                // Disable button and show loading spinner
                submitButton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving Pls Wait...');
            
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    processData: false,  // Required for FormData
                    contentType: false,  // Required for FormData
                    data: formData,
                    success: function (response) {
                       console.log(response);
                            if (response.status == "success") {
                                alert(response.message);
                                // openPaymentGateWay(response.order_id,response.amount,response.razorpay_api_key);
                                // $("#paymentModal").modal("show");
                                $("#member_regsiter").hide();
                                $("#upi_payment").show();
                                $("#skater_id_form").val(response.skater_id);
                                console.log(response)
                            } else {
                                alert(response.message);
                                // submitButton.prop('disabled', false).html('I agree to abide by SSFI Rules & Submit');
                            }
                    },
                    error: function (xhr) {
                        showtoastt('Something Went Wrong...', 'error');
                        console.error('Request failed:', xhr);
                        submitButton.prop('disabled', false).html('I agree to abide by SSFI Rules & Submit');
                    },
                    complete: function () {
                        // Re-enable button and restore original text
                        submitButton.prop('disabled', false).html('I agree to abide by SSFI Rules & Submit');
                    }
                });
        
        });
    
    $("#paymentForm").submit(function (event) {
        event.preventDefault(); // Prevent default form submission

        var skater_id = $("#skater_id_form").val();
        var transaction_no = $("#transaction_no").val();
        // var aadhar_number = $("#aadhar_number").val();
        var payment_screenshot = $("#payment_screenshot")[0].files[0];

        // Basic Validation
        if (!transaction_no || !payment_screenshot) {
            alert("All fields are required!");
            return;
        }

        var formData = new FormData();
        formData.append("skater_id", skater_id);
        formData.append("transaction_no", transaction_no);
        formData.append("payment_screenshot", payment_screenshot);

        // AJAX Request
        $.ajax({
            url: "../ssfi/admin/api/front-api/upi_process_payment.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                var result = JSON.parse(response);
                if (result.status === "success") {
                    alert(result.message);
                    $("#paymentForm").hide();
                    upi_payment(result.order_id,result.amount,result.skater_id);
                    // $("#member_confirmation").show();
                    window.alert("Skater Payment is Received..Waiting For Approval")
                } else {
                    alert("Payment failed. Please try again.");
                }
            },
            error: function () {
                alert("Error processing payment.");
            }
        });
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


    
    
function getDropDown(tablename, id, value, conditions = {}, selected_id = null) {
    $.ajax({
        url: `../ssfi/admin/api/helper/drop-down.php?table=${tablename}&columns=id,${value}&orderby=${value}&conditions=${encodeURIComponent(JSON.stringify(conditions))}`,
        type: "GET",
        dataType: "json",
        success: function (response) {
            console.log(selected_id);
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
                console.error("Error:", response.error);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
}

// function openPaymentGateWay(order_id,amount,razorpay_api_key){
//             var amount=amount;
//             var phone=$("#mobile_number").val();
//             var email=$("#email_address").val();
            
//          //rzp_live_KxA2ObhhPI9pbL-live   ,,,,test Key :rzp_test_FDm6XwduZUC9hK
//             var options = {
//                     "key": razorpay_api_key,
//                     "amount": (amount * 100), // Convert to paise
//                     "name": "Tamilnadu Speed Skating Association-TNSSA",
//                     "description": "Skater Registration Fees",
//                     "image": "../ssfi/admin/assets/img/favicon/ssfa.png",
//                     "order_id": order_id, // Pass the order_id received from PHP
//                     "handler": function (response) {
//                         console.log("Payment Success:", response);
                    
//                         fetch("../ssfi/admin/api/front-api/payment_capture.php", {
//                             method: "POST",
//                             headers: {
//                                 "Content-Type": "application/json"
//                             },
//                             body: JSON.stringify({
//                                 razorpay_payment_id: response.razorpay_payment_id,
//                                 razorpay_order_id: response.razorpay_order_id,
//                                 razorpay_signature: response.razorpay_signature,
//                                 amount: amount
//                             })
//                         })
//                         .then(res => res.json())
//                         .then(data => {
//                             console.log("Server Response:", data);
//                             alert(data.message);
//                             $('#txt_title').text(res.message);
//                             $('#confirm_name').text(res.data.full_name);
//                             $('#confirm_member_id').text(res.data.membership_id);
//                             $('#confirm_age_gender').text(res.data.date_of_birth+' / '+res.data.gender);
//                             $('#confirm_category').text(res.data.cat_name);
//                             $('#confirm_level_category').text(res.data.cat_name);
//                             $('#confirm_profile').attr('src', "../ssfi/admin/" + res.data.profile_photo);
//                             $('#confirm_certicate_download').attr('href', "confirmation_certificate.php?id=" + res.data.id);
//                             $('#contiue_with_payment').hide();
//                             $("#member_confirmation").show();
//                         })
//                         .catch(error => {
//                             console.error("Error:", error);
//                         });
//                     },
//                     "prefill": {
//                         "contact": phone,
//                         "email": email,
//                     },
//                     "theme": {
//                         "color": "#528FF0"
//                     }
//                     };
                    
//                     var rzp1 = new Razorpay(options);

// // Handle payment failure
//             rzp1.on('payment.failed', function (response) {
//                 console.log("Payment Failed!", response);
            
//                 fetch("../ssfi/admin/api/front-api/payment_capture.php", {
//                     method: "POST",
//                     headers: {
//                         "Content-Type": "application/json"
//                     },
//                     body: JSON.stringify({
//                         status: "failed",
//                         reason: response.error.description,
//                         code: response.error.code,
//                         source: response.error.source,
//                         step: response.error.step
//                     })
//                 })
//                 .then(res => res.json())
//                 .then(data => {
//                     console.log("Failure Response:", data);
//                     alert("Payment Failed! Reason: " + data.reason);
//                 })
//                 .catch(error => {
//                     console.error("Error:", error);
//                 });
//             });
            
//             // Open Razorpay payment window
//             rzp1.open();

//         }

function openPaymentGateWay(order_id, amount, razorpay_api_key) {
    var phone = $("#mobile_number").val();
    var email = $("#email_address").val();
    
    var options = {
        "key": razorpay_api_key,
        "amount": (amount * 100), // Convert to paise
        "name": "Tamilnadu Speed Skating Association-TNSSA",
        "description": "Skater Registration Fees",
        "image": "../ssfi/admin/assets/img/favicon/ssfa.png",
        "order_id": order_id, // Pass the order_id received from PHP
        "handler": function (response) {
            console.log("Payment Success:", response);
            
            fetch("../ssfi/admin/api/front-api/payment_capture.php", {
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
                console.log("Server Response:", data);
                alert(data.message);
                $('#txt_title').text(data.message); // Changed from res.message to data.message
                $('#confirm_name').text(data.data.full_name);
                $('#confirm_member_id').text(data.data.membership_id);
                $('#confirm_age_gender').text(data.data.date_of_birth + ' / ' + data.data.gender);
                $('#confirm_category').text(data.data.cat_name); 
                $('#confirm_level_category').text(data.data.cat_name);
                $('#confirm_profile').attr('src', "../ssfi/admin/" + data.data.profile_photo);
                // $('#confirm_certicate_download').attr('href', "confirmation_certificate.php?id=" + data.data.id);
                $('#confirm_certicate_download').attr('href', "pdf.php?id=" + data.data.id);
                $('#contiue_with_payment').hide();
                $("#member_regsiter").hide();
                $("#member_confirmation").show();
            })
            .catch(error => {
                console.error("Error:", error);
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
        console.log("Payment Failed!", response);
        
        fetch("../ssfi/admin/api/front-api/payment_capture.php", {
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
            console.log("Failure Response:", data);
            alert("Payment Failed! Reason: " + data.reason);
        })
        .catch(error => {
            console.error("Error:", error);
        });
    });
    
    rzp1.open();
}

function upi_payment(order_id,amount){
    var phone = $("#mobile_number").val();
    var email = $("#email_address").val();
    
    var options = {
        "amount": (amount * 100), // Convert to paise
        "name": "Tamilnadu Speed Skating Association-TNSSA",
        "description": "Skater Registration Fees",
        "image": "../ssfi/admin/assets/img/favicon/ssfa.png",
        "order_id": order_id, // Pass the order_id received from PHP
        "handler": function (response) {
            console.log("Payment Success:", response);
            fetch("../ssfi/admin/api/front-api/payment_capture.php", {
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
                console.log("Server Response:", data);
                alert(data.message);
                $('#txt_title').text(data.message); // Changed from res.message to data.message
                $('#confirm_name').text(data.data.full_name);
                $('#confirm_member_id').text(data.data.membership_id);
                $('#confirm_age_gender').text(data.data.date_of_birth + ' / ' + data.data.gender);
                $('#confirm_category').text(data.data.cat_name); 
                $('#confirm_level_category').text(data.data.cat_name);
                $('#confirm_profile').attr('src', "../ssfi/admin/" + data.data.profile_photo);
                $('#confirm_certicate_download').attr('href', "pdf.php?id=" + data.data.id);
                $('#contiue_with_payment').hide();
                $("#member_regsiter").hide();
                $("#member_confirmation").show();
            })
            .catch(error => {
                console.error("Error:", error);
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
        console.log("Payment Failed!", response);
        
        fetch("../ssfi/admin/api/front-api/payment_capture.php", {
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
            console.log("Failure Response:", data);
            alert("Payment Failed! Reason: " + data.reason);
        })
        .catch(error => {
            console.error("Error:", error);
        });
    });
    
    rzp1.open();
}

// function upi_payment(order_id, amount,skater_id) {
//     fetch("../ssfi/admin/api/front-api/payment_capture.php", {
//         method: "POST",
//         headers: {
//             "Content-Type": "application/json"
//         },
//         body: JSON.stringify({
//             order_id: order_id,
//             amount: amount,
//             skater_id:skater_id
//         })
//     })
//     .then(res => res.json())  // Convert response to JSON
//     .then(data => {
//         console.log("Server Response:", data);
        
//         if (data.status === "success") {
//             alert(data.message);
//             $('#txt_title').text(data.message);
//             $('#confirm_name').text(data.data.full_name);
//             $('#confirm_member_id').text(data.data.membership_id);
//             $('#confirm_age_gender').text(data.data.date_of_birth + ' / ' + data.data.gender);
//             $('#confirm_category').text(data.data.cat_name);
//             $('#confirm_level_category').text(data.data.cat_name);
//             $('#confirm_profile').attr('src', "../ssfi/admin/" + data.data.profile_photo);
//             $('#confirm_certicate_download').attr('href', "pdf.php?id=" + data.data.id);
//             $('#contiue_with_payment').hide();
//             $("#member_regsiter").hide();
//             $("#member_confirmation").show();
//         } else {
//             alert("Payment Failed: " + data.message);
//         }
//     })
//     .catch(error => {
//         console.error("Error:", error);
//     });
// }


</script>
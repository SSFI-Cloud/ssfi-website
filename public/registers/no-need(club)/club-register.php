<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        
    <title>SSFI-CLUB REGISTER -2025-2026</title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../ssfi/admin/assets/img/favicon/ssfa.png" />
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=0.8, maximum-scale=1.0, user-scalable=no" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css" />
        <link rel="stylesheet" href="vendor/waves/waves.min.css" />
        <link rel="stylesheet" href="https://indiaskate.com/skaterbase25/css/nativedroid2.css" />
        <link rel="stylesheet" href="https://indiaskate.com/skaterbase25/css/cbstyle.css" />
        <link rel="stylesheet" href="https://indiaskate.com/skaterbase25/vendor/wow/animate.css" />
        <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <style type='text/css'>
            table {
            border-collapse: collapse;
            }
            .ui-shadow{
            padding: 4px;
            font-weight: 400;
            font-size: 14px;
            }
            @media only screen and (min-width: 600px) {
            .ui-page {
            width: 100% !important;
            max-width: 1300px !important;
            margin: 0 auto !important;
            position: relative !important;
            }
            }
            
            .nd2-card {
                box-shadow: none;
            }
        </style>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>
        <script src="vendor/waves/waves.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
        <script src="https://indiaskate.com/skaterbase25/vendor/wow/wow.min.js"></script>
        <script src="https://indiaskate.com/skaterbase25/js/nativedroid2.js"></script>
        <script src="https://indiaskate.com/skaterbase25/nd2settings.js"></script>
        <script src="https://indiaskate.com/skaterbase25/js/jquery.cropit.js"></script>
        <script type="text/javascript" src="j.js?version=202512"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="entrypage" data-url="entrypage">
            <div data-role="header" style="overflow:hidden; text-align:center;">
                <br>
                <?php include ('register-header.php');  ?>
                <center style="padding: 10px;"><b style="font-size: 16px;color: #afa300;">CLUB REGISTRATION 2025 - 2026</b></center>
            </div>
            
            <div data-role="main" class="ui-content" id="member_verification">
                    <div class="col-xs">
                      <div class="box">
                        <div class="nd2-card">
                          <form id="emailForm">
                            <div class="row">
                              <div class="col-xs-12" style="padding:10px 20px;">
                                <div class="box">
                                  <center><h6>Login with Email ID. & Mobile Number</h6></center>
                                    <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="mob">Email ID<br>
                                                <small>(OTP will be sent to this email ID.)</small></label>
                                                    <input required="required" type="email" name="verify_email_id" id="verify_email_id" value="" data-clear-btn="true" data-clear-btn="true" placeholder="Type Email Address...">
                                                    
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="mob">Mobile No<br>
                                                <small>(OTP will be sent to this whatsapp mobile number.)</small></label>
                                                    <input required="required" type="number" name="verify_mobile_no" pattern="\d{10}" minlength="10" maxlength="10" id="verify_mobile_no" value="" data-clear-btn="true" data-clear-btn="true" placeholder="Type Mobile Number...">
                                                    
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="aadhar_number">Club Registration Number</label>
                                                <input type="number" name="verify_registration_number" id="verify_registration_number" pattern="\d{16}" value="" data-clear-btn="true" placeholder="Aadhar Number" minlength="16" maxlength="16" required="required">
                                                
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
            
            <div data-role="main" class="ui-content" id="member_verification_otp">
                    <div class="col-xs">
                      <div class="box">
                        <div class="nd2-card">
                          <form id="otpForm">
                            <div class="row">
                              <div class="col-xs-12" style="padding:10px 20px;">
                                <div class="box">
                                  <center><h6>Verification Process</h6></center>
                                  
                                    <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="mob">Email ID<br>
                                                <small>(below email id otp has been sended...)</small></label>
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
                                        <button type="submit" class="ui-btn ui-btn-inline ui-corner-all ui-shadow clr-btn-green clr-white"> Verifiy Otp >></button>
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
                                                    <option value="B Positive(+)" selected>B Positive(+)</option>
                                                    <option value="B Negative(-)">B Negative(-)</option>
                                                    <option value="AB Positive(+)">AB Positive(+)</option>
                                                    <option value="AB Negative(-)">AB Negative(-)</option>
                                                    <option value="A1 Positive(+)">A1 Positive(+)</option>
                                                    <option value="A1 Negative(-)">A1 Negative(-)</option>
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
                                                <input type="text" name="coach_mobile_number" id="coach_mobile_number" value="" data-clear-btn="true" placeholder="Coach Number" required="required">
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
    </body>
</html>

<script>

$('#go_home').click(function() {
    window.location.href = '';
});

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
    
    
    // On form submit, show OTP verification and hide email verification
    $("#emailForm").submit(function (e) {
        e.preventDefault(); // Prevent form submission
        let email = $('#verify_email_id').val().trim();
        let mobile_no = $('#verify_mobile_no').val().trim();
        // Send AJAX request to backend to generate OTP (optional)
            $.ajax({
                url: "api/generate_otp.php",  // Replace with your actual API endpoint
                type: "POST",
                data: { email: email,mobile_no:mobile_no,type:'Club' },
                dataType: "json",
                success: function(response) {
                    let res = response;
                    console.log(response);
                    if(res.status === "success") {
                        $("#member_verification").hide();
                        $("#member_verification_otp").show();
                        $('#confirmation_email_id').text(email);
                    } else {
                        alert("Error sending OTP. Try again.");
                    }
                }
            });
        
    });
    
    
    
    // OTP verification
        $("#otpForm").submit(function (e) {
            e.preventDefault(); // Prevent default form submission
            let otp = $('#otp').val().trim();
            console.log(otp);
            
            
            let email = $('#verify_email_id').val().trim();
            let mobile_no = $('#verify_mobile_no').val().trim();
            let aadhar_number = $('#verify_registration_number').val().trim();
            
            // Validate OTP via AJAX
            $.ajax({
                url: "api/verify_otp.php",  // Replace with your actual API endpoint
                type: "POST",
                data: { email: email, otp: otp,mobile_no:mobile_no,aadhar_number:aadhar_number },
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    let res = response;
                    if(res.status === "success") {
                        alert(res.message);
                        
                        if(res.type==1){ //go for register confirmation only download prooof
                            $("#member_verification_otp").hide();
                            /*$('#aadhar_number').val(aadhar_number).prop('readonly', true);*/
                            $('#mobile_number').val(mobile_no);
                            $('#email_address').val(email).prop('readonly', true);
 
                            $('#txt_title').text(res.message);
                            
                            $('#confirm_name').text(res.data.full_name);
                            $('#confirm_member_id').text(res.data.membership_id);
                            $('#confirm_age_gender').text(res.data.date_of_birth+' / '+res.data.gender);
                            $('#confirm_category').text(res.data.cat_name);
                            $('#confirm_level_category').text(res.data.cat_name);
                            $('#confirm_profile').attr('src', "../ssfi/admin/" + res.data.profile_photo);
                            $('#confirm_certicate_download').attr('href', "confirmation_certificate.php?id=" + res.data.id);
                            
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
                            $('#email_address').val(email).prop('readonly', true);;
                            $("#member_regsiter").show();
                        }
                        
                        
                        
                        
                    } else {
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
                                openPaymentGateWay(response.order_id,response.amount,response.razorpay_api_key);
                            } else {
                                alert(response.message);
                                submitButton.prop('disabled', false).html('I agree to abide by SSFI Rules & Submit');
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
                $('#confirm_certicate_download').attr('href', "confirmation_certificate.php?id=" + data.data.id);
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

    // Handle payment failure
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
    
    // Open Razorpay payment window
    rzp1.open();
}

</script>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        
    <title>DISTRICT ASSOCIATION REGISTRATION</title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../admin/assets/img/favicon/ssfi-logo-12.png" />
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=0.8, maximum-scale=1.0, user-scalable=no" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css" />
        <link rel="stylesheet" href="vendor/waves/waves.min.css" />
        <link rel="stylesheet" href="css/nativedroid2.css" />
        <link rel="stylesheet" href="css/cbstyle.css" />
        <link rel="stylesheet" href="vendor/wow/animate.css" />
        <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <!-- jQuery -->
        <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
        <script src="vendor/wow/wow.min.js"></script>
        <script src="js/nativedroid2.js"></script>
        <script src="nd2settings.js"></script>
        <script src="js/jquery.cropit.js"></script>
        <script type="text/javascript" src="j.js?version=202512"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="entrypage" data-url="entrypage">
            <div data-role="header" style="overflow:hidden; text-align:center;">
                <br>
                <center>
                 <div>
                     <img src="image/WEBSITE SSFI (1).jpg" alt="image" width="80%" >
                 </div>
                    </table>
                </center>
            </div>
            <div data-role="main" class="ui-content" id="member_verification">
                    <div class="col-xs">
                      <div class="box">
                        <div class="nd2-card">
                          <form id="emailForm">
                            <div class="row">
                              <div class="col-xs-12" style="padding:10px 20px;">
                                <div class="box">
                                    
                                  <center><h6>Login with whatsapp mobile number.</h6></center>
                                    <div class="row">
                                            
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="mob">Mobile No<br>
                                                <!--<small>(OTP will be sent to this whatsapp mobile number.)</small>-->
                                                </label>
                                                    <input required="required" type="text" name="verify_mobile_no" pattern="\d{10}" minlength="10" maxlength="10" id="verify_mobile_no" value="" data-clear-btn="true" data-clear-btn="true" placeholder="Type Mobile Number...">
                                                    
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="mob">Email<br>
                                                <small>(OTP will be sent to this Mail ID.)</small></label>
                                                    <input required="required" type="email" name="verify_email_id"  id="verify_email_id" value="" data-clear-btn="true" data-clear-btn="true" placeholder="Type Email...">
                                                    
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="aadhar_number">Aadhar Number</label>
                                                <input type="text" name="verify_aadhar_number" id="verify_aadhar_number" pattern="\d{12}" value="" data-clear-btn="true" placeholder="Aadhar Number" minlength="12" maxlength="12" required="required">
                                                
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
                            <div class="spinner" id="spinner"></div>
                          <form id="otpForm">
                            <div class="row">
                              <div class="col-xs-12" style="padding:10px 20px;">
                                <div class="box">
                                  <center><h6>Verification Process</h6></center>
                                  
                                    <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="mob">Mobile number<br>
                                                <small>(below Mobile Number otp has been sended...)</small></label>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12" style="padding: 6px 10px;">
                                                <b id="confirmation_mobile_number"></b>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="mob">Email<br>
                                                <small>(below Email otp has been sended...)</small></label>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12" style="padding: 6px 10px;">
                                                <b id="confirmation_email"></b>
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
                        <form id="secretaryform" autocorrect="off" spellcheck="false" autocomplete="false">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <center><b style="font-size: 14px;color: #3e4095;">SECRETARY Personal Information</b><br><br></center>
                                    <div class="box">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="sname">FullName - As per Aadhaar:</label>
                                                <input autocomplete="off" required="required" type="text" name="full_name" id="full_name" value="" data-clear-btn="true" placeholder="Type SECRETARY Name here...">
                                            </div>
                                           
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="phone">Mobile : <small>(SECRETARY MOBILE NUMBER)</small></label>
                                                <input required="required" type="number" name="mobile_number" id="mobile_number" value="" data-clear-btn="true" placeholder="Mobile" minlength="10" maxlength="10">
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="aadhar_number">Aadhar Number</label>
                                                <input type="text" name="aadhar_number" id="aadhar_number" value="" data-clear-btn="true" placeholder="Aadhar Number" required="required">
                                                
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="email">Email :</label>
                                                <input required="required" type="email" name="email_address" id="email_address" value="" data-clear-btn="true" placeholder="Email">
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

                                  
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <center><b style="font-size: 14px;color: #3e4095;"></b><br><br></center>
                                    <div class="box">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="state_id">State :</label>
                                                <select name="state_id" id="state_id" class="form-control" required="">
                                                    <option value="23">Tamilnadu</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="district_id">District :</label>
                                                <select name="district_id" id="district_id" class="form-control" required="">
                                                    <option value="23">Salem</option>
                                                </select>
                                            </div>
                                      
                                          
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                  <br>  <br>   <br>
                                                <b><center style="font-size: 14px;color: #3e4095;">Fill Address Details</center></b>
                                                    <label for="residential_address">Representing Address :</label>
                                                    <textarea cols="40" rows="4" name="residential_address" required="required" id="residential_address" placeholder="type here(Maximum 4 Lines)" value="" data-clear-btn="true" class="ui-input-text ui-shadow-inset ui-body-inherit ui-corner-all ui-textinput-autogrow" style="height: 33px;"></textarea>
                                                    
                                            </div>
                                        </div> 
                                        
                                        <div id="paystat"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <center><b style="font-size: 14px;color: #3e4095;">Proof & SECRETARY Photo</b><br><br></center>
                                    <div class="box">
                                        
                                        
                                         <div class="row">
                                            <!-- <div class="col-xs-12 col-sm-12 col-md-12">-->
                                            <!--    <label for="aadhar_number">Aadhar Number</label>-->
                                            <!--    <input type="text" name="aadhar_number" id="aadhar_number" value="" data-clear-btn="true" placeholder="Aadhar Number" required="required">-->
                                                
                                            <!--</div>-->
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="box">
                                                    <div class="ui-field-contain">
                                                        <label for="profile_photo">Passport Size Photo</label>
                                                        <input type="file" name="profile_photo" id="profile_photo" accept="image/png,image/jpg,image/jpeg,image/webp" max-size=1024 required="required" />
                                                        <span style="font-size:12px">* Note: Only WEBP, PNG, JPG, and JPEG formats are supported.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="ui-field-contain">
                                                    <label for="identity_proof">ID Proof Image</label>
                                                    <input type="file" name="identity_proof" id="identity_proof" accept="application/pdf,image/png,image/jpg,image/jpeg" max-size=1024 required="required" />
                                                    <span style="font-size:12px">* Note: Only PDF, PNG, JPG, and JPEG formats are supported.</span>
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
                                        <!--<br /> I hereby declare that-->
                                        </p>
                                        <!--<p align="justify"> 1. I am/was not a registered SECRETARY with any State/U.T. Unit other than the present one.-->
                                        <!--    <br /> I hereby consent to provide my/myward's Aadhaar Offline KYC Data and Passcode for Aadhaar based authentication for -->
                                        <!--</p>-->
                                    </div>
                                </div>
                            </div>
                           <div class="row">
                                <div class="col-xs">
                                    <input type="hidden" value="" name="photourl" id="photourl" />
                                    <input type="hidden" value="" name="dob-data" id="dob-data" />
                                    <input type="hidden" value="" name="applno" id="applno" />
                                    <input type="hidden" value="" name="mode" id="mode" />
                                    <div class="ui-field-contain">
                                        <label for="regstatus">I hereby declare that all the information provided by me in this registration form is true and correct to the best of my knowledge and belief. I understand that any false or misleading information may result in disqualification from participation.

<br><br>I also affirm that I have read, understood, and agree to abide by all the rules, regulations, and guidelines laid down by the Speed Skating Federation of India (SSFI), including any updates or changes made from time to time. I pledge to maintain discipline, sportsmanship, and uphold the integrity of the sport at all times.

<br><br>I fully understand that any violation of the code of conduct or federation norms may lead to penalties, suspension, or expulsion as per the discretion of the concerned authorities.

<br><br>I participate in the sport at my own risk and will not hold the SSFI or any of its affiliated organizers responsible for any injury, loss, or damages that may occur during practice, travel, or competition.</label>
                                        <input id="regstatus" name="regstatus" type="checkbox" required="required" />
                                        <br />
                                        <br />
                                    </div>
                                    <!--<div>-->
                                    <!--    <input type="hidden" value="1" name="plan" id="plan" />-->
                                    <!--</div>-->
                                    <!--<input type="submit" id="submitbutton" value="Register" class="" />-->
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-xs">
                                    <div>
                                        <button type="submit" style="color:white;" id="submitBtn" class="ui-btn ui-corner-all ui-shadow clr-btn-green ui-btn-icon-left ui-icon-pen clr-white">Register >>></button>
                                        <!--<button type="submit" class="btn btn-primary" id="submitBtn" style="background-color: blue; width: 10%; color: white; font-size: 18px;">Register</button>-->
                                    </div>
                                </div>
                            </div>
                                
                            
                        </form>
                    </div>
                </div>
            </div>
            
            <div data-role="main" class="ui-content" id="member_confirmation">
                <div class="col-xs">
                      <div class="box">
                        <div class="nd2-card" style="max-width:none">
                            <div class="row">
                              <div class="col-xs-12" style="padding:10px 20px;">
                                <div class="box">
                                  <center>
                                    <h6 id="txt_title">Your Annual Secretary Registered Already Completed, Waiting for Approval</h6>
                                    <div id="payment_pending" style="padding:15px; font-family: Arial, sans-serif; background-color: #f9f9f9; border-radius: 8px; width:100%; margin: auto;">
                                        <h3 style="color: #2C3E50; text-align: center;">Account Activation Pending</h3>
                                        <p style="text-align: center;">To activate your District Association Registration account, please complete the payment of Rs.3000 /- using the below payment methods:</p>
                                        <div style="display: flex; justify-content: space-around; align-items: center; margin-top: 20px;">
                                            <!-- PhonePe Payment -->
                                            <!--<div style="text-align: center; flex: 1; margin: 0 10px;">-->
                                            <!--    <img src="image/gapy_logo.png" alt="Google Pay Logo"    style="width:95px; height: auto; margin-bottom: 10px;">-->
                                            <!--    <p>Mobile No: <span style="color: #27ae60;">8698462358</span></p>-->
                                            <!--</div>-->
                                            <!-- Google Pay Payment -->
                                            <div style="text-align: center; flex: 1; margin: 0 10px;">
                                                <img src="https://ssfibharatskate.com/images/ssfi_payment_qr.jpeg" alt="PhonePe Logo" style="width:110px; height: auto; margin-bottom: 10px;">
                                              <p style="font-weight: bold; color: #2980B9;">Scan QR Code</p>
                                                <p>Use your UPI payment app to scan the QR code and complete the payment.</p>
                                            </div>
                                            <!-- QR Code Payment -->
                                            <!--<div style="text-align: center; flex: 1; margin: 0 10px;">-->
                                            <!--    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQb0ijC0BqkNvS1WfNm4FDBhNp1pf6WbwnI4Q&s" alt="Payment QR Code" style="width: 100px; height: 100px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 8px;">-->
                                               
                                            <!--</div>-->
                                        </div>
                                        <p style="text-align: center; font-style: italic; color: #7f8c8d; margin-top: 20px;">If you have already made the payment, please wait for the admin's approval. Once approved, you will receive a confirmation email and a WhatsApp message notifying you of the successful activation.</p>
                                    </div>
                                  </center>
                                  <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-3"></div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                      <div style="border: 1px solid gray;border-style: dashed;padding:5px;border-radius:10px;">
                                        <table style="width: 100%;">
                                          <tbody>
                                            <tr>
                                              <td rowspan="1" style="width:20%;">
                                                <img id="confirm_profile" src="" style="width:100px;border-radius: 10px;">
                                              </td>
                                              <td style="vertical-align:top;line-height: 25px;padding-left:10px;">
                                                      Name : <b id="confirm_name"></b>
                                                    <br> Member Id: <b id="confirm_member_id"></b>
                                                    <br> Gender : <b id="confirm_gender"></b>
                                                    <br> Registered State : <b id="confirm_registered_state"></b>
                                                    <br> Registered District : <b id="confirm_registered_district"></b>
                                                    <br> Aadhar No : <b id="confirm_registered_aadhar"></b>
                                                    <br>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td colspan="2" style="text-align:center;">
                                                <a  id="confirm_certicate_download" class="btn btn-primary btn-sm" target="_blank">
                                                  <i class="fa fa-download"></i> Download Confirmation Certificate 
                                                </a>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </div>
                                      <button id="go_home" style="color:white;margin-top:20px" class="ui-btn ui-corner-all ui-shadow clr-btn-green ui-btn-icon-left ui-icon-pen clr-white"> <<< Back To register Page </button>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3"></div>
                                  </div>
                                    <br>
                                  <div>
                                    
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
 $(document).ready(function () {
    // Initially show member_verification and hide member_verification_otp
    $("#member_verification").show();
    $("#member_verification_otp").hide();
    $("#member_regsiter").hide();
    $("#member_confirmation").hide();
    
    getDropDown('tbl_states','state_id','state_name');
    
    $('#state_id').on('change',function(){
    var state_id = $('#state_id').val();
    getDropDown('tbl_districts','district_id','district_name',{'state_id':state_id});
    });
    
    $("#secretaryform").submit(function (e) {
        e.preventDefault();
        let form = $("#secretaryform");
            let submitButton = $("#submitBtn"); // Ensure the submit button has an ID
            let formData = new FormData(form[0]); // Use FormData for file uploads
            let url = '../admin/api/front-api/d-register-secretary.php';
            
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
                            // location.reload();
                            // openPaymentGateWay(response.order_id,response.amount,response.razorpay_api_key);
                            let res = response;
                            $("#member_verification_otp").hide();
                            $('#txt_title').text(res.message);
                            
                            $('#confirm_name').text(res.data.full_name);
                            $('#confirm_member_id').text("********");
                            $('#confirm_gender').text(res.data.gender);
                            $('#confirm_registered_aadhar').text(res.data.aadhar_number);
                            $('#confirm_registered_state').text(res.data.state_name);
                            $('#confirm_registered_district').text(res.data.district_name);
                            $('#confirm_profile').attr('src', "../admin/" + res.data.profile_photo);
                            $('#confirm_certicate_download').hide();
                            
                            $("#member_regsiter").hide();
                            $('#payment_panding').show();
                            $('#contiue_with_payment').hide();
                            $("#member_confirmation").show();
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
    
    
    // On form submit, show OTP verification and hide email verification
    $("#emailForm").submit(function (e) {
        e.preventDefault(); // Prevent form submission
        let email = $('#verify_email_id').val().trim();
        let mobile_no = $('#verify_mobile_no').val().trim();
        // Send AJAX request to backend to generate OTP (optional)
            $.ajax({
                url: "api/generate_otp_secretary.php",  // Replace with your actual API endpoint
                type: "POST",
                data: { mobile_no:mobile_no,email:email },
                dataType: "json",
                success: function(response) {
                    let res = response;
                    console.log(response);
                    if(res.status === "success") {
                        $("#member_verification").hide();
                        $("#member_verification_otp").show();
                        $('#confirmation_mobile_number').text(mobile_no);
                        $('#confirmation_email').text(email);
                    } else {
                        alert("Error sending OTP. Try again.");
                    }
                }
            });
        
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
            
            
            let email = $('#verify_email_id').val().trim();
            let mobile_no = $('#verify_mobile_no').val().trim();
            let aadhar_number = $('#verify_aadhar_number').val().trim();
            
            // Validate OTP via AJAX
            $.ajax({
                url: "api/verify_otp_secretary.php",  // Replace with your actual API endpoint
                type: "POST",
                data: { otp: otp,mobile_no:mobile_no,aadhar_number:aadhar_number,email:email },
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
                            $('#confirm_member_id').text(res.data.member_id);
                            $('#confirm_gender').text(res.data.gender);
                            $('#confirm_registered_aadhar').text(res.data.aadhar_number);
                            $('#confirm_registered_state').text(res.data.state_name);
                            $('#confirm_registered_district').text(res.data.district_name);
                            $('#confirm_profile').attr('src', "../admin/" + res.data.profile_photo);
                            $('#confirm_certicate_download').attr('href', "pdf.php?id=" + res.data.id);
      
                            $('#payment_panding').hide();
                            $('#contiue_with_payment').hide();
                            
                            $("#member_confirmation").show();
                            
                        }else if(res.type==2){ //call order create api
                            alert('Option Coming Soon...');
                        }else if(res.type==3){ //go for payment
                            // $('#txt_title').text(res.message);
                            // $('#confirm_name').text(res.data.full_name);
                            // $('#confirm_member_id').text(res.data.membership_id);
                            // $('#confirm_age_gender').text(res.data.date_of_birth+' / '+res.data.gender);
                            // $('#confirm_category').text(res.data.cat_name);
                            // $('#confirm_level_category').text(res.data.cat_name);
                            // $('#confirm_profile').attr('src', "../ssfi/admin/" + res.data.profile_photo);
                            // $('#confirm_certicate_download').hide();
                            // $('#contiue_with_payment').attr('onclick', 'pay(' + res.data.id + ')');
                            // $("#member_confirmation").show();
                            
                            $("#member_verification_otp").hide();
                            $('#txt_title').text(res.message);
                            
                            $('#confirm_name').text(res.data.full_name);
                            $('#confirm_member_id').text("********");
                            $('#confirm_gender').text(res.data.gender);
                            $('#confirm_registered_aadhar').text(res.data.aadhar_number);
                            $('#confirm_registered_state').text(res.data.state_name);
                            $('#confirm_registered_district').text(res.data.district_name);
                            $('#confirm_profile').attr('src', "../admin/" + res.data.profile_photo);
                            $('#confirm_certicate_download').hide();
      
                            $('#payment_panding').show();
                            $('#contiue_with_payment').hide();
                            
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
        // $("#skaterForm").submit(function (e) {
        //     e.preventDefault();
        //     let form = $("#skaterForm");
        //         let submitButton = $("#submitBtn"); // Ensure the submit button has an ID
        //         let formData = new FormData(form[0]); // Use FormData for file uploads
        //         let url = '../ssfi/admin/api/front-api/d-register-secretary.php';
                
        //         /*if (selectedId) {
        //             formData.append('id', selectedId); // Append ID for update
        //         }*/
        //         // Disable button and show loading spinner
        //         submitButton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving Pls Wait...');
            
        //         $.ajax({
        //             url: url,
        //             type: 'POST',
        //             dataType: 'json',
        //             processData: false,  // Required for FormData
        //             contentType: false,  // Required for FormData
        //             data: formData,
        //             success: function (response) {
        //               console.log(response);
        //                     if (response.status == "success") {
        //                         alert(response.message);
        //                         // openPaymentGateWay(response.order_id,response.amount,response.razorpay_api_key);
        //                         console.log(response)
        //                     } else {
        //                         alert(response.message);
        //                         // submitButton.prop('disabled', false).html('I agree to abide by SSFI Rules & Submit');
        //                     }
        //             },
        //             error: function (xhr) {
        //                 showtoastt('Something Went Wrong...', 'error');
        //                 console.error('Request failed:', xhr);
        //                 submitButton.prop('disabled', false).html('I agree to abide by SSFI Rules & Submit');
        //             },
        //             complete: function () {
        //                 // Re-enable button and restore original text
        //                 submitButton.prop('disabled', false).html('I agree to abide by SSFI Rules & Submit');
        //             }
        //         });
        
        // });
 
 // Go back button functionality
   $(".ui-btn.clr-btn-pink").click(function () {
        $("#member_verification").show();
        $("#member_verification_otp").hide();
    });
 







function getDropDown(tablename, id, value, conditions = {}, selected_id = null) {
    $.ajax({
        url: `../admin/api/helper/drop-down.php?table=${tablename}&columns=id,${value}&orderby=${value}&conditions=${encodeURIComponent(JSON.stringify(conditions))}`,
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
</script>
<?php include "header.php" ?>
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
                                                <small>(OTP will be sent to this whatsapp mobile number.)</small></label>
                                                    <input required="required" type="number" name="verify_mobile_no" pattern="\d{10}" minlength="10" maxlength="10" id="verify_mobile_no" value="" data-clear-btn="true" data-clear-btn="true" placeholder="Type Mobile Number...">
                                                    
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="aadhar_number">Aadhar Number</label>
                                                <input type="number" name="verify_aadhar_number" id="verify_aadhar_number" pattern="\d{16}" value="" data-clear-btn="true" placeholder="Aadhar Number" minlength="16" maxlength="16" required="required">
                                                
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
            
            <div data-role="main" class="ui-content"  id="member_regsiter">
                <div class="nd2-no-menu-swipe">
                    <div class="ui-content" data-inset="false">
                        <form id="clubform" autocorrect="off" spellcheck="false" autocomplete="false">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <center><b style="font-size: 14px;color: #3e4095;">CLUB Information</b><br><br></center>
                                    <div class="box">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="club_name">Club Name:</label>
                                                <input autocomplete="off" required="required" type="text" name="club_name" id="club_name" value="" data-clear-btn="true" placeholder="Type Club Name here...">
                                            </div>
                                           
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="registration_number">Registration Number :</label>
                                                <input required="required" type="number" name="registration_number" id="registration_number" value="" data-clear-btn="true" placeholder="Enter Your Registration Number">
                                            </div>
                                             <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="aadhar_number">Aadhar Number</label>
                                                <input type="text" name="aadhar_number" id="aadhar_number" value="" data-clear-btn="true" placeholder="Enter Your Aadhar Number" required="required">
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="contact_person">Contact Person</label>
                                                <input type="text" name="contact_person" id="contact_person" value="" data-clear-btn="true" placeholder="Enter Your Contact Person" required="required">
                                                
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="mobile_number">Mobile Number :</label>
                                                <input required="required" type="number" name="mobile_number" id="mobile_number" value="" data-clear-btn="true" placeholder="Enter Your Mobile Number">
                                            </div>
                                            
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="email">Email :</label>
                                                <input required="required" type="email" name="email_address" id="email_address" value="" data-clear-btn="true" placeholder="Enter Your Email">
                                            </div>
                                            
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="established_year">Established Year :</label>
                                                <input required="required" type="text" name="established_year" id="established_year" value="" data-clear-btn="true" placeholder="Enter Your Established Year">
                                            </div>
                    
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <center><b style="font-size: 14px;color: #3e4095;">CLUB Contact Details</b><br><br></center>
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
                                                  <!--<br>  <br>  -->
                                                <!--<b><center style="font-size: 14px;color: #3e4095;">Fill Address Details</center></b>-->
                                                    <label for="club_address">Club Address :</label>
                                                    <textarea cols="40" rows="4" name="club_address" required="required" id="club_address" placeholder="type here(Maximum 4 Lines)" value="" data-clear-btn="true" class="ui-input-text ui-shadow-inset ui-body-inherit ui-corner-all ui-textinput-autogrow" style="height: 33px;"></textarea>
                                                    
                                            </div>
                                        </div> 
                                        
                                        <div id="paystat"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <center><b style="font-size: 14px;color: #3e4095;">Club Photo</b><br><br></center>
                                    <div class="box">
                                        
                                        
                                         <div class="row">
                                        
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <!--<div class="ui-field-contain">-->
                                                    <label for="logo">Club Image</label>
                                                    <input type="file" name="logo" id="logo" accept="image/png,image/jpg,image/jpeg,image/webp"  max-size=1024 required="required" />
                                                    <span style="font-size:12px">* Note: Only WEBP, PNG, JPG, and JPEG formats are supported.</span>
                                                    
                                                <!--</div>-->
                                            </div>
                                            
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <!--<div class="ui-field-contain">-->
                                                <br>
                                                    <label for="logo">Authorized Person Passport Photo</label>
                                                    <input type="file" name="passport" id="passport" accept="image/png,image/jpg,image/jpeg,image/webp"  max-size=1024 required="required" />
                                                    <span style="font-size:12px">* Note: Only WEBP, PNG, JPG, and JPEG formats are supported.</span>
                                                    <br>
                                                <!--</div>-->
                                            </div>
                                            
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <!--<div class="ui-field-contain">-->
                                                <br>
                                                    <label for="logo">Id Proof</label>
                                                    <input type="file" name="proof" id="proof" accept="image/png,image/jpg,image/jpeg,image/webp"  max-size=1024 required="required" />
                                                    <span style="font-size:12px">* Note: Only WEBP, PNG, JPG, and JPEG formats are supported.</span>
                                                    <br>
                                                <!--</div>-->
                                            </div>
                                            
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                  <br>
                                                <!--<div class="ui-field-contain">-->
                                                    <label for="logo">Club Logo</label>
                                                    <input type="file" name="club" id="club" accept="image/png,image/jpg,image/jpeg,image/webp"  max-size=1024 />
                                                    <span style="font-size:12px">* Note: Only WEBP, PNG, JPG, and JPEG formats are supported.</span>
                                                    <br>
                                                <!--</div>-->
                                            </div>
                                            
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <!--<div class="ui-field-contain">-->
                                                <br>
                                                    <label for="logo">Club Register Certificate</label>
                                                    <input type="file" name="certificate" id="certificate" accept="image/png,image/jpg,image/jpeg,image/webp"  max-size=1024 required="required" />
                                                    <span style="font-size:12px">* Note: Only WEBP, PNG, JPG, and JPEG formats are supported.</span>
                                                  
                                                <!--</div>-->
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
                                        <label for="regstatus">Agree to terms and conditions All the information given by me is correct and if any information is wrong then I'm the responsible for
                                        this. I obey all the rules and regulations of TNSSA</label>
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
                                        <!--<button type="submit" class="btn btn-primary" id="submitBtn" style="background-color: blue; width: 10%; color: white; font-size: 18px;">Register</button>-->
                                        <button type="submit" style="color:white;" id="submitBtn" class="ui-btn ui-corner-all ui-shadow clr-btn-green ui-btn-icon-left ui-icon-pen clr-white">Register >>></button>
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
                        <div class="nd2-card"  style="max-width:none">
                            <div class="row">
                              <div class="col-xs-12" style="padding:10px 20px;">
                                <div class="box">
                                  <center>
                                    <h6 id="txt_title">Your Annual Secretary Registered Already Completed, Waiting for Approval</h6>
                                    <div id="payment_pending" style="padding:15px; font-family: Arial, sans-serif; background-color: #f9f9f9; border-radius: 8px; width:100%; margin: auto;">
                                        <h3 style="color: #2C3E50; text-align: center;">Account Activation Pending</h3>
                                        <p style="text-align: center;">To activate your account, please complete the payment using one of the methods below:</p>
                                        <div style="display: flex; justify-content: space-around; align-items: center; margin-top: 20px;">
                                             PhonePe Payment 
                                            <div style="text-align: center; flex: 1; margin: 0 10px;">
                                                <img src="image/gapy_logo.png" alt="Google Pay Logo"    style="width:95px; height: auto; margin-bottom: 10px;">
                                                <p>Mobile No: <span style="color: #27ae60;">8698462358</span></p>
                                            </div>
                                             Google Pay Payment 
                                            <div style="text-align: center; flex: 1; margin: 0 10px;">
                                                <img src="image/phonepe_logo.png" alt="PhonePe Logo" style="width:110px; height: auto; margin-bottom: 10px;">
                                                <p>UPI ID: <span style="color: #27ae60;">32467868@ybl</span></p>
                                            </div>
                                             QR Code Payment 
                                            <div style="text-align: center; flex: 1; margin: 0 10px;">
                                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQb0ijC0BqkNvS1WfNm4FDBhNp1pf6WbwnI4Q&s" alt="Payment QR Code" style="width: 100px; height: 100px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 8px;">
                                                <p style="font-weight: bold; color: #2980B9;">Scan QR Code</p>
                                                <p>Use your UPI payment app to scan the QR code and complete the payment.</p>
                                            </div>
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
                                                Club Name : <b id="confirm_club_name"></b>
                                                <br> Member Id: <b id="confirm_member_id"></b>
                                                <br> Registration No : <b id="confirm_registered_no"></b>
                                                <br> Registered State : <b id="confirm_registered_state"></b>
                                                <br> Registered District : <b id="confirm_registered_district"></b>
                                                <br> Established Year : <b id="confirm_established_year"></b>
                                                
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
        </div>
  
    </body>
</html>


<script>

// $(document).ready(function () {
//     getDropDown('tbl_states','state_id','state_name');
    
//     $('#state_id').on('change',function(){
//     var state_id = $('#state_id').val();
//     getDropDown('tbl_districts','district_id','district_name',{'state_id':state_id});
//     });
    
    $("#clubform").submit(function (e) {
            e.preventDefault();
            let form = $("#clubform");
                let submitButton = $("#submitBtn"); // Ensure the submit button has an ID
                let formData = new FormData(form[0]); // Use FormData for file uploads
                let url = '../admin/api/front-api/register-club.php';
                
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
                                // location.reload();
                                let res = response;
                                $("#member_verification_otp").hide();
                                $('#txt_title').text(res.message);
                                
                                $('#confirm_club_name').text(res.data.club_name);
                                $('#confirm_member_id').text("********");
                                $('#confirm_registered_no').text(res.data.registration_number);
                                $('#confirm_registered_state').text(res.data.state_name);
                                $('#confirm_registered_district').text(res.data.district_name);
                                $('#confirm_established_year').text(res.data.established_year);
                                $('#confirm_profile').attr('src', "../ssfi/admin/" + res.data.logo_path);
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
        
        
// });
//     function getDropDown(tablename, id, value, conditions = {}, selected_id = null) {
//     $.ajax({
//         url: `../ssfi/admin/api/helper/drop-down.php?table=${tablename}&columns=id,${value}&orderby=${value}&conditions=${encodeURIComponent(JSON.stringify(conditions))}`,
//         type: "GET",
//         dataType: "json",
//         success: function (response) {
//             console.log(selected_id);
//             if (response.success) {
//                 let dropdown = $(`#${id}`);
//                 dropdown.empty(); // Clear previous options
//                 dropdown.append('<option value="">Select</option>'); // Default option

//                 response.data.forEach(function (item) {
//                     let isSelected = (selected_id && item.id == selected_id) ? 'selected' : '';
//                     dropdown.append(`<option  value="${item.id}" ${isSelected}>${item[value]}</option>`);
//                 });
                
//                 dropdown.trigger("change");
//             } else {
//                 console.error("Error:", response.error);
//             }
//         },
//         error: function (xhr, status, error) {
//             console.error("AJAX Error:", error);
//         }
//     });
// }
</script>




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
    
    // $("#secretaryform").submit(function (e) {
    //         e.preventDefault();
    //         let form = $("#secretaryform");
    //             let submitButton = $("#submitBtn"); // Ensure the submit button has an ID
    //             let formData = new FormData(form[0]); // Use FormData for file uploads
    //             let url = '../ssfi/admin/api/front-api/d-register-secretary.php';
                
    //             /*if (selectedId) {
    //                 formData.append('id', selectedId); // Append ID for update
    //             }*/
    //             // Disable button and show loading spinner
    //             submitButton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving Pls Wait...');
            
    //             $.ajax({
    //                 url: url,
    //                 type: 'POST',
    //                 dataType: 'json',
    //                 processData: false,  // Required for FormData
    //                 contentType: false,  // Required for FormData
    //                 data: formData,
    //                 success: function (response) {
    //                   console.log(response);
    //                         if (response.status == "success") {
    //                             alert(response.message);
    //                             location.reload();
    //                             // openPaymentGateWay(response.order_id,response.amount,response.razorpay_api_key);
    //                         } else {
    //                             alert(response.message);
    //                             submitButton.prop('disabled', false).html('I agree to abide by SSFI Rules & Submit');
    //                         }
    //                 },
    //                 error: function (xhr) {
    //                     showtoastt('Something Went Wrong...', 'error');
    //                     console.error('Request failed:', xhr);
    //                     submitButton.prop('disabled', false).html('I agree to abide by SSFI Rules & Submit');
    //                 },
    //                 complete: function () {
    //                     // Re-enable button and restore original text
    //                     submitButton.prop('disabled', false).html('I agree to abide by SSFI Rules & Submit');
    //                 }
    //             });
        
    //     });
    
    
    // On form submit, show OTP verification and hide email verification
    $("#emailForm").submit(function (e) {
        e.preventDefault(); // Prevent form submission
        // let email = $('#verify_email_id').val().trim();
        let mobile_no = $('#verify_mobile_no').val().trim();
        // Send AJAX request to backend to generate OTP (optional)
            $.ajax({
                url: "api/generate_otp_secretary.php",  // Replace with your actual API endpoint
                type: "POST",
                data: { mobile_no:mobile_no },
                dataType: "json",
                success: function(response) {
                    let res = response;
                    console.log(response);
                    if(res.status === "success") {
                        $("#member_verification").hide();
                        $("#member_verification_otp").show();
                        $('#confirmation_mobile_number').text(mobile_no);
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
            
            
            // let email = $('#verify_email_id').val().trim();
            let mobile_no = $('#verify_mobile_no').val().trim();
            let aadhar_number = $('#verify_aadhar_number').val().trim();
            
            // Validate OTP via AJAX
            $.ajax({
                url: "api/verify_otp_secretary.php",  // Replace with your actual API endpoint
                type: "POST",
                data: { otp: otp,mobile_no:mobile_no,aadhar_number:aadhar_number },
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
                        
                            $('#confirm_club_name').text(res.data.club_name);
                            $('#confirm_member_id').text(res.data.member_id);
                            $('#confirm_registered_no').text(res.data.registration_number);
                            $('#confirm_registered_state').text(res.data.state_name);
                            $('#confirm_registered_district').text(res.data.district_name);
                            $('#confirm_established_year').text(res.data.established_year);
                            $('#confirm_profile').attr('src', "../ssfi/admin/" + res.data.logo_path);
                            $('#confirm_certicate_download').attr('href', "pdf.php?id=" + res.data.id);
      
                            $('#payment_panding').hide();
                            $('#contiue_with_payment').hide();
                            
                            $("#member_confirmation").show();
                            
                        }else if(res.type==2){ //call order create api
                            alert('Option Coming Soon...');
                        }else if(res.type==3){ //go for payment
                            $("#member_verification_otp").hide();
                            $('#txt_title').text(res.message);
                            
                            $('#confirm_club_name').text(res.data.club_name);
                            $('#confirm_member_id').text("********");
                            $('#confirm_registered_no').text(res.data.registration_number);
                            $('#confirm_registered_state').text(res.data.state_name);
                            $('#confirm_registered_district').text(res.data.district_name);
                             $('#confirm_established_year').text(res.data.established_year);
                            $('#confirm_profile').attr('src', "../ssfi/admin/" + res.data.logo_path);
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
</script>
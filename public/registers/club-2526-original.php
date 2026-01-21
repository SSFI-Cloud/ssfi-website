<?php include "header1.php" ?>

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
                                                <label for="mob">Email ID<br>
                                                <small>(OTP will be sent to this email ID.)</small></label>
                                                    <input required="required" type="email" name="verify_email_id" id="verify_email_id" value="" data-clear-btn="true" data-clear-btn="true" placeholder="Type Email Address...">
                                                    
                                            </div>
                                            
                                            <!--<div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="mob">Mobile No<br>
                                                <small>(OTP will be sent to this whatsapp mobile number.)</small></label>
                                                    <input required="required" type="number" name="verify_mobile_no" pattern="\d{10}" minlength="10" maxlength="10" id="verify_mobile_no" value="" data-clear-btn="true" data-clear-btn="true" placeholder="Type Mobile Number...">
                                                    
                                            </div>-->
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
                                                <label for="mob">Email ID<br>
                                                <small>(below Email ID otp has been sended...)</small></label>
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
                                                <input type="number" name="registration_number" id="registration_number" value="" data-clear-btn="true" placeholder="Enter Your Registration Number">
                                            </div>
                                             <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="aadhar_number">Aadhar Number</label>
                                                <input type="text" name="aadhar_number" id="aadhar_number" value="" data-clear-btn="true" placeholder="Enter Your Aadhar Number" required="required">
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="contact_person">Secretary/Coach name</label>
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
                                            
                                            
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                  <label for="blood">T-Shirt Size</label>
                                                   <select name="tshirt_size" id="tshirt_size" required>
                                                            <option value="">-- Select Size --</option>
                                                                <option value="32">32</option>
                                                                <option value="34">34</option>
                                                                <option value="36">36</option>
                                                                <option value="38">38</option>
                                                                <option value="40">40</option>
                                                                <option value="42">42</option>
                                                                <option value="44">44</option>
                                                                <option value="46">46</option>
                                                            </select>
                                                    
                                            </div>
                                            
                                            
                                            
                                        </div> 
                                        
                                        <div id="paystat"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <center><b style="font-size: 14px;color: #3e4095;">Club Photo</b><br><br></center>
                                    <div class="box">
                                        
                                        
                                         <div class="row">
                                        
                                            <!--<div class="col-xs-12 col-sm-12 col-md-12">-->
                                                <!--<div class="ui-field-contain">-->
                                            <!--        <label for="logo">Club Image</label>-->
                                            <!--        <input type="file" name="logo" id="logo" accept="image/png,image/jpg,image/jpeg,image/webp"  max-size=1024 required="required" />-->
                                            <!--        <span style="font-size:12px">* Note: Only WEBP, PNG, JPG, and JPEG formats are supported.</span>-->
                                                    
                                                <!--</div>-->
                                            <!--</div>-->
                                            
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="ui-field-contain">
                                                <br>
                                                    <label for="logo">Secretary/Coach Photo (Passport Size) </label>
                                                    <input type="file" name="passport" id="passport" accept="image/png,image/jpg,image/jpeg,image/webp"  max-size=1024 required="required" />
                                                    <span style="font-size:12px">* Note: Only WEBP, PNG, JPG, and JPEG formats are supported.</span>
                                                    <br>
                                                </div>
                                            </div>
                                            
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="ui-field-contain">
                                                <br>
                                                    <label for="logo">Id Proof</label>
                                                    <input type="file" name="proof" id="proof" accept="image/png,image/jpg,image/jpeg,image/webp"  max-size=1024 required="required" />
                                                    <span style="font-size:12px">* Note: Only WEBP, PNG, JPG, and JPEG formats are supported.</span>
                                                    <br>
                                                </div>
                                            </div>
                                            
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                  <br>
                                                <div class="ui-field-contain">
                                                    <label for="logo">Club Logo</label>
                                                    <input type="file" name="club" id="club" accept="image/png,image/jpg,image/jpeg,image/webp"  max-size=1024 required="required" />
                                                    <span style="font-size:12px">* Note: Only WEBP, PNG, JPG, and JPEG formats are supported.</span>
                                                    <br>
                                                </div>
                                            </div>
                                            
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="ui-field-contain">
                                                <br>
                                                    <label for="logo">Club Register Certificate</label>
                                                    <input type="file" name="certificate" id="certificate" accept="image/png,image/jpg,image/jpeg,image/webp"  max-size=1024  />
                                                    <span style="font-size:12px">* Note: Only WEBP, PNG, JPG, and JPEG formats are supported.</span>
                                                  
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
                                        <label for="regstatus">I hereby declare that the information provide for my Membership with SSFI is true and correct to the best of my knowledge.I understand that any false information may lead to disqualification.</label>
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
            
            
            
            
            <!--  <div data-role="main" class="ui-content" id="member_confirmation1">-->
            <!--    <div class="col-xs">-->
            <!--          <div class="box">-->
            <!--            <div class="nd2-card"  style="max-width:none">-->
            <!--                <div class="row">-->
            <!--                  <div class="col-xs-12" style="padding:10px 20px;">-->
            <!--                    <div class="box">-->
            <!--                      <center>-->
            <!--                        <h6 id="txt_title">Your Annual Secretary Registered Already Completed, Waiting for Approval</h6>-->
            <!--                      </center>-->
            <!--                      <div class="row">-->
            <!--                        <div class="col-xs-3 col-sm-3 col-md-3"></div>-->
            <!--                        <div class="col-xs-6 col-sm-6 col-md-6">-->
            <!--                          <div style="border: 1px solid gray;border-style: dashed;padding:5px;border-radius:10px;">-->
            <!--                            <table style="width: 100%;">-->
            <!--                              <tbody>-->
            <!--                                <tr>-->
            <!--                                  <td rowspan="1" style="width:20%;">-->
            <!--                                    <img id="confirm_profile" src="" style="width:100px;border-radius: 10px;">-->
            <!--                                  </td>-->
            <!--                                  <td style="vertical-align:top;line-height: 25px;padding-left:10px;"> -->
            <!--                                    Club Name : <b id="confirm_club_name"></b>-->
            <!--                                    <br> Member Id: <b id="confirm_member_id"></b>-->
            <!--                                    <br> Registration No : <b id="confirm_registered_no"></b>-->
            <!--                                    <br> Registered State : <b id="confirm_registered_state"></b>-->
            <!--                                    <br> Registered District : <b id="confirm_registered_district"></b>-->
            <!--                                    <br> Established Year : <b id="confirm_established_year"></b>-->
                                                
            <!--                                    <br>-->
            <!--                                  </td>-->
            <!--                                </tr>-->
            <!--                                <tr>-->
            <!--                                  <td colspan="2" style="text-align:center;">-->
            <!--                                    <a  id="confirm_certicate_download" class="btn btn-primary btn-sm" target="_blank">-->
            <!--                                      <i class="fa fa-download"></i> Download Confirmation Certificate -->
            <!--                                    </a>-->
                                                
            <!--                                    <a  id="contiue_with_payment" class="btn btn-primary btn-sm" target="_blank">-->
            <!--                                      <i class="fa fa-download"></i> Continue Payment </a> -->
                                                
                                                
            <!--                                  </td>-->
            <!--                                </tr>-->
            <!--                              </tbody>-->
            <!--                            </table>-->
            <!--                          </div>-->
            <!--                          <button id="go_home" style="color:white;margin-top:20px" class="ui-btn ui-corner-all ui-shadow clr-btn-green ui-btn-icon-left ui-icon-pen clr-white"> <<< Back To register Page </button>-->
                                      
            <!--                        </div>-->
            <!--                        <div class="col-xs-3 col-sm-3 col-md-3"></div>-->
            <!--                      </div>-->
            <!--                      <br>-->
            <!--                      <div>-->
                                
            <!--                      </div>-->
            <!--                    </div>-->
            <!--                  </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--          </div>-->
            <!--        </div>-->
            <!--</div>-->
            
            <div class="container my-4" id="member_confirmation">
  <div class="card shadow">
    <div class="card-body">
      <h6 class="text-center text-primary mb-4" id="txt_title">
        Your Annual Secretary Registered Already Completed, Waiting for Approval
      </h6>

      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12">
          <div class="border border-secondary border-dashed p-3 rounded">

            <div class="row">
              <div class="col-md-4 text-center mb-3">
                <img id="confirm_profile" src="" alt="Profile" class="img-fluid rounded" style="max-width: 100px;">
              </div>

              <div class="col-md-8">
                <p>Club Name: <b id="confirm_club_name"></b></p>
                <p>Member Id: <b id="confirm_member_id"></b></p>
                <p>Registration No: <b id="confirm_registered_no"></b></p>
                <p>Registered State: <b id="confirm_registered_state"></b></p>
                <p>Registered District: <b id="confirm_registered_district"></b></p>
                <p>Established Year: <b id="confirm_established_year"></b></p>
              </div>
            </div>

            <div class="text-center mt-4">
              <a id="confirm_certicate_download" href="#" target="_blank" class="btn btn-primary btn-sm mx-2">
                <i class="fa fa-download"></i> Download Confirmation Certificate
              </a>

              <a id="contiue_with_payment" href="#" target="_blank" class="btn btn-success btn-sm mx-2">
                <i class="fa fa-credit-card"></i> Continue Payment
              </a>
            </div>

            <div class="text-center mt-4">
              <button id="go_home" class="btn btn-outline-secondary">
                <<< Back To Register Page
              </button>
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
                                openPaymentGateWay(response.order_id,response.amount,response.razorpay_api_key);
                                console.log(response)
                            } else {
                                alert(response.message);
                                submitButton.prop('disabled', false).html('I agree to abide by SSFI Rules & Submit');
                                
                                
                                /****************************************/
                                let res = response;
                            if(res.type==1){ //go for register confirmation only download prooof
                                $("#member_verification_otp").hide();
                                $('#txt_title').text(res.message);
                                
                                $('#confirm_club_name').text(res.data.club_name);
                                $('#confirm_member_id').text(res.data.membership_id);
                                $('#confirm_registered_no').text(res.data.registration_number);
                                $('#confirm_registered_state').text(res.data.state_name);
                                $('#confirm_registered_district').text(res.data.district_name);
                                $('#confirm_established_year').text(res.data.established_year);
                                $('#confirm_profile').attr('src', "../admin/" + res.data.club);
                                $('#confirm_certicate_download').hide();
                                
                                $("#member_regsiter").hide();
                                $("#member_confirmation").show();
                        }else if(res.type==2){ //call order create api
                            alert('Option Coming Soon...');
                        }else if(res.type==3){ //go for payment
                            $('#txt_title').text(res.message);
                            $('#confirm_club_name').text(res.data.club_name);
                                $('#confirm_member_id').text(res.data.membership_id);
                                $('#confirm_registered_no').text(res.data.registration_number);
                                $('#confirm_registered_state').text(res.data.state_name);
                                $('#confirm_registered_district').text(res.data.district_name);
                                $('#confirm_established_year').text(res.data.established_year);
                                $('#confirm_profile').attr('src', "../admin/" + res.data.club);
                                $('#confirm_certicate_download').hide();
                            $('#contiue_with_payment').attr('onclick', 'pay(' + res.data.id + ')');
                            $("#member_verification_otp").hide();
                            $("#member_regsiter").hide();
                            $("#member_confirmation").show();
                            
                        }else{ //new Register
                            $("#member_verification_otp").hide();
                            //$('#mobile_number').val(mobile_no);
                            // $('#email_address').val(email).prop('readonly', true);;
                            $("#member_regsiter").show();
                            submitButton.prop('disabled', false).html('I agree to abide by SSFI Rules & Submit');
                        }
                                /****************************************/
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
</script>




<script>


$('#go_home').click(function() {
    window.location.href = '';
});


function pay(id) {
    $.ajax({
        url: '../admin/api/front-api/get-payment-club.php',
        type: 'POST',
        dataType: 'json',
        data: {club_id:id},
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
    
    getDropDown('tbl_states','state_id','state_name');
    
    $('#state_id').on('change',function(){
    var state_id = $('#state_id').val();
    getDropDown('tbl_districts','district_id','district_name',{'state_id':state_id});
    });
    
    
    // On form submit, show OTP verification and hide email verification
    $("#emailForm").submit(function (e) {
        e.preventDefault(); // Prevent form submission
        $("#member_verification").hide();
        $("#loader").show();
        /*let mobile_no = $('#verify_mobile_no').val().trim();*/
        let email = $('#verify_email_id').val().trim();
        // Send AJAX request to backend to generate OTP (optional)
            $.ajax({
                url: "api/generate_club_otp.php",  // Replace with your actual API endpoint
                type: "POST",
                data: { email:email },
                dataType: "json",
                success: function(response) {
                    let res = response;
                    console.log(response);
                    if(res.status === "success") {
                        $("#member_verification").hide();
                        $("#loader").hide();
                        $("#member_verification_otp").show();
                        $('#confirmation_mobile_number').text(email);
                    } else {
                        alert(res.message);
                        $("#loader").hide();
                        $("#member_verification").show();
                    }
                }
            });
        
    });
 });   
 
 
   // OTP verification
        $("#otpForm").submit(function (e) {
            e.preventDefault(); // Prevent default form submission
            
                $('#submitbtn').prop('disabled', true);
                $('#loader').show();
                $('#otpForm').hide();
                
            let otp = $('#otp').val().trim();
            
            let email = $('#verify_email_id').val().trim();
            /*let mobile_no = $('#verify_mobile_no').val().trim();*/
            let aadhar_number = $('#verify_aadhar_number').val().trim();
            
            // Validate OTP via AJAX
            $.ajax({
                url: "api/club-verify-otp.php",  // Replace with your actual API endpoint
                type: "POST",
                data: { otp: otp,aadhar_number:aadhar_number,email:email },
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    let res = response;
                    if(res.status === "success") {
                           $('#loader').hide();
                             $('#otpForm').show();
                        // alert(res.message);
                        
                        if(res.type==1){ //go for register confirmation only download prooof
                            $("#member_verification_otp").hide();
                            $('#aadhar_number').val(aadhar_number).prop('readonly', true);
                            //$('#mobile_number').val(mobile_no);
                            $('#email_address').val(email).prop('readonly', true);
 
                            $('#txt_title').text(res.message);
                        
                            $('#confirm_club_name').text(res.data.club_name);
                            $('#confirm_member_id').text(res.data.membership_id);
                            $('#confirm_registered_no').text(res.data.registration_number);
                            $('#confirm_registered_state').text(res.data.state_name);
                            $('#confirm_registered_district').text(res.data.district_name);
                            $('#confirm_established_year').text(res.data.established_year);
                            $('#confirm_profile').attr('src', "../admin/" + res.data.club);
                            $('#contiue_with_payment').hide();
                                if( res.data.verified==1){
                                    $('#confirm_certicate_download').attr('href', "club-certificate.php?id=" + res.data.id);
                                    $('#confirm_certicate_download').hide();
                                }else{
                                    $('#confirm_certicate_download').hide();
                                }
                               
                            $("#member_confirmation").show();
                            
                        }else if(res.type==2){ //call order create api
                            alert('Option Coming Soon...');
                        }else if(res.type==3){ //go for payment
                            $("#member_verification_otp").hide();
                            $('#txt_title').text(res.message);
                            
                            $('#confirm_club_name').text(res.data.club_name);
                            $('#confirm_member_id').text(res.data.membership_id);
                            $('#confirm_registered_no').text(res.data.registration_number);
                            $('#confirm_registered_state').text(res.data.state_name);
                            $('#confirm_registered_district').text(res.data.district_name);
                            $('#confirm_established_year').text(res.data.established_year);
                            $('#confirm_profile').attr('src', "../admin/" + res.data.club);
                            $('#contiue_with_payment').attr('onclick', 'pay(' + res.data.id + ')');
                            $('#confirm_certicate_download').hide();
                            $("#member_confirmation").show();
                            $('#email_address').val(email).prop('readonly', true);;
                            
                        }else{ //new Register
                            $("#member_verification_otp").hide();
                            $('#aadhar_number').val(aadhar_number).prop('readonly', true);
                            //$('#mobile_number').val(mobile_no);
                            $('#email_address').val(email).prop('readonly', true);;
                            $("#member_regsiter").show();
                        }
                    } else {
                $('#submitbtn').prop('disabled', false);
                $('#loader').hide();
                 $('#otpForm').show();
                        alert("Invalid OTP. Please try again.");
                    }
                }
            });
        });
 
 // Go back button functionality
   $(".ui-btn.clr-btn-pink").click(function () {
        $("#member_verification").show();
        $("#member_verification_otp").hide();
    });
 


function openPaymentGateWay(order_id, amount, razorpay_api_key) {
    var phone = $("#mobile_number").val() ?? '9876543210';
    var email = $("#email_address").val();
    
    var options = {
        "key": razorpay_api_key,
        "amount": (amount * 100), // Convert to paise
        "name": "SSFI-CLUB REGISTER",
        "description": "Club Registration Fees",
        "image": "../admin/assets/img/favicon/SSFI_main.png",
        "order_id": order_id, // Pass the order_id received from PHP
        "handler": function (response) {
            console.log("Payment Success:", response);
            
            fetch("../admin/api/front-api/payment_capture_club.php", {
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
                
                $('#txt_title').text(data.message);
                $('#confirm_club_name').text(data.data.club_name);
                $('#confirm_member_id').text(data.data.membership_id);
                $('#confirm_registered_no').text(data.data.registration_number);
                $('#confirm_registered_state').text(data.data.state_name);
                $('#confirm_registered_district').text(data.data.district_name);
                $('#confirm_established_year').text(data.data.established_year);
                $('#confirm_profile').attr('src', "../admin/" + data.data.club);
                $('#contiue_with_payment').hide();
                if( data.data.verified==1){
                    $('#confirm_certicate_download').attr('href', "club-certificate.php?id=" + data.data.id);
                    $('#confirm_certicate_download').hide();
                }else{
                    $('#confirm_certicate_download').hide();
                }
                
                
                
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
        
        fetch("../admin/api/front-api/payment_capture.php", {
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
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        
    <title>SSFI-SKATER REGISTER -2025-2026</title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../ssfi/admin/assets/img/favicon/ssfa.png" />
        
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
                    <table style="text-align: center;">
                        <tbody>
                            <tr>
                                <td><img src="https://ssfibharatskate.com/ssfi/admin/assets/img/favicon/ssfa.png" class="tnssa-logo" alt="tnssa logo" style="WIDTH: 70px;"></td>
                                <td><b style="font-size: 16px;color: #3e4095;">Speed Skating Federation of India</b><br>
                                    <b>Affiliated to Speed Skating Federation of India SSFI</b><br>
                                    <b>No. 12 Porkudil Nagar,Podumbu - 625018,Madurai</b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </center>
                <center style="padding: 10px;"><b style="font-size: 16px;color: #afa300;">SKATER REGISTRATION 2025 - 2026</b></center>
            </div>
            
            <div data-role="main" class="ui-content" id="success_page">
                    <div class="col-xs">
                      <div class="box">
                        <div class="nd2-card">
                          <form id="emailForm">
                            <div class="row">
                              <div class="col-xs-12" style="padding:10px 20px;">
                                <div class="box">
                                    
                                    <img src="image/success.jpg" style="width:100px;border-radius: 10px; margin-left:40%">
                                  <center><h6>Your Annual Skater Registered Successfully</h6></center>
                                    <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                 <div style="border: 1px solid gray;border-style: dashed;padding:5px;border-radius:10px;">
             <table style="width: 100%;">
                   <tbody>
                       <tr>
                            <td rowspan="1" style="width:20%;">
                                 <img src="https://tnssa.in/registration/api/image/768699314-2023-06-27%2003:24:47%20pm-image.JPG" style="width:100px;border-radius: 10px;">
                            </td>
                            <td style="vertical-align:top;line-height: 25px;padding-left:10px;">
                                    Name : <b>Kavin Nithila NL</b><br>
                                    Register Id: <b>TNSSA-281</b><br>
                                    Age / Gender : <b>9 / Female</b><br>
                                    Age Category : <b>Under 10</b><br>
                                    Level Category : <b>PROFESSIONAL INLINE</b><br>
                                   </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:center;">
                            <a href="confirmation_certificate.php" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-download"></i> Download Confirmation Certificate</a>
                            </td>
                         </tr>
                     </tbody>
        </table>
                                        </div>
                                        </div>  
                                    </div>
                                     <br>
                                    <div>
                                        <button type="submit" style="color:white;" class="ui-btn ui-corner-all ui-shadow clr-btn-green ui-btn-icon-left ui-icon-pen clr-white"><<< Back To register Page</button>
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
    </body>
</html>

<script>
    $(document).ready(function () {
    // Initially show member_verification and hide member_verification_otp
    $("#member_verification").show();
    $("#member_verification_otp").hide();
    $("#member_regsiter").hide();
    
    
    // On form submit, show OTP verification and hide email verification
    $("#emailForm").submit(function (e) {
        e.preventDefault(); // Prevent form submission
        let email = $('#verify_email_id').val().trim();
        let mobile_no = $('#verify_mobile_no').val().trim();
        // Send AJAX request to backend to generate OTP (optional)
            $.ajax({
                url: "api/generate_otp.php",  // Replace with your actual API endpoint
                type: "POST",
                data: { email: email,mobile_no:mobile_no },
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
            
            
            let email = $('#verify_email_id').val().trim();
            let mobile_no = $('#verify_mobile_no').val().trim();
            let aadhar_number = $('#verify_aadhar_number').val().trim();
            
            // Validate OTP via AJAX
            $.ajax({
                url: "api/verify_otp.php",  // Replace with your actual API endpoint
                type: "POST",
                data: { email: email, otp: otp,mobile_no:mobile_no,aadhar_number:aadhar_number },
                dataType: "json",
                success: function(response) {
                    let res = response;
                    if(res.status === "success") {
                        alert("OTP verified successfully.");
                        $("#member_verification_otp").hide();
                        $('#aadhar_number').val(aadhar_number).prop('readonly', true);;
                        $('#mobile_number').val(mobile_no);
                        $('#email_address').val(email).prop('readonly', true);;
                        $("#member_regsiter").show();
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

</script>
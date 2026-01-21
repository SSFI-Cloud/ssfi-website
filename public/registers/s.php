<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="theme-color" content="#33b5e5">
    <title>SKATER REGISTRATION-TNSSA</title>
    <link rel="icon" type="image/x-icon" href="logo.png">
    	 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <link href='https://code.jquery.com/ui/1.12.1/themes/cupertino/jquery-ui.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.0.1/jquery.rateyo.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" ></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<style>
*{
    font-family: "Poppins", serif !important;
  font-weight: 400 !important;
  font-style: normal !important;
}

b{
      font-family: "Poppins", serif !important;
      font-weight: bolder !important;
      font-style: normal !important;
}

    @media only screen and (max-width: 900px) {
        .tnssa-logo{
            width:100%;
        }
    }
    @media only screen and (min-width: 1200px) {
        .tnssa-logo{
            width:675px;
        }
    }
    
    html, body {
        height: 100%;
        margin: 0;
        overflow: hidden; /* Prevent body scrolling */
        background-image: url("https://png.pngtree.com/thumb_back/fh260/background/20231011/pngtree-vibrant-yellow-skateboard-or-skating-surf-board-soaring-against-a-scenic-image_13595541.png");
        background-size: cover;
        background-attachment: fixed;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    /* Scrollable Box */
    .scroll-box {
        width: min(95vw, 2480px); /* Adjusts width dynamically */
        height: 90vh; /* Limits height to viewport */
        background: rgba(255, 255, 255, 93%);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        overflow-y: auto; /* Enables scrolling inside */
        overflow-x: hidden;
        box-sizing: border-box; /* Prevents overflow due to padding */
    }
    
    
</style>
<body >
    
    
    
   

    
    
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">

<script>
$(document).ready(function () {
    let cropper;
    let croppedImageData = "";

    // When user selects an image
    $("#uploadImage").change(function (event) {
        let files = event.target.files;
        let reader = new FileReader();
        reader.onload = function (e) {
            $("#cropImage").attr("src", e.target.result);
            $("#cropModal").show();
            
            if (cropper) {
                cropper.destroy();
            }
            
            cropper = new Cropper(document.getElementById("cropImage"), {
                aspectRatio: 3/2,
                viewMode: 1
            });
        };
        reader.readAsDataURL(files[0]);
    });

    // Crop and Preview
    $("#cropAndPreview").click(function () {
        let canvas = cropper.getCroppedCanvas();
        croppedImageData = canvas.toDataURL("image/png");

        // Show cropped image preview
        $("#previewImage").attr("src", croppedImageData).show();
        $("#submitImage").show();
        $("#cropModal").hide();
    });

    // Submit Cropped Image to PHP
    $("#submitImage").click(function () {
        if (!croppedImageData) {
            alert("Please crop an image first!");
            return;
        }

        $.ajax({
            url: "save_cropped_image.php",
            type: "POST",
            data: { image: croppedImageData },
            success: function (response) {
                alert("Image saved successfully!");
            },
            error: function () {
                alert("Error saving image.");
            }
        });
    });

    // Close modal
    $("#closeModal").click(function () {
        $("#cropModal").hide();
    });
});
</script>
 
    
    
    
    
    
    
    
    
 <div class="scroll-box">  

 <input type="file" id="uploadImage" accept="image/*">
<div id="previewContainer">
    <img id="previewImage" style="max-width: 100px; display: none;">
</div>
<button id="submitImage" style="display: none;">Submit</button>

<!-- Modal -->
<div id="cropModal" style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5);">
    <div style="width: 400px; margin: 10% auto; background: #fff; padding: 20px; position: relative;">
        <img id="cropImage" style="max-width: 100%;">
        <button id="cropAndPreview">Crop & Preview</button>
        <button id="closeModal">Cancel</button>
    </div>
</div>


<div id="register_div">
  <center style="padding: 10px;"><b style="font-size: 16px;color: #afa300;">SKATER ANNUAL REGISTRATION 2025-26</b></center>

<form class="row g-3 needs-validation" method="post"  id="register_form"><!--novalidate-->
   <center style="padding: 10px;"><b style="font-size: 14px;color: #3e4095;">Fill Skater Personal Information Details</b></center>
      <div class="col-md-4">
        <div class="form-outline">
          <input type="text" class="form-control" name="full_name" id="full_name" value="Ganesan" required />
          <label for="validationCustom01" class="form-label required">Full Name (As Per Aadhar)</label>
          <div class="invalid-feedback">Please Provide valid name.<br></div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-outline">
          <input type="text" class="form-control" name="father_name" id="father_name" value="Govindaraja" required />
          <label for="validationCustom02" class="form-label required">Father Name</label>
          <div class="valid-feedback">Looks good!</div>
          <div class="invalid-feedback">Please provide a father name.<br></div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-outline">
          <input type="number" class="form-control active" id="mobile_number" name="mobile_number" value="8124455952" required onkeypress="if(this.value.length==10) return false;"/>
          <label for="validationCustom06" class="form-label required">Mobile Number (Please Provide a Valid Number)</label>
          <div class="invalid-feedback">Please provide a mobile number.</div>
        </div>
        <span style="color: Green; font-size:12px;">Note : </span><span style="font-size:12px;">Provide Valid Whatsapp Number to Receive OTP (Only 10 Number Should be Allowed).</span>
      </div>
  
  <div class="col-md-2">
    <div class="input-group">
      <select name="birth_day" id="birth_day" onchange="Bday()" class="form-control" required="">
            <option value="">Birth Date <span style="text-fill-color: red;">*</span></option>
                       <option value="01">01</option>
                       <option value="02">02</option>
                       <option value="03">03</option>
                       <option value="04">04</option>
                       <option value="05">05</option>
                       <option value="06">06</option>
                       <option value="07" selected>07</option>
                       <option value="08">08</option>
                       <option value="09">09</option>
                       <option value="10">10</option>
                       <option value="11">11</option>
                       <option value="12">12</option>
                       <option value="13">13</option>
                       <option value="14">14</option>
                       <option value="15">15</option>
                       <option value="16">16</option>
                       <option value="17">17</option>
                       <option value="18">18</option>
                       <option value="19">19</option>
                       <option value="20">20</option>
                       <option value="21">21</option>
                       <option value="22">22</option>
                       <option value="23">23</option>
                       <option value="24">24</option>
                       <option value="25">25</option>
                       <option value="26">26</option>
                       <option value="27">27</option>
                       <option value="28">28</option>
                       <option value="29">29</option>
                       <option value="30">30</option>
                       <option value="31">31</option>
                   </select>
        <div class="invalid-feedback">Please select gender.</div>
    </div>
</div>

<div class="col-md-2">
    <div class="input-group">
      <select name="birth_month" id="birth_month" onchange="Bday()" class="form-control" required="">
            <option value="">Birth Month <span style="text-fill-color: red;">*</span></option>
                       <option value="01">01</option>
                       <option value="02">02</option>
                       <option value="03">03</option>
                       <option value="04">04</option>
                       <option value="05" selected>05</option>
                       <option value="06">06</option>
                       <option value="07">07</option>
                       <option value="08">08</option>
                       <option value="09">09</option>
                       <option value="10">10</option>
                       <option value="11">11</option>
                       <option value="12">12</option>
                   </select>
        <div class="invalid-feedback">Please select Birth Month.</div>
    </div>
</div>
  
<div class="col-md-3">
    <div class="input-group">
      <select name="birth_year" id="birth_year" onchange="Bday()" class="form-control" required="">
            <option value="">Birth Year <span style="text-fill-color: red;">*</span></option>
                       <option value="1980">1980</option>
                       <option value="1981">1981</option>
                       <option value="1982">1982</option>
                       <option value="1983">1983</option>
                       <option value="1984">1984</option>
                       <option value="1985">1985</option>
                       <option value="1986">1986</option>
                       <option value="1987">1987</option>
                       <option value="1988">1988</option>
                       <option value="1989">1989</option>
                       <option value="1990">1990</option>
                       <option value="1991">1991</option>
                       <option value="1992">1992</option>
                       <option value="1993">1993</option>
                       <option value="1994">1994</option>
                       <option value="1995">1995</option>
                       <option value="1996">1996</option>
                       <option value="1997">1997</option>
                       <option value="1998">1998</option>
                       <option value="1999">1999</option>
                       <option value="2000">2000</option>
                       <option value="2001">2001</option>
                       <option value="2002">2002</option>
                       <option value="2003">2003</option>
                       <option value="2004">2004</option>
                       <option value="2005">2005</option>
                       <option value="2006">2006</option>
                       <option value="2007">2007</option>
                       <option value="2008">2008</option>
                       <option value="2009">2009</option>
                       <option value="2010">2010</option>
                       <option value="2011">2011</option>
                       <option value="2012">2012</option>
                       <option value="2013">2013</option>
                       <option value="2014" selected>2014</option>
                       <option value="2015">2015</option>
                       <option value="2016">2016</option>
                       <option value="2017">2017</option>
                       <option value="2018">2018</option>
                       <option value="2019">2019</option>
                       <option value="2020">2020</option>
                       <option value="2021">2021</option>
                       <option value="2022">2022</option>
                   </select>
        <div class="invalid-feedback">Please select Birth Year.</div>
    </div>
</div>  
  <div class="col-md-4">
    <div class="input-group form-outline">
      <input type="text" class="form-control active" name="date_of_birth" id="date_of_birth" placeholder="Date Of Birth" required readonly/>
      <label for="validationCustomUsername" class="form-labelrequired"></label>
      <div class="invalid-feedback">Please choose a date of birth.</div>
    </div>
  </div>
  
  <div class="col-md-4">
    <div class="input-group form-outline">
      <input type="text" class="form-control" name="age" id="age" readonly value=" " required />
      <label for="validationCustomUsername" class="form-label required">Age (Auto Calculate Based on Date of Birth)</label>
      <div class="invalid-feedback">Please choose a date of birth.</div>
    </div>
  </div>

   <div class="col-md-4">
    <div class="input-group form-outline">
      <input type="text" class="form-control" name="category_type" id="category_type" readonly value=" " required />
      <label for="validationCustomUsername" class="form-label required">Age Category (Auto Calculate Based on Date of Birth)</label>
      <div class="invalid-feedback">Please choose a date of birth.</div>
    </div>
  </div>

<div class="col-md-4">
    <label class="form-label">Gender <span style="color: red;">*</span></label>
    <div class="d-flex gap-3">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="male" value="Male" checked required>
            <label class="form-check-label" for="Male">Male</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="female" value="Female" required>
            <label class="form-check-label" for="Female">Female</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="other" value="Other" required>
            <label class="form-check-label" for="Other">Other</label>
        </div>
    </div>
    <div class="invalid-feedback">Please select gender.</div>
</div>


  <div class="col-md-4">
    <div class="input-group">
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
      <div class="invalid-feedback">Please provide a blood group.</div>
    </div>
  </div>
  

   <div class="col-md-4">
    <div class="form-outline">
      <input type="text" class="form-control" id="aadhar_number"  name="aadhar_number" value="276020037889" required=""/>
      <label for="validationCustom06" class="form-label required">Aadhar No</label>
      <div class="invalid-feedback">Please provide a aadhar no.</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-outline">
      <input type="email" class="form-control active" id="email_address"  name="email_address" value="ganesan.firstmatrix@gmail.com" required />
      <label for="validationCustom06" class="form-label required">Email </label>
      <div class="invalid-feedback">Please provide a email.</div>
      
    </div><span style="color: Green; font-size:14px;">Note : </span><span style="color: black; font-size:12px;">Provide Valid Email Id for Communication.</span>
  </div>
<div class="col-md-4">
    <div class="input-group">
        <select name="category_type_id" id="category_type_id" class="form-control" required="">
            <option value="">Select Category  <span style="text-fill-color: red;">*</span></option>
            <option value="1">QUAD</option>
            <option value="2" selected>PROFESSIONAL INLINE</option>
            <option value="3">BEGINNER</option>
            <option value="4">FANCY INLINE</option>
        </select>
        <div class="invalid-feedback">Please select category.</div>
    </div>
  </div> 


   <center style="padding: 10px;"><b style="font-size: 14px;color: #3e4095;">Fill Skater Club & Coach Information Details</b></center>
   
   <div class="col-md-4">
    <div class="input-group">
      <select name="state_id" id="state_id" class="form-control" required="">
            				<option value="23">Tamilnadu</option>
				        </select>
        <div class="invalid-feedback">Please select district.</div>
    </div>
  </div>
  
  
    <div class="col-md-4">
    <div class="input-group">
      <select name="district_id" id="district_id" class="form-control" required="">
            				<option value="23">Salem</option>
				        </select>
        <div class="invalid-feedback">Please select district.</div>
    </div>
  </div>
<div class="col-md-4">
    <div class="form-group">
        <select name="club_id" id="club_id" class="form-control" required="">
            <option value="1">Salem Scate Academy <span style="text-fill-color: red;">*</span></option>
           
        </select>

    </div>
  </div>
  
  <div class="col-md-4">
    <div class="form-outline">
      <input type="text" class="form-control" id="school_name" name="school_name" value="GHS"  required/>
      <label for="validationCustom06"  class="form-label required">School Name </label>
      <div class="invalid-feedback">Please provide a school name.</div>
    </div>
  </div>
  
  <div class="col-md-4">
    <div class="form-outline">
      <input type="text" class="form-control" id="coach_name" name="coach_name" value="raj" />
      <label for="validationCustom04" class="form-label optional">Coach Name </label>
      <div class="invalid-feedback">Please provide a Coach Name.</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-outline">
      <input type="number" class="form-control" id="coach_mobile_number" name="coach_mobile_number" value="8667887996"/>
      <label for="validationCustom06" class="form-label optional">Coach Mobile </label>
      <div class="invalid-feedback">Please provide a coach mobile number.</div>
    </div>
  </div>
<center style="padding: 10px;"><b style="font-size: 14px;color: #3e4095;">Fill Address Details</b></center>

  
  <div class="col-md-4">
    <div class="form-outline">
      <textarea class="form-control"  id="residential_address" name="residential_address" required="">292/7 Mahalakshmi complex 1st floor, Omalur Main Rd, Angammal Colony, Salem, Tamil Nadu 636009</textarea>
      <label for="validationCustom06" class="form-label required">Address </label>
      <div class="invalid-feedback">Please provide a address.</div>
    </div>
  </div>
  
  <center style="padding: 10px;"><b style="font-size: 14px;color: #3e4095;">Fill Details For Insurance</b></center>
 
  <!--<div class="col-md-4">
    <div class="form-outline">
      <input type="text" class="form-control" id="nominee_name"  name="nominee_name" required />
      <label for="validationCustom06" class="form-label required">Nominee Name </label>
      <div class="invalid-feedback">Please provide a nominee Name.</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-outline">
      <input type="text" class="form-control" id="nominee_age"  name="nominee_age" required />
      <label for="validationCustom06" class="form-label required">Nominee Age </label>
      <div class="invalid-feedback">Please provide a Nominee Age.</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-outline">
      <input type="text" class="form-control" id="skater_relation"  name="skater_relation" required />
      <label for="validationCustom06" class="form-label required">Relation For Skater </label>
      <div class="invalid-feedback">Please provide a relation for skater.</div>
    </div>
  </div>-->
  
   <center style="padding: 10px;"><b style="font-size: 14px;color: #3e4095;">Update Proof  & Skater Photo </b></center>
<div class="col-md-4">
    <div class="input-group">
      <label for="validationCustom06" class="form-label required">ID Proof Image </label>
      <input type="file" class="form-control" id="identity_proof" name="identity_proof" accept=".jpg,.jpeg,.png" required />
      <div class="invalid-feedback">Please upload Id proof image.</div>
    </div>
    <span style="color: Green; font-size:14px;">Note : </span><span style="color: black; font-size:14px;">png,jpeg format only accepted. & photo maximum size is 2mb</span>
    <span style="color: red;" id="proofspan"></span>
  </div>
  <div class="col-md-4">
    <div class="input-group">
      <label for="validationCustom06" class="form-label required">Passport Size Photo </label>
      <input type="file" class="form-control" id="profile_photo" name="profile_photo" accept=".jpg,.jpeg,.png" required />
      <div class="invalid-feedback">Please upload Passport Size Photo.</div>
    </div>
      <span style="color: Green; font-size:14px;">Note : </span><span style="color: black; font-size:14px;">png,jpeg,pdf format only accepted. & photo maximum size is 2mb</span>
      <span style="color: red;" id="photospan"></span>
  </div>
  <div class="col-md-12"></div>



  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck"  checked required />
      <label class="form-check-label" for="invalidCheck">Agree to terms and conditions</label>
      <span>All the information given by me is correct and if any information is wrong then I'm the responsible for this. I obey all the rules and regulations of TNSSA<br></span>
      <div class="invalid-feedback">Required to Agree to terms and conditions</div>
    </div>
  </div>
  <div class="col-12">
   <center> <button class="btn btn-primary" type="submit">Register</button></center><br></br>
  </div>
</form>
</div>


</div>



 <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Confirm Your Skater Information Details</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    
                    <table sylele="width:100%;">
                        <tr>
                            <td rowspan="3" style="width:20%;"><img src="https://play-lh.googleusercontent.com/jp91-ExBQ474OUbHYcHJFhuH42Z-lHKR_km7YkZGJ7-UaQ0w4TsRWYfrXifPIScG5Yrq=w240-h480-rw" id="profile_preview" style="width: 80px;"/></td>
                            <td>Name: <b><span id="confirmfull_name"></span></b></td>
                        </tr>
                        <tr>
                            <td>Mobile: <b><span id="confirmmobile_number"></span></b></td>
                        </tr>
                        <tr>
                            <td>Date of Birth: <b><span id="confirmdate_of_birth"></span></b></td>
                        </tr>
                        <tr>
                            <td colspan="2">Age: <b><span id="confirmAge"></span></b>
                                <br><span style="font-size: 10px;padding-left:50px;color:green;">(Age calculation based on 01-01-2025 date onwards)</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Email Id: <b><span id="confirmemail_address"></span></b>
                                <br><span style="font-size: 10px;padding-left:50px;color:green;">(You will receive on register confirmation)
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Aadhar No: <b><span id="confirmaadhar_number"></span></b>
                                <br><span style="font-size: 10px;padding-left:50px;color:green;">(Aadhar number based on age verification check)
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Edit Info</button>
                    <button type="button" class="btn btn-success" id="confirmSubmit">Confirm</button>
                </div>
            </div>
        </div>
    </div>



</body>





<style>
td{
    padding:5px 10px;
}
     
.blinking{
	animation:blinkingText 1.0s infinite;
}
@keyframes blinkingText{
	0%{		color: #97e397;	}
	40%{	color: yellow;	}
	50%{	color: #38e538;	}
	99%{	color:#0da70d;	}
	100%{	color: #000;	}
}
     </style>
<!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css"
  rel="stylesheet"
/>
<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"
></script>
<style type="text/css">
  .required::after {
   content: " * ";
   color: red;
   width: 1.5em;
   margin-right: 1.5em;
}
.optional::after {
   content: " (Optional) ";
   color: green;
   width: 1.5em;
   margin-right: 1.5em;
}
</style>
<script>

   // $("#confirmModal").modal("show");

    function isNumberKey(txt, evt) {
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode == 46) {
        //Check if the text already contains the . character
        if (txt.value.indexOf('.') === -1) {
          return true;
        } else {
          return false;
        }
      } else {
        if (charCode > 31 &&
          (charCode < 48 || charCode > 57))
          return false;
      }
      return true;
    }
    
    
   Bday(); 
function Bday() {
    var day = $('#birth_day').val();
    var month = $('#birth_month').val();
    var year = $('#birth_year').val();

    // Ensure values are not empty
    if (day && month && year) {
        // Convert to integer
        day = parseInt(day, 10);
        month = parseInt(month, 10);
        year = parseInt(year, 10);

        // Check if the date is valid
        var Bdate = new Date(year, month - 1, day); // month - 1 because JS months start from 0
        if (Bdate.getFullYear() !== year || Bdate.getMonth() + 1 !== month || Bdate.getDate() !== day) {
            alert("Invalid date! Please select a valid date.");
            return;
        }

        var limitdate = new Date("01/01/2025");
        var Bday = +new Date(year, month - 1, day);
        var Q = ~~((limitdate - Bday) / (31557600000)); // Calculate age 

        $('#date_of_birth').val(year + '-' + month + '-' + day);
        $('#age').val(Q);

        // Assign age category
        if (Q < 4) {
            $('#category_type').val('Under 4');
        } else if (Q < 6) {
            $('#category_type').val('Under 6');
        } else if (Q < 8) {
            $('#category_type').val('Under 8');
        } else if (Q < 10) {
            $('#category_type').val('Under 10');
        } else if (Q < 12) {
            $('#category_type').val('Under 12');
        } else if (Q < 14) {
            $('#category_type').val('Under 14');
        } else if (Q < 16) {
            $('#category_type').val('Under 16');
        } else {
            $('#category_type').val('Above 16');
        }
    }
}

    
    
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
 <script>
        $(document).ready(function () {
            $("#register_form").submit(function (event) {
                event.preventDefault(); // Stop form submission
                console.log("form Popup");
                $("#confirmfull_name").text($("#full_name").val());
                $("#confirmmobile_number").text($("#mobile_number").val());
                $("#confirmdate_of_birth").text($("#date_of_birth").val());
                $("#confirmAge").text($("#age").val());
                $("#confirmaadhar_number").text($("#aadhar_number").val());
                $("#confirmemail_address").text($("#email_address").val());
                $("#confirmModal").modal("show");
            });
            
            // When user confirms, submit the form
            $("#confirmSubmit").click(function () {
                //$("#register_form").off("submit").submit(); // Unbind previous submit event and submit the form
                submitForm();
                console.log("Hit The Server Code");
                
                
            });
        });
        
        //openPaymentGateWay();
        
        
        
        
        
function submitForm() {
    let form = $("#register_form");
    let submitButton = $("#confirmSubmit"); // Ensure the submit button has an ID
    let formData = new FormData(form[0]); // Use FormData for file uploads
    let url = '../ssfi/admin/api/front-api/register-skater.php';

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
                alert(response.order_id);
                openPaymentGateWay(response.order_id,response.amount,response.razorpay_api_key);
            } else {
                alert(response.message);
                submitButton.prop('disabled', false).html('Confirm');
            }
        },
        error: function (xhr) {
            alert('Something Went Wrong...');
            console.error('Request failed:', xhr);
            submitButton.prop('disabled', false).html('Confirm');
        },
        complete: function () {
            // Re-enable button and restore original text
            submitButton.prop('disabled', false).html('Confirm');
        }
    });
}
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        function openPaymentGateWay(order_id,amount,razorpay_api_key){
            var amount=amount;
            var phone=$("#mobile_number").val();
            var email=$("#email_address").val();
            
         //rzp_live_KxA2ObhhPI9pbL-live   ,,,,test Key :rzp_test_FDm6XwduZUC9hK
            var options = {
                    "key": razorpay_api_key,
                    "amount": (amount * 100), // Convert to paise
                    "name": "Tamilnadu Speed Skating Association-TNSSA",
                    "description": "Skater Registration Fees",
                    "image": "logo.png",
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
<script>
    document.getElementById("profile_photo").addEventListener("change", function(event) {
        const file = event.target.files[0]; // Get the selected file
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("profile_preview").src = e.target.result; // Set image preview
            };
            reader.readAsDataURL(file); // Read file as Data URL
        }
    });
</script>
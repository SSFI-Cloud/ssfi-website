
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
</head>
<style>
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
 <div class="scroll-box">  


<div id="register_div">
  <center style="padding: 10px;"><b style="font-size: 16px;color: #afa300;">SKATER ANNUAL REGISTRATION 2025-26</b></center>

<form class="row g-3 needs-validation" method="post"  id="register_form"><!--novalidate-->
   <center style="padding: 10px;"><b style="font-size: 14px;color: #3e4095;">Fill Skater Personal Information Details</b></center>
      <div class="col-md-4">
        <div class="form-outline">
          <input type="text" class="form-control" name="full_name" id="full_name"/>
          <label for="validationCustom01" class="form-label required">Full Name (As Per Aadhar)</label>
        </div>
          <div class="error-message text-danger mt-1"></div>
      </div>
      
     <div class="col-md-4">
        <div class="form-outline">
          <input type="text" class="form-control" name="father_name" id="father_name" />
          <label for="validationCustom02" class="form-label required">Father Name</label>
          <div class="valid-feedback">Looks good!</div>
          <div class="invalid-feedback">Please provide a father name.<br></div>
        </div>
      </div>
      
 
      <div class="col-md-4">
        <div class="form-outline">
          <input type="number" class="form-control active" id="mobile_number" name="mobile_number"onkeypress="if(this.value.length==10) return false;"/>
          <label for="validationCustom06" class="form-label required">Mobile Number (Please Provide a Valid Number)</label>
          <div class="invalid-feedback">Please provide a mobile number.</div>
        </div>
        <span style="color: Green; font-size:12px;">Note : </span><span style="font-size:12px;">Provide Valid Whatsapp Number to Receive OTP (Only 10 Number Should be Allowed).</span>
      </div>
        

  <div class="col-md-2">
    <div class="input-group">
      <select name="birth_day" id="birth_day" onchange="Bday()" class="form-control" >
            <option value="">Birth Date <span style="text-fill-color: red;">*</span></option>
                       <option value="01">01</option>
                       <option value="02">02</option>
                       <option value="03">03</option>
                       <option value="04">04</option>
                       <option value="05">05</option>
                       <option value="06">06</option>
                       <option value="07">07</option>
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
      <select name="birth_month" id="birth_month" onchange="Bday()" class="form-control" >
            <option value="">Birth Month <span style="text-fill-color: red;">*</span></option>
                       <option value="01">01</option>
                       <option value="02">02</option>
                       <option value="03">03</option>
                       <option value="04">04</option>
                       <option value="05">05</option>
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
      <select name="birth_year" id="birth_year" onchange="Bday()" class="form-control" >
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
                       <option value="2014">2014</option>
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
      <input type="text" class="form-control active" name="date_of_birth" id="date_of_birth" placeholder="Date Of Birth"readonly/>
      <label for="validationCustomUsername" class="form-labelrequired"></label>
      <div class="invalid-feedback">Please choose a date of birth.</div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="input-group form-outline">
      <input type="text" class="form-control" name="age" id="age" readonly value=" "/>
      <label for="validationCustomUsername" class="form-label required">Age (Auto Calculate Based on Date of Birth)</label>
      <div class="invalid-feedback">Please choose a date of birth.</div>
    </div>
  </div>

   <div class="col-md-4">
    <div class="input-group form-outline">
      <input type="text" class="form-control" name="agecat" id="agecat" readonly value=" "/>
      <label for="validationCustomUsername" class="form-label required">Age Category (Auto Calculate Based on Date of Birth)</label>
      <div class="invalid-feedback">Please choose a date of birth.</div>
    </div>
  </div>


<div class="col-md-4">
    <label class="form-label">Gender <span style="color: red;">*</span></label>
    <div class="d-flex gap-3">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="male" value="Male" >
            <label class="form-check-label" for="male">Male</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="female" value="Female" >
            <label class="form-check-label" for="female">Female</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="other" value="Other" >
            <label class="form-check-label" for="other">Other</label>
        </div>
    </div>
    <div class="invalid-feedback">Please select gender.</div>
</div>

  <div class="col-md-4">
    <div class="input-group">
        <select name="blood_group" id="blood_group" class="form-control" >
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
        </select>
      <div class="invalid-feedback">Please provide a blood group.</div>
    </div>
  </div>
  


   <div class="col-md-4">
    <div class="form-outline">
      <input type="text" class="form-control" id="aadhar_number"  name="aadhar_number" />
      <label for="validationCustom06" class="form-label optional">Aadhar No</label>
      <div class="invalid-feedback">Please provide a aadhar no.</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-outline">
      <input type="email" class="form-control active" id="email"  name="email"/>
      <label for="validationCustom06" class="form-label required">Email </label>
      <div class="invalid-feedback">Please provide a email.</div>
      
    </div><span style="color: Green; font-size:14px;">Note : </span><span style="color: black; font-size:12px;">Provide Valid Email Id for Communication.</span>
  </div>
<div class="col-md-4">
    <div class="input-group">
        <select name="category_type_id" id="category_type_id" class="form-control" >
            <option value="">Select Category  <span style="text-fill-color: red;">*</span></option>
            <option value="QUAD">QUAD</option>
            <option value="PROFESSIONAL INLINE">PROFESSIONAL INLINE</option>
            <option value="BEGINNER">BEGINNER</option>
            <option value="FANCY INLINE">FANCY INLINE</option>
        </select>
        <div class="invalid-feedback">Please select category.</div>
    </div>
  </div> 


   <center style="padding: 10px;"><b style="font-size: 14px;color: #3e4095;">Fill Skater Club & Coach Information Details</b></center>
    <div class="col-md-4">
    <div class="input-group">
      <select name="district_id" id="district_id" class="form-control" >
            <option value="">Select District  <span style="text-fill-color: red;">*</span></option>
            				<option value="7">CHENGALPET</option>
								<option value="20">CHENNAI</option>
								<option value="21">COIMBATORE</option>
								<option value="22">CUDDALORE</option>
								<option value="13">DHARMAPURI </option>
								<option value="23">DINDIGUL</option>
								<option value="15">ERODE</option>
								<option value="6">KANCHIPURAM</option>
								<option value="25">KANYAKUMARI</option>
								<option value="3">KARUR</option>
								<option value="26">KRISHNAGIRI</option>
								<option value="27">MADURAI</option>
								<option value="14">NAMAKKAL </option>
								<option value="29">NILGIRIS</option>
								<option value="31">PUDUKOTTAI</option>
								<option value="32">RAMANATHAPURAM</option>
								<option value="50">RANIPET</option>
								<option value="8">SALEM</option>
								<option value="34">SIVAGANGAI</option>
								<option value="35">TENKASI</option>
								<option value="36">THANJAVUR</option>
								<option value="37">THENI</option>
								<option value="4">THIRUVALLUR</option>
								<option value="10">THOOTHUKUDI</option>
								<option value="9">TIRUCHIRAPALLI</option>
								<option value="49">TIRUPATHUR </option>
								<option value="16">TIRUPPUR</option>
								<option value="39">TIRUVANNAMALAI</option>
								<option value="12">VELLORE</option>
								<option value="45">VILLUPURAM</option>
								<option value="17">VIRUDHUNAGAR</option>
				        </select>
        <div class="invalid-feedback">Please select district.</div>
    </div>
  </div>
<div class="col-md-4">
    <div class="form-group">
        <select name="clubname" id="clubname" class="form-control" >
            <option value="">Select District First <span style="text-fill-color: red;">*</span></option>
           
        </select>

    </div>
  </div>

  
  <div class="col-md-4">
    <div class="form-outline">
      <input type="text" class="form-control" id="school" name="school"  />
      <label for="validationCustom06"  class="form-label required">School Name </label>
      <div class="invalid-feedback">Please provide a school name.</div>
    </div>
  </div>
  
  <div class="col-md-4">
    <div class="form-outline">
      <input type="text" class="form-control" id="coach_name" name="coach_name" />
      <label for="validationCustom04" class="form-label optional">Coach Name </label>
      <div class="invalid-feedback">Please provide a Coach Name.</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-outline">
      <input type="number" class="form-control" id="coach_mobile_number" name="coach_mobile_number" />
      <label for="validationCustom06" class="form-label optional">Coach Mobile </label>
      <div class="invalid-feedback">Please provide a coach mobile number.</div>
    </div>
  </div>
<center style="padding: 10px;"><b style="font-size: 14px;color: #3e4095;">Fill Address Details</b></center>

   
  <div class="col-md-4">
    <div class="form-outline">
      <input type="text" class="form-control" id="taluk"  name="taluk"/>
      <label for="validationCustom06" class="form-label required">City </label>
      <div class="invalid-feedback">Please provide a city.</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-outline">
      <textarea class="form-control"  id="address" name="address" ></textarea>
      <label for="validationCustom06" class="form-label required">Address </label>
      <div class="invalid-feedback">Please provide a address.</div>
    </div>
  </div>
  
  <center style="padding: 10px;"><b style="font-size: 14px;color: #3e4095;">Fill Details For Insurance</b></center>
 
  <div class="col-md-4">
    <div class="form-outline">
      <input type="text" class="form-control" id="nominee_name"  name="nominee_name"/>
      <label for="validationCustom06" class="form-label required">Nominee Name </label>
      <div class="invalid-feedback">Please provide a nominee Name.</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-outline">
      <input type="text" class="form-control" id="nominee_age"  name="nominee_age"/>
      <label for="validationCustom06" class="form-label required">Nominee Age </label>
      <div class="invalid-feedback">Please provide a Nominee Age.</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-outline">
      <input type="text" class="form-control" id="skater_relation"  name="skater_relation"/>
      <label for="validationCustom06" class="form-label required">Relation For Skater </label>
      <div class="invalid-feedback">Please provide a relation for skater.</div>
    </div>
  </div>
  
   <center style="padding: 10px;"><b style="font-size: 14px;color: #3e4095;">Update Proof  & Skater Photo </b></center>
<div class="col-md-4">
    <div class="input-group">
      <label for="validationCustom06" class="form-label required">ID Proof Image </label>
      <input type="file" class="form-control" id="idproof" name="idproof" accept=".jpg,.jpeg,.png"/>
      <div class="invalid-feedback">Please upload Id proof image.</div>
    </div>
    <span style="color: Green; font-size:14px;">Note : </span><span style="color: black; font-size:14px;">png,jpeg format only accepted. & photo maximum size is 2mb</span>
    <span style="color: red;" id="proofspan"></span>
  </div>
  <div class="col-md-4">
    <div class="input-group">
      <label for="validationCustom06" class="form-label required">Passport Size Photo </label>
      <input type="file" class="form-control" id="photo" name="photo" accept=".jpg,.jpeg,.png"/>
      <div class="invalid-feedback">Please upload Passport Size Photo.</div>
    </div>
      <span style="color: Green; font-size:14px;">Note : </span><span style="color: black; font-size:14px;">png,jpeg,pdf format only accepted. & photo maximum size is 2mb</span>
      <span style="color: red;" id="photospan"></span>
  </div>
  <div class="col-md-12"></div>



  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck"/>
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

<!--full_name-->
<!--father_name-->
<!--mobile_number-->
<!--birth_day-->
<!--birth_month-->
<!--birth_year-->
<!--date_of_birth-->
<!--age-->
<!--agecat-->
<!--male-->
<!--female-->
<!--other-->
<!--blood_group-->
<!--aadhar_number-->
<!--email-->
<!--category_type_id-->
<!--district_id-->
<!--clubname-->
<!--school-->
<!--coach_name-->
<!--coach_mobile_number-->
<!--taluk-->
<!--address-->
<!--nominee_name-->
<!--nominee_age-->
<!--skater_relation-->
<!--idproof-->
<!--proofspan-->
<!--photo-->
<!--photospan-->
                  <!--id`, `membership_id`, `full_name`, `father_name`, `mobile_number`, `date_of_birth`, `category_type_id`, `gender`, `blood_group`, `school_name`, `aadhar_number`, `email_address`,-->
      <!--`club_id`, `coach_name`, `coach_mobile_number`, `state_id`, `district_id`, `residential_address`, `identity_proof`, `profile_photo`, `created_at`, `updated_at`);-->

 <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Your Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Name:</strong> <span id="confirmName"></span></p>
                    <p><strong>Mobile:</strong> <span id="confirmMobile"></span></p>
                    <p><strong>Birthdate:</strong> <span id="confirmBday"></span></p>
                    <p><strong>Age:</strong> <span id="confirmAge"></span></p>
                    <p><strong>Age Category:</strong> <span id="confirmAgeCat"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Edit</button>
                    <button type="button" class="btn btn-success" id="confirmSubmit">Confirm</button>
                </div>
            </div>
        </div>
    </div>



</body>





<style>
     
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

        var limitdate = new Date("01/01/2024");
        var Bday = +new Date(year, month - 1, day);
        var Q = ~~((limitdate - Bday) / (31557600000)); // Calculate age

        $('#sd').val(year + '-' + month + '-' + day);
        $('#age').val(Q);

        // Assign age category
        if (Q < 4) {
            $('#agecat').val('Under 4');
        } else if (Q < 6) {
            $('#agecat').val('Under 6');
        } else if (Q < 8) {
            $('#agecat').val('Under 8');
        } else if (Q < 10) {
            $('#agecat').val('Under 10');
        } else if (Q < 12) {
            $('#agecat').val('Under 12');
        } else if (Q < 14) {
            $('#agecat').val('Under 14');
        } else if (Q < 16) {
            $('#agecat').val('Under 16');
        } else {
            $('#agecat').val('Above 16');
        }
    }
}

    
    
</script>


//  <script>
//         $(document).ready(function () {
//             // $("#registrationForm").submit(function (event) {
//             //     event.preventDefault(); // Stop form submission
//             //     console.log("form Popup");
//             // });
            
            
            
            
//     $('#branchForm').on('submit', function (e) {
//         e.preventDefault();
//         if (this.checkValidity()) {
//             submitBranchForm();
//         } else {
//             this.classList.add('was-validated');
//         }
//     });
            
            
//             // When user confirms, submit the form
//             // $("#confirmSubmit").click(function () {
//             //     //$("#registrationForm").off("submit").submit(); // Unbind previous submit event and submit the form
                
//             //     console.log("Hit The Server Code");
                
//             // });
//         });
                
</script>
<script>
    let selectedId = null; // Ensure selectedId is defined

    document.addEventListener("DOMContentLoaded", function () {
        let form = document.getElementById("register_form");

        if (form) {
            form.addEventListener("submit", function (e) {
                e.preventDefault();
                if (validateForm()) {
                    submitForm();
                }
            });
        }
    });

    function validateForm() {
        let isValid = true;
        let fields = [
            { id: "membership_id", message: "Membership ID is required." },
            { id: "full_name", message: "Full Name is required." },
            { id: "father_name", message: "Father Name is required." },
            { id: "mobile_number", message: "Mobile Number is required.", pattern: /^\d{10}$/, errorMsg: "Enter a valid 10-digit Mobile Number." },
            { id: "date_of_birth", message: "Date of Birth is required.", pattern: /^\d{4}-\d{2}-\d{2}$/, errorMsg: "Enter a valid Date of Birth (YYYY-MM-DD)." },
            { id: "category_type_id", message: "Category Type is required." },
            { id: "gender", message: "Please select Gender.", select: true },
            { id: "blood_group", message: "Blood Group is required." },
            { id: "school_name", message: "School Name is required." },
            { id: "aadhar_number", message: "Aadhar Number is required.", pattern: /^\d{12}$/, errorMsg: "Enter a valid 12-digit Aadhar Number." },
            { id: "email_address", message: "Email Address is required.", pattern: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/, errorMsg: "Enter a valid Email Address." },
            { id: "club_id", message: "Club ID is required." },
            { id: "coach_name", message: "Coach Name is required." },
            { id: "coach_mobile_number", message: "Coach Mobile Number is required.", pattern: /^\d{10}$/, errorMsg: "Enter a valid 10-digit Mobile Number." },
            { id: "state_id", message: "Please select a State.", select: true },
            { id: "district_id", message: "Please select a District.", select: true },
            { id: "residential_address", message: "Residential Address is required." }
        ];

        if (!selectedId) {
            fields.push({ id: "identity_proof", message: "Identity Proof is required." });
            fields.push({ id: "profile_photo", message: "Profile Photo is required." });
        }

        // Remove previous errors
        document.querySelectorAll(".error-message").forEach(el => el.remove());
        document.querySelectorAll(".is-invalid").forEach(el => el.classList.remove("is-invalid"));

        fields.forEach(({ id, message, pattern, errorMsg, select }) => {
            let input = document.getElementById(id);
            if (!input) return;

            let value = input.value.trim();
            let errorMessage = "";

            if (!value) {
                errorMessage = message;
                isValid = false;
            } else if (pattern && !pattern.test(value)) {
                errorMessage = errorMsg;
                isValid = false;
            }

            if (errorMessage) {
                input.classList.add("is-invalid");
                showError(input, errorMessage);
            }
        });

        return isValid;
    }

    function showError(input, message) {
        let errorDiv = document.createElement("div");
        errorDiv.className = "error-message text-danger mt-1";
        errorDiv.innerText = message;
        input.insertAdjacentElement("afterend", errorDiv);
    }

    function submitForm() {
        let form = $("#register_form");
        let submitButton = $("#submitBtn");
        let formData = new FormData(form[0]);
        let url = selectedId ? 'api/skaters/update.php' : 'api/skaters/create.php';

        if (selectedId) {
            formData.append('id', selectedId);
        }

        submitButton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving Please Wait...');

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert("Form submitted successfully!");
                submitButton.prop('disabled', false).html('Submit');
            },
            error: function(xhr) {
                alert("Error submitting form. Please try again.");
                submitButton.prop('disabled', false).html('Submit');
            }
        });
    }
</script>

<?php include('header.php');?>
<link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
<link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />
<link rel="stylesheet" href="assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
<link rel="stylesheet" href="assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
<link rel="stylesheet" href="assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
<link rel="stylesheet" href="assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />
<link rel="stylesheet" href="assets/vendor/libs/select2/select2.css" />
<link rel="stylesheet" href="assets/vendor/libs/@form-validation/form-validation.css" />
        
    <!-- Content -->
    <div class="container-xxl flex-grow-1" style="padding: 0px 10px;">
        <div class="card" style="margin-bottom:5px;min-height: 85vh !important;">
            <div class="row" style="padding: 5px 5px;">
                    <div class="col-md-8">                            
                        <h6 class="card-header" ><i class="ri-file-list-3-fill"></i><span id="title_text"></span> : Skater Member Register Form Details</h6>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="skater-list.php"><button type="button" class="btn btn-xs rounded-pill btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#userModal">
                            <i class="ri-arrow-left-circle-fill"></i> &nbsp;&nbsp; Back to Skater List
                          </button></a>
                    </div>
            </div>    
            <div class="row" style="padding: 5px 20px;"> 
            <?php if(!isset($_GET['id']) && isset($_SESSION) && $_SESSION['user_id']!=1 ){ echo '<center><img src="dist/access-denied.png" style="width:200px;"/><center>'; }else{  ?>
                    <form id="skaterForm" novalidate enctype="multipart/form-data">
    <div class="row mb-1">
        <div class="col-sm-4">
            <h6 class="card-header" style="font-size:14px;color: brown;"><i class="ri-file-list-3-fill"></i><span id="title_text"></span> : Skater Personal Information</h6>
            <div class="row mb-1">
                    <div class="col-sm-6 mt-2">
                        <label for="full_name" style="font-size:12px;color: darkgrey;" class="required-label">Name</label>
                        <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Enter your name" required/>
                    </div>
                    
                    <div class="col-sm-6 mt-2">
                        <label for="father_name" style="font-size:12px;color: darkgrey;" class="required-label">Father Name</label>
                        <input type="text" name="father_name" id="father_name" class="form-control" placeholder="Enter father name" required/>
                    </div>
                    
                    <div class="col-sm-6 mt-2">
                        <label style="font-size:12px;color: darkgrey;" class="required-label">Gender</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender_male" value="Male" checked required>
                            <label class="form-check-label" for="gender_male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender_female" value="Female" required>
                            <label class="form-check-label" for="gender_female">Female</label>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 mt-2">
                        <label for="school_name" style="font-size:12px;color: darkgrey;" class="required-label">School Name</label>
                        <input type="text" name="school_name" id="school_name" class="form-control" placeholder="Enter your School Name" required/>
                    </div>
                    
                    <div class="col-sm-6 mt-2">
                        <label for="email_address" style="font-size:12px;color: darkgrey;" class="required-label">E-mail</label>
                        <input type="email" name="email_address" id="email_address" class="form-control" placeholder="Enter your E-mail" required/>
                    </div>
                    <div class="col-sm-6 mt-2">
                    <label for="mobile_number" style="font-size:12px;color: darkgrey;" class="required-label">Mobile Number</label>
                    <input type="number" name="mobile_number" id="mobile_number" class="form-control" placeholder="Enter your mobile number" required/>
                </div>
                <div class="col-sm-6 mt-2">
                    <label for="state_id" style="font-size:12px;color: darkgrey;" class="required-label">State Id</label>
                    <select id="state_id" name="state_id" class="form-select" required>
                        <option value="">Select State Id</option>
                        <!-- Add dynamic options here -->
                    </select>
                </div>
                
                <div class="col-sm-6 mt-2">
                    <label for="district_id" style="font-size:12px;color: darkgrey;" class="required-label">District Id</label>
                    <select id="district_id" name="district_id" class="form-select" required>
                        <option value="">Select District Id</option>
                        <!-- Add dynamic options here -->
                    </select>
                </div>
                
                <div class="col-sm-6 mt-2">
                    <label for="date_of_birth" style="font-size:12px;color: darkgrey;" class="required-label">Date Of Birth <small>(AS PER AADHAAR)</small></label>
                    <input type="date" name="date_of_birth" id="date_of_birth" onchange="Bday()" class="form-control" placeholder="Enter your date of birth" required/>
                </div>
                
                <div class="col-sm-12 mt-2">
                    <label for="date_of_birth" style="font-size:12px;color: darkgrey;" >Age <small>(Age is calculated as on cut of date 01-01-2025) : <b id="days"></b></small></label>
                    <input type="text" name="age" id="age" class="form-control" placeholder="Age is calculated as on cut of date 01-01-2025" readonly/>
                </div>
                
                <div class="col-sm-12 mt-2">
                    <label for="date_of_birth" style="font-size:12px;color: darkgrey;">Age Category <small>(Auto calculated based on date of birth)</small></label>
                    <input type="text" name="agecat" id="agecat" class="form-control" placeholder="Auto calculated based on date of birth" readonly/>
                </div>
                
                <div class="col-sm-12 mt-2">
                    <label for="blood_group" style="font-size:12px;color: darkgrey;" class="required-label">Blood Group</label> 
                    <select id="blood_group" name="blood_group" class="form-select" required>
                        <option value="">Select Blood Group</option>
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
                
                
                
                

            </div>
        </div>
        <div class="col-sm-4">
            <h6 class="card-header" style="font-size:14px;color: brown;"><i class="ri-file-list-3-fill"></i><span id="title_text"></span> : Registration Details</h6>
            <div class="row mb-1">
                <div class="col-sm-6 mt-2">
                    <label for="category_type_id" style="font-size:12px;color: darkgrey;" class="required-label">Category Id</label>
                    <select id="category_type_id" name="category_type_id" class="form-select" required>
                        <option value="">Select Category</option>
                        <option value="">1</option>
                        <!-- Add dynamic options here -->
                    </select>
                </div>
                
                    <div class="col-sm-6 mt-2">
                        <label for="school_name" style="font-size:12px;color: darkgrey;" class="required-label">Nominee Name</label>
                        <input type="text" name="nominee_name" id="nominee_name" class="form-control" placeholder="Type  Nominee Name here" required/>
                    </div>
                    <div class="col-sm-6 mt-2">
                        <label for="school_name" style="font-size:12px;color: darkgrey;" class="required-label">Nominee Age</label>
                        <input type="number" name="nominee_age" id="nominee_age" class="form-control" placeholder="Type Nominee age here" required/>
                    </div>
                    <div class="col-sm-6 mt-2">
                        <label for="school_name" style="font-size:12px;color: darkgrey;" class="required-label">Nominee relation with skater</label>
                        <input type="text" name="nominee_relation" id="nominee_relation" class="form-control" placeholder="Enter your School Name" required/>
                    </div>
                
                
                <div class="col-sm-12 mt-2">
                    <label for="club_id" style="font-size:12px;color: darkgrey;" class="required-label">Select Club</label>
                    <select id="club_id" name="club_id" class="form-select" required>
                        <option value="">Select Club</option>
                        <option value="">1</option>
                        <!-- Add dynamic options here -->
                    </select>
                </div>
                
                <div class="col-sm-6 mt-2">
                    <label for="coach_name" style="font-size:12px;color: darkgrey;" class="required-label">Coach Name</label>
                    <input type="text" name="coach_name" id="coach_name" class="form-control" placeholder="Enter Your Coach Name" required/>
                </div>
                
                <div class="col-sm-6 mt-2">
                    <label for="coach_mobile_number" style="font-size:12px;color: darkgrey;" class="required-label">Coach Mobile Number</label>
                    <input type="tel" name="coach_mobile_number" id="coach_mobile_number" class="form-control" placeholder="Enter your Coach Mobile Number" required/>
                </div>
                <div class="col-sm-12 mt-2">
                    <label for="district_id" style="font-size:12px;color: darkgrey;" class="required-label">I am</label>
                    <select id="i_am" name="i_am" class="form-select" required>
                        <option value="Studying in School - STATE Board">Studying in School - STATE Board</option>
                        <option value="Studying in School - CBSE">Studying in School - CBSE</option>
                        <option value="Studying in School - ICSE">Studying in School - ICSE</option>
                        <option value="Studying in School - ISE">Studying in School - ISE</option>
                        <option value="Studying in School/ College / University">Studying in School/ College / University</option>
                        <option value="Studying in School / College / University - Private / Open">Studying in School / College / University - Private / Open</option>
                        <option value="Working">Working</option>
                        <option value="Self-Employed / Business">Self-Employed / Business</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="col-sm-12 mt-2">
                    <label for="residential_address" style="font-size:12px;color: darkgrey;" class="required-label">Residential Address</label>
                    <textarea id="residential_address" name="residential_address" rows="4" class="form-control" placeholder="Enter Your Address" required></textarea>
                </div>

            </div>
        </div>
        <div class="col-sm-4">
            <h6 class="card-header" style="font-size:14px;color: brown;"><i class="ri-file-list-3-fill"></i><span id="title_text"></span> : Proof & Skater Photo</h6>
            <div class="row mb-1">
                <div class="col-sm-8 mt-2">
                        <label for="aadhar_number" style="font-size:12px;color: darkgrey;" class="required-label">Aadhar Number</label>
                        <input type="number" name="aadhar_number" id="aadhar_number" class="form-control" placeholder="Enter your Aadhar Number" required/>
                </div>
                <div class="col-sm-6 mt-2">
                    <label class="required-label" style="font-size:12px;color: darkgrey;"  for="identity_proof" id="identity_proof_label">Identity Proof</label>
                    <input type="file" name="identity_proof" class="form-control" id="identity_proof" accept="image/*" required/>
                </div>
                <div class="col-sm-6 mt-2">
                    <label class="required-label" style="font-size:12px;color: darkgrey;"  for="identity_proof" id="profile_photo_label">Profile Photo</label>
                    <input type="file" name="profile_photo" class="form-control" id="profile_photo" accept="image/*" required/>
                </div>
                
                <div class="col-sm-6 mt-2">
                    <img src="assets/img/favicon/SSFI_main.png" id="identityPreview" style="width:200px;"/>
                </div>
                <div class="col-sm-6 mt-2">
                    <img src="assets/img/favicon/SSFI_main.png" id="profilePreview" style="width:200px;"/>
                </div>
                
                <div class="col-sm-12 text-end">
                    &nbsp;
                </div>
                <div class="col-sm-12 text-end">
                    <button type="submit" class="btn btn-xs rounded-pill btn-success waves-effect waves-light" id="submitBtn">Register Skater</button>
                </div>
            </div>
        </div>
    </div>
</form>
            <?php } ?>
            </div>
        </div>
    </div>
    <!-- / Content -->
 
 
 
 
 <style>
     .col-form-label {
    padding-bottom: 2px !important;
    padding-top: 2px !important;
    margin-bottom: 2px !important;
     }
     .mb-4 {
    margin-bottom: 3px !important;
}
.form-control {
    padding: 5px !important;
}
.form-select {
    padding: 5px !important;
}

 </style>
 

<!-- Vendors JS -->
<script src="assets/vendor/libs/jquery/jquery.js"></script>
<script src="assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="assets/vendor/libs/select2/select2.js"></script>
<script src="assets/vendor/libs/@form-validation/popular.js"></script>
<script src="assets/vendor/libs/@form-validation/bootstrap5.js"></script>
<script src="assets/vendor/libs/@form-validation/auto-focus.js"></script>
   <script>
    $(document).ready(function () {
        getDropDown('tbl_states','state_id','state_name');
        getDropDown('tbl_category_type','category_type_id','cat_name');
        getDropDown('tbl_clubs','club_id','club_name');
    });
    $('#state_id').on('change',function(){
        var state_id = $('#state_id').val();
        getDropDown('tbl_districts','district_id','district_name',{'state_id':state_id});
    });
    
    $('#district_id').on('change',function(){
        var district_id = $('#district_id').val();
        //getDropDown('tbl_districts','district_id','district_name',{'state_id':state_id});
        getDropDown('tbl_clubs','club_id','club_name',{'district_id':district_id});
    });

document.addEventListener("DOMContentLoaded", function () {
    function getQueryParam(param) {
        let urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    let selectedId = getQueryParam("id");
    if (selectedId) {
        $('#title_text').text("Update");
        $("#identity_proof_label").removeClass("required-label");
        $("#profile_photo_label").removeClass("required-label");
        $("#update_image_hide").hide();
        editSkater(selectedId);
    }else{
        $('#title_text').text("Create");
    }






function editSkater(id) {
        if (!id) {
            console.error("Invalid ID provided.");
            return;
        }
        
        
        $.get(`api/skaters/read_single.php?id=${encodeURIComponent(id)}`, function (data) {
         if (data) {
             
                getDropDown('tbl_states','state_id','state_name',{},data.state_id);
                getDropDown('tbl_districts','district_id','district_name',{'state_id':data.state_id},data.district_id);
                getDropDown('tbl_clubs','club_id','club_name',{'district_id':data.district_id},data.club_id);
                getDropDown('tbl_category_type','category_type_id','cat_name',{},data.category_type_id);
             
                $('#full_name').val(data.full_name);
                $('#father_name').val(data.father_name);
                $('#mobile_number').val(data.mobile_number);
                $('#date_of_birth').val(data.date_of_birth);
                $('#blood_group').val(data.blood_group);
                $('#school_name').val(data.school_name);
                $('#aadhar_number').val(data.aadhar_number);
                $('#email_address').val(data.email_address);
                $('#coach_name').val(data.coach_name);
                $('#coach_mobile_number').val(data.coach_mobile_number);
                $('#residential_address').val(data.residential_address);
                $('#i_am').val(data.i_am);
                
                $('#nominee_name').val(data.nominee_name);
                $('#nominee_age').val(data.nominee_age);
                $('#nominee_relation').val(data.nominee_relation);
                
                if (data.gender === 'Male') {
                    $('#gender_male').prop('checked', true);
                } else if (data.gender === 'Female') {
                    $('#gender_female').prop('checked', true);
                }
                
                if (data.identity_proof) {
                    $('#identityPreview').attr('src', `${data.identity_proof}`).show();
                }
                if (data.profile_photo) {
                    $('#profilePreview').attr('src', `${data.profile_photo}`).show();
                }
                Bday();
                
                
            } else {
                console.error("No data received for the given ID.");
            }
        }).fail(function (xhr) {
            console.error("Error fetching client details:", xhr.responseText);
        });
    }
    
    




    let form = document.getElementById("skaterForm");
    if (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            if (validateForm()) {
                submitForm();
            }
        });
    }
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
        { id: "i_am", message: "is required." },
        { id: "nominee_relation", message: "is required." },
        { id: "nominee_age", message: "is required." },
        { id: "nominee_name", message: "is required." },
        { id: "residential_address", message: "Residential Address is required." },
        { id: "age", message: "Age is required." },
        { id: "agecat", message: "Age Category is required." },
        ];
        
        // Add identity_proof and profile_photo only if selectedId is NOT present
        if (!selectedId) {
            fields.push({ id: "identity_proof", message: "Identity Proof is required." });
            fields.push({ id: "profile_photo", message: "Profile Photo is required." });
        }

        document.querySelectorAll(".error-message").forEach(el => el.remove());

        fields.forEach(field => {
            let input = document.getElementById(field.id);
            if (!input) return;

            let errorMessage = "";
            if (!input.value.trim()) {
                errorMessage = field.message;
                isValid = false;
            } else if (field.pattern && !field.pattern.test(input.value)) {
                errorMessage = field.errorMsg;
                isValid = false;
            }

            if (errorMessage) {
                input.classList.add("is-invalid");
                showError(input, errorMessage);
            } else {
                input.classList.remove("is-invalid");
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
    let form = $("#skaterForm");
    let submitButton = $("#submitBtn"); // Ensure the submit button has an ID
    let formData = new FormData(form[0]); // Use FormData for file uploads
    let url = selectedId ? 'api/skaters/update.php' : 'api/skaters/create.php';
    
    if (selectedId) {
        formData.append('id', selectedId); // Append ID for update
    }
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
                showtoastt(response.message, 'success');
                if (!selectedId) {
                    form[0].reset(); // Reset form only for create
                }
            } else {
                showtoastt(response.message, 'error');
                submitButton.prop('disabled', false).html('Register Skater');
            }
        },
        error: function (xhr) {
            showtoastt('Something Went Wrong...', 'error');
            console.error('Request failed:', xhr);
            submitButton.prop('disabled', false).html('Register Skater');
        },
        complete: function () {
            // Re-enable button and restore original text
            submitButton.prop('disabled', false).html('Register Skater');
        }
    });
}


});

function Bday() {

         
var dob = $('#date_of_birth').val();
console.log('Date of Birth:', dob);
// Optional: extract day, month, year if needed
if (dob) {
    var dateParts = dob.split('-'); // Format: YYYY-MM-DD
    var year = dateParts[0];
    var month = dateParts[1];
    var day = dateParts[2];
    console.log('Year:', year, 'Month:', month, 'Day:', day);
}
         
         
         
            if(day!="" && month!="" && year!="" ){
                var Q4A = "Your birthday is: ";
                var Bdate = ''+year+'-'+month+'-'+day;
                //$('#sd').val(Bdate);
                var limitdate = new Date("01/01/2025");
                var Bday = +new Date(Bdate);
                 Q= ~~ ((limitdate - Bday) / (31557600000));
                $('#age').val(Q);
                if(Q<2){
                    $('#agecat').val('Under 4');   
                }else if(Q<4){
                    $('#agecat').val('Under 4');
                }
                else if(Q<6){
                    $('#agecat').val('Under 6');
                }
                else if(Q<8){
                    $('#agecat').val('Under 8');
                }
                else if(Q<10){
                    $('#agecat').val('Under 10');
                }
                else if(Q<12){
                    $('#agecat').val('Under 12');
                }
                else if(Q<14){
                    $('#agecat').val('Under 14');
                }
                else if(Q<16){
                    $('#agecat').val('Under 16');
                }
                else{
                    $('#agecat').val('Above 16');
                }
            }
}
</script>
<?php include('footer.php')?>

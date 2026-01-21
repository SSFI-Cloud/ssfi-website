<?php include('header.php')?>
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
        <div class="card" style="margin-bottom:5px;">
            <div class="row" style="padding: 5px 5px;">
                    <div class="col-md-8">
                        <h6 class="card-header" ><i class="ri-file-list-3-fill"></i> State Secretary Form Details</h6>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="s-secretary-list.php"><button type="button" class="btn btn-xs rounded-pill btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#userModal">
                            <i class="ri-arrow-left-circle-fill"></i> &nbsp;&nbsp; Back to State Secretary List
                          </button></a>
                    </div>
            </div>    
            <div class="row" style="padding: 5px 20px;"> 
<form id="secretary" novalidate enctype="multipart/form-data">
 <div class="row mb-4">
     <center><h6 class="mt-4">Personal Details</h6></center>
    <div class="col-sm-6">
   
    <div class="row mb-4">
        <!-- Mobile Number -->
        <label class="col-sm-4 col-form-label required-label" for="full_name">Name</label>
        <div class="col-sm-8">
            <input type="text" name="full_name" class="form-control" id="full_name" 
            placeholder="Enter your name" required/>
        </div>
    </div>
    <!-- <div class="row mb-4">-->
         
    <!--    <label class="col-sm-4 col-form-label required-label">Gender</label>-->
    <!--    <div class="col-sm-8">-->
    <!--        <div class="form-check form-check-inline">-->
    <!--            <input class="form-check-input" type="radio" name="gender" id="gender" value="Male" checked required>-->
    <!--            <label class="form-check-label" for="status_active">Male</label>-->
    <!--        </div>-->
    <!--        <div class="form-check form-check-inline">-->
    <!--            <input class="form-check-input" type="radio" name="gender" id="gender" value="Female" required>-->
    <!--            <label class="form-check-label" for="status_inactive">Female</label>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <div class="row mb-4">
        <label class="col-sm-4 col-form-label required-label">Gender</label>
        <div class="col-sm-8">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="gender_male" value="Male" checked required>
                <label class="form-check-label" for="gender_male">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="gender_female" value="Female" required>
                <label class="form-check-label" for="gender_female">Female</label>
            </div>
        </div>
    </div>

   
    <div class="row mb-4">
        <!-- Registration Number -->
        <label class="col-sm-4 col-form-label required-label" for="email_address">E-mail</label>
        <div class="col-sm-8">
            <input type="email" name="email_address" class="form-control" id="email_address" placeholder="Enter your E-mail" required/>
        </div>
    </div>
    
    
    
        <div class="row mb-4">
        <!-- Registration Number -->
        <label class="col-sm-4 col-form-label required-label" for="aadhar_number">Aadhar Number</label>
        <div class="col-sm-8">
            <input type="number" name="aadhar_number" class="form-control" id="aadhar_number" placeholder="Enter your Aadhar Number" required/>
        </div>
    </div>
    
    <div class="row mb-4">
        <!-- Registration Number -->
        <label class="col-sm-4 col-form-label required-label" for="state_id">State Id</label>
        <div class="col-sm-8">
         <select id="state_id" name="state_id" class="form-select" required>
                <option value="">Select State Id</option>
                <!-- Add dynamic options here -->
            </select>
    </div>
    </div>
    
    </div>
     <div class="col-sm-6">
    
    <div class="row mb-4">
        <!-- Email Address -->
        <label class="col-sm-4 col-form-label required-label" for="email_address">Mobile Numer</label>
        <div class="col-sm-8">
            <input type="number" name="mobile_number" class="form-control" id="mobile_number" placeholder="Enter your mobile number" required/>
        </div>
    </div>
    <!--<div class="row mb-4">-->
        <!-- Club Name -->
    <!--    <label class="col-sm-4 col-form-label required-label" for="date_of_birth">Date Of Birth</label>-->
    <!--    <div class="col-sm-8">-->
    <!--        <input type="date" name="date_of_birth" class="form-control" id="date_of_birth" placeholder="Enter your date Of Birth" required/>-->
    <!--    </div>-->
    <!--</div>-->
    <!--<div class="row mb-4">-->
        <!-- Registration Number -->
    <!--    <label class="col-sm-4 col-form-label required-label" for="blood_group">Blood Group</label>-->
    <!--    <div class="col-sm-8">-->
    <!--        <select id="blood_group" name="blood_group" class="form-select" required>-->
    <!--            <option value="">Select Blood Group</option>-->
    <!--            <option value="A+">A+</option>-->
    <!--            <option value="A-">A-</option>-->
    <!--            <option value="B+">B+</option>-->
    <!--            <option value="B-">B-</option>-->
    <!--            <option value="O+">O+</option>-->
    <!--            <option value="O-">O-</option>-->
    <!--            <option value="AB+">AB+</option>-->
    <!--            <option value="AB-">AB-</option>-->
                <!-- Add dynamic options here -->
    <!--        </select>-->
    <!--    </div>-->
    <!--</div>-->
  
       <div class="row mb-4">
        <!--residential_address -->
        <label class="col-sm-4 col-form-label required-label" for="residential_address">Residential Address</label>
        <div class="col-sm-8">
            <textarea id="residential_address" name="residential_address" rows="5"  class="form-control" placeholder="Enter Your Address" required></textarea>
        </div>
    </div>
    
</div>


 
    
  <center><h6 class="mt-4">Identity Details</h6></center>


<div class="col-sm-6">
    <div class="row mb-4">
        <!-- Identity Proof Upload Preview -->
        <label class="col-sm-4 col-form-label required-label" for="identity_proof" id="identity_proof_label">Identity Proof</label>
        <div class="col-sm-8 text-center">
            <img id="identity_proof_preview" src="https://ssfibharatskate.com/ssfi/admin/assets/img/favicon/ssfa.png" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;" />
            <input type="file" name="identity_proof" class="form-control mt-2" id="identity_proof" accept="image/*" required/>
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="row mb-4">
        <!-- Profile Photo Upload Preview -->
        <label class="col-sm-4 col-form-label required-label" for="profile_photo" id="profile_photo_label">Profile Photo</label>
        <div class="col-sm-8 text-center">
            <img id="profile_photo_preview" src="https://ssfibharatskate.com/ssfi/admin/assets/img/favicon/ssfa.png" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;" />
            <input type="file" name="profile_photo" class="form-control mt-2" id="profile_photo" accept="image/*" required/>
        </div>
    </div>
</div>



</div>
    <div class="row mb-4">
        <!-- Submit Button -->
        <div class="col-sm-12 text-end">
            <button type="submit" class="btn btn-success" id="submitBtn">Register State Secretary</button>
        </div>
    </div>
</form>
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

    });
    // $('#state_id').on('change',function(){
    //     var state_id = $('#state_id').val();
    //     getDropDown('tbl_districts','district_id','district_name',{'state_id':state_id});
    // });

   
document.addEventListener("DOMContentLoaded", function () {
    function getQueryParam(param) {
        let urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    let selectedId = getQueryParam("id");
    if (selectedId) {
        $('#title_text').text("Update");
        editClient(selectedId);
    }else{
        $('#title_text').text("Create");
    }

    function editClient(id) {
        if (!id) {
            console.error("Invalid ID provided.");
            return;
        }
//         `membership_id`, `full_name`, `father_name`, `mobile_number`, `date_of_birth`, `category_type_id`, 
// `gender`, `blood_group`, `school_name`, `aadhar_number`, `email_address`, `club_id`, `coach_name`, `coach_mobile_number`, `state_id`, `district_id`, `residential_address`, 
// `identity_proof`, `profile_photo`
        
        $.get(`api/s-secretary/read_single.php?id=${encodeURIComponent(id)}`, function (data) {
         if (data) {
            $('#full_name').val(data.full_name);
            $('#mobile_number').val(data.mobile_number);
            $('#aadhar_number').val(data.aadhar_number);
            $('#email_address').val(data.email_address);
            getDropDown('tbl_states', 'state_id', 'state_name', {}, data.state_id);
            // getDropDown('tbl_districts', 'district_id', 'district_name', { 'state_id': data.state_id }, data.district_id);
            $("input[name='gender'][value='" + data.gender + "']").prop("checked", true);
            $('#residential_address').val(data.residential_address);
            if (data.identity_proof) {
                $('#identity_proof_preview').attr('src', `${data.identity_proof}`).show();
                // $('#identity_proof').val(data.identity_proof); 
            }
            if (data.profile_photo) {
                $('#profile_photo_preview').attr('src', `${data.profile_photo}`).show();
                // $('#profile_photo').val(data.profile_photo); 
            }
            } else {
                console.error("No data received for the given ID.");
            }
        }).fail(function (xhr) {
            console.error("Error fetching client details:", xhr.responseText);
        });
    }

    let form = document.getElementById("secretary");
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
        { id: "full_name", message: "Full Name is required." },
        { id: "mobile_number", message: "Mobile Number is required.", pattern: /^\d{10}$/, errorMsg: "Enter a valid 10-digit Mobile Number." },
        { id: "gender", message: "Please select Gender.", select: true },
        { id: "aadhar_number", message: "Aadhar Number is required.", pattern: /^\d{12}$/, errorMsg: "Enter a valid 12-digit Aadhar Number." },
        { id: "email_address", message: "Email Address is required.", pattern: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/, errorMsg: "Enter a valid Email Address." },
        { id: "state_id", message: "Please select a State.", select: true },
        // { id: "district_id", message: "Please select a District.", select: true },
        { id: "residential_address", message: "Residential Address is required." },
        
        ];
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
    let form = $("#secretary");
    let submitButton = $("#submitBtn"); // Ensure the submit button has an ID
    let formData = new FormData(form[0]); // Use FormData for file uploads
    let url = selectedId ? 'api/s-secretary/update.php' : 'api/s-secretary/create.php';

    if (!validateForm()) {
        return;
    }

    if (selectedId) {
        formData.append('id', selectedId); // Append ID for update
    }

    // Disable button and show loading spinner
    submitButton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');

    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        processData: false,  // Required for FormData
        contentType: false,  // Required for FormData
        data: formData,
        success: function (response) {
            console.log(response);
            if (response.status === "success") {
                showtoastt(response.message, 'success');
                if (!selectedId) {
                    form[0].reset(); // Reset form only for create
                }
            } else {
                showtoastt(response.message, 'error');
            }
        },
        error: function (xhr) {
            showtoastt('Something Went Wrong...', 'error');
            console.error('Request failed:', xhr);
        },
        complete: function () {
            // Re-enable button and restore original text
            submitButton.prop('disabled', false).html(selectedId ? 'Update Details' : 'Register Details');
        }
    });
}
});


</script>
<script>
document.getElementById('identity_proof').addEventListener('change', function(event) {
    previewImage(event, 'identity_proof_preview');
});

document.getElementById('profile_photo').addEventListener('change', function(event) {
    previewImage(event, 'profile_photo_preview');
});

function previewImage(event, previewElementId) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById(previewElementId).src = reader.result;
        };
        reader.readAsDataURL(file);
    }
}
</script>
<?php include('footer.php')?>

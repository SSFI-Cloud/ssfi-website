<?php require_once('header.php'); ?>
<!-- Vendors CSS -->
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
                        <h6 class="card-header" ><i class="ri-file-list-3-fill"></i> Club <span id="title_text">Creation</span> Form Details</h6>
                    </div>
                    <div class="col-md-4 text-end">
                        <a onclick="getContent('club-list.php')"><button type="button" class="btn btn-xs rounded-pill btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#userModal">
                            <i class="ri-arrow-left-circle-fill"></i> &nbsp;&nbsp; Back to Club List
                          </button></a>
                    </div>
            </div>    
            <div class="row" style="padding: 5px 20px;"> 
<form id="clubForm" novalidate>
 <div class="row mb-4">
    <div class="col-sm-6">
    <div class="row mb-4">
        <!-- Club Name -->
        <label class="col-sm-4 col-form-label" for="club_name">Club Name</label>
        <div class="col-sm-8">
            <input type="text" name="club_name" class="form-control" id="club_name" placeholder="Enter Club Name" required/>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Registration Number -->
        <label class="col-sm-4 col-form-label" for="registration_number">Registration Number</label>
        <div class="col-sm-8">
            <input type="text" name="registration_number" class="form-control" id="registration_number" placeholder="Reg No." required/>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Contact Person -->
        <label class="col-sm-4 col-form-label" for="contact_person">Contact Person</label>
        <div class="col-sm-8">
            <input type="text" name="contact_person" class="form-control" id="contact_person" placeholder="Person Name" required/>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Mobile Number -->
        <label class="col-sm-4 col-form-label" for="mobile_number">Mobile Number</label>
        <div class="col-sm-8">
            <input type="tel" name="mobile_number" class="form-control" id="mobile_number" maxlength="10" pattern="\d{10}" oninput="this.value=this.value.slice(0,10)" placeholder="(123) 456-7890" required/>
        </div>
    </div>
    <div class="row mb-4">
        <!-- Email Address -->
        <label class="col-sm-4 col-form-label" for="email_address">Email</label>
        <div class="col-sm-8">
            <input type="email" name="email_address" class="form-control" id="email_address" placeholder="club@example.com" required/>
        </div>
    </div>

    

    <div class="row mb-4">
        <!-- State -->
        <label class="col-sm-4 col-form-label" for="state_id">State</label>
        <div class="col-sm-8">
            <select id="state_id" name="state_id" class="form-select" required>
                <option value="">Select State</option>
                <!-- Add dynamic options here -->
            </select>
        </div>
    </div>
    
    <div class="row mb-4">
        <!-- District -->
        <label class="col-sm-4 col-form-label" for="district_id">District</label>
        <div class="col-sm-8">
            <select id="district_id" name="district_id" class="form-select" required>
                <option value="">Select District</option>
                <!-- Add dynamic options here -->
            </select>
        </div>
    </div>
    
    
</div>
<div class="col-sm-6">
    

    <div class="row mb-4">
        <!-- Club Address -->
        <label class="col-sm-4 col-form-label" for="club_address">Address</label>
        <div class="col-sm-8">
            <textarea id="club_address" name="club_address" class="form-control" placeholder="Enter Address" required></textarea>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Established Year -->
        <label class="col-sm-4 col-form-label" for="established_year">Established Year</label>
        <div class="col-sm-8">
            <input type="number" name="established_year" class="form-control" id="established_year" min="1900" max="2025" placeholder="YYYY" required/>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Logo Upload -->
        <label class="col-sm-4 col-form-label" for="logo_path">Club Logo</label>
        <div class="col-sm-8">
            <input type="file" name="logo_path" class="form-control" id="logo_path" accept="image/*" required/>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Status -->
        <label class="col-sm-4 col-form-label">Status</label>
        <div class="col-sm-8">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="status_active" value="active" required>
                <label class="form-check-label" for="status_active">Active</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="status_inactive" value="inactive">
                <label class="form-check-label" for="status_inactive">Inactive</label>
            </div>
        </div>
    </div>
</div>
</div>
    <div class="row mb-4">
        <!-- Submit Button -->
        <div class="col-sm-12 text-end">
            <button type="submit" class="btn btn-success">Register Club</button>
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
 <?php require_once('footer.php'); ?>

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
        
    $('#state_id').on('change',function(){
        console.log('state fetch');
        var state_id = $('#state_id').val();
        getDropDown('tbl_districts','district_id','district_name',{'state_id':state_id});
    });
        // $('.select2').select2({
        //     allowClear: true
        // });
        // getBranch();
   
document.addEventListener("DOMContentLoaded", function () {
    function getQueryParam(param) {
        let urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    let selectedId = getQueryParam("id");
    if (selectedId) {
        $('#title_text').text("Update");
        editClub(selectedId);
    }else{
        $('#title_text').text("Create");
    }

    function editClub(id) {
    if (!id) {
        console.error("Invalid ID provided.");
        return;
    }
    $.get(`api/club/read_single.php?id=${encodeURIComponent(id)}`, function (data) {
          console.log(data.state_id+'stephen');
        if (data) {
            console.log(data);
            $('#club_name').val(data.club_name);
            $('#registration_number').val(data.registration_number);
            $('#contact_person').val(data.contact_person);
            $('#mobile_number').val(data.mobile_number);
            $('#email_address').val(data.email_address);
            $('#state_id').val(data.state_id).trigger('change');  // Ensure dropdown updates
            $('#district_id').val(data.district_id).trigger('change');
            $('#club_address').val(data.club_address);
            
            $('#established_year').val(data.established_year);
            // Set status radio buttons
            if (data.status === 'active') {
                $('#status_active').prop('checked', true);
            } else if (data.status === 'inactive') {
                $('#status_inactive').prop('checked', true);
            }
            console.log(data.state_id+'stephen');
            getDropDown('tbl_states','state_id','state_name',data.state_id);
            getDropDown('tbl_districts','district_id','district_name',{'state_id':state_id},data.district_id);

        } else {
            console.error("No data received for the given ID.");
        }
    }).fail(function (xhr) {
        console.error("Error fetching club details:", xhr.responseText);
    });
}


    let form = document.getElementById("clubForm");
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
            { id: "club_name", message: "Club Name is required." },
            { id: "registration_number", message: "Registration Number is required." },
            { id: "contact_person", message: "Contact Person is required." },
            { id: "mobile_number", message: "Mobile Number is required.", pattern: /^\d{10}$/, errorMsg: "Enter a valid 10-digit Mobile Number." },
            { id: "state_id", message: "Please select a State.", select: true },
            { id: "district_id", message: "Please select a District.", select: true },
        ];

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
        let formData = $("#clientForm").serialize();
        let url = selectedId ? 'api/client/update.php' : 'api/client/create.php';

         $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: formData,  
            success: function (response) {
                alert(response);
                console.log(response);
                showtoastt(response.message, 'success');
   
            },
            error: function (xhr) {
                showtoastt('Something Went Wrong...', 'red');
                console.error('Request failed:', xhr);
            }
        });
    }
});


</script>
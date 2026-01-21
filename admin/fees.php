<?php include 'header.php' ?>
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
                        <h6 class="card-header" ><i class="ri-file-list-3-fill"></i>Fees <span id="title_text"></span> Details</h6>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="index.php"><button type="button" class="btn btn-xs rounded-pill btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#userModal">
                            <i class="ri-arrow-left-circle-fill"></i> &nbsp;&nbsp; Back to Dashboard
                          </button></a>
                    </div>
            </div>    
            <div class="row" style="padding: 5px 20px;"> 
            <form id="clubForm" novalidate enctype="multipart/form-data">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        
                    <div class="row mb-4">
                
                        <label class="col-sm-4 col-form-label required-label" for="skater_fees">Skater Fees</label>
                        <div class="col-sm-8">
                            <input type="number" name="skater_fees" class="form-control" id="skater_fees" placeholder="Skater Fees" required/>
                        </div>
                    </div>
                
                    <div class="row mb-4">
                
                        <label class="col-sm-4 col-form-label required-label" for="district_fees">District Fees</label>
                        <div class="col-sm-8">
                            <input type="number" name="district_fees" class="form-control" id="district_fees" placeholder="District Fees" required/>
                        </div>
                    </div>
                
                    <div class="row mb-4">
                
                        <label class="col-sm-4 col-form-label required-label" for="state_fees">State Fees</label>
                        <div class="col-sm-8">
                            <input type="number" name="state_fees" class="form-control" id="state_fees" placeholder="State Fees" required/>
                        </div>
                    </div>
                
                </div>
            </div>
                
                <div class="row mb-4">
                    <!-- Submit Button -->
                    <div class="col-sm-12 text-end">
                        <button type="submit" class="btn btn-success" id="submitBtn">Update Fees Details</button>
                    </div>
                </div>
            </form>
            </div>
            <div class="row" style="padding: 5px 20px;"> 
                <div class="col-sm-12">
<div class="card">
   <div class="card-header" style="background-color: #6c757d; color: white;">
    <h5 class="mb-0" style="color: white;">Instructions for Skater Fees, District Fees, and State Fees</h5>
</div>

    <br>
    <div class="card-body">
        <ul>
            <li>
                <strong>Fees Valid For One Year Validation:</strong>
                <ul>
                    <li>Fees should be valid <b>only for one financial year</b> (e.g., April 1, 2024 – March 31, 2025).</li>
                    <li>Users <b>cannot enter multiple fees</b> for the same financial year.</li>
                </ul>
            </li>
            
            <li>
                <strong>Mandatory Fields:</strong>
                <ul>
                    <li>All of the following fields are <b>required</b>:</li>
                    <ul>
                        <li>Skater Fees</li>
                        <li>District Fees</li>
                        <li>State Fees</li>
                    </ul>
                </ul>
            </li>

            <li>
                <strong>Unique Entry per Financial Year:</strong>
                <ul>
                    <li>A club <b>cannot</b> have more than one entry for a particular financial year.</li>
                    <li>If an entry already exists for the same financial year, an <b>error message</b> will be displayed.</li>
                </ul>
            </li>

            <li>
                <strong>Updating Fees:</strong>
                <ul>
                    <li>If fees <b>already exist</b> for a financial year, users can <b>update</b> them instead of creating a new entry.</li>
                    <li>The update should apply <b>only to the selected financial year</b> and <b>not affect previous records</b>.</li>
                </ul>
            </li>

            <li>
                <strong>Data Integrity:</strong>
                <ul>
                    <li>Only <b>numerical values</b> are allowed for fees.</li>
                    <li>Negative values are <b>not permitted</b>.</li>
                    <li>Fees should <b>not exceed a predefined limit</b> (if applicable).</li>
                    <li>Each entry should be stored <b>with the associated financial year</b>.</li>
                    <li>Queries should always <b>check for the financial year</b> when fetching or updating fee details.</li>
                </ul>
            </li>

          
        </ul>
    </div>
</div>

                </div>
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
 
<?php include 'footer.php' ?>
<!-- Vendors JS -->
<script src="assets/vendor/libs/jquery/jquery.js"></script>
<script src="assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="assets/vendor/libs/select2/select2.js"></script>
<script src="assets/vendor/libs/@form-validation/popular.js"></script>
<script src="assets/vendor/libs/@form-validation/bootstrap5.js"></script>
<script src="assets/vendor/libs/@form-validation/auto-focus.js"></script>

<script>
   
   
document.addEventListener("DOMContentLoaded", function () {


    let selectedId =1;
    
    
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
        
        
        $.get(`api/fees/read_single.php?id=${encodeURIComponent(id)}`, function (data) {
         if (data) {
            
            $('#state_fees').val(data.state_fees);
            $('#district_fees').val(data.district_fees);
            $('#skater_fees').val(data.skater_fees);
            } 
        else {
                console.error("No data received for the given ID.");
            }
        }).fail(function (xhr) {
            console.error("Error fetching client details:", xhr.responseText);
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
            { id: "state_fees", message: "State Fees is required." },
            { id: "district_fees", message: "District Fees is required." },
            { id: "skater_fees", message: "Staker Fees is required." },
            
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
    let form = $("#clubForm");
    let submitButton = $("#submitBtn"); // Ensure the submit button has an ID
    let formData = new FormData(form[0]); // Use FormData for file uploads
    
    
    let url = selectedId ? 'api/fees/update.php' : 'api/fees/create.php';
    
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
            if (response.status == "success") {
                showtoastt(response.message, 'success');
                if (!selectedId) {
                    form[0].reset(); // Reset form only for create
                }
            } else {
                showtoastt(response.message, 'error');
                submitButton.prop('disabled', false).html('Register Club');
            }
        },
        error: function (xhr) {
            showtoastt('Something Went Wrong...', 'error');
            console.error('Request failed:', xhr);
            submitButton.prop('disabled', false).html('Register Club');
        },
        complete: function () {
            // Re-enable button and restore original text
            submitButton.prop('disabled', false).html('Submit');
        }
    });
}

    
    
    
    
    
});

</script>
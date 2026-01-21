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
                        <h6 class="card-header" ><i class="ri-file-list-3-fill"></i> Events <span id="title_text">Creation</span> Form Details</h6>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="district-events-list.php"><button type="button" class="btn btn-xs rounded-pill btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#userModal">
                            <i class="ri-arrow-left-circle-fill"></i> &nbsp;&nbsp; Back to Events List
                          </button></a>
                    </div>
            </div>    
            <div class="row" style="padding: 5px 20px;"> 
<form id="eventForm" novalidate enctype="multipart/form-data">

    
 <div class="row mb-4">
     
     <div class="col-sm-4">
     
    <div class="row mb-4">
            <label class="col-sm-4 col-form-label required-label" for="reg_start_date">Registration Start Date</label>
            <div class="col-sm-8">
                <input type="datetime-local" id="reg_start_date" name="reg_start_date" class="form-control" required>
            </div>
        </div>
    </div>
         <div class="col-sm-4">
        <div class="row mb-4">
            <label class="col-sm-4 col-form-label required-label" for="reg_end_date">Registration End Date</label>
            <div class="col-sm-8">
                <input type="datetime-local" id="reg_end_date" name="reg_end_date" class="form-control" required>
            </div>
        </div>
     </div>
     <div class="col-sm-4">
           
        <div class="row mb-4">
            <label class="col-sm-4 col-form-label required-label" for="event_date">Event Date</label>
            <div class="col-sm-8">
                <input type="date" id="event_date" name="event_date" class="form-control" required>
            </div>
        </div>
       </div>
     <br>
    <div class="col-sm-4">

        
    
        <div class="row mb-4">
            <label class="col-sm-4 col-form-label required-label" for="event_name">Event Name</label>
            <div class="col-sm-8">
                <input type="text" id="event_name" name="event_name" class="form-control" required>
            </div>
        </div>
    
       

             <div class="row mb-4">
            <label class="col-sm-4 col-form-label required-label" for="event_fees">Event Fees</label>
            <div class="col-sm-8">
                <input type="number" id="event_fees" name="event_fees" class="form-control" required>
            </div>
        </div>
        
        
         <div class="row mb-4">
            <label class="col-sm-4 col-form-label" for="event_description">Event Description</label>
            <div class="col-sm-8">
                <textarea id="event_description" name="event_description" class="form-control"></textarea>
            </div>
        </div>
    </div>
    
    
     <div class="col-sm-4">
    
     <div class="row mb-4">
            <label class="col-sm-4 col-form-label required-label" for="state_id">State</label>
            <div class="col-sm-8">
                <select id="state_id" name="state_id" class="form-select" required>
                    <option value="">Select State</option>
                </select>
            </div>
        </div>
        
       
         <div class="row mb-4">
            <label class="col-sm-4 col-form-label" for="event_image">Event Image</label>
            <div class="col-sm-8">
                <input type="file" id="event_image" name="event_image" class="form-control">
            </div>
        </div>
          <div class="row mb-4">
            <label class="col-sm-4 col-form-label" for="event_remarks">Event Remarks</label>
            <div class="col-sm-8">
                <textarea id="event_remarks" name="event_remarks" class="form-control"></textarea>
            </div>
        </div>
    
      

     </div>
        
    <div class="col-sm-4">
           <div class="row mb-4">
            <label class="col-sm-4 col-form-label required-label" for="district_id">District</label>
            <div class="col-sm-8">
                <select id="district_id" name="district_id" class="form-select" required>
                    <option value="">Select District</option>
                </select>
            </div>
        </div>
        
        
        <div class="row mb-4">
            <label class="col-sm-4 col-form-label required-label" for="status">Status</label>
            <div class="col-sm-8">
                <select id="status" name="status" class="form-select" required>
                    <option value="">Select Status</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>
        </div>
        
        
       </div>
   
    <h5 class="text-center">Certificate Information Details</h5>
    
     <div class="col-sm-6">
        <div class="row mb-4">
            <label class="col-sm-4 col-form-label required-label" for="title_of_championship">Title of Championship</label>
            <div class="col-sm-8">
                <input type="text" id="title_of_championship" name="title_of_championship" class="form-control" required>
            </div>
        </div>
     </div>
      <div class="col-sm-6">
     
       <div class="row mb-4">
            <label class="col-sm-4 col-form-label required-label" for="association_name">Association Name</label>
            <div class="col-sm-8">
                <input type="text" id="association_name" name="association_name" class="form-control" required>
            </div>
        </div>
          </div>
         <div class="col-sm-6">
     
       <div class="row mb-4">
            <label class="col-sm-4 col-form-label required-label" for="reg_no">Registration Number</label>
            <div class="col-sm-8">
                <input type="text" id="reg_no" name="reg_no" class="form-control" required>
            </div>
        </div>
     
          </div>
     
        
         <div class="col-sm-6">
               <div class="row mb-4">
            <label class="col-sm-4 col-form-label required-label" for="date"> From Date</label>
            <div class="col-sm-8">
                <input type="date" id="date" name="date" class="form-control" required>
            </div>
        </div>
        <div class="row mb-4">
            <label class="col-sm-4 col-form-label required-label" for="date"> To Date <span style='font-size:10px;color:red'>(If 1 Day Means Put Same Date)</span></label>
            <div class="col-sm-8">
                <input type="date" id="date1" name="date1" class="form-control" required>
            </div>
        </div>
          </div>
         <!--<div class="col-sm-6">-->
               
         <!-- </div>-->
     
      <div class="col-sm-6">
        <div class="row mb-4">
            <label class="col-sm-4 col-form-label required-label" for="secretory_sign">Secretary Signature</label>
            <div class="col-sm-8">
                <input type="file" id="secretory_sign" name="secretory_sign" class="form-control" required>
            </div>
        </div>
        
          <div class="row mb-4">
            <label class="col-sm-4 col-form-label required-label" for="venue">Venue</label>
            <div class="col-sm-8">
                <input type="text" id="venue" name="venue" class="form-control" required>
            </div>
        </div>
        
    </div>
    
      <div class="col-sm-6">
      
        <div class="row mb-4">
            <label class="col-sm-4 col-form-label required-label" for="president_sign">President Signature</label>
            <div class="col-sm-8">
                <input type="file" id="president_sign" name="president_sign" class="form-control" required>
            </div>
        </div>
    </div>
    </div>
</div>
    <div class="row mb-4">
        <!-- Submit Button -->
        <div class="col-sm-12 text-end">
            <button type="submit" class="btn btn-success" id="submitBtn">Register Events</button>
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
 
<?php include 'footer.php' ?>
<!-- Vendors JS -->
<script src="assets/vendor/libs/jquery/jquery.js"></script>
<script src="assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="assets/vendor/libs/select2/select2.js"></script>
<script src="assets/vendor/libs/@form-validation/popular.js"></script>
<script src="assets/vendor/libs/@form-validation/bootstrap5.js"></script>
<script src="assets/vendor/libs/@form-validation/auto-focus.js"></script>
   <script>
   var district_idS = 0;
    getDropDown('tbl_states','state_id','state_name');
    getDropDown('tbl_event_level_type','event_level_type_id','event_level');

    
    $('#state_id').on('change',function(){
        var state_id = $('#state_id').val();
        getDropDown('tbl_districts','district_id','district_name',{'state_id':state_id});
    });
    
     
        // getBranch();
   
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
        
        
        // $.get(`api/club/read_single.php?id=${encodeURIComponent(id)}`, function (data) {
        //  if (data) {
        //     getDropDown('tbl_states','state_id','state_name',{},data.state_id);
        //     getDropDown('tbl_districts','district_id','district_name',{'state_id':data.state_id},data.district_id);
        //     $('#club_name').val(data.club_name);
        //     $('#registration_number').val(data.registration_number);
        //     $('#contact_person').val(data.contact_person);
        //     $('#mobile_number').val(data.mobile_number);
        //     $('#email_address').val(data.email_address);
        //     $('#club_address').val(data.club_address);
        //     $('#established_year').val(data.established_year);
        //     // Set status radio buttons
        //     if (data.status === 'active') {
        //         $('#status_active').prop('checked', true);
        //     } else if (data.status === 'inactive') {
        //         $('#status_inactive').prop('checked', true);
        //     }
            
        //     if (data.logo_path) {
        //         $('#logoPreview').attr('src', `${data.logo_path}`).show();
        //     }
            
            
        //     } else {
        //         console.error("No data received for the given ID.");
        //     }
        // }).fail(function (xhr) {
        //     console.error("Error fetching client details:", xhr.responseText);
        // });
        // `id`, `event_level_type_id`, `state_id`, `district_id`, ``, `event_image`, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, `secretory_sign`, `president_sign`, `created_at`, `updated_at`
        $.get(`api/d-events/read_single.php?id=${encodeURIComponent(id)}`, function (data) {
            console.log(data);
    if (data) {
        getDropDown('tbl_states', 'state_id', 'state_name', {}, data.state_id);
        getDropDown('tbl_districts', 'district_id', 'district_name', { 'state_id': data.state_id }, data.district_id);
        getDropDown('tbl_event_levels', 'event_level_type_id', 'event_level_name', {}, data.event_level_type_id);

        $('#event_name').val(data.event_name);
        $('#event_date').val(data.event_date);
        $('#reg_start_date').val(data.reg_start_date);
        $('#reg_end_date').val(data.reg_end_date);
        $('#event_description').val(data.event_description);
        $('#event_fees').val(data.event_fees);
        $('#event_remarks').val(data.event_remarks);
        $('#title_of_championship').val(data.title_of_championship);
        $('#association_name').val(data.association_name);
        $('#reg_no').val(data.reg_no);
        $('#date').val(data.date);
        $('#date1').val(data.date1);
        $('#venue').val(data.venue);
        $('#status').val(data.status);

        // Set image preview for event_image
        if (data.event_image) {
            $('#eventImagePreview').attr('src', data.event_image).show();
        }

        // Set image preview for secretary signature
        if (data.secretory_sign) {
            $('#secretarySignPreview').attr('src', data.secretory_sign).show();
        }

        // Set image preview for president signature
        if (data.president_sign) {
            $('#presidentSignPreview').attr('src', data.president_sign).show();
        }

        
    } else {
        console.error("No data received for the given ID.");
    }
}).fail(function (xhr) {
    console.error("Error fetching event details:", xhr.responseText);
});

    }

    let form = document.getElementById("eventForm");
    if (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            if (validateForm()) {
                submitForm();
            }
        });
    }

//     function validateForm() {
//         let isValid = true;
//         let fields = [
//             { id: "club_name", message: "Club Name is required." },
//             { id: "registration_number", message: "Registration Number is required." },
//             { id: "contact_person", message: "Contact Person is required." },
//             { id: "mobile_number", message: "Mobile Number is required.", pattern: /^\d{10}$/, errorMsg: "Enter a valid 10-digit Mobile Number." },
//             { id: "state_id", message: "Please select a State.", select: true },
//             { id: "district_id", message: "Please select a District.", select: true },
//         ];

//         document.querySelectorAll(".error-message").forEach(el => el.remove());

//         fields.forEach(field => {
//             let input = document.getElementById(field.id);
//             if (!input) return;

//             let errorMessage = "";
//             if (!input.value.trim()) {
//                 errorMessage = field.message;
//                 isValid = false;
//             } else if (field.pattern && !field.pattern.test(input.value)) {
//                 errorMessage = field.errorMsg;
//                 isValid = false;
//             }

//             if (errorMessage) {
//                 input.classList.add("is-invalid");
//                 showError(input, errorMessage);
//             } else {
//                 input.classList.remove("is-invalid");
//             }
//         });

//         return isValid;
//     }

function validateForm() {
    let isValid = true;
    let fields = [
        { id: "event_name", message: "Event Name is required." },
        // { id: "event_level_type_id", message: "Please select an Event Level.", select: true },
        { id: "state_id", message: "Please select a State.", select: true },
        { id: "district_id", message: "Please select a District.", select: true },
        { id: "event_date", message: "Event Date is required." },
        { id: "reg_start_date", message: "Registration Start Date is required." },
        { id: "reg_end_date", message: "Registration End Date is required." },
        { id: "event_fees", message: "Event Fees are required.", pattern: /^[0-9]+(\.[0-9]{1,2})?$/, errorMsg: "Enter a valid fee amount." },
        { id: "venue", message: "Venue is required." },
        { id: "association_name", message: "Association Name is required." },
        { id: "reg_no", message: "Registration Number is required." },
        // { id: "event_remarks", message: "Event remark is required." },
        // { id: "event_description", message: "Event description is required." },
        { id: "title_of_championship", message: "Title of championship is required." },
        { id: "date", message: "Date is required." },
        { id: "date1", message: "Date is required." },
    ];
    if (!selectedId) {
            fields.push({ id: "secretory_sign", message: "Secretory sign is required." });
            fields.push({ id: "president_sign", message: "President sign is required." });
            fields.push({ id: "event_image", message: "Event image  is required." });
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

//     function showError(input, message) {
//         let errorDiv = document.createElement("div");
//         errorDiv.className = "error-message text-danger mt-1";
//         errorDiv.innerText = message;
//         input.insertAdjacentElement("afterend", errorDiv);
//     }

function showError(input, message) {
    let errorDiv = document.createElement("div");
    errorDiv.className = "error-message text-danger mt-1";
    errorDiv.innerText = message;
    input.insertAdjacentElement("afterend", errorDiv);
}

//     function submitForm() {
//     let form = $("#clubForm");
//     let submitButton = $("#submitBtn"); // Ensure the submit button has an ID
//     let formData = new FormData(form[0]); // Use FormData for file uploads
//     let url = selectedId ? 'api/club/update.php' : 'api/club/create.php';
    
//     if (selectedId) {
//         formData.append('id', selectedId); // Append ID for update
//     }
//     // Disable button and show loading spinner
//     submitButton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');

//     $.ajax({
//         url: url,
//         type: 'POST',
//         dataType: 'json',
//         processData: false,  // Required for FormData
//         contentType: false,  // Required for FormData
//         data: formData,
//         success: function (response) {
//             console.log(response);
//             if (response.status == "success") {
//                 showtoastt(response.message, 'success');
//                 if (!selectedId) {
//                     form[0].reset(); // Reset form only for create
//                 }
//             } else {
//                 showtoastt(response.message, 'error');
//                 submitButton.prop('disabled', false).html('Register Club');
//             }
//         },
//         error: function (xhr) {
//             showtoastt('Something Went Wrong...', 'error');
//             console.error('Request failed:', xhr);
//             submitButton.prop('disabled', false).html('Register Club');
//         },
//         complete: function () {
//             // Re-enable button and restore original text
//             submitButton.prop('disabled', false).html('Submit');
//         }
//     });
// }





function submitForm() {
    let form = $("#eventForm");
    let submitButton = $("#submitBtn"); // Ensure the submit button has an ID
    let formData = new FormData(form[0]); // Use FormData for file uploads
    let url = selectedId ? 'api/d-events/update.php' : 'api/d-events/create.php';

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
            submitButton.prop('disabled', false).html(selectedId ? 'Update Event' : 'Register Event');
        }
    });
}


    
    
    
    
    
});

</script>
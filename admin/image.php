<?php include('header.php')?>
<link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
<link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />
<link rel="stylesheet" href="assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
<link rel="stylesheet" href="assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
<link rel="stylesheet" href="assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
<link rel="stylesheet" href="assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />
<link rel="stylesheet" href="assets/vendor/libs/select2/select2.css" />
<link rel="stylesheet" href="assets/vendor/libs/@form-validation/form-validation.css" />
<!-- Cropper.js CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" />
<!-- Cropper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>


        
    <!-- Content -->
    <div class="container-xxl flex-grow-1" style="padding: 0px 10px;">
        <div class="card" style="margin-bottom:5px;">
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
<form id="skaterForm" novalidate enctype="multipart/form-data">
 <div class="row mb-4">
    <div class="col-sm-6">
   
    <div class="row mb-4">
        <!-- Mobile Number -->
        <label class="col-sm-4 col-form-label required-label" for="full_name">Name</label>
        <div class="col-sm-8">
            <input type="text" name="full_name" class="form-control" id="full_name" 
            placeholder="Enter your name" required/>
        </div>
    </div>
    <div class="row mb-4">
        <!-- Mobile Number -->
        <label class="col-sm-4 col-form-label required-label" for="full_name">Father Name</label>
        <div class="col-sm-8">
            <input type="text" name="father_name" class="form-control" id="father_name" 
            placeholder="Enter father your name" required/>
        </div>
    </div>
    
    
    <div class="row mb-4">
        <!-- Email Address -->
        <label class="col-sm-4 col-form-label required-label" for="email_address">Mobile Numer</label>
        <div class="col-sm-8">
            <input type="number" name="mobile_number" class="form-control" id="mobile_number" placeholder="Enter your mobile number" required/>
        </div>
    </div>
     <div class="row mb-4">
        <!-- Club Name -->
        <label class="col-sm-4 col-form-label required-label" for="date_of_birth">Date Of Birth</label>
        <div class="col-sm-8">
            <input type="date" name="date_of_birth" class="form-control" id="date_of_birth" placeholder="Enter your date Of Birth" required/>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Registration Number -->
        <label class="col-sm-4 col-form-label required-label" for="category_type_id">Category Id</label>
        <div class="col-sm-8">
              <select id="category_type_id" name="category_type_id" class="form-select" required>
                <option value="">Select Category</option>
                <option value="">1</option>
                <!-- Add dynamic options here -->
            </select>
        </div>
    </div>
    

    <div class="row mb-4">
         <!--Status -->
        <label class="col-sm-4 col-form-label required-label">Gender</label>
        <div class="col-sm-8">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="status_active" value="Male" checked required>
                <label class="form-check-label" for="status_active">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="status_inactive" value="Female" required>
                <label class="form-check-label" for="status_inactive">Female</label>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Registration Number -->
        <label class="col-sm-4 col-form-label required-label" for="blood_group">Blood Group</label>
        <div class="col-sm-8">
            <select id="blood_group" name="blood_group" class="form-select" required>
                <option value="">Select Blood Group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <!-- Add dynamic options here -->
            </select>
        </div>
    </div>
<div class="row mb-4">
        <!-- Club Name -->
        <label class="col-sm-4 col-form-label required-label" for="school_name">School Name</label>
        <div class="col-sm-8">
            <input type="text" name="school_name" class="form-control" id="school_name" placeholder="Enter your School Name" required/>
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
        <label class="col-sm-4 col-form-label required-label" for="email_address">E-mail</label>
        <div class="col-sm-8">
            <input type="email" name="email_address" class="form-control" id="email_address" placeholder="Enter your E-mail" required/>
        </div>
    </div>
    
    <div class="row mb-4">
        <!-- Registration Number -->
        <label class="col-sm-4 col-form-label required-label" for="club_id">Select Club</label>
        <div class="col-sm-8">
           <select id="club_id" name="club_id" class="form-select" required>
                <option value="">Select Club</option>
                <option value="">1</option>
                <!-- Add dynamic options here -->
            </select>
        </div>
    </div>
    
    <div class="row mb-4">
        <!-- Registration Number -->
        <label class="col-sm-4 col-form-label required-label" for="coach_name">Coach Name</label>
        <div class="col-sm-8">
            <input type="text" name="coach_name" class="form-control" id="coach_name" placeholder="Enter Your Coach Name" required/>
        </div>
    </div>
    
    <div class="row mb-4">
        <!-- Registration Number -->
        <label class="col-sm-4 col-form-label required-label" for="coach_mobile_number">Coach Mobile Number</label>
        <div class="col-sm-8">
            <input type="tel" name="coach_mobile_number" class="form-control" id="coach_mobile_number" placeholder="Enter your Coach Mobile Number" required/>
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
    <div class="row mb-4">
        <!-- Registration Number -->
        <label class="col-sm-4 col-form-label required-label" for="district_id">District Id</label>
        <div class="col-sm-8">
          <select id="district_id" name="district_id" class="form-select" required>
                <option value="">Select District Id</option>
                <!-- Add dynamic options here -->
            </select>
        </div>
    </div>
    
    
    <div class="row mb-4">
        <!--residential_address -->
        <label class="col-sm-4 col-form-label required-label" for="residential_address">Residential Address</label>
        <div class="col-sm-8">
            <textarea id="residential_address" name="residential_address" rows="5"  class="form-control" placeholder="Enter Your Address" required></textarea>
        </div>
    </div>
    
</div>
<div class="col-sm-6">


    
    <div class="row mb-4">
        <!-- Logo Upload -->
        <label class="col-sm-4 col-form-label" for="logo_path"></label>
        <div class="col-sm-8">
            <h6>Final Uploaded Image:</h6>
            <img id="finalImage" style="max-width: 50%; border: 1px solid #ddd; display: none;" />
        </div>
    </div>
    
    <div class="row mb-4">
         <!--identity_proof -->
        <label class="col-sm-4 col-form-label required-label" for="profile_photo" id="profile_photo_label">Profile Photo</label>
        <div class="col-sm-8">
            <input type="file" name="profile_photo" class="form-control" id="profile_photo" accept="image/*" required/>
        </div>
    </div>
    
    <!-- Display Selected Image on Main UI -->

    


   
</div>
</div>
    <div class="row mb-4">
        <!-- Submit Button -->
        <div class="col-sm-12 text-end">
            <button type="submit" class="btn btn-success" id="submitBtn">Register Skater</button>
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
 
<!-- Cropping Modal -->
<div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Image for Cropping -->
                <div id="cropContainer">
                    <img id="cropImage" style="width: 100%; object-fit: contain;" />
                </div>
                <div class="modal-footer">
                <button id="cropButton" class="btn btn-primary">Crop</button>
                </div>

                <!-- Cropped Image Preview (Initially Hidden) -->
                <div id="previewContainer" class="text-center mt-3" style="display: none;">
                    <h6>Preview:</h6>
                    <img id="croppedPreview" style="max-width: 100%; border: 1px solid #ddd;" />
                    <div class="mt-3">
                        <button id="recropButton" class="btn btn-warning">Re-Crop</button>
                        <button id="submitButton" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>






<script>
// document.addEventListener("DOMContentLoaded", function () {
//     let cropper;
//     let image = document.getElementById("cropImage");
//     let input = document.getElementById("profile_photo");
//     let cropModal = new bootstrap.Modal(document.getElementById("cropModal"));
//     let previewImage = document.getElementById("croppedPreview");
//     let finalImage = document.getElementById("finalImage");

//     let cropContainer = document.getElementById("cropContainer");
//     let previewContainer = document.getElementById("previewContainer");

//     let cropButton = document.getElementById("cropButton");
//     let recropButton = document.getElementById("recropButton");
//     let submitButton = document.getElementById("submitButton");

//     let croppedCanvas;

//     // Show Modal with Image Preview
//     input.addEventListener("change", function (event) {
//         let files = event.target.files;
//         if (files && files.length > 0) {
//             let reader = new FileReader();
//             reader.onload = function (e) {
//                 image.src = e.target.result;
//                 cropModal.show();

//                 if (cropper) cropper.destroy(); // Destroy previous instance
//                 cropper = new Cropper(image, {
//                     aspectRatio: 1,
//                     viewMode: 2,
//                 });

//                 // Reset UI
//                 previewContainer.style.display = "none";
//                 cropButton.style.display = "block";
//             };
//             reader.readAsDataURL(files[0]);
//         }
//     });

//     // Crop Button Click
//     cropButton.addEventListener("click", function () {
//         croppedCanvas = cropper.getCroppedCanvas();
//         if (croppedCanvas) {
//             previewImage.src = croppedCanvas.toDataURL();
//             previewContainer.style.display = "block"; // Show preview section
//             cropButton.style.display = "none"; // Hide Crop button
//         }
//     });

//     // Re-Crop Button Click
//     recropButton.addEventListener("click", function () {
//         previewContainer.style.display = "none"; // Hide preview
//         cropButton.style.display = "block"; // Show Crop button again
//     });

//     // Submit Button Click
//     submitButton.addEventListener("click", function () {
//         finalImage.src = croppedCanvas.toDataURL(); // Set final image
//         finalImage.style.display = "block"; // Show image on UI
//         cropModal.hide(); // Close modal
//     });
// });
// document.addEventListener("DOMContentLoaded", function () {
//     let cropper;
//     let image = document.getElementById("cropImage");
//     let input = document.getElementById("profile_photo");
//     let cropModal = new bootstrap.Modal(document.getElementById("cropModal"));
//     let previewImage = document.getElementById("croppedPreview");
//     let finalImage = document.getElementById("finalImage");

//     let cropContainer = document.getElementById("cropContainer");
//     let previewContainer = document.getElementById("previewContainer");

//     let cropButton = document.getElementById("cropButton");
//     let recropButton = document.getElementById("recropButton");
//     let submitButton = document.getElementById("submitButton");

//     let croppedCanvas;

//     // Show Modal with Image Preview
//     input.addEventListener("change", function (event) {
//         let files = event.target.files;
//         if (files && files.length > 0) {
//             let reader = new FileReader();
//             reader.onload = function (e) {
//                 image.src = e.target.result;
//                 cropModal.show();

//                 if (cropper) cropper.destroy(); // Destroy previous instance
//                 cropper = new Cropper(image, {
//                     aspectRatio: 1,
//                     viewMode: 2,
//                 });

//                 // Reset UI
//                 previewContainer.style.display = "none";
//                 cropButton.style.display = "block";
//             };
//             reader.readAsDataURL(files[0]);
//         }
//     });


//     // Crop Button Click
//     cropButton.addEventListener("click", function () {
//         croppedCanvas = cropper.getCroppedCanvas();
//         if (croppedCanvas) {
//             previewImage.src = croppedCanvas.toDataURL();
//             previewContainer.style.display = "block"; // Show preview section
//             cropButton.style.display = "none"; // Hide Crop button
//         }
//     });

//     // Re-Crop Button Click
//     recropButton.addEventListener("click", function () {
//         previewContainer.style.display = "none"; // Hide preview
//         cropButton.style.display = "block"; // Show Crop button again
//     });

//     // Submit Button Click
//     submitButton.addEventListener("click", function () {
//         finalImage.src = croppedCanvas.toDataURL(); // Set final image
//         finalImage.style.display = "block"; // Show image on UI
//         cropModal.hide(); // Close modal
//     });
// });
document.addEventListener("DOMContentLoaded", function () {
    let cropper;
    let image = document.getElementById("cropImage");
    let input = document.getElementById("profile_photo");
    let cropModal = new bootstrap.Modal(document.getElementById("cropModal"));
    let previewImage = document.getElementById("croppedPreview");
    let finalImage = document.getElementById("finalImage");

    let cropContainer = document.getElementById("cropContainer");
    let previewContainer = document.getElementById("previewContainer");

    let cropButton = document.getElementById("cropButton");
    let recropButton = document.getElementById("recropButton");
    let submitButton = document.getElementById("submitButton");

    let croppedCanvas;

    // Show Modal with Image Preview
    input.addEventListener("change", function (event) {
        let files = event.target.files;
        if (files && files.length > 0) {
            let reader = new FileReader();
            reader.onload = function (e) {
                image.src = e.target.result;
                cropModal.show();

                if (cropper) cropper.destroy(); // Destroy previous instance
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 2,
                });

                // Reset UI
                previewContainer.style.display = "none";
                cropButton.style.display = "block";
            };
            reader.readAsDataURL(files[0]);
        }
    });

    // Crop Button Click
    cropButton.addEventListener("click", function () {
        croppedCanvas = cropper.getCroppedCanvas();
        if (croppedCanvas) {
            previewImage.src = croppedCanvas.toDataURL();
            previewContainer.style.display = "block"; // Show preview section
            cropButton.style.display = "none"; // Hide Crop button
        }
    });

    // Re-Crop Button Click
    recropButton.addEventListener("click", function () {
        previewContainer.style.display = "none"; // Hide preview
        cropButton.style.display = "block"; // Show Crop button again
    });

    // Submit Button Click - Replace File Input with Cropped Image
    submitButton.addEventListener("click", function () {
        croppedCanvas.toBlob(function (blob) {
            let file = new File([blob], "cropped_image.png", { type: "image/png" });

            // Create a DataTransfer to hold the file (for file input replacement)
            let dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);

            // Replace file input value with the cropped image
            input.files = dataTransfer.files;

            // Show the cropped image
            finalImage.src = URL.createObjectURL(blob);
            finalImage.style.display = "block";

            // Close modal
            cropModal.hide();
        }, "image/png");
    });
});


</script>
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
        $("#identity_proof_label").removeClass("required-label");
        $("#profile_photo_label").removeClass("required-label");
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
                getDropDown('tbl_clubs','club_id','club_name',{},data.club_id);
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
                if (data.gender === 'Male') {
                    $('#status_active').prop('checked', true);
                } else if (data.gender === 'Female') {
                    $('#status_inactive').prop('checked', true);
                }
                
                if (data.identity_proof) {
                    $('#identityPreview').attr('src', `${data.identity_proof}`).show();
                }
                if (data.profile_photo) {
                    $('#profilePreview').attr('src', `${data.profile_photo}`).show();
                }
                
                
                
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
        { id: "residential_address", message: "Residential Address is required." },
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


</script>

<script>
        let cropper;
        $("#imageInput").on("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $("#previewImage").attr("src", e.target.result).show();
                    if (cropper) {
                        cropper.destroy();
                    }
                    cropper = new Cropper(document.getElementById("previewImage"), {
                        aspectRatio: 1, // Square crop
                        viewMode: 2,
                    });
                    $("#cropButton").show();
                };
                reader.readAsDataURL(file);
            }
        });

        $("#cropButton").on("click", function() {
            if (cropper) {
                cropper.getCroppedCanvas().toBlob((blob) => {
                    const formData = new FormData();
                    formData.append("croppedImage", blob);
                    
                    $.ajax({
                        url: "upload.php",
                        method: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            alert("Image uploaded successfully: " + response);
                        }
                    });
                });
            }
        });
    </script>
<?php include('footer.php')?>


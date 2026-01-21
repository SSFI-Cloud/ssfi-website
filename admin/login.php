<?php 
ob_start();
session_start();


if (isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}
?>

<!doctype html>
<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="horizontal-menu-template"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login | Speed Skating Federation of India</title>

    <meta name="description" content="" />

     <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/logo_new (1).jpg" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="assets/vendor/fonts/remixicon/remixicon.css" />
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icons.css" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="assets/vendor/libs/node-waves/node-waves.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />
    <!-- Vendor -->
    <link rel="stylesheet" href="assets/vendor/libs/@form-validation/form-validation.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
    
    <style>
        /* Basic styling for the toast */
        .toastt {
            color: white;
            padding: 15px;
            margin: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-width: 250px;
            position: relative;
        }

        /* Toast container position */
        #toasttContainer {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        /* Close button styling */
        .close-btn {
            background: transparent;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
        }
    </style>

    
  </head>

  <body>
    <!-- Content -->

    <div class="position-relative">
      <div class="authentication-wrapper authentication-basic container-p-y p-4 p-sm-0">
        <div class="authentication-inner py-6">
          <!-- Login -->
          <div class="card p-md-7 p-1">
         
            <!-- Logo -->
            <div class="app-brand justify-content-center mt-5">
              <a href="index.php" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                  <span style="color: #666cff">
                    <!--<svg width="268" height="150" viewBox="0 0 38 20" fill="none" xmlns="http://www.w3.org/2000/svg">-->
                      <path
                        d="M30.0944 2.22569C29.0511 0.444187 26.7508 -0.172113 24.9566 0.849138C23.1623 1.87039 22.5536 4.14247 23.5969 5.92397L30.5368 17.7743C31.5801 19.5558 33.8804 20.1721 35.6746 19.1509C37.4689 18.1296 38.0776 15.8575 37.0343 14.076L30.0944 2.22569Z"
                        fill="currentColor" />
                      <path
                        d="M30.171 2.22569C29.1277 0.444187 26.8274 -0.172113 25.0332 0.849138C23.2389 1.87039 22.6302 4.14247 23.6735 5.92397L30.6134 17.7743C31.6567 19.5558 33.957 20.1721 35.7512 19.1509C37.5455 18.1296 38.1542 15.8575 37.1109 14.076L30.171 2.22569Z"
                        fill="url(#paint0_linear_2989_100980)"
                        fill-opacity="0.4" />
                      <path
                        d="M22.9676 2.22569C24.0109 0.444187 26.3112 -0.172113 28.1054 0.849138C29.8996 1.87039 30.5084 4.14247 29.4651 5.92397L22.5251 17.7743C21.4818 19.5558 19.1816 20.1721 17.3873 19.1509C15.5931 18.1296 14.9843 15.8575 16.0276 14.076L22.9676 2.22569Z"
                        fill="currentColor" />
                      <path
                        d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z"
                        fill="currentColor" />
                      <path
                        d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z"
                        fill="url(#paint1_linear_2989_100980)"
                        fill-opacity="0.4" />
                      <path
                        d="M7.82901 2.22569C8.87231 0.444187 11.1726 -0.172113 12.9668 0.849138C14.7611 1.87039 15.3698 4.14247 14.3265 5.92397L7.38656 17.7743C6.34325 19.5558 4.04298 20.1721 2.24875 19.1509C0.454514 18.1296 -0.154233 15.8575 0.88907 14.076L7.82901 2.22569Z"
                        fill="currentColor" />
                      <defs>
                        <linearGradient
                          id="paint0_linear_2989_100980"
                          x1="5.36642"
                          y1="0.849138"
                          x2="10.532"
                          y2="24.104"
                          gradientUnits="userSpaceOnUse">
                          <stop offset="0" stop-opacity="1" />
                          <stop offset="1" stop-opacity="0" />
                        </linearGradient>
                        <linearGradient
                          id="paint1_linear_2989_100980"
                          x1="5.19475"
                          y1="0.849139"
                          x2="10.3357"
                          y2="24.1155"
                          gradientUnits="userSpaceOnUse">
                          <stop offset="0" stop-opacity="1" />
                          <stop offset="1" stop-opacity="0" />
                        </linearGradient>
                      </defs>
                    </svg>
                  </span>
                </span>
                <span class="app-brand-text demo text-heading fw-semibold">Speed Skating Federation of India</span>
              </a>
            </div>
            <!-- /Logo -->

            <div class="card-body mt-1">
              <!--<h4 class="mb-1">Welcome to Professional Courier</h4>-->
               <div id="toasttContainer"></div>
              <p class="mb-5"></p>

              <form id="login_form" class="mb-5" method="POST" action="">
                <div class="form-floating form-floating-outline mb-5">
                  <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="username"
                    placeholder="Enter your email or username"
                    autofocus />
                  <label for="email">Email or Username</label>
                </div>
                <div class="mb-5">
                  <div class="form-password-toggle">
                    <div class="input-group input-group-merge">
                      <div class="form-floating form-floating-outline">
                        <input
                          type="password"
                          id="password"
                          class="form-control"
                          name="password"
                          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                          aria-describedby="password" />
                        <label for="password">Password</label>
                      </div>
                      <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                    </div>
                  </div>
                </div>
                <div class="mb-5 d-flex justify-content-between mt-5">
                  <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                  </div>
                  <!--<a href="#" class="float-end mb-1 mt-2">
                    <span>Forgot Password?</span>
                  </a>-->
                </div>
                <div class="mb-5">
                  <button class="btn btn-primary d-grid w-100" name="sign_in" id="sign_in" type="submit">Sign in</button>
                </div>
              </form>

              <!--<p class="text-center">
                <span>New on our platform?</span>
                <a href="#">
                  <span>Create an account</span>
                </a>
              </p>-->

    
            </div>
          </div>
          <!-- /Login -->
          <img
            alt="mask"
            src="assets/img/illustrations/auth-basic-login-mask-light.png"
            class="authentication-image d-none d-lg-block"
            data-app-light-img="illustrations/auth-basic-login-mask-light.png"
            data-app-dark-img="illustrations/auth-basic-login-mask-dark.png" />
        </div>
      </div>
    </div>
<style>
    #sign_in:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

}
</style>  
<script src="assets/vendor/libs/@form-validation/auto-focus.js"></script>
<script>

    
    function showtoastt(message, type) {
        const toasttContainer = document.getElementById("toasttContainer");
    
        if (!toasttContainer) {
            console.error("Toast container not found!");
            return;  // Exit if container doesn't exist
        }
    
        const toastt = document.createElement("div");
        toastt.classList.add("toastt");
    
        // Set background color based on type
        toastt.style.background = type === "error" ? "#dc3545" : "#28a745";
    
        // Add message and close button
        toastt.innerHTML = `
            <span>${message}</span>
            <button class="close-btn" onclick="this.parentElement.remove()">×</button>
        `;
    
        // Append the toast notification
        toasttContainer.appendChild(toastt);
    
        // Automatically remove after 3 seconds
        setTimeout(() => {
            toastt.remove();
        }, 3000);
    }


    // Form submission handler
    let form = document.getElementById("login_form");
    if (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            if (validateForm()) {
                submitForm();
            }
        });
    }

    // Form validation function
    function validateForm() {
        let isValid = true;


        let fields = [
            { id: "username", message: "username is required." },
            { id: "password", message: "password is required." },
            
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


        if (!isValid) {
            //alert("Please fix the errors before submitting.");
            showtoastt("Please fix the errors before submitting.", 'error');
        }
        return isValid;
    }


    // Function to display validation errors
    function showError(input, message) {
        let errorDiv = document.createElement("div");
        errorDiv.className = "error-message text-danger mt-1";
        errorDiv.innerText = message;
        input.insertAdjacentElement("afterend", errorDiv);
    }

    // AJAX form submission
    // function submitForm() {
    //     let formData = {
    //         username: $('#username').val(),
    //         password: $('#password').val(),
    //     };
        
    //     let url = 'api/auth/login.php';
        
    //     $.ajax({
    //         url: url,
    //         type: 'POST',
    //         dataType: 'json',  // jQuery will automatically parse JSON
    //         data: formData,
    //         success: function (response) {
    //             if (response.status == "success") {
    //                 showtoastt(response.message, 'success');
    //                 window.location.href = 'index.php';  // Redirect after successful login
    //             } else {
    //                 showtoastt(response.message, 'error');
    //             }
    //         },
    //         error: function (xhr) {
    //             showtoastt('Something Went Wrong...', 'error');
    //             console.error('Request failed:', xhr);
    //         }
    //     });

    // }
    function submitForm() {
    let submitButton = $('#submitButton');  // Target the submit button
    submitButton.prop('disabled', true);  // Disable the button

    let formData = {
        username: $('#username').val(),
        password: $('#password').val(),
    };

    let url = 'api/auth/login.php';

    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: formData,
        success: function (response) {
            if (response.status === "success") {
                showtoastt(response.message, 'success');
                setTimeout(function () {
                    window.location.href = 'index.php';  // Redirect after successful login
                }, 1000);  // Optional delay for UX
            } else {
                showtoastt(response.message, 'error');
                submitButton.prop('disabled', false);  // Re-enable button if login fails
            }
        },
        error: function (xhr) {
            showtoastt('Something Went Wrong...', 'error');
            console.error('Request failed:', xhr);
            submitButton.prop('disabled', false);  // Re-enable button on error
        }
    });
}


</script>
    

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="assets/vendor/libs/hammer/hammer.js"></script>
    <script src="assets/vendor/libs/i18n/i18n.js"></script>
    <script src="assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="assets/vendor/libs/@form-validation/auto-focus.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/js/pages-auth.js"></script>
  </body>
</html>

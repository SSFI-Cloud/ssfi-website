<style>
    .error-message{
            font-size: 12px;
    }
</style>  
           <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div
                  class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                  <div class="text-body mb-2 mb-md-0">
                    ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                     SSFI. All Rights Reserved.</span> Designed and Developed by
                    <a href="https://firstmatrix.in" target="_blank" class="footer-link">Firstmatrix Solutions</a>
                  </div>
                 
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
  </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->
    
    
    <div class="toastt-container" id="toasttContainer"></div>
    
    

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    
    <script src="assets/vendor/libs/select2/select2.js"></script>
    <script src="assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="assets/vendor/libs/hammer/hammer.js"></script>
    <script src="assets/vendor/libs/i18n/i18n.js"></script>
    <script src="assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="assets/vendor/js/menu.js"></script>

    <!-- endbuild -->


    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
    
        <!-- Vendors JS -->
    <script src="assets/vendor/libs/sweetalert2/sweetalert2.js"></script>


    <!-- Page JS -->
    <script src="assets/js/extended-ui-sweetalert2.js"></script>
    
    
    
    <script>
    
        function deleteClub(id) {
            deleteId = id;
            $('#deleteModal').modal('show'); // Show the modal
        }
    
        function getContent(file_name) {
            $("#main_content").html(`
                <div class="loading-container">
                    <div class="loading-spinner"></div>
                </div>
            `); // Show loading icon
        
            $.ajax({
                url: file_name,
                type: "GET",
                dataType: "html",
                success: function(response) {
                    $("#main_content").html(response);
                },
                error: function(xhr, status, error) {
                    console.error("Error loading content:", error);
                    $("#main_content").html('<p style="color:red;">Failed to load content. Please try again.</p>');
                }
            });
        }
    </script>
    
    
    
    <style>
    .loading-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Full screen height */
}

.loading-spinner {
    width: 50px;
    height: 50px;
    border: 5px solid #f3f3f3;
    border-top: 5px solid #3498db;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

    table > :not(caption) > * > * {
        padding:2px 5px !important;
    }
.form-select {
    padding: 5px !important;
}
    table{
        margin:10px !important;
    }
    .card-header {
        padding: 2px 5px;
    }
    td{
        padding:2px 5px !important;
    }
    div.dataTables_wrapper div.dataTables_length, div.dataTables_wrapper div.dataTables_filter {
    margin-top: 5px;
    margin-bottom: 5px;
}
.form-control-sm {
    min-height: 30px !important;
    padding: 2px 5px; !important;
}
.form-control.form-control-sm {
    min-height: 30px !important;
    padding: 2px 5px !important;
}
.form-select.form-select-sm {
    padding: 4px 25px !important;
}
.form-select.form-select-sm {
    min-height: 25px !important;
    background-size: 20px 20px !important;
}
div.card-datatable {
    padding-bottom: 3px !important;
}
.form-control {
    padding: 5px !important;
}
div.dataTables_wrapper div.dataTables_paginate ul.pagination .page-link {
    padding: 2px 10px !important;
    font-size: 0.8125rem !important;
    line-height: 20px !important;
}
div.table-responsive > div.dataTables_wrapper > div.row {
    margin: 2px 10px !important;
}
th{
    padding: 8px 5px !important;
}
</style>
     <style>
     
     .required-label::after {
    content: " *";
    color: red;
}
        /* toastt container (top-right) */
        .toastt-container {
            position: fixed;
            top: 70px;
            right: 20px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* toastt message style */
        .toastt {
            min-width: 250px;
            max-width: 350px;
            background: #28a745;
            color: #fff;
            z-index:99;
            padding: 15px;
            border-radius: 5px;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateX(100%);
            animation: slideIn 0.5s ease-out forwards, fadeOut 0.5s ease-in 2.5s forwards;
        }

        /* Close button */
        .toastt .close-btn {
            background: none;
            border: none;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
            margin-left: 10px;
        }
        .btn-sm, .btn-group-sm > .btn
        {
            --bs-btn-padding-y: 0.15rem;
            --bs-btn-padding-x: 0.969rem;
        }
        .btn-xs, .btn-group-xs > .btn
        {
            --bs-btn-padding-y: 0.15rem;
            --bs-btn-padding-x: 0.969rem;
        }

        /* Slide-in animation */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Fade-out animation */
        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(100%);
            }
        }
        .light-style .select2-container--default .select2-selection--single {
            height: 32px !important;
        }
        .light-style .select2-container--default.select2-container--focus .select2-selection--single .select2-selection__rendered, .light-style .select2-container--default.select2-container--open .select2-selection--single .select2-selection__rendered {
            line-height: 30px !important;
        }
        .light-style .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 30px !important;
        }
        .light-style .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 30px !important;
        }
    </style>
    <script>
    $('.select2').select2({
            allowClear: true
        });
        function showtoastt(message, type) {
            const toasttContainer = document.getElementById("toasttContainer");
            const toastt = document.createElement("div");
            toastt.classList.add("toastt");
            if (type === "error") {
                toastt.style.background = "#dc3545"; // Red for error
            } else {
                toastt.style.background = "#28a745"; // Green for success
            }

            // Add message and close button
            toastt.innerHTML = `
                <span>${message}</span>
                <button class="close-btn" onclick="this.parentElement.remove()">×</button>
            `;
            // Append toastt to container
            toasttContainer.appendChild(toastt);
            // Remove toastt after 3 seconds
            setTimeout(() => {
                toastt.remove();
            }, 3000);
        }
    </script>
    <script>
    $(document).ready(function () {
        $(".focus-next").on("keypress", function (e) {
            if (e.which == 13) { // Detect Enter key
                e.preventDefault(); // Prevent form submission
                var inputs = $(".focus-next");
                var index = inputs.index(this) + 1; // Get next input index
                if (index < inputs.length) {
                    inputs.eq(index).focus(); // Move to the next input
                }
            }
        });
    });


function getDropDown(tablename, id, value, conditions = {}, selected_id = null) {
    $.ajax({
        url: `api/helper/drop-down.php?table=${tablename}&columns=id,${value}&orderby=${value}&conditions=${encodeURIComponent(JSON.stringify(conditions))}`,
        type: "GET",
        dataType: "json",
        success: function (response) {
            console.log(selected_id);
            if (response.success) {
                let dropdown = $(`#${id}`);
                dropdown.empty(); // Clear previous options
                dropdown.append('<option value="">All</option>'); // Default option

                response.data.forEach(function (item) {
                    let isSelected = (selected_id && item.id == selected_id) ? 'selected' : '';
                    dropdown.append(`<option  value="${item.id}" ${isSelected}>${item[value]}</option>`);
                });
            } else {
                console.error("Error:", response.error);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
}

// function getDropDown(tablename, id, value,conditions = {},selected_id=null) {

//     console.log('DrpDown');
//     $.ajax({
//         url: `api/helper/drop-down.php?table=${tablename}&columns=id,${value}&orderby=${value}&conditions=${encodeURIComponent(JSON.stringify(conditions))}`, // Adjust the path
//         type: "GET",
//         dataType: "json",
//         success: function (response) {
//             console.log(response);
             
//             if (response.success) {
//                 let dropdown = $(`#${id}`);
//                 let selected_id = selected_id;
//                 dropdown.empty(); // Clear previous options
//                 dropdown.append('<option value="">Select</option>'); // Default option
//                 response.data.forEach(function (item) {
//                     dropdown.append(`<option value="${item.id}">${item[value]}</option>`);
//                 });
//             } else {
//                 console.error("Error:", response.error);
//             }
//         },
//         error: function (xhr, status, error) {
//             console.error("AJAX Error:", error);
//         }
//     });
// }
</script>

  </body>
</html>

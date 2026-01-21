<?php include 'header.php'; ?>

<!-- Vendors CSS -->
<link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
<link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />
<link rel="stylesheet" href="assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
<link rel="stylesheet" href="assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
<link rel="stylesheet" href="assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
<link rel="stylesheet" href="assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />
<link rel="stylesheet" href="assets/vendor/libs/select2/select2.css" />
<link rel="stylesheet" href="assets/vendor/libs/@form-validation/form-validation.css" />

<div class="container-xxl flex-grow-1" style="padding: 0px 10px;">
    <div class="card" style="margin-bottom:5px;">
        <div class="row" style="padding: 5px 5px;">
            <div class="col-md-8">
                <h6 class="card-header"><i class="ri-user-fill"></i> User Details</h6>
            </div>
            <!--<div class="col-md-4 text-end">-->
            <!--    <button type="button" class="btn btn-xs rounded-pill btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#awbModal">-->
            <!--        <i class="ri-file-add-fill"></i> Add User-->
            <!--    </button>-->
                
            <!--</div>-->
        </div>
    </div>
    <div class="card">
        <div class="table-responsive text-nowrap">
            <table id="awbTable" class="table" style="width: 99% !important;">
                <thead>
                    <tr>
                        <th style="padding: 8px 5px !important;">Sl.No</th>
                        <th style="padding: 8px 5px !important;">Prefix</th>
                        <th style="padding: 8px 5px !important;">Role</th>
                        <th style="padding: 8px 5px !important;">Is System</th>
                        <th style="padding: 8px 5px !important;">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Add/Edit AWB Modal -->
<div class="modal fade" id="awbModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Role Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="awbForm">
                <div class="modal-body">
                    <input type="hidden" id="awbID">
                    <input type="hidden" id="updated_by">
                    <input type="hidden" id="re_allocate" value="0">

                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="branch_id" class="form-label">Branch</label>
                        <select id="branch_id" name="branch_id" class="form-select form-select focus-next" style="padding-right: 0px;">
                        </select>
                    </div>

                    <!-- Mobile Field -->
                    <div class="mb-3">
                        <label for="product_id" class="form-label">Product</label>
                        <select id="product_id" name="product_id" class="form-select form-select focus-next" style="padding-right: 0px;">
                        </select>
                    </div>

                    <!-- Address1 Field -->
                    <div class="mb-3">
                        <label for="consignment_type_id" class="form-label">Consignment Type</label>
                        <select id="consignment_type_id" name="consignment_type_id" class="form-select form-select focus-next" style="padding-right: 0px;">
                            <option value="">Select Consignment Type</option>
                            <option value="1">Cash Virtual</option>
                            <option value="2">UPI</option>
                        </select>
                    </div>

                    <!-- Address2 Field -->
                    <div class="mb-3">
                        <label for="start" class="form-label">From Range</label>
                        <input type="text" id="start" name="start" class="form-control" placeholder="Enter From Range" oninput="this.value = this.value.replace(/[^0-9]/g, '')" >
                    </div>

                    <!-- Pincode Field -->
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Enter Quantity</label>
                        <input type="text" id="quantity" name="quantity" class="form-control" placeholder="Enter Quantity" >
                    </div>
                    
                    <div class="mb-3">
                        <label for="end" class="form-label">To Range</label>
                        <input type="text" id="end" name="end" class="form-control" placeholder="Enter To Range" oninput="this.value = this.value.replace(/[^0-9]/g, '')" >
                    </div>

                    <!-- Status Field -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-select" >
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this Role?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<!-- Vendors JS -->
<script src="assets/vendor/libs/jquery/jquery.js"></script>
<script src="assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="assets/vendor/libs/select2/select2.js"></script>
<script src="assets/vendor/libs/@form-validation/popular.js"></script>
<script src="assets/vendor/libs/@form-validation/bootstrap5.js"></script>
<script src="assets/vendor/libs/@form-validation/auto-focus.js"></script>

<script>
    $(document).ready(function () {
    
        // $('.select2').select2({
        //     allowClear: true
        // });
        getBranch();
        getProduct();
        
        $('#start, #quantity').on('input', function() {
            var from = parseInt($('#start').val()) || 0;
            var to = parseInt($('#end').val()) || 0;
            var quantity = parseInt($('#quantity').val()) || 0;
            var re_allocate = parseInt($('#re_allocate').val()) || 0;
    
            if(re_allocate == '1'){
                var to_range = from+quantity;
        
                if (to_range >= 0) {
                    $('#end').val(to_range); 
                } else {
                    $('#end').val(0); 
                }
            }
        });
        
    });

    document.addEventListener("DOMContentLoaded", function () {
        const table = $('#awbTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: 'api/role/read.php',
                type: 'GET'
            },
            columns: [
                { data: null, render: (data, type, row, meta) => meta.row + 1 },
                { data: 'prefix' },
                { data: 'name' },
                { data: 'is_system' },
                {
                    data: null,
                    render: (data) => {
                        if (data.id == 1) {
                            return ''; 
                        }
                        return `
                            <button class="btn btn-xs btn-secondary" onclick="permission(${data.id})">
                                <i class="ri-lock-fill"></i> Permission
                            </button>
                            <button class="btn btn-xs btn-danger" onclick="deleteAWB(${data.id})">
                                <i class="ri-chat-delete-fill"></i> Delete
                            </button>
                        `;
                    }
                }
            ]
        });
        document.getElementById("awbForm").addEventListener("submit", validateForm);
    });

function getBranch(){
    $.ajax({
        url: "api/helper/drop-down.php?table=tbl_branch&columns=id,branch_name&orderby=branch_name", // Adjust the path
        type: "GET",
        dataType: "json",
        success: function (response) {
            if (response.success) {
                let branchDropdown = $("#branch_id");
                branchDropdown.append('<option value="">Select Branch</option>');
                response.data.forEach(function (branch) {
                    branchDropdown.append(`<option value="${branch.id}">${branch.branch_name}</option>`);
                });
                // branchDropdown.select2({
                //     allowClear: true
                // });
            } else {
                console.error("Error:", response.error);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
}

function getProduct(){
    $.ajax({
        url: "api/helper/drop-down.php?table=tbl_products&columns=id,name&orderby=name", // Adjust the path
        type: "GET",
        dataType: "json",
        success: function (response) {
            if (response.success) {
                let productDropdown = $("#product_id");
                productDropdown.append('<option value="">Select Product</option>');
                response.data.forEach(function (product) {
                    productDropdown.append(`<option value="${product.id}">${product.name}</option>`);
                });
                // productDropdown.select2({
                //     allowClear: true
                // });
            } else {
                console.error("Error:", response.error); 
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
}

function showErrorsOneByOne(errors, color) {
    let delay = 0;
    
    errors.forEach((error, index) => {
        setTimeout(() => {
            showtoastt(`Error ${index + 1}: ${error}`, color);
        }, delay);
        
        delay += 2000;
    });
}

function validateForm(event) {
    event.preventDefault();
    let form = event.target;
    let isValid = true;

    let fields = [
        { id: "branch_id", message: "Branch Name is required." },
        { id: "product_id", message: "Product Name is required." },
        { id: "consignment_type_id", message: "Consignment Type is required." },
        { id: "start", message: "From Range Type is required." },
        { id: "end", message: "To Range Type is required." },
        { id: "status", message: "Status is required." }
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
            let errorDiv = document.createElement("div");
            errorDiv.className = "error-message text-danger mt-1";
            errorDiv.innerText = errorMessage;
            input.insertAdjacentElement("afterend", errorDiv);
        } else {
            input.classList.remove("is-invalid");
        }
    });
    if (isValid) submitAWBForm();
}

function submitAWBForm() {
    const submitButton = $('#awbForm').find('button[type="submit"]');
    submitButton.prop('disabled', true);

    const AWBData = {
        id: $('#awbID').val(),
        branch_id: $('#branch_id').val().trim(),
        product_id: $('#product_id').val().trim(),
        consignment_type_id: $('#consignment_type_id').val().trim(),
        start: $('#start').val().trim(),
        end: $('#end').val().trim(),
        status: $('#status').val(),
        re_allocate: $('#re_allocate').val(),
        updated_by: $('#updated_by').val()
    };

    const url = AWBData.id ? 'api/awb_series/update.php' : 'api/awb_series/create.php';

    $.ajax({
        url: url,
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(AWBData),
        success: function (response) {
            if(response.success){
                showtoastt(response.message, 'success');
                $('#awbTable').DataTable().ajax.reload();
                $('#awbModal').modal('hide');
                $('#awbForm')[0].reset();
                submitButton.prop('disabled', false);
            }else{
                showErrorsOneByOne(response.errors, 'red');
                $('#awbModal').modal('hide');
                submitButton.prop('disabled', false);
            }
        },
        error: function () {
            showtoastt('Something Went Wrong...', 'red');
        },
        complete: function () {
            submitButton.prop('disabled', false);
        }
    });
}

function openAddCustomerModal() {
    $('#awbForm')[0].reset();
    $('#awbForm').removeClass('was-validated');
    $('#awbID').val('');
    $('#modalTitle').text('Add User Details');
    $('#awbModal').modal('show');
}


function permission(id){
    window.location.href="setting-permission.php?id="+id;
} 


function editAWB(id) {
    $.get(`api/awb_series/read_single.php?id=${id}`, function (data) {
        $('#awbID').val(data.id);
        $('#branch_id').val(data.branch_id);
        $('#product_id').val(data.product_id);
        $('#consignment_type_id').val(data.consignment_type_id);
        $('#start').val(data.start);
        $('#end').val(data.end);
        $('#status').val(data.status);
        $('#re_allocate').val(0);
        $('#updated_by').val(data.updated_by);
        $('#modalTitle').text('Edit User Details');
        $('#awbModal').modal('show');
    });
}

function reallocateAWB(id) {
    $.get(`api/awb_series/read_single.php?id=${id}`, function (data) {
        $('#awbID').val(data.id);
        $('#branch_id').val(data.branch_id);
        $('#product_id').val(data.product_id);
        $('#consignment_type_id').val(data.consignment_type_id);
        $('#start').val(data.end);
        $('#end').val('');
        $('#status').val(data.status);
        $('#re_allocate').val(1);
        $('#updated_by').val(data.updated_by);
        $('#modalTitle').text('Reallocate User Details');
        $('#awbModal').modal('show');
    });
}

let deleteId = null;

function deleteAWB(id) {
    deleteId = id;
    $('#deleteModal').modal('show');
}

$('#confirmDelete').click(function () {
    if (deleteId) {
        $.ajax({
            url: `api/role/delete.php`,
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ id: deleteId }),
            success: function (response) {
                $('#deleteModal').modal('hide');
                showtoastt(response.message, 'success');
                $('#awbTable').DataTable().ajax.reload();
            },
            error: function () {
                $('#deleteModal').modal('hide');
                showtoastt('Something Went Wrong...', 'red');
            }
        });
    }
});

</script>

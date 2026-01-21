<?php include 'header.php' ?>
<!-- Vendors CSS -->
<link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
<link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />
<link rel="stylesheet" href="assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
<link rel="stylesheet" href="assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
<link rel="stylesheet" href="assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
<link rel="stylesheet" href="assets/vendor/libs/select2/select2.css" />
<link rel="stylesheet" href="assets/vendor/libs/@form-validation/form-validation.css" />

<div class="container-xxl flex-grow-1" style="padding: 0px 10px;">
    <div class="card mb-2">
        <div class="row p-2">
            <div class="col-md-8">
                <h6 class="card-header"><i class="ri-building-line"></i> State Secretary Details</h6>
            </div>
            <?php if(get_permission('s-secretary', 'is_add')){ ?>
            <div class="col-md-4 text-end">
                <button type="button" class="btn btn-xs btn-primary rounded-pill add_btn">
                    <i class="ri-file-add-fill"></i> Add New
                </button>
            </div>
            <?php } ?>
        </div>
        <div class="row p-2">
            <div class="row mb-1">
                <div class="col-sm-3">
                    <span style="font-size:12px;color: blue;">Filter By State</span>
                    <select id="filter_state_id" name="filter_state_id" class="form-select" required>
                        <option value="">All State</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <span style="font-size:12px;color: blue;">Filter By Verified</span>
                    <select id="filter_verify_id" name="filter_verify_id" class="form-select" >
                        <option value="">All List</option>
                        <option value="0">Not Verified</option>
                        <option value="1">Verified</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="table-responsive text-nowrap">
            <table id="clubTable" class="table" style="width: 100%;"> 
                <thead>
                    <tr> <th>Approved</th>
                        <?php if(get_permission('s-secretary', 'is_edit') || get_permission('s-secretary', 'is_view')|| get_permission('s-secretary', 'is_delete')){ ?>
                        <th>Actions</th>
                        <?php } ?>
                        <th>S.No</th>
                        <th>Member Id</th>
                        <th>full_name</th>
                        <th>gender</th>
                        <th>Mobile Number</th>
                        <th>Aadhar Number</th>
                        <th>Email Address</th>
                        <th>Address</th>
                        <th>State</th>
                       
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!--delete Modal-->
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this Secretary?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php' ?>
<!-- Vendors JS -->
<script src="assets/vendor/libs/jquery/jquery.js"></script>
<script src="assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="assets/vendor/libs/select2/select2.js"></script>
<script>

/*dropdown starts.......*/
    getDropDown('tbl_states','filter_state_id','state_name');

    
    $('#filter_state_id,#filter_verify_id').on('change',function(){
        getDataTable();
    });
/*dropdown ends.......*/
    
function getDataTable() {
    const stateId = $('#filter_state_id').val();
    const verifyId = $('#filter_verify_id').val();
    
    // Construct query parameters
    const params = new URLSearchParams();
    if (stateId) params.append("state_id", stateId);
    if (verifyId) params.append("verify_id", verifyId);
    const queryString = params.toString() ? `?${params.toString()}` : "";
    // <button class="btn btn-danger btn-xs" onclick="deleteClub(${data.id})"><i class="ri-chat-delete-fill"></i> Delete</button>

    const $table = $('#clubTable');

    if ($.fn.DataTable.isDataTable($table)) {
        $table.DataTable().clear().destroy();
    }

    $table.DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        ajax: {
            url: `api/s-secretary/read.php${queryString}`,
            type: 'GET'
        },
        columns: [
            { 
            data: null,
            render: function(data, type, row) {
                if (data.verified == 1) {
                    return '<button class="btn btn-success btn-sm" >Verified</button>';
                } else {
                    return `<button class="btn btn-danger btn-sm" onclick="viewSecretary(${data.id})">Not Verified</button>`;
                }
            }
            },  
            <?php if(get_permission('s-secretary', 'is_edit') || get_permission('s-secretary', 'is_view')|| get_permission('s-secretary', 'is_delete')){ ?>
            {
                data: null,
                orderable: false,
                searchable: false,
                className: "text-center",
                render: (data) => `<?php if(get_permission('s-secretary', 'is_edit')){ ?>
                            <button class="btn btn-warning btn-xs" onclick="editClub(${data.id})"><i class="ri-edit-box-fill"></i> Edit</button>
                            <?php }  if(get_permission('s-secretary', 'is_delete')){ ?>
                                    <?php } if (get_permission('s-secretary', 'is_view')){ ?>
                                    <button class="btn btn-success btn-xs" onclick="viewSecretary(${data.id})"><i class="ri-chat-delete-fill"></i> View</button>
                                    <?php } ?> `
            },
            <?php } ?>
            { data: null, render: (data, type, row, meta) => meta.row + 1 }, // Auto-increment row index
            { data: 'member_id' },
            // { 
            //     data:null,
            //     render: (data, type, row) => `<a href="view-s-secretary-info.php?id=${data.id}" class="">${data.full_name}</a>` 
            // },
            {
                data: null,
                render: (data, type, row) => {
                    let color = data.verified == 1 ? 'green' : 'red';
                    return `<a href="view-s-secretary-info.php?id=${data.id}" style="color: ${color};">${data.full_name}</a>`;
                }
            },
            { data: 'gender' },
            { data: 'mobile_number' },
            { data: 'aadhar_number' },
             { data: 'email_address' },
            { data: 'residential_address' },
            { data: 'state_name' }
            
        ],
        order: [[1, 'asc']], // Default sorting by club_name
        // responsive: true,    // Enables responsiveness
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Pagination options
    });
}


$(document).ready(function () {
    getDataTable();
    
$('.add_btn').on('click', function() {
    window.location.href = 's-secretary.php';
});

    $('#branchForm').on('submit', function (e) {
        e.preventDefault();
        if (this.checkValidity()) {
            submitBranchForm();
        } else {
            this.classList.add('was-validated');
        }
    });
});


function editClub(id) {
   window.location.href = 's-secretary.php?id='+id;
}

function viewSecretary(id) {
        window.location.href='view-s-secretary-info.php?id='+id;
      
    }

var deleteId = null; // Store the ID of the product to be deleted

function deleteClub(id) {
    deleteId = id;
    $('#deleteModal').modal('show'); // Show the modal
}


$('#confirmDelete').click(function () {
    if (deleteId) {
        $.ajax({
            url: `api/s-secretary/delete.php`,
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ id: deleteId }),
            dataType: 'json', // Ensure the response is treated as JSON
            success: function (response) {
                console.log(response);
                $('#deleteModal').modal('hide'); // Hide modal on success
                if (response.status === 'success') {
                    showtoastt(response.message, 'success');
                    $('#clubTable').DataTable().ajax.reload();
                } else {
                    showtoastt(response.message, 'red');
                    $('#clubTable').DataTable().ajax.reload();
                }
            },
            error: function (jqXHR) {
                //$('#clubTable').modal('hide');
                $('#deleteModal').modal('hide'); // Hide modal on success
                let errorMessage = 'Something went wrong...';
                $('#clubTable').DataTable().ajax.reload();
                if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
                    errorMessage = jqXHR.responseJSON.message;
                }
                showtoastt(errorMessage, 'red');
            }
        });
    }
});
</script>

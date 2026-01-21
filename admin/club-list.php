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
                <h6 class="card-header"><i class="ri-building-line"></i> Club Details</h6>
            </div>
            <?php if(get_permission('club', 'is_add')){ ?>
            <div class="col-md-4 text-end" hidden>
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
                    <span style="font-size:12px;color: blue;">Filter By District</span>
                    <select id="filter_district_id" name="filter_district_id" class="form-select" required>
                        <option value="">All District</option>
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
                   <div class="col-sm-3">
                    <span style="font-size:12px;color: blue;">Filter By Payment Status</span>
                    <select id="payment_status" name="payment_status" class="form-select" >
                        <option value="">All List</option>
                        <option value="1">Success</option>
                        <option value="0">Pending</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="table-responsive text-nowrap">
            <table id="clubTable" class="table" style="width: 100%;"> 
                <thead>
                    <tr><th>Verified</th>
                        <?php if(get_permission('club', 'is_edit') || get_permission('club', 'is_view')|| get_permission('club', 'is_delete')){ ?>
                        <th>Actions</th>
                        <?php } ?>
                        <th>Sl.No</th>
                        <th>Club Name</th>
                        <th>Register No</th>
                        <th>Contact Person</th>
                        <th>Mobile Number</th>
                        <!--<th>Email Address</th>-->
                        <th>District</th>
                        <th>State</th>
                        <th>Status</th>
                        
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
        Are you sure you want to delete this Club?
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

    
    $('#filter_state_id').on('change',function(){
        var state_id = $('#filter_state_id').val();
        getDropDown('tbl_districts','filter_district_id','district_name',{'state_id':state_id});
    });
    
    
    
    $('#filter_state_id,#filter_district_id,#filter_verify_id,#payment_status').on('change',function(){
        getDataTable();
    });
/*dropdown ends.......*/
    
function getDataTable() {
    const stateId = $('#filter_state_id').val();
    const districtId = $('#filter_district_id').val();
    const verifyId = $('#filter_verify_id').val();
    const payment_status = $('#payment_status').val();
    console.log('verifyId'+verifyId);
    //   <button class="btn btn-danger btn-xs" onclick="deleteClub(${data.id})"><i class="ri-chat-delete-fill"></i> Delete</button>
    // Construct query parameters
    const params = new URLSearchParams();
    if (stateId) params.append("state_id", stateId);
    if (districtId) params.append("district_id", districtId);
    if (verifyId) params.append("verify_id", verifyId);
    if (payment_status) params.append("payment_status", payment_status);
    const queryString = params.toString() ? `?${params.toString()}` : "";


    const $table = $('#clubTable');

    if ($.fn.DataTable.isDataTable($table)) {
        $table.DataTable().clear().destroy();
    }

    $table.DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        ajax: {
            url: `api/club/read.php${queryString}`,
            type: 'GET'
        },
        columns: [     { 
            data: null,
            render: function(data, type, row) {
                if (data.verified == 1) {
                    return '<button class="btn btn-success btn-sm" >Verified</button>';
                } else {
                    return `<button class="btn btn-danger btn-sm" onclick="viewClub(${data.id})">Not Verified</button>`;
                }
            }
            },  
            <?php if(get_permission('club', 'is_edit') || get_permission('club', 'is_view')|| get_permission('club', 'is_delete')){ ?>
            {
                data: null,
                orderable: false,
                searchable: false,
                className: "text-center",
                render: (data) => `<?php if(get_permission('club', 'is_edit')){ ?>
                                    <button class="btn btn-warning btn-xs" onclick="editClub(${data.id})"><i class="ri-edit-box-fill"></i> Edit</button>
                                    <?php }  if(get_permission('club', 'is_delete')){ ?>
                                 
                                    <?php } if (get_permission('club', 'is_view')){ ?>
                                    <button class="btn btn-success btn-xs" onclick="viewClub(${data.id})"><i class="ri-chat-delete-fill"></i> View</button>
                                    <?php } ?>`
            },
            <?php } ?>
            { data: null, render: (data, type, row, meta) => meta.row + 1 }, // Auto-increment row index
            {
                data: null,
                render: (data, type, row) => {
                    let color = data.verified == 1 ? 'green' : 'red';
                    return `<a href="view-club-info.php?id=${data.id}" style="color: ${color};">${data.club_name}</a>`;
                }
            },
            // { data: 'club_name' },
            { data: 'registration_number' },
            { data: 'contact_person' },
            { data: 'mobile_number' },
            // { data: 'email_address' },
            { data: 'district_name' },
            { data: 'state_name' },
            { data: 'status' }
       
        ],
        order: [[1, 'asc']], // Default sorting by club_name
        // responsive: true,    // Enables responsiveness
        lengthMenu: [[10, 25, 50, 100,500,1000], [10, 25, 50, 100,500,1000]], // Pagination options
    });
}
  
    

$(document).ready(function () {
    
$('.add_btn').on('click', function() {
    window.location.href = 'club.php';
});
    
    getDataTable();

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
   window.location.href = 'club.php?id='+id;
}

function viewClub(id) {
        window.location.href='view-club-info.php?id='+id;
      
    }


var deleteId = null; // Store the ID of the product to be deleted

function deleteClub(id) {
    deleteId = id;
    $('#deleteModal').modal('show'); // Show the modal
}


$('#confirmDelete').click(function () {
    if (deleteId) {
        $.ajax({
            url: `api/club/delete.php`,
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

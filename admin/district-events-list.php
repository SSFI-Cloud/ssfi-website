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
                <h6 class="card-header"><i class="ri-building-line"></i> District Event Details</h6>
            </div>
            
            <div class="col-md-4 text-end">
                <?php if(get_permission('district_event', 'is_add')){ ?>
                    <button type="button" class="btn btn-xs btn-primary rounded-pill add_btn">
                        <i class="ri-file-add-fill"></i> Add New
                    </button>
                <?php } ?>
                <?php if(get_permission('district_event', 'is_view')){ ?>
                    <button type="button" class="btn btn-xs btn-info rounded-pill add_btn_register">
                        <i class="ri-file-add-fill"></i> Skater Event Register
                    </button>
                <?php } ?>
                
            </div>
            
            
            
            
            
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
            </div>
        </div>
    </div>
    
    
    
    
    <div class="card">
        <div class="table-responsive text-nowrap">
            <table id="clubTable" class="table" style="width: 100%;"> 
                <thead>
                    <tr>
                        <?php if(get_permission('district_event', 'is_edit') ||  get_permission('district_event', 'is_delete') ||  get_permission('district_event', 'is_view')){ ?>
                        <th>Actions</th>
                        <?php } ?>
                        <th>Sl.No</th>
                        <th>Skaters</th>
                        <th>Event Skater</th>
                        <th>Reg. Start Date</th>
                        <th>Reg. End Date</th>
                        <!--<th>Event Level Type</th>-->
                        <th>Event Name</th>
                        <th>State</th>
                        <th>District</th>
                        <th>Event Fees</th>
                        <!--<th>Event Image</th>-->
                        <th>Event Date </th>
                        <th>Event Description</th>
                        <th>Event Remarks</th>
                        <th>Status</th>
                        <th>Title of Championship</th>
                        <th>Association Name</th>
                        <th>Registration Number</th>
                        <th>Date</th>
                        <th>Venue</th>
                        
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
        Are you sure you want to delete this Events?
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
$(document).ready(function () {
    
    getDropDown('tbl_states','filter_state_id','state_name');
getDataTable();
    
    $('#filter_state_id').on('change',function(){
        var state_id = $('#filter_state_id').val();
        getDropDown('tbl_districts','filter_district_id','district_name',{'state_id':state_id});
    });
    
    $('#filter_state_id,#filter_district_id').on('change',function(){
        getDataTable();
    });
    
$('.add_btn').on('click', function() {
    window.location.href = 'district-events.php';
});

$('.add_btn_register').on('click', function() {
    window.location.href = 'events-register.php';
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
   window.location.href = 'district-events.php?id='+id;
}

var deleteId = null; // Store the ID of the product to be deleted

function deleteClub(id) {
    deleteId = id;
    $('#deleteModal').modal('show'); // Show the modal
}


$('#confirmDelete').click(function () {
    if (deleteId) {
        $.ajax({
            url: `api/d-events/delete.php`,
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

function getDataTable() { 
    const stateId = $('#filter_state_id').val();
    const districtId = $('#filter_district_id').val();
    const params = new URLSearchParams();
    if (stateId) params.append("state_id", stateId);
    if (districtId) params.append("district_id", districtId);
    const queryString = params.toString() ? `?${params.toString()}` : "";
    
    /*<button class="btn btn-danger btn-xs" onclick="deleteClub(${data.id})"><i class="ri-chat-delete-fill"></i> Delete</button>*/
    
    const table = $('#clubTable').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        ajax: {
            url: `api/d-events/read.php${queryString}`,
            type: 'GET'
        },
       columns: [
           <?php if(get_permission('district_event', 'is_edit') ||  get_permission('district_event', 'is_delete') ||  get_permission('district_event', 'is_view')){ ?>
    {
        data: null,
render: (data) => {
    let html = ``;

    <?php if(get_permission('district_event', 'is_edit')){ ?>
        html += `<a class="btn btn-info btn-xs" href="events-result.php?event_id=${data.id}">
                    <i class="ri-edit-box-fill"></i> Update Result
                 </a>
                 <button class="btn btn-warning btn-xs" onclick="editClub(${data.id})">
                    <i class="ri-edit-box-fill"></i> Edit
                 </button>`;
    <?php } ?>

    <?php if(get_permission('district_event', 'is_view')){ ?>
        html += `<a class="btn btn-success btn-xs" href="events-report.php?event_id=${data.id}">
                    <i class="ri-edit-box-fill"></i> View Event Register List
                 </a>`;
        

        <?php if($_SESSION['user_id']==1){ ?>
            if (data.register && data.register > 0) {
                let total = data.register;
                let batch = 100;
                let dropdown = `<div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-view-box-fill"></i> Print Certificates
                                    </button>
                                    <ul class="dropdown-menu">`;

                for (let i = 0; i < total; i += batch) {
                    let start = i + 1;
                    let end = Math.min(i + batch, total);
                    dropdown += `<li>
                                    <a class="dropdown-item" target="_blank" href="certificates/certificate/certificate.php?event_id=${data.id}&limit=${i},${batch}">
                                        ${start} - ${end}
                                    </a>
                                 </li>`;
                }

                dropdown += `</ul></div>`;
                html += dropdown;
            }
        <?php } ?>
        
        html += `<a class="btn btn-secondary btn-xs" href="excel/state_selection_list.php?event_id=${data.id}">
                    State Selection List
                 </a>`;
                 
    <?php } ?>

    <?php if(get_permission('district_event', 'is_delete')){ ?>
        // delete button if needed
    <?php } ?>

    return html;
}


    },
    <?php } ?> 
    { data: null, render: (data, type, row, meta) => meta.row + 1 },
    { data: 'eligible' },
    { data: 'register' },
    { 
        data: 'reg_start_date',
        render: (data) => {
            if (!data) return ''; 
            const date = new Date(data);
            const formattedDate = date.toLocaleDateString('en-GB').split('/').reverse().join('-'); // Converts to DD-MM-YYYY
            const formattedTime = date.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true }).replace(':', '.'); // hh.mmAM/PM
            return `${formattedDate}`;
        }
    },
    { 
        data: 'reg_end_date',
        render: (data) => {
            if (!data) return ''; 
            const date = new Date(data);
            const formattedDate = date.toLocaleDateString('en-GB').split('/').reverse().join('-'); // Converts to DD-MM-YYYY
            const formattedTime = date.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true }).replace(':', '.'); // hh.mmAM/PM
            return `${formattedDate}`;
        }
    },
    
    { data: 'event_name' },
    { data: 'state_name' },
    { data: 'district_name' },
    { data: 'event_fees' },
    { data: 'event_date' },
    { data: 'event_description' },
    { data: 'event_remarks' },
    { data: 'status' },
    { data: 'title_of_championship' },
    { data: 'association_name' },
    { data: 'reg_no' },
    { data: 'date' },
    { data: 'venue' },
    
]

    });
}
</script>

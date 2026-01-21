<?php include('header.php');
// print_r($_SESSION['role_id']);
?>
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
                <h6 class="card-header"><i class="ri-building-line"></i> Skater Details</h6>
            </div>
            <?php if(get_permission('skater', 'is_add')){ ?>
            <?php if($_SESSION['role_id']==1){ ?>
            <div class="col-md-4 text-end">
                <button type="button" class="btn btn-xs btn-primary rounded-pill add_btn">
                <i class="ri-file-add-fill"></i> Add New
                </button>
            </div>
            <?php } ?>
            <?php } ?>
            <?php if($_SESSION['role_id']==4 || $_SESSION['role_id']==3 || $_SESSION['role_id']==2){?>
            <div class="col-md-4 text-end">
                <a href='skater-for-club.php'><button type="button" class="btn btn-xs btn-primary rounded-pill">
                <i class="ri-file-add-fill"></i> Add New
                </button></a>
            </div>
            <?php }?>
        </div>
        <div class="row p-2">
            <div class="row mb-1">
                <div class="col-sm-1">
                    <span style="font-size:12px;color: blue;">Filter By Year</span>
                    <select id="filter_year" name="filter_year" class="form-select" required>
                        <option value="">All Year</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <span style="font-size:12px;color: blue;">Filter By State</span>
                    <select id="filter_state_id" name="filter_state_id" class="form-select" required>
                        <option value="">All State</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <span style="font-size:12px;color: blue;">Filter By District</span>
                    <select id="filter_district_id" name="filter_district_id" class="form-select" required>
                        <option value="">All District</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <span style="font-size:12px;color: blue;">Filter By Club</span>
                    <select id="filter_club_id" name="filter_club_id" class="form-select" required>
                        <option value="">All Club</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <span style="font-size:12px;color: blue;">Filter By Category</span>
                    <select name="filter_cat_id" id="filter_cat_id" class="form-control" required="">
                                                </select>
                </div>
                <div class="col-sm-2">
                    <span style="font-size:12px;color: blue;">Filter By Age Category</span>
                    <select id="filter_category" name="filter_category" class="form-select" >
                        <option value="">All</option>
                        <option value="Under 4">Under 4</option>
                        <option value="Under 6">Under 6</option>
                        <option value="Under 8">Under 8</option>
                        <option value="Under 10">Under 10</option>
                        <option value="Under 12">Under 12</option>
                        <option value="Under 14">Under 14</option>
                        <option value="Under 16">Under 16</option>
                        <option value="Above 16">Above 16</option>
                       
                    </select>
                </div>
                <div class="col-sm-2">
                    <span style="font-size:12px;color: blue;">Filter By Gender</span>
                    <select id="filter_gender" name="filter_gender" class="form-select" >
                        <option value="">All</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <span style="font-size:12px;color: blue;">Filter By Verified</span>
                    <select id="filter_verify_id" name="filter_verify_id" class="form-select" >
                        <option value="">All List</option>
                        <option value="0">Not Verified</option>
                        <option value="1">Verified</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <span style="font-size:12px;color: blue;">Filter By Payment</span>
                    <select id="filter_payment" name="filter_payment" class="form-select" >
                        <option value="">All</option>
                        <option value="0">Paid</option>
                        <option value="1">Not Paid</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <span style="font-size:12px;color: blue;">Filter By Date Start</span>
                    <input type="date" name="start_date"  class="form-control" id="start_date" placeholder="Enter your date Of Birth" required/>
                </div>
                <div class="col-sm-2">
                    <span style="font-size:12px;color: blue;">Filter By Date End</span>
                    <input type="date" name="end_date"  class="form-control" id="end_date" placeholder="Enter your date Of Birth" required/>
                </div>
                
                
                <div class="col-sm-12" style="padding-top:10px;">
                    <div class="row mb-1">
                        <div class="col-sm-6">
                            S.Records : <span id="skater_selected">0</span>
                            <button class="btn btn-sm btn-success" type="button" id="cert_btn" onclick="SendMessage(1)"> Send Certificate Confirmation</button>
                            <button class="btn btn-sm btn-danger" type="button" onclick="SendMessage(2)"> Send Un-Paid Message</button>
                        </div>
                        
                        <div class="col-sm-4" style="text-align:right;">
                            <div id="exportBtnWrapper" ></div>
                        </div>
                        <div class="col-sm-2" style="text-align:right;">
                            <button class="btn btn-sm btn-primary" id="toggleColumnPanel" type="button">
                                Show & Hide Columns
                            </button>
                        </div>
                    </div>
                    
                    <div id="columnToggles" style="margin-top:10px; display:none;">
                        <!-- Checkboxes will be inserted here -->
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
    
<style>
.buttons-html5{
    padding: 2px 20px;
    font-size: 13px;
}
#columnToggles label {
    display: inline-block;
    margin-right: 10px;
    font-size: 13px;
}
</style>

    <div class="card">
        <div class="table-responsive text-nowrap">
            <!-- Column Toggle Checkboxes -->

            <table id="skaterTables" class="table" style="width: 100%;">
                <thead>
                    <tr>  <th>Verified</th>
                        <?php if(get_permission('skater', 'is_edit') || get_permission('skater', 'is_view')|| get_permission('skater', 'is_delete')){ ?>
                        <th>Actions</th>
                        <?php } ?>
                        <th><input type="checkbox" id="selectAllSkaters" class="skater_checks"></th>
                        <th>S.No</th>
                        <th>Download Aadhar</th>
                        <th>Download Photo</th>
                        <th>Member Id</th>
                        <th>State</th>
                        <th>District</th>
                        <th>Club</th>
                        <th>Category Type</th>
                        <th>Age Category</th>
                        <th>Full Name</th>
                        <th>Father Name</th>
                        <th>Mobile Number</th>
                        <th>Date of Birth</th>
                        
                        <th>Gender</th>
                        <th>Blood Group</th>
                        <th>School Name</th>
                        <th>Aadhar Number</th>
                        <th>Email Address</th>
                        <th>Coach Name</th>
                        <th>Coach Mobile Number</th>
                        <th>Payment ID</th>
                        
                        <th>Nominee Name</th>
                        <th>Nominee Age</th>
                        <th>Nominee Relation</th>
                        
                    </tr>
                </thead>
            </table>
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
                Are you sure you want to delete this Skater?
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
        //getDropDown('tbl_clubs','filter_club_id','club_name');
        getDropDown('tbl_category_type','filter_cat_id','cat_name');
        getDropDown('tbl_session','filter_year','name');
    
        $('#filter_state_id').on('change',function(){
            var state_id = $('#filter_state_id').val();
            getDropDown('tbl_districts','filter_district_id','district_name',{'state_id':state_id});
        });
    
        $('#filter_state_id,#filter_district_id,#filter_club_id,#filter_verify_id,#filter_payment,#filter_cat_id,#filter_category,#filter_gender,#start_date,#end_date,#filter_year').on('change',function(){
            getDataTable();
        });
        
    $('#filter_state_id,#filter_district_id').on('change',function(){
        var state_id = $('#state_id').val();
        var district_id = $('#filter_district_id').val();
        getDropDown('tbl_clubs','filter_club_id','club_name',{'state_id':state_id,'district_id':district_id});
    });
        
        
    /*dropdown ends.......*/
    
    function getDataTable() {
        const stateId = $('#filter_state_id').val();
        const districtId = $('#filter_district_id').val();
        const ClubId = $('#filter_club_id').val();
        const verifyId = $('#filter_verify_id').val();
        const filter_payment = $('#filter_payment').val();
        
        
        const filter_category_id = $('#filter_cat_id').val();
        const filter_agecategory = $('#filter_category').val();
        const filter_gender = $('#filter_gender').val();
        const start_date = $('#start_date').val();
        const end_date = $('#end_date').val();
        const filter_year = $('#filter_year').val();
        
        // console.log(verifyId);
            //  <button class="btn btn-danger btn-xs" onclick="deleteSkater(${data.id})"><i class="ri-chat-delete-fill"></i> Delete</button>

        // Construct query parameters
        const params = new URLSearchParams();
        if (stateId) params.append("state_id", stateId);
        if (districtId) params.append("district_id", districtId);
        if (ClubId) params.append("club_id", ClubId);
        if (verifyId) params.append("verify_id", verifyId);
        if (filter_payment) params.append("filter_payment", filter_payment);
        if (filter_category_id) params.append("filter_category_id", filter_category_id);
        if (filter_agecategory) params.append("filter_agecategory", filter_agecategory);
        if (filter_gender) params.append("filter_gender", filter_gender);
        if (start_date) params.append("start_date", start_date);
        if (end_date) params.append("end_date", end_date);
        if (filter_year) params.append("filter_year", filter_year);
        const queryString = params.toString() ? `?${params.toString()}` : "";
    
    
        const $table = $('#skaterTables');
    
        if ($.fn.DataTable.isDataTable($table)) {
            $table.DataTable().clear().destroy();
        }
    
$table.DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: {
                url: `api/skaters/read.php${queryString}`,
                type: 'GET'
            },
            columns: [
                { 
                data: null,
                render: function(data, type, row) {
                    if (data.verified == 1) {
                        return '<button class="btn btn-success btn-sm" >Verified</button>';
                    } else {
                        return `<button class="btn btn-danger btn-sm" onclick="viewskater(${data.id})">Not Verified</button>`;
                    }
                }
            },  
            <?php if(get_permission('skater', 'is_edit') || get_permission('skater', 'is_view')|| get_permission('skater', 'is_delete')){ ?>
                {
                    data: null,
                    render: (data) => `<?php if(get_permission('skater', 'is_edit')){ ?>
                        <button class="btn btn-warning btn-xs" onclick="editSkater(${data.id})"><i class="ri-edit-box-fill"></i> Edit</button>
                        <?php }  if(get_permission('skater', 'is_delete')){ ?>
                        <button class="btn btn-danger btn-xs" onclick="deleteSkater(${data.id})"><i class="ri-chat-delete-fill"></i> Delete</button>
                        <?php } if (get_permission('skater', 'is_view')){ ?>
                        <button class="btn btn-success btn-xs" onclick="viewskater(${data.id})"><i class="ri-chat-delete-fill"></i> View</button>
                        <?php } ?>
                    `
                },
                <?php } ?>
                { 
                    data: null,
                    orderable: false,  // ✅ Disable sorting for this column
                    searchable: false, // (Optional) Disable search for this column too
                    render: function(data, type, row) {
                            return `<input type="checkbox" class="skater_check" value="${data.id}">`;
                    }
                },  
                { data: null, render: (data, type, row, meta) => meta.row + 1 }, // Auto-increment row index
            //     { 
            //     data:null,
            //     render: (data, type, row) => `<a href="view-skater-info.php?id=${data.id}" class="">${data.membership_id}</a>` 
            // },
                        {
                    data: 'profile_photo',
                    render: function(data, type, row) {
                        if (data) {
                            return `<a href="${data}" target="_blank" download class="btn btn-primary btn-sm">
                                        <i class="ri-download-2-line"></i> Photo
                                    </a>`;
                        } else {
                            return `<span class="text-muted">No Photo</span>`;
                        }
                    }
                },
        
                // 🟢 NEW COLUMN: Aadhaar Card Download
                {
                    data: 'identity_proof',
                    render: function(data, type, row) {
                        if (data) {
                            return `<a href="${data}" target="_blank" download class="btn btn-info btn-sm">
                                        <i class="ri-download-2-line"></i> Aadhaar
                                    </a>`;
                        } else {
                            return `<span class="text-muted">No File</span>`;
                        }
                    }
                },
                {
                    data: null,
                    render: (data, type, row) => {
                        let color = data.verified == 1 ? 'green' : 'red';
                        return `<a href="view-skater-info.php?id=${data.id}" style="color: ${color};">${data.membership_id}</a>`;
                    }
                },
                { data: 'state_name' },
                { data: 'district_name' },
                { data: 'club_name' },
                { data: 'cat_name' },
                { data: 'age_category' },
                { data: 'full_name' },
                { data: 'father_name' },
                { data: 'mobile_number' },
                { data: 'date_of_birth' },
                { data: 'gender' },
                { data: 'blood_group' },
                { data: 'school_name' },
                { data: 'aadhar_number' },
                { data: 'email_address' },
                { data: 'coach_name' },
                { data: 'coach_mobile_number' },
                { data: 'payment_id' },
                { data: 'nominee_name' },
                { data: 'nominee_age' },
                { data: 'nominee_relation' }
                
            ]
            ,
            order: [[1, 'desc']], // Default sorting by club_name
            // responsive: true,    // Enables responsiveness
            lengthMenu: [[10, 25, 50, 100, 1000], [10, 25, 50, 100, 1000]],
            dom: '<"row mb-3"<"col-sm-4"l><"col-sm-4 text-center"B><"col-sm-4"f>>rt<"row mt-3"<"col-sm-6"i><"col-sm-6"p>>',
                buttons: [
                    {
                        extend: 'csvHtml5',
                        text: 'Export CSV',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Export Excel',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]

        });
    var table = $('#skaterTables').DataTable();  
    table.buttons().container().appendTo('#exportBtnWrapper'); // ID of your custom div
    $('#columnToggles').empty();
    table.columns().every(function (index) {
        var column = this;
        var colTitle = $(column.header()).text();   
    $('#columnToggles').append(
            `<label style="padding: 5px 10px;"><input type="checkbox" class="toggle-column" data-column="${index}" checked> ${colTitle}</label> `
        );
    });

    // Toggle column visibility on checkbox change
    $('#columnToggles').on('change', '.toggle-column', function () {
        var colIndex = $(this).data('column');
        var isChecked = $(this).is(':checked');
        table.column(colIndex).visible(isChecked);
    });
}
    
    
    
    $(document).ready(function () {
        
        $('.add_btn').on('click', function() {
        window.location.href = 'skater.php';
    });
    
    getDataTable();
    });
    
    function editSkater(id) {
        window.open('skater.php?id=' + id, '_blank');
    }
    
    function viewskater(id) {
        //window.location.href='view-skater-info.php?id='+id;
        window.open('view-skater-info.php?id=' + id, '_blank');
    }
    
    
    
    var deleteId = null;
    var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    function deleteSkater(id) {
        deleteId = id;
        $('#deleteModal').modal('show'); // Show the modal
    }
    $('#deleteModal').click(function () {
        if (deleteId) {
            $.ajax({
                url: `api/skaters/delete.php`,
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ id: deleteId }),
                dataType: 'json',
                success: function (response) {
                    deleteModal.hide();
                    $('#skaterTables').DataTable().ajax.reload();
                },
                error: function () {
                    deleteModal.hide();
                    $('#skaterTables').DataTable().ajax.reload();
                }
            });
        }
    });
    // Toggle show/hide panel on button click
    $('#toggleColumnPanel').on('click', function () {
        $('#columnToggles').toggle();
    });
    $(document).on('change', '#selectAllSkaters', function () {
    const isChecked = $(this).is(':checked');
    $('.skater_check').prop('checked', isChecked);
});


function SendMessage(type){
    $('#cert_btn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Loading Pls Wait...');
    var checkedBoxes = $('.skater_check:checked');
    var count = checkedBoxes.length;

    if (count === 0) {
      alert('Please select at least one skater.');
    } else {
      var selectedIds = [];
      checkedBoxes.each(function () {
        selectedIds.push($(this).val());
      });

      // Send selectedIds to AJAX
      $.ajax({
        url: 'api/skaters/send-certificate-confirmation.php',
        method: 'POST',
        data: { ids: selectedIds,type:type },
        success: function (response) {
          console.log('Success:', response);
          alert("Sended...");
          $('#cert_btn').prop('disabled', false).html('Send Certificate Confirmation');
        },
        error: function (xhr, status, error) {
          console.error('Error:', error);
          $('#cert_btn').prop('disabled', false).html('Send Certificate Confirmation');
        }
      });
    }
}
$(document).on('change', '.skater_check,.skater_checks', function () {
    let count = $('.skater_check:checked').length;
    $('#skater_selected').text(count);
  });


</script>
<?php include('header.php');?>
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
                <h6 class="card-header"><i class="ri-building-line"></i> Skater Report</h6>
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
                <div class="col-sm-3">
                    <span style="font-size:12px;color: blue;">Filter By Club</span>
                    <select id="filter_club_id" name="filter_club_id" class="form-select" required>
                        <option value="">All Club</option>
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
            <table id="skaterTables" class="table" style="width: 100%;">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Member Id</th>
                        <th>Full Name</th>
                        <th>Father Name</th>
                        <th>Mobile Number</th>
                        <th>Date of Birth</th>
                        <th>Category Type</th>
                        <th>Gender</th>
                        <th>Blood Group</th>
                        <th>School Name</th>
                        <th>Aadhar Number</th>
                        <th>Email Address</th>
                        <th>Club</th>
                        <th>Coach Name</th>
                        <th>Coach Mobile Number</th>
                        <th>State</th>
                        <th>District</th>
                        <th>Verified</th>
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
        getDropDown('tbl_clubs','filter_club_id','club_name');
    
        $('#filter_state_id').on('change',function(){
            var state_id = $('#filter_state_id').val();
            getDropDown('tbl_districts','filter_district_id','district_name',{'state_id':state_id});
        });
    
        $('#filter_state_id,#filter_district_id,#filter_club_id,#filter_verify_id').on('change',function(){
            getDataTable();
        });
    /*dropdown ends.......*/
    
    function getDataTable() {
        const stateId = $('#filter_state_id').val();
        const districtId = $('#filter_district_id').val();
        const ClubId = $('#filter_club_id').val();
        const verifyId = $('#filter_verify_id').val();
        // console.log(verifyId);
        
        // Construct query parameters
        const params = new URLSearchParams();
        if (stateId) params.append("state_id", stateId);
        if (districtId) params.append("district_id", districtId);
        if (ClubId) params.append("club_id", ClubId);
        if (verifyId) params.append("verify_id", verifyId);
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
                { data: null, render: (data, type, row, meta) => meta.row + 1 }, // Auto-increment row index
                {
                    data: null,
                    render: (data, type, row) => {
                        let color = data.verified == 1 ? 'green' : 'red';
                        return `<a style="color: ${color};">${data.membership_id}</a>`;
                    }
                },
                 { data: 'full_name' },
                { data: 'father_name' },
                { data: 'mobile_number' },
                { data: 'date_of_birth' },
                { data: 'cat_name' },
                { data: 'gender' },
                { data: 'blood_group' },
                { data: 'school_name' },
                { data: 'aadhar_number' },
                { data: 'email_address' },
                { data: 'club_name' },
                { data: 'coach_name' },
                { data: 'coach_mobile_number' },
                { data: 'state_name' },
                { data: 'district_name' },
                { 
                data: null,
                render: function(data, type, row) {
                    if (data.verified == 1) {
                        return '<button class="btn btn-success btn-sm" >Verified</button>';
                    } else {
                        return `<button class="btn btn-danger btn-sm">Not Verified</button>`;
                    }
                }
            }
            ],
            order: [[1, 'asc']], // Default sorting by club_name
            responsive: true,    // Enables responsiveness
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Pagination options
        });
    }
    
    
    
    $(document).ready(function () {
        
        $('.add_btn').on('click', function() {
        window.location.href = 'skater.php';
    });
    
    getDataTable();
        
        

    });
    


</script>
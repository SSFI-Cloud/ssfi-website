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
                <h6 class="card-header"><i class="ri-building-line"></i> State Secretary Reports</h6>
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
                    <tr>
                        <th>S.No</th>
                        <th>full_name</th>
                        <th>gender</th>
                        <th>Email Address</th>
                        <th>Mobile Number</th>
                        <th>Aadhar Number</th>
                        <th>Address</th>
                        <th>State</th>
                        <th>Approved</th>
                    </tr>
                </thead>
            </table>
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
            { data: null, render: (data, type, row, meta) => meta.row + 1 }, // Auto-increment row index
            // { 
            //     data:null,
            //     render: (data, type, row) => `<a href="view-s-secretary-info.php?id=${data.id}" class="">${data.full_name}</a>` 
            // },
            {
                data: null,
                render: (data, type, row) => {
                    let color = data.verified == 1 ? 'green' : 'red';
                    return `<a style="color: ${color};">${data.full_name}</a>`;
                }
            },
            // { data: 'full_name' },
            { data: 'gender' },
            { data: 'email_address' },
            { data: 'mobile_number' },
            { data: 'aadhar_number' },
            { data: 'residential_address' },
            { data: 'state_name' },
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
    getDataTable();

});



</script>

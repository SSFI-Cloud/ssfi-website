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
                <h6 class="card-header"><i class="ri-building-line"></i> Event Register Report Details</h6>
            </div>
            <div class="col-md-4 text-end">
                <button type="button" class="btn btn-xs btn-warning rounded-pill back_btn">
                <i class="ri-file-add-fill"></i> Back to Event List
                </button>
            </div>
        </div>
        <div class="row p-2">
            <div class="row mb-1">
                <div class="row mb-1"> 
                    <div class="col-sm-6">
                        <span >Event Name :</span>
                        <b id="event_name"></b>
                        <br>
                        <span >Venue :</span>
                        <b id="venue"></b>
                    </div>
                   
                </div>
                
                <div class="col-sm-2">
                    <span style="font-size:12px;color: blue;">Filter By Payment</span>
                    <select id="filter_payment" name="filter_payment" class="form-select" >
                        <option value="">All</option>
                        <option value="1">Paid</option>
                        <option value="0">Not Paid</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <span style="font-size:12px;color: blue;">Filter By Category</span>
                    <select name="filter_cat_id" id="filter_cat_id" class="form-control" required="">
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
                
                <div class="col-sm-12" style="padding-top:10px;">
                    <div class="row mb-1">
                        <div class="col-sm-6">
                            
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
            <table id="skaterTables" class="table" style="width: 100%;">
                <thead>
                    <tr>
                        <th>S.No</th>
                        
                        <?php if(get_permission('skater', 'is_edit') || get_permission('skater', 'is_view')|| get_permission('skater', 'is_delete')){ ?>
                        <th>Actions</th>
                        <?php } ?>
                        
                        <th>Member Id</th>
                        <th>Full Name</th>
                        <th>Date of Birth</th>
                        <th>Category Type</th>
                        <th>Age</th>
                        <th>Age Category</th>
                        <th>Suit Size</th>
                        
                        <th>Club</th>
                        <th>District Name</th>
                        <th>Gender</th>
                        <th>Payment</th>
                        <th>Date & Time</th>
                        
                        <th>200 M</th>
                        <th>400 M</th>
                        <th>1000 M</th>
                        <th>Road Race100 M</th>
                        <th>Point to Point</th>
                        <th>Road Race 2000 M</th>
                        
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
                Are you sure you want to delete this Skater Registrations?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Suit Size Modal -->
<div class="modal fade" id="editSuitModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Suit Size</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <input type="hidden" id="edit_skater_id">
        <input type="hidden" id="edit_event_id">

        <div class="mb-2">
          <label class="form-label">Old Suit Size</label>
          <input type="text" class="form-control" id="old_suit_size" readonly>
        </div>

        <div class="mb-2">
          <label class="form-label">New Suit Size</label>
          <select class="form-select" id="new_suit_size">
            <option value="">Select Suit Size</option>
          </select>
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" id="updateSuitSize">Update</button>
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

function populateSuitSizes() {
    let html = '<option value="">Select Suit Size</option>';
    for (let i = 10; i <= 50; i++) {
        html += `<option value="${i}">${i}</option>`;
    }
    $('#new_suit_size').html(html);
}
populateSuitSizes();

const editSuitModal = new bootstrap.Modal(document.getElementById('editSuitModal'));

function openEditSuitModal(id, eventId, oldSuitSize) {
    $('#edit_skater_id').val(id);
    $('#edit_event_id').val(eventId);
    $('#old_suit_size').val(oldSuitSize);
    $('#new_suit_size').val('');
    editSuitModal.show();
}

$('#updateSuitSize').on('click', function () {
    const id = $('#edit_skater_id').val();
    const eventId = $('#edit_event_id').val();
    const newSuitSize = $('#new_suit_size').val();

    if (!newSuitSize) {
        alert('Please select a new suit size');
        return;
    }

    fetch('api/events-report/update-suit-size.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            id: id,
            event_id: eventId,
            suit_size: newSuitSize
        })
    })
    .then(res => res.json())
    .then(resp => {
        editSuitModal.hide();
        $('#skaterTables').DataTable().ajax.reload(null, false);
    })
    .catch(err => {
        console.error(err);
        alert('Failed to update suit size');
    });
});




    /*dropdown starts.......*/
        getDropDown('tbl_category_type','filter_cat_id','cat_name');
        getDropDown('tbl_states','filter_state_id','state_name');
        
        $('#filter_state_id').on('change',function(){
            var state_id = $('#filter_state_id').val();
            getDropDown('tbl_districts','filter_district_id','district_name',{'state_id':state_id});
        });
        
    
        $('#filter_state_id,#filter_district_id,#filter_cat_id,#filter_category,#filter_gender,#filter_payment,#filter_club_id').on('change',function(){
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
        const filter_category_id = $('#filter_cat_id').val();
        const filter_agecategory = $('#filter_category').val();
        const filter_gender = $('#filter_gender').val();
        const filter_payment = $('#filter_payment').val();
        const filter_club_id = $('#filter_club_id').val();
        const event_id = <?=$_GET['event_id'] ?? 0 ?>
        // console.log(verifyId);
        // Construct query parameters
        const params = new URLSearchParams();
        if (filter_category_id) params.append("filter_category_id", filter_category_id);
        if (filter_agecategory) params.append("filter_agecategory", filter_agecategory);
        if (filter_gender) params.append("filter_gender", filter_gender);
        if (filter_payment) params.append("filter_payment", filter_payment);
        if (filter_club_id) params.append("filter_club_id", filter_club_id);
        if (stateId) params.append("filter_state_id", stateId);
        if (districtId) params.append("filter_district_id", districtId);
        
        if (event_id) params.append("event_id", event_id);
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
                url: `api/events-report/events-report-state.php${queryString}`,
                type: 'GET'
            },
            columns: [
                { data: null, render: (data, type, row, meta) => meta.row + 1 }, // Auto-increment row index
                {
                    data: null,
                    render: (data) => `<?php  if(get_permission('skater', 'is_delete')){ ?>
                        <button class="btn btn-primary btn-xs" onclick="openEditSuitModal(${data.id}, ${data.event_id}, '${data.suit_size || ''}')"> <i class="ri-edit-2-fill"></i> Edit Suit Size </button>

                        <button class="btn btn-danger btn-xs" onclick="deleteSkaters(${data.id},${data.event_id})"><i class="ri-chat-delete-fill"></i> Delete</button>
                        <?php } ?>
                    `
                },
                { data: 'membership_id' },
                { data: 'full_name' },
                { data: 'date_of_birth' },
                { data: 'cat_name' },
                { data: 'age' },
                { data: 'age_category' },
                { data: 'suit_size' },
                { data: 'club_name'},
                { data: 'district_name'},
                { data: 'gender' },
                { data: 'payment_id' },
                {
                    data: 'created_at',
                    render: function(data, type, row) {
                        if (!data) return '';
                        const date = new Date(data);
                        const options = {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit',
                            hour12: true
                        };
                        return date.toLocaleString('en-GB', options).replace(',', '').replace(':', '.');
                    }
                },
                { data: '200 M' },
                { data: '400 M' },
                { data: '1000 M' },
                { data: 'Road Race 100 M' },
                { data: 'Point to Point' },
                { data: 'Road Race 2000 M' },
            ],
            order: [[1, 'asc']], // Default sorting by club_name
            
            lengthMenu: [[10, 25, 50, 100,'2000'], [10, 25, 50, 100,2000]], // Pagination options
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
    },
    {
        text: 'Print Report',
        className: 'btn btn-info',
        action: function (e, dt, node, config) {
            const category = $('#filter_cat_id option:selected').text().trim() || 'All';
            const categoryid = $('#filter_cat_id').val().trim() || '0';
            const gender = $('#filter_gender option:selected').text().trim() || 'All';
            const eventName = $('#event_name').text() || '';
            const venue = $('#venue').text() || '';

            // Fetch filtered data
            const data = dt.rows({ search: 'applied' }).data().toArray();

            // Prepare printable HTML
            let html = `
                <div style="text-align:center;">
                    <h2 style="margin:0;">${eventName}</h2>
                    <h4 style="margin:0;">${venue}</h4>
                    <h5>Event Register Report</h5>
                    <p><b>Category:</b> ${category} &nbsp;&nbsp; | &nbsp;&nbsp; <b>Gender:</b> ${gender}</p>
                </div>
                <table border="1" cellspacing="0" cellpadding="6" style="width:100%; border-collapse:collapse; font-size:12px; text-align:center;">
                    <thead>
                        <tr style="background:#f2f2f2;">
                            <th>S.No</th>
                            <th>Mem.ID</th>
                            <th>Name</th>
                            <th>Age-Grp</th>
                            <th>Club</th>`;
                            
                        if(gender=="All"){    
                             html += `<th>Gender</th>`;
                        }
                            html += `<th>District</th>
                            <th>200</th>
                            <th>Res</th>
                            <th>400</th>
                            <th>Res</th>`;
                            
                        if(categoryid==3){
                            html += `<th>1000 M</th>
                            <th>Res</th>`;
                        }    
                            
                            
                        if(categoryid==2 || categoryid==1){    
                            html += `<th>1000</th>
                            <th>Res</th>
                            <th>RR-100</th>
                            <th>Res</th>
                            <th>P-P</th>
                            <th>Res</th>
                            <th>RR-2000</th>
                            <th>Res</th>`;
                        }
                            
                        html += `</tr>
                    </thead>
                    <tbody>
            `;
            var ag='';var sno=1;
            data.forEach((row, index) => {
                
                if(ag!=row.age_category && index!=0){
                    sno=1;
                    html += `
                    <tr><td colspan="19"><br>*****************************************************************<br></td></tr>
                    <tr style="background:#f2f2f2;">
                            <td>S.No</td>
                            <td>Mem.ID</td>
                            <td>Name</td>
                            <td>Age-Grp</td>
                            <td>Club</td>`;
                           if(gender=="All"){    html += `<td>Gender</td>`;}
                            html += `<td>District</td>
                            <td>200</td>
                            <td>Res</td>
                            <td>400</td>
                            <td>Res</td>`;
                            
                        if(categoryid==3){
                            html += `<td>1000</td>
                            <td>Res</td>`;
                        }
                            
                            
                        if(categoryid==2 || categoryid==1){ 
                            html += `<td>1000</td>
                            <td>Res</td>
                            <td>RR-100</td>
                            <td>Res</td>
                            <td>P-P</td>
                            <td>Res</td>
                            <td>RR-2000</td>
                            <td>Res</td>`;
                        }    
                        html += `</tr>
                    `;
                }
                ag=row.age_category;
                
                html += `
                    <tr>
                        <td>${sno}</td>
                        <td>${(row.membership_id || '').trim().split('/').pop()}</td>
                        <td>${row.full_name || ''}</td>
                        <td>${row.age_category || ''}</td>
                        <td>${row.club_name || ''}</td>`;
                        if(gender=="All"){ 
                         html += `<td>${row.gender || ''}</td>`;
                        }
            
                        html += `<td>${row.district_name || ''}</td>
                        <td>${row['200 M'] || ''}</td>
                        <td></td>
                        <td>${row['400 M'] || ''}</td>
                        <td></td>`;
                        
                    if(categoryid==3){
                        html += `<td>${row['1000 M'] || ''}</td>
                        <td></td>`;
                    }
                        
                        
                        
                    if(categoryid==2 || categoryid==1){  
                        html += `<td>${row['1000 M'] || ''}</td>
                        <td></td>
                        <td>${row['Road Race 100 M'] || ''}</td>
                        <td></td>
                        <td>${row['Point to Point'] || ''}</td>
                        <td></td>
                        <td>${row['Road Race 2000 M'] || ''}</td>
                        <td></td>`;
                    }    
                        
                    html += `</tr>
                `;
                sno++;
            });

            html += `</tbody></table>`;

            // Open print window
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Event Register Report</title>
                        <style>
                            body { font-family: Arial, sans-serif; margin: 1px; }
                            table, th, td { border: 1px solid #000; border-collapse: collapse; }
                            th, td { padding: 3px; text-align: center; }
                            th { background-color: #f2f2f2; }
                        </style>
                    </head>
                    <body>${html}</body>
                </html>
            `);
            printWindow.document.close();
            printWindow.print();
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
        
        $('.back_btn').on('click', function() {
        window.location.href = 'district-events-list.php';
    });
        getDataTable();
    });
    
    function editSkater(id) {
        window.location.href='skater.php?id='+id;
    }
    
    function viewskater(id) {
        window.location.href='view-skater-info.php?id='+id;
      
    }
    
    

    let deleteId = null;
    let eventId = null;

    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));

    function deleteSkaters(id, event_ids) {
        deleteId = id;
        eventId = event_ids;
        deleteModal.show(); // Use Bootstrap 5 modal API
    }

    // Attach to the correct button, not the whole modal
    document.getElementById('confirmDelete').addEventListener('click', function () {
        if (deleteId && eventId) {
            fetch('api/d-events/delete-register.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: deleteId,
                    event_ids: eventId
                })
            })
            .then(response => response.json())
            .then(data => {
                deleteModal.hide();
                $('#skaterTables').DataTable().ajax.reload(); // Assuming you're using jQuery DataTables
            })
            .catch(error => {
                console.error('Delete failed:', error);
                deleteModal.hide();
                $('#skaterTables').DataTable().ajax.reload();
            });
        }
    });


    
    
    
    $('#toggleColumnPanel').on('click', function () {
        $('#columnToggles').toggle();
    });

document.addEventListener("DOMContentLoaded", function () {    
    // let selectedId = getQueryParam("event_id");
    let selectedId = 14;
    
    
    if (selectedId) {
        GetInfo(selectedId);
    }
    function getQueryParam(param) {
        let urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }
    function GetInfo(id) {
        if (!id) {
                    console.error("Invalid ID provided.");
                    return;
                }
                $.get(`api/d-events/read_single.php?id=${encodeURIComponent(id)}`, function (data) {
                    console.log(data);
            if (data) {
                $('#event_name').text(data.event_name);
                $('#venue').text(data.venue);
                getDropDown('tbl_clubs','filter_club_id','club_name',{'district_id':data.district_id});
                
            } else {
                console.error("No data received for the given ID.");
            }
        }).fail(function (xhr) {
            console.error("Error fetching event details:", xhr.responseText);
        });

    }
});    
    
</script>
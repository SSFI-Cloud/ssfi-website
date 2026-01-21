<?php include('header.php')?>
<div class="container-xxl flex-grow-1" style="padding: 0px 10px;">
    <div class="card mb-2">
        <div class="row p-2">
            <div class="col-md-8">
                <h6 class="card-header"><i class="ri-building-line"></i> Member ID: <b style="color:blue;"><span class="membership_id"></span></b>  <span class="btn btn-xs btn-warning rounded-pill verify-button">Verified Pending</span></h6>
            </div>
            <div class="col-md-4 text-end">
                <a href="skater-list.php"><button type="button" class="btn btn-xs rounded-pill btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#userModal">
                            <i class="ri-arrow-left-circle-fill"></i> &nbsp;&nbsp; Back to Skaters List
                          </button></a>
            </div>
        </div>
    </div>
    <div class="card mb-2">
        <div class="nav-align-top">
            <ul class="nav nav-tabs mb-4" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#account" role="tab"
                        ><i class="ri-group-line me-2"></i>Account</a
                        >
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#district" role="tab"
                        ><i class="ri-lock-2-line me-2"></i>District Level Entry</a
                        >
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#billing" role="tab"
                        ><i class="ri-bookmark-line me-2"></i>State Level Entry</a
                        >
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#achievements" role="tab"
                        ><i class="ri-notification-4-line me-2"></i>Achievements</a
                        >
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="account" role="tabpanel">
                    
                    
                    
                    
                    
                    <div class="row mb-1">
        <div class="col-sm-4">
            <h6 class="card-header" style="font-size:14px;color: brown;"><i class="ri-file-list-3-fill"></i><span id="title_text"></span> : Skater Personal Information</h6>
            <div class="row mb-1">
                    <div class="col-sm-6 mt-2">
                        <label for="full_name" style="font-size:12px;color: darkgrey;" class="">Name</label>
                        <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Enter your name" required/>
                    </div>
                    
                    <div class="col-sm-6 mt-2">
                        <label for="father_name" style="font-size:12px;color: darkgrey;" class="">Father Name</label>
                        <input type="text" name="father_name" id="father_name" class="form-control" placeholder="Enter father name" required/>
                    </div>
                    
                    <div class="col-sm-6 mt-2">
                        <label style="font-size:12px;color: darkgrey;" class="">Gender</label><br>
                        <input type="text" name="gender" id="gender" class="form-control" placeholder="Enter gender name" required/>
                        
                    </div>
                    
                    <div class="col-sm-6 mt-2">
                        <label for="school_name" style="font-size:12px;color: darkgrey;" class="">School Name</label>
                        <input type="text" name="school_name" id="school_name" class="form-control" placeholder="Enter your School Name" required/>
                    </div>
                    
                    <div class="col-sm-6 mt-2">
                        <label for="email_address" style="font-size:12px;color: darkgrey;" class="">E-mail</label>
                        <input type="email" name="email_address" id="email_address" class="form-control" placeholder="Enter your E-mail" required/>
                    </div>
                    <div class="col-sm-6 mt-2">
                    <label for="mobile_number" style="font-size:12px;color: darkgrey;" class="">Mobile Number</label>
                    <input type="number" name="mobile_number" id="mobile_number" class="form-control" placeholder="Enter your mobile number" required/>
                </div>
                <div class="col-sm-6 mt-2">
                    <label for="state_id" style="font-size:12px;color: darkgrey;" class="">State Id</label>
                    <select id="state_id" name="state_id" class="form-select" required disabled>
                        <option value="">Select State Id</option>
                        <!-- Add dynamic options here -->
                    </select>
                </div>
                
                <div class="col-sm-6 mt-2">
                    <label for="district_id" style="font-size:12px;color: darkgrey;" class="">District Id</label>
                    <select id="district_id" name="district_id" class="form-select" required disabled>
                        <option value="">Select District Id</option>
                        <!-- Add dynamic options here -->
                    </select>
                </div>
                
                <div class="col-sm-6 mt-2">
                    <label for="date_of_birth" style="font-size:12px;color: darkgrey;" class="">Date Of Birth <small>(AS PER AADHAAR)</small></label>
                    <input type="date" name="date_of_birth" id="date_of_birth" onchange="Bday()" class="form-control" placeholder="Enter your date of birth" required/>
                </div>
                
                <div class="col-sm-12 mt-2">
                    <label for="date_of_birth" style="font-size:12px;color: darkgrey;" >Age <small>(Age is calculated as on cut of date 01-01-2025) : <b id="days"></b></small></label>
                    <input type="text" name="age" id="age" class="form-control" placeholder="Age is calculated as on cut of date 01-01-2025" readonly/>
                </div>
                
                <div class="col-sm-12 mt-2">
                    <label for="date_of_birth" style="font-size:12px;color: darkgrey;">Age Category <small>(Auto calculated based on date of birth)</small></label>
                    <input type="text" name="agecat" id="agecat" class="form-control" placeholder="Auto calculated based on date of birth" readonly/>
                </div>
                
                <div class="col-sm-12 mt-2">
                    <label for="blood_group" style="font-size:12px;color: darkgrey;" class="">Blood Group</label> 
                    <select id="blood_group" name="blood_group" class="form-select" required disabled>
                        <option value="">Select Blood Group</option>
                        <option value="O Positive(+)">O Positive(+)</option>
                        <option value="O Negative(-)">O Negative(-)</option>
                        <option value="A Positive(+)">A Positive(+)</option>
                        <option value="A Negative(-)">A Negative(-)</option>
                        <option value="B Positive(+)">B Positive(+)</option>
                        <option value="B Negative(-)">B Negative(-)</option>
                        <option value="AB Positive(+)">AB Positive(+)</option>
                        <option value="AB Negative(-)">AB Negative(-)</option>
                        <option value="A1 Positive(+)">A1 Positive(+)</option>
                        <option value="A1 Negative(-)">A1 Negative(-)</option>
                        <option value="A2 Positive(+)">A2 Positive(+)</option>
                        <option value="A2 Negative(-)">A2 Negative(-)</option>
                        <option value="A1B Positive(+)">A1B Positive(+)</option>
                        <option value="A1B Negative(-)">A1B Negative(-)</option>
                        <option value="A2B Positive(+)">A2B Positive(+)</option>
                        <option value="A2B Negative(-)">A2B Negative(-)</option>
                        <option value="Rh Null">Rh Null</option>
                    </select>
                </div>
                
                
                
                

            </div>
        </div>
        <div class="col-sm-4">
            <h6 class="card-header" style="font-size:14px;color: brown;"><i class="ri-file-list-3-fill"></i><span id="title_text"></span> : Registration Details</h6>
            <div class="row mb-1">
                <div class="col-sm-6 mt-2">
                    <label for="category_type_id" style="font-size:12px;color: darkgrey;" class="">Category Id</label>
                    <select id="category_type_id" name="category_type_id" class="form-select" required disabled>
                        <option value="">Select Category</option>
                        <option value="">1</option>
                        <!-- Add dynamic options here -->
                    </select>
                </div>
                
                    <div class="col-sm-6 mt-2">
                        <label for="school_name" style="font-size:12px;color: darkgrey;" class="">Nominee Name</label>
                        <input type="text" name="nominee_name" id="nominee_name" class="form-control" placeholder="Type  Nominee Name here" required/>
                    </div>
                    <div class="col-sm-6 mt-2">
                        <label for="school_name" style="font-size:12px;color: darkgrey;" class="">Nominee Age</label>
                        <input type="number" name="nominee_age" id="nominee_age" class="form-control" placeholder="Type Nominee age here" required/>
                    </div>
                    <div class="col-sm-6 mt-2">
                        <label for="school_name" style="font-size:12px;color: darkgrey;" class="">Nominee relation with skater</label>
                        <input type="text" name="nominee_relation" id="nominee_relation" class="form-control" placeholder="Enter your School Name" required/>
                    </div>
                
                
                <div class="col-sm-12 mt-2">
                    <label for="club_id" style="font-size:12px;color: darkgrey;" class="">Select Club</label>
                    <select id="club_id" name="club_id" class="form-select" required disabled>
                        <option value="">Select Club</option>
                        <option value="">1</option>
                        <!-- Add dynamic options here -->
                    </select>
                </div>
                
                <div class="col-sm-6 mt-2">
                    <label for="coach_name" style="font-size:12px;color: darkgrey;" class="">Coach Name</label>
                    <input type="text" name="coach_name" id="coach_name" class="form-control" placeholder="Enter Your Coach Name" required/>
                </div>
                
                <div class="col-sm-6 mt-2">
                    <label for="coach_mobile_number" style="font-size:12px;color: darkgrey;" class="">Coach Mobile Number</label>
                    <input type="tel" name="coach_mobile_number" id="coach_mobile_number" class="form-control" placeholder="Enter your Coach Mobile Number" required/>
                </div>
                <div class="col-sm-12 mt-2">
                    <label for="district_id" style="font-size:12px;color: darkgrey;" class="">I am</label>
                    <select id="i_am" name="i_am" class="form-select" required disabled>
                        <option value="Studying in School - STATE Board">Studying in School - STATE Board</option>
                        <option value="Studying in School - CBSE">Studying in School - CBSE</option>
                        <option value="Studying in School - ICSE">Studying in School - ICSE</option>
                        <option value="Studying in School - ISE">Studying in School - ISE</option>
                        <option value="Studying in School/ College / University">Studying in School/ College / University</option>
                        <option value="Studying in School / College / University - Private / Open">Studying in School / College / University - Private / Open</option>
                        <option value="Working">Working</option>
                        <option value="Self-Employed / Business">Self-Employed / Business</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="col-sm-12 mt-2">
                    <label for="residential_address" style="font-size:12px;color: darkgrey;" class="">Residential Address</label>
                    <textarea id="residential_address" name="residential_address" rows="4" class="form-control" placeholder="Enter Your Address" required></textarea>
                </div>

            </div>
        </div>
        <div class="col-sm-4">
            <h6 class="card-header" style="font-size:14px;color: brown;"><i class="ri-file-list-3-fill"></i><span id="title_text"></span> : Proof & Skater Photo</h6>
            <div class="row mb-1">
                <div class="col-sm-8 mt-2">
                        <label for="aadhar_number" style="font-size:12px;color: darkgrey;" class="">Aadhar Number</label>
                        <input type="number" name="aadhar_number" id="aadhar_number" class="form-control" placeholder="Enter your Aadhar Number" required/>
                </div>
               
                
                <div class="col-sm-6 mt-2">
                    <img src="assets/img/favicon/SSFI_main.png" id="identityPreview" style="width:200px;"/>
                </div>
                <div class="col-sm-6 mt-2">
                    <img src="assets/img/favicon/SSFI_main.png" id="profilePreview" style="width:200px;"/>
                </div>
                
                <div class="col-sm-12 text-end">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>
                    <center> 
                        <button type="button" class="btn btn-xs btn-info rounded-pill verify-button" onclick="verifySkater()">
                        <i class="ri-file-add-fill"></i> Update Profile as Verified
                        </button>
                    </center>
                </div>
                <div class="tab-pane fade" id="district" role="tabpanel">
                    <div class="mb-2">
                        <div class="row">
                            <center>Coming Soon...</center>
                            <!--<div class="card col-md-4 p-2">
                                <h6 class="card-header"><i class="ri-building-line"></i> <b style="color:blue;">Title of Championship</b></h6>
                                District : Salem<br>
                                Registered Event level Details:<br>
                                <span class="btn btn-xs btn-warning rounded-pill waves-effect waves-light">200 MTR</span>
                                <span class="btn btn-xs btn-warning rounded-pill waves-effect waves-light">400 MTR</span>
                                <span class="btn btn-xs btn-warning rounded-pill waves-effect waves-light">Road Race</span>
                            </div>-->
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="billing" role="tabpanel">
                    <div class="mb-2">
                        <div class="row">
                            <center>Coming Soon...</center>
                            <!--<div class="card col-md-4 p-2">-->
                            <!--    <h6 class="card-header"><i class="ri-building-line"></i> <b style="color:blue;">Title of Championship</b></h6>-->
                            <!--    District : Salem<br>-->
                            <!--    Registered Event level Details:<br>-->
                            <!--    <span class="btn btn-xs btn-warning rounded-pill waves-effect waves-light">200 MTR</span>-->
                            <!--    <span class="btn btn-xs btn-warning rounded-pill waves-effect waves-light">400 MTR</span>-->
                            <!--    <span class="btn btn-xs btn-warning rounded-pill waves-effect waves-light">Road Race</span>-->
                            <!--</div>-->
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="achievements" role="tabpanel">
                    <div class="mb-2">
                        <div class="row">
                            <center>Coming Soon...</center>
                            <!--<div class="card col-md-4 p-2">
                                <h6 class="card-header"><i class="ri-building-line"></i> <b style="color:blue;">Title of Championship</b></h6>
                                District : Salem<br>
                                Registered Event level Details:<br>
                                <span class="btn btn-xs btn-warning rounded-pill waves-effect waves-light">200 MTR</span>
                                <span class="btn btn-xs btn-warning rounded-pill waves-effect waves-light">400 MTR</span>
                                <span class="btn btn-xs btn-warning rounded-pill waves-effect waves-light">Road Race</span>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .form-control,.form-select{
        border: none;
        font-weight: 500;
    }
</style>

<div class="modal fade" id="verifyModal" tabindex="-1" aria-labelledby="verifyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verifyModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to Approved this Skater?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="confirmVerify">Approve</button>
            </div>
        </div>
    </div>
</div>

<style>
    td,th{
    padding:5px 10px !important;
    }
    th{
    font-weight: bold;
    }
</style>
<?php include('footer.php')?>
<script>


document.addEventListener("DOMContentLoaded", function () {
    function getQueryParam(param) {
        let urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    let selectedId = getQueryParam("id");

    function editSkater(id) {
        if (!id) {
            console.error("Invalid ID provided.");
            return;
        }

        $.get(`api/skaters/read_single.php?id=${encodeURIComponent(id)}`, function (data) {
            if (data) {
                getDropDown('tbl_states','state_id','state_name',{},data.state_id);
                getDropDown('tbl_districts','district_id','district_name',{'state_id':data.state_id},data.district_id);
                getDropDown('tbl_clubs','club_id','club_name',{},data.club_id);
                getDropDown('tbl_category_type','category_type_id','cat_name',{},data.category_type_id);
             
                $('#full_name').val(data.full_name);
                $('#father_name').val(data.father_name);
                $('#mobile_number').val(data.mobile_number);
                $('#date_of_birth').val(data.date_of_birth);
                $('#blood_group').val(data.blood_group);
                $('#school_name').val(data.school_name);
                $('#gender').val(data.gender);
                
                $('#aadhar_number').val(data.aadhar_number);
                $('#email_address').val(data.email_address);
                $('#coach_name').val(data.coach_name);
                $('#coach_mobile_number').val(data.coach_mobile_number);
                $('#residential_address').val(data.residential_address);
                $('#i_am').val(data.i_am);
                
                $('#nominee_name').val(data.nominee_name);
                $('#nominee_age').val(data.nominee_age);
                $('#nominee_relation').val(data.nominee_relation);
                
                if (data.gender === 'Male') {
                    $('#status_active').prop('checked', true);
                } else if (data.gender === 'Female') {
                    $('#status_inactive').prop('checked', true);
                }
                
                if (data.identity_proof) {
                    $('#identityPreview').attr('src', `${data.identity_proof}`).show();
                }
                if (data.profile_photo) {
                    $('#profilePreview').attr('src', `${data.profile_photo}`).show();
                }
                Bday();
                
                if (data.verified == 1) {
                    $(".verify-button").removeClass("verify-button btn-warning").addClass("verify btn-success").text("Verified").prop("disabled", true) ;
                }
            } else {
                console.error("No data received for the given ID.");
            }
        }).fail(function (xhr) {
            console.error("Error fetching details:", xhr.responseText);
        });
    }

    if (selectedId) {
        editSkater(selectedId);
    }
});

var verifyModal = new bootstrap.Modal(document.getElementById('verifyModal'));

function verifySkater() {
    verifyId = getQueryParam("id"); // Fetch ID globally
    if (!verifyId) {
        alert("No valid ID found.");
        return;
    }
    $('#verifyModal').modal('show'); // Show the modal
}

$('#confirmVerify').click(function () {  // Use `#confirmVerify` instead of `#verifyModal`
    if (verifyId) {
        $.ajax({
            url: `api/skaters/update_verify.php`,
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ id: verifyId }),
            dataType: 'json',
            success: function (response) {
                verifyModal.hide();
                $(".verify-button").removeClass("verify-button btn-warning").addClass("verify btn-success").text("Verified").prop("disabled", true);
            },
            error: function () {
                verifyModal.hide();
                alert("Error updating verification.");
            }
        });
    }
});

function getQueryParam(param) {
    let urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}
function Bday() {

         
var dob = $('#date_of_birth').val();
console.log('Date of Birth:', dob);
// Optional: extract day, month, year if needed
if (dob) {
    var dateParts = dob.split('-'); // Format: YYYY-MM-DD
    var year = dateParts[0];
    var month = dateParts[1];
    var day = dateParts[2];
    console.log('Year:', year, 'Month:', month, 'Day:', day);
}
         
         
         
            if(day!="" && month!="" && year!="" ){
                var Q4A = "Your birthday is: ";
                var Bdate = ''+year+'-'+month+'-'+day;
                //$('#sd').val(Bdate);
                var limitdate = new Date("01/01/2025");
                var Bday = +new Date(Bdate);
                 Q= ~~ ((limitdate - Bday) / (31557600000));
                $('#age').val(Q);
                if(Q<2){
                    $('#agecat').val('Under 4');   
                }else if(Q<4){
                    $('#agecat').val('Under 4');
                }
                else if(Q<6){
                    $('#agecat').val('Under 6');
                }
                else if(Q<8){
                    $('#agecat').val('Under 8');
                }
                else if(Q<10){
                    $('#agecat').val('Under 10');
                }
                else if(Q<12){
                    $('#agecat').val('Under 12');
                }
                else if(Q<14){
                    $('#agecat').val('Under 14');
                }
                else if(Q<16){
                    $('#agecat').val('Under 16');
                }
                else{
                    $('#agecat').val('Above 16');
                }
            }
}
</script>
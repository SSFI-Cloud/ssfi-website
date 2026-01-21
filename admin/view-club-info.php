<?php include('header.php')?>
<div class="container-xxl flex-grow-1" style="padding: 0px 10px;">
    <div class="card mb-2">
        <div class="row p-2">
            <div class="col-md-8">
                <h6 class="card-header"><i class="ri-building-line"></i> Club Name: <b style="color:blue;"><span class="club_name"></span></b>  <span class="btn btn-xs btn-warning rounded-pill verify-button">Verified Pending</span></h6>
            </div>
            <div class="col-md-4 text-end">
                <a href="club-list.php"><button type="button" class="btn btn-xs rounded-pill btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#userModal">
                            <i class="ri-arrow-left-circle-fill"></i> &nbsp;&nbsp; Back to Club List
                          </button></a>
            </div>
        </div>
    </div>
    <div class="card mb-2">
        <div class="nav-align-top">
            <ul class="nav nav-tabs mb-3" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#account" role="tab"
                        ><i class="ri-group-line me-2"></i>Account</a
                        >
                </li>
         
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="account" role="tabpanel">
                    <div class="row p-2">
                        <div class="row mb-1">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-4">
                                <center><b style="color:blue;">Club Logo</b></center>
                                <div style="padding-left:10px;padding-top:10px">
                                    <center><img id="profilePreview" src="https://ssfibharatskate.com/ssfi/admin/assets/img/favicon/ssfa.png" style="width: 200px;height:200px"></center>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <center><b style="color:blue;">Club Info</b></center>
                                <table class="table">
<!--                                    // `id`, `verified`, `verified_by`, `club_name`, `registration_number`, `contact_person`, `mobile_number`, `email_address`, `district_id`, `state_id`,-->
<!--// `club_address`, `established_year`, `logo_path`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`-->
                                    <tbody>
                                        <tr>
                                            <th>Club Name:</th>
                                            <td class="club_name"></td>
                                        </tr>
                                        <tr>
                                            <th>Registration Number:</th>
                                            <td id="registration_number"></td>
                                        </tr>
                                        <tr>
                                            <th>Contact Person:</th>
                                            <td id="contact_person"></td>
                                        </tr>
                                        <tr>
                                            <th>Mobile Number:</th>
                                            <td id="mobile_number"></td>
                                        </tr>
                                        <tr>
                                            <th>Email Address:</th>
                                            <td id="email_address"></td>
                                        </tr>
                                        <tr>
                                            <th>District Name:</th>
                                            <td id="district_id"></td>
                                        </tr>
                                        <tr>
                                            <th>State:</th>
                                            <td id="state_id"></td>
                                        </tr>
                                        <tr>
                                            <th>Club Address:</th>
                                            <td id="club_address"></td>
                                        </tr>
                                        <tr>
                                            <th>Established Year:</th>
                                            <td id="established_year"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                            </div>
                            <div class="col-sm-2">
                            </div>
                        </div>
                    </div>
                    <center> 
                        <button type="button" class="btn btn-xs btn-info rounded-pill verify-button" id="verifyButton" onclick="verifySkater()">
                        <i class="ri-file-add-fill"></i> Update Profile as Verified
                        </button>
                         <button type="button" class="btn btn-xs btn-info rounded-pill resend" id="resend" onclick="resend()">
                        <i class="ri-file-add-fill"></i> Resend Login Details
                        </button>
                    </center>
                </div>
              
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="verifyModal" tabindex="-1" aria-labelledby="verifyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verifyModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to Approved this Club?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="confirmVerify">Approve</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="resendModal" tabindex="-1" aria-labelledby="resendModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resendModalLabel">Confirm Resend</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to Resend this Club Login Details?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="confirmVerifys">Approve</button>
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
        $.get(`api/club/read_single.php?id=${encodeURIComponent(id)}`, function (data) {
            if (data) {
                $('.club_name').html(data.club_name);
                $('#registration_number').html(data.registration_number);
                $('#contact_person').html(data.contact_person);
                $('#mobile_number').html(data.mobile_number);
                $('#email_address').html(data.email_address);
                $('#district_id').html(data.district_name);
                $('#state_id').html(data.state_name);
                $('#club_address').html(data.club_address);
                $('#established_year').html(data.established_year);
                if (data.club) {
                    $('#profilePreview').attr('src', `${data.club}`).show();
                }
                if (data.verified==1) {
                    $(".verify-button").removeClass("verify-button btn-warning").addClass("verify btn-success").text("Verified").prop("disabled", true);
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
            url: `api/club/update_verify.php`,
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

function resend() {
    verifyIds = getQueryParam("id"); // Fetch ID globally
    if (!verifyIds) {
        alert("No valid ID found.");
        return;
    }
    $('#resendModal').modal('show'); // Show the modal
}
$('#confirmVerifys').click(function () {  // Use `#confirmVerify` instead of `#verifyModal`
    if (verifyIds) {
        $.ajax({
            url: `api/club/resend_msg.php`,
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ id: verifyIds }),
            dataType: 'json',
            success: function (response) {
                 let modalEl = document.getElementById('resendModal');
                let modalInstance = bootstrap.Modal.getInstance(modalEl);
                if (modalInstance) {
                    modalInstance.hide();
                }
                // resendModal.hide();
                // $(".verify-button").removeClass("verify-button btn-warning").addClass("verify btn-success").text("Verified").prop("disabled", true);
            },
            error: function () {
                // resendModal.hide();
                 let modalEl = document.getElementById('resendModal');
                let modalInstance = bootstrap.Modal.getInstance(modalEl);
                if (modalInstance) {
                    modalInstance.hide();
                }
                alert("Error updating verification.");
            }
        });
    }
});


function getQueryParam(param) {
    let urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}
</script>
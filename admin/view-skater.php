<?php include('header.php')?>
<!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <!-- User Sidebar -->
                <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                  <!-- User Card -->
                  <div class="card mb-6">
                    <div class="card-body pt-12">
                      <!--<div class="user-avatar-section">-->
                      <!--  <div class="d-flex align-items-center flex-column">-->
                      <!--    <img-->
                      <!--      class="img-fluid rounded mb-4"-->
                      <!--      src="../../assets/img/avatars/1.png"-->
                      <!--      height="120"-->
                      <!--      width="120"-->
                      <!--      alt="User avatar" />-->
                      <!--    <div class="user-info text-center">-->
                      <!--      <h5>Violet Mendoza</h5>-->
                           
                      <!--    </div>-->
                      <!--  </div>-->
                      <!--</div>-->
                      
                      <h5 class="text-center pb-4 border-bottom mb-4">Details</h5>
                     <div class="info-container">
  <table class="table">

    <tbody>
      <tr>
        <th>Menbership Id:</th>
        <td id="membership_id"></td>
      </tr>
      <tr>
        <th>Full Name:</th>
        <td id="full_name"></td>
      </tr>
      <tr>
        <th>Father Name:</th>
        <td id="father_name"></td>
      </tr>
      <tr>
        <th>Mobile Number:</th>
        <td id="mobile_number"></td>
      </tr>
   
      <tr>
        <th>Date of Birth:</th>
        <td id="date_of_birth"></td>
      </tr>
      <tr>
        <th>Category Type:</th>
        <td id="category_type_id"></td>
      </tr>
      <!--<tr>-->
      <!--  <th>Gender:</th>-->
      <!--  <td id="membership_id"></td>-->
      <!--</tr>-->
       <tr>
        <th>Blood Group:</th>
        <td id="blood_group"></td>
      </tr>
       <tr>
        <th>School Name:</th>
        <td id="school_name"></td>
      </tr> 
      <tr>
        <th>Aadhar Number:</th>
        <td id="aadhar_number"></td>
      </tr> 
      <tr>
        <th>Email Address:</th>
        <td id="email_address"></td>
      </tr> 
      <tr>
        <th>Club:</th>
        <td id="club_id"></td>
         </tr>
         <tr>
        <th>Coach Name:</th>
        <td id="coach_name"></td>
         </tr>
         <tr>
        <th>Coach Mobile Number:</th>
        <td id="coach_mobile_number"></td>
         </tr>
         <tr>
        <th>State:</th>
        <td id="state_id"></td>
      </tr>
       <tr>
        <th>District:</th>
        <td id="district_id"></td>
      </tr>
    </tbody>
  </table>
</div>

                    </div>
                  </div>
                  <!-- /User Card -->
                  <!-- Plan Card -->
                  
                  <!-- /Plan Card -->
                </div>
                <!--/ User Sidebar -->

                <!-- User Content -->
                <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                  <!-- User Tabs -->
            <div class="nav-align-top">
  <ul class="nav nav-tabs mb-3" role="tablist">
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
      <div class="card">
        <div class="table-responsive text-nowrap">
            <table id="skaterTables" class="table" style="width: 100%;"> 
                <thead>
                    <tr>
                        <th>S.No</th>
                         <th>Menbership Id</th>
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
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    </div>
    <div class="tab-pane fade" id="district" role="tabpanel">
      <p>    <div class="card mb-6">
                    <h5 class="card-header">Recent Devices</h5>
                    <div class="table-responsive table-border-bottom-0">
                      <table class="table">
                        <thead>
                          <tr>
                            <th class="text-truncate">Browser</th>
                            <th class="text-truncate">Device</th>
                            <th class="text-truncate">Location</th>
                            <th class="text-truncate">Recent Activities</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="text-truncate">
                              <img
                                src="../../assets/img/icons/brands/chrome.png"
                                alt="Chrome"
                                class="me-4"
                                width="22"
                                height="22" /><span class="text-heading">Chrome on Windows</span>
                            </td>
                            <td class="text-truncate">HP Spectre 360</td>
                            <td class="text-truncate">Switzerland</td>
                            <td class="text-truncate">10, July 2021 20:07</td>
                          </tr>
                          <tr>
                            <td class="text-truncate">
                              <img
                                src="../../assets/img/icons/brands/chrome.png"
                                alt="Chrome"
                                class="me-4"
                                width="22"
                                height="22" /><span class="text-heading">Chrome on iPhone</span>
                            </td>
                            <td class="text-truncate">iPhone 12x</td>
                            <td class="text-truncate">Australia</td>
                            <td class="text-truncate">13, July 2021 10:10</td>
                          </tr>
                          <tr>
                            <td class="text-truncate">
                              <img
                                src="../../assets/img/icons/brands/chrome.png"
                                alt="Chrome"
                                class="me-4"
                                width="22"
                                height="22" /><span class="text-heading">Chrome on Android</span>
                            </td>
                            <td class="text-truncate">Oneplus 9 Pro</td>
                            <td class="text-truncate">Dubai</td>
                            <td class="text-truncate">14, July 2021 15:15</td>
                          </tr>
                          <tr>
                            <td class="text-truncate">
                              <img
                                src="../../assets/img/icons/brands/chrome.png"
                                alt="Chrome"
                                class="me-4"
                                width="22"
                                height="22" /><span class="text-heading">Chrome on MacOS</span>
                            </td>
                            <td class="text-truncate">Apple iMac</td>
                            <td class="text-truncate">India</td>
                            <td class="text-truncate">16, July 2021 16:17</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div></p>
    </div>
    <div class="tab-pane fade" id="billing" role="tabpanel">
      <p>    <div class="card mb-6">
                    <h5 class="card-header">Recent Devices</h5>
                    <div class="table-responsive table-border-bottom-0">
                      <table class="table">
                        <thead>
                          <tr>
                            <th class="text-truncate">Browser</th>
                            <th class="text-truncate">Device</th>
                            <th class="text-truncate">Location</th>
                            <th class="text-truncate">Recent Activities</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="text-truncate">
                              <img
                                src="../../assets/img/icons/brands/chrome.png"
                                alt="Chrome"
                                class="me-4"
                                width="22"
                                height="22" /><span class="text-heading">Chrome on Windows</span>
                            </td>
                            <td class="text-truncate">HP Spectre 360</td>
                            <td class="text-truncate">Switzerland</td>
                            <td class="text-truncate">10, July 2021 20:07</td>
                          </tr>
                          <tr>
                            <td class="text-truncate">
                              <img
                                src="../../assets/img/icons/brands/chrome.png"
                                alt="Chrome"
                                class="me-4"
                                width="22"
                                height="22" /><span class="text-heading">Chrome on iPhone</span>
                            </td>
                            <td class="text-truncate">iPhone 12x</td>
                            <td class="text-truncate">Australia</td>
                            <td class="text-truncate">13, July 2021 10:10</td>
                          </tr>
                          <tr>
                            <td class="text-truncate">
                              <img
                                src="../../assets/img/icons/brands/chrome.png"
                                alt="Chrome"
                                class="me-4"
                                width="22"
                                height="22" /><span class="text-heading">Chrome on Android</span>
                            </td>
                            <td class="text-truncate">Oneplus 9 Pro</td>
                            <td class="text-truncate">Dubai</td>
                            <td class="text-truncate">14, July 2021 15:15</td>
                          </tr>
                          <tr>
                            <td class="text-truncate">
                              <img
                                src="../../assets/img/icons/brands/chrome.png"
                                alt="Chrome"
                                class="me-4"
                                width="22"
                                height="22" /><span class="text-heading">Chrome on MacOS</span>
                            </td>
                            <td class="text-truncate">Apple iMac</td>
                            <td class="text-truncate">India</td>
                            <td class="text-truncate">16, July 2021 16:17</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div></p>
    </div>
    <div class="tab-pane fade" id="achievements" role="tabpanel">
        <div class="card mb-6">
                    <h5 class="card-header">Recent Devices</h5>
                    <div class="table-responsive table-border-bottom-0">
                      <table class="table">
                        <thead>
                          <tr>
                            <th class="text-truncate">Browser</th>
                            <th class="text-truncate">Device</th>
                            <th class="text-truncate">Location</th>
                            <th class="text-truncate">Recent Activities</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="text-truncate">
                              <img
                                src="../../assets/img/icons/brands/chrome.png"
                                alt="Chrome"
                                class="me-4"
                                width="22"
                                height="22" /><span class="text-heading">Chrome on Windows</span>
                            </td>
                            <td class="text-truncate">HP Spectre 360</td>
                            <td class="text-truncate">Switzerland</td>
                            <td class="text-truncate">10, July 2021 20:07</td>
                          </tr>
                          <tr>
                            <td class="text-truncate">
                              <img
                                src="../../assets/img/icons/brands/chrome.png"
                                alt="Chrome"
                                class="me-4"
                                width="22"
                                height="22" /><span class="text-heading">Chrome on iPhone</span>
                            </td>
                            <td class="text-truncate">iPhone 12x</td>
                            <td class="text-truncate">Australia</td>
                            <td class="text-truncate">13, July 2021 10:10</td>
                          </tr>
                          <tr>
                            <td class="text-truncate">
                              <img
                                src="../../assets/img/icons/brands/chrome.png"
                                alt="Chrome"
                                class="me-4"
                                width="22"
                                height="22" /><span class="text-heading">Chrome on Android</span>
                            </td>
                            <td class="text-truncate">Oneplus 9 Pro</td>
                            <td class="text-truncate">Dubai</td>
                            <td class="text-truncate">14, July 2021 15:15</td>
                          </tr>
                          <tr>
                            <td class="text-truncate">
                              <img
                                src="../../assets/img/icons/brands/chrome.png"
                                alt="Chrome"
                                class="me-4"
                                width="22"
                                height="22" /><span class="text-heading">Chrome on MacOS</span>
                            </td>
                            <td class="text-truncate">Apple iMac</td>
                            <td class="text-truncate">India</td>
                            <td class="text-truncate">16, July 2021 16:17</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
    </div>
  </div>
</div>

            </div>
            <!-- / Content -->
            </div>
            </div>
            </div>

  <!--footer-->
  
<?php include('footer.php')?>


<script>
document.addEventListener("DOMContentLoaded", function () {
    function getQueryParam(param) {
        let urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    let selectedId = getQueryParam("id");
    if (selectedId) {
        $('#title_text').text("Update");
        $("#identity_proof_label").removeClass("required-label");
        $("#profile_photo_label").removeClass("required-label");
        editSkater(selectedId);
    }
    else{
        $('#title_text').text("Create");
    }






function editSkater(id) {
        if (!id) {
            console.error("Invalid ID provided.");
            return;
        }
        
        
        $.get(`api/skaters/read_single.php?id=${encodeURIComponent(id)}`, function (data) {
         if (data) {
            //  getDropDown('tbl_states','state_id','state_name',{},data.state_id);
                $('#state_id').html(data.state_name);
                $('#district_id').html(data.district_name);
                $('#club_id').html(data.club_name);
                $('#category_type_id').html(data.category_type_id);
                $('#membership_id').html(data.membership_id);
                $('#full_name').html(data.full_name);
                $('#father_name').html(data.father_name);
                $('#mobile_number').html(data.mobile_number);
                $('#date_of_birth').html(data.date_of_birth);
                $('#blood_group').html(data.blood_group);
                $('#school_name').html(data.school_name);
                $('#aadhar_number').html(data.aadhar_number);
                $('#email_address').html(data.email_address);
                $('#coach_name').html(data.coach_name);
                $('#coach_mobile_number').html(data.coach_mobile_number);
                $('#residential_address').html(data.residential_address);
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
                
                
                
            } else {
                console.error("No data received for the given ID.");
            }
        }).fail(function (xhr) {
            console.error("Error fetching client details:", xhr.responseText);
        });
    }
});





</script>

<?php include('header.php')?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f4f6f5;
      font-family: 'Poppins', sans-serif;
    }
    .registration-card {
      background-color: Green;
      color: white;
      border-radius: 20px;
      padding: 88px 20px;
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      cursor: pointer;
      height: 220px;
      width: 330px !important;
    }
    .registration-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    .registration-card i {
      font-size: 40px;
      margin-bottom: 20px;
      color: Green;
    }
    .registration-title {
      font-weight: 600;
      font-size: 22px;
    }
    .registration-section {
      /*max-width: 800px;*/
      margin: auto;
    }
  </style>

<div class="container py-5">
  <div class="card text-center mb-4 p-5" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px; border-radius:20px" >
    <h2 class="fw-bold text-uppercase" style="color: Orange;">Choose Your Event Type</h2>
  

  <div class="row registration-section g-4 justify-content-center">
    <!-- District Event Registration -->
    <div class="col-md- col-lg-4 col-sm-12">
      <div class="registration-card" onclick="window.location.href='event_type.php'">
        <!--<i class="fas fa-laptop-code"></i>-->
        <div class="registration-title">District Event Registration</div>
      </div>
    </div>

    <!-- State Event Registration -->
    <div class="col-md-4 col-lg-4 col-sm-12">
      <div class="registration-card" onclick="window.location.href='state_event_type.php'">
        <!--<i class="fas fa-sync-alt"></i>-->
        <div class="registration-title">State Event Registration</div>
      </div>
    </div>
    
      <!-- Renew Registration -->
    <div class="col-md-4 col-lg-4 col-sm-12">
      <div class="registration-card" onclick="window.location.href='national_event_type.php'">
        <!--<i class="fas fa-sync-alt"></i>-->
        <div class="registration-title">National Event Registration</div>
      </div>
    </div>
    
  </div>
</div>
</div>
</body>
</html>



<?php include('../footer.php')?>
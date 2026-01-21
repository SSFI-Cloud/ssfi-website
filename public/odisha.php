<?php include('header.php')?>
<!--<section>-->
<!--    <div style="margin-top:10%">-->
<!--        <div class="container">-->
<!--                    <div class="row g-4 gy-5">-->
<!--                        <div class="col-lg-4 col-md-6 mb10">-->
<!--                            <div class="rounded-20px">-->
<!--                                <div class="post-image rounded-10px">-->
                                   
<!--                                    <img alt="" src="images/news/ssfi 1 (1).jpg" class="lazy">-->
<!--                                </div>-->
<!--                                <div class="pt-2 h-100">-->
<!--                                    <h4 class="text-center"><a class="text-dark" href="#">O.S. Sekar</a></h4>-->
<!--                                    <h5 class="mb-3 text-center">President</h5>-->
<!--                                     <a href="tel:" style="font-size:20px; margin-left:30%;"><i class="icofont-phone"></i>98410 27667</a>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                        
<!--                        <div class="col-lg-4 col-md-6 mb10">-->
<!--                            <div class="rounded-20px">-->
<!--                                <div class="post-image rounded-10px">-->
                                    
<!--                                    <img alt="" src="images/news/ssfi 2 (1).jpg" class="lazy">-->
<!--                                </div>-->
<!--                                <div class="pt-2 h-100">-->
<!--                                    <h4 class="text-center"><a class="text-dark" href="#">Dr. R. Pratap Kumar</a></h4>-->
<!--                                    <h5 class="mb-3 text-center">Gen. Secretary</h5>-->
<!--                                    <a href="tel:" style="font-size:20px; margin-left:30%;"><i class="icofont-phone"></i>98410 27667</a>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div> -->
<!--                        <div class="col-lg-4 col-md-6 mb10">-->
<!--                            <div class="rounded-20px">-->
<!--                                <div class="post-image rounded-10px">-->
                            
<!--                                    <img alt="" src="images/news/ssfi 3 (1).jpg" class="lazy">-->
<!--                                </div>-->
<!--                                <div class="pt-2 h-100">-->
<!--                                    <h4 class="text-center"><a class="text-dark" href="#">Sathianarayanan</a></h4>-->
<!--                                    <h5 class="mb-3 text-center">Treasurer</h5>-->
<!--                                    <a href="tel:" style="font-size:20px; margin-left:30%;"><i class="icofont-phone"></i>98410 27667</a>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                       
<!--                    </div>-->
<!--                </div>-->
<!--    </div>-->
                
<!--            </section>-->






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabbed Content with Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        /* Tab Navigation */
        .tab-container {
            display: flex;
            justify-content: center;
            /*background: #f1f1f1;*/
            padding: 10px;
        }

        .tab {
            padding: 12px 20px;
            cursor: pointer;
            background: #ddd;
            border: none;
            margin: 0 5px;
            font-size: 16px;
            border-radius: 29px;
        }

        .tab:hover {
            background: #bbb;
        }

        .tab.active {
            background: #333;
            color: white;
            border-radius: 26px;
        }

        /* Tab Content */
        .tab-content {
            display: none;
            padding: 20px;
        }

        .tab-content.active {
            display: block;
        }

        /* Table Styling */
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #333;
            color: white;
        }

        /* Contact Section */
        .contact-box {
            background: orange;
            padding: 20px;
            color: white;
            margin-top: 20px;
        }

        .contact-box div {
            margin: 10px 0;
        }

        .icon {
            font-weight: bold;
        }

    </style>
</head>
<body>

<br>

<div class="container">
   <img src="images/MISSION CLUB LOGOS-7 (1).png" width="50%" height="50%" style="border-radius:50%" alt="">
    <h4>ODISHA SPEED SKATING ASSOCIATION</h4>
    
</div>

    <!-- Tab Buttons -->
    <div class="tab-container" style="margin-top:10%;">
        <button class="tab active" onclick="openTab(event, 'About')">About</button>
        <button class="tab" onclick="openTab(event, 'District Units')">District Units</button>
        <!--<button class="tab active" onclick="openTab(event, 'National')">National Players 2021-22</button>-->
        <button class="tab" onclick="openTab(event, 'Registered')">Registered Skaters 2025</button>
        <button class="tab active" onclick="openTab(event, 'District')">District & State Championships 2025</button>
        <button class="tab active" onclick="openTab(event, 'Acheivements')">Gallery</button>
    </div>

    <!-- Office Bearers Content -->
    
    <!--about-->
    <div id="About" class="tab-content active">
    
    <div style="margin-top:0%">
        <div class="container">
                    <div class="row g-4 gy-5">
                        <div class="col-lg-4 col-md-6 mb10">
                            <div class="rounded-20px">
                                <div class="post-image rounded-10px">
                                   
                                    <img alt="" src="images/news/profile.jpg" class="lazy">
                                </div>
                                <div class="pt-2 h-100">
                                    <h4 class="text-center"><a class="text-dark" href="#">Name</a></h4>
                                    <h5 class="mb-3 text-center">Designation</h5>
                                     <a href="tel:" style="font-size:20px; margin-left:30%;"><i class="icofont-phone"></i>Mobile Number</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-6 mb10">
                            <div class="rounded-20px">
                                <div class="post-image rounded-10px">
                                    
                                    <img alt="" src="images/news/profile.jpg" class="lazy">
                                </div>
                                <div class="pt-2 h-100">
                                    <h4 class="text-center"><a class="text-dark" href="#">Name</a></h4>
                                    <h5 class="mb-3 text-center">Designation</h5>
                                     <a href="tel:" style="font-size:20px; margin-left:30%;"><i class="icofont-phone"></i>Mobile Number</a>
                                </div>
                            </div>
                        </div> 
                        <div class="col-lg-4 col-md-6 mb10">
                            <div class="rounded-20px">
                                <div class="post-image rounded-10px">
                            
                                    <img alt="" src="images/news/profile.jpg" class="lazy">
                                </div>
                                <div class="pt-2 h-100">
                                    <h4 class="text-center"><a class="text-dark" href="#">Name</a></h4>
                                    <h5 class="mb-3 text-center">Designation</h5>
                                     <a href="tel:" style="font-size:20px; margin-left:30%;"><i class="icofont-phone"></i>Mobile Number</a>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
    </div>
      
    </div>
    
    <!--district unit-->
      <div id="District Units" class="tab-content">
         <h5>visible district alone </h5>
         </div>
    
    
    
     <!-- Executive Committee Details Content -->
    <div id="District" class="tab-content">
  <h5>District Unit Details</h5>
    </div>
     <!-- Affiliated Units Details Content -->
    <!--<div id="National" class="tab-content active">-->
    <!--      <div class="container mt-5">-->
    <!--    <h2 class="text-center mb-4">Office Bearers</h2>-->
    <!--    <div class="table-responsive">-->
    <!--        <table class="table table-bordered table-striped text-center">-->
    <!--            <thead class="table-dark">-->
    <!--                <tr>-->
    <!--                    <th>SL.NO.</th>-->
    <!--                    <th>ID. NO.</th>-->
    <!--                    <th>NAME</th>-->
    <!--                    <th>AGE GROUP</th>-->
    <!--                    <th>GENDER</th>-->
    <!--                    <th>STATE / U.T.</th>-->
    <!--                    <th>DISCIPLINE</th>-->
    <!--                    <th>CERTIFICATE</th>-->
    <!--                    <th>CERT.NO.</th>-->
    <!--                </tr>-->
    <!--            </thead>-->
    <!--            <tbody>-->
    <!--                <tr>-->
    <!--                    <td>1</td>-->
    <!--                    <td>5366</td>-->
    <!--                    <td>SUMIT TOPPO</td>-->
    <!--                    <td>9 to 11 – Cadet</td>-->
    <!--                    <td>Boys</td>-->
    <!--                    <td>Andaman Nicobar</td>-->
    <!--                    <td>Speed-Quad</td>-->
    <!--                    <td>Participation</td>-->
    <!--                    <td>0001</td>-->
    <!--                </tr>-->
    <!--                <tr>-->
    <!--                    <td>2</td>-->
    <!--                    <td>5367</td>-->
    <!--                    <td>AARYAN ANAND</td>-->
    <!--                    <td>9 to 11 – Cadet</td>-->
    <!--                    <td>Boys</td>-->
    <!--                    <td>Andaman Nicobar</td>-->
    <!--                    <td>Speed-Quad</td>-->
    <!--                    <td>Participation</td>-->
    <!--                    <td>0002</td>-->
    <!--                </tr>-->
    <!--                <tr>-->
    <!--                    <td>3</td>-->
    <!--                    <td>5368</td>-->
    <!--                    <td>KHUSHI KUMARI MUNDA</td>-->
    <!--                    <td>9 to 11 – Cadet</td>-->
    <!--                    <td>Girls</td>-->
    <!--                    <td>Andaman Nicobar</td>-->
    <!--                    <td>Speed-Quad</td>-->
    <!--                    <td>Participation</td>-->
    <!--                    <td>0003</td>-->
    <!--                </tr>-->
    <!--                <tr>-->
    <!--                    <td>4</td>-->
    <!--                    <td>5369</td>-->
    <!--                    <td>A R JEEVA</td>-->
    <!--                    <td>11 to 14 – Sub Junior</td>-->
    <!--                    <td>Boys</td>-->
    <!--                    <td>Andaman Nicobar</td>-->
    <!--                    <td>Speed-Quad</td>-->
    <!--                    <td>Participation</td>-->
    <!--                    <td>0713</td>-->
    <!--                </tr>-->
    <!--                <tr>-->
    <!--                    <td>5</td>-->
    <!--                    <td>5370</td>-->
    <!--                    <td>J DARSHAN</td>-->
    <!--                    <td>11 to 14 – Sub Junior</td>-->
    <!--                    <td>Boys</td>-->
    <!--                    <td>Andaman Nicobar</td>-->
    <!--                    <td>Speed-Quad</td>-->
    <!--                    <td>Participation</td>-->
    <!--                    <td>0714</td>-->
    <!--                </tr>-->
    <!--                <tr>-->
    <!--                    <td>6</td>-->
    <!--                    <td>5371</td>-->
    <!--                    <td>R R SAI PRAJESH</td>-->
    <!--                    <td>11 to 14 – Sub Junior</td>-->
    <!--                    <td>Boys</td>-->
    <!--                    <td>Andaman Nicobar</td>-->
    <!--                    <td>Speed-Quad</td>-->
    <!--                    <td>Participation</td>-->
    <!--                    <td>0715</td>-->
    <!--                </tr>-->
    <!--                <tr>-->
    <!--                    <td>7</td>-->
    <!--                    <td>5378</td>-->
    <!--                    <td>G PRIYA</td>-->
    <!--                    <td>Above 17 – Senior</td>-->
    <!--                    <td>Women</td>-->
    <!--                    <td>Andaman Nicobar</td>-->
    <!--                    <td>Speed-Quad</td>-->
    <!--                    <td>Participation</td>-->
    <!--                    <td>0716</td>-->
    <!--                </tr>-->
    <!--            </tbody>-->
    <!--        </table>-->
    <!--    </div>-->
    <!--</div>-->
    <!--</div>-->

    <!-- Infrastructure Details Content -->
    <div id="Registered" class="tab-content">
      <div class="container mt-5">
        <h2 class="text-center mb-4">Registered skater count</h2>
        <!--<p class="fw-bold">Last updated on : 07/01/2022 08:05:31 pm</p>-->
        <!--<div class="table-responsive">-->
        <!--    <table class="table table-bordered text-center">-->
        <!--        <thead class="table-dark">-->
        <!--            <tr>-->
        <!--                <th>Sl.No.</th>-->
        <!--                <th>Skater Name</th>-->
        <!--                <th>Age Group</th>-->
        <!--                <th>Gender</th>-->
        <!--                <th>Discipline</th>-->
        <!--            </tr>-->
        <!--        </thead>-->
        <!--        <tbody>-->
        <!--            <tr class="fw-bold">-->
        <!--                <td colspan="5">District : Sangli</td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--                <td>1</td>-->
        <!--                <td>Mahammad Juned Mahibub Mulani</td>-->
        <!--                <td>11 to 14 - Sub Junior</td>-->
        <!--                <td>Male</td>-->
        <!--                <td>Speed-Inline</td>-->
        <!--            </tr>-->
        <!--            <tr class="fw-bold">-->
        <!--                <td colspan="5">District : South Andaman</td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--                <td>1</td>-->
        <!--                <td>A S NAVNEET</td>-->
        <!--                <td>11 to 14 - Sub Junior</td>-->
        <!--                <td>Male</td>-->
        <!--                <td>Speed-Quad</td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--                <td>2</td>-->
        <!--                <td>A R JEEVA</td>-->
        <!--                <td>11 to 14 - Sub Junior</td>-->
        <!--                <td>Male</td>-->
        <!--                <td>Speed-Quad</td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--                <td>3</td>-->
        <!--                <td>SUMIT TOPPO</td>-->
        <!--                <td>9 to 11 - Cadet</td>-->
        <!--                <td>Male</td>-->
        <!--                <td>Speed-Quad</td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--                <td>4</td>-->
        <!--                <td>V YASHWANT</td>-->
        <!--                <td>11 to 14 - Sub Junior</td>-->
        <!--                <td>Male</td>-->
        <!--                <td>Speed-Quad</td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--                <td>5</td>-->
        <!--                <td>VISHNI B NAIR</td>-->
        <!--                <td>11 to 14 - Sub Junior</td>-->
        <!--                <td>Male</td>-->
        <!--                <td>Speed-Quad</td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--                <td>6</td>-->
        <!--                <td>HARSHITHA V</td>-->
        <!--                <td>11 to 14 - Sub Junior</td>-->
        <!--                <td>Female</td>-->
        <!--                <td>Speed-Quad</td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--                <td>7</td>-->
        <!--                <td>B ARAVIND</td>-->
        <!--                <td>11 to 14 - Sub Junior</td>-->
        <!--                <td>Male</td>-->
        <!--                <td>Speed-Quad</td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--                <td>8</td>-->
        <!--                <td>E VIVEK</td>-->
        <!--                <td>14 to 17 - Junior</td>-->
        <!--                <td>Male</td>-->
        <!--                <td>Speed-Quad</td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--                <td>9</td>-->
        <!--                <td>ANNVESHA ANISH</td>-->
        <!--                <td>9 to 11 - Cadet</td>-->
        <!--                <td>Female</td>-->
        <!--                <td>Speed-Quad</td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--                <td>10</td>-->
        <!--                <td>CH SAI DHAKSH YADAV</td>-->
        <!--                <td>14 to 17 - Junior</td>-->
        <!--                <td>Male</td>-->
        <!--                <td>Speed-Quad</td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--                <td>11</td>-->
        <!--                <td>NITEEN SAMANTA</td>-->
        <!--                <td>9 to 11 - Cadet</td>-->
        <!--                <td>Male</td>-->
        <!--                <td>Speed-Quad</td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--                <td>12</td>-->
        <!--                <td>AARYAN ANAND</td>-->
        <!--                <td>9 to 11 - Cadet</td>-->
        <!--                <td>Male</td>-->
        <!--                <td>Speed-Quad</td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--                <td>13</td>-->
        <!--                <td>A R MRINALIKA</td>-->
        <!--                <td>11 to 14 - Sub Junior</td>-->
        <!--                <td>Female</td>-->
        <!--                <td>Speed-Quad</td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--                <td>14</td>-->
        <!--                <td>SOMI REDDY LAKSHMI DEVI</td>-->
        <!--                <td>Above 17 - Senior</td>-->
        <!--                <td>Female</td>-->
        <!--                <td>Speed-Quad</td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--                <td>15</td>-->
        <!--                <td>ANUSHRI ANAND</td>-->
        <!--                <td>7 to 9 - Cadet</td>-->
        <!--                <td>Female</td>-->
        <!--                <td>Speed-Quad</td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--                <td>16</td>-->
        <!--                <td>ARCHANA</td>-->
        <!--                <td>7 to 9 - Cadet</td>-->
        <!--                <td>Female</td>-->
        <!--                <td>Speed-Quad</td>-->
        <!--            </tr>-->
        <!--        </tbody>-->
        <!--    </table>-->
        <!--</div>-->
    </div>
    </div>
     <!-- Acheivements Details Content -->
        <div id="Acheivements" class="tab-content">
            <div class="container">
                  <div class="row">
         <div class="col-lg-2 col-md-3 col-sm-6">
             <img src="images/logo_new (1).jpg" alt="">
         </div>
         <div class="col-lg-2 col-md-3 col-sm-6">
             <img src="images/logo_new (1).jpg" alt="">
         </div>
      
     </div>
            </div>
   
    </div>

    <!-- JavaScript for Tab Switching -->
    <script>
        function openTab(event, tabName) {
            let i, tabContent, tabButtons;

            // Hide all tab contents
            tabContent = document.querySelectorAll(".tab-content");
            tabContent.forEach(content => content.style.display = "none");

            // Remove 'active' class from all tabs
            tabButtons = document.querySelectorAll(".tab");
            tabButtons.forEach(tab => tab.classList.remove("active"));

            // Show the selected tab content
            document.getElementById(tabName).style.display = "block";
            event.currentTarget.classList.add("active");
        }
    </script>

</body>
</html>

            <?php include ('footer.php')?>
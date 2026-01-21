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


    <!-- Tab Buttons -->
    <div class="tab-container" style="margin-top:10%;">
        <button class="tab active" onclick="openTab(event, 'Speed')">Speed Skating</button>
        <button class="tab" onclick="openTab(event, 'Artistic')">Artistic Skating</button>
        <button class="tab active" onclick="openTab(event, 'roller')">roller & Inline Hockey</button>
        <button class="tab" onclick="openTab(event, 'Games')">Other Games</button>
        <button class="tab active" onclick="openTab(event, 'Referees')">Referees under Training</button>
    </div>

    <!-- Office Bearers Content -->
    
    <!--about-->
    <div id="Speed" class="tab-content active">
    
    <div style="margin-top:0%">
        <div class="container">
                    <div class="row g-4 gy-5">
                        <div class="col-lg-3 col-md-6 mb10">
                            <div class="rounded-20px">
                                <div class="post-image rounded-10px">
                                   
                                    <img alt="" src="images/news/ssfi 1 (1).jpg" class="lazy">
                                </div>
                                <div class="pt-2 h-100">
                                    <h4 class="text-center"><a class="text-dark" href="#">O.S. Sekar</a></h4>
                                    <h5 class="mb-3 text-center">President</h5>
                                     <a href="tel:" style="font-size:20px; margin-left:30%;"><i class="icofont-phone"></i>98410 27667</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6 mb10">
                            <div class="rounded-20px">
                                <div class="post-image rounded-10px">
                                    
                                    <img alt="" src="images/news/ssfi 2 (1).jpg" class="lazy">
                                </div>
                                <div class="pt-2 h-100">
                                    <h4 class="text-center"><a class="text-dark" href="#">Dr. R. Pratap Kumar</a></h4>
                                    <h5 class="mb-3 text-center">Gen. Secretary</h5>
                                    <a href="tel:" style="font-size:20px; margin-left:30%;"><i class="icofont-phone"></i>98410 27667</a>
                                </div>
                            </div>
                        </div> 
                        <div class="col-lg-3 col-md-6 mb10">
                            <div class="rounded-20px">
                                <div class="post-image rounded-10px">
                            
                                    <img alt="" src="images/news/ssfi 3 (1).jpg" class="lazy">
                                </div>
                                <div class="pt-2 h-100">
                                    <h4 class="text-center"><a class="text-dark" href="#">Sathianarayanan</a></h4>
                                    <h5 class="mb-3 text-center">Treasurer</h5>
                                    <a href="tel:" style="font-size:20px; margin-left:30%;"><i class="icofont-phone"></i>98410 27667</a>
                                </div>
                            </div>
                        </div>
                        
                          <div class="col-lg-3 col-md-6 mb10">
                            <div class="rounded-20px">
                                <div class="post-image rounded-10px">
                                    
                                    <img alt="" src="images/news/ssfi 2 (1).jpg" class="lazy">
                                </div>
                                <div class="pt-2 h-100">
                                    <h4 class="text-center"><a class="text-dark" href="#">Dr. R. Pratap Kumar</a></h4>
                                    <h5 class="mb-3 text-center">Gen. Secretary</h5>
                                    <a href="tel:" style="font-size:20px; margin-left:30%;"><i class="icofont-phone"></i>98410 27667</a>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
    </div>
      
    </div>
    
    <!--district unit-->
     <div id="Artistic" class="tab-content">     
           <div style="margin-top:0%">
        <div class="container">
                    <div class="row g-4 gy-5">
                        <div class="col-lg-3 col-md-6 mb10">
                            <div class="rounded-20px">
                                <div class="post-image rounded-10px">
                                   
                                    <img alt="" src="images/news/ssfi 1 (1).jpg" class="lazy">
                                </div>
                                <div class="pt-2 h-100">
                                    <h4 class="text-center"><a class="text-dark" href="#">O.S. Sekar</a></h4>
                                    <h5 class="mb-3 text-center">President</h5>
                                     <a href="tel:" style="font-size:20px; margin-left:30%;"><i class="icofont-phone"></i>98410 27667</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6 mb10">
                            <div class="rounded-20px">
                                <div class="post-image rounded-10px">
                                    
                                    <img alt="" src="images/news/ssfi 2 (1).jpg" class="lazy">
                                </div>
                                <div class="pt-2 h-100">
                                    <h4 class="text-center"><a class="text-dark" href="#">Dr. R. Pratap Kumar</a></h4>
                                    <h5 class="mb-3 text-center">Gen. Secretary</h5>
                                    <a href="tel:" style="font-size:20px; margin-left:30%;"><i class="icofont-phone"></i>98410 27667</a>
                                </div>
                            </div>
                        </div> 
                        <div class="col-lg-3 col-md-6 mb10">
                            <div class="rounded-20px">
                                <div class="post-image rounded-10px">
                            
                                    <img alt="" src="images/news/ssfi 3 (1).jpg" class="lazy">
                                </div>
                                <div class="pt-2 h-100">
                                    <h4 class="text-center"><a class="text-dark" href="#">Sathianarayanan</a></h4>
                                    <h5 class="mb-3 text-center">Treasurer</h5>
                                    <a href="tel:" style="font-size:20px; margin-left:30%;"><i class="icofont-phone"></i>98410 27667</a>
                                </div>
                            </div>
                        </div>
                        
                          <div class="col-lg-3 col-md-6 mb10">
                            <div class="rounded-20px">
                                <div class="post-image rounded-10px">
                                    
                                    <img alt="" src="images/news/ssfi 2 (1).jpg" class="lazy">
                                </div>
                                <div class="pt-2 h-100">
                                    <h4 class="text-center"><a class="text-dark" href="#">Dr. R. Pratap Kumar</a></h4>
                                    <h5 class="mb-3 text-center">Gen. Secretary</h5>
                                    <a href="tel:" style="font-size:20px; margin-left:30%;"><i class="icofont-phone"></i>98410 27667</a>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
    </div> 
         </div>
    
    
    
     <!-- Executive Committee Details Content -->
    <div id="roller" class="tab-content">
  <div style="margin-top:0%">
        <div class="container">
                    <div class="row g-4 gy-5">
                        <div class="col-lg-3 col-md-6 mb10">
                            <div class="rounded-20px">
                                <div class="post-image rounded-10px">
                                   
                                    <img alt="" src="images/news/ssfi 1 (1).jpg" class="lazy">
                                </div>
                                <div class="pt-2 h-100">
                                    <h4 class="text-center"><a class="text-dark" href="#">O.S. Sekar</a></h4>
                                    <h5 class="mb-3 text-center">President</h5>
                                     <a href="tel:" style="font-size:20px; margin-left:30%;"><i class="icofont-phone"></i>98410 27667</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6 mb10">
                            <div class="rounded-20px">
                                <div class="post-image rounded-10px">
                                    
                                    <img alt="" src="images/news/ssfi 2 (1).jpg" class="lazy">
                                </div>
                                <div class="pt-2 h-100">
                                    <h4 class="text-center"><a class="text-dark" href="#">Dr. R. Pratap Kumar</a></h4>
                                    <h5 class="mb-3 text-center">Gen. Secretary</h5>
                                    <a href="tel:" style="font-size:20px; margin-left:30%;"><i class="icofont-phone"></i>98410 27667</a>
                                </div>
                            </div>
                        </div> 
                        <div class="col-lg-3 col-md-6 mb10">
                            <div class="rounded-20px">
                                <div class="post-image rounded-10px">
                            
                                    <img alt="" src="images/news/ssfi 3 (1).jpg" class="lazy">
                                </div>
                                <div class="pt-2 h-100">
                                    <h4 class="text-center"><a class="text-dark" href="#">Sathianarayanan</a></h4>
                                    <h5 class="mb-3 text-center">Treasurer</h5>
                                    <a href="tel:" style="font-size:20px; margin-left:30%;"><i class="icofont-phone"></i>98410 27667</a>
                                </div>
                            </div>
                        </div>
                        
                          <div class="col-lg-3 col-md-6 mb10">
                            <div class="rounded-20px">
                                <div class="post-image rounded-10px">
                                    
                                    <img alt="" src="images/news/ssfi 2 (1).jpg" class="lazy">
                                </div>
                                <div class="pt-2 h-100">
                                    <h4 class="text-center"><a class="text-dark" href="#">Dr. R. Pratap Kumar</a></h4>
                                    <h5 class="mb-3 text-center">Gen. Secretary</h5>
                                    <a href="tel:" style="font-size:20px; margin-left:30%;"><i class="icofont-phone"></i>98410 27667</a>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
    </div> 
    </div>
    
    
    
    
    
     <!-- Affiliated Units Details Content -->
    <div id="Games" class="tab-content active">
          <div style="margin-top:0%">
        <div class="container">
                    <div class="row g-4 gy-5">
                        <div class="col-lg-3 col-md-6 mb10">
                            <div class="rounded-20px">
                                <div class="post-image rounded-10px">
                                   
                                    <img alt="" src="images/news/ssfi 1 (1).jpg" class="lazy">
                                </div>
                                <div class="pt-2 h-100">
                                    <h4 class="text-center"><a class="text-dark" href="#">O.S. Sekar</a></h4>
                                    <h5 class="mb-3 text-center">President</h5>
                                     <a href="tel:" style="font-size:20px; margin-left:30%;"><i class="icofont-phone"></i>98410 27667</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6 mb10">
                            <div class="rounded-20px">
                                <div class="post-image rounded-10px">
                                    
                                    <img alt="" src="images/news/ssfi 2 (1).jpg" class="lazy">
                                </div>
                                <div class="pt-2 h-100">
                                    <h4 class="text-center"><a class="text-dark" href="#">Dr. R. Pratap Kumar</a></h4>
                                    <h5 class="mb-3 text-center">Gen. Secretary</h5>
                                    <a href="tel:" style="font-size:20px; margin-left:30%;"><i class="icofont-phone"></i>98410 27667</a>
                                </div>
                            </div>
                        </div> 
                        <div class="col-lg-3 col-md-6 mb10">
                            <div class="rounded-20px">
                                <div class="post-image rounded-10px">
                            
                                    <img alt="" src="images/news/ssfi 3 (1).jpg" class="lazy">
                                </div>
                                <div class="pt-2 h-100">
                                    <h4 class="text-center"><a class="text-dark" href="#">Sathianarayanan</a></h4>
                                    <h5 class="mb-3 text-center">Treasurer</h5>
                                    <a href="tel:" style="font-size:20px; margin-left:30%;"><i class="icofont-phone"></i>98410 27667</a>
                                </div>
                            </div>
                        </div>
                        
                          <div class="col-lg-3 col-md-6 mb10">
                            <div class="rounded-20px">
                                <div class="post-image rounded-10px">
                                    
                                    <img alt="" src="images/news/ssfi 2 (1).jpg" class="lazy">
                                </div>
                                <div class="pt-2 h-100">
                                    <h4 class="text-center"><a class="text-dark" href="#">Dr. R. Pratap Kumar</a></h4>
                                    <h5 class="mb-3 text-center">Gen. Secretary</h5>
                                    <a href="tel:" style="font-size:20px; margin-left:30%;"><i class="icofont-phone"></i>98410 27667</a>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
    </div> 
    </div>

    <!-- Infrastructure Details Content -->
    <div id="Referees" class="tab-content">
       <style>
        body {
            font-family: Arial, sans-serif;
        }
        .table-container {
            margin: 30px auto;
            max-width: 900px;
            text-align: center;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
    </style>


    <div class="container table-container">
        <h4 class="text-center fw-bold">PROVISIONAL RESULTS – REFEREE SEMINAR & CERTIFICATE PROGRAMME 2024</h4>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="4" class="table-light">PROVISIONAL RESULTS</th>
                    </tr>
                    <tr>
                        <th colspan="4">Speed Skating Results South Zone March 2024</th>
                    </tr>
                    <tr class="table-secondary">
                        <th>Reg No.</th>
                        <th>Name</th>
                        <th>State</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Smrithi I S</td>
                        <td>Karnataka</td>
                        <td>A+</td>
                    </tr>
                   
                    <tr>
                        <td>2</td>
                        <td>Kiran C P</td>
                        <td>Kerala</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>ANIL KUMAR PRAJAPATHI</td>
                        <td>Andhra Pradesh</td>
                        <td>B+</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Michel Devasagayam A</td>
                        <td>Puducherry</td>
                        <td>B+</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Ravish H R</td>
                        <td>Karnataka</td>
                        <td>B+</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Bhagyaraj P M</td>
                        <td>Karnataka</td>
                        <td>B+</td>
                    </tr>
                       <tr>
                        <td>7</td>
                        <td>Smrithi I S</td>
                        <td>Karnataka</td>
                        <td>A+</td>
                    </tr>
                     <tr>
                        <td>8</td>
                        <td>ANURAJ PAINGAVIL R</td>
                        <td>Kerala</td>
                        <td>A+</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>ANURAJ PAINGAVIL R</td>
                        <td>Kerala</td>
                        <td>A+</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Kiran C P</td>
                        <td>Kerala</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>ANIL KUMAR PRAJAPATHI</td>
                        <td>Andhra Pradesh</td>
                        <td>B+</td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>Michel Devasagayam A</td>
                        <td>Puducherry</td>
                        <td>B+</td>
                    </tr>
                    <tr>
                        <td>13</td>
                        <td>Ravish H R</td>
                        <td>Karnataka</td>
                        <td>B+</td>
                    </tr>
                    <tr>
                        <td>14</td>
                        <td>Bhagyaraj P M</td>
                        <td>Karnataka</td>
                        <td>B+</td>
                    </tr>
                </tbody>
            </table>
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
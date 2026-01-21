<?php 
ob_start();
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

?>
<!doctype html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Speed Skating Federation of India</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/ssfi-logo-12.png" />
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"-->
    <!--integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />-->
  <!--<link rel="icon" href="images/ssfi-logo-12.png" type="image/gif" sizes="16x16">-->
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="assets/vendor/fonts/remixicon/remixicon.css" />
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icons.css" />
  

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="assets/vendor/libs/node-waves/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="assets/vendor/libs/swiper/swiper.css" />
    
    <link rel="stylesheet" href="assets/vendor/fonts/remixicon/remixicon.css" />
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icons.css" />


    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
  </head>
 <style>
         toastt container (top-right) 
        .toastt-container {
            position: fixed;
            top: 70px;
            right: 20px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

         toastt message style 
        .toastt {
            min-width: 250px;
            max-width: 350px;
            background: #28a745;
            color: #fff;
            z-index:99;
            padding: 15px;
            border-radius: 5px;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateX(100%);
            animation: slideIn 0.5s ease-out forwards, fadeOut 0.5s ease-in 2.5s forwards;
        }

         Close button 
        .toastt .close-btn {
            background: none;
            border: none;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
            margin-left: 10px;
        }

         Slide-in animation 
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

         Fade-out animation 
        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(100%);
            }
        }
    </style>
  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

       <?php include 'navbar.php' ?>
        <!-- / Menu -->
       <?php include 'topbar.php' ?>
         <!-- Content wrapper -->
          <div class="content-wrapper">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=0.8, maximum-scale=1.0, user-scalable=no" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css" />
        <link rel="stylesheet" href="vendor/waves/waves.min.css" />
        <link rel="stylesheet" href="css/nativedroid2.css" />
        <link rel="stylesheet" href="css/cbstyle.css" />
        <link rel="stylesheet" href="vendor/wow/animate.css" />
        <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous">

        <style type='text/css'>
      .card {
    width: 300%;
    padding: 15px;
    border-radius: 10px;
    background-color: #f9f9f9;
    box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-left:5%;
}

label {
    font-weight: bold;
}

input {
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ccc;
    width: 100%;
}

        </style>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>
        <script src="vendor/waves/waves.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
        <script src="vendor/wow/wow.min.js"></script>
        <script src="js/nativedroid2.js"></script>
        <script src="nd2settings.js"></script>
        <script src="js/jquery.cropit.js"></script>
        <script type="text/javascript" src="j.js?version=202512"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="entrypage" data-url="entrypage">
            <div data-role="header" style="overflow:hidden; text-align:center;">
                <br>
                <center>
                    <table style="text-align: center;">
                        <tbody>
                            <tr>
                                <td><img src="https://ssfibharatskate.com/ssfi/admin/assets/img/favicon/ssfa.png" class="tnssa-logo" alt="tnssa logo" style="WIDTH: 70px;"></td>
                                <td><b style="font-size: 16px;color: #3e4095;">Speed Skating Federation of India</b><br>
                                    <b>Affiliated to Speed Skating Federation of India SSFI</b><br>
                                    <b>No. 12 Porkudil Nagar,Podumbu - 625018,Madurai</b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </center>
                <!--<center style="padding: 10px;"><b style="font-size: 16px;color: #afa300;">SKATER REGISTRATION 2025 - 2026</b></center>-->
            </div>
            <div data-role="main" class="ui-content">
                <div class="nd2-no-menu-swipe">
                    <div class="ui-content" data-inset="false">
                        <form id="entryform" autocorrect="off" spellcheck="false" autocomplete="false">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <!--<center><b style="font-size: 14px;color: #3e4095;">Skater Personal Information</b><br><br></center>-->
                                    <div class="box">
                                        <div class="card p-5">
                                             <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="sname">FullName - As per Aadhaar:</label>
                                                <input autocomplete="off" required="required" type="text" name="full_name" id="full_name" value="" data-clear-btn="true" >
                                            </div>
                                           
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="phone">Mobile :</label>
                                                <input required="required" type="number" name="mobile_number" id="mobile_number" value="" data-clear-btn="true"  minlength="10" maxlength="10">
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="email">Email :</label>
                                                <input required="required" type="email" name="email_address" id="email_address" value="" data-clear-btn="true" placeholder="Email">
                                            </div>
                                     
                                        </div> 
                                        
                                        
                                         <div class="row">
                                
                                        <button class="btn btn-primary" style="background-color: red; width: 15%; color: white; font-size: 18px;">Back To Home</button>
                               
                                </div>
                                        </div>
                                    
                                        
                                        
                                    </div>
                                </div>
                            </div>
                           
                       
                           
                           
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
    </body>
</html>
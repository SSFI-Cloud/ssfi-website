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
        <style type='text/css'>
            table {
            border-collapse: collapse;
            }
            .ui-shadow{
            padding: 4px;
            font-weight: 400;
            font-size: 14px;
            }
            @media only screen and (min-width: 600px) {
            .ui-page {
            width: 100% !important;
            max-width: 1300px !important;
            margin: 0 auto !important;
            position: relative !important;
            }
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
                <center style="padding: 10px;"><b style="font-size: 16px;color: #afa300;">SKATER REGISTRATION 2025 - 2026</b></center>
            </div>
            <div data-role="main" class="ui-content">
                <div class="nd2-no-menu-swipe">
                    <div class="ui-content" data-inset="false">
                        <form id="entryform" autocorrect="off" spellcheck="false" autocomplete="false">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <center><b style="font-size: 14px;color: #3e4095;">Skater Personal Information</b><br><br></center>
                                    <div class="box">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="sname">FullName - As per Aadhaar:</label>
                                                <input autocomplete="off" required="required" type="text" name="full_name" id="full_name" value="" data-clear-btn="true" placeholder="Type Skater Name here...">
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="fathername">Fathername</label>
                                                <input type="text" name="father_name" id="father_name" value="" data-clear-btn="true" placeholder="Father Name" required="required">
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="phone">Mobile : <small>(SKATER / PARENT'S MOBILE NUMBER AS PER AADHAAR.. COACH'S PHONE NUMBER STRICTLY NOT ALLOWED.)</small></label>
                                                <input required="required" type="number" name="mobile_number" id="mobile_number" value="" data-clear-btn="true" placeholder="Mobile" minlength="10" maxlength="10">
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="email">Email :</label>
                                                <input required="required" type="email" name="email_address" id="email_address" value="" data-clear-btn="true" placeholder="Email">
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="date_of_birth">Date of Birth</label>
                                                <input type="date" name="date_of_birth" id="date_of_birth" value="" data-clear-btn="true" placeholder="DOB" required="required">
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="gender" class="d-block">Gender</label>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input class="form-check-input me-1" type="radio" name="gender" id="male" value="Male" checked required>
                                                        <label class="form-check-label me-3" for="male">Male</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input class="form-check-input me-1" type="radio" name="gender" id="female" value="Female" required>
                                                        <label class="form-check-label me-3" for="female">Female</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input class="form-check-input me-1" type="radio" name="gender" id="other" value="Other" required>
                                                        <label class="form-check-label" for="other">Other</label>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="blood">Blood Group</label>
                                                <select name="blood_group" id="blood_group" class="form-control" required="">
                                                    <option value="">Select Blood Group  <span style="text-fill-color: red;">*</span></option>
                                                    <option value="O Positive(+)">O Positive(+)</option>
                                                    <option value="O Negative(-)">O Negative(-)</option>
                                                    <option value="A Positive(+)">A Positive(+)</option>
                                                    <option value="A Negative(-)">A Negative(-)</option>
                                                    <option value="B Positive(+)" selected>B Positive(+)</option>
                                                    <option value="B Negative(-)">B Negative(-)</option>
                                                    <option value="AB Positive(+)">AB Positive(+)</option>
                                                    <option value="AB Negative(-)">AB Negative(-)</option>
                                                    <option value="A1 Positive(+)">A1 Positive(+)</option>
                                                    <option value="A1 Negative(-)">A1 Negative(-)</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="Category">Category</label>
                                                <select name="category_type_id" id="category_type_id" class="form-control" required="">
                                                    <option value="">Select Category  <span style="text-fill-color: red;">*</span></option>
                                                    <option value="1">QUAD</option>
                                                    <option value="2" selected>PROFESSIONAL INLINE</option>
                                                    <option value="3">BEGINNER</option>
                                                    <option value="4">FANCY INLINE</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <center><b style="font-size: 14px;color: #3e4095;">Fill Skater Club & Coach Information Details</b><br><br></center>
                                    <div class="box">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="state_id">State :</label>
                                                <select name="state_id" id="state_id" class="form-control" required="">
                                                    <option value="23">Tamilnadu</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="district_id">District :</label>
                                                <select name="district_id" id="district_id" class="form-control" required="">
                                                    <option value="23">Salem</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="club_id">Select Club :</label>
                                                <select name="club_id" id="club_id" class="form-control" required="">
                                                    <option value="1">Salem Scate Academy <span style="text-fill-color: red;">*</span></option>
                                                </select>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="school_name">School Name</label>
                                                <input type="text" name="school_name" id="school_name" value="" data-clear-btn="true" placeholder="School Name" required="required">
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="coach_name">Coach Name</label>
                                                <input type="text" name="coach_name" id="coach_name" value="" data-clear-btn="true" placeholder="Coach Name" required="required">
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label for="coach_mobile_number">Coach Number</label>
                                                <input type="text" name="coach_mobile_number" id="coach_mobile_number" value="" data-clear-btn="true" placeholder="Coach Number" required="required">
                                            </div>
                                            <!--<div class="col-xs-12 col-sm-12 col-md-12">-->
                                            <!--    <label for="syllabus">I am</label>-->
                                            <!--        <select required="required" name="syllabus" id="syllabus" data-theme="a" data-clear-btn="true">-->
                                            <!--            <option>Studying in School - STATE Board</option>-->
                                            <!--            <option>Studying in School - CBSE</option>-->
                                            <!--            <option>Studying in School - ICSE</option>-->
                                            <!--            <option>Studying in School - ISE</option>-->
                                            <!--            <option>Studying in School/ College / University</option>-->
                                            <!--            <option>Studying in School / College / University - Private / Open</option>-->
                                            <!--            <option>Working</option>-->
                                            <!--            <option>Self-Employed / Business</option>-->
                                            <!--            <option>Others</option>-->
                                            <!--        </select>-->
                                            <!--</div>-->
                                            
                                          
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                  <br>  <br>   <br>
                                                <b><center style="font-size: 14px;color: #3e4095;">Fill Address Details</center></b>
                                                    <label for="residential_address">Representing Address :</label>
                                                    <textarea cols="40" rows="4" name="residential_address" required="required" id="residential_address" placeholder="type here(Maximum 4 Lines)" value="" data-clear-btn="true" class="ui-input-text ui-shadow-inset ui-body-inherit ui-corner-all ui-textinput-autogrow" style="height: 33px;"></textarea>
                                                    
                                            </div>
                                            
                                            
                                            
                                        </div> 
                                        
                                        
                                        
                                        
                                        
                                        
                                        <div id="paystat"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <center><b style="font-size: 14px;color: #3e4095;">Proof & Skater Photo</b><br><br></center>
                                    <div class="box">
                                        
                                        
                                         <div class="row">
                                            <!-- <div class="col-xs-12 col-sm-12 col-md-12">-->
                                            <!--    <label for="aadhar_number">Aadhar Number</label>-->
                                            <!--    <input type="text" name="aadhar_number" id="aadhar_number" value="" data-clear-btn="true" placeholder="Aadhar Number" required="required">-->
                                                
                                            <!--</div>-->
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="box">
                                                    <div class="ui-field-contain">
                                                        <label for="profile_photo">Passport Size Photo</label>
                                                        <input type="file" name="profile_photo" id="profile_photo" accept="application/pdf,image/jpeg" max-size=1024 required="required" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="ui-field-contain">
                                                    <label for="identity_proof">ID Proof Image</label>
                                                    <input type="file" name="identity_proof" id="identity_proof" accept="application/zip" max-size=1024 required="required" />
                                                </div>
                                            </div>
                                            
                                         </div>
                                        
                                        
                                        
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs"></div>
                            </div>
                            <div class="row">
                                <div class="col-xs">
                                    <div class="box">
                                        <p align="justify">
                                        <center>
                                            <strong>Declaration</strong>
                                        </center>
                                        <!--<br /> I hereby declare that-->
                                        </p>
                                        <!--<p align="justify"> 1. I am/was not a registered skater with any State/U.T. Unit other than the present one.-->
                                        <!--    <br /> I hereby consent to provide my/myward's Aadhaar Offline KYC Data and Passcode for Aadhaar based authentication for -->
                                        <!--</p>-->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs">
                                    <input type="hidden" value="" name="photourl" id="photourl" />
                                    <input type="hidden" value="" name="dob-data" id="dob-data" />
                                    <input type="hidden" value="" name="applno" id="applno" />
                                    <input type="hidden" value="" name="mode" id="mode" />
                                    <div class="ui-field-contain">
                                        <label for="regstatus">Agree to terms and conditions All the information given by me is correct and if any information is wrong then I'm the responsible for
                                        this. I obey all the rules and regulations of TNSSA</label>
                                        <input id="regstatus" name="regstatus" type="checkbox" required="required" />
                                        <br />
                                        <br />
                                    </div>
                                    <!--<div>-->
                                    <!--    <input type="hidden" value="1" name="plan" id="plan" />-->
                                    <!--</div>-->
                                    <!--<input type="submit" id="submitbutton" value="Register" class="ui-btn clr-btn-green" />-->
                                    
                                    
                                    
                                </div>
                            </div>
                            <div class="row">
                                <!--<div class="col-lg-3 col-md-3 col-sm-3">-->
                                        <button class="btn btn-primary" style="background-color: red; width: 10%; color: white; font-size: 18px;">Edit</button>
                                <!--</div>-->
                                 <!--<div class="col-lg-3 col-md-3 col-sm-3">-->
                                        <button class="btn btn-primary" style="background-color: green; width: 10%; color: white; font-size: 18px; margin-left: 2%;">Confrim</button>
                                    
                                <!--</div>-->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </body>
</html>
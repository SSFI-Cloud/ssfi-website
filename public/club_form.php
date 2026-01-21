<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
    /* Default Background for Desktop */
body{
    background-image: url("images/background/bg4.avif") !important; /* Change to your image path */
    background-size: cover; /* Cover the entire screen */
    background-position: center; /* Center the image */
    background-attachment: fixed; /* Keeps the background fixed */
    background-repeat: no-repeat;
    width: 100%;
    height: 100vh; /* Full height of viewport */
}

/* Mobile Fix for Background */
@media (max-width: 768px) {
    .bg-fixed {
        background-attachment: scroll; /* Fix mobile background issue */
        background-size: cover;
    }
}

        body {
            padding: 20px;
            background-image:url();
        }
        .form-container {
            max-width: 900px;
            margin: auto;
          
        }
        .form-control{
              border-top:none !important;
            border-right:none !important;
            border-left:none !important;
        }
         .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
        }
        .form-control{
            border-top:none;
             border-right:none;
              border-left:none;
        }
       /* Default Desktop Logo */
.logo-main {
    width: 25%;
    height: auto;
    display: block;
}
/* Sticky Logo (Appears on Scroll) */
.logo-scroll {
    width: 25%;
    height: auto;
    position: fixed;
    top: 10px;
    left: 10px;
    display: none; /* Initially hidden */
}
.logo-mobile{
    display:none;
}

/* Show Sticky Logo on Scroll */
body.scrolled .logo-scroll {
    display: block;
}
body.scrolled .logo-main {
    display: none;
}

/* Mobile Logo (Visible on Smaller Screens) */
@media (max-width: 768px) {
    .logo-main {
        display: none; /* Hide desktop logo */
    }
    .logo-mobile {
        width: 40%;
        height: auto;
        display: block;
    }
    .res{
        margin:0%;
    }
}
        
        
        
    </style>
</head>
<body>
     <div style="align-item:center;" class="d-flex justify-content-between">
       <div id="logo">
         <a href="index.php">
            <img class="logo-main" src="images/logo-removebg-preview.png" width="35%" height="50%" alt="" >
            <!--<img class="logo-scroll" src="images/logo-removebg-preview.png" width="25%" height="25%" alt="" >-->
            <img class="logo-mobile" src="images/logo-removebg-preview.png" width="25%" height="25%" alt="" >
         </a>
        </div>
         <div>
            <h4 class="res mt-3">CLUB ANNUAL REGISTERATION 2025-26</h4>
        </div>
        </div>
    <br>
        
    <div class="container form-container">
        
        <div class="card p-4" style="box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;">
            
     
        
        <h2 class="text-center mb-2">Club Registration Form</h2>
        <form>
            <div class="row">
                <div class="col-md-6">
                    <label for="club_name" class="form-label" style="color:#505050e0;">Club Name:</label>
                    <input type="text" class="form-control" id="club_name" name="club_name" required>
                </div>
                <div class="col-md-6">
                    <label for="registration_number" class="form-label "style="color:#505050e0;">Registration Number:</label>
                    <input type="text" class="form-control" id="registration_number" name="registration_number" required>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="contact_person" class="form-label " style="color:#505050e0;">Contact Person:</label>
                    <input type="text" class="form-control" id="contact_person" name="contact_person" required>
                </div>
                <div class="col-md-6">
                    <label for="mobile_number" class="form-label"style="color:#505050e0;">Mobile Number:</label>
                    <input type="tel" class="form-control" id="mobile_number" name="mobile_number" required>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="email_address" class="form-label" style="color:#505050e0;">Email Address:</label>
                    <input type="email" class="form-control" id="email_address" name="email_address" required>
                </div>
                <div class="col-md-6">
                    <label for="district_id" class="form-label"style="color:#505050e0;">District:</label>
                    <select class="form-control" id="district_id" name="district_id">
                        <option>Select District</option>
                        <option value="1">Chennai</option>
                        <option value="2">Coimbatore</option>
                        <option value="3">Salem</option>
                    </select>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="state_id" class="form-label" style="color:#505050e0;">State:</label>
                    <select class="form-control" id="state_id" name="state_id">
                        <option>Select State</option>
                        <option value="1">Tamil Nadu</option>
                        <option value="2">Karnataka</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="club_address" class="form-label" style="color:#505050e0;" >Club Address:</label>
                    <textarea class="form-control" id="club_address" name="club_address" rows="2"></textarea>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="established_year" class="form-label" style="color:#505050e0;">Established Year:</label>
                    <input type="number" class="form-control" id="established_year" name="established_year" min="1900" max="2025">
                </div>
                <div class="col-md-6">
                    <label for="logo_path" class="form-label" style="color:#505050e0;">Upload Club Logo:</label>
                    <input type="file" class="form-control" id="logo_path" name="logo_path" accept="image/*">
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="status" class="form-label" style="color:#505050e0;">Status:</label>
                    <select class="form-control" id="status" name="status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
        </form>
           </div>
    </div>
    
    
        
    <div class="container">
        <h2 class="text-center mt-5">Declaration</h2>
        <p> I hereby declare that</p>
        <p align="justify">
                         1. I am/was not a registered skater with any State/U.T. Unit other than the present one.<br>

                         2. I am aware that only skaters registered with the Roller Skating Federation of India (RSFI) are allowed to participate in International, Asian, and RSFI-approved National, All India, Memorial, and Invitational Tournaments, as well as State/U.T.-approved State, District, and local championships. Therefore, I undertake not to participate in any competition or championship that does not have the approval of RSFI or the State/U.T. Unit as mentioned above.<br>

3. <strong>I am aware that I am permitted to participate only in the registered discipline (as mentioned above) in any District, State, National, Open Championships, and any violation of this rule will be subject to strict disciplinary action by RSFI.</strong><br>

4. <strong>I also understand that multiple registrations are not allowed. Any violation of this rule will result in strict disciplinary action, invalidation of both registrations, and forfeiture of the registration fee.</strong><br>

5. <strong>I do not participate in any skating sport/discipline/activity that is not recognized by RSFI. In case I intend to participate in any such tournament, I will seek prior permission well in advance.</strong><br>

6. <strong>I have attached proof of identity, address, and date of birth as per RSFI guidelines and will produce the necessary original documents whenever requested by RSFI, the State Association, or the District Association.</strong><br>

7. I understand that completing online registration and making the fee payment does not confirm the completion of the registration process. My registration is subject to approval by the District and State Units and RSFI.<br>

8. I consent to share the information provided by me with RSFI and any service providers associated with RSFI.<br>

9. I agree to receive newsletters and other communications from RSFI via mail, email, phone calls, or SMS.<br>

10. All the information provided in the online registration system (as furnished above) is true, and I take full responsibility for its accuracy.<br>

11. I accept that if any information provided is found to be incorrect, RSFI has the right to take appropriate action, including forfeiture of the fee and rejection or cancellation of my registration.<br>

12. I will produce all original and supporting documents whenever required by RSFI, the State Association, or the District Association. I undertake to abide by all the rules and regulations issued by RSFI, the State Association, and the District Association.<br>

13. I/my ward understand(s) that the rules and regulations are subject to change.<br>

14. I hereby declare that all the information provided by me is true and correct to the best of my knowledge and belief.<br>

15. I undertake not to tarnish the reputation of the game or championship on social media or in print media in any adverse manner.<br>

16. I agree not to oppose any decision made for the betterment of the game or championship by my coach, manager, organizing committee, district, state, or federation.<br>

17. I undertake not to cause any harm or damage to the reputation of the game, players, officials, spectators, or property during the championship.<br>

18. I will adhere to all rules and regulations laid down by the championship committee for the smooth functioning of the championship. In case of non-compliance, I accept the actions taken by the District/State Association, organizing committee, coach, manager, or federation.<br>

19. I/my ward will not participate in any event not organized by CBSE, KVS, SGFI, government organizations, or any event not approved by RSFI, the State Association, or the District Association. In case of any breach, RSFI, the State Association, or the District Association may take appropriate action.<br>

20. I/my ward agree that RSFI, its members, officials, affiliated units, organizers, or federation/association members shall not be held responsible for any injury, accident, or loss of any nature during practice, camps, championships, or journeys, whether on or off the playing area. I also waive the right to claim any damages from the organizers or association for any such incidents. <br>

21. I/my ward will obtain adequate accidental, medical, and life insurance policies for participation in tours, championships, tournaments, camps, etc.<br>

22. I understand that my/my ward’s registration is subject to the approval of the District/State/U.T. Unit, and I will submit the required form and documents to the respective authority promptly.<br>

23. I/my ward confirm that I/my ward have not participated in any unapproved championship or tournament during the 2024-26 season which did not have the approval of RSFI/State/District Unit.<br>

24. I/my ward accept that RSFI or the organizing committee has the right to conduct bone tests / DOPE test at any time during or after the championship, and I have no objections. I am aware that failing to comply will result in disciplinary action.<br>

25. <strong>I am aware that qualifying time standards set by RSFI must be met for participation in District, State, and National Championships. I understand that failure to achieve these times will result in ineligibility.</strong><br>
<strong>26. Consent for Authentication</strong><br>
I hereby consent to provide my/myward's Aadhaar Offline KYC Data and Passcode for Aadhaar based authentication for
the purpose of establishing my identity with RSFI Registration as well as to club all sport activities (i.e. Championships) through my Aadhaar information by District, State Units and RSFI.
I have no objection in authenticating myself/myward and fully understand that information provided by me shall be used for authenticating my identity through Aadhaar Authentication System for the purpose stated above and related services.</p>
  
  
      <div class="ui-checkbox">
                    <input id="regstatus" name="regstatus" type="checkbox" required="required">
          <label for="regstatus" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-checkbox-off">I Read Fully and Agree to Terms &amp; Conditions</label>
</div>

  
  
  <div class="text-center mt-5">
      <button class="btn btn-primary">I AGREE TO ABIDE BY RSFI RULES & SUBMIT</button>
  </div>
  
    </div>
    
</body>
</html>

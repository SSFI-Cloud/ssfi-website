<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
 body{
    background-image: url("images/background/bg4.avif") !important; /* Change to your image path */
    background-size: cover; /* Cover the entire screen */
    background-position: center; /* Center the image */
    background-attachment: fixed; /* Keeps the background fixed */
    background-repeat: no-repeat;
    width: 100%;
    height: 100vh; /* Full height of viewport */
}
        body {
            padding: 20px;
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
        <div style="align-item:center;" class="d-flex justify-content-between">
       <div id="logo">
         <a href="index.php">
            <img class="logo-main" src="images/logo-removebg-preview.png" width="35%" height="50%" alt="" >
            <!--<img class="logo-scroll" src="images/logo-removebg-preview.png" width="25%" height="25%" alt="" >-->
            <img class="logo-mobile" src="images/logo-removebg-preview.png" width="25%" height="25%" alt="" >
         </a>
        </div>
         <div>
            <h4 class="res mt-3">SKATER ANNUAL REGISTERATION 2025-26</h4>
        </div>
        </div>
    <br>
<div class="top">
 <div class="container">
        <h2 class="text-center">Skaters Annual Registration Form</h2>
        <form>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Full Name - As per Aadhaar:</label>
                        <input type="text" class="form-control" placeholder="Type Skater Name here..." required>
                    </div>
                    <div class="form-group">
                        <label>Father Name:</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Mobile:</label>
                        <input type="text" class="form-control" placeholder="As per Aadhaar.. No Coach's Number" required>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Retype Email ID:</label>
                        <input type="email" class="form-control" placeholder="To avoid mistake" required>
                    </div>
                    <div class="form-group">
                        <label>Blood Group:</label>
                        <input type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Discipline:</label>
                        <select class="form-select">
                            <option>SPEED QUAD</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Studying & Representing State / U.T.:</label>
                        <select class="form-select">
                            <option>ANDAMAN NICOBAR</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Studying & Representing District:</label>
                        <select class="form-select">
                            <option>Select District</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Representing Club Name & Address:</label>
                        <textarea class="form-control" rows="2" placeholder="type here(Maximum 4 Lines)"></textarea>
                    </div>
                    <div class="form-group">
                        <label>I am:</label>
                        <select class="form-select">
                            <option>STUDYING IN SCHOOL - STATE BOARD</option>
                        </select>
                    </div>
                      </div>  
                <div class="col-md-4">
                    
                
                    
                    
                    
                    <div class="form-group">
                        <label>Upload AADHAAR OKYC (ZIP):</label>
                        <input type="file" class="form-control" required>
                        <small>Download Aadhaar OKYC File From Official Aadhaar Website.</small>
                    </div>
                    <div class="form-group">
                        <label>Passcode for Aadhaar ZIP File:</label>
                        <input type="text" class="form-control" placeholder="XXXX1234" required>
                    </div>
                    <div class="form-group">
                        <label>Upload Birth Certificate (PDF):</label>
                        <input type="file" class="form-control" required>
                        <small>The date of registration on the birth certificate must be within ONE YEAR of the date of birth.</small>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
    
    
    <div class="container">
        <h2 class="text-center">Declaration</h2>
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
    </div>
    <script>
        window.addEventListener("scroll", function () {
    if (window.scrollY > 50) {
        document.body.classList.add("scrolled");
    } else {
        document.body.classList.remove("scrolled");
    }
});

    </script>
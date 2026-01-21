<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Certificate Replica</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Fonts (for closer visual match) -->
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&family=Great+Vibes&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

  <style>
    /* Page reset */
    html,body{
      height:100%;
      margin:0;
      background:#efefef;
      font-family: "Roboto", Arial, sans-serif;
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
    }

    /* Central certificate container with same aspect ratio as provided image */
    .cert-wrap{
         width: 297mm;
      height: 210mm;
      /*width: 100%;*/
      
      /*max-width: 1000px;*/
      /* change if you want larger/smaller */
      margin: 30px auto;
      background: #fff;
      box-shadow: 0 8px 30px rgba(0,0,0,0.12);
      border-radius: 6px;
      overflow: hidden;
    }

    /* Use the provided certificate image as background to reproduce exact UI.
       Place this file (cer.jpeg or cer.jpg) in same folder as this HTML. */
    .cert{
      position: relative;
      /* Keep same aspect ratio as original image (approx 4:5). Adjust if needed. */
      /*width: 100%;*/
        width: 297mm;
      height: 210mm;
      padding-top: 125%; /* 1.25 = height/width -> tweak to match your image aspect ratio */
      background-image: url('template-state.png');
      background-size: cover;
      /*background-position: center;*/
      background-repeat: no-repeat;
    }

    /*
      Overlay area: all text elements are absolutely positioned using percentage values
      so they scale with the container. These positions were chosen to closely match
      the sample certificate image. Adjust percentages for pixel-perfect tweak as needed.
    */

    .overlay{
      position: absolute;
      inset: 0;
      pointer-events: none; /* disables text selection over decorative overlays */
    }

    /* Title: TAMILNADU SPEED SKATING ASSOCIATION */
    .title-main{
      position: absolute;
      top: 5.6%;
      left: 50%;
      transform: translateX(-50%);
      width: 86%;
      text-align: center;
      font-family: "Cinzel", serif;
      color: #b02b18;
      font-weight: 800;
      letter-spacing: 1.6px;
      font-size: calc(12px + 1.6vw);
      text-transform: uppercase;
    }

    /* Subheading line under the title */
    .subtitle{
      position: absolute;
      top: 10.3%;
      left: 50%;
      transform: translateX(-50%);
      width: 80%;
      text-align:center;
      color:#8a1f11;
      font-weight:700;
      font-size: calc(9px + 0.8vw); 
    }

    /* CERTIFICATE heading */
    .cert-heading{
      position: absolute;
      top: 18%;
      left: 50%;
      transform: translateX(-50%);
      font-family: "Cinzel", serif;
      color:#b0301a;
      font-weight:800;
      font-size: calc(22px + 1.6vw);
      letter-spacing:1px;
    }

    .cert-sub{
      position:absolute;
      top: 23%;
      left:50%;
      transform:translateX(-50%);
      color:#b0301a;
      font-weight:600;
      font-size: calc(9px + 0.6vw);
      letter-spacing: 1px;
    }

    /* "This Certificate is Awarded to" */
    .awarded{
      position:absolute;
      top: 31.3%;
      left:50%;
      transform:translateX(-50%);
      font-size: calc(10px + 0.5vw);
      color:#333;
      font-weight:600;
    }

    /* Big name in center (cursive style) */
    .recipient{
      position:absolute;
      top:34.9%;
      left:50%;
      transform:translateX(-50%);
      font-family: "Great Vibes", cursive;
      color:#9e1a08;
      font-size: calc(20px + 3.2vw);
      letter-spacing: 0.6px;
    }

    /* Member details lines */
    .member-block{
      position:absolute;
      top:44%;
      left:7.5%;
      width:85%;
      font-size: calc(8px + 0.4vw);
      color:#222;
      font-weight:600;
      line-height:1.9;
      letter-spacing:0.3px;
    }

    /* Results table area (center-left) */
    .results{
      position:absolute;
      top:66%;
      left:12%;
      width:44%;
      font-weight:700;
      font-size: calc(11px + 0.4vw);
      color:#0b0b0b;
      text-align:left;
      line-height:2.2;
    }

    /* Rounded rectangle area for photo (right side) */
    .photo-box{
      position:absolute;
      top:58.3%;
      right:12%;
      width:18%;
      padding-top:18%;
      border-radius:12px;
      border:4px solid rgba(0,0,0,0.06);
      box-sizing:border-box;
      background: rgba(255,255,255,0.0);
    }

    /* Signatures row near bottom */
    .sign-row{
      position:absolute;
      bottom:8.5%;
      left:6%;
      right:6%;
      display:flex;
      justify-content:space-between;
      align-items:flex-end;
      gap:10px;
    }

    .sign-block{
      width:30%;
      text-align:center;
      font-weight:700;
      color:#c73b18;
      font-family:"Cinzel", serif;
      font-size: calc(9px + 0.4vw);
    }

    /* Footer center logos and year (small) */
    .footer-center{
      position:absolute;
      bottom:5%;
      left:50%;
      transform:translateX(-50%);
      text-align:center;
      width:36%;
    }

    .footer-year{
      position:absolute;
      bottom:2.2%;
      left:50%;
      transform:translateX(-50%);
      font-family: "Cinzel", serif;
      font-weight:700;
      color:#c33a1d;
      letter-spacing:3px;
      font-size: calc(12px + 1.0vw);
    }

    /* small responsive tweaks */
    @media (max-width:520px){
      .cert-wrap{ max-width:360px; }
      .cert{ padding-top:140%; } /* taller on small screens if needed */
      .recipient{ font-size: calc(18px + 5vw); }
    }
  </style>
</head>
<body>

  <div class="cert-wrap">
    <div class="cert">
      <div class="overlay">
        <!-- Title -->
        <div class="title-main">TAMILNADU SPEED SKATING ASSOCIATION</div>
        <div class="subtitle">Recognized by <strong>SPEED SKATING FEDERATION OF INDIA - S.S.F.I</strong></div>

        <!-- Certificate heading -->
        <div class="cert-heading">CERTIFICATE</div>
        <div class="cert-sub">OF MERIT / PARTICIPATION</div>

        <!-- Awarded to -->
        <div class="awarded">This Certificate is Awarded to</div>

        <!-- Recipient name (exact from sample) -->
        <div class="recipient">Sameera Reedy</div>

        <!-- Member details block (using dots to mimic original) -->
        <div class="member-block">
          <div>Member Id .............................................. Age Category .............................. Gender .............................</div>
          <div style="margin-top:8px;">Representing .............................................. District ....................................................</div>
          <div style="margin-top:10px; font-weight:600;">Club / Academy has participated in 15th TAMILNADU SPEED SKATING CHAMPIONSHIP 2025 Organized by TAMILNADU SPEED SKATING ASSOCIATION TNSSA from 23rd - 26th October at PS Sports arena, Karur and ranked as under</div>
        </div>

        <!-- Results area (left) -->
        <div class="results">
          <div style="margin-bottom:8px;"><strong>SPEED QUAD</strong></div>
          <div><span style="display:inline-block;width:38%;">200M</span><span> - </span><span style="margin-left:8px;">GOLD</span></div>
          <div><span style="display:inline-block;width:38%;">400M</span><span> - </span><span style="margin-left:8px;">SILVER</span></div>
          <div><span style="display:inline-block;width:38%;">RELAY</span><span> - </span><span style="margin-left:8px;">GOLD</span></div>
        </div>

        <!-- Photo placeholder / rounded rectangle -->
        <div class="photo-box" aria-hidden="true"></div>

        <!-- Signatures / names -->
        <div class="sign-row">
          <div class="sign-block" style="text-align:left;">
            <div style="font-family: 'Great Vibes', cursive; font-size:calc(9px + 0.8vw); color:#000;">M. Gowtham</div>
            <div style="margin-top:6px; font-size:calc(7px + 0.3vw); color:#c73b18;">General Secretary</div>
          </div>

          <div style="width:34%; text-align:center;">
            <!-- center logos are part of the background image; nothing needed here -->
          </div>

          <div class="sign-block" style="text-align:right;">
            <div style="font-family: 'Great Vibes', cursive; font-size:calc(9px + 0.8vw); color:#000;">S. Muruganandham</div>
            <div style="margin-top:6px; font-size:calc(7px + 0.3vw); color:#c73b18;">President</div>
          </div>
        </div>

        <!-- Footer small logos (these are in the background image) -->
        <div class="footer-center" aria-hidden="true">
          <!-- intentionally left blank: the background image already contains the logos -->
        </div>

        <div class="footer-year" aria-hidden="true">2025</div>
      </div>
    </div>
  </div>

  <!-- Bootstrap bundle (optional for other interactive use) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

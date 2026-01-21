<?php include '../../config/config.php'; 
$event_id = 22;
$stmt = $pdo->prepare("SELECT s.id,sr.session_id,er.event_id, s.school_name,d.district_name as club_district,e.secretory_sign,e.president_sign,
s.membership_id, s.full_name, s.date_of_birth, ct.cat_name,c.club_name, sr.age, sr.age_category,s.gender,er.payment_id,e.event_name,e.event_image,e.date,e.date1,e.venue,e.association_name,
er.created_at FROM tbl_event_registration er 
LEFT JOIN tbl_skaters s ON er.skater_id = s.id 
LEFT JOIN tbl_events e on e.id=er.event_id
LEFT JOIN tbl_clubs c ON s.club_id = c.id
LEFT JOIN tbl_districts d on d.id=c.district_id
LEFT JOIN tbl_eligible_event_level eel ON eel.id = er.eligible_event_level_id 
LEFT JOIN tbl_category_type ct ON ct.id = eel.category_type_id 
LEFT JOIN tbl_session_renewal sr ON sr.skater_id = s.id AND sr.session_id = er.session_id 
where er.event_id=$event_id limit 10");
$stmt->execute();
$user = $stmt->fetch();
$a=$user;
// $event_date='asdads';
if($a['date']==$a['date1'] || $a['date1']==0000-00-00 ){
    // $event_date = $a['date'];
   $event_date= date("d-m-Y", strtotime($a['date']));
}
else{
    $event_date = date("d-m-Y", strtotime($a['date'])) . ' TO '.date("d-m-Y", strtotime($a['date1']));
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Certificate of Merit / Participation</title>
  <style>
    @font-face {
      font-family: 'Montserrat-Bold';
      src: url('Montserrat-Bold.ttf') format('truetype');
    }
    @font-face {
      font-family: 'Montserrat-SemiBold';
      src: url('Montserrat-SemiBold.ttf') format('truetype');
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Montserrat-SemiBold', sans-serif;
      background-color: #f5f5f5;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      /*padding: 20px;*/
    }
    
    .certificate {
      position: relative;
      width: 297mm;   /* A4 landscape */
      height: 210mm;
      margin: auto;
      /*background: url('template.jpeg') no-repeat center center;*/
      background-size: cover;
      /*border: 15px solid #d4af37;*/
      /*box-sizing: border-box;*/
      /*box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);*/
    }

    /* Top header section */
    .header-text {
      position: absolute;
      top: 22mm;
      left: 50%;
      transform: translateX(-50%);
      text-align: center;
      font-family: 'Montserrat-SemiBold';
      font-size: 12pt;
      line-height: 1.0;
      width: 90%;
    }

    .top-logo {
      max-width: 110mm;
      position: absolute;
      top: 10mm;
      right: 15mm;
      height: 10mm;
    }

    /* Title (Certificate Header Image) */
    .title-img {
      position: absolute;
      top: 60mm;
      left: 50%;
      transform: translateX(-50%);
      width: 135mm;
      height: 23mm;
    }
    
    .title-img-ssfi {
      position: absolute;
      top: 50mm;
      left: 80%;
      transform: translateX(-10%);
      width: 35mm;
      height: 23mm;
    }
    .title-img-district {
      position: absolute;
      top: 50mm;
      left: 10%;
      transform: translateX(-10%);
      width: 33mm;
      height: 27mm;
    }
    .title-img-sign {
      position: absolute;
      top: -40mm;
      left: 8%;
      transform: translateX(-10%);
      width: 50mm;
      height: 20mm;
    }
    .title-img-sign1 {
      position: absolute;
      top: -40mm;
      left: 80%;
      transform: translateX(-10%);
      width: 50mm;
      height: 20mm;
    }

    .subtitle {
      position: absolute;
      top: 75mm;
      left: 50%;
      transform: translateX(-50%);
      font-size: 14pt;
      font-family: 'Montserrat-Bold';
      text-align: center;
    }

    /* Participant Details */
    .content-area {
      position: absolute;
      top: 82mm;
      left: 52%;
      transform: translateX(-50%);
      width: 90%;
      text-align: justify;
      font-size: 12pt;
      font-family: 'Montserrat-SemiBold';
      line-height: 33px;
    }

    .dotted-line {
      display: inline-block;
      border-bottom: 1px dotted #000;
      min-width: 50mm;
      vertical-align: bottom;
    }
    
    .long-dotted-line {
      display: inline-block;
      border-bottom: 1px dotted #000;
      min-width: 100mm;
      vertical-align: bottom;
    }

    /* Event Result Section */
    .results {
      margin-top: 5mm;
      margin-bottom: 20mm;
      font-size: 12pt;
      line-height: 1.6;
      text-align: center;
    }

    .results strong {
      font-family: 'Montserrat-Bold';
    }

    /* Signatures */
  /* Signatures */
.signatures {
  margin-top: 8mm;
  position: absolute;
  bottom: 10mm;
  width: 100%;
  display: flex;
  justify-content: space-between; /* Changed from space-around */
  text-align: center;
  font-size: 11pt;
  font-family: 'Montserrat-SemiBold';
  padding: 0 40px; /* Add padding to keep away from edges */
  box-sizing: border-box;
}

.signature-left {
  text-align: center;
  margin-left: 40px;
}

.signature-right {
  text-align: center;
  margin-right: 40px;
}

.sign-line {
  border-top: 1px solid #000;
  width: 150px;
  margin: 5px 0;
}

    /*.sign-line {*/
    /*  border-top: 1px solid #000;*/
    /*  width: 60mm;*/
    /*  margin: 0 auto 5mm auto;*/
    /*}*/

    /* Footer logos */
    .footer-logos {
    max-width: 20mm;
      position: absolute;
      bottom: 2mm;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      justify-content: center;
      gap: 5mm;
      width: 80%;
    }
    
    .footer-logo {
      height: 15mm;
    }
    
    .print-btn {
      margin-top: 20px;
      padding: 12px 25px;
      background: #d4af37;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-family: 'Montserrat-SemiBold';
      font-size: 16px;
      transition: background 0.3s;
    }
    
    .print-btn:hover {
      background: #b8941f;
    }
    
    @media print {
      body {
        background: none;
        padding: 0;
      }
      
      .print-btn {
        display: none;
      }
    }
    .dashed{
    opacity:100%; 
} 
.bor_v{
    position: absolute;
    font-family: 'Montserrat-SemiBold';
    font-size:12pt;
    margin-top: -10px;text-align: center;
    /*background: #80808042;*/
}
  </style>
  <style>
    @page {
      size: A4 landscape;
      margin: 0mm 0mm 0mm 0mm;
    }

    body {
      margin: 0;
      padding: 0;
    }


    @font-face {
      font-family: 'Montserrat-Bold';
      src: url('certificate-image/Montserrat-Bold.ttf') format('truetype');
    }

    @font-face {
      font-family: 'Montserrat-SemiBold';
      src: url('certificate-image/Montserrat-SemiBold.ttf') format('truetype');
    }

  </style>
</head>
<body style="margin:0px" >
    <pre>
        <!--<?php echo print_r($user,true); ?>-->
    </pre>
  <div class="certificate">
      <img src="template.jpeg" style="width:100%;max-height:209mm;max-width:296mm;"/>
    <!-- Header -->
    <div class="header-text">

      <!--<b><p style="font-size:35px">MADURAI SPEED SKATING ASSOCIATION <small><sup>&reg;</sup></small></p></b><br>-->
      <!--<b><p style="font-size:35px"><?=$a['association_name'];?> <small><sup>&reg;</sup></small></p></b><br>-->
      <!-- HTML -->
            <div style="max-width: 100%; width: fit-content; margin: auto; text-align: center;">
              <p style="
                font-size: clamp(15px, 5vw, 35px); 
                word-wrap: break-word;
                max-width: 100%;
                display: inline-block;
                color:#06038d;
              ">
                <b><?= htmlspecialchars($a['association_name']); ?> <small><sup>&reg;</sup></small></b>
              </p>
            </div>

      <p style="line-height:22px">AFFILIATED TO TAMILNADU SPEED SKATING ASSOCIATION (TNSSA)<br>
      RECOGNIZED BY SPEED SKATING FEDERATION OF INDIA (SSFI)<br>
      IN ASSOCIATION WITH STAIRS FOUNDATION</p>
    </div>
    <img src="top-logo-removebg-preview.png" alt="Top Logo" class="top-logo">

    <!-- Title -->
    <img src="../../<?=$a['event_image']?>" alt="Certificate Title" class="title-img-district">
    <img src="ssfi-main.png" alt="Certificate Title" class="title-img-ssfi">
    <img src="certificate_header_name-removebg-preview.png" alt="Certificate Title" class="title-img">
    <!--<img src="certificate_header_name-removebg-preview.png" alt="Certificate Title" class="title-img">-->
    <!--<div class="subtitle">Certificate of Merit / Participation</div>-->

    <!-- Content -->
    <div class="content-area">
      Member Id : <span> <?=$a['membership_id'];?> </span><br><br>
      This is to certify that <span ><b class="bor_v" style="width: 50%;"><?=strtoupper($a['full_name'])?></b><span class="dashed">................................................................................................................................................................</span> in the Age Category<br>
      <span ><b class="bor_v" style="width: 14%;"><?=strtoupper($a['age_category'])?></b><span class="dashed">........................................</span> has participated in the <span><b class="bor_v" style="width: 60%;font-size: clamp(12px, 5vw, 15px); "><?=strtoupper($a['event_name'])?></b><span class="dashed">.............................................................................................................................................................</span><br>
      held on <span ><b class="bor_v" style="width: 28%;"><?=strtoupper($event_date)?></b><span class="dashed">......................................................................</span> at <span ><b class="bor_v" style="width: 50%;"><?=strtoupper($a['venue'])?></b><span class="dashed">.........................................................................................................................................................</span><br>
      Representing <span ><b class="bor_v" style="width: 45%;"><?=strtoupper($a['club_name'])?></b><span class="dashed">.....................................................................................................................</span> Club <span ><b class="bor_v" style="width: 30%;"><?=strtoupper($a['club_district'])?></b><span class="dashed">.......................................................................................</span><br>
      District <span ><b class="bor_v" style="width: 35%;"><?=strtoupper($a['school_name'])?></b><span class="dashed">...................................................................................................................................</span> School and ranked as under<br>
      
      <div class="results" style="line-height:35px">
        SKATE CATEGORY : <strong style='color:#06038d;'> <?=strtoupper($a['cat_name'])?></strong><br>
        200M – GOLD &nbsp;&nbsp; 400M – SILVER &nbsp;&nbsp; ELIMINATION – BRONZE<br>
        RELAY – GOLD / SILVER / BRONZE / PARTICIPATED / NIL
      </div>
    </div>
<style>
    .bottom-line{
        margin-top:-70px;
    }
</style>
    <!-- Signatures -->
<div class="signatures" >
  <div class="signature-left bottom-line" >
    <img src="../../<?=$a['president_sign']?>" alt="Certificate Title" class="title-img-sign">
    <!--<div class="sign-line"></div>-->
    <!--S. MURUGANANDHAM-->
    <br>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;President
    
  </div>
  <div class="signature-right bottom-line">
    <!--<div class="sign-line"></div>-->
    <img src="../../<?=$a['secretory_sign']?>" alt="Certificate Title" class="title-img-sign1">
    <!--M. GOWTHAM-->
    <br>
    General Secretary
    
  </div>


    <!-- Footer Logos -->
    <div class="footer-logos">
      <img src="bottom-logo1.jpeg" alt="Bottom Logo 1" class="footer-logo bottom-line">
      <img src="bottom-logo2.jpeg" alt="Bottom Logo 2" class="footer-logo bottom-line">
      <img src="bottom-logo3.jpeg" alt="Bottom Logo 3" class="footer-logo bottom-line">
      <img src="bottom-logo4.jpeg" alt="Bottom Logo 3" class="footer-logo bottom-line">
    </div>
    </div>
  </div>

</body>
</html>
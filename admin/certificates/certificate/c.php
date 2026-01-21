<?php 
include '../../config/config.php'; 
error_reporting(E_ALL);
ini_set('display_errors',1);

// $event_id = 18;
$event_id = $_GET['event_id'];
$limit = $_GET['limit'] ?? 10;

$stmt = $pdo->prepare("
    SELECT 
        s.id, sr.session_id, er.event_id, s.school_name, d.district_name as club_district,
        e.secretory_sign, e.president_sign, s.membership_id, s.full_name, s.date_of_birth, 
        ct.cat_name, c.club_name, sr.age, sr.age_category, s.gender, er.payment_id,
        e.event_name, e.event_image, e.date, e.date1, e.venue, e.association_name,s.profile_photo,
        er.created_at ,eel.event_level,er.prize_announcement_place,
        GROUP_CONCAT(DISTINCT eel.event_level ORDER BY eel.event_level SEPARATOR ', ') AS all_event_levels,
    GROUP_CONCAT(DISTINCT er.prize_announcement_place ORDER BY er.prize_announcement_place SEPARATOR ', ') AS prize_places
    FROM tbl_event_registration er 
    LEFT JOIN tbl_skaters s ON er.skater_id = s.id 
    LEFT JOIN tbl_events e ON e.id = er.event_id
    LEFT JOIN tbl_clubs c ON s.club_id = c.id
    LEFT JOIN tbl_districts d ON d.id = c.district_id
    LEFT JOIN tbl_eligible_event_level eel ON eel.id = er.eligible_event_level_id 
    LEFT JOIN tbl_category_type ct ON ct.id = eel.category_type_id 
    LEFT JOIN tbl_session_renewal sr ON sr.skater_id = s.id AND sr.session_id = er.session_id 
    WHERE er.event_id = :event_id
    GROUP BY s.membership_id limit $limit
");
$stmt->execute(['event_id' => $event_id]);
$users = $stmt->fetchAll();


function getPrizeLabel($place) {
    switch ((int)$place) {
        case 1: return "GOLD";
        case 2: return "SILVER";
        case 3: return "BRONZE";
        case 4: return "4TH PLACE";
        case 5: return "5TH PLACE";
        default: return "PARTICIPATED";
    }
}

// Remove any accidental trailing spaces


// echo implode('  ', $output);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Certificates</title>

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
      margin: 0;
      padding: 0;
      background: white;
      overflow: hidden;
    }

    .certificate {
      position: relative;
      width: 297mm;
      height: 210mm;
      background-size: contain;
      page-break-after: always;
      /*margin:30%;*/
    }
    
/*    .certificate {*/
  /*width: 297mm;*/
  /*height: 210mm;*/
/*  width: 1122px;*/
/*  height: 794px;*/
/*  page-break-after: always;*/
/*}*/


    .bor_v {
      position: absolute;
      font-family: 'Montserrat-SemiBold';
      font-size: 12pt;
      margin-top: -10px;
      text-align: center;
      line-height:33px;
    }

    .dashed {
      opacity: 100%;
    }

    .bottom-line {
      margin-top: -60px;
    }

    @page {
      size: A4 landscape;
      margin: 0;
    }
    @page {
      size: A4 landscape;
      margin: 0;
    }


    .header-text {
      position: absolute;
      top: 22mm;
      left: 50%;
      transform: translateX(-50%);
      text-align: center;
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

    .title-img {
      position: absolute;
      top: 55mm;
      left: 50%;
      transform: translateX(-50%);
      width: 135mm;
      height: 23mm;
    }

    .title-img-ssfi {
      position: absolute;
      top: 45mm;
      left: 80%;
      transform: translateX(-10%);
      width: 35mm;
      height: 23mm;
    }

    .title-img-district {
      position: absolute;
      top: 45mm;
      left: 10%;
      transform: translateX(-10%);
      width: 33mm;
      height: 27mm;
    }

    .title-img-sign {
      position: absolute;
      top: -27mm;
      left: 10%;
      transform: translateX(-10%);
      width: 33mm;
      height: 14mm;
    }

    .title-img-sign1 {
      position: absolute;
      top: -27mm;
      left: 83%;
      transform: translateX(-10%);
      width: 33mm;
      height: 14mm;
    }
    .skater-logo {
    position: absolute;
    top: -70mm;
    left: 82%;
    transform: translateX(-10%);
    width: 125px;
    height: 145px;
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

    .content-area {
      position: absolute;
      top: 75mm;
      left: 52%;
      transform: translateX(-50%);
      width: 90%;
      /*text-align: justify;*/
      font-size: 12pt;
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

    .signatures {
      margin-top: 8mm;
      position: absolute;
      bottom: 10mm;
      width: 100%;
      display: flex;
      justify-content: space-between;
      text-align: center;
      font-size: 11pt;
      padding: 0 80px;
      box-sizing: border-box;
    }

    .signature-left,
    .signature-right {
      text-align: center;
    }

    .sign-line {
      border-top: 1px solid #000;
      width: 150px;
      margin: 5px 0;
    }

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

    
    @media print {
  html, body {
    width: 100%;
    height: auto;
    margin: 0 !important;
    padding: 0 !important;
    overflow: hidden !important;
    background: none !important;
  }

  .certificate {
    width: 297mm;
    height: 210mm;
    page-break-after: always;
    background-size: contain;
    /*background-position: center;*/
    margin: 0 !important;
    padding: 0 !important;
  }
}
.certificate {
    position: relative;
    width: 297mm;
    height: 210mm;
    page-break-after: always;
    overflow: hidden;
  }

  .certificate img.bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 297mm;
    height: 210mm;
    object-fit: cover;
    z-index: -1;
  }
    
    
  </style>
</head>
<body onload='print()'>

<?php foreach($users as $a): 
  // Format the event date(s)
  if ($a['date'] == $a['date1'] || $a['date1'] == '0000-00-00') {
    $event_date = date("d-m-Y", strtotime($a['date']));
  } else {
    $event_date = date("d-m-Y", strtotime($a['date'])) . ' TO ' . date("d-m-Y", strtotime($a['date1']));
  }
  
//   if($a['prize_announcement_place']==1){
//       $prize=" GOLD ";
//   }
//   else if($a['prize_announcement_place']==2){
//       $prize=" SILVER ";
//   }
//   else if($a['prize_announcement_place']==3){
//       $prize=" BRONZE ";
//   }
//   else if($a['prize_announcement_place']==4){
//       $prize=" 4th PLACE ";
//   }
//   else if($a['prize_announcement_place']==5){
//       $prize=" 5th PLACE ";
//   }
//   else{
//       $prize=" PARTICIPATED";
//   }
  
?>

<div class="certificate">
  <img src="template.jpeg" style="width:100%;"/>

  <div class="header-text">
    <div style="max-width: 100%; width: fit-content; margin: auto; text-align: center;">
      <p style="font-size: clamp(15px, 5vw, 30px); word-wrap: break-word; color:#06038d;">
        <b><?= htmlspecialchars($a['association_name']); ?> <small><sup>&reg;</sup></small></b>
      </p>
    </div>
    <p style="line-height:22px">
      AFFILIATED TO TAMILNADU SPEED SKATING ASSOCIATION (TNSSA)<br>
      RECOGNIZED BY SPEED SKATING FEDERATION OF INDIA (SSFI)<br>
      IN ASSOCIATION WITH STAIRS FOUNDATION
    </p>
  </div>

  <img src="top-logo-removebg-preview.png" class="top-logo">
  <img src="../../<?= $a['event_image'] ?>" class="title-img-district">
  <img src="ssfi-main.png" class="title-img-ssfi">
  <img src="certificate_header_name-removebg-preview.png" class="title-img">

  <div class="content-area">
    <br>Member Id : <span><?= $a['membership_id']; ?></span><br>
    This is to certify that 
    <b class="bor_v" style="width: 50%;"><?= strtoupper($a['full_name']) ?></b><span class="dashed">...............................................................................................................................................................</span>
    in the Age Category <br>
    <b class="bor_v" style="width: 14%;"><?= strtoupper($a['age_category']) ?></b><span class="dashed">........................................</span> has participated in the 
    <b class="bor_v" style="width: 60%;font-size: clamp(12px, 5vw, 15px);"><?= strtoupper($a['event_name']) ?></b><span class="dashed">.............................................................................................................................................................</span><br>
    held on 
    <b class="bor_v" style="width: 28%;"><?= strtoupper($event_date) ?></b><span class="dashed">......................................................................</span> at 
    <b class="bor_v" style="width: 50%;"><?= strtoupper($a['venue']) ?></b><span class="dashed">.........................................................................................................................................................</span><br>
    Representing 
    <b class="bor_v" style="width: 45%;"><?= strtoupper($a['club_name']) ?></b><span class="dashed">.....................................................................................................................</span> Club 
    <b class="bor_v" style="width: 30%;"><?= strtoupper($a['club_district']) ?></b><span class="dashed">.......................................................................................</span><br>
    District 
    <b class="bor_v" style="width: 35%;"><?= strtoupper($a['school_name']) ?></b><span class="dashed">...................................................................................................................................</span> School and ranked as under

    <?php 
    $event_levels = explode(',', $a['all_event_levels']);
    $prize_places = explode(',', $a['prize_places']);

    $output = [];

    for ($i = 0; $i < count($event_levels); $i++) {
    $event = strtoupper(trim($event_levels[$i]));
    $place = isset($prize_places[$i]) ? trim($prize_places[$i]) : 0;
    $label = getPrizeLabel($place);
    $output[] = "$event - $label";
    }
    ?>

    <div class="results" style="line-height:35px;padding-right: 250px;">
      SKATE CATEGORY : <strong style='color:#06038d;'> <?= strtoupper($a['cat_name']) ?></strong><br>
      <!--200M – GOLD &nbsp;&nbsp; 400M – SILVER &nbsp;&nbsp; ELIMINATION – BRONZE<br>-->
      <!--<.?= strtoupper($event_levels).' - '.strtoupper($prize_labels)?> <br>-->
      <p style="font-size: clamp(10px, 3vw, 16px); word-wrap: break-word;"><?= implode(' , ', $output);?></p> 
      <!--<br>-->
      RELAY – GOLD / SILVER / BRONZE / PARTICIPATED / NIL
    </div>
  </div>

  <div class="signatures">
    <div class="signature-left bottom-line">
      <img src="../../<?= $a['president_sign'] ?>" class="title-img-sign"><br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;President
    </div>
    
    <div class="signature-right bottom-line">
      <img src="../../<?= $a['secretory_sign'] ?>" class="title-img-sign1"><br>
      General Secretary
    </div>
    
<?php
$file = $a['profile_photo'] ?? '';
$fullPath = __DIR__ . "/../../" . $file; // adjust path if needed

if ($file && file_exists($fullPath)) {
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

    if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
        echo '<img src="../../' . $file . '" class="skater-logo">';
    } elseif ($ext === 'pdf') {
        // show inline PDF
        echo '<embed src="../../' . $file . '" type="application/pdf" class="skater-logo" width="150" height="150">';
    }
}
?>


    <!--<img src="../../<?= $a['profile_photo'] ?>" class="skater-logo">-->

    <div class="footer-logos">
      <img src="bottom-logo1.jpeg" class="footer-logo bottom-line">
      <img src="bottom-logo2.jpeg" class="footer-logo bottom-line">
      <img src="bottom-logo3.jpeg" class="footer-logo bottom-line">
      <img src="bottom-logo4.jpeg" class="footer-logo bottom-line">
    </div>
  </div>
</div>

<?php endforeach; ?>

</body>
</html>

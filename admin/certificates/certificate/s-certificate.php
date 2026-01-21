<?php 
include '../../config/config.php'; 


function formatName($name) {
    $name = trim((string)$name);
    if ($name === '') return '';

    // Convert whole string to lowercase first
    $name = strtolower($name);

    // Split by dot to detect initials
    $parts = array_map('trim', explode('.', $name));

    foreach ($parts as $k => $part) {
        // Capitalizes first letter of each word in that segment
        $parts[$k] = ucwords($part);
    }

    // Join back with dot
    $formatted = implode('.', $parts);

    // Fix extra dots and spaces
    $formatted = preg_replace('/\.+/', '.', $formatted);
    $formatted = preg_replace('/\s+/', ' ', $formatted);

    return trim($formatted);
}



error_reporting(E_ALL);
ini_set('display_errors',1);

// $event_id = 18;
$event_id = $_GET['event_id'];
$limit = $_GET['limit'] ?? '0,100';

$districtId = $_GET['districtId'] ?? 0;

$where='';

if($districtId!=0 && $districtId!=''){
    $where = " and s.district_id=".$districtId;
}

$stmt = $pdo->prepare("
    SELECT 
        s.id, sr.session_id, er.event_id, s.school_name, d.district_name as club_district,
        e.secretory_sign, e.president_sign, s.membership_id, s.full_name, s.date_of_birth, 
        ct.cat_name, c.club_name, sr.age, sr.age_category, s.gender, er.payment_id,
        e.event_name, e.event_image, e.date, e.date1, e.venue, e.association_name,s.profile_photo,
        er.created_at ,eel.event_level,er.prize_announcement_place,
        GROUP_CONCAT(eel.event_level  SEPARATOR ', ') AS all_event_levels,
    GROUP_CONCAT(er.prize_announcement_place  SEPARATOR ', ') AS prize_places,
    GROUP_CONCAT(er.is_present  SEPARATOR ', ') AS is_present
    FROM tbl_event_registration er 
    LEFT JOIN tbl_skaters s ON er.skater_id = s.id 
    LEFT JOIN tbl_events e ON e.id = er.event_id
    LEFT JOIN tbl_clubs c ON s.club_id = c.id
    LEFT JOIN tbl_districts d ON d.id = c.district_id
    LEFT JOIN tbl_eligible_event_level eel ON eel.id = er.eligible_event_level_id 
    LEFT JOIN tbl_category_type ct ON ct.id = eel.category_type_id 
    LEFT JOIN tbl_session_renewal sr ON sr.skater_id = s.id AND sr.session_id = er.session_id 
    WHERE er.event_id = :event_id $where
    GROUP BY s.membership_id limit $limit
");
$stmt->execute(['event_id' => $event_id]);
$users = $stmt->fetchAll();


function getPrizeLabel($place) {
    switch ((int)$place) {
        case 1: return "GOLD";
        case 2: return "SILVER";
        case 3: return "BRONZE";
        case 4: return "FOURTH PLACE";
        case 5: return "FIFTH PLACE";
        default: return "PARTICIPATED";
    }
}

function getPresent($place1) {
    switch ((int)$place1) {
        case 1: return "True";
        default: return "False";
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
  font-family: 'Airstrike';
  src: url('airstrike.ttf') format('truetype');
  /* optionally: font-weight, font-style */
}

.skater_name {
  /*font-family: 'Airstrike', sans-serif;*/
  font-family: 'Montserrat-Bold', sans-serif;
  /*font-size: 6mm;*/
   position: absolute;
      /*font-family: 'Montserrat-SemiBold';*/
      /*font-size: 12pt;*/
      font-size: 15pt;
      margin-top: -10px;
      text-align: center;
      line-height:33px;
}



    @font-face {
      font-family: 'Montserrat-SemiBold';
      src: url('Montserrat-SemiBold.ttf') format('truetype');
    }
    
    
@font-face {
    font-family: 'Niconne';
    src: url('state-certificate-img/Niconne-Regular.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
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
      width: 210mm;
      height: 297mm;
      background-size: contain;
      page-break-after: always;
      /*margin:30%;*/
    }


    .bor_v {
      position: absolute;
      font-family: 'Montserrat-SemiBold';
      font-size: 12pt;
      margin-top: -2px;
      text-align: center;
      line-height:31px;
    }

    .dashed {
      opacity: 100%;
    }

    .bottom-line {
      margin-top: -60px;
    }

    @page {
      size: A4;
      margin: 0;
    }
    @page {
      size: A4;
      margin: 0;
    }


    .header-text {
      position: absolute;
      top: 50mm;
      left: 50%;
      transform: translateX(-50%);
      text-align: center; 
      font-size: 12pt;
      line-height: 1.0;
      width: 90%;
    }
    .header-logos {
      position: absolute;
      top: 35mm;
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
      width: 45mm;
      height: 30mm;
    }

    /*.title-img-district {*/
  
    .title-img-district {
    position: absolute;
    top: 45mm;
    left: 10%;
    transform: translateX(-10%);
    max-width: 47mm;
    max-height: 35mm;
    min-width: 30mm;
    min-height: 30mm;
    width: auto;
    height: auto;
    object-fit: contain;
    overflow: hidden;
}


    .title-img-sign {
      position: absolute;
      top: -30mm;
      left: 32px;
      transform: translateX(-10%);
     width: 41mm;
    height: 15mm;
    }

    .title-img-sign1 {
      position: absolute;
      top: -32mm;
      left: 76%;
      transform: translateX(-10%);
      width: 44mm;
      height: 17mm;
    }
    .skater-logo {
       position: absolute;
    top: -65mm;
    left: 80%;
    transform: translateX(7%);
    width: 104px;
    height: 114px;
}



.skater-logo-seal {
    position: absolute;
    top: -75mm;
    left: 70%;
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
      top: 132mm;
      left: 50%;
      transform: translateX(-50%);
      width: 90%;
      /*text-align: justify;*/
      font-size: 12pt;
      line-height: 40px;
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
      bottom: 20mm;
      width: 100%;
      display: flex;
      justify-content: space-between;
      text-align: center;
      font-size: 11px;
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
      bottom: 18mm;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      justify-content: center;
      gap: 5mm;
      width: 80%;
    }
    .footer-text {
      max-width: 20mm;
      position: absolute;
      bottom: 0mm;
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
    
    .header-logo {
      height: 20mm;
      padding-left:5mm;
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
    width: 210mm;
    height: 297mm;
    page-break-after: always;
    background-size: contain;
    /*background-position: center;*/
    margin: 0 !important;
    padding: 0 !important;
  }
}
.certificate {
    position: relative;
    width: 210mm;
    height: 297mm;
    page-break-after: always;
    overflow: hidden;
  }

  .certificate img.bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 210mm;
    height: 297mm;
    object-fit: cover;
    z-index: -1;
  }
  .category{
      display:flex;
      justify-content:space-around;
      align-items: center;
  }
    
  </style>
</head>
<body onload='print()'>
<!--<body >-->
<?php foreach($users as $a): 
  // Format the event date(s)
  if ($a['date'] == $a['date1'] || $a['date1'] == '0000-00-00') {
    $event_date = date("d-m-Y", strtotime($a['date']));
  } else {
    $event_date = date("d-m-Y", strtotime($a['date'])) . ' TO ' . date("d-m-Y", strtotime($a['date1']));
  }
?>

<div class="certificate">
  <img src="state-certificate-img/bgs-3.png" style="width:210mm;"/>
    
    <?php
$ass_name = strtoupper($a['association_name']);
$font_size_ass = (strlen($ass_name) > 40) ? '25px' : 'inherit';
?>


<?php
$school_name = strtoupper($a['school_name']);
$font_size = (strlen($school_name) > 35) ? '12px' : 'inherit';

$parts = explode('/', $a['membership_id']);
$ms=strtoupper(end($parts));
?>


  <div class="content-area">
      <center style="padding-bottom:3mm;">
        <b style="font-family: 'Niconne', cursive;font-size: 48px;color:#06038d"><?= (formatName($a['full_name'])) ?></b>
      </center>
      
    Member Id : 
        <b class="bor_v" style="width: 18%;color:#06038d;"><?= strtoupper($ms) ?></b><span class="dashed">.................................</span>
        in the Age Category 
    <b class="bor_v" style="width: 20%;color:#06038d;"><?= strtoupper($a['age_category']) ?></b><span class="dashed">...................................</span>
    Gender
    <b class="bor_v" style="width: 14%;color:#06038d;"><?= strtoupper($a['gender']) ?></b><span class="dashed">........................</span><br>
    Representing 
    <b class="bor_v" style="width: 75%;color:#06038d;"><?= strtoupper($a['club_district']) ?></b><span class="dashed">........................................................................................................................................</span>District<br>
     
    <b class="bor_v" style="width: 80%;color:#06038d;"><?= strtoupper($a['club_name']) ?></b><span class="dashed">.................................................................................................................................................</span>
    Club / Academy <br> has participated in 15th TAMILNADU SPEED SKATING CHAMPIONSHIP 2025 from 23rd - 26th
    October at PS Sports Arena, Karur and ranked as under
    
    

    <?php 
    $event_levels = explode(',', $a['all_event_levels']);
    $prize_places = explode(',', $a['prize_places']);
    $present = explode(',', $a['is_present']);

    $output = [];

    for ($i = 0; $i < count($event_levels); $i++) {
    $event = strtoupper(trim($event_levels[$i]));
    $place = isset($prize_places[$i]) ? trim($prize_places[$i]) : 0;
    $place1 = isset($present[$i]) ? trim($present[$i]) : 0;
    $label1 = getPresent($place1);
    
    if($label1=="True"){
    $label = getPrizeLabel($place);
    $output[] = "$event - $label";
    }else if($label1=="False"){
    $label = 'NIL';
    $output[] = "$event - $label";
    }
    
    
    $count_check_output = strtoupper(implode(' <br> ', $output));
$font_size_output = (strlen($count_check_output) > 55) ? '14px' : 'inherit';
    }
    ?>
    <div class="category" style="width: 150mm;margin-top: -1mm;">
         
        <div>
            <strong style='color:#06038d;'> <?= strtoupper($a['cat_name']) ?></strong>
        </div>
        <div>
     
        </div>
         
        <div>
            <?= $count_check_output;?>
                 
        </div>
        
    </div>
    <div style="padding-left: 50px;">
         RELAY – GOLD / SILVER / BRONZE / PARTICIPATED / NIL   
    </div>

  </div>

  <div class="signatures">
      
    <div class="signature-left bottom-line">
      <!--<img src="../../<?= $a['secretory_sign'] ?>" class="title-img-sign"><br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
    </div>
    
    <div class="signature-right bottom-line">
      <!--<img src="../../<?= $a['president_sign'] ?>" class="title-img-sign1"><br>-->
      
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

  </div>
</div>

<?php endforeach; ?>

</body>
</html>

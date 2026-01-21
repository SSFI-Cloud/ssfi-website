<?php
include("../admin/config/config.php");

$id = $_GET["id"] ?? 3;

$statement = $pdo->prepare("SELECT sk.*, sr.order_id as transaction_id, p.amount as amounts, c.club_name, ct.cat_name, d.district_name
FROM tbl_skaters sk
LEFT JOIN tbl_session_renewal sr ON sk.id = sr.skater_id
LEFT JOIN payments p ON p.order_id = sr.order_id
LEFT JOIN tbl_clubs c ON c.id = sk.club_id
LEFT JOIN tbl_category_type ct ON ct.id = sk.category_type_id
LEFT JOIN tbl_districts d ON d.id = sk.district_id
WHERE sk.id = ? AND sr.session_id IN (SELECT id FROM tbl_session WHERE is_active = 1)");

$statement->execute([$id]);
$result = $statement->fetch(PDO::FETCH_ASSOC);

// Image move logic
$profileImageName = basename($result['profile_photo']);
$remoteImageUrl = "http://ssfibharatskate.com/admin/uploads/" . $profileImageName;
$geniusServerPath = "/home/geniusgroove/public_html/ssfi_image/profile_photos/";
$geniusPublicUrl = "https://geniusgroove.in/ssfi_image/profile_photos/";
$finalImagePath = $geniusServerPath . $profileImageName;
$finalImageUrl = $geniusPublicUrl . $profileImageName;

if (!file_exists($finalImagePath)) {
    $img = @file_get_contents($remoteImageUrl);
    if ($img !== false) {
        @file_put_contents($finalImagePath, $img);
    } else {
        $finalImageUrl = $geniusPublicUrl . "default.jpg";
    }
}

// Send selected data
$postData = [
    'skater_name'        => $result['skater_name'],
    'father_name'        => $result['father_name'],
    'date_of_birth'      => $result['date_of_birth'],
    'club_name'          => $result['club_name'],
    'gender'             => $result['gender'],
    'blood_group'        => $result['blood_group'],
    'mobile_number'      => $result['mobile_number'],
    'email_address'      => $result['email_address'],
    'residential_address'=> $result['residential_address'],
    'membership_id'      => $result['membership_id'],
    'cat_name'           => $result['cat_name'],
    'district_name'      => $result['district_name'],
    'created_at'         => $result['created_at'],
    'transaction_id'     => $result['transaction_id'] ?? 'without payment',
    'amounts'            => $result['amounts'],
    'profile_photo'      => $remoteImageUrl
];

// Send to GeniusGroove
$ch = curl_init("https://geniusgroove.in/ssfi_image/confirmation_certificate.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode == 200 && $response) {
    header("Content-Type: application/pdf");
    header("Content-Disposition: attachment; filename=Skater_Certificate_".$result['membership_id'].".pdf");
    echo $response;
} else {
    echo "PDF generation failed.";
}
?>

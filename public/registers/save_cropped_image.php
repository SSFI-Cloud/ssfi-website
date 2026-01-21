<?php
if (isset($_POST["image"])) {
    $data = $_POST["image"];
    $image_parts = explode(";base64,", $data);
    $image_base64 = base64_decode($image_parts[1]);
    
    $fileName = "uploads/cropped_" . time() . ".png";
    file_put_contents($fileName, $image_base64);
    
    echo json_encode(["status" => "success", "file" => $fileName]);
}
?>

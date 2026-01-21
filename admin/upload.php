<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uploadDir = "uploads/";
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = uniqid() . ".png"; 
    $filePath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['croppedImage']['tmp_name'], $filePath)) {
        echo "uploads/" . $fileName;
    } else {
        echo "Failed to upload image.";
    }
} else {
    echo "No image received.";
}
?>

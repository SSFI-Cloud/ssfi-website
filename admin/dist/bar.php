<?php
// Set barcode data
$data = $_GET['code']; // Example barcode text


// Barcode patterns for Code 128
$code128 = [
    '11011001100', '11001101100', '11001100110', '10010011000', '10010001100', '10001001100', 
    '10011001000', '10011000100', '10001100100', '11001001000', '11001000100', '11000100100',
    '10110011100', '10011011100', '10011001110', '10111001100', '10011101100', '10011100110',
    '11001110010', '11001011100', '11001001110', '11011100100', '11001110100', '11101101110',
    '11010000100', '11010010000', '11010011100'
];

// Start Code 128 with Start Code B (11010010000)
$barcodePattern = '11010010000';

// Convert each character to barcode pattern
for ($i = 0; $i < strlen($data); $i++) {
    $char = ord($data[$i]) - 32; // Convert ASCII to Code 128 index
    $barcodePattern .= $code128[$char % count($code128)];
}

// Add Stop Code (1100011101011)
$barcodePattern .= '1100011101011';

// Image dimensions
$barWidth = 4; // Increased width to make barcode bold
$height = 80;
$width = strlen($barcodePattern) * $barWidth;

// Create an image with a transparent background
$image = imagecreatetruecolor($width, $height);
imagealphablending($image, false);
imagesavealpha($image, true);
$transparent = imagecolorallocatealpha($image, 255, 255, 255, 127); // Transparent background
imagefill($image, 0, 0, $transparent);

// Colors
$black = imagecolorallocate($image, 0, 0, 0);

// Draw the barcode with bold lines
$x = 10;
for ($i = 0; $i < strlen($barcodePattern); $i++) {
    if ($barcodePattern[$i] == '1') {
        imagefilledrectangle($image, $x, 5, $x + $barWidth - 1, $height - 5, $black);
    }
    $x += $barWidth;
}

// Output PNG with transparency
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
?>

<?php 
ob_start();
use Dompdf\Dompdf;
use Dompdf\Options;

require_once 'pdf/autoload.inc.php';

ini_set('memory_limit', '-1');

// Enable remote content like external images
$options = new Options();
$options->set('isRemoteEnabled', true);
$options->set('chroot', realpath(__DIR__ . '/../../')); // Allow access to root folder (for admin images)

$dompdf = new Dompdf($options);
include 'event_confirmation_certificate.php'; // Make sure this file uses full image URLs
$htmldata = ob_get_clean();

// Load the HTML into Dompdf
$dompdf->loadHtml($htmldata);

// Set paper size
$dompdf->setPaper("A4", "portrait");

// Render the PDF
$dompdf->render();

// Set a download filename
$download_name = $download_name ?? 'document';

// Stream the file (set Attachment to false for inline view)
$dompdf->stream($download_name . '.pdf', array("Attachment" => true));
exit;
?>

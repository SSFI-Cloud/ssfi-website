<?php 
/*namespace Dompdf;
require_once 'pdf/autoload.inc.php';
ini_set('memory_limit', '-1');
$htmldata='';


include 'confirmation_certificate.php';

$dompdf = new Dompdf(); 
$dompdf->loadHtml($htmldata);
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
    $dompdf->setOptions($options); 
    $dompdf->set_paper("A4", "portrait");
$dompdf->render();
$dompdf->stream($download_name.'.pdf',array("Attachment" => true));
exit(0);*/

namespace Dompdf;
require_once 'pdf/autoload.inc.php';
ini_set('memory_limit', '-1');

ob_start();
include 'club_confirmation_certificate.php';
$htmldata = ob_get_clean();

use Dompdf\Dompdf;

$dompdf = new Dompdf(); 
$dompdf->loadHtml($htmldata);

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->setPaper("A4", "portrait");
$dompdf->render();

// Set a default download name if not set
$download_name = $download_name ?? 'document';

$dompdf->stream($download_name . '.pdf', array("Attachment" => true));
exit;
?>
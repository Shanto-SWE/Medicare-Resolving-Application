<?php


require '../../vendor/autoload.php';
use Dompdf\Dompdf;






session_start();
$adminid = $_SESSION['user_id'];

if (!isset($_SESSION["user_id"])) {
    header("location:logout.php");
}
require_once './classes/Server.php';
$result = '';
$result2 = '';
$delete = '';
$change = '';
$data ='';
$data2 ='';


$server = new Server();

$data = $server->viewData();

if (isset($_POST['show'])) {
    $data = $server->viewInvoiceprint($_POST);
    $data2 = $server->viewInvoiceprint2($_POST);
    $result = $server->viewDescriptionprint($_POST);
}

$dompdf = new Dompdf();
ob_start();
require('print-details.php');
$html =ob_get_contents();
ob_get_clean();

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('print-details.pdf',['Attachment'=>false]);
?>

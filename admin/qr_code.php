<?php
// Include Composer's autoloader
require_once 'vendor/autoload.php'; // Automatically load all dependencies

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

// Data for QR code
$qrText = "Senior Citizen ID: 12345\nName: John Doe\nMobile: +639123456789";

// Filename where QR will be saved
$qrFilename = 'qrcodes/senior_sample.png';

// Create QR code instance
$qrCode = new QrCode($qrText);

// Create the qrcodes directory if it doesn't exist
if (!is_dir('qrcodes')) {
    mkdir('qrcodes', 0777, true);
}

// Create a writer
$writer = new PngWriter();

// Generate and save the QR code to the specified file
$result = $writer->write($qrCode);
$result->saveToFile($qrFilename); // Write the QR code to a file

?>

<div class="container" style="text-align: center; margin-top: 50px;">
    <h2>QR Code Generated</h2>
    <p>Below is your qr code</p>

    <img src="<?= $qrFilename ?>" alt="QR Code" class="img-fluid" style="max-width: 300px;">

    <br><br>
    <a href="<?= $qrFilename ?>" download="Senior_Citizen_QR.png" class="btn btn-success btn-flat">Download QR Code</a>
</div>
<?php

define('FPDF_FONTPATH', 'font/');
include_once('ufpdf.php');

$pdf = new UFPDF();
$pdf->Open();
$pdf->SetTitle("UFPDF is Cool.\nŨƑƤĐƒ ıš ČŏōĹ");
$pdf->SetAuthor('Steven Wittens');
$pdf->AddFont('AdobeNaskhMedium', '', 'AdobeNaskh-Medium.otf');
$pdf->AddPage();
$pdf->SetFont('AdobeNaskhMedium', '', 32);
$pdf->Write(12, "جورج");
$pdf->Write(12, "ŨƑƤĐƒ");
$pdf->Write(12, "ıš ČŏōĹ.\n");
$pdf->Close();
$pdf->Output('unicode.pdf', 'F');

?>
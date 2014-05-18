<?php

include_once './fpdf.php';
class PDF extends FPDF
{
    function Header()
    {
        // Logo
        $this->Image('Ebla_logo.png',90,10,30);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        
        // Line break
        $this->Ln(20);
    }
}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$string = 'عرض رقم السطر';
$string = utf8_decode($string);
for($i=1;$i<=40;$i++){
    $pdf->Cell(0,10,$string.$i,0,1);
}
$pdf->Output();
?>
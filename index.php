<?Php
require('fpdf/fpdf.php');
$pdf = new FPDF(); 
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->SetX(50); // abscissa or Horizontal position
$pdf->Cell(60,10,'This is Cell - Welcome to plus2net.com',1,1,'L',false);
$pdf->Ln(40); // Line gap
$pdf->SetX(50); // abscissa of Horizontal position 
$pdf->MultiCell(60,10,'This is MultiCell - Welcome to plus2net.com','LRTB','L',false);

$pdf->Image('https://i.redd.it/6d1wfh2tknz81.jpg', 50, 100,100,100  );
$pdf->Output('my_file.pdf','I'); // send to browser and display
?>
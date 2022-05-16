<?Php
require('fpdf/fpdf.php');
require_once('fpdi/src/autoload.php');

 $pdf = new \setasign\Fpdi\Fpdi();
$pdf->AddPage();
// set the source file
$pdf->setSourceFile('plantilla.pdf');
// import page 1
$tplIdx = $pdf->importPage(1);
// use the imported page and place it at position 10,10 with a width of 100 mm
$pdf->useTemplate($tplIdx);
$url ='https://png.pngtree.com/png-clipart/20220221/original/pngtree-router-logo-replacement-effect-prototype-png-image_7279631.png'; 
$image_name ='http://'.$_SERVER['SERVER_NAME'].'/fpdf/rotate.php&url=' . $url;  
$imagesize = getimagesize(curl_get_contents($image_name));
// 
$pdf->SetFont('Helvetica');
$pdf->SetXY(30, 30);
 $pdf->Cell(60,10,json_encode($imagesize),1,1,'L',false);
   
// // Load image file 
// $image = imagecreatefromfile($image_name);  
  
// // Use imagerotate() function to rotate the image
// $img = imagerotate($image, 180, 0);
// imagepng($img, "myUpdateImage.png");

$cords =  getCords2($image_name, 10, 89,69,43  );
$pdf->Image($image_name,$cords[0], $cords[1],$cords[2],$cords[3]  );
$pdf->Output('I', 'generated.pdf');




// $pdf = new FPDF(); 
// $pdf->AddPage();
// $pdf->SetFont('Arial','B',16);
// $pdf->SetX(50); // abscissa or Horizontal position
// $pdf->Ln(40); // Line gap
// $pdf->SetX(50); // abscissa of Horizontal position 
// $pdf->MultiCell(60,10,'This is MultiCell - Welcome to plus2net.com','LRTB','L',false);

// $pdf->Image('https://i.redd.it/6d1wfh2tknz81.jpg', 50, 100,100,100  );
function curl_get_contents($url)
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}
 function getCords($url, $x, $y, $width, $height){
    $imagesize = getimagesize($url);
    $imageW =  $imagesize[0];
    $imageH = $imagesize[1];
    $factorW  = intdiv($imageW, $width);
    $factorH = intdiv($imageH, $height);
    $factor = ($factorH>$factorW)?$factorH:$factorW;
    $factor++;
    $newW = $imageW/$factor;
    $newH = $imageH/$factor;
    $margenW= ($width-$newW)/2;
    $margenH =  ($height-$newH)/2;
    $newX = $x + $margenW;
    $newY = $y + $margenH;
    return array( $newX, $newY, $newW, $newH);
    
 }
 function getCords2($url, $x, $y, $width, $height){
    $imagesize = getimagesize($url);
    $factor = (intdiv($imagesize[1], $height)>intdiv($imagesize[0], $width))?intdiv($imagesize[1], $height):intdiv($imagesize[0], $width);
    $factor++;
    $newW = $imagesize[0]/$factor;
    $newH = $imagesize[1]/$factor;
    $newX = $x +(($width-$newW)/2);
    $newY = $y + (($height-$newH)/2);
    return array( $newX, $newY, $newW, $newH);
    
 }
//  function imagecreatefromfile( &$filename ) {
//     /* if (!file_exists($filename)) {
//         throw new InvalidArgumentException('File "'.$filename.'" not found.');
//     } <== This needs addiotional checks if using non local picture */
//     // var_dump ( strtolower( array_pop( explode('.', substr($filename, 0, strpos($filename, '?'))))) );
//     switch ( strtolower( array_pop( explode('.', substr($filename, 0, strpos($filename, '?'))))) ) {
        
//         case 'jpeg':
//         case 'jpg':
//             return imagecreatefromjpeg($filename);
//         break;

//         case 'png':
//             return imagecreatefrompng($filename);
//         break;

//         case 'gif':
//             return imagecreatefromgif($filename);
//         break;

//         default:
//             throw new InvalidArgumentException('File "'.$filename.'" is not valid jpg, png or gif image.');
//         break;
//     }
// }
?>
<?php
    $filename =  $_GET['url'];
    $imagesize = getimagesize($filename);
    $mime = explode('/',  $imagesize['mime']);
    $tipo = $mime[1];
     switch ( $tipo) {
        case 'jpeg':
        case 'jpg':
            $image = imagecreatefromjpeg($filename);
        break;

        case 'png':
            
            $image = imagecreatefrompng($filename);
        break;
     }
    $grados =  ($imagesize[0]<$imagesize[1]) ? 90:0;  
    $img = imagerotate($image, $grados, 0);
    header("Content-type: image/png"); 
    imagepng($img); 
  
    ?> 
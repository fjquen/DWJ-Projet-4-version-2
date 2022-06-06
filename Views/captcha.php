<?php
   session_start();
   $code=rand(1000,9999);
   $_SESSION["code"]=$code;
   $image = imagecreatetruecolor(90, 44);
   $background = imagecolorallocate($image, 245, 73, 73); 
   $forground = imagecolorallocate($image, 255, 255, 255);
   imagefill($image, 0, 0, $background);
   imagestring($image, 15, 28, 15,  $code, $forground);
  header("Cache-Control: no-cache, must-revalidate");
  header('Content-type: image/png');
  imagepng($image);
  imagedestroy($image);
?>
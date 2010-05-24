<?php

include_once('../../../wp-config.php');

$imagesoptimizer_options = imagesoptimizer_get_options();

$url = $imagesoptimizer_options['settings_watermark'];

if (!empty($_GET['preview']) && !empty($_GET['image'])) {
    list ($a,$b) = explode("wp-content/", urldecode($_GET['image']));
    $origimage = ABSPATH.'wp-content/'.$b;
    
    $size = getimagesize($origimage); 
    if ($size['mime'] == 'image/jpeg')
      $image = imagecreatefromjpeg($origimage);  
    if ($size['mime'] == 'image/png')
      $image = imagecreatefrompng($origimage); 
    if ($size['mime'] == 'image/gif')
      $image = imagecreatefromgif($origimage); 
     
    header('Content-type: '.$size['mime']);
     
    $image = add_watermark($image,$url,ABSPATH.PLUGINDIR.'/imagesoptimizer/font/font.ttf');
    
    if ($size['mime'] == 'image/jpeg')
      imagejpeg($image, NULL, 100);  
    if ($size['mime'] == 'image/png')
      imagepng($image, NULL, 1);  
    if ($size['mime'] == 'image/gif')
      imagegif($image, NULL);  
    imagedestroy($image);  
    
    die();
}

if (!empty($_POST['image'])) {
    list ($a,$b) = explode("wp-content/", urldecode($_POST['image']));
    $origimage = ABSPATH.'wp-content/'.$b;
    
    $size = getimagesize($origimage); 
    if ($size['mime'] == 'image/jpeg')
      $image = imagecreatefromjpeg($origimage);  
    if ($size['mime'] == 'image/png')
      $image = imagecreatefrompng($origimage); 
    if ($size['mime'] == 'image/gif')
      $image = imagecreatefromgif($origimage); 
     
    $image = add_watermark($image,$url,ABSPATH.PLUGINDIR.'/imagesoptimizer/font/font.ttf');
    
    if ($size['mime'] == 'image/jpeg')
      imagejpeg($image, $origimage, 100);  
    if ($size['mime'] == 'image/png')
      imagepng($image, $origimage, 1);  
    if ($size['mime'] == 'image/gif')
      imagegif($image, $origimage);  
    imagedestroy($image);  
}

if (!empty($_POST['thumbnail'])) {
    list ($a,$b) = explode("wp-content/", urldecode($_POST['thumbnail']));
    $origimage = ABSPATH.'wp-content/'.$b;
    
    $size = getimagesize($origimage); 
    if ($size['mime'] == 'image/jpeg')
      $image = imagecreatefromjpeg($origimage);  
    if ($size['mime'] == 'image/png')
      $image = imagecreatefrompng($origimage); 
    if ($size['mime'] == 'image/gif')
      $image = imagecreatefromgif($origimage); 
     
    $image = add_watermark_th($image,$url,ABSPATH.PLUGINDIR.'/imagesoptimizer/font/font.ttf');
    
    if ($size['mime'] == 'image/jpeg')
      imagejpeg($image, $origimage, 100);  
    if ($size['mime'] == 'image/png')
      imagepng($image, $origimage, 1);  
    if ($size['mime'] == 'image/gif')
      imagegif($image, $origimage);  
    imagedestroy($image);  
}

function add_watermark($img, $text, $font, $r = 161, $g = 161, $b = 161, $alpha = 50)
{
   $width = imagesx($img);
   $height = imagesy($img);

   $text = " ".$text." ";
 
   $c = imagecolorallocatealpha($img, $r, $g, $b, $alpha);
   
   if ($height >= $width) $miny = 10; else $miny = 30;
   $minx = round(strlen($text) * 180 / 15);
   
   imagettftext($img,22,  45, $width - $minx, $height - $miny, $c, $font, $text);
   return $img;
}

function add_watermark_th($img, $text, $font, $r = 161, $g = 161, $b = 161, $alpha = 50)
{
   $width = imagesx($img);
   $height = imagesy($img);

   $text = " ".$text." ";
 
   $c = imagecolorallocatealpha($img, $r, $g, $b, $alpha);
   
   if ($height >= $width) $miny = 10; else $miny = 30;
   $minx = round(strlen($text) * 130 / 15);
   
   imagettftext($img,18, 45, $width - $minx, $height - 5, $c, $font, $text);
   return $img;
}
  
  
_e('Done', 'imagesoptimizer');
?>
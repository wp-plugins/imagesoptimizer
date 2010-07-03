<?php

include_once('../../../wp-config.php');

$imagesoptimizer_options = imagesoptimizer_get_options();

$url = $imagesoptimizer_options['settings_watermark'];

if ($_GET['preview'] == 2) {
    $origimage = ABSPATH.PLUGINDIR.'/imagesoptimizer/img/devushka.jpg';
    
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

function add_watermark($img, $text, $font)
{
    global $imagesoptimizer_options;
    
    $width  = imagesx($img);
    $height = imagesy($img);

    $text   = " ".$text." ";
    
    list($t1,$t2,$t3) = explode(",", $imagesoptimizer_options['settings_watermark_textcolor']);
    list($b1,$b2,$b3) = explode(",", $imagesoptimizer_options['settings_watermark_border1color']);
    list($d1,$d2,$d3) = explode(",", $imagesoptimizer_options['settings_watermark_border2color']);
   
    $border1    = imagecolorallocatealpha($img, $b1,$b2,$b3,$imagesoptimizer_options['settings_watermark_alpha']);
    $border2    = imagecolorallocatealpha($img, $d1,$d2,$d3,$imagesoptimizer_options['settings_watermark_alpha']);
    $textcolor  = imagecolorallocatealpha($img, $t1,$t2,$t3,$imagesoptimizer_options['settings_watermark_alpha']);
    
    if ($height >= $width) $miny = 10; else $miny = 30;
    $minx = round(strlen($text) * 180 / 15);

    imagettfborder($img, 20, 45, $width - $minx, $height - $miny, $border1, $font, $text, 2);
    imagettfborder($img, 20, 45, $width - $minx, $height - $miny, $border2, $font, $text, 1);
    imagettftext($img, 20, 45, $width - $minx, $height - $miny, $textcolor, $font, $text);

    return $img;
}

function add_watermark_th($img, $text, $font)
{
    global $imagesoptimizer_options;
    
    $width  = imagesx($img);
    $height = imagesy($img);

    $text   = " ".$text." ";
    
    list($t1,$t2,$t3) = explode(",", $imagesoptimizer_options['settings_watermark_textcolor']);
    list($b1,$b2,$b3) = explode(",", $imagesoptimizer_options['settings_watermark_border1color']);
    list($d1,$d2,$d3) = explode(",", $imagesoptimizer_options['settings_watermark_border2color']);
   
    $border1    = imagecolorallocatealpha($img, $b1,$b2,$b3,$imagesoptimizer_options['settings_watermark_alpha']);
    $border2    = imagecolorallocatealpha($img, $d1,$d2,$d3,$imagesoptimizer_options['settings_watermark_alpha']);
    $textcolor  = imagecolorallocatealpha($img, $t1,$t2,$t3,$imagesoptimizer_options['settings_watermark_alpha']);
    
    if ($height >= $width) $miny = 10; else $miny = 30;
    $minx = round(strlen($text) * 130 / 15);

    imagettfborder($img, 18, 45, $width - $minx, $height - $miny, $border1, $font, $text, 2);
    imagettfborder($img, 18, 45, $width - $minx, $height - $miny, $border2, $font, $text, 1);
    imagettftext($img, 18, 45, $width - $minx, $height - $miny, $textcolor, $font, $text);

    return $img;
}


function imagettfborder($im, $size, $angle, $x, $y, $color, $font, $text, $width) {
    imagettftext($im, $size, $angle, $x-$width, $y-$width, $color, $font, $text);
    imagettftext($im, $size, $angle, $x, $y-$width, $color, $font, $text);
    imagettftext($im, $size, $angle, $x+$width, $y-$width, $color, $font, $text);
    imagettftext($im, $size, $angle, $x-$width, $y+$width, $color, $font, $text);
    imagettftext($im, $size, $angle, $x, $y+$width, $color, $font, $text);
    imagettftext($im, $size, $angle, $x-$width, $y+$width, $color, $font, $text);
    imagettftext($im, $size, $angle, $x-$width, $y, $color, $font, $text);
    imagettftext($im, $size, $angle, $x+$width, $y, $color, $font, $text);
    for ($i = 1; $i < $width; $i++) {
        imagettftext($im, $size, $angle, $x-$i, $y-$width, $color, $font, $text);
        imagettftext($im, $size, $angle, $x+$i, $y-$width, $color, $font, $text);
        imagettftext($im, $size, $angle, $x-$i, $y+$width, $color, $font, $text);
        imagettftext($im, $size, $angle, $x+$i, $y+$width, $color, $font, $text);
        imagettftext($im, $size, $angle, $x-$width, $y-$i, $color, $font, $text);
        imagettftext($im, $size, $angle, $x-$width, $y+$i, $color, $font, $text);
        imagettftext($im, $size, $angle, $x+$width, $y-$i, $color, $font, $text);
        imagettftext($im, $size, $angle, $x+$width, $y+$i, $color, $font, $text);
    }
}
  
  
_e('Done', 'imagesoptimizer');
?>
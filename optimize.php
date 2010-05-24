<?php
include_once('../../../wp-config.php');

if (!empty($_GET['preview']) && !empty($_GET['image'])) {
	list ($a,$b) = explode("wp-content/", urldecode($_GET['image']));
	$origimage = ABSPATH.'wp-content/'.$b;
	
	$size = getimagesize($origimage);
	
	if ($size['mime'] == 'image/jpeg')
	  $image = imagecreatefromjpeg($origimage);  
	if ($size['mime'] == 'image/png')
	  $image = imagecreatefrompng($origimage); 
	  
	header('Content-type: '.$size['mime']);
	
	if ($size['mime'] == 'image/jpeg')
	  imagejpeg($image, NULL, 85);  
	if ($size['mime'] == 'image/png')
	  imagepng($image, NULL, 3);  
	
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
	
	if ($size['mime'] == 'image/jpeg')
	  imagejpeg($image, $origimage, 85);  
	if ($size['mime'] == 'image/png')
	  imagepng($image, $origimage, 3);  
	
	imagedestroy($image);  
}

_e('Done', 'imagesoptimizer');

?>
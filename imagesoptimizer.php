<?php
/*
Plugin Name: Easy Watermark and Images Optimize
Plugin URI: http://www.zhenskayalogika.ru/
Description: Simple way for adding Watermark to your images and image optimizer.
Version: 1.0
Author: Serafim Panov
Author URI: http://www.spnova.org/
*/

function imagesoptimizer_get_options()
{
  $imagesoptimizer_options = get_option('imagesoptimizer_options');

  if (!isset($imagesoptimizer_options['settings_watermark'])) 
    $imagesoptimizer_options['settings_watermark'] = str_replace("http://", "", get_bloginfo('url'));
    
  if (!isset($imagesoptimizer_options['settings_watermark_alpha'])) 
    $imagesoptimizer_options['settings_watermark_alpha'] = 50;
    
  if (!isset($imagesoptimizer_options['settings_watermark_textcolor'])) 
    $imagesoptimizer_options['settings_watermark_textcolor'] = "0,0,255";
    
  if (!isset($imagesoptimizer_options['settings_watermark_border1color'])) 
    $imagesoptimizer_options['settings_watermark_border1color'] = "175,175,175";
    
  if (!isset($imagesoptimizer_options['settings_watermark_border2color'])) 
    $imagesoptimizer_options['settings_watermark_border2color'] = "255,255,255";
    
  add_option('imagesoptimizer_options', $imagesoptimizer_options);
  return $imagesoptimizer_options;
}


function imagesoptimizer_add_page()
{
  add_options_page('imagesoptimizer', 'imagesoptimizer', 6, __FILE__, 'imagesoptimizer_configuration_page');
}

add_action('admin_menu', 'imagesoptimizer_add_page');

function init_textdomain_imagesoptimizer() {
    load_plugin_textdomain('imagesoptimizer', PLUGINDIR . '/' . dirname(plugin_basename (__FILE__)) . '/lang');
}


add_action('init', 'init_textdomain_imagesoptimizer');

function imagesoptimizer_configuration_page()
{
  $imagesoptimizer_options = imagesoptimizer_get_options();
  
  if (isset($_POST['submit'])) {
    $imagesoptimizer_options['settings_watermark']              = $_POST['settings_watermark'];
    $imagesoptimizer_options['settings_watermark_alpha']        = $_POST['settings_watermark_alpha'];
    $imagesoptimizer_options['settings_watermark_textcolor']    = $_POST['settings_watermark_textcolor'];
    $imagesoptimizer_options['settings_watermark_border1color'] = $_POST['settings_watermark_border1color'];
    $imagesoptimizer_options['settings_watermark_border2color'] = $_POST['settings_watermark_border2color'];
    update_option('imagesoptimizer_options', $imagesoptimizer_options);
  }
  ?>
  <form method="post" action="">
<div style="clear: both;-moz-border-radius:6px 6px 6px 6px;background-color:#B5CDDF;list-style-type:none;padding:5px 5px 5px 10px;margin:5px;height:24px;">
<div style="float:left;width:180px;padding-top:3px;"></div>
<div style="float:left;width:170px;">
</div>
<div style="float:left;width:170px;padding-top:3px;"><b><?php _e('Watermark text', 'imagesoptimizer'); ?></b></div>
<div style="float:left;">
<input type="text" name="settings_watermark" value="<?php if ($imagesoptimizer_options['settings_watermark']) print $imagesoptimizer_options['settings_watermark']; ?>" style="width:350px;" />
</div>
</div>

<div style="clear: both;-moz-border-radius:6px 6px 6px 6px;background-color:#B5CDDF;list-style-type:none;padding:5px 5px 5px 10px;margin:5px;height:24px;">
<div style="float:left;width:180px;padding-top:3px;"></div>
<div style="float:left;width:170px;">
</div>
<div style="float:left;width:170px;padding-top:3px;"><b><?php _e('Transparency', 'imagesoptimizer'); ?></b></div>
<div style="float:left;">
<input type="text" name="settings_watermark_alpha" value="<?php if ($imagesoptimizer_options['settings_watermark_alpha']) print $imagesoptimizer_options['settings_watermark_alpha']; ?>" style="width:50px;" />
</div>
</div>

<div style="clear: both;-moz-border-radius:6px 6px 6px 6px;background-color:#B5CDDF;list-style-type:none;padding:5px 5px 5px 10px;margin:5px;height:24px;">
<div style="float:left;width:180px;padding-top:3px;"></div>
<div style="float:left;width:170px;">
</div>
<div style="float:left;width:170px;padding-top:3px;"><b><?php _e('Text color', 'imagesoptimizer'); ?></b></div>
<div style="float:left;">
<input type="text" name="settings_watermark_textcolor" value="<?php if ($imagesoptimizer_options['settings_watermark_textcolor']) print $imagesoptimizer_options['settings_watermark_textcolor']; ?>" style="width:350px;" />
</div>
</div>

<div style="clear: both;-moz-border-radius:6px 6px 6px 6px;background-color:#B5CDDF;list-style-type:none;padding:5px 5px 5px 10px;margin:5px;height:24px;">
<div style="float:left;width:180px;padding-top:3px;"></div>
<div style="float:left;width:170px;">
</div>
<div style="float:left;width:170px;padding-top:3px;"><b><?php _e('Border 1 color', 'imagesoptimizer'); ?></b></div>
<div style="float:left;">
<input type="text" name="settings_watermark_border1color" value="<?php if ($imagesoptimizer_options['settings_watermark_border1color']) print $imagesoptimizer_options['settings_watermark_border1color']; ?>" style="width:350px;" />
</div>
</div>

<div style="clear: both;-moz-border-radius:6px 6px 6px 6px;background-color:#B5CDDF;list-style-type:none;padding:5px 5px 5px 10px;margin:5px;height:24px;">
<div style="float:left;width:180px;padding-top:3px;"></div>
<div style="float:left;width:170px;">
</div>
<div style="float:left;width:170px;padding-top:3px;"><b><?php _e('Border 2 color', 'imagesoptimizer'); ?></b></div>
<div style="float:left;">
<input type="text" name="settings_watermark_border2color" value="<?php if ($imagesoptimizer_options['settings_watermark_border2color']) print $imagesoptimizer_options['settings_watermark_border2color']; ?>" style="width:350px;" />
</div>
</div>


<div style="clear: both;-moz-border-radius:6px 6px 6px 6px;background-color:#B5CDDF;list-style-type:none;padding:5px 5px 5px 10px;margin:5px;height:24px;">
<div style="float:left;width:180px;padding-top:3px;"></div>
<div style="float:left;width:170px;">
</div>
<div style="float:left;width:170px;padding-top:3px;"><b><?php _e('Preview'); ?></b></div>
<div style="float:left;"><a href="../wp-content/plugins/imagesoptimizer/watermark.php?preview=2&t<?php echo time() ?>" target="_blank"><?php _e('Preview'); ?></a>
</div>
</div>

<div style="clear: both;padding-top:10px;text-align:center;">
<p class="submit"><input type="submit" name="submit" value="<?php _e('Update Options', 'imagesoptimizer'); ?>" /></p>
</div>
</form>
</div>
  <?php
}


add_filter('attachment_fields_to_edit', 'imagesoptimizer_attachment_fields_to_edit_watermark', 10, 2);

function imagesoptimizer_attachment_fields_to_edit_watermark($form_fields, $post){
    if ($post->post_mime_type == 'image/jpeg' || $post->post_mime_type == 'image/gif' || $post->post_mime_type == 'image/png') {
        //$thumb = image_get_intermediate_size($post->ID, 'thumbnail');
        $thumb = image_get_intermediate_size($post->ID, 'medium');
        
        list ($a,$b) = explode("wp-content/", $post->guid);
        $origimage = ABSPATH.'wp-content/'.$b;
        $size = getimagesize($origimage);
        if ($size[1] <= 550 && $size[0] <= 1200) $previewlightbox = 'onclick="imagesoptimizer_add_watermark_preview();return false;"'; else $previewlightbox = '';
        
        $form_fields['imagesoptimizer-watermark']  = array(
            'label'      => __('Add watermark', 'imagesoptimizer'),
            'input'      => 'html',
            'html'       => '
            <script type="text/javascript" src="'.WP_PLUGIN_URL.'/imagesoptimizer/js/jquery.simplemodal-1.3.3.min.js"></script>
<style media="screen" type="text/css">
#simplemodal-container {
background-color:#ffffff;
border:4px solid #444444;
height:'.$size[1].'px;
padding:12px;
width:'.$size[0].'px;
}
#simplemodal-overlay {
background-color:#000000;
cursor:wait;
}

a.modalCloseImg {
    background:url('.WP_PLUGIN_URL.'/imagesoptimizer/img/x.png) no-repeat; /* adjust url as required */
    width:25px;
    height:29px;
    display:inline;
    z-index:3200;
    position:absolute;
    top:-15px;
    right:-18px;
    cursor:pointer;
}
<!--[if lt IE 7]>
<style type=\'text/css\'>
    a.modalCloseImg {
        background:none;
        right:-14px;
        width:22px;
        height:26px;
        filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(
            src=\''.WP_PLUGIN_URL.'/imagesoptimizer/img/x.png\', sizingMethod=\'scale\'
        );
    }
</style>
<![endif]-->
</style>
            <script type="text/javascript">
              function imagesoptimizer_add_watermark() {
                jQuery("#imagesoptimizer_watermark").html("<img src=\"images/wpspin_light.gif\" alt=\"\" width=\"16px\" height=\"16px\" />");
                jQuery.post("../'.PLUGINDIR . '/' . dirname(plugin_basename (__FILE__)).'/watermark.php", { image: "'.urlencode($post->guid).'" },function(data) {
                  jQuery("#imagesoptimizer_watermark").html(data);
                });
              }
              function imagesoptimizer_add_watermarkth() {
                jQuery("#imagesoptimizer_watermark").html("<img src=\"images/wpspin_light.gif\" alt=\"\" width=\"16px\" height=\"16px\" />");
                jQuery.post("../'.PLUGINDIR . '/' . dirname(plugin_basename (__FILE__)).'/watermark.php", { image: "'.urlencode($post->guid).'", thumbnail: "'.urlencode($thumb['url']).'" },function(data) {
                  jQuery("#imagesoptimizer_watermark").html(data);
                });
              }
              function imagesoptimizer_add_watermark_preview() {
                  jQuery.modal(\'<img src="../'.PLUGINDIR . '/' . dirname(plugin_basename (__FILE__)).'/watermark.php?preview=1&image='.urlencode($post->guid).'" />\');
              }
            </script>
    
            <div id="imagesoptimizer_watermark"><a href="#" onclick="imagesoptimizer_add_watermark();return false;">'.__('to image', 'imagesoptimizer').'</a> :: <a href="#" onclick="imagesoptimizer_add_watermarkth();return false;">'.__('to image and thumbnail', 'imagesoptimizer').'</a> :: <a href="../'.PLUGINDIR . '/' . dirname(plugin_basename (__FILE__)).'/watermark.php?preview=1&image='.urlencode($post->guid).'" '.$previewlightbox.' target="_blank">'.__('Preview').'</a></div>'
        );
    
        return $form_fields;
    }
    else
    {
        return false;
    }
}


add_filter('attachment_fields_to_edit', 'imagesoptimizer_attachment_fields_to_edit_optimize', 10, 2);

function imagesoptimizer_attachment_fields_to_edit_optimize($form_fields, $post){
    if ($post->post_mime_type == 'image/jpeg' || $post->post_mime_type == 'image/png') {
        list ($a,$b) = explode("wp-content/", $post->guid);
        $origimage = ABSPATH.'wp-content/'.$b;
        
        $size = getimagesize($origimage);
        
        if ($size['mime'] == 'image/jpeg')
          $image = imagecreatefromjpeg($origimage);  
        if ($size['mime'] == 'image/png')
          $image = imagecreatefrompng($origimage); 
          
        //header('Content-type: '.$size['mime']);
        
        if ($size['mime'] == 'image/jpeg')
          imagejpeg($image, ABSPATH.PLUGINDIR.'/imagesoptimizer/tmp', 85);  
        if ($size['mime'] == 'image/png')
          imagepng($image, ABSPATH.PLUGINDIR.'/imagesoptimizer/tmp', 3);  
        
        imagedestroy($image);  
        
        $sizef        = filesize(ABSPATH.PLUGINDIR.'/imagesoptimizer/tmp');
        $sizecurrent = filesize($origimage);
        $save        = (100 - round(($sizef * 100) / $sizecurrent));
        if ($save <= 0) 
          return false; 
        else 
          $save = $save . "%";
        $sizef        = round($sizef / 1000, 1) . "kb";
        
        if ($size[1] <= 550 && $size[0] <= 1200) $previewlightbox = 'onclick="imagesoptimizer_add_optimizepr();return false;"'; else $previewlightbox = '';
        
        $form_fields['imagesoptimizer-optimize']  = array(
            'label'      => __('Optimize', 'imagesoptimizer'),
            'input'      => 'html',
            'html'       => '
            <script type="text/javascript">
              function imagesoptimizer_add_optimizepr() {
                jQuery.modal(\'<img src="../'.PLUGINDIR . '/' . dirname(plugin_basename (__FILE__)).'/optimize.php?preview=1&image='.urlencode($post->guid).'" />\');
              }
              function imagesoptimizer_add_optimize() {
                jQuery("#imagesoptimizer_optimize").html("<img src=\"images/wpspin_light.gif\" alt=\"\" width=\"16px\" height=\"16px\" />");
                jQuery.post("../'.PLUGINDIR . '/' . dirname(plugin_basename (__FILE__)).'/optimize.php", { image: "'.urlencode($post->guid).'" },function(data) {
                  jQuery("#imagesoptimizer_optimize").html(data);
                });
              }
            </script>
    
            <div id="imagesoptimizer_optimize" style="float:left;"><a href="#" onclick="imagesoptimizer_add_optimize();return false;">'.__('Optimize', 'imagesoptimizer').'</a> ('.__('size', 'imagesoptimizer').': '.$sizef.' '.__('better for', 'imagesoptimizer').': '.$save.') <a href="../'.PLUGINDIR . '/' . dirname(plugin_basename (__FILE__)).'/optimize.php?preview=1&image='.urlencode($post->guid).'" '.$previewlightbox.' target="_blank">'.__('Preview').'</a></div>
            <div id="imagesoptimizer_optimize_preview"></div>'
        );
    
        return $form_fields;
    }
    else
    {
        return false;
    }
}


?>

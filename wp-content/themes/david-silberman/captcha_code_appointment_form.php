<?php
@session_start();
if($_REQUEST['id']==2){
include('../../../wp-load.php');
}
define('SITE_URL1',get_bloginfo('stylesheet_directory'));

function captcha_function()
{
$imagePath  = SITE_URL1.'/shapes/popup/';
$captcha_images_con = array('circle','diamond','square','star','triangle'); // image names //   // array('house','folder','monitor','man','woman','lock','rss'); -> for general theme

$random_con  = mt_rand(0,(sizeof($captcha_images_con)-1));
shuffle($captcha_images_con);
$captcha_output_con = '<p style="margin:0px 0px 10px 0px ; padding:5px 0 0 0; line-height:18px; font-size:13px; font-family:Open Sans,sans-serif; color:#666; text-align:right;">Please select the <span style="color:#000; text-decoration:none; text-transform:uppercase;">'.ucwords($captcha_images_con[$random_con])."</span>  and click the Submit button.</p>\n";


for($i=0;$i<sizeof($captcha_images_con);$i++) 
{
    $captcha_images2_con[$i] = mt_rand();
	$captcha_output_con .= '<a href="" class="captcha-image-contact" onclick="save_captcha_contact(this,'.$captcha_images2_con[$i].');return false;" ><img  src="'.$imagePath.$captcha_images_con[$i].'.png" style="float:right; margin:0px 0px 7px 6px; border:1px solid #0da6e8;" /></a>';
}


$captcha_output_con .= '<a href="javascript:void();" onClick="refreshCapchaContact();return false;"  alt="Refresh" title="Refresh" tabindex="916"><img class="refresh-contact" src="'.$imagePath.'refresh.png" border="0" alt="Refresh"   style=" margin:0px; float:right;"/></a>';

	
	$_SESSION['captcha_field'] = $captcha_images2_con[$random_con];
	return $captcha_output_con;
}
echo captcha_function();
?>
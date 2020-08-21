<?php
@session_start();
if($_REQUEST['id']==2){
include('../../../wp-load.php');
}
define('SITE_URL1',get_bloginfo('stylesheet_directory'));

function captcha_functionmore()
{
$imagePath  = SITE_URL1.'/shapes/';
$captcha_images_con = array('circle','diamond','square','star','triangle'); // image names //   // array('house','folder','monitor','man','woman','lock','rss'); -> for general theme

$random_con  = mt_rand(0,(sizeof($captcha_images_con)-1));
shuffle($captcha_images_con);
$captcha_output_con = '<p style="margin:0px 0px 10px 0px ; padding:0px; line-height:18px; font-size:13px; font-family:Open Sans,sans-serif; color:#8f8f8e;  ">Please select the <span style="color:#3BA7E3; text-decoration:none; text-transform:uppercase;">'.ucwords($captcha_images_con[$random_con])."</span> and then click the submit button.</p>\n";

$captcha_output_con .= '<div><a href="javascript:void();" onClick="refreshCapchaMore();return false;"  alt="Refresh" title="Refresh" tabindex="307"><img src="'.$imagePath.'refresh.png" border="0" alt="Refresh" class="refresh-gift"  /></a>';

for($i=0;$i<sizeof($captcha_images_con);$i++) 
{
    $captcha_images2_con[$i] = mt_rand();
	$captcha_output_con .= '<div style="margin-right:0px;"><a href="" class="captcha-image-more" onclick="save_captcha_more(this,'.$captcha_images2_con[$i].');return false;" ><img  src="'.$imagePath.$captcha_images_con[$i].'.png" style="float:left; margin:3px 0px 20px 6px; border:1px solid #3BA7E3;" /></a></div>';
}
$captcha_output_con .= '</div>';

	
	$_SESSION['captcha_field'] = $captcha_images2_con[$random_con];
	return $captcha_output_con;
}
echo captcha_functionmore();
?>
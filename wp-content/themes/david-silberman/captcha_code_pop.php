<?php
@session_start();
if($_REQUEST['id']==4){
include('../../../wp-load.php');
}
define('SITE_URL2',get_bloginfo('stylesheet_directory'));
function captcha_popfunction()
{
$imagePath  = SITE_URL2.'/shapes/popup/';
$captcha_images_con = array('circle','diamond','square','star','triangle'); // image names //   // array('house','folder','monitor','man','woman','lock','rss'); -> for general theme

$random_con  = mt_rand(0,(sizeof($captcha_images_con)-1));
shuffle($captcha_images_con);
$captcha_output_con = '<p style="margin:0px 0px 10px 0px ; padding:0px; line-height:18px; font-size:13px; font-family:Open Sans,sans-serif; color:#666; text-align:left;  ">Please select the <span style="color:#0da6e8; text-decoration:none; text-transform:uppercase;">'.ucwords($captcha_images_con[$random_con])."</span>  and click the SUBMIT button.</p>\n";

$captcha_output_con .= '<div><a href="javascript:void();" onClick="refreshCapchapop();return false;" tabindex="505" alt="Refresh" title="Refresh" ><img src="'.$imagePath.'refresh.png" border="0" alt="Refresh" style="float:left; margin:0px 5px 0px 0px; " class="catcha-refresh-margin" tabindex="105" /></a>';

for($i=0;$i<sizeof($captcha_images_con);$i++) 
{
    $captcha_images2_con[$i] = mt_rand();
	$captcha_output_con .= '<a href="" class="captcha-image-pop-page" onclick="save_captcha_pop(this,'.$captcha_images2_con[$i].');return false;" ><img  src="'.$imagePath.$captcha_images_con[$i].'.png" style="float:left; margin:0px 0px 10px 4px; border:1px solid #0da6e8; " /></a>';
}
$captcha_output_con .= '</div>';

	
	$_SESSION['captcha_field_pop'] = $captcha_images2_con[$random_con];
	return $captcha_output_con;
}
echo captcha_popfunction();
?>
<?php
@session_start();
if($_REQUEST['id']==4){
include('../../../wp-load.php');
}
define('SITE_URL2',get_bloginfo('stylesheet_directory'));

function captcha_contactfunctiona()
{
$imagePath  = SITE_URL2.'/shapes/form-bottom/';
$captcha_images_con = array('circle','diamond','square','star','triangle'); // image names //   // array('house','folder','monitor','man','woman','lock','rss'); -> for general theme

$random_con  = mt_rand(0,(sizeof($captcha_images_con)-1));
shuffle($captcha_images_con);
$captcha_output_con = '<p class="capcha-div-text" style="color:#000;">Please select the <span style="text-transform:uppercase; color:#0da6e8;">'.ucwords($captcha_images_con[$random_con])."</span>   and click the SUBMIT button.</p>\n";

$captcha_output_con .= '<div>';
$captcha_output_con .= '<a href="javascript:void();" onClick="refreshCapchacontact();return false;"  alt="Refresh" title="Refresh" ><img src="'.$imagePath.'refresh.png" border="0" tabindex="405" alt="Refresh" style="float:left; margin:5px 15px 0px 0px; " class="catcha-refresh-margin"  /></a>';


for($i=0;$i<sizeof($captcha_images_con);$i++) 
{
    $captcha_images2_con[$i] = mt_rand();
	$captcha_output_con .= '<a href="" class="captcha-image-side-page" onclick="save_captcha_contact(this,'.$captcha_images2_con[$i].');return false;" ><img  src="'.$imagePath.$captcha_images_con[$i].'.png" style="float:left; margin:2px 6px 10px 0px; border:1px solid #0da6e8;" /></a>';
}
$captcha_output_con .= '</div>';
	$_SESSION['captcha_field_contact'] = $captcha_images2_con[$random_con];
	return $captcha_output_con;
}
echo captcha_contactfunctiona();
?>
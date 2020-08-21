<?php
@session_start();
if($_REQUEST['id']==4){
include('../../../wp-load.php');
}
define('SITE_URL2',get_bloginfo('stylesheet_directory'));



function captcha_sidefunction()
{
$imagePath  = SITE_URL2.'/shapes/';
$captcha_images_con = array('circle','diamond','square','star','triangle'); // image names //   // array('house','folder','monitor','man','woman','lock','rss'); -> for general theme

$random_con  = mt_rand(0,(sizeof($captcha_images_con)-1));
shuffle($captcha_images_con);
$captcha_output_con = '<p style="margin:0px 0px 20px 0px ; padding:0px; line-height:18px; font-size:13px; font-family:Open Sans,sans-serif;  color:#fff; text-align:left;  ">Please select the <span class="captcha-span" style="text-transform:uppercase; color:#032028;" >'.ucwords($captcha_images_con[$random_con])."</span>  and click the SUBMIT button.</p>\n";


for($i=0;$i<sizeof($captcha_images_con);$i++) 
{
    $captcha_images2_con[$i] = mt_rand();
	$captcha_output_con .= '<a href="" class="captcha-image-contact-page" onclick="save_captcha_sidebar(this,'.$captcha_images2_con[$i].');return false;" ><img  src="'.$imagePath.$captcha_images_con[$i].'.png" style="float:right; margin:0px 0px 10px 5px; border:1px solid #fff;" /></a>';
}



$captcha_output_con .= '<div class="captcha-shape-wrap"><a href="javascript:void();" onClick="refreshCapchasidebar();return false;"  alt="Refresh" title="Refresh" style=" float:right; margin:0 5px 0 5px; " ><img src="'.$imagePath.'refresh.png" border="0" alt="Refresh"  class="catcha-refresh-margin" tabindex="205" /></a>';
$captcha_output_con .= '</div>';


	$_SESSION['captcha_hid_side'] = $captcha_images2_con[$random_con];
	return $captcha_output_con;
}
echo captcha_sidefunction();
?>
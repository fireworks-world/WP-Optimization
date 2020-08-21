<?php
include('../../../wp-load.php');
define('SITE_URL1',get_option('siteurl').'/');
$color = '#17aae9';
$font_color = '#ffffff';
$blog_title = get_option('blogname'); 
$wp_style_dir = get_stylesheet_directory_uri();
$body ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to '.$blog_title.'</title>
</head>
<body style="margin:0px; padding:0px;margin:auto;font-family:Tahoma, Arial;font-size:13px;">
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="'.$color.'">
  <tr>
    <td width="700" align="center" valign="top" bgcolor="'.$color.'" style="border-bottom:none; border:1px solid '.$color.';"  >
   
		<a href="'.SITE_URL1.'" title="'.$blog_title.'" onmouseover="this.style.textDecoration = "'.none.'" onmouseout="this.style.textDecoration = "'.none.'" style="color:#000000;margin:0px;padding:0px;outline:none;text-decoration:none" ><img src="'.$wp_style_dir.'/mails/images/mail-template.jpg" alt="'.$blog_title.'" width="700" height="130" border="0" /></a>
	</td>
  </tr>
 <tr>
    <td align="left" valign="top "style="border-left:1px solid '.$color.';border-right:1px solid '.$color.';"><table width="700" border="0" cellspacing="0" cellpadding="0" >
      <tr>
        <td width="700" align="center" valign="top" style="padding:0px;background:#ffffff;">
            
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" valign="top" bgcolor="#624600">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td colspan="2" height="30" align="left" valign="top" bgcolor="#FFFFFF" style="color:#000; padding:6px 10px 2px 11px;"><h2>Hello</h2> 
                  This mail is sent as a result of testing from the admin section of '.$blog_title.'.<br /><br /><br />
                    <br /></td>
                    </tr>
     
              </table>
			</td>
            </tr>
          </table>          </td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td height="30" align="center" valign="middle" bgcolor="'.$color.'" style="margin:0px; padding:5px 0px 5px 0px; color: '.$font_color.';" ><a onmouseover="this.style.textDecoration = "'.none.'" onmouseout="this.style.textDecoration = "'.none.'" href="'.SITE_URL1.'" target="_blank" style="color:'.$font_color.';text-decoration:none" title="'.$blog_title.'">'.$blog_title.'</a></td>
  </tr>
</table>
</body>
</html>';
?>
 
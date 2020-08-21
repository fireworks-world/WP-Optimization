<?php
$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
$wp_load = $parse_uri[0].'wp-load.php';
require_once($wp_load);

define('SITE_URL',get_option('siteurl').'/');


if($_POST['news_email']){$email=stripslashes($_POST['news_email']);}


/*----- Getting Email id from DB --------*/
$result=mysql_query("SELECT email_to,email_cc,email_bcc FROM den_email");
while($row=mysql_fetch_array($result))
{
	$email_to=$row['email_to']; 
	$email_cc=$row['email_cc'];
	$email_bcc=$row['email_bcc'];
}
/*----- Getting Email id from DB --------*/
	
//Replacing the to, cc and bcc email address if @techwyseintl.com is found STARTS HERE
	$email=stripslashes($email);
	$email_string = strstr($email, "@techwyseintl.com"); //Checking whether email string contains @techwyseintl.com
	$to = ($email_string=="@techwyseintl.com")? stripslashes($email) : $email_to;
	$bcc_email = ($email_string=="@techwyseintl.com")? "" : $email_bcc;
	$cc_email = ($email_string=="@techwyseintl.com")? "" : $email_cc;
//Replacing the to, cc and bcc email address if @techwyseintl.com is found ENDS HERE

if(!filter_var($email, FILTER_VALIDATE_EMAIL))
{
	$proceed2 = "false";
}
else
{
	$proceed2 = "true";
}

if($email!='')
{
	$badStrings = array("Content-Type:", 
                     "MIME-Version:",
                     "Content-Transfer-Encoding:", 
					 														"http:", 
                     "www.", 
                     "mailto:", 
																		 "http://www.",
					 														"URL=http://www.",	
					 														"URL:", 
                     "bcc:", 
                     "cc:",
					 ".html",
					 "iframe",
					 "<script src=http://",
					 "142536",
					 "123456",
					 "src=http://"); 
foreach($_POST as $k => $v)
{
	${$key} = $val;
    foreach($badStrings as $v2)
    { 
 	   if(strpos($v, $v2) !== false)
	   {       
		?>
		<script language="javascript">
		alert('Invalid Data. Cannot Proceed.');
		window.location='<? echo SITE_URL1?>';
		</script>
		<?
        exit(); 
       }
    }
}
if(!isset($_SERVER['HTTP_USER_AGENT']))
{ 
	die("Forbidden - You are not authorized to view this page");   exit; 
}
if(!$_SERVER['REQUEST_METHOD'] == "POST")
{ 
	die("Forbidden - You are not authorized to view this page");   exit;     
}
unset($k, $v, $v2, $badStrings); 

$body='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Newsletter Sign Up</title>

<style type="text/css">
<!--
body
{
	margin:auto;
	padding:30px 0px 0px 0px;
	font-family:Verdana, Tahoma, Arial;
	font-size:13px;
	
}
.header
{
border:2px solid #000;
}
.outer_wrap
{
	border-bottom:1px solid #000;
	border-left:1px solid #000;
	border-right:1px solid #000;
}

.content_wrap
{
	border-top:2px solid #000;
	padding:20px 10px 20px 10px;
	background:#ffffff;
}

a{
 color:#000000;
 text-decoration:underline;
 margin:0px;
 padding:0px;
 outline:none;
 
 }
a:hover{
text-decoration:none;
 
 }
.td-space
{
padding:6px 0px 0px 12px;
font-size:12px;
}
.copyright {
color: #FFFFFF;
}
.footer
{
color:#FFFFFF;
text-decoration:none;
}
.footer:hover
{
color:#ccc;
}
.copyright
{
font-size:12px;
color:#FFFFFF;
}
-->

</style>

</head>
<body style="margin:0px; padding:0px;">
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#020202">
  <tr >
    <td width="700" height="102" align="center" valign="top"  style="border:#000 1px solid; border-bottom:none;"  >
   
<a href="'.SITE_URL.'" title="Dental"><img src="'.SITE_URL.'wp-content/themes/dental/mails/images/mail-template.jpg" alt="Dental" width="700" height="130" border="0"  /></a></td>
  </tr>
  <tr>
    <td align="left"  class="outer_wrap"><table width="700" border="0" cellspacing="0" cellpadding="0" >
      <tr>
        <td width="700" align="center" valign="top" class="content_wrap">
            
          <table width="100%" border="0" cellspacing="1" cellpadding="0">
            <tr>
              <td  width="100%" align="left" valign="top" bgcolor="#e3e3e3"><table width="100%" border="0" cellspacing="2" cellpadding="0">
                <tr >
                  <td colspan="2" align="left" valign="top" bgcolor="#000" style="color:#FFFFFF; padding:6px 0px 6px 10px; font-family:Arial, Helvetica, sans-serif; font-size:13px;"><strong>Personal Details</strong></td>
                  </tr>
<tr bgcolor="#f9f7ea">
                  <td width="37%"  align="left" valign="middle" bgcolor="#FFFFFF" style="padding:6px 0px 6px 11px; font-size:12px;"><strong>Email</strong></td>
                  <td width="63%" align="left" valign="middle" bgcolor="#FFFFFF" style="padding:6px 0px 6px 11px; font-size:12px;"><a href="mailto:'.$email.'" style="color:#363636;">'.stripslashes($email).'</a></td>
                </tr>
           
                 <tr bgcolor="#000">
                  <td colspan="2" align="left" valign="top" bgcolor="#000" style="color:#FFFFFF; padding:6px 0px 6px 10px; font-family:Arial, Helvetica, sans-serif; font-size:13px;"><strong>Form Submitted Details</strong></td>
                  </tr>
                 <tr bgcolor="#f9f7ea">
                  <td  align="left" valign="middle" bgcolor="#FFFFFF" style="padding:6px 0px 6px 11px;  font-size:12px;"><strong>Page Name</strong></td>
                  <td align="left" valign="middle" bgcolor="#FFFFFF" style="padding:6px 0px 6px 11px; font-size:12px;"><a href="'.$_SERVER['HTTP_REFERER'].'">'.$_SERVER['HTTP_REFERER'].'</a></td>
                </tr>
                  <tr bgcolor="#f9f7ea">
                  <td align="left" valign="middle" bgcolor="#FFFFFF" style="padding:6px 0px 6px 11px; font-size:12px;"><strong>IP Address</strong></td>
                  <td align="left" valign="middle" bgcolor="#FFFFFF"  style="padding:6px 0px 6px 11px; font-size:12px;">'.$_SERVER['REMOTE_ADDR'].'</td>
                </tr>
                  <tr bgcolor="#f9f7ea">
                  <td  align="left" valign="middle" bgcolor="#FFFFFF" style=" padding:6px 0px 6px 11px;  font-size:12px;"><strong>Date</strong></td>
                  <td align="left" valign="middle" bgcolor="#FFFFFF" style=" padding:6px 0px 6px 11px;  font-size:12px;">'.date("Y-M-d").'</td>
                </tr>
                  <tr bgcolor="#f9f7ea">
                  <td   align="left" valign="middle" bgcolor="#FFFFFF"  style="padding:6px 0px 6px 11px;  font-size:12px;" ><strong>Time</strong></td>
                  <td align="left" valign="middle" bgcolor="#FFFFFF"  style="padding:6px 0px 6px 11px;  font-size:12px;">'.date("H:i:s").'</td>
                </tr>
               
              </table>
                </td>
            </tr>
          </table>          </td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td height="30" align="center" valign="middle" bgcolor="#000" style="color:#FFFFFF;" > <a  href="'.SITE_URL.'" target="_blank" title="Dental" class="footer">Dental</a></td>
  </tr>
</table>


</body>
</html>
';
	$subject= "Newsletter Signup - Dental";						
	$headers= "MIME-Version: 1.0\r\n";
	$headers.="Content-Type: text/html;\n\tcharset=\"iso-8859-1\"\n";
	$headers.= "From:".$email."\r\n";
	$headers.= "Bcc:".$email_bcc."\r\n";
	$headers.= "Cc:".$email_cc."\r\n";
	@mail($to,$subject,$body,$headers); 
 
	
$body_con='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Newsletter Sign Up</title>

<style type="text/css">
<!--
body
{
	margin:auto;
	padding:30px 0px 0px 0px;
	font-family:Tahoma, Arial;
	font-size:13px;
	
}
.header
{
border:2px solid #7c8db5;
}
.outer_wrap
{
	border-bottom:1px solid #000;
	border-left:1px solid #000;
	border-right:1px solid #000;
}

.content_wrap
{
	padding:20px 10px 20px 10px;
	background:#eeeeee;
	border-top:2px solid #000;
}

a{
 color:#000000;
 text-decoration:underline;
 margin:0px;
 padding:0px;
 outline:none;
 
 }
a:hover{
text-decoration:none;
 
 }
.td-space
{
padding:6px 0px 0px 12px;
font-size:12px;
}
.copyright {
color: #FFFFFF
}
.footer
{
color:#FFFFFF;
text-decoration:none;
}
.footer:hover
{
color:#ccc;
}
.copyright
{
font-size:12px;
color:#FFFFFF;
background:#682800;
}
-->

</style>

</head>
<body style="margin:0px; padding:0px;">
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#fff">
  <tr >
    <td width="700" height="102" align="center" valign="top" bgcolor="#000"  style="border:#000 1px solid; color:#fff; border-bottom:none;"  ><a href="'.SITE_URL.'" title="Dental"><img src="'.SITE_URL.'wp-content/themes/dental/mails/images/mail-template.jpg" alt="Dental" width="700" height="130" border="0" /></a></td>
  </tr>
  <tr>
    <td align="left" valign="top"  class="outer_wrap"><table width="700" border="0" cellspacing="0" cellpadding="0" >
      <tr>
        <td width="700" align="center" valign="top" class="content_wrap">
            
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td align="left" valign="top" bgcolor="#008FD5">
<table width="100%" border="0" cellspacing="2" cellpadding="0">
                <tr>
                  <td colspan="2" height="30" align="left" valign="top"  bgcolor="#FFFFFF" style=" padding:6px 10px 2px 11px;">
                   Thank you for subscribing to our newsletter.<br />
                    <br /></td>
                    </tr>
				<tr bgcolor="#f9f7ea">
                  <td width="37%"  align="left" valign="middle" bgcolor="#FFFFFF" style="padding:6px 0px 6px 11px; font-size:12px;"><strong>Email</strong></td>
                  <td width="63%" align="left" valign="middle" bgcolor="#fff" style="padding:6px 0px 6px 11px; font-size:12px;"><a href="mailto:'.$email.'" style="color:#000;">'.stripslashes($email).'</a></td>
                </tr>
          </table>          </td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td height="30" align="center" valign="middle" bgcolor="#000"><a  href="'.SITE_URL.'" target="_blank" title="Dental" class="footer">Dental</a></td>
  </tr>
</table></tr></table>
</body>
</html>'; 
			 $subject="Confirmation - Dental";					
				$headers_con= "MIME-Version: 1.0\r\n";
				$headers_con.="Content-Type: text/html;\n\tcharset=\"iso-8859-1\"\n";
				$headers_con.= "From:".$email_to ."\r\n";	
				
			/*	echo $body;
				echo"<br>". $body_con;
				exit;
			 */
				
		   		@mail($email,$subject,$body_con,$headers_con);  
				header("location:".SITE_URL."thank-you?nl=1");
}
else
{
header("location:".SITE_URL);
}
?>
<?
session_start();
require( '../../../wp-load.php' );
$table_name = $wpdb->prefix . "email";
define('TABLE_EMAIL',$table_name);
 $email = $_REQUEST['ARG'];
//----------------------------------------------------
  $blog_title = get_option('blogname'); 
//$user_id=1;
$user = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".TABLE_EMAIL."  LIMIT 1",'') );
//------------------------------------------

if($_REQUEST['mailtype']  =="emailto"){$mailtype ="Admin Mail"; $typeval ="to"; }
if($_REQUEST['mailtype']  =="emailcc"){$mailtype ="Cc Mail"; $typeval ="cc"; }
if($_REQUEST['mailtype']  =="emailbcc"){$mailtype ="Bcc Mail";  $typeval ="bcc";}

	include_once("confirm_admin_mail.php");
	//echo $body;exit;
    $to= $email;
	$subject = $mailtype." "." Confirmation -  ".  $blog_title; 
	$headers  = "MIME-Version: 1.0\r\n"; 
	$headers.="Content-Type: text/html;\n\tcharset=\"iso-8859-1\"\n";
	$headers .= "From: ". $user_email ." \r\n";				
	//$headers .= "Bcc: webleads@techwyse.com,".$email_bcc ."";
	@mail($to,$subject,$body,$headers);
	echo  "Mail successfully sent to ".$email."";
   // echo  '<font color="#FF0000">'.$alert.'</font>';
//-------------------------------------------------------------------------
?>
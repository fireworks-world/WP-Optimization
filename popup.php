<?php
include('wp-config.php');
if($_REQUEST['frm']==1)
{
$title="Request Information";
$flag=1;
}
else if($_REQUEST['frm']==2)
{
$title="Request Appointment";
$flag=2;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta charset="iso-8859-1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'> 
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css' />
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery-1.10.2.min.js" type="text/javascript"></script>
<style>
.popup-wrap
{
	margin:0px auto;
	padding:10px;
	height: auto;
	width:280px;
	background:#f4f4f4;
}
.popup-wrap h3
{
	margin:0px 0px 15px 0px;
	padding:0px 0px 5px 0px;
	font-size:22px;
	font-family:'Open Sans',sans-serif;
	color:#000;
	text-transform:uppercase;
	border-bottom:1px solid #ccc;
	text-align:left;
	
}
.popup-wrap input
{
	width:100%;
	padding:8px 8px 8px 10px;
	margin:0px 0px 10px 0px;
	color:#616262;
	font-family:'Open Sans',sans-serif;
	font-size:13px;
	border:1px solid #D5D5D3;
	background:#fff;
	border-radius:3px;
}
.popup-wrap textarea
{
	width:99.5%;
	height:60px;
	padding:8px 8px 8px 10px;
	margin:0px 0px 15px 0px;
	color:#616262;
	font-family:'Open Sans',sans-serif;
	font-size:13px;
	border:1px solid #D5D5D3;
	background:#fff;
	border-radius:3px;
	overflow:auto;
	resize:none;
}

.popup-wrap .submit-bttn{
	padding:3px 12px 3px 12px;
	margin:0px 0px 0px 0px;
	color:#fff;
	font-family:'Open Sans',sans-serif;
	font-size:16px;
	text-transform:uppercase;
	text-align:center;
	background:#000;
	text-decoration:none;
	border-radius:3px;
	display:inline-block;
	float:left;}	
	
.popup-wrap .submit-bttn:hover{
	
	color:#fff;
	background:#0da6e8;}



</style>

</head>
<body>
 
<div class="popup-wrap">
<h3><?php echo $title;?></h3>
	<form name="mainformPopup" id="mainformPopup" action="<?php bloginfo('stylesheet_directory'); ?>/mails/mail.php" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
    <td><input name="pname" placeholder="Name*" id="pname" title="Name" type="text" value="Name*" tabindex="501" class="textfield" onBlur="if(this.value=='')this.value=this.defaultValue;" onFocus="if(this.value==this.defaultValue)this.value='';" onKeyPress="if(event.keyCode=='13')return validatepopForm(document.mainformPopup);" /></td>
  </tr>
  <tr>
    <td><input name="pphone" placeholder="Phone*" id="pphone" type="text"  title="Phone" value="Phone*" tabindex="502" class="textfield" onBlur="if(this.value=='')this.value=this.defaultValue;" onFocus="if(this.value==this.defaultValue)this.value='';" onKeyPress="if(event.keyCode=='13')return validatepopForm(document.mainformPopup);"/></td>
  </tr>
  <tr>
    <td><input name="pemail" placeholder="Email*" id="pemail" type="text" title="Email" value="Email*" tabindex="503" class="textfield"  onblur="if(this.value=='')this.value=this.defaultValue;" onFocus="if(this.value==this.defaultValue)this.value='';" onKeyPress="if(event.keyCode=='13')return validatepopForm(document.mainformPopup);"/></td>
  </tr>
  <tr>
    <td><textarea name="pcomments" placeholder="Questions/Comments*" title="Questions/Comments" tabindex="504" id="pcomments" cols="" rows="" class="textarea" onBlur="if(this.value=='')this.value=this.defaultValue;" onFocus="if(this.value==this.defaultValue)this.value='';">Questions/Comments*</textarea></td>
  </tr>
 <?php
	$theme_root =  get_theme_root().'/'.get_stylesheet().'/';
	?>
  <tr>
    <td align="right"><div id="captcha_div_pop"><?php include($theme_root.'captcha_code_pop.php'); ?></div></td>
  </tr>
  
   <tr>
   <td> 
        <div style=" height:30px;">
        <div id="wait_popform" style="display:none; width:100px; float:left; margin-bottom:0px;">
		<div style="float:left;"><img src="<?php bloginfo('stylesheet_directory'); ?>/shapes/wait.gif" align="left" border="0" style="float:right; margin:0px; padding:0px;"/></div>
  <div style="float:right;  font-size:13px; font-family:Open Sans,sans-serif; color:#000; text-align:right;">Please&nbsp;wait...</div>
   	</div>
	<a href="JavaScript:void(0);" onClick="validatepopForm();" tabindex="506" id="submit_popform" class="submit-bttn" title="Submit">SUBMIT</a>
        
        </div>
        
        
	</td>
  </tr>
  <tr> <td >&nbsp;</td>		
  </tr>
</table>
<input type="hidden" name="captcha_hid_pop" id="captcha_hid_pop" value="" />
<input type="hidden" name="frmname" id="frmname" value="<?php echo $flag;?>" />
</form>

</div>
 <script type="text/javascript">
//--------------------------------- Save Captcha Function-------------------//
function save_captcha_pop(obj,arg)
{
_link=document.links;

for(i=0;i<_link.length;i++)
{
	if(_link[i].className=="captcha-image-pop-page") {	
		if(_link[i]!=obj) {
			_link[i].childNodes[0].style.border='1px solid #0da6e8';
		} else {
			_link[i].childNodes[0].style.border='1px solid #000';
		}
	}
}
document.getElementById("captcha_hid_pop").value=arg;
}
//--------------------------------- Save Captcha Function-------------------//
//--------------------------------- Captcha Validation-------------------//
 function validatepopForm(thisform)
 {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
 
	jQuery('#submit_popform').hide();
	jQuery('#wait_popform').show();
	
	if(jQuery.trim(jQuery('#pname').val())=='' || jQuery.trim(jQuery('#pname').val())=='Name*')
	{
		alert("Please enter your Name.");
		jQuery('#submit_popform').show();
		jQuery('#wait_popform').hide();
		jQuery('#pname').focus();
		return false;
	}	
	
	if(jQuery.trim(jQuery('#pphone').val())=='' || jQuery.trim(jQuery('#pphone').val())=='Phone*')
	{
		alert("Please enter your Phone Number.");
		jQuery('#submit_popform').show();
		jQuery('#wait_popform').hide();
		jQuery('#pphone').focus();
		return false;
	}
			
	if(jQuery.trim(jQuery('#pemail').val())=='' || jQuery.trim(jQuery('#pemail').val())=='Email*')
	{
		alert("Please enter your Email Address.");
		jQuery('#submit_popform').show();
		jQuery('#wait_popform').hide();
		jQuery('#pemail').focus();
		return false;
	}	
		
	if(jQuery.trim(jQuery('#pemail').val())!='' && !emailReg.test(jQuery.trim(jQuery('#pemail').val()))) 
	{
		 alert("Sorry, you have entered an invalid Email Address.");
		jQuery('#submit_popform').show();
		jQuery('#wait_popform').hide();
		 jQuery('#pemail').select();
		 jQuery('#pemail').focus();
		 return false;	 
	}
	
	
	
	if(jQuery.trim(jQuery('#pcomments').val())=='' ||  jQuery.trim(jQuery('#pcomments').val())=='Questions/Comments*')
	{
		alert("Please enter your Questions/Comments.");
		jQuery('#submit_popform').show();
		jQuery('#wait_popform').hide();
		jQuery('#pcomments').focus();
		return false;
	}

    if(jQuery.trim(jQuery('#captcha_hid_pop').val())=='')
    	{
		  alert("The shape you selected is incorrect, please select the right one.");
		  jQuery('#submit_popform').show();
		  jQuery('#wait_popform').hide();
		  jQuery('#captcha_hid_pop').select();
		  jQuery('#captcha_hid_pop').focus();
		  return false;
	   }
   	validateCaptchapop('<?php bloginfo('stylesheet_directory'); ?>/verify_captcha_pop.php');
	return false;
}
//--------------------------------- Captcha Validation -------------------//
//--------------------------------- Captcha Refresh -------------------//
function refreshCapchapop(arg2)
{
jQuery("#captcha_div_pop").load('<?php bloginfo('stylesheet_directory'); ?>/captcha_code_pop.php?id=4');
}
//--------------------------------- Captcha Refresh -------------------//
//--------------------------------- Captcha Validation -------------------//
function validateCaptchapop(argUrl)
{
	var url=argUrl;
	var captchavalue=document.mainformPopup.captcha_hid_pop.value;

$.ajax({
				type: "GET",
				url: url,
				data: "captchaValpop="+captchavalue,
				success: function(data){
				
				 if(data=="yes")
				 {	
				 //alert(data);			  	
				    document.mainformPopup.submit();
				 }
				 else
				 {
				// alert(data);
				   alert("Incorrect answer, please select the right shape.");
				   document.getElementById('submit_popform').style.display ='';
				   document.getElementById('wait_popform').style.display ='none';
		 		   refreshCapchapop();
				   return false;
				 }
					
			}
	  });
}
//--------------------------------- Captcha Validation -------------------//
</script>
 
</body>
</html>

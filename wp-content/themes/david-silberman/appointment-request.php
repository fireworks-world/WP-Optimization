<?php
/*
Template Name: Appointment Request
*/
?>

<?php $gfid = 3; $gfajax = false; ?>
<?php include("site-header.php"); ?>

<?php include("inner-banner.php"); ?>

<!--Inner Content area Start -->

<div class="inner-content-area">
<div class="inner-content-area-in">


<!--Inner Content area Left  -->

<div class="inner-content-area-left">






 

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<h1><?php the_title(); ?></h1>
<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
<?php endwhile; endif; ?>
<style>
#ui-datepicker-div { font-size: 12px; } 
</style>
<div class="contact_wrapper">
<p>If you would like to make an appointment with Dr. Silberman, please fill in the form and the office will contact you to confirm your choice of time.</p>

<?php

gravity_form( $gfid, false, false, false, null, $gfajax, 1, true );
	/*
?>

<form name="formcontact" id="formcontact" action="<?php bloginfo('stylesheet_directory'); ?>/mails/mail.php" method="post">

<div class="contact-form">
<label>Salutation*</label>
<select>
<option selected="selected" value="Mr.">Mr.</option>
<option value="Mrs.">Mrs.</option>
<option value="Ms.">Ms.</option>
<option value="Dr.">Dr.</option>
</select>
<br clear="all">
<label>First Name*</label>
<input type="text" name="apfname" id="apfname" title="First Name" onKeyPress="if(event.keyCode=='13') return validateContactForm(document.formcontact);" onChange="refreshCapchaContact();" tabindex="901"><br clear="all">
<label>Last Name*</label>
<input type="text" name="aplname" id="aplname" title="Last Name" onKeyPress="if(event.keyCode=='13') return validateContactForm(document.formcontact);" tabindex="902"><br clear="all">
<label>Address*</label>
<textarea name="apaddress" id="apaddress" cols="" rows="" title="Address" tabindex="903"></textarea>
<br clear="all">
<label>City*</label>
<input type="text" name="apcity" id="apcity" title="City" onKeyPress="if(event.keyCode=='13') return validateContactForm(document.formcontact);" tabindex="904"><br clear="all">
<label>State*</label>
<input type="text" name="apstate" id="apstate" title="State" onKeyPress="if(event.keyCode=='13') return validateContactForm(document.formcontact);" tabindex="905"><br clear="all">
<label>Zip code*</label>
<input type="text" name="apzip" id="apzip" title="Zip code" onKeyPress="if(event.keyCode=='13') return validateContactForm(document.formcontact);" tabindex="906"><br clear="all">
<label>Phone*</label>
<input type="text" name="apphone" id="apphone" title="Phone" onKeyPress="if(event.keyCode=='13') return validateContactForm(document.formcontact);" tabindex="907"><br clear="all">
<label>Email*</label>
<input type="text" name="apemail" id="apemail" title="Email" onKeyPress="if(event.keyCode=='13') return validateContactForm(document.formcontact);" tabindex="908"><br clear="all">


<label>Questions/Comments*</label>
<textarea name="apcomments" id="apcomments" cols="" rows="" title="Questions/Comments" tabindex="909"></textarea>
<br clear="all">
<label>Select One*</label>
<div class="radio-wrap">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td> <div class="input-out"><p>New Patient</p><input class="radio-btt" name="appatient" checked="checked" id="newpatient" type="radio" value="New Patient" onKeyPress="if(event.keyCode=='13') return validateContactForm(document.formcontact);" tabindex="910"></div></td>
    <td><div class="input-out"><p>Current Patient</p><input class="radio-btt" name="appatient" id="curpatient" type="radio" value="Current Patient" onKeyPress="if(event.keyCode=='13') return validateContactForm(document.formcontact);" tabindex="911"></div></td>
  </tr>
</table>
</div><br clear="all">
<p>You will be called during business hours on the date and at the time requested. </p>
<label>Best day and Time to call*</label>
<input type="text" title="Best day and Time to call" name="apbestday" id="apbestday" value="" class="datetime" onKeyPress="if(event.keyCode=='13') return validateContactForm(document.formcontact);" tabindex="912"><br clear="all">
<label>Reason for Appointment*</label>
<textarea name="apreason" id="apreason" cols="" rows="" title="Reason for Appointment"  tabindex="913" ></textarea>
<br clear="all">
<p>Please indicate your choice of day and time for an appointment and provide an alternative. Dr. Silberman's office will call to confirm the date and time. </p>
<label>Please choose a date</label>
<input type="text" name="apappointmentdate" id="apappointmentdate" title="Please choose a date" value="" class="datetime" onKeyPress="if(event.keyCode=='13') return validateContactForm(document.formcontact);" tabindex="914"><br clear="all">
<label>Please select an alternative date</label>
<input type="text" name="apalternativedate" id="apalternative" title="Please select an alternative date" value="" class="datetime" onKeyPress="if(event.keyCode=='13') return validateContactForm(document.formcontact);" tabindex="915"><br clear="all">
</div>

<div id="captcha_div_contact"><?php include( 'captcha_code_appointment_form.php'); ?></div>
<br clear="all">

<div style=" height:37px;">
<a href="JavaScript:void(0);" title="Submit" tabindex="917" class="submit_btn" onClick="validateContactForm();" id="submit_contactform">Submit</a>

<div id="wait_contactform" class="contact-loader" style="display:none; float:right; height:35px; ">
		<div style="float:left; margin:3px 0px 13px 0px;"><img src="<?php bloginfo('stylesheet_directory'); ?>/shapes/wait.gif" align="left" border="0" class="loader-img"/ style="margin-right:5px; margin-top:3px; float:left;"></div>
        <div style="float: left; text-align: left; font-size:11px; font-family:'Open Sans', 'sans-serif'; color:#000; margin:5px 0px 9px 0px;">Please&nbsp;wait...</div>
   	</div>


 <input type="hidden" name="captcha_hid_contact" id="captcha_hid_contact" value="" />

</form>
<br clear="all" />


</div>
<?php */ ?>
</div>








</div>



<!--Inner Content area left End  -->

<!--Inner Side Bar Start-->
<?php include("inner-side-bar.php"); ?>


<!--Inner Side Bar End -->
<div class="clear"></div>
</div>
<div class="clear"></div>

</div>
<!--Inner Content area End -->



<script type="text/javascript">
//--------------------------------- Save Captcha Function-------------------//
function save_captcha_contact(obj,arg)
{
_link=document.links;

for(i=0;i<_link.length;i++)
{
	if(_link[i].className=="captcha-image-contact") {	
		if(_link[i]!=obj) {
			_link[i].childNodes[0].style.border='1px solid #0da6e8';
		} else {
			_link[i].childNodes[0].style.border='1px solid #000';
		}
	}
}

document.getElementById("captcha_hid_contact").value=arg;
}
//--------------------------------- Save Captcha Function-------------------//
//--------------------------------- Captcha Validation-------------------//
 function validateContactForm(thisform)
 {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
 
	jQuery('#submit_contactform').hide();
	jQuery('#wait_contactform').show();

	if(jQuery.trim(jQuery('#apfname').val())=='')
	{
		alert("Please enter your First Name.");
		jQuery('#submit_contactform').show();
		jQuery('#wait_contactform').hide();
		jQuery('#apfname').focus();
		return false;
	}	
	if(jQuery.trim(jQuery('#aplname').val())=='')
	{
		alert("Please enter your Last Name.");
		jQuery('#submit_contactform').show();
		jQuery('#wait_contactform').hide();
		jQuery('#aplname').focus();
		return false;
	}	
	if(jQuery.trim(jQuery('#apaddress').val())=='')
	{
		alert("Please enter your Address.");
		jQuery('#submit_contactform').show();
		jQuery('#wait_contactform').hide();
		jQuery('#apaddress').focus();
		return false;
	}	
	if(jQuery.trim(jQuery('#apcity').val())=='')
	{
		alert("Please enter your City.");
		jQuery('#submit_contactform').show();
		jQuery('#wait_contactform').hide();
		jQuery('#apcity').focus();
		return false;
	}	
	if(jQuery.trim(jQuery('#apstate').val())=='')
	{
		alert("Please enter your State.");
		jQuery('#submit_contactform').show();
		jQuery('#wait_contactform').hide();
		jQuery('#apstate').focus();
		return false;
	}	
	if(jQuery.trim(jQuery('#apzip').val())=='')
	{
		alert("Please enter your Zip Code.");
		jQuery('#submit_contactform').show();
		jQuery('#wait_contactform').hide();
		jQuery('#apzip').focus();
		return false;
	}	

  if(jQuery.trim(jQuery('#apphone').val())=='')
	{
		alert("Please enter your Phone Number.");
		jQuery('#submit_contactform').show();jQuery('#wait_contactform').hide();
		jQuery('#apphone').focus();
		return false;
	}

	if(jQuery.trim(jQuery('#apemail').val())=='')
	{
		alert("Please enter your Email Address.");
		jQuery('#submit_contactform').show();jQuery('#wait_contactform').hide();
		jQuery('#apemail').focus();
		return false;
	}	
		
	if(jQuery.trim(jQuery('#apemail').val())!='Email*' && !emailReg.test(jQuery.trim(jQuery('#apemail').val()))) 
	{
		 alert("Sorry, you have entered an invalid Email Address.");
		 jQuery('#submit_contactform').show();jQuery('#wait_contactform').hide();
		 jQuery('#apemail').select();
		 jQuery('#apemail').focus();
		 return false;	 
	}
	

	if(jQuery.trim(jQuery('#apcomments').val())=='')
	{
		alert("Please enter your Questions/Comments.");
		  jQuery('#submit_contactform').show();jQuery('#wait_contactform').hide();
		jQuery('#apcomments').focus();
		return false;
	}
 	if(jQuery.trim(jQuery('#apbestday').val())=='')
	{
		alert("Please enter your Best day and Time to call.");
		  jQuery('#submit_contactform').show();jQuery('#wait_contactform').hide();
		jQuery('#apbestday').focus();
		return false;
	}
 	if(jQuery.trim(jQuery('#apreason').val())=='')
	{
		alert("Please enter your Reason for Appointment.");
		  jQuery('#submit_contactform').show();jQuery('#wait_contactform').hide();
		jQuery('#apreason').focus();
		return false;
	}
 
    if(jQuery.trim(jQuery('#captcha_hid_contact').val())=='')
    	{
		  alert("The shape you selected is incorrect, please select the right one.");
		  jQuery('#submit_contactform').show();jQuery('#wait_contactform').hide();
		  jQuery('#captcha_hid_contact').select();
		  jQuery('#captcha_hid_contact').focus();
		  return false;
	   }

   	validateCaptchaContact('<?php bloginfo('stylesheet_directory'); ?>/verify_captcha_appointment_form.php');
	
	return false;
}
//--------------------------------- Captcha Validation -------------------//
//--------------------------------- Captcha Refresh -------------------//
function refreshCapchaContact(arg2)
{
jQuery("#captcha_div_contact").load('<?php bloginfo('stylesheet_directory'); ?>/captcha_code_appointment_form.php?id=2');
}
//--------------------------------- Captcha Refresh -------------------//
//--------------------------------- Captcha Validation -------------------//
function validateCaptchaContact(argUrl)
{
	var url=argUrl;
	//var captchavalue=document.formcontact.captcha_hid_contact.value;
	var captchavalue = $('#captcha_hid_contact').val();
	//alert(captchavalue);
$.ajax({
				type: "GET",
				url: url,
				data: "captchaVal="+captchavalue,
				success: function(data){
				//alert(data);
				 if(data=="yes")
				 {	

				// alert(data);			  	
				    //document.formcontact.submit();
					//if(jQuery.trim(jQuery('#contcomments').val())=='' || jQuery.trim(jQuery('#contcomments').val())=='Comments'){
					//document.formcontact.contcomments.value="";
					//}

					$('#formcontact').submit();
				 }
				 else
				 {
				 //alert(data);
				   alert("Incorrect answer, please select the right shape.");
				   document.getElementById('submit_contactform').style.display ='';
				   document.getElementById('wait_contactform').style.display ='none';
		 		   refreshCapchaContact();
				   return false;
				 }
					
			}
	  });
}
//--------------------------------- Captcha Validation -------------------//
</script>









<?php // include("inner-bottom-banner.php"); ?>
<?php // include("bottom-news-letter.php"); ?>
<?php include("site-footer.php"); ?>
<?php
/*
Template Name: Contact Page
*/
?>
<?php $gfid = 1; $gfajax = true; ?>
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

<div class="contact_wrapper">
<p style="padding-bottom:2px;">Dr. Silberman and his staff always welcome questions from patients as well as prospective patients. Thanks.</p>

	<div class="contact-form-main">
	<div class="contact-form-left">
		<?php 
gravity_form( $gfid, false, false, false, null, $gfajax, 1, true );
?>
</div></div>

<?php /*
<form name="formcontact" id="formcontact" action="<?php bloginfo('stylesheet_directory'); ?>/mails/mail.php" method="post">


<div class="contact-form-left">

<input name="contname" id="contname" type="text" value="Name*" placeholder="Name*" title="Name" onKeyPress="if(event.keyCode=='13') return validateContactForm(document.formcontact);" onChange="refreshCapchaContact();" tabindex="101" onBlur="if(this.value=='')this.value=this.defaultValue;" onFocus="if(this.value==this.defaultValue)this.value='';" />
<input  name="contphone" id="contphone" type="text" value="Phone*" placeholder="Phone*" title="Phone" onKeyPress="if(event.keyCode=='13') return validateContactForm(document.formcontact);" tabindex="103" onBlur="if(this.value=='')this.value=this.defaultValue;" onFocus="if(this.value==this.defaultValue)this.value='';" />
<input name="contemail" id="contemail" type="text" value="Email*" placeholder="Email*" title="Email" onKeyPress="if(event.keyCode=='13') return validateContactForm(document.formcontact);" tabindex="104" onBlur="if(this.value=='')this.value=this.defaultValue;" onFocus="if(this.value==this.defaultValue)this.value='';"  />
<input type="text" name="contcity" id="contcity" title="City"  placeholder="City" value="City" onKeyPress="if(event.keyCode=='13') return validateContactForm(document.formcontact);" tabindex="105" onBlur="if(this.value=='')this.value=this.defaultValue;" onFocus="if(this.value==this.defaultValue)this.value='';">
</div>

<div class="contact-form-right">
<input type="text" name="contstate" id="contstate" title="State" value="State" placeholder="State" onKeyPress="if(event.keyCode=='13') return validateContactForm(document.formcontact);" tabindex="106" onBlur="if(this.value=='')this.value=this.defaultValue;" onFocus="if(this.value==this.defaultValue)this.value='';">
<textarea name="contcomments" id="contcomments" cols="" rows=""placeholder="Questions/Comments*" title="Questions/Comments"  tabindex="107" onBlur="if(this.value=='')this.value=this.defaultValue;" onFocus="if(this.value==this.defaultValue)this.value='';" >Questions/Comments*</textarea>





<div id="captcha_div_contact"><?php include( 'captcha_code_contact_form.php'); ?></div>
<br clear="all">


<a href="JavaScript:void(0);" title="Submit" tabindex="109" class="submit_btn" onClick="validateContactForm();" id="submit_contactform">Submit</a>

<div id="wait_contactform" class="contact-loader" style="display:none; float:right; height:35px; margin-bottom:4px;  ">
		<div style="float:left; margin:5px 0px 0px 0px;"><img src="<?php bloginfo('stylesheet_directory'); ?>/shapes/wait.gif" align="left" border="0" class="loader-img"/ style="margin-right:5px; margin-top:3px; float:left;"></div>
        <div style="float: left; text-align: left; font-size:11px; font-family:'Open Sans', 'sans-serif'; color:#000; margin:5px 0px 0px 0px;">Please&nbsp;wait...</div>
   	</div>



 <input type="hidden" name="captcha_hid_contact" id="captcha_hid_contact" value="" />
</div><br clear="all">
</form>
<?php */ ?>

</div>




<br clear="all" />


</div>

<?php include("inner-side-bar.php"); ?>

</div>

</div>

<!--Inner Content area left End  -->

<!--Inner Side Bar Start-->


</div>
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

	if(jQuery.trim(jQuery('#contname').val())=='Name*' || jQuery.trim(jQuery('#contname').val())=='')
	{
		alert("Please enter your Name.");
		jQuery('#submit_contactform').show();
		jQuery('#wait_contactform').hide();
		jQuery('#contname').focus();
		return false;
	}	

  if(jQuery.trim(jQuery('#contphone').val())=='Phone*' || jQuery.trim(jQuery('#contphone').val())=='')
	{
		alert("Please enter your Phone Number.");
		jQuery('#submit_contactform').show();jQuery('#wait_contactform').hide();
		jQuery('#contphone').focus();
		return false;
	}

	if(jQuery.trim(jQuery('#contemail').val())=='Email*' || jQuery.trim(jQuery('#contemail').val())=='')
	{
		alert("Please enter your Email Address.");
		jQuery('#submit_contactform').show();jQuery('#wait_contactform').hide();
		jQuery('#contemail').focus();
		return false;
	}	
		
	if(jQuery.trim(jQuery('#contemail').val())!='Email*' && !emailReg.test(jQuery.trim(jQuery('#contemail').val()))) 
	{
		 alert("Sorry, you have entered an invalid Email Address.");
		 jQuery('#submit_contactform').show();jQuery('#wait_contactform').hide();
		 jQuery('#contemail').select();
		 jQuery('#contemail').focus();
		 return false;	 
	}
	

	if(jQuery.trim(jQuery('#contcomments').val())=='Questions/Comments*' || jQuery.trim(jQuery('#contcomments').val())=='')
	{
		alert("Please enter your Questions/Comments.");
		  jQuery('#submit_contactform').show();jQuery('#wait_contactform').hide();
		jQuery('#contcomments').focus();
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

   	validateCaptchaContact('<?php bloginfo('stylesheet_directory'); ?>/verify_captcha_contact_form.php');
	
	return false;
}
//--------------------------------- Captcha Validation -------------------//
//--------------------------------- Captcha Refresh -------------------//
function refreshCapchaContact(arg2)
{
jQuery("#captcha_div_contact").load('<?php bloginfo('stylesheet_directory'); ?>/captcha_code_contact_form.php?id=2');
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
					if(jQuery.trim(jQuery('#contcity').val())=='' || jQuery.trim(jQuery('#contcity').val())=='City'){
						document.formcontact.contcity.value="";
					}
					if(jQuery.trim(jQuery('#contstate').val())=='' || jQuery.trim(jQuery('#contstate').val())=='State'){
						document.formcontact.contstate.value="";
					}
					
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
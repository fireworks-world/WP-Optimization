<!--Inner Side Bar Start  -->

<div class="inner-side-bar">

<?php if(!is_page(265) && !is_page(267)) {?>
<div class="side-form">
<h3>REQUEST APPOINTMENT</h3>
<div class="side-form-in">


<?php
gravity_form( $gfid, false, false, false, null, $gfajax, 1, true );

/* ?>

<form name="sidebarForm" id="sidebarForm" action="<?php bloginfo('stylesheet_directory'); ?>/mails/mail.php" method="post">
<input tabindex="201" title="Name" name="sname" id="sname" type="text" placeholder="Name*" value="Name*"  onBlur="if(this.value=='')this.value=this.defaultValue;" onFocus="if(this.value==this.defaultValue)this.value='';" onKeyPress="if(event.keyCode=='13')return validatesidebarForm(document.sidebarForm);"  onchange="refreshCapchasidebar();"/ >
<input tabindex="202" title="Phone" name="sphone" id="sphone" type="text" placeholder="Phone*" value="Phone*" onBlur="if(this.value=='')this.value=this.defaultValue;" onFocus="if(this.value==this.defaultValue)this.value='';" onKeyPress="if(event.keyCode=='13')return validatesidebarForm(document.sidebarForm);" />	
<input tabindex="203" title="Email" name="semail" id="semail" type="text" placeholder="Email*" value="Email*" onBlur="if(this.value=='')this.value=this.defaultValue;" onFocus="if(this.value==this.defaultValue)this.value='';" onKeyPress="if(event.keyCode=='13')return validatesidebarForm(document.sidebarForm);" />	
<textarea tabindex="204" title="Questions/Comments" name="scomments" id="scomments" placeholder="Questions/Comments*" cols="" rows=""  onBlur="if(this.value=='')this.value=this.defaultValue;" onFocus="if(this.value==this.defaultValue)this.value='';"  class="texteria"/>Questions/Comments*</textarea>			


<div class="side-form-cap">
<div id="inner-capcha"><?php include('captcha_code_side.php'); ?>	</div></div><br clear="all" />

<div style="height:35px;">
<div id="wait_sideform" class="contact-loader" style="display:none; float:right; ">
		<div style="float:left; margin:3px 0px 0px 0px;"><img src="<?php bloginfo('stylesheet_directory'); ?>/shapes/wait.gif" align="left" border="0" class="loader-img"/></div>
        <div style="float: left; text-align: left; font-size:11px; font-family:Open Sans,sans-serif; color:#000; margin:5px 0px 0px 5px;">Please&nbsp;wait...</div>
		
   	</div><input type="hidden" name="captcha_hid_side" id="captcha_hid_side" value="" />	
    <a href="JavaScript:void(0);" title="Submit" tabindex="206" class="side-form-cap-sub" onClick="validatesidebarForm();" id="submit_sideform">Submit</a>
	 <br clear="all" />
</div>
</form>
<? */ ?>
</div>
<div class="clear"></div>
</div>
<?php }?>
<div class="side-bar-box">
<h3>SERVICES</h3>


<ul>
        <li><a title="Dentistry for Children, Young Adults" href="<?php bloginfo('wpurl'); ?>/services/dentistry-for-children-young-adults" <?php if(is_page(222)) { echo 'class="active"'; }?>>DENTISTRY FOR CHILDREN, YOUNG ADULTS</a></li>
        <li><a title="Cavity Treatment" href="<?php bloginfo('wpurl'); ?>/services/cavity-treatment" <?php if(is_page(224)) { echo 'class="active"'; }?>>Cavity Treatment</a></li>
        <li><a title="Implant" href="<?php bloginfo('wpurl'); ?>/services/implant" <?php if(is_page(226)) { echo 'class="active"'; }?>>Implant</a></li>
        <li><a title="Root Canal" href="<?php bloginfo('wpurl'); ?>/services/root-canal" <?php if(is_page(228)) { echo 'class="active"'; }?>>Root Canal</a></li>
       
        <li><a title="Short Term Braces" href="<?php bloginfo('wpurl'); ?>/services/short-term-braces" <?php if(is_page(232)) { echo 'class="active"'; }?>>Short Term Braces</a></li>
        <li><a title="Snoring &amp; Sleep Apnea Treatment" href="<?php bloginfo('wpurl'); ?>/services/snoring-sleep-apnea-treatment" <?php if(is_page(234)) { echo 'class="active"'; }?>>Snoring &amp; Sleep Apnea Treatment</a></li>
        <li><a title="Comprehensive Orthodontics" href="<?php bloginfo('wpurl'); ?>/services/comprehensive-orthodontics" <?php if(is_page(236)) { echo 'class="active"'; }?>>Comprehensive Orthodontics</a></li>
        <li><a title="Invisalign" href="<?php bloginfo('wpurl'); ?>/services/invisalign" <?php if(is_page(238)) { echo 'class="active"'; }?>>Invisalign</a></li>
        <li><a title="Gum Treatment" href="<?php bloginfo('wpurl'); ?>/services/gum-treatment" <?php if(is_page(240)) { echo 'class="active"'; }?>>Gum Treatment</a></li>
        <li><a title="Joint/Muscle Treatment" href="<?php bloginfo('wpurl'); ?>/services/jointmuscle-treatment" <?php if(is_page(242)) { echo 'class="active"'; }?>>Joint/Muscle Treatment</a></li>
        <li><a title="Digital X-rays and Records" href="<?php bloginfo('wpurl'); ?>/services/digital-x-rays-and-records" <?php if(is_page(248)) { echo 'class="active"'; }?>>Digital X-rays and Records </a></li>
        </ul>



</div>








</div>
<div class="clear"></div>
</div>
<script type="text/javascript">
//--------------------------------- Save Captcha Function-------------------//
function save_captcha_sidebar(obj,arg)
{
_link=document.links;

for(i=0;i<_link.length;i++)
{
	if(_link[i].className=="captcha-image-contact-page") {	
		if(_link[i]!=obj) {
			_link[i].childNodes[0].style.border='1px solid #fff';
		} else {
			_link[i].childNodes[0].style.border='1px solid #000';
		}
	}
}
document.getElementById("captcha_hid_side").value=arg;
}
//--------------------------------- Save Captcha Function-------------------//
//--------------------------------- Captcha Validation-------------------//
 function validatesidebarForm(thisform)
 {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
 
	jQuery('#submit_sideform').hide();
	jQuery('#wait_sideform').show();
	
	if(jQuery.trim(jQuery('#sname').val())=='' || jQuery.trim(jQuery('#sname').val())=='Name*')
	{
		alert("Please enter your Name.");
		jQuery('#submit_sideform').show();
		jQuery('#wait_sideform').hide();
		jQuery('#sname').focus();
		return false;
	}	
	
	if(jQuery.trim(jQuery('#sphone').val())=='' || jQuery.trim(jQuery('#sphone').val())=='Phone*')
	{
		alert("Please enter your Phone Number.");
		jQuery('#submit_sideform').show();
		jQuery('#wait_sideform').hide();
		jQuery('#sphone').focus();
		return false;
	}
			
	if(jQuery.trim(jQuery('#semail').val())=='' || jQuery.trim(jQuery('#semail').val())=='Email*')
	{
		alert("Please enter your Email Address.");
		jQuery('#submit_sideform').show();
		jQuery('#wait_sideform').hide();
		jQuery('#semail').focus();
		return false;
	}	
		
	if(jQuery.trim(jQuery('#semail').val())!='' && !emailReg.test(jQuery.trim(jQuery('#semail').val()))) 
	{
		 alert("Sorry, you have entered an invalid Email Address.");
		jQuery('#submit_sideform').show();
		jQuery('#wait_sideform').hide();
		 jQuery('#semail').select();
		 jQuery('#semail').focus();
		 return false;	 
	}
	
	
	if(jQuery.trim(jQuery('#scomments').val())=='' ||  jQuery.trim(jQuery('#scomments').val())=='Questions/Comments*')
	{
		alert("Please enter your Questions/Comments.");
		jQuery('#submit_sideform').show();
		jQuery('#wait_sideform').hide();
		jQuery('#scomments').focus();
		return false;
	}
 
    if(jQuery.trim(jQuery('#captcha_hid_side').val())=='')
    	{
		  alert("The shape you selected is incorrect, please select the right one.");
		  jQuery('#submit_sideform').show();
		  jQuery('#wait_sideform').hide();
		  jQuery('#captcha_hid_side').select();
		  jQuery('#captcha_hid_side').focus();
		  return false;
	   }
   	validateCaptchasidebar('<?php bloginfo('stylesheet_directory'); ?>/verify_captcha_side.php');
	return false;
}
//--------------------------------- Captcha Validation -------------------//
//--------------------------------- Captcha Refresh -------------------//
function refreshCapchasidebar(arg2)
{

jQuery("#inner-capcha").load('<?php bloginfo('stylesheet_directory'); ?>/captcha_code_side.php?id=4');
}
//--------------------------------- Captcha Refresh -------------------//
//--------------------------------- Captcha Validation -------------------//
function validateCaptchasidebar(argUrl)
{
	var url=argUrl;
	var captchavalue=document.sidebarForm.captcha_hid_side.value;

$.ajax({
				type: "GET",
				url: url,
				data: "captchaValcontact="+captchavalue,
				success: function(data){
				
				 if(data=="yes")
				 {	
				 //alert(data);			  	
				    document.sidebarForm.submit();
				 }
				 else
				 {
				// alert(data);
				   alert("Incorrect answer, please select the right shape.");
				   document.getElementById('submit_sideform').style.display ='';
				   document.getElementById('wait_sideform').style.display ='none';
		 		   refreshCapchasidebar();
				   return false;
				 }
					
			}
	  });
}
//--------------------------------- Captcha Validation -------------------//
</script>	
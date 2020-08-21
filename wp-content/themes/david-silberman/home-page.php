<?php
/*
Template Name: Home Page
*/
?>
<?php $gfid = 2; $gfajax = true; ?>
<?php include("site-header.php"); ?>

<?php include("home-banner.php"); ?>



<!--Home Slider Start-->
<div class="home-slider-wrap">
  <div class="home-slider-wrap-in">
    <div class="home-slider-wrap-in-txt">
      <a class="home-slider-wrap-in-txt-h3" href="<?php bloginfo('wpurl'); ?>/about/about-dr-silberman/" title="About Dr. Silberman">About <span>Dr. Silberman</span></a>
     <p>Dr. David Silberman is originally from Oklahoma City. He attended University of Texas at Austin where he majored in Computer Science. Dr. Silberman graduated from the University of Texas Dental Branch in Houston in 1980... <a href="<?php bloginfo('wpurl'); ?>/about/about-dr-silberman/" title="Read More">Read More</a></p> </div>
    <div class="home-slider ">
      <div class="home-before-after">
        <div class="home-before-after-slide">
          <?php 
$gallery_imgs = $wpdb->get_results( 
  "
    SELECT * FROM tbl_gallery_main where status='Y' AND ishome='Y' AND category_id=18
    ORDER BY RAND()
  "
);
$gallery_imgscnt=count($gallery_imgs);

if($gallery_imgscnt>0){
?>

    <div class="banner-slide">
    <ul class="slides" >
    <?php foreach($gallery_imgs as $value){ ?>  
      <li>
      <div class="slide-outer">
      <div class="before-wrap">
         <img src="<?php bloginfo('wpurl'); ?>/wp-content/uploads/gallery/before_thumb/<?php echo $value->before_image_thumb; ?>" title="<?php echo $value->before_imagetitle; ?>" alt="<?php echo $value->before_imagealt; ?>" /></div>
         <div class="after-wrap">
         <img src="<?php bloginfo('wpurl'); ?>/wp-content/uploads/gallery/after_thumb/<?php echo $value->after_image_thumb; ?>" title="<?php echo $value->after_imagetitle; ?>" alt="<?php echo $value->after_imagealt; ?>"/></div>
          <div class="clear"></div>
         </div>
      </li>
       <?php }?>
    </ul>
    
  </div>

 <?php
 }
 else {?>

    <div class="callbacks_container">
            <ul class="rslides" id="slider4">
            
              <li>
                <div class="slide-outer">
                  <div class="before-wrap"> <img src="<?php bloginfo('wpurl'); ?>/wp-content/themes/david-silberman/images/before.jpg" title="Before Image" alt="Before Image" /></div>
                  <div class="after-wrap"><img src="<?php bloginfo('wpurl'); ?>/wp-content/themes/david-silberman/images/after.jpg" title="After Image" alt="After Image"/> </div>
                  <div class="clear"></div>
                </div>
              </li>
    
            </ul>
          </div>
  
<?php }?> 

</div>
       <div class="bf">AFTER</div>
        <div class="af">BEFORE</div>
     </div> 
    </div>
    <div class="clear"></div>
  </div>
</div>
<!--Banner Section End-->
<!--Home Appoinment Wrap Start-->


  <div class="home-form-wrap">
  <div class="home-form-wrap-in">
    <div class="qc_header">
    <h3 style="width:100%;">REQUEST
APPOINTMENT</h3>
</div>
<div class="qc_filler">
  &nbsp;
</div>
  
    <div class="front-form">
      <?php
  gravity_form( $gfid, false, false, false, null, $gfajax, 1, true );
  ?>

</div></div>
<div style="clear:both;"></div>
</div>
  <?php
/*
?>
 <form name="sidebarForm" id="sidebarForm" action="<?php bloginfo('stylesheet_directory'); ?>/mails/mail.php" method="post">
<div class="home-form-wrap">
  <div class="home-form-wrap-in">
    <h3>REQUEST
APPOINTMENT</h3>
  
    <div class="home-form-wrap-form">
        






<input type="hidden" name="title" id="title" value="book"/>    
<input tabindex="201" placeholder="Name*" title="Name" name="sname" id="sname" type="text" value="Name*"  onBlur="if(this.value=='')this.value=this.defaultValue;" onFocus="if(this.value==this.defaultValue)this.value='';" onKeyPress="if(event.keyCode=='13')return validatesidebarForm(document.sidebarForm);"  onchange="refreshCapchasidebar();"/ >
<input tabindex="202" placeholder="Phone*" title="Phone" name="sphone" id="sphone" type="text" value="Phone*" onBlur="if(this.value=='')this.value=this.defaultValue;" onFocus="if(this.value==this.defaultValue)this.value='';" onKeyPress="if(event.keyCode=='13')return validatesidebarForm(document.sidebarForm);" /> 
<input tabindex="203" placeholder="Email*" title="Email" name="semail" id="semail" type="text" value="Email*" onBlur="if(this.value=='')this.value=this.defaultValue;" onFocus="if(this.value==this.defaultValue)this.value='';" onKeyPress="if(event.keyCode=='13')return validatesidebarForm(document.sidebarForm);" />
 <div class="clear"></div>  
<textarea tabindex="204" placeholder="Questions/Comments*" title="Questions/Comments" name="scomments" id="scomments" cols="" rows=""  onBlur="if(this.value=='')this.value=this.defaultValue;" onFocus="if(this.value==this.defaultValue)this.value='';"  class="texteria"/>Questions/Comments*</textarea>     

     
      <div class="clear"></div>
    </div>
    <div class="home-form-wrap-cap" >
     <div class="home-cap"><div id="inner-capcha"><?php include('captcha_code_home.php'); ?>	</div> 
    <div id="wait_sideform" class="contact-loader" style="display:none;float:right; width:100px; ">
		<div style="float:left; margin:3px 0px 0px 0px;"><img src="<?php bloginfo('stylesheet_directory'); ?>/shapes/wait.gif" align="left" border="0" class="loader-img"/></div>
        <div style="float: left; text-align: left; font-size:11px; font-family:Open Sans,sans-serif; color:#fff; margin:0px 0px 0px 5px;">Please&nbsp;wait...</div>
		
   	</div><input type="hidden" name="captcha_hid_side" id="captcha_hid_side" value="" />	
    <a href="JavaScript:void(0);" title="Submit" tabindex="206" class="home-form-sub" onClick="validatesidebarForm();" id="submit_sideform">Submit</a>
	   </div>
    </div>
    <div class="clear"></div>
  </div>
</div>
</form>
<?php */ ?>
<!--Home Appoinment Wrap End-->
<!--Home Middle Wrap Start-->
<div class="home-middle-wrap">
  <div class="home-middle-wrap-in"> 
    <div class="home-middle-wrap-inn">
      <a class="home-middle-wrap-in-head" href="<?php bloginfo('wpurl'); ?>/get-the-beautiful-smile-you-always-dreamed-of" title="Get The Beautiful Smile You Always Dreamed of!">Get The Beautiful Smile </br>You Always Dreamed of! </a>
        
      <div class="home-middle-wrap-in-txt">Short Term braces are the most natural, most conservative and least invasive approach to improve your appearance. Furthermore, Short Term braces cost less than crowns or veneers often thousands... <a href="<?php bloginfo('wpurl'); ?>/get-the-beautiful-smile-you-always-dreamed-of" title="Read More">Read More </a></div>
           
      <div class="clear"></div>
    </div>
    <div class="home-rd-box">
      <div class="home-rd-box-in">
        <div class="home-rd-box-img"><a href="<?php bloginfo('wpurl'); ?>/6-month-braces/overview/" title="6 Month Braces"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/cosmetic.jpg" width="284" height="187" alt="6 Month Braces" /></a></div>
        <div class="clear"></div>
        <div class="home-rd-box-in-bot">
          <h4><a href="<?php bloginfo('wpurl'); ?>/6-month-braces/overview/" title="6 Month Braces">6 Month Braces</a></h4>
          <p>Simply said, it is using braces (orthodontics) to improve the appearance of ones upper...</p>
        </div>
        <div class="box-rd-wrp"> <a class="box-rd" href="<?php bloginfo('wpurl'); ?>/6-month-braces/overview/" title="Read More">Read More</a> </div>
      </div>
      <div class="home-rd-box-in">
        <div class="home-rd-box-img"><a href="<?php bloginfo('wpurl'); ?>/cosmetic-dentistry/tooth-whitening/" title="Cosmetic Dentistry"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/family.jpg" width="284" height="187" alt="Cosmetic Dentistry" /></a></div>
        <div class="clear"></div>
        <div class="home-rd-box-in-bot">
          <h4><a href="<?php bloginfo('wpurl'); ?>/cosmetic-dentistry/tooth-whitening/" title="Cosmetic Dentistry">Cosmetic Dentistry</a></h4>
          <p>The most common and effective method to cosmetically whiten ones teeth involves the use of custom...</p>
        </div>
        <div class="box-rd-wrp"> <a class="box-rd" href="<?php bloginfo('wpurl'); ?>/cosmetic-dentistry/tooth-whitening/" title="Read More">Read More</a> </div>
      </div>
      <div class="home-rd-box-in" style="margin:0px;">
        <div class="home-rd-box-img"><a href="<?php bloginfo('wpurl'); ?>/services/snoring-sleep-apnea-treatment/" title="Snoring & Sleep Apnea Treatment"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/dental.jpg" width="284" height="187" alt="Snoring & Sleep Apnea Treatment" /></a></div>
        <div class="clear"></div>
        <div class="home-rd-box-in-bot">
          <h4><a href="<?php bloginfo('wpurl'); ?>/services/snoring-sleep-apnea-treatment/" title="Snoring & Sleep Apnea Treatment">Snoring & Sleep Apnea
Treatment</a></h4>
          <p>Snoring is the sound made by the vibration of the soft tissue in the back of the throat (such as the...</p>
        </div>
        <div class="box-rd-wrp"> <a class="box-rd" href="<?php bloginfo('wpurl'); ?>/services/snoring-sleep-apnea-treatment/" title="Read More">Read More</a> </div>
      </div>
      <div class="clear"></div>
    </div>
    <!--Home Blog Start-->
    
    
    
<div class="home-blog-wrap">

      <h2><a href=" <?php bloginfo('wpurl'); ?>/blog/" title="From The Blog">From The Blog</a></h2>
      <br clear="all"/>

      <div id="owl-example" class="owl-carousel">

        <?php $numpost = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post'"); ?>
        <?php if($numpost>0){ 
              $args = array( 'numberposts' => 5 );
        $lastposts = get_posts( $args );
        ?>

        <?php
        foreach($lastposts as $post) : setup_postdata($post); 
              ?>


        <div class="c-item">

        <h4><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php if (strlen($post->post_title) > 30 ) {$title=get_the_title(); echo wordLimit($title,30); } else {the_title(); } ?></a></h4>
        <h5><?php the_time('d M Y') ?></h5>
        <p>       
                  <?php       
               // $contentlength=36;
                
               // $content = balanceTags(wp_trim_words( get_the_content(), $num_words = $contentlength, $more = null ), true);
               // $content = apply_filters('the_content', $content);
               // echo $content = str_replace(']]>', ']]>', $content);
                        
                ?>
                
                
        <?php 
          $contentlength=30;
          $content = balanceTags(wp_trim_words( get_the_content(), $num_words = $contentlength, $more = null ), true);
          $content = apply_filters('the_content', $content);
          $content = str_replace(']]>', ']]>', $content);
        ?>
        <?php echo strip_tags($content); ?>
                
                

        </p> 



        </div>



        <?php endforeach; 
        ?>



      </div>
      
      
    <?php }else{echo '<p>Coming Soon!</p>';}?>  
      
      
      <div class="clear"></div>
     
    <?php if($numpost>0){ ?>  <div class="blog-view-wrap">  <a href="<?php bloginfo('wpurl'); ?>/blog/" class="blog-vw" title="View All">View All</a></div><?php }?>
    </div>
    <div class="clear"></div>
    <!--Home Blog End-->
    
    
    
    
    
    
    
    
    
  </div>
  <div class="clear"></div>
</div>
<!--Home Middle Wrap End-->
<!--Home FAQ Wrap Start-->

<?php
	$faq_sql = $wpdb->get_row( 
			"
			SELECT *
			FROM tbl_faq
			WHERE tbl_faq.status ='Y' 
			ORDER BY RAND()
			LIMIT 1 
			"
			);		  

	$faq_count 		= count($faq_sql);
	$faq_id 		= $faq_sql->faq_id;
	$faq_question 	= $faq_sql->faq_question;
	$faq_answer 	= $faq_sql->faq_answer;
	
?>    


<div class="home-faq">

  <div class="home-faq-in">
    <h2> <a href="<?php bloginfo('wpurl'); ?>/6-month-braces/faq/" title="FAQ">FAQ</a></h2>
    <?php
if($faq_count>0){?>  
    <h4><?php echo $faq_question;?></h4>
    <p> <?php echo wordLimit(strip_tags($faq_answer),250); ?></p>
    <div class="blog-view-wrap"> <a class="blog-vw" href="<?php bloginfo('wpurl'); ?>/6-month-braces/faq/" title="Read More">Read More</a> </div>
<?php
}else {
	echo "<p>Coming Soon!</p>";
	}?> 
  </div>
  
</div>
<!--Home FAQ Wrap End-->


<div class="bluestrip-wrap-out">
<div class="bluestrip-wrap">
<img src="<?php bloginfo('stylesheet_directory'); ?>/images/about-icon.png"  alt="" />
<p>Are you a candidate for short-term orthodontics? <br>
Schedule a no-cost, no-obligation visit with Dr. Silberman.</p>
</div>
</div>





<!--Home Video Wrap Start-->
<div class="home-video-wrap">
  <div class="home-video-wrap-in">
    <div class="home-video-wrap-video">
    
    
      <h3><a href="<?php bloginfo('wpurl'); ?>/video-gallery/" title="Video Gallery">VIDEO GALLERY</a></h3>
 <?php
	$video_sql = $wpdb->get_row( 
			"
			SELECT *
			FROM tbl_videogallery
			WHERE tbl_videogallery.status ='Y' 
			ORDER BY RAND()
			LIMIT 1
			"
			);		  

	$video_count = count($video_sql);
	$cnt=0; 
		//$videogallery_id 			= $video_sql->videogallery_id;
		//$videogallery_title 		= $video_sql->title;
		$videogallery_url 			= $video_sql->url;
		//$videogallery_description	= $video_sql->description;
		$youtubeid =  substr($videogallery_url,-11);
	
?>     
<?php
if($video_count>0){?>      
      <div class="home-video-box" itemscope itemtype="http://schema.org/VideoGallery">
	     <!--<iframe width="100%" height="100%" frameborder="0" allowfullscreen="" src="//www.youtube.com/embed/<?php echo $youtubeid; ?>"></iframe>-->
		 <iframe width="100%" height="100%" src="https://www.youtube.com/embed/FZ4mHUNX0N8" frameborder="0" allowfullscreen itemprop="url"></iframe>
		 </div>
<?php }
else {
	echo "<p>Coming Soon!</p>";
	}?>      
      
    </div>
    <div class="home-bottom-form">

            <h3>Request Information</h3>
            <?php 
  gravity_form( 7, false, false, false, null, $gfajax, 1, true );
/*
  ?>
  
    <form name="mainformContact" id="mainformContact" action="<?php bloginfo('stylesheet_directory'); ?>/mails/mail.php" method="post">

      <h3>Request Information</h3>
     <input tabindex="401" title="Name" placeholder="Name*" name="cname" id="cname" type="text" value="Name*"  onBlur="if(this.value=='')this.value=this.defaultValue;" onFocus="if(this.value==this.defaultValue)this.value='';" onKeyPress="if(event.keyCode=='13')return validatecontactForm(document.mainformContact); "  onchange="refreshCapchacontact();" / >
	 
	 <input tabindex="402" title="Phone" placeholder="Phone*" name="cphone" id="cphone" type="text" value="Phone*" onBlur="if(this.value=='')this.value=this.defaultValue;" onFocus="if(this.value==this.defaultValue)this.value='';" onKeyPress="if(event.keyCode=='13')return validatecontactForm(document.mainformContact);" />	
	 
	 
	 <input tabindex="403" title="Email" placeholder="Email*" name="cemail" id="cemail" type="text" value="Email*" onBlur="if(this.value=='')this.value=this.defaultValue;" onFocus="if(this.value==this.defaultValue)this.value='';" onKeyPress="if(event.keyCode=='13')return validatecontactForm(document.mainformContact);" style="margin-right:0px;"/>	
	 
      <textarea tabindex="404" name="ccomments" id="ccomments" placeholder="Questions/Comments*"  title="Questions/Comments" cols="" rows=""  onBlur="if(this.value=='')this.value=this.defaultValue;" onFocus="if(this.value==this.defaultValue)this.value='';"  class="texteria"/>Questions/Comments*</textarea>
      <div class="home-bottom-form-cap">
         <div class="home-capp"> <div id="captcha_div_contact"><?php include('captcha_code_contact.php'); ?></div> <a tabindex="406" href="JavaScript:void(0);" title="Submit" class="home-bottom-form-sub" onClick="validatecontactForm();" id="submit_contactform">Submit</a> 
         <div id="wait_contactform" style="display:none; width:95px; float:right; margin:0px 0px 0px 0px; ">
		<div style="float:left; margin:5px 0 0 0;"><img src="<?php bloginfo('stylesheet_directory'); ?>/shapes/wait.gif" align="left" border="0" style="float:right; margin:0px; padding:0px;"/></div>
        <div style="float:right;   font-size:12px; font-family:Open Sans,sans-serif; color:#333; text-align:right; padding:0px; margin:0px;">Please&nbsp;wait...</div>
   	</div>
         <br clear="all">
         </div>

 
</div> <input type="hidden" name="captcha_hid_contact" id="captcha_hid_contact" value="" />	

</form>
<?php */?>

</div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>

<!--Home Video Wrap End-->
<script type="text/javascript">
//--------------------------------- Save Captcha Function-------------------//
function save_captcha_contact(obj,arg)
{
_link=document.links;

for(i=0;i<_link.length;i++)
{
	if(_link[i].className=="captcha-image-side-page") {	
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
 function validatecontactForm(thisform)
 {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
 
	jQuery('#submit_contactform').hide();
	jQuery('#wait_contactform').show();
	
	if(jQuery.trim(jQuery('#cname').val())=='' || jQuery.trim(jQuery('#cname').val())=='Name*')
	{
		alert("Please enter your Name.");
		jQuery('#submit_contactform').show();
		jQuery('#wait_contactform').hide();
		jQuery('#cname').focus();
		return false;
	}	
	
	if(jQuery.trim(jQuery('#cphone').val())=='' || jQuery.trim(jQuery('#cphone').val())=='Phone*')
	{
		alert("Please enter your Phone Number.");
		jQuery('#submit_contactform').show();
		jQuery('#wait_contactform').hide();
		jQuery('#cphone').focus();
		return false;
	}
			
	if(jQuery.trim(jQuery('#cemail').val())=='' || jQuery.trim(jQuery('#cemail').val())=='Email*')
	{
		alert("Please enter your Email Address.");
		jQuery('#submit_contactform').show();
		jQuery('#wait_contactform').hide();
		jQuery('#cemail').focus();
		return false;
	}	
		
	if(jQuery.trim(jQuery('#cemail').val())!='' && !emailReg.test(jQuery.trim(jQuery('#cemail').val()))) 
	{
		 alert("Sorry, you have entered an invalid Email Address.");
		jQuery('#submit_contactform').show();
		jQuery('#wait_contactform').hide();
		 jQuery('#cemail').select();
		 jQuery('#cemail').focus();
		 return false;	 
	}
	
	
	if(jQuery.trim(jQuery('#ccomments').val())=='' ||  jQuery.trim(jQuery('#ccomments').val())=='Questions/Comments*')
	{
		alert("Please enter your Questions/Comments.");
		jQuery('#submit_contactform').show();
		jQuery('#wait_contactform').hide();
		jQuery('#ccomments').focus();
		return false;
	}
 
    if(jQuery.trim(jQuery('#captcha_hid_contact').val())=='')
    	{
		  alert("The shape you selected is incorrect, please select the right one.");
		  jQuery('#submit_contactform').show();
		  jQuery('#wait_contactform').hide();
		  jQuery('#captcha_hid_contact').select();
		  jQuery('#captcha_hid_contact').focus();
		  return false;
	   }
   	validateCaptchacontact('<?php bloginfo('stylesheet_directory'); ?>/verify_captcha_contact.php');
	return false;
}
//--------------------------------- Captcha Validation -------------------//
//--------------------------------- Captcha Refresh -------------------//
function refreshCapchacontact(arg2)
{
jQuery("#captcha_div_contact").load('<?php bloginfo('stylesheet_directory'); ?>/captcha_code_contact.php?id=4');
}
//--------------------------------- Captcha Refresh -------------------//
//--------------------------------- Captcha Validation -------------------//
function validateCaptchacontact(argUrl)
{
	var url=argUrl;
//	var captchavalue=document.mainformContact.captcha_hid_contact.value;
	var captchavalue = $('#captcha_hid_contact').val();	
	
	
//alert(captchavalue);
$.ajax({
				type: "GET",
				url: url,
				data: "captchaValside="+captchavalue,
				success: function(data){
				
				 if(data=="yes")
				 {	
						$('#mainformContact').submit();  	
				    //document.mainformContact.submit();
				 }
				 else
				 {
				// alert(data);
				   alert("Incorrect answer, please select the right shape.");
				   document.getElementById('submit_contactform').style.display ='';
				   document.getElementById('wait_contactform').style.display ='none';
		 		   refreshCapchacontact();
				   return false;
				 }
					
			}
	  });
}
//--------------------------------- Captcha Validation -------------------//
</script>








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
			_link[i].childNodes[0].style.border='1px solid #044f64';
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

jQuery("#inner-capcha").load('<?php bloginfo('stylesheet_directory'); ?>/captcha_code_home.php?id=4');
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
<?php // include("bottom-news-letter.php"); ?>


<?php include("site-footer.php"); ?>
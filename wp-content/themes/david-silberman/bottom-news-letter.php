<!--Home News Letter Wrap Start-->
<div class="home-newsletter">
  <div class="home-newsletter-in">
    <div class="home-newsletter-in-sh"> <a href="https://www.facebook.com/" rel="pulse-grow" class="fb pulse-grow" target="_blank" title="Facebook"></a> <a href="https://twitter.com/" rel="pulse-grow" class="tw pulse-grow" target="_blank"  title="Twitter"></a> <a href="https://www.youtube.com" rel="pulse-grow" class="yt pulse-grow" target="_blank"  title="YouTube"></a> <a href="https://ca.linkedin.com/" rel="pulse-grow" class="in pulse-grow" target="_blank"  title="LinkedIn"></a>
      <div class="clear"></div>
    </div>
  <form  id="news_letter" name="news_letter" method="post" action="<?php bloginfo('stylesheet_directory'); ?>/mails/newsletter-mail.php">    
    <div class="home-newsletter-in-nw">
      <h3>Newsletter Signup</h3>
    
      <input value="Email Address*" title="Email Address" name="news_email" id="news_email" onBlur="if(this.value=='')this.value=this.defaultValue;" onFocus="if(this.value==this.defaultValue)this.value='';" onKeyPress="if(event.keyCode=='13')return validate_news(document.news_letter);"/>

      <a href="JavaScript:void(0);" id="submit_news" title="Subscribe" class="home-nw-sub" onclick="validate_news(document.news_letter);return false;" >Subscribe</a>
      
      
<div id="wait_news" style="display:none; margin-top:10px;  margin-bottom:0px;">
		<div style="float:left;"><img src="<?php bloginfo('stylesheet_directory'); ?>/shapes/wait.gif" align="left" border="0" style="margin:0px 5px 0px 20px; padding:0px;"/></div>
        <div style="font-size:13px; font-family:Open Sans,sans-serif; color:#333;">Please&nbsp;wait...</div>
   	</div>        
      
      
      

      </div>
      </form>
          <div class="clear"></div>
  </div>
</div>
<script>
function validate_news(thisform)
 { 
 
     var pemailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
 
	jQuery('#submit_news').hide();
	jQuery('#wait_news').show();
	
	if(jQuery.trim(jQuery('#news_email').val())=='' || jQuery.trim(jQuery('#news_email').val())=='Email Address*' )
	{
		alert("Please enter your Email Address.");
		 jQuery('#submit_news').show();jQuery('#wait_news').hide();
		jQuery('#news_email').focus();
		jQuery('#news_email').select();
		return false;
	}	
		 
	
	if(jQuery.trim(jQuery('#news_email').val())!=''  && !pemailReg.test(jQuery.trim(jQuery('#news_email').val()))) 
	{
	
		 alert("Sorry, you have entered an invalid Email Address.");
		  jQuery('#submit_news').show();jQuery('#wait_news').hide();
		 jQuery('#news_email').select();
		 jQuery('#news_email').focus();
		 return false;	 
	}
	
jQuery('#news_letter').submit();
    //document.news_letter.submit();
}
</script>
<!--Home News Letter Wrap End-->
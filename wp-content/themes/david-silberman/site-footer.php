<!--Footer Start-->

<div class="footer-mid">

  
 <p>
		<a class="top" href="#" title="Top">Top</a>
	</p>
  <div class="footer-mid-in">
    <div class="footer-mid-in-left">
      <ul>
      	 <li><a class="main <?php if(is_page(4)) { echo 'active'; }?>" href="<?php bloginfo('wpurl'); ?>/" title="Home">Home</a></li>
        <li><a href="<?php bloginfo('wpurl'); ?>/about/about-the-practice/" title="About" <?php if (is_404()){}else{ if(in_array("about" ,$url_array)){ echo "class='active'";}}?>>About</a></li>
       	<li><a href="<?php bloginfo('wpurl'); ?>/patient-info/new-patient-forms/" title="Patient Info" <?php if (is_404()){}else{ if(in_array("patient-info" ,$url_array)){ echo "class='active'";}}?>>Patient Info</a></li>
        <li><a href="<?php bloginfo('wpurl'); ?>/6-month-braces/overview/" title="6 Month Braces" <?php if (is_404()){}else{ if(in_array("6-month-braces" ,$url_array)){ echo "class='active'";}}?>>6 Month Braces</a></li>
        <li><a href="<?php bloginfo('wpurl'); ?>/comprehensive-orthodontics/what-is-it/" title="Comprehensive Orthodontics" <?php if (is_404()){}else{ if(!in_array("services",$url_array)){ if(in_array("comprehensive-orthodontics" ,$url_array)){ echo "class='active'";}}}?>>Comprehensive Orthodontics</a></li>
        <li><a href="<?php bloginfo('wpurl'); ?>/cosmetic-dentistry/tooth-whitening/" title="Cosmetic Dentistry" <?php if (is_404()){}else{ if(in_array("cosmetic-dentistry" ,$url_array)){ echo "class='active'";}}?>>Cosmetic Dentistry</a></li>
        <li><a href="<?php bloginfo('wpurl'); ?>/smile-gallery/" title="Smile Gallery" <?php if (is_404()){}else{if(in_array("smile-gallery" ,$url_array)){ echo "class='active'";}}?>>Smile Gallery</a></li>
        <li><a href="<?php bloginfo('wpurl'); ?>/blog/" title="Blog" <?php if (is_404()){}else{if(in_array("blog" ,$url_array)){ echo "class='active'";}}?>>Blog</a></li>
        <li><a href="<?php bloginfo('wpurl'); ?>/contact-us/location/" title="Contact Us" <?php if (is_404()){}else{ if(in_array("contact-us" ,$url_array)){ echo "class='active'";}}?>>Contact Us</a></li>
        <li><a href="<?php bloginfo('wpurl'); ?>/site-map/" title="Site Map" <?php if(is_page(43)) { echo 'class="active"'; }?>>Site Map</a></li>
      </ul>
      
     
    </div>
    
   <ul class="sub-ul">
    <li><a class="main <?php if (is_404()){}else{ if(in_array("services" ,$url_array)){ echo "active";}}?>" href="<?php bloginfo('wpurl'); ?>/services" title="Services">Services</a></li>
   <li class="li-padd-none"> 
   <div class="footer-mid-in-right">
   <ul>
   
	 <li><a href="<?php bloginfo('wpurl'); ?>/services/dentistry-for-children-young-adults/" title="Dentistry for Children, Young Adults" <?php if(is_page(222)) { echo 'class="active"'; }?>>Dentistry for Children, Young Adults</a></li>
       	<li><a href="<?php bloginfo('wpurl'); ?>/services/cavity-treatment/" title="Cavity Treatment" <?php if(is_page(224)) { echo 'class="active"'; }?>>Cavity Treatment</a></li>
        <li><a href="<?php bloginfo('wpurl'); ?>/services/implant/" title="Implant" <?php if(is_page(226)) { echo 'class="active"'; }?>>Implant</a></li>
        <li><a href="<?php bloginfo('wpurl'); ?>/services/root-canal/" title="Root Canal" <?php if(is_page(228)) { echo 'class="active"'; }?>>Root Canal</a></li>
        
        <li><a href="<?php bloginfo('wpurl'); ?>/services/short-term-braces/" title="Short Term Braces" <?php if(is_page(232)) { echo 'class="active"'; }?>>Short Term Braces</a></li>
       
      </ul>
      
         <ul>
          <li><a href="<?php bloginfo('wpurl'); ?>/services/snoring-sleep-apnea-treatment/" title="Snoring & Sleep Apnea Treatment" <?php if(is_page(234)) { echo 'class="active"'; }?>>Snoring & Sleep Apnea Treatment</a></li>
		 <li><a href="<?php bloginfo('wpurl'); ?>/services/comprehensive-orthodontics/" title="Comprehensive Orthodontics" <?php if(is_page(236)) { echo 'class="active"'; }?>>Comprehensive Orthodontics</a></li>
       	<li><a href="<?php bloginfo('wpurl'); ?>/services/invisalign" title="Invisalign" <?php if(is_page(238)) { echo 'class="active"'; }?>>Invisalign</a></li>
        <li><a href="<?php bloginfo('wpurl'); ?>/services/gum-treatment/" title="Gum Treatment" <?php if(is_page(240)) { echo 'class="active"'; }?>>Gum Treatment</a></li>
        <li><a href="<?php bloginfo('wpurl'); ?>/services/jointmuscle-treatment/" title="Joint/Muscle Treatment" <?php if(is_page(242)) { echo 'class="active"'; }?>>Joint/Muscle Treatment</a></li>
        <li><a href="<?php bloginfo('wpurl'); ?>/services/digital-x-rays-and-records/" title="Digital X-rays and Records " <?php if(is_page(248)) { echo 'class="active"'; }?>>Digital X-rays and Records </a></li>
      </ul>
      </div>
      <li></ul>
      



    
    </div>
    
    
    <div class="clear"></div>
  </div>
</div>
<div class="footer-tw">
  <div class="footer-tw-in">
    <p>&copy; <?php echo date('Y');?> General Dentistry, Cosmetic Dentistry, Orthodontics - Shorttermbraces.com. All Rights Reserved.</p>
    <p></p>
    
<div class="techh"> </div></div>
  <div class="clear"></div>
</div>


<script>
   jQuery(document).ready(function(){
     jQuery(window).bind('scroll', function() {
     var navHeight = jQuery( window ).height();
       if (jQuery
(window).scrollTop() > 90) {
         jQuery('nav').addClass('navbar-fixed-top');
       }
       else {
         jQuery('nav').removeClass('navbar-fixed-top');
       }
    });
  });
  
</script>

<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/owl.carousel.min.js"></script>
<script>
  $(document).ready(function() { 
    $("#owl-example").owlCarousel({
      items : 2,
      navigation: true,
      autoPlay:5000
    }); 
  });
</script>





<!-- Gallery Slider Starts Here -->

<script defer src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.flexslider.js"></script>
      <script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.event.move.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.twentytwenty.js"></script>

    <script type="text/javascript">
$(document).ready(function() {
$("#menu").mmenu({
offCanvas: {
position : "right",
zposition : "front"
}
});
});
</script>

  <script type="text/javascript">

    $(window).load(function(){
      $('#carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 210,
        itemMargin: 5,
        asNavFor: '#slider'
      });

      $('#slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        touch: false, 
        sync: "#carousel",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });


      $('.banner-slide').flexslider({
    animation: "slide",
    controlNav:false,
    
  });



    });




  </script>



 <script>
    $(window).load(function(){
      $(".twentytwenty-container[data-orientation!='vertical']").twentytwenty({default_offset_pct: 0.5});
    });
    </script>
	<!-- Google Code for Remarketing Tag -->
<!--------------------------------------------------
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
--------------------------------------------------->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1069186233;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1069186233/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

	
  

<!-- AdLuge Visitor Tracker Starts Here -->
<script type="text/javascript">
var AdLBaseURL = (("https:" == document.location.protocol) ? "https://www.adluge.com/trackerjs/" :
"http://www.adluge.com/trackerjs/");
document.write(unescape("%3Cscript src='" + AdLBaseURL + "visitors-tracker.js' type='text/javascript'%3E%3C/script%3E"));
</script> 
<!-- AdLuge Visitor Tracker Ends Here -->

<!-- AdLuge visitor tracking code starts here -->  
<script type="text/javascript">  
var _aaq = _aaq || [];  
_aaq.push(['trackPageView']);  
_aaq.push(['enableLinkTracking']);  
(function() {
  var u="//track.adluge.com/";
  _aaq.push(['setTrackerUrl', u+'t/']);
  _aaq.push(['setSiteId', 'AL_93']);
  var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];  g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'javascripts/tracker.js'; s.parentNode.insertBefore(g,s);  
})();  
</script>  
<noscript><p><img src="http://track.adluge.com/noscript/?idsite=AL_93" style="border:0;" alt="" /></p></noscript> 
<!-- AdLuge visitor tracking code ends here -->


<!--Footer End-->
<?php wp_footer(); ?>
</body>
</html>

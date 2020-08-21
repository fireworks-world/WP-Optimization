<!DOCTYPE HTML>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
      <meta name="format-detection" content="telephone=no">
      <link rel="icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.ico" />
      <link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.ico" />
      <title><?php 
         if($metatitle){echo $metatitle;}else{
         wp_title( '|', true, 'right' );}
         ?></title>
      <?php if($metadesc!=""){ ?>
      <meta name="description" content="<?php echo $metadesc; ?>">
      <?php }?>
      <link href="<?php bloginfo('stylesheet_directory'); ?>/style-blue.css?ver=8.1" rel="stylesheet" type="text/css" />
      <?php /*?>
      <link href="<?php bloginfo('stylesheet_directory'); ?>/style-green.css" rel="stylesheet" type="text/css" />
      <?php */?>
      <?php /*?>
      <link href="<?php bloginfo('stylesheet_directory'); ?>/style-orange.css" rel="stylesheet" type="text/css" />
      <?php */?>
      <?php /*?>
      <link href="<?php bloginfo('stylesheet_directory'); ?>/style-red.css" rel="stylesheet" type="text/css" />
      <?php */?>
      <?php /*?>
      <link href="<?php bloginfo('stylesheet_directory'); ?>/style-rose.css" rel="stylesheet" type="text/css" />
      <?php */?>
      <?php /*?>
      <link href="<?php bloginfo('stylesheet_directory'); ?>/style-greenn.css" rel="stylesheet" type="text/css" />
      <?php */?>
      <?php 
      if (!empty($gfid)) {

        if(empty($gfajax)) {
          $gfajax = false;
        }
        gravity_form_enqueue_scripts($gfid, $gfajax);
      }
       ?>
       <?php wp_head(); ?>
      <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,300,500,600' rel='stylesheet' type='text/css'>
      <!--home gallery-->
      <!--slider start-->
       <!--<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery-1.3.2.min.js"></script>-->
      <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.jcarousel.pack.js"></script>
      <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.jcarousel.css" />
      <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/skin.css" />
      <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/owl.carousel.css" />
      <link href="<?php bloginfo('stylesheet_directory'); ?>/css/twentytwenty.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/flexi-demo.css" type="text/css" media="screen" />
      <!-- <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/flexslider.css" type="text/css" media="screen" /> -->
      <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/ddsmoothmenu.js"></script>
      <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/ddsmoothmenu-blue.css" />
      <script type="text/javascript">
         /**
          * We use the initCallback callback
          * to assign functionality to the controls
          */
         var $j = jQuery.noConflict();
          
         function mycarousel_initCallback(carousel) {
             $j('.jcarousel-control a').bind('click', function() {
                 carousel.scroll($j.jcarousel.intval(jQuery(this).text()));
                 return false;
             });
         
             $j('.jcarousel-scroll select').bind('change', function() {
                 carousel.options.scroll = $j.jcarousel.intval(this.options[this.selectedIndex].value);
                 return false;
             });
         
             $j('#mycarousel-next').bind('click', function() {
                 carousel.next();
                 return false;
             });
         
             $j('#mycarousel-prev').bind('click', function() {
                 carousel.prev();
                 return false;
             });
         };
         
         // Ride the carousel...
         
         $j(document).ready(function() {
             $j("#mycarousel").jcarousel({
                 scroll: 1,
                 initCallback: mycarousel_initCallback,
                 // This tells jCarousel NOT to autobuild prev/next buttons
                 buttonNextHTML: null,
                 buttonPrevHTML: null
             });
         });
         
      </script>
      <!-- Owl Carousel -->
      <link href="<?php bloginfo('stylesheet_directory'); ?>/css/owl.carousel.css" rel="stylesheet" type="text/css" />
      <!--slider slider end-->
      <!--Home Gallery-->
      <link href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.mmenu.all.css" rel="stylesheet" type="text/css" />
      <link href="<?php bloginfo('stylesheet_directory'); ?>/css/demo.css" rel="stylesheet" type="text/css" />
      <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.mmenu.min.all.js"></script>
      <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery-1.8.js"></script>
      <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
      <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/demo.css">
      <script src="<?php bloginfo('stylesheet_directory'); ?>/js/responsiveslides.min.js"></script>
      <script>
         // You can also use "$(window).load(function() {"
         $(function () {
           // Slideshow 4
           $("#slider4").responsiveSlides({
             auto: true,
             pager: false,
             nav: true,
             speed: 500,
             namespace: "callbacks",
             before: function () {
               $('.events').append("<li>before event fired.</li>");
             },
             after: function () {
               $('.events').append("<li>after event fired.</li>");
             }
           });
         
         });
      </script>
      <!--//home gallery-->
      <!--J panel -->
      <script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.jpanelmenu.min.js" type="text/javascript" charset="utf-8"></script>
      <script type="text/javascript" > 
         jQuery( document ).ready(function() {
             var jPM = jQuery.jPanelMenu({
                 keyboardShortcuts:'none',
                 menu: '#mobnav',
                 direction: 'right',
                         after: function(){
                     if(jPM.isOpen( )){
                         $('.jPanelMenu-panel').fadeTo(0,.5)
                         }else{
                         $('.jPanelMenu-panel').fadeTo(0,1)
                         }
                     }
              });
                 jPM.on();
         });
         
      </script>
      <!--J panel -->
      <!--faq start-->
      <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/ddaccordion.js"></script>
      <script type="text/javascript">
         //Initialize 2nd demo:
         
         ddaccordion.init({
         
             headerclass: "faq-wrap", //Shared CSS class name of headers group
         
             contentclass: "answer-wrap", //Shared CSS class name of contents group
         
             revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
         
             mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
         
             collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
         
             defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content.
         
             onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
         
             animatedefault: false, //Should contents open by default be animated into view?
         
             scrolltoheader: false, //scroll to header each time after it's been expanded by the user?
         
             persiststate: false, //persist state of opened contents within browser session?
         
             toggleclass: ["closedlanguage", "openlanguage"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
         
             togglehtml: ["prefix "], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
         
             animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
         
             oninit:function(expandedindices){ //custom code to run when headers have initalized
         
                 //do nothing
         
             },
         
             onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
         
                 //do nothing
         
             }
         
         })
         
         
         
      </script>
      <!--faq  End-->
      <!-- <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/owl.carousel.min.js"></script>
      <script>
         $(document).ready(function() { 
           $("#owl-example").owlCarousel({
             items : 2,
             navigation: true,
             autoPlay:5000
           }); 
         });
      </script>-->
      <!--Drpdown Start-->
      <?php /*?>
      <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/ddsmoothmenu-green.css" />
      <?php */?>
      <?php /*?>
      <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/ddsmoothmenu-orange.css" />
      <?php */?>
      <?php /*?>
      <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/ddsmoothmenu-red.css" />
      <?php */?>
      <?php /*?>
      <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/ddsmoothmenu-rose.css" />
      <?php */?>
      <?php /*?>
      <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/ddsmoothmenu-greenn.css" />
      <?php */?>
      <!--Drpdown End-->
      <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.tmpl.min.js"></script>
      <!--<script type="text/javascript" src="<?php // bloginfo('stylesheet_directory'); ?>/js/jquery.easing.1.3.js"></script>-->
      <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.elastislide.js"></script>
      <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/gallery.js"></script>
      <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/gallery.css" />
      <script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">    
         <div class="rg-image-wrapper">
             {{if itemsCount > 1}}
                 <div class="rg-image-nav">
                     <a href="#" class="rg-image-nav-prev">Previous Image</a>
                     <a href="#" class="rg-image-nav-next">Next Image</a>
                 </div>
             {{/if}}
             <div class="rg-image"></div>
             <div class="rg-loading"></div>
             <div class="rg-caption-wrapper">
                 <div class="rg-caption" style="display:none;">
                     <p></p>
                 </div>
             </div>
         </div>
      </script>
      <!-- Poup -->
      <link href="<?php bloginfo('stylesheet_directory'); ?>/facefiles/facebox.css" media="screen" rel="stylesheet" type="text/css" />
      <script src="<?php bloginfo('stylesheet_directory'); ?>/facefiles/facebox.js" type="text/javascript"></script>
      <script type="text/javascript">
         jQuery(document).ready(function($) {
          $('a[rel*=facebox]').facebox() 
          })
      </script>
      <!-- Poup -->
      <!--==  mobile menu  == -->
      <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.mmenu.all.css" />
      <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/mobile-menu.css" />
      <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.mmenu.positioning.css" />
      <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.mmenu.min.all.js"></script>
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
      <!-- =====MOBILE MENU End===== -->
      <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-2609394-1', 'auto');
  ga('send', 'pageview');

</script>
	 
   </head>
   <body>
      <!--Menu 320 Starts Here -->
      <div class="mob-header">
         <div class="mob-header-call">Call Today : <a href="tel:713-981-4600" style="text-decoration:none; color:#fff;" >713-981-4600</a> </div>
         <a class="menu1" href="#menu">Menu</a>
      </div>
      <div id="menu" class="mbl">
         <ul>
            <li style="padding-left:0px;"><a href="<?php bloginfo('wpurl'); ?>/" title="Home" >Home</a></li>
            <li>
               <a href="<?php bloginfo('wpurl'); ?>/about/about-the-practice" title="About">About</a>
               <ul>
                  <li><a href="<?php bloginfo('wpurl'); ?>/about/about-the-practice" title="About the Practice">About the Practice</a></li>
                  <li><a href="<?php bloginfo('wpurl'); ?>/about/about-dr-silberman" title="About Dr. Silberman">About Dr. Silberman</a></li>
                  <li><a href="<?php bloginfo('wpurl'); ?>/about/about-the-team" title="About the Team">About the Team</a></li>
               </ul>
            </li>
            <li>
               <a href="<?php bloginfo('wpurl'); ?>/patient-info/new-patient-forms" title="Patient Info">Patient Info</a>
               <ul>
                  <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/new-patient-forms" title="New Patient Forms">New Patient Forms</a></li>
                  <li>
                     <a href="<?php bloginfo('wpurl'); ?>/patient-info/technology/laser-cavity-detection" title="Technology">Technology</a>
                     <ul>
                        <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/technology/laser-cavity-detection" title="Laser Cavity Detection">Laser Cavity Detection</a></li>
                        <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/technology/in-the-mouth-camera" title="In the Mouth Camera">In the Mouth Camera</a></li>
                     </ul>
                  </li>
                  <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/insurancefinancial" title="Insurance/Financial">Insurance/Financial</a></li>
                  <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/hoursschedule" title="Hours/Schedule">Hours/Schedule</a></li>
                  <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/home-care-instructions" title="Home Care Instructions">Home Care Instructions</a></li>
                  <li>
                     <a href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-root-canal" title="Post Treatment Instructions">Post Treatment Instructions</a>
                     <ul>
                        <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-root-canal" title="After Root Canal">After Root Canal</a></li>
                        <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-implants" title="After Implants">After Implants</a></li>
                        <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-surgery" title="After Surgery">After Surgery</a></li>
                        <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-bleaching" title="After Bleaching">After Bleaching</a></li>
                        <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-orthodontics" title="After Orthodontics">After Orthodontics</a></li>
                        <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-veneers" title="After Veneers">After Veneers</a></li>
                        <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-dentures" title="After Dentures">After Dentures</a></li>
                        <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-periodontics" title="After Periodontics">After Periodontics</a></li>
                        <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/bite-splint" title="Bite Splint">Bite Splint</a></li>
                     </ul>
                  </li>
                  </li>
               </ul>
            <li>
               <a href="<?php bloginfo('wpurl'); ?>/6-month-braces/overview" title="6 Month Braces">6 Month Braces</a>
               <ul>
                  <li><a href="<?php bloginfo('wpurl'); ?>/6-month-braces/overview" title="Overview">Overview</a></li>
                  <?php /* <li><a href="<?php bloginfo('wpurl'); ?>/6-month-braces/faq" title="FAQ">FAQ</a></li> */ ?>
                  <li><a href="<?php bloginfo('wpurl'); ?>/6-month-braces/photo-gallery" title="Photo Gallery">Photo Gallery</a></li>
                  <li><a href="<?php bloginfo('wpurl'); ?>/6-month-braces/download-e-book" title="Download E-book">Download E-book</a></li>
               </ul>
            </li>
            <li>
               <a href="<?php bloginfo('wpurl'); ?>/comprehensive-orthodontics/what-is-it" title="Comprehensive Orthodontics">Comprehensive Orthodontics</a>
               <ul>
                  <li><a href="<?php bloginfo('wpurl'); ?>/comprehensive-orthodontics/what-is-it" title="What is it?">What is it?</a></li>
                  <li><a href="<?php bloginfo('wpurl'); ?>/comprehensive-orthodontics/benefits-of-braces" title="Benefits of Braces">Benefits of Braces</a></li>
                  <li><a href="<?php bloginfo('wpurl'); ?>/comprehensive-orthodontics/orthodontic-problems" title="Orthodontic Problems">Orthodontic Problems</a></li>
               </ul>
            </li>
            <li>
               <a href="<?php bloginfo('wpurl'); ?>/services/" title="Services">Services</a>
               <ul>
                  <li><a href="<?php bloginfo('wpurl'); ?>/services/dentistry-for-children-young-adults" title="Dentistry for Children, Young Adults">Dentistry for Children, Young Adults</a></li>
                  <li><a href="<?php bloginfo('wpurl'); ?>/services/cavity-treatment" title="Cavity Treatment">Cavity Treatment</a></li>
                  <li><a href="<?php bloginfo('wpurl'); ?>/services/implant" title="Implant">Implant</a></li>
                  <li><a href="<?php bloginfo('wpurl'); ?>/services/root-canal" title="Root Canal">Root Canal</a></li>
                 <!--  <li><a href="<?php bloginfo('wpurl'); ?>/services/orthodontics" title="Orthodontics">Orthodontics</a></li> -->
                  <li><a href="<?php bloginfo('wpurl'); ?>/services/short-term-braces" title="Short Term Braces">Short Term Braces</a></li>
                  <li><a href="<?php bloginfo('wpurl'); ?>/services/snoring-sleep-apnea-treatment" title="Snoring & Sleep Apnea Treatment">Snoring & Sleep Apnea Treatment</a></li>
                  <li><a href="<?php bloginfo('wpurl'); ?>/services/comprehensive-orthodontics" title="Comprehensive Orthodontics">Comprehensive Orthodontics</a></li>
                  <li><a href="<?php bloginfo('wpurl'); ?>/services/invisalign" title="Invisalign">Invisalign</a></li>
                  <li><a href="<?php bloginfo('wpurl'); ?>/services/gum-treatment" title="Gum Treatment">Gum Treatment</a></li>
                  <li><a href="<?php bloginfo('wpurl'); ?>/services/jointmuscle-treatment" title="Joint/Muscle Treatment">Joint/Muscle Treatment</a></li>
                  <li><a href="<?php bloginfo('wpurl'); ?>/services/digital-x-rays-and-records" title="Digital X-rays and Records">Digital X-rays and Records </a></li>
               </ul>
            </li>
            <li>
               <a href="<?php bloginfo('wpurl'); ?>/cosmetic-dentistry/tooth-whitening" title="Cosmetic Dentistry">Cosmetic Dentistry</a>
               <ul>
                  <li><a href="<?php bloginfo('wpurl'); ?>/cosmetic-dentistry/tooth-whitening" title="Tooth Whitening">Tooth Whitening</a></li>
                  <li><a href="<?php bloginfo('wpurl'); ?>/cosmetic-dentistry/veneers-crowns" title="Veneers & Crowns">Veneers & Crowns</a></li>
                  <li><a href="<?php bloginfo('wpurl'); ?>/cosmetic-dentistry/smile-make-over" title="Smile Make-Over">Smile Make-Over</a></li>
               </ul>
            </li>
            <li>
               <a href="<?php bloginfo('wpurl'); ?>/smile-gallery/" title="Smile Gallery" <?php if (is_404()){}else{if(in_array("smile-gallery" ,$url_array)){ echo "class='active'";}}?>>Smile Gallery</a>
               <?php /*
                  $categories = $wpdb->get_results(
                  " SELECT
                                DISTINCT tbl_gallery_main.category_id
                                FROM tbl_gallery_main
                                INNER JOIN tbl_gallerysubcategory
                                ON tbl_gallerysubcategory.category_id = tbl_gallery_main.category_id
                                INNER JOIN tbl_category
                                ON tbl_category.category_id = tbl_gallery_main.category_id
                                ORDER BY tbl_category.ordering
                                "
                      
                      );  
                      
                  ?>          
               <ul>
                  <?php 
                     foreach ( $categories as $values ) 
                           {
                           
                             $categoriesvalue = $wpdb->get_row(
                               "
                               SELECT * 
                               FROM tbl_category
                               WHERE status = 'Y' AND category_id = '$values->category_id'
                               ORDER BY ordering
                               "
                             );
                             ?>   
                  <li><a href="<?php bloginfo('wpurl'); ?>/smile-gallery/<?php echo $categoriesvalue->category_seotitle; ?>/" title="<?php echo $categoriesvalue->category_name; ?>"><?php echo $categoriesvalue->category_name; ?></a></li>
                  <?php } ?>              
               </ul>
               <?php */?>
            </li>
            <li><a href="<?php bloginfo('wpurl'); ?>/blog" title="Blog">Blog</a></li>
            <li>
               <a href="<?php bloginfo('wpurl'); ?>/contact-us/location" title="Contact Us">Contact Us</a>
               <ul>
                  <li><a href="<?php bloginfo('wpurl'); ?>/contact-us/location" title="Location">Location</a></li>
                  <li><a href="<?php bloginfo('wpurl'); ?>/contact-us/contact-form/" title="Contact Form">Contact Form</a></li>
                  <li><a href="<?php bloginfo('wpurl'); ?>/contact-us/appointment-request" title="Appointment Request">Appointment Request</a></li>
               </ul>
            </li>
         </ul>
      </div>
      <!--Menu 320 Ends Here -->
      <!--Head Section Start-->
      <div class="head-wrap">
         <div class="head-wrap-in">
            <div class="head-wrap-inn">
               <div class="head-wrap-in-top" itemscope itemtype="http://schema.org/Dentist">
                  <a href="<?php bloginfo('wpurl'); ?>/" class="logo" title="Dr. David M. Silberman General Dentistry, Cosmetic Dentistry, Orthodontics" itemprop= "url" ></a>
                  <div class="head-wrap-in-top-right">
                     <div class="top-share" itemscope itemtype = "https://schema.org/Dentist">
                        <?php // include("share.php"); ?>
                        <a class="top-fb-icon pulse-grow" target="_blank" href="https://www.facebook.com/DavidSilbermanDds " title="Facebook" itemprop="sameAs"></a>
                     <a class="like-icon pulse-grow" href="http://www.nextadagency.com/software/business_review.php?UzEEZgE7VGVUPQVoBGUBNgtj"; target="_blank" title="If You Like Us, Rate Us!"></a>
                     <a class="red-icon pulse-grow" href="http://www.nxnotes.com/pb/rateus.php?id=B7ww4B2"; target="_blank" title="Check Out Our Reviews"></a>
                     </div>
                     <p><a href="tel:713-981-4600" style="text-decoration:none;">713-981-4600</a></p>
                     <div class="clear"></div>
                  </div>
                  <div class="clear"></div>
               </div>
            </div>
            <nav>
               <div id="smoothmenu1" class="ddsmoothmenu">
                  <ul>
                     <li style="padding-left:0px;"><a href="<?php bloginfo('wpurl'); ?>/" title="Home" <?php if(is_page(4)) { echo 'class="active"'; }?>>Home</a></li>
                     <li>
                        <a href="<?php bloginfo('wpurl'); ?>/about/about-the-practice" title="About" <?php if (is_404()){}else{ if(in_array("about" ,$url_array)){ echo "class='active'";}}?>>About</a>
                        <ul>
                           <li><a href="<?php bloginfo('wpurl'); ?>/about/about-the-practice" title="About the Practice">About the Practice</a></li>
                           <li><a href="<?php bloginfo('wpurl'); ?>/about/about-dr-silberman" title="About Dr. Silberman">About Dr. Silberman</a></li>
                           <li><a href="<?php bloginfo('wpurl'); ?>/about/about-the-team" title="About the Team">About the Team</a></li>
                        </ul>
                     </li>
                     <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/new-patient-forms" title="Patient Info" <?php if (is_404()){}else{ if(in_array("patient-info" ,$url_array)){ echo "class='active'";}}?>>Patient Info</a>
                        <ul>
                           <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/new-patient-forms" title="New Patient Forms">New Patient Forms</a></li>
                           <li>
                              <a href="<?php bloginfo('wpurl'); ?>/patient-info/technology/laser-cavity-detection" title="Technology">Technology</a>
                              <ul>
                                 <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/technology/laser-cavity-detection" title="Laser Cavity Detection">Laser Cavity Detection</a></li>
                                 <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/technology/in-the-mouth-camera" title="In the Mouth Camera">In the Mouth Camera</a></li>
                              </ul>
                           </li>
                           <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/insurancefinancial" title="Insurance/Financial">Insurance/Financial</a></li>
                           <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/hoursschedule" title="Hours/Schedule">Hours/Schedule</a></li>
                           <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/home-care-instructions" title="Home Care Instructions">Home Care Instructions</a></li>
                           <li>
                              <a href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-root-canal" title="Post Treatment Instructions">Post Treatment Instructions</a>
                              <ul>
                                 <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-root-canal" title="After Root Canal">After Root Canal</a></li>
                                 <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-implants" title="After Implants">After Implants</a></li>
                                 <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-surgery" title="After Surgery">After Surgery</a></li>
                                 <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-bleaching" title="After Bleaching">After Bleaching</a></li>
                                 <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-orthodontics" title="After Orthodontics">After Orthodontics</a></li>
                                 <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-veneers" title="After Veneers">After Veneers</a></li>
                                 <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-dentures" title="After Dentures">After Dentures</a></li>
                                 <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-periodontics" title="After Periodontics">After Periodontics</a></li>
                                 <li><a href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/bite-splint" title="Bite Splint">Bite Splint</a></li>
                              </ul>
                           </li>
                           </ul>
                           </li>
                        
                     <li>
                        <a href="<?php bloginfo('wpurl'); ?>/6-month-braces/overview" title="6 Month Braces" <?php if (is_404()){}else{ if(in_array("6-month-braces" ,$url_array)){ echo "class='active'";}}?>>6 Month Braces</a>
                        <ul>
                           <li><a href="<?php bloginfo('wpurl'); ?>/6-month-braces/overview" title="Overview">Overview</a></li>
                           <?php /* <li><a href="<?php bloginfo('wpurl'); ?>/6-month-braces/faq" title="FAQ">FAQ</a></li> */ ?>
                           <li><a href="<?php bloginfo('wpurl'); ?>/6-month-braces/photo-gallery" title="Photo Gallery">Photo Gallery</a></li>
                           <li><a href="<?php bloginfo('wpurl'); ?>/6-month-braces/download-e-book" title="Download E-book">Download E-book</a></li>
                        </ul>
                     </li>
                     <li>
                        <a href="<?php bloginfo('wpurl'); ?>/comprehensive-orthodontics/what-is-it" title="Comprehensive Orthodontics" <?php if (is_404()){}else{ if(!in_array("services",$url_array)){ if(in_array("comprehensive-orthodontics" ,$url_array)){ echo "class='active'";}}}?>>Comprehensive Orthodontics</a>
                        <ul>
                           <li><a href="<?php bloginfo('wpurl'); ?>/comprehensive-orthodontics/what-is-it" title="What is it?">What is it?</a></li>
                           <li><a href="<?php bloginfo('wpurl'); ?>/comprehensive-orthodontics/benefits-of-braces" title="Benefits of Braces">Benefits of Braces</a></li>
                           <li><a href="<?php bloginfo('wpurl'); ?>/comprehensive-orthodontics/orthodontic-problems" title="Orthodontic Problems">Orthodontic Problems</a></li>
                        </ul>
                     </li>
                     <li>
                        <a href="<?php bloginfo('wpurl'); ?>/services/" title="Services" <?php if (is_404()){}else{ if(in_array("services" ,$url_array)){ echo "class='active'";}}?>>Services</a>
                        <ul>
                           <li><a href="<?php bloginfo('wpurl'); ?>/services/dentistry-for-children-young-adults" title="Dentistry for Children, Young Adults">Dentistry for Children, Young Adults</a></li>
                           <li><a href="<?php bloginfo('wpurl'); ?>/services/cavity-treatment" title="Cavity Treatment">Cavity Treatment</a></li>
                           <li><a href="<?php bloginfo('wpurl'); ?>/services/implant" title="Implant">Implant</a></li>
                           <li><a href="<?php bloginfo('wpurl'); ?>/services/root-canal" title="Root Canal">Root Canal</a></li>
                           <!-- <li><a href="<?php bloginfo('wpurl'); ?>/services/orthodontics" title="Orthodontics">Orthodontics</a></li> -->
                           <li><a href="<?php bloginfo('wpurl'); ?>/services/short-term-braces" title="Short Term Braces">Short Term Braces</a></li>
                           <li><a href="<?php bloginfo('wpurl'); ?>/services/snoring-sleep-apnea-treatment" title="Snoring & Sleep Apnea Treatment">Snoring & Sleep Apnea Treatment</a></li>
                           <li><a href="<?php bloginfo('wpurl'); ?>/services/comprehensive-orthodontics" title="Comprehensive Orthodontics">Comprehensive Orthodontics</a></li>
                           <li><a href="<?php bloginfo('wpurl'); ?>/services/invisalign" title="Invisalign">Invisalign</a></li>
                           <li><a href="<?php bloginfo('wpurl'); ?>/services/gum-treatment" title="Gum Treatment">Gum Treatment</a></li>
                           <li><a href="<?php bloginfo('wpurl'); ?>/services/jointmuscle-treatment" title="Joint/Muscle Treatment">Joint/Muscle Treatment</a></li>
                           <li><a href="<?php bloginfo('wpurl'); ?>/services/digital-x-rays-and-records" title="Digital X-rays and Records">Digital X-rays and Records </a></li>
                        </ul>
                     </li>
                     <li>
                        <a href="<?php bloginfo('wpurl'); ?>/cosmetic-dentistry/tooth-whitening" title="Cosmetic Dentistry" <?php if (is_404()){}else{ if(in_array("cosmetic-dentistry" ,$url_array)){ echo "class='active'";}}?>>Cosmetic Dentistry</a>
                        <ul>
                           <li><a href="<?php bloginfo('wpurl'); ?>/cosmetic-dentistry/tooth-whitening" title="Tooth Whitening">Tooth Whitening</a></li>
                           <li><a href="<?php bloginfo('wpurl'); ?>/cosmetic-dentistry/veneers-crowns" title="Veneers & Crowns">Veneers & Crowns</a></li>
                           <li><a href="<?php bloginfo('wpurl'); ?>/cosmetic-dentistry/smile-make-over" title="Smile Make-Over">Smile Make-Over</a></li>
                        </ul>
                     </li>
                     <li>
                        <a href="<?php bloginfo('wpurl'); ?>/smile-gallery/" title="Smile Gallery" <?php if (is_404()){}else{if(in_array("smile-gallery" ,$url_array)){ echo "class='active'";}}?>>Smile Gallery</a>
                        <?php /*
                           $categories = $wpdb->get_results(
                                "SELECT DISTINCT tbl_gallerysubcategory.category_id
                                    FROM  tbl_gallerysubcategory
                                    LEFT JOIN tbl_category
                                    ON  tbl_gallerysubcategory.category_id=tbl_category.category_id
                                    WHERE  tbl_gallerysubcategory.status ='Y' AND tbl_category.status ='Y' order by tbl_category.ordering "
                                
                                );  
                                
                           ?>           
                        <ul>
                           <?php 
                              foreach ( $categories as $values ) 
                                        {
                                        
                                            $categoriesvalue = $wpdb->get_row(
                                                "
                                                SELECT * 
                                                FROM tbl_category
                                                WHERE status = 'Y' AND category_id = '$values->category_id'
                                                ORDER BY ordering
                                                "
                                            );
                                            ?>   
                           <li><a href="<?php bloginfo('wpurl'); ?>/smile-gallery/<?php echo $categoriesvalue->category_seotitle; ?>/" title="<?php echo $categoriesvalue->category_name; ?>"><?php echo $categoriesvalue->category_name; ?></a></li>
                           <?php } ?>                     
                        </ul>
                        <?php */?>
                     </li>
                     <li><a href="<?php bloginfo('wpurl'); ?>/blog/" <?php if (is_404()){}else{if(in_array("blog" ,$url_array)){ echo "class='active'";}}?> title="Blog">Blog</a></li>
                     <li>
                        <a href="<?php bloginfo('wpurl'); ?>/contact-us/location/" title="Contact Us" <?php if (is_404()){}else{ if(in_array("contact-us" ,$url_array)){ echo "class='active'";}}?>>Contact Us</a>
                        <ul class="algnleft">
                           <li><a href="<?php bloginfo('wpurl'); ?>/contact-us/location/" title="Location">Location</a></li>
                           <li><a href="<?php bloginfo('wpurl'); ?>/contact-us/contact-form/" title="Contact Form">Contact Form</a></li>
                           <li><a href="<?php bloginfo('wpurl'); ?>/contact-us/appointment-request/" title="Appointment Request">Appointment Request</a></li>
                        </ul>
                     </li>
                  </ul>
               </div>
            </nav>
            <div class="clear"></div>
         </div>
         <div class="clear"></div>
      </div>
      <!--Head Section End-->
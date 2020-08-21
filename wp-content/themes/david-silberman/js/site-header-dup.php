<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<meta name="format-detection" content="telephone=no">
<link rel="icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.ico" />
<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.ico" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link href="<?php bloginfo('stylesheet_directory'); ?>/style.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Raleway:700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300' rel='stylesheet' type='text/css'>



<!-- =====jpanelmenu Start===== -->
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery-1.10.2.min.js" type="text/javascript"></script>
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


 <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.jcarousel.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.jcarousel.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/skin.css" />

<script type="text/javascript">
/**
 * We use the initCallback callback
 * to assign functionality to the controls
 */
function mycarousel_initCallback(carousel) {
    jQuery('.jcarousel-control a').bind('click', function() {
        carousel.scroll(jQuery.jcarousel.intval(jQuery(this).text()));
        return false;
    });

    jQuery('.jcarousel-scroll select').bind('change', function() {
        carousel.options.scroll = jQuery.jcarousel.intval(this.options[this.selectedIndex].value);
        return false;
    });

    jQuery('#mycarousel-next').bind('click', function() {
        carousel.next();
        return false;
    });

    jQuery('#mycarousel-prev').bind('click', function() {
        carousel.prev();
        return false;
    });
};

// Ride the carousel...
jQuery(document).ready(function() {
    jQuery("#mycarousel").jcarousel({
        scroll: 1,
        initCallback: mycarousel_initCallback,
        // This tells jCarousel NOT to autobuild prev/next buttons
        buttonNextHTML: null,
        buttonPrevHTML: null
    });
});

</script>
<!--slider slider end-->

<!--home gallery-->
<!--<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>-->
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery-1.8.js"></script>
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



<!-- =====jpanelmenu End===== -->


<!--slider start-->




<!--Drpdown Start-->

<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/ddsmoothmenu.js"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/ddsmoothmenu.css" />
<!--Drpdown  End-->
<!-- Poup -->

<link href="<?php bloginfo('stylesheet_directory'); ?>/facefiles/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="<?php bloginfo('stylesheet_directory'); ?>/facefiles/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
   jQuery(document).ready(function($) {
    $('a[rel*=facebox]').facebox() 
    })
</script>
<!-- Poup -->



</head>
<body>








<!--Head Section Start-->
<div class="head-wrap">
  <div class="head-wrap-in">
    <div class="head-wrap-in-top"> <a href="<?php bloginfo('wpurl'); ?>/" class="logo" title="Dental"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.jpg" alt=""></a>
      <div class="head-wrap-in-top-right">
        <div class="top-share"></div>
        <p>1-800-123-4567</p>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
    <div id="smoothmenu1" class="ddsmoothmenu">
      <ul>
        <li style="padding-left:0px;"><a href="<?php bloginfo('wpurl'); ?>/" title="Home">Home</a></li>
        <li><a href="<?php bloginfo('wpurl'); ?>/about/" title="About">About</a></li>
        <li><a href="<?php bloginfo('wpurl'); ?>/procedures/" title="Procedures">Procedures</a>
          <ul>
            <li><a href="<?php bloginfo('wpurl'); ?>/" title="Procedures">Procedures</a></li>
            <li><a href="<?php bloginfo('wpurl'); ?>/" title="Procedures">Procedures</a></li>
          </ul>
        </li>
        <li><a href="<?php bloginfo('wpurl'); ?>/faq/" title="FAQ">FAQ</a></li>
         <li><a href="<?php bloginfo('wpurl'); ?>/photo-gallery/" title="Photo Gallery">Photo Gallery</a></li>
        <li><a href="<?php bloginfo('wpurl'); ?>/video-gallery/" title="Video Gallery">Video Gallery</a>
          <ul>
            <li><a href="<?php bloginfo('wpurl'); ?>/" title="Procedures">Procedures</a></li>
            <li><a href="<?php bloginfo('wpurl'); ?>/" title="Procedures">Procedures</a></li>
          </ul>
        </li>
        <li><a href="<?php bloginfo('wpurl'); ?>/fees-financing/" title="Fees &amp; Financing">Fees &amp; Financing</a></li>
        <li><a href="<?php bloginfo('wpurl'); ?>/blog/" title="Blog">Blog</a></li>
        <li><a href="<?php bloginfo('wpurl'); ?>/contact/" title="Contact">Contact</a></li>
      </ul>
    </div>
    <!--Menu 320 Starts Here -->
    <a href="<?php bloginfo('wpurl'); ?>/" class="menu-trigger">Open</a>
    <div id="mobnav">
      <ul>
        <li style="padding-left:0px;"><a href="<?php bloginfo('wpurl'); ?>/" title="Home">Home</a></li>
        <li><a href="<?php bloginfo('wpurl'); ?>/" title="About">About</a></li>
        <li><a href="<?php bloginfo('wpurl'); ?>/" title="Procedures">Procedures</a>
          <ul>
            <li><a href="<?php bloginfo('wpurl'); ?>/" title="Procedures">Procedures</a></li>
            <li><a href="<?php bloginfo('wpurl'); ?>/" title="Procedures">Procedures</a></li>
          </ul>
        </li>
        <li><a href="<?php bloginfo('wpurl'); ?>/faq/" title="FAQ">FAQ</a></li>
        <li><a href="<?php bloginfo('wpurl'); ?>/photo-gallery/" title="Photo Gallery">Photo Gallery</a></li>
        <li><a href="<?php bloginfo('wpurl'); ?>/video-gallery/" title="Video Gallery">Video Gallery</a>
          <ul>
            <li><a href="<?php bloginfo('wpurl'); ?>/" title="Procedures">Procedures</a></li>
            <li><a href="<?php bloginfo('wpurl'); ?>/" title="Procedures">Procedures</a></li>
          </ul>
        </li>
        <li><a href="<?php bloginfo('wpurl'); ?>/" title="Fees & Financing">Fees & Financing</a></li>
        <li><a href="<?php bloginfo('wpurl'); ?>/blog/" title="Blog">Blog</a></li>
        <li><a href="<?php bloginfo('wpurl'); ?>/contact/" title="Contact">Contact</a></li>
      </ul>
    </div>
    <!--Menu 320 Ends Here -->
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
</div>
<!--Head Section End-->
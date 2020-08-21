<?php
/*
Template Name: Site Map Page
*/
?>

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


<!--Site map-->
<div  class="sitemap_wrapper">

<ul>
        <li><a title="Home" href="<?php bloginfo('wpurl'); ?>/">Home</a></li>
        <li><a title="About" href="<?php bloginfo('wpurl'); ?>/about/about-the-practice" style="padding-right: 0px;">About
        <ul >
        <li><a title="About the Practice" href="<?php bloginfo('wpurl'); ?>/about/about-the-practice">About the Practice</a></li>
        <li><a title="About Dr. Silberman" href="<?php bloginfo('wpurl'); ?>/about/about-dr-silberman">About Dr. Silberman</a></li>
        <li><a title="About the Team" href="<?php bloginfo('wpurl'); ?>/about/about-the-team">About the Team</a></li>
        </ul>
    </li>
        
        <li><a title="Patient Info" href="<?php bloginfo('wpurl'); ?>/patient-info/new-patient-forms" style="padding-right: 0px;">Patient Info
        <ul>
        <li><a title="New Patient Forms" href="<?php bloginfo('wpurl'); ?>/patient-info/new-patient-forms">New Patient Forms</a></li>
        <li><a title="Technology" href="<?php bloginfo('wpurl'); ?>/patient-info/technology/laser-cavity-detection">Technology
        <ul>
        <li><a title="Laser Cavity Detection" href="<?php bloginfo('wpurl'); ?>/patient-info/technology/laser-cavity-detection">Laser Cavity Detection</a></li>
        <li><a title="In the Mouth Camera" href="<?php bloginfo('wpurl'); ?>/patient-info/technology/in-the-mouth-camera">In the Mouth Camera</a></li>
        </ul>
        </li>
        
         <li><a title="Insurance/Financial" href="<?php bloginfo('wpurl'); ?>/patient-info/insurancefinancial">Insurance/Financial</a></li>
        <li><a title="Hours/Schedule" href="<?php bloginfo('wpurl'); ?>/patient-info/hoursschedule">Hours/Schedule</a></li>
        <li><a title="Home Care Instructions" href="<?php bloginfo('wpurl'); ?>/patient-info/home-care-instructions">Home Care Instructions</a></li>
        <li><a title="Post Treatment Instructions" href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-root-canal">Post Treatment Instructions
        <ul >
        <li><a title="After Root Canal" href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-root-canal">After Root Canal</a></li>
        <li><a title="" href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-implants">After Implants</a></li>
        <li><a title="After Surgery" href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-surgery">After Surgery</a></li>
        <li><a title="After Bleaching" href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-bleaching">After Bleaching</a></li>
        <li><a title="After Orthodontics" href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-orthodontics">After Orthodontics</a></li>
        <li><a title="After Veneers" href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-veneers">After Veneers</a></li>
        <li><a title="After Dentures" href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-dentures">After Dentures</a></li>
        <li><a title="After Periodontics" href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/after-periodontics">After Periodontics</a></li>
        <li><a title="Bite Splint" href="<?php bloginfo('wpurl'); ?>/patient-info/post-treatment-instructions/bite-splint">Bite Splint</a></li>
        </ul>
        </li>
        
        
        </ul>
       
        </li><li><a title="6 Month Braces" href="<?php bloginfo('wpurl'); ?>/6-month-braces/overview" style="padding-right: 0px;">6 Month Braces
        <ul>
        <li><a title="Overview" href="<?php bloginfo('wpurl'); ?>/6-month-braces/overview">Overview</a></li>
        <li><a title="FAQ" href="<?php bloginfo('wpurl'); ?>/6-month-braces/faq">FAQ</a></li>
        <li><a title="Photo Gallery" href="<?php bloginfo('wpurl'); ?>/6-month-braces/photo-gallery">Photo Gallery</a></li>
        <li><a title="Download E-book" href="<?php bloginfo('wpurl'); ?>/6-month-braces/download-e-book">Download E-book</a></li>
        </ul>
        </li>
        
        <li><a title="Comprehensive Orthodontics" href="<?php bloginfo('wpurl'); ?>/comprehensive-orthodontics/what-is-it" style="padding-right: 0px;">Comprehensive Orthodontics
        <ul >
        <li><a title="What is it?" href="<?php bloginfo('wpurl'); ?>/comprehensive-orthodontics/what-is-it">What is it?</a></li>
        <li><a title="Benefits of Braces" href="<?php bloginfo('wpurl'); ?>/comprehensive-orthodontics/benefits-of-braces">Benefits of Braces</a></li>
        <li><a title="Orthodontic Problems" href="<?php bloginfo('wpurl'); ?>/comprehensive-orthodontics/orthodontic-problems">Orthodontic Problems</a></li>
        </ul>
        </li>
       
        <li><a title="Services" href="<?php bloginfo('wpurl'); ?>/services/" style="padding-right: 0px;">Services
        <ul>
        <li><a title="Dentistry for Children, Young Adults" href="<?php bloginfo('wpurl'); ?>/services/dentistry-for-children-young-adults">Dentistry for Children, Young Adults</a></li>
        <li><a title="Cavity Treatment" href="<?php bloginfo('wpurl'); ?>/services/cavity-treatment">Cavity Treatment</a></li>
        <li><a title="Implant" href="<?php bloginfo('wpurl'); ?>/services/implant">Implant</a></li>
        <li><a title="Root Canal" href="<?php bloginfo('wpurl'); ?>/services/root-canal">Root Canal</a></li>
        
        <li><a title="Short Term Braces" href="<?php bloginfo('wpurl'); ?>/services/short-term-braces">Short Term Braces</a></li>
        <li><a title="Snoring &amp; Sleep Apnea Treatment" href="<?php bloginfo('wpurl'); ?>/services/snoring-sleep-apnea-treatment">Snoring &amp; Sleep Apnea Treatment</a></li>
        <li><a title="Comprehensive Orthodontics" href="<?php bloginfo('wpurl'); ?>/services/comprehensive-orthodontics">Comprehensive Orthodontics</a></li>
        <li><a title="Invisalign" href="<?php bloginfo('wpurl'); ?>/services/invisalign">Invisalign</a></li>
        <li><a title="Gum Treatment" href="<?php bloginfo('wpurl'); ?>/services/gum-treatment">Gum Treatment</a></li>
        <li><a title="Joint/Muscle Treatment" href="<?php bloginfo('wpurl'); ?>/services/jointmuscle-treatment">Joint/Muscle Treatment</a></li>
        <li><a title="Digital X-rays and Records" href="<?php bloginfo('wpurl'); ?>/services/digital-x-rays-and-records">Digital X-rays and Records </a></li>
        </ul>
        </li>
        
        
        <li><a title="Cosmetic Dentistry" href="<?php bloginfo('wpurl'); ?>/cosmetic-dentistry/tooth-whitening" style="padding-right: 0px;">Cosmetic Dentistry
        <ul>
        <li><a title="Tooth Whitening" href="<?php bloginfo('wpurl'); ?>/cosmetic-dentistry/tooth-whitening">Tooth Whitening</a></li>
        <li><a title="Veneers & Crowns" href="<?php bloginfo('wpurl'); ?>/cosmetic-dentistry/veneers-crowns">Veneers & Crowns</a></li>
        <li><a title="Smile Make-Over" href="<?php bloginfo('wpurl'); ?>/cosmetic-dentistry/smile-make-over">Smile Make-Over</a></li>
        </ul>
        </li>
         <li><a title="Smile Gallery" href="<?php bloginfo('wpurl'); ?>/smile-gallery/">Smile Gallery</a>

          </li>
         <li><a title="Blog" href="<?php bloginfo('wpurl'); ?>/blog/">Blog</a></li>
        <li ><a title="Contact Us" href="<?php bloginfo('wpurl'); ?>/contact-us/location/" style="padding-right: 0px;">Contact Us
        <ul>
        <li><a title="Location" href="<?php bloginfo('wpurl'); ?>/contact-us/location/">Location</a></li>
        <li><a title="Contact Form" href="<?php bloginfo('wpurl'); ?>/contact-us/contact-form/">Contact Form</a></li>
        <li><a title="Appointment Request" href="<?php bloginfo('wpurl'); ?>/contact-us/appointment-request/">Appointment Request</a></li>
        </ul>
        </li>
      </ul>
</div>
<!--Site map End-->




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




<?php include("site-footer.php"); ?>
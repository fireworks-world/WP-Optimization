<?php
/*
Template Name: Thank You Page
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
<h1><!--<?php the_title(); ?>--></h1>
<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
<?php endwhile; endif; ?>

	<?php if($_REQUEST['nl']==1){?>
<div class="thankyou-box-nw">
<!-- <a href="javascript:history.go(-1)" title="Back" class="back-button">BACK</a> -->
</div>
<?php }else{?>
<div class="thankyou-box">


<!-- <p>for contacting us!<br />

         we'll be in touch shortly.</p> -->
         <br clear="all" />
        <!-- <a href="javascript:history.go(-1)" title="Back" class="back-button">BACK</a> -->
       
    </div>

<?php }?>

<a href="javascript:history.go(-1)" title="Back" class="back-btn" ><i class="icon-caret-left"></i> Back</a>
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




<!-- Google Code for Lead Action Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1069186233;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "ffffff";
var google_conversion_label = "MZHkCMezaxC5-en9Aw";
var google_conversion_value = 1.00;
var google_conversion_currency = "USD";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1069186233/?value=1.00&amp;currency_code=USD&amp;label=MZHkCMezaxC5-en9Aw&amp;guid=ON&amp;script=0"/>
</div>
</noscript>



<?php include("site-footer.php"); ?>
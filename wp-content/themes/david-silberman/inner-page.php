<?php
/*
Template Name: Inner Page
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

<div class="clear"></div>
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






<?php // include("inner-bottom-banner.php"); ?>
<?php // include("bottom-news-letter.php"); ?>
<?php include("site-footer.php"); ?>
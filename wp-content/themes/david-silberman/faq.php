<?php
/*
Template Name: FAQ Page
*/
?>
<?php $gfid = 1; $gfajax = true; ?>
<?php include("site-header.php"); ?>

<?php include("inner-banner.php"); ?>


<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
the_content();
endwhile; else: ?>
<p>Sorry, no posts matched your criteria.</p>
<?php endif; ?>









<?php include("site-footer.php"); ?>
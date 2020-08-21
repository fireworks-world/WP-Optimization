<?php
/*
Template Name: Smile Gallery Page
*/
?>

<?php $gfid = 1; $gfajax = true; ?>
<?php include("site-header.php"); ?>
<div class="border-ht"></div>
<?php // include("inner-banner.php"); ?>

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

<p>These are illustrations of actual patients of Dr. David Silberman. Results may vary.</p>

<?php
		$galleryvalue = $wpdb->get_results(
			"
			select * from tbl_gallery_main gm inner join  tbl_category c on gm.category_id=c.category_id where c.category_id=18 order by gm.ordering asc
			"
			);

		$gallery_count = count($galleryvalue);
		if($gallery_count>0){?>
		
		
<div style="position: absolute;top: -9999px;left: -9999px;opacity: 0;visibility: hidden;width: 0;height: 0;">		
<?php		
		foreach ( $galleryvalue as $gallerydetails ) 
			{
			?>
			<img src="<?php bloginfo('wpurl'); ?>/wp-content/uploads/gallery/before_patient/<?php echo $gallerydetails->before_image ; ?>">
			<img src="<?php bloginfo('wpurl'); ?>/wp-content/uploads/gallery/after_patient/<?php echo $gallerydetails->after_image; ?>">
			<?php
			}				
			?>
</div>			
		
		
		
		
		

<div class="flexslider-out">
<div class="flexslider-larg">
<div id="slider" class="flexslider">
          <ul class="slides">
		  <?php
			foreach ( $galleryvalue as $gallerydetails ) 
			{?>
			<li><div class="twentytwenty-container"><img src="<?php bloginfo('wpurl'); ?>/wp-content/uploads/gallery/before_patient/<?php echo $gallerydetails->before_image ; ?>" title="<?php echo $gallerydetails->before_imagetitle; ?>" alt="<?php echo $gallerydetails->before_imagealt; ?>" /><img src="<?php bloginfo('wpurl'); ?>/wp-content/uploads/gallery/after_patient/<?php echo $gallerydetails->after_image; ?>" title="<?php echo $gallerydetails->after_imagetitle; ?>" alt="<?php echo $gallerydetails->after_imagealt; ?>" /></div>
			
			<div class="gal-dis">
				<?php echo $gallerydetails->description; ?>
			</div>
				<div class="gal-disa">
				<?php echo $gallerydetails->meta_description; ?>
			</div>			
			</li>
		<?php
		}?>	
          
          </ul>
        </div>
</div>

<div class="flexslider-thup">
        <div id="carousel" class="flexslider ">
          <ul class="slides">
               <?php $i=1;
			foreach ( $galleryvalue as $gallerydetails ) 
			{
			
			?>
			<li><img src="<?php bloginfo('wpurl'); ?>/wp-content/uploads/gallery/after_medium/<?php echo $gallerydetails->after_image; ?>" title="Patient <?php echo $i;?>" /></li>
		<?php
		$i++;
		}?>	
          </ul>
        </div>
  </div>


</div>
<?php }else{
	echo '<p>Coming Soon!</p>';
}?>

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
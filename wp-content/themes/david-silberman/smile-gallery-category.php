
<?php include("site-header.php"); ?>
<div class="border-ht"></div>
<?php //include("inner-banner.php"); ?>
<?php include("pagination-gallerycategory.php"); ?>
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


<div class="photo-land">


 <?php if ($count_num_cat > 0){
$count = 0; 	
?>




<?php    	  
		  while($data=mysql_fetch_array($result_cat)){
$count++;

?>

<div class="<?php if($count % 2 == 0){?>photo-land-box-in<?php }else {?>photo-land-box<?php }?>">

<div class="photo-land-box-1">
<div class="photo-land-box-img">
<a href="<?php bloginfo('wpurl'); ?>/smile-gallery/<?php echo $data['subcategory_seotitle'];?>/" title="<?php echo $data['subcategory_name']; ?>">
<img src="<?php bloginfo('wpurl'); ?>/wp-content/uploads/gallerysubcategory/thumbs/<?php echo $data['subcategory_image']; ?>" alt="<?php echo $data['image_alt']; ?>" /></a>
</div></div>

<h3><a href="<?php bloginfo('wpurl'); ?>/smile-gallery/<?php echo $data['subcategory_seotitle'];?>/" title="<?php echo $data['subcategory_name']; ?>"><?php echo $data['subcategory_name']; ?></a></h3>
<div class=" clear"></div>
</div>


   <?php 
	}
echo $pagination;
    }else {echo "<p>Coming Soon!</p>";} ?>     


<div class="clear"></div>
<a href="javascript:history.go(-1)" title="Back" class="back-btn" ><i class="icon-caret-left"></i> Back</a>


</div>






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
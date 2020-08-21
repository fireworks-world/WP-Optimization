<?php
/*
Template Name: Video Gallery Page
*/
?>

<?php include("site-header.php"); ?>

<?php include("inner-banner.php"); ?>
<?php include("pagination-video.php");?>
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





<div class="video-wrap">

<?php
$cnt=0;
if($count_num_videogallery >0) {
	while($row_data_videogallery=mysql_fetch_array($result_videogallery))
	{
		$count = ++$cnt;
		$videogallery_id 			= $row_data_videogallery['videogallery_id'];
		$videogallery_title 		= $row_data_videogallery['title'];
		$videogallery_url 			= $row_data_videogallery['url'];
		$videogallery_description	= $row_data_videogallery['description'];
		$youtubeid =  substr($videogallery_url,-11);
		
?>	
  



<div class="video-box">
<div class="video">
 <iframe width="100%" height="100%" src="https://www.youtube.com/embed/FZ4mHUNX0N8" frameborder="0" allowfullscreen></iframe>
</div>
<h3><?php echo $videogallery_title;?></h3>
<p><?php echo $videogallery_description;?></p>
<div class="clear"></div>
</div>





<?php   
}
}
else
{
 	echo "<p>Coming Soon!</p>";
}?>

   
	
 
<?php echo $pagination; ?>	

	
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






<?php //include("inner-bottom-banner.php"); ?>
<?php //include("bottom-news-letter.php"); ?>
<?php include("site-footer.php"); ?>
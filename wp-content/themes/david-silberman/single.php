<?php include("site-header.php"); ?>
<?php include("blog-banner.php"); ?>





<div class="border-ht"></div>

<div class="blog-wrap">

<!--Blog Left Wrape Start-->

<div class="blog-wrap-left">


<!--Blog Post Start-->

<?php if ( have_posts() ) : ?>

 <?php while (have_posts()) : the_post(); ?>

<div class="blog-post-box">


<h1><a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

<div class="blog-post-box-in">

<?php the_content(); ?>

<div class="clear"></div>
</div>
<div class="blog-post-bottom">
<div class="blog-post-bottom-sh">

<a rel="pulse-grow" onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php the_title() ?>&amp;p[url]=<?php the_permalink() ?>&amp;p[images][0]=','sharer','toolbar=0,status=0,width=580,height=325');" href="javascript: void(0)" title="Facebook" class="pulse-grow fbb"></a>

<!--
<a href="https://twitter.com/intent/tweet?text=<?php the_title() ?>&url=<?php the_permalink() ?>&source=c-care.ca//&related=Dental" title="Twitter" class="pulse-grow tww" target="_blank"  ></a>
<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>&title=<?php the_title() ?>" class="pulse-grow inn" target="_blank" title="LinkedIn"> </a>

-->

<div class="clear"></div>


</div>
<div class="blog-post-bottom-dt"><?php the_time('M j, Y') ?> by<span> <?php the_author_posts_link(); ?></span>  </div>
<div class="blog-post-bottom-cm"><span><?php echo $post->comment_count; ?></span> Comments</div>
<div class="clear"></div>
</div>

<div class="clear"></div>
</div>
<? endwhile; ?>

<?php	
else:	
	echo '<p>Coming Soon!</p>';
endif;
?>		

<div class="clear"></div>

 <?php comments_template( '', true ); ?>
<!--Blog Post End-->





<div class="clear"></div>

</div>




<!--Blog Left Wrape Ends-->

<?php include("blog-side-bar.php"); ?>

<div class="clear"></div>
</div>

<!--Blog Wrape Ends-->


<?php include("site-footer.php"); ?>
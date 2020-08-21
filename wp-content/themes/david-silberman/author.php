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


  <div class="blog-pos-img">

<?php
        if(function_exists('the_post_thumbnail')){
        $attachments = get_children(array('post_parent' => $post->ID,
                    'post_status' => 'inherit',
                    'post_type' => 'attachment',
                    'post_mime_type' => 'image',
                    'order' => 'ASC',
                    'orderby' => 'menu_order ID'));
        $stack=array();
        foreach($attachments as $att_id => $attachment) {
              if($attachment->ID){
               $full_img_url = wp_get_attachment_url($attachment->ID);
               $img_alt =  strip_tags( get_post_meta($attachment->ID, '_wp_attachment_image_alt', true));
               }
               else{
               $full_img_url = "";
               }
               $finalImage=wp_get_attachment_image_src( $att_id, 'full' );
               if($finalImage[1]>=600 && $finalImage[2]>=600){//width checking herre...Height checked for link building anatomy post. For Infographics only
               array_push($stack, $finalImage[0]);
               break;
              
               }/*else{
               $full_img_url = wp_get_attachment_url($attachment->ID);
                array_push($thumbURL, $full_img_url);
               }*/
        }
        if ($stack[0]) {
        $image_url=$stack[0];
        }else{ 
         $image_url=$full_img_url;
        }
        //echo $image_url;
        $full_img_url = "";
        }
        ?>
            
              <?php //the_content();
        if($image_url!="") {?>
        <img class="blog-post-box-in-featured" alt="<?=$img_alt?>" src="<?=$image_url?>">
        <?php
        }
        $content = balanceTags(wp_trim_words( get_the_content(), $num_words =100, $more = null ), true);
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]>', $content);
        echo $content;
      ?>
</div>
    
<a href="<?php the_permalink() ?>"  title="Read More"class="blog-post-rm">Read More</a>
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



<!--Blog Post End-->



<?php
$post_count = $wp_query->found_posts;

$post_limit = get_option('posts_per_page ');
?>
<?php
if($post_count > $post_limit){?>
<div class="blog-pag">
<?php  wp_paginate(); ?>
</div>
<?php
 }
?>


<div class="clear"></div>
<?php	
else:	
	echo '<p>Coming Soon!</p>';
endif;
?>		
</div>




<!--Blog Left Wrape Ends-->

<?php if ( have_posts() ) : ?>
<?php include("blog-side-bar.php"); ?>
<?php endif;?>		


<div class="clear"></div>
</div>

<!--Blog Wrape Ends-->


<?php include("site-footer.php"); ?>
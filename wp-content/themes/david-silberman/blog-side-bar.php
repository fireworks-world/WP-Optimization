<!--Blog Side Bar Start-->

<div class="blog-side-bar">

<div class="side-bar-box">
<h3>Recent Posts</h3>
<ul>
<?php wp_get_archives('type=postbypost&limit=5'); ?>

</ul>


<h3>CATEGORIES</h3>
<ul>
<?php wp_list_cats('sort_column=name'); ?>

</ul>
<h3>ARCHIVES</h3>
<ul>
<?php wp_get_archives('type=monthly'); ?>
</ul>


<h3>Feeds</h3>
<ul>
<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>" class="subscribe-rss-icon">Subscribe to RSS Feeds</a></li>


</ul>


</div>
<div class="clear"></div>
</div>

<!--Blog Side Bar End-->
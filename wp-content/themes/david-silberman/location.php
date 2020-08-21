<?php
/*
Template Name: Location Page
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





<h1><?php the_title(); ?></h1>
<div class="contact_wrapper" itemscope itemtype = "https://schema.org/Dentist">
<div itemscope itemtype="https://schema.org/PostalAddress">
<h4>CONTACT DETAILS</h4>
<p itemprop="name">David Silberman DDS FAGD<br>
<span itemprop="streetAddress">5264 Beechnut St at Chimney Rock</span><br>
<span itemprop="addressLocality">Houston TX 77096 </span><br>
<span itemprop="telephone">713.981.4600</span><br>
</p></div>
<p>Office is located on the Northeast corner of Beechnut St and Chimney Rock; parking is free.</p>
<h3>From the north</h3>
<p>Proceed south on 610 highway and exit on Beechnut Street. Turn right on Beechnut and continue west past three stoplights. A hundred yards before Chimney Rock Road you will find our office on your right side. Look for the burgundy awning. </p>
<h3>From the east, southeast and Pearland</h3>
<p>Proceed west on 610 highway and exit on North South Braeswood. Continue on the feeder road and turn left under the freeway on Beechnut Street. Continue west past three stoplights. A hundred yards before Chimney Rock Road you will find our office on your right side. Look for the burgundy awning. </p>
<h3>From the west, Sugarland and Richmond</h3>
<p>Proceed northwest on highway 59 and exit on Chimney Rock. Turn right and travel south on Chimney Rock Road. Pass Bissonnet and the next major street is Beechnut. At the stoplight turn left and look for the burgundy awning.</p>
</div>
<div class="map-wrap" itemscope itemtype="http://schema.org/Dentist"><iframe src="https://www.google.com/maps/embed?pb=!1m12!1m8!1m3!1d3466.06400310678!2d-95.47599266271901!3d29.68892401828667!3m2!1i1024!2i768!4f13.1!2m1!1sDavid+Silberman+DDS+FAGD+5264+Beechnut+St+at+Chimney+Rock+Houston+TX+77096!5e0!3m2!1sen!2sin!4v1424338784520" width="100%" height="350" frameborder="0" style="border:0" itemprop="hasMap"></iframe>
<div style="display: none;" itemprop = "geo" itemscope itemtype= "http://schema.org/GeoCoordinates">
<span itemprop= "latitude">29.686228</span>
<span itemprop= "longitude">-95.4756872</span>
</div>
</div>

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
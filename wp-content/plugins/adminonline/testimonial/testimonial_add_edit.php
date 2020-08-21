<?php
	$$primary_key = $_REQUEST[$primary_key];
	$act = ($$primary_key != '')?'Edit':'Add';
	$heading="Manage ".$entity." &raquo; ".$act." ".$entity;
	
?>
<script type="text/javascript" src="<?php echo PLUGIN_URL; ?>inc/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo PLUGIN_URL; ?>testimonial/datepicker/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo PLUGIN_URL; ?>testimonial/datepicker/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo PLUGIN_URL; ?>testimonial/datepicker/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="<?php echo PLUGIN_URL; ?>testimonial/datepicker/jquery.ui.widget.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo PLUGIN_URL; ?>testimonial/datepicker/jquery.ui.all.css">


<style type="text/css">
.ui-draggable, .ui-droppable {
	background-position: top;
}

</style>

<script>
	$(function() {
		$( "#testimonial_post_date" ).datepicker();
	});
	</script>
<div class="wrap" >
  <div id="icon-edit-pages" class="icon32" align="left"></div>
  <h2><?php echo $heading;?></h2>
</div>
<div align="center"><br />
  <font color="#ff0000"><?php echo $alert; ?></font><br />
</div>
<div class="wrap" id="box1" style=" width:90%;">
  <?php	
  		if ($$primary_key != '' && $hidAction == '') {
			$res1 = $wpdb->get_row( $wpdb->prepare( "SELECT * from ".TBL." WHERE ".$primary_key." = %s", $$primary_key ) );
		    $res1 = stripslashes_deep($res1);
			$title=$res1->title;
			$author = $res1->author;
			$testimonialDate = $res1->testimonial_post_date;
			$testimony = $res1->testimony;
			$$primary_key = $res1->$primary_key;
			$status = $res1->status;
		}
		else {
			@extract($_POST);
		}
 ?>
  <form enctype="multipart/form-data" name="add" id="add" method="post" action="<?php echo $_SERVER['REQUEST_URI'].'&option=add'; ?>" onsubmit="return validate();">
    <table cellspacing="0" class="widefat" >
      <thead>
        <tr class="nodrag nodrop">
          <th colspan="3"><?php echo $act.' '.$entity; ?></th>
      </thead>
      <tbody>
	   <tr align="left">
    <!--    <tr align="left">
          <td width="17%">Title<span style=" color:#F00;">*</span></td>
          <td width="45%" align="left"><input type="text" id="title" value="<?php echo $title;?>" size="90" name="title" /></td>
          <td width="45%">&nbsp;</td>
        </tr>-->
		
        <tr align="left">
        <tr align="left">
          <td width="17%">Author<span style=" color:#F00;">*</span></td>
          <td width="45%" align="left"><input type="text" id="author" value="<?php echo $author;?>" size="90" name="author" /></td>
          <td width="45%">&nbsp;</td>
        </tr>
		    
        <tr align="left">
          <td width="17%"  valign="middle">Testimonial<span style=" color:#F00;">*</span></td>
          <td colspan="2" align="left">
		  	<textarea  name="testimony"  id="testimony" rows="10" cols="88"><?php echo $testimony;?></textarea>
				<script type="text/javascript">
					CKEDITOR.replace('testimony');
				</script>
				
          </td>
        </tr>
	<!--	 <tr align="left">
          <td width="17%">Date</td>
          <td width="45%" align="left"> <input type="text" id="testimonial_post_date"  name="testimonial_post_date" value="<?php echo ($$primary_key!='')? $testimonialDate : ''; ?>"  style="width:350px" size="60"  /></td>
          <td width="45%">&nbsp;</td>
        </tr>-->
		
		<tr align="left">
          <td width="17%"  valign="middle">Status<span style=" color:#F00;">*</span></td>
          <td colspan="2" align="left">
		  	<input type="radio" name="status" value="Y" <?php echo ($status=='Y' || $status=='')?'checked="checked"':''; ?> /> Yes &nbsp;
			<input type="radio" name="status" value="N" <?php echo ($status=='N')?'checked="checked"':''; ?> /> No
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;
            <label class="submit">
			<?php 
			if($$primary_key!="")
			{
			?>
            <input  type="submit"  value="Update" title="Update"/>
			<?php
			}
			else
			{
			?>
            <input  type="submit"  value="Save" title="Save"/>
			<?php
			}
			?>
            </label>
            <label class="submit">
            <input  type="button"  value="Cancel"  title="Cancel" onClick="javascript: window.location=('<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$page_name; ?>');"/>
            </label>
          </td>
          <td>&nbsp;</td>
        </tr>
      </tbody>
    </table>
    <input type="hidden" name="hidAction" id="hidAction" value="<?php echo ($$primary_key!='')?'edit':'add'; ?>">
	<input type="hidden" name="<?php echo $primary_key; ?>" id="<?php echo $primary_key; ?>" value="<?php echo $$primary_key; ?>">
  </form>
</div>
<script type="text/javascript">
function validate()
{
	/*if(jQuery.trim(jQuery('#title').val())=='')
	{
		 alert("Please fill in Title.");
		 jQuery('#title').focus();
		 return false;
	}*/
	if(jQuery.trim(jQuery('#author').val())=='')
	{
		 alert("Please fill in Author.");
		 jQuery('#author').focus();
		 return false;
	}
	var str=CKEDITOR.instances.testimony.getData();
    if(str=='')
	{
		 alert("Please fill in Testimonial.");
		 var str=CKEDITOR.instances.testimony;
		 str.focus() ;
		 return false;
	}  
}
jQuery('#author').focus();
</script>

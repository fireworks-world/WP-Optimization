<?php
	$$primary_key = $_REQUEST[$primary_key];
	$act = ($$primary_key != '')?'Edit':'Add';
	$heading="Manage ".$entity." &raquo; ".$act." ".$entity;
	
?>
<script type="text/javascript" src="<?php echo PLUGIN_URL; ?>inc/js/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo PLUGIN_URL; ?>testimonial/jquery_ui_datepicker/timepicker_plug/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo PLUGIN_URL; ?>testimonial/jquery_ui_datepicker/smothness/jquery_ui_datepicker.css">

<div class="wrap" >
  <div id="icon-edit-pages" class="icon32" align="left"></div>
  <h2><?php echo $heading;?></h2>
</div>
<div align="center"><br />
  <font color="#ff0000"><?php echo $alert; ?></font><br />
</div>
<div class="wrap" id="box1" style=" width:99%;">
  <?php	
  		if ($$primary_key != '' && $hidAction == '') {
			$res1 = $wpdb->get_row( $wpdb->prepare( "SELECT * from ".TBL." WHERE ".$primary_key." = %s", $$primary_key ) );
		    $res1 = stripslashes_deep($res1);
			$title = $res1->title;
			$video_script = $res1->url;
			$description=$res1->description;
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
        <tr align="left">
          <td width="17%">Title <span style=" color:#F00;">*</span></td>
          <td width="45%" align="left"><input type="text" id="title" value="<?php echo $title;?>" size="90" name="title" /></td>
          <td width="45%">&nbsp;</td>
        </tr>
		    
        <tr align="left">
          <td width="17%"  valign="middle">Video Source Url <span style=" color:#F00;">*</span></td>
          <td colspan="2" align="left">
		  <textarea name="video_script"  rows="5"  cols="45" id="video_script"><?php echo $video_script;?></textarea> 
		  Eg:-http://www.youtube.com/watch?v=66FW4i08zlA
				
          </td>
        </tr>
	<tr align="left">
          <td width="262"  valign="middle">Description</td>
          <td colspan="2" align="left">
		  <textarea id="description" name="description" rows="5"  cols="45" ><?php echo $description;?></textarea>
			      </td>
        </tr>
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

			 
   if(jQuery.trim(jQuery('#title').val())=='')
	{
		 alert("Please fill in Title.");
		 jQuery('#title').focus();
		 return false;
	 }
  if(jQuery.trim(jQuery('#video_script').val())=='')
	{
		 alert("Please fill in Video Source Url.");
		 jQuery('#video_script').focus();
		 return false;
	 }
 if(validateurl(jQuery.trim(jQuery('#video_script').val())) == false )
	 {
		 alert("Invalid Video Source Url.");
		 jQuery('#video_script').select();
		 jQuery('#video_script').focus();
		 return false;
		 
	 }	 
	 	 
/*	 var str=CKEDITOR.instances.testimony.getData();

     if(str=='')
	 {
	
		 alert("Please fill in Testimonial.");
		 var str=CKEDITOR.instances.testimony;
		 str.focus() ;
		 return false;
	 }  
*/	 
	
function validateurl(urlVal) {
         //alert(urlVal);
         // var url = document.getElementById("url").value;
	    var url = urlVal;
	    var pattern = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
        if (pattern.test(url)) {
           // alert("Url is valid");
            return true;
        } 
           // alert("Url is not valid!");
            return false;

    }
	 
	 
	 
	
}
jQuery('#author').focus();
</script>

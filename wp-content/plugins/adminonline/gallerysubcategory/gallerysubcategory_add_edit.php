<?php 
	$$primary_key = $_REQUEST[$primary_key];
	$act = ($$primary_key != '')?'Edit':'Add';
	$heading="Manage ".$entity." &raquo; ".$act." ".$entity;
?>

<script type="text/javascript" src="<?php echo PLUGIN_URL;?>inc/js/main.js"></script>

<script type="text/javascript" src="<?php echo PLUGIN_URL; ?>inc/ckeditor/ckeditor.js"></script>
<!--<script type="text/javascript" src="http://192.168.1.150/phoenix/PROJECTS/CURRENT/cestar-college/development/wp-content/plugins/adminonline/inc/js/main.js"></script>-->
<!--<script type="text/javascript">
	var lightbox_image_path = "<?php echo PLUGIN_URL; ?>inc/js/lightbox/";
    $(function() {
        $('.enlarge_image').lightBox(
			{
				imageLoading:			lightbox_image_path+'images/lightbox-ico-loading.gif',		// (string) Path and the name of the loading icon
				imageBtnPrev:			lightbox_image_path+'images/lightbox-btn-prev.gif',			// (string) Path and the name of the prev button image
				imageBtnNext:			lightbox_image_path+'images/lightbox-btn-next.gif',			// (string) Path and the name of the next button image
				imageBtnClose:			lightbox_image_path+'images/lightbox-btn-close.gif',		// (string) Path and the name of the close btn
				imageBlank:				lightbox_image_path+'images/lightbox-blank.gif',			// (string) Path and the name of a blank image (one pixel)
			}
		);
    });
</script>-->
<style type="text/css">
#previews{
	position:absolute;
	border:1px solid #ccc;
	background:#333;
	padding:5px;
	display:none;
	color:#fff;
	}
	</style>	
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
			$subcategory_name=$res1->subcategory_name;
			$category_image=$res1->subcategory_image;
			$title=$res1->title;
			$alt=$res1->alt;
			$category_id=$res1->category_id;
			$metatitle=$res1->metatitle;
			$metakeyword=$res1->metakeyword;
			$description=$res1->description;
			$$primary_key = $res1->$primary_key;
			$status = $res1->status;
			
		}
		else {
			extract($_POST);
		}
		
 ?>
  <form enctype="multipart/form-data" name="add" id="add" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>"  onsubmit="return validate();" >
    <table cellspacing="0" class="widefat" >
      <thead>
        <tr class="nodrag nodrop">
          <th colspan="3"><b><?php echo $act.' '.$entity; ?></b></th>
      </thead>
      <tbody>
<tr align="left">
          <td width="400">Gallery Name<font color="#FF0000">*</font> </td>
          <td align="left">
		  <?php
			$categories = $wpdb->get_results( 
				"
				SELECT * 
				FROM tbl_category
				WHERE status = 'Y' AND category_id = '18'
					ORDER BY ordering
				"
			);		  
			//WHERE status = 'Y'
		  //print_r($categories);
		   ?>
		  <select name="category" id="category">
		  <!--<option value="">Select Gallery</option>-->
		  <?php
			foreach ( $categories as $values ) 
			{
				?>
		        <option <?php if($values->category_id==$category_id){?> selected="selected" <?php } ?> value="<?php echo $values->category_id; ?>"><?php echo $values->category_name; ?></option>
				<?php
			}		  
          ?>
		  </select>
		  </td>
          <td width="90">&nbsp;</td>
        </tr>		<tr align="left">
          <td width="224">Category Name<font color="#FF0000">*</font> </td>
          <td width="540" align="left">
		  <input type="text" id="subcategory_name"  size="90" name="subcategory_name" value="<?php echo $subcategory_name;?>" />		        </td>
          <td width="90">&nbsp;</td>
        </tr>
	<tr align="left">
          <td >Upload Image<font color="#FF0000">*</font></td>
          <td width="716" align="left">
		  <input type="file" id="category_image" value="" size="90" name="category_image" />
		  <?php
				if ($category_image!='' && file_exists(UPLOAD_PATH.$folder_name.'/'.$category_image)){
			?>
					<a href="<?php echo UPLOAD_URL.$folder_name.'/'.$category_image; ?>" class="previews" title="">View</a>
			<?php
				}
			?>
			 <input type="hidden" id="hidcategory_image" value="<?php echo $category_image;?>" name="hidcategory_image" />
			<br /> (Restricted to Jpg, Gif and Png)		  </td>
          <td width="210">&nbsp;</td>
        </tr>
		<?php /*?>		<tr>
		  <td>Description<span style=" color:#F00;">*</span></td>
		  <td colspan="3">
          
          <textarea id="txtMainDesc" name="txtMainDesc" rows="5" cols="50"><?php echo $description;?></textarea>
         <div id="charNum"></div>

			<script type="text/javascript">

					CKEDITOR.replace('txtMainDesc');

				</script>  
          </td>
	    </tr><?php */?>
       	<?php /*?>	<tr align="left">
          <td width="224">Image Alt</td>
          <td width="540" align="left">
		  <input type="text" id="sub_alt"  size="90" name="sub_alt" value="<?php echo $alt;?>" />		        </td>
          <td width="90">&nbsp;</td>
        </tr>
		<tr align="left">
          <td width="224">Image Title <span style=" color:#F00;">*</span>&nbsp;</td>
          <td width="540" align="left">
		  <input type="text" id="sub_title"  size="90" name="sub_title" value="<?php echo $title;?>" />		        </td>
          <td width="90">&nbsp;</td>
        </tr>
		<tr> 
           <td width="224">Meta Title<span style=" color:#F00;"></span><span style=" color:#F00;">*</span>&nbsp;</td>
           <td colspan="3"><textarea name="metatitle" id="metatitle" cols="25" rows="2" style="width:250px;"><?php echo $metatitle;?></textarea></td>
        </tr>
         <tr> 
            <td width="224">Meta Description&nbsp;</td>
          <td colspan="3"><textarea name="metadesc" id="metadesc" cols="25" rows="2" style="width:250px;"><?php echo $metadesc;?></textarea></td>
        </tr><?php */?>
		<tr align="left">
          <td width="224"  valign="middle">Status<span style=" color:#F00;">*</span></td>
          <td colspan="2" align="left">
		  	<input type="radio" name="status" value="Y" <?php echo ($status=='Y' || $status=='')?'checked="checked"':''; ?> /> Yes &nbsp;
			<input type="radio" name="status" value="N" <?php echo ($status=='N')?'checked="checked"':''; ?> /> No          </td>
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
           <!-- <input  type="submit"  value="Submit" name="list" />-->
			
            </label>
            <label class="submit">
			<input type="hidden" id="hidCatImg" name="hidCatImg" value="<?php echo $category_image;?>">
            <input  type="button"  value="Cancel"  title="Cancel" onClick="javascript: window.location=('<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$page_name; ?>');"/>
            </label>          </td>
          <td>&nbsp;</td>
        </tr>
      </tbody>
    </table>
    <input type="hidden" name="hidAction" id="hidAction" value="<?php echo ($$primary_key!='')?'edit':'add'; ?>" />
	<input type="hidden" name="<?php echo $primary_key; ?>" id="<?php echo $primary_key; ?>" value="<?php echo $$primary_key; ?>" />
  </form>
</div>
<script type="text/javascript">

function validate()
{
	if (jQuery("#hidAction").val()=='delete_image'){//if delete image
		return true;
	}
    
	if(jQuery.trim(jQuery('#category').val())=='')
	{
		 alert("Please Select Gallery Name.");
		 jQuery('#category').focus();
		 jQuery('#category').select();
		 return false;
	 }
	
	if(jQuery.trim(jQuery('#subcategory_name').val())=='')
	{
		 alert("Please fill in Category Name.");
		 jQuery('#subcategory_name').focus();
		 return false;
	 }
	 <?php
	 if($$primary_key=="")
	 {
	 ?>
	if(jQuery.trim(jQuery('#category_image').val())=='')
	{
		 alert("Please upload Image.");
		 jQuery('#category_image').focus();
		 return false;
	 }
	 <?php
	 }
	 ?>

if(jQuery.trim(jQuery('#category_image').val())!='')
{
	var checkext = validateimageext( jQuery('#category_image').val()  ); 
	//alert(checkext); 
	if(checkext  == false )
	{
		alert("Please upload a valid File format('.png','.gif','.jpg','.jpeg') for Image.");
		jQuery('#category_image').focus();
		return false;
	}
									
}	 /*
var str=CKEDITOR.instances.txtMainDesc.getData();
     if(str=='')
	 {
		 alert("Please fill in Description.");
		 var str=CKEDITOR.instances.txtMainDesc;
		 str.focus() ;
		 return false;
	 }*/
 /* 	if(jQuery.trim(jQuery('#sub_title').val())=='')
	{
		 alert("Please fill in Image Title.");
		 jQuery('#sub_title').focus();
		 return false;
	}
  if(jQuery.trim(jQuery('#metatitle').val())=='')
	{
		 alert("Please fill in Meta Title.");
		 jQuery('#metatitle').focus();
		 return false;
	 }
	if(jQuery.trim(jQuery('#metadesc').val())=='')
	{
		 alert("Please fill in Meta Description.");
		 jQuery('#metadesc').focus();
		 return false;
	 }
*/	
}
jQuery('#category_name').focus();

function validateimageext(filenameval)
{


var extensions = new Array("jpg","jpeg","gif","png");
var image_file = filenameval;
var image_length = image_file.value;
var pos = image_file.lastIndexOf('.') + 1;
var ext = image_file.substring(pos, image_length);
var final_ext = ext.toLowerCase();
for (i = 0; i < extensions.length; i++)
{
    if(extensions[i] == final_ext)
    {
    return true;
    }
}
//alert("You must upload an image file with one of the following extensions: "+ extensions.join(', ') +".");
return false;
}

</script>
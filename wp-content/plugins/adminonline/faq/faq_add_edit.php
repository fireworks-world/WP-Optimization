<?php
	$$primary_key = $_REQUEST[$primary_key];
	$act = ($$primary_key != '')?'Edit':'Add';
	$heading="Manage ".$entity." &raquo; ".$act." ".$entity;
?>
<script type="text/javascript" src="<?php echo PLUGIN_URL; ?>inc/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo PLUGIN_URL;?>inc/js/main.js"></script>
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
<div class="wrap" id="box1" style=" width:99%;">
  <?php	
  		if ($$primary_key != '' && $hidAction == '') {
			$res1 = $wpdb->get_row( $wpdb->prepare( "SELECT * from ".TBL." WHERE ".$primary_key." = %s", $$primary_key ) );
		    $res1 = stripslashes_deep($res1);
			$question = $res1->faq_question;
			$answer = $res1->faq_answer;
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
          <td width="13%">Question<span style=" color:#F00;">*</span></td>
          <td width="64%" align="left"><input type="text" id="faq_question" title="Question" value="<?php echo $question;?>" size="90" name="faq_question"  onkeypress="if(event.keyCode=='13') return validate();"/></td>
          <td width="23%">&nbsp;</td>
        </tr>
		
		    
        <tr align="left">
          <td width="13%"  valign="middle">Answer<span style=" color:#F00;">*</span></td>
		  
          <td colspan="2" align="left">
		  <textarea id="faq_answer" title="Answer" name="faq_answer" cols="88" rows="10"><?php echo $answer;?></textarea>
			<script type="text/javascript">CKEDITOR.replace('faq_answer');</script>
		  </td>
        </tr>
		<tr align="left">
          <td width="13%"  valign="middle">Status<span style=" color:#F00;">*</span></td>
          <td colspan="2" align="left">
          	<input type="radio" title="Active" name="status" value="Y" <?php echo ($status=='Y' || $status=='')?'checked="checked"':''; ?> />
            Active &nbsp; <input type="radio" title="Inactive" name="status" value="N" <?php echo ($status=='N')?'checked="checked"':''; ?> />
            Inactive
          
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
jQuery('#faq_question').focus();
function validate()
{
	
	if(jQuery.trim(jQuery('#faq_question').val())=='')
	{
		 alert("Please fill in Question.");
		 jQuery('#faq_question').focus();
		 return false;
	 }
	 var str=CKEDITOR.instances.faq_answer.getData();
	 if(str=='')
	 { 
		 alert("Please fill in Answer.");
		 var str=CKEDITOR.instances.faq_answer;
		 str.focus() ;
		 return false;
	 }  
}
</script>
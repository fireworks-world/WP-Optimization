<?php 
include("../../../../wp-load.php"); 
$cat_id=$_REQUEST['id'];
if($cat_id==18){
			$subcategories = $wpdb->get_results( 
				"
				SELECT *
				FROM tbl_gallerysubcategory
				WHERE category_id =".$cat_id." and status='Y' 
				"
			);		  
		  $count=count($subcategories);
		  if($count>0)
		  {
		  ?>
		  <table>
				<tr>
			
			
			
			
			<td width="150" colspan="">Category Name<font color="#FF0000">*</font></td>
              <td colspan="583" align="left">
			  
		  <select name="subcat" id="subcat">
		  
			  <?php
				foreach ( $subcategories as $values ) 
				{
			  ?>
			  <option  value="<?php echo $values->subcategory_id; ?>"><?php echo $values->subcategory_name; ?></option>
			  <?php
				}
			  ?>
		  </select>
		  </td>
		   <td width="163">&nbsp;</td>
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  </tr>	
		  </table>
		  <?php
		  }
		  else
		  {
		  echo '<span style="color:#FF0000">Please select a Category Name</span>';
		  //"No Sub Category's Found";
		  }
}
else{?>
		  <input type="hidden" value="no-category" name="subcat" id="subcat">
<?php
}		  
		   ?>

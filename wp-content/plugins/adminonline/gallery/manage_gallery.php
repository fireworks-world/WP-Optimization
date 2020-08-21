<script type="text/javascript" src="<?php echo PLUGIN_URL; ?>inc/js/main.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
	select(); 
	
	function select() {
		   jQuery("#table-1").tableDnD({
			onDragClass: "myDragClass",
			onDrop: function(table, row) {
				var rows = table.tBodies[0].rows;
				var neworder = '';
				for (var i=0; i<rows.length; i++) {
					neworder += rows[i].id+",";
				}
				document.manage_frm.orderval.value=neworder;
				document.manage_frm.hidAction.value='ordering';
				document.manage_frm.submit();
			}
		});
	}
});
</script>

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
<?php
    include_once(PLUGIN_PATH."inc/classes/paginator.class.php");
	$title="Manage ".$entity;
    $searchText = $_REQUEST['searchText'];
	$pval = (isset($_REQUEST['pval']))?$_REQUEST['pval']:'1';
	$sort = (isset($_REQUEST['sort']))?$_REQUEST['sort']:'ordering';
	$mode = (isset($_REQUEST['mode']))?$_REQUEST['mode']:'asc';
	
	
	
	
	
    if($_REQUEST["ins"]==1)
    	$alert = $entity." Added Successfully.";
    elseif($_REQUEST["upd"]==1)
    	$alert = $entity." Updated Successfully.";
	elseif($_REQUEST["del"]==1) 
		$alert = $entity."(s) Deleted Successfully.";
	if($_REQUEST["ord"]==1)
		$alert="Ordering Changed Successfully.";
	if($srch==1)
		$alert=$rec_cnt." Record(s) matched your search.";
		
		/////////////////////     ////////////////////////
		
	if($_REQUEST["ins"]==1 && $_REQUEST['category']!="")
	{
	  $selectSql="SELECT * FROM tbl_gallery_main WHERE category_id=".$_REQUEST['category']." order by ordering"; 
	 $resulSql=mysql_query($selectSql);
	 $i=0;
	    while($dataRow=mysql_fetch_array($resulSql))
		{ 
		$j=++$i;
		$p_order = $dataRow['ordering'];
		 $updateSql="UPDATE tbl_gallery_main SET gallery_seotitle='patient-".$j."',meta_title='Patient ".$j."',title='Patient ".$j."',orderingbyname='".$j."' WHERE gallery_main_id=".$dataRow['gallery_main_id']." and category_id=".$_REQUEST['category']." and subcategory_id=".$_POST['subcategory_id'];
		 $result_updateSql=mysql_query($updateSql);
		}
		
	}
	
	elseif($_REQUEST["del"]==1 && $_REQUEST['category']!="" )
	{
	   $selectSql="SELECT * FROM tbl_gallery_main WHERE category_id=".$_REQUEST['category']." order by ordering"; 
	   $resulSql=mysql_query($selectSql);
	   $i=0;
	   
	    while($dataRow=mysql_fetch_array($resulSql))
		{  
		$j=++$i;
		
		 $updateSql="UPDATE tbl_gallery_main SET gallery_seotitle='patient-".$j."', meta_title='Patient ".$j."' ,,title='Patient ".$j."' ordering='".$j."' WHERE gallery_main_id=".$dataRow['gallery_main_id']." and category_id=".$_REQUEST['category']." and subcategory_id=".$_POST['subcategory_id'];
		 $result_updateSql=mysql_query($updateSql);
		 }
	}
	
	elseif($_REQUEST["ord"]==1 && $_REQUEST['category']!="" )
	{
	   $selectSql="SELECT * FROM tbl_gallery_main WHERE category_id=".$_REQUEST['category']." order by ordering"; 
	   $resulSql=mysql_query($selectSql);
	   $i=0;
	   
	    while($dataRow=mysql_fetch_array($resulSql))
		{  
		$j=++$i;
		$p_order = $dataRow['ordering'];
		  $updateSql="UPDATE tbl_gallery_main SET gallery_seotitle='patient-".$j."',meta_title='Patient ".$j."',title='Patient ".$j."',orderingbyname='".$j."' ,ordering='".$j."'  WHERE gallery_main_id=".$dataRow['gallery_main_id']." and category_id=".$_REQUEST['category']; 
		 $result_updateSql=mysql_query($updateSql);
		 }
	}
	
		
	
	
	
	if($searchText!='') {
         $sql="select * from tbl_gallery_main gm inner join  tbl_category c on gm.category_id=c.category_id where gm.meta_title LIKE '%$searchText%' "; 
		 $sql = $wpdb->prepare( $sql,"");
		 $count_sql = "select count(* ) from tbl_gallery_main gm inner join  tbl_category c on gm.category_id=c.category_id where gm.meta_title LIKE '%$searchText%' ";
		 $count_sql = $wpdb->prepare( $count_sql,"");
		 $srch=1;
	}
	else
	{
		if($_REQUEST['category']!=''  && $_REQUEST['subcategory_id']==''  )
		{
		
			$subcat_idSql=$wpdb->get_row("select * from tbl_gallerysubcategory gs inner join tbl_gallery_main gm on gs.subcategory_id = gm.subcategory_id where gm.category_id = '".$_REQUEST['category']."' AND gs.status ='Y' ORDER BY gs.ordering limit 1");
			$subcat_id=$subcat_idSql->subcategory_id;
			//$_REQUEST['subcategory_id'] = $subcat_id;
			$sql="select * from tbl_gallery_main gm inner join  tbl_category c on gm.category_id=c.category_id where c.category_id=".$_REQUEST['category']."  order by gm.orderingbyname asc"; 
			$sql = $wpdb->prepare( $sql,"" ) ;
			$count_sql = "select count(*) from tbl_gallery_main gm inner join  tbl_category c on gm.category_id=c.category_id where c.category_id=".$_REQUEST['category']." "; 
			$count_sql = $wpdb->prepare( $count_sql,"" ) ;
			
		}
		/*
		else if($_REQUEST['subcategory_id']!='' && $_REQUEST['category']!=''  )
		{
		
			$sql="select * from tbl_gallery_main gm inner join  tbl_category c on gm.category_id=c.category_id where c.category_id=".$_REQUEST['category']." and gm.subcategory_id=".$_REQUEST['subcategory_id']." order by gm.orderingbyname asc"; 
			$sql = $wpdb->prepare( $sql,"" ) ;
			$count_sql = "select count(*) from tbl_gallery_main gm inner join  tbl_category c on gm.category_id=c.category_id where c.category_id=".$_REQUEST['category']."  and gm.subcategory_id=".$_REQUEST['subcategory_id']." "; 
			$count_sql = $wpdb->prepare( $count_sql,"" ) ;
#########################
 	$selectSql="SELECT * FROM tbl_gallery_main WHERE category_id=".$_REQUEST['category']." and subcategory_id=".$_REQUEST['subcategory_id']." order by ordering"; 
	 $resulSql=mysql_query($selectSql);
	 $i=0;
	    while($dataRow=mysql_fetch_array($resulSql))
		{ 
		$j=++$i;
		$p_order = $dataRow['ordering'];
		 $updateSql="UPDATE tbl_gallery_main SET gallery_seotitle='patient-".$j."',meta_title='Patient ".$j."',title='Patient ".$j."',orderingbyname='".$j."' WHERE gallery_main_id=".$dataRow['gallery_main_id']." and category_id=".$_REQUEST['category']."  and subcategory_id=".$_REQUEST['subcategory_id']." ";
		 $result_updateSql=mysql_query($updateSql);
		}
##########################################	
		}		
		*/
		
		else 
		{
			$selectcategory_id=$wpdb->get_row($wpdb->prepare("select * from tbl_gallery_main gm inner join tbl_category c on gm.category_id=c.category_id where c.status='Y'",""));
			
			if($selectcategory_id){
				
				$fistcat="Yes";
				$fistcatId=$selectcategory_id->category_id;
				//$subcat_id=$selectcategory_id->subcategory_id;
				$_REQUEST['category'] = $fistcatId;
				//$_REQUEST['subcategory_id'] = $subcat_id;
				$sql="select * from tbl_gallery_main gm inner join tbl_category c on gm.category_id=c.category_id where gm.category_id=".$fistcatId." order by gm.$sort $mode ";	
				$sql = $wpdb->prepare( $sql,"" ) ;
				$count_sql = "select count(*) from tbl_gallery_main gm inner join  tbl_category c on gm.category_id=c.category_id where 1=1 AND  gm.category_id=".$fistcatId;
				$count_sql = $wpdb->prepare( $count_sql,"" ) ;
			}
			else{
				$count_sql = 0;
			}
		}
	
	}
	$tot_cnt = $wpdb->get_var( $count_sql );
	if($tot_cnt > 0) {
			$pages = new paginator;
			$pages->items_total = $tot_cnt;
			$pages->mid_range = 5;
			$pages->paginate($tot_cnt);
			$rec_list = $wpdb->get_results( $sql ." $pages->limit" );
	
			$rec_list = stripslashes_deep($rec_list);
			$rec_cnt = count($rec_list);
	}
	$ipp = $_REQUEST['ipp'];
	if($ipp!="") {
		$itemPerPageCnt = ($ipp=="All")?$tot_cnt:$ipp;
	}
	else {
		$itemPerPageCnt = 10;
	} 
	if ($_REQUEST['pval']!='')  $cnt = $itemPerPageCnt * ($_REQUEST['pval']  - 1 );

	
		
		/////////////////////     ////////////////////////
?>
<div class="wrap" >
  <div id="icon-edit-pages" class="icon32" align="left"></div>
  <h2><?php echo  $title ;?> </h2>
  <br>
</div>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="manage_frm"  name="manage_frm" method="post">
  <div align="center" style="padding-bottom:10px;"><font color="#ff0000"><?php echo $alert;?></font> </div>
  <div id="admin-top" style="padding-bottom:5px; padding-left:5px;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr class="td">
        <td width="178" class="td-widht"><label class="submit">
          <input id="Add" name="Add" type="button" title="Add <?php echo $entity; ?>" value="Add <?php echo $entity; ?>" onClick="javascript: window.location=('<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$page_name.'&option=add'; ?>');" />
          </label>
        </td>
		<td width="245">
		<?php
		$categories = $wpdb->get_results(
			"	SELECT
				DISTINCT tbl_gallery_main.category_id
				FROM tbl_gallery_main
				INNER JOIN tbl_category
				ON tbl_category.category_id = tbl_gallery_main.category_id
				ORDER BY tbl_category.ordering
				"
		);		  
		 

		?>
		<select name="maincategory_id" id="maincategory_id" onchange="javascript:maincategory(this.value);">
		<option value="0">--Select Category--</option>
		  <?php
			foreach ( $categories as $values ) 
			{
				$categoriesvalue = $wpdb->get_row(
					"
					SELECT * 
					FROM tbl_category
					WHERE status = 'Y' AND category_id = '$values->category_id'
					ORDER BY ordering
					"
				);
				?>
		        <option <?php if($categoriesvalue->category_id==$_REQUEST['category']){?> selected="selected" <?php } ?>  value="<?php echo $categoriesvalue->category_id; ?>"><?php echo $categoriesvalue->category_name; ?></option>
				<?php
			}		  
          ?>
		</select>
		</td>
<?php /*?>
<?php 
			if(isset($_REQUEST['category']) && $_REQUEST['category']==18)
			{
			
					$subcategories = $wpdb->get_results(		
						"SELECT DISTINCT tbl_gallery_main.subcategory_id
						FROM  tbl_gallery_main
						LEFT JOIN tbl_gallerysubcategory
						ON  tbl_gallery_main.subcategory_id=tbl_gallerysubcategory.subcategory_id
						WHERE  tbl_gallerysubcategory.status ='Y' 
						AND tbl_gallery_main.category_id = ".$_REQUEST['category']." order by tbl_gallerysubcategory.ordering "
					);		  
			
			
				//$sql_subcategory=$wpdb->prepare("Select * from tbl_gallerysubcategory where status='Y' AND category_id = ".$_REQUEST['category'] ,"");
				//$result_subcategory=$wpdb->get_results($sql_subcategory);
				//$count_subcategory=count($result_subcategory);
?>
<!--for sub category-->
		<td width="400" id="sub_category_div">
		 	<select id="select_subcategory" name="select_subcategory" onchange="return subcategoryname(this.value);">
			<option selected="selected" value="">--Select category--</option>
			<?php
			
			
			
				foreach ( $subcategories as $subvalues ) 
				{
				$subcategoriesvalue = $wpdb->get_row(
					"
					SELECT * 
					FROM tbl_gallerysubcategory
					WHERE status = 'Y' AND subcategory_id = '$subvalues->subcategory_id'
					ORDER BY ordering
					"
				);			
			
			
			?>
				<option <?php if($subcategoriesvalue->subcategory_id == $_REQUEST['subcategory_id']){?> selected="selected" <?php } ?> value="<?php echo $subcategoriesvalue->subcategory_id; ?>"><?php echo $subcategoriesvalue->subcategory_name; ?> 
				</option>
			<?php	
			}
			?>
		</select>
        </td>

	<?php
	}?>

<?php */?>
        <td width="666">
		  <?php /*?><label>
          <input id="searchText" name="searchText" type="text"  value="<?php echo $searchText;?>" style="float:left; margin-right:5px;"  />
          </label>
		  <label class="submit">
          <input id="srch_btn" name="srch_btn" type="submit"  onclick="return validate_search(manage_frm);"  value="Search"  title="Search" style="float:left;"/>
          </label><?php */?>
        </td>
        <td align="left" valign="middle"width="112">
		<?php if($tot_cnt>0)  {   ?>
          <label style="float:left; padding-top:3px;">Filter&nbsp;</label>
          <div> <?php echo $pages->display_items_per_page(); }?></div>
		</td>
      </tr>
    </table>
    <br />
  </div>
  <div class="wrap">
    <table width="100%" cellspacing="0" class="widefat" <?php if($fistcat=="Yes" || ($searchText=='' && $_REQUEST['category']!='' ))
	  { ?>  id="table-1"<?php } ?>>
      <thead>
        <tr class="nodrag nodrop">
          <th width="8%">SI No</th>
			
			<?php
			    if($_REQUEST['sort']=='category_name')
				{
					$mode = ($_REQUEST['mode']=='asc')?'desc':'asc';
					$field_sort = 'sorted';
					$class_sort = $_REQUEST['mode'];
				}
			?>
				
<?php /*?>          <th width="20%" class="<?php echo $field_sort.' '.$class_sort; ?>">
		  	<a href="<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$page_name.'&sort=category_name'; ?>&mode=<?php echo $mode; ?>&searchText=<?php echo $searchText; ?>&ipp=<?php echo $ipp; ?>&pval=<?php echo $pval; ?>" title="Sort by Category">
				<span>Category</span>
				<span class="sorting-indicator"></span>			</a>		  </th>
<?php */?>		 
		             <th>Category</th>
		    
		<?php /*?> 	<?php 
			if(isset($_REQUEST['category']) && $_REQUEST['category']==18)
			{?>
				<th>Category</th>
			<?php }?><?php */?>
          <th width="10%">Title</th>
          <th width="11%" class="<?php //echo $field_sort.' '.$class_sort; ?>"> 
            <span>Before Image</span> </th>
		  
           <th width="13%" class="<?php //echo $field_sort.' '.$class_sort; ?>"> 
            <span>After Image</span> </th>
		  
		  
		  	<?php
				$mode = 'asc';
				if ($_REQUEST['sort']=='status') {
					$mode = ($_REQUEST['mode']=='asc')?'desc':'asc';
					$field_sort = 'sorted';
					$class_sort = $_REQUEST['mode'];
				}
				else {
					$field_sort = 'sortable';
					$class_sort = 'desc';
				}
			?>
		  <th width="8%" class="<?php echo $field_sort.' '.$class_sort; ?>">
				<span>Status</span> 		  </th>
          <th width="8%">Edit</th>
          <th width="17%" align="right" style="text-align:right;">
		  <?php if ($rec_cnt>0) { ?>
		  	Select All
            <input type="checkbox" name="selectall" value="0" onClick="javascript:allchecked(document.manage_frm.del);"/>
		  <?php } ?>		  </th>
        </tr>
      </thead>
      <tbody>
        <?php
		
		if ($rec_cnt>0) {
			for ($i = 0; $i < $rec_cnt; $i++) {
				$cnt++; 		
				$gallery_mainId=$rec_list[$i]->gallery_main_id;		
		?>
        <tr id="<?php echo $rec_list[$i]->$primary_key; ?>">
          <td width="8%"><?php echo $cnt;?></td>
		  
          <td width="20%"><?php
                $cat_id=$rec_list[$i]->category_id;
                $category = $wpdb->get_row("SELECT category_name FROM tbl_category WHERE category_id = $cat_id");
                $category_name=$category->category_name;

				if(strlen($category_name)>35)

					echo substr($category_name,0,35).'...';

				else

				   echo $category_name;

			 ?></td>
			  <?php /*?> <?php 
			if(isset($_REQUEST['category']) && $_REQUEST['category']==18)
			{?>
          <td width="20%"><?php
                $subcat_id=$rec_list[$i]->subcategory_id;
                $subcategory = $wpdb->get_row("SELECT subcategory_name FROM tbl_gallerysubcategory WHERE subcategory_id = $subcat_id");
                $subcategory_name=$subcategory->subcategory_name;

				if(strlen($subcategory_name)>35)

					echo substr($subcategory_name,0,35).'...';

				else

				   echo $subcategory_name;

			 ?></td>
			 <?php }?><?php */?>
         <td width="17%">Patient <?php echo $cnt;?></td>
		 <td width="11%">
		 	<?php 
		 	$imageSql = $wpdb->get_row("SELECT before_image_thumb,after_image_thumb FROM tbl_gallery_main WHERE gallery_main_id = $gallery_mainId");			
		 	?>
		 	<a href="<?php echo UPLOAD_URL.$folder_name.'/before_thumb/'.$imageSql->before_image_thumb; ?>" onclick="return false;" class="previews">View</a>
		 </td>
		 
		 <td width="10%">
		 	<a href="<?php echo UPLOAD_URL.$folder_name.'/after_thumb/'.$imageSql->after_image_thumb; ?>" onclick="return false;" class="previews">View</a>
		 </td>
		  <td width="8%"><?php 
		  
		   $status_qry="select status from tbl_gallery_main where gallery_main_id=" .$rec_list[$i]->gallery_main_id;
		   $status_res=mysql_query($status_qry);
		   $status_data=mysql_fetch_array($status_res);
		  echo ($status_data[0]=='N')?'Inactive':'Active'; 
		  ?>
		  </td>
          <td width="8%"><a href="<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$page_name.'&gallery_main_id='.$rec_list[$i]->gallery_main_id;?>&option=add"  title="Edit this record">Edit</a></td>
          <td width="17%" align="right"><input type="checkbox" name="del" value="<?php echo $rec_list[$i]->$primary_key; ?>" style="cursor:default" /></td>
        </tr>
        <?php } ?>
        <tr>
          <td colspan="8" align="right"><label class="submit" >
            <input id="Delete" name="Delete" type="submit"  title="Delete selected record(s)" onclick="return validate(document.manage_frm,'delete')" value="Delete" />
            </label>		  </td>
        <tr>
        <?php } else { ?>
        <tr height="30" valign="middle">
          <td colspan="6" align="center" style="border-bottom:none;"><font color="#13859f"><strong>No <?php echo $entity; ?> Found.</strong></font></td>
        <tr>
        <?php } ?>
      </tbody>
    </table>
    <div class="tablenav" >
	
	  <?php
		if ($searchText=='' && $tot_cnt>1 && $sort=='ordering') echo '<span>Note: Drag the rows to sort them in the order of your choice</span>';
	  ?>
      <div class='tablenav-pages' align="center">
        <div style="float:right">
          <?php if($tot_cnt > $itemPerPageCnt)  { echo $pages->display_pages(); } ?>
        </div>
        <br clear="all" />
      </div>
    </div>
  </div>

  
  <input type="hidden" name="deleterec" value="" />
  <input type="hidden" name="hidAction"   id="hidAction" value=""/>
  <input type="hidden" name="orderval"   id="orderval" value=""/>
  <input type="hidden" name="fistcatId" value="<?php echo $fistcatId;?>" /> 
  
  <input type="hidden" name="subcategory_id" value="<?php echo $subcat_id;?>" />
</form>
<script type="text/javascript">
function validate_search(thisform) {
	valid = true;
	thisform.submit();
	return valid;	
}

function validate(frm,opt){
	var del_ids= '';
	if (opt=='delete'){
		var field = frm.del;
		if (field[0]){
			for (i = 0; i < field.length; i++){
				if (field[i].checked == true) {
					if (del_ids=='')
						del_ids = field[i].value;
					else
						del_ids += ',' + field[i].value;
				}
			}
		}
		else {
			if (field.checked == true) {
				del_ids = field.value;
			}
		}
		if (del_ids != ''){
			if (confirm('Are you sure you want to delete the selected record(s)?')){
				frm.deleterec.value = del_ids;
				frm.hidAction.value = 'delete';
				return true;
			}
			else return false;
		}
		frm.hidAction.value = '';
		frm.deleterec.value = '';
		alert('Please select record(s) for deleting.');
		return false;
	}
}

function allchecked(field) {
	var set_tick = true;
	if (field[0]){
		if (field[0].checked == true) set_tick = false;
		for (i = 0; i < field.length; i++){
			field[i].checked = set_tick;
		}
	}
	else {
		if (field.checked == true) set_tick = false;
		field.checked = set_tick;
	}
	document.manage_frm.selectall.checked = set_tick;
}

function maincategory(i)
{
	if(i!="0")
	{
	window.location='<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$page_name.'&sort=ordering'; ?>&mode=<?php echo $mode; ?>&ipp=<?php echo $ipp; ?>&pval=1<?php // echo $pval; ?>&category='+i;
	}
	else
	{
	window.location='<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$page_name.'&sort=ordering'; ?>&mode=<?php echo $mode; ?>&ipp=<?php echo $ipp; ?>&pval=1<?php // echo $pval; ?>';
	}
	
}



function subcategoryname(i)
{
	if(i!="0")
	{
	window.location='<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$page_name.'&sort=ordering'; ?>&mode=<?php echo $mode; ?>&ipp=<?php echo $ipp; ?>&pval=1&category=<?php echo $_REQUEST['category'];?>&subcategory_id='+i;
	}
	else
	{
	window.location='<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$page_name.'&sort=ordering'; ?>&mode=<?php echo $mode; ?>&ipp=<?php echo $ipp; ?>&pval=1&category=<?php echo $_REQUEST['category'];?>';
	}
	
}
</script>
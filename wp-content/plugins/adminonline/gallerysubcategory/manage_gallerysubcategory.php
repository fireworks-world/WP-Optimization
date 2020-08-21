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
	if($searchText!='') {
	     $where = " and (subcategory_name LIKE %s)";
		 if($_REQUEST['category']!='' )
		{
			$where .= "and category_id=".$_REQUEST['category'];
		}
	 	 $sql = "select * from ".TBL." where 1=1 ".$where." order by $sort $mode ";
		 $sql = $wpdb->prepare( $sql, '%%'.like_escape($searchText).'%%' );
		 $count_sql = "select count(*) from ".TBL." where 1=1 ".$where;
		 $count_sql = $wpdb->prepare( $count_sql, '%%'.like_escape($searchText).'%%' );
		 $srch=1;
	}
	else 
	{	
	
		if($_REQUEST['category']!='' )
		{
		$sql = "select * from ".TBL." where category_id=".$_REQUEST['category']." order by $sort $mode";
		$sql = $wpdb->prepare( $sql , '') ;
		$count_sql = "select count(*) from ".TBL." where category_id=".$_REQUEST['category']." order by $sort $mode";
		$count_sql = $wpdb->prepare( $count_sql ,'' ) ;
		
		}
		else
		{
		$sql = "select * from ".TBL." where 1=1 order by $sort $mode ";
		$sql = $wpdb->prepare( $sql , '') ;
		$count_sql = "select count(*) from ".TBL." where 1=1 ";
		$count_sql = $wpdb->prepare( $count_sql , '') ;
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

    if($_REQUEST["ins"]==1)
    	$alert = $entity." Added Successfully.";
    elseif($_REQUEST["upd"]==1)
    	$alert = $entity." Updated Successfully.";
	elseif($_REQUEST["del"]==1) 
		$alert = $entity."(s) Deleted Successfully.";
	if($_REQUEST["ord"]==1)
		$alert="Ordering Changed Successfully.";
	if($srch==1)
		$alert=$tot_cnt." Record(s) matched your search.";
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
        <td width="177" class="td-widht"><label class="submit">
          <input id="Add" name="Add" type="button" title="Add <?php echo $entity; ?>" value="Add <?php echo $entity; ?>" onClick="javascript: window.location=('<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$page_name.'&option=add'; ?>');" />
          </label>
        </td>
		<?php /*?>
		<td width="245">
		<?php
		$categories = $wpdb->get_results(
		"SELECT DISTINCT tbl_gallerysubcategory.category_id
			FROM  tbl_gallerysubcategory
			LEFT JOIN tbl_category
			ON  tbl_gallerysubcategory.category_id=tbl_category.category_id
			WHERE  tbl_gallerysubcategory.status ='Y' AND tbl_category.status ='Y'  order by tbl_category.ordering "
		
		);		  
		 

		?>
		<select name="maincategory_id" id="maincategory_id" onchange="javascript:maincategory(this.value);">
		<!--<option value="0">--Select Gallery--</option>-->
		  <?php
			foreach ( $categories as $values ) 
			{
			
				$categoriesvalue = $wpdb->get_row(
					"
					SELECT * 
					FROM tbl_category
					WHERE status = 'Y' AND category_id = '18'
					ORDER BY ordering
					"
				);
				//WHERE status = 'Y' AND category_id = '$values->category_id'
				?>
		        <option <?php if($categoriesvalue->category_id==$_REQUEST['category']){?> selected="selected" <?php } ?>  value="<?php echo $categoriesvalue->category_id; ?>"><?php echo $categoriesvalue->category_name; ?></option>
				<?php
			}		  
          ?>
		</select>
		</td><?php */?>

        <td width="427">
		  <label>
          <input id="searchText" name="searchText" type="text"  value="<?php echo $searchText;?>" style="float:left; margin-right:5px;"  />
          </label>
		  <label class="submit">
          <input id="srch_btn" name="srch_btn" type="submit"  onclick="return validate_search(manage_frm);"  value="Search"  title="Search" style="float:left;"/>
          </label>
        </td>
        <td align="left" valign="middle"width="104">
		<?php if($tot_cnt>0)  {   ?>
          <label style="float:left; padding-top:3px;">Filter&nbsp;</label>
          <div> <?php echo $pages->display_items_per_page(); }?></div>
		</td>
      </tr>
    </table>
    <br />
  </div>
  <div class="wrap">
    <table width="100%" cellspacing="0" class="widefat" id="table-1" <?php if($searchText=='' && $tot_cnt>1) { ?> <?php } ?>>
      <thead>
        <tr class="nodrag nodrop">
          <th width="6%">SI No</th>
			
			<?php
			    if($_REQUEST['sort']=='subcategory_name')
				{
					$mode = ($_REQUEST['mode']=='asc')?'desc':'asc';
					$field_sort = 'sorted';
					$class_sort = $_REQUEST['mode'];
				}
			?>
				
          <th width="26%" class="<?php echo $field_sort.' '.$class_sort; ?>">
		  	<a href="<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$page_name.'&sort=subcategory_name'; ?>&mode=<?php echo $mode; ?>&searchText=<?php echo $searchText; ?>&ipp=<?php echo $ipp; ?>&pval=<?php echo $pval; ?>" title="Sort by Category">
				<span>Category</span>
				<span class="sorting-indicator"></span>			</a>		  </th>
		 
		  <th width="10%" class="<?php echo $field_sort.' '.$class_sort; ?>">
		  
				<span>Image</span>		  </th>
		
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
		  <th width="10%" class="<?php echo $field_sort.' '.$class_sort; ?>">
		  
				<span>Status</span>		  </th>
          <th width="8%">Edit</th>
          <th width="13%" align="right" style="text-align:right;">
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
			
		?>
        <tr id="<?php echo $rec_list[$i]->$primary_key; ?>">
          <td width="5%"><?php echo $cnt;?></td>
		  
          <td width="26%"><?php

			  	$subcategory_name = strip_tags($rec_list[$i]->subcategory_name);

				if(strlen($subcategory_name)>35)

					echo substr($subcategory_name,0,35).'...';

				else

				   echo $subcategory_name;

			 ?></td>
			 
			 
			 
		<td width="10%"><?php $category_image = strip_tags($rec_list[$i]->subcategory_image); ?><a href="<?php echo UPLOAD_URL.$folder_name.'/'.$category_image; ?>" onclick="return false;" class="previews">View</a></td>
		  
		  <td width="10%"><?php echo ($rec_list[$i]->status=='N')?'Inactive':'Active'; ?></td>
          <td width="8%"><a href="<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$page_name.'&'.$primary_key.'='.$rec_list[$i]->$primary_key;?>&option=add"  title="Edit this record">Edit</a></td>
          <td width="13%" align="right"><input type="checkbox" name="del" value="<?php echo $rec_list[$i]->$primary_key; ?>" style="cursor:default" /></td>
        </tr>
        <?php } ?>
        <tr>
          <td colspan="7" align="right"><label class="submit" >
            <input id="Delete" name="Delete" type="submit"  title="Delete selected record(s)" onclick="return validate(document.manage_frm,'delete')" value="Delete" />
            </label>		  </td>
        <tr>
        <?php } else { ?>
        <tr height="30" valign="middle">
          <td colspan="5" align="center" style="border-bottom:none;"><font color="#13859f"><strong>No <?php echo $entity; ?> Found.</strong></font></td>
        <tr>
        <?php } ?>
      </tbody>
    </table>
    <div class="tablenav" >
	
	  <?php
		if ($searchText=='' && $tot_cnt>1 && $sort=='g.ordering') echo '<span>Note: Drag the rows to sort them in the order of your choice</span>';
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
	window.location='<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$page_name.'&sort=ordering'; ?>&mode=<?php echo $mode; ?>&ipp=<?php echo $ipp; ?>&pval=1&category='+i;
	}
	else
	{
	window.location='<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$page_name.'&sort=ordering'; ?>&mode=<?php echo $mode; ?>&ipp=<?php echo $ipp; ?>&pval=1';
	}
	
}
</script>

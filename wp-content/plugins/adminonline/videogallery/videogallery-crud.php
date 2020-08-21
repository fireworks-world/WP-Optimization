<?php
	 $action=$_REQUEST["hidAction"];
	 
		
	 function videogallery_validation(){
	
		if (trim($_POST["title"])==''){
			return 'Please fill in Title.';
		}
		return 1;
	 }
	 switch($action){
	
	     case 'add': 
		 	$validation_function = $page_name.'_validation';
		 	$validation_status = $validation_function();
		 	if ($validation_status != 1){
				$alert = $validation_status;
				include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
				exit();
			}
		    //duplicate checking         
			/*$dup = $wpdb->get_var( $wpdb->prepare( "select count(*) from ". TBL ." where author = %s", trim($_POST["author"]) ) );	
			if( $dup>0) {
				$alert = 'This author is already existing';
				include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
				exit();
			}
			else{*/
							$updateNewsSql="update tbl_testimonial SET ordering=(ordering + 1)";
							$updateNewsSqlConnect=mysql_query($updateNewsSql);
								
				$data = array(
							'title' => $_POST['title'],
							'url' => $_POST['video_script'],
							'description' 	=> $_POST['description'],
							'status' => $_POST['status'],
							'ordering'=>1,
						);
				$wpdb->insert( TBL, $data, array('%s','%s','%s','%s','%d') );
				wp_redirect("admin.php?page=".$page_name."&ins=1");
		 	//}
		 	break;

		 case 'edit':
			/*$dup = $wpdb->get_var( $wpdb->prepare( "SELECT count(*)  from " .TBL." WHERE author = %s AND   ".$primary_key." <> %s ", trim($_POST["author"]), $_POST[$primary_key]  ) ); 
			if($dup > 0) {
				$alert = 'This author is already existing';
				include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
				exit();
			}
			else{*/
				$validation_function = $page_name.'_validation';
				$validation_status = $validation_function();
				if ($validation_status != 1){
					$alert = $validation_status;
					include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
					exit();
				}
		 
				$data = array(
							'title' => $_POST['title'],
							'url' => $_POST['video_script'],
							'description' 	=> $_POST['description'],
							'status' => $_POST['status'],
						);
				$where = array(
							$primary_key => $_POST[$primary_key]
						);
				$wpdb->update( TBL, $data, $where, array('%s','%s','%s','%s'), '%d' );
			  	wp_redirect("admin.php?page=".$page_name."&upd=1");
			//}
			break;
			
		 case 'delete':
			if ($_POST["deleterec"]!='') {
				$delete_sql = $wpdb->prepare( "DELETE from ".TBL." where ".$primary_key."  in (".$_POST["deleterec"].")");
				$wpdb->query( $delete_sql );
			}
			wp_redirect("admin.php?page=".$page_name."&del=1");
			break;
			
		 case 'ordering':
			if ($_POST["orderval"]!=''){
				$curPage=$_REQUEST['pval'];
				$totPage=$_REQUEST['ipp'];	
				$cnt=(($curPage-1)*$totPage)+1;
				$arr_order=explode(",",$_POST["orderval"]);
				for($i=0;$i<count($arr_order);$i++) {
					if($arr_order[$i]!="") {
						$data = array(
							'ordering' => $cnt
						);
						$where = array(
							$primary_key => $arr_order[$i]
						);
						$wpdb->update( TBL, $data, $where, '%d', '%d' );
						$cnt++;
					}
				}
			}
			wp_redirect("admin.php?page=".$page_name."&ord=1&pval=".$curPage."&ipp=".$totPage);
			break;
	} // end of switch case
?>
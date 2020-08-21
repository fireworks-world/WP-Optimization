<?php
	 $action=$_REQUEST["hidAction"];
	 // include(PLUGIN_PATH."inc/classes/image.class.php");
	 function faq_validation(){
	 	
	 	if (trim($_POST["faq_question"])==''){
			return 'Please fill in Question.';
		}
		$faq=strip_tags($_REQUEST["faq_answer"]);
		$sPattern = '/&nbsp;*/m';
		$sReplace = '';
		$faq=preg_replace( $sPattern, $sReplace, $faq );
		$sPattern1 = '/\s*/m'; 
		$sReplace1 = '';
		$faq=preg_replace( $sPattern1, $sReplace1, $faq );
	
		if (trim($faq)==''){
			return 'Please fill in Answer.';
		}
		if($_REQUEST['option']=="add")
		{
			global $_FILES;
			
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
		    	
				$updateFaqSql="update tbl_faq SET ordering=(ordering + 1) ";
				$updateFaqSqlConnect=mysql_query($updateFaqSql);
				$data = array(
						'faq_question'				=> $_POST['faq_question'],
						'faq_answer' 			    => $_POST['faq_answer'],
						'status' 				=> $_POST['status'],
						'ordering'				=>1
				);
				$wpdb->insert( TBL, $data, array('%s','%s','%s','%d') );
				//$wpdb->print_error(); exit;
				wp_redirect("admin.php?page=".$page_name."&ins=1");
		 	
		 	break;

		 case 'edit':
				$validation_function = $page_name.'_validation';
				$validation_status = $validation_function();
				if ($validation_status != 1){
					$alert = $validation_status;
					include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
					exit();
				}
			//end edit code for before image Uploading and Deleting	
		 	$data = array(
			               'faq_question'				=> $_POST['faq_question'],
							'faq_answer' 			    => $_POST['faq_answer'],
							'status' 				=> $_POST['status']
						);
		 
				$where = array(
							$primary_key => $_POST[$primary_key]
						);
				$wpdb->update( TBL, $data, $where, array('%s','%s','%s'), '%d' );
			  	wp_redirect("admin.php?page=".$page_name."&upd=1");
			//}
			break;
			
		  case 'delete':
			if ($_POST["deleterec"]!='') {
			
				$res_order = $wpdb->get_row("SELECT ordering from " .TBL." WHERE  faq_id=".$_POST[$primary_key]);
				$orderingDel= $res_order->ordering;
				$chorder_sql="UPDATE ".TBL." SET ordering=(ordering - 1) WHERE ordering > '".$orderingDel."' and  faq_id=".$_POST[$primary_key]; 
				$wpdb->query($chorder_sql); 
				
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
							'ordering' => ($i+1)
						);
						$where = array(
							$primary_key => $arr_order[$i]
									);
						$wpdb->update( TBL, $data, $where, '%d', '%d' );
						//$wpdb->print_error(); exit;
						$cnt++;
					}
				}
			}
			wp_redirect("admin.php?page=".$page_name."&ord=1&pval=".$curPage."&ipp=".$totPage."");
			break;
	} // end of switch case
?>
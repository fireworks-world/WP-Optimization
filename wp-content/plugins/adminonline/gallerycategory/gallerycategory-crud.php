<?php
	 require("seofun.php");	 
	 $action=$_REQUEST["hidAction"];
	 
	 
	 include(PLUGIN_PATH."inc/classes/image.class.php");
	 include(PLUGIN_PATH."inc/classes/class.image.php");
		 
		  // server side validation//
	  function gallerycategory_validation(){
		if (trim($_POST["category_name"])==''){
			return 'Please fill in Category Name.';
		}
/*		if (trim($_POST["metatitle"])==''){
			return 'Please fill in Meta Title.';
		}
		if (trim($_POST["metadesc"])==''){
			return 'Please fill in Meta Description.';
		}
*/		return 1;
	 }
	// server side validation// 
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
			$dup = $wpdb->get_var( $wpdb->prepare( "select count(*) from ". TBL ." where category_name = %s", trim($_POST["category_name"]) ) );	
			if( $dup>0) {
				$alert = 'This '.$entity .' already exists.';
				include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
				exit();
			}
			
			//code start for before image
				if (trim($_FILES['category_image']['name']) != ''){//image uploading
					$categoryImage 		= new Image1($_FILES['category_image']['tmp_name']);
					$category_thumbimage 	= new Image($_FILES['category_image']['tmp_name']);
					//$productImage_thumb_detailpage = new Image($_FILES['product_image']['tmp_name']);
					$valid_image_types = array(1,2,3);
					
                    $source_path =$_FILES['category_image']['tmp_name'];

										
				if (!in_array($categoryImage->info['image_type'],$valid_image_types) || $_FILES['category_image']['size']<=0){
						$alert = 'Uploaded image is corrupted or the image type is not allowed or Image size Exceeds the Limit';
						include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
						exit();
					}

						 list($bwidth, $bheight, $btype, $battr)= getimagesize($_FILES['category_image']['name']);

					$categoryImage_name = rand().time().$_FILES['category_image']['name'];
					$categoryImage->resize(374, 166);
					$categoryImage->save(UPLOAD_PATH.$folder_name.'/'.$categoryImage_name );
					
					//$category_thumbimage->resize(100,144);
					//$category_thumbimage->save(UPLOAD_PATH.$folder_name.'/thumbs/'.$categoryImage_name );
					
					//$category_thumbimage=UPLOAD_PATH.$folder_name.'/thumbs/'.$categoryImage_name;
					//cropImages($source_path,$category_thumbimage,179,108);
					
					
					$category_thumbimage->whitespace(374, 166, array('color' => '#FFFFFF')); // With Color
					$category_thumbimage->output(UPLOAD_PATH.$folder_name.'/thumbs/'.$categoryImage_name); 				

				}
				
				else
					$categoryImage_name  = '';
				$updateCategorySql="update ".TBL." SET ordering=(ordering + 1)";
				$updateCategorySqlConnect=mysql_query($updateCategorySql);
				$status="Y";
				if($_POST['status']=='Y')
				{
					$status="Y";
				}
				else
				{
					$status="N";
				}
				
				$data = array(						
							'category_name'   			=> $_POST['category_name'],
							'cat_description'   		=> $_POST['txtMainDesc'],
							'category_seotitle'   		=> generate_seo_link($_POST['category_name']),
							'category_image' 		 	=> $categoryImage_name,
							'category_thumbimage' 		=> $categoryImage_name,
							'metatitle' 				=> $_POST['metatitle'],
							'metakeyword' 				=> $_POST['metakeyword'],
							'metadesc' 					=> $_POST['metadesc'],			
							'status' 				 	=> $status,
							'ordering'				 	=>1
						);
						$wpdb->insert( TBL, $data, array('%s','%s','%s','%s','%s','%s','%s','%s','%s','%d') );
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
			$dup = $wpdb->get_var( $wpdb->prepare( "SELECT count(*)  from " .TBL." WHERE category_name = %s AND   ".$primary_key." <> %s ", trim($_POST["category_name"]), $_POST[$primary_key]  ) ); 
			if($dup > 0) {
				$alert = 'This '.$entity .' already exists.';
				include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
				exit();
			}
			if (trim($_FILES['category_image']['name']) != ''){//image uploading
					$categoryImage 	  = new Image1($_FILES['category_image']['tmp_name']);
					$categoryImage_thumb = new Image($_FILES['category_image']['tmp_name']);
					
                    $source_path =$_FILES['category_image']['tmp_name'];
					
					$valid_image_types = array(1,2,3);
			if (!in_array($categoryImage->info['image_type'],$valid_image_types) || $_FILES['category_image']['size']<=0){
						$alert = 'Uploaded image is corrupted or the image type is not allowed or Image size Exceeds the Limit';
						include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
						exit();
					}
					//delete the old image
		$old_categoryimg = trim( $wpdb->get_var( $wpdb->prepare( "select category_image from ". TBL ." where ".$primary_key." = %s", trim($_POST[$primary_key]) ) ) );
			
			if ($old_categoryimg!='' && file_exists(UPLOAD_PATH.$folder_name.'/thumbs/'.$old_categoryimg)){
						//unlink(UPLOAD_PATH.$folder_name.'/thumb_detailpage/'.$old_filmstripimg);
						unlink(UPLOAD_PATH.$folder_name.'/thumbs/'.$old_categoryimg);
						unlink(UPLOAD_PATH.$folder_name.'/'.$old_categoryimg);
					}
					$categoryImage_name = rand().time().$_FILES['category_image']['name'];
					$categoryImage->resize(374, 166);
					$categoryImage->save(UPLOAD_PATH.$folder_name.'/'.$categoryImage_name );
					
					//$categoryImage_thumb->resize(100,144);
					//$categoryImage_thumb->save(UPLOAD_PATH.$folder_name.'/thumbs/'.$categoryImage_name );
					
					
					 //$categoryImage_thumb=UPLOAD_PATH.$folder_name.'/thumbs/'.$categoryImage_name;
					 //cropImages($source_path,$categoryImage_thumb,179,108);
					$categoryImage_thumb->whitespace(374, 166, array('color' => '#FFFFFF')); // With Color
					$categoryImage_thumb->output(UPLOAD_PATH.$folder_name.'/thumbs/'.$categoryImage_name); 				
					}
					
					else
					{
					$categoryImage_name=$_POST['hidcategory_image'];
					
					}
				if($_POST['status']=='Y')
				{
					$status="Y";
				}
				else
				{
					$status="N";
				}
				
				$data = array(						
							'category_name'   			=> $_POST['category_name'],
							'cat_description'   		=> $_POST['txtMainDesc'],
							'category_seotitle'   		=> generate_seo_link($_POST['category_name']),
							'category_image' 		 	=> $categoryImage_name,
							'category_thumbimage' 		=> $categoryImage_name,
							'metatitle' 				=> $_POST['metatitle'],
							'metakeyword' 				=> $_POST['metakeyword'],
							'metadesc' 					=> $_POST['metadesc'],							
							'status' 				 	=> $status,
						);
						
				$data_format = array('%s','%s','%s','%s','%s','%s','%s','%s','%s');
				
				$where = array(
							$primary_key => $_POST[$primary_key]
						);
				$wpdb->update( TBL, $data, $where, $data_format, '%d' );
				
				//$wpdb->print_error(); exit;
				wp_redirect("admin.php?page=".$page_name."&upd=1");
			
			break;
			
			case 'delete':
			if ($_POST["deleterec"]!='') {
				//delete the image
				$id_arr = explode(',',$_POST["deleterec"]);
				$del_arr = array();
				$del = 1;
				foreach ($id_arr as $key => $val){
					$items_found = $wpdb->get_var( $wpdb->prepare( "select count(*) from ".TBL." where category_id = %d", $val ) );
					
					if ($items_found>0) {
						
						array_push($del_arr,$val); 
						$old_categoryimg = trim( $wpdb->get_var( $wpdb->prepare( "select category_image from ". TBL ." where ".$primary_key." = %s", $val ) ) );
						
						
					if ($old_categoryimg!='' && file_exists(UPLOAD_PATH.$folder_name.'/thumbs/'.$old_categoryimg)){
						    //@unlink(UPLOAD_PATH.$folder_name.'/thumb_detailpage/'.$old_productimg);
							@unlink(UPLOAD_PATH.$folder_name.'/thumbs/'.$old_categoryimg);
							@unlink(UPLOAD_PATH.$folder_name.'/'.$old_categoryimg);
						}
						
						
						
					$selectGallerymain=$wpdb->get_results($wpdb->prepare("select * from tbl_gallerysubcategory where category_id=$val",""));
					if(count($selectGallerymain)>0)
					{
                                            
                                                $alert2 = 'Delete Sub Category Under this Category';
						include(PLUGIN_PATH.$folder_name.'/manage_gallerycategory.php');
						exit();
                                                
					}
						
					}
						if (count($del_arr)>0){
					//print_r($del_arr); exit;

					$del_str = implode(',',$del_arr);
					
					
                                         $delete_sql = $wpdb->prepare( "DELETE from ".TBL." where ".$primary_key."  in (".$del_str.")");
					                    $wpdb->query( $delete_sql );
					
				}
					
				}
				
			}
			
			wp_redirect("admin.php?page=".$page_name."&del=$del");
			break;
			
			case 'ordering':
			if ($_POST["orderval"]!=''){
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
					}
				}
			}
			
			wp_redirect("admin.php?page=".$page_name."&ord=1");
			
			break;
	     
	} // end of switch case 
	
?>
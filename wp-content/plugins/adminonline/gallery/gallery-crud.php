<?php
require("seofun.php");	 
$action=$_REQUEST["hidAction"];
$gallery_count=$_REQUEST['gallery_count'];  
//include(PLUGIN_PATH."inc/classes/image.class.php");
include(PLUGIN_PATH."inc/classes/class.image.php");
include(PLUGIN_PATH."inc/classes/ImageClassMerge.php");
include(PLUGIN_PATH."inc/classes/thumb.php");
// server side validation//
function gallery_validation(){
	if (trim($_POST["txtCategory"])==''){
		return 'Please Select Gallery Name.';
	}
	return 1;
}


if($_POST["subcat"]=='no-category'){
	$_POST["subcat"]=0;
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
		$dup2 = $wpdb->get_var( $wpdb->prepare( "select count(*) from tbl_gallery_main where category_id=".$_POST["txtCategory"]." and subcategory_id=".$_POST["subcat"]." and  gallery_seotitle = %s ", trim($_POST["seo_title"]) ) );	

		$updateGallerySql="update tbl_gallery_main SET ordering=(ordering + 1) where category_id=".$_POST['txtCategory']." and subcategory_id=".$_POST['subcat'];
		$updateGallerySqlConnect=mysql_query($updateGallerySql);

		for($i=1;$i<=$gallery_count;$i++)
		{
			if($_REQUEST['txtBeforeImageTitle_'.$i]!="")
			{
				//code start for  image Upload
				if (trim($_FILES['before_image_'.$i]['name']) != '' && trim($_FILES['after_image_'.$i]['name']) != ''  ){
					//image uploading
					$before_image 			= new Image($_FILES['before_image_'.$i]['tmp_name']);
					$after_image 			= new Image($_FILES['after_image_'.$i]['tmp_name']); 

					$before_thumb_image 	= new Image($_FILES['before_image_'.$i]['tmp_name']); 
					$after_thumb_image 		= new Image($_FILES['after_image_'.$i]['tmp_name']); 

					$before_sthumb_image 	= new Image($_FILES['before_image_'.$i]['tmp_name']); 
					$after_sthumb_image 	= new Image($_FILES['after_image_'.$i]['tmp_name']); 

					$before_popup_image 	= new Image($_FILES['before_image_'.$i]['tmp_name']); 
					$after_popup_image 		= new Image($_FILES['after_image_'.$i]['tmp_name']); 

					$before_patient_image 	= new Image($_FILES['before_image_'.$i]['tmp_name']); 
					$after_patient_image 	= new Image($_FILES['after_image_'.$i]['tmp_name']); 

					$valid_image_types = array('image/png','image/jpeg','image/gif');

					if (!in_array($_FILES['before_image_'.$i]['type'],$valid_image_types) || $_FILES['before_image_'.$i]['size']<=0){
					$alert = 'Uploaded image is corrupted or the image type is not allowed or Image size Exceeds the Limit';
					include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
					exit();
					}

					if (!in_array($_FILES['after_image_'.$i]['type'],$valid_image_types) || $_FILES['after_image_'.$i]['size']<=0){
					$alert = 'Uploaded image is corrupted or the image type is not allowed or Image size Exceeds the Limit';
					include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
					exit();
					}

					$beforeImage_name = rand().time().$_FILES['before_image_'.$i]['name']; 
					$afterImage_name = rand().time().$_FILES['after_image_'.$i]['name']; 

					//--------------------------------- 								
					$source_path_before =$_FILES['before_image_'.$i]['tmp_name'];
					$source_path_after =$_FILES['after_image_'.$i]['tmp_name'];
					//--------------------------------- 

					$dest_before_large=UPLOAD_PATH.$folder_name.'/before/'.$beforeImage_name;
					$before_image->whitespace(420, 285, array('color' => '#FFFFFF')); // With Color              
					$before_image->output($dest_before_large);

					$dest_before_medium=UPLOAD_PATH.$folder_name.'/before_medium/'.$beforeImage_name;
					$before_thumb_image->whitespace(188, 105, array('color' => '#FFFFFF')); // With Color
					$before_thumb_image->output(UPLOAD_PATH.$folder_name.'/before_medium/'.$beforeImage_name );						

					$dest_before_thumb=UPLOAD_PATH.$folder_name.'/before_thumb/'.$beforeImage_name;
					$before_sthumb_image->whitespace(178, 200, array('color' => '#FFFFFF')); // With Color
					$before_sthumb_image->output(UPLOAD_PATH.$folder_name.'/before_thumb/'.$beforeImage_name );

					$dest_before_popup=UPLOAD_PATH.$folder_name.'/before_popup/'.$beforeImage_name;
					$before_popup_image->whitespace(267, 299, array('color' => '#FFFFFF')); // With Color
					$before_popup_image->output(UPLOAD_PATH.$folder_name.'/before_popup/'.$beforeImage_name );

					$dest_before_patient=UPLOAD_PATH.$folder_name.'/before_patient/'.$beforeImage_name;
					$before_patient_image->whitespace(640, 440, array('color' => '#FFFFFF')); // With Color
					$before_patient_image->output(UPLOAD_PATH.$folder_name.'/before_patient/'.$beforeImage_name );

					#######################################

					$dest_after_large=UPLOAD_PATH.$folder_name.'/after/'.$afterImage_name;
					$after_image->whitespace(420, 285, array('color' => '#FFFFFF')); // With Color
					$after_image->output(UPLOAD_PATH.$folder_name.'/after/'.$afterImage_name); 

					$dest_after_medium=UPLOAD_PATH.$folder_name.'/after_medium/'.$afterImage_name;
					$after_thumb_image->whitespace(188, 105, array('color' => '#FFFFFF')); // With Color
					$after_thumb_image->output(UPLOAD_PATH.$folder_name.'/after_medium/'.$afterImage_name); 

					$dest_after_thumb=UPLOAD_PATH.$folder_name.'/after_thumb/'.$afterImage_name;
					$after_sthumb_image->whitespace(178, 200, array('color' => '#FFFFFF')); // With Color
					$after_sthumb_image->output(UPLOAD_PATH.$folder_name.'/after_thumb/'.$afterImage_name); 								

					$dest_after_popup=UPLOAD_PATH.$folder_name.'/after_popup/'.$afterImage_name;
					$after_popup_image->whitespace(267, 299, array('color' => '#FFFFFF')); // With Color
					$after_popup_image->output(UPLOAD_PATH.$folder_name.'/after_popup/'.$afterImage_name); 								

					$dest_after_patient=UPLOAD_PATH.$folder_name.'/after_patient/'.$afterImage_name;
					$after_patient_image->whitespace(640, 440, array('color' => '#FFFFFF')); // With Color
					$after_patient_image->output(UPLOAD_PATH.$folder_name.'/after_patient/'.$afterImage_name); 								

					/****************  Merge Images *********************/
					$ImgObj=new ImageClass();

					$ImgObj->mergeImages(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/large/merged/MERGED'.$i."_",$dest_before_large,$dest_after_large);
					$merge2Temp =$ImgObj->merge_path;
					$merge2Temp=str_replace(ABSPATH.'wp-content/uploads/gallery/BEFORE_AFTER_GALLERY/large/merged/',"",$merge2Temp);

					$ImgObj->mergeImages(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/thumb/merged/MERGED'.$i."_",$dest_before_thumb,$dest_after_thumb);
					$merge3Temp =$ImgObj->merge_path;
					$merge3Temp=str_replace(ABSPATH.'wp-content/uploads/gallery/BEFORE_AFTER_GALLERY/thumb/merged/',"",$merge3Temp);

					$ImgObj->mergeImages(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/medium/merged/MERGED'.$i."_",$dest_before_medium,$dest_after_medium);
					$merge4Temp =$ImgObj->merge_path;
					$merge4Temp=str_replace(ABSPATH.'wp-content/uploads/gallery/BEFORE_AFTER_GALLERY/medium/merged/',"",$merge4Temp);

					$ImgObj->mergeImages(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/popup/merged/MERGED'.$i."_",$dest_before_popup,$dest_after_popup);
					$merge5Temp =$ImgObj->merge_path;
					$merge5Temp=str_replace(ABSPATH.'wp-content/uploads/gallery/BEFORE_AFTER_GALLERY/popup/merged/',"",$merge5Temp);
					/******************************************************/								
				}

				else
				{
					$beforeImage_name  = '';
					$afterImage_name  = '';
				}	

				//code start for  image Upload
				$updateGallerySql="update tbl_gallery_main SET ordering=(ordering + 1)";
				$updateGallerySqlConnect=mysql_query($updateGallerySql);
				
				if($_POST['status']=='Y')
				{
					$status="Y";
				}
				else
				{
					$status="N";
				}
				if($_POST['ishome']=='Y')
				{
					$ishome="Y";
				}
				else
				{
					$ishome="N";
				}
				$data = array(		
					'category_id'   			=> $_POST['txtCategory'],
					'subcategory_id'   			=> $_POST['subcat'],
					'title'   					=> $_POST['txtMainTitle'],
					'gallery_seotitle'   		=> generate_seo_link($_POST['seo_title']),
					'meta_title'				=> $_POST['meta_title'],
					'meta_description'			=> $_POST['bdescription_'.$i],
					'meta_keywords'				=> $_POST['meta_keywords'],
					'description' 				=> $_POST['description_'.$i],			
					'status' 				 	=> $status,
					'ishome' 				 	=> $_POST['ishome_'.$i],
					'ordering'				 	=> 1,
					'before_imagetitle' 		=> $_POST['txtBeforeImageTitle_'.$i],
					'before_imagealt'           => $_POST['txtBeforeImageAlt_'.$i],
					'before_image' 				=> $beforeImage_name,
					'before_image_thumb' 		=> $beforeImage_name,
					'after_imagetitle' 			=> $_POST['txtAfterImageTitle_'.$i],
					'after_imagealt'            => $_POST['txtAfterImageAlt_'.$i],
					'after_image' 				=> $afterImage_name,
					'after_image_thumb' 		=> $afterImage_name,
					'merged_image'				=> $merge2Temp,	
					'merged_thumb'				=> $merge3Temp
				);


				$wpdb->insert( 'tbl_gallery_main', $data, array('%d','%d','%s','%s','%s','%s','%s','%s','%s','%s','%d','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s') );
			}
		}		
	wp_redirect("admin.php?page=".$page_name."&ins=1&category=".$_POST['txtCategory']);  
	break;
				
				
case 'edit':

	$dup2 = $wpdb->get_var( $wpdb->prepare( "SELECT count(*)  from tbl_gallery_main WHERE category_id=".$_POST["txtCategory"]." and subcategory_id=".$_POST['subcat']." and  gallery_seotitle = %s AND   ".$primary_key." <> %s ", trim($_POST["seo_title"]), $_POST[$primary_key]  ) ); 

	//if (trim($_FILES['before_image_1']['name']) != '' || trim($_FILES['after_image_1']['name']) != '')
	//{
		$i=1;
		//code start for  image Upload
		if (trim($_FILES['before_image_'.$i]['name']) != '' && trim($_FILES['after_image_'.$i]['name']) != ''  ){//image uploading

		
		
//Unlink Old Images
			$gallerymainid = $_POST[$primary_key];
			$selectoldGallery=$wpdb->get_results($wpdb->prepare("select * from tbl_gallery_main where gallery_main_id=$gallerymainid",''));
			if(count($selectGallery)>0)
			{
				$old_before_image =$selectGallery->before_image;
				$old_after_image =$selectGallery->after_image;
				$old_merge_image =$selectGallery->merged_image; 

				if ($old_before_image!='' && file_exists(UPLOAD_PATH.$folder_name.'/before/'.$old_before_image))
				{
					@unlink(UPLOAD_PATH.$folder_name.'/before/'.$old_before_image);
					@unlink(UPLOAD_PATH.$folder_name.'/before_thumb/'.$old_before_image);
					@unlink(UPLOAD_PATH.$folder_name.'/before_medium/'.$old_before_image);
					@unlink(UPLOAD_PATH.$folder_name.'/before_popup/'.$old_before_image);
					@unlink(UPLOAD_PATH.$folder_name.'/before_patient/'.$old_before_image);
				}
				if ($old_after_image!='' && file_exists(UPLOAD_PATH.$folder_name.'/before/'.$old_after_image))
				{
					@unlink(UPLOAD_PATH.$folder_name.'/after/'.$old_after_image);
					@unlink(UPLOAD_PATH.$folder_name.'/after_thumb/'.$old_after_image);
					@unlink(UPLOAD_PATH.$folder_name.'/after_medium/'.$old_after_image);
					@unlink(UPLOAD_PATH.$folder_name.'/after_popup/'.$old_after_image);
					@unlink(UPLOAD_PATH.$folder_name.'/after_patient/'.$old_after_image);

				}
				if ($old_merge_image!='' && file_exists(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/large/merged/'.$old_merge_image))
				{
					@unlink(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/large/merged/'.$old_merge_image);
					@unlink(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/medium/merged/'.$old_merge_image);			
					@unlink(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/thumb/merged/'.$old_merge_image);
					@unlink(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/popup/merged/'.$old_merge_image);
				}  
			}


			
		
			$before_image 			= new Image($_FILES['before_image_'.$i]['tmp_name']);
			$after_image 			= new Image($_FILES['after_image_'.$i]['tmp_name']); 

			$before_thumb_image 	= new Image($_FILES['before_image_'.$i]['tmp_name']); 
			$after_thumb_image 		= new Image($_FILES['after_image_'.$i]['tmp_name']); 

			$before_sthumb_image 	= new Image($_FILES['before_image_'.$i]['tmp_name']); 
			$after_sthumb_image 	= new Image($_FILES['after_image_'.$i]['tmp_name']); 

			$before_popup_image 	= new Image($_FILES['before_image_'.$i]['tmp_name']);
			$after_popup_image 		= new Image($_FILES['after_image_'.$i]['tmp_name']); 

			$before_patient_image 	= new Image($_FILES['before_image_'.$i]['tmp_name']);
			$after_patient_image 	= new Image($_FILES['after_image_'.$i]['tmp_name']); 

			$valid_image_types = array('image/png','image/jpeg','image/gif');

			if (!in_array($_FILES['before_image_'.$i]['type'],$valid_image_types) || $_FILES['before_image_'.$i]['size']<=0){
				$alert = 'Uploaded image is corrupted or the image type is not allowed or Image size Exceeds the Limit';
				include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
				exit();
			}

			if (!in_array($_FILES['after_image_'.$i]['type'],$valid_image_types) || $_FILES['after_image_'.$i]['size']<=0){
				$alert = 'Uploaded image is corrupted or the image type is not allowed or Image size Exceeds the Limit';
				include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
				exit();
			}
			list($bwidth, $bheight, $btype, $battr)= getimagesize($_FILES['before_image_'.$i]['tmp_name']);
			list($awidth, $aheight, $atype, $aattr)= getimagesize($_FILES['after_image_'.$i]['tmp_name']);

	
			

			$beforeImage_name = rand().time().$_FILES['before_image_'.$i]['name']; 
			$afterImage_name = rand().time().$_FILES['after_image_'.$i]['name']; 

			//-------------------------------
			$source_path_before =$_FILES['before_image_'.$i]['tmp_name']; 
			$source_path_after =$_FILES['after_image_'.$i]['tmp_name']; 
			//-----------------------------patient

			$dest_before_large=UPLOAD_PATH.$folder_name.'/before/'.$beforeImage_name;
			$before_image->whitespace(420, 285, array('color' => '#FFFFFF')); // With Color
			$before_image->output(UPLOAD_PATH.$folder_name.'/before/'.$beforeImage_name); 

			$dest_before_medium=UPLOAD_PATH.$folder_name.'/before_medium/'.$beforeImage_name;
			$before_sthumb_image->whitespace(188, 105, array('color' => '#FFFFFF')); // With Color
			$before_sthumb_image->output(UPLOAD_PATH.$folder_name.'/before_medium/'.$beforeImage_name );

			$dest_before_thumb=UPLOAD_PATH.$folder_name.'/before_thumb/'.$beforeImage_name;    
			$before_thumb_image->whitespace(178, 200, array('color' => '#FFFFFF')); // With Color
			$before_thumb_image->output(UPLOAD_PATH.$folder_name.'/before_thumb/'.$beforeImage_name );						

			$dest_before_popup=UPLOAD_PATH.$folder_name.'/before_popup/'.$beforeImage_name;    
			$before_popup_image->whitespace(267, 299, array('color' => '#FFFFFF')); // With Color
			$before_popup_image->output(UPLOAD_PATH.$folder_name.'/before_popup/'.$beforeImage_name );						

			$dest_before_patient=UPLOAD_PATH.$folder_name.'/before_patient/'.$beforeImage_name;    
			$before_patient_image->whitespace(640, 440, array('color' => '#FFFFFF')); // With Color
			$before_patient_image->output(UPLOAD_PATH.$folder_name.'/before_patient/'.$beforeImage_name );						

			
			$dest_after_large=UPLOAD_PATH.$folder_name.'/after/'.$afterImage_name;
			$after_image->whitespace(420, 285, array('color' => '#FFFFFF')); // With Color
			$after_image->output(UPLOAD_PATH.$folder_name.'/after/'.$afterImage_name); 

			$dest_after_medium=UPLOAD_PATH.$folder_name.'/after_medium/'.$afterImage_name;
			$after_thumb_image->whitespace(188, 105, array('color' => '#FFFFFF')); // With Color
			$after_thumb_image->output(UPLOAD_PATH.$folder_name.'/after_medium/'.$afterImage_name); 

			$dest_after_thumb=UPLOAD_PATH.$folder_name.'/after_thumb/'.$afterImage_name;
			$after_sthumb_image->whitespace(178, 200, array('color' => '#FFFFFF')); // With Color
			$after_sthumb_image->output(UPLOAD_PATH.$folder_name.'/after_thumb/'.$afterImage_name); 

			$dest_after_popup=UPLOAD_PATH.$folder_name.'/after_popup/'.$afterImage_name;
			$after_popup_image->whitespace(267, 299, array('color' => '#FFFFFF')); // With Color
			$after_popup_image->output(UPLOAD_PATH.$folder_name.'/after_popup/'.$afterImage_name); 

			$dest_after_patient=UPLOAD_PATH.$folder_name.'/after_patient/'.$afterImage_name;
			$after_patient_image->whitespace(640, 440, array('color' => '#FFFFFF')); // With Color
			$after_patient_image->output(UPLOAD_PATH.$folder_name.'/after_patient/'.$afterImage_name); 


			$ImgObj=new ImageClass();                                                               

			$ImgObj->mergeImages(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/large/merged/MERGED'.$i."_",$dest_before_large,$dest_after_large);
			$merge2Temp =$ImgObj->merge_path;
			$merge2Temp=str_replace(ABSPATH.'wp-content/uploads/gallery/BEFORE_AFTER_GALLERY/large/merged/',"",$merge2Temp);

			$ImgObj->mergeImages(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/thumb/merged/MERGED'.$i."_",$dest_before_thumb,$dest_after_thumb);
			$merge3Temp =$ImgObj->merge_path;
			$merge3Temp=str_replace(ABSPATH.'wp-content/uploads/gallery/BEFORE_AFTER_GALLERY/thumb/merged/',"",$merge3Temp);

			$ImgObj->mergeImages(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/medium/merged/MERGED'.$i."_",$dest_before_medium,$dest_after_medium);
			$merge4Temp =$ImgObj->merge_path;
			$merge4Temp=str_replace(ABSPATH.'wp-content/uploads/gallery/BEFORE_AFTER_GALLERY/medium/merged/',"",$merge4Temp);


			$ImgObj->mergeImages(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/popup/merged/MERGED'.$i."_",$dest_before_popup,$dest_after_popup);
			$merge5Temp =$ImgObj->merge_path;
			$merge5Temp=str_replace(ABSPATH.'wp-content/uploads/gallery/BEFORE_AFTER_GALLERY/popup/merged/',"",$merge5Temp);

		}
		else if (trim($_FILES['before_image_'.$i]['name']) == '' && trim($_FILES['after_image_'.$i]['name']) != ''  ){//Before Image empty After Image !='';


			//Unlink Old Images
			$gallerymainid = $_POST[$primary_key];
			$selectoldGallery=$wpdb->get_results($wpdb->prepare("select * from tbl_gallery_main where gallery_main_id=$gallerymainid",''));
			if(count($selectGallery)>0)
			{				
				$old_after_image =$selectGallery->after_image;
				$old_merge_image =$selectGallery->merged_image; 

				if ($old_after_image!='' && file_exists(UPLOAD_PATH.$folder_name.'/before/'.$old_after_image))
				{
					@unlink(UPLOAD_PATH.$folder_name.'/after/'.$old_after_image);
					@unlink(UPLOAD_PATH.$folder_name.'/after_thumb/'.$old_after_image);
					@unlink(UPLOAD_PATH.$folder_name.'/after_medium/'.$old_after_image);
					@unlink(UPLOAD_PATH.$folder_name.'/after_popup/'.$old_after_image);
					@unlink(UPLOAD_PATH.$folder_name.'/after_patient/'.$old_after_image);

				}
				if ($old_merge_image!='' && file_exists(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/large/merged/'.$old_merge_image))
				{
					@unlink(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/large/merged/'.$old_merge_image);
					@unlink(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/medium/merged/'.$old_merge_image);			
					@unlink(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/thumb/merged/'.$old_merge_image);
					@unlink(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/popup/merged/'.$old_merge_image);
				}  
			}


			//image uploading
			$after_image 			= new Image($_FILES['after_image_'.$i]['tmp_name']); 
			$after_thumb_image 		= new Image($_FILES['after_image_'.$i]['tmp_name']); 
			$after_sthumb_image 	= new Image($_FILES['after_image_'.$i]['tmp_name']); 
			$after_popup_image 		= new Image($_FILES['after_image_'.$i]['tmp_name']); 
			$after_patient_image 	= new Image($_FILES['after_image_'.$i]['tmp_name']); 

			$valid_image_types = array('image/png','image/jpeg','image/gif');

			if (!in_array($_FILES['after_image_'.$i]['type'],$valid_image_types) || $_FILES['after_image_'.$i]['size']<=0){
				$alert = 'Uploaded image is corrupted or the image type is not allowed or Image size Exceeds the Limit';
				include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
				exit();
			}
			list($awidth, $aheight, $atype, $aattr)= getimagesize($_FILES['after_image_'.$i]['tmp_name']);
			
			
			$beforeImage_name = $_REQUEST['hidbefore_image'];///Old image Name
			$afterImage_name = rand().time().$_FILES['after_image_'.$i]['name']; 

			$dest_before_large=UPLOAD_PATH.$folder_name.'/before/'.$beforeImage_name;
			$dest_before_medium=UPLOAD_PATH.$folder_name.'/before_medium/'.$beforeImage_name;
			$dest_before_thumb=UPLOAD_PATH.$folder_name.'/before_thumb/'.$beforeImage_name;    
			$dest_before_popup=UPLOAD_PATH.$folder_name.'/before_popup/'.$beforeImage_name;    
			$dest_before_patient=UPLOAD_PATH.$folder_name.'/before_patient/'.$beforeImage_name;    
			
			$dest_after_large=UPLOAD_PATH.$folder_name.'/after/'.$afterImage_name;
			$after_image->whitespace(420, 285, array('color' => '#FFFFFF')); // With Color
			$after_image->output(UPLOAD_PATH.$folder_name.'/after/'.$afterImage_name); 

			$dest_after_medium=UPLOAD_PATH.$folder_name.'/after_medium/'.$afterImage_name;
			$after_thumb_image->whitespace(188, 105, array('color' => '#FFFFFF')); // With Color
			$after_thumb_image->output(UPLOAD_PATH.$folder_name.'/after_medium/'.$afterImage_name); 

			$dest_after_thumb=UPLOAD_PATH.$folder_name.'/after_thumb/'.$afterImage_name;
			$after_sthumb_image->whitespace(178, 200, array('color' => '#FFFFFF')); // With Color
			$after_sthumb_image->output(UPLOAD_PATH.$folder_name.'/after_thumb/'.$afterImage_name); 

			$dest_after_popup=UPLOAD_PATH.$folder_name.'/after_popup/'.$afterImage_name;
			$after_popup_image->whitespace(267, 299, array('color' => '#FFFFFF')); // With Color
			$after_popup_image->output(UPLOAD_PATH.$folder_name.'/after_popup/'.$afterImage_name); 

			$dest_after_patient=UPLOAD_PATH.$folder_name.'/after_patient/'.$afterImage_name;
			$after_patient_image->whitespace(640, 440, array('color' => '#FFFFFF')); // With Color
			$after_patient_image->output(UPLOAD_PATH.$folder_name.'/after_patient/'.$afterImage_name); 


			$ImgObj=new ImageClass();                                                               


			$ImgObj->mergeImages(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/large/merged/MERGED'.$i."_",$dest_before_large,$dest_after_large);
			$merge2Temp =$ImgObj->merge_path;
			$merge2Temp=str_replace(ABSPATH.'wp-content/uploads/gallery/BEFORE_AFTER_GALLERY/large/merged/',"",$merge2Temp);

			$ImgObj->mergeImages(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/thumb/merged/MERGED'.$i."_",$dest_before_thumb,$dest_after_thumb);
			$merge3Temp =$ImgObj->merge_path;
			$merge3Temp=str_replace(ABSPATH.'wp-content/uploads/gallery/BEFORE_AFTER_GALLERY/thumb/merged/',"",$merge3Temp);

			$ImgObj->mergeImages(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/medium/merged/MERGED'.$i."_",$dest_before_medium,$dest_after_medium);
			$merge4Temp =$ImgObj->merge_path;
			$merge4Temp=str_replace(ABSPATH.'wp-content/uploads/gallery/BEFORE_AFTER_GALLERY/medium/merged/',"",$merge4Temp);


			$ImgObj->mergeImages(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/popup/merged/MERGED'.$i."_",$dest_before_popup,$dest_after_popup);
			$merge5Temp =$ImgObj->merge_path;
			$merge5Temp=str_replace(ABSPATH.'wp-content/uploads/gallery/BEFORE_AFTER_GALLERY/popup/merged/',"",$merge5Temp);

		}
		else if (trim($_FILES['before_image_'.$i]['name']) != '' && trim($_FILES['after_image_'.$i]['name']) == ''  ){//After Image empty Before Image !='';
		
		
		
			//Unlink Old Images
			$gallerymainid = $_POST[$primary_key];
			$selectoldGallery=$wpdb->get_results($wpdb->prepare("select * from tbl_gallery_main where gallery_main_id=$gallerymainid",''));
			if(count($selectGallery)>0)
			{
				$old_before_image =$selectGallery->before_image;
				$old_merge_image =$selectGallery->merged_image; 

				if ($old_before_image!='' && file_exists(UPLOAD_PATH.$folder_name.'/before/'.$old_before_image))
				{
					@unlink(UPLOAD_PATH.$folder_name.'/before/'.$old_before_image);
					@unlink(UPLOAD_PATH.$folder_name.'/before_thumb/'.$old_before_image);
					@unlink(UPLOAD_PATH.$folder_name.'/before_medium/'.$old_before_image);
					@unlink(UPLOAD_PATH.$folder_name.'/before_popup/'.$old_before_image);
					@unlink(UPLOAD_PATH.$folder_name.'/before_patient/'.$old_before_image);
				}
				if ($old_merge_image!='' && file_exists(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/large/merged/'.$old_merge_image))
				{
					@unlink(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/large/merged/'.$old_merge_image);
					@unlink(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/medium/merged/'.$old_merge_image);			
					@unlink(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/thumb/merged/'.$old_merge_image);
					@unlink(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/popup/merged/'.$old_merge_image);
				}  
			}
		
		//image uploading

			$before_image 			= new Image($_FILES['before_image_'.$i]['tmp_name']);
			$before_thumb_image 	= new Image($_FILES['before_image_'.$i]['tmp_name']); 
			$before_sthumb_image 	= new Image($_FILES['before_image_'.$i]['tmp_name']); 
			$before_popup_image 	= new Image($_FILES['before_image_'.$i]['tmp_name']);
			$before_patient_image 	= new Image($_FILES['before_image_'.$i]['tmp_name']);

			$valid_image_types = array('image/png','image/jpeg','image/gif');

			if (!in_array($_FILES['before_image_'.$i]['type'],$valid_image_types) || $_FILES['before_image_'.$i]['size']<=0){
				$alert = 'Uploaded image is corrupted or the image type is not allowed or Image size Exceeds the Limit';
				include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
				exit();
			}
			list($bwidth, $bheight, $btype, $battr)= getimagesize($_FILES['before_image_'.$i]['tmp_name']);

			$beforeImage_name = rand().time().$_FILES['before_image_'.$i]['name']; 
			$afterImage_name = $_REQUEST['hidafter_image']; 

			//-------------------------------
			$source_path_before =$_FILES['before_image_'.$i]['tmp_name']; 
			$source_path_after =$_FILES['after_image_'.$i]['tmp_name']; 
			//-----------------------------patient

			$dest_before_large=UPLOAD_PATH.$folder_name.'/before/'.$beforeImage_name;
			$before_image->whitespace(420, 285, array('color' => '#FFFFFF')); // With Color
			$before_image->output(UPLOAD_PATH.$folder_name.'/before/'.$beforeImage_name); 

			$dest_before_medium=UPLOAD_PATH.$folder_name.'/before_medium/'.$beforeImage_name;
			$before_sthumb_image->whitespace(188, 105, array('color' => '#FFFFFF')); // With Color
			$before_sthumb_image->output(UPLOAD_PATH.$folder_name.'/before_medium/'.$beforeImage_name );

			$dest_before_thumb=UPLOAD_PATH.$folder_name.'/before_thumb/'.$beforeImage_name;    
			$before_thumb_image->whitespace(178, 200, array('color' => '#FFFFFF')); // With Color
			$before_thumb_image->output(UPLOAD_PATH.$folder_name.'/before_thumb/'.$beforeImage_name );						

			$dest_before_popup=UPLOAD_PATH.$folder_name.'/before_popup/'.$beforeImage_name;    
			$before_popup_image->whitespace(267, 299, array('color' => '#FFFFFF')); // With Color
			$before_popup_image->output(UPLOAD_PATH.$folder_name.'/before_popup/'.$beforeImage_name );						

			$dest_before_patient=UPLOAD_PATH.$folder_name.'/before_patient/'.$beforeImage_name;    
			$before_patient_image->whitespace(640, 440, array('color' => '#FFFFFF')); // With Color
			$before_patient_image->output(UPLOAD_PATH.$folder_name.'/before_patient/'.$beforeImage_name );						

			
			$dest_after_large=UPLOAD_PATH.$folder_name.'/after/'.$afterImage_name;
			$dest_after_medium=UPLOAD_PATH.$folder_name.'/after_medium/'.$afterImage_name;
			$dest_after_thumb=UPLOAD_PATH.$folder_name.'/after_thumb/'.$afterImage_name;
			$dest_after_popup=UPLOAD_PATH.$folder_name.'/after_popup/'.$afterImage_name;
			$dest_after_patient=UPLOAD_PATH.$folder_name.'/after_patient/'.$afterImage_name;

			$ImgObj=new ImageClass();                                                               

			$ImgObj->mergeImages(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/large/merged/MERGED'.$i."_",$dest_before_large,$dest_after_large);
			$merge2Temp =$ImgObj->merge_path;
			$merge2Temp=str_replace(ABSPATH.'wp-content/uploads/gallery/BEFORE_AFTER_GALLERY/large/merged/',"",$merge2Temp);

			$ImgObj->mergeImages(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/thumb/merged/MERGED'.$i."_",$dest_before_thumb,$dest_after_thumb);
			$merge3Temp =$ImgObj->merge_path;
			$merge3Temp=str_replace(ABSPATH.'wp-content/uploads/gallery/BEFORE_AFTER_GALLERY/thumb/merged/',"",$merge3Temp);

			$ImgObj->mergeImages(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/medium/merged/MERGED'.$i."_",$dest_before_medium,$dest_after_medium);
			$merge4Temp =$ImgObj->merge_path;
			$merge4Temp=str_replace(ABSPATH.'wp-content/uploads/gallery/BEFORE_AFTER_GALLERY/medium/merged/',"",$merge4Temp);


			$ImgObj->mergeImages(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/popup/merged/MERGED'.$i."_",$dest_before_popup,$dest_after_popup);
			$merge5Temp =$ImgObj->merge_path;
			$merge5Temp=str_replace(ABSPATH.'wp-content/uploads/gallery/BEFORE_AFTER_GALLERY/popup/merged/',"",$merge5Temp);

		}
		else{
			$afterImage_name  = $_REQUEST['hidafter_image'];
			$beforeImage_name = $_REQUEST['hidbefore_image'];
			$merge2Temp 	  = $_REQUEST['merged_image'];
			$merge3Temp       = $_REQUEST['merged_thumb'];
			
		}

		if($_POST['status']=='Y')
		{
			$status="Y";
		}else
		{
			$status="N";
		}
		if($_POST['ishome']=='Y')
		{
			$ishome="Y";
		}else
		{
			$ishome="N";
		}

		$data = array(
		'category_id'   		=> $_POST['txtCategory'],
		'subcategory_id'   		=> $_POST['subcat'],
		'title'   				=> $_POST['txtMainTitle'],
		'gallery_seotitle'   	=> generate_seo_link($_POST['seo_title']),
		'meta_title'			=> $_POST['meta_title'],
		'meta_description'		=> $_POST['bdescription_1'],
		'meta_keywords'			=> $_POST['meta_keywords'],
		'description' 			=> $_POST['description_1'],	
		'status' 				=> $status,
		'ishome'				=> $_POST['ishome_1'],
		'before_imagetitle' 	=> $_POST['txtBeforeImageTitle_1'],
		'before_imagealt'       => $_POST['txtBeforeImageAlt_1'],
		'before_image' 			=> $beforeImage_name,
		'before_image_thumb' 	=> $beforeImage_name,
		'after_imagetitle' 		=> $_POST['txtAfterImageTitle_1'],
		'after_imagealt'        => $_POST['txtAfterImageAlt_1'],
		'after_image' 			=> $afterImage_name,
		'after_image_thumb' 	=> $afterImage_name,
		'merged_image'			=> $merge2Temp,	
		'merged_thumb'			=> $merge3Temp							
		);

		$data_format = array('%d','%d','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s');
		$where = array(	$primary_key => $_POST[$primary_key]);

		$wpdb->update('tbl_gallery_main', $data, $where, $data_format, '%d' );

	
	if($gallery_count!=1)
	{
		for($i=1;$i<=$gallery_count;$i++)
		{
			if($i!=1)
			{
				if($_REQUEST['txtBeforeImageTitle_'.$i]!="")
				{
					//code start for  image Upload
					if (trim($_FILES['before_image_'.$i]['name']) != '' && trim($_FILES['after_image_'.$i]['name']) != ''  ){//image uploading
						$before_image 			= new Image($_FILES['before_image_'.$i]['tmp_name']);
						$after_image 			= new Image($_FILES['after_image_'.$i]['tmp_name']); 

						$before_thumb_image 	= new Image($_FILES['before_image_'.$i]['tmp_name']); 
						$after_thumb_image 		= new Image($_FILES['after_image_'.$i]['tmp_name']); 

						$before_sthumb_image 	= new Image($_FILES['before_image_'.$i]['tmp_name']); 
						$after_sthumb_image 	= new Image($_FILES['after_image_'.$i]['tmp_name']); 

						$before_popup_image 	= new Image($_FILES['before_image_'.$i]['tmp_name']);
						$after_popup_image 		= new Image($_FILES['after_image_'.$i]['tmp_name']); 

						$before_patient_image 	= new Image($_FILES['before_image_'.$i]['tmp_name']);
						$after_patient_image 		= new Image($_FILES['after_image_'.$i]['tmp_name']); 

						$valid_image_types = array('image/png','image/jpeg','image/gif');

						if (!in_array($_FILES['before_image_'.$i]['type'],$valid_image_types) || $_FILES['before_image_'.$i]['size']<=0){
							$alert = 'Uploaded image is corrupted or the image type is not allowed or Image size Exceeds the Limit';
							include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
							exit();
						}

						if (!in_array($_FILES['after_image_'.$i]['type'],$valid_image_types) || $_FILES['after_image_'.$i]['size']<=0){
							$alert = 'Uploaded image is corrupted or the image type is not allowed or Image size Exceeds the Limit';
							include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
							exit();
						}
						list($bwidth, $bheight, $btype, $battr)= getimagesize($_FILES['before_image_'.$i]['tmp_name']);
						list($awidth, $aheight, $atype, $aattr)= getimagesize($_FILES['after_image_'.$i]['tmp_name']);

						$beforeImage_name = rand().time().$_FILES['before_image_'.$i]['name']; 
						$afterImage_name = rand().time().$_FILES['after_image_'.$i]['name']; 

						//-------------------------------
						$source_path_before =$_FILES['before_image_'.$i]['tmp_name']; 
						$source_path_after =$_FILES['after_image_'.$i]['tmp_name']; 
						//-----------------------------patient

						$dest_before_large=UPLOAD_PATH.$folder_name.'/before/'.$beforeImage_name;
						$before_image->whitespace(420, 285, array('color' => '#FFFFFF')); // With Color
						$before_image->output(UPLOAD_PATH.$folder_name.'/before/'.$beforeImage_name); 

						$dest_before_medium=UPLOAD_PATH.$folder_name.'/before_medium/'.$beforeImage_name;
						$before_sthumb_image->whitespace(188, 105, array('color' => '#FFFFFF')); // With Color
						$before_sthumb_image->output(UPLOAD_PATH.$folder_name.'/before_medium/'.$beforeImage_name );

						$dest_before_thumb=UPLOAD_PATH.$folder_name.'/before_thumb/'.$beforeImage_name;    
						$before_thumb_image->whitespace(178, 200, array('color' => '#FFFFFF')); // With Color
						$before_thumb_image->output(UPLOAD_PATH.$folder_name.'/before_thumb/'.$beforeImage_name );						
						$dest_before_popup=UPLOAD_PATH.$folder_name.'/before_popup/'.$beforeImage_name;    
						$before_popup_image->whitespace(267, 299, array('color' => '#FFFFFF')); // With Color
						$before_popup_image->output(UPLOAD_PATH.$folder_name.'/before_popup/'.$beforeImage_name );						
						$dest_before_patient=UPLOAD_PATH.$folder_name.'/before_patient/'.$beforeImage_name;    
						$before_patient_image->whitespace(640, 440, array('color' => '#FFFFFF')); // With Color
						$before_patient_image->output(UPLOAD_PATH.$folder_name.'/before_patient/'.$beforeImage_name );
						
						

						$dest_after_large=UPLOAD_PATH.$folder_name.'/after/'.$afterImage_name;
						$after_image->whitespace(420, 285, array('color' => '#FFFFFF')); // With Color
						$after_image->output(UPLOAD_PATH.$folder_name.'/after/'.$afterImage_name); 

						$dest_after_medium=UPLOAD_PATH.$folder_name.'/after_medium/'.$afterImage_name;
						$after_thumb_image->whitespace(188, 105, array('color' => '#FFFFFF')); // With Color
						$after_thumb_image->output(UPLOAD_PATH.$folder_name.'/after_medium/'.$afterImage_name); 

						$dest_after_thumb=UPLOAD_PATH.$folder_name.'/after_thumb/'.$afterImage_name;
						$after_sthumb_image->whitespace(178, 200, array('color' => '#FFFFFF')); // With Color
						$after_sthumb_image->output(UPLOAD_PATH.$folder_name.'/after_thumb/'.$afterImage_name); 

						$dest_after_popup=UPLOAD_PATH.$folder_name.'/after_popup/'.$afterImage_name;
						$after_popup_image->whitespace(267, 299, array('color' => '#FFFFFF')); // With Color
						$after_popup_image->output(UPLOAD_PATH.$folder_name.'/after_popup/'.$afterImage_name); 

						$dest_after_patient=UPLOAD_PATH.$folder_name.'/after_patient/'.$afterImage_name;
						$after_patient_image->whitespace(640, 440, array('color' => '#FFFFFF')); // With Color
						$after_patient_image->output(UPLOAD_PATH.$folder_name.'/after_patient/'.$afterImage_name); 


						$ImgObj=new ImageClass();                                                               


						$ImgObj->mergeImages(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/large/merged/MERGED'.$i."_",$dest_before_large,$dest_after_large);
						$merge2Temp =$ImgObj->merge_path;
						$merge2Temp=str_replace(ABSPATH.'wp-content/uploads/gallery/BEFORE_AFTER_GALLERY/large/merged/',"",$merge2Temp);

						$ImgObj->mergeImages(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/thumb/merged/MERGED'.$i."_",$dest_before_thumb,$dest_after_thumb);
						$merge3Temp =$ImgObj->merge_path;
						$merge3Temp=str_replace(ABSPATH.'wp-content/uploads/gallery/BEFORE_AFTER_GALLERY/thumb/merged/',"",$merge3Temp);

						$ImgObj->mergeImages(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/medium/merged/MERGED'.$i."_",$dest_before_medium,$dest_after_medium);
						$merge4Temp =$ImgObj->merge_path;
						$merge4Temp=str_replace(ABSPATH.'wp-content/uploads/gallery/BEFORE_AFTER_GALLERY/medium/merged/',"",$merge4Temp);


						$ImgObj->mergeImages(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/popup/merged/MERGED'.$i."_",$dest_before_popup,$dest_after_popup);
						$merge5Temp =$ImgObj->merge_path;
						$merge5Temp=str_replace(ABSPATH.'wp-content/uploads/gallery/BEFORE_AFTER_GALLERY/popup/merged/',"",$merge5Temp);

					}	

					//code start for  image Upload
					$updateGallerySql="update tbl_gallery_main SET ordering=(ordering + 1) where category_id=".$_POST['txtCategory']." and subcategory_id=".$_POST['subcat'];
					$updateGallerySqlConnect=mysql_query($updateGallerySql);


					if($_POST['status']=='Y')
					{
						$status="Y";
					}
					else
					{
						$status="N";
					}
					if($_POST['ishome']=='Y')
					{
						$ishome="Y";
					}
					else
					{
						$ishome="N";
					}

					$data = array(
					'category_id'   		=> $_POST['txtCategory'],
					'subcategory_id'   		=> $_POST['subcat'],
					'title'   				=> $_POST['txtMainTitle'],
					'gallery_seotitle'   	=> generate_seo_link($_POST['seo_title']),
					'meta_title'			=> $_POST['meta_title'],
					'meta_description'		=> $_POST['bdescription_'.$i],
					'meta_keywords'			=> $_POST['meta_keywords'],
					'description' 			=> $_POST['description_'.$i],			
					'status' 				=> $status,
					'ishome' 				=> $_POST['ishome_'.$i],
					'ordering'				=> 1,
					'before_imagetitle' 	=> $_POST['txtBeforeImageTitle_'.$i],
					'before_imagealt'       => $_POST['txtBeforeImageAlt_'.$i],
					'before_image' 			=> $beforeImage_name,
					'before_image_thumb' 	=> $beforeImage_name,
					'after_imagetitle' 		=> $_POST['txtAfterImageTitle_'.$i],
					'after_imagealt'        => $_POST['txtAfterImageAlt_'.$i],
					'after_image' 			=> $afterImage_name,
					'after_image_thumb' 	=> $afterImage_name,
					'merged_image'			=> $merge2Temp,	
					'merged_thumb'			=> $merge3Temp                                                    
					);


					$wpdb->insert( 'tbl_gallery_main', $data, array('%d','%d','%s','%s','%s','%s','%s','%s','%s','%s','%d','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s') );

				}

			}

		}
	}
	//$wpdb->print_error(); exit;
	wp_redirect("admin.php?page=".$page_name."&upd=1&category=".$_POST['txtCategory']);  

	break;


	case 'delete':

		if ($_POST["deleterec"]!='') {
			//delete the image
			$id_arr = explode(',',$_POST["deleterec"]); 
			$del_arr = array();
			$del = 1;
			foreach ($id_arr as $key => $val){
			$items_found = $wpdb->get_var( $wpdb->prepare( "select count(*) from tbl_gallery_main where gallery_main_id = %d", $val));
			if ($items_found>0) {
				array_push($del_arr,$val); 
				$selectGallery=$wpdb->get_results($wpdb->prepare("select * from tbl_gallery_main where gallery_main_id=$val",''));
			
				if(count($selectGallery)>0)
				{
					for($j=0;$j<count($selectGallery);$j++)
					{
						$old_before_image =$selectGallery[$j]->before_image;
						$old_after_image =$selectGallery[$j]->after_image;
						$old_merge_image =$selectGallery[$j]->merged_image; 

						if ($old_before_image!='' && file_exists(UPLOAD_PATH.$folder_name.'/before/'.$old_before_image))
						{
							@unlink(UPLOAD_PATH.$folder_name.'/before/'.$old_before_image);
							@unlink(UPLOAD_PATH.$folder_name.'/after/'.$old_after_image);

							@unlink(UPLOAD_PATH.$folder_name.'/before_thumb/'.$old_before_image);
							@unlink(UPLOAD_PATH.$folder_name.'/after_thumb/'.$old_after_image);

							@unlink(UPLOAD_PATH.$folder_name.'/before_medium/'.$old_before_image);
							@unlink(UPLOAD_PATH.$folder_name.'/after_medium/'.$old_after_image);

							@unlink(UPLOAD_PATH.$folder_name.'/before_popup/'.$old_before_image);
							@unlink(UPLOAD_PATH.$folder_name.'/after_popup/'.$old_after_image);

							@unlink(UPLOAD_PATH.$folder_name.'/before_patient/'.$old_before_image);
							@unlink(UPLOAD_PATH.$folder_name.'/after_patient/'.$old_after_image);

						}
						if ($old_merge_image!='' && file_exists(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/large/merged/'.$old_merge_image))
						{

							@unlink(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/large/merged/'.$old_merge_image);

							@unlink(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/medium/merged/'.$old_merge_image);			

							@unlink(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/thumb/merged/'.$old_merge_image);

							@unlink(UPLOAD_PATH.$folder_name.'/BEFORE_AFTER_GALLERY/popup/merged/'.$old_merge_image);

						}                                                
						$deleteGallery="delete from tbl_gallery_main where gallery_main_id=".$selectGallery[$j]->gallery_main_id;
						$deleteGalleryConnect=mysql_query($deleteGallery);
					}
				}
			}
			if (count($del_arr)>0){
			//print_r($del_arr); exit;
				$del_str = implode(',',$del_arr);
				$delete_sql = $wpdb->prepare( "DELETE from tbl_gallery_main where `gallery_main_id`  in (".$del_str.")");
				$wpdb->query( $delete_sql );
			}

			}

		}

	wp_redirect("admin.php?page=".$page_name."&del=$del");
	break;

	case 'ordering':
		$_POST["orderval"];
		//echo "$test".$test;
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
					if($_REQUEST['category']=="")$catId=$_REQUEST['fistcatId'];
					else $catId=$_REQUEST['category'];

					if($_REQUEST['subcategory_id']=="")$subcatId=$_REQUEST['fistsubcatId'];
					else $subcatId=$_REQUEST['subcategory_id'];

					$where = array(
					$primary_key => $arr_order[$i],'category_id'=>$catId
					);
					$wpdb->update( 'tbl_gallery_main', $data, $where, '%d', '%d' );
					$cnt++;
				}
			}
		}
		if($_REQUEST['ipp'])
		{
			$curPage=$_REQUEST['pval'];
			$totPage=$_REQUEST['ipp'];
			wp_redirect("admin.php?page=".$page_name."&ord=1&&pval=".$curPage."&ipp=".$totPage);
		}
		else
		{
			wp_redirect("admin.php?page=".$page_name."&ord=1&category=".$catId);
		}
	break;
} // end of switch case
?>
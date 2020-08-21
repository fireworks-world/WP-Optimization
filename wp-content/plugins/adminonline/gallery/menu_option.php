<?php

function gallery(){
	global $curr_page, $hidAction,$hidAction1,$option, $wpdb;
	
	define('TBL','tbl_gallery_main');
	$entity = 'Gallery';
	$page_name = 'gallery';
	$folder_name = 'gallery';
	$primary_key = 'gallery_main_id';
	$primary_key_edit = 'gallery_main_id';





	$table_main_name = $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE 'tbl_gallery_main'","" ) );
	if ($table_main_name==''){
		$sqlmain = "
CREATE TABLE IF NOT EXISTS `tbl_gallery_main` (
  `gallery_main_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `gallery_seotitle` varchar(250) NOT NULL,
  `meta_title` varchar(250) NOT NULL,
  `meta_description` varchar(250) NOT NULL,
  `meta_keywords` varchar(250) NOT NULL,
  `description` longtext NOT NULL,
  `ordering` int(11) NOT NULL,
  `status` enum('Y','N') NOT NULL,
  PRIMARY KEY (`gallery_main_id`)
  ) 
			";
		$wpdb->query($sqlmain);
	}
	
	//rmdir(UPLOAD_PATH.'gallerycategory');
	
/*	if ( ! is_dir(UPLOAD_PATH) ) {
		@mkdir(UPLOAD_PATH,0777);
	}
	//rmdir(UPLOAD_PATH.$folder_name);
	if ( ! is_dir(UPLOAD_PATH.$folder_name) ) {
		@mkdir(UPLOAD_PATH.$folder_name,0777);

		@mkdir(UPLOAD_PATH.$folder_name.'/after',0777);
		@mkdir(UPLOAD_PATH.$folder_name.'/after_medium',0777);
		@mkdir(UPLOAD_PATH.$folder_name.'/after_popup',0777);
		@mkdir(UPLOAD_PATH.$folder_name.'/after_sthumb',0777);
		@mkdir(UPLOAD_PATH.$folder_name.'/after_thumb',0777);
		
		@mkdir(UPLOAD_PATH.$folder_name.'/before',0777);
		@mkdir(UPLOAD_PATH.$folder_name.'/before_medium',0777);
		@mkdir(UPLOAD_PATH.$folder_name.'/before_popup',0777);
		@mkdir(UPLOAD_PATH.$folder_name.'/before_sthumb',0777);
		@mkdir(UPLOAD_PATH.$folder_name.'/before_thumb',0777);
		
	}
*/	
	$_POST = stripslashes_deep($_POST);
	$_GET = stripslashes_deep($_GET);
	$_REQUEST = stripslashes_deep($_REQUEST);
	
	
	
	if ($hidAction!='')
		include(PLUGIN_PATH.$folder_name.'/'.$page_name.'-crud.php');
	elseif ($_REQUEST['hidAction1']=='editgal')
	include(PLUGIN_PATH.$folder_name.'/'.$page_name.'-edit-crud.php');
			
	elseif ($option=='add')
		include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
	elseif ($option=='edit')
		include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_edit.php');	
	else
		include(PLUGIN_PATH.$folder_name.'/manage_'.$page_name.'.php');
}

	add_action('admin_print_scripts', 'gallery_call_scripts');
	add_action('admin_print_styles', 'gallery_call_css');
	
	function gallery_call_scripts() {
		/*wp_enqueue_script('jquery_1_3_2',PLUGIN_URL.'inc/js/jquery-1.3.2.js');*/
		wp_enqueue_script('jquery_tablednd',PLUGIN_URL.'inc/js/jquery.tablednd_0_5.js');
		/*wp_enqueue_script('jquery_lightbox',PLUGIN_URL.'inc/js/lightbox/js/jquery.lightbox-0.5.js');*/
		
	}
	
	function gallery_call_css() {
		wp_enqueue_style('css_lightbox',PLUGIN_URL.'inc/js/lightbox/css/jquery.lightbox-0.5.css');
	}
?>
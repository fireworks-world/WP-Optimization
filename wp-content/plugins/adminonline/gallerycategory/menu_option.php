<?php

function gallerycategory(){
	global $curr_page, $hidAction, $option, $wpdb;
	
	define('TBL','tbl_category');
	$entity = 'Gallery Category';
	$page_name = 'gallerycategory';
	$folder_name = 'gallerycategory';
	$primary_key = 'category_id';
	
	//create table if not exists
	$table_name = $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE 'tbl_category'","" ) );
	if ($table_name==''){
		$sql = "
				CREATE TABLE IF NOT EXISTS `tbl_category` (
				`category_id` INT( 11 ) NOT NULL AUTO_INCREMENT,
				`category_name` VARCHAR( 250 ) NOT NULL ,
				`category_seotitle` VARCHAR( 250 ) NOT NULL ,
				`category_image` VARCHAR( 250 ) NOT NULL ,
				`category_thumbimage` VARCHAR( 250 ) NOT NULL ,
				`metatitle` VARCHAR( 255 ) NOT NULL ,
				`metakeyword` VARCHAR( 255 ) NOT NULL ,
				`metadesc` VARCHAR( 255 ) NOT NULL ,
				`ordering` INT( 11 ) NOT NULL ,
				`status` ENUM( 'Y', 'N' ) NOT NULL ,
				PRIMARY KEY (`category_id`)
				) 
			";
		$wpdb->query($sql);
	}
	
	if ( ! is_dir(UPLOAD_PATH) ) {
		@mkdir(UPLOAD_PATH,0777);
	}
	
	if ( ! is_dir(UPLOAD_PATH.$folder_name) ) {
		@mkdir(UPLOAD_PATH.$folder_name,0777);
		@mkdir(UPLOAD_PATH.$folder_name.'/thumbs',0777);
	}
	
	$_POST = stripslashes_deep($_POST);
	$_GET = stripslashes_deep($_GET);
	$_REQUEST = stripslashes_deep($_REQUEST);
	
	
	

	if ($hidAction!='')
		include(PLUGIN_PATH.$folder_name.'/'.$page_name.'-crud.php');
	elseif ($option=='add')
		include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
	else
		include(PLUGIN_PATH.$folder_name.'/manage_'.$page_name.'.php');
}

	add_action('admin_print_scripts', 'gallerycategory_call_scripts');
	add_action('admin_print_styles', 'gallerycategory_call_css');
	
	function gallerycategory_call_scripts() {
		/*wp_enqueue_script('jquery_1_3_2',PLUGIN_URL.'inc/js/jquery-1.3.2.js');*/
		wp_enqueue_script('jquery_tablednd',PLUGIN_URL.'inc/js/jquery.tablednd_0_5.js');
		/*wp_enqueue_script('jquery_lightbox',PLUGIN_URL.'inc/js/lightbox/js/jquery.lightbox-0.5.js');*/
		
	}
	
	function gallerycategory_call_css() {
		wp_enqueue_style('css_lightbox',PLUGIN_URL.'inc/js/lightbox/css/jquery.lightbox-0.5.css');
	}
?>
<?php
function testimonial(){
	global $curr_page, $hidAction, $option, $wpdb;
	
	define('TBL','tbl_testimonial');
	$entity = 'Testimonials';
	$page_name = 'testimonial';
	$folder_name = 'testimonial';
	$primary_key = 'testimonial_id';
	
	//create table if not exists
	$table_name = $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE 'tbl_testimonial'" ,"" ) );
	

	if ($table_name==''){
		$sql = "
				CREATE TABLE IF NOT EXISTS `tbl_testimonial` (
				  `testimonial_id` int(11) NOT NULL AUTO_INCREMENT,
				  `title` text NOT NULL,
				  `author` text NOT NULL,
				  `testimony` text NOT NULL,
				  `testimonial_post_date` text NOT NULL,
				  `ordering` int(11) NOT NULL,
				  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
				  PRIMARY KEY (`testimonial_id`)) 
			";
		$wpdb->query($sql);
	}
	
	$_POST = stripslashes_deep($_POST);
	$_GET = stripslashes_deep($_GET);
	$_REQUEST = stripslashes_deep($_REQUEST);

   	
	if ($hidAction!='')
	{
		
		include(PLUGIN_PATH.$folder_name.'/'.$page_name.'-crud.php');
	}	
	if ($option=='add')
	{
		
		include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
	}
	else
	{
		include(PLUGIN_PATH.$folder_name.'/manage_'.$page_name.'.php');
	}	
}

	
	add_action('admin_print_scripts', 'testimonial_call_scripts');
	add_action('admin_print_styles', 'testimonial_call_css');
	
	function testimonial_call_scripts() {
		//wp_enqueue_script('jquery_1_3_2',PLUGIN_URL.'inc/js/jquery-1.3.2.js');
		wp_enqueue_script('jquery_tablednd',PLUGIN_URL.'inc/js/jquery.tablednd_0_5.js');
		wp_enqueue_script('ckeditor',PLUGIN_URL.'inc/js/ckeditor/ckeditor.js');
	}
	
	function testimonial_call_css() {
		//none
	}
?>
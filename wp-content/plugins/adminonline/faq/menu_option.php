<?php
function faq(){
	global $curr_page, $hidAction, $option, $wpdb;
	
	define('TBL','tbl_faq');
	$entity = 'FAQ';
	$page_name = 'faq';
	$folder_name = 'faq';
	$primary_key = 'faq_id';
	
	//create table if not exists
	$table_name = $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE 'tbl_faq'","" ) );
	if ($table_name==''){
		$sql = "CREATE TABLE IF NOT EXISTS `tbl_faq` (
				  `faq_id` int(11) NOT NULL AUTO_INCREMENT,
				  `faq_question` text NOT NULL,
				  `faq_answer` text NOT NULL,
				  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
				  `ordering` int(11) NOT NULL,
				   PRIMARY KEY (`faq_id`)
				) 
			";
		$wpdb->query($sql);
	}
	

	$_POST = stripslashes_deep($_POST);
	$_GET = stripslashes_deep($_GET);
	$_REQUEST = stripslashes_deep($_REQUEST);


	if ($hidAction!='')
		include(PLUGIN_PATH.$folder_name.'/'.$page_name.'-crud.php');
	if ($option=='add')
		include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
	else
		include(PLUGIN_PATH.$folder_name.'/manage_'.$page_name.'.php');
}

	
	add_action('admin_print_scripts', 'faq_call_scripts');
	add_action('admin_print_styles', 'faq_call_css');
	
	function faq_call_scripts() {
		/*wp_enqueue_script('jquery_1_3_2',PLUGIN_URL.'inc/js/jquery-1.3.2.js');*/
		wp_enqueue_script('jquery_tablednd',PLUGIN_URL.'inc/js/jquery.tablednd_0_5.js');
		wp_enqueue_script('ckeditor',PLUGIN_URL.'inc/js/ckeditor/ckeditor.js');
	}
	
	function faq_call_css() {
		//none
	}
?>
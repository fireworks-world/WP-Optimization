<?php
/*
Plugin Name: Manage Emails
Plugin URI: http://www.techwyse.com
Description: Manage Emails
Author: Techwyse 
Author URI: http://www.techwyse.com
*/
function jal_install () {
   global $wpdb;
   global $jal_db_version;

   $table_name = $wpdb->prefix . "email";
   if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
      
      $sql = "CREATE TABLE " . $table_name . " (
	  id mediumint(9) NOT NULL AUTO_INCREMENT,	  
	  email_to  VARCHAR(155) NOT NULL,
	  email_bcc  VARCHAR(155) NOT NULL,
	  email_cc  VARCHAR(155) NOT NULL,
	  UNIQUE KEY id (id)
	);";

      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      dbDelta($sql);

      $email_to = "info@techwyseintl.com";
      $email_bcc = "";
      $email_cc = "";   

      $insert = "INSERT INTO " . $table_name .
            " (email_to, email_bcc, email_cc) " .
            "VALUES ('" . $email_to . "','" . $email_bcc . "','" . $email_cc . "')";

      $results = $wpdb->query( $insert );
 
      add_option("jal_db_version", $jal_db_version);
   }
}
jal_install ();


/////////////////////////////////////
//----------------------------------------------------------

global $js_url_e,$plugin_url;
$js_url_e=get_bloginfo('wpurl') .'/'.PLUGINDIR.'/manage-email/js/'; 

add_action('wp_print_scripts', 'email_scripts');
function email_scripts()
 {
  global $js_url_e;
 if($_REQUEST['page']=='manage-email'){
wp_enqueue_script('script1', $js_url_e.'jquery_new.js');
wp_enqueue_script('script3', $js_url_e.'jquery.js');
wp_enqueue_script('script2', $js_url_e.'email-validation.js');
   
  ?>
  <script type="text/javascript">
var jQuery=jQuery.noConflict();
jQuery("#addToEmail").click(function(){
var to_count=jQuery("#to_count").val();
to_count=parseInt(to_count)+parseInt(1);
jQuery("#to_count").val(to_count);
jQuery("#tbd").append('<tr id="To_'+to_count+'"><td width="1" align="left" style="border:none;">&nbsp;</td><td width="25" align="left" style="border:none;">To<span style="color:#F00;">*</span></td><td align="left" style="border:none;"><input name="emailto" type="text"  size="50" /></td><td align="left" style="border:none;"><input type="button" onclick="SendTestMail(document.manageEmail.emailto,"emailto","<?=$plugin_url?>")" name="button1" title="Test Admin Email" id="button3" value="Test Admin Email" style="cursor:pointer" /></td><td width="900" align="left" style="border:none;"><a href="javascript:void(0); return false;" onclick=" return removeToField('+to_count+');">Remove</a></td></tr>');
});
</script>
<script type="text/javascript">
function removeToField(Id)
{
	var to_count=jQuery("#to_count").val();
	to_count=parseInt(to_count)-parseInt(1);
	jQuery("#to_count").val(to_count);

	jQuery("#To"+Id).remove();
	
}
</script>
  <?php
  
 
   }
}
// action function for hooks

function sub_menu_fun() 
{
    global $current_user;
	  get_currentuserinfo();
	if(current_user_can('administrator') ) {
		add_menu_page('Emails', 'Emails', 1, 'manage-email', 'manage_email');
	}
}
// Hook for adding admin menus
add_action('admin_menu', 'sub_menu_fun');
function manage_email() 
{ 
global $wpdb;
$table_name = $wpdb->prefix . "email";
$result= mysql_query("SELECT email_to,email_bcc,email_cc FROM ".$table_name." where id=1");
$emails_arr=array();
while ($row = mysql_fetch_assoc($result)) 
	  {
array_push($emails_arr, $row['email_to']);
array_push($emails_arr, $row['email_bcc']);
array_push($emails_arr, $row['email_cc']);
      }
	  $plugin_url=get_bloginfo('wpurl') .'/'.PLUGINDIR.'/manage-email/'; 
 $plugin_url1=get_bloginfo('wpurl') .'/'.PLUGINDIR.'/manage-email/mail-icon.png';
?>

 <div class="wrap">
 <h2><img src="<?php echo $plugin_url1; ?>" width="32" height="32"  align="left" style="margin-right:15px;"/>Manage Email</h2> <br />
<form name="manageEmail"  id="manageEmail"  method="post"> 
  <table  align="center" class="widefat" >
    <tbody >  <font color="#FF0000"><div id="admin_mail" align="center"></div></font>
<tr>
        <td  width="1" align="left" colspan="5">
	<table cellpadding="0" cellspacing="0" id="tbd">
      <tr id="To_1" >
        <td width="1" align="left">&nbsp;</td>
        <td width="25" align="left" style="border:none;">To<span style="color:#F00; border:none;">*</span></td>
        <td align="left" style="border:none;"><input name="emailto" type="text" value="<? echo $emails_arr[0]; ?>" size="50" /></td>
        <td align="left" style="border:none;"><input type="button" onclick="SendTestMail(document.manageEmail.emailto,'emailto','<?=$plugin_url?>')" name="button1" title="Test Admin Email" id="button3" value="Test Admin Email" style="cursor:pointer" /></td>
        <td width="900" align="left" style="border:none;">&nbsp;</td>
      </tr>
	  </table></td>
      </tr>
	 
    <tr >
        <td width="1" align="left">&nbsp;</td>
        <td align="left"> Bcc</td>
        <td align="left"><input name="emailbcc" type="text"  value="<? echo $emails_arr[1]; ?>" size="50" /></td>
        <td align="left"><input type="button"  onclick="SendTestMail(document.manageEmail.emailbcc,'emailbcc','<?=$plugin_url?>')"name="button2" title="Test Bcc Email" id="button3" value="Test Bcc Email" style="cursor:pointer" /></td>
        <td width="900" align="left">&nbsp;</td>
      </tr>
    <tr >
        <td width="1" align="left">&nbsp;</td>
        <td align="left">Cc</td>
        <td align="left"><input name="emailcc" type="text" value="<? echo $emails_arr[2]; ?>" size="50" /></td>
        <td align="left"><input type="button"  onclick="SendTestMail(document.manageEmail.emailcc,'emailcc','<?=$plugin_url?>')" name="button3" title="Test Cc Email" id="button3" value="Test Cc Email" style="cursor:pointer" /></td>
        <td align="left">&nbsp;</td>
      </tr>
      <tr> 
        <td colspan="3" align="left"> </td>
        <td align="left"><label class="submit"  style="padding-right:30px;" >
          <input type="button" onclick="SaveMails(document.manageEmail.emailto,document.manageEmail.emailbcc,document.manageEmail.emailcc,'<?=$plugin_url?>')" name="submit" title="Submit" value="Submit">
          </label> </td>
        <td align="left">&nbsp;</td>
      </table>
	  	 <input type="hidden" name="to_count" id="to_count" value="1">
</form>
</div>
<? } ?>
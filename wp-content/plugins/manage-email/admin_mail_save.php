<?
session_start();
require( '../../../wp-load.php' );
if($_REQUEST['EmailTo']!='' || $_REQUEST['EmailCc']!='' || $_REQUEST['EmailBcc']!='')
{
$table_name = $wpdb->prefix . "email";
$wpdb->update($table_name, array('email_to' => $_REQUEST['EmailTo'],'email_cc' => $_REQUEST['EmailCc'],'email_bcc' => $_REQUEST['EmailBcc']), array('id' => 1) );
echo    "Record updated";

}
?>
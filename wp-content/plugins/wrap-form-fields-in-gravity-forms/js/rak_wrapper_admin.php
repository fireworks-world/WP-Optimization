function deleteWrapper( fieldId ) {
	
	jQuery('#gform_fields li#field_' + fieldId).addClass('gform_pending_delete');
	
	var myWrapper = new sack("<?php echo admin_url( 'admin-ajax.php' )?>");
	
	myWrapper.execute = 1;
	myWrapper.method = 'POST';
	
	myWrapper.setVar("action", "rg_delete_field");
	myWrapper.setVar("rg_delete_field", "<?php echo wp_create_nonce( 'rg_delete_field' ) ?>");
	myWrapper.setVar("form_id", form.id);
	myWrapper.setVar("field_id", fieldId);
	
	myWrapper.onError = function () {
		alert(<?php echo json_encode( esc_html__( 'Ajax error while deleting field.', 'gravityforms' ) ); ?>)
	};
	
	myWrapper.runAJAX();
	
	return true;

}
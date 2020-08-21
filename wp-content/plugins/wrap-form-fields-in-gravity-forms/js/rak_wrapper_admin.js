jQuery(document).ready(function($) {
	
	fieldSettings["WrapperBegin"] = ".label_setting, .css_class_setting, .conditional_logic_field_setting";
	fieldSettings["WrapperEnd"] = ".label_setting, .conditional_logic_field_setting";
	
	function wrapperExist() {
		
		var wrappersCount = jQuery( '#gform_fields .gform_wrapper' ).length;
		
		return wrappersCount;
		
	}
	
	jQuery(document).bind('gform_field_deleted', function( event, form, field ){
	
		var wrapperClosed = true;
		
		jQuery.each( form.fields, function( index, value ) {
			
			if ( typeof value.type != "undefined" ) {
				
				if ( value.type == 'WrapperBegin' ) {
					
					wrapperClosed = false;
					
				} else if ( value.type == 'WrapperEnd' ) {
					
					console.log( value );
					
					if ( wrapperClosed ) {
						
						deleteWrapper( value.id );
						
						return;
						
					}
					
					wrapperClosed = true;
					
				}
				
			}
			
		});
	
	});
	
	jQuery(document).bind( 'gform_field_added', function( event, form, field ) {
		
		if ( field['type'] == 'WrapperBegin' || field['type'] == 'WrapperEnd' ) {
			
			var wrapperClosed = true;
			var index = 1;
			
			jQuery.each( form.fields, function( index, value ) {
				
				if ( typeof value.type != "undefined" ) {
					
					if ( value.type == 'WrapperBegin' ) {
						
						if ( wrapperClosed ) {
							
							wrapperClosed = false;
							
						} else {
							
							StartAddField( 'WrapperEnd', index );
							
							wrapperClosed = true;
							
							return;
							
						}
						
					} else if ( value.type == 'WrapperEnd' ) {
						
						if ( wrapperClosed ) {
						
							StartAddField( 'WrapperBegin', index );
							
							return;
							
						} else {
							
							wrapperClosed = true;
							
						}
						
					}
					
				}
				
				index++;
				
			});
			
			if ( !wrapperClosed ) {
				
				StartAddField( 'WrapperEnd' );
				
			}
			
		}
	
	} );
	
});
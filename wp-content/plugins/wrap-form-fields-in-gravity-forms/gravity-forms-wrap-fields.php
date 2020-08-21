<?php

/**
Plugin Name: Wrap Form Fields In Gravity Forms
Version: 0.1.1
Description: Wrap Gravity Form fields within a div and add a custom class.
Contributors: mrommel
Author: Mikkel Rommelhoff
Author URI: https://rommel.dk
Text Domain: gravityforms-wrap-fields
Domain Path: /languages/
License: GPL2 v2
*/

if ( ! defined( 'RAK_GF_FIELDSET_FILE' ) ) {
	define( 'RAK_GF_FIELDSET_FILE', __FILE__ );
}
if ( ! defined( 'RAK_GF_FIELDSET_PATH' ) ) {
	define( 'RAK_GF_FIELDSET_PATH', plugin_dir_path( RAK_GF_FIELDSET_FILE ) );
}
if ( ! defined( 'RAK_GF_FIELDSET_BASENAME' ) ) {
	define( 'RAK_GF_FIELDSET_BASENAME', plugin_basename( RAK_GF_FIELDSET_FILE ) );
}

/**
 * Load translations
 */
add_action( 'init', 'rak_gf_wrapper_load_textdomain', 1 );
function rak_gf_wrapper_load_textdomain() {
	
	$rak_gf_wrapper_path = str_replace( '\\', '/', RAK_GF_FIELDSET_PATH );
	$mu_path    = str_replace( '\\', '/', WPMU_PLUGIN_DIR );

	if ( false !== stripos( $rak_gf_wrapper_path, $mu_path ) ) :
	
		load_muplugin_textdomain( 'gravityforms-wrap-fields', dirname( RAK_GF_FIELDSET_BASENAME ) . '/languages/' );
	else :
		
		load_plugin_textdomain( 'gravityforms-wrap-fields', false, dirname( RAK_GF_FIELDSET_BASENAME ) . '/languages/' );
	endif;
}

/**
 * RAK_GF_Wrapper class.
 */
if (!class_exists('RAK_GF_Wrapper')) {

	add_action( 'admin_notices', array('RAK_GF_Wrapper', 'admin_warnings' ), 20 );
	class RAK_GF_Wrapper {
		
		private static $name = 'Wrap form items in div for Gravity Forms';
		private static $slug = 'rak_gf_wrapper';
		private static $version = '0.1';

		/**
		 * Construct the plugin object
		 */
		public function __construct() {
			
			// register plugin functions through 'plugins_loaded' -
			// this delays the registration until all plugins have been loaded, ensuring it does not run before Gravity Forms is available.
			add_action( 'plugins_loaded', array( &$this, 'register_actions' ) );
		}
		
		/**
		 * Register plugin functions
		 */
		function register_actions() {
			
			// register actions.
			if (self::is_gravityforms_installed()) {

				// start plug in
				// add buttons to the GF
				add_filter( 'gform_add_field_buttons', array( &$this, 'wrapper_add_field' ) );

				// add input field for field title
				add_filter( 'gform_field_type_title', array( &$this, 'wrapper_title' ), 10, 2 );
				add_action( 'gform_editor_js', array( &$this, 'wrapper_custom_scripts' ) );
				add_action( 'gform_field_css_class', array( &$this, 'wrapper_custom_class' ), 10, 3 );
				add_filter( 'gform_field_content', array( &$this, 'wrapper_display_field' ), 10, 5 );
			}
		}

		/**
		 * Create a new fields group in the Gravity Forms forms editor and add our wrapper 'fields' to it.
		 */
		public static function wrapper_add_field( $field_groups ) {
			
			// add begin wrapper button.
			$wrapper_begin_field = array(
				'class'		=> 'button',
				'value'		=> esc_html__( 'Wrapper Begin', 'gravityforms-wrap-fields' ),
				'data-type'	=> 'WrapperBegin',
				'onclick'	=> 'StartAddField( \'WrapperBegin\' );'
			);
			
			// add end wrapper button.
			$wrapper_end_field = array(
				
				'class'		=> 'button',
				'value'		=> esc_html__( 'Wrapper End', 'gravityforms-wrap-fields' ),
				'data-type'	=> 'WrapperEnd',
				'onclick'	=> 'StartAddField( \'WrapperEnd\' );'
			);

			foreach ( $field_groups as &$group ) {

				$rak_fields_active = false;

				if ( $group["name"] === "rak_fields" ) {

					$rak_fields_active = true;

					$group["fields"][] = $wrapper_begin_field;
					$group["fields"][] = $wrapper_end_field;
				}
			}

			if ( !$rak_fields_active ) {

				$field_groups[] = array(

					'name'   => 'rak_fields',
					'label'  => esc_html__( 'Wrappers', 'gravityforms-wrap-fields' ),
					'fields' => array( $wrapper_begin_field, $wrapper_end_field )

				);
			}
			return $field_groups;
		}

		/**
		 * Add title to wrapper, displayed in Gravity Forms forms editor
		 */
		public static function wrapper_title( $title, $field_type ) {
			
			if ( $field_type === "WrapperBegin" ) {

				return esc_html__( 'Wrapper Begin', 'gravityforms-wrap-fields' );
			} elseif ( $field_type === "WrapperEnd" ) {

				return esc_html__( 'Wrapper End', 'gravityforms-wrap-fields' );
			} else {

				return esc_html__( 'Unknown', 'gravityforms-wrap-fields' );
			}
		}
		
		/**
		 * JavaSript to add field options to wrapper fields in the Gravity forms editor
		 */
		public static function wrapper_custom_scripts() {

			// add custom css.
			wp_enqueue_style(
				'rak_wrapper_admin_style',
				plugins_url( '/css/rak_wrapper_admin.css', __FILE__ )
			);

			// add js.
			echo '<script type="text/javascript">';

			// include JS that do not require PHP parse.
			include( plugin_dir_path( __FILE__ ) . '/js/rak_wrapper_admin.js' );
			
			// include JS that requires PHP parsing.
			include( plugin_dir_path( __FILE__ ) . '/js/rak_wrapper_admin.php' );

			echo '</script>';
		}

		/**
		 * Add custom classes to wrapper fields, controls CSS applied to field
		 */
		public static function wrapper_custom_class($classes, $field, $form) {
			
			if ( $field['type'] === 'WrapperBegin' ) {

				$classes .= ' gform_item_wrapper_begin gform_wrapper';

			} elseif ($field['type'] === 'WrapperEnd') {

				$classes .= ' gform_item_wrapper_end gform_wrapper';
			}
			return $classes;
		}
		
		/**
		 * Displays wrapper
		 */
		public static function wrapper_display_field( $content, $field, $value, $lead_id, $form_id ) {

			if ( ( ! is_admin() ) && ( $field['type'] == 'WrapperBegin' ) ) {

				$content = '';
				$content .= '<div class="gfield_course_option_wrapper">';
				$content .= '<ul><li>';

			} elseif ( ( ! is_admin() ) && ( $field['type'] == 'WrapperEnd' ) ) {

				$content = '';
				$content .= '</li></ul>';
				$content .= '</div>';
			}
			return $content;
		}

		/**
		 * Warning message if Gravity Forms is installed and enabled
		 */
		public static function admin_warnings() {
			
			if ( !self::is_gravityforms_installed() ) {

				$message = esc_html__( 'requires Gravity Forms to be installed.', 'gravityforms-wrap-fields' );
			}
			if ( empty( $message ) ) return; ?>
			<div class="error">
				<h3><?php esc_html_e('Warning', 'gravityforms-wrap-fields'); ?></h3>
				<p><?php esc_html_e('The plugin', 'gravityforms-wrap-fields'); ?> <strong><?php echo self::$name; ?></strong> <?php echo $message; ?><br /><?php esc_html_e('Please', 'gravityforms-wrap-fields'); ?> <a target="_blank" href="http://www.gravityforms.com/"><?php esc_html_e('download the latest version', 'gravityforms-wrap-fields'); ?></a> <?php esc_html_e('of Gravity Forms and try again.', 'gravityforms-wrap-fields'); ?></p>
			</div>
			<?php
		}
		
		/**
		 * Check if GF is installed
		 */
		private static function is_gravityforms_installed() {
			
			if ( !function_exists( 'is_plugin_active' ) || !function_exists( 'is_plugin_active_for_network' ) ) {

				require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
			}
			if (is_multisite()) {

				return (
					is_plugin_active_for_network( 'gravityforms/gravityforms.php' ) ||
					is_plugin_active( 'gravityforms/gravityforms.php' )
				);
			} else {
				return is_plugin_active( 'gravityforms/gravityforms.php' );
			}
		}
	}
	$RAK_GF_Wrapper = new RAK_GF_Wrapper();
}

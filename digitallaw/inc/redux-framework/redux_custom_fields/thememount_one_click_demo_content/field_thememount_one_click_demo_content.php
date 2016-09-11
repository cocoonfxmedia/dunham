<?php
/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @subpackage  Field_Color
 * @author      Daniel J Griffiths (Ghost1227)
 * @author      Dovy Paukstys
 * @version     3.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')){
    exit;
}


		
		

// Don't duplicate me!
if( !class_exists( 'ReduxFramework_thememount_one_click_demo_content' ) ) {

    /**
     * Main ReduxFramework_thememount_skin_color class
     *
     * @since       1.0.0
     */

	class ReduxFramework_thememount_one_click_demo_content{
	
		/**
		 * Field Constructor.
		 *
		 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
		 *
	 	 * @since 		1.0.0
	 	 * @access		public
	 	 * @return		void
		 */
		function __construct( $field = array(), $value ='', $parent ) {
        
			//parent::__construct( $parent->sections, $parent->args );
			$this->parent = $parent;
			$this->field = $field;
			$this->value = $value;
			
		}
	
		/**
		 * Field Render Function.
		 *
		 * Takes the vars and outputs the HTML for the field in the settings
	 	 *
	 	 * @since 		1.0.0
	 	 * @access		public
	 	 * @return		void
		 */
		function render() {
			
			$button_disabled			= "disabled";
			
			
			
			if( class_exists('thememount_one_click_demo_setup') ){
				$button_disabled	= "";
			}
			?>

			<div class="thememount-one-click-demo-content-wrapper">
				<input type="button" class="button button-primary <?php echo sanitize_html_class($button_disabled); ?>" id="thememount_one_click_demo_content_option" value="Demo Content Setup" />
				
				<?php
				if( !class_exists('thememount_one_click_demo_setup') ){
					?>
					<div class="alert-info tm-one-click-error-message">
						<?php esc_attr_e('The "Digitallaw Demo Content Setup" plugin is not installed or activated. This plugin is required to Import Demo Content.', 'digitallaw' ); ?>
						<a href="<?php echo esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ) ?>"><?php esc_attr_e('Click here to install the plugin', 'digitallaw' ); ?></a>
					<div>
					<?php
				}
				?>
				<div id="import-demo-data-results-wrapper" style="display:none;">
					<div id="import-demo-data-results">
					
					
						<div class="import-demo-data-layout">
							<h3><?php esc_attr_e('Select demo data type', 'digitallaw') ?>  <small>(<?php esc_attr_e('by clicking on the thumbnail', 'digitallaw'); ?>)</small>: </h3>
							<input type="hidden" id="import-layout-color" name="import-layout-color" value="white" />
							<a href="#" class="import-demo-thumb import-demo-thumb-white import-demo-thumb-active" data-layout="white">
								<span class="import-demo-imgwrapper"><img src="<?php echo esc_url( get_template_directory_uri() . '/inc/redux-framework/redux_custom_fields/thememount_one_click_demo_content/layout-white.png' ); ?>" /></span>
								<span class="import-demo-overlay"><span><img src="<?php echo esc_url( get_template_directory_uri() . '/inc/redux-framework/redux_custom_fields/thememount_one_click_demo_content/active-arrow.png' ); ?>" /></span></span>
								<div class="thememount-demo-link-title"><?php esc_attr_e('White','digitallaw'); ?></div>
							</a>
							<a href="#" class="import-demo-thumb import-demo-thumb-dark" data-layout="dark">
								<span class="import-demo-imgwrapper"><img src="<?php echo esc_url( get_template_directory_uri() . '/inc/redux-framework/redux_custom_fields/thememount_one_click_demo_content/layout-dark.png' ); ?>" /></span>
								<span class="import-demo-overlay"><span><img src="<?php echo esc_url( get_template_directory_uri() . '/inc/redux-framework/redux_custom_fields/thememount_one_click_demo_content/active-arrow.png' ); ?>" /></span></span>
								<div class="thememount-demo-link-title"><?php esc_attr_e('Dark','digitallaw'); ?></div>
							</a>
						</div><!-- .import-demo-data-layout -->
						
					
						<div class="import-demo-data-text">
							<strong><?php esc_attr_e('NOTE:', 'digitallaw'); ?></strong>
							<?php esc_attr_e('This process may overwrite your existing content or settings. So please do this on fresh WordPress setup only.', 'digitallaw'); ?>
							<br /><br />
							<?php esc_attr_e('Also if you already included demo data than this will add multiple menu links and you need to remove the repeated menu items by going to "Admin > Appearance > menus" section.', 'digitallaw'); ?>
							<br /><br />
							<input type="button" class="button button-primary <?php echo esc_attr($this->field['id']); ?>" id="thememount_one_click_demo_content" value="<?php esc_attr_e('I agree, continue demo content setup', 'digitallaw'); ?>" /> &nbsp; 
							<input type="button" class="button" id="thememount_one_click_demo_content_cancel" value="<?php esc_attr_e('Cancel', 'digitallaw'); ?>" />
						</div>
					
					</div>
				</div>
				
			<div class="clear"></div></div>
		
		
		<?php
		}
	
		/**
		 * Enqueue Function.
		 *
		 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
		 *
		 * @since		1.0.0
		 * @access		public
		 * @return		void
		 */
		public function enqueue() {

			// Function for demo content setup
			wp_enqueue_script(
				'redux-field-thememountoneclickdemo-js',
				get_template_directory_uri() . '/inc/redux-framework/redux_custom_fields/thememount_one_click_demo_content/field_thememount_one_click_demo_content.js',
				array( 'jquery' ),
				time(),
				true
			);

			wp_enqueue_style(
				'redux-field-thememountoneclickdemo-css',
				get_template_directory_uri() . '/inc/redux-framework/redux_custom_fields/thememount_one_click_demo_content/field_thememount_one_click_demo_content.css',
				time(),
				true
			);
			
			
		}
		

		
	
		
	
	}
}


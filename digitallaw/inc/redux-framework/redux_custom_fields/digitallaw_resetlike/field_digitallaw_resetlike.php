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
if( !class_exists( 'ReduxFramework_digitallaw_resetlike' ) ) {

    /**
     * Main ReduxFramework_digitallaw_skin_color class
     *
     * @since       1.0.0
     */
	//class ReduxFramework_digitallaw_skin_color extends ReduxFramework {
	class ReduxFramework_digitallaw_resetlike{
	
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
			

			

			echo '<div class="thememount-tm-resetlike-wrapper">';
				echo '<input type="button" class="button button-primary" id="digitallaw_resetlike_btn_caller" value="Reset all LIKE from all Portfolio" />';
				echo '<div id="tm-resetlike-wrapper" style="display:none;">
					<div id="tm-resetlike-results">
					
						<div class="min-generator-layout">
							<p>'.esc_html__('Are you sure you want to reset all LIKEs counter?', 'digitallaw').'</p><br>
							<a href="#" id="digitallaw_resetlike_btn">YES</a> &nbsp; <a href="#" id="digitallaw_resetlike_btn_no">NO</a>
						</div><!-- .import-demo-data-layout -->
					
					</div>
				</div>
				';
			echo '<div class="clear"></div></div>';
		
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
				'redux-field-thememount-resetlike-js',
				get_template_directory_uri() . '/inc/redux-framework/redux_custom_fields/digitallaw_resetlike/field_digitallaw_resetlike.js',
				array( 'jquery' ),
				time(),
				true
			);

			wp_enqueue_style(
				'redux-field-thememount-resetlike-css',
				get_template_directory_uri() . '/inc/redux-framework/redux_custom_fields/digitallaw_resetlike/field_digitallaw_resetlike.css',
				time(),
				true
			);
			
		}
	
	}
}




function digitallaw_resetlike_js() { ?>
	<script type="text/javascript" >

		
	jQuery( document ).ready(function($) {
				
		jQuery('#digitallaw_resetlike_btn').click(function() {
			
			if( $(this).attr('disabled') == 'disabled' ) {
				return false;
			}
			
			
			$('#tm-resetlike-wrapper').slideDown();
			
			var button = $(this);
			var resultDiv = $('#tm-resetlike-results');
			
			resultDiv.addClass('tm-resetlike-progress'); // Adding loader class
			
		
			$.ajax({
				url: ajaxurl,
				type: "POST",
				dataType: "json",
				data: {
					'action'    : 'digitallaw_resetlike',
					//'color'     : color,
					'subaction' : 'start'
				},
				beforeSend: function() {
					resultDiv.html('<p id="tm-resetlike-started">Starting MIN generator...</p>').show().removeClass('error');
				},
				success: function( result ) {

					function demoInstallerStep( result ) {
						
						if( result != null && typeof( result ) == 'object' ) {
						
							if( result.answer == 'ok' ) {
							
								resultDiv.append('<p>' + result.message + '</p>');
								
								/*** Extra data for next processing ***/
								var missing_menu_items = '';
								if( typeof result.missing_menu_items != "undefined" ){
									missing_menu_items = result.missing_menu_items;
								}
								
								var processed_terms = '';
								if( typeof result.processed_terms != "undefined" ){
									processed_terms = result.processed_terms;
								}
								
								var processed_posts = '';
								if( typeof result.processed_posts != "undefined" ){
									processed_posts = result.processed_posts;
								}
								
								var processed_menu_items = '';
								if( typeof result.processed_menu_items != "undefined" ){
									processed_menu_items = result.processed_menu_items;
								}
								
								var menu_item_orphans = '';
								if( typeof result.menu_item_orphans != "undefined" ){
									menu_item_orphans = result.menu_item_orphans;
								}
								
								var url_remap = '';
								if( typeof result.url_remap != "undefined" ){
									url_remap = result.url_remap;
								}
								
								var featured_images = '';
								if( typeof result.featured_images != "undefined" ){
									featured_images = result.featured_images;
								}
								/***********************************/
								
								
								
								
								$.ajax({
									url: ajaxurl,
									type: "POST",
									dataType: "json",
									data: {
										'action'    : 'digitallaw_resetlike',
										//'color'     : color,
										'subaction' : result.next_subaction,
										'data'      : result.data,
										'missing_menu_items'   : result.missing_menu_items,
										'processed_terms'      : result.processed_terms,
										'processed_posts'      : result.processed_posts,
										'processed_menu_items' : result.processed_menu_items,
										'menu_item_orphans'    : result.menu_item_orphans,
										'url_remap'            : result.url_remap,
										'featured_images'      : featured_images
									},
									success: function( result ) {
										demoInstallerStep( result );
									},
									error: function(request, status, error) {
										resultDiv.html( '<p><strong style="color: red"> Error: ' + request.status + '</p>' );
										button.removeAttr('disabled');
									}
								});
							
							}
						
							if( result.answer == 'finished' ) {
								
								resultDiv.append('<p><strong>All finished... Enjoy :) </strong></p>');
								resultDiv.addClass('thememount-import-demo-success');
								
							}
						
						}
						
					}

					demoInstallerStep( result );
			
				},
				error: function(request, status, error) {
			
					resultDiv.html( '<p><strong style="color: red">: ERRRRROR' + request.status + '</p>' );
					
				}
			});
			
			return false;

		});





		
		
	}); // document.ready END
		
		
	</script> <?php
}


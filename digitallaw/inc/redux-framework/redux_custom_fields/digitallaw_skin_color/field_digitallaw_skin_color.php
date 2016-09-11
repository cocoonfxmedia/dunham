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
if( !class_exists( 'ReduxFramework_digitallaw_skin_color' ) ) {

    /**
     * Main ReduxFramework_digitallaw_skin_color class
     *
     * @since       1.0.0
     */

	class ReduxFramework_digitallaw_skin_color{
	
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
			
			$colorList = $this->field['values'];
			
			echo '<div class="thememount-skin-color-list">';
			foreach( $colorList as $name=>$color ){ echo '<a href="#" title="'.$name.'" style="background-color:'.$color.'">'.$name.'</a>'; }
			echo '<div class="clear"></div></div>';
			
			
			echo '<div class="thememount-or-text-wrapper"><span></span><div class="thememount-or-text">OR</div></div>';
		
		
			echo '<input data-id="'.$this->field['id'].'" name="' . $this->field['name'] . $this->field['name_suffix'] . '" id="' . $this->field['id'] . '-color" class="redux-color redux-color-init ' . $this->field['class'] . '"  type="text" value="' . $this->value . '"  data-default-color="' . ( isset($this->field['default']) ? $this->field['default'] : "" ) . '" />';

			if ( !isset( $this->field['transparent'] ) || $this->field['transparent'] !== false ) {
				$tChecked = "";
				if ( $this->value == "transparent" ) {
					$tChecked = ' checked="checked"';
				}
				

				
				echo '<label for="' . $this->field['id'] . '-transparency" class="color-transparency-check"><input type="checkbox" class="checkbox color-transparency ' . $this->field['class'] . '" id="' . $this->field['id'] . '-transparency" data-id="'.$this->field['id'] . '-color" value="1"'.$tChecked.'> '.esc_html__('Transparent', 'digitallaw').'</label>';				
			}

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

			wp_enqueue_style( 'wp-color-picker' );			
		
		}
	
	}
}
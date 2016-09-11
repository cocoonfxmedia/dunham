<?php

// Exit if accessed directly
    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }

    if ( ! class_exists( 'ReduxFramework_digitallaw_icon_select' ) ) {
        class ReduxFramework_digitallaw_icon_select {

            /**
             * Field Constructor.
             * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
             *
             * @since ReduxFramework 1.0.0
             */
            function __construct( $field = array(), $value = '', $parent ) {
                $this->parent = $parent;
                $this->field  = $field;
                $this->value  = $value;
            }

            /**
             * Field Render Function.
             * Takes the vars and outputs the HTML for the field in the settings
             *
             * @since ReduxFramework 1.0.0
             */
            function render() {
				
				/**
				 * Icon Array
				 */
				global $digitallaw_iconsArray;
				$allIcons = array();
				foreach($digitallaw_iconsArray as $icon ){
					$allIcons[ucwords(str_replace('-',' ',$icon))] = $icon;
				}
				$optionsList = '';				
				
				echo '<select id="' . $this->field['id'] . '-select" name="' . $this->field['name'] . '' . $this->field['name_suffix'] . '" class="redux-digitallaw_icon_select-item ' . $this->field['class'] . '" style="width:430px;" rows="6">';
                    
					echo '<option value="">No icon</option>';

                    foreach ( $allIcons as $k => $v ) {
						$v = 'fa '.$v;
						$selected = selected( $this->value, $v, false );
						echo '<option value="' . $v . '"' . $selected . '>fa ' . $v . '</option>';
                    }
                    

                    echo '</select>';
				
					
            } //function

            /**
             * Enqueue Function.
             * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
             *
             * @since ReduxFramework 1.0.0
             */
            function enqueue() {
				
				
				
				wp_enqueue_script(
                    'field-digitallaw_icon_select-js',
                    get_template_directory_uri() . '/inc/redux-framework/redux_custom_fields/digitallaw_icon_select/field_digitallaw_icon_select.js',
					  array( 'jquery' ),
                    time(),
                    true
                );
				
				wp_enqueue_script(
                    'fonticonpicker',
                    get_template_directory_uri() . '/inc/redux-framework/redux_custom_fields/digitallaw_icon_select/fontIconPicker/jquery.fonticonpicker.min.js',
					array( 'jquery' ),
                    time(),
                    true
                );
				wp_enqueue_style(
                    'fonticonpicker',
                    get_template_directory_uri() . '/inc/redux-framework/redux_custom_fields/digitallaw_icon_select/fontIconPicker/css/jquery.fonticonpicker.min.css',
					time(),
                    true
                );
				wp_enqueue_style(
                    'fonticonpicker-theme-grey',
                    get_template_directory_uri() . '/inc/redux-framework/redux_custom_fields/digitallaw_icon_select/fontIconPicker/themes/grey-theme/jquery.fonticonpicker.grey.min.css',
					time(),
                    true
                );
				wp_enqueue_style(
                    'font-awesome',
                    get_template_directory_uri() . '/inc/redux-framework/redux_custom_fields/digitallaw_icon_select/font-awesome/css/font-awesome.min.css',
					time(),
                    true
                );
				
				
				
				
            } //function
        } //class
    }
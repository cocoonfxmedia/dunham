<?php





/**
 *  Add skin color to different elements in Visual Composer
 */
function digitallaw_add_extra_options() {
	// CTA - color
	$param  = WPBMap::getParam( 'vc_cta', 'color' );
	$colors = $param['value'];
	if( is_array($colors) ){
		$colors = array_reverse($colors);
		$colors[__( 'Skin color', 'digitallaw' )] = 'skincolor';
		$param['value']      = array_reverse($colors);
		$param['dependency'] = array(
			'element'            => 'style',
			'value_not_equal_to' => array( 'transparent' )
		);
		$param['std']        = 'skincolor';
		vc_update_shortcode_param( 'vc_cta', $param );
	}

	// CTA - Adding Transparent color in style
	$param  = WPBMap::getParam( 'vc_cta', 'style' );
	$style = $param['value'];
	if( is_array($style) ){
		$style               = array_reverse($style);
		$style[__( 'Transparent', 'digitallaw' )] = 'transparent';
		$param['value']      = array_reverse($style);
		$param['std']        = 'transparent';
		vc_update_shortcode_param( 'vc_cta', $param );
	}

	
	// CTA - button color
	$param  = WPBMap::getParam( 'vc_cta', 'btn_color' );
	$colors = $param['value'];
	if( is_array($colors) ){
		$colors = array_reverse($colors);
		$colors[__( 'Skin color', 'digitallaw' )] = 'skincolor';
		$param['value'] = array_reverse($colors);
		$param['std']   = 'white';
		vc_update_shortcode_param( 'vc_cta', $param );
	}
	$param        = WPBMap::getParam( 'vc_cta', 'btn_button_block' );
	$param['std'] = 'false';
	vc_update_shortcode_param( 'vc_cta', $param );
	
	
	// Button
	$param  = WPBMap::getParam( 'vc_btn', 'color' );
	$colors = $param['value'];
	if( is_array($colors) ){
		$colors = array_reverse($colors);
		$colors[__( 'Skin color', 'digitallaw' )] = 'skincolor';
		$param['value'] = array_reverse($colors);
		$param['std']   = 'skincolor';
		vc_update_shortcode_param( 'vc_btn', $param );
	}
	$param = WPBMap::getParam( 'vc_btn', 'style' );
	$style = $param['value'];
	if( is_array($style) ){
		$style = array_reverse($style);
		$style[__( 'Normal Text', 'digitallaw' )] = 'text';
		$param['value'] = array_reverse($style);
		$param['std']   = 'text';
		vc_update_shortcode_param( 'vc_btn', $param );
	}
	
	// FAQ - Icon color
	$param  = WPBMap::getParam( 'vc_toggle', 'color' );
	$colors = $param['value'];
	if( is_array($colors) ){
		$colors = array_reverse($colors);
		$colors[__( 'Skin color', 'digitallaw' )] = 'skincolor';
		$param['value'] = array_reverse($colors);
		vc_update_shortcode_param( 'vc_toggle', $param );
	}
	
	// Accordion
	$param  = WPBMap::getParam( 'vc_tta_accordion', 'color' );
	$colors = $param['value'];
	if( is_array($colors) ){
		$colors = array_reverse($colors);
		$colors[__( 'Skin color', 'digitallaw' )] = 'skincolor';
		$param['value'] = array_reverse($colors);
		$param['std']   = 'skincolor';
		vc_update_shortcode_param( 'vc_tta_accordion', $param );
	}
	
	// Tabs
	$param  = WPBMap::getParam( 'vc_tta_tabs', 'color' );
	$colors = $param['value'];
	if( is_array($colors) ){
		$colors = array_reverse($colors);
		$colors[__( 'Skin color', 'digitallaw' )] = 'skincolor';
		$param['value'] = array_reverse($colors);
		vc_update_shortcode_param( 'vc_tta_tabs', $param );
	}
	
	// Tours
	$param  = WPBMap::getParam( 'vc_tta_tour', 'color' );
	$colors = $param['value'];
	if( is_array($colors) ){
		$colors = array_reverse($colors);
		$colors[__( 'Skin color', 'digitallaw' )] = 'skincolor';
		$param['value'] = array_reverse($colors);
		vc_update_shortcode_param( 'vc_tta_tour', $param );
	}
	
	// Icon
	$param  = WPBMap::getParam( 'vc_icon', 'color' );
	$colors = $param['value'];
	if( is_array($colors) ){
		$colors = array_reverse($colors);
		$colors[__( 'Skin color', 'digitallaw' )] = 'skincolor';
		$param['value'] = array_reverse($colors);
		$param['std']   = 'skincolor';
		vc_update_shortcode_param( 'vc_icon', $param );
	}
	// Icon Background
	$param  = WPBMap::getParam( 'vc_icon', 'background_color' );
	$colors = $param['value'];
	if( is_array($colors) ){
		$colors = array_reverse($colors);
		$colors[__( 'Skin color', 'digitallaw' )] = 'skincolor';
		$param['value'] = array_reverse($colors);
		$param['std']   = 'skincolor';
		vc_update_shortcode_param( 'vc_icon', $param );
	}
		
	
	
	// Progress Bar - color
	$param  = WPBMap::getParam( 'vc_progress_bar', 'bgcolor' );
	$colors = $param['value'];
	if( is_array($colors) ){
		$colors = array_reverse($colors);
		$colors[__( 'Skin color', 'digitallaw' )] = 'skincolor';
		$param['value'] = array_reverse($colors);
		$param['std']   = 'skincolor';
		vc_update_shortcode_param( 'vc_progress_bar', $param );
	}
	
	// Progress Bar - Colors (new)
	$param  = WPBMap::getParam( 'vc_progress_bar', 'values' );
	if( isset($param['params']) && count($param['params'])>0 ){
		$x = 0;
		foreach($param['params'] as $option){
			if( isset($option['param_name']) && $option['param_name']=='color' && isset($option['heading']) && $option['heading']=='Color' ){
				$value = $param['params'][$x]['value'];
				$value = array_reverse($option['value']);
				$value[__( 'Skin color', 'digitallaw' )] = 'skincolor';
				$value = array_reverse($value);
				$param['params'][$x]['value'] = $value;
			}
			$x++;
		}
		vc_update_shortcode_param( 'vc_progress_bar', $param );
	}
	
	
	/**
	 *  Chanding default value of some elements
	 */
	
	// Setting default value for Tab element
	$param  = WPBMap::getParam( 'vc_tta_tabs', 'shape' );  // Shape
	$param['std']   = 'square';
	vc_update_shortcode_param( 'vc_tta_tabs', $param );
	
	$param  = WPBMap::getParam( 'vc_tta_tabs', 'color' );  // Color
	$param['std']   = 'white';
	vc_update_shortcode_param( 'vc_tta_tabs', $param );
	
	$param  = WPBMap::getParam( 'vc_tta_tabs', 'no_fill_content_area' );  // Do not fill content area?
	$param['std']   = 'true';
	vc_update_shortcode_param( 'vc_tta_tabs', $param );
	
	
	// Setting default value for Tour element
	$param  = WPBMap::getParam( 'vc_tta_tour', 'shape' );  // Shape
	$param['std']   = 'square';
	vc_update_shortcode_param( 'vc_tta_tour', $param );
	
	$param  = WPBMap::getParam( 'vc_tta_tour', 'color' );  // Color
	$param['std']   = 'white';
	vc_update_shortcode_param( 'vc_tta_tour', $param );
	
	$param  = WPBMap::getParam( 'vc_tta_tour', 'no_fill_content_area' );  // Do not fill content area?
	$param['std']   = 'true';
	vc_update_shortcode_param( 'vc_tta_tour', $param );
	
	
	
}
add_action( 'vc_after_init', 'digitallaw_add_extra_options' );





/**
 * Adding extra parameters in VC
 */
function digitallaw_vc_add_extra_param(){
	vc_add_param( 'vc_row', array(
		"type"        => "checkbox",
		"heading"     => esc_html__("Equal Height of each Column", "digitallaw"),
		"description" => esc_html__("This will set equal height of each column in this ROW.", "digitallaw"),
		"param_name"  => "equalheight",
	));
	vc_add_param( 'vc_row', array(
		"type"        => "dropdown",
		"heading"     => esc_html__("Text Color", "digitallaw"),
		"description" => esc_html__("Select text color.", "digitallaw"),
		"param_name"  => "textcolor",
		"value"       => array(
			esc_html__("Default", "digitallaw")     => "default",
			esc_html__("Dark Color", "digitallaw")  => "dark",
			esc_html__("White Color", "digitallaw") => "white",
			esc_html__("Skin Color", "digitallaw")  => "skin",
		),
	));
	vc_add_param( 'vc_row', array(
		"type"        => "dropdown",
		"heading"     => esc_html__("Background Color", "digitallaw"),
		"description" => esc_html__("Select Background Color. If you select color and also select background Video or background Image than the color will be overlay with some opacity.", "digitallaw"),
		"param_name"  => "bgtype",
		"value"       => array(
			esc_html__('Background Color and Image set in DESIGN OPTIONS tab (default)', "digitallaw") => "default",
			esc_html__("Skin Color as Background Color", "digitallaw") => "skin",
			esc_html__("Grey Color as Background Color", "digitallaw") => "grey",
			esc_html__("Dark Color as Background Color", "digitallaw") => "dark",
		),
	));
	
	vc_add_param( 'vc_row', array(
		"type"        => "checkbox",
		"heading"     => esc_html__("Break column in Tablet", "digitallaw"),
		"description" => esc_html__("Break columns in Tablet mode (<996 screen size). This is useful if your content breaks (or not fit) due to columns in tablet mode.", "digitallaw"),
		"param_name"  => "break_in_responsive_996",
	));
	
	
	vc_add_param( 'vc_column', array(
		"type"        => "dropdown",
		"heading"     => esc_html__("Text Color", "digitallaw"),
		"description" => esc_html__("Select text color.", "digitallaw"),
		"param_name"  => "textcolor",
		"value"       => array(
			esc_html__("Default", "digitallaw")     => "default",
			esc_html__("Skin Color", "digitallaw")  => "skin",
			esc_html__("Dark Color", "digitallaw")  => "dark",
			esc_html__("White Color", "digitallaw") => "white",
		),
	));
	vc_add_param( 'vc_column', array(
		"type"        => "dropdown",
		"heading"     => esc_html__("Background Color", "digitallaw"),
		"description" => esc_html__("Select Background Color. If you select color and also select background Image than the color will be overlay with some opacity.", "digitallaw"),
		"param_name"  => "bgcolor",
		"value"       => array(
			esc_html__("Background Color & Image set in \"Design Options\" tab (default)", "digitallaw") => "default",
			esc_html__("Skin Color as Background Color", "digitallaw") => "skin",
			esc_html__("Dark Color as Background Color", "digitallaw") => "dark",
			esc_html__("Grey Color as Background Color", "digitallaw") => "grey",
		),
	));
		
	
}
add_action( 'vc_before_init', 'digitallaw_vc_add_extra_param' );






/**
 * Remove option from ROW element.
 */
if( function_exists('vc_remove_param') ){
	vc_remove_param( "vc_row", "gap" ); 			// remove columns gap param from vc_row
	vc_remove_param( "vc_row", "equal_height" ); 	// remove equal_heighy param from vc_row
}




/**
 * Remove VC Metaboxes
 */
add_action( 'admin_head', 'digitallaw_remove_vc_meta_box' );
function digitallaw_remove_vc_meta_box() {
	remove_meta_box("vc_teaser", "portfolio", "side");
	remove_meta_box("vc_teaser", "page", "side"); 
	remove_meta_box("vc_teaser", "product", "side"); 
}




/*
 *  GLOBAL: Carousel Options
 */
function digitallaw_box_params($boxtype=''){
	
	$boxview = array(
				esc_html__('Row and Column (default)','digitallaw') => 'default',
				esc_html__('Carousel effect','digitallaw')          => 'carousel',
			);
	if( $boxtype=='blog' ){
		$boxview[__('Timeline view','digitallaw')] = 'timeline';
	}
	
	$boxOprions = array(
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'digitallaw' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'digitallaw' ),
			'group'       => esc_html__( 'Box Design', 'digitallaw' ),
		),
		array(
			"type"        => "dropdown",
			"holder"      => "div",
			"class"       => "",
			"heading"     => esc_html__("Box View",'digitallaw'),
			"description" => esc_html__("Select box view. Show as normal row and column or show with carousel effect.",'digitallaw'),
			"param_name"  => "view",
			"value"       => $boxview,
			'group'       => esc_html__( 'Box Design', 'digitallaw' ),
			'std'         => 'default',
		),
		array(
			"type"        => "dropdown",
			"heading"     => esc_html__("Column", "digitallaw"),
			"param_name"  => "column",
			"description" => esc_html__("Select column.", "digitallaw"),
			"value"       => array(
				esc_html__("One Column",    "digitallaw") => "one",
				esc_html__("Two Columns",   "digitallaw") => "two",
				esc_html__("Three Columns", "digitallaw") => "three",
				esc_html__("Four Columns",  "digitallaw") => "four",
				esc_html__("Five Columns",  "digitallaw") => "five",
				esc_html__("Six Columns",   "digitallaw") => "six",
			),
			'std'         => 'three',
			'group'       => esc_html__( 'Box Design', 'digitallaw' ),
			'dependency'  => array(
				'element'   => 'view',
				'value_not_equal_to' => array( 'timeline' ),
			),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Timeline: Group by', 'digitallaw' ),
			'param_name' => 'timeline_groupby',
			'value'      => array(
				esc_html__( 'Monthly grouping', 'digitallaw' ) => 'monthly',
				esc_html__( 'Yearly grouping', 'digitallaw' )  => 'yearly'
			),
			'description' => esc_html__( 'Timeline: Show timeline view in which group by.', 'digitallaw' ),
			'group'       => esc_html__( 'Box Design', 'digitallaw' ),
			'dependency'  => array(
				'element'   => 'view',
				'value'     => array( 'timeline' ),
			),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'std'              => 'monthly',
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Timeline: Box view', 'digitallaw' ),
			'param_name' => 'timeline_boxview',
			'value'      => array(
				esc_html__( 'Simple view - without featured image', 'digitallaw' ) => 'simple',
				esc_html__( 'Simple view - with featured image', 'digitallaw' )    => 'simple_with_fetured',
				esc_html__( 'Box view', 'digitallaw' )                             => 'box',
			),
			'description' => esc_html__( 'Timeline: Show timeline view in which group by.', 'digitallaw' ),
			'group'       => esc_html__( 'Box Design', 'digitallaw' ),
			'dependency'  => array(
				'element'   => 'view',
				'value'     => array( 'timeline' ),
			),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'std'              => 'monthly',
		),
		
		// Auto Play
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Carousel: Autoplay', 'digitallaw' ),
			'param_name' => 'carousel_autoplay',
			'value'      => array(
				esc_html__( 'Yes', 'digitallaw' ) => '1',
				esc_html__( 'No', 'digitallaw' )  => '0'
			),
			'description' => esc_html__( 'Carousel Effect: Autoplay', 'digitallaw' ),
			'group'       => esc_html__( 'Box Design', 'digitallaw' ),
			'dependency'  => array(
				'element'   => 'view',
				//'value_not_equal_to' => array( 'ids', 'custom' ),
				'value'     => array( 'carousel' ),
			),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'std'              => '1',
		),
		
		// autoplaySpeed
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Carousel: autoplaySpeed', 'digitallaw' ),
			'param_name'  => 'carousel_autoplayspeed',
			'description' => esc_html__( 'Carousel Effect: autoplay speed. Inert numbers only. Default value is "800".', 'digitallaw' ),
			'group'       => esc_html__( 'Box Design', 'digitallaw' ),
			'dependency'  => array(
				'element'   => 'view',
				'value'     => array( 'carousel' ),
			),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'std'              => '800',
		),
		
		// autoplayTimeout
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Carousel: autoplayTimeout (Pause time)', 'digitallaw' ),
			'param_name'  => 'carousel_autoplaytimeout',
			'description' => esc_html__( 'Carousel Effect: Autoplay interval timeout. Default value is "4500".', 'digitallaw' ),
			'group'       => esc_html__( 'Box Design', 'digitallaw' ),
			'dependency'  => array(
				'element'   => 'view',
				'value'     => array( 'carousel' ),
			),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'std'              => '4500',
		),
		
		// loop
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Carousel: Loop Item', 'digitallaw' ),
			'param_name' => 'carousel_loop',
			'value'      => array(
				esc_html__( 'No', 'digitallaw' )  => '0',
				esc_html__( 'Yes', 'digitallaw' ) => '1',
			),
			'description' => esc_html__( 'Carousel Effect: Inifnity loop. Duplicate last and first items to get loop illusion.', 'digitallaw' ).'<br><strong>'.esc_html__( 'NOTE:', 'digitallaw' ).' </strong> '.esc_html__( 'If you select NO than the carousel will rewind all and start from 1st item. Also this will work if you enabled "Autoplay".', 'digitallaw' ),
			'group'       => esc_html__( 'Box Design', 'digitallaw' ),
			'dependency'  => array(
				'element'   => 'view',
				'value'     => array( 'carousel' ),
			),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'std'              => '0',
		),
		
		
		
		array(
			'type'       => 'animation_style',
			'heading'    => esc_html__( 'Animation In', 'digitallaw' ),
			'param_name' => 'carousel_animatein',
			'group'      => esc_html__( 'Box Design', 'digitallaw' ),
			'settings'   => array(
				'type'     => array( 'in', 'other' ),
			),
			'dependency' => array(
				'element'   => 'view',
				'value'     => array( 'carousel' ),
			),
			'description' => esc_html__( 'Select "animation in" for page transition.', 'digitallaw' ) . '<br><strong>' . esc_html__('NOTE:','digitallaw') . '</strong>  ' . esc_html__('Animate functions work only with "One Column" option and only in browsers that support perspective property.','digitallaw'),
		),
		array(
			'type'       => 'animation_style',
			'heading'    => esc_html__( 'Animation Out', 'digitallaw' ),
			'param_name' => 'carousel_animateout',
			'group'      => esc_html__( 'Box Design', 'digitallaw' ),
			'settings'   => array(
				'type'     => array( 'out' ),
			),
			'dependency' => array(
				'element'   => 'view',
				'value'     => array( 'carousel' ),
			),
			'description' => esc_html__( 'Select "animation out" for page transition.', 'digitallaw' ) . '<br><strong>' . esc_html__('NOTE:','digitallaw') . '</strong>  ' . esc_html__('Animate functions work only with "One Column" option and only in browsers that support perspective property.','digitallaw'),
		),
		
		// Dots
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Carousel: dots', 'digitallaw' ),
			'param_name' => 'carousel_dots',
			'value'      => array(
				esc_html__('No', 'digitallaw') => 'false',
				esc_html__('Yes', 'digitallaw') => 'true',
				
			),
			'description' => esc_html__( 'Carousel Effect: Show dots navigation.', 'digitallaw' ),
			'group'       => esc_html__( 'Box Design', 'digitallaw' ),
			'dependency'  => array(
				'element'   => 'view',
				//'value_not_equal_to' => array( 'ids', 'custom' ),
				'value'     => array( 'carousel' ),
			),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'std'              => 'false',
		),
		// Next/Prev links
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Carousel: Next/Prev Links (nav)', 'digitallaw' ),
			'param_name' => 'carousel_nav',
			'value'      => array(
				esc_html__('Above Carousel', 'digitallaw')       => 'above',
				esc_html__('Before / After boxes', 'digitallaw') => 'true',
				esc_html__('Hide', 'digitallaw')                 => 'false',
				
			),
			'description' => esc_html__( 'Carousel Effect: Show dots navigation.', 'digitallaw' ),
			'group'       => esc_html__( 'Box Design', 'digitallaw' ),
			'dependency'  => array(
				'element'   => 'view',
				'value'     => array( 'carousel' ),
			),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'std'              => 'above',
		),
		
		
		
		// autoplayHoverPause
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Carousel: autoplayHoverPause', 'digitallaw' ),
			'param_name' => 'carousel_autoplayHoverPause',
			'value'      => array(
				esc_html__('Yes', 'digitallaw') => 'true',
				esc_html__('No', 'digitallaw')  => 'false',
			),
			'description' => esc_html__( 'Carousel Effect: Pause on mouse hover.', 'digitallaw' ),
			'group'       => esc_html__( 'Box Design', 'digitallaw' ),
			'dependency'  => array(
				'element'   => 'view',
				'value'     => array( 'carousel' ),
			),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'std'              => 'true',
		),
		
		
	);
	
	
	
	
	if( $boxtype=='blog' ){
			
		// Masonry view for Blog only
		$boxOprions[] = array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Enable Masonry View', 'digitallaw' ),
			'param_name'  => 'masonry',
			'description' => esc_html__( 'Check this checkbox to enable masonry view. If enabled, it will auto-adjust box position with different heights automatically.', 'digitallaw' ),
			'std'         => '',
			'group'       => esc_html__( 'Box Design', 'digitallaw' ),
			'dependency'  => array(
				'element'   => 'view',
				'value'     => array( 'default' ),
			),
		);
		
	}
	
	return $boxOprions;
}





/*
 *  GLOBAL: Heading Options in Visual Composer element
 */
function digitallaw_vc_heading_params($data=''){
	$h2_custom_heading = vc_map_integrate_shortcode( 'vc_custom_heading', 'h2_', esc_html__( 'Heading', 'digitallaw' ),
		array(
			'exclude' => array(
				'text',
				'source',
				'css',
				'el_class',
			),
		),
		array(
			'element' => 'use_custom_fonts_h2',
			'value'   => 'true',
		)
	);


	// This is needed to remove custom heading _tag and _align options.
	if ( is_array( $h2_custom_heading ) && ! empty( $h2_custom_heading ) ) {
		foreach ( $h2_custom_heading as $key => $param ) {
			if ( is_array( $param ) && isset( $param['type'] ) && $param['type'] == 'font_container' ) {
				if ( isset( $param['settings'] ) && is_array( $param['settings'] ) && isset( $param['settings']['fields'] ) ) {
					$sub_key = array_search( 'tag', $param['settings']['fields'] );
					if ( false !== $sub_key ) {
						unset( $h2_custom_heading[ $key ]['settings']['fields'][ $sub_key ] );
					} else if ( isset( $param['settings']['fields']['tag'] ) ) {
						unset( $h2_custom_heading[ $key ]['settings']['fields']['tag'] );
					}
					$sub_key = array_search( 'text_align', $param['settings']['fields'] );
					if ( false !== $sub_key ) {
						unset( $h2_custom_heading[ $key ]['settings']['fields'][ $sub_key ] );
					} else if ( isset( $param['settings']['fields']['text_align'] ) ) {
						unset( $h2_custom_heading[ $key ]['settings']['fields']['text_align'] );
					}
				}
			}
		}
	}


	$h4_custom_heading = vc_map_integrate_shortcode( 'vc_custom_heading', 'h4_', esc_html__( 'Subheading', 'digitallaw' ),
		array(
			'exclude' => array(
				'text',
				'source',
				'css',
				'el_class',
			),
		),
		array(
			'element' => 'use_custom_fonts_h4',
			'value' => 'true',
		)
	);

	// This is needed to remove custom heading _tag and _align options.
	if ( is_array( $h4_custom_heading ) && ! empty( $h4_custom_heading ) ) {
		foreach ( $h4_custom_heading as $key => $param ) {
			if ( is_array( $param ) && isset( $param['type'] ) && $param['type'] == 'font_container' ) {
				if ( isset( $param['settings'] ) && is_array( $param['settings'] ) && isset( $param['settings']['fields'] ) ) {
					$sub_key = array_search( 'tag', $param['settings']['fields'] );
					if ( false !== $sub_key ) {
						unset( $h4_custom_heading[ $key ]['settings']['fields'][ $sub_key ] );
					} else if ( isset( $param['settings']['fields']['tag'] ) ) {
						unset( $h4_custom_heading[ $key ]['settings']['fields']['tag'] );
					}
					$sub_key = array_search( 'text_align', $param['settings']['fields'] );
					if ( false !== $sub_key ) {
						unset( $h4_custom_heading[ $key ]['settings']['fields'][ $sub_key ] );
					} else if ( isset( $param['settings']['fields']['text_align'] ) ) {
						unset( $h4_custom_heading[ $key ]['settings']['fields']['text_align'] );
					}
				}
			}
		}
	}

	// Removing JUSTIFY from text align option
	$text_align = getVcShared( 'text align' );
	unset($text_align['Justify']);
	
	
	
	$params = array_merge(
		array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Heading', 'digitallaw' ),
				'admin_label' => true,
				'param_name'  => 'h2',
				'save_always' => true,
				'value'       => esc_html__( 'Welcome', 'digitallaw' ),
				'description' => esc_html__( 'Enter text for heading line.', 'digitallaw' ),
				'edit_field_class' => 'vc_col-sm-9 vc_column',
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Use custom font?', 'digitallaw' ),
				'param_name' => 'use_custom_fonts_h2',
				'description' => esc_html__( 'Enable Google fonts.', 'digitallaw' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column',
			),

		),
		$h2_custom_heading,
		array(
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Subheading', 'digitallaw' ),
				'param_name'       => 'h4',
				'description'      => esc_html__( 'Enter text for subheading line.', 'digitallaw' ),
				'edit_field_class' => 'vc_col-sm-9 vc_column',
			),
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Use custom font?', 'digitallaw' ),
				'param_name'       => 'use_custom_fonts_h4',
				'description'      => esc_html__( 'Enable custom font option.', 'digitallaw' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column',
			),
		),
		$h4_custom_heading,
		array(
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Text alignment', 'digitallaw' ),
				'param_name'  => 'txt_align',
				'value'       => $text_align, // default left
				'description' => esc_html__( 'Select text alignment.', 'digitallaw' ),
				'std'         => 'left',
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Separator Line With Heading', 'digitallaw' ),
				'param_name'  => 'heading_sep',
				'value'       => array(
						esc_html__('Yes', 'digitallaw') => 'yes',
						esc_html__('No', 'digitallaw')  => 'no',
				),
				'description' => esc_html__( 'Show line with heading.', 'digitallaw' ),
				'std'         => 'yes',
			)
		)
	);
	
	
	
	
	// Setting default font settings.. Make sure you change this when change default value in Redux Options
	$i = 0;
	foreach( $params as $param ){
		$param_name = (isset($param['param_name'])) ? $param['param_name'] : '' ;
		if( $param_name == 'h2_google_fonts' ){
			$params[$i]['std'] = 'font_family:Arimo%3Aregular%2Citalic%2C700%2C700italic|font_style:700%20bold%20regular%3A700%3Anormal';
		} else if( $param_name == 'h4_google_fonts' ){
			$params[$i]['std'] = 'font_family:Lato%3A100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C700%2C700italic%2C900%2C900italic|font_style:300%20light%20regular%3A300%3Anormal';
		}
		$i++;
	}; // Foreach
	
	
	
	return $params;
}




/**
 *  Adding custom elements in Visual Composer
 */
add_action( 'vc_after_init', 'digitallaw_vc_custom_element_servicebox', 21 );
add_action( 'init', 'digitallaw_vc_custom_element_blogbox' );	
add_action( 'init', 'digitallaw_vc_custom_element_portfoliobox' );
add_action( 'init', 'digitallaw_vc_custom_element_team' );
add_action( 'init', 'digitallaw_vc_custom_element_testimonial' );
add_action( 'init', 'digitallaw_vc_custom_element_clients' );
add_action( 'vc_after_init', 'digitallaw_vc_custom_element_facts_in_digits' );
if( function_exists('latest_tweets_render') ){
	add_action( 'init', 'digitallaw_vc_custom_element_twitterbox' );
}
add_action( 'init', 'digitallaw_vc_custom_element_icon_separator' );
add_action( 'init', 'digitallaw_vc_custom_element_heading' );
add_action( 'init', 'digitallaw_vc_custom_element_contactbox' );
add_action( 'init', 'digitallaw_vc_custom_element_list' );
add_action( 'init', 'digitallaw_vc_custom_element_eventsbox' );
add_action( 'init', 'digitallaw_vc_custom_element_socialbox' );









/**
 *  ThemeMount: Social Box
 */
function digitallaw_vc_custom_element_socialbox(){
	
	// Social services
	$sociallist = array(
		esc_html__('Select service','digitallaw') => '',
		'Twitter'      => 'twitter',
		'YouTube'      => 'youtube',
		'Flickr'       => 'flickr',
		'Facebook'     => 'facebook',
		'LinkedIn'     => 'linkedin',
		'Google+'      => 'gplus',
		'yelp'         => 'yelp',
		'Dribbble'     => 'dribbble',
		'Pinterest'    => 'pinterest',
		'Podcast'      => 'podcast',
		'Instagram'    => 'instagram',
		'Xing'         => 'xing',
		'Vimeo'        => 'vimeo',
		'VK'           => 'vk',
		'Houzz'        => 'houzz',
		'Issuu'        => 'issuu',
		'Google Drive' => 'google-drive',
		'Rss Feed'     => 'rss',
	);

	$params = array_merge(
		digitallaw_vc_heading_params(),
		array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'digitallaw' ),
				'param_name'  => 'el_class',
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'digitallaw' ),
			),
			array(
				'type'        => 'param_group',
				'heading'     => esc_html__( 'Social Services List', 'digitallaw' ),
				'param_name'  => 'socialservices',
				'description' => esc_html__( 'Select social service and add URL for it.', 'digitallaw' ).'<br><strong>'.esc_html__('NOTE:','digitallaw').'</strong> '.esc_html__("You don't need to add URL if you are selecting 'RSS' in the social service",'digitallaw'),
				'group'       => esc_html__( 'Social Services', 'digitallaw' ),
				'params'     => array(
					array( // First social service
						'type'        => 'dropdown',
						'heading'     => esc_html__( 'Select Social Service', 'digitallaw' ),
						'param_name'  => 'servicename',
						'std'         => 'none',
						'value'       => $sociallist,
						'description' => esc_html__( 'Select social service', 'digitallaw' ),
						'group'       => esc_html__( 'Social Services', 'digitallaw' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-4 vc_column',
					),
					array(
						'type'        => 'textarea',
						'heading'     => esc_html__( 'Social URL', 'digitallaw' ),
						'param_name'  => 'servicelink',
						'dependency'  => array(
							'element'            => 'servicename',
							'value_not_equal_to' => array( 'rss' )
						),
						'value'       => '',
						'description' => esc_html__( 'Fill social service URL', 'digitallaw' ),
						'group'       => esc_html__( 'Social Services', 'digitallaw' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-8 vc_column',
					),
				),
			),
			array( // First social service
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Select column', 'digitallaw' ),
				'param_name'  => 'column',
				'value'       => array(
					esc_html__('One column','digitallaw')   => 'one',
					esc_html__('Two column','digitallaw')   => 'two',
					esc_html__('Three column','digitallaw') => 'three',
					esc_html__('Four column','digitallaw')  => 'four',
					esc_html__('Five column','digitallaw')  => 'five',
					esc_html__('Six column','digitallaw')   => 'six',
				),
				'std'         => 'six',
				'description' => esc_html__( 'Select how many column will show the social icons', 'digitallaw' ),
				'group'       => esc_html__( 'Social Services', 'digitallaw' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array( // First social service
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Social icon size', 'digitallaw' ),
				'param_name'  => 'iconsize',
				'std'         => 'large',
				'value'       => array(
					esc_html__('Small icon','digitallaw')  => 'small',
					esc_html__('Medium icon','digitallaw') => 'medium',
					esc_html__('Large icon','digitallaw')  => 'large',
				),
				'description' => esc_html__( 'Select social icon size', 'digitallaw' ),
				'group'       => esc_html__( 'Social Services', 'digitallaw' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
		)
	);
	
	global $digitallaw_sc_params_socialbox;
	$digitallaw_sc_params_socialbox = $params;
	
	vc_map( array(
		'name'        => esc_html__( 'ThemeMount Social Box', 'digitallaw' ),
		'base'        => 'tm-socialbox',
		"icon"        => "icon-thememount-vc",
		'category'    => esc_html__( 'ThemeMount Special Elements', 'digitallaw' ),
		'params'      => $params,
	) );
}




/**
 *  ThemeMount: Service Box
 */
function digitallaw_vc_custom_element_servicebox(){

	
	$bgcolor_custom = array();
	$bgcolor_custom[__( 'Transparent', 'digitallaw' )] = 'transparent';
	$bgcolor_custom[__( 'Skin color', 'digitallaw' )]  = 'skincolor';
	$boxcolor =   array_merge( $bgcolor_custom , getVcShared( 'colors-dashed' ) ) ;
	
	
	// Icon options
	$iconOptions    = vc_map_integrate_shortcode( 'vc_icon', 'i_', esc_html__( 'Icon', 'digitallaw' ),
		array(
			'exclude' => array( 'align', 'el_class', 'css_animation', 'link', 'css' ),
		)/*,
		array(
			'element'   => 'icon_type',
			'value' 	=> 'icon',
		)*/
	);
	
	$iconOptionsNew = array();
	
	$iconOptionsNew[] = array(
		'type'        => 'dropdown',
		'param_name'  => 'main_icon_type',
		'heading'     => esc_html__( 'Select Icon Type', 'digitallaw' ),
		'description' => esc_html__( 'Icon can be "Icon" or Image.', 'digitallaw' ),
		'group' 	 	=> esc_html__('Icon','digitallaw'),
		'value'       => array( 
							esc_html__( 'Icon', 'digitallaw' ) 	=> 'icon',
							esc_html__( 'Image', 'digitallaw' ) => 'image',
						),
		'std'		  => 'icon',
	);
	
	
	
	
	
	
	
	
	$i              = 0;
	foreach ($iconOptions as $key => $value){
		
		// adding column class in icon picker
		if( $value['param_name']=='i_type' || substr($value['param_name'],0, 7 ) == 'i_icon_' ){
			$value['edit_field_class'] = 'vc_col-sm-4 vc_column';
		}
		
		// Image as icon (for custom icon)
		if ( isset($value['param_name']) && $value['param_name']=='i_color'){
			$iconOptionsNew[] = array(
				'type' 			=> 'attach_image',
				'heading' 		=> esc_html__( 'Image as icon', 'digitallaw' ),
				'param_name' 	=> 'icon_image',
				'value' 		=> '',
				'description' 	=> esc_html__( 'Select image from media library.', 'digitallaw' ) . '<br><span class="tm-strong-info"><strong>'.esc_html__( 'NOTE:', 'digitallaw' ).' </strong> '. esc_html__( 'The image will appear only if you selected "Image" in above "Select Icon Type" option.', 'digitallaw' ).'</span>',
				'group' 	 	=> esc_html__('Icon','digitallaw'),
				'edit_field_class' => 'vc_col-sm-4 vc_column tm-left-border',
				/*'dependency' 	=> array(
					'element' 	=> 'icon_type',
					'value' 	=> 'image',
				),*/
			);
		}
		
		//merging origial option
		$iconOptionsNew[] = $value;
		
		if ( isset($value['param_name']) && $value['param_name']=='i_background_style'){
			$iconOptionsNew[] = array(
				'type'        => 'checkbox',
				'param_name'  => 'i_on_border',
				'heading'     => esc_html__( 'Place icon on border?', 'digitallaw' ),
				'description' => esc_html__( 'Display icon on call to action element border.', 'digitallaw' ),
				'group'       => esc_html__( 'Icon', 'digitallaw' ),
				'value'       => array( esc_html__( 'Yes', 'digitallaw' ) => 'yes' ),
				'std'		  => false,
				/*'dependency'  => array(
					'element'   => 'icon_type',
					'value' 	=> 'icon',
				),*/
			);
			$iconOptionsNew[] = array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Icon/Image Hower Effect', 'digitallaw' ) . '?',
				'description' => esc_html__( 'Select YES if you like to apply hover effect to the icon or image.', 'digitallaw' ) . '<br>' . esc_html__( 'Please note that the HOVER color will be SKIN Color and normal color will be the "Background Color" selected below (apply to icon only).', 'digitallaw' )  ,
				'param_name'  => 'icon_hover',
				'value'       => array(
					esc_html__( 'No', 'digitallaw' )  => '',
					esc_html__( 'Yes', 'digitallaw' ) => 'yes',
				),
				'std' 		  => '',
				'dependency'  => array(
					'element'   => 'i_background_style',
					'value'     => array( 'rounded-outline' ),
				),
				'group' => 'Icon'
			);
		}
		
		
		
		
		
		
		$i++;
	}
	$iconOptions = $iconOptionsNew;
	
	
	
	
	$imageOptions = array(
		array(
			'type'        => 'dropdown',
			'param_name'  => 'icon_type',
			'heading'     => esc_html__( 'Show icon or hero image', 'digitallaw' ),
			'description' => esc_html__( 'Show hero image instead of icon. This will remove icon and will show image at top-center position.', 'digitallaw' ),
			'value'       => array( 
								esc_html__( 'Show icon', 'digitallaw' )  => 'icon',
								esc_html__( 'Show hero image', 'digitallaw' ) => 'image',
							),
			'std'		  => 'icon',
		),
		array(
			'type' 			=> 'attach_image',
			'heading' 		=> esc_html__( 'Select hero image', 'digitallaw' ),
			'param_name' 	=> 'images',
			'value' 		=> '',
			'description' 	=> esc_html__( 'Select image from media library.', 'digitallaw' ),
			//'group' 	 	=> esc_html__('Image','digitallaw'),
			'dependency' 	=> array(
				'element' 	=> 'icon_type',
				'value' 	=> 'image',
			)
		),
	);
	
	
	
	
	
	
	$params = array_merge(
		digitallaw_vc_heading_params(),
		array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Box Border Shape', 'digitallaw' ),
				'param_name' => 'shape',
				'std'        => 'none',
				'value'      => array(
					esc_html__( 'None', 'digitallaw' )    => 'none',
					esc_html__( 'Square', 'digitallaw' )  => 'square',
					esc_html__( 'Rounded', 'digitallaw' ) => 'rounded',
					esc_html__( 'Round', 'digitallaw' )   => 'round',
				),
				'description' => esc_html__( 'Select Service Box shape.', 'digitallaw' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Box Style', 'digitallaw' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Transparent', 'digitallaw' ) => 'transparent',
					esc_html__( 'Flat', 'digitallaw' )        => 'flat',
					esc_html__( 'Outline', 'digitallaw' )     => 'outline',
					esc_html__( '3d', 'digitallaw' )          => '3d',
					esc_html__( 'Custom', 'digitallaw' )      => 'custom',
				),
				'std'         => 'transparent',
				'description' => esc_html__( 'Select Service Box display style.', 'digitallaw' ),
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => esc_html__( 'Background color', 'digitallaw' ),
				'param_name'  => 'custom_background',
				'description' => esc_html__( 'Select custom background color.', 'digitallaw' ),
				'dependency'  => array(
					'element'   => 'style',
					'value'     => array( 'custom' )
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => esc_html__( 'Text color', 'digitallaw' ),
				'param_name'  => 'custom_text',
				'description' => esc_html__( 'Select custom text color.', 'digitallaw' ),
				'dependency'  => array(
					'element'   => 'style',
					'value'     => array( 'custom' )
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Background Color', 'digitallaw' ),
				'param_name'  => 'color',
				'value'       => getVcShared( 'colors-dashed' ),
				'std'         => 'grey',
				'description'        => esc_html__( 'Select color schema.', 'digitallaw' ),
				'param_holder_class' => 'vc_colored-dropdown vc_cta3-colored-dropdown',
				'dependency'  => array(
					'element'   => 'style',
					'value'     => array( 'flat', 'outline', '3d' )
				),
			),
			array(
				'type'       => 'textarea_html',
				'heading'    => esc_html__( 'Text', 'digitallaw' ),
				'param_name' => 'content',
				'value'      => esc_html__( 'I am promo text. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'digitallaw' )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Add button', 'digitallaw' ) . '?',
				'description' => esc_html__( 'Add button to Service Box.', 'digitallaw' ),
				'param_name'  => 'add_button',
				'value'       => array(
					esc_html__( 'No', 'digitallaw' )  => '',
					esc_html__( 'Yes', 'digitallaw' ) => 'bottom',
				),
				'std' 		  => '',
				
			),
		),
		vc_map_integrate_shortcode( 'vc_btn', 'btn_', esc_html__( 'Button', 'digitallaw' ),
			array(
			'exclude' => array(
				'align',
				'button_block',
				'el_class',
				'css_animation',
				'css',
			),
		),
			array(
				'element' => 'add_button',
				'not_empty' => true,
			)
		),
		array(
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Icon position', 'digitallaw' ),
				'description' => esc_html__( 'Icon position in the Service box.', 'digitallaw' ),
				'param_name'  => 'add_icon',
				'std'         => 'top',
				'value'       => array(
					esc_html__( 'Top Center', 'digitallaw' )          => 'top',
					esc_html__( 'Left', 'digitallaw' )                => 'left',
					esc_html__( 'Right', 'digitallaw' )               => 'right',
					esc_html__( 'Top Left Corner', 'digitallaw' )     => 'topleft',
					esc_html__( 'Top Right Corner', 'digitallaw' )    => 'topright',
					esc_html__( 'Bottom', 'digitallaw' )              => 'bottom',
					esc_html__( 'Bottom Left Corner', 'digitallaw' )  => 'bottomleft',
					esc_html__( 'Bottom Right Corner', 'digitallaw' ) => 'bottomright',
				),
			),
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__("Box Hover Effect",'digitallaw'),
				"param_name" => "hover",
				"value"      => array(
					esc_html__('None','digitallaw')         => 'none',
					esc_html__('Float Shadow','digitallaw') => 'hvr-float-shadow',
					esc_html__('Grow','digitallaw')         => 'hvr-grow',
					esc_html__('Shrink','digitallaw')       => 'hvr-shrink',
					esc_html__('Pulse','digitallaw')        => 'hvr-pulse',
					esc_html__('Pulse Grow','digitallaw')   => 'hvr-pulse-grow',
					esc_html__('Pulse Shrink','digitallaw') => 'hvr-pulse-shrink',
					esc_html__('Push','digitallaw')         => 'hvr-push',
					esc_html__('Pop','digitallaw')          => 'hvr-pop',
					esc_html__('Bounce In','digitallaw')    => 'hvr-bounce-in',
					esc_html__('Bounce Out','digitallaw')   => 'hvr-bounce-out',
					esc_html__('Rotate','digitallaw')       => 'hvr-rotate',
					esc_html__('Grow Rotate','digitallaw')  => 'hvr-grow-rotate',
					esc_html__('Float','digitallaw')        => 'hvr-float',
					esc_html__('Sink','digitallaw')         => 'hvr-sink',
					esc_html__('Bob','digitallaw')          => 'hvr-bob',
					esc_html__('Hang','digitallaw')         => 'hvr-hang',
					esc_html__('Skew','digitallaw')         => 'hvr-skew',
					esc_html__('Skew Forward','digitallaw') => 'hvr-skew-forward',
					esc_html__('Wobble Horizontal','digitallaw')      => 'hvr-wobble-horizontal',
					esc_html__('Wobble Vertical','digitallaw')        => 'hvr-wobble-vertical',
					esc_html__('Wobble To Bottom Right','digitallaw') => 'hvr-wobble-to-bottom-right',
					esc_html__('Wobble To Top Right','digitallaw')    => 'hvr-wobble-to-top-right',
					esc_html__('Wobble Top','digitallaw')             => 'hvr-wobble-top',
					esc_html__('Wobble Bottom','digitallaw')          => 'hvr-wobble-bottom',
					esc_html__('Wobble Skew','digitallaw')            => 'hvr-wobble-skew',
					esc_html__('Buzz','digitallaw')                   => 'hvr-buzz',
					esc_html__('Buzz Out','digitallaw')               => 'hvr-buzz-out',
				),
				"description" => esc_html__("Select hover effect.",'digitallaw'),
				'std'         => 'none',
			)
		),
		$iconOptions,
		$imageOptions,
		array(
			/*array(
				'type' 			=> 'attach_image',
				'heading' 		=> esc_html__( 'Hero Image', 'digitallaw' ),
				'param_name' 	=> 'images',
				'value' 		=> '',
				'description' 	=> esc_html__( 'Select image from media library.', 'digitallaw' ) . ' ' . esc_html__( 'This image will appear above the content and as center only.', 'digitallaw' ),
				'dependency' 	=> array(
					'element' 	=> 'icon_type',
					'value' 	=> 'image',
				),
			),*/
			// cta3
			vc_map_add_css_animation(),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'digitallaw' ),
				'param_name'  => 'el_class',
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'digitallaw' )
			),
		),
		
		array(
			array(
				'type'       => 'css_editor',
				'heading'    => esc_html__( 'CSS box', 'digitallaw' ),
				'param_name' => 'css',
				'group'      => esc_html__( 'Design Options', 'digitallaw' )
			)
		)
		
	);
	
	// Changing modifying, adding extra options
	$i = 0;
	foreach( $params as $param ){
		
		$param_name = (isset($param['param_name'])) ? $param['param_name'] : '' ;
		
		if( $param_name == 'btn_style' ){
			$style = $param['value'];
			if( is_array($style) ){
				$style = array_reverse($style);
				$style[__( 'Normal Text', 'digitallaw' )] = 'text';
				$params[$i]['value'] = array_reverse($style);
				$params[$i]['std']   = 'text';
			}
			
		} else if( $param_name == 'btn_color' ){
			$colors = $param['value'];
			if( is_array($colors) ){
				$colors = array_reverse($colors);
				$colors[__( 'Skin color', 'digitallaw' )] = 'skincolor';
				$params[$i]['value'] = array_reverse($colors);
				$params[$i]['std']   = 'skincolor';
			}
		
		} else if( $param_name == 'color' ){
			$colors = $param['value'];
			if( is_array($colors) ){
				$colors = array_reverse($colors);
				$colors[__( 'Skin color', 'digitallaw' )] = 'skincolor';
				$params[$i]['value'] = array_reverse($colors);
				$params[$i]['std']   = 'grey';
			}
		
		} else if( $param_name == 'btn_shape' ){
			$params[$i]['dependency'] = array(
				'element'            => 'btn_style',
				'value_not_equal_to' => array( 'text' )
			);
		} else if( $param_name == 'btn_title' ){
			$params[$i]['std'] = esc_html__( 'Read More', 'digitallaw' );
				
		} else if( $param_name == 'txt_align' ){
			$params[$i]['std'] = 'center';
			
		} else if( $param_name == 'btn_add_icon' ){
			$params[$i]['std']   = false;
			
		} else if( $param_name == 'i_type' ){
			$params[$i]['std'] = 'fontawesome';
			$params[$i]['description'] =  esc_html__( 'Select icon library.', 'digitallaw' ) . '<br><span class="tm-strong-info"><strong>'.esc_html__( 'NOTE:', 'digitallaw' ).' </strong> '. esc_html__( 'The icon will appear only if you selected "Icon" in above "Select Icon Type" option.', 'digitallaw' ).'</span>';
			
		} else if( $param_name == 'i_icon_fontawesome' ){
			$params[$i]['std'] = 'fa fa-thumbs-o-up';
			
		} else if( $param_name == 'i_icon_openiconic' ){
			$params[$i]['std'] = 'vc-oi vc-oi-dial';
			
		} else if( $param_name == 'i_icon_typicons' ){
			$params[$i]['std'] = 'typcn typcn-adjust-brightness';
			
		} else if( $param_name == 'i_icon_entypo' ){
			$params[$i]['std'] = 'entypo-icon entypo-icon-note';
			
		} else if( $param_name == 'i_icon_linecons' ){
			$params[$i]['std'] = 'vc_li vc_li-heart';
			
		} else if( $param_name == 'i_color' ){
			$params[$i]['dependency'] = array(
				'element'   => 'icon_type',
				'value'     => array( 'icon' )
			);
			
			
		} else if( $param_name == 'i_background_style' ){
			$params[$i]['value'][__( 'None', 'digitallaw' )] = 'none';
			$params[$i]['heading'] = esc_html__( 'IconBackground/Image shape', 'digitallaw' );
			$params[$i]['std']     = 'rounded-outline';
			
		} else if( $param_name == 'i_on_border' ){
			$params[$i]['heading'] = esc_html__( 'Place icon/image on border?', 'digitallaw' );
			
		} else if( $param_name == 'i_background_color' ){
			$params[$i]['value'][__( 'None', 'digitallaw' )] = 'none';
			$params[$i]['heading'] = esc_html__( 'Icon background color (for icon only)', 'digitallaw' );
			$params[$i]['std']     = 'grey';
			
		
		} else if( $param_name == 'i_size' ){
			$params[$i]['heading'] = esc_html__( 'Icon/Image size', 'digitallaw' );
			$params[$i]['std']     = 'xl';
			
		} else if( $param_name == 'h2_google_fonts' ){
			$params[$i]['std'] = 'font_family:Arimo%3Aregular%2Citalic%2C700%2C700italic|font_style:700%20bold%20regular%3A700%3Anormal';
		
		} else if( $param_name == 'h4_google_fonts' ){
			$params[$i]['std'] = 'font_family:Lato%3A100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C700%2C700italic%2C900%2C900italic|font_style:300%20light%20regular%3A300%3Anormal';
			
		} else if( $param_name == 'heading_sep' ){
			$params[$i]['std'] = 'no';
		}
		
		$i++;
	} // Foreach
	
	

	
	global $digitallaw_sc_params_servicebox;
	$digitallaw_sc_params_servicebox = $params;
	
	
	vc_map( array(
		'name'        => esc_html__( 'ThemeMount Service Box', 'digitallaw' ),
		'base'        => 'tm-servicebox',
		"icon"        => "icon-thememount-vc",
		'category'    => esc_html__( 'ThemeMount Special Elements', 'digitallaw' ),
		'params'      => $params,
	) );
	
}





/**
 *  ThemeMount: Blog Box
 */
function digitallaw_vc_custom_element_blogbox(){

	$postCatList    = get_categories( array('hide_empty'=>false) );
	
	$catList = array();
	foreach($postCatList as $cat){
		$catList[ esc_html($cat->name) . ' (' . $cat->count . ')' ] = $cat->slug;
	}
	
	$colors_arr = array(
		esc_html__( 'Grey', 'digitallaw' )      => 'wpb_button',
		esc_html__( 'Blue', 'digitallaw' )      => 'btn-primary',
		esc_html__( 'Turquoise', 'digitallaw' ) => 'btn-info',
		esc_html__( 'Green', 'digitallaw' )     => 'btn-success',
		esc_html__( 'Orange', 'digitallaw' )    => 'btn-warning',
		esc_html__( 'Red', 'digitallaw' )       => 'btn-danger',
		esc_html__( 'Black', 'digitallaw' )     => "btn-inverse"
	);

	
	
	$allParams = array(
			array(
				"type"        => "checkbox",
				"heading"     => esc_html__("From Category", "digitallaw"),
				"description" => esc_html__("If you like to show posts from selected category than select the category here.", "digitallaw") . esc_html__("The brecket number shows how many posts there in the category.", "digitallaw"),
				"param_name"  => "category",
				"value"       => $catList,
			),
			array(
				"type"        => "dropdown",
				"holder"      => "div",
				"class"       => "",
				"heading"     => esc_html__("Show Posts",'digitallaw'),
				"description" => esc_html__("How many post you want to show.",'digitallaw'),
				"param_name"  => "show",
				"value"       => array(
					esc_html__('1','digitallaw')=>'1',
					esc_html__('2','digitallaw')=>'2',
					esc_html__('3','digitallaw')=>'3',
					esc_html__('4','digitallaw')=>'4',
					esc_html__('5','digitallaw')=>'5',
					esc_html__('6','digitallaw')=>'6',
					esc_html__('7','digitallaw')=>'7',
					esc_html__('8','digitallaw')=>'8',
					esc_html__('9','digitallaw')=>'9',
					esc_html__('10','digitallaw')=>'10',
					esc_html__('11','digitallaw')=>'11',
					esc_html__('12','digitallaw')=>'12',
					esc_html__('13','digitallaw')=>'13',
					esc_html__('14','digitallaw')=>'14',
					esc_html__('15','digitallaw')=>'15',
					esc_html__('16','digitallaw')=>'16',
					esc_html__('17','digitallaw')=>'17',
					esc_html__('18','digitallaw')=>'18',
					esc_html__('19','digitallaw')=>'19',
					esc_html__('20','digitallaw')=>'20',
					esc_html__('21','digitallaw')=>'21',
					esc_html__('22','digitallaw')=>'22',
					esc_html__('23','digitallaw')=>'23',
					esc_html__('24','digitallaw')=>'24',
				),
				"std"  => "3",
			),
			
		);
		
		
	
	$boxParams = digitallaw_box_params('blog');
	$params = array_merge( digitallaw_vc_heading_params(), $allParams, $boxParams );
	
	
	// Changing default values
	$i = 0;
	foreach( $params as $param ){
		$param_name = (isset($param['param_name'])) ? $param['param_name'] : '' ;
		if( $param_name == 'h2' ){
			$params[$i]['std'] = 'Blog';
			
		} else if( $param_name == 'txt_align' ){
			$params[$i]['std'] = 'center';
			
		}
		$i++;
	}
	
	
	
	
	global $digitallaw_sc_params_blogbox;
	$digitallaw_sc_params_blogbox = $params;
	
	
	vc_map( array(
		"name"     => esc_html__('ThemeMount Blog Box','digitallaw'),
		"base"     => "tm-blogbox",
		"class"    => "",
		'category' => esc_html__( 'ThemeMount Special Elements', 'digitallaw' ),
		"icon"     => 'icon-thememount-vc',
		"params"   => $params,
	) );
}

	


	
/**
 *  ThemeMount: Portfolio Box
 */
function digitallaw_vc_custom_element_portfoliobox(){
	
	global $digitallaw_theme_options;
	
	$pf_type_title = ( !empty($digitallaw_theme_options['pf_type_title']) ) ? esc_attr($digitallaw_theme_options['pf_type_title']) : esc_html__('Practice Area','digitallaw');
	
	$pf_cat_title = ( !empty($digitallaw_theme_options['pf_cat_title']) ) ? esc_attr($digitallaw_theme_options['pf_cat_title']) : esc_html__('Practice Area','digitallaw');
	
	$portfolioCatList = array();
	if( taxonomy_exists('tm_portfolio_category') ){
		$portfolioCatList_data = get_terms( 'tm_portfolio_category', array( 'hide_empty' => false ) );
		$portfolioCatList      = array();
		foreach($portfolioCatList_data as $cat){
			$portfolioCatList[ esc_html($cat->name) . ' (' . $cat->count . ')' ] = $cat->slug;
		}
	}
	
	
	$allParams = array(
			array(
				"type"        => "dropdown",
				"holder"      => "div",
				"class"       => "",
				"heading"     => esc_html__("Show Sortable Category Links",'digitallaw'),
				"description" => sprintf( esc_html__("Show sortable category links above %s items so user can sort by category by just single click.", 'digitallaw'), $pf_type_title ),
				"param_name"  => "sortable",
				"value"       => array(
					esc_html__('No','digitallaw')  => 'no',
					esc_html__('Yes','digitallaw') => 'yes',
				),
				"std"         => "no",
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Replace ALL word', 'digitallaw' ),
				'param_name'  => 'allword',
				'description' => esc_html__( 'Replace ALL word in sortable category links. Default is ALL word.', 'digitallaw' ),
				"std"         => "All",
				'dependency'  => array(
					'element'   => 'sortable',
					'value'     => array( 'yes' ),
				),
			),
			array(
				"type"        => "dropdown",
				"holder"      => "div",
				"class"       => "",
				"heading"     => esc_html__("Show Pagination",'digitallaw'),
				"description" => sprintf( esc_html__("Show pagination links below %s boxes.", 'digitallaw'), $pf_type_title ),
				"param_name"  => "pagination",
				"value"       => array(
					esc_html__('No','digitallaw')  => 'no',
					esc_html__('Yes','digitallaw') => 'yes',
				),
				"std"         => "no",
				'dependency'  => array(
					'element'   => 'sortable',
					'value'     => array( 'no' ),
				),
			),
			array(
				"type"        => "checkbox",
				"heading"     => sprintf( esc_html__("From %s.", 'digitallaw'), $pf_cat_title ),
				"description" => esc_html__("If you like to show posts from selected category than select the category here. ", "digitallaw") . esc_html__("The brecket number shows how many posts there in the category.", "digitallaw"),
				"param_name"  => "category",
				"value"       => $portfolioCatList,
			),
			
			array(
				"type"        => "dropdown",
				"holder"      => "div",
				"class"       => "",
				"heading"     => esc_html__("Order by",'digitallaw'),
				"description" => sprintf( esc_html__("Sort retrieved %s by parameter.", 'digitallaw'), $pf_type_title),
				"param_name"  => "orderby",
				"value"       => array(
					esc_html__('No order (none)','digitallaw')           => 'none',
					esc_html__('Order by post id (ID)','digitallaw')     => 'ID',
					esc_html__('Order by author (author)','digitallaw')  => 'author',
					esc_html__('Order by title (title)','digitallaw')    => 'title',
					esc_html__('Order by slug (name)','digitallaw')      => 'name',
					esc_html__('Order by date (date)','digitallaw')      => 'date',
					esc_html__('Order by last modified date (modified)','digitallaw') => 'modified',
					esc_html__('Random order (rand)','digitallaw')       => 'rand',
					esc_html__('Order by number of comments (comment_count)','digitallaw') => 'comment_count',
					
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
				"std"              => "date",
			),
			array(
				"type"        => "dropdown",
				"holder"      => "div",
				"class"       => "",
				"heading"     => esc_html__("Order",'digitallaw'),
				"description" => esc_html__("Designates the ascending or descending order of the 'orderby' parameter.",'digitallaw'),
				"param_name"  => "order",
				"value"       => array(
					esc_html__('Ascending (1, 2, 3; a, b, c)','digitallaw')  => 'ASC',
					esc_html__('Descending (3, 2, 1; c, b, a)','digitallaw') => 'DESC',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
				"std"              => "DESC",
			),
			array(
				"type"        => "dropdown",
				"holder"      => "div",
				"class"       => "",
				"heading"     => esc_html__("Show Item",'digitallaw'),
				"description" => sprintf( esc_html__("How many %s item you want to show.", 'digitallaw'),$pf_type_title),
				"param_name"  => "show",
				"value"       => array(
					esc_html__("All", "digitallaw") => "-1",
					esc_html__('1', "digitallaw")  => "1",
					esc_html__('2', "digitallaw") => "2",
					esc_html__('3','digitallaw')=>'3',
					esc_html__('4','digitallaw')=>'4',
					esc_html__('5','digitallaw')=>'5',
					esc_html__('6','digitallaw')=>'6',
					esc_html__('7','digitallaw')=>'7',
					esc_html__('8','digitallaw')=>'8',
					esc_html__('9','digitallaw')=>'9',
					esc_html__('10','digitallaw')=>'10',
					esc_html__('11','digitallaw')=>'11',
					esc_html__('12','digitallaw')=>'12',
					esc_html__('13','digitallaw')=>'13',
					esc_html__('14','digitallaw')=>'14',
					esc_html__('15','digitallaw')=>'15',
					esc_html__('16','digitallaw')=>'16',
					esc_html__('17','digitallaw')=>'17',
					esc_html__('18','digitallaw')=>'18',
					esc_html__('19','digitallaw')=>'19',
					esc_html__('20','digitallaw')=>'20',
					esc_html__('21','digitallaw')=>'21',
					esc_html__('22','digitallaw')=>'22',
					esc_html__('23','digitallaw')=>'23',
					esc_html__('24','digitallaw')=>'24',
				),
				"std"  => "3",
			),
			array(
				"type"        => "dropdown",
				"holder"      => "div",
				"class"       => "",
				"heading"     => sprintf( esc_html__("%s design.", 'digitallaw'),$pf_type_title),
				"description" => sprintf( esc_html__("Select %s design.", 'digitallaw'),$pf_type_title),
				"param_name"  => "pdesign",
				"value"       => array(
					esc_html__("Default", "digitallaw")          => "",
					esc_html__('No padding view', "digitallaw")  => "nopadding",
				),
				"std"         => "",
			),
		);
	
	$boxParams     = digitallaw_box_params();
	$headingParams = digitallaw_vc_heading_params();
	$params        = array_merge( $headingParams, $allParams, $boxParams );
	
	
	// Changing default values
	$i = 0;
	foreach( $params as $param ){
		$param_name = (isset($param['param_name'])) ? $param['param_name'] : '' ;
		if( $param_name == 'h2' ){
			$params[$i]['std'] = 'Our Work';
			
		} else if( $param_name == 'txt_align' ){
			$params[$i]['std'] = 'center';
		}
		$i++;
	}
	
	
	
	global $digitallaw_sc_params_portfoliobox;
	$digitallaw_sc_params_portfoliobox = $params;
	

	vc_map( array(
		"name"     => sprintf( esc_html__('ThemeMount %s (Portfolio) Box', 'digitallaw'), $pf_type_title ),
		"base"     => "tm-portfoliobox",
		"class"    => "",
		'category' => esc_html__( 'ThemeMount Special Elements', 'digitallaw' ),
		"icon"     => "icon-thememount-vc",
		"params"   => $params,
	) );
}




/**
 *  ThemeMount : Team Members
 */
function digitallaw_vc_custom_element_team(){
	
	global $digitallaw_theme_options;
	
	$team_type_title = ( !empty($digitallaw_theme_options['team_type_title']) ) ? esc_attr($digitallaw_theme_options['team_type_title']) : esc_html__('Lawyers','digitallaw');
	
	$team_group = ( !empty($digitallaw_theme_options['team_group_title']) ) ? esc_attr($digitallaw_theme_options['team_group_title']) : esc_html__('Services','digitallaw');
	
	// Team Group
	$teamGroupList = array();
	if( taxonomy_exists('tm_team_group') ){
		$teamGroups    = get_terms( 'tm_team_group', array( 'hide_empty' => false ) );
		$teamGroupList = array();
		foreach($teamGroups as $teamGroup){
			$name                   = $teamGroup->name.' ('.$teamGroup->count.')';
			$teamGroupList[ $name ] = $teamGroup->slug;
		}
	}
	
	$allParams = array(
		array(
			"type"        => "dropdown",
			"heading"     => sprintf( esc_html__('%s Linking', 'digitallaw'), $team_type_title ),
			"param_name"  => "linking",
			"description" => sprintf( esc_html__("Set link for %s single post on the %s name.", 'digitallaw'), $team_type_title, $team_type_title ),
			"value"       => array(
				esc_html__("Yes (default)", "digitallaw")   => "yes",
				esc_html__("No", "digitallaw")              => "no",
			),
			"std"         => "yes",
		),
		array(
			"type"        => "dropdown",
			"heading"     => sprintf( esc_html__('%s Box Design', 'digitallaw'), $team_type_title ),
			"param_name"  => "boxdesign",
			"description" => sprintf( esc_html__('Set design for %s box.', 'digitallaw'), $team_type_title),
			"value"       => array(
				esc_html__("Top image bottom content (default)", "digitallaw") => "default",
				esc_html__("Left image right content", "digitallaw")           => "leftimage",
			),
			"std"         => "yes",
		),
		array(
			"type"        => "checkbox",
			"heading"     => sprintf( esc_html__('From %s', 'digitallaw'), $team_group ),
			"param_name"  => "groupslug",
			"description" =>  esc_html__("If you like to show posts from selected category than select the category here. ", "digitallaw") . esc_html__("The brecket number shows how many posts there in the category.", "digitallaw"),
			"value"       => $teamGroupList,
		),
		array(
			"type"        => "dropdown",
			"heading"     => esc_html__("Show", "digitallaw"),
			"param_name"  => "show",
			"description" => sprintf( esc_html__('Total %s you want to show.', 'digitallaw'), $team_type_title ),
			"value"       => array(
				esc_html__("All", "digitallaw") => "-1",
				esc_html__("1", "digitallaw")  => "1",
				esc_html__("2", "digitallaw") => "2",
				esc_html__("3", "digitallaw") => "3",
				esc_html__("4", "digitallaw") => "4",
				esc_html__("5", "digitallaw") => "5",
				esc_html__("6", "digitallaw") => "6",
				esc_html__("7", "digitallaw") => "7",
				esc_html__("8", "digitallaw") => "8",
				esc_html__("9", "digitallaw") => "9",
				esc_html__("10", "digitallaw") => "10",
			),
			"std"  => "4",
		),
	);
	
	
	
	
	$boxParams = digitallaw_box_params();
	$params    = array_merge( digitallaw_vc_heading_params(), $allParams, $boxParams );
	
	
	
	// Changing default values
	$i = 0;
	foreach( $params as $param ){
		$param_name = (isset($param['param_name'])) ? $param['param_name'] : '' ;
		if( $param_name == 'column' ){
			$params[$i]['std'] = 'four';
			
		} else if( $param_name == 'h2' ){
			$params[$i]['std'] = 'Our Team';
		
		} else if( $param_name == 'txt_align' ){
			$params[$i]['std'] = 'center';
			
		}
		
		$i++;
	}
	
	
	
	global $digitallaw_sc_params_team;
	$digitallaw_sc_params_team = $params;
	
	
	vc_map( array(
		"name"     => sprintf( esc_html__('ThemeMount %s (Team Members) Box', 'digitallaw'), $team_type_title ),
		"base"     => "tm-team",
		"icon"     => "icon-thememount-vc",
		'category' => esc_html__( 'ThemeMount Special Elements', 'digitallaw' ),
		"params"   => $params,
	) );
}





/**
 *  ThemeMount : Testimonial box
 */

function digitallaw_vc_custom_element_testimonial(){
	
	// Fetching all Testmonial group names
	$testimonialGroups = array();
	if( taxonomy_exists('tm_testimonial_group') ){
		$testimonial_groups = get_terms( 'tm_testimonial_group', array('hide_empty'=>false) );
		$testimonialGroups  = array();
		foreach( $testimonial_groups as $group ){
			$totalcount = 0;
			if( trim($group->count) > 0 ){
				$totalcount = $group->count;
			}
			$testimonialGroups[ $group->name.' ('.$totalcount.')' ] = $group->slug;
		}
	}

	$allParams = array(
		array(
			"type"        => "checkbox",
			"heading"     => esc_html__("From Group", "digitallaw"),
			"param_name"  => "group",
			"description" => esc_html__("Select group so it will show Testimonials from selected group only.", "digitallaw"),
			"value"       => $testimonialGroups,
			"std"         => "",
		),
		array(
			"type"        => "dropdown",
			"heading"     => esc_html__("Show", "digitallaw"),
			"param_name"  => "show",
			"description" => esc_html__("Total Testimonials you want to show.", "digitallaw"),
			"value"       => array(
				esc_html__("All", "digitallaw") => "-1",
				esc_html__("1", "digitallaw")  => "1",
				esc_html__("2", "digitallaw") => "2",
				esc_html__("3", "digitallaw") => "3",
				esc_html__("4", "digitallaw") => "4",
				esc_html__("5", "digitallaw") => "5",
				esc_html__("6", "digitallaw") => "6",
				esc_html__("7", "digitallaw") => "7",
				esc_html__("8", "digitallaw") => "8",
				esc_html__("9", "digitallaw") => "9",
				esc_html__("10", "digitallaw") => "10",
				esc_html__("11", "digitallaw") => "11",
				esc_html__("12", "digitallaw") => "12",
				esc_html__("13", "digitallaw") => "13",
				esc_html__("14", "digitallaw") => "14",
				esc_html__("15", "digitallaw") => "15",
				esc_html__("16", "digitallaw") => "16",
				esc_html__("17", "digitallaw") => "17",
				esc_html__("18", "digitallaw") => "18",
				esc_html__("19", "digitallaw") => "19",
				esc_html__("20", "digitallaw") => "20",
			),
			"std"  => "3",
		),
		
	);
	
	$boxParams = digitallaw_box_params();
	$params    = array_merge( digitallaw_vc_heading_params(), $allParams, $boxParams );
	
	
	
	// Changing default values
	$i = 0;
	foreach( $params as $param ){
		$param_name = (isset($param['param_name'])) ? $param['param_name'] : '' ;
		if( $param_name == 'h2' ){
			$params[$i]['std'] = 'Testimonials';
			
		} else if( $param_name == 'txt_align' ){
			$params[$i]['std'] = 'center';
			
		}
		
		$i++;
	}
	
	
	
	global $digitallaw_sc_params_testimonial;
	$digitallaw_sc_params_testimonial = $params;
	
	
	vc_map( array(
		"name"     => esc_html__("ThemeMount Testimonial Box", "digitallaw"),
		"base"     => "tm-testimonial",
		"icon"     => "icon-thememount-vc",
		'category' => esc_html__( 'ThemeMount Special Elements', 'digitallaw' ),
		"params"   => $params,
	) );	
}




/**
 *  ThemeMount: Clients Logos
 */
function digitallaw_vc_custom_element_clients(){
	// Fetching all client group names
	$clientGroups = array();
	if( taxonomy_exists('tm_client_group') ){
		$client_groups = get_terms( 'tm_client_group', array('hide_empty'=>false) );
		$clientGroups  = array();
		foreach( $client_groups as $group ){
			$clientGroups[ $group->name.' ('.$group->count.')' ] = $group->slug;
		}
	}
	
	$allParams = array(
			array(
				"type"        => "checkbox",
				"heading"     => esc_html__("From Group", "digitallaw"),
				"param_name"  => "group",
				"description" => esc_html__("Select group so it will show client logo from selected group only.", "digitallaw"),
				"value"       => $clientGroups,
				"std"         => "",
			),
			array(
				"type"        => "dropdown",
				"heading"     => esc_html__("Show", "digitallaw"),
				"param_name"  => "show",
				"description" => esc_html__("Total Clients Logos you want to show.", "digitallaw"),
				"value"       => array(
					esc_html__("All", "digitallaw") => "-1",
					esc_html__("1", "digitallaw")  => "1",
					esc_html__("2", "digitallaw") => "2",
					esc_html__("3", "digitallaw") => "3",
					esc_html__("4", "digitallaw") => "4",
					esc_html__("5", "digitallaw") => "5",
					esc_html__("6", "digitallaw") => "6",
					esc_html__("7", "digitallaw") => "7",
					esc_html__("8", "digitallaw") => "8",
					esc_html__("9", "digitallaw") => "9",
					esc_html__("10", "digitallaw") => "10",
					esc_html__("11", "digitallaw") => "11",
					esc_html__("12", "digitallaw") => "12",
					esc_html__("13", "digitallaw") => "13",
					esc_html__("14", "digitallaw") => "14",
					esc_html__("15", "digitallaw") => "15",
					esc_html__("16", "digitallaw") => "16",
					esc_html__("17", "digitallaw") => "17",
					esc_html__("18", "digitallaw") => "18",
					esc_html__("19", "digitallaw") => "19",
					esc_html__("20", "digitallaw") => "20",
				),
				"std"  => "10",
			),
		);
	
	
	
	$boxParams = digitallaw_box_params();
	$params    = array_merge( digitallaw_vc_heading_params(), $allParams, $boxParams );
	
	
	
	// Changing default values
	$i = 0;
	foreach( $params as $param ){
		$param_name = (isset($param['param_name'])) ? $param['param_name'] : '' ;
		if( $param_name == 'h2' ){
			$params[$i]['std'] = 'Our Clients';
		
		} else if( $param_name == 'column' ){
			$params[$i]['std'] = 'five';
			
		} else if( $param_name == 'view' ){
			$params[$i]['std'] = 'carousel';
			
		} else if( $param_name == 'carousel_loop' ){
			$params[$i]['std'] = '1';
			
		} else if( $param_name == 'carousel_dots' ){
			$params[$i]['std'] = 'true';
			
		} else if( $param_name == 'carousel_nav' ){
			$params[$i]['std'] = 'false';
			
		} else if( $param_name == 'txt_align' ){
			$params[$i]['std'] = 'center';
			
		}
		
		$i++;
	}
	
	
	global $digitallaw_sc_params_clients;
	$digitallaw_sc_params_clients = $params;
	
	
	vc_map( array(
		"name"     => esc_html__("ThemeMount Clients Logo Box", "digitallaw"),
		"base"     => "tm-clients",
		"icon"     => "icon-thememount-vc",
		'category' => esc_html__( 'ThemeMount Special Elements', 'digitallaw' ),
		"params"   => $params,
	) );
}






/**
 *  ThemeMount: Facts in digits
**/
function digitallaw_vc_custom_element_facts_in_digits(){
	
	$allParams1 =  array(
				array(
					'type'			=> 'textfield',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> esc_html__('Header (optional)', 'digitallaw'),
					'param_name'	=> 'title',
					'std'			=> esc_html__('Title Text', 'digitallaw'),
					'description'	=> esc_html__('Enter text for the title. Leave blank if no title is needed.', 'digitallaw')
				),
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Add icon?', 'digitallaw' ),
					'param_name' => 'add_icon',
					'std'        => 'true',
				),
				array(
					"type"			=> "dropdown",
					"holder"		=> "div",
					"class"			=> "",
					"heading"		=> esc_html__("Icon Align", 'digitallaw'),
					"param_name"	=> "icon_align",
					"description"	=> esc_html__('Icon alignment.' , 'digitallaw'),
					'value' => array(
						esc_html__( 'Top Center', 'digitallaw' ) => 'top',
						esc_html__( 'Left', 'digitallaw' )       => 'left',
						esc_html__( 'Right', 'digitallaw' )      => 'right',
					),
					'std' => 'top',
					'dependency'  => array(
						'element'   => 'add_icon',
						'value'     => 'true'
					)
				)
	);
	
	$icon_options = vc_map_integrate_shortcode(
		'vc_icon',
		'icon_',
		'',
		array(
			'include_only' => array(
				'type',
				'icon_fontawesome',
				'icon_openiconic',
				'icon_typicons',
				'icon_entypo',
				'icon_linecons',
			),
		),
		array(
			'element' => 'add_icon',
			'value' => 'true',
		)
	);
	
	$allParams2 = array(
				array(
					'type'				=> 'textfield',
					'holder'			=> 'div',
					'class'				=> '',
					'heading'			=> esc_html__('Rotating Number', 'digitallaw'),
					'param_name'		=> 'digit',
					'std'				=> '100',
					'description'		=> esc_html__('Enter rotating number digit here.', 'digitallaw'),
				),
				array(
					'type'				=> 'textfield',
					'holder'			=> 'div',
					'heading'			=> esc_html__('Text Before Number', 'digitallaw'),
					'param_name'		=> 'before',
					'description'		=> esc_html__('Enter text which appear just before the rotating numbers.', 'digitallaw'),
					'edit_field_class'	=> 'vc_col-sm-6 vc_column',
				),
				array(
					"type"			=> "dropdown",
					"holder"		=> "div",
					"heading"		=> esc_html__("Text Style",'digitallaw'),
					"param_name"	=> "beforetextstyle",
					"description"	=> esc_html__('Select text style for the text.', 'digitallaw') . '<br>' . esc_html__('Superscript text appears half a character above the normal line, and is rendered in a smaller font.','digitallaw') . '<br>' . esc_html__('Subscript text appears half a character below the normal line, and is sometimes rendered in a smaller font.','digitallaw'),
					'value' => array(
						esc_html__( 'Superscript', 'digitallaw' ) => 'sup',
						esc_html__( 'Subscript', 'digitallaw' )   => 'sub',
						esc_html__( 'Normal', 'digitallaw' )      => 'span',
					),
					'std' => 'sup',
					'edit_field_class'	=> 'vc_col-sm-6 vc_column',
				),
				array(
					'type'				=> 'textfield',
					'holder'			=> 'div',
					'class'				=> '',
					'heading'			=> esc_html__('Text After Number', 'digitallaw'),
					'param_name'		=> 'after',
					'description'		=> esc_html__('Enter text which appear just after the rotating numbers.', 'digitallaw'),
					'edit_field_class'	=> 'vc_col-sm-6 vc_column',
				),
				array(
					"type"			=> "dropdown",
					"holder"		=> "div",
					"class"			=> "",
					"heading"		=> esc_html__("Text Style",'digitallaw'),
					"param_name"	=> "aftertextstyle",
					"description"	=> esc_html__('Select text style for the text.', 'digitallaw') . '<br>' . esc_html__('Superscript text appears half a character above the normal line, and is rendered in a smaller font.','digitallaw') . '<br>' . esc_html__('Subscript text appears half a character below the normal line, and is sometimes rendered in a smaller font.','digitallaw'),
					'value' => array(
						esc_html__( 'Superscript', 'digitallaw' ) => 'sup',
						esc_html__( 'Subscript', 'digitallaw' )   => 'sub',
						esc_html__( 'Normal', 'digitallaw' )      => 'span',
					),
					'std' => 'sub',
					'edit_field_class'	=> 'vc_col-sm-6 vc_column',
				),
				array(
					'type'			=> 'textfield',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> esc_html__('Rotating digit Interval', 'digitallaw'),
					'param_name'	=> 'interval',
					'std'			=> '5',
					'description'	=> esc_html__('Enter rotating interval number here.', 'digitallaw')
				)
	);
	
	
	$params = array_merge( $allParams1, $icon_options, $allParams2 );
	
	// Changing default values
	$i = 0;
	foreach( $params as $param ){
		
		$param_name = (isset($param['param_name'])) ? $param['param_name'] : '' ;
		
		if( $param_name == 'icon_type' ){
			$params[$i]['std'] = 'fontawesome';
		
		} else if( $param_name == 'icon_icon_fontawesome' ){
			$params[$i]['std'] = 'fa fa-thumbs-o-up';
			
		} else if( $param_name == 'icon_icon_openiconic' ){
			$params[$i]['std'] = 'vc-oi vc-oi-dial';
			
		} else if( $param_name == 'icon_icon_typicons' ){
			$params[$i]['std'] = 'typcn typcn-adjust-brightness';
			
		} else if( $param_name == 'icon_icon_entypo' ){
			$params[$i]['std'] = 'entypo-icon entypo-icon-note';
			
		} else if( $param_name == 'icon_icon_linecons' ){
			$params[$i]['std'] = 'vc_li vc_li-heart';
			
		}
		
		$i++;
	}
	
	
	
	
	global $digitallaw_sc_params_facts_in_digits;
	$digitallaw_sc_params_facts_in_digits = $params;
	
	
	if( function_exists('vc_map') ){
		vc_map( array(
			'name'		=> esc_html__( 'ThemeMount Facts in digits', 'digitallaw' ),
			'base'		=> 'tm-facts-in-digits',
			'class'		=> '',
			'icon'		=> 'icon-thememount-vc',
			'category'	=> esc_html__( 'ThemeMount Special Elements', 'digitallaw' ),
			'params'	=> $params
		));
	}
	
}





/**
 * ThemeMount: Tweeter box
 */
function digitallaw_vc_custom_element_twitterbox(){
	
	$allParams = array(
			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class"			=> "",
				"heading"		=> esc_html__("Twitter handle (Twitter Username)",'digitallaw'),
				"param_name"	=> "username",
				"description"	=> esc_html__('Twitter user name. Example "envato".','digitallaw')
			),
			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class"			=> "",
				"heading"		=> esc_html__('"Follow us" text after big icon','digitallaw'),
				"param_name"	=> "followustext",
				"description"	=> esc_html__('(optional) Follow us text after the big Twitter icon so user can click on it and go to Twitter profile page.','digitallaw')
			),
			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class"			=> "",
				"heading"		=> esc_html__("Show Tweets",'digitallaw'),
				"param_name"	=> "show",
				"description"	=> esc_html__('How many Tweets you like to show.','digitallaw'),
				'value' => array(
					esc_html__( '1', 'digitallaw' ) => '1',
					esc_html__( '2', 'digitallaw' ) => '2',
					esc_html__( '3', 'digitallaw' ) => '3',
					esc_html__( '4', 'digitallaw' ) => '4',
					esc_html__( '5', 'digitallaw' ) => '5',
					esc_html__( '6', 'digitallaw' ) => '6',
					esc_html__( '7', 'digitallaw' ) => '7',
					esc_html__( '8', 'digitallaw' ) => '8',
					esc_html__( '9', 'digitallaw' ) => '9',
					esc_html__( '10', 'digitallaw' ) => '10',
				),
				'std' => '3',
			),
			
			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class"			=> "",
				"heading"		=> esc_html__("Minimum popularity",'digitallaw'),
				"param_name"	=> "popularity",
				"description"	=> esc_html__('Minimum popularity. Default is zero','digitallaw'),
				'value' => array(
					esc_html__( '0', 'digitallaw' ) => '0',
					esc_html__( '1', 'digitallaw' ) => '1',
					esc_html__( '2', 'digitallaw' ) => '2',
					esc_html__( '3', 'digitallaw' ) => '3',
					esc_html__( '4', 'digitallaw' ) => '4',
					esc_html__( '5', 'digitallaw' ) => '5',
					esc_html__( '6', 'digitallaw' ) => '6',
					esc_html__( '7', 'digitallaw' ) => '7',
					esc_html__( '8', 'digitallaw' ) => '8',
					esc_html__( '9', 'digitallaw' ) => '9',
					esc_html__( '10', 'digitallaw' ) => '10',
				),
				'std' => '0',
			),
			
			array(
				"type"        => "checkbox",
				"heading"     => esc_html__("Show Retweets", "digitallaw"),
				"param_name"  => "retweets",
				"description" => esc_html__("Show Retweets.", "digitallaw"),
				"value"       => 'y',
			),
			
			array(
				"type"        => "checkbox",
				"heading"     => esc_html__("Show Replies", "digitallaw"),
				"param_name"  => "replies",
				"description" => esc_html__("Show Replies.", "digitallaw"),
				"value"       => 'y',
			),
			
			
			
		);
	
	
	$boxParams = digitallaw_box_params();
	$params    = array_merge( $allParams, $boxParams );
	
	
	
	// Changing default values
	$i = 0;
	foreach( $params as $param ){
		
		$param_name = (isset($param['param_name'])) ? $param['param_name'] : '' ;
		
		if( $param_name == 'column' ){
			$params[$i]['std'] = 'one';
		
		} else if( $param_name == 'view' ){
			$params[$i]['std'] = 'carousel';
			
		} else if( $param_name == 'carousel_dots' ){
			$params[$i]['std'] = 'true';
			
		}
		
		$i++;
	}
	
	
	
	global $digitallaw_sc_params_twitterbox;
	$digitallaw_sc_params_twitterbox = $params;
	
	
	vc_map( array(
		"name"        => esc_html__("ThemeMount Twitter Box",'digitallaw'),
		"base"        => "tm-twitterbox",
		"class"       => "",
		'category' => esc_html__( 'ThemeMount Special Elements', 'digitallaw' ),
		"icon"        => "icon-thememount-vc",
		"params"      => $params,
	) );

}

	
	
/**
 *  ThemeMount: Separator with Icon
 */
function digitallaw_vc_custom_element_icon_separator(){
	
	
	$icon_options = vc_map_integrate_shortcode(
		'vc_icon',
		'icon_',
		'',
		array(
			'include_only' => array(
				'type',
				'icon_fontawesome',
				'icon_openiconic',
				'icon_typicons',
				'icon_entypo',
				'icon_linecons',
			),
		)
	);
	
	$allParams =  array(
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Title', 'digitallaw' ),
			'description' => esc_html__( 'Add text for separator.', 'digitallaw' ),
			'param_name'  => 'title',
			'holder'      => 'div',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Icon position', 'digitallaw' ),
			'description' => esc_html__( 'Select icon position.', 'digitallaw' ),
			'param_name'  => 'icon_position',
			'value'       => array(
				esc_html__( 'before title', 'digitallaw' ) => 'left',
				esc_html__( 'After title', 'digitallaw' )  => "right"
			),
			'std'         => 'left',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Title align', 'digitallaw' ),
			'description' => esc_html__( 'Select title align.', 'digitallaw' ),
			'param_name'  => 'title_align',
			'value'       => array(
				esc_html__( 'Center', 'digitallaw' ) => 'separator_align_center',
				esc_html__( 'Left', 'digitallaw' )   => 'separator_align_left',
				esc_html__( 'Right', 'digitallaw' )  => "separator_align_right"
			),
			'std'         => 'separator_align_center',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Separator alignment', 'digitallaw' ),
			'description' => esc_html__( 'Select separator alignment.', 'digitallaw' ),
			'param_name'  => 'align',
			'value'       => array(
				esc_html__( 'Center', 'digitallaw' ) => 'align_center',
				esc_html__( 'Left', 'digitallaw' )   => 'align_left',
				esc_html__( 'Right', 'digitallaw' )  => "align_right"
			),
			'std'         => 'align_center',
		),
		array(
			'type'               => 'dropdown',
			'heading'            => esc_html__( 'Color', 'digitallaw' ),
			'param_name'         => 'color',
			'value'              => array_merge( getVcShared( 'colors' ), array( esc_html__( 'Custom color', 'digitallaw' ) => 'custom' ) ),
			'std'                => 'grey',
			'description'        => esc_html__( 'Select color of separator.', 'digitallaw' ),
			'param_holder_class' => 'vc_colored-dropdown'
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => esc_html__( 'Custom Color', 'digitallaw' ),
			'param_name'  => 'accent_color',
			'description' => esc_html__( 'Custom separator color for your element.', 'digitallaw' ),
			'dependency'  => array(
				'element'   => 'color',
				'value'     => array( 'custom' )
			),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'digitallaw' ),
			'param_name'  => 'style',
			'value'       => getVcShared( 'separator styles' ),
			'description' => esc_html__( 'Separator display style.', 'digitallaw' )
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Border width', 'digitallaw' ),
			'param_name'  => 'border_width',
			'value'       => getVcShared( 'separator border widths' ),
			'description' => esc_html__( 'Select border width (pixels).', 'digitallaw' )
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Element width', 'digitallaw' ),
			'param_name'  => 'el_width',
			'value'       => getVcShared( 'separator widths' ),
			'description' => esc_html__( 'Separator element width in percents.', 'digitallaw' )
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'digitallaw' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'digitallaw' )
		),
	);
	
	
	
	// All options
	$params = array_merge( $icon_options, $allParams );
	
	
	
	// Changing default values
	$i = 0;
	foreach( $params as $param ){
		
		$param_name = (isset($param['param_name'])) ? $param['param_name'] : '' ;
		
		if( $param_name == 'icon_type' ){
			$params[$i]['std'] = 'fontawesome';
		
		} else if( $param_name == 'icon_icon_fontawesome' ){
			$params[$i]['std'] = 'fa fa-hand-o-right';
			
		} else if( $param_name == 'icon_icon_openiconic' ){
			$params[$i]['std'] = 'vc-oi vc-oi-dial';
			
		} else if( $param_name == 'icon_icon_typicons' ){
			$params[$i]['std'] = 'typcn typcn-adjust-brightness';
			
		} else if( $param_name == 'icon_icon_entypo' ){
			$params[$i]['std'] = 'entypo-icon entypo-icon-note';
			
		} else if( $param_name == 'icon_icon_linecons' ){
			$params[$i]['std'] = 'vc_li vc_li-heart';
			
		}
		
		$i++;
	}
	
	
	
	global $digitallaw_sc_params_icon_separator;
	$digitallaw_sc_params_icon_separator = $params;
	
	
	vc_map( array(
		'name'     => esc_html__( 'ThemeMount Separator with Icon', 'digitallaw' ),
		'base'     => 'tm-icon-separator',
		'icon'     => 'icon-thememount-vc',
		'category' => esc_html__( 'ThemeMount Special Elements', 'digitallaw' ),
		'params'   => $params,
	) );
	
	
}
	



/**
 *  ThemeMount: Heading
 */
function digitallaw_vc_custom_element_heading(){
	
	$allParams = digitallaw_vc_heading_params();
	
	$css_editor = array(
		array(
			'type'       => 'css_editor',
			'heading'    => esc_html__( 'CSS box', 'digitallaw' ),
			'param_name' => 'css',
			'group'      => esc_html__( 'Design Options', 'digitallaw' )
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'digitallaw' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'digitallaw' )
		)
	);
	
	$params    = array_merge( $allParams, $css_editor );
	
	
	// Changing modifying, adding extra options
	$i = 0;
	foreach( $params as $param ){
		$param_name = (isset($param['param_name'])) ? $param['param_name'] : '' ;
		if( $param_name == 'txt_align' ){
			$params[$i]['std'] = 'left';
			
		}
		$i++;
	}
		
	
	
	global $digitallaw_sc_params_heading;
	$digitallaw_sc_params_heading = $params;
	
	
	vc_map( array(
		"name"     => esc_html__("ThemeMount Heading", "digitallaw"),
		"base"     => "tm-heading",
		"icon"     => "icon-thememount-vc",
		'category' => esc_html__( 'ThemeMount Special Elements', 'digitallaw' ),
		"params"   => $params,
	) );
}







/**
 *  ThemeMount: List
 */
if( !function_exists('digitallaw_vc_custom_element_list') ){
function digitallaw_vc_custom_element_list(){
	
	$allParams = array(
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'List Type', 'digitallaw' ),
			'param_name' => 'type',
			'value'      => array(
				esc_html__( 'Icon', 'digitallaw' )                    => 'icon',
				esc_html__( 'Disc', 'digitallaw' )                    => 'disc',
				esc_html__( 'Circle', 'digitallaw' )                  => 'circle',
				esc_html__( 'Square', 'digitallaw' )                  => 'square',
				esc_html__( 'Decimal (1, 2, 3, 4)', 'digitallaw' )    => 'decimal',
				esc_html__( 'Alphabetic (A, B, C, D)', 'digitallaw' ) => 'upper-alpha',
				esc_html__( 'Roman (I, II, III, IV)', 'digitallaw' )  => 'roman',
			),
			'std'         => 'icon',
			'description' => esc_html__( 'Select list style.', 'digitallaw' ),
		),
	);
	
	$icon_options = vc_map_integrate_shortcode(
		'vc_icon',
		'icon_',
		'',
		array(
			'include_only' => array(
				'type',
				'icon_fontawesome',
				'icon_openiconic',
				'icon_typicons',
				'icon_entypo',
				'icon_linecons',
			),
		),
		array(
			'element' => 'type',
			'value'   => 'icon',
		)
	);
	
	// Setting default icon for ICON list
	$icon_options[2]['value'] = 'fa fa-angle-right';
	
	
	
	
	// each line
	$lines = array();
	$total = 20;
	for( $x=1; $x <= $total ; $x++ ){
		$lines[] = array(
			'type'        => 'textarea_raw_html',
			'heading'     => sprintf( esc_html__( 'List Line %s','digitallaw' ), $x ),
			'param_name'  => 'line'.$x,
			'description' => esc_html__( 'Enter text for the list line. Some HTML tags are allowed.', 'digitallaw' ),
			'value'       => '',
		);
	}
	
	// Merge all parameters
	$params = array_merge( $allParams, $icon_options, $lines );
	
	
	
	// Changing default values
	$i = 0;
	foreach( $params as $param ){
		
		$param_name = (isset($param['param_name'])) ? $param['param_name'] : '' ;
		
		if( $param_name == 'icon_type' ){
			$params[$i]['std'] = 'fontawesome';
		
		} else if( $param_name == 'icon_icon_fontawesome' ){
			$params[$i]['std'] = 'fa fa-chevron-right';
			
		} else if( $param_name == 'icon_icon_openiconic' ){
			$params[$i]['std'] = 'vc-oi vc-oi-dial';
			
		} else if( $param_name == 'icon_icon_typicons' ){
			$params[$i]['std'] = 'typcn typcn-adjust-brightness';
			
		} else if( $param_name == 'icon_icon_entypo' ){
			$params[$i]['std'] = 'entypo-icon entypo-icon-note';
			
		} else if( $param_name == 'icon_icon_linecons' ){
			$params[$i]['std'] = 'vc_li vc_li-heart';
			
		}
		
		$i++;
	}
	
	
	
	global $digitallaw_sc_params_list;
	$digitallaw_sc_params_list = $params;
	
	
	vc_map( array(
		'name'		=> esc_html__( 'ThemeMount List', 'digitallaw' ),
		'base'		=> 'tm-list',
		'class'		=> '',
		'icon'		=> 'icon-thememount-vc',
		'category'	=> esc_html__( 'ThemeMount Special Elements', 'digitallaw' ),
		'params'	=> $params
	));
	
}
}










/**
 * ThemeMount: Events Calendar list in Visual Composer
 */
function digitallaw_vc_custom_element_eventsbox(){
	if( class_exists('Tribe__Events__Main') ){
		
		// Getting event category
		$eventCatArray = get_terms( 'tribe_events_cat', array( 'hide_empty' => false ) );
		$eventCatList  = array();
		foreach($eventCatArray as $eventCat){
			$name                  = $eventCat->name.' ('.$eventCat->count.')';
			$eventCatList[ $name ] = $eventCat->slug;
		}

		
		
		$allParams = array(
				array(
					"type"        => "dropdown",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Show Pagination",'digitallaw'),
					"description" => esc_html__("Show pagination links below Event boxes.",'digitallaw'),
					"param_name"  => "pagination",
					"value"       => array(
						esc_html__('No','digitallaw')  => 'no',
						esc_html__('Yes','digitallaw') => 'yes',
					),
					"std"         => "no",
				),
				array(
					"type"        => "checkbox",
					"heading"     => esc_html__("Event Categories", "digitallaw"),
					"param_name"  => "catslug",
					"description" => esc_html__("Select category to show Events from selected category only. Select none to show all Events.", "digitallaw"),
					"value"       => $eventCatList,
				),
				array(
					"type"        => "dropdown",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Show Events Item",'digitallaw'),
					"description" => esc_html__("How many events you want to show.",'digitallaw'),
					"param_name"  => "show",
					"value"       => array(
						esc_html__('All','digitallaw') => '-1',
						esc_html__('1','digitallaw')  => '1',
						esc_html__('2','digitallaw') => '2',
						esc_html__('3','digitallaw')=>'3',
						esc_html__('4','digitallaw')=>'4',
						esc_html__('5','digitallaw')=>'5',
						esc_html__('6','digitallaw')=>'6',
						esc_html__('7','digitallaw')=>'7',
						esc_html__('8','digitallaw')=>'8',
						esc_html__('9','digitallaw')=>'9',
						esc_html__('10','digitallaw')=>'10',
						esc_html__('11','digitallaw')=>'11',
						esc_html__('12','digitallaw')=>'12',
						esc_html__('13','digitallaw')=>'13',
						esc_html__('14','digitallaw')=>'14',
						esc_html__('15','digitallaw')=>'15',
						esc_html__('16','digitallaw')=>'16',
						esc_html__('17','digitallaw')=>'17',
						esc_html__('18','digitallaw')=>'18',
						esc_html__('19','digitallaw')=>'19',
						esc_html__('20','digitallaw')=>'20',
						esc_html__('21','digitallaw')=>'21',
						esc_html__('22','digitallaw')=>'22',
						esc_html__('23','digitallaw')=>'23',
						esc_html__('24','digitallaw')=>'24',
					),
					"std"  => "3",
				),
				array(
					"type"        => "dropdown",
					"heading"     => esc_html__("Box Style", "digitallaw"),
					"description" => esc_html__("Select box style.", "digitallaw"),
					"group"       => esc_html__( "Box Design", "digitallaw" ),
					"param_name"  => "design",
					"value"       => array(
						esc_html__("Default Style", "digitallaw")   => "default",
						esc_html__("Detailed Style", "digitallaw") => "detailed",
					),
					"std"         => "default",
				)
			);
		
		$boxParams = digitallaw_box_params();
		$params    = array_merge( digitallaw_vc_heading_params(), $allParams, $boxParams );
		
		
		// Changing default values
		$i = 0;
		foreach( $params as $param ){
			$param_name = (isset($param['param_name'])) ? $param['param_name'] : '' ;
			if( $param_name == 'h2' ){
				$params[$i]['std'] = 'Latest Events';
				
			}
			$i++;
		}
		
		
		global $digitallaw_sc_params_eventsbox;
		$digitallaw_sc_params_eventsbox = $params;
	
		
		vc_map( array(
			"name"     => esc_html__("ThemeMount Events Box", "digitallaw"),
			"base"     => "tm-eventsbox",
			"icon"     => "icon-thememount-vc",
			'category' => esc_html__( 'ThemeMount Special Elements', 'digitallaw' ),
			"params"   => $params
		) );
	}
}

	
	
	
/**
 *  ThemeMount: Contact Box
 */
function digitallaw_vc_custom_element_contactbox(){
	
	$params = array(
		array(
			"type"        => "textfield",
			"holder"      => "div",
			"class"       => "",
			"heading"     => esc_html__("Phone",'digitallaw'),
			"description" => esc_html__("Write phone number here. Example: <code>(+01) 123 456 7890</code>",'digitallaw'),
			"param_name"  => "phone",
		),
		array(
			"type"        => "textfield",
			"holder"      => "div",
			"class"       => "",
			"heading"     => esc_html__("Email",'digitallaw'),
			"description" => esc_html__("Write email here. Example: <code>info@example.com</code>",'digitallaw'),
			"param_name"  => "email",
		),
		array(
			"type"        => "textfield",
			"holder"      => "div",
			"class"       => "",
			"heading"     => esc_html__("Website",'digitallaw'),
			"description" => esc_html__("Write website URL here. Example: <code>www.example.com</code>",'digitallaw'),
			"param_name"  => "website",
		),
		array(
			"type"        => "textarea",
			"holder"      => "div",
			"class"       => "",
			"heading"     => esc_html__("Address",'digitallaw'),
			"description" => esc_html__("Write address here. <br> Example: <code>Honey Business <br> 24 Fifth st., Los Angeles, <br> USA</code>",'digitallaw'),
			"param_name"  => "address",
		),
		array(
			"type"        => "textarea",
			"holder"      => "div",
			"class"       => "",
			"heading"     => esc_html__("Time",'digitallaw'),
			"description" => esc_html__("Write time here. <br> Example: <code>Mon to Sat - 9:00am to 6:00pm<br>(Sunday Closed)</code>",'digitallaw'),
			"param_name"  => "time",
		),
	);

	global $digitallaw_sc_params_contactbox;
	$digitallaw_sc_params_contactbox = $params;

	
	vc_map( array(
		"name"     => esc_html__("ThemeMount Contact Details Box",'digitallaw'),
		"base"     => "tm-contactbox",
		"class"    => "",
		'category' => esc_html__( 'ThemeMount Special Elements', 'digitallaw' ),
		"icon"     => "icon-thememount-vc",
		"params"   => $params
	) );
}

	


/************************** Custom Template *****************************/
add_filter( 'vc_load_default_templates', 'digitallaw_custom_template_for_vc' );
function digitallaw_custom_template_for_vc($maindata) {
	
	$maindata = array();
	
	/* ***************** */
	
	
	// 1st sample: Main Homepage
    $data               = array();
    $data['name']       = esc_html__( 'Main Homepage', 'digitallaw' );
    $data['image_path'] = get_template_directory_uri() . '/inc/images/sample-page.png' ; // always use preg replace to be sure that "space" will not break logic
    $data['custom_class'] = 'digitallaw_home_template';
    $data['content']    = <<<CONTENTTTTTTTTTTT
[vc_row full_width="stretch_row" bgtype="grey" css=".vc_custom_1457081487414{padding-bottom: 70px !important;}"][vc_column width="1/2"][vc_single_image image="9258" img_size="full"][/vc_column][vc_column width="1/2"][tm-heading h2="WELCOME TO DIGITAL LAW" h4="Working With Excellent Attorneys"][vc_column_text]Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy dummy text of the printing and typesetting industry. Lorem Ipsum has been the industryver.[/vc_column_text][vc_row_inner el_class="small tm-break-colum-992"][vc_column_inner width="1/3"][tm-servicebox h2="Ontime at Services" h2_font_container="font_size:15px" h2_google_fonts="font_family:Lora%3Aregular%2Citalic%2C700%2C700italic|font_style:400%20regular%3A400%3Anormal" txt_align="left" add_icon="left" i_on_border="" i_type="linecons" i_icon_linecons="vc_li vc_li-clock" i_background_style="none" i_size="lg" i_icon_stroke7_pixeden="pe-7s-diamond" use_custom_fonts_h2="true"][/tm-servicebox][/vc_column_inner][vc_column_inner width="1/3"][tm-servicebox h2="Available at Your Location" h2_font_container="font_size:15px" h2_google_fonts="font_family:Lora%3Aregular%2Citalic%2C700%2C700italic|font_style:400%20regular%3A400%3Anormal" txt_align="left" add_icon="left" i_on_border="" i_type="linecons" i_icon_linecons="vc_li vc_li-location" i_background_style="none" i_size="lg" i_icon_stroke7_pixeden="pe-7s-map-2" use_custom_fonts_h2="true"][/tm-servicebox][/vc_column_inner][vc_column_inner width="1/3"][tm-servicebox h2="Online Appointment" h2_font_container="font_size:15px" h2_google_fonts="font_family:Lora%3Aregular%2Citalic%2C700%2C700italic|font_style:400%20regular%3A400%3Anormal" txt_align="left" add_icon="left" i_on_border="" i_type="linecons" i_icon_linecons="vc_li vc_li-calendar" i_background_style="none" i_size="lg" i_icon_stroke7_pixeden="pe-7s-browser" use_custom_fonts_h2="true"][/tm-servicebox][/vc_column_inner][/vc_row_inner][vc_btn title="CONTACT US" style="outline"][/vc_column][/vc_row][vc_row full_width="stretch_row_content" bgtype="skin" css=".vc_custom_1455359641206{padding-top: 0px !important;padding-bottom: 0px !important;}" equalheight="true"][vc_column width="1/2" css=".vc_custom_1456553900604{padding-top: 4% !important;padding-right: 3% !important;padding-bottom: 3.5% !important;padding-left: 3% !important;}"][vc_custom_heading text="Fill out the form below, we will get back you soon." font_container="tag:h2|font_size:16px|text_align:center" google_fonts="font_family:Lora%3Aregular%2Citalic%2C700%2C700italic|font_style:400%20italic%3A400%3Aitalic" css=".vc_custom_1456551879872{margin-bottom: 7px !important;}"][vc_custom_heading text="REQUEST A CONSULTATION TOTALLY FREE" font_container="tag:h2|text_align:center" use_theme_fonts="yes" css=".vc_custom_1456551898111{margin-bottom: 40px !important;}"][vc_column_text css=".vc_custom_1456553310043{margin-bottom: 15px !important;}"][contact-form-7 id="8107" title="Homepage Appointment form"][/vc_column_text][vc_row_inner][vc_column_inner][vc_custom_heading text="Have Questions? Ask Your Lawyer" font_container="tag:h3|font_size:24px|text_align:center|line_height:25px" google_fonts="font_family:Lora%3Aregular%2Citalic%2C700%2C700italic|font_style:400%20italic%3A400%3Aitalic" css=".vc_custom_1456837037034{margin-bottom: 10px !important;padding-top: 10px !important;}"][vc_custom_heading text="7 days a week from 8:00am to 5:00pm" font_container="tag:h3|font_size:16px|text_align:center|line_height:25px" google_fonts="font_family:Lora%3Aregular%2Citalic%2C700%2C700italic|font_style:400%20italic%3A400%3Aitalic" css=".vc_custom_1457432914152{margin-bottom: 16px !important;}"][vc_custom_heading text="1 234 500 7007" font_container="tag:h2|font_size:29px|text_align:center|line_height:30px" use_theme_fonts="yes" css=".vc_custom_1456836905257{margin-bottom: 16px !important;}"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/2" css=".vc_custom_1455359522290{background-image: url(http://digitallaw.thememountdemo.com/wp-content/uploads/2015/12/image3.jpg?id=9191) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][/vc_column][/vc_row][vc_row css=".vc_custom_1455629081260{padding-bottom: 60px !important;}"][vc_column width="1/3"][tm-testimonial h2="WHAT PEOPLE SAY" txt_align="left" view="carousel" column="one" carousel_dots="true" carousel_nav="false" h4="Testimonials"][/vc_column][vc_column width="2/3"][tm-heading h2="LAW SERVICES" h4="We offer a Broad Range"][vc_tta_tabs][vc_tta_section title="CRIMINAL LAW" tab_id="1455615349113-3fad1f90-449b"][vc_custom_heading text="LEGAL REPRESENTATION IN LITIGATION CASES" font_container="tag:h2|font_size:17px|text_align:left" google_fonts="font_family:Roboto%20Condensed%3A300%2C300italic%2Cregular%2Citalic%2C700%2C700italic|font_style:700%20bold%20regular%3A700%3Anormal"][vc_row_inner][vc_column_inner width="1/3"][vc_single_image image="9488" img_size="full"][/vc_column_inner][vc_column_inner width="2/3"][vc_custom_heading text="CRIMINAL LAW" font_container="tag:h2|font_size:17px|text_align:left|color:%239dc02e" google_fonts="font_family:Roboto%20Condensed%3A300%2C300italic%2Cregular%2Citalic%2C700%2C700italic|font_style:400%20regular%3A400%3Anormal"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore. Excepteur sint occaecat cupidatat non proident.

Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore. Excepteur sint occaecat cupidatat non proident. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam[/vc_column_text][/vc_tta_section][vc_tta_section title="LEGAL ADVICE" tab_id="1455626265081-9a6a9c0a-12c7"][vc_custom_heading text="LEGAL REPRESENTATION IN LITIGATION CASES" font_container="tag:h2|font_size:17px|text_align:left" google_fonts="font_family:Roboto%20Condensed%3A300%2C300italic%2Cregular%2Citalic%2C700%2C700italic|font_style:700%20bold%20regular%3A700%3Anormal"][vc_custom_heading text="LEGAL ADVICE" font_container="tag:h2|font_size:17px|text_align:left|color:%239dc02e" google_fonts="font_family:Roboto%20Condensed%3A300%2C300italic%2Cregular%2Citalic%2C700%2C700italic|font_style:400%20regular%3A400%3Anormal"][vc_row_inner][vc_column_inner width="1/3"][vc_single_image image="9333" img_size="full"][/vc_column_inner][vc_column_inner width="2/3"][tm-list icon_icon_fontawesome="fa fa-check-circle" line1="TG9yZW0lMjBpcHN1bSUyMGRvbG9yJTIwc2l0JTIwYW1ldA==" line2="VmVzdGlidWx1bSUyMGNvbnNlcXVhdCUyMGFudGUlMjA=" line3="RG9uZWMlMjBtYWxlc3VhZGElMjBtYXNzYSUyMHZpdGFl" line4="RnVzY2UlMjBhJTIwbGFjdXMlMjBub24lMjBlbmltJTIwZWxlbWVudHVt"][/vc_column_inner][/vc_row_inner][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore. Excepteur sint occaecat cupidatat non proident. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam.[/vc_column_text][/vc_tta_section][vc_tta_section title="TRAFFIC OFFENSE" tab_id="1455626337016-c491e1ac-feca"][vc_custom_heading text="LEGAL REPRESENTATION IN LITIGATION CASES" font_container="tag:h2|font_size:17px|text_align:left" google_fonts="font_family:Roboto%20Condensed%3A300%2C300italic%2Cregular%2Citalic%2C700%2C700italic|font_style:700%20bold%20regular%3A700%3Anormal"][vc_row_inner][vc_column_inner width="2/3"][vc_custom_heading text="TRAFFIC OFFENSE" font_container="tag:h2|font_size:17px|text_align:left|color:%239dc02e" google_fonts="font_family:Roboto%20Condensed%3A300%2C300italic%2Cregular%2Citalic%2C700%2C700italic|font_style:400%20regular%3A400%3Anormal"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore. Excepteur sint occaecat cupidatat non proident.

Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][vc_single_image image="9327" img_size="full"][/vc_column_inner][/vc_row_inner][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore. Excepteur sint occaecat cupidatat non proident. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam.[/vc_column_text][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row full_width="stretch_row_content_no_spaces" bgtype="dark" css=".vc_custom_1456728133648{padding-top: 0px !important;padding-bottom: 0px !important;}" equalheight="true"][vc_column width="1/3" bgcolor="skin" css=".vc_custom_1457324796407{padding-top: 4% !important;padding-right: 3% !important;padding-bottom: 3% !important;padding-left: 3% !important;background-color: #9dc02e !important;}"][vc_row_inner][vc_column_inner width="1/2"][tm-facts-in-digits title="RECOVERED CLIENTS" icon_align="left" icon_type="linecons" icon_icon_linecons="vc_li vc_li-params" digit="25478"][tm-facts-in-digits title="SOLVED CASES" icon_align="left" icon_type="linecons" icon_icon_linecons="vc_li vc_li-study" digit="25473"][/vc_column_inner][vc_column_inner width="1/2"][tm-facts-in-digits title="SUCCESFULL CASES" icon_align="left" icon_type="linecons" icon_icon_linecons="vc_li vc_li-like" digit="14578"][tm-facts-in-digits title="TRUSTED CLIENTS" icon_align="left" icon_type="linecons" icon_icon_linecons="vc_li vc_li-bulb" digit="12475"][/vc_column_inner][/vc_row_inner][vc_custom_heading text="ABOUT US" font_container="tag:h3|font_size:26px|text_align:left|line_height:30px" google_fonts="font_family:Roboto%20Condensed%3A300%2C300italic%2Cregular%2Citalic%2C700%2C700italic|font_style:700%20bold%20regular%3A700%3Anormal"][vc_column_text]Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam qnesciunt.

eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam qnesciunt.[/vc_column_text][vc_btn title="Read More" color="white" i_align="right" i_icon_fontawesome="fa fa-angle-right" add_icon="true" css=".vc_custom_1455612541974{margin-top: -20px !important;}"][/vc_column][vc_column width="1/3" css=".vc_custom_1456728218641{padding-top: 4% !important;padding-right: 3% !important;padding-bottom: 3% !important;padding-left: 3% !important;}"][tm-heading h2=" OUR HISTORY" h4="Well Focused"][tm-servicebox h2="Jan 18, 2011 (Opening)" h2_font_container="font_size:19px|color:%239dc02e|line_height:25px" h2_google_fonts="font_family:Lora%3Aregular%2Citalic%2C700%2C700italic|font_style:400%20italic%3A400%3Aitalic" txt_align="left" add_icon="left" i_on_border="" i_type="entypo" i_icon_entypo="entypo-icon entypo-icon-check" i_background_style="none" i_size="sm" use_custom_fonts_h2="true"]Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris. Nisi ut aliquip ex ea commodo consequat Duis aute irure dolor in reprehenderit.[/tm-servicebox][tm-servicebox h2="April 10, 2012 (Opening of new office)" h2_font_container="font_size:19px|color:%239dc02e|line_height:25px" h2_google_fonts="font_family:Lora%3Aregular%2Citalic%2C700%2C700italic|font_style:400%20italic%3A400%3Aitalic" txt_align="left" add_icon="left" i_on_border="" i_type="entypo" i_icon_entypo="entypo-icon entypo-icon-check" i_background_style="none" i_size="sm" use_custom_fonts_h2="true"]Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris. Nisi ut aliquip ex ea commodo consequat Duis aute irure dolor in reprehenderit.[/tm-servicebox][tm-servicebox h2="Jun 3, 2015 (Clients succes determines)" h2_font_container="font_size:19px|color:%239dc02e|line_height:25px" h2_google_fonts="font_family:Lora%3Aregular%2Citalic%2C700%2C700italic|font_style:400%20italic%3A400%3Aitalic" txt_align="left" add_icon="left" i_on_border="" i_type="entypo" i_icon_entypo="entypo-icon entypo-icon-check" i_background_style="none" i_size="sm" use_custom_fonts_h2="true"]Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris. Nisi ut aliquip ex ea commodo consequat Duis aute irure dolor in reprehenderit.[/tm-servicebox][/vc_column][vc_column width="1/3" css=".vc_custom_1456218081743{background-image: url(http://digitallaw.thememountdemo.com/wp-content/uploads/2015/12/image5.jpg?id=9193) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][/vc_column][/vc_row][vc_row css=".vc_custom_1455612776007{padding-bottom: 50px !important;}"][vc_column][tm-blogbox h2="LATEST NEWS &amp; UPDATES" txt_align="left" category="bank-and-financial,corporate,employment-law,family-law" show="6" view="carousel" h4="Whats going on"][/vc_column][/vc_row][vc_row full_width="stretch_row" video_bg="yes" video_bg_url="https://www.youtube.com/watch?v=DaSJ1gLCOJ0" bgtype="dark" css=".vc_custom_1457082145506{padding-bottom: 0px !important;}"][vc_column width="2/3"][vc_row_inner][vc_column_inner width="1/2"][tm-servicebox h2="REAL ESTATE LAW" h2_font_container="color:%239dc02e" h2_google_fonts="font_family:Roboto%20Condensed%3A300%2C300italic%2Cregular%2Citalic%2C700%2C700italic|font_style:700%20bold%20regular%3A700%3Anormal" txt_align="left" add_icon="left" i_on_border="" i_icon_fontawesome="fa fa-home" i_color="white" i_background_style="rounded-less-outline" i_background_color="white" i_size="lg" use_custom_fonts_h2="true"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum..[/tm-servicebox][/vc_column_inner][vc_column_inner width="1/2"][tm-servicebox h2="FAMILY LAW" h2_font_container="color:%239dc02e" h2_google_fonts="font_family:Roboto%20Condensed%3A300%2C300italic%2Cregular%2Citalic%2C700%2C700italic|font_style:700%20bold%20regular%3A700%3Anormal" txt_align="left" add_icon="left" i_on_border="" i_icon_fontawesome="fa fa-user" i_color="white" i_background_style="rounded-less-outline" i_background_color="white" i_size="lg" use_custom_fonts_h2="true"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum..[/tm-servicebox][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/2"][tm-servicebox h2="CRIMINAL DEFENSE" h2_font_container="color:%239dc02e" h2_google_fonts="font_family:Roboto%20Condensed%3A300%2C300italic%2Cregular%2Citalic%2C700%2C700italic|font_style:700%20bold%20regular%3A700%3Anormal" txt_align="left" add_icon="left" i_on_border="" i_type="entypo" i_icon_entypo="entypo-icon entypo-icon-shareable" i_color="white" i_background_style="rounded-less-outline" i_background_color="white" i_size="lg" use_custom_fonts_h2="true"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum..[/tm-servicebox][/vc_column_inner][vc_column_inner width="1/2"][tm-servicebox h2="EMPLOYMENT LAW" h2_font_container="color:%239dc02e" h2_google_fonts="font_family:Roboto%20Condensed%3A300%2C300italic%2Cregular%2Citalic%2C700%2C700italic|font_style:700%20bold%20regular%3A700%3Anormal" txt_align="left" add_icon="left" i_on_border="" i_icon_fontawesome="fa fa-line-chart" i_color="white" i_background_style="rounded-less-outline" i_background_color="white" i_size="lg" use_custom_fonts_h2="true"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum..[/tm-servicebox][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/3"][vc_single_image image="9522" img_size="full" css=".vc_custom_1455692346480{margin-top: -70px !important;margin-bottom: 0px !important;}"][/vc_column][/vc_row][vc_row full_width="stretch_row" bgtype="grey" css=".vc_custom_1455956346914{padding-bottom: 70px !important;}"][vc_column][tm-team h2="MEET OUR ATTORNEYS" txt_align="left" boxdesign="default" groupslug="bank-and-financial,capital-market,car-accident,construction-law,dispute-resolution,employment-law,family-law,insurance-law,nationality-law" show="6" view="carousel" h4="We are with awesome people"][/vc_column][/vc_row][vc_row css=".vc_custom_1457081661486{padding-bottom: 80px !important;}"][vc_column width="1/2"][tm-clients h2="CILENTS WE DEAL" txt_align="left" show="4" view="default" column="two" h4="Some of Our"][/vc_column][vc_column width="1/2"][tm-heading h2="FAQ's" h4="Frequently Asked Questions"][vc_toggle title="General Liability and Litigation" size="lg" open="true" el_id="1455699774820-3e584237-05fb"]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore. Excepteur sint occaecat cupidatat non proident. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa.[/vc_toggle][vc_toggle title="In the world crime only is lose" size="lg" el_id="1455699822226-45a5b0a1-5e57"]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore. Excepteur sint occaecat cupidatat non proident. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa.[/vc_toggle][vc_toggle title="Lawyer Civil Disobedience" size="lg" el_id="1455699821242-8eb1c544-e810"]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore. Excepteur sint occaecat cupidatat non proident. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa.[/vc_toggle][/vc_column][/vc_row][vc_row full_width="stretch_row" parallax="content-moving" parallax_image="9329" parallax_speed_bg="4.5" bgtype="skin" css=".vc_custom_1457081697350{padding-top: 80px !important;padding-bottom: 70px !important;background-position: center;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column width="3/4"][vc_custom_heading text="ARE YOU HAVING ANY PROBLEMS BUT CAN'T CONSULT TO ANYONE?" font_container="tag:h2|font_size:26px|text_align:left|line_height:26px" use_theme_fonts="yes" css=".vc_custom_1456556697481{padding-bottom: 7px !important;}"][vc_custom_heading text="Talk to us! We promise we can help you! Call Now! (1)234-5678-910" font_container="tag:h3|font_size:23px|text_align:left|line_height:23px" google_fonts="font_family:Lora%3Aregular%2Citalic%2C700%2C700italic|font_style:400%20italic%3A400%3Aitalic"][/vc_column][vc_column width="1/4"][vc_btn title="READ MORE" style="outline" color="white" align="right" i_icon_fontawesome="fa fa-thumbs-o-up" link="url:%23||" add_icon="true" css=".vc_custom_1456556823656{margin-top: 11px !important;}"][/vc_column][/vc_row]
CONTENTTTTTTTTTTT;
	$maindata[] = $data;
	
	
	
	
	
	// 2nd sample: Home Version 1
    $data               = array();
    $data['name']       = esc_html__( 'Home Version 1', 'digitallaw' );
    $data['image_path'] = get_template_directory_uri() . '/inc/images/sample-page1.png' ; // always use preg replace to be sure that "space" will not break logic
    $data['custom_class'] = 'digitallaw_home_2_template';
    $data['content']    = <<<CONTENTTTTTTTTTTT
[vc_row css=".vc_custom_1456131888309{padding-bottom: 0px !important;}"][vc_column width="1/2"][vc_row_inner][vc_column_inner width="1/2"][tm-servicebox h2="REAL ESTATE LAW" txt_align="left" add_icon="topleft" i_on_border="" i_type="linecons" i_icon_linecons="vc_li vc_li-shop" i_background_style="none"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum..[/tm-servicebox][/vc_column_inner][vc_column_inner width="1/2"][tm-servicebox h2="CRIMINAL LAW" txt_align="left" add_icon="topleft" i_on_border="" i_type="linecons" i_icon_linecons="vc_li vc_li-lock" i_background_style="none"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum..[/tm-servicebox][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/2"][tm-servicebox h2="LEGAL ADVICE" txt_align="left" add_icon="topleft" i_on_border="" i_type="linecons" i_icon_linecons="vc_li vc_li-note" i_background_style="none"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum..[/tm-servicebox][/vc_column_inner][vc_column_inner width="1/2"][tm-servicebox h2="EMPLOYMENT LAW" txt_align="left" add_icon="topleft" i_on_border="" i_type="linecons" i_icon_linecons="vc_li vc_li-user" i_background_style="none"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum..[/tm-servicebox][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/2"][vc_single_image image="9576" img_size="full" alignment="center" css=".vc_custom_1456133377780{margin-bottom: 0px !important;}"][/vc_column][/vc_row][vc_row full_width="stretch_row" bgtype="grey" css=".vc_custom_1456300875098{padding-bottom: 70px !important;}"][vc_column][tm-portfoliobox h2="OUR PRACTICE AREAS" txt_align="left" h4="Check out our possibilities"][/vc_column][/vc_row][vc_row full_width="stretch_row" bgtype="skin" css=".vc_custom_1457083896545{padding-top: 140px !important;background-image: url(http://digitallaw.thememountdemo.com/wp-content/uploads/2016/02/pr-img3.jpg?id=9331) !important;}"][vc_column][vc_icon type="linecons" icon_linecons="vc_li vc_li-study" color="white" size="xl" align="center" css=".vc_custom_1456301162208{padding-bottom: 10px !important;}"][vc_custom_heading text="Check out our great features, we hope you enjoy it." font_container="tag:h2|font_size:21px|text_align:center|line_height:25px" google_fonts="font_family:Lora%3Aregular%2Citalic%2C700%2C700italic|font_style:400%20italic%3A400%3Aitalic"][vc_custom_heading text="SAY HELLO TO <strong>DIGITAL LAW</strong>" font_container="tag:h2|font_size:55px|text_align:center|line_height:60px" google_fonts="font_family:Roboto%20Condensed%3A300%2C300italic%2Cregular%2Citalic%2C700%2C700italic|font_style:300%20light%20regular%3A300%3Anormal"][vc_btn title="talk to lawyer" style="outline" color="white" align="center" css=".vc_custom_1456301114904{padding-top: 20px !important;}"][/vc_column][/vc_row][vc_row css=".vc_custom_1456309234365{padding-bottom: 30px !important;}"][vc_column width="1/3"][tm-heading h2="ABOUT DIGITALLAW" h4="Company Quality"][vc_tta_accordion shape="square" color="white" gap="10" active_section="1"][vc_tta_section i_type="linecons" i_icon_linecons="vc_li vc_li-like" title="Choose Company Law" tab_id="1456301258004-f6ac1659-39b1" add_icon="true"][vc_column_text]Mauris in quam tristique, dignissim urna in, molestie felis. Fusce tristique, elit nec vehicula imperdiet, eros est egestas odio, at aliquet elit[/vc_column_text][/vc_tta_section][vc_tta_section i_type="linecons" i_icon_linecons="vc_li vc_li-bulb" title="Our Company Vission" tab_id="1456301258052-77a8806b-99b3" add_icon="true"][vc_column_text]Mauris in quam tristique, dignissim urna in, molestie felis. Fusce tristique, elit nec vehicula imperdiet, eros est egestas odio, at aliquet elit.[/vc_column_text][/vc_tta_section][vc_tta_section i_type="linecons" i_icon_linecons="vc_li vc_li-megaphone" title="Our Company Strategy" tab_id="1456308251137-de6623ac-beae" add_icon="true"][vc_column_text]Mauris in quam tristique, dignissim urna in, molestie felis. Fusce tristique, elit nec vehicula imperdiet, eros est egestas odio, at aliquet elit[/vc_column_text][/vc_tta_section][vc_tta_section i_type="linecons" i_icon_linecons="vc_li vc_li-study" title="Legal Representation" tab_id="1456308495551-78a791b2-7612" add_icon="true"][vc_column_text]Mauris in quam tristique, dignissim urna in, molestie felis. Fusce tristique, elit nec vehicula imperdiet, eros est egestas odio, at aliquet elit[/vc_column_text][/vc_tta_section][/vc_tta_accordion][/vc_column][vc_column width="2/3"][tm-testimonial h2="WHAT CLIENTS SAY?" txt_align="left" show="2" column="two" h4="About clients reviews"][/vc_column][/vc_row][vc_row css=".vc_custom_1457083987775{padding-top: 0px !important;padding-bottom: 70px !important;}"][vc_column][tm-clients h2="" txt_align="left" show="4" view="default" column="four"][/vc_column][/vc_row][vc_row full_width="stretch_row_content_no_spaces" textcolor="white" css=".vc_custom_1458192675733{padding-top: 0px !important;padding-bottom: 0px !important;background-image: url(http://digitallaw.thememountdemo.com/wp-content/uploads/2015/09/image8.jpg?id=9680) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}" equalheight="true"][vc_column width="1/2"][/vc_column][vc_column width="1/2" css=".vc_custom_1456310759265{padding-top: 4% !important;padding-right: 6% !important;padding-bottom: 3% !important;padding-left: 4% !important;background-color: rgba(12,12,12,0.65) !important;*background-color: rgb(12,12,12) !important;}"][vc_custom_heading text="AWESOME THEME FEATURES" font_container="tag:h2|font_size:25px|text_align:left|color:%23ffffff|line_height:30px" google_fonts="font_family:Roboto%20Condensed%3A300%2C300italic%2Cregular%2Citalic%2C700%2C700italic|font_style:700%20bold%20regular%3A700%3Anormal"][vc_custom_heading text="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." font_container="tag:h4|font_size:17px|text_align:left|color:%23ffffff|line_height:22px" google_fonts="font_family:Roboto%20Condensed%3A300%2C300italic%2Cregular%2Citalic%2C700%2C700italic|font_style:400%20italic%3A400%3Aitalic"][vc_row_inner][vc_column_inner width="1/2" offset="vc_col-lg-4"][tm-list line1="UHJhY3RpY2UlMjBBcmVhcw==" line2="UmVjZW50JTIwQ2FzZXM=" line3="VGVhbSUyME1lbWJlcnM=" line4="T2ZmaWNlJTIwTG9jYXRpb25z" line5="SW52ZXN0aWdhdGlvbg=="][/vc_column_inner][vc_column_inner width="1/2"][tm-list line1="RmFtaWx5JTIwTGF3" line2="RmlyZSUyMEFjY2lkZW50" line3="U2V4dWFsJTIwT2ZmZW5jZXM=" line4="RHJ1ZyUyME9mZmVuY2Vz" line5="RmluYW5jaWFsJTIwTGF3"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row full_width="stretch_row" parallax="content-moving" parallax_speed_bg="4.5" bgtype="skin" css=".vc_custom_1456559790884{padding-top: 70px !important;padding-bottom: 30px !important;background-image: url(http://digitallaw.thememountdemo.com/wp-content/uploads/2016/02/pr-img7.jpg?id=9333) !important;background-position: center;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column width="1/4"][tm-facts-in-digits title="SOLVED CASES" icon_type="linecons" digit="25473"][/vc_column][vc_column width="1/4"][tm-facts-in-digits title="SUCCESFULL CASES" icon_type="linecons" icon_icon_linecons="vc_li vc_li-like" digit="14578"][/vc_column][vc_column width="1/4"][tm-facts-in-digits title="TRUSTED CLIENTS" icon_type="linecons" icon_icon_linecons="vc_li vc_li-bulb" digit="12475"][/vc_column][vc_column width="1/4"][tm-facts-in-digits title="RECOVERED CLIENTS" icon_type="linecons" icon_icon_linecons="vc_li vc_li-lab" digit="25473"][/vc_column][/vc_row][vc_row css=".vc_custom_1457084038399{padding-bottom: 70px !important;}"][vc_column][tm-team h2="MEET OUR ATTORNEYS" txt_align="left" boxdesign="default" groupslug="bank-and-financial,capital-market,car-accident,construction-law,dispute-resolution,employment-law,family-law,insurance-law,nationality-law" show="6" view="carousel" h4="We are with awesome people"][/vc_column][/vc_row][vc_row full_width="stretch_row" parallax="content-moving" parallax_speed_bg="4.5" bgtype="grey" css=".vc_custom_1457084077663{padding-bottom: 50px !important;background-image: url(http://digitallaw.thememountdemo.com/wp-content/uploads/2016/02/pr-img4.jpg?id=9337) !important;background-position: center;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column width="2/3"][tm-blogbox h2="RECENT NEWS" txt_align="left" category="bank-and-financial,corporate,employment-law,family-law" show="2" column="two" h4="Whats going on"][/vc_column][vc_column width="1/3"][tm-heading h2="MAKE AN APPOINTMENT" h4="How we can help you"][contact-form-7 id="9712"][/vc_column][/vc_row]
CONTENTTTTTTTTTTT;
	$maindata[] = $data;
	
	
	
	// 3rd sample: Home Version 2
    $data               = array();
    $data['name']       = esc_html__( 'Home Version 2', 'digitallaw' );
    $data['image_path'] = get_template_directory_uri() . '/inc/images/sample-page2.png' ; // always use preg replace to be sure that "space" will not break logic
    $data['custom_class'] = 'digitallaw_home_3_template';
    $data['content']    = <<<CONTENTTTTTTTTTTT
[vc_row full_width="stretch_row_content_no_spaces" css=".vc_custom_1457690928663{padding-top: 0px !important;padding-bottom: 0px !important;}"][vc_column width="1/2" bgcolor="skin" css=".vc_custom_1457691070402{margin-bottom: 0px !important;padding-top: 5% !important;padding-right: 4% !important;padding-bottom: 4% !important;padding-left: 14% !important;background-image: url(http://digitallaw.thememountdemo.com/wp-content/uploads/2016/02/pr-img6.jpg?id=9327) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_custom_heading text="WHO WE ARE" font_container="tag:h2|text_align:right" use_theme_fonts="yes"][vc_custom_heading text="Professional and highly trained" font_container="tag:h4|font_size:19px|text_align:right|line_height:23px" google_fonts="font_family:Lora%3Aregular%2Citalic%2C700%2C700italic|font_style:400%20italic%3A400%3Aitalic"][vc_custom_heading text="Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim." font_container="tag:p|text_align:right" use_theme_fonts="yes"][vc_empty_space height="15px"][vc_btn title="VIEW MORE" style="outline" shape="square" color="white" size="sm" align="right" link="url:%23||"][/vc_column][vc_column width="1/2" bgcolor="dark" css=".vc_custom_1457691080689{margin-bottom: 0px !important;padding-top: 5% !important;padding-right: 14% !important;padding-bottom: 4% !important;padding-left: 4% !important;background-image: url(http://digitallaw.thememountdemo.com/wp-content/uploads/2015/09/bg-12.jpg?id=10252) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_custom_heading text="FREE CONSULTATION" use_theme_fonts="yes"][vc_custom_heading text="Don't hesitate to ask" font_container="tag:h4|font_size:19px|text_align:left|line_height:23px" google_fonts="font_family:Lora%3Aregular%2Citalic%2C700%2C700italic|font_style:400%20italic%3A400%3Aitalic"][vc_custom_heading text="Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim." font_container="tag:p|text_align:left" use_theme_fonts="yes"][vc_empty_space height="15px"][vc_btn title="BOOK APPOINTMENT" style="outline" shape="square" color="white" size="sm" align="left" link="url:%23||"][/vc_column][/vc_row][vc_row full_width="stretch_row" parallax="content-moving" parallax_speed_bg="5.0" bgtype="grey" css=".vc_custom_1457084247462{padding-bottom: 70px !important;background-image: url(http://digitallaw.thememountdemo.com/wp-content/uploads/2016/02/pr-img7.jpg?id=9333) !important;}"][vc_column][vc_row_inner][vc_column_inner width="1/4"][tm-servicebox h2="DEATH CASES" i_on_border="" i_icon_fontawesome="fa fa-file-text-o" i_background_style="none"]At vero eos et accusamus et iusto odio dignissimos ducimus .[/tm-servicebox][/vc_column_inner][vc_column_inner width="1/4"][tm-servicebox h2="BUSINESS LITIGATION" i_on_border="" i_icon_fontawesome="fa fa-signal" i_background_style="none"]At vero eos et accusamus et iusto odio dignissimos ducimus .[/tm-servicebox][/vc_column_inner][vc_column_inner width="1/4"][tm-servicebox h2="PROPERTY LITIGATION" i_on_border="" i_icon_fontawesome="fa fa-qrcode" i_background_style="none"]At vero eos et accusamus et iusto odio dignissimos ducimus .[/tm-servicebox][/vc_column_inner][vc_column_inner width="1/4"][tm-servicebox h2="MEDICAL INJURIES" i_on_border="" i_icon_fontawesome="fa fa-medkit" i_background_style="none"]At vero eos et accusamus et iusto odio dignissimos ducimus .[/tm-servicebox][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/4"][tm-servicebox h2="AUTO ACCIDENTS" i_on_border="" i_icon_fontawesome="fa fa-rocket" i_background_style="none"]At vero eos et accusamus et iusto odio dignissimos ducimus .[/tm-servicebox][/vc_column_inner][vc_column_inner width="1/4"][tm-servicebox h2="PRODUCT LIABILITY" i_on_border="" i_icon_fontawesome="fa fa-leaf" i_background_style="none"]At vero eos et accusamus et iusto odio dignissimos ducimus .[/tm-servicebox][/vc_column_inner][vc_column_inner width="1/4"][tm-servicebox h2="CRIMINAL LAW" i_on_border="" i_icon_fontawesome="fa fa-building-o" i_background_style="none"]At vero eos et accusamus et iusto odio dignissimos ducimus .[/tm-servicebox][/vc_column_inner][vc_column_inner width="1/4"][tm-servicebox h2="EMPLOYMENT LAW" i_on_border="" i_icon_fontawesome="fa fa-male" i_background_style="none"]At vero eos et accusamus et iusto odio dignissimos ducimus .[/tm-servicebox][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row css=".vc_custom_1457084296569{padding-bottom: 60px !important;}"][vc_column width="1/4"][tm-heading h2="OUR ATTORNEYS" h4="Trusted Team"][vc_column_text]Lorem ipsum dolor sit amet, consectetur Adipisicing elit, sed do eiusmod tempor Incididunt ut labore et dolore magna aliqua Sed do eiusmod tempor ed do eiusmod tempor Incididunt ut labore et dolore magna aliqua.[/vc_column_text][vc_btn title="MORE ATTORNEY" i_align="right" i_icon_fontawesome="fa fa-chevron-circle-right" link="url:%23||" add_icon="true" css=".vc_custom_1456391894490{margin-top: -15px !important;}"][/vc_column][vc_column width="3/4"][tm-team h2="" boxdesign="default" groupslug="bank-and-financial,capital-market,car-accident,construction-law,dispute-resolution,employment-law,family-law,insurance-law,nationality-law" show="5" view="carousel" column="three"][/vc_column][/vc_row][vc_row full_width="stretch_row" parallax="content-moving" parallax_speed_bg="4.5" bgtype="dark" css=".vc_custom_1456562394811{padding-bottom: 60px !important;background-image: url(http://digitallaw.thememountdemo.com/wp-content/uploads/2016/02/pr-img7.jpg?id=9333) !important;background-position: center;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column width="1/4"][tm-facts-in-digits title="CASES STUDIES" icon_align="left" icon_type="linecons" icon_icon_linecons="vc_li vc_li-paperplane" digit="25473"][/vc_column][vc_column width="1/4"][tm-facts-in-digits title="QUALIFIED LAWYERS" icon_align="left" icon_type="linecons" icon_icon_linecons="vc_li vc_li-user" digit="14578"][/vc_column][vc_column width="1/4"][tm-facts-in-digits title="HONORS &amp; AWARDS" icon_align="left" icon_type="linecons" icon_icon_linecons="vc_li vc_li-study" digit="12475"][/vc_column][vc_column width="1/4"][tm-facts-in-digits title="SUCCESSFUL CASES" icon_align="left" icon_type="linecons" icon_icon_linecons="vc_li vc_li-like" digit="8756"][/vc_column][/vc_row][vc_row full_width="stretch_row" bgtype="grey" css=".vc_custom_1457084462121{padding-bottom: 50px !important;}"][vc_column width="1/3"][tm-heading h2="LATEST NEWS" h4="Check Out"][vc_column_text]Lorem ipsum dolor sit amet, consectetur Adipisicing elit, sed do eiusmod tempor Incididunt ut labore et dolore magna aliqua Sed do eiusmod

Tempor ed do eiusmod tempor Incididunt ut labore et dolore magna aliqua. Maecenas volutpat, diam enim sagittis quam, id porta quam.[/vc_column_text][vc_btn title="MORE NEWS" i_align="right" i_icon_fontawesome="fa fa-chevron-circle-right" link="url:%23||" add_icon="true" css=".vc_custom_1457432360369{margin-top: -15px !important;}"][/vc_column][vc_column width="2/3"][tm-blogbox h2="" category="bank-and-financial,corporate,employment-law,family-law" show="2" column="two"][/vc_column][/vc_row][vc_row css=".vc_custom_1456653483002{padding-bottom: 10px !important;}"][vc_column width="1/3" css=".vc_custom_1456652510389{background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][tm-servicebox h2="RETALIATION" h2_font_container="font_size:20px|color:%23ffffff|line_height:25px" h2_google_fonts="font_family:Roboto%20Condensed%3A300%2C300italic%2Cregular%2Citalic%2C700%2C700italic|font_style:700%20bold%20regular%3A700%3Anormal" h4_font_container="font_size:15px|color:%23ffffff|line_height:20px" h4_google_fonts="font_family:Lora%3Aregular%2Citalic%2C700%2C700italic|font_style:400%20italic%3A400%3Aitalic" i_on_border="" i_type="linecons" i_icon_linecons="vc_li vc_li-like" i_color="white" i_background_style="none" i_size="lg" css=".vc_custom_1456653362367{padding-top: 3% !important;padding-bottom: 2% !important;background: rgba(0,0,0,0.81) url(http://digitallaw.thememountdemo.com/wp-content/uploads/2015/12/image6.jpg?id=9194) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;*background-color: rgb(0,0,0) !important;}" use_custom_fonts_h2="true" h4=" Stop before it causes a big trouble " use_custom_fonts_h4="true"][/tm-servicebox][/vc_column][vc_column width="1/3"][tm-servicebox h2="PERSONAL INJURY LAW" h2_font_container="font_size:20px|color:%23ffffff|line_height:25px" h2_google_fonts="font_family:Roboto%20Condensed%3A300%2C300italic%2Cregular%2Citalic%2C700%2C700italic|font_style:700%20bold%20regular%3A700%3Anormal" h4_font_container="font_size:15px|color:%23ffffff|line_height:20px" h4_google_fonts="font_family:Lora%3Aregular%2Citalic%2C700%2C700italic|font_style:400%20italic%3A400%3Aitalic" i_on_border="" i_type="linecons" i_icon_linecons="vc_li vc_li-user" i_color="white" i_background_style="none" i_size="lg" css=".vc_custom_1456653297566{padding-top: 3% !important;padding-bottom: 2% !important;background: rgba(157,192,46,0.91) url(http://digitallaw.thememountdemo.com/wp-content/uploads/2015/09/tm-homeimage3.jpg?id=9796) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;*background-color: rgb(157,192,46) !important;}" use_custom_fonts_h2="true" h4="Anything Related to Employment" use_custom_fonts_h4="true"][/tm-servicebox][/vc_column][vc_column width="1/3"][tm-servicebox h2="CASE FIGHT" h2_font_container="font_size:20px|color:%23ffffff|line_height:25px" h2_google_fonts="font_family:Roboto%20Condensed%3A300%2C300italic%2Cregular%2Citalic%2C700%2C700italic|font_style:700%20bold%20regular%3A700%3Anormal" h4_font_container="font_size:15px|color:%23ffffff|line_height:20px" h4_google_fonts="font_family:Lora%3Aregular%2Citalic%2C700%2C700italic|font_style:400%20italic%3A400%3Aitalic" i_on_border="" i_type="linecons" i_icon_linecons="vc_li vc_li-paperplane" i_color="white" i_background_style="none" i_size="lg" css=".vc_custom_1456830945070{padding-top: 3% !important;padding-bottom: 2% !important;background: rgba(0,0,0,0.81) url(http://digitallaw.thememountdemo.com/wp-content/uploads/2015/09/tm-image11.jpg?id=9911) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;*background-color: rgb(0,0,0) !important;}" use_custom_fonts_h2="true" h4="We will fight your case in court" use_custom_fonts_h4="true"][/tm-servicebox][/vc_column][/vc_row][vc_row css=".vc_custom_1457084638660{padding-top: 60px !important;padding-bottom: 50px !important;}"][vc_column width="1/2"][tm-testimonial h2="Testimonials" txt_align="left" view="carousel" column="one" h4="About clients reviews"][/vc_column][vc_column width="1/2"][tm-heading h2="OUR SKILLS" h4="Well covered &amp; efficient"][vc_progress_bar values="%5B%7B%22label%22%3A%22BUSINESS%20LAW%22%2C%22value%22%3A%2295%22%2C%22color%22%3A%22skincolor%22%7D%2C%7B%22label%22%3A%22DWI%20DEFENSE%22%2C%22value%22%3A%2268%22%2C%22color%22%3A%22skincolor%22%7D%2C%7B%22label%22%3A%22FAMILY%20LAW%22%2C%22value%22%3A%2285%22%2C%22color%22%3A%22skincolor%22%7D%2C%7B%22label%22%3A%22PERSONAL%20INJURY%22%2C%22value%22%3A%2289%22%2C%22color%22%3A%22skincolor%22%7D%2C%7B%22label%22%3A%22BANKRUPTCY%20LAW%22%2C%22value%22%3A%2277%22%2C%22color%22%3A%22skincolor%22%7D%5D" units="%" css=".vc_custom_1456403208646{margin-top: 45px !important;}"][/vc_column][/vc_row][vc_row full_width="stretch_row" bgtype="grey" css=".vc_custom_1457084569936{padding-bottom: 70px !important;}"][vc_column width="1/4"][tm-heading h2="OUR CLIENTS" h4="They Trust Us"][vc_column_text]Lorem ipsum dolor sit amet, consectetur Adipisicing elit, sed do eiusmod tempor Incididunt ut labore et dolore magna aliqua Sed do eiusmod tempor ed do eiusmod tempor Incididunt ut labore et dolore magna aliqua.[/vc_column_text][vc_btn title="MORE CLIENTS" i_align="right" i_icon_fontawesome="fa fa-chevron-circle-right" link="url:%23||" add_icon="true" css=".vc_custom_1457432340108{margin-top: -15px !important;}"][/vc_column][vc_column width="3/4"][tm-clients h2="" show="6" view="default" column="three"][/vc_column][/vc_row]
CONTENTTTTTTTTTTT;
	$maindata[] = $data;
	
	
	
	// 4th sample: Home Version 3
    $data               = array();
    $data['name']       = esc_html__( 'Home Version 3', 'digitallaw' );
    $data['image_path'] = get_template_directory_uri() . '/inc/images/sample-page3.png' ; // always use preg replace to be sure that "space" will not break logic
    $data['custom_class'] = 'digitallaw_home_4_template';
    $data['content']    = <<<CONTENTTTTTTTTTTT
[vc_row css=".vc_custom_1457084889613{padding-bottom: 60px !important;}"][vc_column width="1/2"][vc_custom_heading text="WELCOME TO DIGITAL LAW" font_container="tag:h2|text_align:left|line_height:30px" use_theme_fonts="yes"][vc_custom_heading text="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua." font_container="tag:p|font_size:17px|text_align:left|line_height:24px" google_fonts="font_family:Roboto%20Condensed%3A300%2C300italic%2Cregular%2Citalic%2C700%2C700italic|font_style:400%20italic%3A400%3Aitalic" css=".vc_custom_1456835819141{padding-bottom: 30px !important;}"][tm-servicebox h2="CASES FIGHTING" txt_align="left" add_icon="left" i_on_border="" i_color="white" i_background_style="rounded-less" i_background_color="skincolor" i_size="lg"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum..[/tm-servicebox][tm-servicebox h2="LEGAL ADVICE" txt_align="left" add_icon="left" i_on_border="" i_icon_fontawesome="fa fa-location-arrow" i_color="white" i_background_style="rounded-less" i_background_color="skincolor" i_size="lg"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum..[/tm-servicebox][tm-servicebox h2="PERSONAL INJURY" txt_align="left" add_icon="left" i_on_border="" i_icon_fontawesome="fa fa-info" i_color="white" i_background_style="rounded-less" i_background_color="skincolor" i_size="lg"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum..[/tm-servicebox][/vc_column][vc_column width="1/2"][vc_single_image image="9796" img_size="full"][vc_column_text]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.[/vc_column_text][/vc_column][/vc_row][vc_row full_width="stretch_row_content_no_spaces" bgtype="grey" css=".vc_custom_1457085519788{padding-top: 70px !important;padding-bottom: 0px !important;}"][vc_column][tm-portfoliobox h2="OUR PRACTICE AREAS" show="8" pdesign="nopadding" column="four" h4="Some of our work"][/vc_column][/vc_row][vc_row css=".vc_custom_1457084999495{padding-bottom: 65px !important;}"][vc_column][tm-team h2="Attorneys Team" boxdesign="leftimage" groupslug="bank-and-financial,capital-market,car-accident,construction-law,dispute-resolution,employment-law,family-law,insurance-law,nationality-law" column="two" h4="Our Expert"][/vc_column][/vc_row][vc_row full_width="stretch_row_content_no_spaces" bgtype="grey" equalheight="true" css=".vc_custom_1456553805462{padding-top: 0px !important;padding-bottom: 0px !important;}"][vc_column width="1/2" css=".vc_custom_1456553647678{background-image: url(http://digitallaw.thememountdemo.com/wp-content/uploads/2015/09/tm-image11.jpg?id=9911) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][/vc_column][vc_column width="1/2" css=".vc_custom_1457085052845{padding-top: 5% !important;padding-right: 4% !important;padding-bottom: 4% !important;padding-left: 4% !important;}"][vc_custom_heading text="WHY CHOOSE US?" font_container="tag:h2|text_align:left|line_height:30px" use_theme_fonts="yes"][vc_custom_heading text="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua." font_container="tag:p|font_size:17px|text_align:left|line_height:24px" google_fonts="font_family:Roboto%20Condensed%3A300%2C300italic%2Cregular%2Citalic%2C700%2C700italic|font_style:400%20italic%3A400%3Aitalic" css=".vc_custom_1456835801896{padding-bottom: 30px !important;}"][tm-servicebox h2="BEST CASE STRATEGY" txt_align="left" add_icon="left" i_on_border="" i_type="linecons" i_icon_linecons="vc_li vc_li-megaphone" i_background_color="skincolor" i_size="lg" el_class="tm-connected"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum..[/tm-servicebox][tm-servicebox h2="REVIEW YOUR CASE DOCUMENTS" txt_align="left" add_icon="left" i_on_border="" i_type="linecons" i_icon_linecons="vc_li vc_li-lab" i_background_color="skincolor" i_size="lg" el_class="tm-connected"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum..[/tm-servicebox][tm-servicebox h2="FIGHT FOR JUSTICE" txt_align="left" add_icon="left" i_on_border="" i_type="linecons" i_icon_linecons="vc_li vc_li-world" i_background_color="skincolor" i_size="lg" el_class="tm-connected"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum..[/tm-servicebox][/vc_column][/vc_row][vc_row css=".vc_custom_1456558338917{padding-bottom: 50px !important;}"][vc_column width="1/3"][vc_single_image image="9924" img_size="full"][/vc_column][vc_column width="2/3"][vc_custom_heading text="ABOUT OUR SKILLS" font_container="tag:h2|font_size:26px|text_align:left|line_height:30px" google_fonts="font_family:Roboto%20Condensed%3A300%2C300italic%2Cregular%2Citalic%2C700%2C700italic|font_style:700%20bold%20regular%3A700%3Anormal"][vc_custom_heading text="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua." font_container="tag:p|font_size:17px|text_align:left|line_height:24px" google_fonts="font_family:Roboto%20Condensed%3A300%2C300italic%2Cregular%2Citalic%2C700%2C700italic|font_style:400%20italic%3A400%3Aitalic" css=".vc_custom_1456556867535{margin-bottom: 0px !important;padding-bottom: 30px !important;}"][vc_column_text]Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam.[/vc_column_text][vc_separator][vc_row_inner][vc_column_inner width="1/3"][tm-facts-in-digits title="SOLVED CASES" icon_type="linecons" icon_icon_linecons="vc_li vc_li-study" digit="25473"][/vc_column_inner][vc_column_inner width="1/3"][tm-facts-in-digits title="TRUSTED CLIENTS" icon_type="linecons" icon_icon_linecons="vc_li vc_li-user" digit="35481"][/vc_column_inner][vc_column_inner width="1/3"][tm-facts-in-digits title="CASE STUDIES" icon_type="linecons" icon_icon_linecons="vc_li vc_li-settings" digit="4587"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row css=".vc_custom_1458391125903{padding-top: 0px !important;padding-bottom: 100px !important;}"][vc_column][tm-clients h2="" show="6" column="four" carousel_dots="false" carousel_nav="true"][/vc_column][/vc_row][vc_row full_width="stretch_row_content" bgtype="skin" css=".vc_custom_1457085424563{padding-top: 0px !important;padding-bottom: 0px !important;}" equalheight="true"][vc_column width="1/2" css=".vc_custom_1456553900604{padding-top: 4% !important;padding-right: 3% !important;padding-bottom: 3.5% !important;padding-left: 3% !important;}"][vc_custom_heading text="Fill out the form below, we will get back you soon." font_container="tag:h2|font_size:16px|text_align:center" google_fonts="font_family:Lora%3Aregular%2Citalic%2C700%2C700italic|font_style:400%20italic%3A400%3Aitalic" css=".vc_custom_1456551879872{margin-bottom: 7px !important;}"][vc_custom_heading text="REQUEST A CONSULTATION TOTALLY FREE" font_container="tag:h2|text_align:center" use_theme_fonts="yes" css=".vc_custom_1456551898111{margin-bottom: 40px !important;}"][vc_column_text css=".vc_custom_1456553310043{margin-bottom: 15px !important;}"][contact-form-7 id="8107" title="Homepage Appointment form"][/vc_column_text][vc_row_inner][vc_column_inner][vc_custom_heading text="Have Questions? Ask Your Lawyer" font_container="tag:h3|font_size:24px|text_align:center|line_height:25px" google_fonts="font_family:Lora%3Aregular%2Citalic%2C700%2C700italic|font_style:400%20italic%3A400%3Aitalic" css=".vc_custom_1456837037034{margin-bottom: 10px !important;padding-top: 10px !important;}"][vc_custom_heading text="7 days a week from 8:00am to 5:00pm" font_container="tag:h3|font_size:16px|text_align:center|line_height:25px" google_fonts="font_family:Lora%3Aregular%2Citalic%2C700%2C700italic|font_style:400%20italic%3A400%3Aitalic" css=".vc_custom_1457433080553{margin-bottom: 16px !important;}"][vc_custom_heading text="1 234 500 7007" font_container="tag:h2|font_size:29px|text_align:center|line_height:30px" use_theme_fonts="yes" css=".vc_custom_1456836905257{margin-bottom: 16px !important;}"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/2" css=".vc_custom_1455359522290{background-image: url(http://digitallaw.thememountdemo.com/wp-content/uploads/2015/12/image3.jpg?id=9191) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][/vc_column][/vc_row]
CONTENTTTTTTTTTTT;
	$maindata[] = $data;
	
	

	
	
	
	/************* END of Visual Composer Template list ***************/
	
	
	// Return all VC templates
	return $maindata;
	
}





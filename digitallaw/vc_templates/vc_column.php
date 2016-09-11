<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column
 */
$el_class = $width = $css = $offset = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

/*ThemeMount Custom Classes*/
$thememountClass  = 'tm-col-textcolor-'.$textcolor;
$thememountClass .= ' tm-col-bgcolor-'.$bgcolor;

$bg_color = array('skin','dark','grey');
$tm_main  = '';
$colorbg  = false;

if(in_array($bgcolor, $bg_color)){
	$colorbg  = true;
}


$bgimage 		  = digitallaw_CheckBGImage($css);
$customDiv 		  = '';
if($bgimage==true || $css!='' || $colorbg==true ){
	$thememountClass .= ' tm-col-main';
	$customDiv 		  = '<div class="tm-col-overlay"></div>';
}

if($bgimage==true){
	$thememountClass .= ' tm-col-background-image';
}

$css_classes = array(
	$this->getExtraClass( $el_class ),
	'wpb_column',
	'vc_column_container',
	$thememountClass, // Added by ThemeMount
	$width,
);

if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
	$css_classes[]='vc_col-has-fill';
}

$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

$css_class .= ' '.esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) );  // Added by ThemeMount

$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';


$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= $customDiv;  // Added by ThemeMount
$output .= '<div class="vc_column-inner">';  // modified by ThemeMount
$output .= '<div class="wpb_wrapper">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

?>



<div <?php echo implode( ' ', $wrapper_attributes ); ?>>
<?php echo trim($customDiv);  // Added by ThemeMount ?>
	<div class="vc_column-inner">
		<div class="wpb_wrapper">
			<?php echo wpb_js_remove_wpautop( $content ); ?>
		</div>
	</div>
</div>




<?php

/* Added by ThemeMount - code start */
$customStyle = '';
if(trim($css)!= ''){
		$customStyle 	    .= '<div><style scoped>';
		$new_bgimage_element = vc_shortcode_custom_css_class( $css, '' ). ' .tm-col-overlay';
		$newCSS   			 = str_replace( vc_shortcode_custom_css_class( $css, '' ),$new_bgimage_element,$css );
		$customStyle  		.= $newCSS;
		$customStyle  		.= '.'.$new_bgimage_element.'{background-image: none !important;}';
		$customStyle 		.= '</style></div>';
		
		echo trim($customStyle); // We are not sanitize this because we are expecting css and HTML both content
	}
	
/* Added by ThemeMount - code end */
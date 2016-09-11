<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $equal_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $parallax_speed_bg
 * @var $parallax_speed_video
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = '';
$disable_element = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );



/**************** ThemeMount custom code *****************/
$thememount_class  = 'tm-row-textcolor-'.$textcolor;  // Text Color
$thememount_class .= ' tm-row-bgtype-'.$bgtype;  // BG Type
$thememount_class .= ($equalheight=='true') ? ' tm-equalheightdiv' : '' ; // Equal Height class
$thememount_class .= ($break_in_responsive_996=='true') ? ' tm-responsive-col-992' : '' ; // break column in resposinve mode

// Check if background image set
$bgimage = digitallaw_CheckBGImage($css);

// Overlay
if( $bgimage==true || trim($parallax_image)!='' ){
	$thememount_class .= ' tm-background-image';
}

// Dynamic Class:
$thememount_dynamic_class = 'tm-custom-'.rand(10000,99999);
/*********************************************************/



wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
	'vc_row',
	'wpb_row', //deprecated
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
	$thememount_class,         // Added by ThemeMount
	$thememount_dynamic_class, // Added by ThemeMount
);

if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') ) || $video_bg || $parallax) {
	$css_classes[]='vc_row-has-fill';
}


$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if ( ! empty( $full_width ) ) {
	$wrapper_attributes[] = 'data-vc-full-width="true"';
	$wrapper_attributes[] = 'data-vc-full-width-init="false"';
	if ( 'stretch_row_content' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
	} elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
		$css_classes[] = 'vc_row-no-padding';
	}
	$after_output .= '<div class="vc_row-full-width vc_clearfix"></div>';
}

if ( ! empty( $full_height ) ) {
	$css_classes[] = 'vc_row-o-full-height';
	if ( ! empty( $columns_placement ) ) {
		$flex_row = true;
		$css_classes[] = 'vc_row-o-columns-' . $columns_placement;
		if ( 'stretch' === $columns_placement ) {
			$css_classes[] = 'vc_row-o-equal-height';
		}
	}
}

if ( ! empty( $equal_height ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = 'vc_row-flex';
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

$parallax_speed = $parallax_speed_bg;
if ( $has_video_bg ) {
	$parallax = $video_bg_parallax;
	$parallax_speed = $parallax_speed_video;
	$parallax_image = $video_bg_url;
	$css_classes[] = 'vc_video-bg-container';
	wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

if ( ! empty( $parallax ) ) {
	wp_enqueue_script( 'vc_jquery_skrollr_js' );
	$wrapper_attributes[] = 'data-vc-parallax="' . esc_attr( $parallax_speed ) . '"'; // parallax speed
	$css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
	if ( false !== strpos( $parallax, 'fade' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fade';
		$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
	} elseif ( false !== strpos( $parallax, 'fixed' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fixed';
	}
}

if ( ! empty( $parallax_image ) ) {
	if ( $has_video_bg ) {
		$parallax_image_src = $parallax_image;
	} else {
		$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
		$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
		if ( ! empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}
	$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}
if ( ! $parallax && $has_video_bg ) {
	$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
?>

<div <?php echo implode( ' ', $wrapper_attributes ) ?>>
	<div class="tm-bg-overlay"></div><!-- ThemeMount custom DIV added -->
	<?php echo wpb_js_remove_wpautop( $content ); ?>
</div>
<?php
echo wp_kses( /* HTML Filter */
	$after_output,
	array(
		'div'    => array(
			'class' => array(),
		),
		'span'    => array(
			'class' => array(),
		),
		'p'    => array(
			'class' => array(),
		),
		'img' => array(
			'class'  => array(),
			'src'    => array(),
			'alt'    => array(),
			'title'  => array(),
			'width'  => array(),
			'height' => array(),
		),
	)
);


?>






<!-- ThemeMount custom CSS - Start -->

<?php if( trim($css)!='' ): ?>
	<!-- ThemeMount custom CSS - Start -->
    <div>
	<style type="text/css" scoped>
	<?php 
	$newElementForBG = vc_shortcode_custom_css_class( $css, '' ). ' .tm-bg-overlay';
	$newCSS          = str_replace( vc_shortcode_custom_css_class( $css, '' ),$newElementForBG,$css );
	?>
	<?php echo trim($newCSS); // we are not santizing this as we are expecting css here ?>
	.<?php echo esc_attr($newElementForBG); ?> { background-image: none !important; }
	
	<?php
	// fetching custom background color to apply it in tbe icon BG color. This is custom background color so we need to do special coding.
	$tmRowBgColor = '';
	$tmRowCustomOptions = str_replace('.'.vc_shortcode_custom_css_class( $css, '' ),'',$css);
	$tmRowCustomOptions = str_replace('{','',$tmRowCustomOptions);
	$tmRowCustomOptions = str_replace('}','',$tmRowCustomOptions);
	$tmRowCustomOptions = explode(';',$tmRowCustomOptions);
	foreach($tmRowCustomOptions as $tmRowCustomOption){
		if( substr($tmRowCustomOption, 0, 16 ) == 'background-color' || substr($tmRowCustomOption, 0, 17 ) == '*background-color' ){
			$tmRowBgColor = str_replace('*background-color','',$tmRowCustomOption);
			$tmRowBgColor = str_replace('background-color','',$tmRowBgColor);
			$tmRowBgColor = str_replace(':','',$tmRowBgColor);
			$tmRowBgColor = str_replace('!important','',$tmRowBgColor);
			$tmRowBgColor = trim($tmRowBgColor);
		}
	}
	?>
	
	<?php if( $tmRowBgColor!='' ){ ?>
	.<?php echo vc_shortcode_custom_css_class( $css, '' ) ?> .tm-sbox .vc_cta3-style-outline .vc_icon_element.vc_icon_element-outer .vc_icon_element-inner.vc_icon_element-outline {
		background-color: <?php echo trim($tmRowBgColor); // we are not santizing this as we are expecting CSS code here. ?>;
	}
	<?php }; ?>
	
	
	</style>
    </div>
	<!-- ThemeMount custom CSS - End -->
<?php endif; ?>


<!-- Patch: This is to remove the closing </p> tag which appear dynamically -->
<div class="tm-last-div-in-row"></div>

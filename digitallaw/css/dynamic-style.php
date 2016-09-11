<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Creating variable for theme options */
global $digitallaw_theme_options;



/*
 *  Generate dynamic style. Internal use only.
 */
if( isset($_GET['color']) && trim($_GET['color'])!='' ){
	$digitallaw_theme_options['skincolor'] = '#'.trim($_GET['color']);
}


/*
 *  Setting variables for different Theme Options
 */
$headerHeight        = ( !empty($digitallaw_theme_options['header-height']) ) ? esc_attr($digitallaw_theme_options['header-height']) : '79' ;
$firstMenuMargin     = ( !empty($digitallaw_theme_options['first-menu-margin']) ) ? esc_attr($digitallaw_theme_options['first-menu-margin']) : '50' ;
$tbar_height         = ( !empty($digitallaw_theme_options['tbar-height']) ) ? esc_attr($digitallaw_theme_options['tbar-height']) : '141' ;
$headerHeightSticky  = ( !empty($digitallaw_theme_options['header-height-sticky']) ) ? esc_attr($digitallaw_theme_options['header-height-sticky']) : '73' ;
$centerLogoWidth     = ( !empty($digitallaw_theme_options['center-logo-width']) ) ? esc_attr($digitallaw_theme_options['center-logo-width']) : '350' ;
$stickyheaderbgcolor = ( !empty($digitallaw_theme_options['stickyheaderbgcolor']['rgba']) ) ? trim($digitallaw_theme_options['stickyheaderbgcolor']['rgba']) : $digitallaw_theme_options['headerbgcolor']['rgba'] ;
$stickymainmenufontcolor  = ( !empty($digitallaw_theme_options['stickymainmenufontcolor']) ) ? trim(esc_attr($digitallaw_theme_options['stickymainmenufontcolor'])) : esc_attr($digitallaw_theme_options['mainmenufont']['color']) ;
$titlebar_bg_color_opacity = ( !empty($digitallaw_theme_options['titlebar_bg_color_opacity']) ) ? trim($digitallaw_theme_options['titlebar_bg_color_opacity']) : '75' ;
if($titlebar_bg_color_opacity>0){ $titlebar_bg_color_opacity = ($titlebar_bg_color_opacity/100);}



$logoMaxHeightSticky = ( !empty($digitallaw_theme_options['logo-max-height-sticky']) ) ? esc_attr($digitallaw_theme_options['logo-max-height-sticky']) : '35' ;

$mainMenuFontColor  = ( isset($digitallaw_theme_options['mainmenufont']['color']) && trim($digitallaw_theme_options['mainmenufont']['color'])!='' ) ? trim($digitallaw_theme_options['mainmenufont']['color']) : '#333333' ;



// Default border color
$sbarBorderColor = '#eaeaea';
if( isset($digitallaw_theme_options['inner_background']['background-color']) && trim($digitallaw_theme_options['inner_background']['background-color'])!=''){
	if( digitallaw_check_dark_color($digitallaw_theme_options['inner_background']['background-color']) ){
		// Lighten color
		$sbarBorderColor = digitallaw_adjustBrightness( $digitallaw_theme_options['inner_background']['background-color'] , 20);  // Steps should be between -255 and 255. Negative = darker, positive = lighter
	} else {
		// Darken color
		$sbarBorderColor = digitallaw_adjustBrightness( $digitallaw_theme_options['inner_background']['background-color'] , -20);  // Steps should be between -255 and 255. Negative = darker, positive = lighter
	}
}


// check if Redux is reset processing
global $digitallaw_dynamic_style_reset;
$reset = ( isset($digitallaw_dynamic_style_reset) && $digitallaw_dynamic_style_reset=='yes' ) ? 'y' : 'n' ;



/* Output start
------------------------------------------------------------------------------*/ ?>

<?php
/* Custom CSS Code at top */
if( !empty($digitallaw_theme_options['custom_css_code_top']) ){
	// We are not escaping / sanitizing as we are expecting css code. 
	echo trim($digitallaw_theme_options['custom_css_code_top']); 
}
?>

/*------------------------------------------------------------------
* dynamic-style.php index *
[Table of contents]

1.  Background color
2.  Topbar Background color
3.  Element Border color
4.  Textcolor
5.  Boxshadow
6.  Header / Footer background color
7.  Footer background color
8.  Logo Color
9.  Genral Elements
10. "Center Logo Between Menu" options

-------------------------------------------------------------------*/




/**
 * 1. Background color
 * ----------------------------------------------------------------------------
 */

body.error404 .site-main form .search-submit:hover,
.vc_tta.vc_tta-style-outline.vc_tta-color-skincolor .vc_tta-tab>a:hover,
.page-links > span,
.site-header .thememount-topbar a.tm-full-bt,
.tm-sbox.tm-sbox-iconalign-left:hover .vc_icon_element.vc_icon_element-outer .vc_icon_element-inner.vc_icon_element-background-color-white.vc_icon_element-outline,
.thememount-fbar-text-white.thememount-fbar-bg-darkgrey.thememount-fbar-box-w .submit_field button,
.thememount-fbar-text-white .widget_tag_cloud .tagcloud a:hover,
.thememount-portfolio-design-nopadding .item .icons .thememount-portfolio-likes,
.tm-taxonomy-term-list ul li a:hover,
.tm-taxonomy-term-list ul li.current-cat > a,
.nav-links a[rel="prev"]:hover, 
.nav-links a[rel="next"]:hover,
.tm-bcrumb-first-text:after,
.tm-social-share-w ul li > a:hover,
.tm-pf-proj-btn .vc_btn3-container a.vc_general.vc_btn3:hover,
.tm-pf-single-np-nav .vc_btn3-container a.vc_general.vc_btn3:hover,
.vc_tta-color-skincolor.vc_tta-style-outline .vc_tta-tab>a:hover,
.vc_tta-color-skincolor.vc_tta-style-classic .vc_tta-tab>a,
.vc_tta-color-skincolor.vc_tta-style-flat .vc_tta-panel.vc_active .vc_tta-panel-heading,
.vc_tta-color-skincolor.vc_tta-style-modern .vc_tta-panel .vc_tta-panel-heading,
.vc_tta-color-skincolor.vc_tta-style-flat .vc_tta-tab>a,
.vc_tta-color-skincolor.vc_tta-style-modern .vc_tta-tab>a,
.tm-connected.tm-sbox.tm-sbox-iconalign-left:after,
.vc_toggle_round.vc_toggle_color_skincolor .vc_toggle_icon,
.vc_toggle_round.vc_toggle_color_skincolor .vc_toggle_title:hover .vc_toggle_icon,
.tm-appo-form-new .tm-appo-submit input[type="submit"],
.vc_toggle_rounded.vc_toggle_color_inverted.vc_toggle_color_skincolor .vc_toggle_title:hover .vc_toggle_icon::after, 
.vc_toggle_rounded.vc_toggle_color_inverted.vc_toggle_color_skincolor .vc_toggle_title:hover .vc_toggle_icon::before,
.vc_toggle_round.vc_toggle_color_inverted.vc_toggle_color_skincolor .vc_toggle_icon::after, 
.vc_toggle_round.vc_toggle_color_inverted.vc_toggle_color_skincolor .vc_toggle_icon::before,
.vc_toggle_round.vc_toggle_color_inverted.vc_toggle_color_skincolor .vc_toggle_title:hover .vc_toggle_icon::after, 
.vc_toggle_round.vc_toggle_color_inverted.vc_toggle_color_skincolor .vc_toggle_title:hover .vc_toggle_icon::before,
.vc_toggle_square.vc_toggle_color_skincolor .vc_toggle_icon,
.vc_toggle_square.vc_toggle_color_skincolor .vc_toggle_title:hover .vc_toggle_icon,
.vc_toggle_rounded.vc_toggle_color_inverted.vc_toggle_color_skincolor .vc_toggle_icon::after, 
.vc_toggle_rounded.vc_toggle_color_inverted.vc_toggle_color_skincolor .vc_toggle_icon::before,
.header-controls .search_box a,
.tm-sresult-form-wrapper .tm-sresult-cpt-select option,
body .tm-sresult-form-wrapper,
.testimonials .testimonial-control:before, 
.thememount-fbar-btn.tm-fbar-bg-color-skincolor a,
.site-main .tm-carousel-arrows .thememount-carousel-controls-inner a.thememount-carousel-prev:hover,
.site-main .tm-carousel-arrows .thememount-carousel-controls-inner a.thememount-carousel-next:hover, 
.woocommerce .site-main #review_form #respond .form-submit input:hover,
.woocommerce #respond input#submit, 
.woocommerce a.button, 
.woocommerce button.button, .woocommerce input.button, 
.woocommerce-page #content input.button[name="apply_coupon"], 
.woocommerce #content input.button[name="apply_coupon"],
.single-product .yith-wcwl-add-to-wishlist a:hover, 
.single-product .thememount-products a.compare:hover,
.woocommerce .summary .single_add_to_cart_button.button.alt,
.portfolio-sortable-list ul li:hover a:before,
.productbox .yith-wcwl-add-to-wishlist a:hover, 
.productbox .yith-wcwl-add-to-wishlist a.add_to_wishlist:hover, 
.tm-sbox.tm-heading-with-separator .vc_general.vc_cta3 h2:after,
.tm-element-heading-wrapper.tm-heading-with-separator .vc_general.vc_cta3 h2:after,
.productbox .compare.button:hover,
.productbox .button.yith-wcqv-button,
.thememount-post-left,
.tm-timeline .date-wrap,
.entry-content .page-links a:hover,
.tparrows:hover,
button, 
input[type="submit"], 
input[type="button"], 
input[type="reset"],
.vc_general.vc_btn3.vc_btn3-color-skincolor,
.vc_general.vc_cta3.vc_cta3-color-skincolor.vc_cta3-style-flat,
.vc_general.vc_cta3.vc_cta3-color-skincolor.vc_cta3-style-3d,
.tm-col-bgcolor-skin .tm-col-overlay,
.tm-row-bgtype-skin .tm-bg-overlay,
.owl-carousel.owl-theme .owl-dots .owl-dot.active span, 
.owl-carousel.owl-theme .owl-dots .owl-dot:hover span,
.flex-control-paging li a.flex-active,
.thememount-postbox-small-date,
.vc_progress_bar.vc_progress-bar-color-skincolor .vc_single_bar .vc_bar,
.vc_progress_bar .vc_single_bar.skincolor .vc_bar,
.thememount-post-left .thememount-post-date-wrapper,
.thememount-btn-effect-colortoborder.thememount-btn-color-skincolor,
.thememount-row-bgtype-skin,
.thememount-btn-effect-colortogrey.thememount-btn-color-skincolor,
.thememount-btn-effect-colortodarkgrey.thememount-btn-color-skincolor, 
.thememount-wbar-bgcolor-skincolor,
.thememount-btn-effect-bordertocolor.thememount-btn-color-skincolor:hover,
.thememount-btn-effect-greytocolor.thememount-btn-color-skincolor:hover,
.thememount-btn-effect-darkgreytocolor.thememount-btn-color-skincolor:hover,
.thememount-ibgcolor-skincolor,
.tp-caption.themeline,
.vc_progress_bar .vc_single_bar .vc_bar.striped, 
.footersocialicon,
body .owl-theme .owl-controls .owl-buttons div:hover,
.flex-direction-nav a:hover,
.tagcloud a:hover,
.vc_btn_skincolor,
.wpb_skincolor,
.thememount-pf-btn .wpb_button_a .wpb_button,
.thememount-blogbox-btn .wpb_button_a .wpb_button,
.tp-caption.skin_divider,
.thememount-testimonial-icon,
.thememount-testimonial-wrapper .flex-control-paging li a.flex-active,
.wpb_gallery_slides .flex-control-paging li a.flex-active,
.thememount-pagination .page-numbers.current,
.thememount-pagination a.page-numbers:hover,
#totop:hover,
#bbpress-forums ul li.bbp-header,
.widget .bbp-logged-in .button,
.item:hover .item-content .thememount-portfolio-likes,
.single-team-left .thememount-team-social-links a:hover,
.tribe-events-list .tribe-events-event-cost span, 
.item-thumbnail .tribe-events-event-cost, #tribe-bar-form .tribe-bar-submit input[type=submit], 
.tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"], 
.tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"]>a, 
#tribe_events_filters_wrapper input[type=submit], .tribe-events-button, 
#tribe-events .tribe-events-button, .tribe-events-button.tribe-inactive, 
#tribe-events .tribe-events-button:hover, 
.tribe-events-button:hover, 
.tribe-events-button.tribe-active:hover, 
.single-tribe_events .tribe-events-schedule .tribe-events-cost, 
body .datepicker .datepicker-days table tr td:hover,
.vc_icon_element-background-color-skincolor,
.post-box-icon-wrapper,
.tm-titlebar-wrapper.tm-titlebar-bgcolor-skincolor .tm-titlebar-inner-wrapper,
.tm-titlebar-wrapper.tm-titlebar-bgcolor-skincolor.tm-titlebar-with-bgimage,
.widget .search-form  .search-submit,
.widget .woocommerce-product-search input[type="submit"],
.entry-content .tm-pformat-link-url,
.productbox .roadtip,
body .woocommerce.add_to_cart_inline .button,
.woocommerce ul.products li.product .productbox .button, 
.woocommerce-page ul.products li.product .productbox .button,
.woocommerce ul.products li.product .add_to_cart_button.added, 
.woocommerce-page ul.products li.product .add_to_cart_button.added,
.woocommerce ul.products li.product .add_to_cart_button.loading, 
.woocommerce-page ul.products li.product .add_to_cart_button.loading,
.woocommerce .widget_shopping_cart .cart_list li a.remove:hover,
.woocommerce a.remove:hover,
.woocommerce-page #content input.button[name="apply_coupon"]:hover, 
.woocommerce #content input.button[name="apply_coupon"]:hover,
.shop_table.cart input.button,
.woocommerce #respond input#submit.alt, 
.woocommerce a.button.alt, 
.woocommerce button.button.alt, 
.woocommerce input.button.alt,
.woocommerce .login input.button,
.widget_shopping_cart_content .button.checkout,
.widget_price_filter .price_slider_wrapper .button,
.single-product .thememount-products span.onsale,
body.woocommerce nav.woocommerce-pagination ul li span.current, 
body.woocommerce #content nav.woocommerce-pagination ul li span.current, 
body.woocommerce-page nav.woocommerce-pagination ul li span.current, 
body.woocommerce-page #content nav.woocommerce-pagination ul li span.current,
.woocommerce nav.woocommerce-pagination ul li a:hover, 
.woocommerce-page nav.woocommerce-pagination ul li a:hover,
.vc_general.vc_btn3.vc_btn3-color-skincolor.vc_btn3-style-outline:hover,
.tm-dcap-color-skincolor,
.thememount-fbar-bg-skincolor.thememount-fbar-box-w:after,
.tm-row-bgtype-skin .vc_tta-color-white.vc_tta-style-classic.vc_tta-shape-square.vc_tta-o-no-fill .vc_tta-tab.vc_active > a,
.tm-row-bgtype-skin .vc_tta-color-white.vc_tta-style-classic.vc_tta-shape-square.vc_tta-o-no-fill .vc_tta-tab > a,
.vc_tta-color-skincolor.vc_tta-style-flat .vc_tta-panel .vc_tta-panel-heading,
.vc_tta-color-skincolor.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading,
.vc_tta-color-skincolor.vc_tta-style-flat .vc_tta-panel.vc_active .vc_tta-panel-heading,
.vc_tta-color-skincolor.vc_tta-style-flat .vc_tta-panel .vc_tta-panel-heading,
.vc_tta-color-skincolor.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-heading:hover, 
.vc_tta-color-skincolor.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-heading:focus,
.woocommerce nav.woocommerce-pagination ul li a:focus, 
.woocommerce nav.woocommerce-pagination ul li a:hover, 
.woocommerce nav.woocommerce-pagination ul li span.current,
.tm-row-bgtype-skin .tm-sbox .vc_cta3-style-outline .vc_icon_element.vc_icon_element-outer .vc_icon_element-inner.vc_icon_element-outline,


.site-main .tm-carousel-arrows .thememount-carousel-controls-inner a.thememount-carousel-prev:hover:before, 
.site-main .tm-carousel-arrows .thememount-carousel-controls-inner a.thememount-carousel-next:hover:before,

.site-main .tm-carousel-arrows .thememount-carousel-controls-inner a.thememount-carousel-prev:hover, 
.site-main .tm-carousel-arrows .thememount-carousel-controls-inner a.thememount-carousel-next:hover{
	background-color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?>;
}



.tm-sbox-bg-skincolor .tm-sbox-overlay,
.vc_tta-color-skincolor.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading:focus,
.vc_tta-color-skincolor.vc_tta-style-flat .vc_tta-panel .vc_tta-panel-heading:hover, 
.vc_tta-color-skincolor.vc_tta-style-flat .vc_tta-panel .vc_tta-panel-heading:focus,
.thememount-fbar-bg-skincolor.thememount-fbar-box-w.tm-fbar-with-bgimage:after,
.tm-titlebar-wrapper.tm-titlebar-bgcolor-skincolor.tm-titlebar-with-bgimage .tm-titlebar-inner-wrapper,
.tm-row-bgtype-skin.tm-background-image .tm-bg-overlay,
.tm-col-bgcolor-skin.tm-col-background-image .tm-col-overlay,
.tm-row-bgtype-skin.vc_video-bg-container .tm-bg-overlay{
	background-color: rgba( <?php echo digitallaw_hex2rgb(esc_attr($digitallaw_theme_options['skincolor'])); ?> , 0.90);
}

.format-image .thememount-blog-media .overthumb,
.tm-box-style-leftimage .tm-team-imglink .overthumb,
.format-standard .thememount-blog-media .overthumb,
.post-item-thumbnail-inner .overthumb,
.thememount-team-box .thememount-team-data-inner,
.thememount-team-box:hover .thememount-team-data-inner,
.item .item-thumbnail .icon-overlay,
.post-box.thememount-blogbox-format-standard .thememount-blog-media:before,
.item .item-thumbnail:before{
	background-color: rgba( <?php echo digitallaw_hex2rgb(esc_attr($digitallaw_theme_options['skincolor'])); ?> , 0.75);
}
body:not(.thememount-header-style-3) .k_flying_searchform_wrapper{
	background-color: rgba( <?php echo digitallaw_hex2rgb(esc_attr($digitallaw_theme_options['skincolor'])); ?> , 0.85);
}
.vc_tta-color-skincolor.vc_tta-style-classic .vc_tta-tab>a:hover{
	background-color: <?php echo digitallaw_adjustBrightness(esc_attr($digitallaw_theme_options['skincolor']), -30); ?>;
}
.vc_tta-color-skincolor.vc_tta-style-flat .vc_tta-tab.vc_active>a,
.tm-custombutton a:hover{
	background-color: <?php echo digitallaw_adjustBrightness(esc_attr($digitallaw_theme_options['skincolor']), -10); ?>;
}
.tp-caption.Sports-Button-skin{
	border: 2px solid transparent !important;
}


.tm-dark a.ptp-button:hover,

body .woocommerce.add_to_cart_inline .button.loading,
.woocommerce ul.products li.product .add_to_cart_button.loading, 
.woocommerce-page ul.products li.product .add_to_cart_button.loading,
.tp-caption.Sports-Button-skin, 
.tp-caption.WebProduct-Button-skinnew{
	background-color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?> !important;
}
.tp-caption.Sports-Button-skin:hover{
	color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?> !important;
    border-color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?> !important;
	background-color: transparent !important;
}
.tp-button.skincolor{
	border-color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?>;    
}
.tp-button.skincolor{
	border: 1px solid <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?>;   
}
.vc_general.vc_btn3.vc_btn3-style-3d.vc_btn3-color-skincolor{
	box-shadow: 0 5px 0 <?php echo digitallaw_adjustBrightness(esc_attr($digitallaw_theme_options['skincolor']), -30); ?>;
}
.categorytag a:hover{
	color: <?php echo digitallaw_adjustBrightness(esc_attr($digitallaw_theme_options['skincolor']), -30); ?>;
}

.vc_general.vc_btn3.vc_btn3-style-3d.vc_btn3-color-skincolor:hover, 
.vc_general.vc_btn3.vc_btn3-style-3d.vc_btn3-color-skincolor:focus {
    top: 3px;
    box-shadow: 0 2px 0 <?php echo digitallaw_adjustBrightness(esc_attr($digitallaw_theme_options['skincolor']), -30); ?>;
    background-color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?> ;
}

/* 3D Button *********************/
.vc_btn.vc_btn_skincolor.vc_btn_3d {
  -webkit-box-shadow: 0 5px 0 rgba( <?php echo digitallaw_hex2rgb(esc_attr($digitallaw_theme_options['skincolor'])); ?> , 0.8);
  box-shadow: 0 5px 0 rgba( <?php echo digitallaw_hex2rgb(esc_attr($digitallaw_theme_options['skincolor'])); ?> , 0.8);
  margin-bottom: 5px;
}

/* This is Titlebar Background color */
<?php if( $digitallaw_theme_options['titlebar_bg_color']=='custom' && !empty($digitallaw_theme_options['titlebar_bg_custom_color']['rgba']) ): ?>
.tm-titlebar-wrapper .tm-titlebar-inner-wrapper{
	background-color: <?php echo esc_attr($digitallaw_theme_options['titlebar_bg_custom_color']['rgba']); ?>;
}
.tm-titlebar-wrapper{
	background-color:  <?php echo esc_attr($digitallaw_theme_options['titlebar_bg_custom_color']['rgba']); ?>;
}
<?php endif; ?>
.tm-header-overlay .tm-titlebar-wrapper .tm-titlebar-inner-wrapper{	
	padding-top: <?php echo ($headerHeight) ?>px;
}
.thememount-header-style-3.tm-header-overlay .tm-titlebar-wrapper .tm-titlebar-inner-wrapper{
	padding-top: <?php echo ($headerHeight+55) ?>px;
}
/* This is Titlebar Text color */
<?php if( $digitallaw_theme_options['titlebar_text_color']=='custom' && !empty($digitallaw_theme_options['titlebar_text_custom_color']) ): ?>
.tm-titlebar-main h1.entry-title{
	color: <?php echo esc_attr($digitallaw_theme_options['titlebar_text_custom_color']); ?> ;
}
.tm-titlebar-main .breadcrumb-wrapper a{ /* Breadcrumb */
	color: rgba( <?php echo digitallaw_hex2rgb(esc_attr($digitallaw_theme_options['titlebar_text_custom_color'])); ?> , 1) ;
}
.tm-titlebar-main .breadcrumb-wrapper a:hover{ /* Breadcrumb */
	color: rgba( <?php echo digitallaw_hex2rgb(esc_attr($digitallaw_theme_options['titlebar_text_custom_color'])); ?> , 0.7) ;
}
<?php endif; ?>

.tm-titlebar-wrapper .tm-titlebar-inner-wrapper{
	height: <?php echo esc_attr($tbar_height); ?>px;	
}
.tm-header-overlay .thememount-titlebar-wrapper .tm-titlebar-inner-wrapper{	
	padding-top: <?php echo esc_attr($headerHeight+30) ?>px;
}
.thememount-header-style-3.tm-header-overlay .tm-titlebar-wrapper .tm-titlebar-inner-wrapper{
	padding-top: <?php echo esc_attr($headerHeight+55) ?>px;
}

/* This is Tranparent Backgroundcolor */
.thememount-topbar .vc_btn3.vc_btn3-color-white:hover, 
.thememount-topbar .vc_btn3.vc_btn3-color-white.vc_btn3-style-flat:hover, 
.thememount-topbar .vc_general.vc_btn3.vc_btn3-color-skincolor:hover{
	background-color: <?php echo digitallaw_adjustBrightness(esc_attr($digitallaw_theme_options['skincolor']), -30); ?>
}
.k_flying_searchform_wrapper #flying_searchform:before,
.thememount-row-bgprecolor-skin:before,
.wpb_skincolor:hover{
	background: rgba( <?php echo digitallaw_hex2rgb(esc_attr($digitallaw_theme_options['skincolor'])); ?> , 0.85);
}
/* Logo Max-Height */
.headercontent .headerlogo img{
     max-height: <?php echo esc_attr($digitallaw_theme_options['logo-max-height']); ?>px;
}
.is-sticky .headercontent .headerlogo img{
     max-height: <?php echo esc_attr($logoMaxHeightSticky); ?>px;
}
/* Pricing Table */
a.ptp-button:hover,
.ptp-highlight a.ptp-button,
.ptp-highlight div.ptp-price {
	background-color:  <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?> !important;
}
.ptp-highlight div.ptp-plan {
	background-color: rgba( <?php echo digitallaw_hex2rgb(esc_attr($digitallaw_theme_options['skincolor'])); ?> , 0.8) !important;
}

/**
 * 2. Topbar Background color
 * ----------------------------------------------------------------------------
 */
<?php if( !empty($digitallaw_theme_options['topbartextcolor']) && esc_attr($digitallaw_theme_options['topbartextcolor']) == 'custom' ): ?>
.thememount-topbar{
	color: rgba( <?php echo digitallaw_hex2rgb(esc_attr($digitallaw_theme_options['topbartextcustomcolor'])); ?> , 0.7);
}

.thememount-topbar a{
	color: rgba( <?php echo digitallaw_hex2rgb(esc_attr($digitallaw_theme_options['topbartextcustomcolor'])); ?> , 1);
}
<?php endif; ?>


<?php if( !empty($digitallaw_theme_options['topbarbgcolor']) && esc_attr($digitallaw_theme_options['topbarbgcolor'])=='custom' && !empty($digitallaw_theme_options['topbarbgcustomcolor']) ): ?>
.site-header .thememount-topbar{
	background-color: <?php echo esc_attr($digitallaw_theme_options['topbarbgcustomcolor']); ?>;
}
<?php endif; ?>
.tm-header-overlay header .thememount-topbar{
	background-color: rgba( <?php echo digitallaw_hex2rgb(esc_attr($digitallaw_theme_options['topbarbgcolor'])); ?> , 0.5) ;
}
.site-header .thememount-topbar.thememount-topbar-bgcolor-skincolor {
	background-color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?> ;
}

/**
 * 3. Element Border color
 * ----------------------------------------------------------------------------
 */ 
 
.nav-links a[rel="prev"], 
.nav-links a[rel="next"], 
.vc_tta.vc_tta-style-outline.vc_tta-color-skincolor .vc_tta-tab>a, 
 
.footer .social-icons li a:hover,
.entry-content .page-links a:hover, .entry-content .page-links span:not(.page-links-title),
.tm-sbox.tm-sbox-iconalign-left:hover .vc_icon_element.vc_icon_element-outer .vc_icon_element-inner.vc_icon_element-size-lg.vc_icon_element-background-color-skincolor,
.tm-sbox.tm-sbox-iconalign-left:hover .vc_icon_element.vc_icon_element-outer .vc_icon_element-inner.vc_icon_element-background-color-white.vc_icon_element-outline,
.thememount-fbar-text-white.thememount-fbar-bg-darkgrey.thememount-fbar-box-w .submit_field button:hover,
.tm-box-style-default:hover .thememount-team-data,
.tm-box-style-leftimage:hover .thememount-team-data-right, 
.tm-appo-form-new .tm-appo-submit input[type="submit"]:hover, 
.woocommerce #payment #place_order:hover, 
.woocommerce-page #payment #place_order:hover, 
.woocommerce .summary .single_add_to_cart_button.button.alt, 
.woocommerce-page #content input.button[name="update_cart"]:hover,
.woocommerce #content input.button[name="update_cart"]:hover,
.woocommerce .thememount-products .single_add_to_cart_button.button.alt,
body .woocommerce.add_to_cart_inline .button,
body .woocommerce.add_to_cart_inline .button:hover,
.woocommerce ul.products li.product .productbox .button, 
.woocommerce-page ul.products li.product .productbox .button,
.woocommerce ul.products li.product .add_to_cart_button.added, 
.woocommerce-page ul.products li.product .add_to_cart_button.added,
.woocommerce ul.products li.product .add_to_cart_button.loading, 
.woocommerce-page ul.products li.product .add_to_cart_button.loading,
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.widget_shopping_cart .widget_shopping_cart_content .button.checkout:hover,
.woocommerce ul.products li.product .add_to_cart_button.added, 
.woocommerce-page ul.products li.product .add_to_cart_button.added,
.woocommerce ul.products li.product .productbox:before,
.woocommerce ul.products li.product .productbox:after,
button:hover, 
input[type="submit"]:hover, 
input[type="button"]:hover, 
input[type="reset"]:hover,
textarea:focus, 
input[type="text"]:focus, 
input[type="password"]:focus, 
input[type="datetime"]:focus, 
input[type="datetime-local"]:focus, 
input[type="date"]:focus, 
input[type="month"]:focus, 
input[type="time"]:focus, 
input[type="week"]:focus, 
input[type="number"]:focus, 
input[type="email"]:focus, 
input[type="url"]:focus, 
input[type="search"]:focus, 
input[type="tel"]:focus, 
input[type="color"]:focus, 
input.input-text:focus, 
select:focus, 
.woocommerce table.cart td.actions .coupon .input-text:focus, 
.woocommerce #content table.cart td.actions .coupon .input-text:focus, 
.woocommerce-page table.cart td.actions .coupon .input-text:focus, 
.woocommerce-page #content table.cart td.actions .coupon .input-text:focus, 
.tm-social-share-w ul li > a:hover,
.tm-pf-proj-btn .vc_btn3-container a.vc_general.vc_btn3,
.tm-pf-single-np-nav .vc_btn3-container a.vc_general.vc_btn3,
.tm-appo-form-new .tm-appo-submit input[type="submit"],
.vc_tta-color-skincolor.vc_tta-style-outline .vc_tta-tab>a, 
.widget .widgettitle,
.widget .widget-title, 
.vc_toggle_rounded.vc_toggle_color_inverted.vc_toggle_color_skincolor .vc_toggle_title:hover .vc_toggle_icon, 
.vc_toggle_rounded.vc_toggle_color_inverted.vc_toggle_color_skincolor .vc_toggle_icon,  
.vc_toggle_square.vc_toggle_color_inverted.vc_toggle_color_skincolor .vc_toggle_title:hover .vc_toggle_icon, 
.vc_toggle.vc_toggle_arrow.vc_toggle_color_skincolor .vc_toggle_icon::after, 
.vc_toggle.vc_toggle_arrow.vc_toggle_color_skincolor .vc_toggle_icon::before,
.vc_toggle.vc_toggle_arrow.vc_toggle_color_skincolor .vc_toggle_title:hover .vc_toggle_icon::after, 
.vc_toggle.vc_toggle_arrow.vc_toggle_color_skincolor .vc_toggle_title:hover .vc_toggle_icon::before,
.vc_toggle_square.vc_toggle_color_inverted.vc_toggle_color_skincolor .vc_toggle_icon,
.vc_toggle_round.vc_toggle_color_inverted.vc_toggle_color_skincolor .vc_toggle_title:hover .vc_toggle_icon,
.vc_toggle_round.vc_toggle_color_inverted.vc_toggle_color_skincolor .vc_toggle_icon,
.owl-carousel.owl-theme .owl-dots .owl-dot.active span, 
.owl-carousel.owl-theme .owl-dots .owl-dot:hover span, 
.site-main .tm-carousel-arrows .thememount-carousel-controls-inner a.thememount-carousel-prev:hover,
.site-main .tm-carousel-arrows .thememount-carousel-controls-inner a.thememount-carousel-next:hover, 
.tm-heading-with-separator:not(.tm-element-align-center) .vc_cta3-content-header, 
.tm-heading-with-separator.tm-element-align-right:not(.tm-element-align-center) .vc_cta3-content-header, 
.tp-bullets .bullet.selected,  
.vc_icon_element.vc_icon_element-outer .vc_icon_element-inner.vc_icon_element-background-color-skincolor.vc_icon_element-outline, 
.vc_general.vc_cta3.vc_cta3-color-skincolor.vc_cta3-style-outline,
.vc_general.vc_btn3.vc_btn3-style-classic.vc_btn3-color-skincolor:hover,
.tp-rightarrow.default:hover, 
.tp-leftarrow.default:hover, 
.vc_btn.vc_btn_skincolor,
.portfolio-sortable-list ul li a:hover,
.portfolio-sortable-list ul li a.selected,
.flex-control-paging li a.flex-active,
.tagcloud a:hover,
blockquote,
.vc_general.vc_btn3.vc_btn3-color-skincolor.vc_btn3-style-outline,
.vc_toggle_default.vc_toggle_color_skincolor.vc_toggle_active .vc_toggle_title > h4:after,
.vc_tta-color-skincolor.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-heading,
.tm-timeline .tm-timeline-element-inner:hover .tm-anchor-point,
.tm-sbox:hover .tm-shadowicon .vc_icon_element.vc_icon_element-outer .vc_icon_element-inner.vc_icon_element-size-lg.vc_icon_element-have-style-inner:before{
	border-color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?>;    
}
.vc_tta-color-skincolor.vc_tta-style-modern .vc_tta-panel .vc_tta-panel-heading,
.vc_tta-color-skincolor.vc_tta-style-classic .vc_tta-tab>a,
.vc_btn.vc_btn_skincolor:hover{
	border-color: rgba( <?php echo digitallaw_hex2rgb(esc_attr($digitallaw_theme_options['skincolor'])); ?> , 0.8);    
}
.vc_general.vc_btn3.vc_btn3-color-skincolor.vc_btn3-style-outline,
.vc_btn_skincolor.vc_btn_outlined, .vc_btn_skincolor.vc_btn_square_outlined{
	color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?>;    
}
.vc_btn_skincolor:hover{
	background-color: rgba( <?php echo digitallaw_hex2rgb(esc_attr($digitallaw_theme_options['skincolor'])); ?> , 0.8);
}
.vc_tta-color-white.vc_tta-style-classic.vc_tta-shape-square.vc_tta-o-no-fill.vc_tta-tabs-position-left .vc_tta-tab.vc_active{
	border-left-color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?>;
}
.thememount-fbar-position-right .thememount-fbar-btn.tm-fbar-bg-color-skincolor a:after,
.productbox .roadtip:after{
	border-top-color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?>;
}
.thememount-fbar-position-right .thememount-fbar-btn.tm-fbar-bg-color-skincolor a:after,
div.thememount-fbar-box-w,
.thememount-fbar-position-default div.thememount-fbar-box-w.thememount-fbar-bg-darkgrey{
	border-bottom-color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?>;
}
.thememount-fbar-position-default .thememount-fbar-btn.tm-fbar-bg-color-skincolor a:after{
    border-left-color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?>;
    border-right-color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?>;
}
.woocommerce ul.products li.product span.onsale,
.woocommerce-page ul.products li.product span.onsale{		
	border-right-color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?> !important;
    border-top-color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?> !important;
}
.thememount-header-cart-link-wrapper span.thememount-cart-qty:before{
	border-color: transparent <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?>; transparent;
}


/**
 * 4. Textcolor
 * ----------------------------------------------------------------------------
 */

.nav-links a[rel="prev"], 
.nav-links a[rel="next"],

.vc_tta.vc_tta-style-outline.vc_tta-color-skincolor .vc_tta-tab>a, 
.vc_tta.vc_tta-style-outline.vc_tta-color-skincolor .vc_tta-tab.vc_active>a,

.tm-title-skincolor,
.tm-sbox-title-skincolor h2,
.tm-row-bgtype-dark .tm-heading-history h2,
.tm-row-bgtype-skin .thememount-twitterbar-list .thememount_tweet_item.thememount_tweetitem a:hover, 
.tm-row-bgtype-dark .thememount-twitterbar-list .thememount_tweet_item.thememount_tweetitem a:hover, 
.tm-row-bgtype-grey .thememount-twitterbar-list .thememount_tweet_item.thememount_tweetitem a:hover, 
thead th,
table tr th,
.tm-sbox.tm-sbox-iconalign-left:hover .vc_icon_element.vc_icon_element-outer .vc_icon_element-inner.vc_icon_element-size-lg.vc_icon_element-background-color-skincolor .vc_icon_element-icon,
.thememount-fbar-text-white.thememount-fbar-bg-darkgrey.thememount-fbar-box-w .submit_field button:hover,
.thememount-fbar-box-w.thememount-fbar-text-white .widget a:hover,
.tm-box-style-default .thememount-team-box .thememount-team-social-links ul li a:hover,
.woocommerce #payment #place_order:hover, .woocommerce-page #payment #place_order:hover,
.woocommerce .summary .single_add_to_cart_button.button.alt:hover,
.woocommerce-page #content input.button[name="update_cart"]:hover,
.woocommerce #content input.button[name="update_cart"]:hover,
.widget_calendar #today,
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.widget_shopping_cart .widget_shopping_cart_content .button.checkout:hover,
.woocommerce ul.products li.product .add_to_cart_button.loading, 
.woocommerce-page ul.products li.product .add_to_cart_button.loading,

body .woocommerce.add_to_cart_inline .button:hover, 
.woocommerce ul.products li.product .productbox .button:hover, 
.woocommerce-page ul.products li.product .productbox .button:hover,
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.widget_shopping_cart .widget_shopping_cart_content .button.checkout:hover,
.widget_display_forums li a:before, .widget_display_topics li a:before, .widget_recent_entries li a:before, 
.widget_archive li a:before, .widget_categories li a:before, .menu li a:before, .widget_meta li a:before,
.widget_pages  li a:before, .widget_recent_comments li:before, .widget_layered_nav li a:before, 
body .widget.widget_product_categories li a:before, 
button:hover, 
input[type="submit"]:hover, 
input[type="button"]:hover, 
input[type="reset"]:hover,  
.thememount-skincolor, 
.tm-titlebar-wrapper .breadcrumb-wrapper,
ul.thememount-portfolio-details-list li i,
.tm-pf-proj-btn .vc_btn3-container a.vc_general.vc_btn3,
.tm-pf-single-np-nav .vc_btn3-container a.vc_general.vc_btn3,
.tm-appo-form-new .tm-appo-submit input[type="submit"]:hover,
.vc_tta-color-skincolor.vc_tta-style-outline .vc_tta-tab.vc_active>a,
.vc_tta-color-skincolor.vc_tta-style-outline .vc_tta-tab>a,
.widget .latest-tweets li:before,
.widget .latest-tweets ul li .tweet-text a,
.footer.footer-text-color-white .widget .latest-tweets ul li .tweet-details a:hover,
.vc_tta-color-white.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a,
.vc_tta-color-white.vc_tta-style-classic .vc_active .vc_tta-icon,  
.site-main .vc_row .thememount-post-readmore a, 
.thememount-post-readmore a, 
.thememount-team-social-links ul li a:hover,
.footer .tm-sbox .vc_general.vc_cta3 h2 a:hover,
.tm-skincolor, 
.site-main .tm-box-style-leftimage .thememount-team-phoneemail .tm-skincolor,
.site-main .tm-box-style-leftimage:hover .thememount-team-title a,
.site-main .tm-box-style-leftimage:hover .thememount-team-title,
.site-main .tm-box-style-default .thememount-team-box .thememount-team-title a:hover,
.site-main .tm-box-style-leftimage .thememount-team-box .thememount-team-phoneemail a:hover,
.thememount-topbar .top-contact i,  
.thememount-fbar-btn.tm-fbar-icon-color-skincolor a i, 
.site-main .tm-fid-icon-wrapper i,  
.single-tm_team_member .thememount-team-cat-links a:hover,
.tm-top-info-con .icon,
.single-product .summary .amount,
.categorytag .catgoryinfo:after,
.categorytag .tags-links:after,
.portfolio-sortable-list ul li:hover a,
.portfolio-sortable-list ul li a.selected,
.portfolio-sortable-list ul li:after,
.productbox .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a, 
.productbox .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a,
.tm-date,
.tm-timeline .tm-content-wrap .tm-title a:hover, 
.categorytag a,
.site-main .item-content .thememount-meta-details a:hover,   
body.search-no-results .tm-no-sresult-wrapper .thememount-big-icon i, 
.widget_pages li.current_page_item > a, 
.widget_categories li.current-cat > a, 
.thememount-header-cart-link-wrapper a:hover, 
.thememount-header-style-6 .thememount-header-cart-link-wrapper a:hover,

.tm-mmenu-active-color-skin #navbar #site-navigation div.nav-menu > ul > li:hover > a,
.tm-mmenu-active-color-skin #navbar #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal > li.mega-menu-item:hover > a, 
.tm-dmenu-active-color-skin #navbar #site-navigation div.nav-menu > ul > li.current_page_ancestor > a, 
.tm-dmenu-active-color-skin #navbar #site-navigation div.nav-menu > ul > li li.current_page_ancestor > a, 

.tm-dmenu-active-color-skin #navbar #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal > li.mega-menu-item ul.mega-sub-menu li.mega-menu-item:hover > a,
.tm-dmenu-active-color-skin #navbar #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal > li.mega-menu-item ul.mega-sub-menu li.menu-item:hover > a,

.vc_general.vc_btn3.vc_btn3-style-text.vc_btn3-color-inverse:hover,
.vc_toggle_color_skincolor.vc_toggle_default.vc_toggle_active .vc_toggle_title > h4:after,
.vc_toggle_color_skincolor.vc_toggle_default.vc_toggle_active .vc_toggle_title > h4,
.item-content h4 a:hover, 
.vc_icon_element.vc_icon_element-outer .vc_icon_element-inner.vc_icon_element-color-skincolor .vc_icon_element-icon,
.vc_general.vc_cta3.vc_cta3-color-skincolor.vc_cta3-style-outline .vc_cta3-content-header,
.vc_general.vc_btn3.vc_btn3-style-text.vc_btn3-color-skincolor,
.vc_general.vc_btn3.vc_btn3-style-classic.vc_btn3-color-skincolor:hover,
a:hover,
.thememount-topbar-textcolor-white a:hover,
.thememount-topbar-textcolor-dark a:hover,
.comment-content a,
.skincolor, 
.site-title span,
.comment-content a:hover,
.widget a:hover,
.widget a:focus,
.thememount-row-bgprecolor-skin .thememount-servicebox  .thememount-icon,
.thememount-servicebox-lefticonspacing .thememount-icon,
.thememount-servicebox.thememount-servicebox-lefticon .thememount-icon,
.thememount-meta-details a:hover,
.site-main .postcontent .thememount-meta-details a:hover,
.thememount-post-right .entry-title a:hover,
.colored,
.thememount-row-bgcolor-grey .thememount-btn-effect-colortoborder.thememount-btn-color-white:hover span,
.thememount-heading-sepicon i,
.thememount_footer_menu ul li a:hover,
.copyright .thememount_footer_text a:hover,
body.error404 .page-content h1,
body.error404 .page-content i:before,
ul.thememount_vc_contact_wrapper li:before,
.thememount-titlebar-wrapper .breadcrumb-wrapper a:hover,
.thememount-portfolio-likes-wrapper .like-active,
a.thememount-portfolio-likes,
.thememount-servicebox.thememount-servicebox-righticonspacing .thememount-icon,
.post-item .item-content h4 a:hover,
.item-content h4 a:hover,
.widget_calendar tbody a,
.widget_calendar a,
.site-main ul li:before,
ul.special li:before,
ol.special li:before,
body.search-no-results .page-content .thememount-big-icon i:before,
.large-skincolor-bold,
.comment-reply-link:hover,
.comment-meta a:hover,
.widget_calendar #today a:hover,
.post-box.thememount-blogbox-format-standard .thememount-blog-media .btn-view:hover,
.thememount-tst-contarea-text:before,
#content #bbpress-forums ul.topic:hover a.bbp-topic-permalink,
#content #bbpress-forums ul.forum:hover a.bbp-forum-title,
.bbp-submit-wrapper .button:hover,
.widget .bbp-logged-in .button:hover,
.thememount-fbar-bg-skin .tagcloud a:hover,
.thememount-fbar-bg-dark .tagcloud a:hover,
.footer .social-icons li a:hover i, 
.footer.footer-text-color-dark .widget ul > li a:hover,
.site-footer .footer-text-color-dark .widget a:hover,
.header-text-color-white .thememount-tb-content a:hover,
body .headerblock .thememount-fbar-box-w.thememount-fbar-text-white .widget a:hover,
.footer.footer-text-color-white .widget ul > li a:hover, 
.site-footer .footer-text-color-white .widget a:hover,
.thememount-icontext i:before,
.thememount-row-bgprecolor-dark .thememount-servicebox-title a:hover,
.tp-leftarrow.default:hover:before,
.tp-rightarrow.default:hover:before,
.thememount-post-wrapper .entry-title a:hover,
.woocommerce ul.products li.product .amount, 
.woocommerce-page ul.products li.product .amount,
.woocommerce .woocommerce-message .button.wc-forward:hover, 
.woocommerce-page .woocommerce-message .button.wc-forward:hover,
.single-product .thememount-products .woocommerce-message a.button:hover,
.tm-list.tm-list-style-icon i.tm-skincolor,

/* Text color skin in row secion*/
.tm-background-image.tm-row-textcolor-skin h1, 
.tm-background-image.tm-row-textcolor-skin h2, 
.tm-background-image.tm-row-textcolor-skin h3, 
.tm-background-image.tm-row-textcolor-skin h4, 
.tm-background-image.tm-row-textcolor-skin h5, 
.tm-background-image.tm-row-textcolor-skin h6,
.tm-background-image.tm-row-textcolor-skin .tm-element-heading-wrapper h2,

.tm-background-image.tm-row-textcolor-skin a,
.tm-background-image.tm-row-textcolor-skin .item-content a:hover,
.site-main .tm-row-bgtype-dark .item-content h4 a:hover,
.site-main .tm-row-bgtype-grey .item-content h4 a:hover,
.vc_row.tm-row-textcolor-skin h1, 
.vc_row.tm-row-textcolor-skin h2, 
.vc_row.tm-row-textcolor-skin h3, 
.vc_row.tm-row-textcolor-skin h4, 
.vc_row.tm-row-textcolor-skin h5, 
.vc_row.tm-row-textcolor-skin h6,
.vc_row .wpb_column.vc_column_container.tm-col-textcolor-skin h1, 
.vc_row .wpb_column.vc_column_container.tm-col-textcolor-skin h2, 
.vc_row .wpb_column.vc_column_container.tm-col-textcolor-skin h3, 
.vc_row .wpb_column.vc_column_container.tm-col-textcolor-skin h4, 
.vc_row .wpb_column.vc_column_container.tm-col-textcolor-skin h5, 
.vc_row .wpb_column.vc_column_container.tm-col-textcolor-skin h6,
.vc_row .wpb_column.vc_column_container.tm-col-textcolor-skin a,

.vc_row .wpb_column.vc_column_container.tm-col-textcolor-skin,
.vc_row.tm-row-textcolor-skin a,
.site-footer .footer-info-text-color-white a:hover,
.vc_tta-color-skincolor.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-title > a,
.vc_tta-color-white.vc_tta-style-classic.vc_tta-shape-square.vc_tta-o-no-fill .vc_tta-tab.vc_active > a,
.vc_tta-color-black.vc_tta-style-classic.vc_tta-shape-square.vc_tta-o-no-fill .vc_tta-tab.vc_active > a,
.woocommerce ul.products li.product a:hover h3,
.tm-row-bgtype-skin .thememount-testimonial-icon,
.woocommerce .star-rating span:before{
	color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?>;
}

/* Text color skin in row secion*/
.vc_row.tm-row-textcolor-skin a:hover,
.vc_row .wpb_column.vc_column_container.tm-col-textcolor-skin a:hover,
.vc_row .wpb_column.vc_column_container.tm-col-textcolor-skin p,
.tm-background-image.tm-row-textcolor-skin,
.tm-background-image.tm-row-textcolor-skin .tm-element-heading-wrapper h4,
.tm-background-image.tm-row-textcolor-skin p,
.tm-background-image.tm-row-textcolor-skin span,
.tm-background-image.tm-row-textcolor-skin .thememount-tst-contarea-text,
.tm-background-image.tm-row-textcolor-skin .thememount-testimonial-title .thememount-testimonial-designation,
.vc_row.tm-row-textcolor-skin,
.vc_row.tm-row-textcolor-skin p,
.vc_row.tm-row-textcolor-skin span,
.vc_row.tm-row-textcolor-skin .thememount-tst-contarea-text,
.tm-row-textcolor-skin .thememount-testimonial-title .thememount-testimonial-designation,
.vc_row.thememount-row-textcolor-skin p,
.vc_tta-color-skincolor.vc_tta-style-outline .vc_tta-panel.vc_active .vc_tta-panel-title > a{
	color:rgba( <?php echo digitallaw_hex2rgb(esc_attr($digitallaw_theme_options['skincolor'])); ?> , 0.85);
}

.vc_row.tm-row-textcolor-skin .item-content a:hover{
	color: <?php echo digitallaw_adjustBrightness(esc_attr($digitallaw_theme_options['skincolor']), -30); ?>
}
.Transparent-Button-Light:hover{
	color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?> !important;
}
<?php if( !empty($digitallaw_theme_options['mainmenu_active_link_color']) && trim(esc_attr($digitallaw_theme_options['mainmenu_active_link_color']))=='custom' ){ ?> 
/* Main Menu Active Link Color --------------------------------*/  
.tm-mmenu-active-color-custom #navbar #site-navigation div.nav-menu > ul > li.current-menu-ancestor > a, 
.tm-mmenu-active-color-custom #navbar #site-navigation div.nav-menu > ul > li.current_page_item > a, 
.tm-mmenu-active-color-custom #navbar #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal > li.mega-menu-item.mega-current-menu-item > a,    
.tm-mmenu-active-color-custom #navbar #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal > li.mega-menu-item.mega-current-menu-ancestor > a,
.tm-mmenu-active-color-custom #navbar #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal > li.mega-menu-item:hover > a,
.tm-mmenu-active-color-custom #navbar #site-navigation div.nav-menu > ul > li:hover > a {
    color: <?php echo esc_attr($digitallaw_theme_options['mainmenu_active_link_custom_color']); ?>;
}
.tm-mmenu-active-color-custom #navbar #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal > li:hover > a:before, 
.tm-mmenu-active-color-custom #navbar #site-navigation div.nav-menu > ul > li:hover > a:before {
    background-color: <?php echo esc_attr($digitallaw_theme_options['mainmenu_active_link_custom_color']); ?>;
}


<?php } ?>

<?php if( !empty($digitallaw_theme_options['dropmenu_active_link_color']) && trim($digitallaw_theme_options['dropmenu_active_link_color'])=='custom' ){ ?>
/*Dropdown Menu Active Link Color --------------------------------*/ 
.tm-dmenu-active-color-custom #navbar #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal > li.mega-menu-item ul.mega-sub-menu li:hover > a,
.tm-dmenu-active-color-custom #navbar #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal > li.mega-menu-item ul.mega-sub-menu li.current-menu-item > a,
.tm-dmenu-active-color-custom #navbar #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal > li.mega-menu-item ul.mega-sub-menu li.mega-current-menu-item > a,    
.tm-dmenu-active-color-custom #navbar #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal > li.mega-menu-item ul.mega-sub-menu li.mega-current-menu-ancestor > a,    
.tm-dmenu-active-color-custom #navbar #site-navigation div.nav-menu > ul > li li a:hover,
.tm-dmenu-active-color-custom #navbar #site-navigation div.nav-menu > ul > li li:hover > a,
.tm-dmenu-active-color-custom #navbar #site-navigation div.nav-menu > ul > li li.current-menu-ancestor > a,    
.tm-dmenu-active-color-custom #navbar #site-navigation div.nav-menu > ul > li li.current-menu-item > a,    
.tm-dmenu-active-color-custom #navbar #site-navigation div.nav-menu > ul > li li.current_page_item > a {
    color: <?php echo esc_attr($digitallaw_theme_options['dropmenu_active_link_custom_color']); ?>;
}

<?php } ?>
<?php /*if( isset($digitallaw_theme_options['mainmenufont']['color']) && trim($digitallaw_theme_options['mainmenufont']['color'])!='' ):*/ ?>
/* Dynamic main menu color applying to responsive menu link text */
.header-controls .search_box i.tmicon-fa-search,
.righticon i,
.menu-toggle i,
.header-controls a{
    color: rgba( <?php echo digitallaw_hex2rgb($mainMenuFontColor); ?> , 1) ;
}



<?php /*endif;*/ ?>   

<?php if( isset($digitallaw_theme_options['dropdownmenufont']['color']) && trim($digitallaw_theme_options['dropdownmenufont']['color'])!='' ): ?>
#navbar #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu > li.mega-menu-item-type-widget div{
	color: rgba( <?php echo digitallaw_hex2rgb($digitallaw_theme_options['dropdownmenufont']['color']); ?> , 0.8);
    font-weight: normal;
}
<?php endif; ?>
#navbar #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu > li.mega-menu-item-type-widget div.textwidget{
	padding-top: 10px;
}
/*Header / Footer background color --------------------------------*/
<?php if( !empty($digitallaw_theme_options['headerbgcolor']['rgba']) ) : ?>
#stickable-header,
body:not(.tm-header-overlay) #stickable-header-sticky-wrapper,
.thememount-header-style-6 #stickable-header .headerlogo,
.thememount-header-style-4 #stickable-header .container .headercontent,
.thememount-header-style-4 #stickable-header .container-full .headercontent{
	background-color: <?php echo esc_attr($digitallaw_theme_options['headerbgcolor']['rgba']); ?>;
}
<?php endif; ?>

<?php if( !empty($stickyheaderbgcolor) ) : ?>
.thememount-header-style-3.tm-header-overlay .is-sticky #navbar,
.is-sticky #stickable-header,
.tm-header-overlay .is-sticky #stickable-header,
.tm-header-overlay.thememount-header-style-4 .is-sticky #stickable-header,
.thememount-header-style-4 .is-sticky  #stickable-header .container .headercontent,
.thememount-header-style-4 .is-sticky  #stickable-header .container-full .headercontent{
	background-color: <?php echo esc_attr($stickyheaderbgcolor); ?>;
}
<?php endif; ?>
.tm-header-overlay.thememount-header-style-4 #stickable-header,
.tm-header-overlay.thememount-header-style-6 #stickable-header,
.tm-header-overlay.thememount-header-style-6 #stickable-header .headerlogo{
	background-color: transparent;
}

/*Logo Color --------------------------------*/ 
h1.site-title{
	color: <?php echo esc_attr($digitallaw_theme_options['logo_font']['color']); ?>;
}

/**
 * 9. Genral Elements
 * ----------------------------------------------------------------------------
 */

/* Site Pre-loader image */
<?php if( isset($digitallaw_theme_options['loaderimage_custom']['url']) && esc_url($digitallaw_theme_options['loaderimage_custom']['url']) != '' ): ?>
.pageoverlay{
	background-image:url('<?php echo esc_url($digitallaw_theme_options['loaderimage_custom']['url']); ?>');
}
<?php elseif( esc_attr($digitallaw_theme_options['loaderimg']) != '' ): ?>
.pageoverlay{
	background-image:url('../images/loader<?php echo esc_attr($digitallaw_theme_options['loaderimg']); ?>.gif');
}
<?php endif; ?>


  

/*Custom Breakpoint topbar*/
<?php if( !empty($digitallaw_theme_options['topbar_breakpoint']) && esc_attr($digitallaw_theme_options['topbar_breakpoint'])!='all' ): ?>

<?php

$topbar_breakpoint = esc_attr($digitallaw_theme_options['topbar_breakpoint']);
if( trim($digitallaw_theme_options['topbar_breakpoint'])=='custom' ) {
	$topbar_breakpoint = ( !empty($digitallaw_theme_options['topbar_breakpoint_custom']) ) ?  esc_attr($digitallaw_theme_options['topbar_breakpoint_custom']) : $topbar_breakpoint ;
}


?>
/* Show/hide topbar in some devices */
@media (max-width: <?php echo esc_attr($topbar_breakpoint); ?>px){
	.thememount-topbar{
		display: none;
	}
}
<?php endif; ?>



/*Custom Breakpoint Floating Bar*/
<?php if( !empty($digitallaw_theme_options['floatingbar_breakpoint']) && trim($digitallaw_theme_options['floatingbar_breakpoint'])!='all' ): ?>

<?php

$fbar_breakpoint = esc_attr($digitallaw_theme_options['floatingbar_breakpoint']);
if( trim($digitallaw_theme_options['floatingbar_breakpoint'])=='custom' ) {
	$fbar_breakpoint = ( !empty($digitallaw_theme_options['floatingbar_breakpoint_custom']) ) ?  trim(esc_attr($digitallaw_theme_options['floatingbar_breakpoint_custom'])) : $fbar_breakpoint ;
}


?>
/* Show/hide topbar in some devices */
@media (max-width: <?php echo esc_attr($fbar_breakpoint); ?>px){
	.thememount-fbar-btn,
    .thememount-fbar-box-w{
		display: none !important;
	}
}

<?php endif; ?>



<?php //if( isset($digitallaw_theme_options['mainmenufont']['color']) && trim($digitallaw_theme_options['mainmenufont']['color'])!='' ): ?>
/* Dynamic main menu color applying to responsive menu link text */ 



<?php //endif; ?>  

.thememount-fbar-btn.tm-fbar-bg-color-custom a{
	background-color: <?php echo esc_attr($digitallaw_theme_options['fbar_btn_bg_custom_color']); ?>;
}
.thememount-fbar-position-right  .thememount-fbar-btn.tm-fbar-bg-color-custom a:after{
	border-top-color: <?php echo esc_attr($digitallaw_theme_options['fbar_btn_bg_custom_color']); ?>;
    border-bottom-color: <?php echo esc_attr($digitallaw_theme_options['fbar_btn_bg_custom_color']); ?>;
}
.thememount-fbar-position-default .thememount-fbar-btn.tm-fbar-bg-color-custom a:after{
    border-left-color: <?php echo esc_attr($digitallaw_theme_options['fbar_btn_bg_custom_color']); ?>;
    border-right-color: <?php echo esc_attr($digitallaw_theme_options['fbar_btn_bg_custom_color']); ?>;
}
.thememount-fbar-btn.tm-fbar-icon-color-custom a i{
	color: <?php echo esc_attr($digitallaw_theme_options['fbar_icon_custom_color']); ?>;
}
<?php if( !empty($digitallaw_theme_options['headerbgcolor']['color']) ) : ?>
.header-controls .search_box a{
    color: <?php echo esc_attr($digitallaw_theme_options['headerbgcolor']['color']); ?>;
}
<?php endif; ?>
.header-controls .search_box a{
    background-color: rgba( <?php echo digitallaw_hex2rgb($mainMenuFontColor); ?> , 1) ;
}
.tm-header-overlay .header-controls .search_box a{
    background-color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?>;
} 
.header-controls .search_box a:hover{
    background-color:  <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?>;
}
@media (min-width: 768px){
    .vc_tta-color-skincolor.vc_tta-style-modern .vc_tta-panel .vc_tta-panel-heading,
    .vc_tta-color-skincolor.vc_tta-style-outline.vc_tta-tabs .vc_tta-panels, 
    .vc_tta-color-skincolor.vc_tta-style-outline.vc_tta-tabs .vc_tta-panels::after, 
    .vc_tta-color-skincolor.vc_tta-style-outline.vc_tta-tabs .vc_tta-panels::before {
        border-color:  <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?>;
    }
    .vc_tta-color-skincolor.vc_tta-style-modern .vc_tta-panel .vc_tta-panel-heading,
    .vc_tta-color-skincolor.vc_tta-style-modern .vc_tta-panel .vc_tta-panel-heading:focus, 
    .vc_tta-color-skincolor.vc_tta-style-modern .vc_tta-panel .vc_tta-panel-heading:hover,
    .vc_tta-color-skincolor.vc_tta-style-flat.vc_tta-tabs .vc_tta-panels {
        background-color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?>;
    }
}
.vc_tta-color-skincolor.vc_tta-style-flat .vc_tta-panel .vc_tta-panel-body, 
.vc_tta-color-skincolor.vc_tta-style-flat .vc_tta-panel.vc_active .vc_tta-panel-heading {
	background-color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?>;
}




/* ********************* Dark layout *************************** */

.tm-dark .site-main .tm-box-style-leftimage .thememount-team-box .thememount-team-phoneemail a:hover,
.tm-dark .site-main .tm-box-style-leftimage .thememount-team-title a:hover,
.tm-dark .thememount-post-wrapper .entry-title a:hover,
.tm-dark .site-main .item-content h4 a:hover,
.tm-dark .site-main .thememount-portfolio-design-nopadding .portfolio-box .item .item-content h4 a:hover,

.tm-dark .site-main .vc_tta-color-white.vc_tta-style-classic.vc_tta-shape-square.vc_tta-o-no-fill .vc_tta-tab.vc_active > a, 
.tm-dark .site-main .vc_tta-color-white.vc_tta-style-classic.vc_tta-shape-square.vc_tta-o-no-fill .vc_tta-tab > a:hover,
.tm-dark .site-main .thememount-testimonial-title a:hover,

.tm-dark .thememount-topbar-bgcolor-custom.thememount-topbar-textcolor-white a:hover,

.tm-dark .item-content h4 a:hover, 
.tm-dark .post-box .post-item  .item-content h4 a:hover,
.tm-dark .portfolio-sortable-list ul li a.selected,

.tm-dark .site-main .postcontent .thememount-meta-details a:hover,
.tm-dark .woocommerce .woocommerce-info a:hover, 
.tm-dark .woocommerce-page .woocommerce-info a:hover,

.tm-dark .site-main .tm-box-style-default .thememount-team-box .thememount-team-title a:hover,
.tm-dark #page footer.site-footer > div.footer > div.footer-inner a:hover{
	color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?>;
}
.tm-dark .tagcloud a:hover,
.tm-dark .tm-taxonomy-term-list ul li a:hover,
.tm-dark .tm-taxonomy-term-list ul li.current-cat > a,

.tm-dark #bbpress-forums li.bbp-header, 
.tm-dark #bbpress-forums li.bbp-footer {
	background-color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?>;
}
.tm-dark .tm-row-bgtype-dark .tm-box-style-default:hover .thememount-team-data,
.tm-dark .tm-box-style-default:hover .thememount-team-data,
.tm-dark .tm-box-style-leftimage:hover .thememount-team-data-right,
.tm-dark #bbpress-forums button, 
.tm-dark .bbp-submit-wrapper .button {
	border-color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?>;
}

@media (min-width: 768px){	
	.site-main .vc_tta-color-skincolor.vc_tta-style-outline.vc_tta-tabs:not(.vc_tta-o-no-fill) .vc_tta-panels, 
	.site-main .vc_tta-color-skincolor.vc_tta-style-outline.vc_tta-tabs .vc_tta-panels:after, 
	.site-main .vc_tta-color-skincolor.vc_tta-style-outline.vc_tta-tabs .vc_tta-panels:before{
		border-color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?>;
	}
}
.site-main .vc_tta-color-skincolor.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-body:after, 
.site-main .vc_tta-color-skincolor.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-body:before{
	border-color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?>;
}
@media (max-width: 767px){
	.site-main .vc_tta-color-skincolor.vc_tta-style-outline:not(.vc_tta-o-no-fill) .vc_tta-panel .vc_tta-panel-body{
		border-color: <?php echo esc_attr($digitallaw_theme_options['skincolor']); ?>;
	}	
}


/* ********************* End Dark layout *************************** */









/* ********************* Responsive Menu Code Start *************************** */
<?php
/*
 *  Generate dynamic style for responsive menu. The code with breakpoint.
 */
require( get_template_directory().'/css/dynamic-menu-style.php' ); // Functions
?>
/* ********************** Responsive Menu Code END **************************** */




/******************************************************/
/******************* Custom Code **********************/

<?php
// We are not escaping / sanitizing as we are expecting css code. 
echo trim($digitallaw_theme_options['custom_css_code']);
?>

/******************************************************/

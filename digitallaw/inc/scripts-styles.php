<?php

/**
 * Login page CSS script
 */
function digitallaw_login_stylesheet() {
    wp_enqueue_style( 'digitallaw-login-style', get_template_directory_uri() . '/style-login.min.css' );
}
add_action( 'login_enqueue_scripts', 'digitallaw_login_stylesheet' );


/*
 *  Check if MIN css or not
 */
function digitallaw_min_css(){
	global $digitallaw_theme_options;
	
	// Checking if MIN enabled
	if(!is_admin()) {
		if( isset($digitallaw_theme_options['minify-css-js']) && esc_attr($digitallaw_theme_options['minify-css-js']) == '0' ){
			define('TM_MIN', '');
		} else {
			define('TM_MIN', '.min');
		}
	}
}
add_action( 'init', 'digitallaw_min_css' );



/**
 * Enqueue scripts and styles for the front end.
 *
 * @since DigitalLaw 1.0
 *
 * @return void
 */
function digitallaw_scripts_styles() {
	global $digitallaw_theme_options;
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ){
		wp_enqueue_script( 'comment-reply' );
	}
	
	/*
	 * Adds RTL CSS file
	 */
	if ( is_rtl() ) {
		wp_enqueue_style(  'digitallaw-rtl',  get_template_directory_uri() . '/rtl'.TM_MIN.'.css' );
	}
	
	
	// hower.css : Hover effect (we are using min version)
	wp_register_style( 'hover', get_template_directory_uri() . '/assets/hover/hover-min.css' );
	
	
	// Hint.css
	wp_enqueue_style( 'hint', get_template_directory_uri() . '/assets/hint/hint.min.css' );
	
	
	// mCustomScrollbar.css : Fancy Scrollbar
	wp_enqueue_style( 'mCustomScrollbar', get_template_directory_uri() . '/assets/malihu-custom-scrollbar/jquery.mCustomScrollbar.min.css' );	
	
	
	// IsoTope
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/isotope/isotope.pkgd.min.js', array( 'jquery' ), '', true );
	
	
	// Flex Slider
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/assets/flexslider/jquery.flexslider-min.js', array( 'jquery' ), '', true );
	wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/assets/flexslider/flexslider.css' );
	
	
	// Sticky
	if( esc_attr($digitallaw_theme_options['stickyheader']) == 'y' ){
		wp_enqueue_script( 'sticky', get_template_directory_uri() . '/assets/sticky/jquery.sticky.js', array( 'jquery' ) , '', true );
	}
	
	// FontAwesome Library
	if ( !wp_style_is( 'font-awesome', 'registered' ) ) { // If library is not registered
		$fontawesome_css = get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css';
		if( file_exists( WP_PLUGIN_URL . '/js_composer/assets/lib/bower/font-awesome/css/font-awesome.min.css') ){
			$fontawesome_css = WP_PLUGIN_URL . '/js_composer/assets/lib/bower/font-awesome/css/font-awesome.min.css';
		}
		wp_register_style( 'font-awesome', $fontawesome_css );
	}
	
	// Enqueue FontAwesome library for general use
	wp_enqueue_style( 'font-awesome' );
	
	
	// TM Social Icons CSS Library
	wp_enqueue_style( 'tm-social-icon-library', get_template_directory_uri() . '/assets/tm-social-icons/css/tm-social-icon.css' );
	
	
	// animate.css
	if ( !wp_style_is( 'animate-css', 'registered' ) ) { // If library is not registered
		wp_register_style( 'animate-css', get_template_directory_uri() . '/assets/animate/animate.min.css' );
	}
	wp_enqueue_script( 'nivo-slider', get_template_directory_uri() . '/assets/nivo-slider/jquery.nivo.slider.pack.js', array( 'jquery' ), '', true );
	wp_enqueue_style( 'nivo-slider-css', get_template_directory_uri() . '/assets/nivo-slider/nivo-slider.css' );
	wp_enqueue_style( 'nivo-slider-theme', get_template_directory_uri() . '/assets/nivo-slider/themes/default/default.css' );
	
	
	// Numinate plugin
	if ( !wp_script_is( 'waypoints', 'registered' ) ) { // If library is not registered
		wp_register_script( 'waypoints', get_template_directory_uri() . '/assets/waypoints/jquery.waypoints.min.js', array( 'jquery' ), '', true );
	}
	wp_register_script( 'numinate', get_template_directory_uri() . '/assets/numinate/numinate.min.js', array( 'jquery' ), '', true );
	
	
	// owl carousel
	wp_register_script( 'owl-carousel', get_template_directory_uri() . '/assets/owl-carousel/owl.carousel.min.js', array('jquery'), '', true );
	wp_register_style( 'owl-carousel', get_template_directory_uri() . '/assets/owl-carousel/assets/owl.carousel.css' );
	wp_enqueue_style( 'owl-carousel'); /* patch for ie9: this CSS should be added */
	
	
	// PrettyPhoto
	if ( !wp_script_is( 'prettyphoto', 'registered' ) ) { // If library is not registered
		$prettyphoto_js = get_template_directory_uri() . '/assets/prettyphoto/js/jquery.prettyPhoto.js';
		if( file_exists( WP_PLUGIN_URL . '/js_composer/assets/lib/prettyphoto/js/jquery.prettyPhoto.js') ){
			$prettyphoto_js = WP_PLUGIN_URL . '/js_composer/assets/lib/prettyphoto/js/jquery.prettyPhoto.js';
		}
		wp_register_script( 'prettyphoto', $prettyphoto_js, array('jquery') , '', true);
	}
	if ( !wp_style_is( 'prettyphoto', 'registered' ) ) { // If library is not registered
		$prettyphoto_css = get_template_directory_uri() . '/assets/prettyphoto/css/prettyPhoto.css';
		if( file_exists( WP_PLUGIN_URL . '/js_composer/assets/lib/prettyphoto/css/prettyPhoto.css') ){
			$prettyphoto_css = WP_PLUGIN_URL . '/js_composer/assets/lib/prettyphoto/css/prettyPhoto.css';
		}
		wp_register_style( 'prettyphoto', $prettyphoto_css );
	}
	
	// jquery-match-height
	wp_enqueue_script( 'jquery-match-height', get_template_directory_uri() . '/assets/jquery-match-height/jquery.matchHeight-min.js', array( 'jquery' ), '', true );
	
	
	// mCustomScrollbar.css : Fancy Scrollbar
	wp_enqueue_script( 'mCustomScrollbar', get_template_directory_uri() . '/assets/malihu-custom-scrollbar/jquery.mCustomScrollbar.concat.min.js', array( 'jquery' ), '', true );
	
	// Input style css (http://usingcss3.com/awesome-input-focus-effects/)
	wp_enqueue_style( 'input-style', get_template_directory_uri() . '/assets/input-style/input-style.css' );
	
	
	// Air Datepicker
	wp_enqueue_style( 'air-datepicker', get_template_directory_uri() . '/assets/air-datepicker/css/datepicker.min.css' );
	wp_enqueue_script( 'air-datepicker', get_template_directory_uri() . '/assets/air-datepicker/js/datepicker.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'air-datepicker-en', get_template_directory_uri() . '/assets/air-datepicker/js/i18n/datepicker.en.js', array( 'jquery', 'air-datepicker' ), '', true );
	
	
	// Loading prettyPhoto by default
	wp_enqueue_script( 'prettyphoto' );
	wp_enqueue_style( 'prettyphoto' );
	
}
add_action( 'wp_enqueue_scripts', 'digitallaw_scripts_styles', 10 );





function digitallaw_scripts_styles_14() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'multi-columns-row', get_template_directory_uri() . '/css/multi-columns-row.min.css', array('bootstrap') );
	wp_enqueue_style( 'bootstrap-theme', get_template_directory_uri() . '/css/bootstrap-theme.min.css', array('bootstrap') );
	wp_enqueue_style( 'theme-base-style', get_template_directory_uri() . '/css/base'.TM_MIN.'.css' );
}
add_action( 'wp_enqueue_scripts', 'digitallaw_scripts_styles_14', 14 );





function digitallaw_scripts_styles_15() {
	global $digitallaw_theme_options;
	$min = TM_MIN;
	if( is_child_theme() ){
		$min = '';
	}
	if( defined( 'WPB_VC_VERSION' ) ){
		wp_enqueue_style( 'digitallaw-main-style', get_template_directory_uri() . '/css/main'.TM_MIN.'.css' , array('js_composer_front') );
		wp_register_style( 'digitallaw-dark', get_template_directory_uri() . '/css/dark'.TM_MIN.'.css' , array('js_composer_front', 'digitallaw-main-style') );  // Dark
		
	} else {
		wp_enqueue_style( 'digitallaw-main-style', get_template_directory_uri() . '/css/main'.$min.'.css' );
		wp_register_style( 'digitallaw-dark', get_template_directory_uri() . '/css/dark'.TM_MIN.'.css' , array( 'digitallaw-main-style') );  // Dark
	}
	
	// Load dark.css if dark layout
	//if( isset($digitallaw_theme_options['inner_background']['background-color']) && trim($digitallaw_theme_options['inner_background']['background-color'])!='' && digitallaw_check_dark_color($digitallaw_theme_options['inner_background']['background-color']) ){  // This is old code
	if( !empty($digitallaw_theme_options['layout_type']) && trim($digitallaw_theme_options['layout_type'])=='dark' ){
		wp_enqueue_style('digitallaw-dark');
	}
}
add_action( 'wp_enqueue_scripts', 'digitallaw_scripts_styles_15', 15 );





function digitallaw_scripts_styles_16() {
	global $digitallaw_theme_options;
	
	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'digitallaw-ie', get_template_directory_uri() . '/css/ie'.TM_MIN.'.css' );
	wp_style_add_data( 'digitallaw-ie', 'conditional', 'lt IE 10' );
	
	wp_enqueue_style( 'digitallaw-last-checkpoint', get_template_directory_uri() . '/css/digitallaw-last-checkpoint'.TM_MIN.'.css' );
}

if( !is_multisite() ){   // checking if not multi site
	add_action( 'wp_enqueue_scripts', 'digitallaw_scripts_styles_16', 16 );
}




function digitallaw_scripts_styles_17() {
	// Responsive
	global $digitallaw_theme_options;
	
	if($digitallaw_theme_options['responsive']=='1'){
		wp_enqueue_style( 'digitallaw-responsive-style', get_template_directory_uri() . '/css/responsive'.TM_MIN.'.css' );
	}
	
	
	
	
	// Loads JavaScript file with functionality specific to DigitalLaw.
	if ( wp_script_is( 'wpb_composer_front_js', 'registered' ) ) {
		wp_enqueue_script( 'digitallaw-script', get_template_directory_uri() . '/js/functions'.TM_MIN.'.js', array( 'jquery', 'wpb_composer_front_js' ), '1.0', true );
	} else {
		wp_enqueue_script( 'digitallaw-script', get_template_directory_uri() . '/js/functions'.TM_MIN.'.js', array( 'jquery' ), '1.0', true );
	}
	
	
}
add_action( 'wp_enqueue_scripts', 'digitallaw_scripts_styles_17', 17 );




/**
 * Enqueue scripts and styles for the admin section.
 *
 * @since DigitalLaw 1.0
 *
 * @return void
 */
function digitallaw_custom_wp_admin_style() {
	
	wp_enqueue_style( 'digitallaw_custom_wp_admin_css', get_template_directory_uri() . '/inc/admin-style.css', false, '1.0.0' );
	wp_enqueue_script( 'digitallaw_custom_js', get_template_directory_uri() . '/inc/admin-custom.js', array( 'jquery' ) );
	
}
add_action( 'admin_enqueue_scripts', 'digitallaw_custom_wp_admin_style' );


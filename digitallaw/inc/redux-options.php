<?php 
$args = array();

// Getting all values of Theme Options
global $digitallaw_theme_options;
$digitallaw_theme_options = get_option('digitallaw_theme_options');

// For use with a tab example below
$tabs = array();



/*
 *  Disable tracking for Redux Framework
 */
$options                   = get_option( 'redux-framework-tracking' );
$options['allow_tracking'] = 'no';
update_option( 'redux-framework-tracking', $options );




// BEGIN Sample Config

// Setting dev mode to true allows you to view the class settings/info in the panel.
// Default: true
$args['dev_mode']   = false;
$args['customizer'] = false;

//Remove Options Object tab when in localhost 
$args['show_options_object'] = false; 


// Set the icon for the dev mode tab.
// If $args['icon_type'] = 'image', this should be the path to the icon.
// If $args['icon_type'] = 'iconfont', this should be the icon name.
// Default: info-sign
//$args['dev_mode_icon'] = 'info-sign';

// Set the class for the dev mode tab icon.
// This is ignored unless $args['icon_type'] = 'iconfont'
// Default: null
$args['dev_mode_icon_class'] = 'icon-large';

// Set a custom option name. Don't forget to replace spaces with underscores!
$args['opt_name'] = 'digitallaw_theme_options';

// Disable tracking
$args['disable_tracking'] = true;

// Setting system info to true allows you to view info useful for debugging.
// Default: false
//$args['system_info'] = true;


// Set the icon for the system info tab.
// If $args['icon_type'] = 'image', this should be the path to the icon.
// If $args['icon_type'] = 'iconfont', this should be the icon name.
// Default: info-sign
//$args['system_info_icon'] = 'info-sign';

// Set the class for the system info tab icon.
// This is ignored unless $args['icon_type'] = 'iconfont'
// Default: null
//$args['system_info_icon_class'] = 'icon-large';

$theme = wp_get_theme();

$args['display_name'] = $theme->get('Name');
//$args['database'] = "theme_mods_expanded";
$args['display_version'] = $theme->get('Version');

// If you want to use Google Webfonts, you MUST define the api key.
$args['google_api_key'] = 'AIzaSyAX_2L_UzCDPEnAHTG7zhESRVpMPS4ssII';

// Define the starting tab for the option panel.
// Default: '0';
//$args['last_tab'] = '0';

// Define the option panel stylesheet. Options are 'standard', 'custom', and 'none'
// If only minor tweaks are needed, set to 'custom' and override the necessary styles through the included custom.css stylesheet.
// If replacing the stylesheet, set to 'none' and don't forget to enqueue another stylesheet!
// Default: 'standard'
//$args['admin_stylesheet'] = 'standard';

// Setup custom links in the footer for share icons
$args['share_icons']['twitter'] = array(
	'link' => 'https://twitter.com/thememount',
	'title' => 'Follow us on Twitter', 
	'img' => get_template_directory_uri() . '/inc/images/twitter.png'
);

// Enable the import/export feature.
// Default: true
//$args['show_import_export'] = false;

// Set the icon for the import/export tab.
// If $args['icon_type'] = 'image', this should be the path to the icon.
// If $args['icon_type'] = 'iconfont', this should be the icon name.
// Default: refresh
//$args['import_icon'] = 'refresh';

// Set the class for the import/export tab icon.
// This is ignored unless $args['icon_type'] = 'iconfont'
// Default: null
$args['import_icon_class'] = 'icon-large';

/**
 * Set default icon class for all sections and tabs
 * @since 3.0.9
 */
$args['default_icon_class'] = 'icon-large';


// Set a custom menu icon.
//$args['menu_icon'] = '';

// Set a custom title for the options page.
// Default: Options
$args['menu_title'] = esc_attr__('Theme Options', 'digitallaw');

// Set a custom page title for the options page.
// Default: Options
$args['page_title'] = esc_attr__('Theme Options', 'digitallaw');

// Set a custom page slug for options page (wp-admin/themes.php?page=***).
// Default: redux_options
$args['page_slug'] = 'thememount_theme_options';

$args['default_show'] = true;
$args['default_mark'] = '*';

// Set a custom page capability.
// Default: manage_options
//$args['page_cap'] = 'manage_options';

// Set the menu type. Set to "menu" for a top level menu, or "submenu" to add below an existing item.
// Default: menu
//$args['page_type'] = 'submenu';
$args['page_type'] = 'submenu';

// Set the parent menu.
// Default: themes.php
// A list of available parent menus is available at http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
//$args['page_parent'] = 'options_general.php';

// Set a custom page location. This allows you to place your menu where you want in the menu order.
// Must be unique or it will override other items!
// Default: null
//$args['page_position'] = null;

// Set a custom page icon class (used to override the page icon next to heading)
//$args['page_icon'] = 'icon-themes';

// Set the icon type. Set to "iconfont" for Elusive Icon, or "image" for traditional.
// Redux no longer ships with standard icons!
// Default: iconfont
//$args['icon_type'] = 'image';

// Disable the panel sections showing as submenu items.
// Default: true
//$args['allow_sub_menu'] = false;
    
// Set ANY custom page help tabs, displayed using the new help tab API. Tabs are shown in order of definition.
$args['help_tabs'][] = array(
    'id' => 'thememount-opts-1',
    'title' => esc_attr__('Help and Support', 'digitallaw'),
    'content' => '<h3>'. esc_attr__('Help and Support','digitallaw') .'</h3>
		<ul>
			<li><a href="'. esc_url('http://digitallaw.thememountdemo.com/documentation/index.html') .'" target="_blank">'. esc_attr__('Theme Help Documenation','digitallaw') .'</a></li>
			<li><a href="'. esc_url('http://support.thememount.com/') .'" target="_blank">'. esc_attr__('Questions? Ask us here.','digitallaw') .'</a></li>
			<li><a href="'. esc_url('http://digitallaw.thememountdemo.com/') .'" target="_blank">'. esc_attr__('Live Demo','digitallaw') .'</a></li>
		</ul>'
);



// Add HTML before the form.
if (!isset($args['global_variable']) || $args['global_variable'] !== false ) {
	/*if (!empty($args['global_variable'])) {
		$v = $args['global_variable'];
	} else {
		$v = str_replace("-", "_", $args['opt_name']);
	}*/
	$args['intro_text'] = sprintf(
		esc_html__( 'If you have any problem or question than you can %1$s read theme documentation online by clicking here %3$s. If still not working than you can %2$s contact us via our support ticket system %3$s.','digitallaw' ),
		'<a href="http://digitallaw.thememountdemo.com/documentation/" target="_blank">',
		'<a href="http://support.thememount.com" target="_blank">',
		'</a>'
	);

} else {
	// 
}

// Add content after the form.
//$args['footer_text'] = esc_html__('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'digitallaw');

// Set footer/credit line.
//$args['footer_credit'] = esc_html__('<p>This text is displayed in the options panel footer across from the WordPress version (where it normally says \'Thank you for creating with WordPress\'). This field accepts all HTML.</p>', 'digitallaw');




/*
 *  Theme Options array
 */
include get_template_directory() . '/inc/redux-options-array.php';
$sections = digitallaw_theme_options_array();



//Background Patterns Reader
$sample_patterns_path = ReduxFramework::$_dir . '../../../images/patterns/';
$sample_patterns_url  = get_template_directory_uri() . '/images/patterns/';
$sample_patterns      = array();



if ( is_dir( $sample_patterns_path ) ) :
	if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
		$sample_patterns = array();
		while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {
			if( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
				$name = explode(".", $sample_patterns_file);
				$name = str_replace('.'.end($name), '', $sample_patterns_file);
				$sample_patterns[] = array( 'alt'=>$name,'img' => $sample_patterns_url . $sample_patterns_file );
			}
		}
	endif;
endif;


/**
 *  Redux Vendor Support
 *
 * This plugin (or extension) acts as a backup and/or replacement for the CDN based files for Select2 and ACE Editor used within Redux Framework.
 *
 */
$args['use_cdn'] = false;  // Disabling external CDN
//include_once get_template_directory().'/inc/redux-framework/redux-vendor-support/redux-vendor-support.php';





if (function_exists('wp_get_theme')){
	$theme_data = wp_get_theme();
	$theme_uri = $theme_data->get('ThemeURI');
	$description = $theme_data->get('Description');
	$author = $theme_data->get('Author');
	$version = $theme_data->get('Version');
	$tags = $theme_data->get('Tags');
}else{
	$theme_data = wp_get_theme(trailingslashit(get_stylesheet_directory()).'style.css');
	$theme_uri = $theme_data['URI'];
	$description = $theme_data['Description'];
	$author = $theme_data['Author'];
	$version = $theme_data['Version'];
	$tags = $theme_data['Tags'];
}	

$theme_info = '<div class="redux-framework-section-desc">';
$theme_info .= '<p class="redux-framework-theme-data description theme-uri">'.esc_html__('<strong>Theme URL:</strong> ', 'digitallaw').'<a href="'.$theme_uri.'" target="_blank">'.$theme_uri.'</a></p>';
$theme_info .= '<p class="redux-framework-theme-data description theme-author">'.esc_html__('<strong>Author:</strong> ', 'digitallaw').$author.'</p>';
$theme_info .= '<p class="redux-framework-theme-data description theme-version">'.esc_html__('<strong>Version:</strong> ', 'digitallaw').$version.'</p>';
$theme_info .= '<p class="redux-framework-theme-data description theme-description">'.$description.'</p>';
if ( !empty( $tags ) ) {
	$theme_info .= '<p class="redux-framework-theme-data description theme-tags">'.esc_html__('<strong>Tags:</strong> ', 'digitallaw').implode(', ', $tags).'</p>';	
}
$theme_info .= '</div>';

global $ReduxFramework;
$ReduxFramework = new ReduxFramework($sections, $args, $tabs);



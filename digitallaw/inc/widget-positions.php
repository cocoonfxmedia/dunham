<?php
/**
 * Register widget areas.
 *
 * @since DigitalLaw 1.0
 *
 * @return void
 */
function digitallaw_widgets_init() {
	
	global $digitallaw_theme_options;
	
	register_sidebar( array(
		'name' => esc_html__( 'Left Sidebar for Blog', 'digitallaw' ),
		'id' => 'sidebar-left-blog',
		'description' => esc_html__( 'This is left sidebar for blog section', 'digitallaw' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Right Sidebar for Blog', 'digitallaw' ),
		'id' => 'sidebar-right-blog',
		'description' => esc_html__( 'This is right sidebar for blog section', 'digitallaw' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Left Sidebar for Pages', 'digitallaw' ),
		'id' => 'sidebar-left-page',
		'description' => esc_html__( 'This is left sidebar for pages', 'digitallaw' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Right Sidebar for Pages', 'digitallaw' ),
		'id' => 'sidebar-right-page',
		'description' => esc_html__( 'This is right sidebar for pages', 'digitallaw' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Left Sidebar for Search', 'digitallaw' ),
		'id' => 'sidebar-left-search',
		'description' => esc_html__( 'This is left sidebar for search', 'digitallaw' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Right Sidebar for search', 'digitallaw' ),
		'id' => 'sidebar-right-search',
		'description' => esc_html__( 'This is right sidebar for search', 'digitallaw' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// Floating bar widgets
	$class = digitallaw_class_for_widgets_count( digitallaw_get_widgets_count( 'floating-header-widgets' ) );
	register_sidebar( array(
		'name'          => esc_html__( 'Floating Header Widgets', 'digitallaw' ),
		'id'            => 'floating-header-widgets',
		'description'   => esc_html__( 'Set widgets for Floating Header area.', 'digitallaw' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s '.$class.'">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	// WooCommerce
	register_sidebar( array(
		'name' => esc_html__( 'WooCommerce Shop', 'digitallaw' ),
		'id' => 'sidebar-woocommerce',
		'description' => esc_html__( 'This is sidebar for WooCommerce shop pages.', 'digitallaw' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// BBPress
	register_sidebar( array(
		'name'          => esc_html__( 'BBPress Sidebar', 'digitallaw' ),
		'id'            => 'sidebar-bbpress',
		'description'   => esc_html__( 'This is sidebar for BBPress.', 'digitallaw' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	
	// The Events Calendar
	register_sidebar( array(
		'name'          => esc_html__( 'Events Sidebar', 'digitallaw' ),
		'id'            => 'sidebar-events',
		'description'   => esc_html__( 'This is sidebar for "The Events Calendar" plugin only.', 'digitallaw' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	
	$pf_cat_title  = ( !empty($digitallaw_theme_options['pf_cat_title']) ) ? esc_attr($digitallaw_theme_options['pf_cat_title']) : esc_html__('Practice Area Category','digitallaw');
	
	// Portfolio category widgets
	register_sidebar( array(
		'name'          => sprintf( esc_html__( 'Widgets for %s', 'digitallaw' ), $pf_cat_title),
		'id'            => 'pf-cat-sidebar',
		'description'   => sprintf( esc_html__( 'This is sidebar for "%s" (portfolio category) sidebar.', 'digitallaw' ), $pf_cat_title),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	
	$team_group_title  = ( !empty($digitallaw_theme_options['team_group_title']) ) ? esc_attr($digitallaw_theme_options['team_group_title']) : esc_html__('Services','digitallaw');
	// Portfolio category widgets
	register_sidebar( array(
		'name'          => sprintf( esc_html__( 'Widgets for %s', 'digitallaw' ), $team_group_title),
		'id'            => 'team-group-sidebar',
		'description'   => sprintf( esc_html__( 'This is sidebar for "%s" (Team group) sidebar.', 'digitallaw' ), $team_group_title),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	//First Row Footer Widget Areas
	register_sidebar( array(
		'name' => esc_html__( 'Footer 1st Row - First Column Area', 'digitallaw' ),
		'id' => 'first-top-footer-widget-area',
		'description' => esc_html__( 'This is First Widget area for First Row', 'digitallaw' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Footer 1st Row - Second Column Area', 'digitallaw' ),
		'id' => 'second-top-footer-widget-area',
		'description' => esc_html__( 'This is Second Widget area for First Row', 'digitallaw' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Footer 1st Row - Third Column Area', 'digitallaw' ),
		'id' => 'third-top-footer-widget-area',
		'description' => esc_html__( 'This is Third Widget area for First Row', 'digitallaw' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Footer 1st Row - Fourth Column Area', 'digitallaw' ),
		'id' => 'fourth-top-footer-widget-area',
		'description' => esc_html__( 'This is Fourth Widget area for First Row', 'digitallaw' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	// Secon Row Footer Widget Areas 
	register_sidebar( array(
		'name' => esc_html__( 'Footer 2nd Row - First Column Area', 'digitallaw' ),
		'id' => 'first-footer-widget-area',
		'description' => esc_html__( 'This is First Widget area for Second Row', 'digitallaw' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Footer 2nd Row - Second Column Area', 'digitallaw' ),
		'id' => 'second-footer-widget-area',
		'description' => esc_html__( 'This is Second Widget area for Second Row', 'digitallaw' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Footer 2nd Row - Third Column Area', 'digitallaw' ),
		'id' => 'third-footer-widget-area',
		'description' => esc_html__( 'This is Third Widget area for Second Row', 'digitallaw' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Footer 2nd Row - Fourth Column Area', 'digitallaw' ),
		'id' => 'fourth-footer-widget-area',
		'description' => esc_html__( 'This is Fourth Widget area for Second Row', 'digitallaw' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// Dynamic Sidebars (Unlimited Sidebars)
	global $digitallaw_theme_options;
	if( isset($digitallaw_theme_options['sidebars']) && is_array($digitallaw_theme_options['sidebars']) && count($digitallaw_theme_options['sidebars'])>0 ){
		foreach( $digitallaw_theme_options['sidebars'] as $custom_sidebar ){
			if( trim($custom_sidebar)!='' ){
				$custom_sidebar_key = str_replace('-','_',sanitize_title($custom_sidebar));
				register_sidebar( array(
					'name'          => $custom_sidebar,
					'id'            => $custom_sidebar_key,
					'description'   => esc_html__( 'This is custom widget developed from "Appearance > Theme Options".', 'digitallaw' ),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget'  => '</aside>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
				) );
			}
		}
	}
	
}
add_action( 'widgets_init', 'digitallaw_widgets_init' );

<?php
/**
 * The sidebar containing the sidebar 1.
 *
 */

global $digitallaw_theme_options;

?>

<?php
if( is_page() ){
	?>
	
	<?php
	$sidebar1      = 'sidebar-left-page';
	$sidebar1_page = get_post_meta($post->ID,'_thememount_page_options_leftsidebar',true);
	if( trim($sidebar1_page)!='' ){ $sidebar1 = trim($sidebar1_page); }
	
	
	
	
	
	// The Events Calendar
	if( function_exists('tribe_is_upcoming') ){
		if (get_post_type()=='tribe_events'){
			$events_sidebar = !empty($digitallaw_theme_options['sidebar_events']) ? esc_attr($digitallaw_theme_options['sidebar_events']) : 'no' ; // Global settings
			if( $events_sidebar=='left' ){
				$sidebar1 = 'sidebar-events';
			}
		}
	}
	
	?>

	<aside id="sidebar-left" class="widget-area col-md-3 col-lg-3 col-xs-12 sidebar" role="complementary">
		<?php dynamic_sidebar( $sidebar1 ); ?>
	</aside><!-- #sidebar-left -->
		
	<?php
} elseif( is_home() || is_single() ){
	
	$pageid   = get_option('page_for_posts');
	$postType = 'page';
	if( is_single() ){
		global $post;
		$pageid   = $post->ID;
		$postType = 'post';
	}
	
	?>
	
	<?php
	$sidebar1      = 'sidebar-left-blog';
	$sidebar1_blog = get_post_meta( $pageid ,'_thememount_'.$postType.'_options_leftsidebar',true);
	if( trim($sidebar1_blog)!='' ){ $sidebar1 = trim($sidebar1_blog); }
	
	
	// The Events Calendar
	if( function_exists('tribe_is_upcoming') ){
		if ( get_post_type() == 'tribe_events' || tribe_is_upcoming() || tribe_is_month() || tribe_is_by_date() || tribe_is_day() || is_single('tribe_events')){
			$events_sidebar = ( isset($digitallaw_theme_options['sidebar_events']) && trim($digitallaw_theme_options['sidebar_events'])!='' ) ? esc_attr($digitallaw_theme_options['sidebar_events']) : 'no' ; // Global settings
			if( $events_sidebar=='left' ){
				$sidebar1 = 'sidebar-events';
			}
		}
	}
	
	
	?>

	<aside id="sidebar-left" class="widget-area col-md-3 col-lg-3 col-xs-12 sidebar" role="complementary">
		<?php dynamic_sidebar( $sidebar1 ); ?>
	</aside><!-- #sidebar-left -->
		
	<?php
} elseif( is_search() ) {
	
	?>
	<aside id="sidebar-left" class="widget-area col-md-3 col-lg-3 col-xs-12 sidebar" role="complementary">
		<?php dynamic_sidebar( 'sidebar-left-search' ); ?>
	</aside><!-- #sidebar-left -->


	
	<?php
} elseif( function_exists('is_bbpress') && is_bbpress() ) {
	$bbpressSidebar = isset($digitallaw_theme_options['sidebar_bbpress']) ? esc_attr($digitallaw_theme_options['sidebar_bbpress']) : 'right' ;
	?>
	
	<?php if( $bbpressSidebar=='left' ): ?>
	
		<aside id="sidebar-left" class="widget-area col-md-3 col-lg-3 col-xs-12 sidebar bbpress-sidebar" role="complementary">
			<?php dynamic_sidebar( 'sidebar-bbpress' ); ?>
		</aside><!-- #sidebar-left -->
		
	<?php endif; ?>
	
	
	
	<?php
} elseif( (function_exists('tribe_is_upcoming')) && (get_post_type() == 'tribe_events' || tribe_is_upcoming() || tribe_is_month() || tribe_is_by_date() || tribe_is_day() || is_single('tribe_events'))){
	
	$sidebar1 = 'sidebar-events';

	
	?>
	
	<aside id="sidebar-left" class="widget-area col-md-3 col-lg-3 col-xs-12 sidebar tm-events-sidebar tm-events-sidebar-left" role="complementary">
		<?php dynamic_sidebar( $sidebar1 ); ?>
	</aside><!-- #sidebar-left -->
	
	
	

	<?php
} else {
	
	global $digitallaw_theme_options;
	$sidebar2 = esc_attr($digitallaw_theme_options['sidebar_blog']); // Global settings
	$sidebar2 = 'sidebar-left-blog';
	$sidebar2_post = get_post_meta($post->ID,'_thememount_post_options_leftsidebar',true);
	if( trim($sidebar2_post)!='' ){ $sidebar2 = trim($sidebar2_post); }
	
	
	
	?>
	<aside id="sidebar-left" class="widget-area col-md-3 col-lg-3 col-xs-12 sidebar" role="complementary">
		<?php dynamic_sidebar( $sidebar2 ); ?>
	</aside><!-- #sidebar-left -->
	
	<?php
}

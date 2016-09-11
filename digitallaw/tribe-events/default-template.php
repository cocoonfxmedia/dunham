<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

get_header(); 
global $digitallaw_theme_options;
$sidebar = esc_attr($digitallaw_theme_options['sidebar_events']); // Global settings

$primaryclass = '';
if( $sidebar!='no' ){
	$primaryclass = digitallaw_setPrimaryClass($sidebar);
}
?>
	<?php if( $sidebar!='no' && $sidebar!='' ): ?>
		<div class="container"><div class="row">
	<?php endif; ?>

	<div id="primary" class="content-area <?php echo digitallaw_sanitize_html_classes($primaryclass); ?>">
		<div id="tribe-events-pg-template">
			<?php tribe_events_before_html(); ?>
			<?php tribe_get_view(); ?>
			<?php tribe_events_after_html(); ?>
		</div> <!-- #tribe-events-pg-template -->
	</div>
	
	<?php
	// Sidebar 1 (Left Sidebar)
	if($sidebar=='left' || $sidebar=='right'){
		get_sidebar($sidebar);
	}
	?>
	
<?php if( $sidebar!='no' && $sidebar!='' ): ?>
	</div><!-- .row -->  </div><!-- .container -->
<?php endif; ?>
	
	
<?php get_footer(); ?>
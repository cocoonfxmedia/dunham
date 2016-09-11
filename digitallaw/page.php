<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage DigitalLaw
 * @since DigitalLaw 1.0
 */

get_header();

global $digitallaw_theme_options;
$sidebar = esc_attr($digitallaw_theme_options['sidebar_page']); // Global settings

// If BBPress
if( function_exists('is_bbpress') && is_bbpress() ){
	$sidebar = esc_attr($digitallaw_theme_options['sidebar_bbpress']); // Global settings
	
	// If The Events Calendar
} else if( function_exists('tribe_is_upcoming') && function_exists('tribe_is_month') && function_exists('tribe_is_by_date') ){
	if ( get_post_type() == 'tribe_events' && ( tribe_is_upcoming() || tribe_is_month() || tribe_is_by_date() || is_single() ) ) {
		$sidebar = !empty($digitallaw_theme_options['sidebar_events']) ? esc_attr($digitallaw_theme_options['sidebar_events']) : 'no' ; // Global settings
	}

}


$sidebarposition = get_post_meta( get_the_ID(), '_thememount_page_options_sidebarposition', true);
if( is_array($sidebarposition) ){ $sidebarposition = $sidebarposition[0]; } // Converting to String if Array

// Page settings
if( trim($sidebarposition) != '' ){
	$sidebar = $sidebarposition;
}


// Primary Content class
$primaryclass = 'col-md-12';
if( $sidebar!='no' ){
	$primaryclass = digitallaw_setPrimaryClass($sidebar);
}


?>

<?php if( $sidebar!='no' && $sidebar!='' ): ?>
	<div class="container"><div class="row">
<?php endif; ?>
	
	<div id="primary" class="content-area <?php echo digitallaw_sanitize_html_classes($primaryclass); ?>">
		<div id="content" class="site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
					<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
					<div class="entry-thumbnail">
						<?php the_post_thumbnail(); ?>
					</div>
					<?php endif; ?>

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'digitallaw' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div><!-- .entry-content -->

					<footer class="entry-meta">
						<?php edit_post_link( esc_html__( 'Edit', 'digitallaw' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</div><!-- #post -->

				<?php comments_template(); ?>
			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->
	
	<?php
	// Resetting post data
	wp_reset_postdata();
	
	// Sidebar 1 (Left Sidebar)
	if($sidebar=='left' || $sidebar=='both' || $sidebar=='bothleft' || $sidebar=='bothright' ){
		get_sidebar('left');
	}

	// Sidebar 2 (Right Sidebar)
	if($sidebar=='right' || $sidebar=='both' || $sidebar=='bothleft' || $sidebar=='bothright' ){
		get_sidebar('right');
	}
	?>
	
<?php if( $sidebar!='no' && $sidebar!='' ): ?>
	</div><!-- .row -->  </div><!-- .container -->
<?php endif; ?>
	



<?php get_footer(); ?>
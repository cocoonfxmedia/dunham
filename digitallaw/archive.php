<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, DigitalLaw
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage DigitalLaw
 * @since DigitalLaw 1.0
 */

get_header();

// Checking if Blog page
$primaryclass = 'col-md-12 col-lg-12 col-sm-12 col-xs-12';
global $digitallaw_theme_options;
$sidebar = esc_attr($digitallaw_theme_options['sidebar_blog']); // Global settings

// Page settings
if( isset($sidebarposition) && trim($sidebarposition) != '' ){
	$sidebar = $sidebarposition;
}

// Primary Content class
$primaryclass = digitallaw_setPrimaryClass($sidebar);

?>
<div class="container">
	<div class="row multi-columns-row">		
		
	<div id="primary" class="content-area <?php echo digitallaw_sanitize_html_classes($primaryclass); ?>">
		<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
				if( !empty($digitallaw_theme_options['blog_view']) && trim(esc_attr($digitallaw_theme_options['blog_view'])) != 'classic' ) {
					echo digitallaw_blogbox(esc_attr($digitallaw_theme_options['blog_view']));
				} else {
					get_template_part( 'content', 'post' );
				}
				?>
			<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
		
		<div class="clr clear"></div>
		<?php digitallaw_paging_nav(); ?>

		</div><!-- #content -->
	</div><!-- #primary -->

	
	<?php
	// Sidebar 1 (Left Sidebar)
	if($sidebar=='left' || $sidebar=='both' || $sidebar=='bothleft' || $sidebar=='bothright' ){
		get_sidebar('left');
	}

	// Sidebar 2 (Right Sidebar)
	if($sidebar=='right' || $sidebar=='both' || $sidebar=='bothleft' || $sidebar=='bothright' ){
		get_sidebar('right');
	}
	?>
	
	</div><!-- .row -->
</div><!-- .container -->
<?php get_footer(); ?>
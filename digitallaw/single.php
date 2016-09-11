<?php
/**
 * The template for displaying all single posts
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

$sidebarposition = get_post_meta( get_the_ID(), '_thememount_post_options_sidebarposition', true);

// Page settings
if( isset($sidebarposition) && trim($sidebarposition) != '' ){
	$sidebar = $sidebarposition;
}

// Primary Content class
$primaryclass = digitallaw_setPrimaryClass($sidebar);


?>
<div class="container">
  <div class="row">		

	<div id="primary" class="content-area <?php echo digitallaw_sanitize_html_classes($primaryclass); ?>">
		<div id="content" class="site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'post' ); ?>
				<?php digitallaw_post_nav(); ?>
				<?php comments_template(); ?>

			<?php endwhile; ?>

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
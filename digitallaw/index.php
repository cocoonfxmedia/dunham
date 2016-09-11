<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage DigitalLaw
 * @since DigitalLaw 1.0
 */

get_header();



// Checking if Blog page
$primaryclass = 'col-md-12 col-lg-12 col-xs-12';
if( is_home() ){
	global $digitallaw_theme_options;
	
	$template    = get_page_template_slug( get_option('page_for_posts') );
	$pageSidebar = get_post_meta( get_option('page_for_posts'), '_thememount_page_options_sidebarposition', true );
	if( is_array($pageSidebar) ){ $pageSidebar = $pageSidebar[0]; } // Converting to String if Array
	$blogSidebar = esc_attr($digitallaw_theme_options['sidebar_blog']); // Global settings

	if( $template!='template-full-width.php' ){
		if( $pageSidebar!='' ){
			$sidebar = $pageSidebar;
		} else {
			$sidebar = $blogSidebar;
		}
	} else {
		$sidebar = '';
	}
	
	

	// Page settings
	if( isset($sidebarposition) && trim($sidebarposition) != '' ){
		$sidebar = $sidebarposition;
	}

	// Primary Content class
	$primaryclass = digitallaw_setPrimaryClass($sidebar);
}

?>
<div class="container">
<div class="row multi-columns-row">		
		


	<div id="primary" class="content-area <?php echo digitallaw_sanitize_html_classes($primaryclass); ?>">
	
		<?php
		$site_content_class = '';
		if( !empty($digitallaw_theme_options['blog_view']) && trim(esc_attr($digitallaw_theme_options['blog_view'])) != 'classic' ) {
			$site_content_class = 'row';
		}
		?>
	
		<div id="content" class="site-content <?php echo sanitize_html_class($site_content_class); ?>" role="main">
		<?php if ( have_posts() ) : ?>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
				if(  !empty($digitallaw_theme_options['blog_view']) && trim(esc_attr($digitallaw_theme_options['blog_view'])) != 'classic' ) {
					echo digitallaw_blogbox(esc_attr($digitallaw_theme_options['blog_view']));
				} else {
					get_template_part( 'content', 'post' );
				}
				
				?>
			<?php endwhile; ?>

			

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
		<?php digitallaw_paging_nav(); ?>
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
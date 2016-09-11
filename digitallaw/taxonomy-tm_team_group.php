<?php
/**
 * The template for displaying Team Group
 *
 * Used to display team_member with a unique design.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage DigitalLaw
 * @since DigitalLaw 1.0
 */
global $digitallaw_theme_options;
global $wp_query;
$tax   = $wp_query->get_queried_object();


/*
 * Featured Image for taxonomy
 */
$featured_img = get_option( "taxonomy_term_$tax->term_id" );
if( isset( $featured_img['thememount_img_url'] ) ){
	$featured_img = $featured_img['thememount_img_url'];
}






get_header(); ?>

<div class="container">
	<div class="row">
		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
			
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
					<!-- Left Sidebar -->
					<div class="tm-taxonomy-left col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<div class="tm-taxonomy-left-wrapper">
							<?php
							/* List of other groups */
							echo '<div class="tm-taxonomy-term-list"><ul>';
							echo wp_list_categories( array('taxonomy'=>$tax->taxonomy, 'hide_empty'=>0,'title_li'=>'','use_desc_for_title'=>0) );
							echo '</ul></div>';
							?>
						</div>
						
						<?php if( is_active_sidebar( 'team-group-sidebar' ) ) : ?>
							<aside id="tm-team-group-sidebar" class="widget-area sidebar" role="complementary">
								<?php dynamic_sidebar( 'team-group-sidebar' ); ?>
							</aside><!-- #tm-pf-cat-sidebar -->
						<?php endif; ?>
						
					</div>
					
					<!-- Right Content Area -->
					<div class="tm-taxonomy-right col-lg-9 col-md-9 col-sm-12 col-xs-12">
						
						<?php
						/*
						 * Category featured image
						 */
						if( trim($featured_img)!='' ){
							echo '<div class="tm-term-img"><img src="'.$featured_img.'" alt="'.$tax->name.'" /></div>';
						}
						?>
						
						
						<?php
						/*
						 * Category title and description
						 */
						echo '<div class="tm-term-desc">';
							echo '<span class="tm-term-title">'.do_shortcode('[tm-heading h2="'.$tax->name.'"]').'</span>';
							echo do_shortcode(nl2br($tax->description));
						echo '</div>';
						?>
						
						
						<?php /* The loop */ ?>
	
						<div class="row multi-columns-row">
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'content', 'teammember' ); ?>
								<?php comments_template(); ?>
							<?php endwhile; ?>
						</div><!-- .row -->
						
						<?php digitallaw_paging_nav(); ?>
						
					</div>
				
				</article>

			</div><!-- #content -->
		</div><!-- #primary -->
	
	</div><!-- .row -->
</div><!-- .container -->

<?php
/* Restore original Post Data */
wp_reset_postdata();
?>
<?php get_footer(); ?>
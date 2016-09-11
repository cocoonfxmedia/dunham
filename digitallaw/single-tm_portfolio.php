<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage DigitalLaw
 * @since DigitalLaw 1.0
 */

get_header();
$terms      = wp_get_post_terms( get_the_ID(), 'tm_portfolio_category' );
global $digitallaw_theme_options;


// Single Portfolio View
$portfolioView        = $digitallaw_theme_options['portfolio_viewstyle']; // Global view
$portfolioView_single = get_post_meta( get_the_ID(), '_thememount_portfolio_view_viewstyle', true); // Single portfolio view
if( is_array($portfolioView_single) ){ $portfolioView_single = $portfolioView_single[0]; }
if( trim($portfolioView_single)!='' && trim($portfolioView_single)!='global' ){
	$portfolioView = $portfolioView_single;
}



// Like
$likeActiveClass = ( isset($_COOKIE["thememount_likes_".get_the_ID()]) ) ? 'like-active' : '' ;
$likeIconClass   = ( isset($_COOKIE["thememount_likes_".get_the_ID()]) ) ? 'fa fa-heart' : 'fa fa-heart-o' ;
$likes = get_post_meta( get_the_ID(), 'thememount_likes', true );
if( !$likes ){ $likes='0'; }

$like = '<!-- Like -->
			<div class="thememount-portfolio-likes-wrapper">
				<a class="thememount-portfolio-likes ' . $likeActiveClass . '" href="javascript:void(0)" id="pid-' . get_the_ID() . '">
					<i class="'.$likeIconClass.'"></i>&nbsp;' . $likes . '
				</a>
			</div>';
if( isset($digitallaw_theme_options['portfolio_show_like']) && trim(esc_attr($digitallaw_theme_options['portfolio_show_like'])) == '0' ){
	$like = '';
}




$wrapper_img    = 'col-md-8';
$wrapper_text   = 'col-md-4';
$wrapper_desc   = '';
$wrapper_detail = '';
$wrapper_text_w_start = '';
$wrapper_text_w_end   = '';

if( esc_attr($portfolioView)=='top'){
	$wrapper_img    = 'col-md-12';
	$wrapper_text   = 'col-md-12';
	$wrapper_desc   = 'col-md-8';
	$wrapper_detail = 'col-md-4';
	$wrapper_text_w_start = '<div class="row">';
	$wrapper_text_w_end   = '</div>';
} else if( esc_attr($portfolioView)=='full'){
	$wrapper_text   = 'col-md-12';
	$wrapper_desc   = 'col-md-12';
	$wrapper_text_w_start = '<div class="row">';
	$wrapper_text_w_end   = '</div>';
}


// Related Portfolio - This function will echo all related portfolios
function digitallaw_related_pf(){
	global $digitallaw_theme_options;
	
	$catid      = wp_get_post_terms( get_the_ID() , 'tm_portfolio_category', array("fields" => "ids"));
	$thisPostID = array(get_the_ID());
	
	$args = array(
		'post__not_in' => $thisPostID,
		'post_type'    => 'tm_portfolio',
		'showposts'    => 3,
		'tax_query'    => array(
			array(
				'taxonomy' => 'tm_portfolio_category',
				'field'    => 'id',
				'terms'    => $catid,
			)
		),
		'orderby' => 'rand',
	);
	
	$relatedPortfolio = new WP_Query( $args );
	
	
	if ( $relatedPortfolio->have_posts() ) {
		echo '<div class="thememount-portfolio-related">';
		echo '<h2 class="tm-pf-title-relatedarticle">' . esc_attr( $digitallaw_theme_options['portfolio_related_title']) . '</h2>';
		echo '<div class="container"><div class="row">';
		while ( $relatedPortfolio->have_posts() ) { $relatedPortfolio->the_post(); ?>
			<?php echo digitallaw_portfoliobox( 'three' ); ?>
		<?php }; // end of the loop.
		echo '</div></div></div>';
	};
	
	// Restore original Post Data
	wp_reset_postdata();
	
}  // function digitallaw_related_pf()


?>



<div class="container">
	<div id="primary" class="site-content col">
		<div id="content" role="main">
			<div class="tm-pf-single-view tm-psingleview-<?php echo sanitize_html_class($portfolioView); ?>">
		
			<div class="tm-pf-single-title-w">
				<div class="tm-pf-single-title"><h2><?php echo get_the_title(); ?></h2></div>
				<div class="tm-pf-single-np-nav"><?php echo digitallaw_pf_single_np(); ?></div>
			</div>
			
			<?php if( esc_attr($portfolioView)=='full'): ?>
	
				<?php while ( have_posts() ) : the_post(); ?>
				<?php $categories = get_the_category( get_the_ID() ); /* Getting category list for showing related portfolio items */ ?>
				
				<div class="entry-content">
				
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php
						echo wp_kses( /* HTML Filter */
							$wrapper_text_w_start,
							array(
								'div'    => array(
									'class' => array(),
								),
							)
						);
						?>
							<div class="portfolio-description <?php echo sanitize_html_class($wrapper_desc); ?>">
								<?php the_content(); ?>
								
							</div><!-- .portfolio-description -->
						<?php
						echo wp_kses( /* HTML Filter */
							$wrapper_text_w_end,
							array(
								'div'    => array(
									'class' => array(),
								),
							)
						);
						?>
						
						
						
						<footer class="entry-meta">
							<?php edit_post_link( esc_html__( 'Edit', 'digitallaw' ), '<span class="edit-link">', '</span>' ); ?>
						</footer><!-- .entry-meta -->
					</article><!-- #post -->
					
                </div><!-- .entry-content -->
				
				<?php endwhile; // end of the loop. ?>
              
              

              

	

			<?php else: ?>

			
					
					
			
				<?php if( esc_attr($portfolioView)=='default' ) : ?>
					<?php /*** Default view - Left image and right content (default) ***/  ?>
					
					<?php while ( have_posts() ) : the_post(); ?>
					<?php $categories = get_the_category( get_the_ID() ); /* Getting category list for showing related portfolio items */ ?>
					
					<div class="row">
						
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="thememount-portfolio-content <?php echo sanitize_html_class($wrapper_img); ?>">
								<div class="entry-content">
									<?php digitallaw_get_portfolio_featured_content(); ?>
									<?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'digitallaw' ), 'after' => '</div>' ) ); ?>
								</div><!-- .entry-content -->
								
									
								
							</div><!-- .thememount-portfolio-content -->
							<div id="thememount-portfolio-sidebar" class="thememount-portfolio-aside <?php echo sanitize_html_class($wrapper_text); ?>">
							
							<?php
							echo wp_kses( /* HTML Filter */
								$wrapper_text_w_start,
								array(
									'div'    => array(
										'class' => array(),
									),
								)
							);
							?>
							
								<div class="portfolio-meta-details <?php echo sanitize_html_class($wrapper_detail); ?>">
									<?php digitallaw_portfolio_detailsbox(); ?>
								</div><!-- #portfolio-description -->
							<?php
							echo wp_kses( /* HTML Filter */
								$wrapper_text_w_end,
								array(
									'div'    => array(
										'class' => array(),
									),
								)
							);
							?>
								
							</div><!-- .portfolio-meta-details -->
							
							<div class="clear clr"></div>
							
							<div class="portfolio-description <?php echo sanitize_html_class($wrapper_desc); ?> col-md-12">
							
								<div class="tm-pf-description-title-w">
									<h2 class="tm-pf-description-title"><?php echo esc_attr($digitallaw_theme_options['portfolio_description']); ?></h2>
									
									<?php 
										echo wp_kses( // HTML Filter
											$like,
											array(
												'div'    => array(
													'class' => array(),
												),
												'a'    => array(
													'class' => array(),
													'href'  => array(),
													'id'    => array(),
												),
												'i'    => array(
													'class' => array(),
												),
											)
										);
									?>
								</div>
									
								<div id="sidebar-inner">
									<?php the_content(); ?>
									<?php echo digitallaw_pf_social_share_icons(); ?>
								</div>
							</div><!-- .portfolio-description -->
							
							
							
							
						</article><!-- #post -->
						<?php edit_post_link( esc_html__( 'Edit', 'digitallaw' ), '<footer class="entry-meta"><span class="edit-link">', '</span> </footer><!-- .entry-meta -->' ); ?>
					</div><!-- .row -->
					
					<?php endwhile; // end of the loop. ?>
					
					
					
					
					
				<?php else : ?>
					<?php /*** Top image and bottom content view ***/  ?>
					
					<?php while ( have_posts() ) : the_post(); ?>
					<?php $categories = get_the_category( get_the_ID() ); /* Getting category list for showing related portfolio items */ ?>
					
					<div class="row">
						
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="thememount-portfolio-content <?php echo sanitize_html_class($wrapper_img); ?>">
								<div class="entry-content">
									<?php digitallaw_get_portfolio_featured_content(); ?>
									<?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'digitallaw' ), 'after' => '</div>' ) ); ?>
								</div><!-- .entry-content -->
								
									<?php edit_post_link( esc_html__( 'Edit', 'digitallaw' ), '<footer class="entry-meta"><span class="edit-link">', '</span> </footer><!-- .entry-meta -->' ); ?>
								
							</div><!-- .thememount-portfolio-content -->
							<div id="thememount-portfolio-sidebar" class="thememount-portfolio-aside <?php echo sanitize_html_class($wrapper_text); ?>">
							
							<?php
							echo wp_kses( /* HTML Filter */
								$wrapper_text_w_start,
								array(
									'div'    => array(
										'class' => array(),
									),
								)
							);
							?>
								
								
								<div class="portfolio-description <?php echo sanitize_html_class($wrapper_desc); ?> col-md-12">
									<div class="tm-pf-description-title-w">
										<h2 class="tm-pf-description-title"><?php echo esc_attr($digitallaw_theme_options['portfolio_description']); ?></h2>
										<?php 
											echo wp_kses( // HTML Filter
												$like,
												array(
													'div'    => array(
														'class' => array(),
													),
													'a'    => array(
														'class' => array(),
														'href'  => array(),
														'id'    => array(),
													),
													'i'    => array(
														'class' => array(),
													),
												)
											);
										?>
									</div>
									<div id="sidebar-inner">
										<?php the_content(); ?>
										<?php echo digitallaw_pf_social_share_icons(); ?>
									</div>
								</div><!-- .portfolio-description -->
								
								<div class="portfolio-meta-details <?php echo sanitize_html_class($wrapper_detail); ?>">
									<?php digitallaw_portfolio_detailsbox(); ?>
								</div><!-- #portfolio-description -->
								
							<?php
							echo wp_kses( /* HTML Filter */
								$wrapper_text_w_end,
								array(
									'div'    => array(
										'class' => array(),
									),
								)
							);
							?>
								
							</div><!-- .portfolio-meta-details -->
							
							
							
							
							
							
							
						</article><!-- #post -->
						
					</div><!-- .row -->
					
					<?php endwhile; // end of the loop. ?>
					
					
					
					
				
				<?php endif; ?>
			

				
            
		
			<?php endif; ?>

			
			<?php
			if( esc_attr($digitallaw_theme_options['portfolio_show_related']) == '1' ){
				digitallaw_related_pf();
			}
			?>

			
			
			</div><!-- .tm-psingleview-$portfolioView -->
		</div><!-- #content -->
	</div><!-- #primary -->	
</div><!-- #container -->


		
		
<?php get_footer(); ?>

<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage DigitalLaw
 * @since DigitalLaw 1.0
 */


get_header();

global $digitallaw_theme_options;
$sidebar      = esc_attr($digitallaw_theme_options['sidebar_search']); // Global settings 
$primaryclass = digitallaw_setPrimaryClass($sidebar);  // Primary Content class

$postCount = 0;



function digitallaw_page_search_filter( $query ) {
	if ( $query->is_search && isset($_GET['post_type']) && $_GET['post_type']=='page' ) {
		$query->set( 'post_type', 'page' );
	}
	return $query;
}
add_filter('pre_get_posts','digitallaw_page_search_filter', 20);



// Fetching all results
$args = array();
if( get_query_var('post_type')=='any' && !isset($_GET['post_type']) ){
	$args['posts_per_page'] = -1 ;
} else if( get_query_var('post_type')=='tm_portfolilo'
		|| get_query_var('post_type')=='tm_team_member'
		|| get_query_var('post_type')=='product'
		|| get_query_var('post_type')=='tribe_events'
	){
	$args['posts_per_page'] = 9 ;
} else if( isset($_GET['post_type']) && $_GET['post_type']=='page' ){
	$args['posts_per_page'] = 20 ;
} else {
	// show 10 results for rest CPT
	$args['posts_per_page'] = 10 ;
}



// Fetching for CPT only result if set in URL query
if( get_query_var('post_type')!=false && get_query_var('post_type')!='any' ){ $args['post_type'] = get_query_var('post_type'); }


// Final query
if ($wp_query->is_search) {
	query_posts( array_merge( $args, $wp_query->query) );
}



// Max result per custom post type
$tm_max_result_per_cpt = 10;

?>

<div class="container">
	<div class="row">
		<div id="primary" class="content-area <?php echo digitallaw_sanitize_html_classes($primaryclass); ?>">
			<div id="content" class="site-content" role="main">
			
			<?php if( get_query_var('post_type')=='team_member' && trim(get_query_var('s'))!='' ): ?>
				<div class="thememount-content-team-search-box">
					<?php echo digitallaw_team_search_form(); ?>
				</div>
			<?php endif; ?>
			
			
			
			
			<?php
			// Page and Post List
			if ( have_posts() ) :
				$pageListCount      = 0;
				$postListCount      = 0;
				$portfolioListCount = 0;
				$teamListCount      = 0;
				$wproductsListCount = 0;
				$eventsListCount    = 0;
				$pageList      = '';
				$postList      = '';
				$portfolioList = '';
				$teamList      = '';
				$wproductsList = '';
				$eventsList    = '';
				$postType      = '';
				$pageListClass = 'col-md-6';
				$postListClass = 'col-md-6';
				$otherCPT      = array();
				
				$pageListLeft  = '';
				$pageListRight = '';
				$pageListLeftCount  = 0;
				$pageListRightCount = 0;
				
				
				$cpt_title_portfolio = ( !empty($digitallaw_theme_options['pf_type_title']) ) ? esc_attr($digitallaw_theme_options['pf_type_title']) : esc_html__('Practice Area','digitallaw');
				
				$cpt_title_team      = ( !empty($digitallaw_theme_options['team_type_title']) ) ? esc_attr($digitallaw_theme_options['team_type_title']) : esc_html__('Lawyers','digitallaw');
				
				
				/* The loop */
				while ( have_posts() ) : the_post();
				
					if( get_post_type() == 'page' ){
						// Page
						$showPage = ( get_query_var('post_type')=='page' ) ? 20 : 10 ;
						if( get_query_var('post_type')=='page' ){
							$pageListClass = 'col-md-12';
						}
						if( $pageListCount<$showPage ){
							if( get_query_var('post_type')=='page' ){
								// PAGE only result page
								
								$desc = ( has_excerpt() ) ? '<div class="tm-result-page-content">'.get_the_excerpt().'</div>' : '' ;
								
								if( $pageListLeftCount<10 ){
									$pageListLeft .= '
									<li>
										<h4><i class="tm-skincolor fa fa-file-text-o"></i>  <a href="'.get_permalink().'">'.get_the_title().'</a></h4>
										'.$desc.'
									</li>';
									$pageListLeftCount++;
								} else {
									$pageListRight .= '
									<li>
										<h4><i class="tm-skincolor fa fa-file-text-o"></i>  <a href="'.get_permalink().'">'.get_the_title().'</a></h4>
										'.$desc.'
									</li>';
									$pageListRightCount++;
								}
								 
								
							} else {
								$pageList .= '<li><i class="tm-skincolor fa fa-file-text-o"></i> <a href="'.get_permalink().'">'.get_the_title().'</a></li>';
							}
							
						}
						$pageListCount++;
						
					} else if( get_post_type() == 'post' ){
						// Post
						$showPost = ( get_query_var('post_type')=='post' ) ? 9 : 5 ;
						if( $postListCount<$showPost ){
							
							if( get_query_var('post_type')=='post' ){
								// Box view
								$postList .= digitallaw_blogbox( 'three' );
								$postListClass = 'col-md-12';
							} else {
								// Post list view
								if ( has_post_thumbnail( get_the_ID() ) ) {
									$featuredImage = get_the_post_thumbnail(get_the_ID(), 'thumbnail' );
								} else {
									$featuredImage = '<img src="'.get_template_directory_uri().'/images/noimage-150x150.png" />';
								}
								$postList .= '
								<li>
									<a href="'.get_permalink().'">'.$featuredImage.'</a>
									<a href="'.get_permalink().'">'.get_the_title().'</a>
									<span class="post-date">'.get_the_date('M j, Y').'</span>
								</li>';
							}
						}
						$postListCount++;
						
					} else if( get_post_type() == 'tm_portfolio' ){
						// Portfolio
						$showPortfolio = ( get_query_var('post_type')=='tm_portfolio' ) ? 9 : 3 ;
						if( $portfolioListCount<$showPortfolio ){
							ob_start();
							get_template_part( 'content', 'portfolio' );
							$portfolioList .= ob_get_contents();
							ob_end_clean();
						}
						$portfolioListCount++;
						
					} else if( get_post_type() == 'tm_team_member' ){
						// Team Members
						$showTeam = ( get_query_var('post_type')=='tm_team_member' ) ? 9 : 3 ;
						if( $teamListCount<$showTeam ){
							$teamList .= digitallaw_teammemberbox('three');
						}
						$teamListCount++;
						
					} else if( get_post_type() == 'product' ){
						// WooCommerce Products
						$showProduct = ( get_query_var('post_type')=='product' ) ? 9 : 3 ;
						if( $wproductsListCount<$showProduct ){
							ob_start();
							wc_get_template_part( 'content', 'product' );
							$wproductsList .= ob_get_contents();
							ob_end_clean();
						}
						$wproductsListCount++;
						
					} else if( get_post_type() == 'tribe_events' ){
						// Events
						$showEvents = ( get_query_var('post_type')=='tribe_events' ) ? 9 : 3 ;
						if( $eventsListCount<$showEvents ){
							$eventsList .= digitallaw_eventsbox( 'three', 'default' );
						}
						$eventsListCount++;
						
					} else {
						// Other Custom Post Types
						$otherCPT[get_post_type()][] = '<a href="'.get_permalink().'">'.get_the_title().'</a>';
						
					}
					
					
				endwhile;
			
				
				
				// Wrapping all CPT contents
				$pageList = ($pageList!='') ? '<ul class="tm-search-list tm-search-pagelist tm-list tm-list-style-icon">'.$pageList.'</ul>' : '' ;
				
				$pageListLeft = ($pageListLeft!='') ? '<ul class="tm-search-list tm-search-pagelist tm-list tm-list-style-icon">'.$pageListLeft.'</ul>' : '' ;
				
				$pageListRight = ($pageListRight!='') ? '<ul class="tm-search-list tm-search-pagelist tm-list tm-list-style-icon">'.$pageListRight.'</ul>' : '' ;
				
				if( get_query_var('post_type')=='post' ){
					$postList = ($postList!='') ? '<div class="tm-search-list tm-search-postlist">'.$postList.'</div>' : '' ;
				} else {
					$postList = ($postList!='') ? '<ul class="tm-search-list tm-search-postlist thememount_widget_recent_entries">'.$postList.'</ul>' : '' ;
				}
				
				
				$portfolioList = ($portfolioList!='') ? '<div class="row tm-search-list tm-search-portoliolist">'.$portfolioList.'</div>' : '' ;
				$teamList = ($teamList!='') ? '<div class="row tm-search-list tm-search-teamlist">'.$teamList.'</div>' : '' ;
				$eventsList = ($eventsList!='') ? '<div class="row tm-search-list tm-search-eventlist">'.$eventsList.'</div>' : '' ;
				$wproductsList = ($wproductsList!='') ? '<div class="woocommerce"><ul class="row tm-search-list tm-search-wproductslist products">'.$wproductsList.'</ul></div>' : '' ;
				
				
				
				// View More link setup
				$viewmore_page = ($pageListCount>10) ? ' &nbsp; <small><a href="'. esc_url(get_home_url()).'?s='.get_search_query().'&post_type=page" class="label label-default">'.esc_html__('View more','digitallaw').'</a></small>' : '' ;
				
				$viewmore_post = ($postListCount>4) ? ' &nbsp; <small><a href="'. esc_url(get_home_url()).'?s='.get_search_query().'&post_type=post" class="label label-default">'.esc_html__('View more','digitallaw').'</a></small>' : '' ;
				
				$viewmore_portfolio = ($portfolioListCount>3 && get_query_var('post_type')!='tm_portfolio') ? ' &nbsp; <small><a href="'.esc_url(get_home_url()).'?s='.get_search_query().'&post_type=tm_portfolio" class="label label-default">'.esc_html__('View more','digitallaw').'</a></small>' : '' ;
				
				$viewmore_team = ($teamListCount>3) ? ' &nbsp; <small><a href="'.esc_url(get_home_url()).'?s='.get_search_query().'&post_type=tm_team_member" class="label label-default">'.esc_html__('View more','digitallaw').'</a></small>' : '' ;
				
				$viewmore_wproducts = ($wproductsListCount>3) ? ' &nbsp; <small><a href="'. esc_url(get_home_url()).'?s='.get_search_query().'&post_type=product" class="label label-default">'.esc_html__('View more','digitallaw').'</a></small>' : '' ;
				
				$viewmore_events = ($eventsListCount>3) ? ' &nbsp; <small><a href="'. esc_url(get_home_url()).'?s='.get_search_query().'&post_type=tribe_events" class="label label-default">'.esc_html__('View more','digitallaw').'</a></small>' : '' ;
				
				
				
				// Back to results page link
				$viewmore_page = ( get_query_var('post_type')=='page') ? ' &nbsp; <small><a href="'.esc_url(get_home_url()).'?s='.get_search_query().'" class="label label-default"><i class="fa fa-chevron-left"></i> &nbsp; '.esc_html__('Back to results','digitallaw').'</a></small>' : $viewmore_page;
				
				$viewmore_portfolio = ( get_query_var('post_type')=='tm_portfolio') ? ' &nbsp; <small><a href="'.esc_url(get_home_url()).'?s='.get_search_query().'" class="label label-default"><i class="fa fa-chevron-left"></i> &nbsp; '.esc_html__('Back to results','digitallaw').'</a></small>' : $viewmore_portfolio;
				
				$viewmore_team = ( get_query_var('post_type')=='tm_team_member') ? ' &nbsp; <small><a href="'.esc_url(get_home_url()).'?s='.get_search_query().'" class="label label-default"><i class="fa fa-chevron-left"></i> &nbsp; '.esc_html__('Back to results','digitallaw').'</a></small>' : $viewmore_team;
				
				$viewmore_post = ( get_query_var('post_type')=='post') ? ' &nbsp; <small><a href="'.esc_url(get_home_url()).'?s='.get_search_query().'" class="label label-default"><i class="fa fa-chevron-left"></i> &nbsp; '.esc_html__('Back to results','digitallaw').'</a></small>' : $viewmore_post;
				
				?>
				
				<!-- Search form -->
				<div class="tm-sresult-form-wrapper">
					<div class="tm-sresult-form-top">
						<h2>
							<i class="fa fa-search"></i>
							<?php esc_html_e('You searched for', 'digitallaw'); ?>
						</h2>
						<?php get_search_form(); ?>
						<div class="tm-sresults-settings-wrapper">
							<a class="tm-sresults-settings-btn" href="#">
								<i class="fa fa-gear"></i>  
								<span><?php esc_html_e('Settings', 'digitallaw'); ?></span>
							</a>
						</div>
						<div class="clr clear"></div>
					</div>
					<div class="tm-sresult-form-bottom-w">
						<div class="tm-sresult-form-bottom row" style="display:none;">
						
							<?php
								// CPT list for selection
								$cptList = array(
									'any'            => esc_html__('All selections', 'digitallaw'),
									'page'           => esc_html__('Pages', 'digitallaw'),
									'post'           => esc_html__('Blog posts', 'digitallaw'),
									'product'        => esc_html__('Products', 'digitallaw'),
									'tribe_events'   => esc_html__('Events', 'digitallaw'),
									'tm_portfolio'   => $cpt_title_portfolio,
									'tm_team_member' => $cpt_title_team,
								);
								
								
								
								?>
						<div class="tm-search-main-box clearfix">
                            <div class="tm-search-text"><strong><?php esc_html_e('Search in:','digitallaw'); ?></strong></div>
							<div class="tm-search-select-box">
								
								<select class="tm-sresult-cpt-select">
									<?php foreach( $cptList as $cptkey=>$cptval ){
										$selected = ( isset($_GET['post_type']) && $_GET['post_type']==$cptkey ) ? ' selected="selected" ' : '' ;
										echo '<option value="'.$cptkey.'" class="'.$cptkey.'" '.$selected.'>'.$cptval.'</option>';
									} ?>
							  </select>
                              <div class="tm-sresult-form-sbtbtn-wrapper">
								<input class="tm-sresult-form-sbtbtn" type="submit" value="<?php esc_html_e('Search now','digitallaw'); ?>" />
							  </div>
						  </div>
							
                          </div>
						</div><!-- .tm-sresult-form-bottom -->
					</div><!-- .tm-sresult-form-bottom-w -->
				</div>
				
		
				
				
				<!-- Page and posts -->
				<div class="row tm-search-results-wrapper tm-search-results-w-pagepost">
					<?php if( trim($pageList)!='' ): ?>
					<div class="<?php echo sanitize_html_class($pageListClass); ?>">
						<h2 class="tm-search-results-title"><?php printf('Search results for %s', '<strong>'.esc_html__('Page','digitallaw').'</strong>' ); ?>
							
							<?php
							echo wp_kses( /* HTML Filter */
								$viewmore_page,
								array(
									'small' => array(
										'class' => array(),
									),
									'a' => array(
										'href'  => array(),
										'class' => array(),
										'title' => array(),
										'rel'   => array(),
									),
									'i' => array(
										'class' => array(),
									),
									
									'span' => array(
										'class' => array(),
									),
									'img' => array(
										'class'  => array(),
										'src'    => array(),
										'alt'    => array(),
										'title'  => array(),
										'width'  => array(),
										'height' => array(),
									),
								)
							);
							?>
							
						</h2>
						<?php
						echo wp_kses( /* HTML Filter */
								$pageList,
								array(
									'ul' => array(
										'class' => array(),
									),
									'li' => array(
										'class' => array(),
									),
									'a' => array(
										'href'  => array(),
										'class' => array(),
										'title' => array(),
										'rel'   => array(),
									),
									'i' => array(
										'class' => array(),
									),
								)
							);
						
						
						?>
						
						
						
					</div>
					<?php endif; ?>
					
					<?php if( trim($pageListLeft)!='' ): ?>
					<div class="col-md-12">
						<h2 class="tm-search-results-title"><?php printf('Search results for %s', '<strong>'.esc_html__('Page','digitallaw').'</strong>' ); ?>
							<?php
							echo wp_kses( /* HTML Filter */
								$viewmore_page,
								array(
									'small' => array(
										'class' => array(),
									),
									'a' => array(
										'href'  => array(),
										'class' => array(),
										'title' => array(),
										'rel'   => array(),
									),
									'i' => array(
										'class' => array(),
									),
									
									'span' => array(
										'class' => array(),
									),
									'img' => array(
										'class'  => array(),
										'src'    => array(),
										'alt'    => array(),
										'title'  => array(),
										'width'  => array(),
										'height' => array(),
									),
								)
							);
							?>
						</h2>
					</div>
					<div class="col-md-6">
						<?php
						echo wp_kses( /* HTML Filter */
								$pageListLeft,
								array(
									'ul' => array(
										'class' => array(),
									),
									'li' => array(
										'class' => array(),
									),
									'a' => array(
										'href'  => array(),
										'class' => array(),
										'title' => array(),
										'rel'   => array(),
									),
									'i' => array(
										'class' => array(),
									),
								)
							);
						
						
						?>
						
					</div>
					
					<div class="col-md-6">
						<?php
						echo wp_kses( /* HTML Filter */
								$pageListRight,
								array(
									'ul' => array(
										'class' => array(),
									),
									'li' => array(
										'class' => array(),
									),
									'a' => array(
										'href'  => array(),
										'class' => array(),
										'title' => array(),
										'rel'   => array(),
									),
									'i' => array(
										'class' => array(),
									),
								)
							);
						
						
						?>
						
					</div>
					<?php endif; ?>
					
					<?php if( trim($postList)!='' ): ?>
					<div class="<?php echo digitallaw_sanitize_html_classes($postListClass); ?>">
						<h2 class="tm-search-results-title"><?php printf('Search results for %s', '<strong>'.esc_html__('Post','digitallaw').'</strong>' ); ?>
							<?php
							echo wp_kses( /* HTML Filter */
								$viewmore_post,
								array(
									'small' => array(
										'class' => array(),
									),
									'a' => array(
										'href'  => array(),
										'class' => array(),
										'title' => array(),
										'rel'   => array(),
									),
									'i' => array(
										'class' => array(),
									),
									
									'span' => array(
										'class' => array(),
									),
									'img' => array(
										'class'  => array(),
										'src'    => array(),
										'alt'    => array(),
										'title'  => array(),
										'width'  => array(),
										'height' => array(),
									),
								)
							);
							?>
							
						</h2>

						<?php
						echo wp_kses( /* HTML Filter */
								$postList,
								array(
									'h2' => array(
										'class' => array(),
									),
									'h4' => array(
										'class' => array(),
									),
									'div' => array(
										'class' => array(),
									),
									'article' => array(
										'class' => array(),
									),
									'span' => array(
										'class' => array(),
									),
									'iframe' => array(
										'class'  => array(),
										'src'    => array(),
										'width'  => array(),
										'height' => array(),
										'frameborder' => array(),
										'allowfullscreen' => array(),
									),
									'ul' => array(
										'class' => array(),
									),
									'li' => array(
										'class' => array(),
									),
									'a' => array(
										'href'  => array(),
										'class' => array(),
										'title' => array(),
										'rel'   => array(),
									),
									'i' => array(
										'class' => array(),
									),
									'img' => array(
										'class'  => array(),
										'src'    => array(),
										'alt'    => array(),
										'title'  => array(),
										'width'  => array(),
										'height' => array(),
									),
								)
							);
						?>
					</div>
					
					<?php endif; ?>
					
				</div>
				
				
				<br><br>
				
				<?php if( trim($portfolioList)!='' ): ?>
				<!-- Portfolio -->
				<div class="row tm-search-results-wrapper tm-search-results-w-portfolio">
					<div class="col-md-12">
						<h2 class="tm-search-results-title"><?php printf('Search results for %s', '<strong>'.$cpt_title_portfolio.'</strong>' ); ?>
							<?php
							echo wp_kses( /* HTML Filter */
								$viewmore_portfolio,
								array(
									'small' => array(
										'class' => array(),
									),
									'a' => array(
										'href'  => array(),
										'class' => array(),
										'title' => array(),
										'rel'   => array(),
									),
									'i' => array(
										'class' => array(),
									),
									
									'span' => array(
										'class' => array(),
									),
									'img' => array(
										'class'  => array(),
										'src'    => array(),
										'alt'    => array(),
										'title'  => array(),
										'width'  => array(),
										'height' => array(),
									),
								)
							);
							?>
						</h2>
						<?php
							echo wp_kses( /* HTML Filter */
								$portfolioList,
								array(
									'div' => array(
										'class' => array(),
									),
									'span' => array(
										'class' => array(),
									),
									'small' => array(
										'class' => array(),
									),
									'a' => array(
										'href'  => array(),
										'class' => array(),
										'title' => array(),
										'rel'   => array(),
									),
									'i' => array(
										'class' => array(),
									),
									
									'span' => array(
										'class' => array(),
									),
									'h4' => array(
										'class' => array(),
									),
									'img' => array(
										'class'  => array(),
										'src'    => array(),
										'alt'    => array(),
										'title'  => array(),
										'width'  => array(),
										'height' => array(),
									),
								)
							);
							?>
					</div>
				</div>
				<br><br>
				<?php endif; ?>
				
				
				<?php if( trim($teamList)!='' ): ?>
				<!-- Team -->
				<div class="row tm-search-results-wrapper tm-search-results-w-team">
					<div class="col-md-12">
						<h2 class="tm-search-results-title"><?php printf('Search results for %s', '<strong>'.$cpt_title_team.'</strong>' ); ?>
							<?php
							echo wp_kses( /* HTML Filter */
								$viewmore_team,
								array(
									'small' => array(
										'class' => array(),
									),
									'a' => array(
										'href'  => array(),
										'class' => array(),
										'title' => array(),
										'rel'   => array(),
									),
									'i' => array(
										'class' => array(),
									),
									
									'span' => array(
										'class' => array(),
									),
									'img' => array(
										'class'  => array(),
										'src'    => array(),
										'alt'    => array(),
										'title'  => array(),
										'width'  => array(),
										'height' => array(),
									),
								)
							);
							?>
						</h2>
						<?php
						echo wp_kses( /* HTML Filter */
							$teamList,
							array(
								'ul' => array(
									'class' => array(),
								),
								'li' => array(
									'class' => array(),
								),
								'div' => array(
									'class' => array(),
								),
								'span' => array(
									'class' => array(),
								),
								'small' => array(
									'class' => array(),
								),
								'a' => array(
									'href'  => array(),
									'class' => array(),
									'title' => array(),
									'rel'   => array(),
									'data-hint' => array(),
									'target' => array(),
									
								),
								'i' => array(
									'class' => array(),
								),
								'h3' => array(
									'class' => array(),
								),
								'h4' => array(
									'class' => array(),
								),
								'span' => array(
									'class' => array(),
								),
								'img' => array(
									'class'  => array(),
									'src'    => array(),
									'alt'    => array(),
									'title'  => array(),
									'width'  => array(),
									'height' => array(),
								),
							)
						);
						?>
					</div>
				</div>
				<br><br>
				<?php endif; ?>
				
				
				<?php if( trim($wproductsList)!='' ): ?>
				<!-- WooCommerce Products -->
				<div class="row tm-search-results-wrapper tm-search-results-w-products">
					<div class="col-md-12">
						<h2 class="tm-search-results-title"><?php printf('Search results for %s', '<strong>'.esc_html__('Products','digitallaw').'</strong>' ); ?>
							<?php
							echo wp_kses( /* HTML Filter */
								$viewmore_wproducts,
								array(
									'small' => array(
										'class' => array(),
									),
									'a' => array(
										'href'  => array(),
										'class' => array(),
										'title' => array(),
										'rel'   => array(),
									),
									'i' => array(
										'class' => array(),
									),
									
									'span' => array(
										'class' => array(),
									),
									'img' => array(
										'class'  => array(),
										'src'    => array(),
										'alt'    => array(),
										'title'  => array(),
										'width'  => array(),
										'height' => array(),
									),
								)
							);
							?>
						</h2>
						<?php
						echo wp_kses( /* HTML Filter */
							$wproductsList,
							array(
								'h3' => array(
									'class' => array(),
								),
								'ul' => array(
									'class' => array(),
								),
								'li' => array(
									'class' => array(),
								),
								'div' => array(
									'class' => array(),
								),
								'span' => array(
									'class' => array(),
								),
								'small' => array(
									'class' => array(),
								),
								'a' => array(
									'href'  => array(),
									'class' => array(),
									'title' => array(),
									'rel'   => array(),
								),
								'i' => array(
									'class' => array(),
								),
								'del' => array(
									'class' => array(),
								),
								'ins' => array(
									'class' => array(),
								),
								'img' => array(
									'class'  => array(),
									'src'    => array(),
									'alt'    => array(),
									'title'  => array(),
									'width'  => array(),
									'height' => array(),
								),
							)
						);
						?>
					</div>
				</div>
				<br><br>
				<?php endif; ?>
				
				
				<?php if( trim($eventsList)!='' ): ?>
				<!-- TribeEvents -->
				<div class="row tm-search-results-wrapper tm-search-results-w-events">
					<div class="col-md-12">
						<h2 class="tm-search-results-title"><?php printf('Search results for %s', '<strong>'.esc_html__('Events','digitallaw').'</strong>' ); ?>
							<?php
							echo wp_kses( /* HTML Filter */
								$viewmore_events,
								array(
									'h2' => array(
										'class' => array(),
									),
									'small' => array(
										'class' => array(),
									),
									'a' => array(
										'href'  => array(),
										'class' => array(),
										'title' => array(),
										'rel'   => array(),
									),
									'i' => array(
										'class' => array(),
									),
									
									'span' => array(
										'class' => array(),
									),
									'img' => array(
										'class'  => array(),
										'src'    => array(),
										'alt'    => array(),
										'title'  => array(),
										'width'  => array(),
										'height' => array(),
									),
								)
							);
							?>
						</h2>
						<?php
						echo wp_kses( /* HTML Filter */
							$eventsList,
							array(
								'h4' => array(
									'class' => array(),
								),
								'article' => array(
									'class' => array(),
								),
								'div' => array(
									'class' => array(),
								),
								'span' => array(
									'class' => array(),
								),
								'small' => array(
									'class' => array(),
								),
								'a' => array(
									'href'  => array(),
									'class' => array(),
									'title' => array(),
									'rel'   => array(),
									'data-id' => array(),
								),
								'i' => array(
									'class' => array(),
								),
								
								'span' => array(
									'class' => array(),
								),
								'img' => array(
									'class'  => array(),
									'src'    => array(),
									'alt'    => array(),
									'title'  => array(),
									'width'  => array(),
									'height' => array(),
								),
							)
						);
						?>
					</div>
				</div>
				<br><br>
				<?php endif; ?>
				
				
				
				<?php
				// Other CPT
				foreach( $otherCPT as $cpt=>$content ){
					$cptdata = get_post_type_object( $cpt );
					$cptname = $cptdata->labels->name;
					$x = 0;
					
					$viewMoreLink = '';
					
					if( count($content)>10 ){
						$viewMoreLink = ' &nbsp; <small><a href="'.esc_url(get_home_url()).'?s='.get_search_query().'&post_type='.$cpt.'" class="label label-default">'. esc_attr__('View more','digitallaw').'</a></small>';
					}
					
					?>
					<div class="row tm-search-results-wrapper tm-search-results-w-<?php echo digitallaw_sanitize_html_classes($cpt); ?>">
						<div class="col-md-12">
							<h2 class="tm-search-results-title"><?php printf('Search results for %s', '<strong>'.esc_attr($cptname).'</strong>' ); ?>
								<?php
								echo wp_kses( /* HTML Filter */
									$viewMoreLink,
									array(
										'small' => array(
											'class' => array(),
										),
										'a' => array(
											'href'  => array(),
											'class' => array(),
											'title' => array(),
											'rel'   => array(),
										),
										'i' => array(
											'class' => array(),
										),
										
										'span' => array(
											'class' => array(),
										),
										'img' => array(
											'class'  => array(),
											'src'    => array(),
											'alt'    => array(),
											'title'  => array(),
											'width'  => array(),
											'height' => array(),
										),
									)
								);
								?>
							</h2>
							<?php
							if( count($content)>0 ){
								$content_html_output  = '';
								$content_html_output .= '<ul class="tm-search-list tm-search-'.$cpt.'list">';
								foreach( $content as $row ){
									if( $x<$tm_max_result_per_cpt ){
										$content_html_output .= '<li>'.$row.'</li>';
									}
									$x++;
								}
								$content_html_output .= '</ul>';
								
								echo wp_kses( /* HTML Filter */
									$content_html_output,
									array(
										'ul' => array(
											'class' => array(),
										),
										'li' => array(
											'class' => array(),
										),
										'article' => array(
											'class' => array(),
										),
										'div' => array(
											'class' => array(),
										),
										'span' => array(
											'class' => array(),
										),
										'small' => array(
											'class' => array(),
										),
										'a' => array(
											'href'  => array(),
											'class' => array(),
											'title' => array(),
											'rel'   => array(),
										),
										'i' => array(
											'class' => array(),
										),
										
										'span' => array(
											'class' => array(),
										),
										'img' => array(
											'class'  => array(),
											'src'    => array(),
											'alt'    => array(),
											'title'  => array(),
											'width'  => array(),
											'height' => array(),
										),
									)
								);
								
							}
							?>
						</div>
					</div>
					<br><br>
					
					<?php
				}
				?>
				
				
				
				<?php digitallaw_paging_nav(); ?>
				
				
					<br><br>
					
					
			<?php else: ?>
			
				<div class="tm-no-sresult-wrapper">
					<?php
					// We are not sanitizing this as we are expecting any (HTML, CSS, JS) code here
					echo wp_kses( /* HTML Filter */
						$digitallaw_theme_options['searchnoresult'],
						array(
							'div' => array(
								'class' => array(),
								'id'    => array(),
							),
							'h1' => array(
								'class' => array(),
								'id'    => array(),
							),
							'h2' => array(
								'class' => array(),
								'id'    => array(),
							),
							'h3' => array(
								'class' => array(),
								'id'    => array(),
							),
							'h4' => array(
								'class' => array(),
								'id'    => array(),
							),
							'h5' => array(
								'class' => array(),
								'id'    => array(),
							),
							'h6' => array(
								'class' => array(),
								'id'    => array(),
							),
							'a' => array(
								'href'  => array(),
								'title' => array(),
								'class' => array()
							),
							'br'     => array(),
							'em'     => array(),
							'strong' => array(),
							'span'   => array(
								'class'  => array(),
							),
							'ol'     => array(),
							'ul'     => array(
								'class'  => array(),
							),
							'li'     => array(
								'class'  => array(),
							),
							'i'     => array(
								'class'  => array(),
							),
						)
					);
					
					?>
					<div class="tm-search-result-form"><?php get_search_form(); ?></div>
					<br><br>
				</div>
				
			<?php endif; ?>
			
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
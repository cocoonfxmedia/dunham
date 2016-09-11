<?php
/**
 * The template for displaying Team Member
 *
 * @package WordPress
 * @subpackage DigitalLaw
 * @since DigitalLaw 1.0
 */

get_header();

global $digitallaw_theme_options;

/* Post Meta */
global $post;
$position = esc_attr( trim(get_post_meta( get_the_id(), '_thememount_team_member_details_position', true )) );
$excerpt  = trim($post->post_excerpt);
$title    = get_the_title();

if( trim($position)!='' ){ $position = '<h4 class="thememount-team-position">'.esc_html($position).'</h4>'; }



// Team Group
$categories_list = '';
if( taxonomy_exists('tm_team_group') ){
	$categories_list = get_the_term_list( get_the_ID(), 'tm_team_group', '', esc_html__( ' &nbsp; &#47; &nbsp; ', 'digitallaw' ) );
	if( $categories_list!='' ){
		$categories_list = '<div class="thememount-team-cat-links">'.$categories_list.'</div>';
	}
}



// Social links
$socialcode = digitallaw_team_social();


// Phone email
$phone_email = '';
$phone       = esc_attr(get_post_meta( get_the_id(), '_thememount_team_member_details_phone', true ));
$email       = esc_attr(get_post_meta( get_the_id(), '_thememount_team_member_details_email', true ));
if( !empty($phone) ){
	$phone_email .= '<div class="thememount-team-phone"><span class="tm-skincolor">'. esc_html__('Phone','digitallaw') .':</span>  <a href="tel:'.$phone.'">'. $phone .'</a></div>';
}
if( !empty($email) ){
	$phone_email .= '<div class="thememount-team-email"><span class="tm-skincolor">'. esc_html__('E-mail','digitallaw') .':</span>  <a href="mailto:'. $email .'">'. $email .'</a></div>';
}
if( !empty($phone_email) ){
	$phone_email = '<div class="thememount-team-phoneemail">'. $phone_email .'</div>';
}


?>
<div class="container">
	<div class="tm-container-inner">
		<div id="primary" class="content-area">
			<article class="post single post-type-team_member">
				<div id="content" class="site-content row" role="main">
					<?php /* The loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
					
					<div class="single-team-left col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<?php if ( has_post_thumbnail() ) { ?>
							<div class="thememount-team-img">
								<?php if( has_post_thumbnail() ){  the_post_thumbnail( 'full' ); } ?>
								
				                <div class="thememount-team-data">
                                    <div class="thememount-team-title-block">
										<h2><?php
											if( !empty($digitallaw_theme_options['team_before_title_text']) ){
												$team_before_title_text = trim($digitallaw_theme_options['team_before_title_text']);
												printf(
													esc_attr__( '%s', 'digitallaw' ),
													$team_before_title_text
												);
												echo ' ';
											}
											echo esc_attr($title);
											?></h2>
										<?php
										echo wp_kses( /* HTML Filter */
											$position,
											array(
												'div'    => array(
													'class' => array(),
												),
												'h4'    => array(
													'class' => array(),
												),
											)
										);
										
										?>
									</div>
                                      
                                    <?php /* Team Group */
									echo wp_kses( /* HTML Filter */
										$categories_list,
										array(
											'div'    => array(
												'class' => array(),
											),
											'span'    => array(
												'class' => array(),
											),
											'ul'    => array(
												'class' => array(),
											),
											'a'    => array(
												'class' => array(),
												'href'  => array(),
												'ref'   => array(),
												'data-hint' => array(),
											),
											'li'    => array(
												'class' => array(),
											),
										)
									);
									?>
									
									
									<?php /* Social Links */
									echo wp_kses( /* HTML Filter */
										$socialcode,
										array(
											'div'    => array(
												'class' => array(),
											),
											'i'    => array(
												'class' => array(),
											),
											'ul'    => array(
												'class' => array(),
											),
											'li'    => array(
												'class' => array(),
											),
											'a'    => array(
												'class' => array(),
												'href' => array(),
												'data-hint' => array(),
											),
										)
									);
									?>
									
									
									
									<?php /* Phone & Email */
									echo wp_kses( /* HTML Filter */
										$phone_email,
										array(
											'div'    => array(
												'class' => array(),
											),
											'span'    => array(
												'class' => array(),
											),
											'i'    => array(
												'class' => array(),
											),
											'ul'    => array(
												'class' => array(),
											),
											'li'    => array(
												'class' => array(),
											),
											'a'    => array(
												'class' => array(),
												'href' => array(),
											),
										)
									);
									?>
									
									
									
									<?php /* Appointment Button */ echo digitallaw_team_appointment_btn(); ?>
									
			                  </div>
								
								
								
							</div>
                            
							
							
							
						<?php } ?>
					</div>
					
					<div class="single-team-right col-xs-12 col-sm-8 col-md-8 col-lg-8"> 
						<?php the_content(); ?>
					</div>
					
				<?php endwhile; ?>

				</div><!-- #content -->
			</article>
		</div><!-- #primary -->
	</div><!-- .row -->
</div><!-- .containenr -->
<?php get_footer(); ?>

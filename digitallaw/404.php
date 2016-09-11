<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage DigitalLaw
 * @since DigitalLaw 1.0
 */

get_header();

global $digitallaw_theme_options;


?>
<div class="container">
	<div class="row">
	
		<div id="primary" class="content-area col-md-12 col-lg-12 col-sm-12 col-xs-12">
			<div id="content" class="site-content" role="main">

				<div class="page-wrapper">
					<div class="page-content">
						<div class="thememount-big-icon"><i class="<?php echo esc_attr($digitallaw_theme_options['error404_big_icon']); ?>"></i></div>
						<h1><?php echo esc_attr($digitallaw_theme_options['error404_big_text']); ?></h1>
						<p><?php echo esc_attr($digitallaw_theme_options['error404_medium_text']); ?></p>
						<br><br><br>
						
						<?php
						/*
						* Search is now optional. You can show/hide search button from "Theme Options > Error 404 Page Settings" directly.
						*/
						$error404_search = ( !isset($digitallaw_theme_options['error404_search']) ) ? '1' : esc_attr($digitallaw_theme_options['error404_search']) ;
						if( $error404_search=='1' ){
							get_search_form();
						}

						?>
					</div><!-- .page-content -->
				</div><!-- .page-wrapper -->

			</div><!-- #content -->
		</div><!-- #primary -->
	
	</div><!-- .row -->
</div><!-- .container -->
<?php get_footer(); ?>
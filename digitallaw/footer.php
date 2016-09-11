
			</div><!-- #main-inner -->
		</div><!-- #main -->




		<footer id="colophon" class="site-footer">
			  
			<div class="footer footer-text-color-<?php echo sanitize_html_class( thememount_footerwidget_color() ); ?>">
				<div class="footer-inner <?php echo sanitize_html_class( thememount_footer_no_widget_class('all') ); ?>">
				
					<?php if( esc_attr(thememount_footer_no_widget_class('first-row')) != 'tm-footer-1st-row-no-widgets' ) :?>
					<div class="tm-footer-first-row <?php echo sanitize_html_class( thememount_footer_container_class() ); ?>">
						<div class="row multi-columns-row">
							<?php get_sidebar( 'footertop' ); ?>
						</div>
					</div>
					<?php endif; ?>
					
					<?php if( esc_attr(thememount_footer_no_widget_class('second-row')) != 'tm-footer-2nd-row-no-widgets' ) :?>
					<div class="tm-footer-second-row <?php echo sanitize_html_class( thememount_footer_container_class() ); ?>">
						<div class="tm-footer-second-row-inner">
							<div class="row multi-columns-row">
								<?php get_sidebar( 'footer' ); ?>
							</div>
						</div>
					</div>
					<?php endif; ?>
					
			  
					<div class="site-info ">
						<div class="container">
							<div class="site-info-inner">
								<div class="row">
									<div class="col-xs-12 col-sm-12 tm-footer2-center">
									<?php
									echo do_shortcode(
										wp_kses( /* HTML Filter */
											thememount_footer_copyright_left(),
											array(
												'a' => array(
													'href'  => array(),
													'title' => array()
												),
												'br' => array(),
												'em' => array(),
												'strong' => array(),
											)
										)
									);
									?>
									</div><!--.tm-footer2-center -->

								</div><!--.row --> 
							</div><!-- .site-info-inner -->
						</div><!-- .container --> 
					</div><!-- .site-info --> 
				</div><!-- .footer-inner --> 
			</div><!-- .footer -->
			  
		</footer><!-- #colophon -->

	</div><!-- #page -->

</div><!-- .main-holder.animsition --> 

<a id="totop" href="#top" style="display: none;"><i class="fa fa-angle-up"></i></a>
<?php wp_footer(); ?>
</body></html>
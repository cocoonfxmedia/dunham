<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package WordPress
 * @subpackage DigitalLaw
 * @since DigitalLaw 1.0
 */
?>


<div class="page-content">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	<p><?php
		esc_attr_e( 'Ready to publish your first post?', 'digitallaw' );
		echo '<a href="'. admin_url( 'post-new.php' ) .'">';
		echo esc_attr__( 'Get started here.', 'digitallaw' );
		echo '</a>';
	?></p>

	<?php elseif ( is_search() ) : ?>

	<p><?php global $digitallaw_theme_options; echo do_shortcode( esc_attr($digitallaw_theme_options['searchnoresult']) ); ?></p>
	
	<?php if( get_query_var('post_type')!='team_member' ): ?>
		<?php get_search_form(); ?>
	<?php endif; ?>
	
	<?php else : ?>

	<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'digitallaw' ); ?></p>
	<div class="digitallaw-no-content-search-form">
		<?php get_search_form(); ?>
	</div>

	<?php endif; ?>
</div><!-- .page-content -->

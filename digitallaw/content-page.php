<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage DigitalLaw
 * @since DigitalLaw 1.0
 */

global $digitallaw_theme_options;
$blog_readmore_text = 'Read More';
if( !empty($digitallaw_theme_options['blog_readmore_text']) ){
	$blog_readmore_text = trim(esc_attr($digitallaw_theme_options['blog_readmore_text']));
}

// Getting Page Format
$pageFormat = get_post_format();

?>

<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="thememount-page-wrapper">
		<div class="pagecontent">

			<header class="entry-header">
				<?php if( trim(get_the_title())!='' ): ?>
					<h2 class="entry-title">
					<?php if( is_single() ): ?>
						<?php echo esc_attr(trim(get_the_title())); ?>
					<?php else: ?>
						<a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo esc_attr(trim(get_the_title())); ?></a>
					<?php endif; ?>
					</h2><!-- .entry-title -->
				<?php endif; ?>
			</header><!-- .entry-header -->
      
	  
			<?php if ( has_excerpt() ) : // Only display Excerpts for Search ?>
			
				<div class="entry-summary">
					<?php the_excerpt(); ?>
					
					<?php
					$excerpt = get_the_excerpt();
					$excerpt = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $excerpt);
					?>
					
				</div><!-- .entry-summary -->
			
			<?php else : ?>
			
				<div class="entry-content">
					<?php
					//  Getting content and processing to show short content
					$text = get_the_content('');
					$text = do_shortcode($text);
					$text = strip_shortcodes( $text );
					$text = apply_filters( 'the_content', $text );
					$text = str_replace(']]>', ']]&gt;', $text);
					$excerpt_length = apply_filters( 'excerpt_length', 55 );
					$excerpt_more = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );
					$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
					echo esc_attr($text);
					?>
				</div><!-- .entry-content -->
	  
			<?php endif; ?>
		</div><!-- .pagecontent -->
	</div><!-- .thememount-page-wrapper -->
	<div class="clearfix"></div>
</article><!-- #page-<?php the_ID(); ?> --> 

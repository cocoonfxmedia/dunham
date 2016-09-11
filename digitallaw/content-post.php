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
	$blog_readmore_text = trim( esc_attr($digitallaw_theme_options['blog_readmore_text']) );
}

// Getting Post Format
$postFormat = get_post_format();

// class for no title for this post
$custom_post_classes = array();
if( ''==trim(get_the_title()) ){
	$custom_post_classes[] = 'tm-empty-title';
}

// class for mp3 as audio
if( $postFormat == 'audio' ){
	$audiocode = trim( get_post_meta( get_the_ID(), '_format_audio_embed', true) );
	if( $audiocode!='' && substr($audiocode, -4) == ".mp3" ){
		$custom_post_classes[] = 'thememount-blogbox-format-audio-mp3';
	}
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($custom_post_classes); ?>>
	<div class="thememount-post-wrapper">
        <div class="thememount-post-left">
            <?php digitallaw_post_meta_left(); ?>
        </div><!-- .thememount-post-left -->
    
		<?php
		// Featured content like image, slider, video, audio etc
		digitallaw_post_thumbnail(true, 'full');
		?>
		<div class="postcontent">   			
			
				<?php if($postFormat!='quote' && $postFormat!='status'): ?>
					<?php if( trim(get_the_title())!='' ): ?>
						<header class="entry-header"><h2 class="entry-title">
						<?php if( is_single() ): ?>
							<?php echo esc_attr(trim(get_the_title())); ?>
						<?php else: ?>
							<a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo esc_attr(trim(get_the_title())); ?></a>
						<?php endif; ?>
						</h2><!-- .entry-title -->
						<?php digitallaw_blogbox_entry_meta(true, $tags='yes'); ?>
						</header><!-- .entry-header -->
					<?php endif; ?>
				<?php endif; ?>
			
      
	  
			<?php if ( is_search() ) : // Only display Excerpts for Search ?>
			
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->
			
			<?php else : ?>
			
				<div class="entry-content">
				<?php /* Quote */ if( $postFormat=='quote' ): ?><blockquote><?php endif; ?>
		
				<?php if( $postFormat=='link' ): ?>
					<?php $link = trim( get_post_meta( get_the_ID(), '_format_link_url', true ) );
					if( $link!='' ){
						echo '<h4 class="tm-pformat-link-url"><a href="' . $link . '" target="_blank"> <i class="fa fa-link"></i> ' . $link . '</a></h4>';
					}
					?>
				<?php endif; ?>
				
				<?php
				$blog_readmore_link = esc_attr( $blog_readmore_text ).'  <i class="fa fa-angle-double-right"></i>';
				if( $postFormat=='quote' ){
					$blog_readmore_link = '';
				}
				?>
				
				<?php the_content( $blog_readmore_link ); ?>
				<?php
					if( $postFormat=='quote' ){
						$thememount_quote_source_name = trim( get_post_meta( get_the_ID(), '_format_quote_source_name', true ) );
						$thememount_quote_source_url  = trim( get_post_meta( get_the_ID(), '_format_quote_source_url', true ) );
						
						if( empty( $thememount_quote_source_url) ){
							$thememount_quote_source_url = get_permalink();
						}
						
						if( $thememount_quote_source_name!='' ){
							echo '<cite class="tm-quote-footer"><a href="' . $thememount_quote_source_url . '" target="_blank">' . $thememount_quote_source_name . '</a></cite>';
						}
					}
				?>
				<?php /* Quote */ if( $postFormat=='quote' ): ?></blockquote><?php endif; ?>
		
		
				<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_attr__( 'Pages:', 'digitallaw' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
				</div><!-- .entry-content -->
	  
				
			<?php endif; ?>
		</div><!-- .postcontent -->
	</div><!-- .thememount-post-wrapper -->
	<div class="clearfix"></div>
</article><!-- #post-<?php the_ID(); ?> --> 

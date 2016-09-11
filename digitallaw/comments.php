<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage DigitalLaw
 * @since DigitalLaw 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ){
	return;
}

if ( ! comments_open() ){
	return;
}

?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		
		<div class="tm-post-comment-head"><h3>
		<?php
		// Total Comments
		$num_comments = number_format_i18n( get_comments_number() ); // get_comments_number returns only a numeric value
		if ( comments_open() ) {
			if ( $num_comments == 0 ) {
				esc_attr_e('No Comments', 'digitallaw');
			} elseif ( $num_comments > 1 ) {
				printf( esc_attr__('%1$s Comments', 'digitallaw'), $num_comments );
			} else {
				esc_attr_e('1 Comment', 'digitallaw');
			}
		}
		?>
		</h3></div>
	
	
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'digitallaw' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 74,
					'callback' => 'digitallaw_comment_row_template',
				) );
			?>
		</ol><!-- .comment-list -->

		<?php
			// Are there comments to navigate through?
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text section-heading"><?php esc_html_e( 'Comment navigation', 'digitallaw' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_attr__( '&larr; Older Comments', 'digitallaw' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_attr__( 'Newer Comments &rarr;', 'digitallaw' ) ); ?></div>
		</nav><!-- .comment-navigation -->
		<?php endif; // Check for comment navigation ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.' , 'digitallaw' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php
	$commenter     = wp_get_current_commenter();
	$req           = get_option( 'require_name_email' );
	$aria_req      = ( $req ? " aria-required='true'" : '' );
	$required_text = esc_attr__('Required fields are marked *', 'digitallaw');
	
	$threeClass = ' col-lg-4 col-md-4 col-sm-4 col-xs-12 ';
	
	$args = array();
	
	$args['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" placeholder="'.esc_html__('Comment','digitallaw').'" name="comment" cols="45" rows="8" aria-required="true">' .
		'</textarea></p>';
		
	$args['comment_notes_before'] = '<p class="comment-notes">' .
    esc_attr__( 'Your email address will not be published.', 'digitallaw' ) . ' ' . ( $req ? $required_text : '' ) .
    '</p>';
	
	$args['comment_notes_after'] = '';
	
	
	$args['fields']   =  array(
		'author' =>
		'<div class="comment-form-three-fields row"><p class="comment-form-author ' . $threeClass . '">' .
		'<input id="author" placeholder="'.esc_html__('Name *','digitallaw').'" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
		'" size="30"' . $aria_req . ' /></p>',

		'email' =>
		'<p class="comment-form-email ' . $threeClass . '">' .
		'<input id="email" placeholder="'.esc_html__('Email *','digitallaw').'" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
		'" size="30"' . $aria_req . ' /></p>',

		'url' =>
		'<p class="comment-form-url ' . $threeClass . '">' .
		'<input id="url" placeholder="'.esc_html__('Website','digitallaw').'" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
		'" size="30" /></p></div>',
	);
	
					
	
	
	
	comment_form($args); ?>

</div><!-- #comments -->
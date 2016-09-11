<?php
/**
 * DigitalLaw functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage DigitalLaw
 * @since DigitalLaw 1.0
 */

/**
 *  Declaring global variable
 */
$digitallaw_theme_options = get_option('digitallaw_theme_options');
 
 
/*
 * Set up the content width value based on the theme's design.
 *
 * @see digitallaw_content_width() for template-specific adjustments.
 */
if ( ! isset( $content_width ) ){
	$content_width = 727;
}





/*
 *  Remove Redux page from admin section
 */
add_action( 'admin_menu', 'digitallaw_disable_admin_menu',999 );
if( !function_exists('digitallaw_disable_admin_menu') ){
function digitallaw_disable_admin_menu() {
	remove_submenu_page( 'tools.php', 'redux-about' );
}
}


/*
 *  WooCommerce
 */
add_filter( 'woocommerce_sale_flash', 'digitallaw_wc_custom_replace_sale_text' );
if( !function_exists('digitallaw_wc_custom_replace_sale_text') ){
function digitallaw_wc_custom_replace_sale_text( $html ) {
    return str_replace( esc_attr__( 'Sale!', 'digitallaw' ), '<span>' . esc_attr__( 'Sale!', 'digitallaw' ) . '</span>', $html );
}
}







/**
 * Blog Box
 */
if( !function_exists('digitallaw_blogbox') ){
function digitallaw_blogbox( $column='' ){
	global $digitallaw_theme_options;
	$return = '';
	
	$blog_readmore_text = esc_attr__('Read More', 'digitallaw');
	if( !empty($digitallaw_theme_options['blog_readmore_text']) ){
		$var_blog_readmore_text = $digitallaw_theme_options['blog_readmore_text'];
		$blog_readmore_text     = esc_attr($var_blog_readmore_text);
	}
	
	// Getting Post Format
	$format = get_post_format();
	
	if( $format == false || $format == '' ){
		$format = 'standard';
	}

	$title = get_the_title();
	if( !empty($title) ){
		$title = '<h4><a href="'. get_permalink() .'">'. get_the_title() .'</a></h4>';
	} else {
		$title = '';
	}
	
	$date             = '<div class="thememount-postbox-small-date">'.digitallaw_entry_box_date(false).'</div>';
	$datenew          = '<span class="tm-date-wrapper"> <span class="tm-date-inner-wrapper"> ' . get_the_date( 'j M Y' ) . '</span></span>';
	$featuredLink     = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
	$featuredImgURL   = $featuredLink[0];
	
	
	switch($column){
		case 'one':
			$boxClass = 'col-lg-12 col-sm-12 col-md-12 col-xs-12';
			break;
		case 'two':
			$boxClass = 'col-lg-6 col-sm-6 col-md-6 col-xs-12';
			break;
		case 'three':
			$boxClass = 'col-lg-4 col-sm-6 col-md-4 col-xs-12';
			break;
		case 'four':
		default:
			$boxClass = 'col-lg-3 col-sm-6 col-md-3 col-xs-12';
			break;
		case 'five':
			$boxClass = 'col-lg-20percent col-sm-4 col-md-4 col-xs-12';
			break;
		case 'six':
			$boxClass = 'col-lg-2 col-sm-4 col-md-4 col-xs-12';
			break;
		case 'mix':
			$boxClass = 'col-lg-3 col-sm-6 col-md-3 col-xs-12';
			break;
		case 'fix':
			$boxClass = 'blog-slider-box-width';
			break;
		case 'timeline':
			$boxClass = 'tm-blogbox-timeline';
			break;
	}
	
	// Adding Post format class to box
	$boxClass .= ' thememount-blogbox-format-'. sanitize_html_class($format);
	
	// class for mp3 as audio
	if( $format == 'audio' ){
		$audiocode = trim( get_post_meta( get_the_ID(), '_format_audio_embed', true) );
		if( $audiocode!='' && substr($audiocode, -4) == ".mp3" ){
			$boxClass .= ' thememount-blogbox-format-audio-mp3';
		}
	}

	// Featured Content like Image, Slider, Video, Audio etc
	$featuredContent  = digitallaw_post_thumbnail( false, $column );
	
	
	$slugs = wp_get_post_terms( get_the_ID(), 'category', array("fields" => "slug"));
	$slugs   = implode( ' ', $slugs );
	
	
	/* Short Description */
	$description = '';
	//$readMore    = $blog_readmore_text . '<i class="tm-social-icon-right"></i>';
	
	if( !empty( $digitallaw_theme_options['blog_text_limit'] ) && esc_attr($digitallaw_theme_options['blog_text_limit']) > 0 ){
		$description  = nl2br( digitallaw_get_short_desc() );
	} else if( has_excerpt() ){
		$description  = nl2br( get_the_excerpt() );
		$description  = do_shortcode($description);
	} else {
		global $more;
		$more = 0;
		$description = strip_shortcodes( nl2br(get_the_content( '' )) );
	}
	
	// Post Format: Link
	if( $format=='link' ){
		$link = trim( get_post_meta( get_the_ID(), '_format_link_url', true ) );
		if( $link!='' ){
			$description = '<h4 class="tm-pformat-link-url"><a href="' . $link . '" target="_blank"> <i class="fa fa-link"></i> ' . $link . '</a></h4>' . $description;
		}
	} 
	
	
	$categories_list = get_the_category_list( esc_attr__( ', ', 'digitallaw' ) ); // Translators: used between list items, there is a space after the comma.
	$categories_list = ( $categories_list ) ? '<span class="categories-links"><i class="fa fa-folder-open"></i> ' . $categories_list . '</span>' : '' ;
	
	$comments     = wp_count_comments( get_the_ID() ); $comments = $comments->approved; //Get Total Comments
	$commentsCode = '<div class="tm-blogbox-comment-w">';
	if( !is_sticky() && comments_open() ){
		$commentsCode  .= '<div class="tm-blogbox-comment"><i class="fa fa-comments-o"></i> '.$comments.'</div>';
	}
	$commentsCode .= '</div>';
	 
	$metaDetails = '';
	if( $column != 'one' && ($categories_list!='' || $comments!='') ){
		$metaDetails = '<div class="entry-meta thememount-blogbox-entry-meta"><div class="thememount-meta-details">' . $categories_list . '</div></div>';
	}
	
	// Overlay
	$overthumb = '';
	if( ($format=='standard' || $format=='image') && $featuredContent!='' ){
		$overthumb = '<a href="'. get_permalink() .'"><span class="overthumb"><i class="tm-social-icon-plus"></i></span></a>';
	}
	
	// Date
	$date = get_the_date();
	
	// if blog title is emplty than add link to date
	if( empty($title) ){
		$date = '<a href="'. get_permalink() .'">'. $date .'</a>';
	}
	
	// Total Comments
	$comments     = '';
	$num_comments = get_comments_number(); // get_comments_number returns only a numeric value
	if ( comments_open() ) {
		if ( $num_comments == 0 ) {
			$comments = esc_attr__('No Comments', 'digitallaw');
		} elseif ( $num_comments > 1 ) {
			$comments = $num_comments . ' ' . esc_attr__('Comments', 'digitallaw');
		} else {
			$comments = esc_attr__('1 Comment', 'digitallaw');
		}
	}
	
	
	
	// if quote
	if( $format=='quote' ){
		$thememount_quote_source_name = trim( get_post_meta( get_the_ID(), '_format_quote_source_name', true ) );
		$thememount_quote_source_url  = trim( get_post_meta( get_the_ID(), '_format_quote_source_url', true ) );
		$desc_footer                  = '';
		$title                        = '';  // No title in quote
		
		if( empty( $thememount_quote_source_url) ){
			$thememount_quote_source_url = get_permalink();
		}
		
		if( $thememount_quote_source_name!='' ){
			$desc_footer = '<cite class="tm-quote-footer"><a href="' . $thememount_quote_source_url . '" target="_blank">' . $thememount_quote_source_name . '</a></cite>';
		}
		$featuredContent = '<div class="tm-blogbox-featured-quote"><blockquote>'. get_the_content( '' ) . $desc_footer .'</blockquote></div>';
		$description     = '';
		$overthumb       = '';
	}
	
	
	
	// If timeline view than add some extra DIV with class
	if( $column == 'timeline' ){
		
		$return .= '<div class="tm-blogbox-timeline-boxview">
		<div class="tm-timeline-spine"></div>
		<div class="tm-timeline-element-inner">
			<span>
				<div class="tm-anchor-point"></div>
				<div class="tm-animation-wrap">';
		
	}
	
	
	// Preparing Featured content div
	if( trim($featuredContent)!='' ){
		$featuredContent = '<div class="post-item-thumbnail-inner">' . $featuredContent . $overthumb .'</div>';
	}
	
	
	$return .= '
		<article class="post-box tm-box ' . digitallaw_sanitize_html_classes($boxClass) . ' ' . $slugs . '">
			<div class="post-item">
					' . $featuredContent . '
				<div class="item-content">
					'.$title.'			
					<div class="thememount-blogbox-desc">
						' . $description . '
						<div class="tm-blogbox-footer-meta">
						<div class="tm-blogbox-date"><i class="demo-icon tm-social-icon-calendar"></i> '.$date.'</div>
						<div class="tm-blogbox-comment"><i class="demo-icon tm-social-icon-comment-1"></i> '. $comments .'</div>
						</div>
					</div>
				</div>
			</div>
		</article>
	';
	
	
	// If timeline view than add some extra DIV with class
	if( $column == 'timeline' ){
		
		$return .= '
					<div class="tm-angle-border">
						<div class="angle-part"></div>
					</div>
					
				</div>
			</span>
		</div>
		</div><!-- .tm-blogbox-timeline-boxview -->';
		
	}
	

	
	return $return;
	
}
}
/* ********************* Function END ********************* */




/**
 * Blogbox Timeline View
 */
if( !function_exists('digitallaw_blogbox_timeline') ){
function digitallaw_blogbox_timeline($option=""){
	
	global $digitallaw_theme_options;
	
	// Getting Post Format
	$format = get_post_format();
	
	// Featured Content like Image, Slider, Video, Audio etc
	$featuredContent = '';
	if( $option=='withfeatured' ){
		$featuredContent  = digitallaw_post_thumbnail( false, 'one' );
	}
	
	/* Short Description */
	$description = '';
	if( !empty( $digitallaw_theme_options['blog_text_limit'] ) && esc_attr($digitallaw_theme_options['blog_text_limit']) > 0 ){
		$description  = nl2br( digitallaw_get_short_desc() );
		$description .= digitallaw_wrap_readmore('');
	} else if( has_excerpt() ){
		$description  = nl2br( get_the_excerpt() );
		$description  = do_shortcode($description);
		$description .= digitallaw_wrap_readmore('');
	} else {
		global $more;
		$more = 0;
		$description = strip_shortcodes( nl2br(get_the_content( '' )) );
	}
	
	
	// if quote
	if( $format=='quote' ){
		$thememount_quote_source_name = trim( get_post_meta( get_the_ID(), '_format_quote_source_name', true ) );
		$thememount_quote_source_url  = trim( get_post_meta( get_the_ID(), '_format_quote_source_url', true ) );
		$desc_footer                  = '';
		$title                        = '';  // No title in quote
		
		if( empty( $thememount_quote_source_url) ){
			$thememount_quote_source_url = get_permalink();
		}
		
		if( $thememount_quote_source_name!='' ){
			$desc_footer = '<cite class="tm-quote-footer"><a href="' . $thememount_quote_source_url . '" target="_blank">' . $thememount_quote_source_name . '</a></cite>';
		}
		$featuredContent = '<div class="tm-blogbox-featured-quote"><blockquote>'. get_the_content( '' ) . $desc_footer .'</blockquote></div>';
		$description     = '';
		$overthumb       = '';
	}
	
	
	
	$return = '
		<div class="tm-timeline-spine"></div>
		<div class="tm-timeline-element-inner">
			<span>
				<div class="tm-anchor-point"></div>
				<div class="tm-animation-wrap">
					
					<div class="tm-content-wrap">
						<div class="post-item-thumbnail-inner">' . $featuredContent . '</div>
						<div class="tm-date">'.get_the_date('jS M Y').'</div>
						<h3 class="tm-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h3>
						<div class="tm-content">'.$description.'</div>
					</div>
					
					<div class="tm-angle-border">
						<div class="border-part-top"></div>
						<div class="angle-part"></div>
						<div class="border-part-bottom"></div>
					</div>
					
				</div>
			</span>
		</div>
	';
	
	return $return;
}
}




/**
 * Portfolio Box
 */
if( !function_exists('digitallaw_portfoliobox') ){
function digitallaw_portfoliobox( $column='', $pdesign='' ){
	global $digitallaw_theme_options;
	$return = '';
	$featuredImg = '';
	// Getting all values
	$featuredtype = get_post_meta( get_the_ID(), '_thememount_portfolio_featured_featuredtype', true );
	$featuredtype = $featuredtype[0];

	// YouTube or Vimeo
	$videourl     = get_post_meta( get_the_ID(), '_thememount_portfolio_featured_videourl', true );

	// Video Player (HTML5)
	$videofile_mp4 =  get_post_meta( get_the_ID(), '_thememount_portfolio_featured_videofile_mp4', true );
	$videofile_webm = get_post_meta( get_the_ID(), '_thememount_portfolio_featured_videofile_webm', true );
	$videofile_ogv =  get_post_meta( get_the_ID(), '_thememount_portfolio_featured_videofile_ogv', true );

	// SoundCloud or other Audio embed code
	$audiocode = get_post_meta( get_the_ID(), '_thememount_portfolio_featured_audiocode', true );

	// Audio Player (HTML5)
	$audiofile_mp3 = get_post_meta( get_the_ID(), '_thememount_portfolio_featured_audiofile_mp3', true );
	$audiofile_wav = get_post_meta( get_the_ID(), '_thememount_portfolio_featured_audiofile_wav', true );
	$audiofile_oga = get_post_meta( get_the_ID(), '_thememount_portfolio_featured_audiofile_oga', true );

	$embedCodeDiv = '';
	
	$boxClass = 'col-lg-3 col-sm-6 col-md-3 col-xs-12';
	switch($column){
		case 'one':
			$boxClass = 'col-lg-12 col-sm-12 col-md-12 col-xs-12';
			break;
		case 'two':
			$boxClass = 'col-lg-6 col-sm-6 col-md-6 col-xs-12';
			break;
		case 'three':
			$boxClass = 'col-lg-4 col-sm-6 col-md-4 col-xs-12';
			break;
		case 'four':
		default:
			$boxClass = 'col-lg-3 col-sm-6 col-md-3 col-xs-12';
			break;
		case 'five':
			$boxClass = 'col-lg-20percent col-sm-4 col-md-4 col-xs-12';
			break;
		case 'six':
			$boxClass = 'col-lg-2 col-sm-4 col-md-4 col-xs-12';
			break;
		case 'mix':
			$boxClass = 'col-lg-3 col-sm-6 col-md-3 col-xs-12';
			break;
		case 'fix':
			$boxClass = 'portfolio-slider-box-width';
			break;
	}




	
	$slugs = array();
	$terms = array();
	if( taxonomy_exists('tm_portfolio_category') ){
		$term_slugs = wp_get_post_terms( get_the_ID(), 'tm_portfolio_category', array("fields" => "all") );
		foreach( $term_slugs as $term ){
			$slugs[] = $term->slug;
			$terms[] = $term->name;
		}
	}

	$likes = get_post_meta( get_the_ID(), 'thememount_likes', true );
	if( !$likes ){ $likes='0'; }

	$likeActiveClass = ( isset($_COOKIE["thememount_likes_".get_the_ID()]) ) ? 'like-active' : '' ;
	$likeIconClass   = ( isset($_COOKIE["thememount_likes_".get_the_ID()]) ) ? 'fa fa-heart' : 'fa fa-heart-o' ;

	$featuredLink = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
	$featuredImgURL = $featuredLink[0];

	// Featured type link
	switch($featuredtype){
		case 'image':
		default:
			$featuredLink = '<a href="' . esc_url($featuredImgURL) . '" class="thememount_pf_featured tm_prettyphoto" title="' . get_the_title() . '" data-rel="prettyPhoto"><i class="tm-social-icon-picture-1"></i></a>';
			break;
		case 'video':
			$featuredLink = '<a href="' . esc_url($videourl) . '" class="thememount_pf_featured tm_prettyphoto" title="' . get_the_title() . '" data-rel="prettyPhoto"><i class="tm-social-icon-videocam"></i></a>';
			break;
			
		case 'audioembed':
			$embedCodeDiv = '<div id="thememount-embed-code-'.get_the_ID().'" class="thememount-hide tm_prettyphoto">'.$audiocode.'</div>';
			$featuredLink = '<a href="#thememount-embed-code-' . get_the_ID() . '" class="thememount_pf_featured" title="' . get_the_title() . '" data-rel="prettyPhoto"><i class="tm-social-icon-volume-down"></i></a>';
			break;
			
		case 'slider':
			$embedCodeDiv = '<div id="#thememount-embed-code-' . get_the_ID() . '" class="thememount-hide">';
			$api_images = $api_titles = $api_desc = array();
			for($i=1; $i<=10; $i++){
				$img = get_post_meta( get_the_ID(), '_thememount_portfolio_featured_slideimage'.$i, true );
				if( $img != '' ){
					$imgdesc      = wp_get_attachment_image_src( $img, 'full' );
					$api_images[] = '"'.$imgdesc[0].'"';
					$api_titles[] = '"' . get_the_title() . '"';
					$api_desc[]   = '""';
				}
			}
			if( count($api_images)>0 ){
				$embedCodeDiv .= '<div class="thememount-hide thememount-pf-gallery-content"><script type="text/javascript">';
				$embedCodeDiv .= 'api_images_' . get_the_ID() . ' = [' . implode(',',$api_images) . '];';
				$embedCodeDiv .= 'api_titles_' . get_the_ID() . ' = [' . implode(',',$api_titles) . '];';
				$embedCodeDiv .= 'api_desc_' . get_the_ID() . '   = [' . implode(',',$api_desc) . '];';
				$embedCodeDiv .= '</script></div>';
			}
			$embedCodeDiv .= '</div>';

			$featuredLink = '<a href="#thememount-embed-code-' . get_the_ID() . '" class="thememount_pf_featured thememount-open-gallery" title="' . get_the_title() . '"><i class="tm-social-icon-gallery"></i></a>';

			
			
			
			break;
	}
	
	
	
	
	$termList = ( is_array($terms) && count($terms)>0 ) ? '<p>'. implode(', ',$terms) .'</p>' : '' ;
	
	
	$like = '<!-- Like -->
				<div class="thememount-portfolio-likes-wrapper">
					<a class="thememount-portfolio-likes ' . sanitize_html_class($likeActiveClass) . '" href="#" id="pid-' . get_the_ID() . '">
						<i class="'.digitallaw_sanitize_html_classes($likeIconClass).'"></i>&nbsp;' . esc_attr($likes) . '
					</a>
				</div>';
	if( isset($digitallaw_theme_options['portfolio_show_like']) && trim(esc_attr($digitallaw_theme_options['portfolio_show_like'])) == '0' ){
		$like = '';
	}
	
	
	// Short description
	$shortdesc = '';
	/* Short Description */
	$shortdesc = '';
	$readMore    = esc_attr__('View Practice Detail', 'digitallaw') . ' <i class="fa fa-angle-double-right"></i>';
	if( has_excerpt() ){
		$shortdesc  = '<div class="thememount-short-desc">';
		$shortdesc .= get_the_excerpt();
		$shortdesc .= digitallaw_wrap_readmore('<a href="'.get_permalink().'">'.$readMore.'</a>');
		$shortdesc .= '</div>';
	}

	
	
	// NEW featured image
	if( $pdesign=='nopadding' ){
		if( has_post_thumbnail() ){
			$featuredImg = get_the_post_thumbnail( get_the_ID(), 'digitallaw-portfolio-'.$column.'-column' );
		} else {
				$featuredImg = '';
			//}
		}
		
	} else {
		if( has_post_thumbnail() ){
			$featuredImg  = get_the_post_thumbnail( get_the_ID(), 'digitallaw-portfolio-'.$column.'-column' );
			$featuredImg .= '<div class="icon-overlay"></div>								
				<div class="icons">
					' . $featuredLink . '
					<a href="' . get_permalink() . '" class="thememount_pf_link"><i class="fa fa-link"></i></a>
				</div>';

		} else {
			$featuredImg = '';
		}
	}
	
	
	
	
	
	// Now preparing output
	
	if( $pdesign=='nopadding' ){
		// No Padding view
		
		$return .= '
			<div class="portfolio-box tm-box ' . digitallaw_sanitize_html_classes($boxClass) . ' ' .    digitallaw_sanitize_html_classes( implode(' ',$slugs) ) . ' thememount-box">
				<div class="item">
					<div class="item-thumbnail">
						' . $featuredImg . '
						<div class="icon-overlay"></div>								
						<div class="icons">					
							' . $featuredLink . '
							<a href="' . get_permalink() . '" class="thememount_pf_link"><i class="fa fa-link"></i></a>
						</div>
					</div>
					<div class="item-content">
						<div class="item-content-inner">
							<h4><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>
							' . $termList . '
						</div>
						'.$like.'
					</div>
				</div>
				' . $embedCodeDiv . '
			</div>
		';
		
	} else {
		
		// Default box view
		
		$return .= '
			<div class="portfolio-box tm-box ' . digitallaw_sanitize_html_classes($boxClass) . ' ' .    digitallaw_sanitize_html_classes( implode(' ',$slugs) ) . ' thememount-box">
			
				<div class="item">
					<div class="item-thumbnail">
						' . $featuredImg . '
					</div>
					<div class="item-content">
						<h4><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>
						'. $shortdesc .'
					</div>
				</div>
				' . $embedCodeDiv . '
			</div>
		';
		
	}
	
	return $return;
	
}
}
/* ********************* Function END ********************* */








/**
 *  Convert VC options to list of array with default values
 */
if( !function_exists('digitallaw_create_options_list') ){
function digitallaw_create_options_list( $optionslist=array() ){
	$options_list = array();
	if( is_array($optionslist) && count($optionslist)>0 ){
		foreach( $optionslist as $options ){
			if( isset($options['param_name']) && $options['param_name']!='content' ){
				$std = ( isset($options['std']) && trim($options['std'])!='' ) ? trim($options['std']) : '' ;
				$options_list[$options['param_name']] = $std;
			}
		}
	}
	return $options_list;
}
}
/* ********************* Function END ********************* */





/**
 * Function to prepare DATA tag values
 */
if( !function_exists('digitallaw_carousel_data_html') ){
function digitallaw_carousel_data_html( $allVar ){
	$return = '';
	
	if( $allVar['view'] == 'carousel' ){
		
		wp_enqueue_script( 'owl-carousel');
		wp_enqueue_style( 'owl-carousel');
		wp_enqueue_style( 'animate-css');
		
		
		foreach( $allVar as $key=>$value ){
			$var = substr($key, 0 , 9 );
			if( $var=='carousel_' ){
				$datatitle = str_replace('carousel_','data-',$key);
				$return .= ' '.$datatitle.'="'.$value.'" ';
			}
		}
	}
	return $return;
}
}
/* ********************* Function END ********************* */





/**
 *  Heading in our custom element like Blogbox, Portfoliobox etc.
 */
if( !function_exists('digitallaw_vc_element_heading') ){
function digitallaw_vc_element_heading( $allVar ){
	
	$ctaOptions = array(
		'h2',
		'h2_link',
		'h2_use_theme_fonts',
		'use_custom_fonts_h2',
		'h2_font_container',
		'h2_google_fonts',
		'h4',
		'h4_link',
		'h4_use_theme_fonts',
		'use_custom_fonts_h4',
		'h4_font_container',
		'h4_google_fonts',
		'txt_align',
		'heading_sep',
		'shape',
		'style',
		'custom_background',
		'custom_text',
		'color',
		'add_button',
	);
	
	$carouselControls = '<div class="thememount-carousel-controls">
						<div class="thememount-carousel-controls-inner">							
							<!--<a class="thememount-carousel-slideshow"><span class="wpb_button"><i class="fa fa-pause"></i></span></a>-->
							<a class="thememount-carousel-next"><i class="demo-icon tm-social-icon-right-small"></i></a>
							<a class="thememount-carousel-prev"><i class="demo-icon tm-social-icon-left-small"></i></a>
						</div>
					</div>';
	
	$return = '';
	
	
	if( trim($allVar['h2'])!='' ) {
		$return .= '<div class="tm-element-heading-wrapper tm-heading-inner tm-element-align-'. sanitize_html_class($allVar['txt_align']).' ">';
		if( !isset($allVar['content']) ){
			$allVar['content'] = '';
		}
		$allVar['style'] = 'transparent';
		
		// Preparing NEW shortcode
		$ctaShortcode = '[tm-heading ';
		foreach( $ctaOptions as $option ){
			if( isset($allVar[$option]) ){
				$ctaShortcode .= $option.'="'.$allVar[$option].'" ';
			}
		}
		if( isset($allVar['add_icon_new']) ){
			$ctaShortcode .= 'add_icon="'.$allVar['add_icon_new'].'" ';
		}
		$ctaShortcode .= 'el_width="100%" css_animation=""]'.$allVar['content'].'[/tm-heading]';
		
		
		
		$return .= do_shortcode($ctaShortcode);
	
	
		if( $allVar['view'] == 'carousel' && $allVar['carousel_nav']=='above' ){
			$return .= '<div class="tm-carousel-arrows tm-carousel-arrows-'. sanitize_html_class($allVar['txt_align']) .'">';
			$return .= $carouselControls;
			$return .= '</div>';
		}
		
		$return .= '</div> <!-- .tm-element-heading-wrapper container --> ';
		
	}
	return $return;
}
}
/* ********************* Function END ********************* */









/**
 * Bootstrap 3 based columns
 */
if( !function_exists('digitallaw_translateColumnWidthToSpan') ){
function digitallaw_translateColumnWidthToSpan($width, $front = true) {
	switch ( $width ) {
		case "1/12" :
			$w = "col-xs-12 col-sm-1 col-md-1 col-lg-1";
			break;
		case "1/6" :
			$w = "col-xs-12 col-sm-2 col-md-2 col-lg-2";
			break;    
		case "1/4" :
			$w = "col-xs-12 col-sm-3 col-md-3 col-lg-3";
			break;
		case "1/3" :
			$w = "col-xs-12 col-sm-4 col-md-4 col-lg-4";
			break;
		case "5/12" :
			$w = "col-xs-12 col-sm-5 col-md-5 col-lg-5";
			break;
		case "1/2" :
			$w = "col-xs-12 col-sm-6 col-md-6 col-lg-6";
			break;
		case "7/12" :
			$w = "col-xs-12 col-sm-7 col-md-7 col-lg-7";
			break;
		case "2/3" :
			$w = "col-xs-12 col-sm-8 col-md-8 col-lg-8";
			break;    
		case "3/4" :
			$w = "col-xs-12 col-sm-9 col-md-9 col-lg-9";
			break;    
		case "5/6" :
			$w = "col-xs-12 col-sm-10 col-md-10 col-lg-10";
			break;
		case "11/12" :
			$w = "col-xs-12 col-sm-11 col-md-11 col-lg-11";
			break;
		case "1/1" :
			$w = "col-xs-12 col-sm-12 col-md-12 col-lg-12";
			break;
		default :
		$w = $width;
	}
	if( function_exists('get_custom_column_class') ){
		$custom = $front ? get_custom_column_class($w): false;
	} else {
		$custom = false;
	}
	return $custom ? $custom : $w;
}
}
/* ********************* Function END ********************* */



/**
 * Team Member Box
 */
if( !function_exists('digitallaw_teammemberbox') ){
function digitallaw_teammemberbox( $column='two', $linking='yes', $boxdesign='default' ){
	global $post;
	$return   = '';
	$position = esc_attr(get_post_meta( get_the_id(), '_thememount_team_member_details_position', true ));
	$content  = trim($post->post_content);
	$excerpt  = trim($post->post_excerpt);
	
	
	// Image
	$img = '';
	if( has_post_thumbnail() ){
		$img = get_the_post_thumbnail( get_the_id(), 'digitallaw-team-'.$column.'-column' );
	} else {
		$img = '';
	}
	
	
	/* Title */
	$title = '<a href="'.get_permalink( get_the_ID() ).'">'.get_the_title().'</a>';
	
	$overthumb = '';
	if( $boxdesign=='leftimage' ){ $overthumb = '<span class="overthumb"><i class="tm-social-icon-plus"></i></span>'; }
	$thumbcode = '<a class="tm-team-imglink" href="'.get_permalink().'">'.$img . $overthumb .'</a>';
	
	if( $linking=='no' ){
		$title = get_the_title();
		$thumbcode = $img;
	}
	
	
	
	$boxClass = '';
	switch($column){
		case 'one':
			$boxClass = 'col-lg-12 col-sm-12 col-md-12 col-xs-12';
			break;
		case 'two':
			$boxClass = 'col-lg-6 col-sm-6 col-md-6 col-xs-12';
			break;
		case 'three':
			$boxClass = 'col-lg-4 col-sm-6 col-md-4 col-xs-12';
			break;
		case 'four':
			$boxClass = 'col-lg-3 col-sm-6 col-md-3 col-xs-12';
			break;
		case 'five':
			$boxClass = 'col-lg-20percent col-sm-4 col-md-4 col-xs-12';
			break;
		case 'six':
			$boxClass = 'col-lg-2 col-sm-4 col-md-4 col-xs-12';
			break;
	}
	
	
	if( trim($position)!='' ){ $position = '<h4 class="thememount-team-position">'.esc_attr($position).'</h4>'; }

	// Team Group
	$categories_list = '';
	if( taxonomy_exists('tm_team_group') ){
		$categories_list = get_the_term_list( get_the_ID(), 'tm_team_group', '', esc_attr__( ' &nbsp; &#47; &nbsp; ', 'digitallaw' ) );
		if( $categories_list!='' ){
			$categories_list = '<div class="thememount-team-cat-links">'.$categories_list.'</div>';
		}
	}
	
	
	// Phone email
	$phone_email = '';
	$phone       = get_post_meta( get_the_id(), '_thememount_team_member_details_phone', true );
	$email       = get_post_meta( get_the_id(), '_thememount_team_member_details_email', true );
	if( !empty($phone) ){
		$phone_email .= '<div class="thememount-team-phone"><span class="tm-skincolor">'. esc_attr__('Phone','digitallaw') .':</span>  <a href="tel:'.esc_attr($phone).'">'. esc_attr($phone) .'</a></div>';
	}
	if( !empty($email) ){
		$phone_email .= '<div class="thememount-team-email"><span class="tm-skincolor">'. esc_attr__('E-mail','digitallaw') .':</span>  <a href="mailto:'. sanitize_email( $email ) .'">'. sanitize_email( $email ) .'</a></div>';
	}
	if( !empty($phone_email) ){
		$phone_email = '<div class="thememount-team-phoneemail">'. $phone_email .'</div>';
	}
	
	
	
	
	// Short description
	$shortdesc = '';
	if( has_excerpt() ){
		$shortdesc .= '<div class="thememount-team-short-desc">';
		$shortdesc .= get_the_excerpt();
		$shortdesc .= '</div><!-- .thememount-team-short-desc -->';
	}
	
	
	
	// Social links
	$socialcode = digitallaw_team_social();
	
	
	// Box code start
	$return .= "\n\t".'<div class="tm-box '. digitallaw_sanitize_html_classes($boxClass) .' tm-box-style-'.  sanitize_html_class($boxdesign) .'">';
	
	
	// Box design
	if( $boxdesign=='leftimage' ){
	
	
		$return .= '<div class="thememount-team-box">';
			$return .= '<div class="row">';
				$return .= '<div class="thememount-team-img-left col-md-6">';
					$return .= $thumbcode;	
				$return .= '</div><!-- .thememount-team-img -->';
				$return .= '<div class="thememount-team-data-right col-md-6">';
					$return .= '<div class="thememount-team-data-right-inner">';
						$return .= '<h3 class="thememount-team-title">'.$title.'</h3>';
						$return .= $position;
						$return .= $shortdesc;
						$return .= $socialcode;
						$return .= $phone_email;
						//$return .= $categories_list;
					$return .= '</div>';
				$return .= '</div>';
			$return .= '</div>';
		$return .= '</div>';
		
		
	} else {
		
		$return .= '<div class="thememount-team-box">';
			$return .= '<div class="thememount-team-img">';
				$return .= $thumbcode;	
				$return .= '<div class="thememount-team-data-inner">';
					$return .= $phone_email;
					$return .= $shortdesc;
					$return .= $socialcode;
					//$return .= $categories_list;
				$return .= '</div> <!-- .thememount-team-data-inner --> ';	
			$return .= '</div><!-- .thememount-team-img -->';
		
			$return .= '<div class="thememount-team-data">';
				$return .= '<h3 class="thememount-team-title">'.$title.'</h3>';
				$return .= $position;
			$return .= '</div>';
		$return .= '</div>';
			
	}
	
	$return .= "\n\t".'</div>';  // box code end
	
		
	return $return;
}
}
/* ********************* Function END ********************* */



/**
 * Social Links function
 */
if( !function_exists('digitallaw_team_social') ){
function digitallaw_team_social( $column='' ){
	$facebook   = trim(get_post_meta( get_the_id(), '_thememount_team_member_social_links_facebook', true ));
	$twitter    = trim(get_post_meta( get_the_id(), '_thememount_team_member_social_links_twitter', true ));
	$linkedin   = trim(get_post_meta( get_the_id(), '_thememount_team_member_social_links_linkedin', true ));
	$googleplus = trim(get_post_meta( get_the_id(), '_thememount_team_member_social_links_googleplus', true ));
	$instagram  = trim(get_post_meta( get_the_id(), '_thememount_team_member_social_links_instagram', true ));
	$email      = trim(get_post_meta( get_the_id(), '_thememount_team_member_details_email', true ));
	
	$socialcode = '';
	if($facebook!=''){   $socialcode .= '<li class="thememount-social-facebook"><a href="'.esc_url($facebook).'" class="hint--top" data-hint="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>'; }
	if($twitter!=''){    $socialcode .= '<li class="thememount-social-twitter"><a href="'.esc_url($twitter).'" class="hint--top" data-hint="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>'; }
	if($linkedin!=''){   $socialcode .= '<li class="thememount-social-linkedin"><a href="'.esc_url($linkedin).'" class="hint--top" data-hint="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a></li>'; }
	if($googleplus!=''){ $socialcode .= '<li class="thememount-social-gplus"><a href="'.esc_url($googleplus).'" class="hint--top" data-hint="Google+" target="_blank"><i class="fa fa-google-plus"></i></a></li>'; }
	if($instagram!=''){ $socialcode .= '<li class="thememount-social-instagram"><a href="'.esc_url($instagram).'" class="hint--top" data-hint="Instagram" target="_blank"><i class="fa fa-instagram"></i></a></li>'; }
	if($email!=''){      $socialcode .= '<li class="thememount-social-email"><a href="mailto:'.sanitize_email($email).'" class="hint--top" data-hint="' . esc_attr__('Email', 'digitallaw') . '" ><i class="fa fa-envelope-o"></i></a></li>'; }
	if($socialcode!=''){ $socialcode = '<div class="thememount-team-social-links"><ul>'.$socialcode.'</ul></div>'; }
	
	return $socialcode;
}
}
/* ********************* Function END ********************* */













/**
 * Print HTML with date information for current post.
 *
 * Create your own digitallaw_entry_box_date() to override in a child theme.
 *
 * @since DigitalLaw 1.0
 *
 * @param boolean $echo (optional) Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
if ( !function_exists( 'digitallaw_entry_box_date' ) ){
function digitallaw_entry_box_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) ){
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'digitallaw' );
	} else {
		$format_prefix = '%2$s';
	}
	
	
	$date = '<div class="thememount-post-box-date-wrapper">';
		$date .= sprintf( '<div class="thememount-entry-date-wrapper">
								<span class="thememount-entry-date">
									<time class="entry-date" datetime="%1$s" >
										<span class="entry-date">%2$s</span> 
										<span class="entry-month">%3$s</span> 
										<span class="entry-year">%4$s</span> 
									</time>
								</span>
							</div>',
			get_the_date( 'c' ),
			get_the_date( 'j' ),
			get_the_date( 'M' ),
			get_the_date( ' Y' )
		);
	$date .= '</div>';
	
	if ( $echo ){
		
		echo wp_kses( /* HTML Filter */
			$date,
			array(
				'div' => array(
					'class' => array(),
				),
				'span' => array(
					'class' => array(),
				),
				'time' => array(
					'class' => array(),
					'datetime' => array(),
				)
			)
		);
		
		
		
		
	} else {
		return wp_kses( /* HTML Filter */
			$date,
			array(
				'div' => array(
					'class' => array(),
				),
				'span' => array(
					'class' => array(),
				),
				'time' => array(
					'class' => array(),
					'datetime' => array(),
				)
			)
		);
	}
}
}
/* ********************* Function END ********************* */




/**
 *  Post thumbnail. This will echo post thumbnail according to port format like video, audio etc.
 */
if ( !function_exists( 'digitallaw_post_thumbnail' ) ){
function digitallaw_post_thumbnail( $echo=true, $column='four' ){
	
	global $digitallaw_theme_options;
	
	// Image size ID
	$imgSize = 'digitallaw-blog-'.$column.'-column';
	if( $column=='full' ){
		$imgSize = 'full';
	}
	
	// Getting Post Format
	$format = get_post_format();
	if( $format=='' ){ $format=='standard'; }
	
	$featuredContent = '';
	
	$noImgCode = '';
	
	switch( $format ){
		case 'standard':
		default:
			if( has_post_thumbnail() ){
				$featuredContent = get_the_post_thumbnail( get_the_ID(), $imgSize );
			} else {
				$featuredContent = $noImgCode;
			}
			break;
		case 'quote':
			$title = '';
			if( has_post_thumbnail() ){
				$featuredContent = get_the_post_thumbnail( get_the_ID(), $imgSize );
			} else {
				$featuredContent = $noImgCode;
			}
			break;
		case 'video':
			$videocode = trim( get_post_meta( get_the_ID(), '_format_video_embed', true) );
			if( $videocode!='' ){
				if( strpos($videocode, 'http') === 0 ){
					$featuredContent = wp_oembed_get($videocode);
					if( $featuredContent==false ){ // 1st retry
						$featuredContent = wp_oembed_get($videocode);
					}
					if( $featuredContent==false ){ // 2nd retry
						$featuredContent = wp_oembed_get($videocode);
					}
					if( $featuredContent==false ){ // 3rd retry
						$featuredContent = wp_oembed_get($videocode);
					}
				} else {
					$featuredContent = $videocode;
				}
			}
			$featuredLinkArea = '';
			break;
			
		case 'audio':
			$audiocode = trim( get_post_meta( get_the_ID(), '_format_audio_embed', true) );
			if( $audiocode!='' && substr($audiocode, -4) != ".mp3" ){
				$featuredContent = wp_oembed_get($audiocode);
				if( $featuredContent!=false ){
					$featuredContent = wp_oembed_get($audiocode);
				} else {
					$featuredContent = $audiocode;
				}
			} else if( $audiocode!='' && substr($audiocode, -4) == ".mp3" ){
				$featuredContent = '<div class="tm-blogbox-audio-mp3player-w">'.do_shortcode( '[audio src="'.$audiocode.'"]' ).'</div>';
			}
			$featuredLinkArea = '';
			break;
			
		case 'gallery':
			$featuredContent = digitallaw_featured_gallery_slider('post', $column);
			if( $featuredContent=='' ){
				if( has_post_thumbnail() ){
					$featuredContent = get_the_post_thumbnail( get_the_ID(), $imgSize );
				} else {
					$featuredContent = $noImgCode;
				}
			} else {
				$featuredLinkArea = '';
			}
			break;
	}
	
	
	// Overlay
	$overthumb = '';
	if( ($format=='standard' || $format=='image' || $format==false) && !is_single() ){
		$overthumb = '<a href="'. get_permalink() .'"><span class="overthumb"><i class="tm-social-icon-plus"></i></span></a>';
	}
	
	
	
	// Wrapping the featured content
	if( trim($featuredContent)!='' ){
		$featuredContent = '<div class="thememount-blog-media entry-thumbnail">' . $featuredContent . $overthumb . '</div>';
	}
	
	
	if( $echo ){
		
		echo wp_kses( // HTML Filter
			$featuredContent,
			array(
				'a' => array(
					'href'  => array(),
					'class' => array(),
					'title' => array(),
					'rel'   => array(),
				),
				'iframe' => array(
					'class'  => array(),
					'src'    => array(),
					'width'  => array(),
					'height' => array(),
					'frameborder' => array(),
					'allowfullscreen' => array(),
				),
				'audio' => array(
					'class'		=> array(),
					'id'		=> array(),
					'style' 	=> array(),
					'preload' 	=> array(),
				),
				'source' => array(
					'type' 	=> array(),
					'src' 	=> array(),
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
		
		
		
	} else {
		return wp_kses( /* HTML Filter */
			$featuredContent,
			array(
				'a' => array(
					'href'  => array(),
					'class' => array(),
					'title' => array(),
					'rel'   => array(),
				),
				'iframe' => array(
					'class'  => array(),
					'src'    => array(),
					'width'  => array(),
					'height' => array(),
					'frameborder' => array(),
					'allowfullscreen' => array(),
				),
					'audio' => array(
					'class'		=> array(),
					'id'		=> array(),
					'style' 	=> array(),
					'preload' 	=> array(),
				),
				'source' => array(
					'type' 	=> array(),
					'src' 	=> array(),
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
	}
	
}
}
/* ********************* Function END ********************* */




/**
 *  Slider
 */
if( !function_exists('digitallaw_featured_gallery_slider') ){
function digitallaw_featured_gallery_slider( $postType='post', $column='four' ){
	
	$wrapperClass = '';
	$metaPrefix   = '_thememount_post_gallery_';
	$wrapperClass = 'thememount-blog-media';
	
	if( 'portfolio' == $postType ){
		$metaPrefix   = '_thememount_portfolio_featured_';
		$wrapperClass = 'thememount-portfolio-media';
		$imgSize      = 'digitallaw-portfolio-'.$column.'-column';
	} else if( 'post' == $postType ){
		$metaPrefix   = '_thememount_post_gallery_';
		$wrapperClass = 'thememount-blog-media';
		$imgSize      = 'digitallaw-blog-'.$column.'-column';
	}
	$return = '';
	if( $metaPrefix!='' ){
		for($a=1; $a<=10; $a++){
			$slideImage = get_post_meta(get_the_ID(), $metaPrefix . 'slideimage'.$a, true);
			if( $slideImage!='' ){
				$return .= '<li>'.wp_get_attachment_image( $slideImage, $imgSize).'</li>';
			}
		}
		if( $return!='' ){
			$return = '<div class="'. sanitize_html_class($wrapperClass) .' thememount-blog-media thememount-slider-wrapper"><div class="flexslider"><ul class="slides">' . $return . '</ul></div></div>';
		}
	}
	return $return;
}
}
/* ********************* Function END ********************* */






/**
 * Print HTML with icon for current post.
 *
 * Create your own digitallaw_entry_icon() to override in a child theme.
 *
 * @since DigitalLaw 1.0
 *
 */
if ( !function_exists( 'digitallaw_entry_icon' ) ){
function digitallaw_entry_icon( $echo = false ) {
	$iconCode = '';
	$postFormat = get_post_format();
	if( is_sticky() ){ $postFormat = 'sticky'; }
	$icon = 'pencil';
	switch($postFormat){
		case 'sticky':
			$icon = 'thumb-tack';
			break;
		case 'aside':
			$icon = 'thumb-tack';
			break;
		case 'audio':
			$icon = 'music';
			break;
		case 'chat':
			$icon = 'comments';
			break;
		case 'gallery':
			$icon = 'files-o';
			break;
		case 'image':
			$icon = 'photo';
			break;
		case 'link':
			$icon = 'link';
			break;
		case 'quote':
			$icon = 'quote-left';
			break;
		case 'status':
			$icon = 'ellipsis-h';
			break;
		case 'video':
			$icon = 'film';
			break;
	}
	
	$iconCode .= '<i class="fa fa-'.$icon.'"></i>';
	
	if( trim(get_the_title())=='' ){
		$iconCode = '<a class="tm-post-date-link tm-post-no-title" href="'. get_permalink() .'">'. $iconCode .'</a>';
	}
	
	if ( $echo ){
		echo wp_kses( /* HTML Filter */
			$iconCode,
			array(
				'a' => array(
					'href'  => array(),
					'class' => array(),
				),
				'i' => array(
					'class' => array(),
				)
			)
		);
		
		
	} else {
		return wp_kses( /* HTML Filter */
			$iconCode,
			array(
				'a' => array(
					'href'  => array(),
					'class' => array(),
				),
				'i' => array(
					'class' => array(),
				)
			)
		);
	}
}
}
/* ********************* Function END ********************* */






/**
 * Print HTML with meta information for current post.
 *
 * Create your own digitallaw_blogbox_entry_meta() to override in a child theme.
 *
 * @since DigitalLaw 1.0
 *
 * @return void
 */
if ( !function_exists( 'digitallaw_blogbox_entry_meta' ) ){
function digitallaw_blogbox_entry_meta($echo = false, $tags='no') {
	$return = '';
	$sep    = '<span class="tm-blogbox-meta-sep"> &nbsp;/&nbsp; </span>';
	
	global $post;
	
	if( isset($post->post_type) && $post->post_type=='page' ){
		return;
	}
	
	
	$postFormat = get_post_format();
	
	// Post author
	$num_comments    = get_comments_number();
	
	$return .= '<div class="thememount-meta-details">';
		
		// Author
		if ( 'post' == get_post_type() ) {
			
			$return .= sprintf( '<div class="thememount-post-user"><i class="tm-social-icon-user-1"></i> <span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span></div>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( esc_attr__( 'View all posts by %s', 'digitallaw' ), get_the_author() ) ),
				get_the_author()
			);
		
		}
		
		// Categories
		$categories_list = get_the_category_list( esc_attr__( ', ', 'digitallaw' ) );
		if ( $categories_list ) {
			$return .= '<span class="categories-links"><i class="tm-social-icon-folder"></i> ' . $categories_list . '</span>';
		}
		
		if($tags=='yes'){
			//Tags
			$tag_list = get_the_tag_list( '',esc_attr__( ', ', 'digitallaw' ) ); 
			if($tag_list){
				$return .= '<span class="tag-links"><i class="tm-social-icon-tag-1"></i> ' . $tag_list . '</span>';
			}
		}
		
		if( !is_sticky() && comments_open() && ($num_comments>0) ){
			$return .= '<span class="comments"><i class="fa fa-comments-o"></i> ';
			$return .= $num_comments;
			$return .= '</span>';
		}

	$return .= '</div>';
	
	if( $echo == true ){
		echo wp_kses( /* HTML Filter */
			$return,
			array(
				'div' => array(
					'class' => array(),
				),
				'span' => array(
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
				)
			)
		);
		
	} else {
		return wp_kses( /* HTML Filter */
			$return,
			array(
				'div' => array(
					'class' => array(),
				),
				'span' => array(
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
				)
			)
		);
	}
}
}
/* ********************* Function END ********************* */





/**
 * Wrap DIV to the Read More link in blog
 */
if( !function_exists('digitallaw_wrap_readmore') ){
function digitallaw_wrap_readmore($more_link) {
    return '<div class="thememount-post-readmore">'.$more_link.'</div>';
}
}
add_filter('the_content_more_link', 'digitallaw_wrap_readmore', 10, 1);
/* ********************* Function END ********************* */





/**
 * Testimonial Box
 */
if( !function_exists('digitallaw_testimonialbox') ){
function digitallaw_testimonialbox( $column='' ){
	$return      = '';
	$clienturl   = trim(get_post_meta( get_the_id(), '_thememount_testimonials_details_clienturl', true ));
	$designation = esc_attr( trim(get_post_meta( get_the_id(), '_thememount_testimonials_details_designation', true )) );
	
	$boxClass = '';
	
	switch($column){
		case 'one':
			$boxClass = 'col-lg-12 col-sm-12 col-md-12 col-xs-12';
			break;
		case 'two':
			$boxClass = 'col-lg-6 col-sm-6 col-md-6 col-xs-12';
			break;
		case 'three':
			$boxClass = 'col-lg-4 col-sm-6 col-md-4 col-xs-12';
			break;
		case 'four':
			$boxClass = 'col-lg-3 col-sm-6 col-md-3 col-xs-12';
			break;
		case 'five':
			$boxClass = 'col-lg-20percent col-sm-4 col-md-4 col-xs-12';
			break;
		case 'six':
			$boxClass = 'col-lg-2 col-sm-4 col-md-4 col-xs-12';
			break;
		case 'five':
			$boxClass = 'col-lg-20percent col-sm-4 col-md-4 col-xs-12';
			break;
		case 'six':
			$boxClass = 'col-lg-2 col-sm-4 col-md-4 col-xs-12';
			break;
	}
	
	$return .= "\n\t".'<div class="thememount-testimonial-box tm-box '. digitallaw_sanitize_html_classes($boxClass) .'">';
		
		$return .= '<div class="thememount-testimonial-data">';
		
		$iconCode = ( has_post_thumbnail() ) ? '<div class="thememount-testimonial-img">'.get_the_post_thumbnail( get_the_id(), 'thumbnail' ).'</div>'  :  '<span class="thememount-testimonial-icon"><i class="fa fa-quote-left"></i></span>';
		
		$return .= '<header>';
		$return .= ' '.$iconCode.' ';
		$return .= '<cite class="thememount-testimonial-title">';
		$return .= ( $clienturl!='' ) ? '<a href="' . esc_url($clienturl) . '" target="_blank">' . get_the_title() . '</a>' : get_the_title() ;
		$return .= ( $designation!='' ) ? '<span class="thememount-testimonial-designation">'.$designation.'</span>' : '' ;
		$return .= '</cite>';
		$return .= '</header>';
		
		
		$return .= '<blockquote class="thememount-testimonial-text">
						<div class="contarea">
							<div class="tm-quote"><i class="fa fa-quote-left"></i></div>															
							<div class="thememount-tst-contarea-text">'.get_the_content('').'</div>	
							<div class="tm-angle"></div>						
						</div>';		
		$return .= '</blockquote>';		
		

		
		
		$return .= '</div>';
	$return .= "\n\t".'</div>';
	
	return $return;
}
}
/* ********************* Function END ********************* */






/********************** Team Search Form ************************/
if( !function_exists('digitallaw_team_search_form') ){
function digitallaw_team_search_form($title='', $form_desc='', $search='', $submit_btn='', $form_type=''){
	
	$return = '';
	global $digitallaw_theme_options;
	
	// Team Group as Dropdown
	$dropDown     = '';
	$inputClass   = 'tm-wrap-cell';
	$termList     = get_terms( 'tm_team_group', array('hide_empty'=>false) );
	//$termList   = '';
	$noGroupClass = '';
	if( is_array($termList) && count($termList)>0 ){
		$inputClass = 'tm-wrap-cell tm-fbar-input';
		$dropDown .= '<div class="tm-wrap-cell tm-fbar-input"> <div class="search_field selectbox"> <i class="fa fa-tags"></i> <select name="team_group"> <option value="" class="select-empty">' . esc_attr__('All Sections', 'digitallaw') . '</option>';
		foreach( $termList as $term ){
			$selected = ( get_query_var('team_group') == $term->slug ) ? 'selected="selected"' : '' ;
			$dropDown .= '<option value="'.$term->slug.'" '.$selected.'>'.$term->name.'</option>'."\n";
		}
		$dropDown .= '</select></div></div>';
	} else {
		$noGroupClass = 'thememount-team-form-no-group';
		$inputClass   = 'tm-wrap-cell tm-fbar-input';
	}
	
	$wpmlHdn = '';
	if (defined('ICL_LANGUAGE_CODE')){
		$wpmlHdn = '<input type="hidden" name="lang" value="'.ICL_LANGUAGE_CODE.'"/>';
	}
	
	
	// Search title
	$lawyer_search_title = esc_attr__('Lawyer Search:', 'digitallaw');
	$lawyer_search_title = esc_attr($title);
	
	if( !empty($lawyer_search_title) ){
		$lawyer_search_title = '<h2>'. $lawyer_search_title .'</h2>';
	}
	
	
	// Text before form
	$text_before_form = '';
	if(!empty($form_desc)){
		$form_desc 		   = esc_attr($form_desc);
		$text_before_form .= '<div class="team-search-form-before-text">';
		$text_before_form .= do_shortcode($form_desc);
		$text_before_form .= '</div>';
	} 
	
	//Placeholder text for team name
	$tm_placeholder = esc_attr__('Search by name','digitallaw');
	if(!empty($search)){
		$tm_placeholder = esc_attr($search);
	}
	
	//Search Button Text
	$submit_button = esc_attr__('Search' , 'digitallaw');
	if(!empty($submit_btn)){
		$submit_button = esc_attr($submit_btn);
	}
	
	//Form type class 
	
	$formclass = 'tm-form-style-horizontal';
	if(!empty($form_type)){
		$formclass = 'tm-form-style-'.$form_type;
	}
	
	// Form
	$return .= '<div class="team-search-form-w '. sanitize_html_class($formclass) .'"><div class="team-search-form-inner-w">
		<form method="get" class="team-search-form '. sanitize_html_class($noGroupClass) .'" action="'.esc_url( home_url( '/' ) ).'">
					<input type="hidden" name="teamsearch" value="1">
					<input type="hidden" name="post_type" value="team_member" />
					'.$wpmlHdn.'
					<div class="tm-wrap">
						
						<div class="tm-team-search-title">
							'. $lawyer_search_title .'
						</div>
						'. $text_before_form .'
						<div class="'.  digitallaw_sanitize_html_classes($inputClass) .'">
							<div class="search_field by_name">
								<i class="fa fa-user"></i>
								<input type="text" placeholder="'.$tm_placeholder.'" name="s" value="'.get_search_query().'">
							</div>
						</div>
						
						'.$dropDown.'
						
						<div class="tm-wrap-cell">
							<div class="submit_field">
								<button type="submit">' . $submit_button . '</button>
							</div>
						</div>
						
					</div><!-- .row -->
					
				</form><!-- form end --> </div></div> ';
				
	return $return;
	
}
}
/*****************************************************************/





/**
 *  Portfolio Details
 */
if( !function_exists('digitallaw_portfolio_detailsbox') ){
function digitallaw_portfolio_detailsbox(){
	global $digitallaw_theme_options;
	$optionsArray = array(
						'pf_details_date',
						'pf_details_line1',
						'pf_details_line2',
						'pf_details_line3',
						'pf_details_line4',
						'pf_details_line5',
						'pf_details_cat',
	);
	
	// Creating variables
	foreach( $optionsArray as $option ){
		$option1 = $option.'_icon';
		if( isset($digitallaw_theme_options[$option1]) ){
			$$option1 = esc_attr($digitallaw_theme_options[$option1]);
		}
		$option2 = $option.'_title';
		if( isset($digitallaw_theme_options[$option2]) ){
			$$option2 = esc_attr($digitallaw_theme_options[$option2]);
		}
	}
	
	// Output starts
	$portfolio_project_details = $digitallaw_theme_options['portfolio_project_details'];
	echo '<div class="thememount-portfolio-details">';
	echo '<h2 class="tm-pf-title-details">' . esc_attr($portfolio_project_details) . '</h2>';
	echo '<ul class="thememount-portfolio-details-list">';
	
	
	
	foreach( $optionsArray as $option ){
		
		$curr_op_icon  = ${$option.'_icon'};
		$curr_op_title = ${$option.'_title'};
		
		$class = str_replace('_','-',$option);
		if( $option == 'pf_details_date' ){  // Date
			if( trim(${$option.'_title'})!='' ){ // checking if empty
				
				echo '
				<li class="tm-'.$class.'">
					<span class="tm-pf-left-details"><i class="' . $curr_op_icon . '"></i> ' . esc_attr( $curr_op_title) . '</span>
					<span class="tm-pf-right-details">' . get_the_date( 'd M Y' ) . '</span>
				</li>';
			}
			
		} else if( $option == 'pf_details_cat' ){  // Category
			if( trim(${$option.'_title'})!='' ){ // checking if empty
				echo '
				<li class="tm-'.$class.'">
					<span class="tm-pf-left-details"><i class="' . $curr_op_icon . '"></i> ' . esc_attr($curr_op_title) . '</span> ';
				echo '<span class="tm-pf-right-details">';
				$catList = wp_get_post_terms( get_the_ID(), 'tm_portfolio_category' );
				$x = 0;
				foreach( $catList as $cat ){
					if( $x!=0 ){ echo ', '; }
					echo '<span>' . $cat->name . '</span>';
					$x++;
				}
				echo '</span>';
				echo '</li>';
			}
			
		} else {  // Lines
			
			if( trim(${$option.'_title'})!='' ){ // checking if empty
				$line = get_post_meta( get_the_ID() , '_thememount_portfolio_data_'.$option.'_title');
				$line = ( is_array($line) && count($line)>0 ) ? $line[0] : $line ;
				$line = ( is_array($line) && count($line)==0 ) ? ''      : $line ;
				if( $line!='' ){
					echo '
					<li class="tm-'.$class.'">
						<span class="tm-pf-left-details"><i class="' . $curr_op_icon . '"></i> ' . esc_attr($curr_op_title) . '</span>
						<span class="tm-pf-right-details"> '.$line.' </span>
					</li>';
				}
			}
		}
	}
	echo '</ul>';
	
	
	
	// Button
	$portfolioLinkText = trim(get_post_meta( get_the_ID(),'_thememount_portfolio_data_linktext',true));
	$portfolioLinkUrl  = urlencode(trim(get_post_meta( get_the_ID(),'_thememount_portfolio_data_linkurl',true)));
	if( $portfolioLinkText!='' && $portfolioLinkUrl!='' ){
		echo '<div class="tm-pf-proj-btn">';
		echo do_shortcode('[vc_btn title="'.$portfolioLinkText.'" style="flat" align="center" i_icon_fontawesome="fa fa-external-link" link="url:'.$portfolioLinkUrl.'|target:%20_blank" add_icon="true"]');
		echo '</div>';
	}
	echo '</div> <!-- .portfolio-details --> ';
}	
}







if( !function_exists('digitallaw_get_social_links') ){
function digitallaw_get_social_links(){
	global $digitallaw_theme_options;
	$socialArray = array(
		'twitter'    => array( 'twitter', 'Twitter' ),
		'youtube'    => array( 'youtube', 'YouTube' ),
		'flickr'     => array( 'flickr', 'Flickr' ),
		'facebook'   => array( 'facebook', 'Facebook' ),
		'linkedin'   => array( 'linkedin', 'LinkedIn' ),
		'googleplus' => array( 'gplus', 'Google+' ),
		'yelp'       => array( 'yelp', 'Yelp' ),
		'dribbble'   => array( 'dribbble', 'Dribbble' ),
		'pinterest'  => array( 'pinterest', 'Pinterest' ),
		'podcast'    => array( 'podcast', 'Podcast' ),
		'instagram'  => array( 'instagram', 'Instagram' ),
		'xing'       => array( 'xing', 'Xing' ),
		'vimeo'      => array( 'vimeo', 'Vimeo' ),
		'vk'         => array( 'vk', 'VK' ),
		'houzz'      => array( 'houzz', 'Houzz' ),
		'issuu'      => array( 'issuu', 'Issuu' ),
		'google-drive' => array( 'google-drive', 'Google Drive' ),
		'rss'        => array( 'rss', 'RSS' ),
	);
	
	$return = '';
	foreach( $socialArray as $key=>$value ){
		
		if( $key == 'rss' ){
			if( isset($digitallaw_theme_options['rss']) && $digitallaw_theme_options['rss']=='1' ){
				$return .= '<li class="'.$key.'"><a target="_blank" href="'.get_bloginfo('rss2_url').'" class="hint--bottom" data-hint="'.$value[1].'"><i class="tm-social-icon-'.$value[0].'"></i></a></li>';
			}
		} else {
			if( isset($digitallaw_theme_options[$key]) && trim($digitallaw_theme_options[$key])!='' ){
				$return .= '<li class="'.$key.'"><a target="_blank" href="'.esc_url($digitallaw_theme_options[$key]).'" class="hint--bottom" data-hint="'.$value[1].'"><i class="tm-social-icon-'.$value[0].'"></i></a></li>';
			}
		}
	}
	
	if( $return!='' ){
		$return = '<ul class="social-icons">'.$return.'</ul>';
	}
	
	return $return;
}
}






/*************** Set primary Class for #primary ******************/
if( !function_exists('digitallaw_setPrimaryClass') ){
function digitallaw_setPrimaryClass($sidebar){
	$primaryclass = 'col-md-12 col-lg-12 col-sm-12 col-xs-12';
	switch($sidebar){
		case 'left':
		case 'right':
			$primaryclass = 'col-md-9 col-lg-9 col-xs-12';
			break;
		case 'both':
		case 'bothleft':
		case 'bothright':
			$primaryclass = 'col-md-6 col-lg-6 col-xs-12';
			break;
	}
	return $primaryclass;
}
}
/*****************************************************************/




/*
 *  Check if color is dark. This is new version. This will return TRUE if dark color.
 */
if( !function_exists('digitallaw_check_dark_color') ){
function digitallaw_check_dark_color($hex){
	//$hex = "78ff2f"; //Bg color in hex, without any prefixing #!
	
	// strip off any leading #
	$hex = str_replace('#', '', $hex);

	//break up the color in its RGB components
	$r = hexdec(substr($hex,0,2));
	$g = hexdec(substr($hex,2,2));
	$b = hexdec(substr($hex,4,2));

	//do simple weighted avarage
	//
	//(This might be overly simplistic as different colors are perceived
	// differently. That is a green of 128 might be brighter than a red of 128.
	// But as long as it's just about picking a white or black text color...)
	if($r + $g + $b > 382){
		return false;
		//bright color, use dark font
	}else{
		return true;
		//dark color, use bright font
	}
}
}



/************* HEX to RGB converter for CSS color ****************/
if( !function_exists('digitallaw_hex2rgb') ){
function digitallaw_hex2rgb($hex) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);
	return implode(",", $rgb); // returns the rgb values separated by commas
}
}
/*****************************************************************/






/*********** Portfolio: Getting Featured Slider / Video or Image ***********/
if( !function_exists('digitallaw_get_portfolio_featured_content') ){
function digitallaw_get_portfolio_featured_content(){
	global $digitallaw_theme_options;
	$featuredtype    = get_post_meta(get_the_ID(), '_thememount_portfolio_featured_featuredtype', true);
	$featuredtype    = $featuredtype[0];
	$startDiv = '<div>';
	$endDiv   = '</div>';
	
	switch($featuredtype){
		case 'image':
		default:
			if( has_post_thumbnail(get_the_ID()) ){
				
				$final_output  = $startDiv;
				$final_output .= get_the_post_thumbnail( get_the_ID(), 'full' );
				$final_output .=  $endDiv;
				
				// applying filter
				echo wp_kses( /* HTML Filter */
					$final_output,
					array(
						'div' => array(
							'class' => array()
						),
						'span' => array(
							'class' => array()
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
				
				
				
				
			} else {
				
				

			}
			break;
			
		case 'video':
		
			$final_output  = $startDiv;
			$final_output .= '<div class="fluid-video mediabox">' . digitallaw_get_embed_code( get_post_meta( get_the_ID(), '_thememount_portfolio_featured_videourl', true) ) . '</div>';
			$final_output .=  $endDiv;
			
			echo wp_kses( /* HTML Filter */
				$final_output,
				array(
					'div' => array(
						'class' => array()
					),
					'img' => array(
						'class'  => array(),
						'src'    => array(),
						'alt'    => array(),
						'title'  => array(),
						'width'  => array(),
						'height' => array(),
					),
					'iframe' => array(
						'class'  => array(),
						'src'    => array(),
						'alt'    => array(),
						'title'  => array(),
						'width'  => array(),
						'height' => array(),
					),
				)
			);
			
			
			break;
			
		case 'audioembed':
			
			$final_output  = $startDiv;
			$final_output .= '<div class="fluid-audio">' . get_post_meta(get_the_ID(), '_thememount_portfolio_featured_audiocode', true).'</div>';
			$final_output .=  $endDiv;
			
			echo wp_kses( /* HTML Filter */
				$final_output,
				array(
					'div' => array(
						'class' => array()
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
			
			
			
			break;
			
		case 'slider':
			
			$final_output  = $startDiv;
			$final_output .= digitallaw_featured_gallery_slider( 'portfolio' );
			$final_output .=  $endDiv;
			
			echo wp_kses( /* HTML Filter */
				$final_output,
				array(
					'ul' => array(
						'class' => array()
					),
					'li' => array(
						'class' => array()
					),
					'span' => array(
						'class' => array()
					),
					'div' => array(
						'class' => array()
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
			
			
			
			break;
	}

}
}
/*******************************************************************/






/********************** Get YouTube/Vimeo embed code *************************/
if( !function_exists('digitallaw_get_embed_code') ){
	function digitallaw_get_embed_code($url, $echo = false){
		$width  = '853';
		$height = '480';
		if( $echo == true ){
			echo wp_oembed_get($url);
		} else {
			return wp_oembed_get($url);
		}
	}
}
/*****************************************************************************/
















/********************  Darken/Lighten HEX color ***********************/
if( !function_exists('digitallaw_adjustBrightness') ){
function digitallaw_adjustBrightness($hex, $steps) {
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max(-255, min(255, $steps));

    // Format the hex color string
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }

    // Get decimal values
    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));

    // Adjust number of steps and keep it inside 0 to 255
    $r = max(0,min(255,$r + $steps));
    $g = max(0,min(255,$g + $steps));  
    $b = max(0,min(255,$b + $steps));

    $r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
    $g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
    $b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);

    return '#'.$r_hex.$g_hex.$b_hex;
}
}
/**********************************************************************/










/************************ Breadcrumb Function **************************/
if( !function_exists('digitallaw_get_breadcrumb_navigation') ){
function digitallaw_get_breadcrumb_navigation() {
	$return = '';
	/* === OPTIONS === */
	$text['home']     = 'Home'; // text for the 'Home' link
	$text['category'] = 'Archive by Category "%s"'; // text for a category page
	$text['search']   = 'Search Results for "%s" Query'; // text for a search results page
	$text['tag']      = 'Posts Tagged "%s"'; // text for a tag page
	$text['author']   = 'Articles Posted by %s'; // text for an author page
	$text['404']      = 'Error 404'; // text for the 404 page

	$show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
	$show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
	$show_title     = 1; // 1 - show the title for the links, 0 - don't show
	$delimiter      = ' / '; // delimiter between crumbs
	$before         = '<span class="current">'; // tag before the current crumb
	$after          = '</span>'; // tag after the current crumb
	/* === END OF OPTIONS === */

	global $post;
	$link_before  = '<span typeof="v:Breadcrumb">';
	$link_after   = '</span>';
	$link_attr    = ' rel="v:url" property="v:title"';
	$link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
	$parent_id = NULL;
	if( isset($post) ){
		$parent_id    = $parent_id_2 = $post->post_parent;
	}
	$frontpage_id = get_option('page_on_front');

	if (is_home() || is_front_page()) {

		if ($show_on_home == 1) $return .= '<div class="breadcrumbs"><a href="' . esc_url( home_url('/') ) . '">' . $text['home'] . '</a></div>';

	} else {

		$return .= '<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';
		if ($show_home_link == 1) {
			$return .= '<a href="' . esc_url( home_url('/') ) . '" rel="v:url" property="v:title">' . $text['home'] . '</a>';
			if ($frontpage_id == 0 || $parent_id != $frontpage_id) $return .= $delimiter;
		}

		if ( is_category() ) {
			$this_cat = get_category(get_query_var('cat'), false);
			if ($this_cat->parent != 0) {
				$cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				$return .= $cats;
			}
			if ($show_current == 1) $return .= $before . sprintf($text['category'], single_cat_title('', false)) . $after;

		} elseif ( is_search() ) {
			$return .= $before . sprintf($text['search'], get_search_query()) . $after;

		} elseif ( is_day() ) {
			$return .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			$return .= sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
			$return .= $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			$return .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			$return .= $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			$return .= $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				$return .= sprintf($link, esc_url( home_url('/') ) . '' . $slug['slug'] . '/', $post_type->labels->singular_name);
				if ($show_current == 1) $return .= $delimiter . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				$return .= $cats;
				if ($show_current == 1) $return .= $before . get_the_title() . $after;
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			$return .= $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($parent_id);
			$return .= sprintf($link, get_permalink($parent), $parent->post_title);
			if ($show_current == 1) $return .= $delimiter . $before . get_the_title() . $after;
		} elseif ( is_page() && !$parent_id ) {
			if ($show_current == 1) $return .= $before . get_the_title() . $after;

		} elseif ( is_page() && $parent_id ) {
			if ($parent_id != $frontpage_id) {
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					if ($parent_id != $frontpage_id) {
						$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					}
					$parent_id = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					$return .= $breadcrumbs[$i];
					if ($i != count($breadcrumbs)-1) $return .= $delimiter;
				}
			}
			if ($show_current == 1) {
				if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) $return .= $delimiter;
				$return .= $before . get_the_title() . $after;
			}

		} elseif ( is_tag() ) {
			$return .= $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

		} elseif ( is_author() ) {
	 		global $author;
			$userdata = get_userdata($author);
			$return .= $before . sprintf($text['author'], $userdata->display_name) . $after;

		} elseif ( is_404() ) {
			$return .= $before . $text['404'] . $after;
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $return .= ' (';
			$return .= esc_attr__('Page', 'digitallaw') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $return .= ')';
		}

		$return .= '</div><!-- .breadcrumbs -->';
	
		return $return;
	}
} // end digitallaw_get_breadcrumb_navigation()
}
/***********************************************************************/






/*
 *  Events Box
 */
 if( !function_exists('digitallaw_eventsbox') ){
function digitallaw_eventsbox( $column='four', $design="default" ){
	
	$return = '';
	
	if( !function_exists('tribe_get_start_date') ){
		
		return;
	}
	
	
	if( $design=="detailed" ){
		$start_date       = tribe_get_start_date( null, false, 'c' );
		$start_date_date  = tribe_get_start_date( null, false, 'j' );
		$start_date_month = tribe_get_start_date( null, false, 'M' );
		$start_date_year  = tribe_get_start_date( null, false, ', Y' );
		
		
		
		// Date Box
		$title            = '<h4><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';
		
		$date = '<div class="thememount-postbox-small-date"><div class="thememount-post-box-date-wrapper">';
		$date .= sprintf( '<div class="thememount-entry-date-wrapper">
								<span class="thememount-entry-date">
									<time class="entry-date" datetime="%1$s" >
										<span class="entry-date">%2$s</span> 
										<span class="entry-month">%3$s</span> 
										<span class="entry-year">%4$s</span> 
									</time>
								</span>
							</div>',
			$start_date,
			$start_date_date,
			$start_date_month,
			$start_date_year
		);
		$date .= '</div></div>';
		
		$featuredLink     = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
		$featuredImgURL   = $featuredLink[0];
		$featuredLinkArea = '';
		$featuredContent  = '';
		
		if( has_post_thumbnail() ){
			$featuredContent = get_the_post_thumbnail( get_the_ID(), 'digitallaw-portfolio-'.$column.'-column' );
		} else {
			$featuredContent = '';
		}

		
		switch($column){
			case 'one':
				$boxClass = 'col-lg-12 col-sm-12 col-md-12 col-xs-12';
				break;
			case 'two':
				$boxClass = 'col-lg-6 col-sm-6 col-md-6 col-xs-12';
				break;
			case 'three':
				$boxClass = 'col-lg-4 col-sm-6 col-md-4 col-xs-12';
				break;
			case 'four':
			default:
				$boxClass = 'col-lg-3 col-sm-6 col-md-3 col-xs-12';
				break;
			case 'five':
				$boxClass = 'col-lg-20percent col-sm-4 col-md-4 col-xs-12';
				break;
			case 'six':
				$boxClass = 'col-lg-2 col-sm-4 col-md-4 col-xs-12';
				break;
			case 'mix':
				$boxClass = 'col-lg-3 col-sm-6 col-md-3 col-xs-12';
				break;
			case 'fix':
				$boxClass = 'blog-slider-box-width';
				break;
		}
		
		
		
		/***************************/
		$slugs = wp_get_post_terms( get_the_ID(), 'category', array("fields" => "slug"));
		$slugs   = implode( ' ', $slugs );
		
		
		/* Short Description */
		$description = '';
		$readMore    = esc_attr__('See Event', 'digitallaw') . ' <i class="kwicon-fa-angle-right"></i>';
		if( has_excerpt() ){
			$description  = get_the_excerpt();
			$description .= digitallaw_wrap_readmore('<a href="'.get_permalink().'">'.$readMore.'</a>');
		} else {
			global $more;
			$more = 0;
			$description = get_the_content( $readMore );
		}
		
		$categories_list = get_the_category_list( esc_attr__( ', ', 'digitallaw' ) ); // Translators: used between list items, there is a space after the comma.
		$categories_list = ( $categories_list ) ? '<span class="categories-links"><i class="kwicon-fa-folder-open"></i> ' . $categories_list . '</span>' : '' ;
		
		$comments = wp_count_comments(); $comments = $comments->approved; //Get Total Comments
		$commentsCode = '';
		if( $comments > 0 ){
			$commentsCode  = '<span class="comments"><i class="kwicon-fa-comment"></i> '.get_comments_number( 'no comments', '1', '%' ).'</span>';
		}
		 
		$metaDetails = '';
		if( $column != 'one' && ($categories_list!='' || $comments!='') ){
			$metaDetails = '<div class="entry-meta thememount-eventbox-entry-meta"><div class="thememount-meta-details">' . $categories_list . '</div></div>';
		}
		
		
		$return .= '
			<article class="post-box post-box-event ' . digitallaw_sanitize_html_classes($boxClass) . ' ' . digitallaw_sanitize_html_classes($slugs) . '">
				<div class="post-item">
					<div class="post-item-thumbnail">
						<div class="post-item-thumbnail-inner">
							' . $featuredContent . '
						</div>
						<div class="overthumb"></div>
						' . $featuredLinkArea . '
					</div>
					<div class="item-content">
						'.$title.'
						'.digitallaw_event_meta().'
						<div class="thememount-eventbox-desc">' . $description . '</div>
					</div>
				</div>
			</article>
		';

	} else {
		
		switch($column){
			case 'one':
				$boxClass = 'col-lg-12 col-sm-12 col-md-12 col-xs-12';
				break;
			case 'two':
				$boxClass = 'col-lg-6 col-sm-6 col-md-6 col-xs-12';
				break;
			case 'three':
				$boxClass = 'col-lg-4 col-sm-6 col-md-4 col-xs-12';
				break;
			case 'four':
			default:
				$boxClass = 'col-lg-3 col-sm-6 col-md-3 col-xs-12';
				break;
			case 'five':
				$boxClass = 'col-lg-20percent col-sm-4 col-md-4 col-xs-12';
				break;
			case 'six':
				$boxClass = 'col-lg-2 col-sm-4 col-md-4 col-xs-12';
				break;
			case 'mix':
				$boxClass = 'col-lg-3 col-sm-6 col-md-3 col-xs-12';
				break;
			case 'fix':
				$boxClass = 'blog-slider-box-width';
				break;
		}

		//  Featured Image
		if( has_post_thumbnail() ){
			$featuredImg = '<a href="' . get_permalink() . '">'.get_the_post_thumbnail( get_the_ID(), 'digitallaw-portfolio-'.$column.'-column' ).'</a>';
		} else {
			$featuredImg = '<div class="thememount-proj-noimage"><i class="fa fa-picture-o"></i></div>';
		}
		
		$price = '';
		if( function_exists('tribe_get_formatted_cost') ){
			$cost = tribe_get_formatted_cost();
			if ( ! empty( $cost ) ){
				$price = '<div class="tribe-events-event-cost"> ' . esc_html( tribe_get_formatted_cost() ) . ' </div>';
			}
		}

		$return .= '
			<article class="events-box ' . digitallaw_sanitize_html_classes($boxClass) . ' thememount-box">
				<div class="item">
					<div class="item-thumbnail">
						' . $price . '
						' . $featuredImg . '
					</div>
					<div class="item-content">					
						<h4><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>
					</div>
				</div>
			</article>
		';
	}
	
	return $return;
	
}// Function End
}







if( !function_exists('digitallaw_event_meta') ){
function digitallaw_event_meta(){
	$return = '';
	$price = '';
	
	
	$time_format = get_option( 'time_format', Tribe__Date_Utils::TIMEFORMAT );
	$time_range_separator = tribe_get_option( 'timeRangeSeparator', ' - ' );

	$start_datetime = tribe_get_start_date();
	$start_date = tribe_get_start_date( null, false );
	$start_time = tribe_get_start_date( null, false, $time_format );
	$start_ts = tribe_get_start_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

	$end_datetime = tribe_get_end_date();
	$end_date = tribe_get_end_date( null, false );
	$end_time = tribe_get_end_date( null, false, $time_format );
	$end_ts = tribe_get_end_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );
	
	if( function_exists('tribe_get_formatted_cost') ){
		$cost = tribe_get_formatted_cost();
		if ( ! empty( $cost ) ){
			$price = '<span class="tribe-events-event-cost"> ' . esc_html( tribe_get_formatted_cost() ) . ' </span>';
		}
	}
	
	
	
	
	
	$return .= '<div class="thememount-meta-details thememount-event-meta-details">';
		$return .= '<span class="thememount-event-meta-item thememount-event-date"> ';
			$return .= '<i class="fa fa-clock-o"></i> ';
			// All day (multiday) events
			if ( tribe_event_is_all_day() && tribe_event_is_multiday() ){
				

				$return .= '
					<span class="thememount-event-meta-dtstart" title="' . esc_attr( $start_ts ) . '"> ' .  esc_attr( $start_date ) . ' </span> - 
					<span class="thememount-event-meta-dtend" title="' . esc_attr( $end_ts ) . '"> ' . esc_attr( $end_date ) . ' </span>';

			
			// All day (single day) events
			} elseif ( tribe_event_is_all_day() ){
				$return .= '<span class="thememount-event-meta-onedate" title="'. esc_attr( $start_ts ) . '"> ' . esc_attr( $start_date ) . '</span>';

			
			// Multiday events
			} elseif ( tribe_event_is_multiday() ){
				
				$return .= '<span class="thememount-event-meta-dtstart" title="' . esc_attr( $start_ts ) . '"> ' . esc_attr( $start_datetime ) . ' </span> - ';
				$return .= '<span class="thememount-event-meta-dtend" title="' . esc_attr( $end_ts ) . '"> ' .  esc_attr( $end_datetime ) .' </span>';


			// Single day events
			} else {
				
				$return .= '<span class="thememount-event-meta-dtstart" title="' . esc_attr( $start_ts ) . '"> ' . esc_attr( $start_date ) . ' </span> - ';

				$return .= '<span class="thememount-event-meta-dtend" title="' . esc_attr( $end_ts ) . '">';
					if ( $start_time == $end_time ) {
						$return .= esc_attr( $start_time );
					} else {
						$var_diff_time = $start_time . $time_range_separator . $end_time;
						$return .= esc_attr( $var_diff_time );
					}

				$return .=' </span>';
			}
		$return .=' </span>';
		$return .= '
			&nbsp;&nbsp; <span class="thememount-event-meta-item thememount-event-price">
				'.$price.'
			</span>';
	$return .= '</div>';
	return $return;
}
}







if( !function_exists('digitallaw_addhttp') ){
	function digitallaw_addhttp($url){
		if (!preg_match("~^(?:f|ht)tps?://~i", $url)){
			$url = "http://" . $url;
		}
		return $url;
	}
}





if( !function_exists('digitallaw_get_short_desc') ){
function digitallaw_get_short_desc(){
	global $digitallaw_theme_options;
	$content = '';
	if( !empty( $digitallaw_theme_options['blog_text_limit'] ) && esc_attr($digitallaw_theme_options['blog_text_limit']) > 0 ){
		$content = get_the_content('',FALSE,'');
		$content = wp_strip_all_tags($content);
		$content = strip_shortcodes($content);
		$content = str_replace(']]>', ']]>', $content);
		//$content = substr($content,0, $digitallaw_theme_options['blog_text_limit'] );
		$content = mb_substr($content,0, esc_attr($digitallaw_theme_options['blog_text_limit']), 'UTF-8' );
		$content = trim(preg_replace( '/\s+/', ' ', $content));
		$content = $content.'...';
	}
	return $content;
}
}


/******************** CSS Parser *********************/

if( !function_exists('digitallaw_CheckBGImage') ){
function digitallaw_CheckBGImage($css){
	$return = false;
	
	if( trim($css)!='' ){
		
		// Check if background image exists
		$newCSS = str_replace( 'http://', 'http//', $css );

		// Removing breackets
		$newCSS = explode('{', $newCSS);
		$newCSS = explode('}', $newCSS[1]);
		$newCSS = $newCSS[0];

		// Filtering background properties
		$newCSS = explode(';', $newCSS);

		foreach( $newCSS as $css ){
			$x = '';
			$x = explode(':', $css);
			if( $x[0] == 'background' ){
				if (strpos($x[1] , 'url(') !== false) {
					$return = true;
				}
			} else if( $x[0] == 'background-image' ){
				$return = true;
			}
		}
	}
	
	return $return;
}
}

/******************************************************/





/*
 *  Max Mega Menu : Default theme setup
 */
if( !function_exists('digitallaw_mmmenu_theme_setup') ){
function digitallaw_mmmenu_theme_setup(){
	$megamenu_themes       = get_option('megamenu_themes');
	$tm_mmmenu_theme_saved = get_option('tm_mmmenu_theme_saved');
	
	if( $tm_mmmenu_theme_saved!=='yes' ){
		$megamenu_themes['default'] = array(
			"title" => "Default",
			"arrow_up" => "dash-f343",
			"arrow_down" => "dash-f347",
			"arrow_left" => "dash-f341",
			"arrow_right" => "dash-f345",
			"responsive_breakpoint" => "1200px",
			"responsive_text" => "",
			"line_height" => "1.7",
			"z_index" => "999",
			"shadow_horizontal" => "0px",
			"shadow_vertical" => "0px",
			"shadow_blur" => "5px",
			"shadow_spread" => "0px",
			"shadow_color" => "rgba(0, 0, 0, 0.1)",
			"container_background_from" =>  "rgba(34, 34, 34, 0)",
			"container_background_to" =>  "rgba(34, 34, 34, 0)",
			"container_padding_top" => "0px",
			"container_padding_right" => "0px",
			"container_padding_bottom" => "0px",
			"container_padding_left" => "0px",
			"container_border_radius_top_left" => "0px",
			"container_border_radius_top_right" => "0px",
			"container_border_radius_bottom_right" => "0px",
			"container_border_radius_bottom_left" => "0px",
			"menu_item_align" => "left",
			"menu_item_background_from" => "rgba(0,0,0,0)",
			"menu_item_background_to" => "rgba(0,0,0,0)",
			"menu_item_background_hover_from" => "#333",
			"menu_item_background_hover_to" => "#333",
			"menu_item_spacing" => "0px",
			"menu_item_link_height" => "40px",
			"menu_item_link_color" => "#ffffff",
			"menu_item_link_font_size" => "14px",
			"menu_item_link_font" => "inherit",
			"menu_item_link_text_transform" => "none",
			"menu_item_link_weight" => "normal",
			"menu_item_link_text_decoration" => "none",
			"menu_item_link_color_hover" => "#ffffff",
			"menu_item_link_weight_hover" => "bold",
			"menu_item_link_text_decoration_hover" => "none",
			"menu_item_link_padding_top" => "0px",
			"menu_item_link_padding_right" => "10px",
			"menu_item_link_padding_bottom" => "0px",
			"menu_item_link_padding_left" => "10px",
			"menu_item_border_color" => "#fff",
			"menu_item_border_top" => "0px",
			"menu_item_border_right" => "0px",
			"menu_item_border_bottom" => "0px",
			"menu_item_border_left" => "0px",
			"menu_item_border_color_hover" => "#fff",
			"menu_item_link_border_radius_top_left" => "0px",
			"menu_item_link_border_radius_top_right" => "0px",
			"menu_item_link_border_radius_bottom_right" => "0px",
			"menu_item_link_border_radius_bottom_left" => "0px",
			"menu_item_divider_color" => "rgba(255, 255, 255, 0.1)",
			"menu_item_divider_glow_opacity" => "0.1",
			"panel_background_from" => "#f1f1f1",
			"panel_background_to" => "#f1f1f1",
			"panel_width" => "100%",
			"panel_padding_top" => "0px",
			"panel_padding_right" => "0px",
			"panel_padding_bottom" => "0px",
			"panel_padding_left" => "0px",
			"panel_border_color" => "#fff",
			"panel_border_top" => "0px",
			"panel_border_right" => "0px",
			"panel_border_bottom" => "0px",
			"panel_border_left" => "0px",
			"panel_border_radius_top_left" => "0px",
			"panel_border_radius_top_right" => "0px",
			"panel_border_radius_bottom_right" => "0px",
			"panel_border_radius_bottom_left" => "0px",
			"panel_widget_padding_top" => "15px",
			"panel_widget_padding_right" => "15px",
			"panel_widget_padding_bottom" => "15px",
			"panel_widget_padding_left" => "15px",
			"panel_header_color" => "#555",
			"panel_header_font_size" => "16px",
			"panel_header_font" => "inherit",
			"panel_header_font_weight" => "bold",
			"panel_header_text_transform" => "uppercase",
			"panel_header_text_decoration" => "none",
			"panel_font_color" => "#666",
			"panel_font_size" => "14px",
			"panel_font_family" => "inherit",
			"panel_header_padding_top" => "0px",
			"panel_header_padding_right" => "0px",
			"panel_header_padding_bottom" => "5px",
			"panel_header_padding_left" => "0px",
			"panel_header_margin_top" => "0px",
			"panel_header_margin_right" => "0px",
			"panel_header_margin_bottom" => "0px",
			"panel_header_margin_left" => "0px",
			"panel_header_border_color" => "#555",
			"panel_header_border_top" => "0px",
			"panel_header_border_right" => "0px",
			"panel_header_border_bottom" => "0px",
			"panel_header_border_left" => "0px",
			"panel_second_level_font_color" => "#555",
			"panel_second_level_font_size" => "16px",
			"panel_second_level_font" => "inherit",
			"panel_second_level_font_weight" => "bold",
			"panel_second_level_text_transform" => "uppercase",
			"panel_second_level_text_decoration" => "none",
			"panel_second_level_font_color_hover" => "#555",
			"panel_second_level_font_weight_hover" => "bold",
			"panel_second_level_text_decoration_hover" => "none",
			"panel_second_level_background_hover_from" => "rgba(0,0,0,0)",
			"panel_second_level_background_hover_to" => "rgba(0,0,0,0)",
			"panel_second_level_padding_top" => "0px",
			"panel_second_level_padding_right" => "0px",
			"panel_second_level_padding_bottom" => "0px",
			"panel_second_level_padding_left" => "0px",
			"panel_second_level_margin_top" => "0px",
			"panel_second_level_margin_right" => "0px",
			"panel_second_level_margin_bottom" => "0px",
			"panel_second_level_margin_left" => "0px",
			"panel_second_level_border_color" => "#555",
			"panel_second_level_border_top" => "0px",
			"panel_second_level_border_right" => "0px",
			"panel_second_level_border_bottom" => "0px",
			"panel_second_level_border_left" => "0px",
			"panel_third_level_font_color" => "#666",
			"panel_third_level_font_size" => "14px",
			"panel_third_level_font" => "inherit",
			"panel_third_level_font_weight" => "normal",
			"panel_third_level_text_transform" => "none",
			"panel_third_level_text_decoration" => "none",
			"panel_third_level_font_color_hover" => "#666",
			"panel_third_level_font_weight_hover" => "normal",
			"panel_third_level_text_decoration_hover" => "none",
			"panel_third_level_background_hover_from" => "rgba(0,0,0,0)",
			"panel_third_level_background_hover_to" => "rgba(0,0,0,0)",
			"panel_third_level_padding_top" => "0px",
			"panel_third_level_padding_right" => "0px",
			"panel_third_level_padding_bottom" => "0px",
			"panel_third_level_padding_left" => "0px",
			"flyout_menu_background_from" => "#f1f1f1",
			"flyout_menu_background_to" => "#f1f1f1",
			"flyout_width" => "150px",
			"flyout_padding_top" => "0px",
			"flyout_padding_right" => "0px",
			"flyout_padding_bottom" => "0px",
			"flyout_padding_left" => "0px",
			"flyout_border_color" => "#ffffff",
			"flyout_border_top" => "0px",
			"flyout_border_right" => "0px",
			"flyout_border_bottom" => "0px",
			"flyout_border_left" => "0px",
			"flyout_border_radius_top_left" => "0px",
			"flyout_border_radius_top_right" => "0px",
			"flyout_border_radius_bottom_right" => "0px",
			"flyout_border_radius_bottom_left" => "0px",
			"flyout_background_from" => "#f1f1f1",
			"flyout_background_to" => "#f1f1f1",
			"flyout_background_hover_from" => "#dddddd",
			"flyout_background_hover_to" => "#dddddd",
			"flyout_link_height" => "35px",
			"flyout_link_padding_top" => "0px",
			"flyout_link_padding_right" => "10px",
			"flyout_link_padding_bottom" => "0px",
			"flyout_link_padding_left" => "10px",
			"flyout_link_color" => "#666",
			"flyout_link_size" => "14px",
			"flyout_link_family" => "inherit",
			"flyout_link_text_transform" => "none",
			"flyout_link_weight" => "normal",
			"flyout_link_text_decoration" => "none",
			"flyout_link_color_hover" => "#666",
			"flyout_link_weight_hover" => "normal",
			"flyout_link_text_decoration_hover" => "none",
			"flyout_menu_item_divider_color" =>  "rgba(255, 255, 255, 0.1)",
			"custom_css" => '#{$wrap} #{$menu} {
			/** Custom styles should be added below this line **/
			}
			#{$wrap} { 
			clear: both;
			}'
		);
		
		//  Saving new theme
		update_option('megamenu_themes', $megamenu_themes);
		update_option('tm_mmmenu_theme_saved', 'yes');
	}
}  // function digitallaw_mmmenu_theme_setup()
}


/**
 *  Team Member appointment button
 */
if( !function_exists('digitallaw_team_appointment_btn') ){
function digitallaw_team_appointment_btn(){
	$return = '';
	
	$btn_text = trim(get_post_meta( get_the_id(), '_thememount_team_member_details_btn_text', true ));
	$btn_link = trim(get_post_meta( get_the_id(), '_thememount_team_member_details_btn_link', true ));
	
	if( !empty($btn_text) && !empty($btn_link) ){
		$return .= '
		<div class="tm-team-member-appointment-btn-wrapper">
			<div class="vc_btn3-container vc_btn3-left">
				<a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-classic vc_btn3-color-skincolor" href="'. esc_url($btn_link) .'" title="'. esc_attr($btn_text) .'" target="_self">'. esc_attr($btn_text) .'</a>
			</div><!-- .vc_btn3-container.vc_btn3-left -->
		</div><!-- .tm-team-member-appointment-btn-wrapper -->  ';
	}
	
	return $return;
	
}
}





/**
 *  Portfolio - Social share icons
 */
if( !function_exists('digitallaw_pf_social_share_icons') ){
function digitallaw_pf_social_share_icons(){
	global $digitallaw_theme_options;
	$return = '';
	
	if( !empty($digitallaw_theme_options['pf_single_social_share']) && is_array($digitallaw_theme_options['pf_single_social_share']) && count($digitallaw_theme_options['pf_single_social_share'])>0 ){ // we are not esc_attr this as it is array
		
		foreach ( $digitallaw_theme_options['pf_single_social_share'] as $social=>$status ){
			if( $status=='1' ){
				
				// setting link
				switch($social){
					case 'facebook':
						$link = '//web.facebook.com/sharer/sharer.php?u='.urlencode(get_permalink()). '&_rdr';
						break;
						
					case 'twitter':
						$link = '//twitter.com/share?url='. get_permalink();
						break;
					
					case 'gplus':
						$link = '//plus.google.com/share?url='. get_permalink();
						break;
					
					case 'pinterest':
						$link = '//www.pinterest.com/pin/create/button/?url='. get_permalink();
						break;
						
					case 'linkedin':
						$link = '//www.linkedin.com/shareArticle?mini=true&url='. get_permalink();
						break;
						
					case 'stumbleupon':
						$link = '//stumbleupon.com/submit?url='. get_permalink();
						break;
					
					case 'tumblr':
						$link = '//tumblr.com/share/link?url='. get_permalink();
						break;
						
					case 'reddit':
						$link = '//reddit.com/submit?url='. get_permalink();
						break;
						
					case 'digg':
						$link = '//www.digg.com/submit?url='. get_permalink();
						break;
						
				} // switch end here
				
				
				// Now preparing the icon
				$return .= '<li class="tm-social-share tm-social-share-'. $social .'">
				<a href="#" onClick="TMSocialWindow=window.open(\''. esc_url($link) .'\',\'TMSocialWindow\',width=600,height=100); return false;"><i class="tm-social-icon-'. sanitize_html_class($social) .'"></i></a>
				</li>';
				
			} // if
			
		}  //  foreach
		
		
		// preparing final output
		if( $return != '' ){
			$return = '<div class="tm-social-share-w"><ul>'. $return .'</ul></div>';
		}
		
		
	} // if
	
	return $return;
	
}
}




if( !function_exists('digitallaw_pf_single_np') ){
function digitallaw_pf_single_np(){
	$return = '';
	
	
	$prev_link = get_permalink(get_adjacent_post(false,'',false));
	$next_link = get_permalink(get_adjacent_post(false,'',true));
	
	if( !empty($prev_link) ){
		$return .= ' <span class="tm-pf-next-posts">'. do_shortcode( '[vc_btn title="'. esc_attr__('Previous', 'digitallaw') .'" style="flat" size="sm" btniconposition="no" btnicon="fa-adjust" link="url:'. urlencode($prev_link) .'||"]' ) .'</span> ';
	}
	
	if( !empty($next_link) ){
		$return .= '&nbsp; &nbsp; <span class="tm-pf-prev-posts">'. do_shortcode( '[vc_btn title="'. esc_attr__('Next', 'digitallaw') .'" style="flat" size="sm" btniconposition="no" btnicon="fa-adjust" link="url:'. urlencode($next_link) .'||"]' ) .'</span> ';
	}
	
	if( !empty($return) ){ $return = '<div class="tm-pf-navigation">'. $return .'</div>'; }
	return $return;
}
}





 
 
 




if( !function_exists('digitallaw_change_heading_order') ){
function digitallaw_change_heading_order($input_code=''){
	// finding and fetching <h2> and <h4> tag
	preg_match("/<h2>(.*?)<\/h2>/", $input_code, $h2_output_array);
	preg_match("/<h4>(.*?)<\/h4>/", $input_code, $h4_output_array);

	// now checking if both tags are available
	if( !empty($h2_output_array) && is_array($h2_output_array) && count($h2_output_array)==2 &&
	!empty($h4_output_array) && is_array($h4_output_array) && count($h4_output_array)==2 ){
		$input_code = preg_replace('/<h4>(.*?)<\/h4>/', '', $input_code);
		$replace_word = $h4_output_array[0];
		$input_code = str_replace( '<h2>' , $replace_word.'<h2>' , $input_code );
	}

	return $input_code;

}
}


 




/*
 *  WooCommerce Settings
 */
require_once(get_template_directory().'/inc/woocommerce.php');





/*
 *  MaxMegaMenu default theme setup
 */
digitallaw_mmmenu_theme_setup();






/**
 * Disable responsive image support (test!)
 */
// Clean the up the image from wp_get_attachment_image()


// Override the calculated image sizes
add_filter( 'wp_calculate_image_sizes', '__return_false',  PHP_INT_MAX );

// Override the calculated image sources
add_filter( 'wp_calculate_image_srcset', '__return_false', PHP_INT_MAX );







/*
 *  Creating default array 
 */
if( !function_exists('digitallaw_redux_load_default_options') ){
function digitallaw_redux_load_default_options(){
	global $digitallaw_theme_options;
	if( !is_array($digitallaw_theme_options) ){
		$digitallaw_theme_options = array();
		include get_template_directory() . '/inc/redux-options-array.php';
		$all_options = digitallaw_theme_options_array();
		foreach( $all_options as $section ){
			if( isset($section['fields']) && is_array($section['fields']) ){
				foreach( $section['fields'] as $field ){
					if( isset($field['id']) && isset($field['default']) ){
						$field_id              = $field['id'];
						$field_val             = $field['default'];
						$digitallaw_theme_options[$field_id] = $field_val;
					}
				}
				
			}
		}
	}
}
}
add_action('init','digitallaw_redux_load_default_options');
add_action('admin_init','digitallaw_redux_load_default_options');




/*
 *  This function will reset the TGM Activation message box to show if user need to update any plugin or not. This function will call after theme version changed.
 */
if( !function_exists('digitallaw_reset_tgm_infobox') ){
function digitallaw_reset_tgm_infobox(){
	update_user_meta( get_current_user_id(), 'tgmpa_dismissed_notice_tgmpa', '0' );
}
}







/*
 *  Show message that SAFE MODE is active.
 */
if( !function_exists('digitallaw_admin_notice') ){
function digitallaw_admin_notice() {
	if( ini_get('safe_mode') ){
    ?>
    <div class="error">
        <p><?php esc_html_e( '<p><strong>SAFE MODE is active on your hosting</strong></p> <p>Some options in <strong>DigitalLaw theme</strong> may not work including "Demo content installation" and "Theme Options settings". Please contact your hosting service provider and ask them to disable SAFE MODE.</p>', 'digitallaw' ); ?></p>
    </div>
    <?php
	}
}
}
add_action( 'admin_notices', 'digitallaw_admin_notice' );



/**
 * To make Breadcrumb NavXT plugin to WPML Ready 
 */
if(function_exists('bcn_display')){
	//Hook into the Breadcrumb NavXT title filter, want the 4.2+ version with 2 args
	add_filter('bcn_breadcrumb_title', 'digitallaw_bcn_ext_title_translater', 10, 2);
	/**
	 * This function is a filter for the bcn_breadcrumb_title filter, it runs through
	 * the SitePress::the_category_name_filter function
	 * 
	 * @param string $title The title to be filtered (translated)
	 * @param array $context The breadcrumb type array
	 * @return string The string filtered through SitePress::the_category_name_filter
	 */
	if( !function_exists('digitallaw_bcn_ext_title_translater') ){
	function digitallaw_bcn_ext_title_translater($title, $context){
		//Need to make sure we have a taxonomy and that the SitePress object is available
		if(is_array($context) && isset($context[0]) && taxonomy_exists($context[0]) && class_exists('SitePress')){
			//This may be a little dangerous due to the internal recursive calls for the function
			$title = SitePress::the_category_name_filter($title);
		}
		return $title;
	}
	}
}



add_action('admin_init', 'digitallaw_change_maxmegamenu_setting');
if( !function_exists('digitallaw_change_maxmegamenu_setting') ){
function digitallaw_change_maxmegamenu_setting() {

	global $digitallaw_theme_options;
	$breakpoint = '1200';
	$breakpoint = ( !empty($digitallaw_theme_options['menu_breakpoint']) ) ? trim(esc_attr($digitallaw_theme_options['menu_breakpoint'])) : '1200' ;
	
	if( !empty($digitallaw_theme_options['menu_breakpoint']) && esc_attr($digitallaw_theme_options['menu_breakpoint']) == 'custom'){
		$breakpoint =  esc_attr($digitallaw_theme_options['menu_breakpoint_custom']);
	}

	$themes['default'] = array(
            'title'                                     => esc_attr__("Default", "digitallaw"),
            'container_background_from'                 => '#222',
            'container_background_to'                   => '#222',
            'container_padding_left'                    => '0px',
            'container_padding_right'                   => '0px',
            'container_padding_top'                     => '0px',
            'container_padding_bottom'                  => '0px',
            'container_border_radius_top_left'          => '0px',
            'container_border_radius_top_right'         => '0px',
            'container_border_radius_bottom_left'       => '0px',
            'container_border_radius_bottom_right'      => '0px',
            'arrow_up'                                  => 'dash-f142',
            'arrow_down'                                => 'dash-f140',
            'arrow_left'                                => 'dash-f141',
            'arrow_right'                               => 'dash-f139',
            'menu_item_background_from'                 => 'transparent',
            'menu_item_background_to'                   => 'transparent',
            'menu_item_background_hover_from'           => '#333',
            'menu_item_background_hover_to'             => '#333',
            'menu_item_spacing'                         => '0px',
            'menu_item_link_font'                       => 'inherit',
            'menu_item_link_font_size'                  => '14px',
            'menu_item_link_height'                     => '40px',
            'menu_item_link_color'                      => '#ffffff',
            'menu_item_link_weight'                     => 'normal',
            'menu_item_link_text_transform'             => 'normal',
            'menu_item_link_color_hover'                => '#ffffff',
            'menu_item_link_weight_hover'               => 'normal',
            'menu_item_link_padding_left'               => '10px',
            'menu_item_link_padding_right'              => '10px',
            'menu_item_link_padding_top'                => '0px',
            'menu_item_link_padding_bottom'             => '0px',
            'menu_item_link_border_radius_top_left'     => '0px',
            'menu_item_link_border_radius_top_right'    => '0px',
            'menu_item_link_border_radius_bottom_left'  => '0px',
            'menu_item_link_border_radius_bottom_right' => '0px',
            'panel_background_from'                     => '#f1f1f1',
            'panel_background_to'                       => '#f1f1f1',
            'panel_width'                               => '100%',
			'panel_border_color'                        => '#fff',
            'panel_border_left'                         => '0px',
            'panel_border_right'                        => '0px',
            'panel_border_top'                          => '0px',
            'panel_border_bottom'                       => '0px',
            'panel_border_radius_top_left'              => '0px',
            'panel_border_radius_top_right'             => '0px',
            'panel_border_radius_bottom_left'           => '0px',
            'panel_border_radius_bottom_right'          => '0px',
            'panel_header_color'                        => '#555',
            'panel_header_text_transform'               => 'uppercase',
            'panel_header_font'                         => 'inherit',
            'panel_header_font_size'                    => '16px',
            'panel_header_font_weight'                  => 'bold',
            'panel_header_padding_top'                  => '0px',
            'panel_header_padding_right'                => '0px',
            'panel_header_padding_bottom'               => '5px',
            'panel_header_padding_left'                 => '0px',
            'panel_padding_left'                        => '0px',
            'panel_padding_right'                       => '0px',
            'panel_padding_top'                         => '0px',
            'panel_padding_bottom'                      => '0px',
            'panel_widget_padding_left'                 => '15px',
            'panel_widget_padding_right'                => '15px',
            'panel_widget_padding_top'                  => '15px',
            'panel_widget_padding_bottom'               => '15px',
            'flyout_width'                              => '150px',
			'flyout_border_color'                        => '#ffffff',
            'flyout_border_left'                         => '0px',
            'flyout_border_right'                        => '0px',
            'flyout_border_top'                          => '0px',
            'flyout_border_bottom'                       => '0px',
            'flyout_link_padding_left'                  => '10px',
            'flyout_link_padding_right'                 => '10px',
            'flyout_link_padding_top'                   => '0px',
            'flyout_link_padding_bottom'                => '0px',
            'flyout_link_weight'                        => 'normal',
            'flyout_link_weight_hover'                  => 'normal',
            'flyout_link_height'                        => '35px',
            'flyout_background_from'                    => '#f1f1f1',
            'flyout_background_to'                      => '#f1f1f1',
            'flyout_background_hover_from'              => '#dddddd',
            'flyout_background_hover_to'                => '#dddddd',
            'font_size'                                 => '14px',
            'font_color'                                => '#666',
            'font_family'                               => 'inherit',
            'responsive_breakpoint'                     => $breakpoint.'px',
            'line_height'                               => '1.7',
            'z_index'                                   => '999',
            'custom_css'                                => '
#{$wrap} #{$menu} {
    /** Custom styles should be added below this line **/
}
#{$wrap} { 
    clear: both;
}'
        );
		
	$megamenu_themes = get_option('megamenu_themes');
	if( is_array($megamenu_themes) && isset($megamenu_themes["default"]['responsive_breakpoint']) ){
		if( $megamenu_themes["default"]['responsive_breakpoint'] != $breakpoint.'px' ){
			$megamenu_themes["default"]['responsive_breakpoint'] = $breakpoint.'px';
			update_option('megamenu_themes', $megamenu_themes);
			
			// Generate Cache CSS of MaxMegaMenu
			if( class_exists('Mega_Menu_Style_Manager') ){
				$Mega_Menu_Style_Manager = new Mega_Menu_Style_Manager;
				$Mega_Menu_Style_Manager->generate_css( 'scss_formatter_compressed' );
			}
			
		}
	} else {
		update_option('megamenu_themes', $themes);
		
		// Generate Cache CSS of MaxMegaMenu
		if( class_exists('Mega_Menu_Style_Manager') ){
			$Mega_Menu_Style_Manager = new Mega_Menu_Style_Manager;
			$Mega_Menu_Style_Manager->generate_css( 'scss_formatter_compressed' );
		}
		
	}
}
}



/*
 * Function to get count of total sidebar
 */
if( !function_exists('digitallaw_get_widgets_count') ){
function digitallaw_get_widgets_count( $sidebar_id ){
	$sidebars_widgets = wp_get_sidebars_widgets();
	if( isset($sidebars_widgets[ $sidebar_id ]) ){
		return (int) count( (array) $sidebars_widgets[ $sidebar_id ] );
	}
}
}
if( !function_exists('digitallaw_class_for_widgets_count') ){
function digitallaw_class_for_widgets_count( $count=0 ){
	$return = '';
	if( $count<1 ){ $count = 1; }
	if( $count>4 ){ $count = 4; }
	switch( $count ){
		case 1:
			$return = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
			break;
		case 2:
			$return = 'col-xs-12 col-sm-6 col-md-6 col-lg-6';
			break;
		case 3:
			$return = 'col-xs-12 col-sm-6 col-md-4 col-lg-4';
			break;
		case 4:
			$return = 'col-xs-12 col-sm-6 col-md-3 col-lg-3';
			break;
	}
	return $return;
}
}



/**
 *  CSS Minifier
 */
if( !function_exists('digitallaw_minify_css') ){
function digitallaw_minify_css( $css ){
	if( !empty($css) ){
		// Remove comments
		$css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
		
		// Remove new line charactor
		$css = str_replace(array("\r\n", "\r", "\n", "\t"), '', $css);
		
		// Remove whitespace
		$css = str_replace(array('  ', '   ', '    ', '     ', '      ', '       ', '        ', '         ', '          '), ' ', $css);
		
		// Remove space after colons
		$css = str_replace(': ', ':', $css);
		
		// Remove space near commas
		$css = str_replace(', ', ',', $css);
		$css = str_replace(' ,', ',', $css);

		// Remove space before brackets
		$css = str_replace('{ ', '{', $css);
		$css = str_replace('} ', '}', $css);
		$css = str_replace(' {', '{', $css);
		$css = str_replace(' }', '}', $css);

		// Remove last dot with comma
		$css = str_replace(';}', '}', $css);
		
		// Remove whitespace again
		$css = str_replace(array('  ', '   ', '    ', '     ', '      ', '       ', '        ', '         ', '          '), ' ', $css);
		
		// Remove extra space
		$css = str_replace('; }', ';}', $css);
		
	}
	return $css;
}
}





if( !function_exists('digitallaw_add_inline_dynamic_css') ){
function digitallaw_add_inline_dynamic_css(){
	global $digitallaw_theme_options;
	
	/* Fetching dynamic-style.php output and store in a variable */
	ob_start(); // begin collecting output
	include get_template_directory().'/css/dynamic-style.php';
	$css    = ob_get_clean(); // retrieve output from myfile.php, stop buffering
	
	// --------- Minify CSS Code ----------- //
	if( !empty( $digitallaw_theme_options['minify-css-js']) && esc_attr($digitallaw_theme_options['minify-css-js'])=='1' ){
		$css = digitallaw_minify_css( $css );
	}	
	
	// digitallaw-main-style
	wp_add_inline_style( 'digitallaw-main-style', $css );
	
}
}
add_action( 'wp_enqueue_scripts', 'digitallaw_add_inline_dynamic_css', 17 );





/*
 * Add some special classes on <body> tag.
 */
if( !function_exists('digitallaw_body_classes') ){
function digitallaw_body_classes($bodyClass){
	global $digitallaw_theme_options;
	
	// check if dark background set for container.
	if( isset($digitallaw_theme_options['inner_background']['background-color']) && trim($digitallaw_theme_options['inner_background']['background-color'])!='' && digitallaw_check_dark_color(esc_attr($digitallaw_theme_options['inner_background']['background-color'])) ){
		$bodyClass[] = 'tm-dark-layout';
		//wp_enqueue_style('digitallaw-dark');
	}
	
	//Responsive ON / OFF
	if( isset($digitallaw_theme_options['responsive']) && $digitallaw_theme_options['responsive']=='1'){
		$bodyClass[] = 'thememount-responsive-on';
	} else {
		$bodyClass[] = 'thememount-responsive-off';
	}

	// Sticky Fotoer ON/OFF
	if( isset($digitallaw_theme_options['stickyfooter']) && esc_attr($digitallaw_theme_options['stickyfooter'])=='1' ){
		$bodyClass[] = 'thememount-sticky-footer';
	}
	
	// Single Portfolio
	if( is_singular('portfolio') ){
		$portfolioView        = esc_attr($digitallaw_theme_options['portfolio_viewstyle']); // Global view
		$portfolioView_single = esc_attr(get_post_meta( get_the_ID(), '_thememount_portfolio_view_viewstyle', true)); // Single portfolio view
		if( is_array($portfolioView_single) ){ $portfolioView_single = $portfolioView_single[0]; }
		if( trim($portfolioView_single)!='' && trim($portfolioView_single)!='global' ){
			$portfolioView = $portfolioView_single;
		}
		$bodyClass[] = sanitize_html_class('thememount-portfolio-view-'.$portfolioView);
	}
	
	// Boxed / Wide
	if( !empty($digitallaw_theme_options['layout'])){
		$layout = esc_attr($digitallaw_theme_options['layout']);
		if( $layout == 'boxed' || $layout == 'framed' || $layout == 'rounded' ){
			$bodyClass[] = 'thememount-boxed';
		}
		if( $layout == 'framed' || $layout == 'rounded' ){
			$bodyClass[] = 'thememount-boxed-'.sanitize_html_class($layout);
		}
		
		$bodyClass[] = sanitize_html_class( 'thememount-'.trim($layout) );
		if( $layout == 'fullwide' ){
			if( isset($digitallaw_theme_options['full_wide_elements']['content']) && esc_attr($digitallaw_theme_options['full_wide_elements']['content'])=='1' ){
				$bodyClass[] = 'tm-layout-container-full';
			}
		}
		
	} else {
		$bodyClass[] = 'thememount-wide';
	}
	
	$thememount_retina_logo = 'off';
	if( isset($digitallaw_theme_options['logoimg_retina']['url']) && $digitallaw_theme_options['logoimg_retina']['url']!=''){
		$thememount_retina_logo = 'on';
	}

	
	// Header Style
	$headerstyle        = '';
	$hClass 			= '';
	if( !empty($digitallaw_theme_options['headerstyle']) ){
		$headerstyle = sanitize_html_class($digitallaw_theme_options['headerstyle']);
	}

	switch( $headerstyle ){
		case '1':
		case '2':
		case '3':
		case '9':
			if( $headerstyle=='9' ){ $headerstyle='1 tm-header-invert'; }
			$hClass = 'thememount-header-style-'.trim($headerstyle);
			break;
		case '4':
		case '10':
			$overlayClass = ' tm-header-overlay';
			if( $headerstyle=='10' ){ $overlayClass.=' tm-header-invert'; }
			if( is_page() ){
				global $post;
				$slidertype   = get_post_meta( $post->ID, '_thememount_page_options_slidertype', true );
				if( is_array($slidertype) ){ $slidertype = $slidertype[0];}
				$hidetitlebar = get_post_meta( $post->ID, '_thememount_page_options_hidetitlebar', true );
				
				if( trim($slidertype)=='' && $hidetitlebar=='on' ){
					if($headerstyle=='10'){
						$overlayClass = ' tm-header-invert';
					}
					else{
						$overlayClass = '';
					}					
				}
			}
			$hClass = 'thememount-header-style-1' . $overlayClass;
			break;
		case '5':
			$overlayClass = ' tm-header-overlay';
			if( is_page() ){
				global $post;
				$slidertype   = get_post_meta( $post->ID, '_thememount_page_options_slidertype', true );
				if( is_array($slidertype) ){ $slidertype = $slidertype[0];}
				$hidetitlebar = get_post_meta( $post->ID, '_thememount_page_options_hidetitlebar', true );
				
				if( trim($slidertype)=='' && $hidetitlebar=='on' ){
					$overlayClass = '';
				}
			}
			$hClass = 'thememount-header-style-2' . $overlayClass;
			break;
		case '6':
		case '13':
			$overlayClass = '';
			if( $headerstyle=='13' ){ $overlayClass.=' tm-header-overlay'; }
			if( is_page() ){
				global $post;
				$slidertype   = get_post_meta( $post->ID, '_thememount_page_options_slidertype', true );
				if( is_array($slidertype) ){ $slidertype = $slidertype[0];}
				$hidetitlebar = get_post_meta( $post->ID, '_thememount_page_options_hidetitlebar', true );
				
				if( trim($slidertype)=='' && $hidetitlebar=='on' ){
					$overlayClass = '';
				}
			}
			$hClass = 'thememount-header-style-6' . $overlayClass;
			break;
		case '7':
		case '8':
			$overlayClass = ' tm-header-overlay';
			if( $headerstyle=='8' ){ $overlayClass.=' tm-header-invert'; }
			if( is_page() ){
				global $post;
				$slidertype   = get_post_meta( $post->ID, '_thememount_page_options_slidertype', true );
				if( is_array($slidertype) ){ $slidertype = $slidertype[0];}
				$hidetitlebar = get_post_meta( $post->ID, '_thememount_page_options_hidetitlebar', true );
				
				if( trim($slidertype)=='' && $hidetitlebar=='on' ){
					if($headerstyle=='8'){
						$overlayClass = ' tm-header-invert';
					}
					else{
						$overlayClass = '';
					}
				}
			}
			$hClass = 'thememount-header-style-4' . $overlayClass;
			break;
	}
	$bodyClass[] = $hClass;
	
	

	// Sidebar Class
	$sidebar = esc_attr($digitallaw_theme_options['sidebar_blog']); // Global settings
	if( (is_page()) ){
		$sidebar = esc_attr($digitallaw_theme_options['sidebar_page']); // Global settings
		$sidebarposition = get_post_meta( get_the_ID(), '_thememount_page_options_sidebarposition', true);
		if( is_array($sidebarposition) ){ $sidebarposition = $sidebarposition[0]; } // Converting to String if Array
		// Page settings
		if( trim($sidebarposition) != '' ){
			$sidebar = $sidebarposition;
		}
	} else if( (is_home()) || is_single() ){
		
		$pageid   = get_option('page_for_posts');
		$postType = 'page';
		if( is_single() ){
			global $post;
			$pageid   = $post->ID;
			$postType = 'post';
		}
		
		$sidebarposition = get_post_meta( $pageid, '_thememount_'.$postType.'_options_sidebarposition', true);
		if( is_array($sidebarposition) ){ $sidebarposition = $sidebarposition[0]; } // Converting to String if Array
		// Page settings
		if( trim($sidebarposition) != '' ){
			$sidebar = $sidebarposition;
		}
	}
	
	
	// WooCommerce sidebar class
	if( function_exists('is_woocommerce') && is_woocommerce() ) {
		$sidebar = isset($digitallaw_theme_options['sidebar_woocommerce']) ? esc_attr($digitallaw_theme_options['sidebar_woocommerce']) : 'right' ;
	}
	
	// BBPress sidebar class
	if( function_exists('is_bbpress') && is_bbpress() ) {
		$sidebar = isset($digitallaw_theme_options['sidebar_bbpress']) ? esc_attr($digitallaw_theme_options['sidebar_bbpress']) : 'right' ;
	}
	
	// Tribe Events (The Events Calendar plugin)
	if( function_exists('tribe_is_upcoming') ){
		if ( get_post_type() == 'tribe_events' || tribe_is_upcoming() || tribe_is_month() || tribe_is_by_date() || tribe_is_day() || is_single('tribe_events') ){
			$sidebar = !empty($digitallaw_theme_options['sidebar_events']) ? esc_attr($digitallaw_theme_options['sidebar_events']) : 'no' ; // Global settings
		}
	}
	
	
	// Search results page sidebar
	if( is_search() ){
		$sidebar = ( !empty($digitallaw_theme_options['sidebar_search']) ) ? esc_attr($digitallaw_theme_options['sidebar_search']) : 'no' ; // Global settings for search results page
	}
	
	
	
	if( $sidebar=='no' ){
		// The page is full width
		$bodyClass[] = 'thememount-page-full-width';
	} else {
		// Sidebar class for border
		$bodyClass[] = sanitize_html_class( 'thememount-sidebar-'.$sidebar );
	}
	
	// Check if "Max Mega Menu" plugin is active
	if( !function_exists('is_plugin_active') ){
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	}
	if ( is_plugin_active( 'megamenu/megamenu.php' ) ) {
		// plugin is activated
		$bodyClass[] = 'thememount-maxmegamenu-active';
	}
	
	// One Page website
	if( !empty($digitallaw_theme_options['one_page_site']) && esc_attr($digitallaw_theme_options['one_page_site']) == '1' ){
		$bodyClass[] = 'thememount-one-page-site';
	}
	
	// Class tm-topbar-hidden if topbar is hidden. 
	$page_topbar = trim( get_post_meta( get_the_ID(), '_thememount_page_options_show_topbar', true ) );
	$topbar 	 = ( isset($digitallaw_theme_options['show_topbar']) && esc_attr($digitallaw_theme_options['show_topbar']) == '0' ) ? esc_attr($digitallaw_theme_options['show_topbar']) : '';

	if($topbar=='0' || $page_topbar=='0'){
		$bodyClass[] = 'tm-topbar-hidden';
	}
	
	if ( ! is_multi_author() )
		$bodyClass[] = 'single-author';

	if ( ! get_option( 'show_avatars' ) )
		$bodyClass[] = 'no-avatars';
	
	if( isset($digitallaw_theme_options['responsive']) && $digitallaw_theme_options['responsive']=='1'){
		$bodyClass[] = 'thememount-responsive-on';
	} else {
		$bodyClass[] = 'thememount-responsive-off';
	}
	
	// Theme version
	$my_theme		= wp_get_theme( 'digitallaw' );
	$theme_version	= $my_theme->get( 'Version' );
	if( $theme_version != '' ){
		$theme_version	= str_replace('.', '-', $theme_version);
		$theme_version	= 'digitallaw-v'.$theme_version;
		$bodyClass[]	= sanitize_html_class($theme_version);
	}

	return $bodyClass;
}
}
add_filter('body_class', 'digitallaw_body_classes');



/*
 * digitallaw_getCSS
 */
if( !function_exists('digitallaw_getCSS') ){
function digitallaw_getCSS( $value = array() ) {
	$css = '';
	if ( ! empty( $value ) && is_array( $value ) ) {
		foreach ( $value as $key => $value ) {
			if ( ! empty( $value ) && $key != "media" ) {
				if ( $key == "background-image" ) {
					$css .= $key . ":url('" . $value . "');";
				} else {
					$css .= $key . ":" . $value . ";";
				}
			}
		}
	}
	return $css;
}
}


/*
 * Login page stylesheet
 */
if( !function_exists('digitallaw_custom_login_css') ){
function digitallaw_custom_login_css() {
	global $digitallaw_theme_options;
	$bg_size = '';
	
	// Custom CSS Code for login page only
	$login_custom_css_code = '';
	if( !empty($digitallaw_theme_options['login_custom_css_code']) ){
		$login_custom_css_code = $digitallaw_theme_options['login_custom_css_code'];
	}
	
	// Login page background CSS style
	$bgStyle = digitallaw_getCSS($digitallaw_theme_options['login_background']);
	
	$cssCode  = '';
	$cssCode2 = '';
	
	if( !empty($bgStyle) ){
		$cssCode .= 'body.login{'.$bgStyle.'}';
	}
	
	
	
	
	
	if( !empty($digitallaw_theme_options['logoimg']["url"]) ){
		$cssCode2 .= 'background: transparent url("'.esc_url($digitallaw_theme_options['logoimg']["url"]).'") no-repeat center center;';
	}
	
	if( !empty($digitallaw_theme_options['logoimg']["width"]) ){
		if( $digitallaw_theme_options['logoimg']["width"] > 320 ){
			$cssCode2 .= 'width: 320px;';
		} else {
			$cssCode2 .= 'width: '.esc_attr($digitallaw_theme_options['logoimg']["width"]).'px;';
		}
	}
	
	if( !empty($digitallaw_theme_options['logoimg']["height"]) ){
		// 320px : max-width
		$width  = esc_attr($digitallaw_theme_options['logoimg']["width"]);
		$height = esc_attr($digitallaw_theme_options['logoimg']["height"]);
		if( $width > 320 ){
			$bg_size   = 'background-size: 100%;';
			$newheight = ceil( ($height / $width) * 320 );
		} else {
			$newheight = $height;
		}
		
		$cssCode2 .= 'height: '.$newheight.'px;';
	}
	
	// Submit button to skin color
	$otherCSS = '.wp-core-ui #login .button-primary{ background: '.esc_attr($digitallaw_theme_options['skincolor']).'; text-shadow: none;}';
	
	
	echo '<style>
		.login #login form{background-color: #f7f7f7; box-shadow: none;}
		'.$cssCode.'
		.login #login h1 a{
			'.$cssCode2.'
			'.$bg_size.'
		}
		'.$otherCSS.'
		'.$login_custom_css_code.'
		</style>';
}
}
add_action('login_head', 'digitallaw_custom_login_css');



/**
 * Login page logo link
 */
if( !function_exists('digitallaw_loginpage_custom_link') ){
function digitallaw_loginpage_custom_link() {
	return esc_url( home_url( '/' ) );
}
}
add_filter('login_headerurl','digitallaw_loginpage_custom_link');


/**
 * Login page logo link title
 */
if( !function_exists('digitallaw_change_title_on_logo') ){
function digitallaw_change_title_on_logo() {
	return esc_attr( get_bloginfo( 'name', 'display' ) );
}
}
add_filter('login_headertitle', 'digitallaw_change_title_on_logo');



/**
 * DigitalLaw setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * DigitalLaw supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since DigitalLaw 1.0
 *
 * @return void
 */
 
if( !function_exists('digitallaw_theme_setup') ){
function digitallaw_theme_setup() {
	/*
	 * Makes DigitalLaw available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on DigitalLaw, use a find and
	 * replace to change 'digitallaw' to the name of your theme in all
	 * template files.
	 */
	$parentPath = WP_CONTENT_DIR . '/digitallaw-languages';
	if (file_exists($parentPath)) {
		load_theme_textdomain( 'digitallaw', $parentPath );
	} else {
		load_theme_textdomain( 'digitallaw', get_template_directory() . '/languages' );
	}
	
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'inc/editor-style.css' ) );
	
	// Temporary
	add_theme_support( 'custom-header' );
  	add_theme_support( 'custom-background' );


	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	
	// Since Version 4.1, themes should use add_theme_support() in the functions.php file in order to support title tag
	add_theme_support( 'title-tag' );
	
	// Adding WooCommerce Support
	add_theme_support( 'woocommerce' );

	/*
	 * Switches default core markup for search form, comment form,
	 * and comments to output valid HTML5.
	 */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', esc_attr__( 'Navigation Menu', 'digitallaw' ) );
	register_nav_menu( 'footer' , esc_attr__( 'Footer Menu', 'digitallaw' ) );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	
	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
	
	// Widgets
	include_once(get_template_directory().'/inc/widgets/thememountWidgetRecentPosts.php');
	include_once(get_template_directory().'/inc/widgets/thememountWidgetFlickr.php');
	include_once(get_template_directory().'/inc/widgets/thememountWidgetContact.php');
	include_once(get_template_directory().'/inc/widgets/thememountWidgetTeamSearch.php');
	
}
}
add_action( 'after_setup_theme', 'digitallaw_theme_setup' );



/*
 *  Adding Image sizes
 */

if( !function_exists('digitallaw_image_sizes') ){
function digitallaw_image_sizes(){
	
	global $digitallaw_theme_options;
	
	$img_array = array(
		'digitallaw-portfolio-two-column',
		'digitallaw-portfolio-three-column',
		'digitallaw-portfolio-four-column',
		'digitallaw-blog-two-column',
		'digitallaw-blog-three-column',
		'digitallaw-blog-four-column',
		'digitallaw-team-two-column',
		'digitallaw-team-three-column',
		'digitallaw-team-four-column',
		'digitallaw-blog-single',
	);
	foreach($img_array as $imgsize){
		$size = array( 'width' => 1110, 'height' => 624, 'crop' => true );
		
		if( $imgsize == 'digitallaw-portfolio-two-column' || $imgsize == 'digitallaw-blog-two-column' ){ // Portfolio - Two Column
			$size = array( 'width' => 1110, 'height' => 624, 'crop' => true );
		
		} else if( $imgsize == 'digitallaw-portfolio-three-column' || $imgsize == 'digitallaw-blog-three-column' ){ // Portfolio - Three Column
			$size = array( 'width' => 720, 'height' => 406, 'crop' => true );
			
		} else if( $imgsize == 'digitallaw-portfolio-four-column' || $imgsize == 'digitallaw-blog-four-column' ){ // Portfolio - Four Column
			$size = array( 'width' => 750, 'height' => 422, 'crop' => true );
			
		} else if( $imgsize == 'digitallaw-blog-single' ){ // Blog Single Post Imgae
			$size = array( 'width' => 727, 'height' => 409, 'crop' => true );
		}
		
		// Getting redux value
		if( isset($digitallaw_theme_options['img-'.$imgsize]) && is_array($digitallaw_theme_options['img-'.$imgsize]) ){
			$size = $digitallaw_theme_options['img-'.$imgsize];
		}
	
		// Convrting to Boolean
		if( $size['crop']=='no' ){
			$size['crop'] = false;
		} else {
			$size['crop'] = true;
		}
		
		if( $imgsize == 'digitallaw-blog-single' ){
			set_post_thumbnail_size( $size['width'], $size['height'], $size['crop'] );
		} else {
			add_image_size( $imgsize,   $size['width'], $size['height'], $size['crop'] );
		}
	}
	
}
}
add_action( 'init', 'digitallaw_image_sizes' );



// Visual Composer Theme integration
add_action( 'vc_before_init', 'digitallaw_vcSetAsTheme', 9 );
if( !function_exists('digitallaw_vcSetAsTheme') ){
function digitallaw_vcSetAsTheme() {
	if( function_exists('vc_set_as_theme') ){ vc_set_as_theme( true ); }
	if( function_exists('vc_manager') ){ vc_manager()->disableUpdater(true); }
	if( function_exists('vc_set_default_editor_post_types') ){ vc_set_default_editor_post_types(array('page', 'tm_portfolio', 'tm_team_member')); }
}
}

// Slider Revoluiton Theme integration
add_action( 'init', 'digitallaw_set_rs_as_theme' );
if( !function_exists('digitallaw_set_rs_as_theme') ){
function digitallaw_set_rs_as_theme() {
	// Setting options to hide Revoluiton Slider message
	if(get_option('revSliderAsTheme') != 'true'){
		update_option('revSliderAsTheme', 'true');
	}
	if(get_option('revslider-valid-notice') != 'false'){
		update_option('revslider-valid-notice', 'false');
	}
	if( function_exists('set_revslider_as_theme') ){	
		set_revslider_as_theme();
	}
}
}






/******************* Order Testimonials by date *******************/
/* Sort posts in wp_list_table by column in ascending or descending order. */

if( !function_exists('digitallaw_custom_post_order') ){
function digitallaw_custom_post_order($query){
	$post_types = get_post_types(array('_builtin' => false), 'names');
	
	/* The current post type. */
	$post_type = $query->get('testimonial');
	
	/* Check post types. */
	if(in_array($post_type, $post_types)){
		/* Post Column: e.g. title */
		if($query->get('orderby') == ''){
			$query->set('orderby', 'date');
		}
		/* Post Order: ASC / DESC */
		if($query->get('order') == ''){
			$query->set('order', 'DESC');
		}
	}
}
}
if(is_admin()){
	add_action('pre_get_posts', 'digitallaw_custom_post_order');
}
/******************************************************/



/*
 *  Scripts and styles
 */
include(get_template_directory().'/inc/scripts-styles.php');



/*
 *  Widgets
 */
include_once(get_template_directory().'/inc/widget-positions.php');


/*
 * Display pagination to set of posts when applicable.
 */
if ( ! function_exists( 'digitallaw_paging_nav' ) ) :
	function digitallaw_paging_nav($return = false, $wp_query_data=false) {
		if( $wp_query_data==false ){
			global $wp_query;
		} else {
			$wp_query = $wp_query_data;
		}
		
		$result = '';
		
		$big = 999999999; // need an unlikely integer
		
		// Array to check if pagination data exists
		$paginateLinks = paginate_links( array(
			'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'    => '?paged=%#%',
			'current'   => max( 1, get_query_var('paged') ),
			'total'     => $wp_query->max_num_pages,
			'type'      => 'array',
			'prev_text' => ' <i class="fa fa-angle-double-left"></i> ',
			'next_text' => ' <i class="fa fa-angle-double-right"></i> ',
		) );
		
		
		if( $paginateLinks!=NULL ){
			$big = 999999999; // need an unlikely integer
			$result .= '<div class="thememount-pagination">';
			$result .= paginate_links( array(
				'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'    => '?paged=%#%',
				'current'   => max( 1, get_query_var('paged') ),
				'total'     => $wp_query->max_num_pages,
				'prev_text' => ' <i class="fa fa-angle-double-left"></i> ',
				'next_text' => ' <i class="fa fa-angle-double-right"></i> ',
			) );
			$result .= '</div>';
		}
		
		if( $return==true ){
			
			return wp_kses( /* HTML Filter */
				$result,
				array(
					'div' => array(
						'class' => array(),
					),
					'span' => array(
						'class' => array(),
					),
					'i' => array(
						'class' => array(),
					),
					'a' => array(
						'href' => array(),
						'class' => array(),
					)
				)
			);
			
			
			
		} else {
			echo wp_kses( /* HTML Filter */
				$result,
				array(
					'div' => array(
						'class' => array(),
					),
					'span' => array(
						'class' => array(),
					),
					'i' => array(
						'class' => array(),
					),
					'a' => array(
						'href' => array(),
						'class' => array(),
					)
				)
			);
		}
	}
endif;





if ( ! function_exists( 'digitallaw_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
*
* @since DigitalLaw 1.0
*
* @return void
*/
function digitallaw_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation">
		<div class="nav-links">
			<?php previous_post_link( '%link', '<span class="meta-nav"></span> ' . esc_attr__( 'Previous', 'digitallaw' ) ); ?>
			<?php next_post_link( '%link', esc_attr__( 'Next', 'digitallaw' ) . ' <span class="meta-nav"></span>' ); ?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;












if ( ! function_exists( 'digitallaw_post_meta_left' ) ) :
/**
 * Print HTML with date information for current post.
 *
 * Create your own digitallaw_post_meta_left() to override in a child theme.
 *
 * @since DigitalLaw 1.0
 *
 * @param boolean $echo (optional) Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function digitallaw_post_meta_left( $echo = true ) {
	$return = '';
	if ( has_post_format( array( 'chat', 'status' ) ) ){
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'digitallaw' );
	} else {
		$format_prefix = '%2$s';
	}
	
	$date = '';
	$writtenBy = sprintf(
			'<span class="authorname">'.get_the_author().'</span>'
	);
	
	// Icon Text
	$post_format = get_post_format();
	if( $post_format=='' ){
		$post_format = 'Regular';
	}
	
	$iconTitle = sprintf(
		esc_attr__( '%s Post', 'digitallaw' ),
		$post_format
	);
	
	// Comment
	$commentCode = '';
	if( comments_open() ){
		$commentCode = sprintf( '
			<div class="thememount-commenbox">
				<span class="comments"><i class="fa fa-comments-o"></i> %1$s</span>
			</div>',
			get_comments_number()
		);
	}
	
	// Date
	$dateCode = sprintf( '
		<time class="entry-date dateinfo" datetime="%1$s">
			<span class="date"> %2$s </span>
			%3$s
		</time>
		',
		get_the_date( 'c' ),
		get_the_date( 'j' ),
		get_the_date( 'M' )
	);
	
	// Add link to date if no title added
	if( '' == trim(get_the_title()) ){
		$dateCode = '<a href="'. get_permalink() .'">'. $dateCode .'</a>';
	}
	
	
	
	$return .= sprintf( '
	
			<div class="thememount-post-date-wrapper">
				<div class="thememount-entry-date-wrapper">
					<div class="thememount-entry-icon">
						<div class="thememount-post-icon-wrapper">
							%1$s
						</div>
					</div>
				</div>
			</div>
			<div class="thememount-entry-date">
				 %3$s
			</div>
			%4$s',
		digitallaw_entry_icon(),
		$writtenBy,
		$dateCode,
		$commentCode
	
		
	);
	
	if ( $echo ){
		
		echo wp_kses( /* HTML Filter */
			$return,
			array(
				'div' => array(
					'class' => array(),
				),
				'time' => array(
					'class'    => array(),
					'datetime' => array(),
				),
				'span' => array(
					'class' => array(),
				),
				'i' => array(
					'class' => array(),
				),
				'a' => array(
					'href' => array(),
					'class' => array(),
				)
			)
		);
		
		
	} else {
		return wp_kses( /* HTML Filter */
			$return,
			array(
				'div' => array(
					'class' => array(),
				),
				'span' => array(
					'class' => array(),
				),
				'i' => array(
					'class' => array(),
				),
				'a' => array(
					'href' => array(),
					'class' => array(),
				)
			)
		);
		
	}
}
endif;







if ( ! function_exists( 'digitallaw_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since DigitalLaw 1.0
 *
 * @return void
 */
function digitallaw_the_attached_image() {
	/**
	 * Filter the image attachment size to use.
	 *
	 * @since DigitalLaw 1.0
	 *
	 * @param array $size {
	 *     @type int The attachment height in pixels.
	 *     @type int The attachment width in pixels.
	 * }
	 */
	$attachment_size     = apply_filters( 'digitallaw_attachment_size', array( 724, 724 ) );
	$next_attachment_url = wp_get_attachment_url();
	$post                = get_post();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;




/**
 * Adjust content_width value for video post formats and attachment templates.
 *
 * @since DigitalLaw 1.0
 *
 * @return void
 */
if( !function_exists('digitallaw_content_width') ){
function digitallaw_content_width() {
	global $content_width;

	if ( is_attachment() )
		$content_width = 724;
	elseif ( has_post_format( 'audio' ) )
		$content_width = 484;
}
}
add_action( 'template_redirect', 'digitallaw_content_width' );








/*************** Icon List *****************/
$digitallaw_iconsArray = array();
include_once(get_template_directory() . '/inc/icons-list-fontawesome.php');
$digitallaw_iconsArray = array_merge($digitallaw_iconsArray, $fontawesome_array ); // Adding FontAwesome List by default


/*************** Cuztom Framework: Custom Post Type, Texonomy etc. *****************/
require_once( get_template_directory() . '/inc/posttype-page.php' );
require_once( get_template_directory() . '/inc/posttype-post.php' );


/*************** Extra addons in Visual Composer *****************/
if( function_exists('vc_map') && class_exists('WPBMap') ){
	require_once( get_template_directory() . '/inc/visual-composer.php' );
}



/**
 *  Loading Theme Options array list on INIT so the language translation will work
 */
add_action('init', 'digitallaw_redux_options', 9);
if( !function_exists('digitallaw_redux_options') ){
function digitallaw_redux_options(){
	if ( class_exists( 'ReduxFramework' ) ) {
		require_once( get_template_directory() . '/inc/redux-options.php' );
	}
}
}


if( !function_exists('digitallaw_removeDemoModeLink') ){
function digitallaw_removeDemoModeLink() { // Be sure to rename this function to something more unique
	if ( class_exists('ReduxFrameworkPlugin') ) {
		remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
	}
	if ( class_exists('ReduxFrameworkPlugin') ) {
		remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
	}
}
}
add_action('init', 'digitallaw_removeDemoModeLink');



/*
 * A simple plugin to help the users of developers who ship a Redux based product with developer mode on. 
 * This plugin globally disables developer mode for all Redux instances.
 */
if ( ! function_exists( 'redux_disable_dev_mode_plugin' ) ) {
	function redux_disable_dev_mode_plugin( $redux ) {
		if ( $redux->args['opt_name'] != 'redux_demo' ) {
			$redux->args['dev_mode'] = false;
			$redux->args['forced_dev_mode_off'] = false;
		}
	}

	add_action( 'redux/digitallaw_theme_options', 'redux_disable_dev_mode_plugin' );
}




/**
 *  Creating global variable for theme options
 */
add_action('init', 'digitallaw_theme_options_variable', 1);
if( !function_exists('digitallaw_theme_options_variable') ){
function digitallaw_theme_options_variable(){
	global $digitallaw_options;
	if( empty($digitallaw_options) ){
		$digitallaw_options = get_option('digitallaw_options');
	}
}
}


/* Add custom field */
add_action('admin_init', 'digitallaw_redux_fields');
if( !function_exists('digitallaw_redux_fields') ){
function digitallaw_redux_fields(){
	add_filter( "redux/digitallaw_theme_options/field/class/digitallaw_skin_color", "digitallaw_redux_skin_color" ); // Adds the local field
	add_filter( "redux/digitallaw_theme_options/field/class/thememount_one_click_demo_content", "digitallaw_redux_one_click_demo_content" ); // Adds the local field
	add_filter( "redux/digitallaw_theme_options/field/class/digitallaw_pre_color_packages", "digitallaw_redux_pre_color_packages" ); // Adds the local field
	add_filter( "redux/digitallaw_theme_options/field/class/digitallaw_icon_select", "digitallaw_redux_icon_select" ); // Adds the local field
	add_filter( "redux/digitallaw_theme_options/field/class/digitallaw_min_generator", "digitallaw_min_generator" ); // Adds the local field
	add_filter( "redux/digitallaw_theme_options/field/class/digitallaw_dimensions", "digitallaw_dimensions" ); // Adds the local field
	add_filter( "redux/digitallaw_theme_options/field/class/digitallaw_resetlike", "digitallaw_resetlike" ); // Adds the local field
	
}
}



if( !function_exists('digitallaw_redux_skin_color') ){
function digitallaw_redux_skin_color($field) {
	return get_template_directory().'/inc/redux-framework/redux_custom_fields/digitallaw_skin_color/field_digitallaw_skin_color.php';
}
}

if( !function_exists('digitallaw_redux_one_click_demo_content') ){
function digitallaw_redux_one_click_demo_content($field) {
	return get_template_directory().'/inc/redux-framework/redux_custom_fields/thememount_one_click_demo_content/field_thememount_one_click_demo_content.php';
}
}

if( !function_exists('digitallaw_redux_pre_color_packages') ){
function digitallaw_redux_pre_color_packages($field) {
	return get_template_directory().'/inc/redux-framework/redux_custom_fields/digitallaw_pre_color_packages/field_digitallaw_pre_color_packages.php';
}
}

if( !function_exists('digitallaw_redux_icon_select') ){
function digitallaw_redux_icon_select($field) {
	return get_template_directory().'/inc/redux-framework/redux_custom_fields/digitallaw_icon_select/field_digitallaw_icon_select.php';
}
}

if( !function_exists('digitallaw_min_generator') ){
function digitallaw_min_generator($field) {
	return get_template_directory().'/inc/redux-framework/redux_custom_fields/digitallaw_min_generator/field_digitallaw_min_generator.php';
}
}

if( !function_exists('digitallaw_dimensions') ){
function digitallaw_dimensions($field) {
	return get_template_directory().'/inc/redux-framework/redux_custom_fields/digitallaw_dimensions/field_digitallaw_dimensions.php';
}
}

if( !function_exists('digitallaw_resetlike') ){
function digitallaw_resetlike($field) {
	return get_template_directory().'/inc/redux-framework/redux_custom_fields/digitallaw_resetlike/field_digitallaw_resetlike.php';
}
}

/***************************** END Redux Framework **********************************/




add_filter( 'admin_body_class', 'digitallaw_admin_interface_version_body_class' );
if( !function_exists('digitallaw_admin_interface_version_body_class') ){
function digitallaw_admin_interface_version_body_class( $classes ) {
	// check wp_version
	if ( version_compare( $GLOBALS['wp_version'], '3.8-alpha', '>' ) ) {
		// check admin_color
		if ( get_user_option( 'admin_color' ) === 'light' ) {
			$classes .= 'light-admin-ui'; // custom new admin interface
		} else {
			$classes .= 'dark-admin-ui'; // new admin interface
		}
	} else {
		$classes .= 'light-admin-ui'; // old admin interface
	}
	$classes .= ' admin-color-fresh'; // new admin interface
	return $classes;
}
}



/** Post Like ajax **/
add_action('wp_ajax_thememount-portfolio-likes', 'digitallaw_ajax_callback' );
add_action('wp_ajax_nopriv_thememount-portfolio-likes', 'digitallaw_ajax_callback' );

if( !function_exists('digitallaw_ajax_callback') ){
function digitallaw_ajax_callback(){
	if(isset($_POST['likes_id'])){
		$post_id = str_replace('pid-', '', $_POST['likes_id']);
		echo digitallaw_update_like( $post_id );
	}
	exit;
}
}


if( !function_exists('digitallaw_update_like') ){
function digitallaw_update_like( $post_id ){
	if(!is_numeric($post_id)) return;

	$return = '';
	$likes = get_post_meta($post_id, 'thememount_likes', true);
	if(!$likes){ $likes = 0; }
	$likes++;
	update_post_meta($post_id, 'thememount_likes', $likes);
	setcookie('thememount_likes_'.$post_id, $post_id, time()*20, '/');
	return '<i class="fa fa-heart"></i> '.$likes.'</i>';
}
}




/*** Theme Customizer: Write inline style for live customizer ****/
if( !function_exists('digitallaw_customizer_script') ){
function digitallaw_customizer_script(){
	global $wp_customize;
	if ( isset( $wp_customize ) ) {
		global $digitallaw_theme_options;
		?>
		<style type="text/css">
		header .thememount-topbar{
			background-color: <?php echo esc_attr($digitallaw_theme_options['topbarbgcolor']); ?>;
		}
		<?php if( !empty($digitallaw_theme_options['headerbgcolor']['rgba']) ) : ?>
		header .headerblock .header-inner, #stickable-header-sticky-wrapper{
			background-color: <?php echo esc_attr($digitallaw_theme_options['headerbgcolor']['rgba']); ?>;
		}
		<?php endif; ?>
		footer.site-footer > div.footer{
			background-color: <?php echo esc_attr($digitallaw_theme_options['footerwidget_bgcolor']); ?>;
		}
		footer.site-footer > div.site-info{
			background-color: <?php echo esc_attr($digitallaw_theme_options['footertext_bgcolor']); ?>;
		}
		</style>
		
		<?php
	}
}
}
add_action('wp_head','digitallaw_customizer_script');



/*
 *  Exrra plugins
 */
require_once(get_template_directory().'/inc/extra-plugins.php');





// Add SPAN to numbers in Categories widget
if( !function_exists('digitallaw_add_span_cat_count') ){
function digitallaw_add_span_cat_count($links) {
	$links = str_replace('</a> (', '</a> <span>(', $links);
	$links = str_replace(')', ')</span>', $links);
	return $links;
}
}
add_filter('wp_list_categories', 'digitallaw_add_span_cat_count');




/* Custom HTML code */
if( isset($digitallaw_theme_options['customhtml_head']) && trim($digitallaw_theme_options['customhtml_head'])!='' ){
	add_action('wp_head','digitallaw_customhtmlhead', 20);
	if( !function_exists('digitallaw_customhtmlhead') ){
		function digitallaw_customhtmlhead(){
			global $digitallaw_theme_options;
			// We are not sanitizing this as we are expecting any (HTML, CSS, JS) code here
			echo trim($digitallaw_theme_options['customhtml_head']);
		}
	}
}

if( isset($digitallaw_theme_options['customhtml_bodyend']) && trim($digitallaw_theme_options['customhtml_bodyend'])!='' ){
	add_action('wp_footer','digitallaw_customhtmlbodyend', 20);
	if( !function_exists('digitallaw_customhtmlbodyend') ){
		function digitallaw_customhtmlbodyend(){
			global $digitallaw_theme_options;
			// We are not sanitizing this as we are expecting any (HTML, CSS, JS) code here
			echo trim($digitallaw_theme_options['customhtml_bodyend']);
		}
	}
}


if( !empty($digitallaw_theme_options['custom_js_code']) ){
	add_action('wp_footer','digitallaw_custom_js_code', 20);
	if( !function_exists('digitallaw_custom_js_code') ){
		function digitallaw_custom_js_code(){
			global $digitallaw_theme_options;
			echo '<script type="text/javascript"> /* Custom JS Code */ '.trim($digitallaw_theme_options['custom_js_code']).'</script>';// We are not sanitizing this as we are expecting any (JS) code here
		}
	}
}




/*
 *  This is under construction message code
 */
if( !function_exists('digitallaw_uconstruction') ){
function digitallaw_uconstruction(){
	global $digitallaw_theme_options;
	
	if (!is_user_logged_in() && !is_admin() && !empty($digitallaw_theme_options['uconstruction']) && esc_attr($digitallaw_theme_options['uconstruction']) == '1' ){
		
		// We are not sanitizing this as we are expecting any (HTML, CSS, JS) code here
		$uconstruction_html = do_shortcode( $digitallaw_theme_options['uconstruction_html'] );
		
		// Background
		$value = $digitallaw_theme_options['uconstruction_background']; // not escaping as value is array
		$css   = '';
		if ( ! empty( $value ) && is_array( $value ) ) {
			foreach ( $value as $key => $value ) {
				if ( ! empty( $value ) && $key != "media" ) {
					if ( $key == "background-image" ) {
						$css .= $key . ":url('" . $value . "');";
					} else {
						$css .= $key . ":" . $value . ";";
					}
				}
			}
		}
		if( $css!='' ){
			$css = '<style> body{'.$css.'} </style>';
			if( strpos($uconstruction_html, '</head>') !== false ) {
				$uconstruction_html = str_replace('</head>', $css.'</head>', $uconstruction_html);
			} else {
				$uconstruction_html = $uconstruction_html . $css;
			}
		}
		echo $uconstruction_html;
		die();
		
	}
}
}
add_action('template_redirect', 'digitallaw_uconstruction');






if( !function_exists('digitallaw_pf_reset_like') ){
function digitallaw_pf_reset_like(){
	$screen = get_current_screen();
	if ( $screen->post_type == 'tm_portfolio' && isset($_GET['action']) && $_GET['action']=='edit' && !isset($_GET['taxonomy']) ){
		global $post;
		$postID = $_GET['post'];
		$resetVal = get_post_meta($postID, '_thememount_portfolio_like_pflikereset' ,true );
		if( $resetVal=='on' ){
			// Do reset processs now
			update_post_meta($postID, 'thememount_likes' , '0' ); // Setting ZERO
			update_post_meta($postID, '_thememount_portfolio_like_pflikereset' ,'' ); // Removing checkbox
		}
	}
	
}
}
add_action('current_screen', 'digitallaw_pf_reset_like');




/**
 * Enables the Excerpt meta box in Page edit screen.
 */
if( !function_exists('digitallaw_add_excerpt_support_for_pages') ){
function digitallaw_add_excerpt_support_for_pages() {
	add_meta_box('postexcerpt', esc_attr__('Short description for this page (Excerpt)', 'digitallaw'), 'digitallaw_custom_post_excerpt_meta_box', 'page', 'normal', 'default');
}
}
add_action( 'admin_init', 'digitallaw_add_excerpt_support_for_pages' );

if( !function_exists('digitallaw_custom_post_excerpt_meta_box') ){
function digitallaw_custom_post_excerpt_meta_box($post) {
	?>
	<label class="screen-reader-text" for="excerpt"><?php esc_html_e('Excerpt', 'digitallaw') ?></label><textarea rows="1" cols="40" name="excerpt" tabindex="6" id="excerpt"><?php echo esc_attr($post->post_excerpt); ?></textarea>
	<p><?php esc_html_e('Excerpts are optional hand-crafted summaries of your content that can be used in your theme. <a href="http://codex.wordpress.org/Excerpt" target="_blank">Learn more about manual excerpts.</a>', 'digitallaw'); ?></p>
	<div class="tm-highlight-box"><strong><?php esc_html_e('NOTE:','digitallaw') ?></strong> <?php esc_html_e('This text will be used as short description (for this page) on search results page. Please fill this box with short description for this page so user can understand the content type and get perfect result.','digitallaw') ?></div>
	
	<?php
}
}


// Hide GENERATOR meta tag
if( !function_exists('digitallaw_hide_generator_meta_tag') ){
function digitallaw_hide_generator_meta_tag() {
	global $digitallaw_theme_options;
	if( isset($digitallaw_theme_options['hide_generator_meta_tag']) && esc_attr($digitallaw_theme_options['hide_generator_meta_tag']) == '1' ){
		// Remove GENERATOR tag from WordPress
		remove_action('wp_head', 'wp_generator');
		
		// Remove GENERATOR tag from Visual Composer
		if( function_exists('vc_map') ){
			remove_action('wp_head', array(visual_composer(), 'addMetaData'));
		}
		
		// Remove GENERATOR tag from WooCommerce
		if( function_exists('is_woocommerce') ){
			remove_action('wp_head','wc_generator_tag');
		}
		
		// Remove GENERATOR tag from WPML plugin
		global $sitepress;
		if( isset($sitepress) ){
			remove_action( 'wp_head', array($sitepress, 'meta_generator_tag' ) );
		}
		
		// Remove GENERATOR tag from Revolution Slider plugin
		if( !function_exists('tm_remove_revslider_meta_tag') ){
		function tm_remove_revslider_meta_tag() {		 
			return '';
		}
		}
		add_filter( 'revslider_meta_generator', 'tm_remove_revslider_meta_tag' );
		
	}
}
}
add_action( 'init', 'digitallaw_hide_generator_meta_tag' );


/**
 * Setting limit to show number of Portfolios on Portfolio Category page
 */
if( !function_exists('digitallaw_number_of_posts_on_pcat') ){
function digitallaw_number_of_posts_on_pcat($query){
	global $digitallaw_theme_options;
	$pfcat_show = ( !empty($digitallaw_theme_options['pfcat_show']) ) ? esc_attr($digitallaw_theme_options['pfcat_show']) : '9' ;

	if( is_tax( 'tm_portfolio_category' ) && $query->is_main_query() ){
		$query->set('posts_per_page', $pfcat_show);
	}
	return $query;
}
}
add_filter('pre_get_posts', 'digitallaw_number_of_posts_on_pcat');




/**
 *  Setting limit to show number of Team Members on Team Category page
 */
if( !function_exists('digitallaw_number_of_posts_on_teamgroup') ){
function digitallaw_number_of_posts_on_teamgroup($query){
	global $digitallaw_theme_options;
	$teamcat_show = ( !empty($digitallaw_theme_options['teamcat_show']) ) ? esc_attr($digitallaw_theme_options['teamcat_show']) : '9' ;
	
	if( (is_tax( 'tm_team_group' ) || is_post_type_archive( 'tm_team_member' ) ) && $query->is_main_query() && !is_admin() ){
		$query->set('posts_per_page', $teamcat_show);
	}
	return $query;
}
}
add_filter('pre_get_posts', 'digitallaw_number_of_posts_on_teamgroup');







/* ******************** */

if( !function_exists('digitallaw_comment_row_template') ){
function digitallaw_comment_row_template($comment, $args, $depth){
	if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo esc_attr($tag) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author vcard">
        <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
        
    </div>
    <?php if ( $comment->comment_approved == '0' ) : ?>
         <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'digitallaw' ); ?></em>
          <br />
    <?php endif; ?>

    <div class="comment-meta commentmetadata">
		<?php printf( '<cite class="tm-fn fn">%s</cite>', get_comment_author_link() ); ?>
		<a class="tm-comment-date-link" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
			/* translators: 1: date, 2: time */
			printf( esc_attr__('%1$s at %2$s', 'digitallaw'), get_comment_date(),  get_comment_time() ); ?>
		</a>  
		<?php edit_comment_link( esc_attr__( '(Edit)', 'digitallaw' ), '  ', '' );
        ?>
    </div>

    <?php comment_text(); ?>

    <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
    <?php
}
}






/**
 * Add inline CSS for Topbar area based on certain conditions. 
 */
if( !function_exists('digitallaw_topbar_inline_css') ){
function digitallaw_topbar_inline_css(){
	
	global $digitallaw_theme_options;
	$css = '';
	
	if( is_page() ){
		
		$id = get_the_ID();
		
		$topbarOptions = array(
			'topbarbgcolor',
			'topbarbgcustomcolor',
			'topbartextcolor',
			'topbartextcustomcolor',
		);
		
		// Creating blank variables
		foreach( $topbarOptions as $option ){
			${$option} = '';
		}
		
		// Fetching page options
		foreach( $topbarOptions as $option ){
			${'page_'.$option} = trim( get_post_meta( $id, '_thememount_page_options_'.$option, true ) );
		}
		
		// Background color
		if( $page_topbarbgcolor == 'custom' ){
			$topbarbgcustomcolor = $page_topbarbgcustomcolor;
			
			$css = "
				.thememount-topbar, .thememount-topbar .top-contact i{
					background-color: $topbarbgcustomcolor;
				}
			";
		}
		
		// Text Color
		if( $page_topbartextcolor == 'custom' ){
			$topbartextcustomcolor = $page_topbartextcustomcolor;
		
			// Genrating RGB color 
			$topbartextcustomcolorrgb = digitallaw_hex2rgb($topbartextcustomcolor);
			
			
			$css .= "
				.thememount-topbar, .thememount-topbar .top-contact i, .thememount-topbar a:hover{
					color: $topbartextcustomcolor;
				}
				.thememount-topbar a{
					color: rgba($topbartextcustomcolorrgb, 0.70);
				}
			";
		}
	
	}else if( is_home() ){
		
		$id = get_option('page_for_posts');
		
		$topbarOptions = array(
			'topbarbgcolor',
			'topbarbgcustomcolor',
			'topbartextcolor',
			'topbartextcustomcolor',
		);
		
		// Creating blank variables
		foreach( $topbarOptions as $option ){
			${$option} = '';
		}
		
		// Fetching page options
		foreach( $topbarOptions as $option ){
			${'blog_'.$option} = trim( get_post_meta( $id, '_thememount_page_options_'.$option, true ) );
		}
		
		// Background color
		if( $blog_topbarbgcolor == 'custom' ){
			
			$topbarbgcustomcolor = $blog_topbarbgcustomcolor;
			$css = "
				.thememount-topbar, .thememount-topbar .top-contact i{
					background-color: $topbarbgcustomcolor;
				}
			";
			
		}
		
		// Text Color
		if( $blog_topbartextcolor == 'custom' ){
			
			$topbartextcustomcolor = $blog_topbartextcustomcolor;
			
			// Genrating RGB color 
			$topbartextcustomcolorrgb = digitallaw_hex2rgb($topbartextcustomcolor);
			
			$css .= "
				.thememount-topbar, .thememount-topbar .top-contact i, .thememount-topbar a:hover{
					color: $topbartextcustomcolor;
				}
				.thememount-topbar a{
					color: rgba($topbartextcustomcolorrgb, 0.70);
				}
			";
			
		}
		
	}
	

	// Finally write inline CSS code. 
	if( !empty($css) ){
		wp_add_inline_style( 'digitallaw-last-checkpoint', $css );
	}
	
	
}
}
add_action( 'wp_enqueue_scripts', 'digitallaw_topbar_inline_css', 16 );




/**
 * Add inline CSS for Titlebar area based on certain conditions. 
 */
if( !function_exists('digitallaw_titlebar_inline_css') ){
function digitallaw_titlebar_inline_css(){
	
	global $digitallaw_theme_options;
	$css = '';
	
	if( is_page() ){
		
		$id = get_the_ID();
		
		$titlebarOptions = array(
			'titlebar_bg_color',
			'titlebar_bg_custom_color',
			'titlebar_text_color',
			'titlebar_text_custom_color',
			'titlebar_bg_custom_image',
		);
		
		// Creating blank variables
		foreach( $titlebarOptions as $option ){
			${$option} = '';
		}
		
		// Fetching page options
		foreach( $titlebarOptions as $option ){
			${'page_'.$option} = trim( get_post_meta( $id, '_thememount_page_options_'.$option, true ) );
		}
		
		// Background color
		if( $page_titlebar_bg_color == 'custom' ){
			
			// Genrating RGB color 
			$titlebar_bg_custom_color_rgb = digitallaw_hex2rgb($page_titlebar_bg_custom_color);
			
			$css = "
				.tm-titlebar-wrapper .tm-titlebar-inner-wrapper{
					background-color: rgba($titlebar_bg_custom_color_rgb, 0.80);
				}
			";
			
		}
		
		// Text Color
		if( $page_titlebar_text_color == 'custom' ){
			
			$titlebar_text_color = $page_titlebar_text_custom_color;
		
			// Genrating RGB color 
			$titlebar_text_color_rgb = digitallaw_hex2rgb($titlebar_text_color);
			
			$css .= "
				.tm-titlebar-main h1.entry-title, .tm-subtitle{
					color: $titlebar_text_color;
				}
				.tm-titlebar-wrapper .breadcrumb-wrapper{
					color: rgba($titlebar_text_color_rgb, 0.7);
				}
				.tm-titlebar-wrapper .breadcrumb-wrapper a{
					color: rgba($titlebar_text_color_rgb, 1);
				}
				.tm-titlebar-wrapper .breadcrumb-wrapper a:hover{
					color: rgba($titlebar_text_color_rgb, 0.7);
				}
			";
			
		}
		
		// Background Image
		if( isset( $page_titlebar_bg_custom_image ) && trim( $page_titlebar_bg_custom_image ) != '' ){
			
			$imagesrc = wp_get_attachment_image_src( $page_titlebar_bg_custom_image, 'full' );
			$imagesrc = $imagesrc[0];
			
			$css .= "
				body div.tm-titlebar-wrapper{
					background-image:url('$imagesrc');
				}
			";
			
		}
	
	
	
	
	
	
	
	
	
	
	
	} else if( function_exists('is_woocommerce')  && is_woocommerce() ){ // WooCommerce
		$id = wc_get_page_id( 'shop' );
		
		$titlebarOptions = array(
			'titlebar_bg_color',
			'titlebar_bg_custom_color',
			'titlebar_text_color',
			'titlebar_text_custom_color',
			'titlebar_bg_custom_image',
		);
		
		// Creating blank variables
		foreach( $titlebarOptions as $option ){
			${$option} = '';
		}
		
		// Fetching page options
		foreach( $titlebarOptions as $option ){
			${'shop_'.$option} = trim( get_post_meta( $id, '_thememount_page_options_'.$option, true ) );
		}
		
		// Background color
		if( $shop_titlebar_bg_color == 'custom' ){
			
			// Genrating RGB color 
			$titlebar_bg_custom_color_rgb = digitallaw_hex2rgb($shop_titlebar_bg_custom_color);
			
			$css = "
				.tm-titlebar-wrapper .tm-titlebar-inner-wrapper{
					background-color: rgba($titlebar_bg_custom_color_rgb, 0.80);
				}
			";
			
		}
		
		// Text Color
		if( $shop_titlebar_text_color == 'custom' ){
			
			$titlebar_text_color = $shop_titlebar_text_custom_color;
		
			// Genrating RGB color 
			$titlebar_text_color_rgb = digitallaw_hex2rgb($titlebar_text_color);
			
			$css .= "
				.tm-titlebar-main h1.entry-title, .tm-subtitle{
					color: $titlebar_text_color;
				}
				.tm-titlebar-wrapper .breadcrumb-wrapper{
					color: rgba($titlebar_text_color_rgb, 0.7);
				}
				.tm-titlebar-wrapper .breadcrumb-wrapper a{
					color: rgba($titlebar_text_color_rgb, 1);
				}
				.tm-titlebar-wrapper .breadcrumb-wrapper a:hover{
					color: rgba($titlebar_text_color_rgb, 0.7);
				}
			";
			
		}
		
		// Background Image
		if( isset( $shop_titlebar_bg_custom_image ) && trim( $shop_titlebar_bg_custom_image ) != '' ){
			
			$imagesrc = wp_get_attachment_image_src( $shop_titlebar_bg_custom_image, 'full' );
			$imagesrc = $imagesrc[0];
			
			$css .= "
				body div.tm-titlebar-wrapper{
					background-image:url('$imagesrc');
				}
			";
			
		}
		
	
	
	
	
	} else if( is_home() ){
		
		$id = get_option('page_for_posts');
		
		$titlebarOptions = array(
			'titlebar_bg_color',
			'titlebar_bg_custom_color',
			'titlebar_text_color',
			'titlebar_text_custom_color',
			'titlebar_bg_custom_image',
		);
		
		// Creating blank variables
		foreach( $titlebarOptions as $option ){
			${$option} = '';
		}
		
		// Fetching page options
		foreach( $titlebarOptions as $option ){
			${'blog_'.$option} = trim( get_post_meta( $id, '_thememount_page_options_'.$option, true ) );
		}
		
		// Background color
		if( $blog_titlebar_bg_color == 'custom' ){
			
			// Genrating RGB color 
			$titlebar_bg_custom_color_rgb = digitallaw_hex2rgb($blog_titlebar_bg_custom_color);
			
			$css = "
				.tm-titlebar-wrapper .tm-titlebar-inner-wrapper{
					background-color: rgba($titlebar_bg_custom_color_rgb, 0.80);
				}
			";
			
		}
		
		// Text Color
		if( $blog_titlebar_text_color == 'custom' ){
			
			$titlebar_text_color = $blog_titlebar_text_custom_color;
		
			// Genrating RGB color 
			$titlebar_text_color_rgb = digitallaw_hex2rgb($titlebar_text_color);
			
			$css .= "
				.tm-titlebar-main h1.entry-title, .tm-subtitle{
					color: $titlebar_text_color;
				}
				.tm-titlebar-wrapper .breadcrumb-wrapper{
					color: rgba($titlebar_text_color_rgb, 0.7);
				}
				.tm-titlebar-wrapper .breadcrumb-wrapper a{
					color: rgba($titlebar_text_color_rgb, 1);
				}
				.tm-titlebar-wrapper .breadcrumb-wrapper a:hover{
					color: rgba($titlebar_text_color_rgb, 0.7);
				}
			";
			
		}
		
		// Background Image
		if( isset( $blog_titlebar_bg_custom_image ) && trim( $blog_titlebar_bg_custom_image ) != '' ){
			
			$imagesrc = wp_get_attachment_image_src( $blog_titlebar_bg_custom_image, 'full' );
			$imagesrc = $imagesrc[0];
			
			$css .= "
				body div.tm-titlebar-wrapper{
					background-image:url('$imagesrc');
				}
			";
			
		}
		
	} else if(is_single()){
		
		$id 		= get_the_ID();
		$postType 	= esc_attr( get_post_type( $id ) );
		
		
		switch($postType){
			
			case 'post':
				
				$titlebarOptions = array(
					'titlebar_bg_color',
					'titlebar_bg_custom_color',
					'titlebar_text_color',
					'titlebar_text_custom_color',
					'titlebar_bg_custom_image',
				);
				
				// Creating blank variables
				foreach( $titlebarOptions as $option ){
					${$option} = '';
				}
				
				// Fetching page options
				foreach( $titlebarOptions as $option ){
					${'blog_'.$option} = trim( get_post_meta( $id, '_thememount_post_options_'.$option, true ) );
				}
				
				// Background color
				if( $blog_titlebar_bg_color == 'custom' ){
					
					// Genrating RGB color 
					$titlebar_bg_custom_color_rgb = digitallaw_hex2rgb($blog_titlebar_bg_custom_color);
					
					$css = "
						.tm-titlebar-wrapper .tm-titlebar-inner-wrapper{
							background-color: rgba($titlebar_bg_custom_color_rgb, 0.80);
						}
					";
					
				}
				
				// Text Color
				if( $blog_titlebar_text_color == 'custom' ){
					
					$titlebar_text_color = $blog_titlebar_text_custom_color;
				
					// Genrating RGB color 
					$titlebar_text_color_rgb = digitallaw_hex2rgb($titlebar_text_color);
					
					$css .= "
						.tm-titlebar-main h1.entry-title, .tm-subtitle{
							color: $titlebar_text_color;
						}
						.tm-titlebar-wrapper .breadcrumb-wrapper{
							color: rgba($titlebar_text_color_rgb, 0.7);
						}
						.tm-titlebar-wrapper .breadcrumb-wrapper a{
							color: rgba($titlebar_text_color_rgb, 1);
						}
						.tm-titlebar-wrapper .breadcrumb-wrapper a:hover{
							color: rgba($titlebar_text_color_rgb, 0.7);
						}
					";
					
				}
				
				// Background Image
				if( isset( $blog_titlebar_bg_custom_image ) && trim( $blog_titlebar_bg_custom_image ) != '' ){
					
					$imagesrc = wp_get_attachment_image_src( $blog_titlebar_bg_custom_image, 'full' );
					$imagesrc = $imagesrc[0];
					if( !empty($imagesrc) ){
						$css .= "
							body div.tm-titlebar-wrapper{
								background-image:url('$imagesrc');
							}
						";
					}
					
				}
			
			break;
		}
		
	}
	

	// Finally write inline CSS code. 
	if( !empty($css) ){
		wp_add_inline_style( 'digitallaw-last-checkpoint', $css );
	}
	
	
}
}
add_action( 'wp_enqueue_scripts', 'digitallaw_titlebar_inline_css', 16 );








/**
 * Add inline CSS for Titlebar area based on certain conditions. 
 */
if( !function_exists('digitallaw_titlebar_height_inline_css') ){
function digitallaw_titlebar_height_inline_css(){
	
	global $digitallaw_theme_options;
	$css = '';
	
	
	$headerHeight = ( !empty($digitallaw_theme_options['header-height']) ) ? esc_attr($digitallaw_theme_options['header-height']) : '79' ;
	
	// Global Settings
	$topbarHeight = 40;
	if( !empty($digitallaw_theme_options['show_topbar']) ){
		$topbarHeight = 0;
	}
	
	// Page wise settings
	if( is_page() ){
		global $post;
		$pageTopbarHide = get_post_meta( $post->ID, '_thememount_page_topbar_show_topbar', true );
		if( $pageTopbarHide == '0' ){
			$topbarHeight = 0;
		}
	}
	
	$css = '
	.tm-header-overlay .thememount-titlebar-wrapper .thememount-titlebar-inner-wrapper{	
		padding-top: '. ($headerHeight+$topbarHeight) .'px;
	}
	.thememount-header-style-3.tm-header-overlay .thememount-titlebar-wrapper .thememount-titlebar-inner-wrapper{
		padding-top: '. ($headerHeight+$topbarHeight+55) .'px;
	}';


	// Finally write inline CSS code. 
	if( !empty($css) ){
		wp_add_inline_style( 'digitallaw-last-checkpoint', $css );
	}
	
}
}
add_action( 'wp_enqueue_scripts', 'digitallaw_titlebar_height_inline_css', 16 );









/**
 * Add inline CSS for Titlebar area based on certain conditions. 
 */
if(!function_exists('digitallaw_floatingbar_inline_css')){
function digitallaw_floatingbar_inline_css(){
	
	global $digitallaw_theme_options;
	$css = '';
	
	$flotingbarOptions = array(
		'fbar_show',
		'fbar_bg_color',
		'fbar_bg_custom_color',
		'fbar_text_color',
		'fbar_text_custom_color',
	);
	
	foreach( $flotingbarOptions as $option ){
		if( !is_array($digitallaw_theme_options[$option]) ){  
			$$option = esc_attr($digitallaw_theme_options[$option]);
		}else{
			$$option = $digitallaw_theme_options[$option];
		}
	}


	
	if($fbar_show){
	
		// Inline style
		$inlineStyleAll			= '';
		$inlineStyle     		= '';
		$inlineStyle_a   		= '';
		$inlineStyle_ah  		= '';
		$inlineStyle_h   		= '';
		$inlineStyle_border   	= '';
	
		// Custom Background color RGB
		if( $fbar_bg_color == 'custom' && !empty( $fbar_bg_custom_color['rgba'] ) ){
			$css .= '.thememount-fbar-box-w:after{background-color:'.esc_attr($fbar_bg_custom_color['rgba']).';}';
		}
		
		// Custom Text Color
		if( $fbar_text_color == 'custom' && !empty($fbar_text_custom_color) ){
			$fbar_text_custom_color  = esc_attr($fbar_text_custom_color);
			$inlineStyle			.= 'color: rgba( ' . digitallaw_hex2rgb($fbar_text_custom_color) . ', 0.7);';
			$inlineStyle_a			.= 'color: rgba( ' . digitallaw_hex2rgb($fbar_text_custom_color) . ', 1);';
			$inlineStyle_ah			.= 'color: rgba( ' . digitallaw_hex2rgb($fbar_text_custom_color) . ', 0.7);';
			$inlineStyle_h  		.= 'color: rgba( ' . digitallaw_hex2rgb($fbar_text_custom_color) . ', 1);';
			$inlineStyle_border  	.= 'border-color: rgba( ' . digitallaw_hex2rgb($fbar_text_custom_color) . ', 0.7);';
			
			$css .= "
				.thememount-fbar-box-w *, .tm-wrap-cell.tm-fbar-input .search_field.selectbox:after, .thememount-fbar-box .search_field select, .thememount-content-team-search-box .search_field select, .thememount-fbar-box .search_field i, .thememount-content-team-search-box .search_field i { $inlineStyle }
				.thememount-fbar-box-w a, .widget_calendar #today{ $inlineStyle_a }
				.thememount-fbar-box-w a:hover{ $inlineStyle_ah }
				.thememount-fbar-box-w .widget .widget-title{ $inlineStyle_h }
				.thememount-fbar-box-w .widget .widget-title, .thememount-fbar-box-w .widget_calendar table, .thememount-fbar-box-w .widget_calendar th, .thememount-fbar-box-w .widget_calendar td, .thememount-fbar-box .search_field, .contact-info{ $inlineStyle_border }
			";
		}
		
	}
	
	
	// Finally write inline CSS code. 
	if( !empty($css) ){
		wp_add_inline_style( 'digitallaw-last-checkpoint', $css );
	}
	
}
}
add_action( 'wp_enqueue_scripts', 'digitallaw_floatingbar_inline_css', 16 );




/**
 * Add inline JS code to set JavaScript variable tm_breakpoint 
 */
if(!function_exists('digitallaw_menu_breakpoint_inline_script')){
function digitallaw_menu_breakpoint_inline_script(){
	
	global $digitallaw_theme_options;
	$js = '';
	
	$breakpoint = ( !empty($digitallaw_theme_options['menu_breakpoint']) ) ? trim(esc_attr($digitallaw_theme_options['menu_breakpoint'])) : '1200' ;
	
	if( esc_attr($digitallaw_theme_options['menu_breakpoint']) == 'custom' ){
		$breakpoint =  esc_attr($digitallaw_theme_options['menu_breakpoint_custom']);
	}

	$breakpoint = esc_attr($breakpoint);
	
	
	$js = "
		// declaring variable tm_breakpoint
		var tm_breakpoint = $breakpoint;
	";
	
	// Finally write inline JS code. 
	if( !empty($js) ){
		wp_add_inline_script( 'isotope', $js );
	}
	
}
}
add_action( 'wp_enqueue_scripts', 'digitallaw_menu_breakpoint_inline_script');




/**
 * Add inline JS code to set Ajaxurl
 */
if(!function_exists('digitallaw_ajaxurl_inline_script')){
function digitallaw_ajaxurl_inline_script(){
	
	global $digitallaw_theme_options;
	$js = '';
	
	$url	= esc_url(admin_url('admin-ajax.php'));
	$js 	= "var ajaxurl =  '$url';";

	// Finally write inline JS code. 
	if( !empty($js) ){
		wp_add_inline_script( 'isotope', $js );
	}
	
}
}
add_action( 'wp_enqueue_scripts', 'digitallaw_ajaxurl_inline_script');






/**
 * Add inline JS code to thememount_skincolor
 */
if(!function_exists('digitallaw_thememount_skincolor_inline_script')){
function digitallaw_thememount_skincolor_inline_script(){
	
	global $digitallaw_theme_options;
	
	if( !empty($digitallaw_theme_options['skincolor']) ){
		$js = '';
		$color	=  str_replace('#', '', $digitallaw_theme_options['skincolor']);
		$js 	= "
			// declaring variable thememount_skincolor
			var thememount_skincolor = '$color';
		";
		
		// Finally write inline JS code. 
		if( !empty($js) ){
			wp_add_inline_script( 'isotope', $js );
		}
	}
	
	
}
}
add_action( 'wp_enqueue_scripts', 'digitallaw_thememount_skincolor_inline_script');


/**
 * Add inline JS code for One Page Site
 */
if(!function_exists('digitallaw_onepage_site_inline_script')){
function digitallaw_onepage_site_inline_script(){
	
	global $digitallaw_theme_options;
	$js = '';

	if( !empty($digitallaw_theme_options['one_page_site']) && esc_attr($digitallaw_theme_options['one_page_site']) == '1' ){
	
		$js = "
			// One Page Site JS Code
			var x = 1;
			jQuery('.mega-menu a, .menu-main-menu-container a').each(function(){
				if( x != 1 ){
					jQuery(this).parent().removeClass('mega-current-menu-item mega-current_page_item current-menu-ancestor current-menu-item current_page_item');
				}
				x = 0;
			});
		";
		
	}
	
	// Finally write inline JS code. 
	if( !empty($js) ){
		wp_add_inline_script( 'isotope', $js );
	}
	
}
}
add_action( 'wp_enqueue_scripts', 'digitallaw_onepage_site_inline_script');



/**
 * Add inline JS code for page Flex and Nivo Slider 
 */
if(!function_exists('digitallaw_flex_nivo_slider_inline_script')){
function digitallaw_flex_nivo_slider_inline_script(){
	
	global $digitallaw_theme_options;
	$js = '';

	$pageid = '';
	if( is_page() ){
		$pageid = get_the_ID();
	} else if( is_home() ) {
		$pageid = get_option('page_for_posts');
	}
	
	// check if any slider setup on page
	$sliderType = get_post_meta($pageid, '_thememount_page_options_slidertype', true);
	if(isset($sliderType) && is_array($sliderType) ){ 
		$sliderType = $sliderType[0]; 
	}
	
	$slideroptions = trim(get_post_meta( $pageid ,'_thememount_page_options_slideroptions', true ));
	if($slideroptions!=''){ $slideroptions='{'.$slideroptions.'}'; };
	$slideroptions = str_replace('"',"'",$slideroptions);
	$slideroptions = str_replace('"',"'",$slideroptions);
	$slideroptions = str_replace('"',"'",$slideroptions);
	$slideroptions = str_replace('"',"'",$slideroptions);
	$slideroptions = str_replace('"',"'",$slideroptions);
	$slideroptions = str_replace('"',"'",$slideroptions);
	$slideroptions = str_replace('"',"'",$slideroptions);
	$slideroptions = str_replace('"',"'",$slideroptions);
	$slideroptions = str_replace('"',"'",$slideroptions);
	$slideroptions = str_replace('"',"'",$slideroptions);
	
	if( $sliderType == 'flex' ){
		
		// Flex Slider JS call
		$defaultSlideroptions = '{ animation:"slide", controlNav:false, directionNav:true, start:function(){ digitallaw_blogmasonry(); } }';
		
		// Setting default values if no custom options written
		if( trim($slideroptions) == '' || trim($slideroptions) == '{}' ){
			$slideroptions = $defaultSlideroptions;
		} 
		
		$js = "
			// Flex Slider Code
			jQuery( document ).ready(function() {
				jQuery('.thememount-slider-wrapper .flexslider').flexslider($slideroptions);
			});
		";
	
	} else if( $sliderType == 'nivo' ){
		
		$js = "
			// Nivo Slider Code
			jQuery( document ).ready(function() {
				jQuery('.thememount-slider-wrapper .nivoSlider-wrapper').nivoSlider($slideroptions);
			});
		";
		
	}
	
	// Finally write inline JS code. 
	if( !empty($js) ){
		wp_add_inline_script( 'isotope', $js );
	}
	
}
}
add_action( 'wp_enqueue_scripts', 'digitallaw_flex_nivo_slider_inline_script' );




/**
 *  Pre Loader image
 */
if( !function_exists('digitallaw_preloader') ){
function digitallaw_preloader(){
	global  $digitallaw_theme_options;
	$return = '';
	$img    = '';
	
	// Check if pre-defined image is selected 
	if( !empty($digitallaw_theme_options['loaderimg']) && esc_attr($digitallaw_theme_options['loaderimg']) != 'custom' && esc_attr($digitallaw_theme_options['loaderimg']) != 'no' ){
		$img = get_template_directory_uri().'/images/loader'. esc_attr($digitallaw_theme_options['loaderimg']) .'.gif';
	}
	
	// check if custom image for preloader is selected
	if( esc_attr($digitallaw_theme_options['loaderimg'])=='custom' && !empty($digitallaw_theme_options['loaderimage_custom']['url']) ){
		$img = esc_url($digitallaw_theme_options['loaderimage_custom']['url']);
	}
	
	
	if( esc_url($img)!='' ){
		$return = '<div class="tm-page-loader-wrapper" style="background: #fff url(\''. esc_url($img) .'\') no-repeat center center"></div>';
	}
	
	return $return;
}
}




/**
 *  Team Member search box
 */
if( !function_exists('digitallaw_floatingbar') ){
function digitallaw_floatingbar(){
	global $digitallaw_theme_options;
	$optionsArray = array(
						'fbar_show',
						'fbar_bg_color',
						'fbar_bg_custom_color',
						'fbar_text_color',
						'fbar_text_custom_color',
						'fbar_background',
						'fbar_handler_icon',
						'fbar_handler_icon_close',
						'fbar_btn_bg_color',
						'fbar_icon_color',
	);
	
	// Creating variables
	foreach( $optionsArray as $option ){
		$fbar_opt = '';
		if( isset($digitallaw_theme_options[$option]) ){
			if( !is_array($digitallaw_theme_options[$option]) ){  // bypassing color value which is array by default
				$fbar_opt = esc_attr($digitallaw_theme_options[$option]);
			} else {
				$fbar_opt = $digitallaw_theme_options[$option];
			}
		}
		$$option = $fbar_opt;
	}
	
	
	// Check if floating bar is enabled
	if( $fbar_show ){
		
		// Bg image class
		$bgclass = 'tm-fbar-without-bgimage';
		if( !empty($digitallaw_theme_options['fbar_background']['background-image']) ){
			$bgclass = 'tm-fbar-with-bgimage';
		}
		
		
		// If Topbar bg color is set to SKIN color than set the icon color with grey or dark-grey color so it will be visible
		$arrowbgcolorclass = '';
		if( !empty($digitallaw_theme_options['topbarbgcolor']) && esc_attr($digitallaw_theme_options['topbarbgcolor']) == 'skincolor' ){
			$arrowbgcolorclass = 'tm-fbar-btn-bgnoskin';
		}
		
		echo '<div>';
		
		// Trigger background and icon color
		$fbarbtnclass    = '';
		if($fbar_btn_bg_color!='' || $fbar_icon_color!=''){
			$fbarbtnclass  = 'tm-fbar-bg-color-'.sanitize_html_class($fbar_btn_bg_color);
			$fbarbtnclass .= ' tm-fbar-icon-color-'.sanitize_html_class($fbar_icon_color);
		}
		
		
		
		
		// Floatingbar position
		$fbar_position = !empty($digitallaw_theme_options['fbar_position']) ? esc_attr($digitallaw_theme_options['fbar_position']) : 'default' ;
		
		
		// Button
		$fbar_btn_top   = '<span class="thememount-fbar-btn '. sanitize_html_class($arrowbgcolorclass) .' ' . digitallaw_sanitize_html_classes($fbarbtnclass) .'">
                    <a href="#" data-closeicon="'. digitallaw_sanitize_html_classes($fbar_handler_icon_close) .'" data-openicon="'. digitallaw_sanitize_html_classes($fbar_handler_icon) .'"><i class="'. digitallaw_sanitize_html_classes($fbar_handler_icon)  .'"></i>  <span>'. esc_attr__('Open', 'digitallaw') .'</span></a>
                </span>';
		$fbar_btn_right = '';
		if( $fbar_position == 'right' ){
			$fbar_btn_top   = '';
			$fbar_btn_right = '<span class="thememount-fbar-btn '. sanitize_html_class($arrowbgcolorclass) .' ' . digitallaw_sanitize_html_classes($fbarbtnclass) .'">
                    <a href="#" data-closeicon="'. digitallaw_sanitize_html_classes($fbar_handler_icon_close) .'" data-openicon="'. digitallaw_sanitize_html_classes($fbar_handler_icon) .'"><i class="'. digitallaw_sanitize_html_classes($fbar_handler_icon) .'"></i>  <span>'. esc_attr__('Open', 'digitallaw') .'</span></a>
                </span>';
		}
		
		
		?>
		
		<div class="thememount-fbar-main-w thememount-fbar-position-<?php echo sanitize_html_class($fbar_position); ?>">
		
			<?php
			
				echo wp_kses( /* HTML Filter */
					$fbar_btn_top,
					array(
						'form' => array(
							'class' => array(),
							'id' => array(),
							'method' => array(),
							'action' => array(),
						),
						'input' => array(
							'type' => array(),
							'id' => array(),
							'name' => array(),
							'value' => array(),
							'class' => array(),
							'placeholder' => array(),
						),
						'select' => array(
							'name' => array(),
							'class' => array(),
						),
						'option' => array(
							'value' => array(),
							'class' => array(),
						),
						'div' => array(
							'class' => array(),
						),
						'span' => array(
							'class' => array(),
						),
						'i' => array(
							'class' => array(),
						),
						'a' => array(
							'href'           => array(),
							'class'          => array(),
							'data-closeicon' => array(),
							'data-openicon'  => array(),
						),
					)
				);
			
			
			?>

			<div class="thememount-fbar-box-w thememount-fbar-text-<?php echo sanitize_html_class($fbar_text_color); ?> thememount-fbar-bg-<?php echo sanitize_html_class($fbar_bg_color); ?> <?php echo sanitize_html_class($bgclass); ?>" >
				
				<?php 				
				echo wp_kses( /* HTML Filter */
					$fbar_btn_right,
					array(
						'form' => array(
							'class' => array(),
							'id' => array(),
							'method' => array(),
							'action' => array(),
						),
						'input' => array(
							'type' => array(),
							'id' => array(),
							'name' => array(),
							'value' => array(),
							'class' => array(),
							'placeholder' => array(),
						),
						'select' => array(
							'name' => array(),
							'class' => array(),
						),
						'option' => array(
							'value' => array(),
							'class' => array(),
						),
						'div' => array(
							'class' => array(),
						),
						'span' => array(
							'class' => array(),
						),
						'i' => array(
							'class' => array(),
						),
						'a' => array(
							'href'           => array(),
							'class'          => array(),
							'data-closeicon' => array(),
							'data-openicon'  => array(),
						),
					)
				);
				
				?>

				<div class="container thememount-fbar-box" style="">
				
				  <div class="row multi-columns-row">
					<?php if( !dynamic_sidebar( 'floating-header-widgets' ) ){
						// no sidebar
					} ?>
				  </div>
				</div>
			</div>
		
		</div>
		
		</div>
		<?php
		
	}
	
}
}







/**
 *  Topbar box
 */
if( !function_exists('digitallaw_topbar') ){
function digitallaw_topbar(){
	

	global $digitallaw_theme_options;
	
	$optionsArray = array(
						'show_topbar',
						'topbarbgcolor',
						'topbarbgcustomcolor',
						'topbartextcolor',
						'topbartextcustomcolor',
						'topbarlefttext',
						'topbarrighttext',
	);
	
	// Global options
	foreach( $optionsArray as $option ){
		if( $option=='topbarlefttext' || $option=='topbarrighttext' ){
			$tbaropt = wp_kses( /* HTML Filter */
				$digitallaw_theme_options[$option],
				array(
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
			
		} else if( !is_array($digitallaw_theme_options[$option]) ){  // Bypassing color which is as array
			$tbaropt = esc_attr($digitallaw_theme_options[$option]);
			
		} else {
			$tbaropt = $digitallaw_theme_options[$option];
		}
		${$option} = $tbaropt;
	}
	
	// Page options
	if( is_page() ){
		foreach( $optionsArray as $option ){
			${'page_'.$option} = trim( get_post_meta( get_the_ID(), '_thememount_page_options_'.$option, true ) );
		}

		// Show / Hide Topbar
		if( $page_show_topbar!='' ){
			$show_topbar = $page_show_topbar;
		}
		
		// Background color
		if( $page_topbarbgcolor!='' ){
			$topbarbgcolor = $page_topbarbgcolor;
			if( $page_topbarbgcolor=='custom' ){
				$topbarbgcustomcolor = $page_topbarbgcustomcolor;
			}
		}
		
		// Text Color
		if( $page_topbartextcolor!='' ){
			$topbartextcolor = $page_topbartextcolor;
			if( $page_topbartextcolor=='custom' ){
				$topbartextcustomcolor = $page_topbartextcustomcolor;
			}
		}
		
		// Left Content
		if( $page_topbarlefttext!='' ){
			$topbarlefttext = wp_kses( /* HTML Filter */
				$page_topbarlefttext,
				array(
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
			
		}
		
		// Right Content
		if( $page_topbarrighttext!='' ){
			$topbarrighttext = wp_kses( /* HTML Filter */
				$page_topbarrighttext,
				array(
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
		}
		
	}else if( is_home() ){
		$pageid = get_option('page_for_posts');
		foreach( $optionsArray as $option ){
			${'blog_'.$option} = trim( get_post_meta( $pageid, '_thememount_page_options_'.$option, true ) );
		}
		
		// Show / Hide Topbar
		if( $blog_show_topbar!='' ){
			$show_topbar = $blog_show_topbar;
		}
		
		// Background color
		if( $blog_topbarbgcolor!='' ){
			$topbarbgcolor = $blog_topbarbgcolor;
			if( $blog_topbarbgcolor=='custom' ){
				$topbarbgcustomcolor = $blog_topbarbgcustomcolor;
			}
		}
		
		// Text Color
		if( $blog_topbartextcolor!='' ){
			$topbartextcolor = $blog_topbartextcolor;
			if( $blog_topbartextcolor=='custom' ){
				$topbartextcustomcolor = $blog_topbartextcustomcolor;
			}
		}
		
		// Left Content
		if( $blog_topbarlefttext!='' ){
			$topbarlefttext = wp_kses( /* HTML Filter */
				$blog_topbarlefttext,
				array(
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
			
		}
		
		// Right Content
		if( $blog_topbarrighttext!='' ){
			$topbarrighttext = wp_kses( /* HTML Filter */
				$blog_topbarrighttext,
				array(
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
		}
		
	}
	
	
	if( $show_topbar=='1' ){
		global $digitallaw_theme_options;
		$return       = '';
		$leftContent  = do_shortcode($topbarlefttext);
		$rightContent = do_shortcode($topbarrighttext);
		
		
		if( trim($rightContent) == '' ){
			$return .= '<div class="tm-center-content">';
			$return .= '<div class="thememount-tb-left-content thememount-center">'.$leftContent.'</div>';
			$return .= '</div>';
		} else {
			$return .= '<div class="table-row">';
			$return .= '<div class="thememount-tb-left-content thememount-flexible-width-left">'.$leftContent.'</div>';
			$return .= '<div class="thememount-tb-right-content thememount-flexible-width-right">'.$rightContent.'</div>';
			$return .= '</div> <!-- .table-row -->';
		}
		
		echo '<div>';
		echo '
			<div class="thememount-topbar thememount-topbar-textcolor-'.sanitize_html_class($topbartextcolor).' thememount-topbar-bgcolor-'. sanitize_html_class($topbarbgcolor) .'">
				<div class="container">
					'.$return.'
				</div>
			</div>';
		echo '</div>';
		
	}
}
}





/*
 *  Header dynamic class for different settings
 */
if( !function_exists('digitallaw_headerclass') ){
function digitallaw_headerclass(){
	global $digitallaw_theme_options;
	$headerClassList = array();
	
	// Main Menu active link color
	if( !empty($digitallaw_theme_options['mainmenu_active_link_color']) ){
		$headerClassList[] = 'tm-mmenu-active-color-'.sanitize_html_class($digitallaw_theme_options['mainmenu_active_link_color']);
	} else {
		$headerClassList[] = 'tm-mmenu-active-color-skin';
	}
	
	// Dropdown Menu active link color
	if( !empty($digitallaw_theme_options['dropmenu_active_link_color']) ){
		$headerClassList[] = 'tm-dmenu-active-color-'.sanitize_html_class($digitallaw_theme_options['dropmenu_active_link_color']);
	} else {
		$headerClassList[] = 'tm-dmenu-active-color-skin';
	}
	
	// Dropdown Menu separator
	if( !empty($digitallaw_theme_options['dropdown_menu_separator']) && trim(esc_attr($digitallaw_theme_options['dropdown_menu_separator'])) != '' ){
		$headerClassList[] = 'tm-dmenu-sep-'.sanitize_html_class($digitallaw_theme_options['dropdown_menu_separator']);
	}
	
	// Dropdown Menu Vertical separator
	if( !empty($digitallaw_theme_options['dropdown_menu_separator_vertical']) && trim(esc_attr($digitallaw_theme_options['dropdown_menu_separator_vertical'])) != '' ){
		$headerClassList[] = 'tm-dmenu-v-sep-'.sanitize_html_class($digitallaw_theme_options['dropdown_menu_separator_vertical']);
	} 
	
	return implode(' ', $headerClassList);
}
}





 
/**
 *  Customized search form
 */
if( !function_exists('digitallaw_get_search_form') ){
function digitallaw_get_search_form(){
	global $digitallaw_theme_options;
	$var_search_input = $digitallaw_theme_options['search_input'];
	$search_input = ( !empty($digitallaw_theme_options['search_input']) ) ? esc_attr($var_search_input) :  esc_attr_x("WRITE SEARCH WORD...", 'Search placeholder word', 'digitallaw');
	
	?>
	
	<!-- search form -->
	<div class="k_flying_searchform_wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<form method="get" id="flying_searchform" action="<?php echo esc_url( home_url() ); ?>" >
						<div class="w-search-form-h">
							<div class="w-search-form-row">
								<div class="w-search-input">
									<input type="text" class="field searchform-s" name="s" id="searchval" placeholder="<?php echo esc_attr($search_input); ?>" value="<?php echo get_search_query() ?>" />
									<button class="header-search" type="submit"><i class="fa fa-search"></i></button>
								</div>
							</div>
						</div>
					</form>
					<div class="tm-search-close">
						<i class="fa fa-close"></i>
					</div>
				</div><!-- .col-md-12 -->
			</div><!-- .row -->
		</div><!-- .container -->
	</div>
	<!-- .k_flying_searchform_wrapper --> 
	
	<?php
	
}
}






/**
 *  Header Titlebar
 */
if( !function_exists('digitallaw_header_titlebar') ){
function digitallaw_header_titlebar(){
	global $digitallaw_theme_options;
	global $wp_query;
	$inlineStyle    = '';
	//$inlineCSS      = '';
	$hidetitlebar   = false;
	$hidebreadcrumb = false;
	$subtitle       = '';
	
	
	
	// Working perfectly
	$hidebreadcrumb             = esc_attr($digitallaw_theme_options['tbar_hide_bcrumb']);
	$titlebar_bg_color          = esc_attr($digitallaw_theme_options['titlebar_bg_color']);
	$titlebar_text_color        = esc_attr($digitallaw_theme_options['titlebar_text_color']);
	$titlebar_view              = esc_attr($digitallaw_theme_options['titlebar_view']);  // Text Align
	
	$var_blog_tbar_title = $digitallaw_theme_options['blog_tbar_title'];
	$blog_tbar_title = ( !empty($var_blog_tbar_title) ) ? esc_attr($var_blog_tbar_title) : esc_attr__('Blog', 'digitallaw') ;
	
	$titlebar_bg_custom_color   = $digitallaw_theme_options['titlebar_bg_custom_color'];  // We are not escaping this because this is array
	$titlebar_text_custom_color = esc_attr($digitallaw_theme_options['titlebar_text_custom_color']);
	$titlebar_bg_color_type     = 'rgb';
	$titlebar_background        = $digitallaw_theme_options['titlebar_background'];  // We are not escaping this because this is array
	
	
	if( is_page() ){ // Page
		$hidetitlebar   = esc_attr(get_post_meta( get_the_ID(), '_thememount_page_options_hidetitlebar', true ));
		$title          = esc_attr( trim(get_post_meta( get_the_ID(), '_thememount_page_options_title', true)) );
		$subtitle       = esc_attr( trim(get_post_meta( get_the_ID(), '_thememount_page_options_subtitle', true)) );
		$hidebreadcrumb = esc_attr(get_post_meta( get_the_ID(), '_thememount_page_options_hidebreadcrumb', true));
		$title  = ( $title != '' ? $title : get_the_title( get_the_ID() ) );
		
		$page_titlebar_bg_custom_image = wp_get_attachment_image_src(get_post_meta( get_the_ID(), '_thememount_page_options_titlebar_bg_custom_image', true) , 'full' );
		
		
		/*********************/
		$titlebar_bg_color = ( get_post_meta( get_the_ID(), '_thememount_page_options_titlebar_bg_color', true)!='' ) ?  esc_attr(get_post_meta( get_the_ID(), '_thememount_page_options_titlebar_bg_color', true)) : $titlebar_bg_color ;
		$titlebar_text_color = ( get_post_meta( get_the_ID(), '_thememount_page_options_titlebar_text_color', true)!='' ) ?  esc_attr(get_post_meta( get_the_ID(), '_thememount_page_options_titlebar_text_color', true)) : $titlebar_text_color ;
		$titlebar_view = ( get_post_meta( get_the_ID(), '_thememount_page_options_titlebar_view', true)!='' ) ? esc_attr(get_post_meta( get_the_ID(), '_thememount_page_options_titlebar_view', true)) : $titlebar_view ;
		
		
		if( get_post_meta( get_the_ID(), '_thememount_page_options_titlebar_text_color', true)=='custom' ){
			$titlebar_text_custom_color = ( get_post_meta( get_the_ID(), '_thememount_page_options_titlebar_text_custom_color', true)!='' ) ? esc_attr(get_post_meta( get_the_ID(), '_thememount_page_options_titlebar_text_custom_color', true)) : $titlebar_text_custom_color ;
		}
		
		if( get_post_meta( get_the_ID(), '_thememount_page_options_titlebar_bg_color', true)=='custom' ){
			$titlebar_bg_custom_color = ( get_post_meta( get_the_ID(), '_thememount_page_options_titlebar_bg_custom_color', true)!='' ) ? esc_attr(get_post_meta( get_the_ID(), '_thememount_page_options_titlebar_bg_custom_color', true)) : $titlebar_bg_custom_color ;
			$titlebar_bg_color_type     = 'hex';
		}
		
		
		$titlebar_bg_custom_image = ( get_post_meta( get_the_ID(), '_thememount_page_options_titlebar_bg_custom_image', true)!='' ) ? esc_attr(get_post_meta( get_the_ID(), '_thememount_page_options_titlebar_bg_custom_image', true)) : '' ;
		

		
		/***********************/
		
		
	} else if( function_exists('is_woocommerce')  && is_woocommerce() ){ // WooCommerce
		$hidetitlebar   = '';
		$title          = '';
		$subtitle       = '';
		$hidebreadcrumb = '';
		//$icon           = '';
		
		if ( is_search() ) {
			$title = sprintf( esc_attr__( 'Search Results: &ldquo;%s&rdquo;', 'digitallaw' ), get_search_query() );
			if ( get_query_var( 'paged' ) ){
				$title .= sprintf( esc_attr__( '&nbsp;&ndash; Page %s', 'digitallaw' ), get_query_var( 'paged' ) );
			}
		} elseif ( is_tax() ) {
			$title = single_term_title( "", false );
		} else {
			$shop_page_id = wc_get_page_id( 'shop' ); // Getting shop page ID
			
			$hidetitlebar   = esc_attr(get_post_meta( $shop_page_id, '_thememount_page_options_hidetitlebar', true ));
			$title          = esc_attr( trim(get_post_meta( $shop_page_id, '_thememount_page_options_title', true)) );
			$subtitle       = esc_attr( trim(get_post_meta( $shop_page_id, '_thememount_page_options_subtitle', true)) );
			$hidebreadcrumb = esc_attr(get_post_meta( $shop_page_id, '_thememount_page_options_hidebreadcrumb', true));
			$title  = ( $title != '' ? $title : esc_attr(get_the_title( $shop_page_id )) );
			
			$page_titlebar_bg_image        = esc_attr(get_post_meta( $shop_page_id, '_thememount_page_options_titlebar_bg_image', true));
			
			
			
			$page_titlebar_bg_custom_image_id = get_post_meta( $shop_page_id, '_thememount_page_options_titlebar_bg_custom_image', true);
			$page_titlebar_bg_custom_image = '';
			if( trim($page_titlebar_bg_custom_image_id)!='' ){
				$titlebar_bg_custom_image = $page_titlebar_bg_custom_image_id;
			}
			
		
		}
		$woocommerce_Active = true;
		
	} else if( is_home() ){ // Blogroll
		if( get_option('page_for_posts') == 0 ){
			$hidetitlebar   = true;
		} else {
			$page_id        = get_option('page_for_posts');
			$hidetitlebar   = esc_attr(get_post_meta( $page_id, '_thememount_page_options_hidetitlebar', true ));
			$title          = esc_attr( trim(get_post_meta( $page_id, '_thememount_page_options_title', true)) );
			$subtitle       = esc_attr( trim(get_post_meta( $page_id, '_thememount_page_options_subtitle', true)) );
			$hidebreadcrumb = esc_attr(get_post_meta( $page_id, '_thememount_page_options_hidebreadcrumb', true ));
			$title          = ( $title != '' ? $title : esc_attr(get_the_title( $page_id )) );
			
			$page_titlebar_bg_image        = esc_attr(get_post_meta( $page_id, '_thememount_page_options_titlebar_bg_image', true));
			$page_titlebar_bg_custom_image = wp_get_attachment_image_src(get_post_meta( $page_id, '_thememount_page_options_titlebar_bg_custom_image', true) , 'full' );
			
			// Page option overriding global options : Predefined image
			if( $page_titlebar_bg_image!='' && $page_titlebar_bg_image!='global' && $page_titlebar_bg_image!='custom' ){
				$titlebar_bg_image_type = 'image';
				$titlebar_bg_image      = $page_titlebar_bg_image;
			}
			
			// Page option overriding global options : Custom image
			if( $page_titlebar_bg_image == 'custom' ){
				$titlebar_bg_image_type   = 'custom';
				if( isset($page_titlebar_bg_custom_image[0]) && $page_titlebar_bg_custom_image[0]!='' ){
					$page_titlebar_bg_custom_image[0] = esc_url($page_titlebar_bg_custom_image[0]);
				}
				$titlebar_bg_custom_image = @$page_titlebar_bg_custom_image[0];
			}
			
			
			/*********************/
			$titlebar_bg_color = ( get_post_meta( $page_id, '_thememount_page_options_titlebar_bg_color', true)!='' ) ?  esc_attr(get_post_meta( $page_id, '_thememount_page_options_titlebar_bg_color', true)) : $titlebar_bg_color ;
			$titlebar_text_color = ( get_post_meta( $page_id, '_thememount_page_options_titlebar_text_color', true)!='' ) ? esc_attr(get_post_meta( $page_id, '_thememount_page_options_titlebar_text_color', true)) : $titlebar_text_color ;
			$titlebar_view = ( get_post_meta( $page_id, '_thememount_page_options_titlebar_view', true)!='' ) ?  esc_attr(get_post_meta( $page_id, '_thememount_page_options_titlebar_view', true)) : $titlebar_view ;
			
			if( get_post_meta( $page_id, '_thememount_page_options_titlebar_text_color', true)=='custom' ){
				$titlebar_text_custom_color = ( get_post_meta( $page_id, '_thememount_page_options_titlebar_text_custom_color', true)!='' ) ?  esc_attr(get_post_meta( $page_id, '_thememount_page_options_titlebar_text_custom_color', true)) : $titlebar_text_custom_color ;
			}
			if( get_post_meta( $page_id, '_thememount_page_options_titlebar_bg_color', true)=='custom' ){
				$titlebar_bg_custom_color = ( get_post_meta( $page_id, '_thememount_page_options_titlebar_bg_custom_color', true)!='' ) ? esc_attr(get_post_meta( $page_id, '_thememount_page_options_titlebar_bg_custom_color', true)) : $titlebar_bg_custom_color ;
				$titlebar_bg_color_type     = 'hex';
			}
			
			$titlebar_bg_custom_image = ( get_post_meta( $page_id, '_thememount_page_options_titlebar_bg_custom_image', true)!='' ) ? esc_attr(get_post_meta( $page_id, '_thememount_page_options_titlebar_bg_custom_image', true)) : '' ;
			
			/***********************/
				
			
		}
	} else if( is_single() ){ // Single Post
		$postType = esc_attr(get_post_type( get_the_ID() ));
		
		switch($postType){
			case 'post':
				//$page_for_posts = get_option('page_for_posts');
				$hidetitlebar   = esc_attr(get_post_meta( get_the_ID(), '_thememount_post_options_hidetitlebar', true ));
				$customtitle    = esc_attr( trim(get_post_meta( get_the_ID(), '_thememount_post_options_title', true)) );
				//$rawtitle       = esc_attr(get_the_title( get_the_ID() ));
				$rawtitle       = esc_attr($blog_tbar_title);
				$title          = ($customtitle=='') ? $rawtitle : $customtitle ;
				$subtitle       = esc_attr( trim(get_post_meta( get_the_ID(), '_thememount_post_options_subtitle', true)) );
				$hidebreadcrumb = esc_attr(get_post_meta( get_the_ID(), '_thememount_post_options_hidebreadcrumb', true));
				$title          = ( $title != '' ? $title : get_the_title( get_the_ID() ) );
				
				/*********************/
				$titlebar_bg_color = ( get_post_meta( get_the_ID(), '_thememount_post_options_titlebar_bg_color', true)!='' ) ?  esc_attr(get_post_meta( get_the_ID(), '_thememount_post_options_titlebar_bg_color', true))  : $titlebar_bg_color ;
				$titlebar_text_color = ( get_post_meta( get_the_ID(), '_thememount_post_options_titlebar_text_color', true)!='' ) ?  esc_attr(get_post_meta( get_the_ID(), '_thememount_post_options_titlebar_text_color', true))  : $titlebar_text_color ;
				$titlebar_view = ( get_post_meta( get_the_ID(), '_thememount_post_options_titlebar_view', true)!='' ) ?  esc_attr(get_post_meta( get_the_ID(), '_thememount_post_options_titlebar_view', true))  : $titlebar_view ;
				
				if( get_post_meta( get_the_ID(), '_thememount_post_options_titlebar_text_color', true)=='custom' ){
					$titlebar_text_custom_color = ( get_post_meta( get_the_ID(), '_thememount_post_options_titlebar_text_custom_color', true)!='' ) ?  esc_attr(get_post_meta( get_the_ID(), '_thememount_post_options_titlebar_text_custom_color', true))  : $titlebar_text_custom_color ;
				}
				if( get_post_meta( get_the_ID(), '_thememount_post_options_titlebar_bg_color', true)=='custom' ){
					$titlebar_bg_custom_color = ( get_post_meta( get_the_ID(), '_thememount_post_options_titlebar_bg_custom_color', true)!='' ) ?  esc_attr(get_post_meta( get_the_ID(), '_thememount_post_options_titlebar_bg_custom_color', true))  : $titlebar_bg_custom_color ;
					$titlebar_bg_color_type     = 'hex';
				}
				
				$titlebar_bg_custom_image = ( get_post_meta( get_the_ID(), '_thememount_post_options_titlebar_bg_custom_image', true)!='' ) ?  esc_attr(get_post_meta( get_the_ID(), '_thememount_post_options_titlebar_bg_custom_image', true))  : '' ;
				
				
				/***********************/
		
				
				
				$post_titlebar_bg_image = esc_attr(get_post_meta( get_the_ID(), '_thememount_post_options_titlebar_bg_image', true));
				$post_titlebar_bg_custom_image = wp_get_attachment_image_src(get_post_meta( get_the_ID(), '_thememount_post_options_titlebar_bg_custom_image', true) , 'full' );
				
				// Page option overriding global options : Predefined image
				if( $post_titlebar_bg_image!='' && $post_titlebar_bg_image!='global' && $post_titlebar_bg_image!='custom' ){
					$titlebar_bg_image_type = 'image';
					$titlebar_bg_image      = $post_titlebar_bg_image;
				}
				
				// Page option overriding global options : Custom image
				if( $post_titlebar_bg_image == 'custom' ){
						$titlebar_bg_image_type   = 'custom';
						$titlebar_bg_custom_image = @esc_url($post_titlebar_bg_custom_image[0]);
				}
				
				break;

			case 'tm_portfolio':
				$title = get_the_title();
				$var_pf_type_title = $digitallaw_theme_options['pf_type_title'];
				if( !empty($var_pf_type_title) ){ $title = esc_attr($var_pf_type_title); }
				$hidebreadcrumb = 'off';
				break;	
				
			case 'tm_team_member':
				$title          = get_the_title();
				$hidebreadcrumb = 'off';
				break;	
				
			case 'forum':
			case 'topic':
				$title          = get_the_title();
				$hidebreadcrumb = 'on';
				break;
			default:
				$title          = get_the_title();
				$hidebreadcrumb = 'off';
				break;
		}
		
	} else if( is_category() ){ // Category
		
		$var_adv_tbar_catarc  = $digitallaw_theme_options['adv_tbar_catarc'];
		$var_single_cat_title = single_cat_title( '', false);
		
		$adv_tbar_catarc = ( !empty($var_adv_tbar_catarc) ) ? esc_attr($var_adv_tbar_catarc) : esc_attr__('Category Archives:', 'digitallaw') ;
		$title = sprintf(
			$adv_tbar_catarc.' %s',
			'<span>' . esc_attr( $var_single_cat_title ) . '</span>'  // for WPML
		);
		$subtitle = category_description();
		
	} else if( is_tag() ){ // Tag
		$var_adv_tbar_tagarc  = $digitallaw_theme_options['adv_tbar_tagarc'];
		$var_single_tag_title = single_tag_title( '', false);
		
		$adv_tbar_tagarc = !empty( $var_adv_tbar_tagarc ) ? esc_attr($var_adv_tbar_tagarc) : esc_attr__('Tag Archives:','digitallaw') ;
		$title = sprintf(
			$adv_tbar_tagarc.' %s',
			'<span>' . esc_attr($var_single_tag_title) . '</span>'  // for WPML
		);
		$subtitle        = tag_description();
		
	} else if( is_tax() ){ // Taxonomy
		global $wp_query;
		$tax          = $wp_query->get_queried_object();
		$var_tax_name = $tax->name;
		
		if( is_tax('tm_team_group') || is_tax('tm_portfolio_category') ){
			
			$title = '<span>' . esc_attr($var_tax_name) . '</span>';
			
		} else {
			global $wp_query;
			$var_adv_tbar_postclassified = $digitallaw_theme_options['adv_tbar_postclassified'];
			
			$adv_tbar_postclassified = !empty( $var_adv_tbar_postclassified ) ? esc_attr($var_adv_tbar_postclassified) : esc_attr__('Posts classified under:', 'digitallaw') ;
		
			$title = sprintf(
				$adv_tbar_postclassified.' %s',
				'<span>' . esc_attr( $var_tax_name ) . '</span>'
			);
			
		}
		
	} else if( is_author() ){ // Author
		if ( have_posts() ){
			the_post();
			
			$var_adv_tbar_authorarc = $digitallaw_theme_options['adv_tbar_authorarc'];
			
			$adv_tbar_authorarc = !empty( $var_adv_tbar_authorarc ) ? esc_attr($var_adv_tbar_authorarc) : esc_attr__('Author Archives:', 'digitallaw');
			$title = sprintf(
				$adv_tbar_authorarc.' %s',
				'<span>' . get_the_author() . '</span>'
			);
			
		}

	} else if( is_search()  ){ // Search Results
		$title    = sprintf( esc_attr__( 'Search Results for %s', 'digitallaw' ), '<strong><span>' . get_search_query() . '</span></strong>' );
	
	} else if( is_404() ){ // 404
		$hidetitlebar   = true;  // Hide Titlebox on 404 error page

	} else if( is_archive() ){ // Archive
	
		
		// Title for events calendar pages
		if( function_exists('tribe_is_month') && tribe_is_month() && !is_tax() ) { // The Main Calendar Page
			$title = esc_attr__( 'Events Calendar', 'digitallaw' );
			
		} elseif( function_exists('tribe_is_month') && tribe_is_month() && is_tax() ) { // Calendar Category Pages
			$title = single_term_title('', false);
			
		} elseif( function_exists('tribe_is_event') &&  tribe_is_event() && !tribe_is_day() && !is_single() ) { // The Main Events List
			$title = esc_attr__( 'Events', 'digitallaw' );

		} elseif( function_exists('tribe_is_event') && tribe_is_event() && is_single() ) { // Single Events
			$title = get_the_title();
			
		} elseif( function_exists('tribe_is_day') && tribe_is_day() ) { // Single Event Days
			$title = esc_attr__( 'Events on: ', 'digitallaw' ). date('F j, Y', strtotime($wp_query->query_vars['eventDate']));
			
		} elseif( function_exists('tribe_is_venue') && tribe_is_venue() ) { // Single Venues
			$title =	get_the_title();
			
			
		// BBPress section
		} else if( function_exists('is_bbpress') && is_bbpress() ) {
			$title = esc_attr__( 'Forum', 'digitallaw' );
			$hidebreadcrumb = 'on';
		} else if( is_post_type_archive() ){
			if( is_post_type_archive('tm_team_member') ){
				
				$var_team_type_archive_title = $digitallaw_theme_options['team_type_archive_title'];
				
				$title = ( !empty($var_team_type_archive_title) ) ? esc_attr($var_team_type_archive_title) : esc_attr__('Team Members', 'digitallaw') ;
			} else {
				$title = post_type_archive_title('', false);
			}
		} else if ( is_day() ){
			$title = sprintf( esc_attr__( 'Daily Archives: %s', 'digitallaw' ), '<span>' . get_the_date() . '</span>' );
		} elseif( is_month() ){
			$title = sprintf( esc_attr__( 'Monthly Archives: %s', 'digitallaw' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'digitallaw' ) ) . '</span>' );
		} elseif( is_year() ){
			$title = sprintf( esc_attr__( 'Yearly Archives: %s', 'digitallaw' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'digitallaw' ) ) . '</span>' );
		} else {
			if( function_exists('is_bbpress') && is_bbpress() ) {
				$title = esc_attr__( 'Forum', 'digitallaw' );
			} else {
				$title = esc_attr__( 'Archives', 'digitallaw' );
			}
		};
	
	
	} else {
		$title          = get_the_title();
		$hidebreadcrumb = 'on';
	}
	
	// Theme Options : Hide Breadcrumb globally
	global $digitallaw_theme_options;
	if( isset($digitallaw_theme_options['tbar_hide_bcrumb']) && $digitallaw_theme_options['tbar_hide_bcrumb']=='1' ){
		$hidebreadcrumb = 'on';
	}
	
	
	
	
	
	
	
	if( $hidetitlebar != 'on' ){
		
		$imagesrc = '';
		if( isset($titlebar_bg_custom_image) && trim($titlebar_bg_custom_image)!='' ){
			$imagesrc = wp_get_attachment_image_src( $titlebar_bg_custom_image, 'full' );
		}
		
		
		$e_class  = ( $subtitle != '' ? 'tm-with-subtitle' : 'tm-without-subtitle' );
		$e_class .= ( $hidebreadcrumb == 'on' ? ' tm-no-breadcrumb' : ' tm-with-breadcrumb' );
		$e_class .= ( isset($titleNavigation) ? ' tm-with-proj-navigation' : ' tm-without-proj-navigation' );
		$e_class .= ( ( !empty($titlebar_background['background-image']) ) || (isset($imagesrc[0]) && $imagesrc[0]!='') ) ? ' tm-titlebar-with-bgimage' : '' ;
		$h1Class    = 'headingblock';
		$bcClass    = 'breadcrumbblock';
		
		$subtitle = ($subtitle!='') ? '<h3 class="tm-subtitle">'.do_shortcode($subtitle).'</h3>' : '' ;

		$leftContent = '<div class="entry-title-wrapper">
							' . $subtitle . '
							<h1 class="entry-title"> ' . do_shortcode($title) . '</h1>

						<div class="white-line-ac"></div>
						</div>';
					
		$rightContent = '';
		if($hidebreadcrumb!='on'){
			//$rightContent .= '<div class="breadcrumb-wrapper">';
			if(function_exists('bcn_display')){
				$rightContent .=  '<!-- Breadcrumb NavXT output -->';
				$rightContent .= '<div class="breadcrumb-wrapper">';
				$rightContent .= bcn_display(true);
				$rightContent .=  '</div><!-- .breadcrumb-wrapper -->';
			} else if( function_exists('is_woocommerce') && is_woocommerce() ) {
				$rightContent .=  '<!-- woocommerce_breadcrumb -->';
				$rightContent .= '<div class="breadcrumb-wrapper">';
				ob_start();
				woocommerce_breadcrumb(); //would normally get printed to the screen/output to browser
				$tm_wc_bcrumb_output = ob_get_contents();
				ob_end_clean();
				$rightContent .= $tm_wc_bcrumb_output;
				$rightContent .=  '</div><!-- .breadcrumb-wrapper -->';
			} else {
				$breacrumb_nav_data = digitallaw_get_breadcrumb_navigation();
				if( $breacrumb_nav_data!='' ){
					$rightContent .=  '<!-- digitallaw_get_breadcrumb_navigation -->';
					$rightContent .= '<div class="breadcrumb-wrapper">';
					$rightContent .= digitallaw_get_breadcrumb_navigation();
					$rightContent .=  '</div><!-- .breadcrumb-wrapper -->';
				}
				
			}
			//$rightContent .=  '</div><!-- .breadcrumb-wrapper -->';
		} // if($hidebreadcrumb!='on')
			
		
		// Left Align Content
		$allContent = $leftContent . $rightContent;
		if( $titlebar_view == 'right' ){  // Right align
			$allContent = $rightContent . $leftContent;
		}
		
		?>
		
		<div>
			<div class="tm-titlebar-wrapper entry-header <?php echo digitallaw_sanitize_html_classes($e_class); ?> tm-titlebar-bgcolor-<?php echo sanitize_html_class($titlebar_bg_color); ?> tm-titlebar-textcolor-<?php echo sanitize_html_class($titlebar_text_color); ?> tm-titlebar-align-<?php echo sanitize_html_class($titlebar_view); ?>">
				<div class="tm-titlebar-inner-wrapper">
					<div class="tm-titlebar-main">
						<div class="container">
							
							<?php

								echo wp_kses( /* HTML Filter */
									$allContent,
									array(
										'div' => array(
											'class' => array(),
										),
										'h1' => array(
											'class' => array(),
										),
										'h2' => array(
											'class' => array(),
										),
										'h3' => array(
											'class' => array(),
										),
										'h4' => array(
											'class' => array(),
										),
										'h5' => array(
											'class' => array(),
										),
										'h6' => array(
											'class' => array(),
										),
										'span' => array(
											'class' => array(),
										),
										'a' => array(
											'href'           => array(),
											'class'          => array(),
											'data-closeicon' => array(),
											'data-openicon'  => array(),
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
						</div><!-- .container -->
					</div><!-- .tm-titlebar-main -->
				</div><!-- .tm-titlebar-inner-wrapper -->
			</div><!-- .tm-titlebar-wrapper -->
		</div>
		
		
		
		<?php
	}
}
}








/**
 *  Header Slider
 */
if( !function_exists('digitallaw_header_slider') ){
function digitallaw_header_slider(){
	
	if( is_page() || is_home() ){
		
		$sliderWrapperStart = '<div id="tm-header-slider" class="thememount-slider-wrapper">';
		$sliderWrapperEnd   = '</div>';
		$pageid = '';
		if( is_page() ){
			$pageid = get_the_ID();
		} else if( is_home() ) {
			$pageid = get_option('page_for_posts');
		}
		
		// check if any slider setup on page
		$sliderType = get_post_meta($pageid, '_thememount_page_options_slidertype', true);
		if(isset($sliderType) && is_array($sliderType) ){ $sliderType = $sliderType[0]; }
		
		
		
		// If Boxed Slider set
		$sliderSize = get_post_meta($pageid, '_thememount_page_options_slidersize', true);
		if(isset($sliderSize) && is_array($sliderSize) ){ $sliderSize = $sliderSize[0]; }
		if( $sliderSize=='boxed' ){
			$sliderWrapperStart .= '<div class="container"><div class="row"><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
			$sliderWrapperEnd   .= '</div></div></div>';
		}
		
		if( $sliderType!='' ){
			switch($sliderType){
				case 'revslider':
					// **** Slider Revolution **** //
					$revSliderAlias = trim(get_post_meta($pageid, '_thememount_page_options_revslider_slider', true));
					if( $revSliderAlias!='' ){
						$slider_html_code  = $sliderWrapperStart . ' %s ' . $sliderWrapperEnd;
						printf(
							wp_kses( /* HTML Filter */
								$slider_html_code,
								array(
									'div' => array(
										'class' => array(),
									),
									'span' => array(
										'class' => array(),
									),
								)
							),
							
							do_shortcode('[rev_slider '.$revSliderAlias.']')
						
						);
						
						
						
					}
					break;
				
				
				case 'nivo':
				case 'flex':	
					
					$slidercat     = get_post_meta( $pageid ,'_thememount_page_options_slidercat', true );
					
					$args = array(
						'post_type'      => 'tm_slide',
						'posts_per_page' => 9999,
						'tax_query'      => array(
							array(
								'taxonomy' => 'tm_slide_group',
								'field' => 'slug',
								'terms' => $slidercat
							),
						)
					);
					$loop = new WP_Query( $args );
					
					/* Restore original Post Data */
					wp_reset_postdata();
					
					if( isset($loop->posts) && count($loop->posts)>0 ){
						
						$html_nivoflaxslider = '';
						
						$html_nivoflaxslider .= $sliderWrapperStart;
						if( $sliderType=='flex' ){
							$html_nivoflaxslider .= '<div class="flexslider"><ul class="slides">';
						} else {
							$html_nivoflaxslider .= '<div class="thememount-slider thememount-'.$sliderType.'-slider-wrapper"> <div class="slider-wrapper theme-default"> <div id="slider" class="nivoSlider-wrapper">';
						}
						
						$x = 1;
						$descText = '';
						while ( $loop->have_posts() ) : $loop->the_post();
							
							// Getting data
							$title   = esc_attr( trim(get_the_title()) );
							$desc    = esc_attr( trim(get_post_meta( get_the_ID(), '_thememount_slides_options_desc', true )) );
							$btntext = esc_attr( trim(get_post_meta( get_the_ID(), '_thememount_slides_options_btntext', true )) );
							$btnlink = esc_url( trim(get_post_meta( get_the_ID(), '_thememount_slides_options_btnlink', true )) );
							
							$desc    = ( $desc!='' ) ? '<div class="thememount-slider-desc">'.$desc.'</div>' : '' ;
							$btntext = ( $btntext!='' ) ? do_shortcode('[vc_button title="'.$btntext.'" icon="right-open" color="white" size="big" href="'.$btnlink.'" el_class="" btn_effect="bordertocolor" iconposition="right" showicon="withicon"]') : '' ;
							
							
							if( has_post_thumbnail() ){
								$url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
							} else {
								$url = 'no-image.jpg';
							}
							
							
							if( $sliderType=='nivo' ){
								// **** Nivo Slider **** //
								$html_nivoflaxslider .= '<img src="'.$url.'" alt="" title="#nivoslidetext'.$x.'" />';
								$descText .= '<div id="nivoslidetext'.$x.'" class="nivo-html-caption"><h2>'.$title.'</h2>'.$desc.$btntext.'</div>';
								
							} else {
								// **** Flex Slider **** //
								$html_nivoflaxslider .= '<li><img src="'.$url.'" />';
								if( $title!='' ){
									$html_nivoflaxslider .= '<div class="flex-caption"><div class="flex-caption-inner"><h3 class="flex-caption-title">'.$title.'</h3><div class="flex-caption-desc">'.$desc.'</div><div class="flex-caption-btn">'.$btntext.'</div></div></div>';
								}
								$html_nivoflaxslider .= '</li>';
							}
							$x++;
						endwhile;
						
						if( $sliderType=='flex' ){
							// **** Flex Slider **** //
							$html_nivoflaxslider .= '</ul><!-- .slides --> </div><!-- .flexslider -->';
							
						} else {
							// **** Nivo Slider **** //
							$html_nivoflaxslider .= '</div><!-- #slider.nivoSlider -->';
							// Decription of each slide
							$html_nivoflaxslider .= '<div id="htmlcaption" class="nivo-html-caption">'.$descText.'</div>';
							$html_nivoflaxslider .= '</div><!-- .slider-wrapper --> </div><!-- .thememount-slider --> ';
							
						}
						
						$html_nivoflaxslider .= $sliderWrapperEnd;
						
						
						// sanitize html data
						echo wp_kses( /* HTML Filter */
								$html_nivoflaxslider,
								array(
									'div' => array(
										'class' => array(),
										'id'    => array(),
									),
									'span' => array(
										'class' => array(),
									),
									'ul' => array(
										'class' => array(),
									),
									'li' => array(
										'class' => array(),
									),
									'a' => array(
										'href'           => array(),
										'class'          => array(),
										'data-closeicon' => array(),
										'data-openicon'  => array(),
									),
									'img' => array(
										'class'  => array(),
										'src'    => array(),
										'alt'    => array(),
										'title'  => array(),
										'width'  => array(),
										'height' => array(),
									),
									'h2' => array(
										'class' => array(),
									),
									'h3' => array(
										'class' => array(),
									),
									
								)
							);
						
						
					}  // if( count($loop->posts)>0 )
					
					/* Restore original Post Data */
					wp_reset_postdata();
				
					break;
			}
		}

	}
}
}




/*
 *  Sticky Header Class
 */
if( !function_exists('thememount_stickyHeaderClass') ){
function thememount_stickyHeaderClass(){
	global $digitallaw_theme_options;
	$stickyHeaderClass = ( !empty($digitallaw_theme_options['stickyheader']) && esc_attr($digitallaw_theme_options['stickyheader']) == 'y') ? 'masthead-header-stickyOnScroll' : '' ; // Check if sticky header enabled
	return $stickyHeaderClass;
}
}





/*
 *  Header Class
 */
if( !function_exists('thememount_headerClass') ){
function thememount_headerClass(){
	global $digitallaw_theme_options;
	// header dark class
	$headerClass = '';
	if( !empty($digitallaw_theme_options['headerbgcolor']['rgba']) && digitallaw_check_dark_color(esc_attr($digitallaw_theme_options['headerbgcolor']['rgba'])) ){
		$headerClass = 'tm-dark-header';
	}

	return $headerClass;
}
}





/*
 *  Header Class
 */
if( !function_exists('thememount_logotag') ){
function thememount_logotag(){
	global $digitallaw_theme_options;
	
	$logoseo      = ( !empty($digitallaw_theme_options['logoseo']) ) ? esc_attr($digitallaw_theme_options['logoseo']) : "h1homeonly" ;

	// Logo tag for SEO
	$logotag = 'h1';
	if( $logoseo=='h1homeonly' && !is_front_page() ){
		$logotag = 'span';
	}
	
	return $logotag;
}
}




/*
 *  Sticky Logo exists Class
 */
if( !function_exists('thememount_stickylogo_class') ){
function thememount_stickylogo_class(){
	global $digitallaw_theme_options;
	
	$stickyLogo = 'no';
	if( !empty($digitallaw_theme_options['logoimg_sticky']["url"]) ){
		$stickyLogo = 'yes';
	}
	
	return $stickyLogo;
}
}






/*
 *  Get header style
 */
if( !function_exists('thememount_get_headerstyle') ){
function thememount_get_headerstyle(){
	global $digitallaw_theme_options;
	//Getting header style 
	$headerStyle = ( !empty($digitallaw_theme_options['headerstyle']) ) ? esc_attr($digitallaw_theme_options['headerstyle']) :'' ;
	
	return $headerStyle;

}
}





/*
 *  Header container class
 */
if( !function_exists('thememount_header_container_class') ){
function thememount_header_container_class(){
	global $digitallaw_theme_options;
	$headerContainer = 'container';
	if( !empty($digitallaw_theme_options['layout']) && esc_attr($digitallaw_theme_options['layout']) == 'fullwide' ){
		if( isset($digitallaw_theme_options['full_wide_elements']['header']) && $digitallaw_theme_options['full_wide_elements']['header']=='1' )
		$headerContainer = 'container-full';
	}

	// specially added for header 3
	if( thememount_get_headerstyle() == '3' && esc_attr($digitallaw_theme_options['layout']) == 'wide' ){
		$headerContainer = 'container-wide';
	}
	
	
	return $headerContainer;
}
}



/*
 * This will override the default "skin color" set in the page directly.
 */
if( !function_exists('digitallaw_single_skin_color') ){
function digitallaw_single_skin_color(){
	if( is_page() ){
		global $post;
		global $digitallaw_theme_options;
		$skincolor = trim( get_post_meta( $post->ID, '_thememount_page_customize_skincolor', true ) );
		if($skincolor!=''){
			$digitallaw_theme_options['skincolor']=$skincolor;
		}
	} else if( is_home() ){
		global $post;
		global $digitallaw_theme_options;
		$pageid = get_option('page_for_posts');
		$skincolor = trim( get_post_meta( $pageid, '_thememount_page_customize_skincolor', true ) );
		if($skincolor!=''){
			$digitallaw_theme_options['skincolor']=$skincolor;
		}
	}
}
}
add_action('wp','digitallaw_single_skin_color');





/**
 *  Custom HTML at body start tag
 *
 */
if( !function_exists('digitallaw_customhtml_bodystart') ){
function digitallaw_customhtml_bodystart(){
	global $digitallaw_theme_options;
	/* Custom HTML code */
	if( !empty($digitallaw_theme_options['customhtml_bodystart']) ){
		// We are not sanitizing this as we are expecting any (HTML, CSS, JS) code here
		echo trim($digitallaw_theme_options['customhtml_bodystart']);
	}
}
}



/********* Footer Functions ***********/


/*
 *  Footer container class
 */
if( !function_exists('thememount_footer_container_class') ){
function thememount_footer_container_class(){
	global $digitallaw_theme_options;
 
	$footerContainer = 'container';
	if( !empty($digitallaw_theme_options['layout']) && esc_attr($digitallaw_theme_options['layout'])=='fullwide' ){
		if( !empty($digitallaw_theme_options['full_wide_elements']['footer']) && $digitallaw_theme_options['full_wide_elements']['footer']=='1' ){
			$footerContainer = 'container-full';
		}
	}
	
	return $footerContainer;
	
}
}




/*
 *  Footer no widget class
 */
if( !function_exists('thememount_footer_no_widget_class') ){
function thememount_footer_no_widget_class($for='all'){
	global $digitallaw_theme_options;
 
	$footer_no_widget_class     = '';
	$footer_1st_no_widget_class = '';
	$footer_2nd_no_widget_class = '';

	// First row
	if ( !is_active_sidebar( 'first-top-footer-widget-area' )
	&& !is_active_sidebar( 'second-top-footer-widget-area' )
	&& !is_active_sidebar( 'third-top-footer-widget-area' )
	&& !is_active_sidebar( 'fourth-top-footer-widget-area' ) ) {
		$footer_1st_no_widget_class = 'tm-footer-1st-row-no-widgets';
	}

	// second row
	if ( !is_active_sidebar( 'first-footer-widget-area' )
	&& !is_active_sidebar( 'second-footer-widget-area' )
	&& !is_active_sidebar( 'third-footer-widget-area' )
	&& !is_active_sidebar( 'fourth-footer-widget-area' ) ) {
		$footer_2nd_no_widget_class = 'tm-footer-2nd-row-no-widgets';
	}

	if( $footer_1st_no_widget_class=='tm-footer-1st-row-no-widgets' && $footer_2nd_no_widget_class=='tm-footer-2nd-row-no-widgets' ){
		$footer_no_widget_class = 'tm-footer-no-widgets';
	}
	
	if( $for=='all' ){
		return $footer_no_widget_class;
		
	} else if( $for='first-row' ){
		return $footer_1st_no_widget_class;
		
	} else if( $for='second-row' ){
		return $footer_2nd_no_widget_class;
		
	}
	
	return '';
	
}
}




/*
 *  Footer no widget class
 */
if( !function_exists('thememount_footerwidget_color') ){
function thememount_footerwidget_color(){
	global $digitallaw_theme_options;
	if( !empty($digitallaw_theme_options['footerwidget_color']) ){
		return  sanitize_html_class($digitallaw_theme_options['footerwidget_color']);
	} else {
		return '';
	}
	
}
}



/*
 *  Footer no widget class
 */
if( !function_exists('thememount_footer_copyright_left') ){
function thememount_footer_copyright_left(){
	global $digitallaw_theme_options;
	
	if( !empty($digitallaw_theme_options['footer_copyright_left']) ){
		return trim($digitallaw_theme_options['footer_copyright_left']);
	} else {
		return '';
	}
	
}
}




/**
 *  Sanitize multiple HTML classes in one pass.
 */
if( !function_exists('digitallaw_layout_type_class') ){
function digitallaw_layout_type_class(){
	global $digitallaw_theme_options;
	$return = 'tm-layout-white';
	
	if( !empty($digitallaw_theme_options['layout_type']) && esc_attr($digitallaw_theme_options['layout_type'])=='dark' ){
		$return = 'tm-dark';
	}
	
	return $return;
}
}






/**
 *  Sanitize multiple HTML classes in one pass.
 *
 *  Accepts either an array of '$classes', or a space separated string of classes and
 *  sanitizes them using the 'sanitize_html_class' function.
 */
if( !function_exists('digitallaw_sanitize_html_classes') ){
function digitallaw_sanitize_html_classes($classes, $return_format = 'input'){
	if ( 'input' === $return_format ) {
		$return_format = is_array( $classes ) ? 'array' : 'string';
	}

	$classes = is_array( $classes ) ? $classes : explode( ' ', $classes );

	$sanitized_classes = array_map( 'sanitize_html_class', $classes );

	if ( 'array' === $return_format ){
		return $sanitized_classes;
	}else{
		return implode( ' ', $sanitized_classes );
	}

}
}


/**
 *  Change global header style value based on specific condition
 */
if( !function_exists('digitallaw_change_headerstyle') ){
function digitallaw_change_headerstyle(){
	
	global $digitallaw_theme_options;
	$headerstyle_page = '';
	
	if( is_page() ){
		$headerstyle_page = trim(get_post_meta(get_the_ID(), 'headerstyle', true));
	}
	
	if( $headerstyle_page != '' ){
		$digitallaw_theme_options['headerstyle'] = $headerstyle_page;
	} 
	
}
}
add_action( 'wp', 'digitallaw_change_headerstyle' );


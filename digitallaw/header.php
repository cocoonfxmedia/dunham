<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>



<?php /* HTML code at body-start tag */  digitallaw_customhtml_bodystart(); ?>


<?php echo digitallaw_preloader(); ?>

<div class="main-holder <?php echo sanitize_html_class(digitallaw_layout_type_class()); ?>">
<div id="page" class="hfeed site">
<header id="masthead" class="site-header">
<?php digitallaw_floatingbar(); ?>
<?php digitallaw_topbar(); ?>
  <div class="headerblock <?php echo digitallaw_headerclass(); ?>">
    
    
    <div id="stickable-header" class="header-inner <?php echo sanitize_html_class( thememount_stickyHeaderClass() ); ?> <?php echo sanitize_html_class( thememount_headerClass() ); ?>">
      <div class="<?php echo sanitize_html_class( thememount_header_container_class() ); ?>">
        <div class="headercontent clearfix">
		
		
		<?php
		// specially added for header 3
		global $digitallaw_theme_options;
		if( thememount_get_headerstyle() == '3' && $digitallaw_theme_options['layout']=='wide' ){
			echo '<div class="tm-header-top-wrapper"> <div class="tm-header-top container">';
		}
		?>
		
		
			<div class="headerlogo thememount-logotype-<?php echo sanitize_html_class($digitallaw_theme_options['logotype']); ?> tm-stickylogo-<?php echo sanitize_html_class( thememount_stickylogo_class() ); ?>"> <<?php echo esc_attr( thememount_logotag() ); ?> class="site-title"> <a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<?php if( esc_attr($digitallaw_theme_options['logotype']) == 'image' ){ ?>
				<img class="thememount-logo-img standardlogo" src="<?php echo esc_url($digitallaw_theme_options['logoimg']["url"]); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" width="<?php echo esc_attr($digitallaw_theme_options['logoimg']["width"]); ?>" height="<?php echo esc_attr($digitallaw_theme_options['logoimg']["height"]); ?>">
				<?php if( !empty($digitallaw_theme_options['logoimg_sticky']["url"]) ): ?>
				<img class="thememount-logo-img stickylogo" src="<?php echo esc_url($digitallaw_theme_options['logoimg_sticky']["url"]); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" width="<?php echo esc_attr($digitallaw_theme_options['logoimg_sticky']["width"]); ?>" height="<?php echo esc_attr($digitallaw_theme_options['logoimg_sticky']["height"]); ?>">
				<?php endif; ?>
				<?php } else { ?>
				<?php if( trim($digitallaw_theme_options['logotext'])!='' ){ echo esc_attr($digitallaw_theme_options['logotext']); } else { bloginfo( 'name' ); }?>
				<?php } ?>
				</a> </<?php echo esc_attr( thememount_logotag() ); ?>>
				<h2 class="site-description">
				  <?php bloginfo( 'description' ); ?>
				</h2>
			</div>
			
			
			<?php 
		   
			if (thememount_get_headerstyle()=='3' && isset($digitallaw_theme_options['header_three_content'])){
							
				$header_three_content = wp_kses( /* HTML Filter */
					trim($digitallaw_theme_options['header_three_content']),
					array(
						'div' => array(
							'class' => array(),
							'id'    => array(),
						),
						'button' => array(
							'class' => array(),
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
				<div class="tm-top-info-con">
					<?php	echo do_shortcode($header_three_content)?>
				</div>
                <div class="header-controls">
                	<div class="search_box"> <a href="#"><i class="fa fa-search"></i></a> </div>
                </div>
				
				<div class="clearfix"></div>
				
			<?php } ?>
			
		
		
		
		
		
			<?php
			// specially added for header 3
			if( thememount_get_headerstyle() == '3' && $digitallaw_theme_options['layout']=='wide' ){
				echo '</div><!-- .tm-header-top -->  </div><!-- .tm-header-top-wrapper -->  ';
			}
			?>
		
		
		
			<?php
			// specially added for header 3
			if( thememount_get_headerstyle() == '3' && $digitallaw_theme_options['layout']=='wide' ){
				echo '<div class="tm-header-bottom-wrapper"> <div class="tm-header-bottom container">';
			}
			?>
		
		
	
          
          <?php
		  /*
		   * Search is now optional. You can show/hide search button from "Theme Options" directly.
		   */
		  $header_search = ( !isset($digitallaw_theme_options['header_search']) ) ? '1' : esc_attr($digitallaw_theme_options['header_search']);
		  $tm_sticky_header_height = ( !empty($digitallaw_theme_options['header-height-sticky']) ) ? $digitallaw_theme_options['header-height-sticky'] : '73' ; 
		  ?>
          <div id="navbar"<?php if( esc_attr($header_search)=='1' ) { echo ' class="'. sanitize_html_class('k_searchbutton').'" '; } ?>>
            <nav id="site-navigation" class="navigation main-navigation" data-sticky-height="<?php echo esc_attr($tm_sticky_header_height); ?>">
              
			  
			  
			  <?php
			  $header_controls = '';
			  
			  //header right content
			  if ( thememount_get_headerstyle()!='2' && thememount_get_headerstyle()!='3' && thememount_get_headerstyle()!='5' && thememount_get_headerstyle()!='6' && thememount_get_headerstyle()!='15' && !empty($digitallaw_theme_options['header_right_content']) ){
				  
				  $header_right_content = wp_kses( /* HTML Filter */
						$digitallaw_theme_options['header_right_content'],
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
				  
				  $header_controls .= '<div class="tm-custombutton">'. do_shortcode( $header_right_content ) .'</div>';
			  }
			  
			  // Show search only for headerstyle 3
			  if (thememount_get_headerstyle()=='3' && $header_search=='1'){
				  $digitallaw_get_search_form = '';
				  ob_start();
				  digitallaw_get_search_form();
				  $digitallaw_get_search_form = ob_get_contents();
				  ob_end_clean();
				  
				  $header_controls .= '<div class="tm-header-small-search-form">'. $digitallaw_get_search_form .'</div>';
			  }
			  
			  
			  
			  // Header search icon
			  if( $header_search=='1'):
				  if( thememount_get_headerstyle()!='3' ):
					  $header_controls .= '<div class="search_box"> <a href="#"><i class="fa fa-search"></i></a> </div>';
				  endif;
			  endif;
              
			  
			  
			  // WooCommerce - Header cart link and text
			  $wc_header_icon = ( isset($digitallaw_theme_options['wc-header-icon']) && ($digitallaw_theme_options['wc-header-icon'])!=''  ) ? esc_attr($digitallaw_theme_options['wc-header-icon']) : '1' ;
			  
			  if( function_exists('is_woocommerce') && $wc_header_icon=='1' ){
				  global $woocommerce;
				  $header_controls .= '<div class="thememount-header-cart-link-wrapper"> <a href="'. $woocommerce->cart->get_cart_url() .'" class="thememount-header-cart-link"><i class="fa fa-shopping-cart"></i> <span class="thememount-cart-qty"> CART <span>(<span class="cart-contents">&nbsp;&nbsp;</span>)</span></span> </a> </div>';
			  }
			  
			  
			  // Final output
			  if( $header_controls!='' ){
				  echo '<div class="header-controls">'. $header_controls .'</div>';
			  }
			  
			  
			  ?>
			  
			  
			  
			  
              <h3 class="menu-toggle">
                <span><?php esc_html_e( 'Toggle menu', 'digitallaw' ); ?></span><i class="fa fa-bars"></i>
              </h3>
              <a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'digitallaw' ); ?>">
              <?php esc_html_e( 'Skip to content', 'digitallaw' ); ?>
              </a>
              <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'container_class' => 'nav-menu' ) );	?>
            </nav>
            <!-- #site-navigation --> 
          </div>
		  
		  
		<?php
		// specially added for header 3
		if( thememount_get_headerstyle() == '3' && $digitallaw_theme_options['layout']=='wide' ){
			echo '</div><!-- .tm-header-bottom --> </div><!-- .tm-header-bottom-wrapper --> ';
		}
		?>
		  
		  
		  
		  
          <!-- #navbar --> 
        </div>
        <!-- .row --> 
      </div>
	  
	  <?php digitallaw_get_search_form(); ?>
      
      </div>
    </div>
  
  <?php digitallaw_header_titlebar(); ?>
  <?php digitallaw_header_slider(); ?>
  
</header><!-- #masthead -->

<div id="main" class="site-main">
	<div id="main-inner" class="site-main-inner clearfix">

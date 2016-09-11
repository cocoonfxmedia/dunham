<?php

/*
 *  WooCommerce Settings
 */
if( function_exists('is_woocommerce') ){  /* Check if WooCommerce plugin activated */
	
	// Remove breadcrumb from woocommerce_before_main_content
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
	remove_action( 'woocommerce_before_main_content', 'woocommerce_page_title', 20);
	
	// Remove Page Title
	function digitallaw_wc_title(){return '';}
	add_action( 'woocommerce_show_page_title', 'digitallaw_wc_title' );
	
	
	// Change number or products per row to 3
	add_filter('loop_shop_columns', 'digitallaw_loop_columns');
	if (!function_exists('digitallaw_loop_columns')){
		function digitallaw_loop_columns() {
			global $digitallaw_theme_options;
			$woocommerce_column = !empty($digitallaw_theme_options['woocommerce-column']) ? trim($digitallaw_theme_options['woocommerce-column']) :3 ;
			return $woocommerce_column; // 3 products per row
		}
	}
	
	
	// Remove "product" class from product thumb LI
	if( !function_exists('digitallaw_wc_remove_product_class') ){
		function digitallaw_wc_remove_product_class($classes) {
			$classes = array_diff($classes, array("product"));
			return $classes;
		}
	}
	
	
	
	/*
	 *  WooCommerce : Settings for related products on single page
	 */
	$wc_single_showRelated = !empty($digitallaw_theme_options['wc-single-show-related']) ? esc_attr($digitallaw_theme_options['wc-single-show-related']) : '1' ;
	if( $wc_single_showRelated=='0' ){
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
	} else {
		
		
		
		// Single product related products : Column
		add_filter( 'woocommerce_output_related_products_args', 'digitallaw_related_products_args' );
		function digitallaw_related_products_args( $args ) {
			global $digitallaw_theme_options;
			$wc_related_column = !empty($digitallaw_theme_options['wc-single-related-column']) ? intval(trim(esc_attr($digitallaw_theme_options['wc-single-related-column']))) : 3 ;
			
			$args['columns'] = $wc_related_column; // arranged in 2 columns
			return $args;
		}
		
		
		
		function digitallaw_woo_related_products_limit() {
			//$posts_per_page = 4;
			global $product, $woocommerce_loop, $digitallaw_theme_options;
			$related = $product->get_related();
			if ( sizeof( $related ) == 0 ) return;
			
			$wc_related_count = !empty($digitallaw_theme_options['wc-single-related-count']) ? intval(trim(esc_attr($digitallaw_theme_options['wc-single-related-count']))) : 3 ;
			
			$args = array(
				'post_type'        		=> 'product',
				'no_found_rows'    		=> 1,
				'posts_per_page'   		=> $wc_related_count,
				'ignore_sticky_posts' 	=> 1,
				'orderby'             	=> 'rand',
				'post__in'            	=> $related,
				'post__not_in'        	=> array($product->id)
			);
			return $args;
		}
		add_filter( 'woocommerce_related_products_args', 'digitallaw_woo_related_products_limit' );
		
		


		add_action( 'init', 'digitallaw_product_up_related' );
		function digitallaw_product_up_related() {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
			remove_action( 'woocommerce_after_single_product_summary', 'woo_wc_upsell_display', 15 );
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
			remove_action( 'woocommerce_after_single_product_summary', 'woo_wc_related_products', 20);
			add_action( 'woocommerce_after_single_product_summary', 'digitallaw_woocommerce_output_upsells', 15 );
			add_action( 'woocommerce_after_single_product_summary', 'digitallaw_woocommerce_output_related_products', 20);

			function digitallaw_woocommerce_output_upsells() {
				woocommerce_upsell_display( 4,4 ); // Display 3 products in rows of 3
			}
			function digitallaw_woocommerce_output_related_products() {
				woocommerce_related_products(4,4); // 3 products, 3 columns
			}
		} // end Upsells/related columns
		
		
	}

	
	
	
	// Display xx products per page. Goes in functions.php
	global $digitallaw_theme_options;
	$wc_productPerPage = !empty($digitallaw_theme_options['woocommerce-product-per-page']) ? trim(esc_attr($digitallaw_theme_options['woocommerce-product-per-page'])) : 9 ;
	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$wc_productPerPage.';' ), 20 );


}




/**
 * Define image sizes
 */
function digitallaw_woocommerce_image_dimensions() {
	
	$tm_wc_sizeadded = get_option('tm_wc_sizeadded');
	
	if( $tm_wc_sizeadded!='yes' ){
		$catalog = array(
			'width' 	=> '520',	// px
			'height'	=> '520',	// px
			'crop'		=> 1 		// true
		);

		$single = array(
			'width' 	=> '800',	// px
			'height'	=> '800',	// px
			'crop'		=> 1 		// true
		);

		$thumbnail = array(
			'width' 	=> '120',	// px
			'height'	=> '120',	// px
			'crop'		=> 0 		// false
		);

		// Image sizes
		update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
		update_option( 'shop_single_image_size', $single ); 		// Single product image
		update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
		
		update_option('tm_wc_sizeadded','yes');
		
	}
}
add_action( 'init', 'digitallaw_woocommerce_image_dimensions', 1 );





// WooCommerce: Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter('add_to_cart_fragments', 'digitallaw_woocommerce_header_add_to_cart_fragment');
if (!function_exists('digitallaw_woocommerce_header_add_to_cart_fragment')) {
function digitallaw_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?><span class="cart-contents"><?php echo esc_attr($woocommerce->cart->cart_contents_count); ?></span><?php
	$fragments['span.cart-contents'] = ob_get_clean();
	return $fragments;
}
}



/**
 *  Hide "Read More" button if no stock for a product (in product box)
 */
if (!function_exists('woocommerce_template_loop_add_to_cart')) {
function woocommerce_template_loop_add_to_cart() {
	global $product;
	if (!$product->is_in_stock()) return;
	woocommerce_get_template('loop/add-to-cart.php');
}
}



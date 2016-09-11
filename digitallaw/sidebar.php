<?php
/**
 * The sidebar containing the sidebar 2.
 *
 */
?>

<?php
if( is_page() ){
	?>
	
	<?php
	$sidebar2      = 'sidebar-right-page';
	$sidebar2_page = get_post_meta($post->ID,'_thememount_page_options_rightsidebar',true);
	if( trim($sidebar2_page)!='' ){ $sidebar2 = trim($sidebar2_page); }
	
	?>
	
	<aside id="sidebar-right" class="widget-area col-md-3 col-lg-3 col-sm-4 col-xs-12 sidebar" role="complementary">
		<?php dynamic_sidebar( $sidebar2 ); ?>
	</aside><!-- #sidebar-right -->
	
	<?php
} elseif( is_search() ) {
	?>
	<aside id="sidebar-right" class="widget-area col-md-3 col-lg-3 col-sm-4 col-xs-12 sidebar" role="complementary">
		<?php dynamic_sidebar( 'sidebar-right-search' ); ?>
	</aside><!-- #sidebar-right -->
	
	
	
	<?php
} else {
	?>
	<aside id="sidebar-right" class="widget-area col-md-3 col-lg-3 col-sm-4 col-xs-12 sidebar" role="complementary">
		<?php dynamic_sidebar( 'sidebar-right-blog' ); ?>
	</aside><!-- #sidebar-right -->
		
		
	
	<?php
}

<?php 

if( !function_exists('digitallaw_theme_options_array') ){
function digitallaw_theme_options_array(){
	
	
	
	// Theme Information
	ob_start();
	$ct              = wp_get_theme();
	$theme_data      = $ct;
	$item_name       = $theme_data->get('Name'); 
	$tags            = $ct->Tags;
	$screenshot      = $ct->get_screenshot();
	$class           = $screenshot ? 'has-screenshot' : '';
	$customize_title = sprintf( esc_attr__( 'Customize &#8220;%s&#8221;','digitallaw' ), $ct->display('Name') );
	?>
	<div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
		<?php if ( $screenshot ) : ?>
			<?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
			<a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr( $customize_title ); ?>">
				<img src="<?php echo esc_url( $screenshot ); ?>" alt="<?php esc_attr_e( 'Current theme preview', 'digitallaw' ); ?>" />
			</a>
			<?php endif; ?>
			<img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>" alt="<?php esc_attr_e( 'Current theme preview', 'digitallaw' ); ?>" />
		<?php endif; ?>

		<h4>
		<h4>
			<?php echo esc_attr($ct->display('Name')); ?>
		</h4>

		<div>
			<ul class="theme-info">
				<li><?php printf( esc_attr__('By %s','digitallaw'), $ct->display('Author') ); ?></li>
				<li><?php printf( esc_attr__('Version %s','digitallaw'), $ct->display('Version') ); ?></li>
				<li><?php echo '<strong>'.esc_attr__('Tags', 'digitallaw').':</strong> '; ?><?php printf( $ct->display('Tags') ); ?></li>
			</ul>
			<p class="theme-description"><?php echo esc_attr($ct->display('Description')); ?></p>
			<?php if ( $ct->parent() ) {
				printf(
					wp_kses( // HTML Filter
						__('<p class="howto">This <a href="%1$s" target="_blank">child theme</a> requires its parent theme, %2$s.</p>', 'digitallaw' ),
						array(
							'a' => array(
								'href'   => array(),
								'target' => array(),
							),
							'p' => array(
								'class' => array(),
							),
						)
					),
					esc_url( 'http://codex.wordpress.org/Child_Themes' ),
					$ct->parent()->display( 'Name' )
				);
			} ?>
			
		</div>

	</div>
	<?php
	$item_info = ob_get_contents();
	ob_end_clean();
	
	// End of theme information
	
	
	
	
	global $digitallaw_theme_options;

	$sections = array();              

	// Layout Settings
	$sections[] = array(
		'title'  => esc_attr__('Layout Settings', 'digitallaw'),
		'header' => esc_attr__('Layout Settings', 'digitallaw'),
		'desc'   => esc_attr__('Specify theme pages layout, the skin coloring and background', 'digitallaw'),
		'icon_class' => 'icon-large',
		'icon'   => 'el-icon-website',
		'fields' => array(
			array(
				'id'         => 'thememount_one_click_demo_content',
				'type'       => 'thememount_one_click_demo_content',
				'title'      => __('Demo Content Setup', 'digitallaw'), 
				'subtitle'   => __('This is one click demo content setup', 'digitallaw'),
				'customizer' => false,
			),
			array(
				'id'       => 'digitallaw_pre_color_packages',
				'type'     => 'digitallaw_pre_color_packages',
				'title'    => esc_attr__('Pre-color packages', 'digitallaw'), 
				'subtitle' => esc_attr__('You will get different color settings in just one click. So you don\'t need to set each options individually.', 'digitallaw'),
				'customizer'=> false,
			),
			array(
				'id'       => 'layout',
				'type'     => 'radio',
				'title'    => esc_attr__('Pages Layout', 'digitallaw'), 
				'subtitle' => esc_attr__('Specify the layout for the pages', 'digitallaw'),
				'options'  => array('wide'     => esc_attr__('Wide', 'digitallaw'),
									'boxed'    => esc_attr__('Boxed', 'digitallaw'),
									'framed'   => esc_attr__('Framed', 'digitallaw'),
									'rounded'  => esc_attr__('Rounded', 'digitallaw'),
									'fullwide' => esc_attr__('Full Wide', 'digitallaw'),
							),//Must provide key => value pairs for radio options
				'default'  => 'wide',
			),
			array(
				'id'        => 'full_wide_elements',
				'type'      => 'checkbox',
				'title'     => esc_attr__('Select Elements for Full Wide View (in above option)', 'digitallaw'),
				'subtitle'  => esc_attr__('Select elements that you want to show in full-wide view.', 'digitallaw'),
				'desc'      => esc_attr__('Select elements that you want to show in full-wide view.', 'digitallaw'),
				'required'  => array('layout','equals','fullwide'),
				//Must provide key => value pairs for multi checkbox options
				'options'   => array(
					'header'  => esc_attr__('Header', 'digitallaw'),
					'content' => esc_attr__('Content Area', 'digitallaw'),
					'footer'  => esc_attr__('Footer', 'digitallaw'),
				),
				
				//See how std has changed? you also don't need to specify opts that are 0.
				'default'   => array(
					'header'  => '1',
					'content' => '1',
					'footer'  => '1',
				)
			),
			
			array(
				'id'       => 'responsive',
				'type'     => 'switch',
				'title'    => esc_attr__('Responsive Design', 'digitallaw'), 
				'subtitle' => esc_attr__('Check this option to enable responsive design to the theme', 'digitallaw'),
				'on'       => esc_attr__('Yes', 'digitallaw'),
				'off'      => esc_attr__('No', 'digitallaw'),
				'default'  => '1', // 1 = on | 0 = off
				'customizer'=> false,
			),
			array(
				'id'       => 'skincolor',
				'type'     => 'digitallaw_skin_color',
				'title'    => esc_attr__('Skin Color', 'digitallaw'), 
				'subtitle' => esc_attr__('Custom color for skin. This is color to highlight different elements. Like text links, active tabs, progress bars, active accordion and others.', 'digitallaw'),
				'default'  => '#9dc02e',
				'values'   => array(
					'Atlantis'         => '#9dc02e',
					'Havelock Blue'    => '#449edd',
					'Conifer'          => '#97d04d',
					'Jaffa'            => '#ea984f',
					'Sail'             => '#a7ddf4',
					'Flamingo'         => '#F6653C',
					'Atoll'            => '#0A4B73',
					'Keppel'           => '#37bc9b',
					'Curious Blue'     => '#22b5e1',
					'Hollywood Cerise' => '#ff0096',
				),
				'validate'   => 'color',
				'customizer' => false,
				'compiler'   => 'true',
			),
			array(
				'id'       => 'layout_type',
				'type'     => 'select',
				'title'    => esc_html__('Layout Type', 'digitallaw'), 
				'subtitle' => esc_html__('You can switch to dark layout from here. Default is white.', 'digitallaw') . '<br><br><strong>' . esc_html__('NOTE:', 'digitallaw') . '</strong> ' . esc_html__('This will change some options automatically. This will change skin color, all font colors and some background colors.', 'digitallaw'),
				
				'options'  => array(
						'white' => esc_html__('White Layout (default)', 'digitallaw'),
						'dark'  => esc_html__('Dark Layout', 'digitallaw'),
					),
				'default' => 'white'
			),
			
			array(
				'id'    =>'html-backgroundsettings',
				'type'  => 'info',
				'title' => esc_attr__('Background Settings', 'digitallaw'), 
				'desc'  => esc_attr__('Set below background options. Background settings will be applied to Boxed layout only.', 'digitallaw')
			),
			array(
				'id'            => 'global_background',
				'type'          => 'background',
				'title'         => esc_attr__('Body Background Properties', 'digitallaw'),
				'subtitle'      => esc_attr__('Set background for main body. This is for main outer body background. For "Boxed" layout only.', 'digitallaw'),
				'preview_media' => true,
				'output'        => array('body'),
				'default'       => array( "background-color" => "#ffffff", ),
				//'customizer'    => true,
			),
			array(
				'id'            => 'content_background',
				'type'          => 'background',
				'title'         => esc_attr__('Content Area Background Properties', 'digitallaw'),
				'subtitle'      => esc_attr__('Set background for content area. This is for main inner body background.', 'digitallaw'),
				'preview_media' => true,
				'output'        => array('.tm-dark.main-holder, .tm-dark .site-main'),
				'default'       => array( "background-color" => "#ffffff", ),
				//'customizer'    => true,
			),
			
			
			/* Loader Image */
			array(
				'id'    =>'html-loaderimage',
				'type'  => 'info',
				'title' => esc_attr__('Pre-loader image', 'digitallaw'), 
				'desc'  => esc_attr__('Select pre-loader image for the site. This will work on desktop, mobile and tablet devices.', 'digitallaw')
			),
			array(
				'id'       => 'loaderimg',
				'type'     => 'image_select',
				'title'    => esc_attr__('Pre-loader Image', 'digitallaw'), 
				'subtitle' => esc_attr__('Please select site pre-loader image.', 'digitallaw') . '<br /><br /><em><strong>'. esc_attr__('Note:', 'digitallaw') .' </strong>'. esc_attr__('Please note that if you uploaded pre-loader image (in below option) than this pre-defined loader image will be ignored.', 'digitallaw') .'</em>',
				'options'  => array(
					'no' => array(
						'alt' => esc_attr__('Loader image 0', 'digitallaw'),
						'img' => get_template_directory_uri() . '/images/loader0.gif'
					),
					'1' => array(
						'alt' => esc_attr__('Loader image 1', 'digitallaw'),
						'img' => get_template_directory_uri() . '/images/loader1.gif'
					),
					'2' => array(
						'alt' => esc_attr__('Loader image 2', 'digitallaw'),
						'img' => get_template_directory_uri() . '/images/loader2.gif'
					),
					'3' => array(
						'alt' => esc_attr__('Loader image 3', 'digitallaw'),
						'img' => get_template_directory_uri() . '/images/loader3.gif'
					),
					'4' => array(
						'alt' => esc_attr__('Loader image 4', 'digitallaw'),
						'img' => get_template_directory_uri() . '/images/loader4.gif'
					),
					'5' => array(
						'alt' => esc_attr__('Loader image 5', 'digitallaw'),
						'img' => get_template_directory_uri() . '/images/loader5.gif'
					),
					'6' => array(
						'alt' => esc_attr__('Loader image 6', 'digitallaw'),
						'img' => get_template_directory_uri() . '/images/loader6.gif'
					),
					'7' => array(
						'alt' => esc_attr__('Loader image 7', 'digitallaw'),
						'img' => get_template_directory_uri() . '/images/loader7.gif'
					),
					'8' => array(
						'alt' => esc_attr__('Loader image 8', 'digitallaw'),
						'img' => get_template_directory_uri() . '/images/loader8.gif'
					),
					'9' => array(
						'alt' => esc_attr__('Loader image 9', 'digitallaw'),
						'img' => get_template_directory_uri() . '/images/loader9.gif'
					),
					'10' => array(
						'alt' => esc_attr__('Loader image 10', 'digitallaw'),
						'img' => get_template_directory_uri() . '/images/loader10.gif'
					),
					'11' => array(
						'alt' => esc_attr__('Loader image 11', 'digitallaw'),
						'img' => get_template_directory_uri() . '/images/loader11.gif'
					),
					'12' => array(
						'alt' => esc_attr__('Loader image 12', 'digitallaw'),
						'img' => get_template_directory_uri() . '/images/loader12.gif'
					),
					'13' => array(
						'alt' => esc_attr__('Loader image 13', 'digitallaw'),
						'img' => get_template_directory_uri() . '/images/loader13.gif'
					),
					'14' => array(
						'alt' => esc_attr__('Loader image 14', 'digitallaw'),
						'img' => get_template_directory_uri() . '/images/loader14.gif'
					),
					'15' => array(
						'alt' => esc_attr__('Loader image 15', 'digitallaw'),
						'img' => get_template_directory_uri() . '/images/loader15.gif'
					),
					'16' => array(
						'alt' => esc_attr__('Loader image 16', 'digitallaw'),
						'img' => get_template_directory_uri() . '/images/loader16.gif'
					),
					'17' => array(
						'alt' => esc_attr__('Loader image 17', 'digitallaw'),
						'img' => get_template_directory_uri() . '/images/loader17.gif'
					),
					'18' => array(
						'alt' => esc_attr__('Loader image 18', 'digitallaw'),
						'img' => get_template_directory_uri() . '/images/loader18.gif'
					),
					'custom' => array(
						'alt' => esc_attr__('Custom Loader image (select below)', 'digitallaw'),
						'img' => get_template_directory_uri() . '/images/loader-custom.gif'
					),
				),
				'default'  => '1',
			),
			array(
				'id'       => 'loaderimage_custom',
				'type'     => 'media',
				'title'    => esc_attr__('Upload Pre-loader Image', 'digitallaw'),
				'subtitle' => esc_html__( 'Custom pre-loader image that you want to show. You can create animated GIF image from your logo from Animizer website.', 'digitallaw')
						.'<a href="'. esc_url('http://animizer.net/en/animate-static-image') .'" target="_blank">'
							.esc_html__( 'Click here to go to Animizer website.', 'digitallaw')
						.'</a>'
						.'<br /><br /><em>'
						.'<strong>' . esc_html__( 'Note:', 'digitallaw') . '</strong>'
						.esc_html__( 'Please note that if you selected image here than the pre-defined loader image (in above option) will be ignored.', 'digitallaw')
						.'</em>',
				'required' => array( 'loaderimg', 'equals', 'custom' ),
			),
			
			
			// One Page site
			array(
				'id'    =>'html-onepagesite',
				'type'  => 'info',
				'title' => esc_attr__('One Page website', 'digitallaw'), 
				'desc'  => esc_attr__('Options for One Page website.', 'digitallaw'),
			),
			array(
				'id'       => 'one_page_site',
				'type'     => 'switch',
				'title'    => esc_attr__('One Page Site', 'digitallaw'), 
				'subtitle' => esc_attr__('Set this option "YES" if your site is one page website.', 'digitallaw'),
				'default'  => '0', // 1 = on | 0 = off
				'on'       => esc_attr__('Yes', 'digitallaw'),
				'off'      => esc_attr__('No', 'digitallaw'),
			),
			
		),
	);



	// Font Settings
	$sections[] = array(
		'title'  => esc_html__('Font Settings', 'digitallaw'),
		'header' => esc_html__('Font Settings', 'digitallaw'),
		'customizer'=> false,
		'desc'   => esc_html__('Set different font style', 'digitallaw'),
		'icon_class' => 'icon-large',
		'icon'   => 'el-icon-text-height',
		'fields' => array(
			array(
				'id'    =>'html-font-generalele',
				'type'  => 'info',
				'title' => esc_html__('General Element Fonts', 'digitallaw'), 
				'desc'  => esc_html__('Select Font for general elements.', 'digitallaw'),
			),
			array(
				'id'          => 'general_font',
				'type'        => 'typography', 
				'title'       => esc_html__('General Font', 'digitallaw'),
				'text-align'  => false,
				'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup' => true, // Select a backup non-google font in addition to a google font
				'subsets'     => false, // Only appears if google is true and subsets not set to false
				'line-height'    => true,
				'text-transform' => true,
				'word-spacing'   => false, // Defaults to false
				'letter-spacing' => true, // Defaults to false
				'color'          => true,
				'output'      => array('body'), // An array of CSS selectors to apply this font style to dynamically
				'units'       => 'px', // Defaults to px
				'subtitle'    => esc_html__('Select General font, color and size', 'digitallaw'),
				'default'     => array(
					'font-family'    => 'Roboto Condensed',
					'font-backup'    => "'Trebuchet MS', Helvetica, sans-serif",
					'google'         => '1',
					'font-weight'    => '400',
					'font-size'      => '14px',
					'line-height'    => '25px',
					'letter-spacing' => '0.5px',
					'color'          => '#838383',
				),
			),
			array(
				'id'       => 'link-color',
				'type'     => 'link_color',
				'title'    => esc_html__( 'Links Color Option', 'digitallaw' ),
				'subtitle' => esc_html__( 'Links color option. This can be applied to &lt;a&gt; tag only.', 'digitallaw' ).'<br>',
				'desc'     => esc_html__( 'By default, the "Regular" color is Global Font color, the "Hover" color is skin color', 'digitallaw' ),
				'active'    => false, // Disable Active Color
				'default'  => array(
					'regular' => '#2d2d2d',
					'hover'   => '#9dc02e',
				),
				'output'   => array('a'),
			),
			array(
				'id'             => 'h1_heading_font',
				'type'           => 'typography', 
				'title'          => esc_html__('H1 Heading Font', 'digitallaw'),
				'text-align'     => false,
				'google'         => true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup'    => true, // Select a backup non-google font in addition to a google font
				'subsets'        => false, // Only appears if google is true and subsets not set to false
				'line-height'    => true,
				'text-transform' => true,
				'word-spacing'   => false, // Defaults to false
				'letter-spacing' => true, // Defaults to false
				'output'         => array('h1'), // An array of CSS selectors to apply this font style to dynamically
				'units'          => 'px', // Defaults to px
				'subtitle'       => esc_html__('Select font family, size etc. for H1 heading tag.', 'digitallaw'),
				'default'        => array(
					'font-family'    => 'Roboto Condensed',
					'font-backup'    => "'Trebuchet MS', Helvetica, sans-serif",
					'google'         => '1',
					'font-weight'    => '700',
					'font-size'      => '30px',
					'line-height'    => '34px',
					'letter-spacing' => '1px',
					'color'          => '#2c2c2c',
				),
			),
			array(
				'id'          => 'h2_heading_font',
				'type'        => 'typography', 
				'title'       => esc_html__('H2 Heading Font', 'digitallaw'),
				'text-align'  => false,
				'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup' => true, // Select a backup non-google font in addition to a google font
				'subsets'     => false, // Only appears if google is true and subsets not set to false
				'line-height'    => true,
				'text-transform' => true,
				'word-spacing'   => false, // Defaults to false
				'letter-spacing' => true, // Defaults to false
				'output'      => array('h2'), // An array of CSS selectors to apply this font style to dynamically
				'units'       => 'px', // Defaults to px
				'subtitle'    => esc_html__('Select font family, size etc. for H2 heading tag.', 'digitallaw'),
				'default'     => array(
					'font-family'    => 'Roboto Condensed',
					'font-backup'    => "'Trebuchet MS', Helvetica, sans-serif",
					'google'         => '1',
					'font-weight'    => '700',
					'font-size'      => '26px',
					'line-height'    => '30px',
					'letter-spacing' => '1px',
					'color'          => '#2c2c2c',
				),
			),
			array(
				'id'          => 'h3_heading_font',
				'type'        => 'typography', 
				'title'       => esc_html__('H3 Heading Font', 'digitallaw'),
				'text-align'  => false,
				'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup' => true, // Select a backup non-google font in addition to a google font
				'subsets'     => false, // Only appears if google is true and subsets not set to false
				'line-height'    => true,
				'text-transform' => true,
				'word-spacing'   => false, // Defaults to false
				'letter-spacing' => true, // Defaults to false
				'output'      => array('h3'), // An array of CSS selectors to apply this font style to dynamically
				'units'       => 'px', // Defaults to px
				'subtitle'    => esc_html__('Select font family, size etc. for H3 heading tag.', 'digitallaw'),
				'default'     => array(
					'font-family'    => 'Roboto Condensed',
					'font-backup'    => "'Trebuchet MS', Helvetica, sans-serif",
					'google'         => '1',
					'font-weight'    => '400',
					'font-size'      => '22px',
					'line-height'    => '26px',
					'color'          => '#2c2c2c',
				),
			),
			array(
				'id'          => 'h4_heading_font',
				'type'        => 'typography', 
				'title'       => esc_html__('H4 Heading Font', 'digitallaw'),
				'text-align'  => false,
				'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup' => true, // Select a backup non-google font in addition to a google font
				'subsets'     => false, // Only appears if google is true and subsets not set to false
				'line-height'    => true,
				'text-transform' => true,
				'word-spacing'   => false, // Defaults to false
				'letter-spacing' => true, // Defaults to false
				'output'      => array('h4'), // An array of CSS selectors to apply this font style to dynamically
				'units'       => 'px', // Defaults to px
				'subtitle'    => esc_html__('Select font family, size etc. for H4 heading tag.', 'digitallaw'),
				'default'     => array(
					'font-family'    => 'Roboto Condensed',
					'font-backup'    => "'Trebuchet MS', Helvetica, sans-serif",
					'google'         => '1',
					'font-weight'    => '400',
					'font-size'      => '18px',
					'line-height'    => '20px',
					'color'          => '#2c2c2c',
				),
			),
			array(
				'id'          => 'h5_heading_font',
				'type'        => 'typography', 
				'title'       => esc_html__('H5 Heading Font', 'digitallaw'),
				'text-align'  => false,
				'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup' => true, // Select a backup non-google font in addition to a google font
				'subsets'     => false, // Only appears if google is true and subsets not set to false
				'line-height'    => true,
				'text-transform' => true,
				'word-spacing'   => false, // Defaults to false
				'letter-spacing' => true, // Defaults to false
				'output'      => array('h5'), // An array of CSS selectors to apply this font style to dynamically
				'units'       => 'px', // Defaults to px
				'subtitle'    => esc_html__('Select font family, size etc. for H5 heading tag.', 'digitallaw'),
				'default'     => array(
					'font-family'    => 'Roboto Condensed',
					'font-backup'    => "'Trebuchet MS', Helvetica, sans-serif",
					'google'         => '1',
					'font-weight'    => '400',
					'font-size'      => '16px',
					'line-height'    => '18px',
					'color'          => '#2c2c2c',
				),
			),
			
			array(
				'id'          => 'h6_heading_font',
				'type'        => 'typography', 
				'title'       => esc_html__('H6 Heading Font', 'digitallaw'),
				'text-align'  => false,
				'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup' => true, // Select a backup non-google font in addition to a google font
				'subsets'     => false, // Only appears if google is true and subsets not set to false
				'line-height'    => true,
				'text-transform' => true,
				'word-spacing'   => false, // Defaults to false
				'letter-spacing' => true, // Defaults to false
				'output'      => array('h6'), // An array of CSS selectors to apply this font style to dynamically
				'units'       => 'px', // Defaults to px
				'subtitle'    => esc_html__('Select font family, size etc. for H6 heading tag.', 'digitallaw'),
				'default'     => array(
					'font-family'    => 'Roboto Condensed',
					'font-backup'    => "'Trebuchet MS', Helvetica, sans-serif",
					'google'         => '1',
					'font-weight'    => '400',
					'font-size'      => '14px',
					'line-height'    => '16px',
					'letter-spacing' => '1px',
					'color'          => '#2c2c2c',
				),
			),
			
			
			array(
				'id'    =>'html-font-specificele',
				'type'  => 'info',
				'title' => esc_html__('Heading and Subheading Font Settings', 'digitallaw'), 
				'desc'  => esc_html__('Select font settings for Heading and subheading of different title elements like Blog Box, Portfolio Box etc.', 'digitallaw'),
			),
			array(
				'id'          => 'heading_font',
				'type'        => 'typography', 
				'title'       => esc_html__('Heading Font', 'digitallaw'),
				'text-align'  => false,
				'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup' => true, // Select a backup non-google font in addition to a google font
				'subsets'     => false, // Only appears if google is true and subsets not set to false
				'line-height'    => true,
				'text-transform' => true,
				'word-spacing'   => false, // Defaults to false
				'letter-spacing' => true, // Defaults to false
				'output'      => array('.tm-element-heading-wrapper h2'), // An array of CSS selectors to apply this font style to dynamically
				'units'       => 'px', // Defaults to px
				'subtitle'    => esc_html__('Select font family, size etc. for heading title', 'digitallaw'),
				'default'=> array(
					'font-family'    => 'Roboto Condensed',
					'font-backup'    => "'Trebuchet MS', Helvetica, sans-serif",
					'google'         => '1',
					'font-weight'    => '700',
					'font-size'      => '26px',
					'line-height'    => '28px',
					'letter-spacing' => '1px',
					'color'          => '#2c2c2c',
				),
			),
			array(
				'id'          => 'subheading_font',
				'type'        => 'typography', 
				'title'       => esc_html__('Subheading Font', 'digitallaw'),
				'text-align'  => false,
				'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup' => true, // Select a backup non-google font in addition to a google font
				'subsets'     => false, // Only appears if google is true and subsets not set to false
				'line-height'    => true,
				'text-transform' => true,
				'word-spacing'   => false, // Defaults to false
				'letter-spacing' => true, // Defaults to false
				'output'      => array('.tm-element-heading-wrapper h4'), // An array of CSS selectors to apply this font style to dynamically
				'units'       => 'px', // Defaults to px
				'subtitle'    => esc_html__('Select font family, size etc. for sub-heading title', 'digitallaw'),
				'default'=> array(
					'font-family' => 'Lora',
					'google'      => '1',
					'font-weight' => '400',
					'font-style'  => 'italic',
					'font-size'   => '19px',
					'line-height' => '25px',
					'color'       => '#838383',
				),
			),
			array(
				'id'    =>'html-font-specificele',
				'type'  => 'info',
				'title' => esc_html__('Specific Element Fonts', 'digitallaw'), 
				'desc'  => esc_html__('Select Font for specific elements.', 'digitallaw'),
			),
			array(
				'id'          => 'widget_font',
				'type'        => 'typography', 
				'title'       => esc_html__('Widget Title Font', 'digitallaw'),
				'text-align'  => false,
				'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup' => true, // Select a backup non-google font in addition to a google font
				'subsets'     => false, // Only appears if google is true and subsets not set to false
				'line-height'    => true,
				'text-transform' => true,
				'word-spacing'   => false, // Defaults to false
				'letter-spacing' => true, // Defaults to false
				'output'      => array('body .widget .widget-title, body .widget .widgettitle, #navbar #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu > li.mega-menu-item > h4.mega-block-title'), // An array of CSS selectors to apply this font style to dynamically
				'units'       => 'px', // Defaults to px
				'subtitle'    => esc_html__('Select font family, size etc. for widget title', 'digitallaw'),
				'default'=> array(
					'font-family'    => 'Roboto Condensed',
					'font-backup'    => "'Trebuchet MS', Helvetica, sans-serif",
					'google'         => '1',
					'font-weight'    => '700',
					'text-transform' => 'uppercase',
					'font-size'      => '17px',
					'line-height'    => '26px',
					'letter-spacing' => '1px',
					'color'          => '#0c0c0c',
				),
			),
			array(
				'id'          => 'button_font',
				'type'        => 'typography', 
				'title'       => esc_html__('Button Font', 'digitallaw'),
				'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup' => true, // Select a backup non-google font in addition to a google font
				'subsets'     => false, // Only appears if google is true and subsets not set to false
				'text-align'  => false,
				'font-size'   => false,
				'line-height'    => false,
				'text-transform' => true,
				'word-spacing'   => false, // Defaults to false
				'letter-spacing' => true, // Defaults to false
				'color'       => false,
				'output'      => array('.woocommerce button.button, .woocommerce-page button.button, input, .vc_btn, .vc_btn3, .woocommerce-page a.button, .button, .wpb_button, button, .woocommerce input.button, .woocommerce-page input.button, .tp-button.big, .woocommerce #content input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page #content input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .thememount-post-readmore a'), // An array of CSS selectors
				'units'       => 'px', // Defaults to px
				'subtitle'    => esc_html__('This fonts will be applied to all buttons in this site', 'digitallaw'),
				'default'     => array(
					'font-family'    => 'Roboto Condensed',
					'font-backup'    => "'Trebuchet MS', Helvetica, sans-serif",
					'google'         => '1',
					'font-weight'    => '400',
					'text-transform' => 'uppercase',
					'letter-spacing' => '1px',
				),
			),
			array(
				'id'		  => 'elementtitle',
				'type'		  => 'typography', 
				'title'		  => esc_html__('Element Title Font', 'digitallaw'),
				'text-align'  => false,
				'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup' => true, // Select a backup non-google font in addition to a google font
				//'font-style'=> false, // Includes font-style and weight. Can use font-style or font-weight to declare
				'subsets'     => false, // Only appears if google is true and subsets not set to false
				'font-size'   => false,
				'line-height'    => false,
				'text-transform' => true,
				'word-spacing'   => false, // Defaults to false
				'letter-spacing' => true, // Defaults to false
				'color'      => false,
				'output'     => array('.wpb_tabs_nav a.ui-tabs-anchor, body .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a, .vc_progress_bar .vc_label, .vc_tta.vc_general .vc_tta-tab > a'), // An array of CSS selectors to apply this font style to dynamically
				'units'      => 'px', // Defaults to px
				'subtitle'   => esc_html__('This will be applied to Tab title, Accordion Title and Progress Bar title text.', 'digitallaw'),
				'default'    => array(
					'font-family' => 'Roboto Condensed',
					'font-backup' => "'Trebuchet MS', Helvetica, sans-serif",
					'google'      => '1',
					'font-weight' => '400',
				),
			),
		),
	);





	// Floating Bar Settings
	$sections[] = array(
		'title'      => esc_html__('Floating Bar Settings', 'digitallaw'),
		'header'     => esc_html__('Floating Bar Settings', 'digitallaw'),
		'desc'       => esc_html__('This is settings page for Header Floating Bar.', 'digitallaw'),
		'icon_class' => 'icon-large',
		'icon'       => 'el-icon-upload',
		'fields' => array(
			array(
				'id'       => 'fbar_show',
				'type'     => 'switch',
				'title'    => esc_html__('Show Floating Bar', 'digitallaw'), 
				'subtitle' => esc_html__('Show or hide Floating Bar', 'digitallaw'),
				'default'  => '0', // 1 = on | 0 = off
				'on'       => esc_html__('Yes', 'digitallaw'),
				'off'      => esc_html__('No', 'digitallaw'),
			),
			
			array(
				'id'       => 'fbar_position',
				'type'     => 'radio',
				'title'    => esc_html__('Floating bar position', 'digitallaw'),
				'subtitle' => esc_html__('Position for Floating bar', 'digitallaw'),
				'options'  => array(
					'default' => esc_html__('Top (default)','digitallaw'),
					'right'   => esc_html__('Right', 'digitallaw').'</small>',
				),
				'default'  => 'right', // 1 = on | 0 = off
				'required' => array('fbar_show','equals','1'),
			),
			array(
				'id'       => 'fbar_bg_color',
				'type'     => 'select',
				'title'    => esc_html__('Floating Bar Background Color', 'digitallaw'), 
				'subtitle' => esc_html__('Select predefined color for Floating Bar background color.', 'digitallaw'),
				'required' => array('fbar_show','equals','1'),
				'options'  => array(
						'darkgrey'   => esc_html__('Dark grey', 'digitallaw'),
						'grey'       => esc_html__('Grey', 'digitallaw'),
						'white'      => esc_html__('White', 'digitallaw'),
						'skincolor'  => esc_html__('Skincolor', 'digitallaw'),
						'custom'     => esc_html__('Custom Color', 'digitallaw'),
					),
				'default' => 'darkgrey'
			),
			array(
				'id'       => 'fbar_bg_custom_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__('Floating Bar Custom Background Color', 'digitallaw'),
				'subtitle' => esc_html__('Custom background color for Floating Bar.', 'digitallaw'),
				'default'  => array(
					'color' => '#551b1b',
					'alpha' => '0.8',
					'rgba'  => 'rgba(85,27,27,0.8)',
				),
				'required' => array(
								array('fbar_show','equals','1'),
								array('fbar_bg_color','equals','custom'),
					),
			),
			array(
				'id'       => 'fbar_text_color',
				'type'     => 'select',
				'title'    => esc_html__('Floating Bar Text Color', 'digitallaw'), 
				'subtitle' => esc_html__('Select "Dark" color if you are going to select light color in above option.', 'digitallaw'),
				'required' => array('fbar_show','equals','1'),
				'options'  => array(
						'white'  => esc_html__('White', 'digitallaw'),
						'dark'   => esc_html__('Dark', 'digitallaw'),
						'custom' => esc_html__('Custom color', 'digitallaw'),
					),
				'default' => 'white'
			),
			array(
				'id'       => 'fbar_text_custom_color',
				'type'     => 'color',
				'title'    => esc_html__('Floating Bar Custom Color for text', 'digitallaw'),
				'default'  => '#8224e3',
				'required' => array(
								array('fbar_show','equals','1'),
								array('fbar_text_color','equals','custom'),
					),
				'validate' => 'color',
			),
			array(
				'id'               => 'fbar_background',
				'type'             => 'background',
				'title'            => esc_html__('Floating Bar Background Properties', 'digitallaw'),
				'subtitle'         => esc_html__('Set background for Floating bar. You can set color or image and also set other background related properties.', 'digitallaw'),
				'preview_media'    => true,
				'background-color' => false,
				'output'           => array('div.thememount-fbar-box-w'),
				'required'         => array('fbar_show','equals','1'),
				'default'          => array( 
					"background-repeat"   => "no-repeat",
					"background-size"     => "cover",
					"background-position" => "center center",
					"background-image"    => get_template_directory_uri().'/images/fbar-bg.jpg',
				),
			),
			array(
				'id'    =>'html-fbar-button',
				'type'  => 'info',
				'title' => esc_html__('Floating Bar Open/Close Button', 'digitallaw'), 
				'required' => array('fbar_show','equals','1'),
				'desc'  => esc_html__('Settings for Floating Bar Open/Close Button', 'digitallaw'),
			),
			array(
				'id'       => 'fbar_handler_icon',
				'type'     => 'digitallaw_icon_select',
				'data'     => 'elusive',
				'title'    => esc_html__('Open Link Icon', 'digitallaw'), 
				'subtitle' => esc_html__('Select icon for the link to open the Header Floating Bar.', 'digitallaw'),
				'default'  => 'fa fa-user',
				'required' => array('fbar_show','equals','1'),
			),
			array(
				'id'       => 'fbar_handler_icon_close',
				'type'     => 'digitallaw_icon_select',
				'data'     => 'elusive',
				'title'    => esc_html__('Close Link Icon', 'digitallaw'), 
				'subtitle' => esc_html__('Select icon for the link to close the Header Floating Bar', 'digitallaw'),
				'default'  => 'fa fa-remove',
				'required' => array('fbar_show','equals','1'),
			),
			array(
				'id'       => 'fbar_btn_bg_color',
				'type'     => 'select',
				'title'    => esc_html__('Floating Bar Open/Close Button Background Color', 'digitallaw'), 
				'subtitle' => esc_html__('Select predefined color for Floating Bar Open/Close button background color.', 'digitallaw'),
				'required' => array('fbar_show','equals','1'),
				'options'  => array(
						'darkgrey'   => esc_html__('Dark grey', 'digitallaw'),
						'grey'       => esc_html__('Grey', 'digitallaw'),
						'white'      => esc_html__('White', 'digitallaw'),
						'skincolor'  => esc_html__('Skincolor', 'digitallaw'),
						'custom'     => esc_html__('Custom Color', 'digitallaw'),
					),
				'default' => 'skincolor'
			),
			array(
				'id'       => 'fbar_btn_bg_custom_color',
				'type'     => 'color',
				'title'    => esc_html__('Floating Bar Open/Close Button Custom Background Color', 'digitallaw'),
				'subtitle' => esc_html__('Custom background color for Open/Close Button Floating Bar.', 'digitallaw'),
				'default'  => '#eeee22',
				'required' => array(
								array('fbar_show','equals','1'),
								array('fbar_btn_bg_color','equals','custom'),
					),
			),
			array(
				'id'       => 'fbar_icon_color',
				'type'     => 'select',
				'title'    => esc_html__('Floating Bar Open/Close Icon Color', 'digitallaw'), 
				'subtitle' => esc_html__('Select "Dark" color if you are going to select light color in above option.', 'digitallaw'),
				'required' => array('fbar_show','equals','1'),
				'options'  => array(
						'white'     => esc_html__('White', 'digitallaw'),
						'dark'      => esc_html__('Dark', 'digitallaw'),
						'skincolor' => esc_html__('Skin Color', 'digitallaw'),
						'custom'    => esc_html__('Custom color', 'digitallaw'),
					),
				'default' => 'white'
			),
			array(
				'id'       => 'fbar_icon_custom_color',
				'type'     => 'color',
				'title'    => esc_html__('Floating Bar Custom Color for Open/Close Icon', 'digitallaw'),
				'default'  => '#eeee22',
				'required' => array(
								array('fbar_show','equals','1'),
								array('fbar_icon_color','equals','custom'),
					),
				'validate' => 'color',
			),
			array(
				'id'    =>'html-floatingbar-responsive',
				'type'  => 'info',
				'title' => esc_html__('Hide Floating Bar in Small Devices', 'digitallaw'), 
				'required' => array('fbar_show','equals','1'),
				'desc'  => esc_html__('Hide Floating Bar in small devices like mobile, tablet etc.', 'digitallaw'),
			),
			array(
				'id'       => 'floatingbar_breakpoint',
				'type'     => 'radio',
				'title'    => esc_html__('Show/Hide Floating Bar in Responsive Mode', 'digitallaw'), 
				'subtitle' => esc_html__('Change options for responsive behaviour of Floating Bar.', 'digitallaw'),
				'options'  => array(
					'all'      => esc_html__('Show in all devices','digitallaw'),
					'1200'     => esc_html__('Show only on large devices','digitallaw').'<small>'.esc_html__('show only on desktops (>1200px)', 'digitallaw').'</small>',
					'992'      => esc_html__('Show only on medium and large devices','digitallaw').'<small>'.esc_html__('show only on desktops and Tablets (>992px)', 'digitallaw').'</small>',
					'768'      => esc_html__('Show on some small, medium and large devices','digitallaw').'<small>'.esc_html__('show only on mobile and Tablets (>768px)', 'digitallaw').'</small>',
					'custom'   => esc_html__('Custom (select pixel below)', 'digitallaw'),
				),
				'required'      => array('fbar_show','equals','1'),
				'default'  => '992'
			),
			array(
				'id'            => 'floatingbar_breakpoint_custom',
				'type'          => 'slider',
				'title'         => esc_html__( 'Custom screen size to hide Floating Bar (in pixel)', 'digitallaw' ),
				'subtitle'      => esc_html__( 'Select after how many pixels the Floating Bar will be hidden.', 'digitallaw' ),
				'default'       => 1200,
				'min'           => 1,
				'step'          => 1,
				'max'           => 1200,
				'display_value' => 'text',
				'required' 		=> array(
										array('fbar_show','equals','1'),
										array('floatingbar_breakpoint','equals','custom'),
									),
				
			),
			
			
		),
	);


	// Topbar Settings
	$sections[] = array(
		'title'  => esc_html__('Topbar Settings', 'digitallaw'),
		'header' => esc_html__('Topbar Settings', 'digitallaw'),
		'desc'   => esc_html__('Topbar settings', 'digitallaw'),
		'icon_class' => 'icon-large',
		'icon'   => 'el-icon-tasks',
		'fields' => array(
			array(
				'id'       => 'show_topbar',
				'type'     => 'switch',
				'title'    => esc_html__('Show Topbar', 'digitallaw'), 
				'subtitle' => esc_html__('Select YES to show the Topbar', 'digitallaw'),
				'default'  => '1', // 1 = on | 0 = off
				'on'       => esc_html__('Yes', 'digitallaw'),
				'off'      => esc_html__('No', 'digitallaw'),
			),
			array(
				'id'       => 'topbarbgcolor',
				'type'     => 'select',
				'title'    => esc_html__('Topbar Background Color', 'digitallaw'), 
				'subtitle' => esc_html__('Select predefined color for Topbar background color.', 'digitallaw'),
				'required' => array('show_topbar','equals','1'),
				'options'  => array(
						'darkgrey'   => esc_html__('Dark grey', 'digitallaw'),
						'grey'       => esc_html__('Grey', 'digitallaw'),
						'white'      => esc_html__('White', 'digitallaw'),
						'skincolor'  => esc_html__('Skincolor', 'digitallaw'),
						'custom'     => esc_html__('Custom Color', 'digitallaw'),
					),
				'default' => 'darkgrey'
			),
			array(
				'id'       => 'topbarbgcustomcolor',
				'type'     => 'color',
				'title'    => esc_html__('Topbar Custom Background Color', 'digitallaw'),
				'subtitle' => esc_html__('Custom background color for Topbar.', 'digitallaw'),
				'default'  => '#303030',
				'required' => array(
								array('show_topbar','equals','1'),
								array('topbarbgcolor','equals','custom'),
					),
				'validate' => 'color',
			),
			array(
				'id'       => 'topbartextcolor',
				'type'     => 'select',
				'title'    => esc_html__('Topbar Text Color', 'digitallaw'), 
				'subtitle' => esc_html__('Select "Dark" color if you are going to select light color in above option.', 'digitallaw'),
				'required' => array('show_topbar','equals','1'),
				'options'  => array(
						'white'  => esc_html__('White', 'digitallaw'),
						'dark'   => esc_html__('Dark', 'digitallaw'),
						'custom' => esc_html__('Custom color', 'digitallaw'),
					),
				'default' => 'white'
			),
			array(
				'id'       => 'topbartextcustomcolor',
				'type'     => 'color',
				'title'    => esc_html__('Topbar Custom Color for text', 'digitallaw'),
				'default'  => '#f45138',
				'required' => array(
								array('show_topbar','equals','1'),
								array('topbartextcolor','equals','custom'),
					),
				'validate' => 'color',
			),
			array(
				'id'    =>'html-topbarleft',
				'type'  => 'info',
				'title' => esc_html__('Topbar Content Options', 'digitallaw'), 
				'required' => array('show_topbar','equals','1'),
				'desc'  => esc_html__('Content for Topbar.', 'digitallaw'),
			),
			array(
				'id'       => 'topbarlefttext',
				'type'     => 'textarea',
				'title'    => esc_html__('Topbar Left Content', 'digitallaw'), 
				'subtitle' => esc_html__('This content will appear on Left side of Topbar area.', 'digitallaw'),
				'desc'     => esc_html__('Some HTML tags and shortcodes are allowed.', 'digitallaw') .
						' <br><a href="'. esc_url('http://digitallaw.thememountdemo.com/documentation/shortcodes.html') .'" target="_blank">' . 
						esc_html__('Click here to get list of all shortcodes.','digitallaw') .  
						'</a>',
				'required' => array('show_topbar','equals','1'),
				'validate' => 'html',
				'default'  => '<ul class="top-contact"><li><i class="fa fa-phone"></i><span>Call us : (1-800-555-1234)</span></li><li><i class="fa fa-envelope-o"></i>Email us: <a href="mailto:mail@example.com">mail@example.com</a></li></ul>'
			),
			array(
				'id'       => 'topbarrighttext',
				'type'     => 'textarea',
				'title'    => esc_html__('Topbar Right Content', 'digitallaw'), 
				'subtitle' => esc_html__('This content will appear on Right side of Topbar area.', 'digitallaw'),
				'desc'     => esc_html__('Some HTML tags and shortcodes are allowed.', 'digitallaw') .
						' <br><a href="'. esc_url('http://digitallaw.thememountdemo.com/documentation/shortcodes.html') .'" target="_blank">' . 
						esc_html__('Click here to get list of all shortcodes.','digitallaw') .  
						'</a>',
				'required' => array('show_topbar','equals','1'),
				'default'  => '',
			),
			array(
				'id'    =>'html-topbar-responsive',
				'type'  => 'info',
				'title' => esc_html__('Hide Topbar in Small Devices', 'digitallaw'), 
				'required' => array('show_topbar','equals','1'),
				'desc'  => esc_html__('Hide Topbar in small devices like mobile, tablet etc.', 'digitallaw'),
			),
			
			array(
				'id'       => 'topbar_breakpoint',
				'type'     => 'radio',
				'title'    => esc_html__('Show/Hide Topbar in Responsive Mode', 'digitallaw'), 
				'subtitle' => esc_html__('Change options for responsive behaviour of Topbar.', 'digitallaw'),
				'options'  => array(
					'all'      => esc_html__('Show in all devices','digitallaw'),
					'1200'     => esc_html__('Show only on large devices','digitallaw').'<small>'.esc_html__('show only on desktops (>1200px)', 'digitallaw').'</small>',
					'992'      => esc_html__('Show only on medium and large devices','digitallaw').'<small>'.esc_html__('show only on desktops and Tablets (>992px)', 'digitallaw').'</small>',
					'768'      => esc_html__('Show on some small, medium and large devices','digitallaw').'<small>'.esc_html__('show only on mobile and Tablets (>768px)', 'digitallaw').'</small>',
					'custom'   => esc_html__('Custom (select pixel below)', 'digitallaw'),
				),
				'required'      => array('show_topbar','equals','1'),
				'default'  => '768'
			),
			array(
				'id'            => 'topbar_breakpoint_custom',
				'type'          => 'slider',
				'title'         => esc_html__( 'Custom screen size to hide Topbar (in pixel)', 'digitallaw' ),
				'subtitle'      => esc_html__( 'Select after how many pixels the Topbar will be hidden.', 'digitallaw' ),
				'default'       => 1200,
				'min'           => 1,
				'step'          => 1,
				'max'           => 1200,
				'display_value' => 'text',
				'required' 		=> array(
										array('show_topbar','equals','1'),
										array('topbar_breakpoint','equals','custom'),
									),
				
			),
			
		),
		
	);


	// Titlebar Settings
	$sections[] = array(
		'title'  => esc_html__('Titlebar Settings', 'digitallaw'),
		'header' => esc_html__('Titlebar Settings', 'digitallaw'),
		'desc'   => esc_html__('Settings for titlebar', 'digitallaw'),
		'icon_class' => 'icon-large',
		'icon'   => 'el-icon-lines',
		'fields' => array(
		
		
			array(
				'id'       => 'titlebar_bg_color',
				'type'     => 'select',
				'title'    => esc_html__('Titlebar Background Color', 'digitallaw'), 
				'subtitle' => esc_html__('Select predefined color for Titlebar background color.', 'digitallaw'),
				'options'  => array(
						'darkgrey'   => esc_html__('Dark grey', 'digitallaw'),
						'grey'       => esc_html__('Grey', 'digitallaw'),
						'white'      => esc_html__('White', 'digitallaw'),
						'skincolor'  => esc_html__('Skincolor', 'digitallaw'),
						'custom'     => esc_html__('Custom Color', 'digitallaw'),
					),
				'default' => 'darkgrey'
			),
			array(
				'id'       => 'titlebar_bg_custom_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__('Titlebar Background Color', 'digitallaw'),
				'subtitle' => esc_html__('Custom color for titlebar background.', 'digitallaw'),
				'required'      => array('titlebar_bg_color','equals', 'custom' ),
				'default'  => array(
						"color" => "#f2177f",
						"alpha" => "0.77",
						"rgba"  => "rgba(242,23,127,0.77)"
					),
			),
			array(
				'id'               => 'titlebar_background',
				'type'             => 'background',
				'title'            => esc_html__('Title Bar Background Properties', 'digitallaw'),
				'subtitle'         => esc_html__('Set background for Title bar. You can set color or image and also set other background related properties.', 'digitallaw'),
				'preview_media'    => true,
				'background-color' => false,
				'output'           => array('div.tm-titlebar-wrapper'),
				'default'          => array( 
					"background-repeat"   => "no-repeat",
					"background-size"     => "cover",
					"background-position" => "center center",
					"background-image"    => get_template_directory_uri().'/images/tbar-bg.jpg',
				),
			),
			array(
				'id'    =>'html-titlebarfont',
				'type'  => 'info',
				'title' => esc_html__('Titlebar Font Settings', 'digitallaw'), 
				'desc'  => esc_html__('Font Settings for different elements in Titlebar area.', 'digitallaw'),
			),
			array(
				'id'          => 'titlebar_heading_font',
				'type'        => 'typography', 
				'title'       => esc_html__('Heading Font', 'digitallaw'),
				'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup' => true, // Select a backup non-google font in addition to a google font
				'subsets'     => false, // Only appears if google is true and subsets not set to false
				'text-align'  => false,
				'font-size'   => true,
				'line-height'    => true,
				'text-transform' => true,
				'word-spacing'   => false, // Defaults to false
				'letter-spacing' => true, // Defaults to false
				'color'       => false,
				'output'      => array('.tm-titlebar-main h1.entry-title'), // An array of CSS selectors
				'units'       => 'px', // Defaults to px
				'subtitle'    => esc_html__('Select font family, size etc. for heading in Titlebar.', 'digitallaw'),
				'default'     => array(
					'font-family'    => 'Roboto Condensed',
					'font-backup'    => "'Trebuchet MS', Helvetica, sans-serif",
					'google'         => '1',
					'font-weight'    => '700',
					'text-transform' => 'uppercase',
					'font-size'      => '40px',
					'line-height'    => '40px',
					'letter-spacing' => '1px',
				),
			),
			array(
				'id'          => 'titlebar_subheading_font',
				'type'        => 'typography', 
				'title'       => esc_html__('Sub-heading Font', 'digitallaw'),
				'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup' => true, // Select a backup non-google font in addition to a google font
				'subsets'     => false, // Only appears if google is true and subsets not set to false
				'text-align'  => false,
				'font-size'   => true,
				'line-height'    => true,
				'text-transform' => true,
				'word-spacing'   => false, // Defaults to false
				'letter-spacing' => true, // Defaults to false
				'color'       => false,
				//'preview'   => false, // Disable the previewer
				'output'      => array('.tm-titlebar-main h3.tm-subtitle'), // An array of CSS selectors
				'units'       => 'px', // Defaults to px
				'subtitle'    => esc_html__('Select font family, size etc. for sub-heading in Titlebar.', 'digitallaw'),
				'default'     => array(
					'font-family'    => 'Lora',
					'google'         => '1',
					'font-weight'    => '400',
					'font-style'     => 'italic',
					'text-transform' => 'none',
					'font-size'      => '20px',
					'line-height'    => '30px',
					'letter-spacing' => '1px',
				),
			),
			array(
				'id'          => 'titlebar_breadcrumb_font',
				'type'        => 'typography', 
				'title'       => esc_html__('Breadcrumb Font', 'digitallaw'),
				'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup' => true, // Select a backup non-google font in addition to a google font
				'subsets'     => false, // Only appears if google is true and subsets not set to false
				'text-align'  => false,
				'font-size'   => true,
				'line-height'    => true,
				'text-transform' => true,
				'word-spacing'   => false, // Defaults to false
				'letter-spacing' => true, // Defaults to false
				'color'       => false,
				'output'      => array('.tm-titlebar-wrapper .breadcrumb-wrapper, .breadcrumb-wrapper a'), // An array of CSS selectors
				'units'       => 'px', // Defaults to px
				'subtitle'    => esc_html__('Select font family, size etc. for breadcrumbs in Titlebar.', 'digitallaw'),
				'default'     => array(
					'font-family'    => 'Lora',
					'google'         => '1',
					'font-weight'    => '400',
					'font-style'     => 'italic',
					'text-transform' => 'capitalize',
					'font-size'      => '14px',
					'line-height'    => '20px',
					'letter-spacing' => '1px',
				),
			),

			array(
				'id'    =>'html-tbarcontent',
				'type'  => 'info',
				'title' => esc_html__('Titlebar Content Options', 'digitallaw'), 
				'desc'  => esc_html__('Content options for Titlebar area.', 'digitallaw'),
			),
			array(
				'id'            => 'tbar-height',
				'type'          => 'slider',
				'title'         => esc_html__( 'Titlebar Height', 'digitallaw' ),
				'subtitle'      => esc_html__( 'Set height of the Titlebar.', 'digitallaw' ),
				'desc'          => esc_html__( 'Set height of the Titlebar.', 'digitallaw' ),
				'default'       => 300,
				'min'           => 100,
				'step'          => 1,
				'max'           => 600,
				'display_value' => 'text',
			),
			array(
				'id'       => 'titlebar_view',
				'type'     => 'select',
				'title'    => esc_html__('Titlebar Text Align', 'digitallaw'), 
				'subtitle' => esc_html__('Select text align in Titlebar.', 'digitallaw'),
				'options'  => array(
						'default'  => esc_html__('All Center (default)', 'digitallaw'),
						'left'     => esc_html__('Title Left / Breadcrumb Right', 'digitallaw'),
						'right'    => esc_html__('Title Right / Breadcrumb Left', 'digitallaw'),
						'allleft'  => esc_html__('All Left', 'digitallaw'),
						'allright' => esc_html__('All Right', 'digitallaw'),
					),
				'default' => 'allleft'
			),
			array(
				'id'       => 'titlebar_text_color',
				'type'     => 'select',
				'title'    => esc_html__('Titlebar Text Color', 'digitallaw'), 
				'subtitle' => esc_html__('Select "Dark" color if you are going to select light color in above option.', 'digitallaw'),
				'options'  => array(
						'white'  => esc_html__('White', 'digitallaw'),
						'dark'   => esc_html__('Dark', 'digitallaw'),
						'custom' => esc_html__('Custom Color', 'digitallaw'),
					),
				'default' => 'white'
			),
			array(
				'id'       => 'titlebar_text_custom_color',
				'type'     => 'color',
				'title'    => esc_html__('Titlebar Custom Color for text', 'digitallaw'),
				//'subtitle' => esc_html__('Custom background color for Topbar.', 'digitallaw'),
				'default'  => '#dd3333',
				'required' => array(
								array('titlebar_text_color','equals','custom'),
					),
				'validate' => 'color',
			),
			array(
				'id'       => 'tbar_hide_bcrumb',
				'type'     => 'checkbox',
				'title'    => esc_html__( 'Hide Breadcrumb', 'digitallaw' ),
				'subtitle' => esc_html__( 'Check this box to hide breadcrumb globally', 'digitallaw' ),
				'desc'     => esc_html__( 'Check this box to hide breadcrumb globally', 'digitallaw' ),
				'default'  => '0'// 1 = on | 0 = off
			),
			
			// Titlebar Options
			array(
				'id'    =>'html-adv_titlebaroptions',
				'type'  => 'info',
				'title' => esc_html__('Titlebar Options', 'digitallaw'), 
				'desc'  => esc_html__('Change settings for Titlebar.', 'digitallaw')
			),
			array(
				'id'       => 'adv_tbar_catarc',
				'type'     => 'text',
				'title'    => esc_html__('Post Category "Category Archives:" Label Text', 'digitallaw'),
				'default'  => esc_html__('Category Archives: ', 'digitallaw'),
			),
			array(
				'id'       => 'adv_tbar_tagarc',
				'type'     => 'text',
				'title'    => esc_html__('Post Tag "Tag Archives:" Label Text', 'digitallaw'),
				'default'  => esc_html__('Tag Archives: ', 'digitallaw'),
			),
			array(
				'id'       => 'adv_tbar_postclassified',
				'type'     => 'text',
				'title'    => esc_html__('Post Taxonomy "Posts classified under:" Label Text', 'digitallaw'),
				'default'  => esc_html__('Posts classified under: ', 'digitallaw'),
			),
			array(
				'id'       => 'adv_tbar_authorarc',
				'type'     => 'text',
				'title'    => esc_html__('Post Author "Author Archives:" Label Text', 'digitallaw'),
				'default'  => esc_html__('Author Archives: ', 'digitallaw'),
			),
			
		),
	);


	// Header Settings
	$sections[] = array(
		'title'  => esc_html__('Header Settings', 'digitallaw'),
		'header' => esc_html__('Header Settings', 'digitallaw'),
		'desc'   => esc_html__('Header settings', 'digitallaw'),
		'icon_class' => 'icon-large',
		'icon'   => 'el-icon-th-list',
		'fields' => array(
			array(
				'id'       => 'headerbgcolor',
				'type'     => 'color_rgba',
				'title'    => esc_html__('Header Background Color', 'digitallaw'),
				'subtitle' => esc_html__('Custom color for header background.', 'digitallaw'),
				'default'  => array(
						"color" => "#ffffff",
						"alpha" => "1",
						"rgba"  => "rgba(255, 255, 255, 1)"
				),
			),
			array(
				'id'       => 'stickyheaderbgcolor',
				'type'     => 'color_rgba',
				'title'    => esc_html__('Sticky Header Background Color', 'digitallaw'),
				'subtitle' => esc_html__('Custom color for header background when becomes sticky.', 'digitallaw'),
				'default'  => array(
						"color" => "#ffffff",
						"alpha" => "1",
						"rgba"  => "rgba(255, 255, 255, 1)"
				),
				'output'   => array('background-color' => 'body.thememount-header-style-3 .is-sticky #navbar'),
			),
			array(
				'id'       => 'logotype',
				'type'     => 'radio',
				'title'    => esc_html__('Logo type', 'digitallaw'), 
				'subtitle' => esc_html__('Specify the type of logo. It can Text or Image', 'digitallaw'),
				'options'  => array( 'text' => esc_html__('Logo as Text', 'digitallaw'), 'image' => esc_html__('Logo as Image', 'digitallaw') ),
				'default'  => 'image'
			),
			array(
				'id'       => 'logotext',
				'type'     => 'text',
				'required' => array('logotype','equals','text'),
				'title'    => esc_html__('Logo Text', 'digitallaw'),
				'subtitle' => esc_html__('Enter the text to be used instead of the logo image', 'digitallaw'),
				'default'  => 'Digital LAW'
			),
			array(
				'id'          => 'logo_font',
				'type'        => 'typography', 
				'required'    => array('logotype','equals','text'),
				'title'       => esc_html__('Logo Font', 'digitallaw'),
				'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
				'text-align'  => false,
				'font-backup' => true, // Select a backup non-google font in addition to a google font
				'font-style'  => false, // Includes font-style and weight. Can use font-style or font-weight to declare
				'subsets'     => false, // Only appears if google is true and subsets not set to false
				'line-height' => false,
				'color'       => true,
				'output'      => array('.site-title a'), // An array of CSS selectors to apply this font style to dynamically
				'units'       => 'px', // Defaults to px
				'subtitle'    => esc_html__('This will be applied to logo text only. Select Logo font-style and size', 'digitallaw'),
				'default'     => array(
					'font-family'   => 'Raleway',
					'google'        => '1',
					"font-backup"   => "'Times New Roman', Times,serif",
					'font-weight'   => '700',
					'font-size'     => '36px', 
					'color'         => "#272727", 
				),
			),
			array(
				'id'       => 'logoimg',
				'type'     => 'media',
				'required' => array('logotype','equals','image'),
				'url'      => false,
				'title'    => esc_html__('Logo Image', 'digitallaw'),
				'subtitle' => esc_html__('Upload image that will be used as logo for the site ', 'digitallaw') .'  <br><strong>'.esc_html__('NOTE:', 'digitallaw') . '</strong> ' . esc_html__('Upload image that will be used as logo for the site', 'digitallaw'),
				'compiler' => 'true',
				'default'  => array(
								'url'    => get_template_directory_uri() . '/images/logo.png',
								'width'  => 271,
								'height' => 57,
				),
			),
			array(
				'id'       => 'logoimg_sticky',
				'type'     => 'media',
				'required' => array('logotype','equals','image'),
				'url'      => false,
				'title'    => esc_html__('Logo Image for Sticky Header', 'digitallaw'),
				'subtitle' => esc_html__('Upload image that will be used as logo for sticky header', 'digitallaw'),
				'compiler' => 'true',
			),
			array(
				'id'            => 'logo-max-height',
				'type'          => 'slider',
				'title'         => esc_html__( 'Logo Max Height', 'digitallaw' ),
				'subtitle'      => esc_html__( 'If you feel your logo looks small than increase this and adjust it.', 'digitallaw' ),
				'desc'          => esc_html__( 'If you feel your logo looks small than increase this and adjust it.', 'digitallaw' ),
				'default'       => 40,
				'min'           => 30,
				'step'          => 1,
				'max'           => 190,
				'display_value' => 'text',
				'required'      => array('logotype','equals','image'),
			),
			array(
				'id'            => 'logo-max-height-sticky',
				'type'          => 'slider',
				'title'         => esc_html__( 'Logo Max Height when Sticky Header', 'digitallaw' ),
				'subtitle'      => esc_html__( 'Set logo when the header is sticky.', 'digitallaw' ),
				'desc'          => esc_html__( 'Set logo when the header is sticky.', 'digitallaw' ),
				'default'       => 40,
				'min'           => 10,
				'step'          => 1,
				'max'           => 190,
				'display_value' => 'text',
				'required'      => array('logotype','equals','image'),
			),
			array(
				'id'            => 'header-height',
				'type'          => 'slider',
				'title'         => esc_html__( 'Header Height (in pixel)', 'digitallaw' ),
				'subtitle'      => esc_html__( 'You can set height of header area from here', 'digitallaw' ),
				'desc'          => esc_html__( 'You can set height of header area from here', 'digitallaw' ),
				'default'       => 110,
				'min'           => 60,
				'step'          => 1,
				'max'           => 200,
				'display_value' => 'text',
				//'required'      => array( 'headerstyle', 'equals', array('1','2') ),
			),
			array(
				'id'            => 'header-height-sticky',
				'type'          => 'slider',
				'title'         => esc_html__( 'Sticky Header Height (in pixel)', 'digitallaw' ),
				'subtitle'      => esc_html__( 'You can set height of header area when it becomes sticky', 'digitallaw' ),
				'desc'          => esc_html__( 'You can set height of header area when it becomes sticky', 'digitallaw' ),
				'default'       => 70,
				'min'           => 60,
				'step'          => 1,
				'max'           => 160,
				'display_value' => 'text',
			),
			array(
				'id'    =>'html-showsearchbtn',
				'type'  => 'info',
				'title' => esc_html__('Search Button in Header', 'digitallaw'), 
				'desc'  => esc_html__('Option to show or hide search button in header area.', 'digitallaw'),
			),
			array(
				'id'       => 'header_search',
				'type'     => 'switch',
				'title'    => esc_html__('Show Search Button', 'digitallaw'), 
				'subtitle' => esc_html__('Set this option "YES" to show search button in header. The icon will be at the right side (after menu).', 'digitallaw'),
				'default'  => '1', // 1 = on | 0 = off
				'on'       => esc_html__('Yes', 'digitallaw'),
				'off'      => esc_html__('No', 'digitallaw'),
			),
			array(
				'id'       => 'search_input',
				'type'     => 'text',
				'title'    => esc_html__('Search Form Input Word', 'digitallaw'),
				'subtitle' => esc_html__('Write the search form input word here.', 'digitallaw'). ' <br> ' . esc_html__('Default:', 'digitallaw'). ' ' . esc_html__("WRITE SEARCH WORD...", 'digitallaw'),
				'default'  => esc_html__("WRITE SEARCH WORD...", 'digitallaw'),
				'required' => array('header_search','equals','1'),
			),
			array(
				'id'    =>'html-stickyheader',
				'type'  => 'info',
				'title' => esc_html__('Sticky Header', 'digitallaw'), 
				'desc'  => esc_html__('Options for sticky header', 'digitallaw')
			),
			array(
				'id'       => 'stickyheader',
				'type'     => 'radio',
				//'customizer' => false,
				'title'    => esc_html__('Enable Sticky Header', 'digitallaw'), 
				'subtitle' => esc_html__('Select YES if you want the sticky header on page scroll', 'digitallaw'),
				'options'  => array( 'y' => esc_html__('Yes', 'digitallaw'), 'n' => esc_html__('No', 'digitallaw') ),
				'default'  => 'y'
			),
			array(
				'id'    =>'html-headerstyle',
				'type'  => 'info',
				'title' => esc_html__('Header Style', 'digitallaw'), 
				'desc'  => esc_html__('Options to change header style', 'digitallaw')
			),
			array(
				'id'       => 'headerstyle',
				'type'     => 'image_select',
				'title'    => esc_html__('Select Header Style', 'digitallaw'), 
				'subtitle' => esc_html__('Please select header style', 'digitallaw'),
				'options' => array(
					'1' => array(
						'alt' => esc_html__('Left logo and right menu', 'digitallaw'),
						'img' => get_template_directory_uri() . '/inc/images/classic.png'
					),
					'9' => array(
						'alt' => esc_html__('Left menu and right logo', 'digitallaw'),
						'img' => get_template_directory_uri() . '/inc/images/classic-rtl.png'
					),
					'2' => array(
						'alt' => esc_html__('Centre logo between menu', 'digitallaw'),
						'img' => get_template_directory_uri() . '/inc/images/split.png'
					),
					'3' => array(
						'alt' => esc_html__('Centre logo above menu', 'digitallaw'),
						'img' => get_template_directory_uri() . '/inc/images/info-stack.png'
					),
					'4' => array(
						'alt' => esc_html__('Logo and Menu overlay on slider and Titlebar', 'digitallaw'),
						'img' => get_template_directory_uri() . '/inc/images/classic-overlay.png'
					),
					'10' => array(
						'alt' => esc_html__('Logo and Menu overlay on slider and Titlebar (Right logo)', 'digitallaw'),
						'img' => get_template_directory_uri() . '/inc/images/classic-overlay-rtl.png'
					),
					'5' => array(
						'alt' => esc_html__('Logo and Menu overlay on slider and Titlebar', 'digitallaw'),
						'img' => get_template_directory_uri() . '/inc/images/split-overlay.png'
					),
					'6' => array(
						'alt' => esc_html__('Logo and Menu overlay on slider and Titlebar', 'digitallaw'),
						'img' => get_template_directory_uri() . '/inc/images/stack-center.png'
					),
					'13' => array(
						'alt' => esc_html__('Logo and Menu overlay on slider and Titlebar. normal view', 'digitallaw'),
						'img' => get_template_directory_uri() . '/inc/images/stack-center-overlay.png'
					),
					'7' => array(
						'alt' => esc_html__('Boxed Header overlay on slider and Titlebar (Left logo)', 'digitallaw'),
						'img' => get_template_directory_uri() . '/inc/images/elegant.png'
					),
					'8' => array(
						'alt' => esc_html__('Boxed Header overlay on slider and Titlebar (Right Logo)', 'digitallaw'),
						'img' => get_template_directory_uri() . '/inc/images/elegant-rtl.png'
					),
					
				),
				'default' => '1'
			),
			array(
				'id'            => 'center-logo-width',
				'type'          => 'slider',
				'title'         => esc_html__( 'Logo Area Width (pixel)', 'digitallaw' ),
				'subtitle'      => esc_html__( 'This is the width of the logo area. This is for centre-logo header style only.', 'digitallaw' ),
				'desc'          => esc_html__( 'You need to change this only when your menu overlays on the logo. This should be bigger that the logo width (ignore this if retina logo). Please set this and check your site for best results.', 'digitallaw' ),
				'default'       => 225,
				'min'           => 10,
				'step'          => 5,
				'max'           => 500,
				'display_value' => 'text',
				'required'      => array( 'headerstyle', 'equals', array('2','5') ),
			),
			array(
				'id'            => 'first-menu-margin',
				'type'          => 'slider',
				'title'         => esc_html__( 'Menu Left margin (pixel)', 'digitallaw' ),
				'subtitle'      => esc_html__( 'This is to set the logo appear at center with the menu. The logo will be always center. This is an advanced option.', 'digitallaw' ),
				'desc'          => esc_html__( 'You need to change this only when you feel your menu is not center aligned with logo. Please set this and check your site for best results.', 'digitallaw' ),
				'default'       => 210,
				'min'           => -500,
				'step'          => 5,
				'max'           => 500,
				'display_value' => 'text',
				'required'      => array('headerstyle', 'equals', array('2','5') ),
			),
			// Custom bg color for header style 3, 6 
			array(
				'id'       => 'menubgcolor',
				'type'     => 'color',
				'title'    => esc_html__('Menu Background Color', 'digitallaw'),
				'subtitle' => esc_html__('Custom color for menu background. This option created specially for selected header only.', 'digitallaw'),
				'default'  => '#f3f3f3',
				'validate' => 'color',
				'required' => array('headerstyle','equals',array('3','6','13')),
				'output'   => array('background-color' => '.thememount-header-style-3 .tm-header-bottom-wrapper, body.thememount-header-style-3 .is-sticky #navbar, body.thememount-header-style-3 #navbar'),
			),
			//Advanced Header Settings
			array(
				'id'    	=>'adv_header_settings',
				'type' 		=> 'info',
				'title' 	=> esc_html__('Advanced Header Settings', 'digitallaw'), 
				'desc'  	=> esc_html__('Some advance setting for header area', 'digitallaw'),
				'required' 	=> array( 
								array('headerstyle','!=','2'), 
								array('headerstyle','!=','5'),
								array('headerstyle','!=','6'), 
								array('headerstyle','!=','15'), 
							),
			),
			array(
				'id'       => 'header_right_content',
				'type'     => 'textarea',
				'title'    => esc_html__('Header Button Area', 'digitallaw'), 
				'subtitle' => esc_html__('This content will appear after Search/Cart icon in header area. This option will work for currently selected header style only', 'digitallaw'),
				'desc'     => esc_html__('Some HTML tags and shortcodes are allowed.', 'digitallaw') . '<br><a href="'. esc_url('http://digitallaw.thememountdemo.com/documentation/shortcodes.html') .'" target="_blank">' . esc_html__('Click here to get list of all shortcodes.','digitallaw') . '</a><br><br>' . esc_html__('Default:', 'digitallaw'). ' <pre>[vc_btn title="APPOINTMENT" style="classic"]</pre> ',
				
				
				'validate' => 'html',
				'default'  => '',
				//'required' => array('headerstyle', 'equals', array('1','3','4','6','7','8','9','10',) ),
				'required' => array( 
								array('headerstyle','!=','2'), 
								array('headerstyle','!=','3'), 
								array('headerstyle','!=','5'),
								array('headerstyle','!=','6'), 
								array('headerstyle','!=','15'), 
							),
			),
			array(
				'id'       => 'header_three_content',
				'type'     => 'textarea',
				'title'    => esc_html__('Content for "Info Stack" Header', 'digitallaw'), 
				'subtitle' => esc_html__('This content will appear on Right side the LOGO, and will only work when "Info Stack" header is selected', 'digitallaw'),
				'desc'     => esc_html__('Some HTML tags and shortcodes are allowed.', 'digitallaw') . '<br><a href="'. esc_url('http://digitallaw.thememountdemo.com/documentation/shortcodes.html') .'" target="_blank">' . esc_html__('Click here to get list of all shortcodes.','digitallaw') . '</a>',
				'validate' => 'html',
				'required' => array('headerstyle', 'equals', array('3') ),
				'default'  => '<ul>
	<li class="fst">
	<div class="media-left">
	<div class="icon"> <i class="fa fa-map-marker"></i></div>
	</div>
	<div class="media-right">
	<h6 class="font-raleway">Our Location </h6>
	<span>24 Fifth st., Los Angeles, USA </span> </div>
	</li>

	<li>
	<div class="media-left">
	<div class="icon"> <i class="fa fa-clock-o"></i></div>
	</div>
	<div class="media-right">
	<h6>WE ARE OPEN!</h6>
	<span>Mon-Fri 8:00-16:00</span> </div>
	</li>
	<li>[vc_btn title="Free Consultation" style="classic" link="url:%23|||"]</li>
	</ul>',
			),
			
			// SEO Settings
			array(
				'id'    =>'html-seosettings',
				'type'  => 'info',
				'title' => esc_html__('Logo SEO', 'digitallaw'), 
				'desc'  => esc_html__('Options for Logo SEO', 'digitallaw'),
			),
			array(
				'id'       => 'logoseo',
				'type'     => 'radio',
				'title'    => esc_html__('Logo Tag for SEO', 'digitallaw'), 
				'subtitle' => esc_html__('Select logo tag for SEO purpose.', 'digitallaw'),
				'options'  => array(
					'h1homeonly' => esc_html__('H1 for home, SPAN on other pages', 'digitallaw'),
					'allh1'      => esc_html__('H1 tag everywhere', 'digitallaw'),
				),
				'default'  => 'h1homeonly',
			),
		),
	);


	// Menu Settings
	$sections[] = array(
		'title'  => esc_html__('Menu Settings', 'digitallaw'),
		'header' => esc_html__('Menu Settings', 'digitallaw'),
		'desc'   => esc_html__('Menu settings', 'digitallaw'),
		'icon_class' => 'icon-large',
		'icon'   => 'el-icon-th-list',
		'fields' => array(
			// Responsive Menu Breakpoint
			array(
				'id'    =>'html-responsive_menu_breakpoint',
				'type'  => 'info',
				'title' => esc_html__('Responsive Menu Breakpoint', 'digitallaw'), 
				'desc'  => esc_html__('Change options for responsive menu breakpoint.', 'digitallaw')
			),
			array(
				'id'       => 'menu_breakpoint',
				'type'     => 'radio',
				'title'    => esc_html__('Responsive Menu Breakpoint', 'digitallaw'), 
				'subtitle' => esc_html__('Change options for responsive menu breakpoint.', 'digitallaw'),
				'options'  => array(
					'1200'   => esc_html__('Large devices','digitallaw').'<small>'.esc_html__('Desktops (>1200px)', 'digitallaw').'</small>',
					'992'    => esc_html__('Medium devices','digitallaw').'<small>'.esc_html__('Desktops and Tablets (>992px)', 'digitallaw').'</small>',
					'768'    => esc_html__('Small devices','digitallaw').'<small>'.esc_html__('Mobile and Tablets (>768px)', 'digitallaw').'</small>',
					'custom' => esc_html__('Custom (select pixel below)', 'digitallaw'),
				),
				'default'  => '1200'
			),
			array(
				'id'            => 'menu_breakpoint_custom',
				'type'          => 'slider',
				'title'         => esc_html__( 'Custom Breakpoint for Menu (in pixel)', 'digitallaw' ),
				'subtitle'      => esc_html__( 'Select after how many pixels the menu will become responsive.', 'digitallaw' ),
				'default'       => 1200,
				'min'           => 1,
				'step'          => 1,
				'max'           => 1200,
				'display_value' => 'text',
				'required'      => array('menu_breakpoint','equals','custom'),
			),
			
			// Main Menu Options
			array(
				'id'    =>'html-mainmenuoptions',
				'type'  => 'info',
				'title' => esc_html__('Main Menu Options', 'digitallaw'), 
				'desc'  => esc_html__('Options for main menu in header', 'digitallaw')
			),
			array(
				'id'          => 'mainmenufont',
				'type'        => 'typography', 
				'title'       => esc_html__('Main Menu Font', 'digitallaw'),
				'text-align'  => false,
				'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup' => true, // Select a backup non-google font in addition to a google font
				'subsets'     => false, // Only appears if google is true and subsets not set to false
				'line-height' => true,
				'font-weight' => true,
				'text-transform' => true,
				'letter-spacing' => true, // Defaults to false
				'color'       => true,
				'output'      => array( '.header-controls .thememount-header-cart-link-wrapper a .thememount-cart-qty, #navbar #site-navigation div.nav-menu > ul > li > a, #navbar #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal > li.mega-menu-item > a' ), // An array of CSS selectors to apply this font style to dynamically
				'units'       => 'px', // Defaults to px
				'subtitle'    => esc_html__('Select font, color and size for main menu.', 'digitallaw'),
				'default'     => array(
					'font-family'    => 'Roboto Condensed',
					'font-backup'    => "'Trebuchet MS', Helvetica, sans-serif",
					'font-options'   => '',
					'google'         => '1',
					'font-backup'    => "Arial, Helvetica, sans-serif",
					'font-weight'    => '700',
					'font-style'     => '',
					'text-transform' => 'uppercase',
					'font-size'      => '14px',
					'line-height'    => '35px',
					'letter-spacing' => '1.5px',
					'color'          => '#222222',
				),
			),
			array(
				'id'       => 'stickymainmenufontcolor',
				'type'     => 'color',
				'title'    => esc_html__('Main Menu Font Color for Sticky Header', 'digitallaw'),
				'subtitle' => esc_html__('Main menu font color when the header becomes sticky.', 'digitallaw'),
				'default'  => '#222222',
				'validate' => 'color',
			),
			array(
				'id'       => 'mainmenu_active_link_color',
				'type'     => 'select',
				'title'    => esc_html__('Main Menu Active Link Color', 'digitallaw'), 
				'subtitle' => '<strong> '. esc_html__('Tips:', 'digitallaw') .' </strong>
									<ul>
										<li><code>'. esc_html__('Skin color (default):', 'digitallaw') .'</code> '. esc_html__('Skin color for active link color.', 'digitallaw') .'</li>
										<li><code>'. esc_html__('Custom color:', 'digitallaw') .'</code> '. esc_html__('Custom color for active link color. Useful if you like to use any color for active link color.', 'digitallaw') .'</li>
									</ul>
									',
				'options'  => array(
						'skin'   => esc_html__('Skin color (default)', 'digitallaw'),
						'custom' => esc_html__('Custom color (select below)', 'digitallaw'),
					),
				'default' => 'skin'
			),
			array(
				'id'       => 'mainmenu_active_link_custom_color',
				'type'     => 'color',
				'title'    => esc_html__('Main Menu Active Link Custom Color', 'digitallaw'),
				'subtitle' => esc_html__('Custom color for main menu active menu text.', 'digitallaw'),
				'default'  => '#ff0505',
				'validate' => 'color',
				'required' => array('mainmenu_active_link_color','equals','custom'),
			),
			
			// Dropdown menu options
			array(
				'id'    =>'html-dropmenuoptions',
				'type'  => 'info',
				'title' => esc_html__('Drop Down Menu Options', 'digitallaw'), 
				'desc'  => esc_html__('Options for drop down menu in header', 'digitallaw')
			),
			array(
				'id'          => 'dropdownmenufont',
				'type'        => 'typography', 
				'title'       => esc_html__('Dropdown Menu Font', 'digitallaw'),
				'text-align'  => false,
				'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup' => true, // Select a backup non-google font in addition to a google font
				'subsets'     => false, // Only appears if google is true and subsets not set to false
				'line-height' => true,
				'font-weight' => true,
				'text-transform' => true,
				'word-spacing' => false, // Defaults to false
				'letter-spacing' => true, // Defaults to false
				'color'       => true,
				'output'      => array('ul.nav-menu li ul li a, div.nav-menu > ul li ul li a, #navbar #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu a, #navbar #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu a:hover, #navbar #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu a:focus, #navbar #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu a.mega-menu-link, #navbar #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu a.mega-menu-link:hover, #navbar #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu a.mega-menu-link:focus, #navbar #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal > li.mega-menu-megamenu > ul.mega-sub-menu > li.mega-menu-item li.mega-menu-item > a.mega-menu-link'), // An array of CSS selectors to apply this font style to dynamically
				'units'       => 'px', // Defaults to px
				'subtitle'    => esc_html__('Select font, color and size for dropdown menu.', 'digitallaw'),
				'default'     => array(
					'font-family'    => 'Roboto Condensed',
					'font-backup'    => "'Trebuchet MS', Helvetica, sans-serif",
					'google'         => '1',
					'font-weight'    => '400',
					'text-transform' => 'uppercase',
					'font-size'      => '12px',
					'line-height'    => '20px',
					'letter-spacing' => '1px',
					'color'          => '#ffffff',
				),
			),
			array(
				'id'       => 'dropmenu_active_link_color',
				'type'     => 'select',
				'title'    => esc_html__('Dropdown Menu Active Link Color', 'digitallaw'), 
				'subtitle' => '<strong> '. esc_html__('Tips:', 'digitallaw') .' </strong>
									<ul>
										<li><code>'. esc_html__('Skin color (default):', 'digitallaw') .'</code> '. esc_html__('Skin color for active link color.', 'digitallaw') .'</li>
										<li><code>'. esc_html__('Custom color:', 'digitallaw') .'</code> '. esc_html__('Custom color for active link color. Useful if you like to use any color for active link color.', 'digitallaw') .'</li>
									</ul>
									',
				'options'  => array(
						'skin'   => esc_html__('Skin color (default)', 'digitallaw'),
						'custom' => esc_html__('Custom color (select below)', 'digitallaw'),
					),
				'default' => 'skin'
			),
			array(
				'id'       => 'dropmenu_active_link_custom_color',
				'type'     => 'color',
				'title'    => esc_html__('Dropdown Menu Active Link Custom Color', 'digitallaw'),
				'subtitle' => esc_html__('Custom color for dropdown menu active menu text.', 'digitallaw'),
				'default'  => '#ff1111',
				'validate' => 'color',
				'required' => array('dropmenu_active_link_color','equals','custom'),
			),
			
			
			array(
				'id'            => 'dropmenu_background',
				'type'          => 'background',
				'title'         => esc_html__('Dropdown Menu Background Properties', 'digitallaw'),
				'subtitle'      => esc_html__('Set background for dropdown menu.', 'digitallaw'),
				'preview_media' => true,
				'output'        => array('ul.nav-menu li ul, div.nav-menu > ul .children, #navbar #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu, #navbar #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu a:hover, 
	#navbar #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu li:hover > a, #navbar #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu a, #navbar #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu a.mega-menu-link:hover, 
	#navbar #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu li:hover > a.mega-menu-link, #navbar #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu a.mega-menu-link'),
				'default'       => array( "background-color" => "#222222", ),
			),
			array(
				'id'       => 'dropdown_menu_separator',
				'type'     => 'radio',
				'title'    => esc_html__('Separator line between dropdown menu links', 'digitallaw'), 
				'subtitle' => '<strong> '. esc_html__('Tips:', 'digitallaw') .' </strong>
									<ul>
										<li><code>'. esc_html__('Grey color as border color (default):', 'digitallaw') .'</code> '. esc_html__('This is default border view.', 'digitallaw') .'</li>
										<li><code>'. esc_html__('White color:', 'digitallaw') .'</code> '. esc_html__('Select this option if you are going to select dark background color (for dropdown menu)', 'digitallaw') .'</li>
										<li><code>'. esc_html__('No separator border:', 'digitallaw') .'</code> '. esc_html__('Completely remove border. This will make your menu totally flat.', 'digitallaw') .'</li>
									</ul>
									',
				'options'  => array(
								'grey'  => esc_html__('Grey color as border color (default)', 'digitallaw'),
								'white' => esc_html__('White color as border color (for dark background color)', 'digitallaw'),
								'no'    => esc_html__('No separator border', 'digitallaw'),
							),
				'default'  => 'white'
			),
			array(
				'id'       => 'dropdown_menu_separator_vertical',
				'type'     => 'radio',
				'title'    => esc_html__('Vertical Separator line between dropdown menu links (Mega Menu only)', 'digitallaw'), 
				'subtitle' => '<strong>'. esc_html__('Tips:', 'digitallaw') .'</strong>
									<ul>
										<li><code>'. esc_html__('Grey color as border color (default):', 'digitallaw') .'</code> '. esc_html__('This is grey border view.', 'digitallaw') .' </li>
										<li><code>'. esc_html__('White color:', 'digitallaw') .'</code> '. esc_html__('Select this option if you are going to select dark background color (for dropdown menu)', 'digitallaw') .'</li>
										<li><code>'. esc_html__('No separator border:', 'digitallaw') .'</code> '. esc_html__('Completely remove border. This will make your menu totally flat.', 'digitallaw') .'</li>
									</ul>',
				'options'  => array(
								'grey'  => esc_html__('Grey color as border color (default)', 'digitallaw'),
								'white' => esc_html__('White color as border color (for dark background color)', 'digitallaw'),
								'no'    => esc_html__('No separator border', 'digitallaw'),
							),
				'default'  => 'white'
			),
			array(
				'id'             => 'megamenu_widget_title',
				'type'           => 'typography', 
				'title'          => esc_html__('Mega Menu Widget Title Settings', 'digitallaw'),
				'text-align'     => false,
				'google'         => true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup'    => true, // Select a backup non-google font in addition to a google font
				'subsets'        => false, // Only appears if google is true and subsets not set to false
				'line-height'    => true,
				'text-transform' => true,
				'word-spacing'   => false, // Defaults to false
				'letter-spacing' => true, // Defaults to false
				'color'          => true,
				'output'         => array('#navbar #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu > li.mega-menu-item > h4.mega-block-title'), // An array of CSS selectors to apply this font style to dynamically
				'units'          => 'px', // Defaults to px
				'subtitle'       => esc_html__('Font settings for mega menu widget title.', 'digitallaw') . '<br><br> <strong>'. esc_html__('NOTE:', 'digitallaw') .'</strong> '. esc_html__('This will work only if you installed "Max Mega Menu" plugin and also activated in the main (primary) menu.', 'digitallaw'),
				'default'        => array(
					'font-family'    => 'Roboto Condensed',
					'font-backup'    => "'Trebuchet MS', Helvetica, sans-serif",
					'google'         => '1',
					'font-weight'    => '700',
					'font-size'      => '18px',
					'line-height'    => '20px',
					'letter-spacing' => '1px',
					'color'          => '#ffffff',
				),
			),
			array(
				'id'             => 'megamenu_widget_content',
				'type'           => 'typography', 
				'title'          => esc_html__('Mega Menu Widget Content Settings', 'digitallaw'),
				'text-align'     => false,
				'google'         => true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup'    => true, // Select a backup non-google font in addition to a google font
				'subsets'        => false, // Only appears if google is true and subsets not set to false
				'line-height'    => true,
				'text-transform' => true,
				'word-spacing'   => false, // Defaults to false
				'letter-spacing' => true, // Defaults to false
				'color'          => true,
				'output'         => array('#navbar #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu > li.mega-menu-item-type-widget'), // An array of CSS selectors to apply this font style to dynamically
				'units'          => 'px', // Defaults to px
				'subtitle'       => esc_html__('Font settings for mega menu widget title.', 'digitallaw') . '<br><br> <strong>'. esc_html__('NOTE:', 'digitallaw') .'</strong> '. esc_html__('This will work only if you installed "Max Mega Menu" plugin and also activated in the main (primary) menu.', 'digitallaw'),
				'default'        => array(
					'font-family'    => 'Roboto Condensed',
					'font-backup'    => "'Trebuchet MS', Helvetica, sans-serif",
					'google'         => '1',
					'font-weight'    => '400',
					'font-size'      => '14px',
					'line-height'    => '22px',
					'letter-spacing' => '1px',
					'color'          => '#ffffff',
				),
			),
			
			array(
				'id'    =>'html-mmmenu-dropdown-bg',
				'type'  => 'info',
				'title' => esc_html__('Max mega Menu - Background Settings for Dropdown menu', 'digitallaw'), 
				'desc'  => esc_html__('Set background for dropdown menu.', 'digitallaw') . '<br><strong>' . esc_html__('NOTE:', 'digitallaw') . '</strong>  ' . esc_html__('This will work only if the mega menu (via "Max Mega Menu" plugin) is enabled in the menu.', 'digitallaw')
			),
			array(
				'id'            => 'mmmenu_dropdown_bg_1',
				'type'          => 'background',
				'title'         => esc_html__('First dropdown menu background', 'digitallaw'),
				'subtitle'      => esc_html__('Set background for first dropdown menu.', 'digitallaw') . '<br><strong>' . esc_html__('NOTE:', 'digitallaw') . '</strong>  ' . esc_html__('This will work only if the mega menu (via "Max Mega Menu" plugin) is enabled in the menu.', 'digitallaw'),
				'preview_media' => true,
				'output'        => array('#navbar #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(1) ul.mega-sub-menu, #navbar #site-navigation div.nav-menu > ul > li:nth-child(1) ul'),
				
				
			),
			array(
				'id'            => 'mmmenu_dropdown_bg_2',
				'type'          => 'background',
				'title'         => esc_html__('Second dropdown menu background', 'digitallaw'),
				'subtitle'      => esc_html__('Set background for second dropdown menu.', 'digitallaw') . '<br><strong>' . esc_html__('NOTE:', 'digitallaw') . '</strong>  ' . esc_html__('This will work only if the mega menu (via "Max Mega Menu" plugin) is enabled in the menu.', 'digitallaw'),
				'preview_media' => true,
				'output'        => array('#navbar #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(2) ul.mega-sub-menu, #navbar #site-navigation div.nav-menu > ul > li:nth-child(2) ul'),
			),
			array(
				'id'            => 'mmmenu_dropdown_bg_3',
				'type'          => 'background',
				'title'         => esc_html__('Third dropdown menu background', 'digitallaw'),
				'subtitle'      => esc_html__('Set background for third dropdown menu.', 'digitallaw') . '<br><strong>' . esc_html__('NOTE:', 'digitallaw') . '</strong>  ' . esc_html__('This will work only if the mega menu (via "Max Mega Menu" plugin) is enabled in the menu.', 'digitallaw'),
				'preview_media' => true,
				'output'        => array('#navbar #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(3) ul.mega-sub-menu, #navbar #site-navigation div.nav-menu > ul > li:nth-child(3) ul'),
			),
			array(
				'id'            => 'mmmenu_dropdown_bg_4',
				'type'          => 'background',
				'title'         => esc_html__('Fourth dropdown menu background', 'digitallaw'),
				'subtitle'      => esc_html__('Set background for fourth dropdown menu.', 'digitallaw') . '<br><strong>' . esc_html__('NOTE:', 'digitallaw') . '</strong>  ' . esc_html__('This will work only if the mega menu (via "Max Mega Menu" plugin) is enabled in the menu.', 'digitallaw'),
				'preview_media' => true,
				'output'        => array('#navbar #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(4) ul.mega-sub-menu, #navbar #site-navigation div.nav-menu > ul > li:nth-child(4) ul'),
			),
			array(
				'id'            => 'mmmenu_dropdown_bg_5',
				'type'          => 'background',
				'title'         => esc_html__('Fifth dropdown menu background', 'digitallaw'),
				'subtitle'      => esc_html__('Set background for fifth dropdown menu.', 'digitallaw') . '<br><strong>' . esc_html__('NOTE:', 'digitallaw') . '</strong>  ' . esc_html__('This will work only if the mega menu (via "Max Mega Menu" plugin) is enabled in the menu.', 'digitallaw'),
				'preview_media' => true,
				'output'        => array('#navbar #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(5) ul.mega-sub-menu, #navbar #site-navigation div.nav-menu > ul > li:nth-child(5) ul'),
			),
			array(
				'id'            => 'mmmenu_dropdown_bg_6',
				'type'          => 'background',
				'title'         => esc_html__('Sixth dropdown menu background', 'digitallaw'),
				'subtitle'      => esc_html__('Set background for sixth dropdown menu.', 'digitallaw') . '<br><strong>' . esc_html__('NOTE:', 'digitallaw') . '</strong>  ' . esc_html__('This will work only if the mega menu (via "Max Mega Menu" plugin) is enabled in the menu.', 'digitallaw'),
				'preview_media' => true,
				'output'        => array('#navbar #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(6) ul.mega-sub-menu, #navbar #site-navigation div.nav-menu > ul > li:nth-child(6) ul'),
			),
			array(
				'id'            => 'mmmenu_dropdown_bg_7',
				'type'          => 'background',
				'title'         => esc_html__('Seventh dropdown menu background', 'digitallaw'),
				'subtitle'      => esc_html__('Set background for seventh dropdown menu.', 'digitallaw') . '<br><strong>' . esc_html__('NOTE:', 'digitallaw') . '</strong>  ' . esc_html__('This will work only if the mega menu (via "Max Mega Menu" plugin) is enabled in the menu.', 'digitallaw'),
				'preview_media' => true,
				'output'        => array('#navbar #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(7) ul.mega-sub-menu, #navbar #site-navigation div.nav-menu > ul > li:nth-child(7) ul'),
			),
			array(
				'id'            => 'mmmenu_dropdown_bg_8',
				'type'          => 'background',
				'title'         => esc_html__('Eighth dropdown menu background', 'digitallaw'),
				'subtitle'      => esc_html__('Set background for eighth dropdown menu.', 'digitallaw') . '<br><strong>' . esc_html__('NOTE:', 'digitallaw') . '</strong>  ' . esc_html__('This will work only if the mega menu (via "Max Mega Menu" plugin) is enabled in the menu.', 'digitallaw'),
				'preview_media' => true,
				'output'        => array('#navbar #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(8) ul.mega-sub-menu, #navbar #site-navigation div.nav-menu > ul > li:nth-child(8) ul'),
			),
			array(
				'id'            => 'mmmenu_dropdown_bg_9',
				'type'          => 'background',
				'title'         => esc_html__('Ninth dropdown menu background', 'digitallaw'),
				'subtitle'      => esc_html__('Set background for ninth dropdown menu.', 'digitallaw') . '<br><strong>' . esc_html__('NOTE:', 'digitallaw') . '</strong>  ' . esc_html__('This will work only if the mega menu (via "Max Mega Menu" plugin) is enabled in the menu.', 'digitallaw'),
				'preview_media' => true,
				'output'        => array('#navbar #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(9) ul.mega-sub-menu, #navbar #site-navigation div.nav-menu > ul > li:nth-child(9) ul'),
			),
			array(
				'id'            => 'mmmenu_dropdown_bg_10',
				'type'          => 'background',
				'title'         => esc_html__('Tenth dropdown menu background', 'digitallaw'),
				'subtitle'      => esc_html__('Set background for tenth dropdown menu.', 'digitallaw') . '<br><strong>' . esc_html__('NOTE:', 'digitallaw') . '</strong>  ' . esc_html__('This will work only if the mega menu (via "Max Mega Menu" plugin) is enabled in the menu.', 'digitallaw'),
				'preview_media' => true,
				'output'        => array('#navbar #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(10) ul.mega-sub-menu, #navbar #site-navigation div.nav-menu > ul > li:nth-child(10) ul'),
			),
			
			
			
		
		),
	);




	// Footer Settings
	$sections[] = array(
		'title'  => esc_html__('Footer Settings', 'digitallaw'),
		'header' => esc_html__('Footer Settings', 'digitallaw'),
		'desc'   => esc_html__('Settings of the elements from the page footer area', 'digitallaw'),
		'icon_class' => 'icon-large',
		'icon'   => 'el-icon-return-key',
		'fields' => array(
			array(
				'id'    =>'html-stickyfooter',
				'type'  => 'info',
				'title' => esc_html__('Sticky Footer', 'digitallaw'), 
				'desc'  => esc_html__('Make footer sticky and visible on scrolling at bottom.', 'digitallaw')
			),
			array(
				'id'         => 'stickyfooter',
				'type'       => 'switch',
				'title'      => esc_html__('Sticky Footer', 'digitallaw'), 
				'subtitle'   => esc_html__('Set this option "YES" to enable sticky footer on scrolling at bottom.', 'digitallaw'),
				'on'       => esc_html__('Yes', 'digitallaw'),
				'off'      => esc_html__('No', 'digitallaw'),
				'default'    => '0', // 1 = on | 0 = off
			),
			//Footer Widget area
			array(
				'id'    =>'html-coloroption',
				'type'  => 'info',
				'title' => esc_html__('Footer Background and Color Options', 'digitallaw'), 
				'desc'  => esc_html__('Options to change settings for footer background and color.', 'digitallaw')
			),
			array(
				'id'               => 'footerwidget_bgimage',
				'type'             => 'background',
				'title'            => esc_html__('Footer Background', 'digitallaw'),
				'subtitle'         => esc_html__('Footer background image', 'digitallaw'),
				'preview_media'    => true,
				'background-color' => false,
				'output'           => array('#page footer.site-footer > div.footer'),
				'default'          => array(
					'background-repeat'   => 'no-repeat',
					'background-size'     => 'cover',
					'background-position' => 'center top',
					'background-image'    => get_template_directory_uri() . '/images/fwidget-bg.jpg',
				),
			),
			array(
				'id'       => 'footerwidget_bgcolor',
				'type'     => 'color_rgba',
				'title'    => esc_html__('Footer Background Color', 'digitallaw'),
				'subtitle' => esc_html__('Custom color for footer background.', 'digitallaw'),
				'default'  => array(
					'color'  => '#212121',
					'alpha'  => '0.97',
					'rgba'   => 'rgba(33,33,33,0.97)',
				),
				'output'   => array('background-color' => '#page footer.site-footer > div.footer > div.footer-inner'),
				//'validate' => 'color',
			),
			array(
				'id'       => 'footerwidget_color',
				'type'     => 'select',
				'title'    => esc_html__('Text Color', 'digitallaw'), 
				'subtitle' => esc_html__('Select "Dark" color if you are going to select light color in above option.', 'digitallaw'),
				'options'  => array(
						'white'  => esc_html__('White', 'digitallaw'),
						'dark'   => esc_html__('Dark', 'digitallaw'),
					),
				'default' => 'white'
			),
			
			// Top Footer Widget Area
			array(
				'id'    =>'html_top_footer_widget',
				'type'  => 'info',
				'title' => esc_html__('First Row Footer Widget Area', 'digitallaw'), 
				'desc'  => esc_html__('Change Columns of First Row Footer Widget Area', 'digitallaw')
			),
			array(
				'id'      => 'top_footer_widget_column',
				'type'    => 'image_select',
				'title'   => esc_html__('Select Column Layout for First Row Footer Widget Area', 'digitallaw'), 
				'desc'    => esc_html__('Select Column layout View.', 'digitallaw'),
				'options' => array(
					'12' => array('title' => esc_html__('One Column', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/footer_col_12.png'),
					'6_6' => array('title' => esc_html__('Two Columns', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/footer_col_6_6.png'),
					'4_4_4' => array('title' => esc_html__('Three Columns', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/footer_col_4_4_4.png'),
					'3_3_3_3' => array('title' => esc_html__('Four Columns', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/footer_col_3_3_3_3.png'),
					'8_4' => array('title' => esc_html__('8 + 4 Columns', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/footer_col_8_4.png'),
					'4_8' => array('title' => esc_html__('4 + 8 Columns', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/footer_col_4_8.png'),
					'6_3_3' => array('title' => esc_html__('6 + 3 + 3 columns', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/footer_col_6_3_3.png'),
					'3_3_6' => array('title' => esc_html__('3 + 3 + 6 columns', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/footer_col_3_3_6.png'),
					'8_2_2' => array('title' => esc_html__('8 + 2 + 2 columns', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/footer_col_8_2_2.png'),
					'2_2_8' => array('title' => esc_html__('2 + 2 + 8 columns', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/footer_col_2_2_8.png'),
					'6_2_2_2' => array('title' => esc_html__('6 + 2 + 2 + 2 columns', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/footer_col_6_2_2_2.png'),
					'2_2_2_6' => array('title' => esc_html__('2 + 2 + 2 + 6 columns', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/footer_col_2_2_2_6.png'),
				),
				'default' => '4_4_4'
			),
			
			//Second Footer Widget Area
			array(
				'id'    =>'html-footer_column_layout',
				'type'  => 'info',
				'title' => esc_html__('Second Row Footer Widget Area', 'digitallaw'), 
				'desc'  => esc_html__('Change Columns of Second Row Footer Widget Area', 'digitallaw')
			),
			array(
				'id'      => 'footer_column_layout',
				'type'    => 'image_select',
				'title'   => esc_html__('Select Column layout for Second Row Footer Widget Area', 'digitallaw'), 
				'desc'    => esc_html__('Select Column layout View.', 'digitallaw'),
				'options' => array(
					'12' => array('title' => esc_html__('One Column', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/footer_col_12.png'),
					'6_6' => array('title' => esc_html__('Two Columns', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/footer_col_6_6.png'),
					'4_4_4' => array('title' => esc_html__('Three Columns', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/footer_col_4_4_4.png'),
					'3_3_3_3' => array('title' => esc_html__('Four Columns', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/footer_col_3_3_3_3.png'),
					'8_4' => array('title' => esc_html__('8 + 4 Columns', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/footer_col_8_4.png'),
					'4_8' => array('title' => esc_html__('4 + 8 Columns', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/footer_col_4_8.png'),
					'6_3_3' => array('title' => esc_html__('6 + 3 + 3 columns', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/footer_col_6_3_3.png'),
					'3_3_6' => array('title' => esc_html__('3 + 3 + 6 columns', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/footer_col_3_3_6.png'),
					'8_2_2' => array('title' => esc_html__('8 + 2 + 2 columns', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/footer_col_8_2_2.png'),
					'2_2_8' => array('title' => esc_html__('2 + 2 + 8 columns', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/footer_col_2_2_8.png'),
					'6_2_2_2' => array('title' => esc_html__('6 + 2 + 2 + 2 columns', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/footer_col_6_2_2_2.png'),
					'2_2_2_6' => array('title' => esc_html__('2 + 2 + 2 + 6 columns', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/footer_col_2_2_2_6.png'),
				),
				'default' => '3_3_3_3'
			),
			
			//Footer Text Area
			array(
				'id'    =>'html-footerwidgetarea',
				'type'  => 'info',
				'title' => esc_html__('Footer Text Area', 'digitallaw'), 
				'desc'  => esc_html__('Options to change settings for footer text area.', 'digitallaw')
			),
			array(
				'id'       => 'footer_copyright_left',
				'type'     => 'editor',
				'title'    => esc_html__('Footer Text', 'digitallaw'), 
				'subtitle' => esc_html__('You can use the following shortcodes in your footer text:','digitallaw') . '  <code>[tm-site-url]</code> <code>[tm-site-title]</code> <code>[tm-site-tagline]</code> <code>[tm-current-year]</code> <code>[tm-footermenu]</code>',
				'desc' => '<a href="'. esc_url('http://digitallaw.thememountdemo.com/documentation/shortcodes.html') .'" target="_blank">' . esc_html__('Click here to know more about shortcode description.','digitallaw') . '</a>',
				'default'  => "Copyright &copy; 2016 <a href=\"#\">DigitalLAW</a>. All rights reserved.",
			),
		),
	);



	// Login Page Settings
	$sections[] = array(
		'title'  => esc_html__('Login Page Settings', 'digitallaw'),
		'header' => esc_html__('Login Page Settings', 'digitallaw'),
		'desc'   => esc_html__('Set options for login page.', 'digitallaw'),
		'icon_class' => 'icon-large',
		'icon'   => 'el-icon-lock',
		'fields' => array(
			array(
				'id'            => 'login_background',
				'type'          => 'background',
				'title'         => esc_html__('Background Properties', 'digitallaw'),
				'subtitle'      => esc_html__('Specify the type of background object.', 'digitallaw'),
				'preview_media' => true,
				'default'       => array(
					"background-color"    => "#ffffff",
					"background-repeat"   => "no-repeat",
					"background-size"     => "cover",
					"background-position" => "center center",
					"background-image"    => get_template_directory_uri().'/images/login-bg-image.jpg',
				),
				'customizer'=> false,
			),
		),
	);


	// Blog Settings
	$sections[] = array(
		'title'  => esc_html__( 'Blog Settings', 'digitallaw'),
		'header' => esc_html__( 'Blog Settings', 'digitallaw'),
		'desc'   => esc_html__('Settings for Blog section.', 'digitallaw'),
		'icon_class' => 'icon-large',
		'icon'   => 'el-icon-pencil',
		'fields' => array(
			array(
				'id'       => 'blog_tbar_title',
				'type'     => 'text',
				'title'    => esc_html__('Title for Blog Section', 'digitallaw'),
				'subtitle' => esc_html__('This text will be shown on single POST in Titlebar area.', 'digitallaw'),
				'default'  => esc_html__('Blog', 'digitallaw'),
			),
			array(
				'id'       => 'blog_text_limit',
				'type'     => 'slider',
				'title'    => esc_html__('Blog Excerpt Limit (in words)', 'digitallaw'),
				'subtitle' => esc_html__('Set limit for small description. Select how many words you like to show.', 'digitallaw') . '<br><strong>' . esc_html__('TIP:', 'digitallaw') . '</strong>' . esc_html__('Select "0" (zero) to show excerpt or content before READ MORE break.', 'digitallaw') . '<br>',
				'default'  => 0,
				'min'      => 0,
				'step'     => 1,
				'max'      => 500,
				'display_value' => 'text',
			),
			array(
				'id'       => 'blog_view',
				'type'     => 'select',
				'title'    => esc_html__('Blog view', 'digitallaw'), 
				'subtitle' => esc_html__('Select blog view. The default view is classic list view. You can select two, three or four column blog view from here.', 'digitallaw'),
				'options'  => array(
						'classic' => esc_html__('Classic View (default)', 'digitallaw'),
						'two'     => esc_html__('Two Column view', 'digitallaw'),
						'three'   => esc_html__('Three Column view', 'digitallaw'),
						'four'    => esc_html__('Four Column view', 'digitallaw'),
					),
				'default' => 'classic'
			),
			array(
				'id'       => 'blog_readmore_text',
				'type'     => 'text',
				'title'    => esc_html__('"Read More" Link Text', 'digitallaw'),
				'subtitle' => esc_html__('Text for the Read More link on the Blog page.', 'digitallaw'),
				'default'  => esc_html__('Read More', 'digitallaw'),
			),
		),
	);


	$team_type_title = ( !empty($digitallaw_theme_options['team_type_title']) ) ? esc_attr($digitallaw_theme_options['team_type_title']) : esc_html__('Lawyers','digitallaw');


	// Team Member Settings
	$sections[] = array(
		'title'  => sprintf( esc_html__( '%s Settings', 'digitallaw'), $team_type_title ),
		'header' => sprintf( esc_html__( '%s (Team Members) Settings', 'digitallaw'), $team_type_title ),
		'desc'   => sprintf( esc_html__('Settings for %s custom post type. We are using "Team member" custom post type as %s. Here are some settings for this post type.', 'digitallaw'), '<strong>'.$team_type_title.'</strong>', '<strong>'.$team_type_title.'</strong>' ),
		'icon_class' => 'icon-large',
		'icon'   => 'el-icon-user',
		'fields' => array(
			array(
				'id'       => 'team_before_title_text',
				'type'     => 'text',
				'title'    => esc_html__('Text Before Name of Member', 'digitallaw'),
				'subtitle' => esc_html__('Text before name of Member (for single page only).', 'digitallaw'),
				'default'  => esc_html__('ABOUT', 'digitallaw'),
			),
			array(
				'id'    =>'html-teamcatsettings',
				'type'  => 'info',
				'title' => esc_html__('Team Category Settings', 'digitallaw'), 
				'desc'  => sprintf( esc_html__( 'Settings for category page for %s (Team Members).', 'digitallaw'), $team_type_title ),
			),
			array(
				'id'       => 'teamcat_column',
				'type'     => 'select',
				'title'    => esc_html__('Select column', 'digitallaw'), 
				'subtitle' => sprintf( esc_html__( 'Select column to show %s (Team Members).', 'digitallaw'), $team_type_title ),
				'options'  => array(
						'two'   => esc_html__('Two column', 'digitallaw'),
						'three' => esc_html__('Three column', 'digitallaw'),
						'four'  => esc_html__('Four column', 'digitallaw'),
					),
				'default' => 'three'
			),
			array(
				'id'       => 'teamcat_show',
				'type'     => 'slider',
				'title'    => sprintf( esc_html__( '%s (Team Members) to show', 'digitallaw'), $team_type_title ),
				'subtitle' => sprintf( esc_html__( 'How many %s (Team Members) you like to show on category page.', 'digitallaw'), $team_type_title ),
				'default'  => 9,
				'min'      => 1,
				'step'     => 1,
				'max'      => 100,
				'display_value' => 'text',
			),
			
		),
	);




	$pf_type_title = ( !empty($digitallaw_theme_options['pf_type_title']) ) ? esc_attr($digitallaw_theme_options['pf_type_title']) : esc_html__('Practice Area','digitallaw');
	$pf_cat_title  = ( !empty($digitallaw_theme_options['pf_cat_title']) ) ? esc_attr($digitallaw_theme_options['pf_cat_title']) : esc_html__('Practice Area Category','digitallaw');

	// Portfolio Settings
	$sections[] = array(
		'title'      => sprintf( esc_html__( '%s Settings', 'digitallaw'), $pf_type_title ),
		'header'     => sprintf( esc_html__( '%s (Portfolio) Settings', 'digitallaw'), $pf_type_title ),
		'desc'       => sprintf( esc_html__('Settings for %s custom post type. We are using "Portfolio" custom post type as %s. Here are some settings for this post type.', 'digitallaw'), '<strong>'.$pf_type_title.'</strong>', '<strong>'.$pf_type_title.'</strong>' ),
		'icon_class' => 'icon-large',
		'icon'       => 'el-icon-th-large',
		'fields'     => array(
			array(
				'id'    =>'html-portfoliobox',
				'type'  => 'info',
				'title' => sprintf( esc_html__('%s Box Settings', 'digitallaw'), $pf_type_title ),
				'desc'  => sprintf( esc_html__('Options to change settings for %s box which you insert via Visual Composer.', 'digitallaw'), $pf_type_title ),
			),
			array(
				'id'       => 'portfolio_show_like',
				'type'     => 'switch',
				'title'    => esc_html__('Show Like Option', 'digitallaw'), 
				'subtitle' => sprintf( esc_html__('Select "NO" to hide the like option in the %s box.', 'digitallaw'), $pf_type_title ),
				'default'  => '1', // 1 = on | 0 = off
				'on'       => esc_html__('Yes', 'digitallaw'),
				'off'      => esc_html__('No', 'digitallaw'),
			),
			array(
				'id'    =>'html-singleportfolio',
				'type'  => 'info',
				'title' => sprintf( esc_html__('Single %s Settings', 'digitallaw'), $pf_type_title ),
				'desc'  => sprintf( esc_html__('Options to change settings for single %s.', 'digitallaw'), $pf_type_title ),
			),
			array(
				'id'       => 'portfolio_show_related',
				'type'     => 'switch',
				'title'    => sprintf( esc_html__( 'Show Related %s', 'digitallaw'), $pf_type_title ),
				'subtitle' => sprintf( esc_html__('Select YES to show related %1$s on single %1$s page.', 'digitallaw'), $pf_type_title ),
				'default'  => '1', // 1 = on | 0 = off
				'on'       => esc_html__('Yes', 'digitallaw'),
				'off'      => esc_html__('No', 'digitallaw'),
			),
			array(
				'id'       => 'portfolio_project_details',
				'type'     => 'text',
				'title'    => esc_html__('Project Details Title', 'digitallaw'),
				'subtitle' => sprintf( esc_html__('Title for the list styled "Project Details" area. (For single %s only)', 'digitallaw'), $pf_type_title ),
				'default'  => esc_html__('PROJECT DETAILS', 'digitallaw'),
			),
			array(
				'id'       => 'portfolio_description',
				'type'     => 'text',
				'title'    => esc_html__('Description Title', 'digitallaw'),
				'subtitle' => sprintf( esc_html__('Title for the content "Description" area. (For single %s only)', 'digitallaw'), $pf_type_title ),
				'default'  => esc_html__('ABOUT THIS PROJECT', 'digitallaw'),
			),
			array(
				'id'       => 'portfolio_related_title',
				'type'     => 'text',
				'title'    => sprintf( esc_html__('Related %s Title', 'digitallaw'), $pf_type_title ),
				'subtitle' => sprintf( esc_html__('Title for the Releated %1$s area. (For single %1$s only)', 'digitallaw'), $pf_type_title ),
				'default'  => esc_html__('RELATED  PROJECTS', 'digitallaw'),
			),
			array(
				'id'       => 'portfolio_viewstyle',
				'type'     => 'radio',
				'title'    => sprintf( esc_html__('Single %s View Style', 'digitallaw'), $pf_type_title ),
				'subtitle' => sprintf( esc_html__('Select view for single %s', 'digitallaw'), $pf_type_title ),
				'options'  => array( 
					'default'  => esc_html__('Left image and right content (default)', 'digitallaw'),
					'top'      => esc_html__('Top image and bottom content', 'digitallaw'),
					'full'     => esc_html__('No image and full-width content (without details box)', 'digitallaw'),
				),
				'default'  => 'default'
			),
			
			array(
				'id'    =>'html-singleportfoliodetails',
				'type'  => 'info',
				'title' => sprintf( esc_html__('Single %s List Details Settings', 'digitallaw'), $pf_type_title ),
				'desc'  => sprintf( esc_html__('Options to change each line of list details for single %1$s. Here you can select how many lines will be appear in the details of a single %1$s.', 'digitallaw'), $pf_type_title ),
			),
			// Date
			array(
				'id'       => 'pf_details_date_icon',
				'type'     => 'digitallaw_icon_select',
				'data'     => 'elusive',
				'title'    => esc_html__('Date Icon', 'digitallaw'), 
				'subtitle' => sprintf( esc_html__('Select icon for the date line of the details in single %s.', 'digitallaw'), $pf_type_title ),
				'default'  => 'fa fa-calendar',
			),
			array(
				'id'       => 'pf_details_date_title',
				'type'     => 'text',
				'title'    => esc_html__('Date Title', 'digitallaw'),
				'subtitle' => sprintf( esc_html__('Title for the date line of the details in single %s.', 'digitallaw'), $pf_type_title )
				. '<br> ' . esc_html__('Leave this field empty to remove the line.', 'digitallaw'),
				'default'  => esc_html__('Date', 'digitallaw'),
			),
			
			// Extra Line 1
			array(
				'id'       => 'pf_details_line1_icon',
				'type'     => 'digitallaw_icon_select',
				'data'     => 'elusive',
				'title'    => esc_html__('1st Line Icon', 'digitallaw'), 
				'subtitle' => sprintf( esc_html__('Select icon for the first Line of the details in single %s.', 'digitallaw'), $pf_type_title ),
				'default'  => 'fa fa-user',
			),
			array(
				'id'       => 'pf_details_line1_title',
				'type'     => 'text',
				'title'    => esc_html__('1st Line Title', 'digitallaw'),
				'subtitle' => sprintf( esc_html__('Title for the first line of the details in single %s.', 'digitallaw'), $pf_type_title ) . '<br> ' . esc_html__('Leave this field empty to remove the line.', 'digitallaw'),
				'default'  => esc_html__('Lawyer', 'digitallaw'),
			),
			// Extra Line 2
			array(
				'id'       => 'pf_details_line2_icon',
				'type'     => 'digitallaw_icon_select',
				'data'     => 'elusive',
				'title'    => esc_html__('2nd Line Icon', 'digitallaw'), 
				'subtitle' => sprintf( esc_html__('Select icon for the second line of the details in single %s.', 'digitallaw'), $pf_type_title ),
				'default'  => 'fa fa-clipboard',
			),
			array(
				'id'       => 'pf_details_line2_title',
				'type'     => 'text',
				'title'    => esc_html__('2nd Line Title', 'digitallaw'),
				'subtitle' => sprintf( esc_html__('Title for the second line of the details in single %s.', 'digitallaw'), $pf_type_title ) . '<br> ' . esc_html__('Leave this field empty to remove the line.', 'digitallaw'),
				'default'  => esc_html__('Skills', 'digitallaw'),
			),
			// Extra Line 3
			array(
				'id'       => 'pf_details_line3_icon',
				'type'     => 'digitallaw_icon_select',
				'data'     => 'elusive',
				'title'    => esc_html__('3rd Line Icon', 'digitallaw'), 
				'subtitle' => sprintf( esc_html__('Select icon for the third line of the details in single %s.', 'digitallaw'), $pf_type_title ),
				'default'  => 'fa fa-map-marker',
			),
			array(
				'id'       => 'pf_details_line3_title',
				'type'     => 'text',
				'title'    => esc_html__('3rd Line Title', 'digitallaw'),
				'subtitle' => sprintf( esc_html__('Title for the third line of the details in single %s.', 'digitallaw'), $pf_type_title ) . '<br> ' . esc_html__('Leave this field empty to remove the line.', 'digitallaw'),
				'default'  => esc_html__('Location', 'digitallaw'),
			),
			// Extra Line 4
			array(
				'id'       => 'pf_details_line4_icon',
				'type'     => 'digitallaw_icon_select',
				'data'     => 'elusive',
				'title'    => esc_html__('4th Line Icon', 'digitallaw'), 
				'subtitle' => sprintf( esc_html__('Select icon for the fourth line of the details in single %s.', 'digitallaw'), $pf_type_title ),
				'default'  => '',
			),
			array(
				'id'       => 'pf_details_line4_title',
				'type'     => 'text',
				'title'    => esc_html__('4th Line Title', 'digitallaw'),
				'subtitle' => sprintf( esc_html__('Title for the fourth line of the details in single %s.', 'digitallaw'), $pf_type_title ) . '<br> ' . esc_html__('Leave this field empty to remove the line.', 'digitallaw'),
				'default'  => '',
			),
			// Extra Line 5
			array(
				'id'       => 'pf_details_line5_icon',
				'type'     => 'digitallaw_icon_select',
				'data'     => 'elusive',
				'title'    => esc_html__('5th Line Icon', 'digitallaw'), 
				'subtitle' => sprintf( esc_html__('Select icon for the fifth line of the details in single %s.', 'digitallaw'), $pf_type_title ),
				'default'  => '',
			),
			array(
				'id'       => 'pf_details_line5_title',
				'type'     => 'text',
				'title'    => esc_html__('5th Line Title', 'digitallaw'),
				'subtitle' => sprintf( esc_html__('Title for the fifth line of the details in single %s.', 'digitallaw'), $pf_type_title ) . '<br> ' . esc_html__('Leave this field empty to remove the line.', 'digitallaw'),
				'default'  => '',
			),
			
			// Category
			array(
				'id'       => 'pf_details_cat_icon',
				'type'     => 'digitallaw_icon_select',
				'data'     => 'elusive',
				'title'    => esc_html__('Category Icon', 'digitallaw'), 
				'subtitle' => sprintf( esc_html__('Select icon for the category line of the details in single %s.', 'digitallaw'), $pf_type_title ),
				'default'  => 'fa fa-align-justify',
			),
			array(
				'id'       => 'pf_details_cat_title',
				'type'     => 'text',
				'title'    => esc_html__('Category Title', 'digitallaw'),
				'subtitle' => sprintf( esc_html__('Title for the category line of the details in single %s.', 'digitallaw'), $pf_type_title ) . '<br> ' . esc_html__('Leave this field empty to remove the line.', 'digitallaw'),
				'default'  => esc_html__('Category', 'digitallaw'),
			),
			
			// Single portfolio - social sharing icons
			array(
				'id'    =>'html-socialsharingicons',
				'type'  => 'info',
				'title' => sprintf( esc_html__('Select social service for single %s sharing', 'digitallaw'), $pf_type_title ), 
				'desc'  => sprintf( esc_html__('Select social service so site visitors can share the single %s on different social services', 'digitallaw'), $pf_type_title ),
			),
			array(
				'id'        => 'pf_single_social_share',
				'type'      => 'checkbox',
				'title'     => esc_html__('Select social service', 'digitallaw'),
				'desc'      => sprintf( esc_html__('The selected social service icon will be visible on single %s so user can share on social sites.', 'digitallaw'), $pf_type_title ),
				'options'   => array(
					'facebook'    => 'Facebook',
					'twitter'     => 'Twitter',
					'gplus'       => 'Google Plus',
					'pinterest'   => 'Pinterest',
					'linkedin'    => 'LinkedIn',
					'stumbleupon' => 'Stumbleupon',
					'tumblr'      => 'Tumblr',
					'reddit'      => 'Reddit',
					'digg'        => 'Digg',
					
					//'team_member' => esc_html__('Team Member', 'digitallaw'),
				),
				
				//See how std has changed? you also don't need to specify opts that are 0.
				'default'   => array(
					'facebook'    => '1',
					'twitter'     => '1',
					'gplus'       => '1',
					'pinterest'   => '1',
					'linkedin'    => '1',
					'stumbleupon' => '1',
					'tumblr'      => '1',
					'reddit'      => '1',
					'digg'        => '1',
				)
			),
			
			// Reset like
			array(
				'id'    =>'html-resetlike',
				'type'  => 'info',
				'title' => sprintf( esc_html__('Reset LIKE counter from all %s', 'digitallaw'), $pf_type_title ),
				'desc'  => sprintf( esc_html__('You can reset all LIKE counter from all %s items from here.', 'digitallaw'), $pf_type_title ),
			),
			array(
				'id'         => 'digitallaw_resetlike',
				'type'       => 'digitallaw_resetlike',
				'title'      => esc_html__('Reset LIKE counter', 'digitallaw'), 
				'subtitle'   => sprintf( esc_html__('This will reset LIKE counter for all %1$s. Also you can reset LIKE for individual %1$s too. Just edit %s and check checkbox in the box.', 'digitallaw'), $pf_type_title ),
				'customizer' => false,
			),
			array(
				'id'    =>'html-pfcatsettings',
				'type'  => 'info',
				'title' => sprintf( esc_html__('%s Settings', 'digitallaw'), $pf_cat_title ),
				'desc'  => sprintf( esc_html__( 'Settings for %s page for %s (Portfolio Category).', 'digitallaw'), $pf_cat_title, $pf_type_title ),
			),
			array(
				'id'       => 'pfcat_column',
				'type'     => 'select',
				'title'    => esc_html__('Select column', 'digitallaw'), 
				'subtitle' => sprintf( esc_html__( 'Select column to show %s (Portfolio Category).', 'digitallaw'), $pf_type_title ),
				'options'  => array(
						'two'   => esc_html__('Two column', 'digitallaw'),
						'three' => esc_html__('Three column', 'digitallaw'),
						'four'  => esc_html__('Four column', 'digitallaw'),
					),
				'default' => 'three'
			),
			array(
				'id'       => 'pfcat_show',
				'type'     => 'slider',
				'title'    => sprintf( esc_html__( '%s (Portfolio Category) to show', 'digitallaw'), $pf_type_title ),
				'subtitle' => sprintf( esc_html__( 'How many %s (Portfolio Category) you like to show on category page.', 'digitallaw'), $pf_type_title ),
				'default'  => 9,
				'min'      => 1,
				'step'     => 1,
				'max'      => 100,
				'display_value' => 'text',
			),
		),
	);


	// Error 404 Page Settings
	$sections[] = array(
		'title'  => esc_html__('Error 404 Page Settings', 'digitallaw'),
		'header' => esc_html__('Error 404 Page Settings', 'digitallaw'),
		'customizer' => false,
		'desc'   => esc_html__('Settings that determine how the error page will be looking', 'digitallaw'),
		'icon_class' => 'icon-large',
		'icon'   => 'el-icon-warning-sign',
		'fields' => array(
			array(
				'id'       => 'error404_big_icon',
				'type'     => 'digitallaw_icon_select',
				//'data'     => 'elusive',
				'title'    => esc_html__('Big icon', 'digitallaw'), 
				'subtitle' => esc_html__('Select icon that appear in top with big size.', 'digitallaw'),
				'default'  => 'fa fa-warning',
			),
			array(
				'id'       => 'error404_big_text',
				'type'     => 'text',
				'title'    => esc_html__('Big heading text', 'digitallaw'),
				'subtitle' => esc_html__('This text will be shown with big font size below icon', 'digitallaw'),
				'default'  => esc_html__('404 ERROR', 'digitallaw'),
			),
			array(
				'id'       => 'error404_medium_text',
				'type'     => 'text',
				'title'    => esc_html__('Description text', 'digitallaw'),
				'subtitle' => esc_html__('This text will be appear below the big heading text', 'digitallaw'),
				'default'  => esc_html__('This file may have been moved or deleted. Be sure to check your spelling.', 'digitallaw'),
			),
			array(
				'id'       => 'error404_search',
				'type'     => 'switch',
				'title'    => esc_html__('Show Search Form', 'digitallaw'), 
				'subtitle' => esc_html__('Set this option "YES" to show search form on the 404 page.', 'digitallaw'),
				'default'  => '1', // 1 = on | 0 = off
				'on'       => esc_html__('Yes', 'digitallaw'),
				'off'      => esc_html__('No', 'digitallaw'),
			),
		),
	);


	// Search Page Settings
	$sections[] = array(
		'title'  => esc_html__('Search Page Settings', 'digitallaw'),
		'header' => esc_html__('Search Page Settings', 'digitallaw'),
		'desc'   => esc_html__('Settings that determine how the search results page will be looking', 'digitallaw'),
		'icon_class' => 'icon-large',
		'icon'   => 'el-icon-search',
		'fields' => array(
			array(
				'id'       => 'searchnoresult',
				'type'     => 'textarea',
				'title'    => esc_html__('Content of the search page if no results found', 'digitallaw'), 
				'subtitle' => esc_html__('Specify the content of the page that will be displayed if while search no results found', 'digitallaw'),
				'desc'     => esc_html__('HTML tags and shortcodes are allowed', 'digitallaw'),
				'validate' => 'html',
				'default'  => '<div class="thememount-big-icon"><i class="fa fa-search"></i></div><h4>'. esc_html__('No results were found for your search', 'digitallaw') .'</h4></br>'. esc_html__('You may try the search with another query.', 'digitallaw') .'<br><br><br>',
			),
		),
	);



	// Sidebars
	$sections[] = array(
		'title'  => esc_html__('Sidebar', 'digitallaw'),
		'header' => esc_html__('Sidebar', 'digitallaw'),
		'desc'   => esc_html__('Setup some extra sidebars for a page widgets', 'digitallaw'),
		'icon_class' => 'icon-large',
		'icon'   => 'el-icon-pause',
		'fields' => array(
			array(
				'id'       => 'sidebars',
				'type'     => 'multi_text',
				'title'    => esc_html__('Custom Sidebars', 'digitallaw'),
				'subtitle' => esc_html__('Specify the custom sidebars that can be used in the pages for a widgets', 'digitallaw'),
			),
			array(
				'id'    =>'html-sidebars',
				'type'  => 'info',
				'title' => esc_html__('Sidebar Position', 'digitallaw'), 
				'desc'  => esc_html__('Select sidebar position for different sections.', 'digitallaw')
			),
			array(
				'id'      => 'sidebar_page',
				'type'    => 'image_select',
				'title'   => esc_html__('Standard Pages Sidebar', 'digitallaw'), 
				'desc'    => esc_html__('Select one of layouts for standard pages', 'digitallaw'),
				'options' => array(
					'no'        => array('title' => esc_html__('No Sidebar', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_no_side.png'),
					'left'      => array('title' => esc_html__('Left Sidebar', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_left.png'),
					'right'     => array('title' => esc_html__('Right Sidebar', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_right.png'),
					'both'      => array('title' => esc_html__('Both Sidebars', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_both.png'),
					'bothleft'  => array('title' => esc_html__('Both at Left', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_left_both.png'),
					'bothright' => array('title' => esc_html__('Both at Right', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_right_both.png'),
				),
				'default' => 'right'
			),
			array(
				'id'      => 'sidebar_blog',
				'type'    => 'image_select',
				'title'   => esc_html__('Blog Page Sidebar', 'digitallaw'), 
				'desc'    => esc_html__('Select one of layouts for blog page', 'digitallaw'),
				'options' => array(
					'no'        => array('title' => esc_html__('No Sidebar', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_no_side.png'),
					'left'      => array('title' => esc_html__('Left Sidebar', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_left.png'),
					'right'     => array('title' => esc_html__('Right Sidebar', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_right.png'),
					'both'      => array('title' => esc_html__('Both Sidebars', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_both.png'),
					'bothleft'  => array('title' => esc_html__('Both at Left', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_left_both.png'),
					'bothright' => array('title' => esc_html__('Both at Right', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_right_both.png'),
				),
				'default' => 'right'
			),
			array(
				'id'      => 'sidebar_search',
				'type'    => 'image_select',
				'title'   => esc_html__('Search Page Sidebar', 'digitallaw'), 
				'desc'    => esc_html__('Select one of layouts for search page', 'digitallaw'),
				'options' => array(
					'no'        => array('title' => esc_html__('No Sidebar', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_no_side.png'),
					'left'      => array('title' => esc_html__('Left Sidebar', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_left.png'),
					'right'     => array('title' => esc_html__('Right Sidebar', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_right.png'),
					'both'      => array('title' => esc_html__('Both Sidebars', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_both.png'),
					'bothleft'  => array('title' => esc_html__('Both at Left', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_left_both.png'),
					'bothright' => array('title' => esc_html__('Both at Right', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_right_both.png'),
				),
				'default' => 'left'
			),
			array(
				'id'      => 'sidebar_woocommerce',
				'type'    => 'image_select',
				'title'   => esc_html__('WooCommerce Sidebar', 'digitallaw'), 
				'desc'    => esc_html__('Select sidebar position for WooCommerce Shop and Single Product page', 'digitallaw'),
				'options' => array(
					'no'    => array('title' => esc_html__('No Sidebar', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_no_side.png'),
					'left'  => array('title' => esc_html__('Left Sidebar', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_left.png'),
					'right' => array('title' => esc_html__('Right Sidebar', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_right.png'),
				),
				'default' => 'right'
			),
			array(
				'id'      => 'sidebar_bbpress',
				'type'    => 'image_select',
				'title'   => esc_html__('BBPress Sidebar', 'digitallaw'), 
				'desc'    => esc_html__('Select sidebar position for BBPress pages', 'digitallaw'),
				'options' => array(
					'left'  => array('title' => esc_html__('Left Sidebar', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_left.png'),
					'right' => array('title' => esc_html__('Right Sidebar', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_right.png'),
				),
				'default' => 'right'
			),
			array(
				'id'      => 'sidebar_events',
				'type'    => 'image_select',
				'title'   => esc_html__('Events Sidebar', 'digitallaw'), 
				'desc'    => esc_html__('Select sidebar position for Events pages.', 'digitallaw') . ' ' . 
				sprintf( esc_html__('This is valid for %s plugin only','digitallaw') , '<a href="https://wordpress.org/plugins/the-events-calendar/" target="_blank">The Events Calendar</a>' ),
				'options' => array(
					'no'    => array('title' => esc_html__('No Sidebar', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_no_side.png'),
					'left'  => array('title' => esc_html__('Left Sidebar', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_left.png'),
					'right' => array('title' => esc_html__('Right Sidebar', 'digitallaw'), 'img' => get_template_directory_uri() . '/inc/images/layout_right.png'),
				),
				'default' => 'no'
			),
		),
	);


	// Social Links
	$sections[] = array(
		'title'  => esc_html__('Social Links', 'digitallaw'),
		'header' => esc_html__('Social Links', 'digitallaw'),
		'desc'   => esc_html__('Setup social links to show in header and footer', 'digitallaw'),
		'icon_class' => 'icon-large',
		'icon'   => 'el-icon-group',
		'fields' => array(
			array(
				'id'     => 'thememount-social-desc',
				'type'   => 'info',
				'style'  => 'success',
				'notice' => true,
				'title'  => esc_html__('TIP:', 'digitallaw'),
				'desc'   => sprintf(
					esc_html__('Not found your social service? No problem, we are ready to add new social service here. Please send us social service name via our %s support system %s and we will add it.', 'digitallaw'),
					'<a href="'. esc_url('http://support.thememount.com/') .'" target="_blank">',
					'</a>'
				),
			),
			array(
				'id'       => 'twitter',
				'type'     => 'textarea',
				'title'    => esc_html__('Twitter Link', 'digitallaw'), 
				'subtitle' => esc_html__('Your Twitter Link', 'digitallaw'),
				'desc'     => esc_html__('Paste URL only', 'digitallaw'),
			),
			array(
				'id'       => 'youtube',
				'type'     => 'textarea',
				'title'    => esc_html__('YouTube Link', 'digitallaw'), 
				'subtitle' => esc_html__('Your YouTube Link', 'digitallaw'),
				'desc'     => esc_html__('Paste URL only', 'digitallaw'),
			),
			array(
				'id'       => 'flickr',
				'type'     => 'textarea',
				'title'    => esc_html__('Flickr Link', 'digitallaw'), 
				'subtitle' => esc_html__('Your Flickr Link', 'digitallaw'),
				'desc'     => esc_html__('Paste URL only', 'digitallaw'),
			),
			array(
				'id'       => 'facebook',
				'type'     => 'textarea',
				'title'    => esc_html__('Facebook Link', 'digitallaw'), 
				'subtitle' => esc_html__('Your Facebook Link', 'digitallaw'),
				'desc'     => esc_html__('Paste URL only', 'digitallaw'),
			),
			array(
				'id'       => 'linkedin',
				'type'     => 'textarea',
				'title'    => esc_html__('LinkedIn Link', 'digitallaw'), 
				'subtitle' => esc_html__('Your LinkedIn Link', 'digitallaw'),
				'desc'     => esc_html__('Paste URL only', 'digitallaw'),
			),
			array(
				'id'       => 'googleplus',
				'type'     => 'textarea',
				'title'    => esc_html__('Google+ Link', 'digitallaw'), 
				'subtitle' => esc_html__('Your Google+ Link', 'digitallaw'),
				'desc'     => esc_html__('Paste URL only', 'digitallaw'),
			),
			array(
				'id'       => 'yelp',
				'type'     => 'textarea',
				'title'    => esc_html__('Yelp Link', 'digitallaw'), 
				'subtitle' => esc_html__('Your Yelp Link', 'digitallaw'),
				'desc'     => esc_html__('Paste URL only', 'digitallaw'),
			),
			array(
				'id'       => 'dribbble',
				'type'     => 'textarea',
				'title'    => esc_html__('Dribbble Link', 'digitallaw'), 
				'subtitle' => esc_html__('Your Dribbble Link', 'digitallaw'),
				'desc'     => esc_html__('Paste URL only', 'digitallaw'),
			),
			array(
				'id'       => 'pinterest',
				'type'     => 'textarea',
				'title'    => esc_html__('Pinterest Link', 'digitallaw'), 
				'subtitle' => esc_html__('Your Pinterest Link', 'digitallaw'),
				'desc'     => esc_html__('Paste URL only', 'digitallaw'),
			),
			array(
				'id'       => 'podcast',
				'type'     => 'textarea',
				'title'    => esc_html__('Podcast Link', 'digitallaw'), 
				'subtitle' => esc_html__('Your Podcast Link', 'digitallaw'),
				'desc'     => esc_html__('Paste URL only', 'digitallaw'),
			),
			array(
				'id'       => 'instagram',
				'type'     => 'textarea',
				'title'    => esc_html__('Instagram Link', 'digitallaw'), 
				'subtitle' => esc_html__('Your Instagram Link', 'digitallaw'),
				'desc'     => esc_html__('Paste URL only', 'digitallaw'),
			),
			array(
				'id'       => 'xing',
				'type'     => 'textarea',
				'title'    => esc_html__('Xing Link', 'digitallaw'), 
				'subtitle' => esc_html__('Your Xing Link', 'digitallaw'),
				'desc'     => esc_html__('Paste URL only', 'digitallaw'),
			),
			array(
				'id'       => 'vimeo',
				'type'     => 'textarea',
				'title'    => esc_html__('Vimeo Link', 'digitallaw'), 
				'subtitle' => esc_html__('Your Vimeo Link', 'digitallaw'),
				'desc'     => esc_html__('Paste URL only', 'digitallaw'),
			),
			array(
				'id'       => 'vk',
				'type'     => 'textarea',
				'title'    => esc_html__('VK Link', 'digitallaw'), 
				'subtitle' => esc_html__('Your VK Link', 'digitallaw'),
				'desc'     => esc_html__('Paste URL only', 'digitallaw'),
			),
			array(
				'id'       => 'houzz',
				'type'     => 'textarea',
				'title'    => esc_html__('houzz Link', 'digitallaw'), 
				'subtitle' => esc_html__('Your houzz Link', 'digitallaw'),
				'desc'     => esc_html__('Paste URL only', 'digitallaw'),
			),
			array(
				'id'       => 'issuu',
				'type'     => 'textarea',
				'title'    => esc_html__('Issuu Link', 'digitallaw'), 
				'subtitle' => esc_html__('Your Issuu Link', 'digitallaw'),
				'desc'     => esc_html__('Paste URL only', 'digitallaw'),
			),
			array(
				'id'       => 'google-drive',
				'type'     => 'textarea',
				'title'    => esc_html__('Google Drive Link', 'digitallaw'), 
				'subtitle' => esc_html__('Your Google Drive Link', 'digitallaw'),
				'desc'     => esc_html__('Paste URL only', 'digitallaw'),
			),
			array(
				'id'       => 'rss',
				'type'     => 'switch',
				'title'    => esc_html__('Show RSS Link', 'digitallaw'), 
				'on'       => esc_html__('Yes', 'digitallaw'),
				'off'      => esc_html__('No', 'digitallaw'),
				'subtitle' => esc_html__('Check this option to show RSS link with social icons list', 'digitallaw'),
				'default'  => '1'// 1 = on | 0 = off
			),
		),
	);



	// WooCommerce Settings
	$sections[] = array(
		'title'  => esc_html__('WooCommerce Settings', 'digitallaw'),
		'header' => esc_html__('WooCommerce Settings', 'digitallaw'),
		'customizer'=> false,
		'desc'   => esc_html__('Setup for WooCommerce shop section. Please make sure you installed WooCommerce plugin.', 'digitallaw'),
		'icon_class' => 'icon-large',
		'icon'   => 'el-icon-shopping-cart',
		'fields' => array(
			// WooCommerce settings
			array(
				'id'       => 'wc-header-icon',
				'type'     => 'switch',
				'title'    => esc_html__('Show Cart Icon in Header', 'digitallaw'), 
				'subtitle' => esc_html__('Select "YES" to show the cart icon in header. Select "NO" to hide the cart icon.', 'digitallaw') . ' <br><br> <strong>' . esc_html__('NOTE:', 'digitallaw') . '</strong>' . esc_html__('Please note that if you haven\'t installed "WooCommerce" plugin than the icon will not appear even if you selected "YES" in this option.', 'digitallaw') ,
				'on'       => esc_html__('Yes', 'digitallaw'),
				'off'      => esc_html__('No', 'digitallaw'),
				'default'  => '0', // 1 = on | 0 = off
				'customizer'=> false,
			),
			array(
				'id'       => 'woocommerce-column',
				'type'     => 'radio',
				'title'    => esc_html__('WooCommerce Product List Column', 'digitallaw'), 
				'subtitle' => esc_html__('Select how many column you want to show for product list view.', 'digitallaw'),
				'options'  => array(
					'1' => esc_html__('One Column', 'digitallaw'),
					'2' => esc_html__('Two Columns', 'digitallaw'),
					'3' => esc_html__('Three Columns', 'digitallaw'),
					'4' => esc_html__('Four Columns', 'digitallaw'),
				),
				'default'  => '3'
			),
			array(
				'id'            => 'woocommerce-product-per-page',
				'type'          => 'slider',
				'title'         => esc_html__( 'Products Per Page', 'digitallaw' ),
				'subtitle'      => esc_html__( 'Select how many product you want to show on SHOP page.', 'digitallaw' ),
				'desc'          => esc_html__( 'Select how many product you want to show on SHOP page.', 'digitallaw' ),
				'default'       => 9,
				'min'           => 2,
				'step'          => 1,
				'max'           => 30,
				'display_value' => 'text',
			),
			
			array(
				'id'    =>'html-wc_single_product_page',
				'type'  => 'info',
				'title' => esc_html__('Single Product Page Settings', 'digitallaw'), 
				'desc'  => esc_html__('Options for Single product page.', 'digitallaw')
			),
			array(
				'id'       => 'wc-single-show-related',
				'type'     => 'switch',
				'title'    => esc_html__('Show Related Products', 'digitallaw'), 
				'subtitle' => esc_html__('Select "YES" to show Related Products below the product description on single page.', 'digitallaw') ,
				'on'       => esc_html__('Yes', 'digitallaw'),
				'off'      => esc_html__('No', 'digitallaw'),
				'default'  => '1', // 1 = on | 0 = off
				'customizer'=> false,
			),
			array(
				'id'       => 'wc-single-related-column',
				'type'     => 'radio',
				'title'    => esc_html__('Column for Related Products', 'digitallaw'), 
				'subtitle' => esc_html__('Select how many column you want to show for product list of related products.', 'digitallaw'),
				'options'  => array(
					'1' => esc_html__('One Column', 'digitallaw'),
					'2' => esc_html__('Two Columns', 'digitallaw'),
					'3' => esc_html__('Three Columns', 'digitallaw'),
					'4' => esc_html__('Four Columns', 'digitallaw'),
				),
				'default'  => '3'
			),
			array(
				'id'            => 'wc-single-related-count',
				'type'          => 'slider',
				'title'         => esc_html__( 'Related Products Show', 'digitallaw' ),
				'subtitle'      => esc_html__( 'Select how many products you want to show in the Related prodcuts area on single product page.', 'digitallaw' ),
				'desc'          => esc_html__( 'Select how many products you want to show in the Related prodcuts area on single product page.', 'digitallaw' ),
				'default'       => 3,
				'min'           => 1,
				'step'          => 1,
				'max'           => 8,
				'display_value' => 'text',
			),
			
		),
	);

	$cssfile = (is_multisite()) ? 'php' : 'css' ;


	$sections[] = array(
		'title'      => esc_html__('Under Construction Site', 'digitallaw'),
		'header'     => esc_html__('Under Construction Site Settings', 'digitallaw'),
		'customizer' => false,
		'desc'       => esc_html__('You can set your site in Under Construciton mode during development of your site. Please note that only logged in users like admin can view the site when this mode is activated.', 'digitallaw'),
		'icon_class' => 'icon-large',
		'icon'       => 'el-icon-cog',
		'fields'     => array(
			// Options will be here
			array(
				'id'       => 'uconstruction',
				'type'     => 'switch',
				'title'    => esc_html__('Show Under Construciton Message', 'digitallaw'), 
				'subtitle' => esc_html__('This will show Under Construction message instead of your site to your site visitors.', 'digitallaw'),
				'desc'     => esc_html__('You can acitvate this during development of your site. So site visitor will see Under Construction message.', 'digitallaw'). '<br>' . esc_html__('Please note that admin (when logged in) can view live site and not Under Construction message.', 'digitallaw'),
				'default'  => '0', // 1 = on | 0 = off
				'on'       => esc_html__('Yes', 'digitallaw'),
				'off'      => esc_html__('No', 'digitallaw'),
			),
			array(
				'id'       => 'uconstruction_html',
				'type'     => 'textarea',
				'title'    => esc_html__('Page Content', 'digitallaw'),
				'subtitle' => esc_html__('Write your HTML code for Under Construction page body content.', 'digitallaw'),
				'desc'     => esc_html__('Custom HTML Allowed', 'digitallaw'),
				'default'  => urldecode('%3Chtml%3E%0D%0A%3Chead%3E%0D%0A%3Ctitle%3E%5Btm-site-title%5D+-+Under+Construction%3C%2Ftitle%3E%0D%0A%3C%2Fhead%3E%0D%0A%3Cbody%3E%0D%0A%3Ccenter%3E%0D%0A%3Cbr%3E%3Cbr%3E%3Cbr%3E%0D%0A%3Cdiv%3E%5Btm-logo%5D%3C%2Fdiv%3E%0D%0A%3Cbr%3E%3Cbr%3E%0D%0A%3Ch3+style%3D%22font-family%3A+Verdana%3B+font-weight%3A+normal%3B%22%3EThis+website+is+under+construction.+please+visit+after+some+time.%3C%2Fh3%3E%0D%0A%3C%2Fcenter%3E%0D%0A%3C%2Fbody%3E%0D%0A%3C%2Fhtml%3E'),
				'required' => array(
							array('uconstruction','equals','1'),
							//array('fbar_bg_color','equals','custom'),
				),
			),
			array(
				'id'            => 'uconstruction_background',
				'type'          => 'background',
				'title'         => esc_html__('Background Properties', 'digitallaw'),
				'subtitle'      => esc_html__('Set background options. This is for main body background.', 'digitallaw'),
				'preview_media' => true,
				'required'      => array(
									array('uconstruction','equals','1'),
				),
				'default'       => array(
					"background-color"    => "#ffffff",
					"background-repeat"   => "no-repeat",
					"background-size"     => "cover",
					"background-position" => "center center",
					"background-image"    => get_template_directory_uri().'/images/uconstruction-bg-image.jpg',
				),
				
			),
			
		)
	);




	// Advanced Settings
	$sections[] = array(
		'title'  => esc_html__('Advanced Settings', 'digitallaw'),
		'header' => esc_html__('Advanced Settings', 'digitallaw'),
		'customizer'=> false,
		'desc'   => esc_html__('Advanced Settings for tweaking your site.', 'digitallaw'),
		'icon_class' => 'icon-large',
		'icon'   => 'el-icon-wrench',
		'fields' => array(
			array(
				'id'    =>'html-teamoptionsadv',
				'type'  => 'info',
				'title' => esc_html__('Custom Post Type : Team member Settings', 'digitallaw'), 
				'desc'  => esc_html__('Advanced settings for Team Member custom post type.', 'digitallaw')
			),
			array(
				'id'       => 'team_type_title',
				'type'     => 'text',
				'title'    => esc_html__('Title for Team Member Post Type', 'digitallaw'),
				'subtitle' => esc_html__('This will change the Title for Team Member post type section.', 'digitallaw'),
				'default'  => esc_html__('Lawyers', 'digitallaw'),
			),
			array(
				'id'       => 'team_type_slug',
				'type'     => 'text',
				'title'    => esc_html__('URL Slug for Team Member Post Type', 'digitallaw'),
				'subtitle' => esc_html__('This will change the URL slug for Team Member post type section.', 'digitallaw'),
				'default'  => 'lawyer',
			),
			array(
				'id'       => 'team_group_title',
				'type'     => 'text',
				'title'    => esc_html__('Title for Team Group List', 'digitallaw'),
				'subtitle' => esc_html__('Title for Team Group list for group page. This will appear at left sidebar.', 'digitallaw'),
				'default'  => esc_html__('Services', 'digitallaw'),
			),
			array(
				'id'       => 'team_group_slug',
				'type'     => 'text',
				'title'    => esc_html__('URL Slug for Team Group Link', 'digitallaw'),
				'subtitle' => esc_html__('This will change the URL slug for Team Group link.', 'digitallaw'),
				'default'  => 'service',
			),
			array(
				'id'       => 'team_type_archive_title',
				'type'     => 'text',
				'title'    => esc_html__('Title for archive page', 'digitallaw'),
				'subtitle' => esc_html__( 'Title for archive page of Team Member.', 'digitallaw') . '<a href="'. get_post_type_archive_link( 'tm_team_member' ) .'">' . esc_html__( 'Click here to view the page', 'digitallaw') . '</a>',
				'default'  => esc_html__('Lawyers', 'digitallaw'),
			),
			
			// Portfolio
			array(
				'id'    =>'html-portfoliooptionsadv',
				'type'  => 'info',
				'title' => esc_html__('Custom Post Type : Portfolio Settings', 'digitallaw'), 
				'desc'  => esc_html__('Advanced settings for Portfolio custom post type.', 'digitallaw')
			),
			array(
				'id'       => 'pf_type_title',
				'type'     => 'text',
				'title'    => esc_html__('Title for Portfolio Post Type', 'digitallaw'),
				'subtitle' => esc_html__('This will change the Title for Portfolio post type section.', 'digitallaw'),
				'default'  => esc_html__('Practice Area', 'digitallaw'),
			),
			array(
				'id'       => 'pf_type_slug',
				'type'     => 'text',
				'title'    => esc_html__('URL Slug for Portfolio Post Type', 'digitallaw'),
				'subtitle' => esc_html__('This will change the URL slug for Portfolio post type section.', 'digitallaw'),
				'desc'     => esc_html__('Make sure you save the "Settings > Permalinks" again after changing this option.', 'digitallaw'),
				'default'  => 'practice-area',
			),
			array(
				'id'       => 'pf_cat_title',
				'type'     => 'text',
				'title'    => esc_html__('Title for Portfolio Category List', 'digitallaw'),
				'subtitle' => esc_html__('Title for Portfolio Category list for category page.', 'digitallaw'),
				'default'  => esc_html__('Practice Area Category', 'digitallaw'),
			),
			array(
				'id'       => 'pf_cat_slug',
				'type'     => 'text',
				'title'    => esc_html__('URL Slug for Portfolio Category Link', 'digitallaw'),
				'subtitle' => esc_html__('This will change the URL slug for Portfolio Category link.', 'digitallaw'),
				'default'  => 'practice-area-category',
			),
			
			// Minify opitons
			array(
				'id'    =>'html-minify',
				'type'  => 'info',
				'title' => esc_html__('Minify Options', 'digitallaw'), 
				'desc'  => esc_html__('Options to minify HTML/JS/CSS files.', 'digitallaw')
			),
			array(
				'id'       => 'minify-css-js',
				'type'     => 'switch',
				'title'    => esc_html__('Minify JS and CSS files', 'digitallaw'), 
				'subtitle' => esc_html__('Select "YES" to minify the CSS and JS files.', 'digitallaw') ,
				'on'       => esc_html__('Yes', 'digitallaw'),
				'off'      => esc_html__('No', 'digitallaw'),
				'default'  => '1', // 1 = on | 0 = off
				'customizer'=> false,
			),
			
			// Thumb image sizes
			array(
				'id'    =>'html-imagesize',
				'type'  => 'info',
				'title' => esc_html__('Thumb Image Size Options', 'digitallaw'), 
				'desc'  => esc_html__('Set Image size for Portfolio and WooCoomerce sizes.', 'digitallaw')
			),
			array(
				'id'             => 'img-digitallaw-portfolio-two-column',
				'type'           => 'digitallaw_dimensions',
				'units'          => 'px',    // You can specify a unit value. Possible: px, em, %
				'units_extended' => false,  // Allow users to select any type of unit
				'title'          => esc_html__( 'Portfolio Two Column - Thumb image size', 'digitallaw' ),
				'subtitle'       => esc_html__( 'Set width and height of the Portfolio Box image in Visual Composer element (on frontend site)', 'digitallaw' ),
				'desc'           => '<p>' . sprintf( esc_html__('%s Click here %s to know more about hard crop.', 'digitallaw'), '<a href="'. esc_url('http://www.davidtan.org/wordpress-hard-crop-vs-soft-crop-difference-comparison-example/') .'" target="_blank">' , '</a>' ) . '</p> ' . '<p>' . sprintf( esc_html__('After changing these settings you may need to %s regenerate your thumbnails %s.', 'digitallaw'), '<a href="'. esc_url('http://wordpress.org/extend/plugins/regenerate-thumbnails/') .'" target="_blank">' , '</a>' ) . '</p> ',
				'default'        => array(
					'width'  => 855,
					'height' => 570,
					'crop'   => 'yes',
				)
			),
			array(
				'id'             => 'img-digitallaw-portfolio-three-column',
				'type'           => 'digitallaw_dimensions',
				'units'          => 'px',    // You can specify a unit value. Possible: px, em, %
				'units_extended' => false,  // Allow users to select any type of unit
				'title'          => esc_html__( 'Portfolio Three Column - Thumb image size', 'digitallaw' ),
				'subtitle'       => esc_html__( 'Set width and height of the Portfolio Box image in Visual Composer element (on frontend site)', 'digitallaw' ),
				'desc'           => '<p>' . sprintf( esc_html__('%s Click here %s to know more about hard crop.', 'digitallaw'), '<a href="'. esc_url('http://www.davidtan.org/wordpress-hard-crop-vs-soft-crop-difference-comparison-example/') .'" target="_blank">' , '</a>' ) . '</p> ' . '<p>' . sprintf( esc_html__('After changing these settings you may need to %s regenerate your thumbnails %s.', 'digitallaw'), '<a href="'. esc_url('http://wordpress.org/extend/plugins/regenerate-thumbnails/') .'" target="_blank">' , '</a>' ) . '</p> ',
				'default'        => array(
					'width'  => 740,
					'height' => 493,
					'crop'   => 'yes',
				)
			),
			array(
				'id'             => 'img-digitallaw-portfolio-four-column',
				'type'           => 'digitallaw_dimensions',
				'units'          => 'px',    // You can specify a unit value. Possible: px, em, %
				'units_extended' => false,  // Allow users to select any type of unit
				'title'          => esc_html__( 'Portfolio Four Column - Thumb image size', 'digitallaw' ),
				'subtitle'       => esc_html__( 'Set width and height of the Portfolio Box image in Visual Composer element (on frontend site)', 'digitallaw' ),
				'desc'           => '<p>' . sprintf( esc_html__('%s Click here %s to know more about hard crop.', 'digitallaw'), '<a href="'. esc_url('http://www.davidtan.org/wordpress-hard-crop-vs-soft-crop-difference-comparison-example/') .'" target="_blank">' , '</a>' ) . '</p> ' . '<p>' . sprintf( esc_html__('After changing these settings you may need to %s regenerate your thumbnails %s.', 'digitallaw'), '<a href="'. esc_url('http://wordpress.org/extend/plugins/regenerate-thumbnails/') .'" target="_blank">' , '</a>' ) . '</p> ',
				'default'        => array(
					'width'  => 767,
					'height' => 511,
					'crop'   => 'yes',
				)
			),
			
			// Blog 
			array(
				'id'             => 'img-digitallaw-blog-two-column',
				'type'           => 'digitallaw_dimensions',
				'units'          => 'px',    // You can specify a unit value. Possible: px, em, %
				'units_extended' => false,  // Allow users to select any type of unit
				'title'          => esc_html__( 'Blog Two Column - Thumb image size', 'digitallaw' ),
				'subtitle'       => esc_html__( 'Set width and height of the Blog Box image in Visual Composer element (on frontend site)', 'digitallaw' ),
				'desc'           => '<p>' . sprintf( esc_html__('%s Click here %s to know more about hard crop.', 'digitallaw'), '<a href="'. esc_url('http://www.davidtan.org/wordpress-hard-crop-vs-soft-crop-difference-comparison-example/') .'" target="_blank">' , '</a>' ) . '</p> ' . '<p>' . sprintf( esc_html__('After changing these settings you may need to %s regenerate your thumbnails %s.', 'digitallaw'), '<a href="'. esc_url('http://wordpress.org/extend/plugins/regenerate-thumbnails/') .'" target="_blank">' , '</a>' ) . '</p> ',
				'default'        => array(
					'width'  => 1110,
					'height' => 601,
					'crop'   => 'yes',
				)
			),
			array(
				'id'             => 'img-digitallaw-blog-three-column',
				'type'           => 'digitallaw_dimensions',
				'units'          => 'px',    // You can specify a unit value. Possible: px, em, %
				'units_extended' => false,  // Allow users to select any type of unit
				'title'          => esc_html__( 'Blog Three Column - Thumb image size', 'digitallaw' ),
				'subtitle'       => esc_html__( 'Set width and height of the Blog Box image in Visual Composer element (on frontend site)', 'digitallaw' ),
				'desc'           => '<p>' . sprintf( esc_html__('%s Click here %s to know more about hard crop.', 'digitallaw'), '<a href="'. esc_url('http://www.davidtan.org/wordpress-hard-crop-vs-soft-crop-difference-comparison-example/') .'" target="_blank">' , '</a>' ) . '</p> ' . '<p>' . sprintf( esc_html__('After changing these settings you may need to %s regenerate your thumbnails %s.', 'digitallaw'), '<a href="'. esc_url('http://wordpress.org/extend/plugins/regenerate-thumbnails/') .'" target="_blank">' , '</a>' ) . '</p> ',
				'default'        => array(
					'width'  => 720,
					'height' => 390,
					'crop'   => 'yes',
				)
			),
			array(
				'id'             => 'img-digitallaw-blog-four-column',
				'type'           => 'digitallaw_dimensions',
				'units'          => 'px',    // You can specify a unit value. Possible: px, em, %
				'units_extended' => false,  // Allow users to select any type of unit
				'title'          => esc_html__( 'Blog Four Column - Thumb image size', 'digitallaw' ),
				'subtitle'       => esc_html__( 'Set width and height of the Blog Box image in Visual Composer element (on frontend site)', 'digitallaw' ),
				'desc'           => '<p>' . sprintf( esc_html__('%s Click here %s to know more about hard crop.', 'digitallaw'), '<a href="'. esc_url('http://www.davidtan.org/wordpress-hard-crop-vs-soft-crop-difference-comparison-example/') .'" target="_blank">' , '</a>' ) . '</p> ' . '<p>' . sprintf( esc_html__('After changing these settings you may need to %s regenerate your thumbnails %s.', 'digitallaw'), '<a href="'. esc_url('http://wordpress.org/extend/plugins/regenerate-thumbnails/') .'" target="_blank">' , '</a>' ) . '</p> ',
				'default'        => array(
					'width'  => 780,
					'height' => 423,
					'crop'   => 'yes',
				)
			),
			
			// Team Member 
			array(
				'id'             => 'img-digitallaw-team-two-column',
				'type'           => 'digitallaw_dimensions',
				'units'          => 'px',    // You can specify a unit value. Possible: px, em, %
				'units_extended' => false,  // Allow users to select any type of unit
				'title'          => esc_html__( 'Team Member Two Column - Thumb image size', 'digitallaw' ),
				'subtitle'       => esc_html__( 'Set width and height of the Team Member Box image in Visual Composer element (on frontend site)', 'digitallaw' ),
				'desc'           => '<p>' . sprintf( esc_html__('%s Click here %s to know more about hard crop.', 'digitallaw'), '<a href="'. esc_url('http://www.davidtan.org/wordpress-hard-crop-vs-soft-crop-difference-comparison-example/') .'" target="_blank">' , '</a>' ) . '</p> ' . '<p>' . sprintf( esc_html__('After changing these settings you may need to %s regenerate your thumbnails %s.', 'digitallaw'), '<a href="'. esc_url('http://wordpress.org/extend/plugins/regenerate-thumbnails/') .'" target="_blank">' , '</a>' ) . '</p> ',
				'default'        => array(
					'width'  => 1110,
					'height' => 1332,
					'crop'   => 'yes',
				)
			),
			array(
				'id'             => 'img-digitallaw-team-three-column',
				'type'           => 'digitallaw_dimensions',
				'units'          => 'px',    // You can specify a unit value. Possible: px, em, %
				'units_extended' => false,  // Allow users to select any type of unit
				'title'          => esc_html__( 'Team Member Three Column - Thumb image size', 'digitallaw' ),
				'subtitle'       => esc_html__( 'Set width and height of the Team Member Box image in Visual Composer element (on frontend site)', 'digitallaw' ),
				'desc'           => '<p>' . sprintf( esc_html__('%s Click here %s to know more about hard crop.', 'digitallaw'), '<a href="'. esc_url('http://www.davidtan.org/wordpress-hard-crop-vs-soft-crop-difference-comparison-example/') .'" target="_blank">' , '</a>' ) . '</p> ' . '<p>' . sprintf( esc_html__('After changing these settings you may need to %s regenerate your thumbnails %s.', 'digitallaw'), '<a href="'. esc_url('http://wordpress.org/extend/plugins/regenerate-thumbnails/') .'" target="_blank">' , '</a>' ) . '</p> ',
				'default'        => array(
					'width'  => 720,
					'height' => 864,
					'crop'   => 'yes',
				)
			),
			array(
				'id'             => 'img-digitallaw-team-four-column',
				'type'           => 'digitallaw_dimensions',
				'units'          => 'px',    // You can specify a unit value. Possible: px, em, %
				'units_extended' => false,  // Allow users to select any type of unit
				'title'          => esc_html__( 'Team Member Four Column - Thumb image size', 'digitallaw' ),
				'subtitle'       => esc_html__( 'Set width and height of the Team Member Box image in Visual Composer element (on frontend site)', 'digitallaw' ),
				'desc'           => '<p>' . sprintf( esc_html__('%s Click here %s to know more about hard crop.', 'digitallaw'), '<a href="'. esc_url('http://www.davidtan.org/wordpress-hard-crop-vs-soft-crop-difference-comparison-example/') .'" target="_blank">' , '</a>' ) . '</p> ' . '<p>' . sprintf( esc_html__('After changing these settings you may need to %s regenerate your thumbnails %s.', 'digitallaw'), '<a href="'. esc_url('http://wordpress.org/extend/plugins/regenerate-thumbnails/') .'" target="_blank">' , '</a>' ) . '</p> ',
				'default'        => array(
					'width'  => 750,
					'height' => 900,
					'crop'   => 'yes',
				)
			),
			array(
				'id'             => 'img-digitallaw-blog-single',
				'type'           => 'digitallaw_dimensions',
				'units'          => 'px',    // You can specify a unit value. Possible: px, em, %
				'units_extended' => false,  // Allow users to select any type of unit
				'title'          => esc_html__( 'Blog Single Post Image Size', 'digitallaw' ),
				'subtitle'       => esc_html__( 'Set width and height of the single post image.', 'digitallaw' ),
				'desc'           => '<p>' . sprintf( esc_html__('%s Click here %s to know more about hard crop.', 'digitallaw'), '<a href="'. esc_url('http://www.davidtan.org/wordpress-hard-crop-vs-soft-crop-difference-comparison-example/') .'" target="_blank">' , '</a>' ) . '</p> ' . '<p>' . sprintf( esc_html__('After changing these settings you may need to %s regenerate your thumbnails %s.', 'digitallaw'), '<a href="'. esc_url('http://wordpress.org/extend/plugins/regenerate-thumbnails/') .'" target="_blank">' , '</a>' ) . '</p> ',
				'default'        => array(
					'width'  => 750,
					'height' => 406,
					'crop'   => 'yes',
				)
			),
			
			
			array(
				'id'       => 'hide_generator_meta_tag',
				'type'     => 'switch',
				'title'    => esc_html__('Hide "Generator" meta tag', 'digitallaw'), 
				'subtitle' => esc_html__('Select "YES" to hide GENERATOR meta tag from WordPress, WooCommerce, Visual Composer and WPML plugins. This is for security reasons.', 'digitallaw') ,
				'on'       => esc_html__('Yes', 'digitallaw'),
				'off'      => esc_html__('No', 'digitallaw'),
				'default'  => '0', // 1 = on | 0 = off
				'customizer'=> false,
			),
			
			
			
			
		),
	);



	// Custom Code
	$sections[] = array(
		'title'  => esc_html__('Custom Code', 'digitallaw'),
		'header' => esc_html__('Custom Code', 'digitallaw'),
		'customizer'=> false,
		'desc'   => esc_html__('Add custom JS and CSS code', 'digitallaw'),
		'icon_class' => 'icon-large',
		'icon'   => 'el-icon-pencil',
		'fields' => array(
			array(
				'id'       => 'custom_css_code',
				'type'     => 'ace_editor',
				'title'    => esc_html__('CSS Code', 'digitallaw'), 
				'subtitle' => esc_html__('Add custom CSS code here. This code will be appear at bottom of the dynamic css file so you can override any existing style.', 'digitallaw'),
				'mode'     => 'css',
				'theme'    => 'monokai',
				'default'  => '',
			),
			array(
				'id'       => 'custom_js_code',
				'type'     => 'ace_editor',
				'title'    => esc_html__('JS Code', 'digitallaw'), 
				'subtitle' => esc_html__('Paste your JS code here.', 'digitallaw'),
				'mode'     => 'javascript',
				'theme'    => 'chrome',
				'default'  => ""
			),
			array(
				'id'    =>'html-customhtml',
				'type'  => 'info',
				'title' => esc_html__('Custom HTML Code', 'digitallaw'), 
				'desc'  => esc_html__('Custom HTML Code for different areas. You can paste <strong>Google Analytics</strong> or any tracking code here.', 'digitallaw')
			),
			array(
				'id'       => 'customhtml_head',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Custom Code for &lt;head&gt; tag', 'digitallaw' ),
				'subtitle' => esc_html__( 'This code will appear in &lt;head&gt; tag. You can add your custom tracking code here.', 'digitallaw' ),
				'default'  => '<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300italic,400italic,300,700,700italic&subset=latin,greek,cyrillic-ext,latin-ext,cyrillic,vietnamese" rel="stylesheet" type="text/css">
				<link href="https://fonts.googleapis.com/css?family=Lora&subset=latin,latin-ext,cyrillic" rel="stylesheet" type="text/css">',
			),
			array(
				'id'       => 'customhtml_bodystart',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Custom Code after &lt;body&gt; tag', 'digitallaw' ),
				'subtitle' => esc_html__( 'This code will appear after &lt;body&gt; tag. You can add your custom tracking code here.', 'digitallaw' ),
			),
			array(
				'id'       => 'customhtml_bodyend',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Custom Code before &lt;/body&gt; tag', 'digitallaw' ),
				'subtitle' => esc_html__( 'This code will appear before &lt;/body&gt; tag. You can add your custom tracking code here.', 'digitallaw' ),
			),
			array(
				'id'    =>'html-logincode',
				'type'  => 'info',
				'title' => esc_html__('Custom Code for Login page', 'digitallaw'), 
				'desc'  => esc_html__('Custom Code for Login page only. This will effect only login page and not effect any other pages or admin section.', 'digitallaw')
			),
			array(
				'id'       => 'login_custom_css_code',
				'type'     => 'ace_editor',
				'title'    => esc_html__('CSS Code for Login Page', 'digitallaw'), 
				'subtitle' => esc_html__('Paste write CSS code here.', 'digitallaw'),
				'mode'     => 'css',
				'theme'    => 'monokai',
			),
			array(
				'id'    =>'html-customhtml',
				'type'  => 'info',
				'title' => esc_html__('Advanced Custom CSS Code Option', 'digitallaw'), 
				'desc'  => esc_html__('Advanced Custom CSS Code Option.', 'digitallaw')
			),
			array(
				'id'       => 'custom_css_code_top',
				'type'     => 'ace_editor',
				'title'    => esc_html__('CSS Code (at top of the file)', 'digitallaw'), 
				'subtitle' => esc_html__('Add custom CSS code here. This code will be appear at top of the file. specially for <code>@import</code> style tag.', 'digitallaw'),
				'mode'     => 'css',
				'theme'    => 'monokai',
				'default'  => '',
			),
		),
	);


	$sections[] = array(
		'type' => 'divide',
	);

	$sections[] = array(
		'icon'   => 'el-icon-info-sign',
		'title'  => esc_html__('Theme Information', 'digitallaw'),
		'fields' => array(
			array(
				'id'      => 'raw_new_info',
				'type'    => 'raw',
				'content' => $item_info,
			)
		),
	);

	$sections[] = array(
		'title'     => esc_html__('Import / Export', 'digitallaw'),
		'desc'      => esc_html__('Import and Export your Redux Framework settings from file, text or URL.', 'digitallaw'),
		'icon'      => 'el-icon-refresh',
		'fields'    => array(
			array(
				'id'            => 'opt-import-export',
				'type'          => 'import_export',
				'title'         => 'Import Export',
				'subtitle'      => 'Save and restore your Redux options',
				'full_width'    => false,
			),
		),
	); 

	
	return $sections;

}
}
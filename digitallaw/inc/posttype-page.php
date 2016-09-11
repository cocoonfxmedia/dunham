<?php 

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.


// This must bein INIT action otherwise it will not call and return empty data.
function digitallaw_slider_options_setup(){
	
	// Declaring Pages variable
	$pages = new Cuztom_Post_Type('page');
	
	
	// Retriving Custom Sidebars for use as option for dropdown
	global $digitallaw_theme_options;
	$sidebars = array(''=>'Default');
	if( isset($digitallaw_theme_options['sidebars']) && is_array($digitallaw_theme_options['sidebars']) && count($digitallaw_theme_options['sidebars'])>0 ){
		foreach($digitallaw_theme_options['sidebars'] as $sidebar){
			if( !empty($sidebar) && trim($sidebar)!='' ){
				$sidebar_key = str_replace('-','_',sanitize_title($sidebar));
				$sidebars[$sidebar_key] = $sidebar;
			}
		}
	}
	
		
	// Getting Slider Type
	$sliderType         = array();
	$sliderType['']     = esc_attr__('No slider', 'digitallaw');
	if ( is_plugin_active( 'revslider/revslider.php' ) ) { $sliderType['revslider'] = esc_attr__('Slider Revolution', 'digitallaw'); }
	$sliderType['nivo'] = esc_attr__('Nivo Slider', 'digitallaw');
	$sliderType['flex'] = esc_attr__('Flex Slider', 'digitallaw');
	
	if ( is_plugin_active( 'revslider/revslider.php' ) ) {
		
		/* Slider Revolution plugin is activated */
		$revSliders = array();
		
		$sld     = new RevSlider();
		$sliders = $sld->getArrSliders();
		
		if( $sliders!=false && count($sliders)>0 ){
			foreach($sliders as $slider) {
				$alias = $slider->getParam('alias','false');
				$title = $slider->getTitle();
		
				$revSliders[ $alias ] = $title;
			}
		}
		
		
		$sliderOptions = array(
			array(
				'name'          => 'slidertype',
				'label'         => esc_attr__('Select Slider', 'digitallaw'),
				'description'   => esc_attr__('Select slider which you want to show on this page. The slider will appear in header area.', 'digitallaw'),
				'type'          => 'radios',
				'options'       => $sliderType,
				'default_value' => ''
			),
			array(
				'name'          => 'revslider_slider',
				'label'         => esc_attr__('Select Slider for Slider Revolution', 'digitallaw'),
				'description'   => esc_attr__('Select slider for Slider Revolution.', 'digitallaw'),
				'type'          => 'select',
				'options'       => $revSliders,
			),
		);
		
	} else {

		/* Slider Revolution plugin is not activated */
		$sliderOptions = array(
			array(
				'name'          => 'slidertype',
				'label'         => esc_attr__('Select Slider', 'digitallaw'),
				'description'   => esc_attr__('Select slider which you want to show on this page. The slider will appear in header area.', 'digitallaw'),
				'type'          => 'radios',
				'options'       => $sliderType,
			),
		);
	}
	
	
	if( taxonomy_exists('tm_slide_group') ){
		$allCat = get_terms( 'tm_slide_group', 'hide_empty=0' );
		if( count($allCat)>0 ){
			
			// Preparing array of category list
			$catList = array();
			foreach( $allCat as $cat ){ $catList[$cat->slug] = $cat->name.' ('.$cat->count.')'; }
			$sliderOptions[] = array(
				'name'          => 'slidercat',
				'label'         => esc_attr__('Select Slider Group', 'digitallaw'),
				'description'   => esc_attr__('Select slider group to fetch all slides. Please note that only selected group\'s slides will be shown in FLEX or NIVO slider.', 'digitallaw'),
				'type'          => 'select',
				'options'       => $catList,
			);
		
		}
	}
	
	
	

	// Nivo/Flex slider options
	$sliderOptions[] = array(
		'name'          => 'slideroptions',
		'label'         => esc_attr__('Slider Options', 'digitallaw'),
		'description'   => esc_attr__('Insert Nivo or Flex slider options.', 'digitallaw') . '<br><br><strong>' . esc_attr__('Example:', 'digitallaw').' </strong> ' . '<code>effect: "fade", animSpeed: 700</code>' . '<br><br>' . '<a href="'. esc_url('http://docs.dev7studios.com/article/13-nivo-slider-settings') .'" target="_blank">' . esc_attr__('Click here to see all options of Nivo Slider.', 'digitallaw') . '</a> 
		' . '<br><br>' . '
		<a href="'. esc_url('http://www.woothemes.com/flexslider/#gist9481310') .'" target="_blank">' . esc_attr__('Click here to see all options of Flex Slider.', 'digitallaw') . '</a>',
		'type'          => 'textarea',
		'default_value' => ''
	);

	
	
	
	// Wide or Boxed slider
	$sliderOptions[] = array(
		'name'          => 'slidersize',
		'label'         => esc_attr__('Slide Size', 'digitallaw'),
		'description'   => esc_attr__('Select slider width size.', 'digitallaw'),
		'type'          => 'radios',
		'options'       => array( 'wide'=>'Wide Slider', 'boxed'=>'Boxed Slider' ),
		'default_value' => 'wide'
	);
	
	
	// All options as tabs: Title Box Opitons, Slider Area Options, Sidebar Widget Options
	$pages->add_meta_box(
		'thememount_page_options',
		'DigitalLaw: Page Options',
		array(
			'tabs',
			array(
			
				esc_attr__('Topbar Options','digitallaw') => array(
					array(
						'name'          => 'show_topbar',
						'label'         => esc_attr__('Hide Topbar', 'digitallaw'),
						'description'   => esc_attr__('If you want to hide Topbar than check this option', 'digitallaw'),
						'type'          => 'select',
						'options'       => array(
							''           => esc_attr__('Global', 'digitallaw'),
							'0'          => esc_attr__('Hide Topbar', 'digitallaw'),
							'1'          => esc_attr__('Show Topbar', 'digitallaw'),
						),
						//'default_value' => '',
					),
					array(
						'name'          => 'topbarbgcolor',
						'label'         => esc_attr__('Background Color', 'digitallaw'),
						'description'   => esc_attr__('Please select color for background', 'digitallaw'),
						'type'          => 'select',
						'options'       => array(
							''           => esc_attr__('Global', 'digitallaw'),
							'darkgrey'   => esc_attr__('Dark grey', 'digitallaw'),
							'grey'       => esc_attr__('Grey', 'digitallaw'),
							'white'      => esc_attr__('White', 'digitallaw'),
							'skincolor'  => esc_attr__('Skincolor', 'digitallaw'),
							'custom'     => esc_attr__('Custom Color', 'digitallaw'),
						),
						//'default_value' => 'default',
					),
					array(
						'name'        => 'topbarbgcustomcolor',
						'label'       => esc_attr__('Custom Background Color', 'digitallaw'),
						'description' => esc_attr__('Please select custom color for background', 'digitallaw'),
						'type'        => 'color',
					),
					array(
						'name'        => 'topbartextcolor',
						'type'        => 'select',
						'label'       => esc_attr__('Text Color', 'digitallaw'),
						'description' => esc_html__('Select "Dark" color if you are going to select light color in above option.','digitallaw'),
						'required'    => array('show_topbar','equals','0'),
						'options'     => array(
								''       => esc_attr__('Global', 'digitallaw'),
								'white'  => esc_attr__('White', 'digitallaw'),
								'dark'   => esc_attr__('Dark', 'digitallaw'),
								'custom' => esc_attr__('Custom color', 'digitallaw'),
							),
						'default' => 'dark'
					),
					array(
						'name'        => 'topbartextcustomcolor',
						'label'       => esc_attr__('Custom Text Color', 'digitallaw'),
						'description' => esc_attr__('Please select custom color for text', 'digitallaw'),
						'type'        => 'color',
					),
					array(
						'name'          => 'topbarlefttext',
						'label'         => esc_attr__('Topbar Left Content (overwrite default text)', 'digitallaw'),
						'description'   => esc_attr__('Add content for Topbar text for left area. This will overwrite default text set in Theme Options.', 'digitallaw'),
						'type'          => 'textarea'
					),
					array(
						'name'          => 'topbarrighttext',
						'label'         => esc_attr__('Topbar Right Content (overwrite default text)', 'digitallaw'),
						'description'   => esc_attr__('Add content for Topbar text for right area. This will overwrite default text set in Theme Options.', 'digitallaw'),
						'type'          => 'textarea'
					),
				),
			
			
				esc_attr__('Titlebar Options', 'digitallaw') => array(
					array(
						'name'          => 'hidetitlebar',
						'label'         => esc_attr__('Hide Titlebar', 'digitallaw'),
						'description'   => esc_attr__('If you want to hide title box than check this option', 'digitallaw'),
						'type'          => 'checkbox'
					),
					array(
						'name'          => 'titlebar_view',
						'label'         => esc_attr__('Titlebar Text Align', 'digitallaw'),
						'description'   => esc_attr__('Select text align in Titlebar.', 'digitallaw'),
						'type'          => 'select',
						'options'       => array(
							''            => esc_attr__('Global', 'digitallaw'),
							'default'  => esc_attr__('All Center', 'digitallaw'),
							'left'     => esc_attr__('Title Left / Breadcrumb Right', 'digitallaw'),
							'right'    => esc_attr__('Title Right / Breadcrumb Left', 'digitallaw'),
							'allleft'  => esc_attr__('All Left', 'digitallaw'),
							'allright' => esc_attr__('All Right', 'digitallaw'),
						),
					),

					array(
						'name'          => 'title',
						'label'         => esc_attr__('Page Title', 'digitallaw'),
						'description'   => esc_attr__('(Optional) Replace current page title with this title. So Search results will show the original page title and the page will show this title.', 'digitallaw'),
						'type'          => 'textarea'
					),
					array(
						'name'          => 'subtitle',
						'label'         => esc_attr__('Page Subtitle', 'digitallaw'),
						'description'   => esc_attr__('(Optional) Please fill page subtitle', 'digitallaw'),
						'type'          => 'textarea'
					),
					array(
						'name'          => 'hidebreadcrumb',
						'label'         => esc_attr__('Hide Breadcrumb', 'digitallaw'),
						'description'   => esc_attr__('If you want to hide breadcrumb than check this option', 'digitallaw'),
						'type'          => 'checkbox'
					),
					array(
						'name'     => 'titlebar_bg_color',
						'type'     => 'select',
						'label'    => esc_attr__('Titlebar Background Color', 'digitallaw'), 
						'description' => esc_attr__('Select predefined color for Titlebar background color.', 'digitallaw'),
						'options'  => array(
								''           => esc_attr__('Global', 'digitallaw'),
								'darkgrey'   => esc_attr__('Dark grey', 'digitallaw'),
								'grey'       => esc_attr__('Grey', 'digitallaw'),
								'white'      => esc_attr__('White', 'digitallaw'),
								'skincolor'  => esc_attr__('Skincolor', 'digitallaw'),
								'custom'     => esc_attr__('Custom Color', 'digitallaw'),
							),
						'default' => 'darkgrey'
					),
					array(
						'name'     => 'titlebar_bg_custom_color',
						'type'     => 'color',
						'label'    => esc_attr__('Titlebar Background Color (custom)', 'digitallaw'),
						'description' => esc_attr__('Custom color for titlebar background.', 'digitallaw'),
					),
					array(
						'name'        => 'titlebar_text_color',
						'type'        => 'select',
						'label'       => esc_attr__('Titlebar Text Color', 'digitallaw'), 
						'description' => esc_html__('Select "Dark" color if you are going to select light color in above option.','digitallaw'),
						'options'  => array(
								''       => esc_attr__('Global', 'digitallaw'),
								'white'  => esc_attr__('White', 'digitallaw'),
								'dark'   => esc_attr__('Dark', 'digitallaw'),
								'custom' => esc_attr__('Custom Color', 'digitallaw'),
							),
						'default' => 'white'
					),
					array(
						'name'        => 'titlebar_text_custom_color',
						'type'        => 'color',
						'label'       => esc_attr__('Titlebar Custom Color for text', 'digitallaw'),
						'description' => esc_attr__('Custom background color for Topbar.', 'digitallaw'),
					),
					array(
						'name'        => 'titlebar_bg_custom_image',
						'label'       => esc_attr__('Upload Titlebar Background Image', 'digitallaw'),
						'description' =>  esc_html__('(Optional) Please upload image for background of Titlebar. Image size should be 1700px X 500px.','digitallaw'),
						'type'        => 'image',
					),
				),
			
				esc_attr__('Slider Area Options','digitallaw') => $sliderOptions,
				
				esc_attr__('Sidebar Options','digitallaw') => array(
					array(
						'name'          => 'leftsidebar',
						'label'         => esc_attr__('Left Sidebar', 'digitallaw'),
						'description'   => esc_attr__('(Optional) Select left sidebar Widget position', 'digitallaw'),
						'type'          => 'select',
						'options'       => $sidebars
					),
					array(
						'name'          => 'rightsidebar',
						'label'         => esc_attr__('Right Sidebar', 'digitallaw'),
						'description'   => esc_attr__('(Optional) Select right sidebar Widget position', 'digitallaw'),
						'type'          => 'select',
						'options'       => $sidebars
					),
					array(
						'name'          => 'sidebarposition',
						'label'         => esc_attr__('Sidebar Position', 'digitallaw'),
						'description'   => esc_attr__('(Optional) Select position for sidebars', 'digitallaw'),
						//'type'        => 'select',
						'type'          => 'radios',
						'options'       => array(
							''         => esc_attr__('Global', 'digitallaw'),
							'no'       => esc_attr__('No Sidebar', 'digitallaw'),
							'left'     => esc_attr__('Left Sidebar only', 'digitallaw'),
							'right'    => esc_attr__('Right Sidebar only', 'digitallaw'),
							'both'     => esc_attr__('Both Left and Right Sidebars', 'digitallaw'),
							'bothleft' => esc_attr__('Both sidebars at Left side', 'digitallaw'),
							'bothright'=> esc_attr__('Both sidebars at Right side', 'digitallaw'),
						)
					)
				),
			)
		)
	);
	
	

	$pages->add_meta_box(
		'thememount_page_customize',
		'DigitalLaw: Customize Options',
		array(
			array(
				'name'          => 'skincolor',
				'label'         => esc_attr__('Skin Color', 'digitallaw'),
				'description'   => esc_attr__('Select Skin Color for this page only. This will override Skin color set under "Theme Options" section. ', 'digitallaw').'<br><br> <strong>' . esc_attr__( 'NOTE:' ,'digitallaw') . ' </strong> ' . esc_attr__( 'Leave this empty to use "Skin Color" set in the "Theme Options" directly. ' ,'digitallaw') . '<br><br><strong>' . esc_attr__( 'NOTE:' ,'digitallaw') . ' </strong>  ' . esc_attr__( 'Also make sure you select "Internal" in the "Dynamic Style Position" option which you can find in "Theme Options > Advanced Settings" section.' ,'digitallaw') ,
				'type'          => 'color',
				'default_value' => '',
			),
		)
	);	
	
	
	
	// Show Template options if template selected
	$template_file = '';
	$post_id       = (isset($_GET['post']) && $_GET['post']!='') ? $_GET['post'] : '';
	if( $post_id=='' ){
		if( isset($_POST['post_ID']) && $_POST['post_ID']!='' ){
			$post_id = $_POST['post_ID'];
		}
	}
	if( $post_id!='' ){
		$template_file = get_post_meta($post_id,'_wp_page_template',true);
		$showPosts     = get_post_meta($post_id, '_thememount_page_template_show_posts', true);
		// Setting default show numbers
		$defaultShowPosts = '10';
		switch($template_file){
			case 'template-blog-2-columns.php': 
				$defaultShowPosts = '10';
				break;
			case 'template-blog-3-columns.php': 
				$defaultShowPosts = '9';
				break;
			case 'template-blog-4-columns.php': 
				$defaultShowPosts = '8';
				break;
		}
	}
	if(    $template_file == 'template-blog-2-columns.php'
		|| $template_file == 'template-blog-3-columns.php'
		|| $template_file == 'template-blog-4-columns.php'
	){
		$pages->add_meta_box(
			'thememount_page_template',
			'DigitalLaw: Template Options',
			array(
				array(
					'name'        => 'show_posts',
					'label'       => esc_attr__('Show Posts', 'digitallaw'),
					'description' => esc_attr__('How many posts you like to show on Two, Three or Four column blog view.', 'digitallaw'),
					'type'        => 'select',
					'options'     => array(
						'global'     => esc_attr__('Global', 'digitallaw'),
						'1'          => esc_attr__('1', 'digitallaw'),
						'2'          => esc_attr__('2', 'digitallaw'),
						'3'          => esc_attr__('3', 'digitallaw'),
						'4'          => esc_attr__('4', 'digitallaw'),
						'5'          => esc_attr__('5', 'digitallaw'),
						'6'          => esc_attr__('6', 'digitallaw'),
						'7'          => esc_attr__('7', 'digitallaw'),
						'8'          => esc_attr__('8', 'digitallaw'),
						'9'          => esc_attr__('9', 'digitallaw'),
						'10'          => esc_attr__('10', 'digitallaw'),
						'11'          => esc_attr__('11', 'digitallaw'),
						'12'          => esc_attr__('12', 'digitallaw'),
						'13'          => esc_attr__('13', 'digitallaw'),
						'14'          => esc_attr__('14', 'digitallaw'),
						'15'          => esc_attr__('15', 'digitallaw'),
						'16'          => esc_attr__('16', 'digitallaw'),
						'17'          => esc_attr__('17', 'digitallaw'),
						'18'          => esc_attr__('18', 'digitallaw'),
						'19'          => esc_attr__('19', 'digitallaw'),
						'20'          => esc_attr__('20', 'digitallaw'),
					),
					'default_value' => $defaultShowPosts,
				),
				
			)
		);
	
	}
	

}  // Function: digitallaw_slider_options_setup()


if( class_exists('Cuztom_Post_Type') ){
	add_action( 'admin_init', 'digitallaw_slider_options_setup' );
}








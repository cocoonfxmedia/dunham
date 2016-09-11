<?php 

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.


// This must bein INIT action otherwise it will not call and return empty data.
function digitallaw_post_meta_options(){
	
	// Declaring Posts variable
	$post = new Cuztom_Post_Type('post');
	
	
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
	
	
	// All options as tabs: Titlebar Opitons, Slider Area Options, Sidebar Widget Options
	$post->add_meta_box(
		'thememount_post_options',
		'DigitalLaw: Post Options',
		array(
			'tabs',
			array(
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
							'default'  	  => esc_attr__('All Center', 'digitallaw'),
							'left'        => esc_attr__('Title Left / Breadcrumb Right', 'digitallaw'),
							'right'       => esc_attr__('Title Right / Breadcrumb Left', 'digitallaw'),
							'allleft'     => esc_attr__('All Left', 'digitallaw'),
							'allright'    => esc_attr__('All Right', 'digitallaw'),
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
						'description' => esc_html__('Select "Dark" color if you are going to select light color in above option.', 'digitallaw'),
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
						'description' => esc_html__(
								'(Optional) Please upload image for background of Titlebar. Image size should be "1700px X 500px".', 'digitallaw' ),
						'type'        => 'image',
					),
				),
			
				
				esc_attr__('Sidebar Widget Options','digitallaw') => array(
					array(
						'name'          => 'leftsidebar',
						'label'         => esc_attr__('Left Sidebar', 'digitallaw'),
						'description'   => esc_attr__('(Optional) Select left sidebar', 'digitallaw'),
						'type'          => 'select',
						'options'       => $sidebars
					),
					array(
						'name'          => 'rightsidebar',
						'label'         => esc_attr__('Right Sidebar', 'digitallaw'),
						'description'   => esc_attr__('(Optional) Select right sidebar', 'digitallaw'),
						'type'          => 'select',
						'options'       => $sidebars
					),
					array(
						'name'          => 'sidebarposition',
						'label'         => esc_attr__('Sidebar Position', 'digitallaw'),
						'description'   => esc_attr__('(Optional) Select position for sidebars', 'digitallaw'),
						'type'          => 'select',
						'options'       => array(
							''         => esc_attr__('Global', 'digitallaw'),
							'left'     => esc_attr__('Left Sidebar only', 'digitallaw'),
							'right'    => esc_attr__('Right Sidebar only', 'digitallaw'),
							'both'     => esc_attr__('Both Left and Right Sidebars', 'digitallaw'),
							'bothleft' => esc_attr__('Both sidebars at Left side', 'digitallaw'),
							'bothright'=> esc_attr__('Both sidebars at Right side', 'digitallaw'),
						)
					)
				)
			)
		)
	);
	
	
	$post->add_meta_box(
		'thememount_post_gallery',
		'DigitalLaw: Gallery Post Format Images for Slider', 
		array(
			/* Image Slider */
			array(
				'name'          => 'slideimage1',
				'label'         => esc_attr__('1st Slider Image', 'digitallaw'),
				'description'   => esc_attr__('Select 1st image for slider here. You can select your featured image here to show the featured image as first image in slider.', 'digitallaw'),
				'type'          => 'image',
			),
			array(
				'name'          => 'slideimage2',
				'label'         => esc_attr__('2nd Slider Image', 'digitallaw'),
				'description'   => esc_attr__('(optional) Select 2nd image for slider here.', 'digitallaw'),
				'type'          => 'image',
			),
			array(
				'name'          => 'slideimage3',
				'label'         => esc_attr__('3rd Slider Image', 'digitallaw'),
				'description'   => esc_attr__('(optional) Select 3rd image for slider here.', 'digitallaw'),
				'type'          => 'image',
			),
			array(
				'name'          => 'slideimage4',
				'label'         => esc_attr__('4th Slider Image', 'digitallaw'),
				'description'   => esc_attr__('(optional) Select 4th image for slider here.', 'digitallaw'),
				'type'          => 'image',
			),
			array(
				'name'          => 'slideimage5',
				'label'         => esc_attr__('5th Slider Image', 'digitallaw'),
				'description'   => esc_attr__('(optional) Select 5th image for slider here.', 'digitallaw'),
				'type'          => 'image',
			),
			array(
				'name'          => 'slideimage6',
				'label'         => esc_attr__('6th Slider Image', 'digitallaw'),
				'description'   => esc_attr__('(optional) Select 6th image for slider here.', 'digitallaw'),
				'type'          => 'image',
			),
			array(
				'name'          => 'slideimage7',
				'label'         => esc_attr__('7th Slider Image', 'digitallaw'),
				'description'   => esc_attr__('(optional) Select 7th image for slider here.', 'digitallaw'),
				'type'          => 'image',
			),
			array(
				'name'          => 'slideimage8',
				'label'         => esc_attr__('8th Slider Image', 'digitallaw'),
				'description'   => esc_attr__('(optional) Select 8th image for slider here.', 'digitallaw'),
				'type'          => 'image',
			),
			array(
				'name'          => 'slideimage9',
				'label'         => esc_attr__('9th Slider Image', 'digitallaw'),
				'description'   => esc_attr__('(optional) Select 9th image for slider here.', 'digitallaw'),
				'type'          => 'image',
			),
			array(
				'name'          => 'slideimage10',
				'label'         => esc_attr__('10th Slider Image', 'digitallaw'),
				'description'   => esc_attr__('(optional) Select 10th image for slider here.', 'digitallaw'),
				'type'          => 'image',
			),
		)
	);
		
}  // Function: digitallaw_post_meta_options()



if( class_exists('Cuztom_Post_Type') ){
	add_action( 'init', 'digitallaw_post_meta_options' );
}

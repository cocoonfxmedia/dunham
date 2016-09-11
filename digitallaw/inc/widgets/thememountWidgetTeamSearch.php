<?php

add_action( 'widgets_init', 'digitallaw_widget_team_search' );
function digitallaw_widget_team_search() {
	register_widget( 'digitallaw_widget_team_search' );
}


global $digitallaw_theme_options;

class digitallaw_widget_team_search extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		
		// Team Type Title 
		$team_type_title = ( !empty($digitallaw_theme_options['team_type_title']) ) ? esc_attr($digitallaw_theme_options['team_type_title']) : esc_html__('Lawyers','digitallaw');
		
		$widget_style = array('classname'   => 'thememount_widget_team_search',
							  'description' => sprintf( esc_html__("Show %s (Team Member) Search Form", 'digitallaw'), $team_type_title ) );
							  
		$widget_define = array('show_id'   => 'thememount_single_team_search',
							   'get_tips'  => 'true',
							   'get_title' => 'true');
							   
		$control_styles = array('width'   => 300,
								'height'  => 350,
								'id_base' => 'thememount_widget_team_search');
								
		$widget_change = array('change1' => 'delay',
							   'change2' => 'effect',
							   'change3' => 'slide',
							   'change4' => 100,
							   'change5' => 0);
							   
		parent::__construct(
			'thememount_widget_team_search', // Base ID
			sprintf( esc_html__("ThemeMount %s (Team Member) Search", 'digitallaw'), $team_type_title ), // Name
			$widget_style // Args
		);
	}


	function widget( $args, $cur_instance ) {
		extract( $args );

		
		$widget_title = '';
		if( !empty($cur_instance['widget_title']) ){
			$widget_title = apply_filters( 'widget_title', $cur_instance['widget_title'] );
		}
		$title   	  = $cur_instance['title'];
		$form_desc    = $cur_instance['form_desc'];
		$search   	  = $cur_instance['search'];
		$submit_btn   = $cur_instance['submit_btn'];
		$form_type    = $cur_instance['form_type'];
		
		
		echo wp_kses( /* HTML Filter */
			$before_widget,
			array(
				'aside' => array(
					'id'    => array(),
					'class' => array(),
				),
				'div' => array(
					'id'    => array(),
					'class' => array(),
				),
				'span' => array(
					'class' => array(),
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
				
			)
		);
		
		
		
		// Widget Title
		if ( !empty($widget_title) ){
			$contact_widget_title = $before_title . $widget_title . $after_title;
			echo wp_kses( /* HTML Filter */
				$contact_widget_title,
				array(
					'aside' => array(
						'id'    => array(),
						'class' => array(),
					),
					'div' => array(
						'id'    => array(),
						'class' => array(),
					),
					'span' => array(
						'class' => array(),
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
					
				)
			);
		}
		
		
		
		// Output content
		$form = digitallaw_team_search_form($title, $form_desc, $search, $submit_btn, $form_type);
		echo wp_kses( /* HTML Filter */
			$form,
			array(
				'aside' => array(
					'id'    => array(),
					'class' => array(),
				),
				'div' => array(
					'id'    => array(),
					'class' => array(),
				),
				'span' => array(
					'class' => array(),
				),
				'i' => array(
					'class' => array(),
				),
				'h2' => array(
					'class' => array(),
					'id'    => array(),
				),
				'br' => array(),
				'h3' => array(
					'class' => array(),
					'id'    => array(),
				),
				'h4' => array(
					'class' => array(),
					'id'    => array(),
				),
				'ul' => array(
					'class' => array(),
				),
				'li' => array(
					'class' => array(),
				),
				'a' => array(
					'href'  => array(),
					'class' => array(),
				),
				
				
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
					'type'  => array(),
					'class' => array(),
				),
				'option' => array(
					'value' => array(),
					'class' => array(),
				),
				'textarea' => array(
					'type'  => array(),
					'class' => array(),
				),
				'button' => array(
					'type'  => array(),
					'class' => array(),
				),
			)
		);
		
		
	
		
		
		echo wp_kses( /* HTML Filter */
			$after_widget,
			array(
				'aside' => array(
					'id'    => array(),
					'class' => array(),
				),
				'div' => array(
					'id'    => array(),
					'class' => array(),
				),
				'span' => array(
					'class' => array(),
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
				
			)
		);
		
		
		
		
		
	}
		
	function update( $new_instance, $org_instance ) {
		$cur_instance 			  	  = $org_instance;
		$cur_instance['widget_title'] = strip_tags( $new_instance['widget_title'] );
		$cur_instance['title']   	  = strip_tags( $new_instance['title'] );
		$cur_instance['form_desc']    = $new_instance['form_desc'];
		$cur_instance['search']   	  = $new_instance['search'];
		$cur_instance['submit_btn']   = $new_instance['submit_btn'];
		$cur_instance['form_type'] 	  = $new_instance['form_type'];
		return $cur_instance;
	}
		 
	function form( $cur_instance ) {
		$defaults = array(
					'widget_title' => '',
					'title'  	   => 'Team Search',
					'form_desc'    => 'Search lawyers by name and also by section',
					'search'       => 'Search By Name',
					'submit_btn'   => "Search",
					'form_type'    => "Form Type",
		);
		
		$cur_instance = wp_parse_args( (array) $cur_instance, $defaults ); ?>

		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'widget_title' )); ?>"><?php esc_attr_e('Widget Title', 'digitallaw'); ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'widget_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'widget_title' )); ?>" value="<?php echo esc_attr($cur_instance['widget_title']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_attr_e('Form Heading', 'digitallaw'); ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($cur_instance['title']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'form_desc' )); ?>"><?php esc_attr_e('Form Description', 'digitallaw'); ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'form_desc' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'form_desc' )); ?>" value="<?php echo esc_attr($cur_instance['form_desc']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'search' )); ?>"><?php esc_attr_e('Search Placeholder', 'digitallaw'); ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'search' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'search' )); ?>" value="<?php echo esc_attr($cur_instance['search']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'submit_btn' )); ?>"><?php esc_attr_e('Search Button Text', 'digitallaw'); ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'submit_btn' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'submit_btn' )); ?>" value="<?php echo esc_attr($cur_instance['submit_btn']); ?>" />
		</p>
		
		<?php // We are hidding this field because, we have planned this option or future. Just created this for testing purpose ?>
		<p style="display:none;">
			<label for="<?php echo esc_attr($this->get_field_id( 'form_type' )); ?>"><?php esc_attr_e('From Type', 'digitallaw'); ?>:</label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'form_type' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'form_type' )); ?>">
			<?php
			$selected = 'vertical';
			if( !empty($cur_instance['form_type']) ){ $selected = $cur_instance['form_type']; }
			$type = array('vertical' => 'Vertical', 'horizontal'=> 'Horizontal');
			foreach($type as $key => $val){
				$selected_tag = '';
				if( $selected == $key ){ $selected_tag = ' selected'; }
				echo '<option value="'. esc_attr($key) .'"'. esc_attr($selected_tag) .'>'. esc_attr($val) .'</option>'."\n";
			}
			?>
			</select>
		</p>
		
		
		
		<?php
	}
}

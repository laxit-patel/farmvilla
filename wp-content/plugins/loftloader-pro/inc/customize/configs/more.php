<?php
/**
* Load loftloader pro section more related functions
*
* @since version 1.0.6
*/

if ( ! class_exists( 'LoftLoader_Pro_Panel_More' ) ) {
	class LoftLoader_Pro_Panel_More extends LoftLoader_Pro_Customize_Base {
		public function register_customize_elements( $wp_customize ) {	
			global $llp_defaults;

			// Add Panel
			$wp_customize->add_panel( 'loftloader_pro_more', array(
				'title' 		=> esc_html__( 'More', 'loftloader_pro' ),
				'description' 	=> esc_html__( 'Please note: the options in the More section only show and work on front end.', 'loftloader-pro' ),
				'priority' 		=> 80
			) );

			// Add Sections
			$wp_customize->add_section( new LoftLoader_Customize_Section( $wp_customize, 'loftloader_pro_more_load_time', array(
				'title' => esc_html__( 'Minimum Load Time', 'loftloader-pro' ),
				'panel' => 'loftloader_pro_more'
			) ) );
			$wp_customize->add_section( new LoftLoader_Customize_Section( $wp_customize, 'loftloader_pro_more_devices', array(
				'title' => esc_html__( 'Devices', 'loftloader-pro' ),
				'panel' => 'loftloader_pro_more'
			) ) );
			$wp_customize->add_section( new LoftLoader_Customize_Section( $wp_customize, 'loftloader_pro_more_smooth_page_transition', array(
				'title' => esc_html__( 'Smooth Page Transition', 'loftloader-pro' ),
				'panel' => 'loftloader_pro_more'
			) ) );
			$wp_customize->add_section( new LoftLoader_Customize_Section( $wp_customize, 'loftloader_pro_more_disable_page_scrolling', array(
				'title' => esc_html__( 'Disable Page Scrolling', 'loftloader-pro' ),
				'panel' => 'loftloader_pro_more'
			) ) );
			$wp_customize->add_section( new LoftLoader_Customize_Section( $wp_customize, 'loftloader_pro_more_close_button', array(
				'title' => esc_html__( 'Close Button', 'loftloader-pro' ),
				'panel' => 'loftloader_pro_more'
			) ) );
			$wp_customize->add_section( new LoftLoader_Customize_Section( $wp_customize, 'loftloader_pro_more_inner_elements_animation', array(
				'title' 		=> esc_html__( 'Inner Elements Animation', 'loftloader-pro' ),
				'panel'			=> 'loftloader_pro_more',
				'description'	=> sprintf(
					esc_html__( 'Here you can control the animation of inner elements such as the loader, progress indicator, and message. For more information please read the %sdocumentation%s.', 'loftloader-pro' ),
					sprintf( '<a href="%s" target="_blank">', 'http://loftocean.com/doc/loftloader/inner-elements-animation/' ),
					'</a>'
				)
			) ) );

			// Add Settings
			$wp_customize->add_setting( new LoftLoader_Customize_Setting( $wp_customize, 'loftloader_pro_load_time', array(
				'default' 			=> $llp_defaults['loftloader_pro_load_time'],
				'transport' 		=> 'postMessage',
				'type' 				=> 'option',
				'sanitize_callback' => 'llp_sanitize_float'
			) ) );
			$wp_customize->add_setting( new LoftLoader_Customize_Setting( $wp_customize, 'loftloader_pro_device', array(
				'default' 			=> $llp_defaults['loftloader_pro_device'],
				'transport' 		=> 'postMessage',
				'type' 				=> 'option',
				'sanitize_callback' => 'llp_sanitize_choice'
			) ) );
			$wp_customize->add_setting( new LoftLoader_Customize_Setting( $wp_customize, 'loftloader_pro_insite_transition', array(
				'default' 			=> $llp_defaults['loftloader_pro_insite_transition'],
				'transport' 		=> 'refresh',
				'type' 				=> 'option',
				'sanitize_callback' => 'llp_sanitize_checkbox'
			) ) );
			$wp_customize->add_setting( new LoftLoader_Customize_Setting( $wp_customize, 'loftloader_pro_exclude_from_page_transition', array(
				'default'   		=> $llp_defaults['loftloader_pro_exclude_from_page_transition'],
				'transport' 		=> 'refresh',
				'type' 				=> 'option',
				'sanitize_callback' => 'sanitize_text_field',
				'dependency' 		=> array(
					'loftloader_pro_insite_transition' => array( 'value' => array( 'on' ) )
				)
			) ) );
			$wp_customize->add_setting( new LoftLoader_Customize_Setting( $wp_customize, 'loftloader_pro_disable_page_scrolling', array(
				'default'   		=> $llp_defaults['loftloader_pro_disable_page_scrolling'],
				'transport' 		=> 'postMessage',
				'type'				=> 'option',
				'sanitize_callback' => 'llp_sanitize_checkbox'
			) ) );
			$wp_customize->add_setting( new LoftLoader_Customize_Setting( $wp_customize, 'loftloader_pro_show_close_timer', array(
				'default'   		=> $llp_defaults['loftloader_pro_show_close_timer'],
				'transport' 		=> 'postMessage',
				'type' 				=> 'option',
				'sanitize_callback' => 'absint'
			) ) );
			$wp_customize->add_setting( new LoftLoader_Customize_Setting( $wp_customize, 'loftloader_pro_show_close_tip', array(
				'default'   		=> $llp_defaults['loftloader_pro_show_close_tip'],
				'transport' 		=> 'postMessage',
				'type' 				=> 'option',
				'sanitize_callback' => 'sanitize_text_field'
			) ) );

			$wp_customize->add_setting( new LoftLoader_Customize_Setting( $wp_customize, 'loftloader_pro_inner_elements_entrance_animation', array(
				'default'   		=> $llp_defaults['loftloader_pro_inner_elements_entrance_animation'],
				'transport' 		=> 'postMessage',
				'type' 				=> 'option',
				'sanitize_callback' => 'llp_sanitize_choice'
			) ) );
			$wp_customize->add_setting( new LoftLoader_Customize_Setting( $wp_customize, 'loftloader_pro_inner_elements_exit_animation', array(
				'default'   		=> $llp_defaults['loftloader_pro_inner_elements_exit_animation'],
				'transport' 		=> 'postMessage',
				'type' 				=> 'option',
				'sanitize_callback' => 'llp_sanitize_choice'
			) ) );

			// Add Controls
			$wp_customize->add_control( new LoftLoader_Customize_Control( $wp_customize, 'loftloader_pro_load_time', array(
				'type'     		=> 'slider',
				'label'    		=> esc_html__( 'Minimum Load Time', 'loftloader-pro' ),
				'after_text' 	=> 'second(s)',
				'input_class' 	=> 'loftloader-load-time',
				'section' 	 	=> 'loftloader_pro_more_load_time',
				'settings' 		=> 'loftloader_pro_load_time',
				'input_attrs' 	=> array(
					'data-default' => '0',
					'data-min'     => '0',
					'data-max'     => '10',
					'data-step'    => '0.5'
				)
			) ) );

			$wp_customize->add_control( new LoftLoader_Customize_Control( $wp_customize, 'loftloader_pro_device', array(
				'type' 		=> 'radio',
				'label' 	=> esc_html__( 'Devices', 'loftloader-pro' ),
				'section' 	=> 'loftloader_pro_more_devices',
				'settings' 	=> 'loftloader_pro_device',
				'choices' 	=> array(
					'all' 			=> esc_html__( 'Enable on all devices', 'loftloader-pro' ),
					'notmobile' 	=> esc_html__( 'Hide on mobile', 'loftloader-pro' ),
					'mobileonly' 	=> esc_html__( 'Enable on mobile only', 'loftloader-pro' )
				)
			) ) );

			$wp_customize->add_control( new LoftLoader_Customize_Control( $wp_customize, 'loftloader_pro_insite_transition', array(
				'type' 		=> 'check',
				'label' 	=> esc_html__( 'Smooth Page Transition', 'loftloader-pro' ),
				'choices' 	=> array( 'on' => '' ),
				'section' 	=> 'loftloader_pro_more_smooth_page_transition',
				'settings' 	=> 'loftloader_pro_insite_transition'
			) ) );
			$wp_customize->add_control( new LoftLoader_Customize_Control( $wp_customize, 'loftloader_pro_exclude_from_page_transition', array(
				'type' 				=> 'textarea',
				'label' 			=> esc_html__( 'Links excluded from Smooth Page Transition', 'loftloader-pro' ),
				'description' 		=> esc_html__( 'Seperated by comma(,)', 'loftloader-pro' ),
				'section' 			=> 'loftloader_pro_more_smooth_page_transition',
				'settings' 			=> 'loftloader_pro_exclude_from_page_transition',
				'active_callback' 	=> 'llp_customize_control_active_cb'
			) ) );

			$wp_customize->add_control( new LoftLoader_Customize_Control( $wp_customize, 'loftloader_pro_disable_page_scrolling', array(
				'type' 		=> 'check',
				'label' 	=> esc_html__( 'Disable Page Scroll while Loading', 'loftloader-pro' ),
				'choices' 	=> array( 'on' => '' ),
				'section' 	=> 'loftloader_pro_more_disable_page_scrolling',
				'settings' 	=> 'loftloader_pro_disable_page_scrolling'
			) ) );

			$wp_customize->add_control( new LoftLoader_Customize_Control( $wp_customize, 'loftloader_pro_show_close_timer', array(
				'type'     		=> 'slider',
				'label'    		=> esc_html__( 'Show Close Button after', 'loftloader-pro' ),
				'after_text' 	=> 'second(s)',
				'input_class' 	=> 'loftloader-show-close-timer',
				'section'  		=> 'loftloader_pro_more_close_button',
				'settings' 		=> 'loftloader_pro_show_close_timer',
				'input_attrs' 	=> array(
					'data-default' 	=> '15',
					'data-min' 		=> '5',
					'data-max' 		=> '20',
					'data-step' 	=> '1'
				)
			) ) );
			$wp_customize->add_control( new LoftLoader_Customize_Control( $wp_customize, 'loftloader_pro_show_close_tip', array(
				'type' 		=> 'text',
				'label'		=> esc_html__( 'Description for Close Button', 'loftloader-pro' ),
				'section' 	=> 'loftloader_pro_more_close_button',
				'settings' 	=> 'loftloader_pro_show_close_tip'
			) ) );


			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'loftloader_pro_inner_elements_entrance_animation', array(
				'type' 		=> 'select',
				'label' 	=> esc_html__( 'Entrance Animation', 'loftloader-pro' ),
				'section' 	=> 'loftloader_pro_more_inner_elements_animation',
				'settings' 	=> 'loftloader_pro_inner_elements_entrance_animation',
				'choices' 	=> array(
					'' 					=> esc_html__( 'None', 'loftloader-pro' ),
					'inner-enter-fade' 	=> esc_html__( 'Fade In', 'loftloader-pro' ),
					'inner-enter-up' 	=> esc_html__( 'Slide Up', 'loftloader-pro' )
				)
			) ) );
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'loftloader_pro_inner_elements_exit_animation', array(
				'type' 		=> 'select',
				'label' 	=> esc_html__( 'Exit Animation', 'loftloader-pro' ),
				'section' 	=> 'loftloader_pro_more_inner_elements_animation',
				'settings' 	=> 'loftloader_pro_inner_elements_exit_animation',
				'choices' 	=> array(
					'' 				=> esc_html__( 'Fade Out', 'loftloader-pro' ),
					'inner-end-up' 	=> esc_html__( 'Slide Up', 'loftloader-pro' )
				)
			) ) );
		}
	}
	new LoftLoader_Pro_Panel_More();
}
<?php
/**
* Load loftloader pro section range related functions
*
* @since version 1.0.6
*/

if ( ! class_exists( 'LoftLoader_Pro_Section_Range' ) ) {
	class LoftLoader_Pro_Section_Range extends LoftLoader_Pro_Customize_Base {
		public function register_customize_elements( $wp_customize ) {	
			global $llp_defaults;

			// Add Section
			$wp_customize->add_section( new LoftLoader_Customize_Section( $wp_customize, 'loftloader_pro_display', array(
				'title' 		=> esc_html__( 'Display on', 'loftloader-pro' ),
				'description' 	=> '',
				'priority' 		=> 30
			) ) );

			// Add Settings
			$wp_customize->add_setting( new LoftLoader_Customize_Setting( $wp_customize, 'loftloader_pro_show_range', array(
				'default'   		=> $llp_defaults['loftloader_pro_show_range'],
				'transport' 		=> 'refresh',
				'type' 				=> 'option',
				'sanitize_callback' => 'llp_sanitize_choice'
			) ) );
			$wp_customize->add_setting( new LoftLoader_Customize_Setting( $wp_customize, 'loftloader_pro_hand_pick_pages', array(
				'default'   		=> $llp_defaults['loftloader_pro_hand_pick_pages'],
				'transport' 		=> 'refresh',
				'type' 				=> 'option',
				'sanitize_callback' => '',
				'dependency' 		=> array(
					'loftloader_pro_show_range' => array( 'value' => array( 'handpick' ) )
				)
			) ) );
			$wp_customize->add_setting( new LoftLoader_Customize_Setting( $wp_customize, 'loftloader_pro_post_types', array(
				'default'   		=> $llp_defaults['loftloader_pro_post_types'],
				'transport' 		=> 'refresh',
				'type' 				=> 'option',
				'sanitize_callback' => '',
				'dependency' 		=> array(
					'loftloader_pro_show_range' => array( 'value' => array( 'post_types' ) )
				)
			) ) );
			$wp_customize->add_setting( new LoftLoader_Customize_Setting( $wp_customize, 'loftloader_pro_selected_post_types', array(
				'default'   		=> $llp_defaults['loftloader_pro_selected_post_types'],
				'transport' 		=> 'refresh',
				'type' 				=> 'option',
				'sanitize_callback' => '',
				'dependency' 		=> array(
					'loftloader_pro_show_range' => array( 'value' => array( 'selected_post_types' ) )
				)
			) ) );
			$wp_customize->add_setting( new LoftLoader_Customize_Setting( $wp_customize, 'loftloader_pro_once_per_session_notes', array(
				'default'  			=> '',
				'transport' 		=> 'postMessage',
				'type' 				=> 'option',
				'sanitize_callback' => 'llp_sanitize_checkbox',
				'dependency' 		=> array(
					'loftloader_pro_show_range' => array( 'value' => array( 'once', 'homepage-once' ) )
				)
			) ) );

			// Add Controls
			$wp_customize->add_control( new LoftLoader_Customize_Control( $wp_customize, 'loftloader_pro_show_range', array(
				'type' 		=> 'radio',
				'label' 	=> '',
				'section' 	=> 'loftloader_pro_display',
				'settings' 	=> 'loftloader_pro_show_range',
				'choices' 	=> array(
					'sitewide' 				=> esc_html__( 'Sitewide', 'loftloader-pro' ),
					'homepage' 				=> esc_html__( 'Homepage only', 'loftloader-pro' ),
					'once' 					=> esc_html__( 'Once per session', 'loftloader-pro' ),
					'homepage-once' 		=> esc_html__( 'Homepage only + Once per session', 'loftloader-pro' ),
					'all' 					=> esc_html__( 'All pages', 'loftloader-pro' ),
					'post_types' 			=> esc_html__( 'Sitewide - Selected Types', 'loftloader-pro' ),
					'selected_post_types' 	=> esc_html__( 'Selected Post Types', 'loftloader-pro' ),
					'handpick' 				=> esc_html__( 'Handpick', 'loftloader-pro' )
				)
			) ) );
			$wp_customize->add_control( new LoftLoader_Customize_Control( $wp_customize, 'loftloader_pro_hand_pick_pages', array(
				'type' 				=> 'loftloader_page_post',
				'label'    			=> esc_html__( 'Choose page/post', 'loftloader-pro' ),
				'description' 		=> esc_html__( 'Please use the CTRL key (PC) or COMMAND key (Mac) to select multiple items.', 'loftloader-pro' ),
				'section' 			=> 'loftloader_pro_display',
				'settings' 			=> 'loftloader_pro_hand_pick_pages',
				'active_callback' 	=> 'llp_customize_control_active_cb'
			) ) );
			$wp_customize->add_control( new LoftLoader_Customize_Control( $wp_customize, 'loftloader_pro_post_types', array(
				'type' 				=> 'loftloader_post_types',
				'label'    			=> esc_html__( 'Choose Post Types', 'loftloader-pro' ),
				'section' 			=> 'loftloader_pro_display',
				'settings' 			=> 'loftloader_pro_post_types',
				'active_callback' 	=> 'llp_customize_control_active_cb',
				'description' 		=> sprintf( 
					esc_html__( 'Loader will not show for the selected post types.%sPlease use the CTRL key (PC) or COMMAND key (Mac) to select multiple items.', 'loftloader-pro' ), 
					'<br />'
				)
			) ) );
			$wp_customize->add_control( new LoftLoader_Customize_Control( $wp_customize, 'loftloader_pro_selected_post_types', array(
				'type' 				=> 'loftloader_post_types',
				'label'    			=> esc_html__('Choose Post Types', 'loftloader-pro'),
				'section' 			=> 'loftloader_pro_display',
				'settings' 			=> 'loftloader_pro_selected_post_types',
				'active_callback' 	=> 'llp_customize_control_active_cb',
				'description' 		=> sprintf(
					esc_html__( 'Loader will show for the selected post types.%sPlease use the CTRL key (PC) or COMMAND key (Mac) to select multiple items.', 'loftloader-pro' ), 
					'<br />'
				)
			) ) );
			$wp_customize->add_control( new LoftLoader_Customize_Control( $wp_customize, 'loftloader_pro_once_per_session_notes', array(
				'type' 				=> 'description',
				'section' 			=> 'loftloader_pro_display',
				'settings' 			=> 'loftloader_pro_once_per_session_notes',
				'active_callback' 	=> 'llp_customize_control_active_cb',
				'description' 		=> sprintf(
					esc_html__( 'Please note: "Once per session" feature only works on front end. To preview the result, please always clear your browser cookie first. More information please refer to %ssession cookie%s.', 'loftloader-pro' ),
					'<a href="http://loftocean.com/doc/loftloader/display-on/#play-once-per-session" target="_blank">',
					'</a>'
				),
			) ) );
		}
	}
	new LoftLoader_Pro_Section_Range();
}

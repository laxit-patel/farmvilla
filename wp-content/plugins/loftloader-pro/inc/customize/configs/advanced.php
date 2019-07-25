<?php
/**
* Load loftloader pro section advanced related functions
*
* @since version 1.0.6
*/
if ( ! class_exists( 'LoftLoader_Pro_Section_Advanced' ) ) {
	class LoftLoader_Pro_Section_Advanced extends LoftLoader_Pro_Customize_Base {
		public function register_customize_elements( $wp_customize ) {	
			global $llp_defaults;

			// Add Section
			$wp_customize->add_section( new LoftLoader_Customize_Section( $wp_customize, 'loftloader_pro_advanced', array(
				'title'       => esc_html__( 'Advanced', 'loftloader-pro' ),
				'description' => '',
				'priority'    => 90
			) ) );

			// Add Settings
			$wp_customize->add_setting( new LoftLoader_Customize_Setting( $wp_customize, 'loftloader_pro_css_in_file', array(
				'default'   		=> $llp_defaults['loftloader_pro_css_in_file'],
				'transport' 		=> 'postMessage',
				'type' 				=> 'option',
				'sanitize_callback' => 'llp_sanitize_choice'
			) ) );
			$wp_customize->add_setting( new LoftLoader_Customize_Setting( $wp_customize, 'loftloader_pro_enable_any_page', array(
				'default'   		=> $llp_defaults['loftloader_pro_enable_any_page'],
				'transport' 		=> 'refresh',
				'type' 				=> 'option',
				'sanitize_callback' => 'llp_sanitize_checkbox'
			) ) );
			$wp_customize->add_setting( new LoftLoader_Customize_Setting( $wp_customize, 'loftloader_pro_any_page_generation', array(
				'default'   	=> esc_html__( 'Generate', 'loftloader-pro' ),
				'transport' 	=> 'postMessage',
				'type' 			=> 'option',
				'dependency' 	=> array(
					'loftloader_pro_enable_any_page' => array( 'value' => array( 'on' ) )
				)
			) ) );

			// Add Controls
			$wp_customize->add_control( new LoftLoader_Customize_Control( $wp_customize, 'loftloader_pro_css_in_file', array(
				'type' 				=> 'radio',
				'label' 			=> esc_html__( 'Save customize styles', 'loftloader-pro' ),
				'description_above' => false,
				'hide' 				=> 'inline',
				'description' 		=> esc_html__( 'Please make sure your WordPress has write permission to modify files.', 'loftloader-pro' ),
				'choices' 			=> array(
					'inline' 	=> esc_html__( 'As inline styles in <head>', 'loftloader-pro' ),
					'file' 		=> esc_html__( 'As an external .css file', 'loftloader-pro' )
				),
				'section' 	=> 'loftloader_pro_advanced',
				'settings' 	=> 'loftloader_pro_css_in_file'
			) ) );
			$wp_customize->add_control( new LoftLoader_Customize_Control( $wp_customize, 'loftloader_pro_enable_any_page', array(
				'type' 		=> 'check',
				'label'	 	=> esc_html__( 'Enable Any Page Extension', 'loftloader-pro' ),
				'section' 	=> 'loftloader_pro_advanced',
				'settings' 	=> 'loftloader_pro_enable_any_page'
			) ) );
			$wp_customize->add_control( new LoftLoader_Customize_Control($wp_customize, 'loftloader_pro_any_page_generation', array(
				'type' => 'loftloader-any-page',
				'label' => esc_html__('Generate LoftLoader Shortcode', 'loftloader-pro'),
				'description' => '',
				'section' => 'loftloader_pro_advanced',
				'settings' => 'loftloader_pro_any_page_generation',
				'active_callback' => 'llp_customize_control_active_cb'
			) ) );
		}
	}
	new LoftLoader_Pro_Section_Advanced();
}
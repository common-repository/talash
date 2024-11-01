<?php

function dropdowns($wp_customize) {
	$wp_customize->add_setting( 'talash_dropdown_heading', array(
		'sanitize_callback' => 'esc_html',
	) );	
	$wp_customize->add_control( new Talash_Heading_Control( $wp_customize, 'talash_dropdown_heading', 
		array(
			'label'	            => __( 'Dropdowns', 'talash' ),
			'settings'	        => 'talash_dropdown_heading',
			'section'  	        => 'talash_section',
			'priority'          => 2,
			'input_attrs' => array(
				'class' => 'talash-heading',
			),
		)
	) );

	$wp_customize->add_setting( 'talash_dropdown_background_color', array(
		'default' 			=> '#ffffff',
		'capability'    	=> 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' 		=> 'postMessage'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'talash_dropdown_background_color', 
		array(
			'label'      => __( 'Dropdown background Color', 'talash' ),
			'section'    => 'talash_section',
			'settings'   => 'talash_dropdown_background_color',
			'priority'   => 2
		) 
	) );

	$wp_customize->add_setting( 'talash_dropdown_color', array(
		'default' 			=> '',
		'capability'    	=> 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' 		=> 'postMessage'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'talash_dropdown_color', 
		array(
			'label'      => __( 'Dropdown Color', 'talash' ),
			'section'    => 'talash_section',
			'settings'   => 'talash_dropdown_color',
			'priority'   => 2
		) 
	) );

	$wp_customize->add_setting( 'talash_dropdown_reset_color', array(
		'default' 			=> '#9e9e9e',
		'capability'    	=> 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' 		=> 'postMessage'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'talash_dropdown_reset_color', 
		array(
			'label'      => __( 'Dropdown Reset & Close button Color', 'talash' ),
			'section'    => 'talash_section',
			'settings'   => 'talash_dropdown_reset_color',
			'priority'   => 2
		) 
	) );

	$wp_customize->add_setting( 'talash_dropdown_progress_bar_color', array(
		'default' 			=> '#ffd300',
		'capability'    	=> 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' 		=> 'postMessage'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'talash_dropdown_progress_bar_color', 
		array(
			'label'      => __( 'Progress bar Color', 'talash' ),
			'section'    => 'talash_section',
			'settings'   => 'talash_dropdown_progress_bar_color',
			'priority'   => 2
		) 
	) );
}

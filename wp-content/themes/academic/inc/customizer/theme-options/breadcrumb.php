<?php
/**
* Breadcrumb options
*
* @package Theme Palace
* @subpackage Academic
* @since 0.3
*/

$wp_customize->add_section( 'academic_breadcrumb', array(
	'title'             => esc_html__('Breadcrumb','academic'),
	'description'       => esc_html__( 'Breadcrumb section options.', 'academic' ),
	'panel'             => 'academic_theme_options_panel'
) );

// Breadcrumb enable setting and control.
$wp_customize->add_setting( 'academic_theme_options[breadcrumb_enable]', array(
	'sanitize_callback'	=> 'academic_sanitize_checkbox',
	'default'          	=> $options['breadcrumb_enable']
) );

$wp_customize->add_control( 'academic_theme_options[breadcrumb_enable]', array(
	'label'            	=> esc_html__( 'Enable Breadcrumb', 'academic' ),
	'section'          	=> 'academic_breadcrumb',
	'type'             	=> 'checkbox',
) );

// Breadcrumb seperator.
$wp_customize->add_setting( 'academic_theme_options[breadcrumb_separator]', array(
	'sanitize_callback'	=> 'sanitize_text_field',
	'default'          	=> $options['breadcrumb_separator']
) );

$wp_customize->add_control( 'academic_theme_options[breadcrumb_separator]', array(
	'label'            	=> esc_html__( 'Breadcrumb Seperator', 'academic' ),
	'section'          	=> 'academic_breadcrumb',
	'type'             	=> 'text',
	'input_attrs'		=> array(
		'style' => 'width:100px'
		),
	'active_callback'	=> 'academic_is_breadcrumb_enable'
) );
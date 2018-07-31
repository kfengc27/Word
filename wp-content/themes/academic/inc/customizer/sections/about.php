<?php
/**
* About options
*
* @package Theme Palace
* @subpackage Academic
* @since 0.3
*/

// Add about enable section
$wp_customize->add_section( 'academic_about_section', array(
	'title'             => esc_html__('About','academic'),
	'description'       => esc_html__( 'About section options.', 'academic' ),
	'panel'             => 'academic_sections_panel'
) );

// Add about enable setting and control.
$wp_customize->add_setting( 'academic_theme_options[about_section_enable]', array(
	'default'           => $options['about_section_enable'],
	'sanitize_callback' => 'academic_sanitize_select'
) );

$wp_customize->add_control( 'academic_theme_options[about_section_enable]', array(
	'label'             => esc_html__( 'Enable on', 'academic' ),
	'section'           => 'academic_about_section',
	'type'              => 'select',
	'choices'           => academic_enable_disable_options()
) );

// Add enable page select setting and control.
$wp_customize->add_setting( 'academic_theme_options[about_content_page]', array(
	'sanitize_callback' => 'academic_sanitize_page'
) );

$wp_customize->add_control( 'academic_theme_options[about_content_page]', array(
	'label'           	=> esc_html__( 'Select Page', 'academic' ),
	'description'		=> esc_html__( 'Set the image size of selected page to 1200px by 800px.','academic' ),
	'section'         	=> 'academic_about_section',
	'type'            	=> 'dropdown-pages',
	'active_callback' 	=> 'academic_is_about_active',
) );

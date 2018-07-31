<?php
/**
* pagination options
*
* @package Theme Palace
* @subpackage Academic
* @since 0.3
*/

// Add sidebar section
$wp_customize->add_section( 'academic_pagination', array(
	'title'               => esc_html__('Pagination','academic'),
	'description'         => esc_html__( 'Pagination section options.', 'academic' ),
	'panel'               => 'academic_theme_options_panel'
) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'academic_theme_options[pagination_enable]', array(
	'sanitize_callback'   => 'academic_sanitize_checkbox',
	'default'             => $options['pagination_enable']
) );

$wp_customize->add_control( 'academic_theme_options[pagination_enable]', array(
	'label'               => esc_html__( 'Pagination Enable', 'academic' ),
	'section'             => 'academic_pagination',
	'type'                => 'checkbox',
) );

// Site layout setting and control.
$wp_customize->add_setting( 'academic_theme_options[pagination_type]', array(
	'sanitize_callback'   => 'academic_sanitize_select',
	'default'             => $options['pagination_type']
) );

$wp_customize->add_control( 'academic_theme_options[pagination_type]', array(
	'label'               => esc_html__( 'Pagination Type', 'academic' ),
	'section'             => 'academic_pagination',
	'type'                => 'select',
	'choices'			  => academic_pagination_options(),
	'active_callback'	  => 'academic_is_pagination_enable'
) );

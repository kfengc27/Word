<?php
/**
* Layout options
*
* @package Theme Palace
* @subpackage Academic
* @since 0.3
*/

// Add sidebar section
$wp_customize->add_section( 'academic_layout', array(
	'title'               => esc_html__('Layout','academic'),
	'description'         => esc_html__( 'Layout section options.', 'academic' ),
	'panel'               => 'academic_theme_options_panel'
) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'academic_theme_options[sidebar_position]', array(
	'sanitize_callback'   => 'academic_sanitize_select',
	'default'             => $options['sidebar_position']
) );

$wp_customize->add_control( 'academic_theme_options[sidebar_position]', array(
	'label'               => esc_html__( 'Sidebar Position', 'academic' ),
	'section'             => 'academic_layout',
	'type'                => 'select',
	'choices'			  => academic_sidebar_position(),
) );

// Site layout setting and control.
$wp_customize->add_setting( 'academic_theme_options[site_layout]', array(
	'sanitize_callback'   => 'academic_sanitize_select',
	'default'             => $options['site_layout']
) );

$wp_customize->add_control( 'academic_theme_options[site_layout]', array(
	'label'               => esc_html__( 'Site Layout', 'academic' ),
	'section'             => 'academic_layout',
	'type'                => 'select',
	'choices'			  => academic_site_layout(),
) );

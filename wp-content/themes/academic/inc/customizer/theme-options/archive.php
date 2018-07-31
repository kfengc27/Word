<?php 

// Add archive section
$wp_customize->add_section( 'academic_archive_option', array(
	'title'             => esc_html__( 'Archive Options','academic' ),
	'description'       => esc_html__( 'These options works only on archive pages.', 'academic' ),
	'panel'             => 'academic_theme_options_panel',
) );

// Show archive content type setting and control.
$wp_customize->add_setting( 'academic_theme_options[archive_content_type]', array(
	'default'           => $options['archive_content_type'],
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'academic_theme_options[archive_content_type]', array(
	'label'             => esc_html__( 'Archive Content', 'academic' ),
	'section'           => 'academic_archive_option',
	'type'				=> 'radio',
	'choices'			=> array( 'excerpt' => esc_html__( 'Excerpt', 'academic' ),
								  'content' => esc_html__( 'Full Content', 'academic' )
									 ),
) );

// Show archive image setting and control.
$wp_customize->add_setting( 'academic_theme_options[archive_image]', array(
	'default'           => $options['archive_image'],
	'sanitize_callback' => 'academic_sanitize_checkbox',
) );

$wp_customize->add_control( 'academic_theme_options[archive_image]', array(
	'label'       => esc_html__( 'Hide Featured Image', 'academic' ),
	'description' => esc_html__( 'Check to hide featured images.', 'academic' ),
	'section'     => 'academic_archive_option',
	'type'        => 'checkbox',
) );

// Show archive meta setting and control.
$wp_customize->add_setting( 'academic_theme_options[archive_meta]', array(
	'default'           => $options['archive_meta'],
	'sanitize_callback' => 'academic_sanitize_checkbox',
) );

$wp_customize->add_control( 'academic_theme_options[archive_meta]', array(
	'label'             => esc_html__( 'Hide Meta', 'academic' ),
	'description'       => esc_html__( 'Check to hide meta like date, author, category.', 'academic' ),
	'section'           => 'academic_archive_option',
	'type'				=> 'checkbox',
) );

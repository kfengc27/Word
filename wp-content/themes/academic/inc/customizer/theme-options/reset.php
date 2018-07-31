<?php
/**
 * Reset options
 *
 * @package Theme Palace
 * @subpackage Academic
 * @since 0.3
 */

/**
* Reset section
*/
// Add reset enable section
$wp_customize->add_section( 'academic_reset_section', array(
	'title'             => esc_html__('Reset all settings','academic'),
	'description'       => esc_html__( 'Caution: All settings will be reset to default. Refresh the page after clicking Save & Publish.', 'academic' ),
) );

// Add reset enable setting and control.
$wp_customize->add_setting( 'academic_theme_options[reset_options]', array(
	'default'           => $options['reset_options'],
	'sanitize_callback' => 'academic_sanitize_checkbox',
	'transport'			  => 'postMessage'
) );

$wp_customize->add_control( 'academic_theme_options[reset_options]', array(
	'label'             => esc_html__( 'Check to reset all settings', 'academic' ),
	'section'           => 'academic_reset_section',
	'type'              => 'checkbox',
) );
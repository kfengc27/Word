<?php
/**
 * Footer options
 *
 * @package Theme Palace
 * @subpackage Academic
 * @since 0.3
 */

/*Footer Section*/
$wp_customize->add_section( 'academic_section_footer',
	array(
		'title'      			=> esc_html__( 'Footer Options', 'academic' ),
		'priority'   			=> 900,
		'panel'      			=> 'academic_theme_options_panel',
	)
);

// scroll top visible
$wp_customize->add_setting( 'academic_theme_options[scroll_top_visible]',
	array(
		'default'       		=> $options['scroll_top_visible'],
		'sanitize_callback'		=> 'academic_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'academic_theme_options[scroll_top_visible]',
    array(
		'label'      			=> esc_html__( 'Display Scroll Top Button', 'academic' ),
		'section'    			=> 'academic_section_footer',
		'type'		 			=> 'checkbox',
    )
);
<?php
/**
<<<<<<< HEAD
* Category Blog one options
=======
* Category Blog Three options
>>>>>>> 7489da0054be6c4ea1ff2a2379700a7f28a0146e
*
* @package Theme Palace
* @subpackage Academic
* @since 0.3
*/

// Add category blog one enable section
$wp_customize->add_section( 'academic_category_blog_first', array(
	'title'             => esc_html__('First Category Blog','academic'),
	'description'       => esc_html__( 'First Category Blog options.', 'academic' ),
	'panel'             => 'academic_sections_panel'
) );

// Add category blog one enable setting and control.
$wp_customize->add_setting( 'academic_theme_options[category_blog_one_enable]', array(
	'default'           => $options['category_blog_one_enable'],
	'sanitize_callback' => 'academic_sanitize_select'
) );

$wp_customize->add_control( 'academic_theme_options[category_blog_one_enable]', array(
	'label'             => esc_html__( 'Enable on', 'academic' ),
	'section'           => 'academic_category_blog_first',
	'type'              => 'select',
	'choices'           => academic_enable_disable_options()
) );

// Add category blog one title.
$wp_customize->add_setting( 'academic_theme_options[category_blog_one_title]', array(
	'default'           => $options['category_blog_one_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( 'academic_theme_options[category_blog_one_title]', array(
	'label'             => esc_html__( 'Title', 'academic' ),
	'section'           => 'academic_category_blog_first',
	'type'              => 'text',
	'active_callback'	=> 'academic_category_blog_first_active'
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'academic_theme_options[category_blog_one_title]', array(
		'selector'            => '#popular-courses .entry-header .entry-title',
		'render_callback'     => 'academic_partial_category_blog_one_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}

// Add category blog one slider dragable.
$wp_customize->add_setting( 'academic_theme_options[category_blog_one_dragable]', array(
	'default'           => $options['category_blog_one_dragable'],
	'sanitize_callback' => 'academic_sanitize_checkbox'
) );

$wp_customize->add_control( 'academic_theme_options[category_blog_one_dragable]', array(
	'label'             => esc_html__( 'Enable Slide Dragable', 'academic' ),
	'section'           => 'academic_category_blog_first',
	'type'              => 'checkbox',
	'active_callback'	=> 'academic_category_blog_first_active'
) );

// Add category blog one slider auto play.
$wp_customize->add_setting( 'academic_theme_options[category_blog_one_autoplay]', array(
	'default'           => $options['category_blog_one_autoplay'],
	'sanitize_callback' => 'academic_sanitize_checkbox'
) );

$wp_customize->add_control( 'academic_theme_options[category_blog_one_autoplay]', array(
	'label'             => esc_html__( 'Enable Slide Auto Slide', 'academic' ),
	'section'           => 'academic_category_blog_first',
	'type'              => 'checkbox',
	'active_callback'	=> 'academic_category_blog_first_active'
) );

// Add category blog one layout.
$wp_customize->add_setting( 'academic_theme_options[category_blog_one_layout]', array(
	'default'           => $options['category_blog_one_layout'],
	'sanitize_callback' => 'academic_sanitize_select'
) );

$wp_customize->add_control( 'academic_theme_options[category_blog_one_layout]', array(
	'label'             => esc_html__( 'Layout', 'academic' ),
	'section'           => 'academic_category_blog_first',
	'type'              => 'select',
	'choices'           => academic_category_blog_first_layout(),
	'active_callback'	=> 'academic_category_blog_first_active'
) );

// Add category blog one layout.
$wp_customize->add_setting( 'academic_theme_options[category_blog_one_type]', array(
	'default'           => $options['category_blog_one_type'],
	'sanitize_callback' => 'academic_sanitize_select'
) );

$wp_customize->add_control( 'academic_theme_options[category_blog_one_type]', array(
	'label'             => esc_html__( 'Content Type', 'academic' ),
	'section'           => 'academic_category_blog_first',
	'type'              => 'select',
	'choices'           => academic_category_blog_first_type(),
	'active_callback'	=> 'academic_category_blog_first_active'
) );

// Add category blog one icon
$wp_customize->add_setting( 'academic_theme_options[category_blog_one_icon]', array(
	'default'           => $options['category_blog_one_icon'],
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'academic_theme_options[category_blog_one_icon]', array(
	'label'             => esc_html__( 'Icon', 'academic' ),
	'description'       => sprintf( __( 'Use font awesome icon: Eg: %1$s. %2$sSee more here%3$s', 'academic' ), 'fa-desktop','<a href="'.esc_url('http://fontawesome.io/icons/').'" target="_blank">','</a>' ),
	'section'           => 'academic_category_blog_first',
	'type'              => 'text',
	'active_callback'	=> 'academic_category_blog_first_active'
) );

// Add category blog one type category setting and control
$wp_customize->add_setting(  'academic_theme_options[category_blog_one_parent_category]', array(
	'sanitize_callback' => 'absint',
) ) ;

$wp_customize->add_control( new academic_Dropdown_Taxonomies_Control ( $wp_customize,'academic_theme_options[category_blog_one_parent_category]', array(
	'label'             => esc_html__( 'Select Parent Category', 'academic' ),
	'section'           => 'academic_category_blog_first',
	'type'              => 'dropdown-taxonomies',
	'active_callback'	=> 'academic_category_blog_first_sub_category'
) ) );

<?php
/**
 * Academic Theme Customizer.
 *
 * @package Theme Palace
 * @subpackage Academic
 * @since 0.3
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function academic_customize_register( $wp_customize ) {
	$options = academic_get_theme_options();

	// Load customize active callback functions.
	require get_template_directory() . '/inc/customizer/active-callback.php';

	// Load customizer custom controls functions.
	require get_template_directory() . '/inc/customizer/custom-controls.php';

	// Load validation callback functions.
	require get_template_directory() . '/inc/customizer/validation.php';

	// Load customize partial functions.
	require get_template_directory() . '/inc/customizer/partial.php';

	$wp_customize->get_setting( 'blogname' )->transport            = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport     = 'postMessage';

	// Remove the core header textcolor control, as it shares the main text color.
	$wp_customize->remove_control( 'header_textcolor' );

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'            => '.site-title a',
			'container_inclusive' => false,
			'render_callback'     => 'academic_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'            => '.site-description',
			'container_inclusive' => false,
			'render_callback'     => 'academic_customize_partial_blogdescription',
		) );
	}

	// Header title color setting and control.
	$wp_customize->add_setting( 'academic_theme_options[header_title_color]', array(
		'default'           => $options['header_title_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'			=> 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'academic_theme_options[header_title_color]', array(
		'priority'			=> 5,
		'label'             => esc_html__( 'Header Title Color', 'academic' ),
		'section'           => 'colors',
	) ) );

	// Header tagline color setting and control.
	$wp_customize->add_setting( 'academic_theme_options[header_tagline_color]', array(
		'default'           => $options['header_tagline_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'			=> 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'academic_theme_options[header_tagline_color]', array(
		'priority'			=> 6,
		'label'             => esc_html__( 'Header Tagline Color', 'academic' ),
		'section'           => 'colors',
	) ) );

	// Add panel for sections
	$wp_customize->add_panel( 'academic_sections_panel' , array(
	    'title'      => esc_html__( 'Sections','academic' ),
	    'description'=> esc_html__( 'Section Options.', 'academic' ),
	    'priority'   => 140,
	) );

	// top-bar
	require get_template_directory() . '/inc/customizer/sections/top-bar.php';

	// Slider
	require get_template_directory() . '/inc/customizer/sections/slider.php';

	// About
	require get_template_directory() . '/inc/customizer/sections/about.php';

	// category blog one
	require get_template_directory() . '/inc/customizer/sections/category-blog-first.php';

	// category blog second
	require get_template_directory() . '/inc/customizer/sections/category-blog-second.php';

	// Upcoming Event 
	require get_template_directory() . '/inc/customizer/sections/upcoming-event.php';

	// partner
	require get_template_directory() . '/inc/customizer/sections/partner.php';

	// Add panel for common theme options
	$wp_customize->add_panel( 'academic_theme_options_panel' , array(
	    'title'      => esc_html__( 'Theme Options','academic' ),
	    'description'=> esc_html__( 'Theme Options.', 'academic' ),
	    'priority'   => 150,
	) );


	// load layout
	require get_template_directory() . '/inc/customizer/theme-options/layout.php';

	// load static homepage option
	require get_template_directory() . '/inc/customizer/theme-options/homepage-static.php';

	// load excerpt option
	require get_template_directory() . '/inc/customizer/theme-options/excerpt.php';

	// load breadcrumb option
	require get_template_directory() . '/inc/customizer/theme-options/breadcrumb.php';

	// load pagination option
	require get_template_directory() . '/inc/customizer/theme-options/pagination.php';

	// load footer option
	require get_template_directory() . '/inc/customizer/theme-options/footer.php';

	// load reset option
	require get_template_directory() . '/inc/customizer/theme-options/reset.php';

	// load archive option
	require get_template_directory() . '/inc/customizer/theme-options/archive.php';

}
add_action( 'customize_register', 'academic_customize_register' );

/*
 * Load customizer sanitization functions.
 */
require get_template_directory() . '/inc/customizer/sanitize.php';

// Load customizer theme pro link
require get_template_directory() . '/inc/customizer/upgrade-to-pro/class-customize.php';

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function academic_customize_preview_js() {
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	wp_enqueue_script( 'academic_customizer', get_template_directory_uri() . '/assets/js/customizer' . $min . '.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'academic_customize_preview_js' );


if ( ! function_exists( 'academic_reset_options' ) ) :
	/**
	 * Reset all options
	 *
	 * @since Academic 0.3
	 *
	 * @param bool $checked Whether the reset is checked.
	 * @return bool Whether the reset is checked.
	 */
	function academic_reset_options() {
		$options = academic_get_theme_options();
		if ( true === $options['reset_options'] ) {
			// Reset custom theme options.
			set_theme_mod( 'academic_theme_options', array() );
			// Reset custom header and backgrounds.
			remove_theme_mod( 'header_image' );
			remove_theme_mod( 'header_image_data' );
			remove_theme_mod( 'background_image' );
			remove_theme_mod( 'background_color' );
	    }
	  	else {
		    return false;
	  	}
	}
endif;
add_action( 'customize_save_after', 'academic_reset_options' );


if ( ! function_exists( 'academic_inline_css' ) ) :
	/*
	 * Add inline css from customizer
	 */
	function academic_inline_css() {
		$options = academic_get_theme_options();

		$css = '';
		$header_title_color = $options['header_title_color'];
		$header_tagline_color = $options['header_tagline_color'];


		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: HEADER_TEXTCOLOR.
		 */
		if ( $header_title_color && $header_tagline_color ) {

			// If we get this far, we have custom styles. Let's do this.
			// Has the text been hidden?
			if ( ! display_header_text() ) :
			$css .='
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}';

			// If the user has set a custom color for the text use that.
			else :
			$css .='
			.site-title a,
			#site-header .site-title a {
				color: '.esc_attr( $header_title_color ).';
			}
			.site-description {
				color: '.esc_attr( $header_tagline_color ).';
			}';
			endif;
		}
		wp_add_inline_style( 'academic-style', $css );
	}
endif;
add_action( 'wp_enqueue_scripts', 'academic_inline_css', 10 );


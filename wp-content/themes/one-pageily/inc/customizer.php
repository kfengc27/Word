<?php
/**
 * one Theme Customizer.
 *
 * @package one wpversion
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function one_pageily_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport                              = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport                       = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport                      = 'postMessage';
    $wp_customize->get_section('header_image')->title = __( 'Header Settings', 'one-pageily' );
    $wp_customize->get_control( 'header_textcolor'  )->section   = 'header_image';
    $wp_customize->add_setting( 'theme_color', array(
        'default'           => '#35c6a2',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
        ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_color', array(
        'label'       => __( 'Theme Color', 'one-pageily' ),
        'description' => __( 'Applied to general elements.', 'one-pageily' ),
        'section'     => 'colors',
        'priority'   => 10,
        'settings'    => 'theme_color',
        ) ) );

    $wp_customize->add_setting( 'header_right_button_text', array(
        'type'              => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'capability'        => 'edit_theme_options',
        ) );

    $wp_customize->add_control( 'header_right_button_text', array(
        'label'    => __( "Header Button Text", 'one-pageily' ),
        'section'  => 'header_image',
        'type'     => 'text',
        'priority' => 1,
        ) );

    $wp_customize->add_setting( 'header_right_button_link', array(
        'type'              => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
        'capability'        => 'edit_theme_options',
        ) );

    $wp_customize->add_control( 'header_right_button_link', array(
        'label'    => __( "Header Button Link", 'one-pageily' ),
        'section'  => 'header_image',
        'type'     => 'text',
        'priority' => 1,
        ) );

    $wp_customize->add_setting( 'header_right_button_bg', array(
        'default'           => '#fff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
        ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_right_button_bg', array(
        'label'       => __( 'Button Background Color', 'one-pageily' ),
        'section'     => 'header_image',
        'priority'   => 1,
        'settings'    => 'header_right_button_bg',
        ) ) );

    $wp_customize->add_setting( 'header_right_button_text_color', array(
        'default'           => '#29b3b0',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
        ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_right_button_text_color', array(
        'label'       => __( 'Button Text Color', 'one-pageily' ),
        'section'     => 'header_image',
        'priority'   => 1,
        'settings'    => 'header_right_button_text_color',
        ) ) );
    $wp_customize->add_setting( 'top_header_background_color', array(
        'default'           => '#fff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
        ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_header_background_color', array(
        'label'       => __( 'Header Background Color', 'one-pageily' ),
        'description' => __( 'Applied to header background.', 'one-pageily' ),
        'section'     => 'header_image',
        'priority'   => 10,
        'settings'    => 'top_header_background_color',
        ) ) );

    $wp_customize->add_setting( 'navigation_frontpage_link_color', array(
        'default'           => '#fff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
        ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'navigation_frontpage_link_color', array(
        'label'       => __( 'Navigation Text Color', 'one-pageily' ),
        'section'     => 'colors',
        'priority'   => 1,
        'settings'    => 'navigation_frontpage_link_color',
        ) ) );
}
add_action( 'customize_register', 'one_pageily_customize_register' );

if(! function_exists('one_pageily_user_customization_customizer' ) ):
    function one_pageily_user_customization_customizer(){

        ?>

        <style type="text/css">

            .related-posts .related-posts-no-img h5.title.front-view-title, #tabber .inside li .meta b,footer .widget li a:hover,.fn a,.reply a,#tabber .inside li div.info .entry-title a:hover, #navigation ul ul a:hover,.single_post a, a:hover, .sidebar.c-4-12 .textwidget a, #site-footer .textwidget a, #commentform a, #tabber .inside li a, .copyrights a:hover, a, .sidebar.c-4-12 a:hover, .top a:hover, footer .tagcloud a:hover,.sticky-text { 
                color: <?php echo esc_attr(get_theme_mod( 'theme_color')); ?>;
            }
            .total-comments span:after, span.sticky-post, .nav-previous a:hover, .nav-next a:hover, #commentform input#submit, #searchform input[type='submit'], .home_menu_item, .currenttext, .pagination a:hover, .readMore a, .onepageily-subscribe input[type='submit'], .pagination .current, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce a.button, .woocommerce-page a.button, .woocommerce button.button, .woocommerce-page button.button, .woocommerce input.button, .woocommerce-page input.button, .woocommerce #respond input#submit, .woocommerce-page #respond input#submit, .woocommerce #content input.button, .woocommerce-page #content input.button, #sidebars h3.widget-title:after, .postauthor h4:after, .related-posts h3:after, .archive .postsby span:after, .comment-respond h4:after, .single_post header:after, #cancel-comment-reply-link, .upper-widgets-grid h3:after, .thumbnail-post-content .entry-meta:after  {    
                background-color: <?php echo esc_attr(get_theme_mod( 'theme_color')); ?>;
            }
            .related-posts-no-img, #navigation ul li.current-menu-item a, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li span.current, .woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce-page nav.woocommerce-pagination ul li a:focus, .woocommerce #content nav.woocommerce-pagination ul li a:focus, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus, .pagination .current, .tagcloud a { 
                border-color: <?php echo esc_attr(get_theme_mod( 'theme_color')); ?>;
            }
            #sidebars .widget h3, #sidebars .widget h3 a { 
                border-left-color: <?php echo esc_attr(get_theme_mod( 'theme_color')); ?>;
            }

            .header-button-solid, .header-button-solid:hover, .eader-button-solid:active, .header-button-solid:focus { color: <?php echo esc_attr(get_theme_mod( 'header_right_button_text_color')); ?>; }
            .header-button-solid, .header-button-solid:hover, .header-button-solid:active, .header-button-solid:focus { background: <?php echo esc_attr(get_theme_mod( 'header_right_button_bg')); ?>; }
            .header-button-border, .header-button-border:hover, .header-button-border:active, .header-button-border:focus { color: <?php echo esc_attr(get_theme_mod( 'header_left_button_text_color')); ?>; }
            .header-button-border, .header-button-border:hover, .header-button-border:active, .header-button-border:focus { border-color: <?php echo esc_attr(get_theme_mod( 'header_left_button_bg')); ?>; }
            #site-header { background-color: <?php echo esc_attr(get_theme_mod( 'top_header_background_color')); ?>; }
            a#pull, #navigation .menu a, #navigation .menu a:hover, #navigation .menu .fa > a, #navigation .menu .fa > a, #navigation .toggle-caret, #navigation span.site-logo a, #navigation.mobile-menu-wrapper .site-logo a, .primary-navigation.header-activated #navigation ul ul li a { color: <?php echo esc_attr(get_theme_mod( 'navigation_link_color')); ?> }
            @media screen and (min-width: 865px) {
                .primary-navigation.header-activated #navigation a { color: <?php echo esc_attr(get_theme_mod( 'navigation_frontpage_link_color')); ?>; }
            }
            @media screen and (max-width: 865px) {
                #navigation.mobile-menu-wrapper{ background-color: <?php echo esc_attr(get_theme_mod( 'navigation_background_color')); ?>; }
            }
        </style>
        <?php }
        add_action( 'wp_head', 'one_pageily_user_customization_customizer' );
        endif;

        function one_pageily_customize_preview_js() {
           wp_enqueue_script( 'one_pageily_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
       }
       add_action( 'customize_preview_init', 'one_pageily_customize_preview_js' );

<?php
/**
 * academic options
 *
 * @package Theme Palace
 * @subpackage Academic
 * @since 0.3
 */

/**
 * Site Layout
 * @return array site layout options
 */
function academic_site_layout() {
  $academic_site_layout = array(
    'wide'  => esc_html__( 'Wide', 'academic' ),
    'boxed' => esc_html__( 'Boxed', 'academic' ),
  );

  $output = apply_filters( 'academic_site_layout', $academic_site_layout );

  return $output;
}

/**
 * Sidebar position
 * @return array Sidbar positions
 */
function academic_sidebar_position() {
  $academic_sidebar_position = array(
    'right-sidebar' => esc_html__( 'Right', 'academic' ),
    'left-sidebar'  => esc_html__( 'Left', 'academic' ),
    'no-sidebar'    => esc_html__( 'No Sidebar', 'academic' ),
  );

  $output = apply_filters( 'academic_sidebar_position', $academic_sidebar_position );

  return $output;
}

/**
 * Header image options
 * @return array Header image options
 */
function academic_header_image() {
  $academic_header_image = array(
    'enable' => esc_html__( 'Enable( Featured Image )', 'academic' ),
    'show-both' => esc_html__( 'Show Both( Featured and Header Image )', 'academic' ),
    'disable'  => esc_html__( 'Disable', 'academic' ),
  );

  $output = apply_filters( 'academic_header_image', $academic_header_image );

  return $output;
}

/**
 * Pagination
 *
 * @return array site pagination options
 */
function academic_pagination_options() {
  $options = academic_get_theme_options();
  $academic_pagination_options = array(
    'numeric'=> esc_html__( 'Numeric', 'academic' ),
    'default'=> esc_html__( 'Default(Older/Newer)', 'academic' ),
  );

  $pagination_type = $options['pagination_type'];
  if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
        $academic_pagination_options['infinite-click'] = 'Infinite Click';
        $academic_pagination_options['infinite-scroll'] = 'Infinite Scroll';
    } elseif( 'infinite-click' == $pagination_type || 'infinite-scroll' == $pagination_type ) {
      $options['pagination_type'] = 'numeric';
      set_theme_mod( 'academic_theme_options', $options );
    }

  $output = apply_filters( 'academic_pagination_options', $academic_pagination_options );

  return $output;
}


/**
 * Slider
 * @return array slider options
 */
function academic_enable_disable_options() {
  $academic_enable_disable_options = array(
    'static-frontpage'  => esc_html__( 'Static Frontpage', 'academic' ),
    'disabled'          => esc_html__( 'Disabled', 'academic' ),
  );

  $output = apply_filters( 'academic_enable_disable_options', $academic_enable_disable_options );

  return $output;
}


/**
 * Enabling options
 * @return array Enable options
 */
function academic_enable_entire_option() {
  $academic_enable_entire_option = array(
    'static-frontpage'  => esc_html__( 'Static Frontpage', 'academic' ),
    'disabled'          => esc_html__( 'Disabled', 'academic' ),
    'entire-site'          => esc_html__( 'Entrie Site', 'academic' ),
  );

  $output = apply_filters( 'academic_enable_entire_option', $academic_enable_entire_option );

  return $output;
}


/**
 * Slider effects
 * @return array Slider effects
 */
function academic_slider_effect() {
  $academic_slider_effect = array(
    'fade'                                        => esc_html__( 'Fade', 'academic' ),
    'cubic-bezier(0.250, 0.250, 0.750, 0.750)'    => esc_html__( 'Linear', 'academic' ),
  );

  $output =  apply_filters( 'academic_slider_effect', $academic_slider_effect );

  // Sort array in ascending order, according to the key:
  if ( ! empty( $output ) ) {
    ksort( $output );
  }

  return $output;
}



/**
 * Category blog two content type
 * @return array Category blog two content type options
 */
function academic_category_blog_two_type() {
  $academic_category_blog_two_type = array(
    'multiple-category' => esc_html__( 'Multiple Category', 'academic' ),
    'recent-posts'      => esc_html__( 'Recent Posts', 'academic' ),
  );

  $output = apply_filters( 'academic_category_blog_two_type', $academic_category_blog_two_type );

  return $output;
}

/**
 * Category blog two content layout
 * @return array Category blog two content type options
 */
function academic_category_blog_two_layout() {
  $academic_category_blog_two_layout = array(
    3  => esc_html__( '3 Column', 'academic' ),
    4  => esc_html__( '4 Column', 'academic' ),
  );

  $output = apply_filters( 'academic_category_blog_two_layout', $academic_category_blog_two_layout );

  return $output;
}


/**
 * Category blog three content layout
 * @return array Category blog three content type options
 */
function academic_category_blog_first_layout() {
  $academic_category_blog_first_layout = array(
    4  => esc_html__( '4 Column', 'academic' ),
    5  => esc_html__( '5 Column', 'academic' ),
    6  => esc_html__( '6 Column', 'academic' ),
  );

  $output = apply_filters( 'academic_category_blog_first_layout', $academic_category_blog_first_layout );

  return $output;
}

/**
 * Category blog three content type
 * @return array Category blog three content type options
 */
function academic_category_blog_first_type() {
  $academic_category_blog_first_type = array(
    'category'          => esc_html__( 'Categories', 'academic' ),
    'sub-category'      => esc_html__( 'Sub Categories', 'academic' ),
  );

  $output = apply_filters( 'academic_category_blog_first_type', $academic_category_blog_first_type );

  return $output;
}

/**
 * Upcoming Event Content type
 * @return array cat blog four content type
 */
function academic_cat_blog_four_content_type() {
  $academic_cat_blog_four_content_type = array(
    'category' => esc_html__( 'Category', 'academic' ),
  );

  $output = apply_filters( 'academic_cat_blog_four_content_type', $academic_cat_blog_four_content_type );
  
  return $output;
}

/**
 * Upcoming Event content layout
 * @return array Category blog four content type options
 */
function academic_category_blog_four_layout() {
  $academic_category_blog_four_layout = array(
    2  => esc_html__( '2 Column', 'academic' ),
    3  => esc_html__( '3 Column', 'academic' ),
    4  => esc_html__( '4 Column', 'academic' ),
  );

  $output = apply_filters( 'academic_category_blog_four_layout', $academic_category_blog_four_layout );

  return $output;
}
<?php
/**
 * one wpversion functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package one wpversion
 */

if ( ! function_exists( 'one_pageily_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function one_pageily_setup() {
    /*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on one, use a find and replace
	 * to change 'one-pageily' to the name of your theme in all the template files.
	 */
    load_theme_textdomain( 'one-pageily', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true );
	add_image_size( 'one-pageily-related', 200, 125, true ); //related

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'one-pageily' ),
   ) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
   ) );

  if ( one_pageily_is_wc_active() ) {
    add_theme_support( 'woocommerce' );
  }

	// Set up the WordPress core custom background feature.
  add_theme_support( 'custom-background', apply_filters( 'one_pageily_custom_background_args', array(
    'default-color' => '#eee',
    'default-image' => '',
    ) ) );
}
endif;
add_action( 'after_setup_theme', 'one_pageily_setup' );

function one_pageily_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'one_pageily_content_width', 678 );
}
add_action( 'after_setup_theme', 'one_pageily_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function one_pageily_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'one-pageily' ),
		'id'            => 'sidebar',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
   ) );

    // First Top Widget 
  register_sidebar( array(
    'name'          => __( 'Top Widget 1', 'one-pageily' ),
    'description'   => __( 'First Top Widget Column', 'one-pageily' ),
    'id'            => 'top-widget-first',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ) );


    // Second Top Widget 
  register_sidebar( array(
    'name'          => __( 'Top Widget 2', 'one-pageily' ),
    'description'   => __( 'Second Top Widget Column', 'one-pageily' ),
    'id'            => 'top-widget-second',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ) );

    // Third Top Widget 
  register_sidebar( array(
    'name'          => __( 'Top Widget 3', 'one-pageily' ),
    'description'   => __( 'Third Top Widget Column', 'one-pageily' ),
    'id'            => 'top-widget-third',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ) );


    // First Footer 
  register_sidebar( array(
    'name'          => __( 'Footer 1', 'one-pageily' ),
    'description'   => __( 'First footer column', 'one-pageily' ),
    'id'            => 'footer-first',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ) );

	// Second Footer 
  register_sidebar( array(
    'name'          => __( 'Footer 2', 'one-pageily' ),
    'description'   => __( 'Second footer column', 'one-pageily' ),
    'id'            => 'footer-second',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ) );

	// Third Footer 
  register_sidebar( array(
    'name'          => __( 'Footer 3', 'one-pageily' ),
    'description'   => __( 'Third footer column', 'one-pageily' ),
    'id'            => 'footer-third',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ) );

  if ( one_pageily_is_wc_active() ) {
        // Register WooCommerce Shop and Single Product Sidebar
    register_sidebar( array(
      'name' => __('Shop Page Sidebar', 'one-pageily' ),
      'description'   => __( 'Appears on Shop main page and product archive pages.', 'one-pageily' ),
      'id' => 'shop-sidebar',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widget-title"><span>',
      'after_title' => '</span></h3>',
      ) );
    register_sidebar( array(
      'name' => __('Single Product Sidebar', 'one-pageily' ),
      'description'   => __( 'Appears on single product pages.', 'one-pageily' ),
      'id' => 'product-sidebar',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widget-title"><span>',
      'after_title' => '</span></h3>',
      ) );
  }
}
add_action( 'widgets_init', 'one_pageily_widgets_init' );

function one_pageily_custom_sidebar() {
    // Default sidebar.
  $sidebar = 'sidebar';

    // Woocommerce.
  if ( one_pageily_is_wc_active() ) {
    if ( is_shop() || is_product_category() ) {
      $sidebar = 'shop-sidebar';
    }
    if ( is_product() ) {
      $sidebar = 'product-sidebar';
    }
  }

  return $sidebar;
}

/**
 * Enqueue scripts and styles.
 */
function one_pageily_scripts() {
	wp_enqueue_style( 'one-pageily-style', get_stylesheet_uri() );

	$handle = 'one-pageily-style';

    // WooCommerce
  if ( one_pageily_is_wc_active() ) {
    if ( is_woocommerce() || is_cart() || is_checkout() ) {
      wp_enqueue_style( 'woocommerce', get_template_directory_uri() . '/css/woocommerce2.css' );
      $handle = 'woocommerce';
    }
  }

  wp_enqueue_script( 'one-pageily-customscripts', get_template_directory_uri() . '/js/customscripts.js',array('jquery'),'',true); 

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'one_pageily_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Copyrights
 */
if ( ! function_exists( 'one_pageily_copyrights_credit' ) ) {
  function one_pageily_copyrights_credit() { 
    global $onepageily_options
    ?>
    <!--start copyrights-->
    <div class="copyrights">
      <div class="container">
        <div class="row" id="copyright-note">
          <span>

            <?php
            $one_pageily_copyright_text = get_theme_mod('one_pageily_copyright_text', 'Copyright 2018 - Powered By WordPress. ');
            echo $one_pageily_copyright_text;
            ?>
          </span>
        </div>
      </div>
    </div>
    <!--end copyrights-->
    <?php }
  }

/**
 * Custom Comments template
 */
if ( ! function_exists( 'one_pageily_comments' ) ) {
	function one_pageily_comment($comment, $args, $depth) { ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
   <div id="comment-<?php comment_ID(); ?>" style="position:relative;" itemscope itemtype="http://schema.org/UserComments">
    <div class="comment-author vcard">
     <?php echo get_avatar( $comment->comment_author_email, 70 ); ?>
     <div class="comment-metadata">
      <?php printf('<span class="fn" itemprop="creator" itemscope itemtype="http://schema.org/Person">%s</span>', get_comment_author_link()) ?>
      <span class="comment-meta">
        <?php edit_comment_link(__('(Edit)', 'one-pageily'),'  ','') ?>
      </span>
    </div>
  </div>
  <?php if ($comment->comment_approved == '0') : ?>
  <em><?php _e('Your comment is awaiting moderation.', 'one-pageily') ?></em>
  <br />
<?php endif; ?>
<div class="commentmetadata" itemprop="commentText">
 <?php comment_text() ?>
 <time><?php comment_date(get_option( 'date_format' )); ?></time>
 <span class="reply">
  <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
</span>
</div>
</div>
</li>
<?php }
}

/*
 * Excerpt
 */
function one_pageily_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt);
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

/**
 * Shorthand function to check for more tag in post.
 *
 * @return bool|int
 */
function one_pageily_post_has_moretag() {
  return strpos( get_the_content(), '<!--more-->' );
}

if ( ! function_exists( 'one_pageily_readmore' ) ) {
    /**
     * Display a "read more" link.
     */
    function one_pageily_readmore() {
      ?>
      <div class="readMore">
        <a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
          <?php _e( 'Read More', 'one-pageily' ); ?>
        </a>
      </div>
      <?php 
    }
  }

/**
 * Breadcrumbs
 */
if (!function_exists('one_pageily_the_breadcrumb')) {
  function one_pageily_the_breadcrumb() {
    if ( is_front_page() ) {
      return;
    }
    echo '<span typeof="v:Breadcrumb" class="root"><a rel="v:url" property="v:title" href="';
    echo esc_url( home_url() );
    echo '">'.esc_html(sprintf( __( "Home", 'one-pageily' )));
    echo '</a></span><span><i class="one-icon icon-angle-double-right"></i></span>';
    if (is_single()) {
      $categories = get_the_category();
      if ( $categories ) {
        $level = 0;
        $hierarchy_arr = array();
        foreach ( $categories as $cat ) {
          $anc = get_ancestors( $cat->term_id, 'category' );
          $count_anc = count( $anc );
          if (  0 < $count_anc && $level < $count_anc ) {
            $level = $count_anc;
            $hierarchy_arr = array_reverse( $anc );
            array_push( $hierarchy_arr, $cat->term_id );
          }
        }
        if ( empty( $hierarchy_arr ) ) {
          $category = $categories[0];
          echo '<span typeof="v:Breadcrumb"><a href="'. esc_url( get_category_link( $category->term_id ) ).'" rel="v:url" property="v:title">'.esc_html( $category->name ).'</a></span><span><i class="one-icon icon-angle-double-right"></i></span>';
        } else {
          foreach ( $hierarchy_arr as $cat_id ) {
            $category = get_term_by( 'id', $cat_id, 'category' );
            echo '<span typeof="v:Breadcrumb"><a href="'. esc_url( get_category_link( $category->term_id ) ).'" rel="v:url" property="v:title">'.esc_html( $category->name ).'</a></span><span><i class="one-icon icon-angle-double-right"></i></span>';
          }
        }
      }
      echo "<span><span>";
      the_title();
      echo "</span></span>";
    } elseif (is_page()) {
      $parent_id  = wp_get_post_parent_id( get_the_ID() );
      if ( $parent_id ) {
        $breadcrumbs = array();
        while ( $parent_id ) {
          $page = get_page( $parent_id );
          $breadcrumbs[] = '<span typeof="v:Breadcrumb"><a href="'.esc_url( get_permalink( $page->ID ) ).'" rel="v:url" property="v:title">'.esc_html( get_the_title($page->ID) ). '</a></span><span><i class="one-icon icon-angle-double-right"></i></span>';
          $parent_id  = $page->post_parent;
        }
        $breadcrumbs = array_reverse( $breadcrumbs );
        foreach ( $breadcrumbs as $crumb ) { echo $crumb; }
      }
      echo "<span><span>";
      the_title();
      echo "</span></span>";
    } elseif (is_category()) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $this_cat_id = $cat_obj->term_id;
      $hierarchy_arr = get_ancestors( $this_cat_id, 'category' );
      if ( $hierarchy_arr ) {
        $hierarchy_arr = array_reverse( $hierarchy_arr );
        foreach ( $hierarchy_arr as $cat_id ) {
          $category = get_term_by( 'id', $cat_id, 'category' );
          echo '<span typeof="v:Breadcrumb"><a href="'.esc_url( get_category_link( $category->term_id ) ).'" rel="v:url" property="v:title">'.esc_html( $category->name ).'</a></span><span><i class="one-icon icon-angle-double-right"></i></span>';
        }
      }
      echo "<span><span>";
      single_cat_title();
      echo "</span></span>";
    } elseif (is_author()) {
      echo "<span><span>";
      if(get_query_var('author_name')) :
        $curauth = get_user_by('slug', get_query_var('author_name'));
      else :
        $curauth = get_userdata(get_query_var('author'));
      endif;
      echo esc_html( $curauth->nickname );
      echo "</span></span>";
    } elseif (is_search()) {
      echo "<span><span>";
      the_search_query();
      echo "</span></span>";
    } elseif (is_tag()) {
      echo "<span><span>";
      single_tag_title();
      echo "</span></span>";
    }
  }
}


/*
 * Google Fonts
 */
function one_pageily_fonts_url() {
  $fonts_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by Monda, translate this to 'off'. Do not translate
    * into your own language.
    */
    $monda = _x( 'on', 'Monda font: on or off', 'one-pageily' );

    if ( 'off' !== $monda ) {
      $font_families = array();

      if ( 'off' !== $monda ) {
        $font_families[] = urldecode('Roboto:300,400,500,700,900');
      }

      $query_args = array(
        'family' => urlencode( implode( '|', $font_families ) ),
            //'subset' => urlencode( 'latin,latin-ext' ),
        );

      $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }

    return $fonts_url;
  }

  function one_pageily_scripts_styles() {
    wp_enqueue_style( 'theme-slug-fonts', one_pageily_fonts_url(), array(), null );
  }
  add_action( 'wp_enqueue_scripts', 'one_pageily_scripts_styles' );

/**
 * WP Mega Menu Plugin Support
 */
function one_pageily_megamenu_parent_element( $selector ) {
  return '.primary-navigation .container';
}
add_filter( 'wpmm_container_selector', 'one_pageily_megamenu_parent_element' );

/**
 * Determines whether the WooCommerce plugin is active or not.
 * @return bool
 */
function one_pageily_is_wc_active() {
  if ( is_multisite() ) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

    return is_plugin_active( 'woocommerce/woocommerce.php' );
  } else {
    return in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
  }
}

/**
 * WooCommerce
 */
if ( one_pageily_is_wc_active() ) {
  if ( !function_exists( 'onepageily_loop_columns' )) {
        /**
         * Change number or products per row to 3
         *
         * @return int
         */
        function onepageily_loop_columns() {
            return 3; // 3 products per row
          }
        }
        add_filter( 'loop_shop_columns', 'onepageily_loop_columns' );

    /**
     * Redefine woocommerce_output_related_products()
     */
    function woocommerce_output_related_products() {
      $args = array(
        'posts_per_page' => 3,
        'columns' => 3,
        );
        woocommerce_related_products($args); // Display 3 products in rows of 1
      }

      global $pagenow;
      if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
        /**
         * Define WooCommerce image sizes.
         */
        function one_pageily_woocommerce_image_dimensions() {
          $catalog = array(
                'width'     => '210',   // px
                'height'    => '155',   // px
                'crop'      => 1        // true
                );
          $single = array(
                'width'     => '326',   // px
                'height'    => '444',   // px
                'crop'      => 1        // true
                );
          $thumbnail = array(
                'width'     => '74',    // px
                'height'    => '74',   // px
                'crop'      => 0        // false
                );
            // Image sizes
            update_option( 'shop_catalog_image_size', $catalog );       // Product category thumbs
            update_option( 'shop_single_image_size', $single );         // Single product image
            update_option( 'shop_thumbnail_image_size', $thumbnail );   // Image gallery thumbs
          }
          add_action( 'init', 'one_pageily_woocommerce_image_dimensions', 1 );
        }


    /**
     * Change the number of product thumbnails to show per row to 4.
     *
     * @return int
     */
    function one_pageily_woocommerce_thumb_cols() {
     return 4; // .last class applied to every 4th thumbnail
   }
   add_filter( 'woocommerce_product_thumbnails_columns', 'one_pageily_woocommerce_thumb_cols' );


    /**
     * Ensure cart contents update when products are added to the cart via AJAX.
     *
     * @param $fragments
     *
     * @return mixed
     */
    function one_pageily_header_add_to_cart_fragment( $fragments ) {
      global $woocommerce;
      ob_start(); ?>

      <a class="cart-contents" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" title="<?php _e( 'View your shopping cart', 'one-pageily' ); ?>"><?php echo sprintf( _n( '%d item', '%d items', $woocommerce->cart->cart_contents_count, 'one-pageily' ), $woocommerce->cart->cart_contents_count );?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>

      <?php $fragments['a.cart-contents'] = ob_get_clean();
      return $fragments;
    }
    add_filter( 'add_to_cart_fragments', 'one_pageily_header_add_to_cart_fragment' );

    /**
     * Optimize WooCommerce Scripts
     * Updated for WooCommerce 2.0+
     * Remove WooCommerce Generator tag, styles, and scripts from non WooCommerce pages.
     */
    function one_pageily_manage_woocommerce_styles() {
        //remove generator meta tag
      remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );

        //first check that woo exists to prevent fatal errors
      if ( function_exists( 'is_woocommerce' ) ) {
            //dequeue scripts and styles
        if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
          wp_dequeue_style( 'woocommerce-layout' );
          wp_dequeue_style( 'woocommerce-smallscreen' );
          wp_dequeue_style( 'woocommerce-general' );
                wp_dequeue_style( 'wc-bto-styles' ); //Composites Styles
                wp_dequeue_script( 'wc-add-to-cart' );
                wp_dequeue_script( 'wc-cart-fragments' );
                wp_dequeue_script( 'woocommerce' );
                wp_dequeue_script( 'jquery-blockui' );
                wp_dequeue_script( 'jquery-placeholder' );
              }
            }
          }
          add_action( 'wp_enqueue_scripts', 'one_pageily_manage_woocommerce_styles', 99 );

    // Remove WooCommerce generator tag.
          remove_action('wp_head', 'wc_generator_tag');
        }

/**
 * Post Layout for Archives
 */
if ( ! function_exists( 'one_pageily_archive_post' ) ) {
    /**
     * Display a post of specific layout.
     * 
     * @param string $layout
     */
    function one_pageily_archive_post( $layout = '' ) { 
       ?>
      <article class="post excerpt">
       
       <?php if ( has_post_thumbnail() ) { ?>
        <div class="post-blogs-container-thumbnails">
       <?php } else { ?>
        <div class="post-blogs-container">
       <?php } ?>
     
        <?php if ( empty($one_pageily_full_posts) ) : ?>


        <?php if ( has_post_thumbnail() ) { ?>
        <div class="featured-thumbnail-container">
          <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" id="featured-thumbnail">
      <?php the_post_thumbnail( 'full' ); ?>
          </a>
        </div>
        <?php } ?>
        <div class="thumbnail-post-content">
        <h2 class="title">
          <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
        </h2>

    <span class="entry-meta">
      <?php echo get_the_date(); ?>
   <?php
        if ( is_sticky() && is_home() && ! is_paged() ) {
          printf( ' / <span class="sticky-text">%s</span>', __( 'Featured', 'one-pageily' ) );
        } ?>
    </span>
        <div class="post-content">
          <?php echo one_pageily_excerpt(50); ?>...
        </div>
      <?php else : ?>
      <?php if (one_pageily_post_has_moretag()) : ?>
      <?php one_pageily_readmore(); ?>
      </div>
    </div>
    <?php endif; ?>
  <?php endif; ?>

</article>
<?php }
}



/**
 * Austintadlock customizer button https://github.com/justintadlock/trt-customizer-pro
 */
require_once( trailingslashit( get_template_directory() ) . 'justinadlock-customizer-button/class-customize.php' );


/**
 * Compare page CSS
 */

function one_pageily_comparepage_css($hook) {
  if ( 'appearance_page_one-pageily-info' != $hook ) {
    return;
  }
  wp_enqueue_style( 'one-pageily-custom-style', get_template_directory_uri() . '/css/compare.css' );
}
add_action( 'admin_enqueue_scripts', 'one_pageily_comparepage_css' );

/**
 * Compare page content
 */

add_action('admin_menu', 'one_pageily_themepage');
function one_pageily_themepage(){
  $theme_info = add_theme_page( __('One Pageily','one-pageily'), __('One Pageily','one-pageily'), 'manage_options', 'one-pageily-info.php', 'one_pageily_info_page' );
}

function one_pageily_info_page() {
  $user = wp_get_current_user();
  ?>
  <div class="wrap about-wrap one-pageily-add-css">
    <div>
      <h1>
        <?php echo __('Welcome to One Pageily!','one-pageily'); ?>
      </h1>

      <div class="feature-section three-col">
        <div class="col">
          <div class="widgets-holder-wrap">
            <h3><?php echo __("Contact Support", "one-pageily"); ?></h3>
            <p><?php echo __("Getting started with a new theme can be difficult, if you have issues with One Pageily then throw us an email.", "one-pageily"); ?></p>
            <p><a target="blank" href="<?php echo esc_url('https://superbthemes.com/help-contact/', 'one-pageily'); ?>" class="button button-primary">
              <?php echo __("Contact Support", "one-pageily"); ?>
            </a></p>
          </div>
        </div>
        <div class="col">
          <div class="widgets-holder-wrap">
            <h3><?php echo __("View our other themes", "one-pageily"); ?></h3>
            <p><?php echo __("Do you like our concept but feel like the design doesn't fit your need? Then check out our website for more designs.", "one-pageily"); ?></p>
            <p><a target="blank" href="<?php echo esc_url('https://superbthemes.com/wordpress-themes/', 'one-pageily'); ?>" class="button button-primary">
              <?php echo __("View All Themes", "one-pageily"); ?>
            </a></p>
          </div>
        </div>
        <div class="col">
          <div class="widgets-holder-wrap">
            <h3><?php echo __("Premium Edition", "one-pageily"); ?></h3>
            <p><?php echo __("If you enjoy One Pageily and want to take your website to the next step, then check out our premium edition here.", "one-pageily"); ?></p>
            <p><a target="blank" href="<?php echo esc_url('https://superbthemes.com/onepageily/', 'one-pageily'); ?>" class="button button-primary">
              <?php echo __("Read More", "one-pageily"); ?>
            </a></p>
          </div>
        </div>
      </div>
    </div>
    <hr>

    <h2><?php echo __("Free Vs Premium","one-pageily"); ?></h2>
    <div class="one-pageily-button-container">
      <a target="blank" href="<?php echo esc_url('https://superbthemes.com/onepageily/', 'one-pageily'); ?>" class="button button-primary">
        <?php echo __("Read Full Description", "one-pageily"); ?>
      </a>
      <a target="blank" href="<?php echo esc_url('https://superbthemes.com/demo/onepageily/', 'one-pageily'); ?>" class="button button-primary">
        <?php echo __("View Theme Demo", "one-pageily"); ?>
      </a>
    </div>


    <table class="wp-list-table widefat">
      <thead>
        <tr>
          <th><strong><?php echo __("Theme Feature", "one-pageily"); ?></strong></th>
          <th><strong><?php echo __("Basic Version", "one-pageily"); ?></strong></th>
          <th><strong><?php echo __("Premium Version", "one-pageily"); ?></strong></th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td><?php echo __("Header Background Color  ", "one-pageily"); ?></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Custom Header Logo & Text ", "one-pageily"); ?></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Custom Header Button Text & Link", "one-pageily"); ?></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Custom Header Button Colors", "one-pageily"); ?></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Custom Navigation Text Color", "one-pageily"); ?></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Custom Background Image", "one-pageily"); ?></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Hide Header Text", "one-pageily"); ?></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>


        <tr>
          <td><?php echo __("Premium Support", "one-pageily"); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Easy Google Fonts", "one-pageily"); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Pagespeed & SEO Plugin", "one-pageily"); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Security Plugin", "one-pageily"); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Only Show Header On Front Page", "one-pageily"); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Custom Header Height", "one-pageily"); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Only Show Widgets On Front Page", "one-pageily"); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Custom Copyright Text", "one-pageily"); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Right/Left Sidebar", "one-pageily"); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Hide/Show Author Section", "one-pageily"); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Hide/Show Related Posts Section  ", "one-pageily"); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Hide/Show Breadcrumbs", "one-pageily"); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Hide/Show Tags Section", "one-pageily"); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Right/Next or Numbered Pagination", "one-pageily"); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Customize Footer Colors", "one-pageily"); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Customize Page/Post Colors", "one-pageily"); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr> 
        <tr>
          <td><?php echo __("Customize Blog Post Feed Colors", "one-pageily"); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Customize All Navigation Colors", "one-pageily"); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Custom Top Widgets Colors", "one-pageily"); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Customize Sidebar Colors", "one-pageily"); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "one-pageily"); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "one-pageily"); ?>" /></span></td>
        </tr>
      </tbody>
    </table>

  </div>
  <?php
}



<?php
/**
 * Top bar
 *
 * This is the template for adding top bar
 *
 * @package Theme Palace
 * @subpackage Academic
 * @since 0.6
 */

if ( ! function_exists( 'academic_add_top_bar' ) ) :
    /**
     * Add top bar section
     *
     * @since Academic 0.6
     */
    function academic_add_top_bar() {
      $options = academic_get_theme_options();

      // Check if top bar is enabled
      $top_bar_show = $options['top_bar_show'];
      if ( ! $top_bar_show ) {
          return;
      }

      // Get top bar section details
      $section_details = array();
      $section_details = apply_filters( 'academic_filter_top_bar_section_details', $section_details );

      if ( empty( $section_details ) ) {
          return;
      }

      // Render top bar section now.
      academic_render_top_bar( $section_details );
    }
endif;
add_action( 'academic_top_bar', 'academic_add_top_bar', 10 );


if ( ! function_exists( 'academic_top_bar_section_details' ) ) :
    /**
     * Top Bar section details.
     *
     * @since Academic 0.6
     *
     * @param array $input top bar section details.
     */
    function academic_top_bar_section_details( $input ) {
        $options = academic_get_theme_options();

        // Top bar content type
        $content_type = $options['top_bar_content_type'];

        $content      = array();

        switch ( $content_type ) {

            case 'custom':
              for ( $i = 1; $i <= $options['top_bar_field_number']; $i++ ) {
                  if ( isset( $options[ 'top_bar_icon_'.$i ] ) ) {
                      $content[ $i ]['icon'] = $options[ 'top_bar_icon_'.$i ];
                  }
                  if ( isset( $options[ 'top_bar_value_'.$i ] ) ) {
                      $content[ $i ]['value'] = $options[ 'top_bar_value_'.$i ];
                  }
              }
            break;

            default:
            break;
        }

        // Assin value if not empty
        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// Top Bar section content details.
add_filter( 'academic_filter_top_bar_section_details', 'academic_top_bar_section_details' );


if ( ! function_exists( 'academic_render_top_bar' ) ) :
    /**
     * Add top bar
     *
     * @since Academic 0.6
     */
    function academic_render_top_bar( $section_details ) { 
      $options = academic_get_theme_options();

      // Bail if no section details input.
      if ( empty( $section_details ) ) {
          return;
      }
      ?>
      <section id="top-bar">
        <button class="topbar-toggle"><i class="fa fa-angle-left"></i></button>
        <div class="container topbar-dropdown">
          <div class="pull-left">
            <ul class="address-block">
            <?php foreach ( $section_details as $content ) { 
              if ( ! empty( $content[ 'icon' ] ) || ! empty( $content['value'] ) ) {
              ?>
              <li>
                <i class="fa <?php echo esc_attr( $content['icon'] );?>"></i>
                <?php 
                $haystack = $content['icon'];
                if( strpos( $haystack, 'phone' ) !== false ) {
                  echo '
                      <a href="tel:' . esc_attr( $content['value'] ) . '" title="' . esc_attr( $content['value'] ) . '">
                        ' . esc_html( $content['value'] ) . '
                      </a>';
                } elseif ( strpos( $haystack, 'email' ) !== false ) {
                  echo '
                      <a href="mailto:' . esc_attr( $content['value'] ) .'">
                        ' . esc_html( $content['value'] ) . '
                      </a>';
                } elseif ( strpos( $haystack, 'skype' ) !== false ) {
                   echo '
                      <a href="callto://' . esc_attr( $content['value'] ) .'">
                        ' . esc_html( $content['value'] ) . '
                      </a>';
                } else{
                  echo esc_html( $content['value'] );
                } ?>
              </li>
            <?php 
              } 
            }
            ?>
            </ul><!-- end .address-block -->
          </div><!-- end .pull-left -->
          <?php if ( has_nav_menu( 'login' ) ) : ?>
            <div class="pull-right">
              <?php wp_nav_menu( array( 'theme_location' => 'login', 'container' => 'ul', 'menu_class' => 'login-signup' ) ); ?>
            </div><!-- end .pull-right -->
          <?php endif; ?>
        </div><!-- end .container -->
        </div><!-- end .container -->
      </section><!-- end .top-bar -->
<?php
    }
endif;
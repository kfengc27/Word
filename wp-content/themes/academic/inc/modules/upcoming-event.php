<?php
/**
 * Category blog four
 *
 * This is the template for adding cat blog four
 *
 * @package Theme Palace
 * @subpackage Academic 0.3@since 0.3
 */

if ( ! function_exists( 'academic_add_cat_blog_four' ) ) :
    /**
     * Add cat blog four section
     *
     * @since Academic 0.3
     */
    function academic_add_cat_blog_four() {
      // Check if cat blog four is enabled on frontpage
      $cat_blog_four_enable = apply_filters( 'academic_section_status', true, 'cat_blog_four_enable' );
      if ( true !== $cat_blog_four_enable ) {
        return false;
      }

      // Get cat blog four section details
      $section_details = array();
      $section_details = apply_filters( 'academic_filter_cat_blog_four_section_details', $section_details );
      if ( empty( $section_details ) ) {
          return;
      }

      // Render cat blog four section now.
      academic_render_cat_blog_four( $section_details );
    } 
endif;
add_action( 'academic_primary_content', 'academic_add_cat_blog_four', 70 );


if ( ! function_exists( 'academic_cat_blog_four_section_details' ) ) :
    /**
     * Category blog four section details.
     *
     * @since Academic 0.3
     *
     * @param array $input cat blog four section details.
     */
    function academic_cat_blog_four_section_details( $input ) {
        $options = academic_get_theme_options();
        // Category blog four content type
        $content_type = $options['cat_blog_four_content_type'];

        $content      = array();

            
              // Get category id
              if ( isset( $options['cat_blog_four_content_type_cat'] ) ) {
                  $cat_id = $options['cat_blog_four_content_type_cat'];
              }

              $num_of_posts = '';
              // Get number of posts
              if ( isset( $options['cat_blog_four_num_of_posts'] ) ) {
                  $num_of_posts = $options['cat_blog_four_num_of_posts'];
              }

              // Bail if no valid posts are selected.
              if ( empty( $cat_id ) ) {
                  return $input;
              }

              $args = array(
                  'no_found_rows' => true,
                  'orderby'       => 'post__in',
                  'cat'           => $cat_id,
                  'posts_per_page'=> $num_of_posts
              );

              $posts = get_posts( $args );
              if ( ! empty( $posts ) ) {

                  $i = 1;
                  foreach ( $posts as $key => $post ) {
                    $post_id = $post->ID;
                    $img_array = null;
                    if ( has_post_thumbnail( $post_id ) ) {
                        $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
                    } 
                    if ( isset( $img_array ) ) {
                      $content[$i]['img_array'] = $img_array;
                    }

                    $content[$i]['url']      = get_permalink( $post_id );
                    $content[$i]['title']    = get_the_title( $post_id );
                    $content[$i]['alt']      = get_the_title( $post_id );
                    $content[$i]['date']      = get_post_meta( $post_id, 'academic-event-date' );
                    $content[$i]['time-from']      = get_post_meta( $post_id, 'academic-event-time-from', true  );
                    $content[$i]['time-to']      = get_post_meta( $post->ID, 'academic-event-time-to', true );
                    $content[$i]['location']      = get_post_meta( $post_id, 'academic-event-location', true  );

                    $i++;
                  }
              }
        

        // Assin value if not empty
        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// Category blog four section content details.
add_filter( 'academic_filter_cat_blog_four_section_details', 'academic_cat_blog_four_section_details' );


if ( ! function_exists( 'academic_render_cat_blog_four' ) ) :
    /**
     * Add cat blog four
     *
     * @since Academic 0.3
     */
    function academic_render_cat_blog_four( $section_details ) { 
      $options = academic_get_theme_options();

      // Bail if no section details input.
      if ( empty( $section_details ) ) {
          return;
      }
      ?>

      <section id="upcoming-events" class="page-section slider os-animation">
        <div class="container">
          <header class="entry-header">
            <?php if ( ! empty( $options['cat_blog_four_title'] ) ) : ?>
              <h2 class="entry-title"><?php echo esc_html( $options['cat_blog_four_title'] );?></h2>  
            <?php endif; ?>
            <?php if ( ! empty( $options['cat_blog_four_sub_title'] ) ) : ?>
              <h6 class="entry-subtitle"><?php echo esc_html( $options['cat_blog_four_sub_title'] );?></h6>
            <?php endif; ?>
          </header><!-- end .entry-header -->

          <div class="entry-content regular" 
          data-slick='{
            "slidesToShow": <?php echo absint( $options['cat_blog_four_slide_to_show'] ); ?>, 
            "slidesToScroll": <?php echo absint( $options['cat_blog_four_slide_to_scroll'] ); ?>, 
            "infinite": <?php echo ( $options['cat_blog_four_infinite_enable'] ? 'true' : 'false' ); ?>, 
            "speed": 800, 
            "dots": <?php echo ( $options['cat_blog_four_pager_enable'] ? 'true' : 'false' ); ?>, 
            "arrows":<?php echo ( $options['cat_blog_four_arrows_enable'] ? 'true' : 'false' ); ?>, 
            "autoplay": <?php echo ( $options['cat_blog_four_autoplay_enable'] ? 'true' : 'false' ); ?> 
          }'>

            <?php foreach ( $section_details as $content ): ?>
              <div class="slider-item">
                <?php if ( ! empty ( $content['img_array'][0] ) ) : ?>
                  <div class="image-wrapper">
                    <a href="<?php echo esc_url( $content['url'] );?>"><img src="<?php echo esc_url( $content['img_array'][0] );?>" alt="<?php echo esc_attr( $content['title'] );?>"></a>
                  </div><!-- end .image-wrapper -->
                <?php endif; ?>
                <div class="course-contents-wrapper">
                  <div class="slide-title">
                    <h3><a href="<?php echo esc_url( $content['url'] );?>"><?php echo esc_html( $content['title'] );?></a></h3>
                  </div><!-- end .slide-title -->

                  <ul class="address-block">
                    <?php if ( ! empty( $content['date'][0] ) || ! empty( $content['time-from'] ) || ! empty( $content['time-to'] ) ) { ?>
                      <li>
                        <i class="fa fa-clock-o"></i>
                        <?php echo esc_html( $content['date'][0] );?>
                        <?php if ( ! empty( $content['time-from'] ) || ! empty( $content['time-to'] ) ) { ?>
                          <?php echo esc_html( $content['time-from'] );?> - <?php echo esc_html( $content['time-to'] );?>
                        <?php } ?>
                      </li>
                    <?php } ?>
                    <?php if ( ! empty( $content['location'] ) ) { ?>
                      <li><i class="fa fa-map-marker"></i><?php echo esc_html( $content['location'] );?></li>
                    <?php } ?>
                  </ul><!-- end .address-block -->

                  <div class="buttons">
                    <a href="<?php echo esc_url( $content['url'] );?>" class="btn btn-blue"><?php esc_html_e( 'Learn More', 'academic' ); ?><i class="fa fa-angle-right"></i></a>
                  </div><!-- end .buttons -->
                </div><!-- end .slider-contents wrapper -->
              </div><!-- end .slider-item -->
            <?php endforeach; ?>
          </div><!-- end .entry-content -->
        </div><!-- end .container -->
      </section><!-- end #upcomiing-events -->
<?php
    }
endif;
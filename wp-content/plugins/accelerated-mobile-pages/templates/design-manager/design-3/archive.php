<?php global $redux_builder_amp; global $wp;  ?>
<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
  <link rel="dns-prefetch" href="https://cdn.ampproject.org">
	<?php
	if ( is_archive() ) {
		$description 	= get_the_archive_description();
		$sanitizer = new AMPFORWP_Content( $description, array(), 
			apply_filters( 'ampforwp_content_sanitizers',
				array( 
					'AMP_Style_Sanitizer' 		=> array(),
					'AMP_Blacklist_Sanitizer' 	=> array(),
					'AMP_Img_Sanitizer' 		=> array(),
					'AMP_Video_Sanitizer' 		=> array(),
					'AMP_Audio_Sanitizer' 		=> array(),
					'AMP_Iframe_Sanitizer' 		=> array(
						'add_placeholder' 		=> true,
					)
				) ) );
	} ?>
	<?php do_action( 'amp_post_template_head', $this ); ?>
	<?php
	$amp_component_scripts = $sanitizer->amp_scripts;
	if ( $sanitizer && $amp_component_scripts) {	
		foreach ($amp_component_scripts as $ampforwp_service => $ampforwp_js_file) { ?>
			<script custom-element="<?php echo $ampforwp_service; ?>"  src="<?php echo $ampforwp_js_file; ?>" async></script> <?php
		}
	}?>
	<style amp-custom>
	<?php $this->load_parts( array( 'style' ) ); ?>
	<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
</head>

<body <?php ampforwp_body_class('amp_home_body design_3_wrapper');?> >
<?php do_action('ampforwp_body_beginning', $this); ?>
<?php $this->load_parts( array( 'header-bar' ) ); ?>

<?php do_action( 'ampforwp_after_header', $this );

if ( get_query_var( 'paged' ) ) {
      $paged = get_query_var('paged');
  } elseif ( get_query_var( 'page' ) ) {
      $paged = get_query_var('page');
  } else {
      $paged = 1;
  }

 ?>

<main>
	<?php do_action('ampforwp_post_before_loop') ?>
	<?php $count = 1; ?>
	<?php

	    $exclude_ids = get_option('ampforwp_exclude_post');

		$q = new WP_Query( array(
			'post_type'           => 'post',
			'orderby'             => 'date',
			'ignore_sticky_posts' => 1,
			'paged'               => esc_attr($paged),
			'post__not_in' 		  => $exclude_ids,
			'has_password' => false ,
			'post_status'=> 'publish'
		) ); ?>

 	<?php if ( is_archive() ) { ?>
 		<div class="amp-wp-content">
 	<?php 
 			if( is_author() ){
			$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
				if( true == ampforwp_gravatar_checker($curauth->user_email) ){
					$curauth_url = get_avatar_url( $curauth->user_email, array('size'=>180) );
					if($curauth_url){ ?>
						<div class="amp-wp-content author-img">
							<amp-img <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> src="<?php echo esc_url($curauth_url); ?>" width="90" height="90" layout="responsive"></amp-img>
						</div>
					<?php }
				}
			}
 			the_archive_title( '<h1 class="amp-wp-content page-title archive-heading">', '</h1>' );
			$arch_desc 		= $sanitizer->get_amp_content();
			if( $arch_desc ) {  
				if($paged <= '1') {?>
					<div class="taxonomy-description">
						<?php echo $arch_desc ; ?>
				  </div>
			  </div> <?php
				}
			}
			if(is_category() && 1 == $redux_builder_amp['ampforwp-sub-categories-support']){
				$parent_cat_id 	= '';
			    $cat_childs		= array();
 			    $parent_cat_id 	= get_queried_object_id();
 			 	$cat_childs 	= get_terms( array(
 			  						'taxonomy' => get_queried_object()->taxonomy,
 			  						'parent'   => $parent_cat_id)
									);
	 			if(!empty($cat_childs)){
	 				echo "<div class='amp-sub-archives'><ul>";
	 				foreach ($cat_childs as $cat_child ) {
	 					 echo '<li><a href="' . get_term_link( $cat_child ) . '">' . $cat_child->name . '</a></li>'; 
	 				}
	 				echo "</ul></div>";
	 			}
	 		}	
 		} ?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
  		$ampforwp_amp_post_url  = ampforwp_url_controller( get_permalink() );

			if( in_array( 'ampforwp-custom-type-amp-endpoint' , $redux_builder_amp ) ) {
	  		if (isset($redux_builder_amp['ampforwp-custom-type-amp-endpoint']) && $redux_builder_amp['ampforwp-custom-type-amp-endpoint']) {
	  			$ampforwp_amp_post_url = trailingslashit( get_permalink() ) . '?amp';
	  		}
			}?>

		<div class="amp-wp-content amp-loop-list <?php if ( ! ampforwp_has_post_thumbnail() ) {  ?>amp-loop-list-noimg<?php } ?>">
			<?php if ( ampforwp_has_post_thumbnail() ) {
				$thumb_url = ampforwp_get_post_thumbnail();
				$thumb_width  	= ampforwp_get_post_thumbnail('width');
				$thumb_height 	= ampforwp_get_post_thumbnail('height');
				if($thumb_url){
					?>
					<div class="home-post_image">
						<a href="<?php echo esc_url( $ampforwp_amp_post_url ); ?>">
							<amp-img
							layout="responsive"
							src=<?php echo esc_url($thumb_url); ?>
							<?php ampforwp_thumbnail_alt(); ?>
							width=<?php echo $thumb_width; ?>
							height=<?php echo $thumb_height; ?>
						></amp-img>
					</a>
				</div>
				<?php } 
			}?>

			<div class="amp-wp-post-content">
                <ul class="amp-wp-tags">
					<?php foreach((get_the_category()) as $category) { 
						if ( true == $redux_builder_amp['ampforwp-archive-support'] ) { ?>
						<li class="amp-cat-<?php echo $category->term_id;?>"><a href="<?php echo esc_url(ampforwp_url_controller( get_category_link( $category->term_id ) )); ?>" ><?php echo $category->cat_name ?></a></li>
					<?php }
					else { ?>
					   <li class="amp-cat-<?php echo $category->term_id;?>"><?php echo $category->cat_name ?></li>
					<?php }
					} ?> 
                </ul>
				<h2 class="amp-wp-title"><a href="<?php echo esc_url( $ampforwp_amp_post_url ); ?>"> <?php the_title(); ?></a></h2>


				<?php
				if( true == $redux_builder_amp['excerpt-option'] ) {
					if(has_excerpt()){
						$content = get_the_excerpt();
					}else{
						$content = get_the_content();
					} ?>
			        <p class="large-screen-excerpt-design-3">
					<?php  
						$excerpt_length	='';
						$excerpt_length = 15;
						$final_content 	= ""; 					
						$final_content  = apply_filters('ampforwp_modify_index_content', $content,  $excerpt_length );

						if ( false === has_filter('ampforwp_modify_index_content' ) ) {
							$final_content = wp_trim_words( strip_shortcodes( $content ) ,  $excerpt_length );
						}
						echo $final_content; ?> </p>
			        <p class="small-screen-excerpt-design-3" > <?php    
						if($redux_builder_amp['excerpt-option-design-3']== true) {
							$excerpt_length='';
							$excerpt_length = $redux_builder_amp['amp-design-3-excerpt'];
							$final_content  = "";  					
							$final_content  = apply_filters('ampforwp_modify_index_content', $content,  $excerpt_length );

							if ( false === has_filter('ampforwp_modify_index_content' ) ) {
								$final_content = wp_trim_words( strip_shortcodes( $content ) ,  $excerpt_length );
							}
							echo $final_content; 
						} ?> 
					</p>
				<?php } ?>
                <div class="featured_time">
                  <?php
                       $post_date =  human_time_diff( get_the_time('U', get_the_ID() ), current_time('timestamp') ) .' '. ampforwp_translation( $redux_builder_amp['amp-translator-ago-date-text'],'ago' );
                    	$post_date = apply_filters('ampforwp_modify_post_date',$post_date);
                    	echo  $post_date ;?>
                </div>

		    </div>
            <div class="cb"></div>
	</div>

	<?php 
	do_action('ampforwp_between_loop',$count,$this);
		         $count++;
	endwhile;  ?>

	<div class="amp-wp-content pagination-holder">


		<div id="pagination">
			<div class="next"><?php next_posts_link( ampforwp_translation ($redux_builder_amp['amp-translator-show-more-posts-text'], 'Show more Posts') . ' &raquo;' ,0 ) ?></div>
					<?php if ( $paged > 1 ) { ?>
						<div class="prev"><?php previous_posts_link( '&laquo; '.ampforwp_translation($redux_builder_amp['amp-translator-show-previous-posts-text'], 'Show previous Posts') ); ?></div>
					<?php } ?>
			<div class="clearfix"></div>
		</div>
	</div>

	<?php endif; ?>
	<?php wp_reset_postdata(); ?>
	<?php do_action('ampforwp_post_after_loop') ?>
</main>
<?php do_action( 'amp_post_template_above_footer', $this ); ?>
<?php $this->load_parts( array( 'footer' ) ); ?>
<?php do_action( 'amp_post_template_footer', $this ); ?>
</body>
</html>
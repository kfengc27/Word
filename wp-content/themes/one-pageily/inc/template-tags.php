<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package one wpversion
 */

if ( ! function_exists( 'one_pageily_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function one_pageily_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	// $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	// $next     = get_adjacent_post( false, '', false );

	// if ( ! $next && ! $previous ) {
	// 	return;
	// }
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<!--Start Pagination-->
        <?php $one_pageily_nav_type = get_theme_mod('one_pageily_pagination_type','1');
        if (!empty($one_pageily_nav_type)) {
			$one_pageily_pagination = get_the_posts_pagination( array(
			    'mid_size' => 2,
			    'prev_text' => '<i class="one-icon icon-angle-left"></i>' ,
			    'next_text' => '<i class="one-icon icon-angle-right"></i>',
			) );
			echo $one_pageily_pagination;
        } else { ?>
			<h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'one-pageily' ); ?></h2>
			<div class="pagination nav-links">
				<?php if ( get_next_posts_link() ) : ?>
					<div class="nav-previous"><?php next_posts_link( '<i class="one-icon icon-angle-left"></i>'.__( ' Older posts', 'one-pageily' ) ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts ', 'one-pageily' ).' <i class="one-icon icon-angle-right"></i>' ); ?></div>
				<?php endif; ?>
			</div>
		<?php } ?>
	</nav><!--End Pagination-->
	<?php
}
endif;

if ( ! function_exists( 'one_pageily_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function one_pageily_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'one-pageily' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'one-pageily' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'one_pageily_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function one_pageily_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( ', ' );
		if ( $categories_list && one_pageily_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'one-pageily' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', ', ');
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'one-pageily' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'one-pageily' ), esc_html__( '1 Comment', 'one-pageily' ), esc_html__( '% Comments', 'one-pageily' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'one-pageily' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function one_pageily_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'one_pageily_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'one_pageily_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so one_pageily_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so one_pageily_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in one_pageily_categorized_blog.
 */
function one_pageily_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'one_pageily_categories' );
}
add_action( 'edit_category', 'one_pageily_category_transient_flusher' );
add_action( 'save_post',     'one_pageily_category_transient_flusher' );

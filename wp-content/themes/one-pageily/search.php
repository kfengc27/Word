<?php
/**
 * The template for displaying search results pages.
 *
 * @package one wpversion
 */

get_header(); ?>
	<div id="page" class="search-area">
		<div class="article">
			<?php if ( have_posts() ) :
				$one_pageily_full_posts = get_theme_mod('one_pageily_full_posts');
				while ( have_posts() ) : the_post();
					one_pageily_archive_post();
				endwhile;
				one_pageily_post_navigation();
			else : ?>
				<div class="single_post clear">
					<article id="content" class="article page">
						<header>
							<h1 class="title"><?php esc_html_e( 'Nothing Found', 'one-pageily' ); ?></h1>
						</header>
						<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'one-pageily' ); ?></p>
						<?php get_search_form(); ?>
					</article>
				</div>
			<?php endif; ?>
		</div><!-- .article -->
		<?php get_sidebar(); ?>
	</div><!-- #primary -->

<?php get_footer(); ?>

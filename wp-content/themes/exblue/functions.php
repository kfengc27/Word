<?php

/**
 * Register stylesheets.
 * Loads parent theme from parent folder before child theme stylesheet.
 */

function exblue_frontscripts() {
	wp_enqueue_style( 'exblue-parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'exblue-style', get_stylesheet_uri(), array( 'exblue-parent-style' ), wp_get_theme()->get('Version') );
}
add_action( 'wp_enqueue_scripts', 'exblue_frontscripts' );

function pagination_bar( $custom_query ) {

    $total_pages = $custom_query->max_num_pages;
    $big = 999999999; // need an unlikely integer

    if ($total_pages > 1){
        $current_page = max(1, get_query_var('paged'));

        echo paginate_links(array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => $current_page,
            'total' => $total_pages,
        ));
    }
}

function pagination($pages = '', $range = 4)
{
$showitems = ($range * 2)+1;
global $paged;
if(empty($paged)) $paged = 1;
if($pages == '')
{
global $wp_query;
$pages = $wp_query->max_num_pages;
if(!$pages)
{
$pages = 1;
}
}
if(1 != $pages)
{
echo '<div class="pagination"><span>Page' . $paged . ' of  ' . $pages . '</span>';
if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo '<a href="' . get_pagenum_link(1) . '"><< First</a>';
if($paged > 1 && $showitems < $pages) echo '<a href="'.get_pagenum_link($paged - 1).'">< Previous</a>';
for ($i=1; $i <= $pages; $i++)
{
if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
{
echo ($paged == $i)? '<span class="current">' . $i . '</span>' : '<a href="' . get_pagenum_link($i) . '" 
class="inactive">' . $i . '</a>';
}
}
if ($paged < $pages && $showitems < $pages) echo '<a href="' . get_pagenum_link($paged + 1) . '">Next ></a>';
if ($paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages) echo '<a href="' . get_pagenum_link($pages) . 
'">Last >></a>';
echo '</div>\n';
}
}
?>


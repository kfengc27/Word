<?php
/**
 * Add Academic modules
 *
 * This is the template that includes all featured modules of Academic
 *
 * @package Theme Palace
 * @subpackage academic
 * @since 0.3
 */

// Add menu
require get_template_directory() . '/inc/modules/menu.php';

// Add top-bar
require get_template_directory() . '/inc/modules/top-bar.php';

// Add slider section
require get_template_directory() . '/inc/modules/slider.php';

// Add about section
require get_template_directory() . '/inc/modules/about.php';

// Add category blog one
require get_template_directory() . '/inc/modules/category-blog-first.php';

// Add category blog two
require get_template_directory() . '/inc/modules/category-blog-second.php';

// Add Upcoming Event
require get_template_directory() . '/inc/modules/upcoming-event.php';

// Add partner
require get_template_directory() . '/inc/modules/partner.php';

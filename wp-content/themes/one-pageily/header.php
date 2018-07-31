<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package one wpversion
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="main-container">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'one-pageily' ); ?></a>
		<header id="site-header" role="banner">
			<div class="primary-navigation header-activated">
				<a href="#" id="pull" class="toggle-mobile-menu"><?php _e('Menu', 'one-pageily'); ?></a>
				<div class="container clear">
					<nav id="navigation" class="primary-navigation mobile-menu-wrapper" role="navigation">
						<?php if (has_custom_logo()) { ?>
						<span id="logo" class="image-logo" itemprop="headline">
							<?php the_custom_logo(); ?>
						</span><!-- END #logo -->
						<?php } else { ?>
						<span class="site-logo" itemprop="headline">
							<a href="<?php echo esc_url(home_url()); ?>"><?php bloginfo( 'name' ); ?></a>
						</span><!-- END #logo -->
						<?php } ?>
						<?php if ( has_nav_menu( 'primary' ) ) { ?>
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'menu clearfix', 'container' => '' ) ); ?>
						<?php } else { ?>
						<ul class="menu clearfix">
							<?php wp_list_categories('title_li='); ?>
						</ul>
						<?php } ?>
					</nav><!-- #site-navigation -->
				</div>
			</div>            

			<div class="container clear">
				<div class="site-branding">
					<div class="site-title">
						<?php bloginfo( 'name' ); ?>
					</div>
					<div class="site-description">
						<?php bloginfo( 'description' ); ?>
					</div>
					<?php if ( get_theme_mod( 'header_right_button_text') ) : ?>
						<div class="buttons-wrapper">
							<?php if (get_theme_mod('header_right_button_text') ) : ?>
								<a href="<?php echo esc_url(get_theme_mod('header_right_button_link')) ?>" class="header-button-solid"><?php echo esc_html(get_theme_mod('header_right_button_text')) ?></a>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</header>
		<?php if ( is_active_sidebar( 'top-widget-first') ||  is_active_sidebar( 'top-widget-second') ||  is_active_sidebar( 'top-widget-third')  ) : ?>
			<div class="container">
				<div class="upper-widgets-grid-wrapper">
					<?php if ( is_active_sidebar( 'top-widget-first' ) ) : ?>
						<div class="upper-widgets-grid">
							<div class="top-column-widget">
								<?php dynamic_sidebar( 'top-widget-first' ); ?> 
							</div>
						</div>
					<?php endif; ?>
					<?php if ( is_active_sidebar( 'top-widget-second' ) ) : ?>
						<div class="upper-widgets-grid"> 
							<div class="top-column-widget">
								<?php dynamic_sidebar( 'top-widget-second' ); ?> 
							</div> 
						</div>
					<?php endif; ?>
					<?php if ( is_active_sidebar( 'top-widget-third' ) ) : ?>
						<div class="upper-widgets-grid">
							<div class="top-column-widget">
								<?php dynamic_sidebar( 'top-widget-third' ); ?> 
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
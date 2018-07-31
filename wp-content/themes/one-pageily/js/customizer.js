/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

 ( function( $ ) {
 	wp.customize( 'header_text_color', function( value ) {
 		value.bind( function( to ) {
 			$( '.site-branding .site-title, .site-branding .site-description, .site-title' ).css( {
 				'color':to
 			});
 		} );
 	} );
 	wp.customize( 'top_header_background_color', function( value ) {
 		value.bind( function( to ) {
 			$( '#site-header' ).css( {
 				'background-color':to
 			});
 		} );
 	} );
 	wp.customize( 'navigation_frontpage_link_color', function( value ) {
 		value.bind( function( to ) {
 			$( '.primary-navigation.header-activated #navigation a' ).css( {
 				'color':to
 			});
 		} );
 	} );

 	wp.customize( 'navigation_link_color', function( value ) {
 		value.bind( function( to ) {
 			$( 'a#pull, #navigation .menu a, #navigation .menu a:hover, #navigation .menu .fa > a, #navigation .menu .fa > a, #navigation .toggle-caret, #navigation span.site-logo a, #navigation.mobile-menu-wrapper .site-logo a, .primary-navigation.header-activated #navigation ul ul li a' ).css( {
 				'color':to
 			});
 		} );
 	} );

 	wp.customize( 'header_right_button_text_color', function( value ) {
 		value.bind( function( to ) {
 			$( '.header-button-solid, .header-button-solid:hover, .header-button-solid:active, .header-button-solid:focus' ).css( {
 				'color':to
 			});
 		} );
 	} );
 	wp.customize( 'header_right_button_bg', function( value ) {
 		value.bind( function( to ) {
 			$( '.header-button-solid, .header-button-solid:hover, .header-button-solid:active, .header-button-solid:focus' ).css( {
 				'background':to
 			});
 		} );
 	} );
 	wp.customize( 'header_left_button_text_color', function( value ) {
 		value.bind( function( to ) {
 			$( '.header-button-border, .header-button-border:hover, .header-button-border:active, .header-button-border:focus' ).css( {
 				'color':to
 			});
 		} );
 	} );
 	wp.customize( 'header_left_button_bg', function( value ) {
 		value.bind( function( to ) {
 			$( '.header-button-border, .header-button-border:hover, .header-button-border:active, .header-button-border:focus' ).css( {
 				'border-color':to
 			});
 		} );
 	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-branding .site-title, .site-branding .site-description, .site-title' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-branding .site-title, .site-branding .site-description, .site-title' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-branding .site-title, .site-branding .site-description, .site-title' ).css( {
					'color': to
				} );
			}
		} );
	} );
} )( jQuery );

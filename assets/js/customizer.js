/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// footer background colro 
	wp.customize( 'spiderprime_footer_area_background_color', function( value ) {
        value.bind( function( to ) {
            $('.quick-contact').css('background', + to );
        } );
    } );
    
	wp.customize( 'spiderprime_footer_buttom_area_background_color', function( value ) {
	    value.bind( function( to ) {
	        $('.copyright').css('background', + to );
	    } );
    } );
    
    
    // Breadcrumbs Settings
    
    wp.customize("spiderprime_breadcrumbs_background_color", function(value) {
        value.bind(function(to) {
            $(".about-banner").css('background', + to );
        } );
    });
    
    wp.customize( 'spiderprime_breadcrumbs_bg_image', function( value ) {
	    value.bind( function( to ) {
	    	$('.about-banner').css('background-image', 'url(' + to + ')' );
	    } );
    } );
    
    

} )( jQuery );

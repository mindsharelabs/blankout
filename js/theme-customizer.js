/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {

	// Update the site title in real time...
	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '#logo' ).html( newval );
		} );
	} );

	wp.customize( 'blankout_options[menu_title]', function( value ) {
		value.bind( function( newval ) {
			if( newval == false) {
				$('.brand').css('display', 'none' );
			} else {
				$('.brand').css('display', 'block' );
			}
		} );
	} );
	
	wp.customize( 'blankout_options[menu_search]', function( value ) {
		value.bind( function( newval ) {
			if( newval == false) {
				$('.navbar-search').css('display', 'none' );
			} else {
				$('.navbar-search').css('display', 'block' );
			}
		} );
	} );
	

	//Update site background color...
	wp.customize( 'background_color', function( value ) {
		value.bind( function( newval ) {
			$('body').css('background-color', newval );
		} );
	} );
	
	//Update link color in real time...
	wp.customize( 'blankout_options[link_textcolor]', function( value ) {
		value.bind( function( newval ) {
			$('#main a').css('color', newval );
		} );
	} );
	
} )( jQuery );

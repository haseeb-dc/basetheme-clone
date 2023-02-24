/**
 * Sticky Header
 * Adds a class to header on scroll
 */

jQuery( document ).on( 'scroll', function() {
	if ( jQuery( document ).scrollTop() > 0 ) {
		jQuery( 'header, body' ).addClass( 'shrink' );
	} else {
		jQuery( 'header, body' ).removeClass( 'shrink' );
	// var $header_height = jQuery("header").outerHeight();
		// 	jQuery("body").css('padding-top', $header_height+'px');
	}
} );
// var offsetheight = ;

/**
 * Document Ready Function
 * Triggered when document get's ready
 */
//  document.all.body.style.paddingBottom="189px";
jQuery( document ).ready( function( jQuery ) {

	if (navigator.userAgent.indexOf('Mac OS X') != -1) {
		jQuery("body").addClass("style-for-apple");
	} else {
		jQuery("body").addClass("style-for-window");
	}
	/**
	 * Toggle menu for mobile
	 */
	// accessible sub menu
	jQuery( '.menu-item-has-children > a' ).focus( function() {
		jQuery( this ).siblings( '.sub-menu' ).addClass( 'focused' );
	  } ).blur( function() {
		jQuery( this ).siblings( '.sub-menu' ).removeClass( 'focused' );
	  } );

	jQuery( '.menu-btn' ).click( function() {
		jQuery( this ).toggleClass( 'active' );
		jQuery( '.nav-overlay' ).toggleClass( 'open' );
		jQuery( 'html, body' ).toggleClass( 'no-overflow' );
		jQuery( '.header-nav ul li.active' ).removeClass( 'active' );
		jQuery( '.header-nav ul.sub-menu' ).slideUp();
	} );
	jQuery.noConflict();

	/**
	 * Add span tag to multi-level accordion menu for mobile menus
	 */
	jQuery( 'li' ).each( function() {
		if ( jQuery( this ).hasClass( 'menu-item-has-children' ) ) {
			jQuery( this )
				.find( 'a:first' )
				.after( '<span class="submenu-icon"></span>' );
		}
	} );
	/**
	 * Slide Up/Down internal sub-menu when mobile menu arrow clicked
	 */
	jQuery( '.header-nav .submenu-icon' ).click( function() {
		const link = jQuery( this );
		const closestUl = link.closest( 'ul' );
		const parallelActiveLinks = closestUl.find( '.active' );
		const closestLi = link.closest( 'li' );
		const linkStatus = closestLi.hasClass( 'active' );
		let count = 0;

		closestUl.find( 'ul' ).slideUp( function() {
			if ( ++count === closestUl.find( 'ul' ).length ) {
				parallelActiveLinks.removeClass( 'active' );
			}
		} );

		if ( ! linkStatus ) {
			closestLi.children( 'ul' ).slideDown();
			closestLi.addClass( 'active' );
		}
	} );
} );
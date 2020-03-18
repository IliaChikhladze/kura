// Live Preview

(function( $ ) {

/*
** Header Colors
*/

	// Header Bg 
	infinityLivePreview('header_color_bg', function(val){
		var css = '\
		.header-center {\
			background-color: '+ val +';\
		}\
		';
		infinityStyle('header_color_bg', css);
	});

	// Title 
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( val ) {
			$( '.site-title' ).css( 'color', val );
		});
	});

	// Title Hover
	infinityLivePreview('header_color_text_hv', function(val){
		var css = '\
		.site-title:hover {\
			color: '+ val +';\
		}\
		';
		infinityStyle('header_color_text_hv', css);
	});

	// Tagline
	infinityLivePreview('header_color_tagline', function(val){
		var css = '\
		.site-description {\
			color: '+ val +';\
		}\
		';
		infinityStyle('header_color_tagline', css);
	});

	// Social
	infinityLivePreview('header_color_social', function(val){
		var css = '\
		.header-center-social a {\
			color: '+ val +';\
		}\
		';
		infinityStyle('header_color_social', css);
	});


/*
** General Colors
*/

	// Accent
	infinityLivePreview('general_color_accent', function(val){
		var css = '\
		.carousel-pagination .active span {\
		    background-color:'+ val +';\
		    color:'+ val +';\
		}\
		blockquote {\
		    border-color: '+ val +';\
		}\
		.meta-categories,\
		.infinity-widget ul li > a:hover,\
		.infinity-widget ul li span a:hover,\
		a,\
		.entry-content a:hover,\
		.infinity-breadcrumbs a:hover,\
		.comment-author a:hover,\
		.meta-author-date a,\
		.meta-tags a:hover,\
		.page-links a,\
		.infinity-breadcrumbs,\
		.related-posts section h4 a:hover,\
		.post-pagination h4:hover,\
		.author-social a:hover,\
		.featured-item a:hover,\
		.copyright a:hover {\
		    color:'+ val +';\
		}\
		.ps-container > .ps-scrollbar-y-rail > .ps-scrollbar-y,\
		.search-title:after,\
		.entry-content > *[class^="wp-block-"].is-style-solid-color {\
	   		background-color:'+ val +' !important;\
		}\
		.top-nav > ul > li > a:hover,\
		.header-top-social a:hover,\
		.top-nav > ul > li.current-menu-item > a,\
		.top-nav > ul > li.current-menu-ancestor > a {\
		    color: '+ val +';\
		}\
		.top-nav > ul > li.current-menu-item > a.menu-btn,\
		.top-nav > ul > li.current-menu-ancestor > a .menu-btn {\
		    background-color: '+ val +';\
		}\
		.top-nav > ul > li > a:hover .menu-btn,\
		.top-nav > ul > li > a:hover .menu-btn:before,\
		.top-nav > ul > li > a:hover .menu-btn:after,\
		.sidebar-btn:hover span:before,\
		.sidebar-btn:hover span:after,\
		.cart-btn-count {\
		    background-color: '+ val +';\
		}\
		.site-nav > ul > li > a:hover,\
		.site-nav-mobile li a:hover,\
		.nav-btn:hover,\
		.site-nav li.current-menu-item > a,\
		.site-nav li.current-menu-ancestor > a,\
		.random-btn:hover,\
		.search-btn:hover {\
		    color: '+ val +';\
		}\
		.site-nav .sub-menu > li > a:hover,\
		.site-nav .sub-menu > li.current-menu-item > a,\
		.site-nav .sub-menu > li.current-menu-ancestor > a  {\
		    color: '+ val +';\
		    background-color: #f8f8f8;\
		}\
		.site-nav .sub-menu {\
		    border-color: '+ val +';\
		}\
		.site-nav .sub-menu > li > a:hover:before {\
		    border-color: transparent transparent transparent '+ val +';\
		}\
		#s:focus + .submit,\
		#wp-calendar tbody td a:hover,\
		.tagcloud a:hover,\
		.submit:hover,\
		.wpcf7 [type="submit"]:hover,\
		.reply a:hover,\
		.post-password-form input[type="submit"]:hover,\
		.infinity-widget input[type="submit"]:hover,\
		.infinity-button:hover,\
		.entry-content .wp-block-button__link:hover {\
			color: #ffffff;\
			background-color: '+ val +';\
		}\
		#wp-calendar tfoot #prev a:hover,\
		#wp-calendar tfoot #next a:hover {\
			color: '+ val +';\
		}\
		.footer-widgets a:hover,\
		.footer-widgets ul li > a:hover,\
		.footer-widgets ul li span a:hover {\
			color: '+ val +';\
		}\
		.footer-social a:hover {\
			color: #ffffff;\
			background-color: '+ val +';\
		}\
		.backtotop {\
			color: '+ val +';\
		}\
		.backtotop:hover {\
			color: #ffffff;\
		}\
		.infinity-preloader {\
		     background-color: #ffffff;\
		}\
		.entry-content .read-more a:hover,\
		.infinity-pagination a:hover,\
		.numbered-current {\
			background-color: '+ val +';\
			border-color: '+ val +';\
			color: #ffffff;\
		}\
		.woocommerce nav.woocommerce-pagination ul li a:focus,\
		.woocommerce nav.woocommerce-pagination ul li a:hover,\
		.woocommerce nav.woocommerce-pagination ul li span.current {\
			background-color: '+ val +';\
			border-color: '+ val +';\
			color: #ffffff;\
		}\
		p.demo_store,\
		.woocommerce-store-notice,\
		.woocommerce span.onsale {\
		   background-color: '+ val +';\
		}\
		.woocommerce .star-rating::before,\
		.woocommerce .star-rating span::before,\
		.woocommerce ul.products li.product .button,\
		.woocommerce-MyAccount-navigation-link.is-active a,\
		.woocommerce-MyAccount-navigation-link a:hover {\
		   color: '+ val +';\
		}\
		.woocommerce input.button:hover,\
		.woocommerce a.button:hover,\
		.woocommerce a.button.alt:hover,\
		.woocommerce button.button.alt:hover,\
		.woocommerce input.button.alt:hover,\
		.woocommerce #respond input#submit.alt:hover,\
		.woocommerce .woocommerce-message .button:hover,\
		.woocommerce a.button.alt:hover,\
		.woocommerce button.button.alt.disabled:hover,\
		.woocommerce button.button.alt:hover,\
		.woocommerce #respond input#submit:hover,\
		.woocommerce .widget_price_filter .button:hover,\
		.woocommerce .woocommerce-message .button:hover,\
		.woocommerce-page .woocommerce-message .button:hover {\
		    color: #ffffff;\
		    background-color: '+ val +';\
		}\
		';
		infinityStyle('general_color_accent', css);
	});


/*
** Header Seciton
*/

	// Site Title 
	wp.customize( 'blogname', function( value ) {
		value.bind( function( val ) {
			$( '.site-title' ).text( val );
		} );
	} );

	// Site Tagline
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( val ) {
			$( '.site-description' ).text( val );
		} );
	} );


	// Logo Width
	infinityLivePreview('header_logo_width', function(val){
		var css = '\
		.site-logo {\
			max-width:'+ val +'px;\
		}\
		';
		infinityStyle('header_logo_width', css);
	});

	// Logo Top Distance
	infinityLivePreview('header_logo_top_magin', function(val){
		var css = '\
		.header-center {\
			padding-top:'+ val +'px;\
		}\
		';
		infinityStyle('header_logo_top_magin', css);
	});


/*
** Sidebar Section
*/

	// Sidebar Width
	infinityLivePreview('general_sidebar_width', function(val){
		var css = '\
		.main-sidebar {\
	    	width:'+ val +'px;\
		}\
		';
		infinityStyle('general_sidebar_width', css);
	});


/*
** Blog Posts Section
*/

	// Read More 
	wp.customize( 'infinity_options[blog_post_read_more_text]', function( value ) {
		value.bind( function( val ) {
			if (val ==='') {
				$( '.read-more a' ).hide();
			} else {
				$( '.read-more a' ).show().text( val );
			}
		} );
	} );

	if ($( '.read-more a' ).text() === '' ) {
		$( '.read-more a' ).hide();
	}



/*
** Functions
*/

	// Bind Function 
	function infinityLivePreview( option, bindFunc ) {
		wp.customize( 'infinity_options['+ option +']', function( value ) {
			value.bind( function( val ) {
				bindFunc( val );
			} );
		} );
	}

	// Conver Hex Color to RGBA
	function infinityHex2rgba(hex,opacity){

		if ( typeof(hex) === 'undefined' ) {
			return;
		}

		hex = hex.replace('#','');
		var r = parseInt(hex.substring(0, hex.length/3), 16);
		var g = parseInt(hex.substring(hex.length/3, 2*hex.length/3), 16);
		var b = parseInt(hex.substring(2*hex.length/3, 3*hex.length/3), 16);

		var result = 'rgba('+r+','+g+','+b+','+ opacity +')';
		return result;
	}

	// Add Live Style
	function infinityStyle( id, css ) {
		if ( $( '#'+ id ).length === 0 ) {
			$('head').append('<style id="'+ id +'"></style>')
		}
		$( '#'+ id ).text( css );
	}

} )( jQuery );
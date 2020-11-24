<?php
function infinity_dynamic_css() {

// Add Dynamic Style
$css = '<style>';

/**
 * ----------------------------------------------------------------------------------------
 * General Section
 * ----------------------------------------------------------------------------------------
 */

	// Site Width  -1
	$css .= '.center-width {
		max-width: 1220px;
	}';

	// Content Padding -1 
	$css .= '
		.main-container-outer {
			padding: 40px;		        
		}
		
		.header-top > div,
		.header-bottom > div,
		.footer-wrap .center-width,
		.infinity-carousel-wrap.center-width,
		.infinity-promo-box-area,
		.infinity-breadcrumbs > div {
			padding-left: 40px;
			padding-right: 40px;
		}

		.infinity-carousel-wrap.center-width {
			padding-top: 40px;
		}
	';




/**
 * ----------------------------------------------------------------------------------------
 * Header Section
 * ----------------------------------------------------------------------------------------
 */

	// Header Height -1
	$css .= '.header-center {
		height: 300px;
    	background-size: cover;
	}';

	// Hide Site Title
	if ( ! display_header_text() || has_custom_logo() ) {
		$css .= '.site-title {
			display: none;
		}';
	}

	// Hide Site Tagline
	if ( true !== infinity_options('header_tagline') ) {
		$css .= '.site-description {
			display: none;
		}';
	}

	// Logo Width
	$css .= '.site-logo {
		max-width:'. infinity_options('header_logo_width') .'px;
	}';

	// Logo Top Distance
	$css .= '.header-center {
		padding-top:'. infinity_options('header_logo_top_magin') .'px;
	}';

	// Logo Responsive Top and Bottom Margin
	$css .= '@media screen and ( max-width: 480px ) {
		.header-center {
			padding:'. infinity_options('header_logo_top_magin') .'px 0;
			height: auto;
		}	
	}';

	// Header Image Background URL
	$css .= '.header-center {
		background-image: url('. get_header_image() .');
	}';

	// Header Image Cover
	if ( infinity_options('header_bg_size') === 'cover' ) {
		$css .= '.header-center {
			background-position: center center;
		}';
	}

	// Top Bar Align
	if ( true === infinity_options('header_top_alt_sidebar') ) {
		if ( infinity_options('header_top_align') === 'left' ) {
			$css .= '
			.sidebar-btn {
				float: right;
			}

			.top-nav {
				float: left;
			}
			
			.header-top-social {
				position: absolute;
				top: 0;
				left: 50%;
				transform: translateX(-50%);
				-webkit-transform: translateX(-50%);
			}

			@media screen and ( max-width: 979px ) {
				.header-top-social {
					position: static;
					float: left;
					transform: none;
					-webkit-transform: none;
				}
			}

			';

		} else {
			$css .= '
			.sidebar-btn {
				float: left;
			}

			.top-nav {
				float: right;
			}
			
			.header-top-social {
				position: absolute;
				top: 0;
				left: 50%;
				transform: translateX(-50%);
				-webkit-transform: translateX(-50%);
			}

			';
		}
	} elseif ( true === infinity_options('header_top_social') ) {
		if ( infinity_options('header_top_align') === 'left' ) {
			$css .= '
			.header-top-social {
				float: right;
			}

			.top-nav {
				float: left;
			}';

		} else {
			$css .= '
			.header-top-social {
				float: left;
			}

			.top-nav {
				float: right;
			}';
		}
	} else {
		$css .= '
		.top-nav {
		    display: inline-block;
		}';
	}



	// Navigation Align
		$css .= '
		';


	if ( 'center' === infinity_options('header_nav_align') ) {
		$css .= '

		.nav-left-controls {
			position: absolute;
			top: 0;
			left: 40px;
		}
		
		.nav-right-controls {
			position: absolute;
			top: 0;
			right: 40px;
		}

		.site-nav {
			text-align: center;
		}
		';

	} elseif ( 'left' === infinity_options('header_nav_align') ) {
		$css .= '
		.nav-left-controls,
		.site-nav {
			float: left;
		}
	
		.nav-right-controls {
			float: right;
		}';

	} else {
		$css .= '
		.nav-left-controls {
			float: left;
		}
	
		.nav-right-controls,
		.site-nav {
			float: right;
		}';
	}


/**
 * ----------------------------------------------------------------------------------------
 * Carousel Section
 * ----------------------------------------------------------------------------------------
 */

	// Height
	$css .= '.carousel-item {
		height: 600px;
	}';

	// Carosuel Next/Prev Button Effect
	if ( infinity_options('carousel_navigation') === 'on_hover' ) {
		$css .= '.infinity-carousel .carousel-prev {
		    left: -60px;
		}';

		$css .= '.infinity-carousel .carousel-next {
		    right: -60px;
		}';
	} 

	// Carosuel Page
	if ( infinity_options('general_carousel_style') === 'inner_content' || infinity_options('general_carousel_style') === 'inner_grid' ) {
		$css .= '.infinity-carousel-wrap {
		    margin-bottom: 40px;
		}';
	} 


/**
 * ----------------------------------------------------------------------------------------
 * Promo Box Section
 * ----------------------------------------------------------------------------------------
 */

	// Height
	$css .= '.infinity-promo-box {
		height: 220px;
	}';

	// Columns
	$promo_box_grid = '';
	$promo_box_columns = (int)infinity_options('promo_box_columns');
	
	for ($i=0; $i < $promo_box_columns; $i++) { 
		$promo_box_grid .= '1fr ';
	}

	$css .= '.infinity-promo-box-area {
		grid-template-columns: '.esc_attr($promo_box_grid) .';
	}';

	// Gutter
	$css .= '.infinity-promo-box-area {
		grid-gap: 30px 30px;
	}';

	$css .= '.infinity-carousel-wrap ~ .infinity-promo-box-area {
		padding-top: 30px;
	}';

	// Show Border
	if ( infinity_options('promo_box_show_border') === true ) {
		$css .= '.infinity-promo-box-overlay {
			border: 1px solid rgba(255,255,255, 0.8);
		}';
	}
	

/**
 * ----------------------------------------------------------------------------------------
 * Content Section
 * ----------------------------------------------------------------------------------------
 */

	if ( is_single() ) {
		$css .= '.entry-content {
			margin-bottom: 10px;   
		}';
	}

	// Home Pagination 
	if ( infinity_options('blog_post_pagination') === 'expand-numbered' ) {
		
		$css .= '.default-next,
				.default-previous {
		    position: absolute;
		    top: 0;
		}

		.default-previous {
		    left: 0;
		}

		.default-next {
		    right: 0;
		}';
	}

	// Post Drop Caps
	if ( infinity_options('blog_post_dropcap') && !is_single() && !is_page() ) {
		$css .= '.post .entry-content > p:first-child:first-letter,
		.has-drop-cap:not(:focus):first-letter {
			font-family: "Playfair Display";
		    float:left;
		    font-size: 76px;
		    line-height: 63px;
		    text-align: center;
		    margin: 0px 10px 0 0;
		    text-transform: uppercase;
		    font-style: normal;
		}';

		$css .= '@-moz-document url-prefix() {
			.post .entry-content > p:first-child:first-letter,
			.has-drop-cap:not(:focus):first-letter {
			    margin-top: 10px !important;
			}
		}';
	}

	// Single Post Drop Caps
	if ( infinity_options('single_post_dropcap') && ( is_single() || is_page() ) ) {
		$css .= '.post .entry-content > p:first-child:first-letter,
		.has-drop-cap:not(:focus):first-letter {
			font-family: "Playfair Display";
		    float:left;
		    font-size: 76px;
		    line-height: 63px;
		    text-align: center;
		    margin: 0px 10px 0 0;
		    text-transform: uppercase;
		    font-style: normal;
		}';

		$css .= '@-moz-document url-prefix() {
			.post .entry-content > p:first-child:first-letter,
			.has-drop-cap:not(:focus):first-letter{
			    margin-top: 10px !important;
			}
		}';
	}




	//  - 1
	$css .= '.main-post {
		margin-bottom: 40px;		        
	}';

	$css .= '.infinity-pagination {
		margin-top: 40px;		        
	}';

	$css .= '.entry-header,
			.entry-content {
		overflow: hidden;       
	}';

	$css .= '.entry-content {
		text-align: justify;   
	}';

	$css .= '.list .entry-media {
		float: left;
		width:300px;
		margin-right: 35px;
		margin-bottom: 40px;	        
	}';
	$css .= '.list .entry-media ~ .entry-footer {
		padding-left: -calc(300px + 35px);  
		padding-left: -webkit-calc(300px + 35px);
		clear: both;     
	}';

	// Sidebar Gutter

	$css .= '[data-sidebar*="rsidebar"] .main-sidebar {
		padding-left: 35px;
	}';

	$css .= '[data-sidebar*="lsidebar"] .main-sidebar {
		padding-right: 35px;
	}
	';

	// Two Column Layout
	$css .= ' .col2 {
		width: calc((100% - 35px ) /2);
		width: -webkit-calc((100% - 35px ) /2);
		margin-right: 35px;
	}';

	$css .= '.infinity-grid .col2:nth-of-type(2n+2) {
		margin-right: 0;
	}';

	$css .= '.infinity-grid .col2:nth-last-child(-n+2) .main-post {
		margin-bottom: 0;
	}';

	$css .= '.main-sidebar .infinity-widget,
			.fixed-sidebar .infinity-widget {
		margin-bottom: 40px;
		overflow: hidden;
	}';


/**
 * ----------------------------------------------------------------------------------------
 * Sidebar section
 * ----------------------------------------------------------------------------------------
 */

	// Sidebar Width
	$css .= '.main-sidebar {
	    width: '. infinity_options('general_sidebar_width') .'px; 
	}';

	$css .= '.fixed-sidebar {
	    width: '. infinity_options('general_sidebar_width') .'px;
	    right: -'. infinity_options('general_sidebar_width') .'px; 
	}';

	$css .= '[data-sidebar="lsidebar"] .main-container,
			[data-sidebar="rsidebar"] .main-container {
		width: calc(100% - '. infinity_options('general_sidebar_width') .'px);
		width: -webkit-calc(100% - '. infinity_options('general_sidebar_width') .'px);
	}';	


	$css .= '.main-container {
	    width: 100%;
	}';

/**
 * ----------------------------------------------------------------------------------------
 *  Preloader section
 * ----------------------------------------------------------------------------------------
 */

	if ( 'loader_1' === infinity_options('general_preloader') ) {
		$css .= '.infinity-load-spinner{width:40px;height:40px;background-color:#333;margin:0 auto;-webkit-animation:infinity-rotateplane 1.2s infinite ease-in-out;animation:infinity-rotateplane 1.2s infinite ease-in-out}@-webkit-keyframes infinity-rotateplane{0%{-webkit-transform:perspective(120px)}50%{-webkit-transform:perspective(120px) rotateY(180deg)}100%{-webkit-transform:perspective(120px) rotateY(180deg) rotateX(180deg)}}@keyframes infinity-rotateplane{0%{transform:perspective(120px) rotateX(0) rotateY(0);-webkit-transform:perspective(120px) rotateX(0) rotateY(0)}50%{transform:perspective(120px) rotateX(-180.1deg) rotateY(0);-webkit-transform:perspective(120px) rotateX(-180.1deg) rotateY(0)}100%{transform:perspective(120px) rotateX(-180deg) rotateY(-179.9deg);-webkit-transform:perspective(120px) rotateX(-180deg) rotateY(-179.9deg)}}';
	}



/**
 * ----------------------------------------------------------------------------------------
 * Footer Section
 * ----------------------------------------------------------------------------------------
 */

	if ( infinity_options('footer_column') === 'three' ) {
		$css .= '.footer-widgets .infinity-widget {
			margin-right: 5%;
			-webkit-flex-basis: 30%;
			flex-basis: 30%;
		}

		.footer-widgets > div > div:nth-of-type(3n) {
			margin-right: 0;
		}';
	}

	if ( infinity_options('footer_column') === 'four' ) {
		$css .= '.footer-widgets .infinity-widget {
			margin-right: 4%;
			-webkit-flex-basis: 22%;
			flex-basis: 22%;
		}

		.footer-widgets > div > div:nth-of-type(4n) {
			margin-right: 0;
		}';
	}


/**
 * ----------------------------------------------------------------------------------------
 * Header Color
 * ----------------------------------------------------------------------------------------
 */

	// Background Color
	$css .= '.header-center {
		background-color: '. infinity_options( 'header_color_bg' ) .';
	}';

	// Text Color
	$header_color = get_header_textcolor();

	$css .= '.site-title {
		color: #'. esc_attr( $header_color ) .';
	}';	
		
	// Text Hover Color
	$css .= '.site-title:hover {
		color: '. infinity_options( 'header_color_text_hv' ) .';
	}';

	// Tagline Color
	$css .= '.site-description {
		color: '. infinity_options( 'header_color_tagline' ) .';
	}';

	// Social Color
	$css .= '.header-center-social a {
		color: '. infinity_options( 'header_color_social' ) .';
	}';


/**
 * ----------------------------------------------------------------------------------------
 * General Color
 * ----------------------------------------------------------------------------------------
 */

	// Overlay Hover Color
	$css .= '.carousel-pagination .active span {
	    background-color:'. infinity_options('general_color_accent') .';
	    color:'. infinity_options('general_color_accent') .';
	}';


	// Accent Color
	$css .= 'blockquote {
	    border-color: '. infinity_options('general_color_accent') .';
	}';

	// Accent Color
	$css .= '.meta-categories,
			.infinity-widget ul li > a:hover,
			.infinity-widget ul li span a:hover,
			a,
			.entry-content a:hover,
			.infinity-breadcrumbs a:hover,
			.comment-author a:hover,
			.meta-author-date a,
			.meta-tags a:hover,
			.page-links a,
			.infinity-breadcrumbs,
			.related-posts section h4 a:hover,
			.post-pagination h4:hover,
			.author-social a:hover,
			.featured-item a:hover,
			.copyright a:hover {
	    color:'. infinity_options('general_color_accent') .';
	}';

	// Accent Color
	$css .= '
		.ps-container > .ps-scrollbar-y-rail > .ps-scrollbar-y,
		.search-title:after,
		.entry-content > *[class^="wp-block-"].is-style-solid-color {
	   		background-color:'. infinity_options('general_color_accent') .' !important;
		}

		.top-nav > ul > li > a:hover,
		.header-top-social a:hover,
		.top-nav > ul > li.current-menu-item > a,
		.top-nav > ul > li.current-menu-ancestor > a {
		    color: '. infinity_options('general_color_accent') .';
		}

		.top-nav > ul > li.current-menu-item > a.menu-btn,
		.top-nav > ul > li.current-menu-ancestor > a .menu-btn {
		    background-color: '. infinity_options('general_color_accent') .';
		}

		.top-nav > ul > li > a:hover .menu-btn,
		.top-nav > ul > li > a:hover .menu-btn:before,
		.top-nav > ul > li > a:hover .menu-btn:after,
		.sidebar-btn:hover span:before,
		.sidebar-btn:hover span:after,
		.cart-btn-count {
		    background-color: '. infinity_options('general_color_accent') .';
		}

		.site-nav > ul > li > a:hover,
		.site-nav-mobile li a:hover,
		.nav-btn:hover,
		.site-nav li.current-menu-item > a,
		.site-nav li.current-menu-ancestor > a,
		.random-btn:hover,
		.search-btn:hover {
		    color: '. infinity_options('general_color_accent') .';
		}

		.site-nav .sub-menu > li > a:hover,
		.site-nav .sub-menu > li.current-menu-item > a,
		.site-nav .sub-menu > li.current-menu-ancestor > a  {
		    color: '. infinity_options('general_color_accent') .';
		    background-color: #f8f8f8;
		}

		.site-nav .sub-menu {
		    border-color: '. infinity_options('general_color_accent') .';
		}

		.site-nav .sub-menu > li > a:hover:before {
		    border-color: transparent transparent transparent '. infinity_options('general_color_accent') .';
		}

		#s:focus + .submit,
		#wp-calendar tbody td a:hover,
		.tagcloud a:hover,
		.submit:hover,
		.wpcf7 [type="submit"]:hover,
		.reply a:hover,
		.post-password-form input[type="submit"]:hover,
		.infinity-widget input[type="submit"]:hover,
		.infinity-button:hover,
		.entry-content .wp-block-button__link:hover {
			color: #ffffff;
			background-color: '. infinity_options('general_color_accent') .';
		}

		#wp-calendar tfoot #prev a:hover,
		#wp-calendar tfoot #next a:hover {
			color: '. infinity_options('general_color_accent') .';
		}

		.footer-widgets a:hover,
		.footer-widgets ul li > a:hover,
		.footer-widgets ul li span a:hover {
			color: '. infinity_options('general_color_accent') .';
		}

		.footer-social a:hover {
			color: #ffffff;
			background-color: '. infinity_options('general_color_accent') .';
		}

		.backtotop {
			color: '. infinity_options('general_color_accent') .';
		}

		.backtotop:hover {
			color: #ffffff;
		}
	';

	// Preloader Background Color - 1
	$css .= '.infinity-preloader {
	     background-color: #ffffff;
	}';



	/* Read More & Pagination Hover Colors */
	$css .='
	.entry-content .read-more a:hover,
	.infinity-pagination a:hover,
	.numbered-current {
		background-color: '. infinity_options('general_color_accent') .';
		border-color: '. infinity_options('general_color_accent') .';
		color: #ffffff;
	}

	.woocommerce nav.woocommerce-pagination ul li a:focus,
	.woocommerce nav.woocommerce-pagination ul li a:hover,
	.woocommerce nav.woocommerce-pagination ul li span.current {
		background-color: '. infinity_options('general_color_accent') .';
		border-color: '. infinity_options('general_color_accent') .';
		color: #ffffff;
	}';


	/* Accent - Woocommerce */
	$css .='
	p.demo_store,
	.woocommerce-store-notice,
	.woocommerce span.onsale {
	   background-color: '. infinity_options('general_color_accent') .';
	}

	.woocommerce .star-rating::before,
	.woocommerce .star-rating span::before,
	.woocommerce ul.products li.product .button,
	.woocommerce-MyAccount-navigation-link.is-active a,
	.woocommerce-MyAccount-navigation-link a:hover {
	   color: '. infinity_options('general_color_accent') .';
	}

	.woocommerce input.button:hover,
	.woocommerce a.button:hover,
	.woocommerce a.button.alt:hover,
	.woocommerce button.button.alt:hover,
	.woocommerce input.button.alt:hover,
	.woocommerce #respond input#submit.alt:hover,
	.woocommerce .woocommerce-message .button:hover,
	.woocommerce a.button.alt:hover,
	.woocommerce button.button.alt.disabled:hover,
	.woocommerce button.button.alt:hover,
	.woocommerce #respond input#submit:hover,
	.woocommerce .widget_price_filter .button:hover,
	.woocommerce .woocommerce-message .button:hover,
	.woocommerce-page .woocommerce-message .button:hover {
	    color: #ffffff;
	    background-color: '. infinity_options('general_color_accent') .';
	}';



/**
 * ----------------------------------------------------------------------------------------
 * Header Typography
 * ----------------------------------------------------------------------------------------
 */

	// Typography Functions
	function infinity_typography_increase( $control, $value ) {
		return infinity_options($control) + $value;
	} 

	function infinity_typography_decrease( $control, $value ) {
		
		$result = infinity_options($control) - $value;
		if ( 0 > $result ) {
			$result = 0;
		}

		return $result;
	} 

	// Site Title
	$css .= "
		.site-title {
			font-family: 'Playfair Display';
			font-size: ". infinity_options( 'header_typography_title_size' ) ."px;
			line-height: ". infinity_options( 'header_typography_title_height' ) .";
			letter-spacing: ". infinity_options( 'header_typography_title_spacing' ) ."px;
			font-weight: ". infinity_options( 'header_typography_title_weight' ) .";
		}
	";

	if ( true === infinity_options( 'header_typography_title_style' ) ) {
		$css .= "
			.site-title {
				font-style: italic;
			}
		";
	}

	if ( true === infinity_options( 'header_typography_title_transform' ) ) {
		$css .= "
			.site-title {
				text-transform: uppercase;
			}
		";
	}



/**
 * ----------------------------------------------------------------------------------------
 * Responsive CSS
 * ----------------------------------------------------------------------------------------
 */

	if ( '' !== infinity_options('header_nav_logo') ) {
		$css .= '@media screen and ( max-width: 979px ) {
			.nav-left-controls {
				left: 50%;
				-webkit-transform: translateX(-50%);
				transform: translateX(-50%);
			}	
		}';

	} else {
		$css .= '@media screen and ( max-width: 979px ) {
			.nav-left-controls {
				left: 66px;
			}	
		}';
	}


$css .= '</style>';

echo '' . $css;

}

add_action( 'wp_head', 'infinity_dynamic_css' );

?>
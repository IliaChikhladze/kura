// Customizer UI javaScript

jQuery(document).ready(function( $ ) {

	"use strict";

	// Tabs Title
	function infinityTabsTitle( id, title ) {
		$( '#customize-control-infinity_options-'+id ).prepend('<h3 class="infinity-options-tab-title">'+title+'</h3>');
	}

	infinityTabsTitle( 'general_full_post', 'Page Layouts' );
	infinityTabsTitle( 'general_header_style', 'Section Style' );
	infinityTabsTitle( 'header_top_bar', 'Top Bar' );
	infinityTabsTitle( 'header_nav_align', 'Navigation' );
	infinityTabsTitle( 'custom_logo', 'Settings' );
	infinityTabsTitle( 'carousel_show', 'Settings' );
	infinityTabsTitle( 'carousel_category', 'Content' );
	infinityTabsTitle( 'promo_box_show', 'Settings' );
	infinityTabsTitle( 'promo_box_title_1', 'Promo Box 1' );
	infinityTabsTitle( 'promo_box_title_2', 'Promo Box 2' );
	infinityTabsTitle( 'promo_box_title_3', 'Promo Box 3' );
	infinityTabsTitle( 'promo_box_title_4', 'Promo Box 4' );
	infinityTabsTitle( 'promo_box_title_5', 'Promo Box 5' );
	infinityTabsTitle( 'promo_box_title_6', 'Promo Box 6' );
	infinityTabsTitle( 'promo_box_title_7', 'Promo Box 7' );
	infinityTabsTitle( 'promo_box_title_8', 'Promo Box 8' );
	infinityTabsTitle( 'blog_post_window', 'Settings' );
	infinityTabsTitle( 'blog_post_header', 'Post Options' );
	infinityTabsTitle( 'blog_post_like', 'Like / Comment / Share' );
	infinityTabsTitle( 'single_post_categories', 'Post Options' );
	infinityTabsTitle( 'single_post_author_page_desc', 'Page Options' );
	infinityTabsTitle( 'header_color_tb_bg', 'Top Bar' );
	infinityTabsTitle( 'header_color_tb_sub_text', 'Top Bar Sub Menu' );
	infinityTabsTitle( 'header_color_bg', 'Header' );
	infinityTabsTitle( 'header_color_mm_bg', 'Navigation' );
	infinityTabsTitle( 'header_color_mm_sub_text', 'Navigation Sub Menu' );
	infinityTabsTitle( 'carousel_color_title', 'Carousel General' );
	infinityTabsTitle( 'carousel_color_read_more', 'Read More' );
	infinityTabsTitle( 'general_color_read_more', 'Read More' );
	infinityTabsTitle( 'general_color_btn_info', 'Button Info' );
	infinityTabsTitle( 'general_color_main_btn', 'Main Button' );
	infinityTabsTitle( 'general_color_overlay_bg', 'Image Overlay' );
	infinityTabsTitle( 'general_color_preloader_bg', 'Preloader' );
	infinityTabsTitle( 'footer_color_widget_bg', 'Footer Widget Section' );
	infinityTabsTitle( 'footer_color_copyright_bg', 'Copyright Section' );
	infinityTabsTitle( 'footer_color_social_text', 'Footer Social' );
	infinityTabsTitle( 'footer_column', 'Settings' );
	infinityTabsTitle( 'social_window', 'Settings' );
	infinityTabsTitle( 'social_icon_1', 'Social 1' );
	infinityTabsTitle( 'social_icon_2', 'Social 2' );
	infinityTabsTitle( 'social_icon_3', 'Social 3' );
	infinityTabsTitle( 'social_icon_4', 'Social 4' );
	infinityTabsTitle( 'social_icon_5', 'Social 5' );
	infinityTabsTitle( 'social_icon_6', 'Social 6' );
	infinityTabsTitle( 'social_icon_7', 'Social 7' );
	infinityTabsTitle( 'social_icon_8', 'Social 8' );
	infinityTabsTitle( 'header_typography_title_family', 'Site Title' );
	infinityTabsTitle( 'header_typography_tagline_family', 'Tagline' );
	infinityTabsTitle( 'header_typography_nav_family', 'Navigation' );
	infinityTabsTitle( 'general_typography_heading_family', 'Heading' );
	infinityTabsTitle( 'general_typography_body_family', 'Body' );
	infinityTabsTitle( 'general_typography_subset_latin', 'Subsets' );
	$( '#customize-control-custom_logo' ).prepend('<h3 class="infinity-options-tab-title">Logo Setup</h3>');
	$( '#customize-control-show_on_front' ).prepend('<h3 class="infinity-options-tab-title">Setup Pages</h3>');
	$( '#customize-control-background_color' ).prepend('<h3 class="infinity-options-tab-title">Content</h3>');
	$( '#customize-control-custom_logo' ).prepend('<h3 class="infinity-options-tab-title">Logo Setup</h3>');
	$( '#customize-control-site_icon' ).prepend('<h3 class="infinity-options-tab-title">Site Icon</h3>');
	$( '#customize-control-background_image' ).prepend('<h3 class="infinity-options-tab-title">Settings</h3>');
	$( '#customize-control-header_image' ).prepend('<h3 class="infinity-options-tab-title">Settings</h3>');
	$( '#customize-control-background_image' ).prepend('<h3 class="infinity-options-tab-title">Settings</h3>');


}); // end ready
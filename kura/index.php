<?php 

get_header();

// Get Data
$current_layout 	= substr( infinity_options('general_home_layout'), 0, 4 );
$sidebar_position	= substr( infinity_options('general_home_layout'), 5, 8 );
$carousel_style		= infinity_options('general_carousel_style');


// Carousel Default Style
if ( true === infinity_options('carousel_show') && $carousel_style !== 'inner_grid' ) {
	infinity_carousel();
}

// Promo Boxes
if ( true === infinity_options('promo_box_show') ) {
	infinity_promo_box();
} 
?>

<div class="main-container-wrap" data-sidebar="<?php echo esc_attr( $sidebar_position ); ?>">
	<div class="main-container-outer <?php echo ( ( infinity_options('general_content_style') === 'boxed' )? 'center-width': '' ); ?>">
		<div class="main-container-inner">
	
			<div class="main-container">
				<?php 
				// Carousel Inner Content Style
				if ( true === infinity_options('carousel_show') && $carousel_style === 'inner_grid' ) {
					infinity_carousel();
				}

				// Page Loop - Display Posts
				infinity_loop($current_layout); ?>

			</div>

			<?php
			// Get Sidebar
			if ( $sidebar_position !== 'nsidebar' ) {
				get_sidebar();
			}
			?>

		</div>
	</div>
</div>
<?php get_footer(); ?>
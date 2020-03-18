<?php 

get_header();

// Get Data
$current_layout 	= substr( infinity_options('general_category_layout'), 0, 4 );
$sidebar_position	= substr( infinity_options('general_category_layout'), 5, 8 );
?>


<div class="main-container-wrap" data-sidebar="<?php echo esc_attr( $sidebar_position ); ?>">
	<div class="main-container-outer <?php echo ( ( infinity_options('general_content_style') === 'boxed' )? 'center-width': '' ); ?>">
		<div class="main-container-inner">
			
			<div class="main-container">
				<?php 
				// Author Description
				if ( true === infinity_options('single_post_cat_page_desc') ) {		
					get_template_part( 'templates/content/category', 'description' );
				}

				// Page Loop - Display Posts
				infinity_loop($current_layout);
				?>
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
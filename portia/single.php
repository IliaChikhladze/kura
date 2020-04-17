<?php get_header(); ?>

<?php
// Get Data
$disable_sidebar = get_post_meta( get_the_ID(), 'hide-sidebar', true );
$sidebar_single_position = substr( infinity_options('general_single_layout'), 5, 8 );
$sidebar_single_position = ($disable_sidebar)?'nsidebar':$sidebar_single_position;

?>

<div class="main-container-wrap" data-sidebar ="<?php echo esc_attr( $sidebar_single_position ); ?>">

	<div class="main-container-outer <?php echo ( ( infinity_options('general_single_style') === 'boxed' )? 'center-width': '' ); ?>">
	<div class="main-container-inner">

	<div class="main-container">
		<?php
		// Single Post
		get_template_part( 'templates/content/single/single', 'post');

		// Author Description
		if ( true === infinity_options('single_post_author_desc') ) {
			get_template_part('templates/content/single/author', 'description');
		}
		
		// Single Pagination
		if ( infinity_options('single_post_pagination') ) {
			get_template_part('templates/content/single/post', 'pagination');
		}
		
		// Similar Post
		infinity_similar_posts( infinity_options('single_post_similar_posts'), infinity_options('single_post_similar_posts_title') );
			
		// Comment Area
		if ( infinity_options('single_post_comment_area') ) {
			echo '<div class="comments-area" id="comments">';
			comments_template('', true);
			echo '</div>';
		} ?>	
	</div>

	<?php
	// Get Sidebar
	if ( $sidebar_single_position !== 'nsidebar' ) {
		get_sidebar();
	}
	?>
	</div>
	</div>
</div>
<?php get_footer(); ?>
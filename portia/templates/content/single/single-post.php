<?php 
// Get Data
$disable_feature_img = get_post_meta( get_the_ID(), 'hide-feature-media', true );
$post_format = get_post_format() ? : 'standard';
?>

<!-- Single Post -->
<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
			
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	

	<?php 
	// Post Media
	if ( !$disable_feature_img && infinity_options('blog_post_header') === 'below-media' ) {
		get_template_part( 'templates/content/post-formats/full/media', $post_format );
	} ?>

	<!-- Post Header -->
	<header class="entry-header">			
		<?php		
		// The Categories
		$category_list = get_the_category_list( ', ' );
		if ( $category_list && infinity_options('blog_post_categories') ) {
			echo '<div class="meta-categories">';
				if ( infinity_options('blog_post_category_prefix') ) {
					echo '<span class="category-prefix">'. esc_html__( 'In', 'portia' ) .'</span>'; 
				}
				echo $category_list;
			echo'</div>';
		}
		?>
		
		<!-- Post Title -->
		<h1 class="post-title">
			<?php the_title(); ?>
		</h1>
		
		<!-- Post Author and Date -->
		<div class="meta-author-date">
			<?php
			
			// Post Date
			if ( infinity_options('single_post_date') ) {

				// Get the date
				echo '<span class="meta-date">';
				echo get_the_time( get_option('date_format') );
				echo '</span>';
			}

			// Post Author
			if ( infinity_options('single_post_author') ) {
				echo '<span class="author-prefix">'. esc_html__( 'By', 'portia' ) .'</span>';
				printf(
					'<a href="%1$s" rel="author">%2$s</a>',
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					get_the_author()
				);
			} ?>
		</div>
	</header>
	
	<?php 
	// Post Media
	if ( !$disable_feature_img && infinity_options('blog_post_header') === 'above-media' ) {
		get_template_part( 'templates/content/post-formats/full/media', $post_format );
	} ?>

	<!-- Post Content -->
	<div class="entry-content">
	<?php
	the_content('');
	wp_link_pages( array(
		'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'portia' ) . '</span>',
		'after'       => '</div>',
		'link_before' => '<span>',
		'link_after'  => '</span>',
	) ); ?>
	</div>

	
	<!-- Article footer -->
	<footer class="entry-footer">
		<?php
		// The tags
		$tag_list = get_the_tag_list( '<div class="meta-tags">','','</div>');
		if ( $tag_list && infinity_options('single_post_tags') ) {
			echo '' . $tag_list;
		}
		
		// Post share
		infinity_sharing();
		?>

		<div class="clear"></div>
	</footer>
</article>

<?php endwhile; ?>
<?php endif; ?>
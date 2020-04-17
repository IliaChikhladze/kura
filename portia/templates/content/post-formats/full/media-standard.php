<?php 
/**
 * ----------------------------------------------------------------------------------------
 * Template For Standart Post
 * ----------------------------------------------------------------------------------------
 */

$post_window = (infinity_options('blog_post_window'))?'_blank':'_self';
?>

<?php if ( has_post_thumbnail() ) : ?>
<div class="entry-media">
	<?php
		if ( !is_single() ) {
			echo '<a href="'.esc_url( get_the_permalink() ).'" class="thumb-overlay" target="'.$post_window.'" ></a>';
		}
		the_post_thumbnail('infinity-full-thumbnail');
	 ?>
</div>
<?php endif; ?>
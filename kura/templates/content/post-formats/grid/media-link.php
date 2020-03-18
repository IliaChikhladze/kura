<?php 
/**
 * ----------------------------------------------------------------------------------------
 * Template For Link Post
 * ----------------------------------------------------------------------------------------
 */
 
// Get Data
$infinity_link_text	= get_post_meta( $post->ID, 'link_text', true );
$infinity_link_url	= get_post_meta( $post->ID, 'link_url', true )
?>

<?php if ( has_post_thumbnail() ) : ?>
<div class="entry-media">
	<div class="entry-link">
		<?php the_post_thumbnail('infinity-grid-thumbnail'); ?>
		<?php if ( '' !== $infinity_link_text ) : ?>
		<div class="container">
		  <div class="outer ">
		    <div class="inner">
			<div class="overlay-wrap">
				<a class="overlay-title" href="<?php echo esc_url( $infinity_link_url ); ?>">
					<?php echo esc_html( $infinity_link_text ); ?>
				</a>
			</div>	
		    </div>
		  </div>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>

<?php 
/**
 * ----------------------------------------------------------------------------------------
 * Template For Quote Post
 * ----------------------------------------------------------------------------------------
 */

// Get Data
$infinity_quote_text 	= get_post_meta( $post->ID, 'quote_text', true );
$infinity_quote_author  = get_post_meta( $post->ID, 'quote_author', true );
?>

<?php if ( has_post_thumbnail() ) : ?>
<div class="entry-media">
	<div class="entry-quote">
		<?php the_post_thumbnail('infinity-grid-thumbnail'); ?>
		<?php if ( '' !== $infinity_quote_text || '' !== $infinity_quote_author ) : ?>
		<div class="container">
		  <div class="outer">
		    	<div class="inner">
		    	<div class="overlay-wrap">
		    		<p class="overlay-title"><?php echo esc_html( $infinity_quote_text ); ?></p>
			        <?php if ( !empty( $infinity_quote_author ) ): ?>
			        <p class="overlay-text"><?php echo esc_html( $infinity_quote_author ); ?></p>
			        <?php endif; ?>	
			     </div>		
				</div>
		    </div>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>
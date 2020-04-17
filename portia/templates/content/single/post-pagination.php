<div class="post-pagination">
	<?php $prev_post = get_previous_post(); ?>	
	
	<?php if ( !empty( $prev_post ) ): ?>
	<div class="previous" >
		<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="previous-thumbnail" >
			<?php echo get_the_post_thumbnail( $prev_post->ID, 'thumbnail' );?>					
		</a>
		<div class="previous-inner">
			<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" >
				<p><i class="fa fa-long-arrow-left"></i>&nbsp;<?php esc_html_e( 'previous', 'portia' ) ; ?></p>
				<h4><?php echo wp_kses_post( $prev_post->post_title ); ?></h4>					
			</a>
		</div>
	</div>
	<?php endif; ?>
	
	<?php $next_post = get_next_post(); ?>
	
	<?php if ( !empty( $next_post ) ): ?>
	<div class="next" >
		<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="next-thumbnail" >
			<?php echo get_the_post_thumbnail( $next_post    ->ID, 'thumbnail' );?>					
		</a>
		<div class="next-inner">
			<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
				<p><?php esc_html_e( 'newer', 'portia' ) ; ?>&nbsp;<i class="fa fa-long-arrow-right"></i></p>
				<h4><?php echo wp_kses_post( $next_post->post_title ); ?></h4>
			</a>
		</div>
	</div>
	<?php endif; ?>
	<div class="clear"></div>
</div>
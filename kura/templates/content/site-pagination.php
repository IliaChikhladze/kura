<?php

	$pages = '';
	$range = 2;
	$showitems = ( $range * 2 ) + 1;

	global $paged;
	if ( empty( $paged ) ) {
		$paged = 1;
	}

	if ( $pages == '' ) {
	global $wp_query;
	$pages = $wp_query->max_num_pages;
		if( !$pages ) {
			$pages = 1;
		}
	}

	if( $pages == 1 ) {
		return;
	}

	echo '<div class="infinity-pagination">';

	if ( 1 != $pages && infinity_options('blog_post_pagination') === 'numbered' ) {
		echo '<div class="numbered-list">';
		
		if ( $paged > 2 && $paged > $range+1 && $showitems < $pages ) {
			echo "<a href='".esc_url( get_pagenum_link(1) )."'><i class='fa fa-angle-double-left'></i></a>";
		}

		if ( $paged > 1 ) {
			echo "<a href='".esc_url( get_pagenum_link( $paged - 1 ) )."'><i class='fa fa-angle-left'></i></a>";
		}

		for ( $i=1; $i <= $pages; $i++ ) {
			if (1 != $pages &&( !( $i >= $paged+$range+1 || $i <= $paged-$range-1 ) || $pages <= $showitems ) ) {
			 echo ( $paged == $i )? "<span class='numbered-current'>".$i."</span>":"<a href='".esc_url( get_pagenum_link( $i ) )."' class='numbered-inactive' >".$i."</a>";
			}
		}

		if ( $paged < $pages ) {
			echo "<a href='". esc_url( get_pagenum_link( $paged + 1 ) )."'><i class='fa fa-angle-right'></i></a>";
		}

		if ( $paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages ) {
			echo "<a href='". esc_url( get_pagenum_link($pages) )."'><i class='fa fa-angle-double-right'></i></a>";
		}

		echo '</div>';
	
	} else if ( infinity_options('blog_post_pagination') === 'default' ) { ?>	
			<?php if ( get_next_posts_link() ) : ?>
			<div class="default-previous">			
			<?php next_posts_link( '<i class="fa fa-long-arrow-left" ></i>&nbsp;'. esc_html__( 'Older', 'inf_lang' ) ); ?>
			</div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="default-next">
			<?php previous_posts_link( esc_html__( 'Newer', 'inf_lang' ) . '&nbsp;<i class="fa fa-long-arrow-right" ></i>' ); ?>
			</div>
			<?php endif; ?>
			
			<div class="clear"></div>

	<?php } else {

 		if ( get_next_posts_link() ) : ?>
		<div class="default-next">
		<?php next_posts_link( esc_html__( 'Older', 'inf_lang' ) . '&nbsp;<i class="fa fa-long-arrow-right" ></i>' ); ?>
		</div>
		<?php endif; ?>
		
		<div class="numbered-list">
		<?php
		for ( $i=1; $i <= $pages; $i++ ) {
			if (1 != $pages &&( !( $i >= $paged+$range+1 || $i <= $paged-$range-1 ) || $pages <= $showitems ) ) {
			 echo ( $paged == $i )? "<span class='numbered-current'>".$i."</span>":"<a href='".esc_url( get_pagenum_link( $i ) )."' class='numbered-inactive' >".$i."</a>";
			}
		}
		?>
		</div>
		<?php if ( get_previous_posts_link() ) : ?>
		<div class="default-previous">
		<?php previous_posts_link( '<i class="fa fa-long-arrow-left" ></i>&nbsp;'. esc_html__( 'Newer', 'inf_lang' ) ); ?>
		</div>
		<?php endif; ?>		

		<div class="clear"></div>
	<?php } ?>

</div>
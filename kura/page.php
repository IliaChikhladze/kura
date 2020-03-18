<?php 

get_header();

// Get Data
$sidebar_page_position = get_post_meta( get_the_ID(), 'sidebar-position', true );

// Show carousel
if ( get_post_meta( get_the_ID(), 'show-carousel', true ) ) {
	infinity_carousel();
}

// Promo Boxes
if ( get_post_meta( get_the_ID(), 'show-promo-box', true ) ) {
	infinity_promo_box();
} 

$container_style = (get_post_meta( get_the_ID(), 'full-style', true ))?'':'center-width';
?>

<div class="main-container-wrap" data-sidebar="<?php echo esc_attr( $sidebar_page_position ); ?>" >
	<div class="main-container-outer <?php echo esc_attr($container_style); ?>">
		<div class="main-container-inner">
	
		<div class="main-container">

		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

		<article id="page-<?php the_ID(); ?>" >
			
			<?php if( !get_post_meta( get_the_ID(), 'hide-feature-media', true ) && has_post_thumbnail() ) : ?>
			<div class="entry-media">
				<?php the_post_thumbnail('infinity-full-thumbnail'); ?>
			</div>
			<?php endif; ?>
			
			<?php if ( ! get_post_meta( get_the_ID(), 'hide-title', true ) ) : ?>	
			<header class="entry-header">
				<h1 class="post-title"><?php the_title(); ?></h1>
			</header>
			<?php endif; ?>

			<div class="entry-content">
				<?php the_content(); ?>
				<div class="clear"></div>
			</div>
			
			<?php if ( get_post_meta( get_the_ID(), 'show-social', true ) ) : ?>	
			<div class="entry-footer">
				<?php infinity_sharing(); ?>
			</div>
			<?php endif; ?>
		
		</article>

		<!-- Comment area -->
		<?php if ( comments_open() || get_comments_number() ): ?>
		<div class="comments-area" id="comments">
			<?php comments_template('', true); ?>
		</div>
		<?php endif; ?>
		
		<?php endwhile; else : ?>
			<h1><?php esc_html_e( 'no page where found','inf_lang' ) ; ?></h1>
		<?php endif; ?>
		</div>

		<?php
		// Get Sidebar
		if ( $sidebar_page_position === 'rsidebar' || $sidebar_page_position === 'lsidebar' ) {
			get_sidebar();
		}

		?>

	</div>
	</div>
</div>
<?php get_footer(); ?>
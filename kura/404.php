<?php get_header(); ?>

<div class="main-container-wrap">
	<div class="main-container-outer <?php echo ( ( infinity_options('general_content_style') === 'boxed' )? 'center-width': '' ); ?>">				
		<div class="fourzerofour">
		<div class="error-title"><?php esc_html_e( 'Page not found!', 'inf_lang' ) ; ?></div>
		<p><?php esc_html_e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help or go back to ', 'inf_lang' ) ; ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Homepage', 'inf_lang' ) ; ?></a></p>
		<?php echo infinity_search_form(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
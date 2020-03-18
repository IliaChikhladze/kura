	<footer class="footer-wrap <?php echo ( infinity_options('general_footer_style') === 'boxed' ) ? 'center-width' : ''; ?>">
	
		<!-- Instagram Widget -->
		<?php if ( is_active_sidebar( 'instagram-widget' ) ) : ?>
		<div class="footer-instagram">
			<?php dynamic_sidebar( 'instagram-widget' ); ?>
		</div>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'footer-widgets' ) && 'none' !== infinity_options('footer_column') ) : ?>
		<div class="footer-widgets">
			<div class="center-width"><?php dynamic_sidebar( 'footer-widgets' ); ?></div>
		</div>
		<?php endif; ?>


		<?php if ( true === infinity_options('footer_social') || true === infinity_options('footer_back_to_top') || '' === infinity_options('footer_copyright') ): ?>
			
		<div class="footer-copyright">	
			<div class="center-width">	
				<!-- Footer Social -->
				<?php 
					if ( true === infinity_options('footer_social') ) {
						echo infinity_social( 'footer-social'); 
					}
				?>

				<!-- Copyright -->
				<div class="copyright">	

					<?php

						$copyright = infinity_options('footer_copyright');
						$copyright = str_replace( '$year', date_i18n( 'Y' ), $copyright );

						echo wp_kses_post( $copyright );

						if ( infinity_options('footer_copyright') !== '' ) {
							esc_html_e( ' | ', 'inf_lang' );
						}

					?>

					<span class="footer-credit">
						<?php
						$theme_data	= wp_get_theme();
						printf( __( 'Theme by <a href="%1$s">%2$s.</a>', 'inf_lang' ), esc_url( 'http://infinitywp.com/' ), $theme_data->Author );
						?>
					</span>
				</div>

				<?php if ( true === infinity_options('footer_back_to_top') ) : ?>
				<!-- Scroll top button -->
				<span class="backtotop">
					<i class="fa fa fa-angle-double-up"></i>
					<br>
					<?php esc_html_e( 'Back to top', 'inf_lang' ) ; ?>
				</span>
				<?php endif; ?>

				

			</div>
		</div>

		<?php endif; ?>

	</footer>

	</div>

<?php wp_footer(); ?>
</body>
</html>
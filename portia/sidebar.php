<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
<div class="main-sidebar-wrap">
	<aside class="main-sidebar" data-effect="<?php echo esc_attr( infinity_options('general_sticky_sidebar') ); ?>" >
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside>
</div>
<?php endif; ?>


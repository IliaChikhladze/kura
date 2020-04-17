<!-- Header Top -->
<?php if ( infinity_options('header_top_bar') ): ?>
<div class="header-top">
	<div class="<?php echo ( infinity_options('general_header_style') === 'contained' ) ? 'center-width' : ''; ?>">
		
		<!-- Fixed Sidebar Button -->
		<?php if ( true === infinity_options('header_top_alt_sidebar') ) : ?>
	    <div class="sidebar-btn">
	    	<span></span>
	    </div>
		<?php endif; ?>


		<?php
			if ( true === infinity_options('header_top_social') ) {
				echo infinity_social('header-top-social');
			}
			
			infinity_nav_menu( 'top-nav', 'top-menu' ); 
		?>
		<div class="clear"></div>
	</div>
</div>
<?php endif; ?>
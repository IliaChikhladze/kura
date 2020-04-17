<!-- Navigation -->
<div class="header-bottom">
	<div class="<?php echo ( infinity_options('general_header_style') === 'contained' ) ? 'center-width' : ''; ?>">

		<!-- Mobile Menu Button -->
		<div class="nav-btn">
			<i class="fa fa-bars"></i>
		</div>

		<div class="nav-left-controls">
			<?php if ( '' !== infinity_options('header_nav_logo') ) : ?>

			<!-- Mini Logo -->
			<div class="mini-logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr( bloginfo('name') ); ?>" >
					<img src="<?php echo esc_url( infinity_options('header_nav_logo') ); ?>" alt="<?php esc_attr( bloginfo('name') ); ?>">
				</a>	
			</div>
			<?php endif; ?>

			<!-- Random Button -->
			<?php 

				if ( true === infinity_options('header_nav_random_btn') && '' === infinity_options('header_nav_logo') ) {
					infinity_random_btn();
				}

			?>
		</div>

		<div class="nav-right-controls">
			<?php 
			
			if (  true === infinity_options('header_nav_random_btn') && '' !== infinity_options('header_nav_logo') ) {
				infinity_random_btn();
			}
			
			?>

			<?php if (  true === infinity_options('header_nav_search') ) : ?>
				<div class="search-btn">
					<span class="btn-info"><?php esc_html_e( 'Search', 'portia' ) ; ?></span>
			    	<i class="fa fa-search"></i>
			    </div>
			<?php endif; ?>

			<?php if ( infinity_is_woo_activated() ) : ?>
				<a class="cart-btn" href="<?php echo wc_get_cart_url(); ?>">
					<i class="fa fa-shopping-cart"></i>
					<span class="cart-btn-count">
						<?php echo WC()->cart->get_cart_contents_count(); ?>
					</span>
					<span class="btn-info"><?php esc_html_e( 'View cart', 'portia' ) ; ?></span>
				</a>
			<?php endif; ?>

		</div>

		<!-- Display Navigation -->
		<?php
			infinity_nav_menu('site-nav', 'main-menu');
		?>

		<!-- Display Mobile Navigation -->
		<?php
		$merge_menu = wp_nav_menu( array(
			'theme_location' => 'top-menu',
			'fallback_cb'	 => false,
			'container'		 => '',
			'items_wrap' 	 => '%3$s',
			'echo'			 => false
		) );

		if ( has_nav_menu( 'main-menu' ) ) {
			wp_nav_menu( array(
				'theme_location' 	=> 'main-menu',
				'container'			=> 'nav',
				'container_class'	=> 'site-nav-mobile',
				'items_wrap' 		=> '<ul id="%1$s" class="%2$s">%3$s ' . $merge_menu . '</ul>',
			) );
		} ?>

	    <div class="clear"></div>
	</div>
</div>

<?php infinity_breadcrumb(); ?>
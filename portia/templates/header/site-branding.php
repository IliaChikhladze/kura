<?php
	
$header_img = get_header_image();
$header_logo = true;

if ( is_category() ) {
	$category = get_category( get_query_var( 'cat' ) );
	$cat_id = $category->cat_ID;
	$caregory_logo = get_term_meta( $cat_id, 'category-logo', true );
	$caregory_header_img = get_term_meta( $cat_id, 'category-header-img-data', true );
	if ( $caregory_header_img ) {
		$header_img = $caregory_header_img;
	}
	if ( $caregory_logo ) {
		$header_logo = false;
	}
}

if ( is_single() ) {
	$page_logo = get_post_meta ( get_the_ID(), 'hide-logo', true );
	$page_header_img = get_post_meta ( get_the_ID(), 'page-header-img-data', true );
	if ( $page_header_img ) {
		$header_img = $page_header_img;
	}
	if ( $page_logo ) {
		$header_logo = false;
	}
}

if ( infinity_is_woo_activated() && ( is_shop() || is_product_category() || is_product() ) ) {
	$page_id = get_option('woocommerce_shop_page_id');
	$page_logo = get_post_meta ( $page_id, 'hide-logo', true );
	$page_header_img = get_post_meta ( $page_id, 'page-header-img-data', true );
	if ( $page_header_img ) {
		$header_img = $page_header_img;
	}
	if ( $page_logo ) {
		$header_logo = false;
	}

} else if ( is_page() ) {
	$page_logo = get_post_meta ( get_the_ID(), 'hide-logo', true );
	$page_header_img = get_post_meta ( get_the_ID(), 'page-header-img-data', true );
	if ( $page_header_img ) {
		$header_img = $page_header_img;
	}
	if ( $page_logo ) {
		$header_logo = false;
	}
}

?>

<!-- Header Center -->
<div class="header-center" style="background-image:url(<?php echo esc_url( $header_img ); ?>)">

	<!-- header Logo -->
	<?php if ( $header_logo ) : ?>

	<div class="site-logo">

		<?php 
			
		if ( has_custom_logo() ) :

			$logo_src = wp_get_attachment_url( get_theme_mod( 'custom_logo' ) );

		?>

		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr( bloginfo('name') ); ?>" >
			<img src="<?php echo esc_url(  $logo_src ); ?>" alt="<?php esc_attr( bloginfo('name') ); ?>">
		</a>

		<?php endif; ?>
			
		<?php if ( is_home() || is_front_page() ) : ?>
		<h1>
			<a href="<?php echo esc_url( home_url('/') ); ?>" class="site-title"><?php echo bloginfo( 'title' ); ?></a>
		</h1>
		<?php else : ?>
		<a href="<?php echo esc_url( home_url('/') ); ?>" class="site-title"><?php echo bloginfo( 'title' ); ?></a>
		<?php endif; ?>

		<p class="site-description"><?php echo bloginfo( 'description' ); ?></p>

		<?php
			// Header Center Socials
			if ( true === infinity_options('header_social') ) {
				echo infinity_social('header-center-social');
			}
		?>
	</div>
	<?php endif; ?>
</div>
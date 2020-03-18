<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php esc_attr( bloginfo( 'charset' ) ); ?>">
	<meta name="description" content="<?php esc_attr( bloginfo( 'description' ) ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >

	<!-- Preloader -->
	<?php
		if ( 'none' !== infinity_options('general_preloader') ) {
			infinity_preloader();
		}
	?>

	<!-- Fixed Sidebar -->
	<?php if ( true === infinity_options('header_top_alt_sidebar') ) : ?>
	<div class="fixed-sidebar-close"></div>
	<div class="fixed-sidebar" data-width="<?php echo esc_attr( infinity_options('general_sidebar_width') ); ?>">
		<div class="fixed-sidebar-close-btn">
			<i class="fa fa-reply"></i>
		</div>
		<?php
		if ( is_active_sidebar( 'sidebar-fixed' ) ) {
			dynamic_sidebar( 'sidebar-fixed' );
		}
		?>
	</div>
	<?php endif; ?>

	<div class="main-wrap">

		<!-- Search Form -->
		<?php if (  true === infinity_options('header_nav_search') ) : ?>
		<div class="header-search-wrap">
			<div class="header-search">
				<div class="search-title"><?php esc_html_e('Do you want Search?', 'inf_lang' ) ; ?></div>
				<?php echo infinity_search_form(true); ?>
			</div>
		</div>
		<?php endif; ?>

		<!-- Header -->
		<header class="header-wrap <?php echo ( infinity_options('general_header_style') === 'boxed' ) ? 'center-width' : ''; ?>">
			
			<?php get_template_part( 'templates/header/top', 'bar' ); ?>
			
			<?php get_template_part( 'templates/header/site', 'branding' ); ?>

			<?php get_template_part( 'templates/header/site', 'navigation' ); ?>

			<div class="responsive-column"></div>
		
		</header>
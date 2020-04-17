<?php 

/**
 * ----------------------------------------------------------------------------------------
 * Define
 * ----------------------------------------------------------------------------------------
 */

define( 'INFINITY_THEMEROOT', get_template_directory_uri() );



/**
 * ----------------------------------------------------------------------------------------
 * Sets up theme defaults and registers support for various WordPress features.
 * ----------------------------------------------------------------------------------------
 */

	function infinity_setup() {

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title
		add_theme_support( 'title-tag' );

		// Load Language File For Translation
		load_theme_textdomain( 'inf_lan', INFINITY_THEMEROOT .'/languages' );

		// Enable support for Post Thumbnails on posts and pages
		add_theme_support( 'post-thumbnails' );

		// Image Size
		add_image_size( 'infinity-full-thumbnail', 1180, 0, true );
		add_image_size( 'infinity-grid-thumbnail', 400, 260, true );
		add_image_size( 'infinity-list-thumbnail', 300, 300, true );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Enable support for Post Formats
		add_theme_support( 
			'post-formats',
			array(
				'link',
				'quote',
			)
		);

		// Add theme support for Custom Logo.
		$custom_logo_defaults = array(
			'width'       => 500,
			'height'      => 200,
			'flex-width'  => true,
			'flex-height' => true,
		);
		add_theme_support( 'custom-logo', $custom_logo_defaults );

		// Register nav menus
		register_nav_menus(
			array(
				'top-menu'	=> esc_html__( 'Top Menu', 'portia' ) ,
				'main-menu'	=> esc_html__( 'Main Menu', 'portia' ) 
			)
		);

		// Add theme support for Custom Header.
		$custom_header_defaults = array(
			'width'       			=> 1300,
			'height'      			=> 500,
			'flex-width'  			=> true,
			'flex-height' 			=> true,
			'default-image' 		=> esc_url( get_template_directory_uri() ) .'/assets/images/header-background.jpg',
			'default-text-color'	=> '111',
		);
		add_theme_support( 'custom-header', $custom_header_defaults );

		// Add theme support for Custom Background.
		$custom_background_defaults = array(
			'default-color'	=> '',
		);
		add_theme_support( 'custom-background', $custom_background_defaults );

		// Set the default content width.
		$GLOBALS['blog_post_width'] = 1000;

		// Set the default content width.
		$GLOBALS['content_width'] = 960;

		// WooCommerce
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

	}
	add_action( 'after_setup_theme', 'infinity_setup', 100 );



/**
 * ----------------------------------------------------------------------------------------
 * Load the custom scripts
 * ----------------------------------------------------------------------------------------
 */

	function infinity_scripts() {

		// Enqueue the stylesheets
		wp_enqueue_style( 'infinity-main-style', get_stylesheet_uri(), array(), '1.0' );
		wp_enqueue_style( 'owl-carousel', INFINITY_THEMEROOT .'/assets/css/owl.carousel.css' );
		wp_enqueue_style( 'magnific-popup', INFINITY_THEMEROOT .'/assets/css/magnific-popup.css' );
		wp_enqueue_style( 'font-awesome', INFINITY_THEMEROOT .'/assets/css/font-awesome.min.css' );
		wp_enqueue_style( 'fontello', INFINITY_THEMEROOT .'/assets/css/fontello.css' );
		wp_enqueue_style( 'perfect-scrollbar', INFINITY_THEMEROOT .'/assets/css/perfect-scrollbar.css' );
		wp_enqueue_style( 'typo', INFINITY_THEMEROOT .'/assets/css/typo.css' );
		wp_enqueue_style( 'infinity-colors', INFINITY_THEMEROOT .'/assets/css/colors.css' );

		// WooCommerce
		if ( infinity_is_woo_activated() ) {
			wp_enqueue_style( 'infinity-woocommerce', INFINITY_THEMEROOT .'/assets/css/woocommerce.css' );
		}

		// Adds support for pages with threaded comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_style( 'infinity-mediaquery', INFINITY_THEMEROOT .'/assets/css/mediaquery.css' );

		// Enqueue the custom scripts
		wp_enqueue_script( 'infinity-plugins', INFINITY_THEMEROOT . '/assets/js/infinity-plugins.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'infinity-custom-scripts', INFINITY_THEMEROOT . '/assets/js/custom-scripts.min.js', array( 'jquery' ), false, true );
		
	}
	add_action( 'wp_enqueue_scripts', 'infinity_scripts' );


	
/**
 * ----------------------------------------------------------------------------------------
 * Require File
 * ----------------------------------------------------------------------------------------
 */

	// Defaults
	require get_parent_theme_file_path( '/inc/customizer/theme-activation.php' );

	// Customizer
	require get_parent_theme_file_path() .'/inc/customizer/infinity-customizer.php';

	// Dynamic Css
	require get_parent_theme_file_path() .'/inc/customizer/css/dynamic-css.php';

	// Post Like
	require get_parent_theme_file_path() . '/inc/plugins/post-likes/post-likes.php';

	// Load Metaboxes
	require  get_parent_theme_file_path() . '/inc/metaboxes/infinity-metaboxs.php';

	// Gallery
	require get_parent_theme_file_path( '/inc/plugins/royal-backend-gallery/royal-backend-gallery.php' );

	// About Theme
	require get_parent_theme_file_path( '/inc/dashboard/about-theme.php' );


/**
 * ----------------------------------------------------------------------------------------
 * Google Fonts
 * ----------------------------------------------------------------------------------------
 */

	// Load Google Font Function
	function infinity_load_google_fonts( $font ) {

		$subsets = '';

		if ( true === infinity_options('general_typography_subset_latin') ) {
			$subsets .= 'latin,latin-ext,';
		}

		if ( true === infinity_options('general_typography_subset_cyrillic') ) {
			$subsets .= 'cyrillic,cyrillic-ext,';
		}

		if ( true === infinity_options('general_typography_subset_greek') ) {
			$subsets .= 'greek,greek-ext,';
		}

		if ( true === infinity_options('general_typography_subset_vietnamese') ) {
			$subsets .= 'vietnamese,';
		}

		if ( '' !== $subsets ) {
			$subsets = '&subset='.substr($subsets, 0, -1);
		}

		$font_url = '';

		// get font url
		if ( 'off' !== _x( 'on', 'Google font: on or off', 'portia' ) ) {
			$font_url = '//fonts.googleapis.com/css?family='. $font .':100,200,300,400,500,600,700,800,900'. $subsets;
		}

		$font = str_replace( '+', '_', $font );

		// Enqueue Font
		wp_register_style( 'infinity_enqueue_'.$font, $font_url, array(), '1.0.0' );
		wp_enqueue_style( 'infinity_enqueue_'.$font );
	
	}

	// Enqueue Google Fonts
	function infinity_enqueue_google_fonts() {

		// load font only once
		$fonts_array = array_unique( array(
			infinity_options( 'header_typography_title_family' ),
			infinity_options( 'header_typography_tagline_family' ),
			infinity_options( 'header_typography_nav_family' ),
			infinity_options( 'general_typography_heading_family' ),
			infinity_options( 'general_typography_body_family' ),
		) );

		// websafe fonts
		$websafe = array(
			'Trebuchet+MS',
			'Times+New+Roman',
			'Tahoma',
			'Helvetica',
			'Verdana',
			'Arial',
			'Times',
			'Georgia',
			'Courier',
		);

		// Enqueue Fonts
		foreach( $fonts_array as $font ) {

			if ( !in_array( $font, $websafe ) ) {
				infinity_load_google_fonts( $font );
			}
		}
	}

	add_action( 'wp_enqueue_scripts', 'infinity_enqueue_google_fonts' );



/**
 * ----------------------------------------------------------------------------------------
 * Register the widgets
 * ----------------------------------------------------------------------------------------
 */

	function infinity_widget_init() {
		if ( function_exists( 'register_sidebar' ) ) {
			register_sidebar(
				array(
					'name'			=> esc_html__( 'Sidebar Widget Area', 'portia' ) ,
					'id'			=> 'sidebar-1',
					'description'	=> esc_html__( 'Add widgets here to appear in your Right Sidebar.', 'portia' ) ,
					'before_widget'	=> '<div id="%1$s" class="infinity-widget %2$s">',
					'after_widget'	=> '</div> <!-- end widget -->',
					'before_title'	=>	'<div class="widget-title"><h4>',
					'after_title'	=>	'</h4></div>'
				)
			);

			register_sidebar(
				array(
					'name'			=>	esc_html__( 'Fixed Sidebar Widget Area', 'portia' ) ,
					'id'			=>	'sidebar-fixed',
					'description'	=>	esc_html__( 'Add widgets here to appear in your Fixed Sidebar.', 'portia' ) ,
					'before_widget'	=>	'<div id="%1$s" class="infinity-widget %2$s">',
					'after_widget'	=>	'</div> <!-- end widget -->',
					'before_title'	=>	'<div class="widget-title"><h4>',
					'after_title'	=>	'</h4> </div>'
				)
			);

			register_sidebar(
				array(
					'name'			=> esc_html__( 'Instagram Widget Area', 'portia' ) ,
					'id'			=> 'instagram-widget',
					'description'	=> esc_html__( 'Add widget here to appear in your Instagram Area.', 'portia' ) ,
					'before_widget'	=> '<div id="%1$s" class="instagram-widget %2$s">',
					'after_widget'	=> '<div class="clear"></div></div> <!-- end widget -->',
					'before_title'	=>	'<div class="instagram-title"><h4>',
					'after_title'	=>	'</h4> </div>'
				)
			);

			register_sidebar(
				array(
					'name'			=>	esc_html__( 'Footer Widget Area', 'portia' ) ,
					'id'			=>	'footer-widgets',
					'description'	=>	esc_html__( 'Add widgets here to appear in your Footer Widgetised Area.', 'portia' ) ,
					'before_widget'	=>	'<div id="%1$s" class="infinity-widget %2$s">',
					'after_widget'	=>	'</div> <!-- end widget -->',
					'before_title'	=>	'<div class="widget-title"><h4>',
					'after_title'	=>	'</h4> </div>'
				)
			);

			register_sidebar(
				array(
					'name'			=> esc_html__( 'Woocommerce Widget Area', 'portia' ) ,
					'id'			=> 'woocommerce-widgets',
					'description'	=> esc_html__( 'Add widgets here to appear in your Woocommerce Sidebar.', 'portia' ) ,
					'before_widget'	=> '<div id="%1$s" class="infinity-widget %2$s">',
					'after_widget'	=> '</div> <!-- end widget -->',
					'before_title'	=>	'<div class="widget-title"><h4>',
					'after_title'	=>	'</h4></div>'
				)
			);

		}
	}
	add_action( 'widgets_init', 'infinity_widget_init' );



/**
 * ----------------------------------------------------------------------------------------
 * Custom Excerpt Length
 * ----------------------------------------------------------------------------------------
 */

	function infinity_excerpt_length() {	
		return 2000;
	}

	add_filter( 'excerpt_length', 'infinity_excerpt_length', 999 );

	function infinity_new_excerpt( $more ) {
		return '...';
	}

	add_filter( 'excerpt_more', 'infinity_new_excerpt' );

	if ( ! function_exists( 'infinity_excerpt' ) ) {

		function infinity_excerpt($limit) {
		    return '<p>'.wp_trim_words(get_the_excerpt(), $limit).'</p>';
		}

	}

/**
 * ----------------------------------------------------------------------------------------
 *  HEX to RGBA
 * ----------------------------------------------------------------------------------------
 */

	function infinity_rgba( $color, $opacity = 1 ) {

		// remove '#'
		$color = substr( $color, 1 );

		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );

	    // convert HEX to RGB
	    $rgb = array_map( 'hexdec', $hex );

		return 'rgba('. implode( ",", $rgb ) .', '. $opacity .')';

	}



/**
 * ----------------------------------------------------------------------------------------
 * Adding Post & Page Classes
 * ----------------------------------------------------------------------------------------
 */

	function infinity_post_classes( $classes, $class, $post_id ) {
	 
		if( is_single() ) {
			$classes[] .= 'infinity-single-post';
		} else if ( is_page() ) {
			$classes[] .= 'infinity-page main-post';	
		} else {
			$classes[] .= 'main-post';
		}
	     
	    return $classes;
	}

	add_filter( 'post_class', 'infinity_post_classes', 10, 3 );



/**
 * ----------------------------------------------------------------------------------------
 * Custom Search Form
 * ----------------------------------------------------------------------------------------
 */

	function infinity_search_form( $value = false ) {
	
		$form  = '<form method="get" action="'. esc_url( home_url( '/' ) ) .'" class="infinity-search" >';
			$form .= '<input id="s" class="search_input" type="text" name="s" placeholder="'. esc_attr__( 'Type and hit Enter...', 'portia' ) .'">';
			$form .= '<button type="submit" class="submit infinity-button" name="submit" ><i class="fa fa-search" ></i></button>';
		$form .= '</form>';

		return $form;
	}	

	add_filter( 'get_search_form', 'infinity_search_form' );



/**
 * ----------------------------------------------------------------------------------------
 * Random button Function
 * ----------------------------------------------------------------------------------------
 */

	// Random Post Button
	if ( ! function_exists( 'infinity_random_btn' ) ) {
		function infinity_random_btn() {

			$args = array(
				'post_type'				=> 'post',
				'orderby' 				=> 'rand',
   				'post_status' 			=> 'publish',
				'showposts' 			=> 1,
				'ignore_sticky_posts' 	=> 1
			);
			$random_post = new WP_Query( $args );

			while ( $random_post->have_posts() ) : $random_post->the_post(); ?>

			<a class="random-btn" href="<?php esc_url( the_permalink() ); ?>">
				<span class="btn-info"><?php esc_html_e( 'Random Article', 'portia' ); ?></span>
				<i class="fa fa-retweet"></i>
			</a>

			<?php
			endwhile;
			wp_reset_postdata();

		}
	}


/**
 * ----------------------------------------------------------------------------------------
 * Nav Menu Function
 * ----------------------------------------------------------------------------------------
 */

	if ( ! function_exists( 'infinity_nav_menu' ) ) {
		
		function infinity_nav_menu(  $infinity_nav_class = '', $infinity_theme_location = '', $infinity_depth = 0 ) { 
			
			if ( has_nav_menu( $infinity_theme_location ) ) {
				wp_nav_menu( array(
					'theme_location'	=> $infinity_theme_location,
					'container'			=> 'nav',
					'container_class' 	=> $infinity_nav_class,
					'menu_class'      	=> '',
					'depth'				=> $infinity_depth
				));
			} else {
				echo '<nav class="'. esc_attr( $infinity_nav_class ) .'">';
				echo '<ul>';
					echo '<li>';
						echo '<a class="set-up" href="'. esc_url(home_url('/') .'wp-admin/nav-menus.php') .'">'. esc_html__( 'Set Up Menu', 'portia' ) .'</a>';
					echo '</li>';
				echo '</ul>';
				echo '</nav>';
			}
		}
	}



/**
 * ----------------------------------------------------------------------------------------
 *  Similar Posts
 * ----------------------------------------------------------------------------------------
 */

if ( ! function_exists( 'infinity_similar_posts' ) ) {
		
	function infinity_similar_posts( $ordeby, $title='' ) {

		if ( $ordeby === 'none' ) {
			return;
		}

		global $post;

		//Get Data
		$current_categories	= get_the_category();

		if ( $current_categories ) {

			$first_category	= $current_categories[0]->term_id;

			if ( $ordeby === 'random' ) {
				$args = array(
					'post_type'				=> 'post',
					'post__not_in'			=> array( $post->ID ),
					'orderby'				=> 'rand',
					'posts_per_page'		=> 3,
					'ignore_sticky_posts'	=> 1,
				    'meta_query' => array(
				        array(
				         'key' => '_thumbnail_id',
				         'compare' => 'EXISTS'
				        ),
				    )
				);
			} else {
				$args = array(
					'post_type'				=> 'post',
					'category__in'			=> array( $first_category ),
					'post__not_in'			=> array( $post->ID ),
					'orderby'				=> 'rand',
					'posts_per_page'		=> 3,
					'ignore_sticky_posts'	=> 1,
				    'meta_query' => array(
				        array(
				         'key' => '_thumbnail_id',
				         'compare' => 'EXISTS'
				        ),
				    )
				);
			}

			$similar_posts = new WP_Query( $args );	

			if ( $similar_posts->have_posts() ) { ?>
			<div class="related-posts">	
				<?php if ( '' !== $title ) : ?>
				<div class="related-posts-title">					
					<h4><?php echo esc_html( $title ); ?></h4>
				</div>
				<?php endif; ?>

			<?php 
				while ( $similar_posts->have_posts() ) { 
					$similar_posts->the_post();
					if ( has_post_thumbnail() ) { ?>
					<section>
						<a href="<?php esc_url( the_permalink() ); ?>"><?php the_post_thumbnail('infinity-grid-thumbnail'); ?></a>
						<h4><a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h4>
						<span class="post-date"><?php echo get_the_time( get_option('date_format') ); ?></span>
					</section>
					<?php }
				} ?>
				<div class="clear"></div>
				</div>
			<?php }
		} 

		wp_reset_postdata(); 
	}
}



/**
 * ----------------------------------------------------------------------------------------
 * Posts Loop
 * ----------------------------------------------------------------------------------------
 */

	if ( ! function_exists( 'infinity_loop' ) ) {
		
		function infinity_loop( $current_layout = 'col2' ) {

			// Get Data
			global $wp_query;

			if ( have_posts() ) {
				
				echo '<ul class="infinity-grid">';

				while ( have_posts() ) {
					
					the_post();

					if ( $current_layout !== 'full' && infinity_options('general_full_post') && is_home() && !is_paged() && $wp_query->current_post == 0 ) {
						infinity_post('full-post');
					} else {
						echo '<li class="'. esc_attr($current_layout) .'">';
							infinity_post($current_layout);
						echo '</li>';
					}	

					// Similar Post
					if ( $current_layout == 'full' ) {
						infinity_similar_posts( infinity_options('blog_post_similar_posts') );
					}

				}

				echo '</ul>';
				
				// Get Pagination
				get_template_part( 'templates/content/site', 'pagination' );
			
			} else { ?>
				
			
			<div class="no-search-result">
				<h3><?php esc_html_e( 'Nothing Found', 'portia' ) ; ?></h3>
				<p><?php esc_html_e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help or go back to ', 'portia' ) ; ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Homepage', 'portia' ) ; ?></a></p>
				<?php echo infinity_search_form(); ?>
			</div>

			<?php

			}
		}
	}



/**
 * ----------------------------------------------------------------------------------------
 * Grid Post
 * ----------------------------------------------------------------------------------------
 */

if ( ! function_exists( 'infinity_post' ) ) {
		
	function infinity_post( $current_layout = 'col2' ) { 


		$media_layout = $current_layout;

		if ( $current_layout === 'col2' || $current_layout === 'col3' ) {
			$media_layout = 'grid';
		} 

		if ( $current_layout === 'full-post' ) {
			$media_layout = 'full';
		} 

		$post_format = (get_post_format())?get_post_format():'standard';

		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<!-- Post Media -->		
			<?php
			if ( infinity_options('blog_post_header') === 'below-media' ) {
				get_template_part( 'templates/content/post-formats/'.$media_layout.'/media', $post_format ); 		
			}
			?>
			
			<!-- Post Header -->
			<header class="entry-header">			
				<?php		
				// The Categories
				$category_list = get_the_category_list( ', ' );
				if ( $category_list && infinity_options('blog_post_categories') ) {
					echo '<div class="meta-categories">';
						if ( infinity_options('blog_post_category_prefix') ) {
							echo '<span class="category-prefix">'. esc_html__( 'In', 'portia' ) .'</span>'; 
						}
						echo $category_list;
					echo'</div>';
				}
				?>
				
				<!-- Post Title -->
				<h2 class="post-title">
					<a href="<?php esc_url( the_permalink() ); ?>" target="<?php echo (infinity_options('blog_post_window'))?'_blank':'_self'; ?>"><?php the_title(); ?></a>
				</h2>

				<!-- Post Author and Date -->
				<div class="meta-author-date">
					<?php
					
					// Post Date
					if ( infinity_options('blog_post_date') ) {

						// Get the date
						echo '<span class="meta-date">';
						echo get_the_time( get_option('date_format') );
						echo '</span>';
					}

					// Post Author
					if ( infinity_options('blog_post_author') ) {
						echo '<span class="author-prefix">'. esc_html__( 'By', 'portia' ) .'</span>';
						printf(
							'<a href="%1$s" rel="author">%2$s</a>',
							esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
							get_the_author()
						);
					} ?>
				</div>
			</header>
			
			<!-- Post Media -->		
			<?php
			if ( infinity_options('blog_post_header') === 'above-media' ) {
				get_template_part( 'templates/content/post-formats/'.$media_layout.'/media', $post_format ); 	
			}
			?>

			<!-- Post Content -->
			<div class="entry-content">
			<?php
				if ( infinity_options('blog_post_description') === 'the-excerpt' ) {		
					
					
					if( $current_layout === 'full' || $current_layout === 'full-post' ) {
						echo infinity_excerpt( infinity_options('blog_post_excerpt_length') );
					} else {
						echo infinity_excerpt( infinity_options('blog_post_grid_excerpt_length') );
					}

					if ( true === infinity_options('blog_post_read_more') || 'full-post' === $current_layout ) { ?>
						<div class="read-more">
							<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo infinity_options('blog_post_read_more_text'); ?></a>
						</div>
						<?php
					}	

				} else {
					the_content('');
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'portia' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) );
				}

			?>
			</div>

			<!-- Article footer -->
			<footer class="entry-footer">
				<?php
				// Post share
				infinity_sharing();
				?>

				<div class="clear"></div>
			</footer>
		</article>
 	<?php
	}
}


/**
 * ----------------------------------------------------------------------------------------
 * Full Post Layout Post Per Page
 * ----------------------------------------------------------------------------------------
 */

	function infinity_set_posts_per_page( $query ) {
		// Get Data
		global $wp_the_query;
		$home_layout = substr( infinity_options('general_home_layout'), 0, 4 );

	    if ( $home_layout!=='full' && infinity_options('general_full_post') && is_home() && !is_paged() ) {
	    	$default_posts_per_page = get_option( 'posts_per_page' );
			$default_posts_per_page++;
			$query->set( 'posts_per_page', $default_posts_per_page );
			return $query; 
		}

	}

	add_action( 'pre_get_posts',  'infinity_set_posts_per_page'  );



/**
 * ----------------------------------------------------------------------------------------
 * Carousel Function
 * ----------------------------------------------------------------------------------------
 */

	if ( ! function_exists( 'infinity_carousel' ) ) {
		
		function infinity_carousel() { 

			// Return woo single and category page
			if ( infinity_is_woo_activated() && ( is_product_category() || is_product() ) ) {
				return;
			}

			?>

			<!-- Carousel & Slider -->
			<div class="infinity-carousel-wrap <?php echo ( infinity_options('general_carousel_style') === 'boxed' ) ? 'center-width' : ''; ?>"
			data-columns="1"
			data-margin="0"
			data-stagepadding="0"
			data-autoplay="0"
			data-loop="1"
			data-navigation="<?php echo esc_attr( infinity_options('carousel_navigation') ); ?>"
			data-pagination="<?php echo esc_attr( infinity_options('carousel_pagination') ); ?>"
			data-slideby="1"
			>
				<!-- Owl Carousel Main -->
				<div class="infinity-carousel owl-carousel">
				
				<?php

				// Query Args
				$args = array(
					'post_type'		      => array( 'post' ),
				 	'orderby'		      => 'date',
					'order'			      => 'DESC',
					'posts_per_page'      => infinity_options('carousel_posts_amount'),
					'ignore_sticky_posts' => 1,
					'meta_query' 		  => array( array(
						'key' 		=> '_thumbnail_id',
						'compare' 	=> 'EXISTS'
					)),
				);

				if ( 'category' === infinity_options('carousel_query') ) {
					$args['cat'] = infinity_options( 'carousel_query_cat' );
				}

				if ( 'custom' === infinity_options('carousel_query') ) {
					$args['post_type'] = array( 'post', 'page' );
					$args['meta_query'] = array( 
					'relation'		=> 'AND',
					array(
						'key'	 	=> 'carousel-post',
						'value'	  	=> 'true',
						'compare' 	=> 'EXISTS',
					),
					array(
						'key' 		=> '_thumbnail_id',
						'compare' 	=> 'EXISTS'
					) );
				}

				$carouselPosts = new WP_Query();

				$carouselPosts->query( $args );

				while( $carouselPosts->have_posts() ) : $carouselPosts->the_post();
				
				if( has_post_thumbnail() ) :

				?>
				
				<div class="carousel-item" style="background-image:url(<?php echo esc_url( the_post_thumbnail_url() ); ?>)">
			
				<!-- Main Container -->
				<div class="container">
				<div class="outer">
				<div class="inner">

					<!-- Carousel Info -->
					<div class="carousel-item-info">
					<!-- The categories -->
					<?php $category_list = get_the_category_list( ', ' ); ?>					
					
					<?php if ( $category_list ) : ?>
					<div class="carousel-category">
						<?php echo '' . $category_list; ?>
					</div> 
					<?php endif; ?>

					<!-- Get The Title -->
					<h2 class="carousel-title"> 
						<a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a>								
					</h2>
					
					<!-- Carousel Post Content -->
					<div class="carousel-content">
						<?php
						echo infinity_excerpt( 15 );
						?>
					</div>
					
					<!-- Carousel Read More -->
					<div class="carousel-read-more">
						<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php esc_html_e( 'Continue Reading','portia' ); ?></a>
					</div>
					
					<!-- Get the Date -->
					<div class="carousel-date">
						<?php the_time( get_option('date_format') ); ?>
					</div>

					<!-- Comments and Likes -->
					<div class="carousel-like-comm">
						<!-- Get Like And Comment -->
						<?php
					
						echo getPostLikeLink( get_the_ID(), false ); 

						if ( comments_open() && !post_password_required() ) {
							comments_popup_link('<i class="fa fa-comment-o"></i>0', '<i class="fa fa-comment-o"></i>1', '<i class="fa fa-comment-o"></i>%', 'carousel-post-comment');
						} ?>
					</div>

					</div><!-- // End Carousel Info -->
					
				</div> <!-- // End Inner -->
				</div> <!-- // End Outer -->
				</div> <!-- // End Container -->
				</div>
			    <?php endif; ?>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
				</div>
			</div>

			<?php
		}
	}


/**
 * ----------------------------------------------------------------------------------------
 * Promo Boxes Function
 * ----------------------------------------------------------------------------------------
 */

	if ( ! function_exists( 'infinity_promo_box' ) ) {
		
		function infinity_promo_box() { 

			// Return woo single and category page
			if ( infinity_is_woo_activated() && ( is_product_category() || is_product() ) ) {
				return;
			} 

			$new_window = ( true === infinity_options( 'promo_box_window' ) )?'_blank':'_self'; ?>

			<div class="infinity-promo-box-area <?php echo ( infinity_options('general_promo_box_style') === 'boxed' ) ? 'center-width' : ''; ?>">
				
				<!-- Promo Box 1 -->
				<?php if ( !empty( infinity_options('promo_box_image_1') ) || ! empty( infinity_options('promo_box_title_1') ) ) : ?>	
				<div class="infinity-promo-box">
					<?php if ( ! empty( infinity_options('promo_box_link_1') ) ): ?>
						<a href="<?php echo esc_url(infinity_options('promo_box_link_1')); ?>" class="infinity-promo-box-link" target="<?php echo esc_attr($new_window); ?>"></a>
					<?php endif; ?>
					<div class="infinity-promo-box-bg" style="background-image:url(<?php echo esc_url(infinity_options('promo_box_image_1') ); ?>)"></div>
					<?php if ( ! empty( infinity_options('promo_box_title_1') ) ) : ?>
						<h4 class="infinity-promo-box-title"><?php echo esc_html( infinity_options('promo_box_title_1') ); ?></h4>
					<?php endif; ?>
				</div>
				<?php endif; ?>

				<!-- Promo Box 2 -->
				<?php if ( !empty( infinity_options('promo_box_image_2') ) || ! empty( infinity_options('promo_box_title_2') ) ) : ?>	
				<div class="infinity-promo-box">
					<?php if ( ! empty( infinity_options('promo_box_link_2') ) ): ?>
						<a href="<?php echo esc_url(infinity_options('promo_box_link_2')); ?>" class="infinity-promo-box-link" target="<?php echo esc_attr($new_window); ?>"></a>
					<?php endif; ?>
					<div class="infinity-promo-box-bg" style="background-image:url(<?php echo esc_url(infinity_options('promo_box_image_2') ); ?>)"></div>
					<?php if ( ! empty( infinity_options('promo_box_title_2') ) ) : ?>
						<h4 class="infinity-promo-box-title"><?php echo esc_html( infinity_options('promo_box_title_2') ); ?></h4>
					<?php endif; ?>
				</div>
				<?php endif; ?>

				<!-- Promo Box 3 -->
				<?php if ( !empty( infinity_options('promo_box_image_3') ) || ! empty( infinity_options('promo_box_title_3') ) ) : ?>	
				<div class="infinity-promo-box">
					<?php if ( ! empty( infinity_options('promo_box_link_3') ) ): ?>
						<a href="<?php echo esc_url(infinity_options('promo_box_link_3')); ?>" class="infinity-promo-box-link" target="<?php echo esc_attr($new_window); ?>"></a>
					<?php endif; ?>
					<div class="infinity-promo-box-bg" style="background-image:url(<?php echo esc_url(infinity_options('promo_box_image_3') ); ?>)"></div>
					<?php if ( ! empty( infinity_options('promo_box_title_3') ) ) : ?>
						<h4 class="infinity-promo-box-title"><?php echo esc_html( infinity_options('promo_box_title_3') ); ?></h4>
					<?php endif; ?>
				</div>
				<?php endif; ?>

			</div>
			
		<?php

		}
	}


/**
 * ----------------------------------------------------------------------------------------
 * Sidebar
 * ----------------------------------------------------------------------------------------
 */


	if ( ! function_exists( 'infinity_sidebar' ) ) {
		
		function infinity_sidebar( $type ) { ?>

			<?php if ( is_active_sidebar( 'sidebar-'.$type ) ) : ?>
			<div class="main-sidebar-wrap">
				<aside class="main-sidebar" data-effect="<?php echo esc_attr( infinity_options('general_sticky_sidebar') ); ?>" >
					<?php dynamic_sidebar( 'sidebar-'.$type ); ?>
				</aside>
			</div>
			<?php endif; ?>

			<?php
		}
	}


/**
 * ----------------------------------------------------------------------------------------
 * Social Function
 * ----------------------------------------------------------------------------------------
 */

	if ( ! function_exists( 'infinity_social' ) ) {
		
		function infinity_social( $social_class = '' ) {

			$html = '<div class="' . esc_attr( $social_class ) . '">';
			
			if ( trim( infinity_options('social_icon_1') ) !== '' ) {
				$html .= '<a href="'. esc_url( infinity_options('social_url_1') ) .'" target="_blank"><i class="fa fa-'. esc_attr(infinity_options('social_icon_1') ).'"></i></a>';
			}

			if ( trim( infinity_options('social_icon_2') ) !== '' ) {
				$html .= '<a href="'. esc_url( infinity_options('social_url_2') ) .'" target="_blank"><i class="fa fa-'. esc_attr(infinity_options('social_icon_2') ).'"></i></a>';
			}

			if ( trim( infinity_options('social_icon_3') ) !== '' ) {
				$html .= '<a href="'. esc_url( infinity_options('social_url_3') ) .'" target="_blank"><i class="fa fa-'. esc_attr(infinity_options('social_icon_3') ).'"></i></a>';
			}

			if ( trim( infinity_options('social_icon_4') ) !== '' ) {
				$html .= '<a href="'. esc_url( infinity_options('social_url_4') ) .'" target="_blank"><i class="fa fa-'. esc_attr(infinity_options('social_icon_4') ).'"></i></a>';
			}

			if ( trim( infinity_options('social_icon_5') ) !== '' ) {
				$html .= '<a href="'. esc_url( infinity_options('social_url_5') ) .'" target="_blank"><i class="fa fa-'. esc_attr(infinity_options('social_icon_5') ).'"></i></a>';
			}

			$html .= '</div>';

			return $html;

		}
	}



/**
 * ----------------------------------------------------------------------------------------
 * Preloader
 * ----------------------------------------------------------------------------------------
 */

	if ( ! function_exists( 'infinity_preloader' ) ) {

		function infinity_preloader() { ?>

			<div class="infinity-preloader">
				<?php if ( 'loader_logo' === infinity_options('general_preloader') && has_custom_logo() ) : ?>
					<?php $logo_src = wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ); ?>	
					<div class="infinity-load-spinner">
						<img src="<?php echo esc_url(  $logo_src ); ?>" alt="<?php esc_attr( bloginfo('name') ); ?>">
					</div>
				<?php elseif ( 'loader_1' === infinity_options('general_preloader') ) : ?>	
					<div class="infinity-load-spinner"></div>
				<?php endif; ?>
			</div>

		<?php

		}
	}


/**
 * ----------------------------------------------------------------------------------------
 * Breadcrumb Section
 * ----------------------------------------------------------------------------------------
 */


add_filter( 'woocommerce_breadcrumb_defaults', 'infinity_wcc_change_breadcrumb_delimiter' );

function infinity_wcc_change_breadcrumb_delimiter( $defaults ) {
	// Change the breadcrumb delimeter from '/' to '>'
	$defaults['wrap_before'] = '';
	$defaults['wrap_after'] = '';
	$defaults['delimiter'] = '<span class="separator"><i class="fa fa-angle-right"></i></span>';
	return $defaults;
}


if ( ! function_exists( 'infinity_breadcrumb' ) ) {

	function infinity_breadcrumb () {
	    
	    if ( true === infinity_options('single_post_breadcrumb') ) {
	   
	    // Settings
	    $separator  = '<i class="fa fa-angle-right"></i>';
	    $parents 	= '';	
	     
	    // Get the query & post information
	    global $post,$wp_query;
	    $category = get_the_category();
	
	    
	    //  Woo breadcrumb
	    if ( infinity_is_woo_activated() && is_woocommerce() ) {
		    echo '<div class="infinity-breadcrumbs">';
		    echo '<div class="center-width">';
				woocommerce_breadcrumb();
			echo '</div>';
			echo '</div>';

		} else if ( !is_front_page() && !is_404() ) {
	     // Build the breadcrums
	    
	    echo '<div class="infinity-breadcrumbs">';
	    echo '<div class="center-width">';
	    echo '<ul>';
	        // Home page
	        echo '<li><a href="' . esc_url( get_home_url( '/' ) ) . '" title="' .  esc_html__( 'Home', 'portia' ) . '">' .  esc_html__( 'Home', 'portia' ) . '</a></li>';
	        echo '<li class="separator"> ' . $separator . ' </li>';
	         
	        if ( is_single() && !is_attachment() ) {
	             
	            // Single post (Only display the first category)
	            echo '<li><a  href="' . esc_url( get_category_link($category[0]->term_id ) ) . '" title="' . esc_attr( $category[0]->cat_name ) . '">' . $category[0]->cat_name . '</a></li>';
	            echo '<li class="separator"> ' . $separator . ' </li>';
	            echo '<li>' . get_the_title() . '</li>';
	             
	        }  else if ( is_category() ) {
	             
	            // Category page
	            echo '<li>' . esc_html__( 'Category Archives:&nbsp;', 'portia' ) . $category[0]->cat_name . '</li>';
	             
	        } else if ( is_page() || is_attachment() ) {
	             
	            // Standard page
	            if( $post->post_parent ) {
	                 
	                // If child page, get parents 
	                $anc = get_post_ancestors( $post->ID );
	                 
	                // Get parents in the right order
	                $anc = array_reverse($anc);
	                
	                // Parent page loop
	                foreach ( $anc as $ancestor ) {
	                    $parents .= '<li><a href="' . esc_url( get_permalink($ancestor) ) . '" title="' . esc_attr(get_the_title($ancestor)) . '">' . get_the_title($ancestor) . '</a></li>';
	                    $parents .= '<li class="separator">' . $separator . '</li>';
	                }
	                 
	                // Display parent pages
	                 
	                echo '' . $parents;
	                // Current page
	                echo '<li>' . get_the_title() . '</li>';
	                 
	            } else {
	                 
	                // Just display current page if not parents
	                echo '<li> ' . get_the_title() . '</li>';
	                 
	            }
	             
	        } else if ( is_tag() ) {
	             
	            // Tag page
	             
	            // Get tag information
	            $term_id = get_query_var('tag_id');
	            $taxonomy = 'post_tag';
	            $args ='include=' . $term_id;
	            $terms = get_terms( $taxonomy, $args );
	             
	            // Display the tag name
	            echo '<li>'.esc_html__( 'Tag Archives:&nbsp;','portia' ) .'&nbsp;'. $terms[0]->name . '</li>';
	         
	        } elseif ( is_day() ) {
	             
	            // Day archive
	             
	            // Year link
	            echo '<li><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . esc_url( get_year_link( get_the_time('Y') ) ) . '" title="' . esc_attr( get_the_time('Y') ) . '">' . get_the_time('Y') . esc_html__('&nbsp;Year', 'portia' ) .'</a></li>';
	            echo '<li>' . $separator . '</li>';
	             
	            // Month link
	            echo '<li><a href="' . esc_url( get_month_link( get_the_time('Y'), get_the_time('m') ) ) . '" title="' . esc_attr( get_the_time('F') ) . '">' . get_the_time('F') .'</a></li>';
	            echo '<li class="separator"> ' . $separator . ' </li>';
	             
	            // Day display
	            echo '<li> ' . get_the_time('jS') . esc_html__('&nbsp;Archives:', 'portia' ) .'</li>';
	             
	        } else if ( is_month() ) {
	             
	            // Month Archive
	             
	            // Year link
	            echo '<li><a class="bread-year bread-year-' .esc_attr(  get_the_time('Y') ) . '" href="' . esc_url( get_year_link( get_the_time('Y') ) ). '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . esc_html__('&nbsp;Year', 'portia' ) .'</a></li>';
	            echo '<li class="separator"> ' . $separator . ' </li>';
	             
	            // Month display
	            echo '<li>' . get_the_time('F') .'</li>';
	             
	        } else if ( is_year() ) {
	             
	            // Display year archive
	            echo '<li>' . get_the_time('Y') . esc_html__('&nbsp;Year', 'portia' ) .'</li>';
	             
	        } else if ( is_author() ) {
	             
	            // Auhor archive
	             
	            // Get the author information
	            global $author;
	            $userdata = get_userdata( $author );
	             
	            // Display author name
	            echo '<li>' . esc_html__( 'Author:', 'portia' ) . '&nbsp;' . $userdata->display_name . '</li>';
	         	   
	        } else if ( is_search() ) {
	        	// Search results page
	            echo '<li>' . esc_html__( 'Search results for:', 'portia' ). '&nbsp;' . get_search_query() . '</li>';
	      
	        }  else if ( get_query_var('paged') ) {
	            // Paginated archives
	            echo '<li>'.esc_html__( 'Page:', 'portia' ) . '&nbsp;' . get_query_var('paged') . '</li>';
	        
	        }
	     echo '</ul>';
	     echo '</div>';
	     echo '</div>';
		}

		}
	}
}
   

   

/**
 * ----------------------------------------------------------------------------------------
 *  Sharing Function
 * ----------------------------------------------------------------------------------------
 */

	if ( ! function_exists( 'infinity_sharing' ) ) { 
		function infinity_sharing() {	
		
		global $post;

		// Post share 
		if ( infinity_options('blog_post_facebook_share') || infinity_options('blog_post_twitter_share') || infinity_options('blog_post_pinterest_share') || infinity_options('blog_post_googleplus_share') || infinity_options('blog_post_linkedin_share') || infinity_options('blog_post_tumblr_share') || infinity_options('blog_post_reddit_share') || infinity_options('blog_post_like') || infinity_options('blog_post_comment') ) : ?>	
			<div class="meta-share">

				<?php 
				// Post Like
				if ( infinity_options('blog_post_like') ) {
					echo getPostLikeLink( get_the_ID() );
				} ?>

				<?php if ( infinity_options('blog_post_facebook_share' ) ) : 
				$facebook_src = 'https://www.facebook.com/sharer/sharer.php?u='.esc_url( get_the_permalink() ); ?>
				<a class="facebook-share" target="_blank" href="<?php echo esc_url ( $facebook_src ); ?>">
					<i class="fa fa-facebook"></i>
					<span class="btn-info"><?php esc_html_e( 'Facebook', 'portia' ) ; ?></span>
				</a>
				<?php endif; ?>

				<?php if ( infinity_options('blog_post_twitter_share') ) : 
				$twitter_src = 'https://twitter.com/intent/tweet?text='.esc_attr(get_the_title()).'&url='.esc_url( get_the_permalink() ); ?>
				<a class="twitter-share" target="_blank" href="<?php echo esc_url ( $twitter_src ); ?>">
					<i class="fa fa-twitter"></i>
					<span class="btn-info"><?php esc_html_e( 'Twitter', 'portia' ) ; ?></span>
				</a>
				<?php endif; ?>

				<?php if ( infinity_options('blog_post_pinterest_share') ) : 
				$pinterest_src = 'https://pinterest.com/pin/create/button/?url='.esc_url( get_the_permalink() ).'&amp;media='.esc_url( wp_get_attachment_url( get_post_thumbnail_id($post->ID)) ).'&amp;description='.esc_attr(get_the_title()); ?>
				<a class="pinterest-share" target="_blank" href="<?php echo esc_url ( $pinterest_src ); ?>">
					<i class="fa fa-pinterest"></i>
					<span class="btn-info"><?php esc_html_e( 'Pinterest', 'portia' ) ; ?></span>
				</a>
				<?php endif; ?>

				<?php if ( infinity_options('blog_post_googleplus_share') ) : 
				$google_src = 'https://plus.google.com/share?url='. esc_url( get_the_permalink() ); ?>
				<a class="googleplus-share" target="_blank" href="<?php echo esc_url ( $google_src ); ?>">
					<i class="fa fa-google-plus"></i>
					<span class="btn-info"><?php esc_html_e( 'Google +', 'portia' ) ; ?></span>
				</a>										
				<?php endif; ?>

				<?php if ( infinity_options('blog_post_linkedin_share') ) :
				$linkedin_src = 'http://www.linkedin.com/shareArticle?url='.esc_url( get_the_permalink() ).'&amp;title='. esc_attr(get_the_title()); ?>
				<a class="linkedin-share" target="_blank" href="<?php echo esc_url( $linkedin_src ); ?>">
					<i class="fa fa-linkedin"></i>
					<span class="btn-info"><?php esc_html_e( 'Linkedin', 'portia' ) ; ?></span>
				</a>
				<?php endif; ?>

				<?php if ( infinity_options('blog_post_tumblr_share') ) : 
				$tumblr_src = 'http://www.tumblr.com/share/link?url='. urlencode( esc_url(get_permalink()) ) .'&amp;name='.urlencode( get_the_title() ).'&amp;description='.urlencode( get_the_excerpt() ); ?>
				<a class="tumblr-share" target="_blank" href="<?php echo esc_url( $tumblr_src ); ?>">
					<i class="fa fa-tumblr"></i>
					<span class="btn-info"><?php esc_html_e( 'Tumblr', 'portia' ) ; ?></span>
				</a>
				<?php endif; ?>

				<?php if ( infinity_options('blog_post_reddit_share') ) : 
				$reddit_src = 'http://reddit.com/submit?url='. esc_url( get_the_permalink() ) .'&amp;title='.esc_attr(get_the_title()); ?>
				<a class="reddit-share" target="_blank" href="<?php echo esc_url( $reddit_src ); ?>">
					<i class="fa fa-reddit"></i>
					<span class="btn-info"><?php esc_html_e( 'Reddit', 'portia' ) ; ?></span>
				</a>
				<?php endif; ?>
				<?php
				// Comments link
				if ( comments_open() &&  infinity_options('blog_post_comment') && !post_password_required() ) {
					comments_popup_link('<i class="fa fa-comment-o"></i><span class="btn-info">0</span>', '<i class="fa fa-comment-o"></i><span class="btn-info">1</span>', '<i class="fa fa-comment-o"></i><span class="btn-info">%</span>', 'infinity-post-comment');
				} ?>
			</div>
		<?php endif; 
		}
	}



/**
 * ----------------------------------------------------------------------------------------
 *  Comments Form Section
 * ----------------------------------------------------------------------------------------
 */

	if ( ! function_exists( 'infinity_comments' ) ) {

		function infinity_comments ( $comment, $args, $depth ) {
		
		$_GLOBAL['comment'] = $comment;

		if(get_comment_type() == 'pingback' || get_comment_type() == 'trackback' ) : ?>
			
		<li class="pingback" id="comment-<?php comment_ID(); ?>">
			<article <?php comment_class('entry-comments'); ?> >
				<div class="comment-content">
					<h3 class="comment-author">
						<?php esc_html_e( 'Pingback:', 'portia' ) ; ?>
					</h3>	
					<span class="comment-date" >
					<a href=" <?php echo esc_url( get_comment_link() ); ?> " class="comment-date" >
						<?php
						comment_date( get_option('date_format') );
						esc_html_e( '&nbsp;at&nbsp;', 'portia' ) ;
						comment_time( get_option('time_format') );
						?>
					</a>
					<?php
						echo edit_comment_link( esc_html__('&nbsp;[Edit]', 'portia' ) );
					?>
					</span>
					<div class="clear"></div>
					<div class="comment-text entry-content">			
					<?php comment_author_link(); ?>
					</div>
				</div>
			</article>
		</li>

		<?php elseif (get_comment_type() == 'comment') : ?>

			<li id="comment-<?php comment_ID(); ?>">
				
				<article <?php comment_class('entry-comments'); ?> >					
					<figure class="comment-avatar">
						<?php 
							$avatar_size = 60;
							if( $comment->comment_parent != 0 ) {
								$avatar_size = 55;
							}
							echo get_avatar( $comment, $avatar_size );
						?>
					</figure>
					<div class="comment-content">
					<h3 class="comment-author">
						<?php comment_author_link(); ?>
					</h3>
					<span class="comment-date" >
					<a href=" <?php echo esc_url( get_comment_link() ); ?> ">
						<?php
						comment_date( get_option('date_format') );
						esc_html_e( '&nbsp;at&nbsp;', 'portia' ) ;
						comment_time( get_option('time_format') );
						?>
					</a>
					<?php
						echo edit_comment_link( esc_html__('&nbsp;[Edit]', 'portia' ) );
					?>
					</span>
					<div class="clear"></div>
					<div class="comment-text entry-content">
					<?php if($comment->comment_approved == '0') : ?>
					<p class="awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'portia' ) ; ?></p>
					<?php endif; ?>
					<?php comment_text(); ?>
					</div>
					</div>
					<span class="reply">
						<?php comment_reply_link(array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth']) ) ); ?>
					</span>	
				</article>							
		<?php endif;
		}
	}



/**
 * ----------------------------------------------------------------------------------------
 *  Comments Fields Section
 * ----------------------------------------------------------------------------------------
 */

	function infinity_comment_form( $defaults ) {
		$defaults['comment_notes_before'] = '';
		$defaults['id_form'] = 'comment-form';
		$defaults['comment_field'] = '<p class="custom-textarea"><label for="comment">'. esc_html__( 'Comment', 'portia' ) .'</label><textarea name="comment" id="comment" cols="30" rows="10"></textarea></p>';
	 
		return $defaults;
	}

	add_filter('comment_form_defaults', 'infinity_comment_form');


	function infinity_comment_fields() {
		$commenter = wp_get_current_commenter();
		$req = get_option('require_name_email');
		$aria_req = ($req ?"aria-required = 'true'" : ' ' );

		$fields = array(
			'author' => '<p>' .
						'<label for="author">'.esc_html__('Name', 'portia' )  . ' '.($req ? '*' : ' ' ) .'</label>'.
						'<input type="text"  name="author" id="author"  value="'. esc_attr($commenter['comment_author']).'" '.$aria_req.'/>'.
						'</p>',

			 'email' => '<p>' .
						'<label for="email">'.esc_html__('Email', 'portia' )  . ' '.($req ? '*' : ' ' ) .'</label>'.
						'<input type="text"  name="email" id="email"  value="'. esc_attr($commenter['comment_author_email']).'" '.$aria_req.'/>'.
						'</p>',	

			 'url' =>  '<p>' .
						'<label for="url">'.esc_html__('Website', 'portia' )  .'</label>'.
						'<input type="text"  name="url" id="url"  value="'. esc_attr($commenter['comment_author_url']).'"/>'.
						'</p>',	
		);

		return $fields;
	}

	add_filter('comment_form_default_fields', 'infinity_comment_fields');


/**
 * ----------------------------------------------------------------------------------------
 *  Add title back to images
 * ----------------------------------------------------------------------------------------
 */

	function infinity_add_title_to_attachment( $markup, $id ){
		$att = get_post( $id );
		return str_replace('<a ', '<a title="'.$att->post_title.'" ', $markup);
	}

	add_filter('wp_get_attachment_link', 'infinity_add_title_to_attachment', 10, 5);



/**
 * ----------------------------------------------------------------------------------------
 *  WooCommerce
 * ----------------------------------------------------------------------------------------
 */

	// Check if WooCommerce is activated
	if ( ! function_exists( 'infinity_is_woo_activated' ) ) {
		function infinity_is_woo_activated() {
			if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
		}
	}


	// Woocommerce Content Wrap
	function infinity_woocommerce_before_main_content() {

		$woo_page_id = get_the_ID();

		if ( infinity_is_woo_activated() && ( is_shop() || is_product_category() || is_product() ) ) {
			$woo_page_id = get_option('woocommerce_shop_page_id');
		} 
	
		// Show carousel
		if ( get_post_meta( $woo_page_id, 'show-carousel', true ) ) {
			infinity_carousel();
		}

		// Promo Boxes
		if ( get_post_meta( $woo_page_id, 'show-promo-box', true ) ) {
			infinity_promo_box();
		} 

		$container_style = (get_post_meta( $woo_page_id, 'full-style', true ))?'':'center-width';
		
		$sidebar_page_position = 'nsidebar';
		if ( is_shop() || is_product_category() ) {
			$sidebar_page_position = get_post_meta( $woo_page_id, 'sidebar-position', true );
		}

		?>

		<div class="main-container-wrap" data-sidebar="<?php echo esc_attr( $sidebar_page_position ); ?>" >
			<div class="main-container-outer <?php echo esc_attr($container_style); ?>">
				<div class="main-container-inner">	
				<div class="main-container">

		<?php
	}
	add_action( 'woocommerce_before_main_content', 'infinity_woocommerce_before_main_content', 5 );

	// Woocommerce Content Wrap
	function infinity_woocommerce_after_main_content() {
				
		$woo_page_id = get_the_ID();

		if ( infinity_is_woo_activated() && ( is_shop() || is_product_category() || is_product() ) ) {
			$woo_page_id = get_option('woocommerce_shop_page_id');
		} ?>

		</div>
		<?php

		$sidebar_page_position = 'nsidebar';
		if ( is_shop() || is_product_category() ) {
			$sidebar_page_position = get_post_meta( $woo_page_id, 'sidebar-position', true );
		}

		// Get Woocommerce Widgets Area
		if ( is_active_sidebar( 'woocommerce-widgets' ) && $sidebar_page_position !== 'nsidebar' ) { ?>
			<div class="main-sidebar-wrap">
				<aside class="main-sidebar" data-effect="<?php echo esc_attr( infinity_options('general_sticky_sidebar') ); ?>" >
					<?php dynamic_sidebar( 'woocommerce-widgets' ); ?>
				</aside>
			</div>
		<?php } ?>

		</div>
		</div>
		</div>
		<?php

	}
	add_action( 'woocommerce_after_main_content', 'infinity_woocommerce_after_main_content', 50 );

	// Grid Columns
	if ( ! function_exists('infinity_loop_shop_columns') ) {
		function infinity_loop_shop_columns() {
			return 3;
		}
	}
	add_filter('loop_shop_columns', 'infinity_loop_shop_columns');

	// Products Per Page
	function infinity_loop_shop_per_page() {
		return 9;
	}
	add_filter( 'loop_shop_per_page', 'infinity_loop_shop_per_page', 20 );

	// Change related products grid columns
	function infinity_related_products_args( $args ) {
		$args['posts_per_page'] = 3;
		$args['columns'] = 3;
		return $args;
	}
	add_filter( 'woocommerce_output_related_products_args', 'infinity_related_products_args' );

	// Remove Sidebar
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

	//Reposition WooCommerce breadcrumb 
	function  infinity_woocommerce_remove_breadcrumb(){
	remove_action( 
	    'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
	}
	add_action(
	    'woocommerce_before_main_content', 'infinity_woocommerce_remove_breadcrumb'
	);




/**
 * Show cart contents / total Ajax
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<a class="cart-btn" href="<?php echo esc_url(wc_get_cart_url()); ?>">
		<i class="fa fa-shopping-cart"></i>
		<span class="cart-btn-count">
			<?php echo $woocommerce->cart->cart_contents_count; ?>
		</span>	
		<span class="btn-info"><?php esc_html_e( 'View cart', 'portia' ) ; ?></span>
	</a>
	<?php
	$fragments['a.cart-btn'] = ob_get_clean();
	return $fragments;
}
<?php 
add_action('customize_register', 'infinity_customize_register', 100);

function infinity_customize_register( $wp_customize ) {


/**
 * ----------------------------------------------------------------------------------------
 * Sanitize Callback Functions
 * ----------------------------------------------------------------------------------------
 */


	function infinity_sanitize_checkbox( $value ) {
		return $value ? true : false;
	}

	// Number absint
	function infinity_sanitize_number( $value, $setting ) {

		// integer value
		$value = absint( $value );

		return ( $value ? $value : $setting->default );

	}

	// Text
	function infinity_sanitize_textarea( $value ) {

		$tags = array(
			'a' => array(
				'href' 		=> array(),
				'title' 	=> array(),
				'_blank'	=> array()
			),
			'img' => array(
				'width'		=> array(),
				'height'	=> array(),
				'src' 		=> array(),
				'alt' 		=> array(),
				'style'		=> array(),
				'class'		=> array(),
				'id'		=> array()
			),
			'em' 	 => array(),
			'br' 	 => array(),
			'strong' => array()
		);

		return wp_kses( $value, $tags );

	}

	// Select
	function infinity_sanitize_select( $value, $setting ) {
			
		$options = $setting->manager->get_control( $setting->id )->choices;

		return ( array_key_exists( $value, $options ) ? $value : $setting->default );
	}



/**
 * ----------------------------------------------------------------------------------------
 * Customizer Control Function
 * ----------------------------------------------------------------------------------------
 */

	// Checkbox
	function infinity_checkbox_option( $section, $control, $name, $transport, $priority ) {
		
		global $wp_customize;

		$wp_customize->add_setting( 'infinity_options['. $section .'_'. $control .']', array(
			'default'	 		=> infinity_options( $section .'_'. $control ),
			'type'		 		=> 'option',
			'transport'	 		=> $transport,
			'capability' 		=> 'edit_theme_options',
			'sanitize_callback' => 'infinity_sanitize_checkbox'
		) );

		$wp_customize->add_control( 'infinity_options['. $section .'_'. $control .']', array(
			'label'		=> $name,
			'section'	=> 'infinity_'. $section,
			'type'		=> 'checkbox',
			'priority'	=> $priority
		) );
	}

	// Radio Button
	function infinity_radio_option( $section, $control, $name, $choices, $transport, $priority ) {
		
		global $wp_customize;

		$wp_customize->add_setting( 'infinity_options['. $section .'_'. $control .']', array(
			'default'	 		=> infinity_options( $section .'_'. $control ),
			'type'		 		=> 'option',
			'transport'	 		=> $transport,
			'capability' 		=> 'edit_theme_options',
			'sanitize_callback' => 'infinity_sanitize_select'
		) );
		
		$wp_customize->add_control( 'infinity_options['. $section .'_'. $control .']', array(
			'label'		=> $name,
			'section'	=> 'infinity_'. $section,
			'type'		=> 'radio',
			'choices' 	=> $choices,
			'priority'	=> $priority
		) );
	}

	// Text Input
	function infinity_text_option( $section, $control, $name, $transport, $priority ) {
		
		global $wp_customize;
		
		$wp_customize->add_setting( 'infinity_options['. $section .'_'. $control .']', array(
			'default'	 		=> infinity_options( $section .'_'. $control ),
			'type'		 		=> 'option',
			'transport'	 		=> $transport,
			'capability' 		=> 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_control( 'infinity_options['. $section .'_'. $control .']', array(
			'label'		=> $name,
			'section'	=> 'infinity_'. $section,
			'type'		=> 'text',
			'priority'	=> $priority
		) );
	}

	// Textarea Input Option
	function infinity_textarea_option( $section, $control, $name, $description, $transport, $priority ) {
		
		global $wp_customize;
		
		$wp_customize->add_setting( 'infinity_options['. $section .'_'. $control .']', array(
			'default'	 		=> infinity_options( $section .'_'. $control ),
			'type'		 		=> 'option',
			'transport'	 		=> $transport,
			'capability' 		=> 'edit_theme_options',
			'sanitize_callback' => 'infinity_sanitize_textarea'
		) );

		$wp_customize->add_control( 'infinity_options['. $section .'_'. $control .']', array(
			'label'			=> $name,
			'description'	=> wp_kses_post($description),
			'section'		=> 'infinity_'. $section,
			'type'			=> 'textarea',
			'priority'		=> $priority
		) );
	}

	// URL Input Option
	function infinity_url_option( $section, $control, $name, $transport, $priority ) {
		
		global $wp_customize;
		
		$wp_customize->add_setting( 'infinity_options['. $section .'_'. $control .']', array(
			'default'	 		=> infinity_options( $section .'_'. $control ),
			'type'		 		=> 'option',
			'transport'	 		=> $transport,
			'capability' 		=> 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		) );

		$wp_customize->add_control( 'infinity_options['. $section .'_'. $control .']', array(
			'label'		=> $name,
			'section'	=> 'infinity_'. $section,
			'type'		=> 'text',
			'priority'	=> $priority
		) );
	}

	// Number Input Option
	function infinity_number_option( $section, $control, $name, $input_attrs, $transport, $priority ) {
		
		global $wp_customize;

		$wp_customize->add_setting( 'infinity_options['. $section .'_'. $control .']', array(
			'default'	 		=> infinity_options( $section .'_'. $control ),
			'type'		 		=> 'option',
			'transport'	 		=> $transport,
			'capability' 		=> 'edit_theme_options',
			'sanitize_callback' => 'infinity_sanitize_number'
		) );

		$wp_customize->add_control( 'infinity_options['. $section .'_'. $control .']', array(
			'label'			=> $name,
			'section'		=> 'infinity_'. $section,
			'type'			=> 'number',
			'input_attrs' 	=> $input_attrs,
			'priority'		=> $priority
		) );
	}

	// Select Option
	function infinity_select_option( $section, $control, $name, $atts, $transport, $priority ) {
		
		global $wp_customize;
		
		$wp_customize->add_setting( 'infinity_options['. $section .'_'. $control .']', array(
			'default'			=> infinity_options( $section .'_'. $control ),
			'type'		 		=> 'option',
			'transport'	 		=> $transport,
			'capability' 		=> 'edit_theme_options',
			'sanitize_callback' => 'infinity_sanitize_select'
		) );

		$wp_customize->add_control( 'infinity_options['. $section .'_'. $control .']', array(
			'label'			=> $name,
			'section'		=> 'infinity_'. $section,
			'type'			=> 'select',
			'choices' 		=> $atts,
			'priority'		=> $priority
		) );
	}

	// Image Option
	function infinity_image_option( $section, $control, $name, $transport, $priority ) {
		
		global $wp_customize;
		
		$wp_customize->add_setting( 'infinity_options['. $section .'_'. $control .']', array(
		    'default' 			=> infinity_options( $section .'_'. $control ),
		    'type' 				=> 'option',
		    'transport'			=> $transport,
		    'sanitize_callback' => 'esc_url_raw'
		) );
		
		$wp_customize->add_control(
			new WP_Customize_Image_Control( $wp_customize, 'infinity_options['. $section .'_'. $control .']', array(
				'label'    => $name,
				'section'  => 'infinity_'. $section,
				'priority' => $priority
			)
		) );
	}

	// Image Crop Option
	function infinity_image_crop_option( $section, $control, $name, $width, $height, $transport, $priority ) {
		
		global $wp_customize;
		
		$wp_customize->add_setting( 'infinity_options['. $section .'_'. $control .']', array(
			'default' 			=> '',
			'type' 				=> 'option',
			'transport' 		=> $transport,
			'sanitize_callback' => 'infinity_sanitize_number'
		) );
		
		$wp_customize->add_control(
			new WP_Customize_Cropped_Image_Control( $wp_customize, 'infinity_options['. $section .'_'. $control .']', array(
				'label'    		=> $name,
				'section'  		=> 'infinity_'. $section,
				'flex_width'  	=> true,
				'flex_height' 	=> true,
				'width'       	=> $width,
				'height'      	=> $height,
				'priority' 		=> $priority
			)
		) );
	}

	// Color Option
	function infinity_color_option( $section, $control, $name, $transport, $priority ) {
		
		global $wp_customize;
		
		$wp_customize->add_setting( 'infinity_options['. $section .'_'. $control .']', array(
			'default'	 		=> infinity_options( $section .'_'. $control ),
			'type'		 		=> 'option',
			'transport'	 		=> $transport,
			'capability' 		=> 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'infinity_options['. $section .'_'. $control .']', array(
			'label' 	=> $name,
			'section' 	=> 'infinity_'. $section,
			'priority'	=> $priority
		) ) );
	}


/**
 * ----------------------------------------------------------------------------------------
 * Color Pannel
 * ----------------------------------------------------------------------------------------
 */
	$wp_customize->add_panel( 'color', array(
	    'priority'       => 1,
	    'capability'     => 'edit_theme_options',
	    'title'          => esc_html__( 'Colors', 'portia' ),
	));


/**
 * ----------------------------------------------------------------------------------------
 * Header Color Section
 * ----------------------------------------------------------------------------------------
 */

	$wp_customize->add_section('infinity_header_color', array(
		'title'			=> esc_html__( 'Header', 'portia' ),
		'priority'		=> 10,
		'capability'	=> 'edit_theme_options',
	    'panel'  		=> 'color',
	));

	
	infinity_color_option( 'header_color', 'bg', esc_html__( 'Background', 'portia' ), 'postMessage', 46 ); 

	// Site Title Color
	$wp_customize->get_control( 'header_textcolor' )->section = 'infinity_header_color';
	$wp_customize->get_control( 'header_textcolor' )->priority = 47;
	$wp_customize->get_control( 'header_textcolor' )->label = esc_html__( 'Title', 'portia' );
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	infinity_color_option( 'header_color', 'text_hv', esc_html__( 'Title Hover', 'portia' ), 'postMessage', 48 );

	infinity_color_option( 'header_color', 'tagline', esc_html__( 'Tagline', 'portia' ), 'postMessage', 49 );

	infinity_color_option( 'header_color', 'social', esc_html__( 'Socials', 'portia' ), 'postMessage', 50 ); 



/**
 * ----------------------------------------------------------------------------------------
 * General Color Section
 * ----------------------------------------------------------------------------------------
 */

	$wp_customize->add_section('infinity_general_color', array(
		'title'			=> esc_html__( 'General', 'portia' ),
		'priority'		=> 30,
		'capability'	=> 'edit_theme_options',
	    'panel'  		=> 'color',
	));

	// Body Background Color
	$wp_customize->get_control( 'background_color' )->section = 'infinity_general_color';
	$wp_customize->get_control( 'background_color' )->priority = 3;
	$wp_customize->get_setting( 'background_color' )->transport  = 'postMessage';

	infinity_color_option( 'general_color', 'accent', esc_html__( 'Accent', 'portia' ), 'postMessage', 15 ); 



/**
 * ----------------------------------------------------------------------------------------
 * General Section
 * ----------------------------------------------------------------------------------------
 */

	$wp_customize->add_section( 'infinity_general', array(
		'title'			=> esc_html__( 'General', 'portia' ),
		'priority'		=> 25
	));

	// Body Background
	$wp_customize->get_control( 'background_image' )->section = 'infinity_general';
	$wp_customize->get_control( 'background_image' )->priority = 1;
	$wp_customize->get_control( 'background_preset' )->section = 'infinity_general';
	$wp_customize->get_control( 'background_preset' )->priority = 2;
	$wp_customize->get_control( 'background_position' )->section = 'infinity_general';
	$wp_customize->get_control( 'background_position' )->priority = 3;
	$wp_customize->get_control( 'background_size' )->section = 'infinity_general';
	$wp_customize->get_control( 'background_size' )->priority = 4;
	$wp_customize->get_control( 'background_repeat' )->section = 'infinity_general';
	$wp_customize->get_control( 'background_repeat' )->priority = 5;
	$wp_customize->get_control( 'background_attachment' )->section = 'infinity_general';
	$wp_customize->get_control( 'background_attachment' )->priority = 6;


	// Sticky Sidebar
	infinity_checkbox_option( 'general', 'sticky_sidebar', esc_html__( 'Sticky Sidebar', 'portia' ), 'refresh', 14 );

	// Sidebar Width
	infinity_number_option( 'general', 'sidebar_width', esc_html__( 'Sidebar Width', 'portia' ), array( 'min' => '0', 'step' => '1' ), 'postMessage', 16 );

	// Preloader
	$preloader_choices = array(
		'none'			=> esc_html__( 'None','portia' ),
		'loader_logo'	=> esc_html__( 'Logo','portia' ),
		'loader_1'		=> esc_html__( 'Style 1','portia' ),
	);

	infinity_select_option( 'general', 'preloader', esc_html__( 'Animated Preloader', 'portia' ), $preloader_choices, 'refresh', 18 );

	//Full Width Post
	infinity_checkbox_option( 'general', 'full_post', esc_html__( 'Full Post ( Grid / List ) Layout', 'portia' ), 'refresh', 20 );

	// Page Layout List
	$general_layout = array(
		'full-nsidebar'	=>	esc_html__( 'One Column', 'portia' ),
		'full-rsidebar'	=>	esc_html__( 'One Column + Right Sidebar', 'portia' ),
		'col2-nsidebar'	=>	esc_html__( 'Grid 2 Columns', 'portia' ),
		'col2-rsidebar'	=>	esc_html__( 'Grid 2 Columns + Right Sidebar', 'portia' ),
		'col2-lsidebar' =>	esc_html__( 'Grid 2 Columns + Left Sidebar', 'portia' ),
	);

	// Home Page Layout
	infinity_select_option( 'general', 'home_layout', esc_html__( 'Post Page', 'portia' ), $general_layout, 'refresh', 25 );

	// Single Page Layout List
	$single_layout = array(
		'full-lsidebar'	=>	esc_html__( 'Right Sidebar', 'portia' ),
		'full-rsidebar'	=>	esc_html__( 'Right Sidebar', 'portia' ),
		'full-nsidebar'	=>	esc_html__( 'No Sidebar', 'portia' ),
	);

	// Single Page Layout
	infinity_select_option( 'general', 'single_layout', esc_html__( 'Single Page', 'portia' ), $single_layout, 'refresh', 30 );

	// Category Page Layout
	infinity_select_option( 'general', 'category_layout', esc_html__( 'Category Page', 'portia' ), $general_layout, 'refresh', 35 );

	// Tag Page Layout
	infinity_select_option( 'general', 'tag_layout', esc_html__( 'Tag Page', 'portia' ), $general_layout, 'refresh', 40 );

	// Archive Page Layout
	infinity_select_option( 'general', 'archive_layout', esc_html__( 'Archive Page', 'portia' ), $general_layout, 'refresh', 45 );

	// Search Page Layout
	infinity_select_option( 'general', 'search_layout', esc_html__( 'Search Page', 'portia' ), $general_layout, 'refresh', 50 );

	// Author Page Layout
	infinity_select_option( 'general', 'author_layout', esc_html__( 'Author Page', 'portia' ), $general_layout, 'refresh', 55 );

	// Sections Style
	$section_style_1 = array(
		'full'	=>	esc_html__( 'Full', 'portia' ),
		'boxed'	=>	esc_html__( 'Boxed', 'portia' ),
	);

	$section_style_2 = array(
		'full'	=>	esc_html__( 'Full', 'portia' ),
		'boxed'	=>	esc_html__( 'Boxed', 'portia' ),
		'contained'	=>	esc_html__( 'Contained', 'portia' ),
	);

	// Header Style
	infinity_select_option( 'general', 'header_style', esc_html__( 'Header Style', 'portia' ), $section_style_2, 'refresh', 60 );

	$carousel_style = array(
		'full' => esc_html__( 'Full','portia' ),
		'boxed'	=> esc_html__( 'Boxed','portia' ),
		'inner_grid' => esc_html__( 'Inner Grid','portia' ) 
	);

	// Carousel Style
	infinity_select_option( 'general', 'carousel_style', esc_html__( 'Carousel Style', 'portia' ), $carousel_style, 'refresh', 65 );

	// Promo Boxes Style
	infinity_select_option( 'general', 'promo_box_style', esc_html__( 'Promo Boxes Style', 'portia' ), $section_style_1, 'refresh', 70 );

	// Content Style
	infinity_select_option( 'general', 'content_style', esc_html__( 'Content Style', 'portia' ), $section_style_1, 'refresh', 75 );

	// Single Style
	infinity_select_option( 'general', 'single_style', esc_html__( 'Single Style', 'portia' ), $section_style_1, 'refresh', 80 );

	$footer_style = array(
		'boxed' 		=> esc_html__( 'Boxed','portia' ),
		'contained' 	=> esc_html__( 'Contained','portia' ),
	);

	// Footer Style
	infinity_select_option( 'general', 'footer_style', esc_html__( 'Footer Style', 'portia' ), $footer_style, 'refresh', 85 );

	
/**
 * ----------------------------------------------------------------------------------------
 * Header Panel
 * ----------------------------------------------------------------------------------------
 */
	$wp_customize->add_panel( 'infinity_header_panel', array(
	    'priority'       => 1,
	    'capability'     => 'edit_theme_options',
	    'title'          => esc_html__( 'Header', 'portia' ),
	    'description'    => '',
	));



/**
 * ----------------------------------------------------------------------------------------
 * Header Image Section
 * ----------------------------------------------------------------------------------------
 */

	// Change Header Image Section location
	$wp_customize->get_section('header_image' )->panel = 'infinity_header_panel';

	$wp_customize->get_control( 'header_image' )->priority = 10;

		// Background Image Size
	$wp_customize->add_setting( 'infinity_options[header_bg_size]', array(
	    'default' 			=> 'cover',
	    'type' 				=> 'option',
	    'sanitize_callback'	=> 'infinity_sanitize_select'
	));

	// Background Image Size
	$wp_customize->add_control( 'infinity_options[header_bg_size]', array(
		'label'    => esc_html__( 'Background Image Size', 'portia' ),
		'section'  => 'header_image',
		'type'     => 'radio',
		'choices'  => array(
			'pattern' => esc_html__( 'Pattern', 'portia' ),
			'cover'   => esc_html__( 'Cover', 'portia' ) 
		)
	));




/**
 * ----------------------------------------------------------------------------------------
 * Site Identity
 * ----------------------------------------------------------------------------------------
 */

	// Change Site Identity Section location
	$wp_customize->get_section('title_tagline' )->panel = 'infinity_header_panel';

	$wp_customize->get_control( 'custom_logo' )->priority = 5;
	$wp_customize->get_control( 'blogname' )->priority = 10;
	$wp_customize->get_control( 'blogdescription' )->priority = 15;
	$wp_customize->get_control( 'display_header_text' )->priority = 20;
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_control( 'display_header_text' )->label = esc_html__( 'Display Site Title', 'portia' );

	// Show Tagline
	$wp_customize->add_setting( 'infinity_options[header_tagline]', array(
		'default'			=> true,
		'type'				=> 'option',
	    'sanitize_callback' => 'infinity_sanitize_checkbox'
	));

	$wp_customize->add_control( 'infinity_options[header_tagline]', array(
		'label'		=> esc_html__( 'Display Site Tagline', 'portia' ),
		'section'	=> 'title_tagline',
		'type'		=> 'checkbox',
		'priority' 	=> 30
	));

	// Show Social
	$wp_customize->add_setting( 'infinity_options[header_social]', array(
		'default'			=> false,
		'type'				=> 'option',
	    'sanitize_callback' => 'infinity_sanitize_checkbox'
	));

	$wp_customize->add_control( 'infinity_options[header_social]', array(
		'label'		=> esc_html__( 'Show Social Icons', 'portia' ),
		'section'	=> 'title_tagline',
		'type'		=> 'checkbox',
		'priority' 	=> 32
	));


	// Header Logo Width Setting
	$wp_customize->add_setting( 'infinity_options[header_logo_width]', array(
		'default'			=> 600,
		'type'				=> 'option',
		'transport'	 		=> 'postMessage',
	    'sanitize_callback' => 'infinity_sanitize_number'
	));

	// Header Logo Width Control
	$wp_customize->add_control( 'infinity_options[header_logo_width]', array(
		'label'		=> esc_html__( 'Logo Width', 'portia' ),
		'section'	=> 'title_tagline',
		'type'		=> 'number',
		'input_attrs'	=> array( 'min' => '1', 'step' => '1'),
		'priority' 	=> 35
	));

	// Header Logo Distance Setting
	$wp_customize->add_setting( 'infinity_options[header_logo_top_magin]', array(
		'default'			=> 90,
		'type'				=> 'option',
		'transport'	 		=> 'postMessage',
	    'sanitize_callback' => 'infinity_sanitize_number'
	));

	// Header Logo Distance Control
	$wp_customize->add_control( 'infinity_options[header_logo_top_magin]', array(
		'label'		=> esc_html__( 'Logo Top Distance', 'portia' ),
		'section'	=> 'title_tagline',
		'type'		=> 'number',
		'input_attrs'	=> array( 'min' => '1', 'step' => '1'),
		'priority' 	=> 35
	));


/**
 * ----------------------------------------------------------------------------------------
 * Header Settings Section
 * ----------------------------------------------------------------------------------------
 */

	$wp_customize->add_section( 'infinity_header', array(
		'title'			=> esc_html__( 'Header Settings', 'portia' ),
	    'panel'  		=> 'infinity_header_panel',
	));

	// Top Bar
	infinity_checkbox_option( 'header', 'top_bar', esc_html__( 'Show Top Bar', 'portia' ), 'refresh', 5 );

	// Show Socials
	infinity_checkbox_option( 'header', 'top_social', esc_html__( 'Show Socials', 'portia' ), 'refresh', 15 );

	// Show Alt Sidebar
	infinity_checkbox_option( 'header', 'top_alt_sidebar', esc_html__( 'Show Alt Sidebar', 'portia' ), 'refresh', 20 );

	$top_menu_align = array(
		'left' 			=> esc_html__( 'Left','portia' ),
		'right'			=> esc_html__( 'Right','portia' ),
	);

	// Top Menu Align
	infinity_select_option( 'header', 'top_align', esc_html__( 'Align', 'portia' ), $top_menu_align, 'refresh', 25 );

	$main_menu_align = array(
		'left' 			=> esc_html__( 'Left','portia' ),
		'center' 		=> esc_html__( 'Center','portia' ),
		'right'			=> esc_html__( 'Right','portia' ),
	);

	// Main Menu Align
	infinity_select_option( 'header', 'nav_align', esc_html__( 'Align', 'portia' ), $main_menu_align, 'refresh', 40 );
	
	// Show Search
	infinity_checkbox_option( 'header', 'nav_search', esc_html__( 'Show Search', 'portia' ), 'refresh', 70 );

	// Show Random Button
	infinity_checkbox_option( 'header', 'nav_random_btn', esc_html__( 'Show Random Button', 'portia' ), 'refresh', 80 );

	// Mini Logo
	infinity_image_option( 'header', 'nav_logo', esc_html__( 'Logo Upload', 'portia' ), 'refresh', 90 );



/**
 * ----------------------------------------------------------------------------------------
 * Carousel Section
 * ----------------------------------------------------------------------------------------
 */

	$wp_customize->add_section('infinity_carousel', array(
		'title'			=> esc_html__( 'Slider / Carousel', 'portia' ),
		'priority'		=> 30
	));


	// Show Carousel
	infinity_checkbox_option( 'carousel', 'show', esc_html__( 'Show Carousel', 'portia' ), 'refresh', 5 );

	$carousel_query = array(
		'post' => esc_html__( 'Post','portia' ),
		'category'=> esc_html__( 'Categories','portia' ),
		'custom' => esc_html__( 'Custom - Metabox','portia' ) 
	);

	// Carousel Query
	infinity_select_option( 'carousel', 'query', esc_html__( 'Query', 'portia' ), $carousel_query, 'refresh', 7 );

	$query_cat = array();

	foreach ( get_categories() as $categories => $category ) {
	    $query_cat[$category->term_id] = $category->name;
	}

	infinity_select_option( 'carousel', 'query_cat', esc_html__( 'Select Category', 'portia' ), $query_cat, 'refresh', 8 );

	// Post Amount
	infinity_number_option( 'carousel', 'posts_amount', esc_html__( 'Posts Amount', 'portia' ), array( 'min' => '1', 'step' => '1', 'max' => '5' ), 'refresh', 10 );

	$carousel_nav = array(
		'off' 		=> esc_html__( 'Off','portia' ),
		'on' 		=> esc_html__( 'On','portia' ),
		'on_hover'	=> esc_html__( 'On Hover','portia' )
	);	

	// Carousel Navigation
	infinity_select_option( 'carousel', 'navigation', esc_html__( 'Show Navigation', 'portia' ), $carousel_nav, 'refresh', 60 );
	// Pagination
	infinity_checkbox_option( 'carousel', 'pagination', esc_html__( 'Show Pagination', 'portia' ), 'refresh', 65 );

	

/**
 * ----------------------------------------------------------------------------------------
 * Promo Boxes Section
 * ----------------------------------------------------------------------------------------
 */

	$wp_customize->add_section('infinity_promo_box', array(
		'title'			=> esc_html__( 'Promo Boxes', 'portia' ),
		'priority'		=> 40
	));

	// Show Promo Boxes
	infinity_checkbox_option( 'promo_box', 'show', esc_html__( 'Show Promo Boxes', 'portia' ), 'refresh', 1 );

	// Columns
	infinity_number_option( 'promo_box', 'columns', esc_html__( 'Columns', 'portia' ), array( 'min' => '0', 'step' => '1', 'max' => '3' ), 'refresh', 11 );

	// Show Border
	infinity_checkbox_option( 'promo_box', 'show_border', esc_html__( 'Show Border', 'portia' ), 'refresh', 14 );

	// Promo Box 1
	infinity_text_option( 'promo_box', 'title_1', esc_html__( 'Title', 'portia' ), 'refresh', 15 );

	infinity_url_option( 'promo_box', 'link_1', esc_html__( 'Link To', 'portia' ), 'refresh', 20 );

	infinity_image_option( 'promo_box', 'image_1', esc_html__( 'Image', 'portia' ), 'refresh', 25 );
	
	infinity_checkbox_option( 'promo_box', 'window_1', esc_html__( 'Open Post In New Window', 'portia' ), 'refresh', 27 );

	// Promo Box 2
	infinity_text_option( 'promo_box', 'title_2', esc_html__( 'Title', 'portia' ), 'refresh', 30 );

	infinity_url_option( 'promo_box', 'link_2', esc_html__( 'Link To', 'portia' ), 'refresh', 35 );

	infinity_image_option( 'promo_box', 'image_2', esc_html__( 'Image', 'portia' ), 'refresh', 40 );
	
	infinity_checkbox_option( 'promo_box', 'window_2', esc_html__( 'Open Post In New Window', 'portia' ), 'refresh', 42 );

	// Promo Box 3
	infinity_text_option( 'promo_box', 'title_3', esc_html__( 'Title', 'portia' ), 'refresh', 45 );

	infinity_url_option( 'promo_box', 'link_3', esc_html__( 'Link To', 'portia' ), 'refresh', 50 );

	infinity_image_option( 'promo_box', 'image_3', esc_html__( 'Image', 'portia' ), 'refresh', 55 );
	
	infinity_checkbox_option( 'promo_box', 'window_3', esc_html__( 'Open Post In New Window', 'portia' ), 'refresh', 58 );



/**
 * ----------------------------------------------------------------------------------------
 * Blog Posts Section
 * ----------------------------------------------------------------------------------------
 */

	$wp_customize->add_section('infinity_blog_post', array(
		'title'			=> esc_html__( 'Blog Posts', 'portia' ),
		'priority'		=> 40
	));

	// Open New Window
	infinity_checkbox_option( 'blog_post', 'window', esc_html__( 'Open Post In New Window', 'portia' ), 'refresh', 15 );

	// Pagination
	$pagination_choices = array(
		'default'			=> esc_html__( 'Default','portia' ),
		'numbered'			=> esc_html__( 'Numbered','portia' ),
		'expand-numbered'	=> esc_html__( 'Expand Numbered','portia' ),
	);

	infinity_select_option( 'blog_post', 'pagination', esc_html__( 'Pagination Style', 'portia' ), $pagination_choices, 'refresh', 25 );


 	// Post Header Position
	$post_header_choices = array(
		'above-media'	=> esc_html__( 'Above Media','portia' ),
		'below-media'	=> esc_html__( 'Below Media','portia' ) 
	);

	infinity_select_option( 'blog_post', 'header', esc_html__( 'Header Position', 'portia' ), $post_header_choices, 'refresh', 40 );

	// Post Categories
	infinity_checkbox_option( 'blog_post', 'categories', esc_html__( 'Show Category', 'portia' ), 'refresh', 75 );

	// Post Category Prefix
	infinity_checkbox_option( 'blog_post', 'category_prefix', esc_html__( 'Show Category Prefix', 'portia' ), 'refresh', 77 );
	
	// Post Date
	infinity_checkbox_option( 'blog_post', 'date', esc_html__( 'Show Date', 'portia' ), 'refresh', 80 );

	// Post Author
	infinity_checkbox_option( 'blog_post', 'author', esc_html__( 'Show Author', 'portia' ), 'refresh', 85 );

	// Drop Caps
	infinity_checkbox_option( 'blog_post', 'dropcap', esc_html__( 'Show Drop Caps', 'portia' ), 'refresh', 90 );

	// Post Description
	$post_description_choices = array(
		'the-content' 	=> esc_html__( 'The Content','portia' ),
		'the-excerpt'	=> esc_html__( 'The Excerpt','portia' ) 
	);

	infinity_select_option( 'blog_post', 'description', esc_html__( 'Post Description', 'portia' ), $post_description_choices, 'refresh', 95 );

	// Post Excerpt
	infinity_number_option( 'blog_post', 'excerpt_length', esc_html__( 'Except Length', 'portia' ), array( 'min' => '0', 'step' => '1' ), 'refresh', 100 );

	// Post Excerpt
	infinity_number_option( 'blog_post', 'grid_excerpt_length', esc_html__( 'Grid & List Except Length', 'portia' ), array( 'min' => '0', 'step' => '1' ), 'refresh', 100 );

	// Similar Post Description
	$similar_posts_choices = array(
		'none' 	=> esc_html__( 'None','portia' ),
		'related'	=> esc_html__( 'Related','portia' ),
		'random'	=> esc_html__( 'Random','portia' ) 
	);

	infinity_select_option( 'blog_post', 'similar_posts', esc_html__( 'Similar Posts', 'portia' ), $similar_posts_choices, 'refresh', 110 );

	// Read More
	infinity_checkbox_option( 'blog_post', 'read_more', esc_html__( 'Show Read More', 'portia' ), 'refresh', 111 );

	// Read More Text
	infinity_text_option( 'blog_post', 'read_more_text', esc_html__( 'Read More Text', 'portia' ), 'postMessage', 112 );

	// Like
	infinity_checkbox_option( 'blog_post', 'like', esc_html__( 'Show Like', 'portia' ), 'refresh', 115 );

	// Comment
	infinity_checkbox_option( 'blog_post', 'comment', esc_html__( 'Show Comment', 'portia' ), 'refresh', 120 );

	// Facebook
	infinity_checkbox_option( 'blog_post', 'facebook_share', esc_html__( 'Show Facebook', 'portia' ), 'refresh', 125 );

	// Twitter
	infinity_checkbox_option( 'blog_post', 'twitter_share', esc_html__( 'Show Twitter', 'portia' ), 'refresh', 130 );

	// Pinterest
	infinity_checkbox_option( 'blog_post', 'pinterest_share', esc_html__( 'Show Pinterest', 'portia' ), 'refresh', 135 );

	// Google Plus
	infinity_checkbox_option( 'blog_post', 'googleplus_share', esc_html__( 'Show Google Plus', 'portia' ), 'refresh', 140 );

	// Linkedin
	infinity_checkbox_option( 'blog_post', 'linkedin_share', esc_html__( 'Show Linkedin', 'portia' ), 'refresh', 145 );

	// Tumblr
	infinity_checkbox_option( 'blog_post', 'tumblr_share', esc_html__( 'Show Tumblr', 'portia' ), 'refresh', 150 );

	// Reddit
	infinity_checkbox_option( 'blog_post', 'reddit_share', esc_html__( 'Show Reddit', 'portia' ), 'refresh', 155 );



/**
 * ----------------------------------------------------------------------------------------
 * Single Posts Section
 * ----------------------------------------------------------------------------------------
 */

	$wp_customize->add_section('infinity_single_post', array(
		'title'			=> esc_html__( 'Single Page', 'portia' ),
		'priority'		=> 40
	));

	// Breadcrumb
	infinity_checkbox_option( 'single_post', 'breadcrumb', esc_html__( 'Show breadcrumb', 'portia' ), 'refresh', 160 );

	// Post Categories
	infinity_checkbox_option( 'single_post', 'categories', esc_html__( 'Show Category', 'portia' ), 'refresh', 75 );

	// Post Date
	infinity_checkbox_option( 'single_post', 'date', esc_html__( 'Show Date', 'portia' ), 'refresh', 80 );

	// Post Author
	infinity_checkbox_option( 'single_post', 'author', esc_html__( 'Show Author', 'portia' ), 'refresh', 85 );

	// Drop Caps
	infinity_checkbox_option( 'single_post', 'dropcap', esc_html__( 'Show Drop Caps', 'portia' ), 'refresh', 162 );

	// Tags
	infinity_checkbox_option( 'single_post', 'tags', esc_html__( 'Show Tags', 'portia' ), 'refresh', 165 );

	// Author Description
	infinity_checkbox_option( 'single_post', 'author_desc', esc_html__( 'Show Author Description', 'portia' ), 'refresh', 170 );

	// Pagination
	infinity_checkbox_option( 'single_post', 'pagination', esc_html__( 'Show Pagination', 'portia' ), 'refresh', 175 );

	// Similar Post Description
	$similar_posts_choices = array(
		'none' 	=> esc_html__( 'None','portia' ),
		'related'	=> esc_html__( 'Related','portia' ),
		'random'	=> esc_html__( 'Random','portia' ) 
	);

	infinity_select_option( 'single_post', 'similar_posts', esc_html__( 'Similar Posts', 'portia' ), $similar_posts_choices, 'refresh', 180 );

	// Similar Post Title
	infinity_text_option( 'single_post', 'similar_posts_title', esc_html__( 'Similar Posts Title', 'portia' ), 'refresh', 185 );

	// Post Comments
	infinity_checkbox_option( 'single_post', 'comment_area', esc_html__( 'Show Comments Area', 'portia' ), 'refresh', 190 );

	// Author Page Description
	infinity_checkbox_option( 'single_post', 'author_page_desc', esc_html__( 'Author Page Description', 'portia' ), 'refresh', 195 );

	// Category Page Description
	infinity_checkbox_option( 'single_post', 'cat_page_desc', esc_html__( 'Category Page Description', 'portia' ), 'refresh', 200 );



/**
 * ----------------------------------------------------------------------------------------
 * Footer Section
 * ----------------------------------------------------------------------------------------
 */

	$wp_customize->add_section('infinity_footer', array(
		'title'			=> esc_html__( 'Footer', 'portia' ),
		'priority'		=> 55
	));

	// Columns
	infinity_select_option( 'footer', 'column', esc_html__( 'Widget Columns', 'portia' ),array('none' => esc_html__( 'None','portia' ),'three' => esc_html__( 'Three','portia' ),'four' => esc_html__( 'Four','portia' ) ), 'refresh', 10 );

	// Social
	infinity_checkbox_option( 'footer', 'social', esc_html__( 'Show Social', 'portia' ), 'refresh', 15 );

	// Social
	infinity_checkbox_option( 'footer', 'back_to_top', esc_html__( 'Show Back to Top Button', 'portia' ), 'refresh', 20 );

	// Copyright 
	infinity_textarea_option( 'footer', 'copyright', esc_html__( 'Copyright', 'portia' ), esc_html__( 'Enter $year to update the year automatically', 'portia' ), 'refresh', 25 );


/**
 * ----------------------------------------------------------------------------------------
 * Typography Panel
 * ----------------------------------------------------------------------------------------
 */
	$wp_customize->add_panel( 'infinity_typography_panel', array(
	    'priority'       => 60,
	    'capability'     => 'edit_theme_options',
	    'title'          => esc_html__( 'Typography', 'portia' ),
	    'description'    => '',
	));


/**
 * ----------------------------------------------------------------------------------------
 * Header Typography Section
 * ----------------------------------------------------------------------------------------
 */

	$wp_customize->add_section('infinity_header_typography', array(
		'title'			=> esc_html__( 'Header Typography', 'portia' ),
		'priority'		=> 10,
		'panel'			=> 'infinity_typography_panel'
	));

	$fonts = array(
		'Vollkorn' => 'Vollkorn',
		'Voltaire' => 'Voltaire',
	);

	// Font Family
	infinity_select_option( 'header_typography', 'title_family', esc_html__( 'Font Family', 'portia' ), $fonts, 'refresh', 5 );

	// Font Size
	infinity_number_option( 'header_typography', 'title_size', esc_html__( 'Font Size', 'portia' ), array( 'min' => '10', 'step' => '1' ), 'refresh', 10 );

	// Line Height
	infinity_number_option( 'header_typography', 'title_height', esc_html__( 'Line Height', 'portia' ), array( 'min' => '1', 'step' => '0.1' ), 'refresh', 15 );

	// Letter Spacing
	infinity_number_option( 'header_typography', 'title_spacing', esc_html__( 'Letter Spacing', 'portia' ), array( 'min' => '0', 'step' => '0.1' ), 'refresh', 20 );

	// Font Weight
	infinity_number_option( 'header_typography', 'title_weight', esc_html__( 'Font Weight', 'portia' ), array( 'min' => '100', 'step' => '100' ), 'refresh', 25 );

	// Font Style
	infinity_checkbox_option( 'header_typography', 'title_style', esc_html__( 'Italic', 'portia' ), 'refresh', 30 );

	// Text Transform
	infinity_checkbox_option( 'header_typography', 'title_transform', esc_html__( 'Uppercase', 'portia' ), 'refresh', 35 );


/**
 * ----------------------------------------------------------------------------------------
 * General Typography Section
 * ----------------------------------------------------------------------------------------
 */


	$wp_customize->add_section('infinity_general_typography', array(
		'title'			=> esc_html__( 'General Typography', 'portia' ),
		'priority'		=> 20,
		'panel'			=> 'infinity_typography_panel'
	));

	// Latin
	infinity_checkbox_option( 'general_typography', 'subset_latin', esc_html__( 'Latin', 'portia' ), 'refresh', 80 );

	// Cyrillic
	infinity_checkbox_option( 'general_typography', 'subset_cyrillic', esc_html__( 'Cyrillic', 'portia' ), 'refresh', 85 );

	// Greek
	infinity_checkbox_option( 'general_typography', 'subset_greek', esc_html__( 'Greek', 'portia' ), 'refresh', 90 );

	// Vietnamese
	infinity_checkbox_option( 'general_typography', 'subset_vietnamese', esc_html__( 'Vietnamese', 'portia' ), 'refresh', 95 );
	


/**
 * ----------------------------------------------------------------------------------------
 * Social Section
 * ----------------------------------------------------------------------------------------
 */

	$wp_customize->add_section('infinity_social', array(
		'title'			=> esc_html__( 'Social Media', 'portia' ),
		'priority'		=> 65
	));

	$social_icons = array(
		'facebook' 				=> 'Facebook 1',
		'facebook-official'		=> 'Facebook 2',
		'facebook-square' 		=> 'Facebook 3',
		'instagram' 			=> 'Instagram',
		'twitter' 				=> 'Twitter 1',
		'twitter-square' 		=> 'Twitter 2',
		'flickr' 				=> 'Flickr',
		'pinterest' 			=> 'Pinterest 1',
		'pinterest-p' 			=> 'Pinterest 2',
		'pinterest-square'		=> 'Pinterest 3',
		'youtube-play' 			=> 'Youtube 1',
		'youtube' 				=> 'Youtube 2',
		'youtube-square' 		=> 'Youtube 3',
		'linkedin'				=> 'Linkedin 1',
		'linkedin-square' 		=> 'Linkedin 2',
		'google-plus' 			=> 'Google Plus 1',
		'google-plus-official'	=> 'Google Plus 2',
		'google-plus-square'	=> 'Google Plus 3',
		'google' 				=> 'Google',
		'behance' 				=> 'Behance 1',
		'behance-square'		=> 'Behance 2',
		'reddit' 				=> 'Reddit 1',
		'reddit-alien' 			=> 'Reddit 2',
		'reddit-square' 		=> 'Reddit 3',
		'tumblr' 				=> 'Tumblr 1',
		'tumblr-square' 		=> 'Tumblr 2',
		'dribbble' 				=> 'Dribbble',
		'vk' 					=> 'vKontakte',
		'skype' 				=> 'Skype',
		'film' 					=> 'Film',
		'soundcloud' 			=> 'Soundcloud',
		'vimeo-square' 			=> 'Vimeo 1',
		'info' 					=> 'Info 1',
		'info-circle' 			=> 'Info 2',
		'rss' 					=> 'RSS 1',
		'rss-square' 			=> 'RSS 2',
		'heart' 				=> 'Heart 1',
		'stack-overflow' 		=> 'Stack Overflow',
		'heart-o' 				=> 'Heart 2',
		'github' 				=> 'Github',
		'qq' 					=> 'QQ',
		'weibo' 				=> 'Weibo',
		'weixin' 				=> 'Weixin',
		'xing' 					=> 'Xing 1',
		'xing-square' 			=> 'Xing 2',
		'map-marker' 			=> 'Map Marker',
		'envelope' 				=> 'Envelope 1',
		'etsy' 					=> 'Etsy',
		'snapchat' 				=> 'Snapchat',
		'spotify'				=> 'Spotify',
		'shopping-cart'			=> 'Cart',
		'meetup' 				=> 'Meetup',
		'cc-paypal' 			=> 'PayPal',
		'credit-card' 			=> 'Credit Card', 
	);


	// Open New Window
	infinity_checkbox_option( 'social', 'window', esc_html__( 'Open Post In New Window', 'portia' ), 'refresh', 1 );

	// Social 1
	infinity_select_option( 'social', 'icon_1', esc_html__( 'Select Icon', 'portia' ), $social_icons, 'refresh', 5 );
	
	infinity_url_option('social','url_1',esc_html__( 'URL', 'portia' ), 'refresh', 10 );

	// Social 2
	infinity_select_option( 'social', 'icon_2', esc_html__( 'Select Icon', 'portia' ), $social_icons, 'refresh', 20 );
	
	infinity_url_option('social','url_2',esc_html__( 'URL', 'portia' ), 'refresh', 30 );

	// Social 3
	infinity_select_option( 'social', 'icon_3', esc_html__( 'Select Icon', 'portia' ), $social_icons, 'refresh', 40 );
	
	infinity_url_option('social','url_3',esc_html__( 'URL', 'portia' ), 'refresh', 50 );

	// Social 4
	infinity_select_option( 'social', 'icon_4', esc_html__( 'Select Icon', 'portia' ), $social_icons, 'refresh', 60 );
	
	infinity_url_option('social','url_4',esc_html__( 'URL', 'portia' ), 'refresh', 70 );

	// Social 5
	infinity_select_option( 'social', 'icon_5', esc_html__( 'Select Icon', 'portia' ), $social_icons, 'refresh', 80 );
	
	infinity_url_option('social','url_5',esc_html__( 'URL', 'portia' ), 'refresh', 90 );


}


/**
 * ----------------------------------------------------------------------------------------
 * Load Customizer Scripts
 * ----------------------------------------------------------------------------------------
 */

function infinity_customizer_scripts() {
	
	// Register style
	wp_register_style( 'infinity-customizer-css', INFINITY_THEMEROOT. '/inc/customizer/css/infinity-customizer.css', array(), '1.0' );
	wp_register_style('infinity-font-awesome', INFINITY_THEMEROOT . '/assets/css/font-awesome.min.css');

	// Register scripts 
	wp_register_script( 'infinity-customizer-js', INFINITY_THEMEROOT . '/inc/customizer/js/infinity-customizer.js', array( 'jquery' ), false, true );
	
	// Load the custom scripts
	wp_enqueue_script( 'infinity-customizer-js' );
	
	// Load the stylesheets
	wp_enqueue_style('infinity-customizer-css');
	wp_enqueue_style('infinity-font-awesome');
}

add_action( 'customize_controls_enqueue_scripts', 'infinity_customizer_scripts' );


function infinity_live_preview() {

	// Register scripts 
	wp_register_script( 'infinity-customizer-livepreview', INFINITY_THEMEROOT .'/inc/customizer/js/customizer-livepreview.js', array('jquery'), null, true );


	$infinity_options = array( 
		'header_color'		=> get_option('infinity_header_color'),
		'carousel_color'	=> get_option('infinity_carousel_color'),
		'general_color'		=> get_option('infinity_general_color'),
		'footer_color'		=> get_option('infinity_footer_color')
	);

	wp_localize_script( 'infinity-customizer-livepreview', 'infinity_options', $infinity_options );

	// Load the custom scripts
	wp_enqueue_script( 'infinity-customizer-livepreview' );

}

add_action( 'customize_preview_init', 'infinity_live_preview' );

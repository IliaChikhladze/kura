<?php

// Meta Box Style
function infinity_admin_styles(){
    global $typenow;
    if( $typenow == 'post' || $typenow == 'page' ) {
        wp_enqueue_style( 'infinity_meta_box_styles',  INFINITY_THEMEROOT . '/inc/metaboxes/css/admin.css' );
    }
}
add_action( 'admin_print_styles', 'infinity_admin_styles' );

// Metaboxs Scripts
function infinity_admin_scripts() {
    wp_enqueue_media();
    wp_enqueue_script( 'page_header_image', INFINITY_THEMEROOT. '/inc/metaboxes/js/infinity-metaboxs.js', array( 'jquery' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'infinity_admin_scripts' );

$infinity_metaboxes = array(
    
     // Post Options metaboxes
    'infinity-post-metabox' => array(
        'title'             => esc_html__('Post Options', 'inf_lang'),
        'applicableto'      => 'post',
        'location'          => 'normal',
        'display_condition' => 'post-option',
        'priority'          => 'high',
        'fields'            => array(
            'carousel-post'    => array(
                'title'         => esc_html__('&nbsp;Show Feature Image in Carousel', 'inf_lang'),
                'type'          => 'checkbox',
                'description'   => '',
                'class'         => ''
            ),
            'hide-feature-media' => array(
                'title'         => esc_html__('&nbsp;Hide Feature Image on Single Page', 'inf_lang'),
                'type'          => 'checkbox',
                'description'   => '',
                'class'         => ''
            ),
            'hide-logo'      => array(
                'title'         => esc_html__('&nbsp;Hide Logo on Single Page', 'inf_lang'),
                'type'          => 'checkbox',
                'description'   => '',
                'class'         => ''
            ),
            'hide-sidebar' => array(
                'title'         => esc_html__('&nbsp;Hide Sidebar on Single Page', 'inf_lang'),
                'type'          => 'checkbox',
                'description'   => '',
                'class'         => ''
            ),
        )
    ),
    // Page Options
    'infinity-page-meta-box' => array(
        'title'             => esc_html__('Page Options', 'inf_lang'),
        'applicableto'      => 'page',
        'location'          => 'normal',   
        'display_condition' => 'page-option',
        'priority'          => 'high',
        'fields'            => array(  
            'show-carousel'    => array(
                'title'         => esc_html__('&nbsp;Show Carousel', 'inf_lang'),
                'type'          => 'checkbox',
                'description'   => '',
                'class'         => ''
            ),
            'show-promo-box'    => array(
                'title'         => esc_html__('&nbsp;Show Promo Boxes', 'inf_lang'),
                'type'          => 'checkbox',
                'description'   => '',
                'class'         => ''
            ),
            'carousel-post'    => array(
                'title'         => esc_html__('&nbsp;Show Feature Image in Carousel', 'inf_lang'),
                'type'          => 'checkbox',
                'description'   => '',
                'class'         => ''
            ),
            'hide-logo'      => array(
                'title'         => esc_html__('&nbsp;Hide Logo', 'inf_lang'),
                'type'          => 'checkbox',
                'description'   => '',
                'class'         => ''
            ),
            'hide-feature-media' => array(
                'title'         => esc_html__('&nbsp;Hide Feature Image', 'inf_lang'),
                'type'          => 'checkbox',
                'description'   => '',
                'class'         => ''
            ),
             'hide-title'      => array(
                'title'         => esc_html__('&nbsp;Hide Title', 'inf_lang'),
                'type'          => 'checkbox',
                'description'   => '',
                'class'         => ''
            ),
            'show-social'      => array(
                'title'         => esc_html__('&nbsp;Show Social Share Buttons', 'inf_lang'),
                'type'          => 'checkbox',
                'description'   => '',
                'class'         => ''
            ),
            'full-style'      => array(
                'title'         => esc_html__('&nbsp;Content Full Style', 'inf_lang'),
                'type'          => 'checkbox',
                'description'   => '',
                'class'         => ''
            ),
            'sidebar-position'    => array(
                'title'         => esc_html__('Sidebar Position&nbsp;', 'inf_lang'),
                'type'          => 'select',
                'description'   => '',
                'class'         => ''
            )
        )
    ),
    // Link metaboxes
    'infinity-link-meta-box' => array(
        'title'             => esc_html__('Link Format', 'inf_lang'),
        'applicableto'      => 'post',
        'location'          => 'normal',
        'display_condition' => 'post-format-link',
        'priority'          => 'core',
        'fields'            => array(     
           
            'link_text'   => array(
                'title'         => esc_html__('Link Text:', 'inf_lang'),
                'type'          => 'input',
                'description'   => '',
                'class'         => 'infinity-metabox'
            ),

            'link_url'   => array(
                'title'         => esc_html__('Link (URL):', 'inf_lang'),
                'type'          => 'input',
                'description'   => '',
                'class'         => 'infinity-metabox'
            )
        )
    ),
    // quote metaboxes
    'infinity-quote-meta-box'    => array(
        'title'             => esc_html__('Quote Format', 'inf_lang'),
        'applicableto'      => 'post',
        'location'          => 'normal',
        'display_condition' => 'post-format-quote',
        'priority'          => 'core',
        'fields'            => array(            
            'quote_text'       => array(
                'title'         => esc_html__('Quote:', 'inf_lang'),
                'type'          => 'input',
                'description'   => '',
                'class'         => 'infinity-metabox'
            ),
            
            'quote_author'  => array(
                'title'         => esc_html__('Quote Author:', 'inf_lang'),
                'type'          => 'input',
                'description'   => '',
                'class'         => 'infinity-metabox'
            )
        )
    ),
);

//Add metaboxes
function infinity_add_post_format_metabox() {
    global $infinity_metaboxes;
    if ( ! empty( $infinity_metaboxes ) ) {
        foreach ( $infinity_metaboxes as $id => $metabox ) {
            add_meta_box( $id, $metabox['title'], 'infinity_show_metaboxes', $metabox['applicableto'], $metabox['location'], $metabox['priority'], $id );
        }
    }
}
add_action( 'admin_init', 'infinity_add_post_format_metabox' );

//Show metaboxes
function infinity_show_metaboxes( $post, $args ) {
    global $infinity_metaboxes;
    global $post;
    $custom = get_post_custom( $post->ID );
    $fields = $infinity_metaboxes[$args['id']]['fields'];
    /** Nonce **/
    $output = '<input type="hidden" name="post_format_meta_box_nonce" value="' . esc_attr( wp_create_nonce( basename( __FILE__ ) ) ) . '" />';
 
    if ( sizeof( $fields ) ) {
        foreach ( $fields as $id => $field ) {
            $meta_box_text  = isset($custom[$id][0])?$custom[$id][0]:'';
                   
            switch ( $field['type'] ) {
                default:
                case "input":
                    $output .= '<label for="' . esc_attr( $id ) . '" class="'. esc_attr( $field['class'] ) .'-label" >' . $field['title'] . '</label><input id="' . esc_attr( $id ) . '" class="'. esc_attr( $field['class'] ) .'-input" type="text" name="' . esc_attr( $id ) . '" value="' . esc_attr( $meta_box_text ). '" />';
                    break;
                case "textarea":
                    $output .= '<label for="' . esc_attr( $id ) . '" class="'. esc_attr( $field['class'] ) .'-label" >' . $field['title'] . '</label><textarea id="' . esc_attr( $id ). '" name="' . esc_attr( $id ) . '" class="'. esc_attr( $field['class'] ) .'-textarea" >' . $meta_box_text . '</textarea>';
                    break;
                case  "checkbox":
                $field_id_value = get_post_meta($post->ID, $id, true);
                $field_id_checked = '';
                if($field_id_value) $field_id_checked = 'checked'; ?>
               <div>
                    <p>
                        <label for="<?php echo esc_attr( $id ); ?>" class="'<?php echo esc_attr( $field['class'] ); ?>'-label" >
                            <input id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $field['class'] ).'-input'; ?>"  type="checkbox" name="<?php echo esc_attr( $id ); ?>" value="true" <?php echo $field_id_checked; ?> />
                            <?php echo $field['title']; ?>
                        </label>
                    </p>
                </div>
                <?php     
                break;
                case  "select":
                $field_value        = get_post_meta($post->ID, $id, true);
                $select_nsidebar    = ( ( isset ( $field_value ) ) ? selected( $field_value, 'nsidebar', false ) : '' ); 
                $select_rsidebar    = ( ( isset ( $field_value ) ) ? selected( $field_value, 'rsidebar', false ) : '' );
                $select_lsidebar    = ( ( isset ( $field_value ) ) ? selected( $field_value, 'lsidebar', false ) : '' );  ?>
                <div>
                    <p>
                        <label for="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $field['class'] ); ?>-label" > <?php echo $field['title']; ?></label>
                        <select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $field['class'] ); ?>-select">
                            <option value="nsidebar" <?php echo $select_nsidebar; ?>><?php esc_html_e( 'None', 'inf_lang' ) ?></option>
                            <option value="rsidebar" <?php echo $select_rsidebar; ?>><?php esc_html_e( 'Right Sidebar', 'inf_lang' ) ?></option>
                            <option value="lsidebar" <?php echo $select_lsidebar; ?>><?php esc_html_e( 'Left Sidebar', 'inf_lang' ) ?></option>
                        </select>             
                    </p>
                </div>
                <?php
                $field_value = '';
                break;    
            }
        }
    } 

    echo '' . $output;
}
add_action( 'save_post', 'infinity_save_metaboxes' );


function infinity_save_metaboxes( $post_id ) {
    global $infinity_metaboxes;
    global $post;
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'infinity_nonce' ] ) && wp_verify_nonce( $_POST[ 'infinity_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    $post_type = get_post_type();
 
    // loop through fields and save the data
    foreach ( $infinity_metaboxes as $id => $metabox ) {
        // check if metabox is applicable for current post type
        if ( $metabox['applicableto'] == $post_type ) {
            $fields = $infinity_metaboxes[$id]['fields'];
 
            foreach ( $fields as $id => $field ) {
                $old = get_post_meta( $post_id, $id, true );
                
                if ( isset($_POST[$id]) ) {
                    $new = $_POST[$id];
                } else {
                    $new = '';
                }              
               
 
                if ( $new && $new != $old ) {
                    update_post_meta( $post_id, $id, $new );
                }

                elseif ( '' == $new && $old || ! isset( $_POST[$id] ) ) {
                    delete_post_meta( $post_id, $id, $old );
                }

            }
        }
    }
}



// Display metaboxes 
function infinity_display_metaboxes() {

    ?>
    <script>
        jQuery(document).ready(function( $ ) {

            function infinityMetaboxes( selector ) {
                
                // hide metaboxes
                $('#infinity-audio-meta-box,#infinity-video-metabox,#royal_gallery_post_meta_box,#infinity-link-meta-box,#infinity-quote-meta-box').css({ 'display' : 'none' });

                if ( selector.val() === 'link' ) {
                    $('#infinity-link-meta-box').removeAttr('style');
                } if ( selector.val() === 'quote' ) {
                    $('#infinity-quote-meta-box').removeAttr('style');
                }
            }

            // Load DOM
            $(window).on('load',function() {
            
                infinityMetaboxes( $('[id*="post-format-selector"],input[name="post_format"]:checked') );

                $('[id*="post-format-selector"],.post-format').on( 'change', function() {
                    infinityMetaboxes( $(this) );
                });
            });

        }); // end dom ready

    </script>
    <?php
}
add_action( 'admin_print_scripts', 'infinity_display_metaboxes', 1000 );



// Add a category header image field 
function add_category_header_img( $taxonomy ) { ?>
    <div class="form-field term-header-img-wrap">
        <label for="category-header-img-data"><?php esc_html_e( 'Header Image', 'inf_lang' ); ?></label>
        <input type="hidden" id="category-header-img-data" name="category-header-img-data" >
        <p><img id="category-header-img" style="width: 200px;cursor: pointer;"></p>
        <p id="category-header-img-desc" style="color: #666;font-style: italic;"> <?php esc_html_e('Click the image to edit or update', 'inf_lang'); ?></p>
        <a href="#" id="category-header-img-upload"><?php esc_html_e('Set header image', 'inf_lang'); ?></a>
        <a href="#" id="category-header-img-remove"><?php esc_html_e('Remove header image', 'inf_lang'); ?></a>
    </div>
    <?php
}
add_action( 'category_add_form_fields','add_category_header_img', 10, 2 );

// Save category header image data
function save_category_header_img( $term_id ) {
    if( isset( $_POST['category-header-img-data'] ) && $_POST['category-header-img-data'] !== '' ) {
        $category_header_img = $_POST['category-header-img-data'];
        add_term_meta( $term_id, 'category-header-img-data', $category_header_img, true );
    }
}
add_action( 'created_category','save_category_header_img', 10, 2 ); 

// Edit category header image field 
function update_category_header_img( $term, $taxonomy ) { ?>
    <tr class="form-field term-header-img-wrap">
        <th scope="row">
            <label for="category-header-img-data"><?php esc_html_e( 'Header Image', 'inf_lang' ); ?></label>
        </th>
        <td>
            <?php $category_header_img_url = get_term_meta( $term->term_id, 'category-header-img-data', true ); ?>
            <input type="hidden" id="category-header-img-data" name="category-header-img-data"  value="<?php echo esc_url($category_header_img_url); ?>" >
            <p><img id="category-header-img" src="<?php echo esc_url($category_header_img_url); ?>" style="width: 200px;cursor: pointer;"></p>    
            <p id="category-header-img-desc" style="color: #666;font-style: italic;"> <?php esc_html_e('Click the image to edit or update', 'inf_lang'); ?></p>
            <p><a href="#" id="category-header-img-upload"><?php esc_html_e('Set header image', 'inf_lang'); ?></a></p>
            <p><a href="#" id="category-header-img-remove"><?php esc_html_e('Remove header image', 'inf_lang'); ?></a></p>
 
        </td>
    </tr>
<?php
}
add_action( 'category_edit_form_fields','update_category_header_img', 10, 2 );
  
// Update category header image field
function updated_category_header_img( $term_id ) {
    if( isset( $_POST['category-header-img-data'] ) && $_POST['category-header-img-data'] !== '' ) {
        $category_header_img_id = $_POST['category-header-img-data'];
        update_term_meta ( $term_id, 'category-header-img-data',  $category_header_img_id );
    } else {
        update_term_meta ( $term_id, 'category-header-img-data', '' );
    }
}
add_action( 'edited_category','updated_category_header_img', 10, 2 );
  
// Add a category logo field 
function add_category_logo( $taxonomy ) { ?>
     <div class="form-field term-logo-wrap">
        <label for="category-logo" >
        <input type="checkbox" id="category-logo"  name="category-logo" value="false"  />
        <?php esc_html_e( 'Hide Logo', 'inf_lang' ); ?>
        </label>
    </div>
    <?php
}
add_action( 'category_add_form_fields','add_category_logo', 10, 2 );

// Save category logo data
function save_category_logo( $term_id ) {
    if( isset( $_POST['category-logo'] ) && $_POST['category-logo'] !== '' ) {
        $category_logo_id = $_POST['category-logo'];
        add_term_meta( $term_id, 'category-logo', $category_logo_id, true );
    }
}
add_action( 'created_category','save_category_logo', 10, 2 ); 

// Edit category logo field 
function update_category_logo( $term, $taxonomy ) { 
    $field_value =  get_term_meta( $term->term_id, 'category-logo', true );
    $field_checked = ($field_value)?'checked':''; ?>
    <tr class="form-field term-logo-wrap">
        <th scope="row">
            <label for="category-logo" ><?php esc_html_e( 'Hide Logo', 'inf_lang' ); ?></label>
        </th>
        <td>
            <input type="checkbox" id="category-logo"  name="category-logo" value="false" <?php echo $field_checked; ?> />
        </td>
    </tr>
<?php
}
add_action( 'category_edit_form_fields','update_category_logo', 10, 2 );

// Update category logo field
function updated_category_logo( $term_id ) {
    if( isset( $_POST['category-logo'] ) && $_POST['category-logo'] !== '' ) {
        $category_logo_id = $_POST['category-logo'];
        update_term_meta ( $term_id, 'category-logo',  $category_logo_id );
    } else {
        update_term_meta ( $term_id, 'category-logo', '' );
    }
}
add_action( 'edited_category','updated_category_logo', 10, 2 );

// Register Page Header Image Metabox
function register_page_header_img() {
    add_meta_box( 'image_metabox', esc_html__('Header Image', 'inf_lang'), 'page_header_img_callback', 'post', 'side', 'low', 'image_metabox' );
    add_meta_box( 'image_metabox', esc_html__('Header Image', 'inf_lang'), 'page_header_img_callback', 'page', 'side', 'low', 'image_metabox' );
}
add_action( 'add_meta_boxes', 'register_page_header_img' );

// Add Page Header Image Field
function page_header_img_callback( $post_id ) {
    wp_nonce_field( basename( __FILE__ ), 'page_header_img_nonce' ); ?>
    <div id="page-header-img-wrap">
        <?php $image_url = get_post_meta( get_the_ID(), 'page-header-img-data', true ); ?>
        <p><img id="page-header-img" src="<?php echo esc_url($image_url); ?>" style="width: 100%;cursor: pointer;"></p>
        <input type="hidden" id="page-header-img-data" name="page-header-img-data" value="<?php echo esc_url($image_url); ?>">
        <p id="page-header-img-desc" style="color: #666;font-style: italic;"> <?php esc_html_e('Click the image to edit or update', 'inf_lang'); ?></p>
        <p><a href="#" id="page-header-img-upload"><?php esc_html_e('Set header image', 'inf_lang'); ?></a></p>
        <p><a href="#" id="page-header-img-remove"><?php esc_html_e('Remove header image', 'inf_lang'); ?></a></p>
        <p></p>
    </div>
    <?php
}

// Save Page Header Image Field
function save_page_header_img( $post_id ) {
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'page_header_img_nonce' ] ) && wp_verify_nonce( $_POST[ 'page_header_img_nonce' ], basename( __FILE__ ) ) )? 'true' : 'false';

    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    if ( isset( $_POST[ 'page-header-img-data' ] ) && $_POST['page-header-img-data'] !== '' ) {
        $image_data = $_POST[ 'page-header-img-data' ];
        update_post_meta( $post_id, 'page-header-img-data', $image_data );
    } else {
          update_post_meta( $post_id, 'page-header-img-data', '' );
    }
}
add_action( 'save_post', 'save_page_header_img' );

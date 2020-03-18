<?php


/*
***************************************************************
* #Enqueue Scripts & Styles
***************************************************************
*/

	function royal_admin_enqueue_scripts( $hook ) {
		
	    global $post;

	    // enqueue scripts & styles
	    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {

			wp_enqueue_style( 'metabox-css', INFINITY_THEMEROOT .'/inc/plugins/royal-backend-gallery/assets/css/metabox-ui.css' );

	        if ( 'page' !== $post->post_type ) {
				wp_enqueue_script( 'image-upload-js', INFINITY_THEMEROOT .'/inc/plugins/royal-backend-gallery/assets/js/image-upload.js' );
	        }

	    }
	}

	add_action( 'admin_enqueue_scripts', 'royal_admin_enqueue_scripts' );

	// func to check if current user is permited to save data - Gist by Tom Mcfarlin. Thanks to Tom :)
	function royal_user_can_save( $post_id, $nonce ) {

		$is_autosave 	= wp_is_post_autosave( $post_id );
		$is_revision 	= wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST[ $nonce ] ) && wp_verify_nonce( $_POST[ $nonce ], 'royal_nonce' ) );

		// Return true if the user is able to save - otherwise, false.
		return ! ( $is_autosave || $is_revision ) && $is_valid_nonce;
	}


/* ----------------- Post Format: Gallery ----------------- */

	// Add
	function royal_add_gallery_post_meta_box() {
		add_meta_box(
			'royal_gallery_post_meta_box',
			__( 'Post Format: Gallery', 'inf_lang' ),
			'royal_display_gallery_post_meta_box',
			'post',
			'normal',
			'high'
		);
	}

	add_action( 'add_meta_boxes', 'royal_add_gallery_post_meta_box' );

	// Display
	function royal_display_gallery_post_meta_box( $post ) {
		// Security check - define nonce field
		wp_nonce_field( 'royal_nonce', 'gallery_post_nonce' );

		// get post meta data
		$rf_gallery_img_ids  = get_post_meta( $post->ID, 'rf_gallery_img_ids', true );
		$rf_gallery_imgs_src = get_post_meta( $post->ID, 'rf_gallery_imgs_src', true );

		// gallery image ids
		$html  = '<input type="text" name="rf_gallery_img_ids" id="rf_gallery_img_ids" class="widefat" value="'. esc_attr( $rf_gallery_img_ids ) .'" />';
		
		// gallery image sources
		$html .= '<input type="text" name="rf_gallery_imgs_src" id="rf_gallery_imgs_src" class="widefat" value="'. esc_attr( $rf_gallery_imgs_src ) .'" />';
		
		// upload gallery image button
		$html .= '<input type="button" id="rf_gallery_imgs_upload" class="royal-upload-btn button button-primary" value="'. __( 'Add Image', 'inf_lang' ) .'" />';
		
		// gallery images wrapper block
		$html .= '<div class="gallery-wrap"><ul id="sortable"></ul></div>';

		echo $html;
	}

	// Save/Update
	function royal_save_gallery_post_meta_box( $post_id ) {
		if ( royal_user_can_save( $post_id, 'gallery_post_nonce' ) ) {

			// gallery images id
			if ( isset($_POST['rf_gallery_img_ids']) ) {
				$valid_rf_gallery_img_ids = wp_filter_nohtml_kses( $_POST['rf_gallery_img_ids'] );
				update_post_meta( $post_id, 'rf_gallery_img_ids', $valid_rf_gallery_img_ids );
			}

			// gallery images src
			if ( isset($_POST['rf_gallery_imgs_src']) ) {
				$valid_rf_gallery_imgs_src = esc_url_raw( $_POST['rf_gallery_imgs_src'] );
				update_post_meta( $post_id, 'rf_gallery_imgs_src', $valid_rf_gallery_imgs_src );
			}

		}
	}

	add_action( 'save_post', 'royal_save_gallery_post_meta_box' );
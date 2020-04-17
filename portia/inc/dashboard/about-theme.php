<?php 

function infinity_add_about_theme_page() {
	add_theme_page( esc_html__( 'Portia Theme', 'portia' ), esc_html__( 'Portia Theme', 'portia' ), 'edit_theme_options', 'about-portia', 'infinity_about_theme_page_render' );
}
add_action( 'admin_menu', 'infinity_add_about_theme_page' );

function infinity_about_theme_page_render() {

?>

<?php
}


?>
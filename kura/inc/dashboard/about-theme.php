<?php 

function infinity_add_about_theme_page() {
	add_theme_page( esc_html__( 'Kura Theme', 'inf_lang' ), esc_html__( 'Kura Theme', 'inf_lang' ), 'edit_theme_options', 'about-kura', 'infinity_about_theme_page_render' );
}
add_action( 'admin_menu', 'infinity_add_about_theme_page' );

function infinity_about_theme_page_render() {

?>

<?php
}


?>
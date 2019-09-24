<?php
function jquery() {
    if (!is_admin()) {
        // comment out the next two lines to load the local copy of jQuery
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', false, '3.3.1');
        wp_enqueue_script('jquery');
    }
}
add_action('init', 'jquery');
/**
 * Proper way to enqueue scripts and styles
 */
function theme_styles() {
    wp_enqueue_style( 'style', get_stylesheet_directory_uri() .'/lib/styles/css/main.css', array(), 'all' );
    wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() .'/lib/scripts/scripts.js', array(), 'all' );
}
add_action( 'wp_enqueue_scripts', 'theme_styles' );
/*
	* Let WordPress manage the document title.
	* By adding theme support, we declare that this theme does not use a
	* hard-coded <title> tag in the document head, and expect WordPress to
	* provide it for us.
	*/
add_theme_support( 'title-tag' );

add_theme_support('post-thumbnails');

register_nav_menus( array(
    'Primary' => esc_html__( 'Primary' )
) );

/**
* Enable SVG Uploads
**/
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point( $path ) {
    // update path
    $path = get_stylesheet_directory() . '/acf-json';
    return $path;
}
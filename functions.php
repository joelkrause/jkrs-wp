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
    wp_enqueue_style( 'style', get_stylesheet_directory_uri() .'/lib/styles/css/main.css', array(),filemtime(get_stylesheet_directory().'/lib/styles/css/main.css') );
    wp_enqueue_script( 'FontAwesome', 'https://kit.fontawesome.com/8acb92c956.js', array(), 'all' );
    wp_enqueue_script( 'TweenMax', get_stylesheet_directory_uri() .'/lib/scripts/src/TweenMax.min.js', array(), 'all' );
    wp_enqueue_script( 'instantload', get_stylesheet_directory_uri() .'/lib/scripts/src/instantload.min.js', array(), 'all' );
    wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() .'/lib/scripts/scripts.js', array(), 'all' );
    wp_localize_script( 'scripts', 'ajax_postajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
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

add_action('wp_ajax_nopriv_getPosts', 'getPosts' );
add_action('wp_ajax_getPosts', 'getPosts' );

function getPosts(){
    $keyword = $_POST["keywords"];
    // Custom WP query search
    $args_search = array(
        's' => $keyword,
        'order' => 'DESC',
    );

    $search = new WP_Query( $args_search );
    $day_check = '';
    if ( $search->have_posts() ) {
        while ($search->have_posts()) {
        $search->the_post();
            $day = get_the_date('Y');
            if ($day != $day_check) {
                echo '<h3 data-animate> '.get_the_date("Y") . '</h3>';
            }
            get_template_part('template-parts/post-card');
            $day_check = $day;
        }
    } else {
        echo 'nothing to show';
    }
    exit();
}

function postDate(){
    global $post;
    $published_time = get_the_date();
    $last_modified_time = get_the_modified_date();

    echo 'Updated about '.$last_modified_time;
    echo 'Published on '.$published_time;
}
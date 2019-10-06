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
    $stylesheet = get_stylesheet_directory().'/lib/styles/css/main.css';
    $script = get_stylesheet_directory().'/lib/scripts/scripts.min.js';
    wp_enqueue_style( 'style', get_stylesheet_directory_uri() .'/lib/styles/css/main.css', array(),filemtime($stylesheet) );
    wp_enqueue_script( 'FontAwesome', 'https://kit.fontawesome.com/8acb92c956.js', array(), 'all' );
    wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() .'/lib/scripts/scripts.min.js', array(), filemtime($script) );
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
  $mimes['svg'] = 'image/svg';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point( $path ) {
    // update path
    $path = get_stylesheet_directory() . '/acf-json';
    return $path;
}

add_action('wp_ajax_nopriv_getLink', 'getLink' );
add_action('wp_ajax_getLink', 'getLink' );
function getLink(){
    $link = $_POST["url"];
    exit();
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

    $datetime1 = date_create( $post->post_modified );
    $datetime2 = date_create(); // current date
    $interval = date_diff( $datetime1, $datetime2 );

    // var_dump($interval);
    if($interval->y){
        $diff = 'Updated about '.$interval->y.' year ago';
        $indicator = 'probably_out_of_date';
    } else if($interval->m){
        $diff = 'Updated about '.$interval->m.' months ago';
        $indicator = 'could_be_out_of_date';
    } else if($interval->days){
        if($interval->days == 1){
            $diff = 'Updated about a day ago';
        } else {
            $diff = 'Updated about '.$interval->days.' days ago';
        }
        $indicator = 'up_to_date';
    } else if($interval->h){
        $diff = 'Updated about '.$interval->h.' hours ago';
        $indicator = 'up_to_date';
    } else if($interval->i){
        if($interval->i > 5){
            $diff = 'Updated about '.$interval->i.' minutes ago';
        } else {
            $diff = 'Updated a few minutes ago';
        }
        $indicator = 'up_to_date';
    } else if($interval->s){
        $diff = 'Updated just now';
        $indicator = 'up_to_date';
    }
    echo '<div class="post__updated" data-animate><span class="post__indicator '.$indicator.'"></span> '.$diff.'</div>';
}
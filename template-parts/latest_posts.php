<?php
// Custom WP query latest_posts
$args_latest_posts = array(
	'posts_per_page' => 5,
	'order' => 'DESC',
);

$latest_posts = new WP_Query( $args_latest_posts );

while ( $latest_posts->have_posts() ) {
    $latest_posts->the_post();
    get_template_part('template-parts/post-card');
}
wp_reset_postdata();
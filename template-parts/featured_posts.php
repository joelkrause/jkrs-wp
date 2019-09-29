<?php
// Custom WP query featured_posts
$args_featured_posts = array(
	'posts_per_page' => 5,
	'order' => 'DESC',
);

$featured_posts = new WP_Query( $args_featured_posts );

while ( $featured_posts->have_posts() ) {
    $featured_posts->the_post();
    get_template_part('template-parts/post-card');
}
wp_reset_postdata();
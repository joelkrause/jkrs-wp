<?php
get_header();
echo '<div class="page__hero">';
    echo '<div class="wrapper" data-animate>';
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post(); 
                the_content();
            }
        }
    echo '</div>';
echo '</div>';

echo '<div class="posts__cards">';
    echo '<div class="wrapper">';
        echo '<header data-animate>';
            echo '<h2>Featured Posts</h2>';
            echo '<a href="/posts" class="button">See All Posts</a>';
        echo '</header>';
        get_template_part('template-parts/featured_posts');
    echo '</div>';
echo '</div>';

echo '<div class="posts__cards">';
    echo '<div class="wrapper">';
        echo '<header data-animate>';
            echo '<h2>Latest Posts</h2>';
            echo '<a href="/posts" class="button">See All Posts</a>';
        echo '</header>';
        get_template_part('template-parts/latest_posts');
    echo '</div>';
echo '</div>';
get_footer();
?>
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
        echo '<h2 data-animate>Latest Posts</h2>';
    echo '</div>';
echo '</div>';

echo '<div class="posts__cards">';
    echo '<div class="wrapper">';
        echo '<h2 data-animate>Featured Posts</h2>';
    echo '</div>';
echo '</div>';
get_footer();
?>
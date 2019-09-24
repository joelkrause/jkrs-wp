<?php
get_header();
echo '<div class="page__hero">';
    echo '<div class="wrapper">';
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post(); 
                the_content();
            }
        }
    echo '</div>';
echo '</div>';
echo '<div class="posts__cards">';
echo '<h2>Latest Posts</h2>';

echo '</div>';

echo '<div class="posts__cards">';
echo '<h2>Featured Posts</h2>';
echo '</div>';
get_footer();
?>
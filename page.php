<?php
get_header();

echo '<div class="page__hero">';
    echo '<div class="wrapper">';
        echo '<h1 data-animate>'.get_the_title().'</h1>';
    echo '</div>';
echo '</div>';
        
echo '<div class="posts__wrapper wrapper">';
    if(get_the_post_thumbnail()){   
        echo '<div class="post__thumbnail" data-animate style="background-image:url('.get_the_post_thumbnail_url().');"></div>';
    }
    if ( have_posts() ) {
        while ( have_posts() ) {
            the_post(); 
            echo '<div data-animate>';
                the_content(); 
            echo '</div>';
        }
    }
echo '</div>';
get_footer(); 
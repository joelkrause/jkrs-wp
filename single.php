<?php get_header();
echo '<div class="page__hero">';
    echo '<div class="wrapper">';
        echo '<h1>'.get_the_title().'</h1>';
        echo '<div class="post__updated">Updated on '.get_the_modified_date().'</div>';
        echo '<div class="post__date">Published on '.get_the_date().'</div>';
        echo '</div>';
        echo '</div>';
        
echo '<div class="posts__wrapper wrapper">';
    if(get_the_excerpt()){   
        echo '<div class="post__excerpt">'.get_the_excerpt().'</div>';
    }
    if(get_the_post_thumbnail()){   
        echo '<div class="post__excerpt">'.get_the_post_thumbnail().'</div>';
    }
    if ( have_posts() ) {
        while ( have_posts() ) {
            the_post(); 
            the_content();
        }
    }
echo '</div>';
get_footer(); 
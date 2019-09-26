<?php
global $post;
$id = $post->ID;
$categories = get_the_category($id);
$category_id = $categories[0]->cat_ID;
$icon = get_field('icon','category_'.$category_id);
$icon_color = get_field('icon_color','category_'.$category_id);
get_header();

echo '<div class="page__hero">';
    echo '<div class="wrapper">';
        echo '<div class="post__icon" data-animate style="background-color:'.$icon_color.';">'.$icon.'</div>';
        echo '<h1 data-animate>'.get_the_title().'</h1>';
        echo '<div class="post__updated" data-animate>Updated on '.get_the_modified_date().'</div>';
        echo '<div class="post__date" data-animate>Published on '.get_the_date().'</div>';
        echo '</div>';
        echo '</div>';
        
echo '<div class="posts__wrapper wrapper">';
    if(get_the_excerpt()){   
        echo '<div class="post__excerpt" data-animate>'.get_the_excerpt().'</div>';
    }
    if(get_the_post_thumbnail()){   
        echo '<div class="post__excerpt" data-animate>'.get_the_post_thumbnail().'</div>';
    }
    if ( have_posts() ) {
        while ( have_posts() ) {
            the_post(); 
            the_content();
        }
    }
echo '</div>';
get_footer(); 
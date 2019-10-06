<?php
global $post;
$id = $post->ID;
$date = get_the_date();
$categories = get_the_category($id);
$category_id = $categories[0]->cat_ID;
$icon = get_field('icon','category_'.$category_id);
$icon = file_get_contents($icon['url']);
$icon_color = get_field('icon_color','category_'.$category_id);
get_header();

echo '<div class="page__hero">';
    echo '<div class="wrapper">';
        echo '<div class="post__icon" data-animate style="background-color:'.$icon_color.';">'.$icon.'</div>';
        echo '<h1 data-animate>'.get_the_title().'</h1>';
        echo '<div data-animate class="post__date">Published on '.$date.'</div>';
        postDate();
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
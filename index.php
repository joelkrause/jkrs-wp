<?php
get_header();
$id_posts_page = get_option( 'page_for_posts' );
echo '<div class="page__hero">';
    echo '<div class="wrapper">';
        echo '<h1>'.get_the_title($id_posts_page).'</h1>';
        echo '<input type="search" id="post_search" placeholder="Search..." />';
    echo '</div>';
echo '</div>';
echo '<div class="posts__wrapper wrapper">';
    
    $day_check = '';
    
    while (have_posts()) : the_post();
        $day = get_the_date('Y');
        if ($day != $day_check) {
            echo '<h3> '.get_the_date("Y") . '</h3>';
        }
        get_template_part('template-parts/post-card');
        $day_check = $day;
    endwhile;
echo '</div>';
get_footer();
?>
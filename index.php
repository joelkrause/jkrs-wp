<?php
get_header();
$id_posts_page = get_option( 'page_for_posts' );
echo '<div class="page__hero">';
echo '<svg data-animate viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg"><g transform="translate(300, 300)"><path d="M151.7,-146.9C185.5,-117.9,194.3,-58.9,185.4,-8.8C176.6,41.2,150.2,82.5,116.3,114.7C82.5,146.8,41.2,169.9,-4.8,174.7C-50.9,179.6,-101.8,166.2,-144.5,134C-187.2,101.8,-221.6,50.9,-218.5,3.1C-215.5,-44.8,-174.9,-89.6,-132.2,-118.6C-89.6,-147.6,-44.8,-160.8,7.1,-167.9C58.9,-174.9,117.9,-175.9,151.7,-146.9Z" fill="#1e2023" stroke="none" stroke-width="0"></path></g></svg>';
    echo '<div class="wrapper">';
        echo '<h1 data-animate>'.get_the_title($id_posts_page).'</h1>';
        echo '<input type="search" id="post_search" placeholder="Search..." data-animate />';
    echo '</div>';
echo '</div>';
echo '<div class="posts__wrapper wrapper">';
    echo '<div id="posts">';
        $day_check = '';
        
        while (have_posts()) : the_post();
            $day = get_the_date('Y');
            if ($day != $day_check) {
                echo '<h3 data-animate> '.get_the_date("Y") . '</h3>';
            }
            get_template_part('template-parts/post-card');
            $day_check = $day;
        endwhile;
    echo '</div>';
echo '</div>';
get_footer();
?>
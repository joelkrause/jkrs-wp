<?php
get_header();
    $day_check = '';

    while (have_posts()) : the_post();
    $day = get_the_date('Y');
    if ($day != $day_check) {
        echo '<h3> '.get_the_date("Y") . '</h3>';
    }
    get_template_part('template-parts/post-card');
    $day_check = $day;
    endwhile;
get_footer();
?>
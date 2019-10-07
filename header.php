<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head();?>
</head>

<body <?php body_class();?>>
    <?php
if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
}
?>
<header class="site__header">
    <div class="site__header-logo">
        <a href="<?php echo home_url();?>">
        Joel Krause.
            <?php //include(get_template_directory().'/lib/images/code-solid.svg');?>
        </a>
    </div>
    <nav class="site__header-nav">
        <?php
        wp_nav_menu( array(
            'theme_location' => 'Primary',
            'menu_id'        => 'Primary',
            'container' => false
        ) );
        ?>
    </nav>
</header>
<!-- <svg class="accent__blob" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg"><g transform="translate(300, 300)"><path d="M151.7,-146.9C185.5,-117.9,194.3,-58.9,185.4,-8.8C176.6,41.2,150.2,82.5,116.3,114.7C82.5,146.8,41.2,169.9,-4.8,174.7C-50.9,179.6,-101.8,166.2,-144.5,134C-187.2,101.8,-221.6,50.9,-218.5,3.1C-215.5,-44.8,-174.9,-89.6,-132.2,-118.6C-89.6,-147.6,-44.8,-160.8,7.1,-167.9C58.9,-174.9,117.9,-175.9,151.7,-146.9Z" fill="#1e2023" stroke="none" stroke-width="0"></path></g></svg> -->
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
    <div class="site__header-logo" data-animate>
        <a href="<?php echo home_url();?>">
            <?php include(get_template_directory().'/lib/images/code-solid.svg');?>
        </a>
    </div>
    <nav class="site__header-nav" data-animate>
        <?php
        wp_nav_menu( array(
            'theme_location' => 'Primary',
            'menu_id'        => 'Primary',
            'container' => false
        ) );
    ?>
    </nav>
</header>
<?php
global $post;
$id = $post->ID;

$title = get_the_title($id);
$link = get_permalink($id);
$date = get_the_date();
$categories = get_the_category($id);
$category_id = $categories[0]->cat_ID;
$icon = get_field('icon','category_'.$category_id);
$icon_color = get_field('icon_color','category_'.$category_id);
?>
<div class="post__card" data-animate>
    <a href="<?php echo $link;?>">
        <div class="post__card-icon" style="background-color:<?php echo $icon_color;?>;"><?php echo $icon;?></div>
        <div class="post__card-title"><?php echo $title;?></div>
        <div class="post__card-date"><?php echo $date;?></div>
    </a>
</div>
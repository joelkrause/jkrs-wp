<?php
global $post;
$id = $post->ID;

$title = get_the_title($id);
$link = get_permalink($id);
?>
<div class="post__card">
<div class="post__card-title"><?php echo $title;?></div>
</div>
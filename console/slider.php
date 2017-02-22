<?php

$slides = get_posts(array(
	'numberposts' => 4,
	'post_type' => 'slide',
	'orderby' => 'time',
	'order' => 'DESC'
));

?>

<div id="slider" class="pt20 rel center w1">
    <ul>
        <?php foreach($slides as $slide) : if(has_post_thumbnail($slide->ID)) : ?>
        <?php $img = wp_get_attachment_image_src( get_post_thumbnail_id($slide->ID), 'slide'); ?>
        <li style="width: <?php echo $img[1] ?>px; height: <?php echo $img[2] ?>px;">
            <img class="db" src="<?php echo $img[0] ?>" title="<?php print $slide->post_title ?>" />
            <a class="db" href="<?php print $slide->post_excerpt ?>" target="_blank"></a>
        </li>
        <?php endif; endforeach; ?>
    </ul>
</div>

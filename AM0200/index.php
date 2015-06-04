<?php get_header(); ?>
<div id="container">
<div id="wrapper">

<?php if (have_posts()) : $count = 0;  while (have_posts()) : the_post(); $count++; if( $count <= 1 ): ?>

<?php

$prev = get_adjacent_post(false,'',true);
if (is_object($prev)) {
    $previous = get_permalink($prev);
} else {
    $previous = '';
}

$args = array(
    'post_type' => 'attachment',
    'numberposts' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'post_mime_type' => 'image', 
    'post_status' => null, 
    'post_parent' => $post->ID
);

$url = get_post_meta( $post->ID, 'origin_url', true );
$background = get_post_meta( $post->ID, 'background', true );
$color = get_post_meta( $post->ID, 'color', true );

?>
    <section data-title="<?php the_title(); ?>" data-link="<?php the_permalink() ?>" data-prev="<?php echo $previous; ?>" class="post" data-id="<?php the_ID(); ?>" id="post<?php the_ID(); ?>" data-bg="<?php echo $background ?>" data-color="<?php echo $color ?>">

    <?php $attachments = get_posts($args); if ($attachments) { ?>

        <ul style="background: <?php echo $background ?>; color: <?php echo $color ?>"><!--

        --><li class="info">
                <header class="menu" style="color: <?php echo $color ?>"><i class="iconfont">&#xe6cd;</i></header>
                <div>
                    <h2><a class="tolink" style="color: <?php echo $color ?>;" target="_blank" href="<?php echo $url ?>"><?php the_title(); ?><i class="iconfont">&#xe624;</i></a></h2>
                    <?php the_excerpt(); ?>
                </div>
           </li><!--

    <?php $i=0; foreach ( $attachments as $attachment ) { $i++; $img = wp_get_attachment_image_src($attachment->ID,'full'); ?>
--><li class="imgs"><div id="img<?php the_ID(); echo $i; ?>" data-w="<?php echo $img[1] ?>" data-h="<?php echo $img[2] ?>" data-u="<?php echo $img[0] ?>"><span style="background:<?php echo $color ?>"></span></div></li><!--
    <?php } ?>--></ul>

    <?php } ?>
        
    </section>

<?php endif; endwhile; endif; ?>

</div>
</div>
<div class="about">
    <i class="iconfont close">&#xe603;</i>
    <div>
        <h2>About <a href="/">AM0200.com</a></h2>
        <p>The primary purpose of this site is to collect creative ideas around the web. Hope you enjoy the site and find the inspiration.</p>
        <a href="mailto:loeify@gmail.com" target="_blank">LoeiFy@gmail.com</a>
    </div>
</div>
</body>
</html>

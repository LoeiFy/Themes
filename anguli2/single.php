<?php get_header(); ?>

<div class="clearfix" id="single">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article class="box-shadow">
        <section id="post">
            <nav class="pre">
                <?php previous_post_link('%link'); ?>
            </nav>
            <nav class="next">
                <?php next_post_link('%link'); ?>
            </nav>
            
            <div id="post_top">
                <h2 id="post_h2"><?php the_title(); ?></h2>
                <p>By <a id="author" href="###">@<?php the_author(); ?></a> - Post in <?php the_category(', '); ?> - <?php the_time('F j, Y'); ?></p>
                <?php tz_printLikes(get_the_ID()); ?>
            </div>
            
            <?php $args = array('post_type' => 'attachment', 'numberposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC', 'post_mime_type' => 'image' ,'post_status' => null, 'post_parent' => $post->ID ); $attachments = get_posts($args); if ($attachments) { ?>
        <div id="wpimgs" class="clearfix"><div id="postimgs">
            <?php foreach ( $attachments as $attachment ) { ?>
                <?php $image_attributes = wp_get_attachment_image_src($attachment->ID,'medium');?>
                <a class="postimg left" href="<?php echo wp_get_attachment_url( $attachment->ID , false ); ?>"><img width="<?php echo $image_attributes[1] ?>" height="<?php echo $image_attributes[2] ?>" src="<?php echo $image_attributes[0] ?>"/></a>
           <?php } ?>
         </div></div>
         <?php } ?>
            
            <div class="entry">
                <?php the_content(); ?>
            </div>
                        
            <div class="comment">
                <?php comments_template(); ?>
            </div>
             
        </section>
    </article>    
    <?php endwhile; endif; ?>

</div>       

<?php get_footer(); ?>
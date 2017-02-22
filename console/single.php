<?php get_header(); ?>

<div id="single">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <?php setPostViews(get_the_ID()); ?>

    <div class="postcontent rel mt30">

        <div class="w1 center">

            <div class="posttop tac rel">
                <h2><a target="_blank" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><span class="icon-open"></span></h2>
                <p class="mt20">文章分类 : <?php the_category(' - '); ?><span> · </span>发布时间 : <?php the_time('Y-m-j'); ?><span> · </span>查看次数 : <?php echo getPostViews(get_the_ID()); ?></p>
            </div>

            <div class="postleft">
                <div class="entry typo">
                    <?php the_content(); ?>
                </div>

                <div class="like dib mt50">
                    <?php tz_printLikes(get_the_ID()); ?>
                </div><?php get_template_part( 'social' ); ?>

                <div class="single_extra rel">
                    <?php previous_post_link( '%link', '<span>' . _x( '上一篇', 'Previous post link', '' ) . '</span>' ); ?>
                    <?php next_post_link( '%link', '<span>' . _x( '下一篇', 'Next post link', '' ) . '</span>' ); ?>
                </div>

                <div class="comment mt30 tac">
                <?php get_template_part( 'comment-box' ); ?>
                </div>

            </div>
        </div>
             
    </div>    
    <?php endwhile; endif; ?>

</div>       

<?php get_footer(); ?>

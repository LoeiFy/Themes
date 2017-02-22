<?php get_header(); ?>

<?php get_template_part( 'slider' ); ?>

<div id="primary" class="main mt10 rel">
    
    <div class="group w1 center">

    <?php if (have_posts()) : $i = 0; while (have_posts()) : the_post(); $i ++; ?><div data-post="<?php echo $i ?>" id="post<?php the_Id() ?>" class="dib rel pb20 mt30 mr20 post<?php if ($i % 3 == 0) : echo ' mr0'; endif; ?>">

        <div class="dash"></div>
        <div class="rel postimg">
            <a target="_blank" title="<?php the_title(); ?>" data-post="post<?php the_Id() ?>" class="postlink db" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail');?></a>
            <a target="_blank" title="<?php the_title(); ?>" data-post="post<?php the_Id() ?>" class="postlink abs status icon-resize-enlarge" href="<?php the_permalink(); ?>"></a>
        </div>
    
        <a title="<?php the_title(); ?>" data-post="post<?php the_Id() ?>" class="postlink nowrap db mt20 posttitle" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

        <div class="rel">
            <p class="extra mt10"><?php the_author(); ?> 发表于&nbsp; - <?php $category = get_the_category(); echo $category[0]->cat_name; ?> -</p>
            <span class="views"><?php the_time('Y-m-j'); ?><?php //echo getPostViews(get_the_ID()); ?></span>
        </div>

    </div><?php if ($i % 3 == 0) : ?></div>
    <div class="postwrap oh w" id="postwrap<?php echo $i / 3 ?>"></div>
    <div class="group w1 center"><?php endif ?><?php endwhile; endif; ?></div>
  
</div>  
<div id="pagination" class="w1 tac center">
    <span class="dib pageprev rel icon-arrow-left">上一页<?php previous_posts_link(__('')); ?></span>
    <span class="dib pagenext rel icon-arrow-right">下一页<?php next_posts_link(__('')); ?></span>
</div>

<?php get_footer(); ?>

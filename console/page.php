<?php get_header(); ?>
<div id="single">
<div class="w1 mt50 center">
<?php while ( have_posts() ) : the_post(); ?>
    <div class="posttop rel">
        <h2><?php the_title(); ?></h2>
    </div>
    <div class="mt30"></div>
    <?php the_content(); ?>
    <?php get_template_part( 'comment-box' ); ?>
<?php endwhile; ?>
</div>
</div>
<?php get_footer(); ?>

<?php get_header(); ?>
<div class="clearfix" id="primary">
<?php while ( have_posts() ) : the_post(); ?>
    <div id="page" class="box-shadow center">
    <?php the_content(); ?>
    </div>
<?php endwhile; ?>
</div>
<?php get_footer(); ?>
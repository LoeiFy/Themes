<?php get_header(); ?>

<div class="clearfix" id="primary">
    
    <div class="header_title">
        <?php if (is_tag()) { ?><h1 class="box-shadow">Tags:<?php single_tag_title(); ?></h1><?php } ?>
        <?php if (is_category()) { ?><h1 class="box-shadow"><?php single_cat_title("Category:") ?></h1><?php } ?>
        <?php if (is_search()) { ?><h1 class="box-shadow">Search:<?php the_search_query(); ?></h1><?php } ?> 
    </div>
    
  <div id="container">
  
  <?php if (have_posts()) : while (have_posts()) : the_post();
    global $postoptions;
    $postoptions->post = get_the_ID();
    $size = $postoptions->get_post_option('post_size');
    $size = the_post_size();
  ?>
  
  <article class="post box-shadow masonry">

    <?php $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); ?>
    <a class="more post_<?php echo $size; ?>" href="<?php the_permalink(); ?>">
      <?php
        if ($size == "l")
            the_post_thumbnail('thumb_l');
        if ($size == "ls")
            the_post_thumbnail('thumb_ls');
        if ($size == "l_ls")
            the_post_thumbnail('thumb_l_ls');
        if ($size == "m")
            the_post_thumbnail('thumb_m');
        if ($size == "m_s")
            the_post_thumbnail('thumb_m_s');
      ?>
    </a>
    
    <h2 class="title"><?php the_title(); ?></h2>
    <a href="<?php echo $image_url[0] ?>" title="<?php the_title(); ?>" class="prettyPhoto zoom"></a>
    <?php tz_printLikes(get_the_ID()); ?>
    
  </article>
    
  <?php endwhile; else: ?> 
    <div id="page404" class="center box-shadow">
        <h2>Not Found</h2>
        <p>The page you were looking for is no longer available.</p>
    </div>
  <?php endif; ?>
  </div>
  <div id="loader">loading</div>  
  <nav id="pagination"><?php next_posts_link(__('LOAD MORE')); ?></nav>
  
</div>  

<?php get_footer(); ?>
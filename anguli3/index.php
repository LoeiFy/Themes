<?php get_header(); ?>

<a href="" id="link_to">please wait a while...or click here to open it directly</a>

<div id="primary">
    
  <div id="wrapper">
  
  <?php if (have_posts()) : $count = 0;  while (have_posts()) : the_post(); $count++; if($count <= 1 && get_query_var('paged') < 2 ): ?>

	<?php $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); ?>

	<article class="post_first post post_<?php echo $count ?>">
		<section>
			<a class="more" title="<?php the_title() ?>" href="<?php the_permalink(); ?>"><?php the_title() ?></a>
			<p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 70,"…"); ?></p>
		</section>
		<a class="more" title="<?php the_title() ?>" href="<?php the_permalink(); ?>"><img width="614" height="614" src="<?php echo get_template_directory_uri(); ?>/thumb/timthumb.php?src=<?php echo $image_url[0] ?>&h=614&w=614&zc=1" class="thumb" /></a>
	</article>

  <?php else : ?>
  <?php 
        $format = get_post_format();
        if( false === $format ) { $format = 'standard'; }
  ?>
  
  <?php get_template_part( 'post', $format ); ?>
  
  <?php endif; ?>
    
  <?php endwhile; ?> 
  <?php endif; ?>
  </div>
  <nav id="pagination"><?php next_posts_link(__('LOAD MORE')); ?></nav>
  
</div>  

<div id="content"><div id="cover_w"></div></div>  
<?php get_footer(); ?>

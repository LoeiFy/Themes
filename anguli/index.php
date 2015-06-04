<?php get_header(); ?>
<div id="load_cover" style="z-index: 2000; width: 100%; height: 100%; top: 0; background: #fff; position: fixed;">
	<p style="margin-top: 100px; text-align: center; font-size: 22px; color: #999;">Loading...</p>
</div>
<div id="container" class="rel">	

	<header id="header" class="w1 center oh">

			<a class="db left" id="logo" href="/" title="<?php bloginfo('name'); ?>"></a>
			<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '' ) ); ?>

	</header>

<div id="primary" class="center w">
    
  
  <?php if (have_posts()) : $count = 0;  while (have_posts()) : the_post(); $count++; if( $count <= 1 ): ?>

	<?php $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); ?>
	
	<article class="rel" id="post_frist" data-img="<?php echo $image_url[0] ?>" data-width="<?php echo $image_url[1] ?>" data-height="<?php echo $image_url[2] ?>">
		<div class="rel abs tac">
			<a class="cf dib tru rel overlay" title="<?php the_title() ?>" href="<?php the_permalink(); ?>"><?php the_title() ?></a>
		</div>
		<div class="abs cf icon-arrow-down"></div>
	</article>

	<div class="hide" id="hide_post">
  	<?php $format = get_post_format(); if( false === $format ) { $format = 'standard'; } ?>
	<?php get_template_part( 'post', $format ); ?>
	</div>

  <div class="bgf w pt25 rel oh">
  <div id="wrapper" class="w2 center rel oh">
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
  </div>
  <div id="pagination" class="w bgf">
	<div class="rel pt25 pb25 tac"><?php next_posts_link(('加载更多')); ?></div>
  </div>
  
</div>

<footer id="footer" class="w">
	<p class="right ca0 mt25 mr25">&copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?><span class="cf ml25">Top</span></p>
</footer>
</div>
<div id="preview_w" class="hide fix bgf md-hidden">
	<div id="preview"></div>
</div>
<?php get_footer(); ?>

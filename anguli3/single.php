<?php get_header(); ?>

<div id="single">

	<div id="s_wrapper">

	<div id="close" class="hide"></div>
	<div id="link_post" class="hide"></div>
	<div id="for_img" class="hide"></div>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <?php setPostViews(get_the_ID()); ?>
            
  	<?php 
        $format = get_post_format();
        if( false === $format ) { $format = 'standard'; }
  	?>  
	<?php get_template_part( 'post', $format ); ?>

	<?php endwhile; endif; ?>

	</div>
</div>       

<?php get_footer(); ?>

<?php if( !is_singular() ) { ?>
<?php $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail'); ?>

	<article class="gallery oh rel left post bgf">

		<a class="overlay icon-camera db rel" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
    		<img class="db" width="300" height="<?php echo $image_url[2] ?>" src="<?php echo $image_url[0] ?>"/>
		</a>

		<h2 class="f18 mr20 mt20 mb10 nowrap"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
		<p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 90," […] "); ?></p>

	</article>
  
<?php } else { ?>
	
<div class="single-gallery">

	<div id="swipe" class="gallery_siider swipe rel">

	<?php $args = array('post_type' => 'attachment', 'numberposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC', 'post_mime_type' => 'image' ,'post_status' => null, 'post_parent' => $post->ID ); $attachments = get_posts($args); if ($attachments) { ?>
		<div class="swipe-wrap">
        <?php foreach ( $attachments as $attachment ) { ?>
        <?php $image_attributes = wp_get_attachment_image_src($attachment->ID,'full');?>
			<div><img class="db center" width="<?php echo $image_attributes[1] ?>" height="<?php echo $image_attributes[2] ?>" src="<?php echo $image_attributes[0] ?>"/></div>
		<?php } ?>
		</div>
	<?php } ?>

		<div id="slider_num" class="cf abs"><span id="pos">1</span> / <span id="total"></span></div>
		<div id="slider_left" class="slider_arrow c0 abs icon-arrow-left"></div>
		<div id="slider_right" class="slider_arrow c0 abs icon-arrow-right"></div>

	</div>

    <div id="single_logo">
        <a class="rel db" href="/"></a>
        <div id="close" href="/" class="c0 rel dib f30 icon-cross3"></div>
    </div>

	<header class="s_header oh w900 center">
		<h2 class="f30 mb15 c3"><?php the_title(); ?></h2>
        <p class="f12 mr10 left tru ca0">
            <span>post by <?php the_author(); ?></span>&nbsp; // &nbsp;
            <span><?php the_time('F j, Y'); ?> </span>&nbsp; // &nbsp;
            <span><?php the_category(', '); ?></span>&nbsp; // &nbsp;
            <span><?php echo getPostViews(get_the_ID()); ?> views</span>
        </p>
	</header>

	<article class="s_article typo mt20 oh w900 center">
		<?php the_content(); ?>
	</article>

	<section class="postmore mt20 rel w900 center">
		<?php tz_printLikes(get_the_ID()); ?>
		<?php get_template_part( 'social' ); ?>

		<nav class="nav rel mt20">
			<?php previous_post_link('%link'); ?>
        	<?php next_post_link('%link'); ?>
		</nav>
	</section>

	<footer class="mt20 w900 center">

		<?php //get_template_part( 'author' ); ?>

	    <?php get_template_part( 'related' ); ?>

		<?php get_template_part( 'comment-box' ); ?>

	</footer>


</div>	

<?php } ?>

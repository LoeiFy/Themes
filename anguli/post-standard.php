<?php if( !is_singular() ) { ?>
<?php $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail'); ?>

	<article class="standard left rel post oh bgf">

		<a class="overlay icon-text db rel" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
    		<img class="db" width="300" height="<?php echo $image_url[2] ?>" src="<?php echo $image_url[0] ?>"/>
		</a>

		<h2 class="f18 mt20 mr20 mb10 nowrap"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
		<p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 70," […] "); ?></p>
    
	</article>

<?php } else { ?>

<div class="single-standard">

    <div id="single_logo">
        <a class="rel db" href="/"></a>
        <div id="close" href="/" class="c0 rel dib f30 icon-cross3"></div>
    </div>

	<header class="s_header w900 center oh">
		<h2 class="f30 mb15 c3"><?php the_title(); ?></h2>
        <p class="f12 mr10 left tru ca0">
            <span>post by <?php the_author(); ?></span>&nbsp; // &nbsp;
            <span><?php the_time('F j, Y'); ?> </span>&nbsp; // &nbsp;
            <span><?php the_category(', '); ?></span>&nbsp; // &nbsp;
            <span><?php echo getPostViews(get_the_ID()); ?> views</span>
        </p>
	</header>

	<article class="s_article w900 center oh typo mt20">
		<?php the_content(); ?>
	</article>

	<section class="postmore w900 center rel mt20">
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

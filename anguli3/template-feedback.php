<?php
/*
Template Name: feedback
*/
?>

<?php get_header(); ?>

<div id="feedback">
<div id="f_wrapper">
<div id="f_info" style="margin-top: 17px;">
<?php while ( have_posts() ) : the_post(); ?>
    <?php the_content(); ?>
<?php endwhile; // end of the loop. ?>
</div>
<!-- Duoshuo Comment BEGIN -->
<div class="ds-thread"></div>
<script type="text/javascript">
var duoshuoQuery = {short_name:"guolu"};
	(function() {
		var ds = document.createElement('script');
		ds.type = 'text/javascript';ds.async = true;
		ds.src = 'http://static.duoshuo.com/embed.js';
		ds.charset = 'UTF-8';
		(document.getElementsByTagName('head')[0] 
		|| document.getElementsByTagName('body')[0]).appendChild(ds);
	})();
	</script>
<!-- Duoshuo Comment END -->
</div>
</div>

<?php get_footer(); ?>
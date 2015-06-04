
<?php $image_full_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); ?>
<?php if( !is_singular() ) { ?>
<?php $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail'); ?>

	<article class="post_standard post box-shadow" style="height: <?php echo $image_url[2] + 90 ?>px;">

	<div class="imgwrap" style="height: <?php echo $image_url[2] ?>px;">

    	<img width="300" height="<?php echo $image_url[2] ?>" src="<?php echo $image_url[0] ?>"/>
    
		<a class="overlay more" title="<?php the_title() ?>" href="<?php the_permalink(); ?>"></a>

	</div>
    
	<h2 class="h_t"><a class="more" title="<?php the_title() ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    
    <p class="h_content"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 70,"…"); ?></p>
    
</article>

<?php } else { ?>

<div class="single-standard">
	<header class="s_header">
		<h2><?php the_title(); ?></h2>

		<p>By <?php the_author() ?> - Post in <?php the_category(', '); ?> - <?php the_time('F j, Y'); ?></p>

		<div class="social_share">
			<a href="javascript:void(function(){var d=document,e=encodeURIComponent,s1=window.getSelection,s2=d.getSelection,s3=d.selection,s=s1?s1():s2?s2():s3?s3.createRange().text:'',r='http://www.douban.com/recommend/?url='+e(d.location.href)+'&amp;title='+e(d.title)+'&amp;sel='+e(s)+'&amp;v=1',x=function(){if(!window.open(r,'douban','toolbar=0,resizable=1,scrollbars=yes,status=1,width=450,height=330'))location.href=r+'&amp;r=1'};if(/Firefox/.test(navigator.userAgent)){setTimeout(x,0)}else{x()}})()" rel="nofollow" id="douban-share" title="推荐到豆瓣">推荐到豆瓣</a>
			
			
			<a href="javascript:void((function(s,d,e){try{}catch(e){}var f='http://v.t.sina.com.cn/share/share.php?',u=d.location.href,p=['url=',e(u),'&amp;title=',e(d.title),'&amp;appkey='].join('');function a(){if(!window.open([f,p].join(''),'mb',['toolbar=0,status=0,resizable=1,width=620,height=450,left=',(s.width-620)/2,',top=',(s.height-450)/2].join('')))u.href=[f,p].join('');};if(/Firefox/.test(navigator.userAgent)){setTimeout(a,0)}else{a()}})(screen,document,encodeURIComponent));" rel="nofollow" id="sina-share" title="分享到新浪微博">分享到新浪微博</a>
			
			<a href="javascript:void(0)" onclick="{ var _t = encodeURI(document.title);  var _url = encodeURI(window.location); var _site = encodeURI; var _pic = ''; var _u = 'http://v.t.qq.com/share/share.php?title='+_t+'&amp;url='+_url+'&amp;site='+_site+'&amp;pic='+_pic; window.open( _u,'转播到腾讯微博', 'width=700, height=580, top=180, left=320, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no' );};" rel="nofollow" id="tencent-share" title="转播到腾讯微博">转播到腾讯微博</a>

			<a href="javascript:window.open('http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+ encodeURIComponent(location.href)+ '&title='+encodeURIComponent(document.title),'qshare','width=570,height=520,left=50,top=50,toolbar=no,menubar=no,location=no,scrollbars=yes,status=yes,resizable=yes');void(0)" rel="nofollow" id="qqzone-share" class="colorTipContainer blue" title="分享到QQ空间">分享到QQ空间</a>

		</div>

	</header>

	<article class="s_article">
		<?php the_content(); ?>
	</article>

	<section class="postmore">
		<nav class="nav">
			<?php previous_post_link('%link'); ?>
        	<?php next_post_link('%link'); ?>
		</nav>
			
		<div class="view"><?php echo getPostViews(get_the_ID()); ?></div>

		<?php tz_printLikes(get_the_ID()); ?>

	</section>

	<footer class="author">

		<h2>About The Author</h2> 

		<div class="au_div">         

          	<?php echo get_avatar( get_the_author_id() , 80 ); ?>         

          	<h3><?php the_author(); ?></h3>   

          	<p><?php the_author_description(); ?></p>

		</div>

		<?php //comments_template(); ?>
		<p id="c_button">Add Comment</p>
        <div id="comment-box"></div>

	</footer>

</div>
<?php } ?>

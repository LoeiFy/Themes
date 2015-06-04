<?php 

    if (is_home()) {

        $description = get_bloginfo('description');
        $keywords = "";

		$class = "index_page";

    } elseif (is_singular()) {

		$class = "single_page";

        if ($post->post_excerpt) {
            $description = $post->post_excerpt;
        } else {
            $description = substr(strip_tags($post->post_content),0,100);
        }

        $keywords = "";
        $tags = wp_get_post_tags($post->ID);
        foreach ($tags as $tag ) {
            $keywords = $keywords . $tag->name . ", ";
        }
	} else {

		//$class = "other_page";

	}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="google" content="notranslate" />
<title><?php bloginfo('name'); ?> <?php wp_title( '|', true, 'left' ); ?></title>
<meta name="keywords" content="<?php echo $keywords ?>" />
<meta name="description" content="<?php echo $description ?>" />
<link rel="icon" href="/favicon.ico" type="image/x-icon" />
<script>var duoshuoQuery = {short_name:'lorem-ipsum'};</script>
<script>var disqus_name = '';</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/basket.full.min-0.0.3.js"></script>
<!--
<script>
	basket.require({ url: '<?php bloginfo('stylesheet_url'); ?>', unique: 0.3,  execute: false })
	.then(function(responses) {
        _stylesheet.appendStyleSheet(responses[0], function() {});
		basket.require({ url: '<?php echo get_template_directory_uri(); ?>/js/jquery.min.js' })
		.then(function() {
			basket.require({ url: '<?php echo get_template_directory_uri(); ?>/js/plugin.js', unique: 0.3 })
			.then(function() {
        		basket.require({ url: '<?php echo get_template_directory_uri(); ?>/js/anguli.js', unique: 0.3 })
			})
		})
	});
</script>
-->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css"/>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/font/zzgf.css" type="text/css"/>
</head>
<body class="<?php echo $class ?>">
<canvas class="fix" id="blur"></canvas>

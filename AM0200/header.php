<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="google" content="notranslate" />
<meta name="author" content="LoeiFy">
<title><?php bloginfo('name'); ?><?php wp_title( '-', true, 'left' ); ?></title>
<meta name="keywords" content="design, picture, am0200, inspiration, illustrator, web design, music, jazzy" />
<meta name="description" content="<?php bloginfo('description') ?>" />
<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/base.css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/font.css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/icon.css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/am0200.css" />
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/plugin.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/function.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/am0200.js"></script>
<!--
<style>
body,div,h1,h2,li,p,ul{margin:0;padding:0;font-weight:400}li,ul{list-style:none}a,a:hover{text-decoration:none}figure,footer,header,section{display:block;margin:0;padding:0}img{display:block;max-width:100%;height:auto}body,html{background:#fff;height:100%;font-size:100%;-webkit-tap-highlight-color:transparent;-webkit-font-smoothing:antialiased}body{color:#555;overflow:hidden;position:relative;font-family:open_sans}body:before{background:grey;position:absolute;content:'';display:block;width:14px;height:14px;left:50%;top:50%;margin-left:-7px;margin-top:-7px;border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-webkit-animation:loading 2s ease-out forwards infinite;-moz-animation:loading 2s ease-out forwards infinite}@-webkit-keyframes loading{0%{-webkit-transform:scale(0.3)}50%{-webkit-transform:scale(1)}100%{-webkit-transform:scale(0.3)}}@-moz-keyframes loading{0%{-moz-transform:scale(0.3)}50%{-moz-transform:scale(1)}100%{-moz-transform:scale(0.3)}}#container{width:100%;height:100%;overflow:hidden;position:relative;z-index:1}#wrapper{position:relative;-webkit-backface-visibility:hidden}section{height:100%;position:relative;overflow:hidden;opacity:0}
</style>
<script src="<?php echo get_template_directory_uri(); ?>/js/basket.js?000"></script>
<script>
	basket.require({ url: '<?php echo get_template_directory_uri(); ?>/dist/am0200.css', unique: 10,  execute: false })
	.then(function(responses) {
        _stylesheet.appendStyleSheet(responses[0], function() {});
		basket.require({ url: '<?php echo get_template_directory_uri(); ?>/js/jquery.js' })
		.then(function() {
			basket.require({ url: '<?php echo get_template_directory_uri(); ?>/js/plugin.js', unique: 0 })
			.then(function() {
        		basket.require({ url: '<?php echo get_template_directory_uri(); ?>/dist/am0200.js', unique: 10 })
			})
		})
	});
</script>
-->
</head>
<body data-posts="<?php $count_posts = wp_count_posts(); echo $published_posts = $count_posts->publish;?>">

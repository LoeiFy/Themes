<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title><?php bloginfo('name'); ?> <?php wp_title( '|', true, 'left' ); ?></title>
<?php if (is_home()){
    $description = get_bloginfo('description');
    $keywords = "";
} elseif (is_single()){
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
}
?>
<meta name="keywords" content="<?php echo $keywords ?>" />
<meta name="description" content="<?php echo $description ?>" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css"/>
</head>
<body>
    
	<header id="header">

        <div class="center" id="h_inner">
        	<h1 class="left"><a href="/"><img src="<?php echo get_template_directory_uri(); ?>/images/logomin.png" alt="<?php bloginfo('name'); ?>"/></a></h1>
        	<nav class="right s-menu">
            <?php 
                wp_nav_menu( array( 
                    'theme_location' => 'primary-menu', 
                    'container' => '', 
                    'fallback_cb' => '' 
                ) ); 
            ?>
			</nav>
			<div id="tog_m"></div>
		</div>

  	<div id="loader">loading</div>
	</header>

    <?php $header_image = get_header_image(); $style = ' style="background: #' . get_header_textcolor() . ' url(' . esc_url( $header_image ). ') no-repeat top center;"' ?>
	<div id="showcase_cover" <?php echo $style ?>>
        <div></div>
		<h1>Showcase & Discover<br />Inspiration and Creation</h1>
	</div>

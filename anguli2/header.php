<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title><?php bloginfo('name'); ?> <?php wp_title( '|', true, 'left' ); ?></title>

<?php if (is_home()){
    $description = "";
    $keywords = "Inspiration, Customization, Rainmeter, Design, Web";
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

<!--<link rel="icon" href="icon.ico" type="image/x-icon" />-->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?20121224" type="text/css"/>
</head>

<body>
    
    <header class="clearfix box-shadow" id="header">
        <h1 class="left"><a href="/"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>"/></a></h1>
        <form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
            <input type="text" value="" autocomplete="off" placeholder="Search" name="s" id="s">
        </form>
        <div id="searchsubmit" class="right"></div>
        <nav class="right" id="s-menu">
            <?php 
                wp_nav_menu( array( 
                    'theme_location' => 'primary-menu', 
                    'container' => '', 
                    'fallback_cb' => '' 
                ) ); 
            ?>
        </nav>
    </header>

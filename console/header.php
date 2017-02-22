<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title><?php bloginfo('name'); ?> <?php wp_title( '|', true, 'left' ); ?></title>
<meta name="keywords" content="console" />
<meta name="description" content="console" />
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/icon.png" type="image/png" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>"/>
<script>var duoshuoQuery = {short_name:'lorem-ipsum'};</script>
</head>

<body <?php body_class(); ?>>
    
    <div id="header" class="rel w1 center">
        <div class="dib">
            <a id="logo" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('url'); ?>"></a>
        </div><!--
     --><div class="dib">
            <?php wp_nav_menu(array('theme_location' => 'Frist', 'container_class' => 'nav dib'));?><?php wp_nav_menu(array('theme_location' => 'Second', 'container_class' => 'nav dib'));?><?php wp_nav_menu(array('theme_location' => 'Third', 'container_class' => 'nav dib'));?>
        </div><!--
     --><div class="dib">
            <form method="get" class="icon-search" id="searchform" action="<?php bloginfo('url'); ?>">
                <input id="s" type="text" value="" autocomplete="off" name="s" placeholder="搜索.." />
                <input type="submit" class="hide" value="" />
            </form>
        </div>
    </div>

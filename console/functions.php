<?php

// shortcode
function Code($atts, $content) {
	extract(shortcode_atts(array(
		"lang" => ''
	), $atts));
	return '<pre><code class="'.$lang.'">'.$content.'</code></pre>';
}

add_shortcode( 'code', 'Code' );

// MENU SUPPORT
function register_menu() {
    register_nav_menus( array(
        'Frist' => __( 'Frist_Navigation', 'console' ),
        'Second' => __( 'Second_Navigation', 'console' ),
        'Third' => __( 'Third_Navigation', 'console' )
    ) );
}
add_action('init', 'register_menu');

// FEATURED IMAGE SUPPORT
add_theme_support( 'post-thumbnails', array( 'post', 'slide' ) );  

// POSTVIEW 
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}
 
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

/*
add_filter('pre_site_transient_update_core',    create_function('$a', "return null;")); // 关闭核心提示
add_filter('pre_site_transient_update_plugins', create_function('$a', "return null;")); // 关闭插件提示
add_filter('pre_site_transient_update_themes',  create_function('$a', "return null;")); // 关闭主题提示
remove_action('admin_init', '_maybe_update_core');    // 禁止 Wordpress 检查更新
remove_action('admin_init', '_maybe_update_plugins'); // 禁止 Wordpress 更新插件
remove_action('admin_init', '_maybe_update_themes');  // 禁止 Wordpress 更新主题
function remove_open_sans() {   
    wp_deregister_style( 'open-sans' );   
    wp_register_style( 'open-sans', false );   
    wp_enqueue_style('open-sans','');   
}   
add_action( 'init', 'remove_open_sans' );
 */

/**
 *  slide
 */
function slide_init(){
	$labels = array(
		'name' => _x('幻灯片', 'post type general name', 'console'),
		'singular_name' => _x('幻灯片', 'post type singular name', 'console'),
		'add_new' => _x('新建', 'book', 'console'),
		'add_new_item' => __('新建幻灯片', 'console'),
		'edit_item' => __('修改幻灯片', 'console'),
		'new_item' => __('新建幻灯片', 'console'),
		'all_items' => __('所有幻灯片', 'console'),
		'view_item' => __('查看幻灯片', 'console'),
		'search_items' => __('搜索幻灯片', 'console'),
		'not_found' =>  __('没有幻灯片', 'console'),
		'not_found_in_trash' => __('回收站没有幻灯片', 'console'),
		'parent_item_colon' => '',
		'menu_name' => __('幻灯片', 'console')
	);

	$args = array(
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => false,
		'rewrite' => false,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array( 'title', 'thumbnail', 'excerpt' )
	);

	register_post_type('slide', $args);

	add_image_size('slide', 940, 300, true);
}
add_action('init', 'slide_init');

// LIKETHIS
function tz_likeThis($post_id,$action = 'get') {

	if(!is_numeric($post_id)) {
		error_log("Error: Value submitted for post_id was not numeric");
		return;
	} //if

	switch($action) {
	
	case 'get':
		$data = get_post_meta($post_id, '_likes');
		
		if(!is_numeric($data[0])) {
			$data[0] = 0;
			add_post_meta($post_id, '_likes', '0', true);
		} //if
		
		return $data[0];
	break;
	
	
	case 'update':
		if(isset($_COOKIE["like_" + $post_id])) {
			return;
		} //if
		
		$currentValue = get_post_meta($post_id, '_likes');
		
		if(!is_numeric($currentValue[0])) {
			$currentValue[0] = 0;
			add_post_meta($post_id, '_likes', '1', true);
		} //if
		
		$currentValue[0]++;
		update_post_meta($post_id, '_likes', $currentValue[0]);
		
		setcookie("like_" + $post_id, $post_id,time()*20, '/');
	break;

	} //switch

} //tz_likeThis

function tz_printLikes($post_id) {
	$likes = tz_likeThis($post_id);
	
	$who = ' people like ';
	
	if($likes == 1) {
		$who = ' person likes ';
	} //if
	
	if(isset($_COOKIE["like_" + $post_id])) {

	print '<a href="#" class="likeThis active" id="like-'.$post_id.'"><span class="icon-heart"></span><span class="count">'.$likes.' 喜欢</span></a>';
		return;
	} //if

	print '<a href="#" class="likeThis" id="like-'.$post_id.'"><span class="icon-heart"></span><span class="count">'.$likes.' 喜欢</span></a>';
} //tz_printLikes


function setUpPostLikes($post_id) {
	if(!is_numeric($post_id)) {
		error_log("Error: Value submitted for post_id was not numeric");
		return;
	} //if
	
	
	add_post_meta($post_id, '_likes', '0', true);

} //setUpPost


function checkHeaders() {
	if(isset($_POST["likepost"])) {
		tz_likeThis($_POST["likepost"],'update');
	} //if

} //checkHeaders


add_action ('publish_post', 'setUpPostLikes');
add_action ('init', 'checkHeaders');

function posts_link_next_class($format){
     $format = str_replace('href=', 'class="next icon-arrow-right" href=', $format);
     return $format;
}
add_filter('next_post_link', 'posts_link_next_class');

function posts_link_prev_class($format) {
     $format = str_replace('href=', 'class="prev icon-arrow-left" href=', $format);
     return $format;
}
add_filter('previous_post_link', 'posts_link_prev_class');

?>

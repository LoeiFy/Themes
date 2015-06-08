<?php

// MENU SUPPORT
function register_menu() {
	register_nav_menu('primary-menu', __('Primary Menu'));
}
add_action('init', 'register_menu');

// FEATURED IMAGE SUPPORT
add_theme_support( 'post-thumbnails', array( 'post' ) );  

// links
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

function random_posts($posts_num=8,$before='<li>',$after='</li>'){
    global $wpdb;
    $sql = "SELECT ID, post_title,guid
            FROM $wpdb->posts
            WHERE post_status = 'publish' ";
    $sql .= "AND post_title != '' ";
    $sql .= "AND post_password ='' ";
    $sql .= "AND post_type = 'post' ";
    $sql .= "ORDER BY RAND() LIMIT 0 , $posts_num ";
    $randposts = $wpdb->get_results($sql);
    $output = '';
    foreach ($randposts as $randpost) {
        $post_title = stripslashes($randpost->post_title);
        $permalink = get_permalink($randpost->ID);
        $output .= $before.'<a href="'
            . $permalink . '"  rel="bookmark" title="';
        $output .= $post_title . '">' . $post_title . '</a>';
        $output .= $after;
    }
    echo $output;
}//random_posts()参数有$posts_num即文章数量,$before开始标签默认<li>,$after=结束标签默认</li>


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

// POST FORMATS
add_theme_support( 'post-formats', array('gallery', 'image' ));

// shortcode
function downLoad($atts) {
	extract(shortcode_atts(array(
		"url" => 'http://'
	), $atts));
	return '<a target="_blank" class="download tac db rel icon-link center" href="'.$url.'">get wallpapers</a>';
}
add_shortcode('download', 'downLoad');

function Mp3( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'name' => '',
			'url' => '',
			'img' => '',
			'autoplay' => ''
		), $atts )
	);

	$id = mt_rand(); 

	// Code
return '<div id="audio'. $id .'" class="mt25 mb15 audio" data-play="'. $autoplay .'" data-url="'. $url .'" data-name="'. $name .'" data-img="'. $img .'"><div class="center hide audiowrap oh rel"><div class="rel"><p id="audio_name" class="abs cf f16 nowrap"></p><p id="audio_time" class="abs cf f24"></p><div id="audio_play" class="icon-play cf abs"></div><div id="audio_pos"></div></div></div></div>'; 

}
add_shortcode( 'mp3', 'Mp3' );

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

	print '<a href="#" class="likeThis active" id="like-'.$post_id.'"><span class="icon"></span><span class="count">'.$likes.' Likes</span></a>';
		return;
	} //if

	print '<a href="#" class="likeThis" id="like-'.$post_id.'"><span class="icon"></span><span class="count">'.$likes.' Likes</span></a>';
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

?>

<?php
// MENU SUPPORT
function register_menu() {
	register_nav_menu('primary-menu', __('Primary Menu'));
}
add_action('init', 'register_menu');

// FEATURED IMAGE SUPPORT
add_theme_support( 'post-thumbnails', array( 'post' ) );  
add_image_size( 'thumb_l', 638, 442, true ); 
add_image_size( 'thumb_ls', 638, 189, true );
add_image_size( 'thumb_l_ls', 968, 442, true );
add_image_size( 'thumb_m', 308, 189, true );
add_image_size( 'thumb_m_s', 308, 442, true );

// POST OPTIONS    
if (!class_exists('PostOptions')) {

	class PostOptions {

      var $defaults = array(
         "post_size" => "m"
      );

		function PostOptions($args = array()) {
			$this->register($args);
		}

		function register($args = array()) {
			$defaults = array(
				'label' => 'Post options ( Important! you must set post options and excerpt! )',
				'id' => 'posthide',
				'post_type' => 'post',
				'priority' => 'low',
			);

         if ( isset($_GET['post']) )
         $this->post_id=$_GET['post'];
         else $this->post_id = 0;
         //if (!$this->post_id) $this->post_id=the_ID();

         if (isset($args['post']))
         if ($args['post']) $this->post_id = $args['post'];

			$args = wp_parse_args($args, $defaults);

			// Create and set properties
			foreach($args as $k => $v) {
				$this->$k = $v;
			}

			add_action('add_meta_boxes', array($this, 'add_metabox'));
			add_action('save_post', array($this, 'save_page'));
			
		}
		
		function add_metabox() {   
			add_meta_box("{$this->post_type}-{$this->id}", __($this->label), array($this, 'thumbnail_meta_box'), $this->post_type, 'side', $this->priority);
		}

		function thumbnail_meta_box() {
			global $post;
			$thumbnail_id = get_post_meta($post->ID, "{$this->post_type}_{$this->id}_thumbnail_id", true);
			echo $this->post_thumbnail_html($thumbnail_id);
		}

		function add_attachment_field($form_fields, $post) {
		}

		function has_post_thumbnail($post_type, $id, $post_id = null) {
			if (null === $post_id) {
				$post_id = get_the_ID();
			}

			if (!$post_id) {
				return false;
			}

			return get_post_meta($post_id, "{$post_type}_{$id}_thumbnail_id", true);
		}

		function the_post_thumbnail($post_type, $id, $post_id = null, $size = 'post-thumbnail', $attr = '') {
		}

		function get_post_thumbnail_id($post_type, $id, $post_id) {
			return get_post_meta($post_id, "{$post_type}_{$id}_thumbnail_id", true);
		}

		function post_thumbnail_html($thumbnail_id = NULL) {
			global $content_width, $_wp_additional_image_sizes, $post_ID;

         $nonce= wp_create_nonce  ('my-nonce');
         
         $content='
            
<input type="hidden" name="nonce" value='.$nonce.' />
            
<p>
Post Size :<br /><br />
<label><input type="radio" name="post_size" value="l" '.($this->get_post_option('post_size') == 'l' ? ' checked="checked"' : '').' /> Large : 638x442</label><br />
<label><input type="radio" name="post_size" value="ls" '.($this->get_post_option('post_size') == 'ls' ? ' checked="checked"' : '').' /> Landscape : 638x190</label><br />
<label><input type="radio" name="post_size" value="l_ls" '.($this->get_post_option('post_size') == 'l_ls' ? ' checked="checked"' : '').' /> Large_landscape : 968x442</label><br />
<label><input type="radio" name="post_size" value="m" '.($this->get_post_option('post_size') == 'm' ? ' checked="checked"' : '').' /> Medium : 308x190</label><br />
<label><input type="radio" name="post_size" value="m_s" '.($this->get_post_option('post_size') == 'm_s' ? ' checked="checked"' : '').' /> Medium_second : 308x445</label><br />
</p>

            ';

			return $content;
		}
		
		function get_post_option($name)
		{
		   global $post;
		   if (!$this->post_id)
            $this->post_id=$post->ID;
		   $v = get_post_meta($this->post_id, '_option_'.$name, true);
		   if (strlen($v) == 0)
		   {
		      return $this->defaults[$name];
		   }
		   return $v;
		}

		function set_post_option($name, $val)
		{
		   add_post_meta($this->post_id, '_option_'.$name, $val, true);
		   update_post_meta($this->post_id, '_option_'.$name, $val);
		}
		
		function save_page($post_id) {
		
		
		if (!isset($_POST['nonce'])) return;
		
           if ( !wp_verify_nonce( $_POST['nonce'], 'my-nonce' )) {
             return $post_id;
           }
           
           $this->post_id=$_POST['post_ID'];

           if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
             return $post_id;

           /*
           if ( 'post' == $_POST['post_type'] ) {
             if ( !current_user_can( 'edit_post', $post_id ) )
               return $post_id;
           } else {
               return $post_id;  
           }
           */
			
			foreach (explode(" ", "post_size") as $opt) {
				if( !isset($_POST[$opt]) ) {
					continue;
				}
				$this->set_post_option($opt, $_POST[$opt]);
			}

           return 1;
		}

	}
}

global $postoptions;
$postoptions=new PostOptions();

function the_post_size()
{
  global $postoptions, $post;
  $postoptions->post_id = $post->ID;
  $size = $postoptions->get_post_option('post_size');
  return $size;
}

/* SIDEBARS
register_sidebar(array(
  'name' => 'Sidebar',
  'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
  'after_widget' => '</div>',
  'before_title' => '<h3 class="widget-title">',
  'after_title' => '</h3>',
));
*/

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

	print '<a href="#" class="likeThis active" id="like-'.$post_id.'"><span class="icon"></span><span class="count">'.$likes.'</span></a>';
		return;
	} //if

	print '<a href="#" class="likeThis" id="like-'.$post_id.'"><span class="icon"></span><span class="count">'.$likes.'</span></a>';
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


/*function jsIncludes() {
	wp_enqueue_script('jquery');

} //jsIncludes*/

add_action ('publish_post', 'setUpPostLikes');
add_action ('init', 'checkHeaders');
//add_action ('get_header', 'jsIncludes');

?>

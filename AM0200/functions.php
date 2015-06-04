<?php

// ADMIN PANL META BOX HIDE
function customadmin() {
    if ( is_admin() ) {
        $script = <<< EOF
<script type='text/javascript'>
    jQuery(document).ready(function($) {
        jQuery('#postexcerpt').show()
        jQuery('#wp-content-editor-container').hide()
        jQuery('#wp-content-editor-tools .wp-editor-tabs').hide()
        jQuery('head').append('<style>#post-status-info{display:none!important}</style>')
    });
</script>
EOF;
        echo $script;
    }
}
add_action('admin_footer', 'customadmin');

// REMOVE IMAGE CROP
function remove_default_image_sizes( $sizes) {
    unset($sizes['thumbnail']);
    unset($sizes['medium']);
    unset($sizes['large']);
    return $sizes;
}
add_filter('intermediate_image_sizes_advanced','remove_default_image_sizes');

// ORIGIN URL
add_action( 'add_meta_boxes', 'url_box' );
function url_box() {
    add_meta_box( 'url_box_id', 'Post Info', 'url_box_input', 'post', 'normal', 'high' );
}
function url_box_input($post) {
    $values = get_post_custom( $post->ID );
    $url = isset( $values['origin_url'] ) ? esc_attr( $values['origin_url'][0] ) : '';
    $background = isset( $values['background'] ) ? esc_attr( $values['background'][0] ) : '';
    $color = isset( $values['color'] ) ? esc_attr( $values['color'][0] ) : '';
    print '<p><label style="display: inline-block; width: 100px;" for="origin_url">URL : </label><input size="50" type="url" value="'.get_post_meta($post->ID, 'origin_url', true).'" name="origin_url" /></p>'.
          '<p><label style="display: inline-block; width: 100px;" for="background">Background : </label><input size="50" type="text" value="'.get_post_meta($post->ID, 'background', true).'" name="background" /></p>'.
          '<p><label style="display: inline-block; width: 100px;" for="color">Color : </label><input size="50" type="text" value="'.get_post_meta($post->ID, 'color', true).'" name="color" /></p>';
}
add_action( 'save_post', 'url_box_save' );
function url_box_save($post_id) {
    update_post_meta($post_id, 'origin_url', $_POST['origin_url']);
    update_post_meta($post_id, 'background', $_POST['background']);
    update_post_meta($post_id, 'color', $_POST['color']);
}

// IGNORE STICKY POSTS
function dangopress_alter_main_loop($query)
{
    /* Only for main loop in home page */
    if (!$query->is_home() || !$query->is_main_query())
        return;

    // ignore sticky posts, don't show them in the start
    $query->set('ignore_sticky_posts', 1);
}
add_action('pre_get_posts', 'dangopress_alter_main_loop'); 

// REMOVE FONT
function remove_open_sans() {   
    wp_deregister_style( 'open-sans' );   
    wp_register_style( 'open-sans', false );   
    wp_enqueue_style('open-sans','');   
}   
add_action( 'init', 'remove_open_sans' );

?>

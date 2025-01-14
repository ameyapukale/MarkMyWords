<?php
/*
  Plugin Name: MarkMyWords.
  Description: Accurate grading at your finger tips.
  Version: 1.0.0
  Author: ASP
 */

define("JUDGING_PARAMETER_DIR_PATH", plugin_dir_path(__FILE__));

add_action( 'admin_menu', 'wporg_parameter_admin_option_page' );
function wporg_parameter_admin_option_page() {
    add_menu_page(
        'Judging Parameter',
        'Judging Parameter',
        'manage_options',
        'list-posts',
        'parameter_admin_option_page_html',
        plugin_dir_url(__FILE__) . 'images/icon-wporg.svg'
    );
    add_submenu_page(
        "list-posts",
        "List Posts",
        "List Posts",
        "read", 
        "list-posts", 
        "parameter_admin_option_page_html",
    );
    add_submenu_page(
        "list-posts",
        "Rate Post",
        "Rate Post",
        "read", 
        "rate-post", 
        "rate_post_admin_option_page_html",
    );
}
add_action( 'admin_enqueue_scripts', 'my_enqueue' );

function my_enqueue( $hook ) {
	if ( 'judging-parameter_page_rate-post' !== $hook ) {
		return;
	}
	wp_enqueue_script(
		'ajax-script',
		plugins_url( '/assets/js/myJquery.js', __FILE__ ),
		array( 'jquery' ),
		'1.0.0',
		array(
		   'in_footer' => true,
		)
	);
	wp_register_style(
		'namespace',
		plugins_url( '/assets/css/style.css', __FILE__ )
	);
    wp_enqueue_script(
		'custom-script',
		plugins_url( '/assets/js/script.js', __FILE__ ),
		array( 'jquery' ),
		'1.0.0',
		array(
		   'in_footer' => true,
		)
	);
}
function wporg_css_body_class( $classes ) {
	if ( ! is_admin() ) {
		$classes[] = '/assets/pryley-star-rating/star-rating.css';
	}
	return $classes;
}
add_filter( 'body_class', 'wporg_css_body_class' );

function rate_post_admin_option_page_html(){
    include_once JUDGING_PARAMETER_DIR_PATH . '/views/rate-post.php';
}

function parameter_admin_option_page_html(){
    include_once JUDGING_PARAMETER_DIR_PATH . '/views/list-post.php';
 }

 function add_story_meta_box(){
    add_meta_box(
        'story_box_id',                 // Unique ID
        'Story',      // Box title
        'story_custom_box_html',  // Content callback, must be of type callable
        // $screen                            // Post type
         'post'
    );
 }

 function add_flow_meta_box(){
    add_meta_box(
        'flow_box_id',                 // Unique ID
        'Flow',      // Box title
        'flow_custom_box_html',  // Content callback, must be of type callable
        // $screen                            // Post type
         'post'
    );
 }

 function add_message_meta_box(){
    add_meta_box(
        'message_box_id',                 // Unique ID
        'Message',      // Box title
        'message_custom_box_html',  // Content callback, must be of type callable
        // $screen                            // Post type
        'post'
    );
 }

 function count_meta_box(){
    add_meta_box(
        'count_box_id',                 // Unique ID
        'Word Count',      // Box title
        'count_custom_box_html',  // Content callback, must be of type callable
        // $screen                            // Post type
        'post'
    );
 }
 function vission_mission_box(){ 
    add_meta_box(
        'vision_motive_box_id',                 // Unique ID
        'Overall Content-Vission & motive',      // Box title
        'wporg_custom_box_html',  // Content callback, must be of type callable
        // $screen                            // Post type
        'post'
    );
}

 function wporg_add_custom_box(){  
    add_meta_box(
        'story_box_id',                 // Unique ID
        'Story',      // Box title
        'story_custom_box_html',  // Content callback, must be of type callable
        // $screen                            // Post type
            'post'
    );		
    add_meta_box(
        'flow_box_id',                 // Unique ID
        'Flow',      // Box title
        'flow_custom_box_html',  // Content callback, must be of type callable
        // $screen                            // Post type
            'post'
    );
    add_meta_box(
        'message_box_id',                 // Unique ID
        'Message',      // Box title
        'message_custom_box_html',  // Content callback, must be of type callable
        // $screen                            // Post type
        'post'
    );
    add_meta_box(
        'count_box_id',                 // Unique ID
        'Word Count',      // Box title
        'count_custom_box_html',  // Content callback, must be of type callable
        // $screen                            // Post type
        'post'
    );
    add_meta_box(
        'vision_motive_box_id',                 // Unique ID
        'Overall Content-Vission & motive',      // Box title
        'wporg_custom_box_html',  // Content callback, must be of type callable
        // $screen                            // Post type
        'post'
    );
}
add_action( 'add_meta_boxes', 'wporg_add_custom_box' );

function story_custom_box_html($post){
    $value = get_post_meta( $post->ID, 'story_box_id_select', true );
    ?>
    <select name ="story_box_id_select" class="star-rating">
        <option value="">Select a rating</option>
        <option value="20" <?php selected( $value, '25' ); ?>>Excellent</option>
        <option value="16" <?php selected( $value, '20' ); ?>>Very Good</option>
        <option value="12" <?php selected( $value, '15' ); ?>>Average</option>
        <option value="8" <?php selected( $value, '10' ); ?>>Poor</option>
        <option value="4" <?php selected( $value, '5' ); ?>>Terrible</option>
    </select>

    <?php
}
function flow_custom_box_html($post){
    $value = get_post_meta( $post->ID, 'flow_box_id_select', true );
    ?>
    <select name="flow_box_id_select" class="star-rating">
        <option value="">Select a rating</option>
        <option value="20" <?php selected( $value, '25' ) ?>>Excellent</option>
        <option value="16" <?php selected( $value, '20' ); ?>>Very Good</option>
        <option value="12" <?php selected( $value, '15' ); ?>>Average</option>
        <option value="8" <?php selected( $value, '10' ); ?>>Poor</option>
        <option value="4" <?php selected( $value, '5' ); ?>>Terrible</option>
    </select>

    <?php
}
function message_custom_box_html($post){
    $value = get_post_meta( $post->ID, 'message_box_id_select', true );
    ?>
    <select name="message_box_id_select" class="star-rating">
        <option value="">Select a rating</option>
        <option value="20" <?php selected( $value, '25' ); ?>>Excellent</option>
        <option value="16" <?php selected( $value, '20' ); ?>>Very Good</option>
        <option value="12" <?php selected( $value, '15' ); ?>>Average</option>
        <option value="8" <?php selected( $value, '10' ); ?>>Poor</option>
        <option value="4" <?php selected( $value, '5' ); ?>>Terrible</option>
    </select>

    <?php
}
function count_custom_box_html($post){
    $countvalue = get_post_meta( $post->ID, 'word_count_box_id_select', true );
    ?>
    <select name="word_count_box_id_select" class="star-rating">
        <option value="">Select a rating</option>
        <option value="20" <?php selected( $countvalue, '25' ); ?>>Excellent</option>
        <option value="16" <?php selected( $countvalue, '20' ); ?>>Very Good</option>
        <option value="12" <?php selected( $countvalue, '15' ); ?>>Average</option>
        <option value="8" <?php selected( $countvalue, '10' ); ?>>Poor</option>
        <option value="4" <?php selected( $countvalue, '5' ); ?>>Terrible</option>
    </select>

    <?php
}
function wporg_custom_box_html($post){
    $vissionvalue = get_post_meta( $post->ID, 'vision_motive_box_id_select', true );
    ?>
    <select name="vision_motive_box_id_select" class="star-rating">
        <option value="">Select a rating</option>
        <option value="20" <?php selected( $vissionvalue, '25' ); ?>>Excellent</option>
        <option value="16" <?php selected( $vissionvalue, '20' ); ?>>Very Good</option>
        <option value="12" <?php selected( $vissionvalue, '15' ); ?>>Average</option>
        <option value="8" <?php selected( $vissionvalue, '10' ); ?>>Poor</option>
        <option value="4" <?php selected( $vissionvalue, '5' ); ?>>Terrible</option>
    </select>

    <?php
}

function wporg_save_postdata( $post_id ) {      
    update_post_meta(
        $post_id,
        'story_box_id_select',
        $_POST['story_box_id_select']
    );

    update_post_meta(
        $post_id,
        'flow_box_id_select',
        $_POST['flow_box_id_select']
    );
    update_post_meta(
        $post_id,
        'message_box_id_select',
        $_POST['message_box_id_select']
    );
    update_post_meta(
        $post_id,
        'word_count_box_id_select',
        $_POST['word_count_box_id_select']
    );
    update_post_meta(
        $post_id,
        'vision_motive_box_id_select',
        $_POST['vision_motive_box_id_select']
    );
}
add_action( 'save_post', 'wporg_save_postdata' );

register_deactivation_hook( __FILE__, 'pluginprefix_deactivate' );

function pluginprefix_deactivate(){
    remove_menu_page("list-posts");
    remove_meta_box("story_box_id", "post", "side");
}

?>
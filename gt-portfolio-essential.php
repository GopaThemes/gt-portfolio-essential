<?php
/**
 * Plugin Name: Portfolio Essential by GopaThemes
 * Plugin URI: https://github.com/GopaThemes/gt-portfolio-essential
 * Description: Portfolio Essential Plugin for WordPress by GopaThemes
 * Version: 1.05
 * Author: GopaThemes
 * Author URI: http://www.gopathemes.com
 */

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

//include_once plugin_dir_path(__FILE__) . 'inc/shortcodes/content-boxes.php';
include_once plugin_dir_path(__FILE__) . 'inc/shortcodes/testimonials.php';
include_once plugin_dir_path(__FILE__) . 'inc/shortcodes/portfolio.php';
//include_once plugin_dir_path(__FILE__) . 'inc/shortcodes/blog_masonry.php';
include_once plugin_dir_path(__FILE__) . 'inc/shortcodes/skillbars.php';
include_once plugin_dir_path(__FILE__) . 'inc/shortcodes/clients.php';
include_once plugin_dir_path(__FILE__) . 'inc/shortcodes/common.php';
include_once plugin_dir_path(__FILE__) . 'inc/shortcodes/buttons.php';
include_once plugin_dir_path(__FILE__) . 'inc/cpt.php';
include_once plugin_dir_path(__FILE__) . 'inc/meta-boxes.php';
include_once plugin_dir_path(__FILE__) . 'inc/compile-sass.php';


// Hooks your functions into the correct filters
function gopathemes_add_mce_button() {
	// check user permissions
	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
		return;
	}
	// check if WYSIWYG is enabled
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'gopathemes_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'gopathemes_register_mce_button' );
	}
}
add_action('admin_head', 'gopathemes_add_mce_button');

// Declare script for new button
function gopathemes_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['gopathemes_shortcode_button'] = plugin_dir_url( __FILE__ ) . 'js/gopathemes-shortcodes.js';
	return $plugin_array;
}

// Register new button in the editor
function gopathemes_register_mce_button( $buttons ) {
	array_push( $buttons, 'gopathemes_shortcode_button' );
	return $buttons;
}

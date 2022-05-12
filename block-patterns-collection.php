<?php
/**
 * Plugin Name:       Block Patterns for Food Bloggers
 * Plugin URI:        https://www.wpzoom.com/plugins/block-patterns/
 * Description:       A beautiful collection of block patterns for food bloggers
 * Version:           1.0.0
 * Requires at least: 5.7
 * Requires PHP:      7.2
 * Author:            WPZOOM
 * Author URI:        https://www.wpzoom.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wpzoom-food-blog-patterns
 * Domain Path:       /languages
 */

require_once 'register-patterns.php';


function wpzoom_register_scripts() {
    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style( 'style',  $plugin_url . "assets/css/style.css");
}

add_action( 'wp_enqueue_scripts', 'wpzoom_register_scripts' );
// add_action( 'admin_print_styles', 'wpzoom_register_scripts' );
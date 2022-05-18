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


function wpzfbp_register_scripts() {
    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_script( 'wpzfbp_utils',  $plugin_url . "assets/js/utils.js", array( 'jquery' ), '1.0', true );
    wp_enqueue_style( 'style',  $plugin_url . "assets/css/style.css");

}

add_action( 'wp_enqueue_scripts', 'wpzfbp_register_scripts' );
// add_action( 'admin_print_styles', 'wpzoom_register_scripts' );



add_editor_style( array( plugin_dir_path( __FILE__ ) . 'assets/css/style.css' ) );




/**
 * Enqueue block JavaScript and CSS for the editor
 */
function wpzfbp_editor_scripts() {

    // Enqueue block editor JS
    wp_enqueue_script(
        'wpzfbp-editor-js',
        plugins_url( '/assets/js/editor.js', __FILE__ ),
        [ 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-editor' ],
        filemtime( plugin_dir_path( __FILE__ ) . 'assets/js/editor.js' )
    );

    // Enqueue block editor styles
    wp_enqueue_style(
        'wpzfbp-editor-css',
        plugins_url( '/assets/css/style.css', __FILE__ ),
        [ 'wp-edit-blocks' ],
        filemtime( plugin_dir_path( __FILE__ ) . 'assets/css/style.css' )
    );

}

// Hook the enqueue functions into the editor
add_action( 'enqueue_block_editor_assets', 'wpzfbp_editor_scripts' );
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


remove_filter( 'admin_head', 'wp_check_widget_editor_deps' );



/**
 * Enqueue block JavaScript and CSS for the editor
 */
function wpzfbp_editor_scripts() {

    // Enqueue block editor JS
    wp_enqueue_script(
        'wpzfbp-editor-js',
        plugins_url( '/assets/js/editor.js', __FILE__ ),
        [ 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components' ],
        filemtime( plugin_dir_path( __FILE__ ) . 'assets/js/editor.js' ),
		true
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



/**
 * Add group block inner container.
 * The inner container has been removed in WordPress 5.8 if a theme.json
 * is available in the theme.
 *
 * @param   string  $block_content The block content
 * @return  string The updated block content
 */
function wpzfbp_group_inner( $block_content ) {
    libxml_use_internal_errors( true );
    $dom = new DOMDocument();
    $dom->loadHTML(
        mb_convert_encoding(
            '<html>' . $block_content . '</html>',
            'HTML-ENTITIES',
            'UTF-8'
        ),
        LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
    );

    foreach ( $dom->getElementsByTagName( 'div' ) as $div ) {
        // check for desired class name
        if (
            strpos( $div->getAttribute( 'class' ), 'wp-block-group' ) === false
            || strpos( $div->getAttribute( 'class' ), 'wp-block-group__inner-container' ) !== false
        ) {
            continue;
        }

        // check if we already processed this div
        foreach ( $div->childNodes as $childNode ) {
            if (
                method_exists( $childNode, 'getAttribute' )
                && strpos( $childNode->getAttribute( 'class' ), 'wp-block-group__inner-container' ) !== false
            ) {
                continue 2;
            }
        }

        // create the inner container element
        $inner_container = $dom->createElement( 'div' );
        $inner_container->setAttribute( 'class', 'wp-block-group__inner-container' );
        // get all children of the current group
        $children = iterator_to_array( $div->childNodes );

        // append all children to the inner container
        foreach ( $children as $child ) {
            $inner_container->appendChild( $child );
        }

        // append new inner container to the group block
        $div->appendChild( $inner_container );
    }

    return str_replace( [ '<html>', '</html>' ], '', $dom->saveHTML( $dom->documentElement ) );
}

add_filter( 'render_block_core/group', 'wpzfbp_group_inner' );

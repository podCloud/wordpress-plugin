<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://podcloud.fr
 * @since             1.0.0
 * @package           podcloud
 *
 * @wordpress-plugin
 * Plugin Name:       podCloud
 * Description:       Ce plugin permet d'inclure un lecteur podCloud d'un podcast ou d'un épisode, simplement en collant son URL dans l'éditeur WordPress. Il ajoute le script de redimensionnement automatique du lecteur magique.
 * Version:           1.0.0
 * Author:            podCloud
 * Author URI:        https://podcloud.fr
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       podcloud
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( "WPINC" ) ) {
    die;
}

define( "PODCLOUD_VERSION", "1.0.0" );
define( "PODCLOUD_HELPER_SCRIPT", "https://podcloud.fr/player-embed/helper.js" );

function podcloud_add_helper( $html, $url, $attr, $post_ID ) {
    if ( false !== strpos( $url, "podcloud.fr" ) ) {
        wp_enqueue_script("podcloud_helper");
    }

    return $html;
}

add_filter( "embed_oembed_html", "podcloud_add_helper", 99, 4 );

// Only if WP_VER > 5.4
function podcloud_enqueue_gutenberg_helper() {
    wp_enqueue_script("podcloud_gutenberg_helper");
}
add_action( "enqueue_block_editor_assets", "podcloud_enqueue_gutenberg_helper" );

function podcloud_init() {

    // register scripts
    wp_register_script(
        "podcloud_helper",
        PODCLOUD_HELPER_SCRIPT,
        [],
        PODCLOUD_VERSION,
        true
    );

    wp_register_script(
        "podcloud_gutenberg_helper",
        plugins_url("gutenberg-helper.js", __FILE__),
        [ "wp-blocks" ],
        PODCLOUD_VERSION,
        false
    );

    // add oembed provider
    $supported = [
        "podcloud.fr/podcast/*",
        "*.lepodcast.fr/*",
        "pdca.st/*",
    ];

    foreach($supported as $format) {
        foreach(["", "s"] as $scheme) {
            wp_oembed_add_provider(
                "http".$scheme."://".$format,
                "https://podcloud.fr/embed.json"
            );
        }
    }
}

podcloud_init();

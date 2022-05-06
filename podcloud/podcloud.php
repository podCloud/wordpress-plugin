<?php

/**
 *
 * @link              https://podcloud.fr
 * @since             1.0.0
 * @package           podcloud
 *
 * @wordpress-plugin
 * Plugin Name:       podCloud
 * Description:       This plugins allow embedding of the podCloud player by pasting a podcast or episode URL into editor.
 * Version:           1.4.0
 * Author:            podCloud
 * Author URI:        https://podcloud.fr
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       podcloud
 */

// If this file is called directly, abort.
if ( ! defined( "WPINC" ) ) {
    die;
}

define( "PODCLOUD_VERSION", "1.3.0" );
define( "PODCLOUD_HELPER_SCRIPT", "https://podcloud.fr/player-embed/helper.js" );

function podcloud_enqueue_helper() {
    // register scripts
    wp_register_script(
        "podcloud_helper",
        PODCLOUD_HELPER_SCRIPT,
        [],
        PODCLOUD_VERSION,
        true
    );
    wp_enqueue_script("podcloud_helper");

    wp_register_style(
        "podcloud_helper_style",
        plugins_url( "podcloud-embed.css", __FILE__ ),
        [],
        PODCLOUD_VERSION,
        "all"
    );
    wp_enqueue_style("podcloud_helper_style");
}
add_action( "wp_enqueue_scripts", "podcloud_enqueue_helper" );


function podcloud_enqueue_gutenberg_helper() {
    wp_register_script(
        "podcloud_gutenberg_helper",
        plugins_url("gutenberg-helper.js", __FILE__),
        [ "wp-blocks" ],
        PODCLOUD_VERSION,
        false
    );
    wp_enqueue_script("podcloud_gutenberg_helper");
}
add_action( "enqueue_block_editor_assets", "podcloud_enqueue_gutenberg_helper" );

function podcloud_init() {
    // add oembed provider
    $supported = [
        "podcloud.fr/podcast/*",
        "podcloud.fr/podcast/*",
        "*.lepodcast.fr",
        "*.lepodcast.fr/*",
        "pdca.st/*",
        "podcloud.fr/users/*/playlists/*"
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

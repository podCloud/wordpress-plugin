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

function enqueue_podcloud_helper() {
    wp_enqueue_script(
        "podcloud_helper",
        PODCLOUD_HELPER_SCRIPT,
        array(),
        PODCLOUD_VERSION
    );
}

add_action( "wp_enqueue_scripts", "enqueue_podcloud_helper" );

$supported = [
    "http://podcloud.fr/podcast/*",
    "https://podcloud.fr/podcast/*",
    "http://*.lepodcast.fr/*",
    "https://*.lepodcast.fr/*",
    "http://pdca.st/*",
    "https://pdca.st/*",
];

foreach($supported as $format) {
    wp_oembed_add_provider( $format, "https://podcloud.fr/embed" );
}

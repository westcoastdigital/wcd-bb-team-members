<?php

/**
 * Plugin Name: WCD Team Members - Beaver Builder
 * Plugin URI: https://westcoastdigital.com.au
 * Description: Add Team Members to your website with beaver Builder
 * Version: 1.0
 * Author: West Coast Digital
 * Author URI: https://westcoastdigital.com.au
 * Text Domain: wcd-team
 * Domain Path: /languages
 */

define( 'WCD_TEAM_DIR', plugin_dir_path( __FILE__ ) );
define( 'WCD_TEAM_URL', plugins_url( '/', __FILE__ ) );

function wcd_team_module() {
    if ( class_exists( 'FLBuilder' ) ) {
        require_once 'includes/wcd-team-module.php';
    }
}
add_action( 'init', 'wcd_team_module' );
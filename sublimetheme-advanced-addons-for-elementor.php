<?php
/**
 * Plugin Name: SublimeTheme - Advanced Addons for Elementor
 * Description: A collection of 7 Advanced Elementor Widgets for elementor built by SublimeTheme.
 * Version: 1.0.6
 * Requires at least: 4.9
 * Requires PHP: 5.6
 * Author: SublimeTheme
 * Author URI: https://sublimetheme.com/
 * License: GPL v3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: sublimetheme-advanced-addons-for-elementor
 * Domain Path: /languages
 * Elementor tested up to: 3.24.4
 * Requires Plugins: elementor
 * 
 * @package SublimeTheme_Advanced_Addons_For_Elementor
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_PATH', plugin_dir_path( __FILE__ ) );
define( 'SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_URL', plugin_dir_url( __FILE__ ) );

if( ! function_exists('get_plugin_data') ){
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

$plugin_data = get_plugin_data( SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_PATH . 'sublimetheme-advanced-addons-for-elementor.php' );

define( 'SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_VERSION', $plugin_data['Version'] );
define( 'SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_TEXTDOMAIN', $plugin_data['TextDomain'] );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
*/
require SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_PATH . 'inc/class-saafe.php';
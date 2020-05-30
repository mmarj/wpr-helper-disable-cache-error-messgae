<?php

defined( 'ABSPATH' ) or die( 'Block Direct access' );

/**
 *
 *
 * @link              https://wpregular.com/author/aurangajeb
 * @since             1.0.0
 
 *
 * @wordpress-plugin
 * Plugin Name:       WP Rocket Helper - Disable Page Caching & Warning Message
 * Plugin URI:        https://wpregular.com
 * Description:       This plugin is an intial release. It will disable the WP Rocket Page Caching and warning on the Admin Dashboard. However, <strong>before activating this plugin make sure you have the WP Rocket Enable regardless there is no use of this Helper plugin.</strong>
 * Version:           1.0.0
 * Author:            MM Aurangajeb
 * Author URI:        https://wpregular.com/author/aurangajeb
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpr-helper
 * Domain Path:       /languages
 */


// Security check - prevent public user to directly access the files through URL
defined( 'ABSPATH' ) or die();


/**
 * Disable page caching in WP Rocket. Prevent WP_CACHE value tweaking on the wp-config file
 *
 */
add_filter( 'do_rocket_generate_caching_files', '__return_false' );


/*// To disable WP_CACHE persistent true value for WP-Rocket
function set_rocket_wp_cache_define_false( $turn_it_on ) {
    return 'false';
}
add_filter('set_rocket_wp_cache_define', 'set_rocket_wp_cache_define_false');

*/
// Clear WP Rocket cache.
function clear_wpr_cache() {

	if ( ! function_exists( 'rocket_clean_domain' ) ) {
		return false;
	}

	// Clear WP Rocket cache.
	rocket_clean_domain();
}
register_activation_hook( __FILE__, __NAMESPACE__ . '\clear_wpr_cache' );


/**
 * Hide admin notice
 * Drawbacks: This will hide all the notification for .notice-warning & .notice-error class
 */

function admin_area_error_hide() {
    wp_enqueue_style('admin_area_error_hide_css', plugins_url('assets/css/style.css', __FILE__), false, null, false);
    wp_enqueue_script('admin_area_error_hide_js', plugins_url('assets/js/script.js', __FILE__), false, null, false);
    
}
add_action('admin_enqueue_scripts', 'admin_area_error_hide');
add_action('login_enqueue_scripts', 'admin_area_error_hide');

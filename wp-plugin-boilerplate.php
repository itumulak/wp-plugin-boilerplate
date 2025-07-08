<?php
/**
 * Plugin Name: WP Plugin Boilerplate
 * Description:
 * Version: 1.0
 * Author: Ian Tumulak
 * License: GPL2
 * Text Domain: itumulak/wp-boilerplate
 *
 * @package itumulak/wp-boilerplate
 */

use Itumulak\Includes\PluginLoader;
use Itumulak\Includes\Models\DB\DatabaseLoader;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'WPPB_PATH', plugin_dir_path( __FILE__ ) );
define( 'WPPB_URL', plugin_dir_url( __FILE__ ) );

require_once WPPB_PATH . 'vendor/autoload.php';

register_activation_hook( __FILE__, 'itumulak_activate_plugin' );
function itumulak_activate_plugin() {
	( new DatabaseLoader() )->init();
}

( new PluginLoader() );

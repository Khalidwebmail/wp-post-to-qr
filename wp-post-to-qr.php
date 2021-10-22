<?php
/**
 * QR code for post
 *
 * @package           PluginPackage
 * @author            Khalid Ahmed
 * @copyright         2021 Khalid Ahmed
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       QR code for post
 * Plugin URI:        https://github.com/Khalidwebmail/wp-post-to-qr
 * Description:       Description of the plugin.
 * Version:           1.0.0
 * Requires at least: 5.6
 * Requires PHP:      7.0
 * Author:            Khalid Ahmed
 * Author URI:        https://example.com
 * Text Domain:       qr-code-for-post
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://github.com/Khalidwebmail/wp-post-to-qr
 */

use QR\Code\Wp_Code_Settings;
use QR\Code\Wp_Enqueue;
use QR\Code\Wp_Generate_Code;

if( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Include autoload file
 */
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

/**
 * Class Wp_Post_QR
 */
final class Wp_Post_QR {
	/**
	 * Wp_Post_QR constructor.
	 */
	private function __construct() {
		$this->wp_ptqr_define_constants();
		add_action( 'init', [ $this, 'wp_ptqr_init_plugin' ] );
	}

	/**
	 * Plugin version
	 */
	public const version = '1.0.0';

	/**
	 * Initialize singleton instance
	 *
	 * @return \Wp_Post_QR
	 */
	public static function wp_ptqr_init() {
		static $instance  = false;

		if(! $instance) {
			$instance = new self();
		}
		return $instance;
	}

	/**
	 * Define required plugins constants
	 *
	 * @return void
	 */
	public function wp_ptqr_define_constants() {
		define( 'WP_PTQR_VERSION', self::version );
		define( 'WP_PTQR_FILE', __FILE__ );
		define( 'WP_PTQR_PATH', __DIR__ );
		define( 'WP_PTQR_URL', plugins_url('', WP_PTQR_FILE ) );
		define( 'WP_PTQR_ASSETS', WP_PTQR_URL . '/assets' );
	}

	/**
	 * Initialize the plugin
	 *
	 * @return void
	 */

	public function wp_ptqr_init_plugin() {
		new Wp_Generate_Code();
        new Wp_Code_Settings();
		new Wp_Enqueue();
	}
}

/**
 * Initialize the main plugin
 *
 * @return \Wp_Post_QR
 */
function wp_ptqr_boot() {
	return Wp_Post_QR::wp_ptqr_init();
}

/**
 * Kick of plugin
 */
wp_ptqr_boot();
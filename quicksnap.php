<?php
/**
 * Quicksnap
 *
 * Plugin Name: Quicksnap - Fast & Flexible search functionality
 * Plugin URI:  https://github.com/mdrejon/quicksnap
 * Description: Quicksnap is a plugin that allows you to search for posts and pages in the WordPress admin area.
 * Version:     1.0.5
 * Author:      Sydur Rahman
 * Author URI:  https://github.com/mdrejon/
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain: quicksnap
 * Domain Path: /languages
 * Requires at least: 4.9
 * Requires PHP: 7.2
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// new WTDQS_Quicksnap();
use WTDQS_Quicksnap\Includes\Includes;
use WTDQS_Quicksnap\Admin\Admin;
use WTDQS_Quicksnap\App\App;

/**
 *  Main Class.
 */
class WTDQS_Quicksnap_INIT {

	/**
	 *  Constructor.
	 */
	public function __construct() {
		// Load Composer Autoload.
		if ( file_exists( plugin_dir_path( __FILE__ ) . 'vendor/autoload.php' ) ) {
			require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
		}

		// Constants.
		$this->wtdqs_quicksnap_constant();

		// Plugin Loaded.
		add_action( 'plugins_loaded', array( $this, 'wtdqs_quicksnap_loaded' ) );
	}

	/**
	 *  Constant.
	 */
	public function wtdqs_quicksnap_constant() {
		define( 'WTDQS_QUICKSNAP_VERSION', '1.0' );
		define( 'WTDQS_QUICKSNAP_PATH', plugin_dir_path( __FILE__ ) );
		define( 'WTDQS_QUICKSNAP_URL', plugin_dir_url( __FILE__ ) );
	}

	/**
	 *  Plugin Loaded.
	 */
	public function wtdqs_quicksnap_loaded() {

		// Load Text Domain.
		add_action( 'init', array( $this, 'wtdqs_quicksnap_textdomain' ) );

		// Include Files.
		$this->wtdqs_quicksnap_includes();
	}

	/**
	 *  Load Text Domain.
	 */
	public function wtdqs_quicksnap_textdomain() {
		load_plugin_textdomain( 'quicksnap', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Include Files.
	 */
	public function wtdqs_quicksnap_includes() {

		// Includes.
		Includes::init(); 

		// admin.
		if ( is_admin() ) {

			// Admin.
			Admin::init();
		}

		// App.
		App::init();
	}
}

// Instantiate.
new WTDQS_Quicksnap_INIT();

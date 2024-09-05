<?php
namespace WTDQS_Quicksnap\Admin;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
// Use.
use WTDQS_Quicksnap\Admin\MetaBox;

/**
 * Admin Class.
 */
class Admin {


	static $instance = null;

	/**
	 *  Constructor.
	 */
	public function __construct() {

		// Meta Box.
		MetaBox::init();

		// Enqueue Admin Scripts.
		add_action( 'admin_enqueue_scripts', array( $this, 'wtdqs_quicksnap_admin_scripts' ) );

		// Initialize the plugin tracker
		$this->wtdqs_appsero_init_tracker_quicksnap();
	}

	/**
	 *  Initialize.
	 */
	public static function init() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 *  Enqueue Admin Scripts.
	 */
	public function wtdqs_quicksnap_admin_scripts() {
		wp_enqueue_style( 'wtdqs-quicksnap-admin-stypes', WTDQS_QUICKSNAP_URL . 'assets/admin/css/quicksnap-admin.css', array(), WTDQS_QUICKSNAP_VERSION, 'all' );
		wp_enqueue_script( 'wtdqs-quicksnap-admin-script', WTDQS_QUICKSNAP_URL . 'assets/admin/js/quicksnap-admin.js', array( 'jquery' ), WTDQS_QUICKSNAP_VERSION, true );
	}

	/**
	 * Initialize the plugin tracker
	 *
	 * @return void
	 */
	public function wtdqs_appsero_init_tracker_quicksnap() {

		 

		$client = new \Appsero\Client( '2fa946af-208d-482d-8a71-2fdbe089e860', 'Quicksnap', __FILE__ );

		// Change Admin notice text
		$notice = sprintf( $client->__trans( 'Want to help make <strong>%1$s</strong> even more awesome? Allow %1$s to collect non-sensitive diagnostic data and usage information. I agree to get Important Plugin Updates related information on my email from  %1$s (I can unsubscribe anytime).' ), $client->name );
		$client->insights()->notice( $notice );
		// Active insights
		$client->insights()->init();

	}
}

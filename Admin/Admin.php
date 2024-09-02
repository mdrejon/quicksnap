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
}

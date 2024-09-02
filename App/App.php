<?php
namespace WTDQS_Quicksnap\App;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Use
use WTDQS_Quicksnap\App\Shortcode;

/**
 * App Class.
 */
class App {


	static $instance = null;

	/**
	 *  Constructor.
	 */
	public function __construct() {

		// Enqueue public Scripts.
		add_action( 'wp_enqueue_scripts', array( $this, 'wtdqs_quicksnap_public_scripts' ) );

		// Shortcode.
		Shortcode::init();
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
	 *  Enqueue public Scripts.
	 */
	public function wtdqs_quicksnap_public_scripts() {

		wp_register_style( 'wtdqs-app-stypes', WTDQS_QUICKSNAP_URL . 'assets/app/css/quicksnap-app.css', array(), WTDQS_QUICKSNAP_VERSION, 'all' );
		wp_register_script( 'wtdqs-app-script', WTDQS_QUICKSNAP_URL . 'assets/app/js/quicksnap-app.js', array( 'jquery' ), WTDQS_QUICKSNAP_VERSION, true );

		wp_localize_script(
			'wtdqs-app-script',
			'wtdqs_ajax',
			array(
				'wtdqs_ajax_url' => admin_url( 'admin-ajax.php' ),
				'wtdqs_nonce'    => wp_create_nonce( 'wtdqs_quicksnap_nonce' ),
			)
		);
	}
}

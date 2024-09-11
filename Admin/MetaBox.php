<?php
namespace WTDQS_quicksnap\Admin;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Meta Box Class.
 */
class MetaBox {

	static $instance = null;

	/**
	 *  Constructor.
	 */

	public function __construct() {

		add_action( 'add_meta_boxes', array( $this, 'wtdqs_quicksnap_add_meta_box' ) );
		add_action( 'save_post', array( $this, 'wtdqs_quicksnap_save_meta_box' ) );
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

	// Meta Box Callback.
	public function wtdqs_quicksnap_add_meta_box() {

		add_meta_box(
			'wtdqs_quicksnap_meta_shortcode_box',
			__( 'Quicksnap', 'quicksnap' ),
			array( $this, 'wtdqs_quicksnap_meta_shortcode_box_callback' ),
			'wtdqs-quicksnap',
			'side',
			'high'
		);

		add_meta_box(
			'wtdqs_quicksnap_meta_option_box',
			__( 'Quicksnap', 'quicksnap' ),
			array( $this, 'wtdqs_quicksnap_meta_option_box_callback' ),
			'wtdqs-quicksnap',
			'normal',
			'high'
		);
	}

	/**
	 *  Meta Box Callback.
	 */
	public function wtdqs_quicksnap_meta_shortcode_box_callback() {
		$post_id = get_the_ID();
		echo '<div class="wtdqs-quicksnap-shortcode-wrap">'; 
		if ( '' != $post_id ) {
			echo '<input type="text" class="wtdqs-quicksnap-shortcode" name="wtdqs-quicksnap-shortcode" value="[wtdqs_quicksnap id=' . esc_attr( $post_id ) . ']" readonly>';
		} else {
			echo '<input type="text" class="wtdqs-quicksnap-shortcode" name="wtdqs-quicksnap-shortcode" value="" readonly>';
		} 
		echo '<a href="#" class="wtdqs-quicksnap-shortcode-btn button">Copy</a>';
		echo '</div>';
	}

	/**
	 *  Meta Box Callback.
	 */
	public function wtdqs_quicksnap_meta_option_box_callback() {
		$_wtdqs_quicksnap_otp = get_post_meta( get_the_ID(), '_wtdqs_quicksnap_otp', true );

		// Load Template. using load_template function
		load_template(
			WTDQS_QUICKSNAP_PATH . 'Admin/Template/Metabox/template-metabox.php',
			false,
			array(
				'_wtdqs_quicksnap_otp' => $_wtdqs_quicksnap_otp,
			)
		);
	}
	

	/**
	 *  Save Meta Box.
	 */
	public function wtdqs_quicksnap_save_meta_box( $post_id ) { 

		if( isset($_POST['wtdqs_quicksnap_nonce']) && !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wtdqs_quicksnap_nonce'] ) ), 'wtdqs_quicksnap' ) ){
			return $post_id;
		} 
		if( !isset($_POST['wtdqs_quicksnap_nonce']) ){
			return $post_id;
		} 


		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		// Get the post type object.
		$_wtdqs_quicksnap_otp = get_post_meta( $post_id, '_wtdqs_quicksnap_otp', true );

		$quicksnap_data = ! empty( $_wtdqs_quicksnap_otp ) && is_array( $_wtdqs_quicksnap_otp ) ? $_wtdqs_quicksnap_otp : array();

		$quicksnap_data['post_type']             = isset( $_POST['_wtdqs_quicksnap_otp']['post_type'] ) ? sanitize_text_field( wp_unslash($_POST['_wtdqs_quicksnap_otp']['post_type']) ) : '';
		$quicksnap_data['maximum_items_display'] = isset( $_POST['_wtdqs_quicksnap_otp']['maximum_items_display'] ) ? sanitize_text_field(  wp_unslash($_POST['_wtdqs_quicksnap_otp']['maximum_items_display']) ) : '';
		$quicksnap_data['is_thumbnail']          = isset( $_POST['_wtdqs_quicksnap_otp']['is_thumbnail'] ) ? 1 : 0;
		$quicksnap_data['thumbnail_position']    = isset( $_POST['_wtdqs_quicksnap_otp']['thumbnail_position'] ) ? sanitize_text_field( wp_unslash($_POST['_wtdqs_quicksnap_otp']['thumbnail_position']) ) : '';
		$quicksnap_data['is_excerpt']            = isset( $_POST['_wtdqs_quicksnap_otp']['is_excerpt'] ) ? 1 : 0;
		$quicksnap_data['custom_css']            = isset( $_POST['_wtdqs_quicksnap_otp']['custom_css'] ) ? wp_kses_post( wp_unslash($_POST['_wtdqs_quicksnap_otp']['custom_css']) ) : '';

		update_post_meta( $post_id, '_wtdqs_quicksnap_otp', $quicksnap_data );
	}
}

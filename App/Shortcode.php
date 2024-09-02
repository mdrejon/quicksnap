<?php
namespace WTDQS_Quicksnap\App;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Shortcode Class.
 */
class Shortcode {


	static $instance = null;

	public $post_id = 0;

	/**
	 *  Constructor.
	 */
	public function __construct() {

		// Register Shortcode.
		add_shortcode( 'wtdqs_quicksnap', array( $this, 'wtdqs_quicksnap_shortcode_callback' ) );

		// Ajax Action.
		add_action( 'wp_ajax_wtdqs_quicksnap_shortcode_ajax', array( $this, 'wtdqs_quicksnap_shortcode_ajax_callback' ) );
		add_action( 'wp_ajax_nopriv_wtdqs_quicksnap_shortcode_ajax', array( $this, 'wtdqs_quicksnap_shortcode_ajax_callback' ) );
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
	 *  Enqueue Scripts.
	 */
	public function wtdqs_quicksnap_shortcode_scripts() {

		// Enqueue Styles.
		if ( ! wp_style_is( 'wtdqs-app-stypes', 'enqueued' ) ) {
			wp_enqueue_style( 'wtdqs-app-stypes' );
		}
		// Enqueue Scripts.
		if ( ! wp_script_is( 'wtdqs-app-script', 'enqueued' ) ) {
			wp_enqueue_script( 'wtdqs-app-script' );
		}
	}

	/**
	 *  Set Post ID.
	 */
	public function set_post_id( $post_id ) {
		$this->post_id = $post_id;
	}

	/**
	 *  Get Meta Data.
	 */
	public function get_meta_data() {
		return get_post_meta( $this->post_id, '_wtdqs_quicksnap_otp', true );
	}

	/**
	 *  Get Query Results.
	 */
	public function get_query_results( $search_value ) {

		if ( empty( $search_value ) ) {
			return false;
		}

		// Get Meta Data.
		$meta = $this->get_meta_data();

		if ( empty( $meta ) ) {
			return false;
		}

		// Query Args. based on post title
		$args = array(
			's'              => $search_value,
			'post_type'      => $meta['post_type'],
			'posts_per_page' => $meta['maximum_items_display'],
		);

		// Query.
		$query = new \WP_Query( $args );

		$result = '';
		// Result.
		if ( $query->have_posts() ) {
				$result .= '<ul>';
			while ( $query->have_posts() ) {
				$query->the_post();
				$title     = get_the_title();
				$permalink = get_the_permalink();
				$excerpt   = get_the_excerpt();
				$excerpt   = wp_trim_words( get_the_excerpt(), 10, '...' );
				$excerpt   = $meta['is_excerpt'] ? apply_filters( 'the_excerpt', $excerpt ) : '';

				$thumbnail = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' );
				$thumbnail = ! empty( $thumbnail ) ? $thumbnail : WTDQS_QUICKSNAP_URL . 'assets/app/img/placeholder-150.png';
				$thumbnail = apply_filters( 'wtdqs_quicksnap_thumbnail', $thumbnail, get_the_ID() );
				$thumbnail = $meta['is_thumbnail'] ? '<div class="thumbnail"> <img src="' . esc_url( $thumbnail ) . '" alt="">  </div>' : '';

				// class.

				$result .= '<li>
                            <a href="' . esc_url( $permalink ) . '">
                                ' . $thumbnail . '
                                <div class="content">
                                    <h3>' . esc_html( $title ) . '</h3>
                                    ' . $excerpt . '
                                </div>
                            </a>
                        </li>';
			}
				$result .= '</ul>';
		}

		return $result;
	}

	/**
	 *  Ajax Callback.
	 */
	public function wtdqs_quicksnap_shortcode_ajax_callback() {

		// Check Nonce. quicksnap_nonce 
		if( !isset($_POST['quicksnapNonce']) && !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['quicksnapNonce'] ) ), 'wtdqs_quicksnap_nonce' ) ){
			wp_send_json_error( 'Nonce Verification Failed' );
			wp_die();
		}
		
		$post_id      = isset( $_POST['postId'] ) ? intval( $_POST['postId'] ) : 0;
		$search_value = isset( $_POST['searchValue'] ) ? sanitize_text_field( wp_unslash($_POST['searchValue']) ) : '';

		if ( $post_id == 0 ) {
			wp_send_json_error( 'Post ID is required' );
			wp_die();
		}

		if ( empty( $search_value ) ) {
			wp_send_json_error( 'Search Value is required' );
			wp_die();
		}

		$this->set_post_id( $post_id );

		$result = $this->get_query_results( $search_value );

		// Response.
		wp_send_json( $result );

		// Exit.
		wp_die();
	}


	/**
	 *  Shortcode Callback.
	 */
	public function wtdqs_quicksnap_shortcode_callback( $atts ) {

		// atts.
		$atts = shortcode_atts(
			array(
				'id' => '',
			),
			$atts
		);

		// Set Post ID.
		$this->set_post_id( $atts['id'] );

		// Get Meta Data.
		$meta = $this->get_meta_data();

		// class name.
		$class = $meta['thumbnail_position'] == true ? 'wtdqs-thumbnail-' . $meta['thumbnail_position'] : '';

		// Enqueue app Scripts.
		$this->wtdqs_quicksnap_shortcode_scripts();

		ob_start();
		?>
		<div id="wtdqs-quicksnap-<?php echo esc_attr( $this->post_id ); ?>" data-id="<?php echo esc_attr( $this->post_id ); ?>"  class="wtdqs-quicksnap <?php echo esc_attr( $class ); ?>" >
			<div class="search_box">
			
				<input class="wtdqs-search-field" type="text" id="wtdqs-search-field-<?php echo esc_attr( $this->post_id ); ?>" name="wtdqs-search-field" placeholder="Search">
				<!-- <input type="submit" value="Search">  -->
			</div>
			<div class="wtdqs-search-result">
				 
			</div>
		</div>
		<?php
		$data = ob_get_clean();

		// Return.
		return $data;
	}
}

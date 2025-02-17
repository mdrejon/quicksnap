<?php 
namespace WTDQS_Quicksnap\Admin\Options;
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
use WTDQS_Quicksnap\Admin\Options\Fields\Fields;
class Metabox {
 
    public $metabox_name = '';
    public $post_type = '';
    public $fields = array();
    public $section = array();

    /**
     *  Constructor.
     */
    public function __construct($post_type, $fields = array()) { 
        $this->post_type = $post_type;
        $this->fields = $fields;
        $this->metabox_name = $fields['metabox_name'];
        $this->section = $fields['section'];

		define( 'WTDQS_METABOX_URL',  WTDQS_QUICKSNAP_URL . 'Admin/Options/' );

        
        add_action( 'add_meta_boxes', array( $this, 'wtdqs_quicksnap_add_meta_box' ) );
        add_action( 'save_post', array( $this, 'wtdqs_quicksnap_save_meta_box' ) );

		// Enqueue Scripts admin
		add_action( 'admin_enqueue_scripts', array( $this, 'wtdqs_option_enqueue_scripts' ) );
 
 
    }


	// Enqueue Admin Scripts.
	public function wtdqs_option_enqueue_scripts() {

		// Enqueue Admin Styles
		wp_enqueue_style( 'wtdqs-admin-option-css', WTDQS_METABOX_URL . 'assets/css/options.min.css', array(), WTDQS_QUICKSNAP_VERSION );
		wp_register_style( 'wtdqs-admin-option-css', WTDQS_METABOX_URL . 'assets/package/codemirror/codemirror.min.css', array(), WTDQS_QUICKSNAP_VERSION );

		// register code mirror 
		wp_register_script( 'wtdqs-codemirror-js', WTDQS_METABOX_URL . 'assets/package/codemirror/codemirror.min.js', array( 'jquery' ), WTDQS_QUICKSNAP_VERSION, true );
		// Enqueue Admin Scripts
		wp_enqueue_script( 'wtdqs-admin-option-js', WTDQS_METABOX_URL . 'assets/js/options.js', array( 'jquery' ), WTDQS_QUICKSNAP_VERSION, true );
		wp_enqueue_code_editor(['type' => 'text/css']); // Load CodeMirror
        wp_enqueue_script('wp-theme-plugin-editor'); // Load WP's editor script
		wp_localize_script(
			'wtdqs-admin-metabox',
			'wtdqs_admin_metabox',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'nonce'    => wp_create_nonce( 'wtdqs_admin_metabox_nonce' ),
			)
		);
		 
	}


    // Set Metabox Fields
    public static function set_metabox( $post_type, $fields ) {  
        return new self( $post_type, $fields );
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
	public function wtdqs_quicksnap_meta_option_box_callback($post) {
		$_wtdqs_quicksnap_otp = get_post_meta( $post->ID, $this->metabox_name, true );

		if ( empty( $_wtdqs_quicksnap_otp ) ) {
			$_wtdqs_quicksnap_otp = array();
		}
		if ( empty( $this->metabox_name ) ) {
			return;
		}

		if(!empty(  $this->section)):

		?>
			<div class="wtdqs-metabox-option wtdqs-flexbox"> 
						
				<div class="wtdqs-metabox-sidebar">
					<ul class="wtdqs-metabox-tabs-menu">
						<?php foreach($this->section as $key => $section): 
							$default = isset($section['default']) ? $section['default'] : '';	
						?>
							<li>
								<a href="#" class="wtdqs-metabox-tabs-btn <?php echo esc_attr($default) ?> wtdqs-flexbox wtdqs-gap-8" data-active="<?php echo esc_attr($key) ?>"> 
									<img clas="wtdqs-menu-icon" src="<?php echo esc_html($section['icon']);  ?>" alt="">
									
									<?php echo esc_html( $section['title'] ); ?>
								</a>
							</li>
							<!-- General Settings  -->
						<?php endforeach ?> 
					</ul>
				</div>

				<div class="wtdqs-metabox-content">
						<div class="wtdqs-metabox-content-wrap">
						<?php foreach($this->section as $key => $section): 
							$default = isset($section['default']) ? $section['default'] : '';	
						?>
 
						<!-- General Settings -->
						<div class="wtdqs-tabs-item <?php echo esc_attr($default) ?> " id="<?php echo esc_attr($key) ?>"> 
							<?php if (!empty($section['fields'])): ?>
							<div class="wtdqs-section-title">
								<h1><?php echo isset($section['title']) ? esc_html($section['title']) : ''; ?></h2>
								<p><?php echo isset($section['desc']) ? esc_html($section['desc']) : ''; ?></p>
							</div>
							<div class="wtdqs-fields-wrap">
								
								<?php 
									
									foreach ($section['fields'] as $field_key => $field):
										//   
										$default = isset($field['default']) ? $field['default'] : '';
										$value = isset($_wtdqs_quicksnap_otp[$field_key]) ? $_wtdqs_quicksnap_otp[$field_key] : $default;
								
										// Create the field instance
										$metabox_field = Fields::set_fields($this->metabox_name, $field, $value); 
								
										// Render the field
										if (method_exists($metabox_field, 'render')) {
											$metabox_field->render();
										}
									endforeach; 
								?>
							
								
							</div>
							<?php 	endif; ?>
						</div>
						<!-- General Settings -->
							

						<?php endforeach ?> 
							
						</div>
					</div>
			</div>
		<?php
		endif;

		// // Load Template. using load_template function
		// load_template(
		// 	WTDQS_QUICKSNAP_PATH . 'Admin/Template/Metabox/template-metabox.php',
		// 	false,
		// 	array(
		// 		'_wtdqs_quicksnap_otp' => $_wtdqs_quicksnap_otp,
		// 	)
		// );
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
		$quicksnap_data['search_bar_width'] = isset( $_POST['_wtdqs_quicksnap_otp']['search_bar_width'] ) ? sanitize_text_field(  wp_unslash($_POST['_wtdqs_quicksnap_otp']['search_bar_width']) ) : '';
		$quicksnap_data['custom_css']            = isset( $_POST['_wtdqs_quicksnap_otp']['custom_css'] ) ? wp_kses_post( wp_unslash($_POST['_wtdqs_quicksnap_otp']['custom_css']) ) : '';

		update_post_meta( $post_id, '_wtdqs_quicksnap_otp', $quicksnap_data );
	}

  

 
}


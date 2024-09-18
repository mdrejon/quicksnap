<?php

namespace WTDQS_Quicksnap\Includes;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Post Type Class.
 */

class Post_Type {

	static $instance = null;

	/**
	 *  Constructor.
	 */
	public function __construct() {

		// Register Post Type.
		add_action( 'init', array( $this, 'wtdqs_Quicksnap_post_type' ) );

		// Add Custom Columns.
		add_filter( 'manage_wtdqs-quicksnap_posts_columns', array( $this, 'wtdqs_quicksnap_columns' ) );

		// add shortcode column data.
		add_action( 'manage_wtdqs-quicksnap_posts_custom_column', array( $this, 'wtdqs_quicksnap_columns_data' ), 10, 2 );

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
	 * Post Type
	 */
	public function wtdqs_Quicksnap_post_type() {
		$labels = array(
			'name'               => _x( 'Quicksnap', 'post type general name', 'quicksnap' ),
			'singular_name'      => _x( 'Quicksnap', 'post type singular name', 'quicksnap' ),
			'menu_name'          => _x( 'Quicksnap', 'admin menu', 'quicksnap' ),
			'name_admin_bar'     => _x( 'Quicksnap', 'add new on admin bar', 'quicksnap' ),
			'add_new'            => _x( 'Add New', 'quicksnap', 'quicksnap' ),
			'add_new_item'       => __( 'Add New Search', 'quicksnap' ),
			'new_item'           => __( 'Create New Search', 'quicksnap' ),
			'edit_item'          => __( 'Edit Search', 'quicksnap' ),
			'view_item'          => __( 'View Search', 'quicksnap' ),
			'all_items'          => __( 'All Search', 'quicksnap' ),
			'search_items'       => __( 'Search Search', 'quicksnap' ),
			'parent_item_colon'  => __( 'Parent Search:', 'quicksnap' ),
			'not_found'          => __( 'No Search found.', 'quicksnap' ),
			'not_found_in_trash' => __( 'No Search found in Trash.', 'quicksnap' ),
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'quicksnap' ),
			'public'             => false,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			// 'rewrite'            => array( 'slug' => 'quicksnap' ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title' ),
		);

		register_post_type( 'wtdqs-quicksnap', $args );
	}

	/**
	 * Add Custom Columns.
	 */
	public function wtdqs_quicksnap_columns( $columns ) {
		$columns = array(
			'cb'        => '<input type="checkbox" />',
			'title'     => __( 'Title', 'quicksnap' ),
			'shortcode' => __( 'ShortCode', 'quicksnap' ),
			'date'      => __( 'Date', 'quicksnap' ),
		);

		return $columns;
	}

	/**
	 * Add Custom Columns Data.
	 */
	public function wtdqs_quicksnap_columns_data( $column, $post_id ) {
		switch ( $column ) {
			case 'shortcode':
				echo '<div class="wtdqs-quicksnap-shortcode-wrap">';
				echo '<input type="text" class="wtdqs-quicksnap-shortcode" name="wtdqs_quicksnap_shortcode" value="[wtdqs_quicksnap id=' . esc_attr( $post_id ) . ']" readonly>';
				// add copy to clipboard. btn
				echo '<a href="#" class="wtdqs-quicksnap-shortcode-btn button">Copy</a>';
				echo '</div>';
				break;
		}
	}

	
}

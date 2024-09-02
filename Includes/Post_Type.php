<?php

namespace WTD_Quicksnap\Includes;

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
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'quicksnap' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title' ),
		);

		register_post_type( 'wtdqs-quicksnap', $args );
	}
}

<?php

namespace WTD_Quicksnap\Includes;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Use PostType.
use WTD_Quicksnap\Includes\Post_Type;

/** 
* Includes.
*/

class Includes {

	public static $instance = null; // Instance.

	/**
	* Constructor.
	*/
	public function __construct() {

		// Post Type.
		Post_Type::init();
	}
	/**
	* Initialize.
	*/
	public static function init() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}

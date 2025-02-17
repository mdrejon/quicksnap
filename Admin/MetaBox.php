<?php
namespace WTDQS_quicksnap\Admin;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
use WTDQS_Quicksnap\Admin\Options\Metabox;


/**
 * Meta Box Class.
 */
MetaBox::set_metabox('wtdqs-quicksnap', array(
	'title' => __( 'Ultimate Addons for CF7 Options', 'quicksnap' ),
	'metabox_name' => '_wtdqs_quicksnap_otp',
	'section' => array(
		// General Settings
		'general' => array(
			'title' => __( 'General Settings', 'quicksnap' ),
			'desc' => __( 'Manage your time zone settings and bookings', 'quicksnap' ),
			'default' => 'active',
			'icon' => WTDQS_QUICKSNAP_URL . '/assets/admin/icon/sliders-horizontal.svg',
			'fields' => array(
				 
				'post_type' => array(
					'name' => 'post_type',
					'type' => 'Select',
					'width' => '50%',
					'label' => __( 'Select post type', 'quicksnap' ), 
					'desc' => __( 'Select post type', 'quicksnap' ), 
					'options' => 'post_types',
				),   
				
				'maximum_items_display' => array(
					'name' => 'maximum_items_display',
					'type' => 'Text',
					'width' => '50%',
					'input_type' => 'number',
					'label' => __( 'Maximum Items Search Result', 'quicksnap' ),  
					'desc' =>  __( 'Type Maximum Items To Dysplay', 'quicksnap' ), 
				),
				'thumbnail_position' => array(
					'name' => 'thumbnail_position',
					'type' => 'Select',
					'width' => '50%',
					'label' => __( 'Thumbnail Position', 'quicksnap' ), 
					'desc' => __( 'Select Thumbnail Position', 'quicksnap' ),  
					'options' => array(
						'left' => __( 'Left', 'quicksnap' ), 
						'right' => __( 'Right', 'quicksnap' ), 
						'top' => __( 'Top', 'quicksnap' ),
						'bottom' => __( 'Bottom', 'quicksnap' ),
					),
				),   
				'is_thumbnails' => array(
					'name' => 'is_thumbnails',
					'type' => 'Checkbox',
					'width' => '25%',
					'label' => __( 'Show Thumbnail', 'quicksnap' ), 
				),  
				'is_excerpt' => array(
					'name' => 'is_excerpt',
					'type' => 'Checkbox',
					'width' => '25',
					'label' => __( 'Show Excerpt', 'quicksnap' ), 
				),  
				 
				'custom_css1' => array(
					'type' => 'CodeField',
					'name' => 'custom_css1',
					'label' => __( 'Custom CSS', 'quicksnap' ),
					// 'description' => __( 'Add custom CSS for the form.', 'quicksnap' ),
				),
				// 'search_content' => array(
				// 	'type' => 'Swicher',
				// 	'label' => __( 'Search Content', 'quicksnap' ),
				// 	'sub_label' =>  __( 'Select search type', 'quicksnap' ),
				// 	'description' =>  __( 'Select search type', 'quicksnap' ),
				// 	'options' => array(
				// 		'post_title' => __( 'Serach Post Title', 'quicksnap' ), 
				// 		'post_content' => __( 'Serach Post Content', 'quicksnap' ), 
				// 	),
				// 	'dependency' => array(
				// 		'condition' => 'search_type',
				// 		'value' => 'post_type',
				// 	),
				// ),
			)
		),

		// Custom CSS
		'custom_css' => array(
			'title' => __( 'Custom CSS', 'quicksnap' ),
			'icon' => WTDQS_QUICKSNAP_URL . '/assets/admin/icon/code.svg',
			'fields' => array(
				'custom_css' => array(
					'type' => 'CodeField',
					'name' => 'custom_css2',
					'label' => __( 'Custom CSS', 'quicksnap' ),
					// 'description' => __( 'Add custom CSS for the form.', 'quicksnap' ),
				),
			)
		),
	)
));
 

 
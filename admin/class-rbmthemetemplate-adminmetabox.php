<?php
/**
 * Adds extra meta boxes.
 *
 * @since {{VERSION}}
 *
 * @package ImpactRestoration
 * @subpackage ImpactRestoration/admin
 */

// Don't load directly
defined( 'ABSPATH' ) || die();

abstract class ImpactRestoration_AdminExtraMeta {

	/**
	 * Meta boxes to add.
	 *
	 * @since {{VERSION}}
	 *
	 * @var array
	 */
	public $meta_boxes = array();

	/**
	 * ImpactRestoration_AdminExtraMeta constructor.
	 *
	 * @since {{VERSION}}
	 */
	function __construct() {

		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
	}

	/**
	 * Add menu items.
	 *
	 * @since {{VERSION}}
	 * @access private
	 */
	function add_meta_boxes() {

		foreach ( $this->meta_boxes as $meta_box ) {

			// Turn into proper callback
			$meta_box[2] = array( $this, $meta_box[2] );

			add_meta_box( $meta_box );
		}
	}
}

<?php
/**
 * Adds extra meta boxes.
 *
 * @since 1.0.0
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
	 * @since 1.0.0
	 *
	 * @var array
	 */
	public $meta_boxes = array();

	/**
	 * ImpactRestoration_AdminExtraMeta constructor.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
	}

	/**
	 * Add menu items.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	function add_meta_boxes() {

		foreach ( $this->meta_boxes as $meta_box ) {

			$args = wp_parse_args( $meta_box['args'], array(
				'id'            => false,
				'title'         => false,
				'callback'      => false,
				'screen'        => null,
				'context'       => 'advanced',
				'priority'      => 'default',
				'callback_args' => null,
			) );

			$add_metabox = false;
			if ( isset( $meta_box['condition_callback'] ) && is_callable( array( $this, $meta_box['condition_callback'] ) ) ){

				if ( call_user_func( array( $this, $meta_box['condition_callback'] ) ) ) {
					$add_metabox = true;
				}

			} else {
				$add_metabox = true;
			}

			if ( $add_metabox ) {
				add_meta_box(
					$args['id'],
					$args['title'],
					$args['callback'],
					$args['screen'],
					$args['context'],
					$args['priority'],
					$args['callback_args']
				);
			}
		}
	}
}

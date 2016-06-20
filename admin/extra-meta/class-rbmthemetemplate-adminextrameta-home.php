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

class ImpactRestoration_AdminExtraMeta_Home {

	/**
	 * Meta boxes to add.
	 *
	 * @since {{VERSION}}
	 *
	 * @var array
	 */
	public $meta_boxes = array(
		array(
			'impactrestoration-mb-home',
			'Extra Meta',
			'mb_home',
			'page'
		),
	);

	/**
	 * Outputs the home metabox.
	 *
	 * @since {{VERSION}}
	 * @access private
	 */
	function mb_home() {

		rbm_do_field_text( 'test_setting', 'Test Setting' );
	}
}

<?php
/**
 * The theme's admin class for providing admin-related functionality.
 *
 * @since {{VERSION}}
 *
 * @package ImpactRestoration
 * @subpackage ImpactRestoration/admin
 */

// Don't load directly
defined( 'ABSPATH' ) || die();

class ImpactRestoration_Admin {

	/**
	 * Admin pages.
	 *
	 * @since {{VERSION}}
	 *
	 * @var array
	 */
	public $pages = array();

	/**
	 * Admin meta boxes.
	 *
	 * @since {{VERSION}}
	 *
	 * @var array
	 */
	public $metaboxes = array();

	/**
	 * ImpactRestoration_Admin constructor.
	 *
	 * @since {{VERSION}}
	 */
	function __construct() {

		$this->require();
	}

	/**
	 * Require deps.
	 *
	 * @since {{VERSION}}
	 */
	private function require() {

		require_once __DIR__ . '/class-impactrestoration-adminpage.php';
		require_once __DIR__ . '/class-impactrestoration-adminmetabox.php';
		require_once __DIR__ . '/pages/class-impactrestoration-adminpage-settings.php';
		require_once __DIR__ . '/extra-meta/class-impactrestoration-adminextrameta-home.php';

		$this->pages['settings'] = new ImpactRestoration_AdminPage_Settings();
		$this->metaboxes['home'] = new ImpactRestoration_AdminExtraMeta_Home();
	}
}

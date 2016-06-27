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
	 * Admin Customizer options.
	 *
	 * @since {{VERSION}}
	 *
	 * @var array
	 */
	public $customizer = array();

	/**
	 * ImpactRestoration_Admin constructor.
	 *
	 * @since {{VERSION}}
	 */
	function __construct() {

		$this->require_files();
	}

	/**
	 * Require deps.
	 *
	 * @since {{VERSION}}
	 */
	private function require_files () {

		require_once __DIR__ . '/class-impactrestoration-adminpage.php';
		require_once __DIR__ . '/class-impactrestoration-adminmetabox.php';
		require_once __DIR__ . '/class-impactrestoration-admincustomizer.php';
		require_once __DIR__ . '/pages/class-impactrestoration-adminpage-settings.php';
		require_once __DIR__ . '/extra-meta/class-impactrestoration-adminextrameta-home.php';
		require_once __DIR__ . '/customizer/class-impactrestoration-admincustomizer-footer.php';

//		$this->pages['settings']    = new ImpactRestoration_AdminPage_Settings();
		$this->metaboxes['home']    = new ImpactRestoration_AdminExtraMeta_Home();
		$this->customizer['footer'] = new ImpactRestoration_AdminCustomizer_Footer();
	}
}

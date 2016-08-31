<?php
/**
 * The theme's admin class for providing admin-related functionality.
 *
 * @since 1.0.0
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
	 * @since 1.0.0
	 *
	 * @var array
	 */
	public $pages = array();

	/**
	 * Admin meta boxes.
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	public $metaboxes = array();

	/**
	 * Admin Customizer options.
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	public $customizer = array();

	/**
	 * ImpactRestoration_Admin constructor.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		$this->require_files();
	}

	/**
	 * Require deps.
	 *
	 * @since 1.0.0
	 */
	private function require_files () {

		require_once __DIR__ . '/class-impactrestoration-adminpage.php';
		require_once __DIR__ . '/class-impactrestoration-adminmetabox.php';
		require_once __DIR__ . '/class-impactrestoration-admincustomizer.php';
		require_once __DIR__ . '/pages/class-impactrestoration-adminpage-settings.php';
		require_once __DIR__ . '/extra-meta/class-impactrestoration-adminextrameta-home.php';
		require_once __DIR__ . '/customizer/class-impactrestoration-admincustomizer-footer.php';
		require_once __DIR__ . '/customizer/class-impactrestoration-admincustomizer-site-identity.php';

//		$this->pages['settings']    = new ImpactRestoration_AdminPage_Settings();
		$this->metaboxes['home']    = new ImpactRestoration_AdminExtraMeta_Home();
		$this->customizer['footer'] = new ImpactRestoration_AdminCustomizer_Footer();
		$this->customizer['footer'] = new ImpactRestoration_AdminCustomizer_SiteIdentity();
	}
}

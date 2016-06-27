<?php
/**
 * Theme settings page
 *
 * @since {{VERSION}}
 *
 * @package ImpactRestoration
 * @subpackage ImpactRestoration/admin/pages
 */

// Don't load directly
defined( 'ABSPATH' ) || die();

class ImpactRestoration_AdminPage_Settings extends ImpactRestoration_AdminPage {

	public $ID = 'impactrestoration-settings';

	public $admin_page = array(
		'page_title' => 'Impact Restoration Settings',
		'menu_title' => 'Impact Restoration Settings',
		'capability' => 'edit_theme_options',
	);

	public $settings = array(
		'impactrestoration_setting',
	);

	/**
	 * Load admin settings page.
	 *
	 * @since {{VERSION}}
	 * @access private
	 */
	function admin_page() {

		$tabs = array(
			'setting_section' => 'Setting Section',
		);

		$current_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : array_shift( $tabs );

		impactrestoration_load_template( 'admin/views/html-rbm-themetemplate-settings.php' );
	}
}

<?php
/**
 * Theme settings page
 *
 * @since {{VERSION}}
 *
 * @package ImpactRestoration
 * @subpackage ImpactRestoration/admin
 */

// Don't load directly
defined( 'ABSPATH' ) || die();

abstract class ImpactRestoration_AdminPage {

	/**
	 * Admin page ID.
	 *
	 * @since {{VERSION}}
	 *
	 * @var string
	 */
	public $ID;

	/**
	 * Admin page init settings.
	 *
	 * @since {{VERSION}}
	 *
	 * @var array
	 */
	public $admin_page = array();

	/**
	 * Admin page settings.
	 *
	 * @since {{VERSION}}
	 *
	 * @var array
	 */
	public $settings = array();

	/**
	 * ImpactRestoration_Admin constructor.
	 *
	 * @since {{VERSION}}
	 */
	function __construct() {

		$this->admin_page[] = $this->ID;

		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	/**
	 * Add menu items.
	 *
	 * @since {{VERSION}}
	 * @access private
	 */
	function admin_menu() {

		$page_args = wp_parse_args( $this->admin_page, array(
			'page_title' => '',
			'menu_title' => '',
			'capability' => '',
			'menu_slug'  => '',
			'function'   => array( $this, 'admin_page' ),
		) );

		$page = add_theme_page(
			$page_args['page_title'],
			$page_args['menu_title'],
			$page_args['capability'],
			$page_args['menu_slug'],
			$page_args['function']
		);

		if ( $page ) {

			add_action( "load-$page", array( $this, 'admin_load' ) );
			add_action( "load-$page", array( $this, 'admin_save' ), 49 );
		}
	}

	/**
	 * Pre-requisites for the page.
	 *
	 * @since {{VERSION}}
	 * @access private
	 */
	function admin_load() {
	}

	/**
	 * Load admin settings page.
	 *
	 * @since {{VERSION}}
	 * @access private
	 */
	function admin_page() {
	}

	/**
	 * Saves theme settings.
	 *
	 * @since {{VERSION}}
	 * @access private
	 */
	function admin_save() {

		if ( isset( $_POST[ $this->ID ] ) ) {

			check_admin_referer( $this->ID, "_wpnonce-$this->ID" );

			foreach ( $this->settings as $setting ) {

				if ( isset( $_POST[ $setting ] ) && ! empty( $_POST[ $setting ] ) ) {
					set_theme_mod( $setting, $_POST[ $setting ] );
				} else {
					set_theme_mod( $setting, '' );
				}
			}

			wp_safe_redirect( $_POST['_wp_http_referer'] );

			exit();
		}
	}
}

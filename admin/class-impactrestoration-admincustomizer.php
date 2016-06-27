<?php
/**
 * Creates Customizer options.
 *
 * @since {{VERSION}}
 *
 * @package ImpactRestoration
 * @subpackage ImpactRestoration/admin
 */

// Don't load directly
defined( 'ABSPATH' ) || die();

abstract class ImpactRestoration_AdminCustomizer {

	/**
	 * Customizer panels.
	 *
	 * @since {{VERSION}}
	 *
	 * @var array
	 */
	public $panels = array();

	/**
	 * Customizer sections.
	 *
	 * @since {{VERSION}}
	 *
	 * @var array
	 */
	public $sections = array();

	/**
	 * Customizer controls.
	 *
	 * @since {{VERSION}}
	 *
	 * @var array
	 */
	public $controls = array();

	/**
	 * Customizer settings.
	 *
	 * @since {{VERSION}}
	 *
	 * @var array
	 */
	public $settings = array();

	/**
	 * ImpactRestoration_AdminCustomizer constructor.
	 *
	 * @since {{VERSION}}
	 */
	function __construct() {

		add_action( 'customize_register', array( $this, 'customizer_add' ) );
	}

	/**
	 * Adds all Customizer settings.
	 *
	 * @since {{VERSION}}
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	function customizer_add( $wp_customize ) {

		if ( $this->settings ) {
			$this->add_settings( $this->settings, $wp_customize );
		}

		if ( $this->controls ) {
			$this->add_controls( $this->controls, $wp_customize );
		}

		if ( $this->sections ) {
			$this->add_sections( $this->sections, $wp_customize );
		}

		if ( $this->panels ) {
			$this->add_panels( $this->panels, $wp_customize );
		}
	}

	/**
	 * Adds Customizer panels.
	 *
	 * @since {{VERSION}}
	 *
	 * @param array $panels
	 * @param WP_Customize_Manager $wp_customize
	 */
	public static function add_panels( $panels, $wp_customize ) {

		foreach ( $panels as $panel ) {

			$panel = wp_parse_args( $panel, array(
				'ID'          => '',
				'title'       => '',
				'description' => '',
				'priority'    => 100,
			) );

			$wp_customize->add_panel( $panel['ID'], array(
				'title'       => $panel['title'],
				'description' => $panel['description'],
				'priority'    => $panel['priority'],
			) );
		}
	}

	/**
	 * Adds Customizer sections.
	 *
	 * @since {{VERSION}}
	 *
	 * @param array $sections
	 * @param WP_Customize_Manager $wp_customize
	 */
	public static function add_sections( $sections, $wp_customize ) {

		foreach ( $sections as $section ) {

			$section = wp_parse_args( $section, array(
				'ID'             => '',
				'title'          => '',
				'description'    => '',
				'panel'          => '',
				'priority'       => 10,
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
			) );

			$wp_customize->add_section( $section['ID'], array(
				'title'          => $section['title'],
				'description'    => $section['description'],
				'panel'          => $section['panel'],
				'priority'       => $section['priority'],
				'capability'     => $section['capability'],
				'theme_supports' => $section['theme_supports'],
			) );
		}
	}

	/**
	 * Adds Customizer controls.
	 *
	 * @since {{VERSION}}
	 *
	 * @param array $controls
	 * @param WP_Customize_Manager $wp_customize
	 */
	public static function add_controls( $controls, $wp_customize ) {

		foreach ( $controls as $control ) {

			$control = wp_parse_args( $control, array(
				'ID'              => '',
				'type'            => '',
				'priority'        => 10,
				'section'         => '',
				'label'           => '',
				'description'     => '',
				'input_attrs'     => '',
				'active_callback' => '',
				'class'           => false,
			) );

			if ( $control['class'] ) {

				$wp_customize->add_control( new $control['class']( $wp_customize, $control['ID'], array(
					'priority'        => $control['priority'],
					'section'         => $control['section'],
					'label'           => $control['label'],
					'description'     => $control['description'],
					'input_attrs'     => $control['input_attrs'],
					'active_callback' => $control['active_callback'],
				) ) );

			} else {

				$wp_customize->add_control( $control['ID'], array(
					'type'            => $control['type'],
					'priority'        => $control['priority'],
					'section'         => $control['section'],
					'label'           => $control['label'],
					'description'     => $control['description'],
					'input_attrs'     => $control['input_attrs'],
					'active_callback' => $control['active_callback'],
				) );
			}
		}
	}

	/**
	 * Adds Customizer settings.
	 *
	 * @since {{VERSION}}
	 *
	 * @param array $settings
	 * @param WP_Customize_Manager $wp_customize
	 */
	public static function add_settings( $settings, $wp_customize ) {

		foreach ( $settings as $setting ) {

			$setting = wp_parse_args( $setting, array(
				'ID'                   => '',
				'type'                 => 'theme_mod',
				'capability'           => 'edit_theme_options',
				'default'              => '',
				'transport'            => '',
				'sanitize_callback'    => '',
				'sanitize_js_callback' => '',
				'theme_supports'       => '',
			) );

			$wp_customize->add_setting( $setting['ID'], array(
				'type'                 => $setting['type'],
				'capability'           => $setting['capability'],
				'theme_supports'       => $setting['theme_supports'],
				'default'              => $setting['default'],
				'transport'            => $setting['transport'],
				'sanitize_callback'    => $setting['sanitize_callback'],
				'sanitize_js_callback' => $setting['sanitize_js_callback'],
			) );
		}
	}
}

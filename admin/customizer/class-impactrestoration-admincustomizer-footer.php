<?php
/**
 * Adds footer Customizer options
 *
 * @since {{VERSION}}
 *
 * @package ImpactRestoration
 * @subpackage ImpactRestoration/admin
 */

// Don't load directly
defined( 'ABSPATH' ) || die();

class ImpactRestoration_AdminCustomizer_Footer extends ImpactRestoration_AdminCustomizer {

	public $sections = array(
		array(
			'ID'    => 'footer',
			'title' => 'Footer',
		),
	);

	public $controls = array(
		array(
			'ID'      => 'footer_logo',
			'class'   => 'WP_Customize_Image_Control',
			'section' => 'footer',
			'label'   => 'Logo',
		),
		array(
			'ID'      => 'footer_address',
			'type'    => 'textarea',
			'section' => 'footer',
			'label'   => 'Address',
		),
	);

	public $settings = array(
		array(
			'ID' => 'footer_logo',
		),
		array(
			'ID' => 'footer_address',
		),
	);
}

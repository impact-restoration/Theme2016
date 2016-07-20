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

class ImpactRestoration_AdminCustomizer_SiteIdentity extends ImpactRestoration_AdminCustomizer {

	public $controls = array(
		array(
			'ID'      => 'toolbar_icon',
			'class'   => 'WP_Customize_Image_Control',
			'section' => 'title_tagline',
			'label'   => 'Toolbar Icon',
		),
	);

	public $settings = array(
		array(
			'ID' => 'toolbar_icon',
		),
	);
}

<?php
/**
 * The theme's functions file that loads on EVERY page, used for uniform functionality.
 *
 * @since {{VERSION}}
 *
 * @package ImpactRestoration
 */

// Don't load directly
defined( 'ABSPATH' ) || die();

// Make sure PHP version is correct
if ( ! version_compare( PHP_VERSION, '5.3.0', '>=' ) ) {
	wp_die( 'ERROR in Impact Restoration theme: PHP version 5.3 or greater is required.' );
}

// Make sure no theme constants are already defined (realistically, there should be no conflicts)
if ( defined( 'THEME_VERSION' ) || defined( 'THEME_FONTS' ) ) {
	wp_die( 'ERROR in Impact Restoration theme: There is a conflicting constant. Please either find the conflict or rename the constant.' );
}

define( 'THEME_VERSION', '{{VERSION}}' );
define( 'THEME_FONTS', array(
	'font-awesome' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css',
) );
define( 'THEME_IMAGE_SIZES', array(
	'medium-crop'  => array(
		'title'  => 'Medium Crop',
		'width'  => 500,
		'height' => 300,
		'crop'   => array( 'center', 'center' ),
	),
) );

// Include required functionality
require_once __DIR__ . '/admin/class-impactrestoration-admin.php';

// Include shortcodes

// Include widgets

// Base actions
add_action( 'after_setup_theme', 'impactrestoration_setup_theme' );
add_filter( 'image_size_names_choose', 'impactrestoration_add_image_sizes' );
add_action( 'init', 'impactrestoration_register_scripts' );
add_action( 'wp_enqueue_scripts', 'impactrestoration_load_scripts' );
add_action( 'admin_enqueue_scripts', 'impactrestoration_load_admin_scripts' );
add_action( 'after_setup_theme', 'impactrestoration_load_nav_menus' );
add_action( 'widgets_init', 'impactrestoration_load_sidebars' );

/**
 * Setup theme properties and stuff.
 *
 * @since {{VERSION}}
 */
function impactrestoration_setup_theme() {

	// Image sizes
	if ( ! empty( THEME_IMAGE_SIZES ) ) {
		foreach ( THEME_IMAGE_SIZES as $ID => $size ) {
			add_image_size( $ID, $size['width'], $size['height'], $size['crop'] );
		}
	}

	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'favicon' );

	// Allow shortcodes in text widget
	add_filter( 'widget_text', 'do_shortcode' );
}

/**
 * Adds support for custom image sizes.
 *
 * @since {{VERSION}}
 *
 * @param $sizes array The existing image sizes.
 *
 * @return array The new image sizes.
 */
function impactrestoration_add_image_sizes( $sizes ) {

	if ( ! empty( THEME_IMAGE_SIZES ) ) {
		$sizes = array_merge( $sizes, wp_list_pluck( THEME_IMAGE_SIZES, 'ID', 'title' ) );
	}

	return $sizes;
}

/**
 * Register theme files.
 *
 * @since {{VERSION}}
 */
function impactrestoration_register_scripts() {

	global $impactrestoration_fonts;

	// Theme styles
	wp_register_style(
		'impactrestoration',
		get_template_directory_uri() . '/style.css',
		null,
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION
	);

//	wp_register_style(
//		'impactrestoration-admin',
//		get_template_directory_uri() . '/admin.css',
//		null,
//		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION
//	);

//	wp_register_style(
//		'impactrestoration-print',
//		get_template_directory_uri() . '/print.css',
//		null,
//		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION,
//		'print'
//	);

	// Theme script
//	wp_register_script(
//		'impactrestoration',
//		get_template_directory_uri() . '/script.js',
//		array( 'jquery' ),
//		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION,
//		true
//	);

//	wp_register_script(
//		'impactrestoration-admin',
//		get_template_directory_uri() . '/admin.js',
//		array( 'jquery' ),
//		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION,
//		true
//	);

	// Localized data
	wp_localize_script( 'impactrestoration', 'ImpactRestoration_Data', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	) );

	if ( ! empty( $impactrestoration_fonts ) ) {
		foreach ( $impactrestoration_fonts as $ID => $link ) {
			wp_register_style(
				'impactrestoration' . "-font-$ID",
				$link
			);
		}
	}
}

/**
 * Enqueue theme files.
 *
 * @since {{VERSION}}
 */
function impactrestoration_load_scripts() {

	// Theme styles
	wp_enqueue_style( 'impactrestoration' );

//	wp_enqueue_style( 'impactrestoration-print' );

	// Theme script
//	wp_enqueue_script( 'impactrestoration' );

	if ( ! empty( THEME_FONTS ) ) {
		foreach ( THEME_FONTS as $ID => $link ) {
			wp_enqueue_style( 'impactrestoration' . "-font-$ID" );
		}
	}
}

/**
 * Enqueue admin files.
 *
 * @since {{VERSION}}
 */
function impactrestoration_load_admin_scripts() {

//	wp_enqueue_style( 'impactrestoration-admin' );
//	wp_enqueue_script( 'impactrestoration-admin' );
}

/**
 * Register nav menus.
 *
 * @since {{VERSION}}
 */
function impactrestoration_load_nav_menus() {

	// Primary
	register_nav_menu( 'primary', 'Primary Navigation Menu' );
}

/**
 * Register sidebars.
 *
 * @since {{VERSION}}
 */
function impactrestoration_load_sidebars() {

	// Page
	register_sidebar( array(
		'name'         => 'Page',
		'id'           => 'page',
		'description'  => 'Displays on default pages.',
		'before_title' => '<h3 class="widget-title">',
		'after_title'  => '</h3>',
	) );
}

/**
 * Loads a template file.
 *
 * @since {{VERSION}}
 *
 * @param string $template Template local path.
 */
function impactrestoration_load_template( $template ) {

	$template = impactrestoration_get_template( $template );

	get_template_part( $template );
}

/**
 * Retreives a template file.
 *
 * @since {{VERSION}}
 *
 * @param string $template Template local path.
 *
 * @return string Template directory path.
 */
function impactrestoration_get_template( $template ) {

	/**
	 * Filter template to retrieve.
	 *
	 * @since {{VERSION}}
	 */
	$template = apply_filters( 'impactrestoration_get_template', $template );

	return $template;
}
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
define( 'THEME_FONTS', serialize( array(
	'font-awesome' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css',
	'open-sans'    => 'https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,800',
) ) );
define( 'THEME_IMAGE_SIZES', serialize( array(
	'medium-crop' => array(
		'title'  => 'Medium Crop',
		'width'  => 500,
		'height' => 300,
		'crop'   => array( 'center', 'center' ),
	),
) ) );

// Include required functionality
require_once __DIR__ . '/admin/class-impactrestoration-admin.php';
new ImpactRestoration_Admin();

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
add_filter( 'excerpt_length', 'impactrestoration_custom_excerpt_length', 999 );
add_filter( 'use_default_gallery_style', '__return_false' );
add_filter( 'shortcode_atts_gallery', 'impactrestoration_gallery_atts' );
add_filter( 'gallery_style', 'impactrestoration_gallery_html' );
add_action( 'admin_bar_menu', 'impactrestoration_modify_toolbar_logo', 15 );
add_action( 'wp_head', 'impactrestoration_toolbar_css' );
add_action( 'admin_head', 'impactrestoration_toolbar_css' );

/**
 * Setup theme properties and stuff.
 *
 * @since {{VERSION}}
 */
function impactrestoration_setup_theme() {

	// Image sizes
	if ( ! empty( unserialize( THEME_IMAGE_SIZES ) ) ) {
		foreach ( unserialize( THEME_IMAGE_SIZES ) as $ID => $size ) {
			add_image_size( $ID, $size['width'], $size['height'], $size['crop'] );
		}
	}

	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'favicon' );
	add_theme_support( 'custom-header' );
//	add_theme_support( 'custom-logo' );

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

	if ( ! empty( unserialize( THEME_IMAGE_SIZES ) ) ) {
		$sizes = array_merge( $sizes, wp_list_pluck( unserialize( THEME_IMAGE_SIZES ), 'ID', 'title' ) );
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
	wp_register_script(
		'impactrestoration',
		get_template_directory_uri() . '/script.js',
		array( 'jquery' ),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION,
		true
	);

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

	if ( ! empty( unserialize( THEME_FONTS ) ) ) {
		foreach ( unserialize( THEME_FONTS ) as $ID => $link ) {
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
	wp_enqueue_script( 'impactrestoration' );

	if ( ! empty( unserialize( THEME_FONTS ) ) ) {
		foreach ( unserialize( THEME_FONTS ) as $ID => $link ) {
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

	register_nav_menu( 'primary', 'Primary Navigation Menu' );
	register_nav_menu( 'footer', 'Footer Navigation Menu' );
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

/**
 * All available icons for Impact Restoration.
 *
 * @since {{VERSION}}
 *
 * @return array Icons with classname as key and name as value.
 */
function impactrestoration_icons() {

	return array(
		'ir-fire'  => 'Fire',
		'ir-water' => 'Water',
		'ir-hail'  => 'Hail',
		'ir-wind'  => 'Wind',
	);
}

/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 *
 * @return int (Maybe) modified excerpt length.
 */
function impactrestoration_custom_excerpt_length( $length ) {
	return 35;
}

/**
 * Modify the gallery to have "unlimitted" columns.
 *
 * @since {{VERSION}}
 * @access private
 *
 * @param $atts
 *
 * @return mixed
 */
function impactrestoration_gallery_atts( $atts ) {

	$atts['columns'] = 0;
	$atts['link']    = 'file';

	return $atts;
}

/**
 * Append gallery extra HTML.
 *
 * @since {{VERSION}}
 * @access private
 *
 * @param $output
 *
 * @return string
 */
function impactrestoration_gallery_html( $output ) {

	/**
	 * Gallery title.
	 *
	 * @since {{VERSION}}
	 */
	$title = apply_filters( 'impactrestoration_gallery_title', false );

	ob_start();
	?>

	<?php if ( $title ) : ?>
		<div class="gallery-title">
			<span><?php echo $title; ?></span>
		</div>
	<?php endif; ?>

	<div class="gallery-navigation"></div>

	<div class="gallery-preview">
		<button class="close" aria-label="Close">
			<span class="fa fa-times"></span>
		</button>

		<div class="gallery-preview-navigation">
			<button class="previous" aria-label="Previous">
				<span class="fa fa-chevron-left"></span>
			</button>

			<button class="next" aria-label="Next">
				<span class="fa fa-chevron-right"></span>
			</button>
		</div>
	</div>

	<?php
	$html = ob_get_clean();

	return $output . $html;
}

/**
 * Modifies the adminbar logo.
 *
 * @since {{VERSION}}
 * @access private
 *
 * @param WP_Admin_Bar $admin_bar
 */
function impactrestoration_modify_toolbar_logo( $admin_bar ) {

	$admin_bar->remove_menu( 'wp-logo' );
	$admin_bar->add_node( array(
		'id'    => 'impactrestoration-icon',
		'title' => '',
		'href'  => get_bloginfo( 'url' ),
		'meta'  => array(
			'class' => 'impactrestoration-adminbar-icon',
		),
	) );
}

/**
 * Outputs CSS in the <head> for the toolbar.
 *
 * @since {{VERSION}}
 * @access private
 */
function impactrestoration_toolbar_css() {

	if ( $toolbar_icon = get_theme_mod( 'toolbar_icon' ) ) : ?>
		<style>
			#wpadminbar ul li.impactrestoration-adminbar-icon a.ab-item {
				background: url("<?php echo $toolbar_icon; ?>") no-repeat;
				background-size: 24px;
				background-position: 7px 3px;
				width: 24px;
			}

			#wpadminbar ul li.impactrestoration-adminbar-icon:hover a.ab-item {
				background: url("<?php echo $toolbar_icon; ?>") #32373c no-repeat !important;
				background-size: 24px !important;
				background-position: 7px 3px !important;
			}
		</style>
	<?php endif;
}
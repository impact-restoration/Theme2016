<?php
/**
 * The theme's header file that appears on EVERY page.
 *
 * @since {{VERSION}}
 *
 * @package ImpactRestoration
 */

// Don't load directly
defined( 'ABSPATH' ) || die();
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header id="site-header">

	<?php if ( has_header_image() ) : ?>
		<div class="logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img src="<?php header_image(); ?>"
				     srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id ) ); ?>"
				     width="<?php echo esc_attr( get_custom_header()->width ); ?>"
				     height="<?php echo esc_attr( get_custom_header()->height ); ?>"
				     alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"/>
			</a>
		</div>
	<?php endif; ?>

	<?php if ( has_nav_menu( 'primary' ) ) : ?>
		<nav class="primary-nav">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'depth'          => 1,
			) );
			?>
		</nav>
	<?php endif; ?>

	<?php if ( $tagline = get_bloginfo( 'description' ) ) : ?>
		<div class="clearfix"></div>
		<div class="tagline">
			<?php echo $tagline; ?>
		</div>
	<?php endif; ?>

	<div class="divider"></div>

</header>

<section id="site-content">
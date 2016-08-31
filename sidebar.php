<?php
/**
 * Sidebar.
 *
 * @since 1.0.0
 *
 * @package ImpactRestoration
 */

// Don't load directly
defined( 'ABSPATH' ) || die();
?>
	<aside id="site-sidebar">
		<ul class="widgets">
			<?php
			/**
			 * Allows hooking before the sidebar widgets to add custom widgets.
			 *
			 * @since 1.0.0
			 */
			do_action( 'impactrestoration_sidebar_before_widgets' );

			dynamic_sidebar( 'page' );

			/**
			 * Allows hooking after the sidebar widgets to add custom widgets.
			 *
			 * @since 1.0.0
			 */
			do_action( 'impactrestoration_sidebar_after_widgets' );
			?>
		</ul>
	</aside>
<?php
/**
 * 404 error page.
 *
 * @since 1.0.0
 *
 * @package ImpactRestoration
 */

// Don't load directly
defined( 'ABSPATH' ) || die();

get_header();

$getintouch_form = rbm_get_field( 'getintouchform', get_option( 'page_on_front' ) );
?>
	<section class="callout-section black left row expanded">
		<div class="callout-content columns small-12 medium-6 large-5">
			<div class="container">
				<h2 class="callout-content-title">404 - Not Found</h2>

				<div class="callout-content-text">
					<p>
						It seems this page does not exist or is currently unavailable. Apologies for any inconvenience.
						Please try again later or contact us.
					</p>
				</div>
			</div>
		</div>

		<div class="callout-prompt columns small-12 medium-6 large-7">
			<div class="container">
				<?php if ( $getintouch_form && function_exists( 'gravity_form' ) ) : ?>
					<?php gravity_form( $getintouch_form, false, false ); ?>
				<?php else: ?>
					<a href="/contact/" class="button large">
						Get in touch with us.
					</a>
				<?php endif; ?>
			</div>
		</div>
	</section>

<?php
get_footer();
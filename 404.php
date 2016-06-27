<?php
/**
 * 404 error page.
 *
 * @since {{VERSION}}
 *
 * @package ImpactRestoration
 */

// Don't load directly
defined( 'ABSPATH' ) || die();

get_header();

$getintouch_form = rbm_get_field( 'getintouchform', get_option( 'page_on_front' ) );
?>
	<section class="callout-section flush-top black left row expand">
	<div class="callout-content columns small-12 medium-6 large-5">
		<div class="container">
			<h2 class="callout-content-title">404 - Not Found</h2>

			<div class="callout-content-text">
				<p>
					It seems this page does not exist or is currently unavailable. Apologies for any inconvenience.
					Please try again later or contact us with this form.
				</p>
			</div>
		</div>
	</div>

<?php if ( $getintouch_form && function_exists( 'gravity_form' ) ) : ?>
	<div class="callout-prompt columns small-12 medium-6 large-7">
		<div class="container">
			<?php gravity_form( $getintouch_form, false, false ); ?>
		</div>
	</div>
	</section>
<?php endif; ?>

<?php
get_footer();
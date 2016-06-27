<?php
/**
 * Post pagination.
 *
 * @since {{VERSION}}
 *
 * @package ImpactRestoration
 */

// Don't load directly
defined( 'ABSPATH' ) || die();
?>

	<section class="pagination-section callout-section short black left row expand">
		<div class="callout-content columns small-12 medium-6 large-5">
			<div class="container">
				<h2 class="callout-content-title no-underline">Posts navigation</h2>
			</div>
		</div>

		<div class="callout-prompt columns small-12 medium-6 large-7">
			<div class="container">
				<?php the_posts_pagination(); ?>
			</div>
		</div>
	</section>

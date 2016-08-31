<?php
/**
 * The theme's page file use for displaying pages.
 *
 * @since 1.0.0
 *
 * @package ImpactRestoration
 */

// Don't load directly
defined( 'ABSPATH' ) || die();

get_header();

the_post();
?>

	<section <?php post_class( array( 'row' ) ); ?>>
		<div class="columns small-12">
			<h1 class="post-title">
				<?php the_title(); ?>
			</h1>

			<div class="post-content">
				<?php the_content(); ?>
			</div>
		</div>
	</section>

<?php
get_footer();
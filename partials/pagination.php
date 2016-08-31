<?php
/**
 * Post pagination.
 *
 * @since 1.0.0
 *
 * @package ImpactRestoration
 */

// Don't load directly
defined( 'ABSPATH' ) || die();

$post_nav_args = apply_filters( 'ir_post_navigation_args', array(
	'mid_size'           => 1,
	'prev_text'          => _x( 'Previous', 'previous post' ),
	'next_text'          => _x( 'Next', 'next post' ),
	'screen_reader_text' => __( 'Posts Navigation' ),
) );
?>

	<section class="pagination-section callout-section short black left row expanded">
		<div class="callout-content columns small-12 medium-6 large-5">
			<div class="container">
				<h2 class="callout-content-title no-underline"><?php echo $post_nav_args['screen_reader_text']; ?></h2>
			</div>
		</div>

		<div class="callout-prompt columns small-12 medium-6 large-7">
			<div class="container">
				<?php the_posts_pagination( $post_nav_args ); ?>
			</div>
		</div>
	</section>

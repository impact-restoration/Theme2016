<?php
/**
 * Testimonials archive page.
 *
 * @since {{VERSION}}
 *
 * @package ImpactRestoration
 */

// Don't load directly
defined( 'ABSPATH' ) || die();

add_filter( 'ir_post_navigation_args', 'ir_testimonial_navigation_args' );

function ir_testimonial_navigation_args( $args ) {
	return array(
		'mid_size'           => 1,
		'prev_text'          => _x( 'Previous', 'previous post' ),
		'next_text'          => _x( 'Next', 'next post' ),
		'screen_reader_text' => __( 'Navigation' ),
	);
}

get_header();
?>

	<div class="row small">
		<div class="column">
			<h1 class="page-title">
				Testimonials
			</h1>
		</div>
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<div id="testimonial-<?php the_ID(); ?>" <?php post_class( array( 'column' ) ); ?>>
					<h1 class="testimonial-title">
						<?php the_title(); ?>
					</h1>

					<div class="testimonial-content">
						<?php the_content(); ?>
					</div>
				</div>
			<?php endwhile; ?>

		<?php else : ?>
			<p>
				Nothing found.
			</p>
		<?php endif; ?>
	</div>

<?php impactrestoration_load_template( 'partials/pagination' ); ?>

<?php
get_footer();
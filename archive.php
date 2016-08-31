<?php
/**
 * Generic archive page.
 *
 * @since 1.0.0
 *
 * @package ImpactRestoration
 */

// Don't load directly
defined( 'ABSPATH' ) || die();

get_header();
?>

	<div class="row">
		<div class="columns small-12">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h1 class="post-title">
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</h1>

						<div class="post-content">
							<?php the_excerpt(); ?>
						</div>

						<a href="<?php the_permalink(); ?>" class="read-more-link dark button">
							Read More
						</a>
					</article>
				<?php endwhile; ?>

			<?php else : ?>
				<p>
					Nothing found.
				</p>
			<?php endif; ?>
		</div>
	</div>

<?php impactrestoration_load_template( 'partials/pagination' ); ?>

<?php
get_footer();
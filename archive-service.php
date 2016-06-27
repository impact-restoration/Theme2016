<?php
/**
 * Service CPT archive page.
 *
 * @since {{VERSION}}
 *
 * @package ImpactRestoration
 */

// Don't load directly
defined( 'ABSPATH' ) || die();

get_header();
?>

<?php if ( have_posts() ) : ?>
	<?php $i = 0; ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php
		$i ++;
		$color = rbm_get_field( 'service_color', false, array( 'sanitization' => 'esc_attr' ) );
		?>
		<section class="archive-service-item row expand <?php echo $i % 2 === 1 ? 'left' : 'right'; ?>"
		         style="color: <?php echo $color; ?>;">
			<div class="archive-service-item-color columns small-12 medium-4 large-6
			<?php echo $i % 2 === 1 ? 'medium-push-8 large-push-6' : ''; ?>"
			     style="background-color: <?php echo $color; ?>;"></div>

			<div class="archive-service-item-content columns small-12 medium-8 large-6
			<?php echo $i % 2 === 1 ? 'medium-pull-4 large-pull-6' : ''; ?>">
				<div class="container">
					<h1>
						<span class="service-title-text"><?php the_title(); ?></span>
					</h1>

					<div class="service-excerpt">
						<?php the_excerpt(); ?>
					</div>

					<a href="<?php the_permalink(); ?>" class="service-read-more button"
					   style="background-color: <?php echo $color; ?>">
						More
						<span class="fa fa-angle-double-right"></span>
					</a>
				</div>
			</div>
		</section>
	<?php endwhile; ?>
<?php else : ?>
<?php endif; ?>

<?php impactrestoration_load_template( 'partials/divider' ); ?>

<?php
get_footer();
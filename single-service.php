<?php
/**
 * Shows a single Service CPT.
 *
 * @since {{VERSION}}
 *
 * @package ImpactRestoration
 */

// Don't load directly
defined( 'ABSPATH' ) || die();

add_filter( 'impactrestoration_gallery_title', 'impactrestoration_services_gallery_title' );

function impactrestoration_services_gallery_title( $title ) {

	static $gallery = 0;
	$gallery ++;

	return "Job $gallery";
}

get_header();

the_post();

$color = rbm_get_field( 'service_color', false, array( 'sanitization' => 'esc_attr' ) );

if ( $services_list = rbm_get_field( 'services' ) ) {
	$services_list = explode( "\n", $services_list );
}

$service_jobs = rbm_get_field( 'jobs' );
?>
	<section class="service-header red up-left row expanded">
		<div class="service-header-color columns small-12 medium-4 medium-push-8 large-6 large-push-6"
		     style="background-color: <?php echo $color; ?>;"></div>

		<div class="service-header-content columns small-12 medium-8 medium-pull-4 large-6 large-pull-6">
			<div class="container">
				<div class="service" data-color="<?php echo $color; ?>" style="color: <?php echo $color; ?>;">
					<h1 class="service-title">
						<?php if ( $icon = rbm_get_field( 'service-icon' ) ) : ?>
							<span class="service-icon <?php echo esc_attr( $icon ); ?>"
							      style="background-color: <?php echo $color; ?>"></span>
						<?php endif; ?>

						<?php the_title(); ?>
					</h1>

					<hr/>

					<div class="service-content">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php if ( $services_list ) : ?>
	<section class="service-services-list row">
		<div class="columns small-12">
			<h2>
				<span class="button dark fa fa-wrench"></span>
				<?php the_title(); ?> Services
			</h2>

			<?php impactrestoration_load_template( 'partials/services-list' ); ?>
		</div>
	</section>
<?php endif; ?>

<?php impactrestoration_load_template( 'partials/divider' ); ?>

<?php if ( $service_jobs ) : ?>
	<section class="service-jobs-title callout-section left black row expanded">
		<div class="callout-content columns small-12 medium-4 large-3">
			<div class="container">
				<h2>Jobs</h2>
			</div>
		</div>

		<div class="callout-prompt columns small-12 medium-8 large-9">
			<div class="container">
				<span class="button dark"><span class="fa fa-info"></span></span>
				<span class="service-jobs-title-text">
					<?php echo wp_is_mobile() ? 'Swipe and tap to view photos.' : 'Mouse over and click photos to view'; ?>
				</span>
			</div>
		</div>
	</section>

	<section class="service-jobs">
		<?php echo do_shortcode( $service_jobs ); ?>
	</section>
<?php endif; ?>

<?php
get_footer();
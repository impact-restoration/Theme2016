<?php
/**
 * The theme's front-page file use for displaying the home page.
 *
 * @since 1.0.0
 *
 * @package ImpactRestoration
 */

// Don't load directly
defined( 'ABSPATH' ) || die();

$services = get_posts( array(
	'post_type'   => 'service',
	'numberposts' => 4,
) );

$about_header = rbm_get_field( 'about_header' );
$about_content = rbm_get_field( 'about_content' );

$phone = get_option( 'impactrestoration_phone', '​(317) 268-6375' );

if ( $services_list = rbm_get_field( 'services' ) ) {
	$services_list = explode( "\n", $services_list );
}

$phone_blurb        = rbm_get_field( 'phone_blurb' );
$get_in_touch_blurb = rbm_get_field( 'get_in_touch_blurb' );

$about_sections = rbm_get_field( 'home_sections' );

$getintouch_form = rbm_get_field( 'getintouchform' );

$testimonials = get_posts( array(
	'post_type'   => 'testimonial',
	'numberposts' => 4,
) );

get_header();
?>

<?php if ( $services ) : ?>
	<section class="home-services row expanded"
	         style="background-color: <?php echo rbm_get_field( 'service_color', $services[0]->ID, 'esc_attr' ); ?>">
		<div class="service-selector columns small-12 medium-8 medium-push-4">
			<div class="selector">
				<div class="selector-options">
					<?php foreach ( $services as $post ) : ?>
						<?php setup_postdata( $post ); ?>
						<a href="#service-<?php the_ID(); ?>"
						   class="<?php echo $post->ID === $services[0]->ID ? 'active' : ''; ?>">
							<?php the_post_thumbnail(); ?>
						</a>

						<?php echo $post->ID === $services[1]->ID ? '<div class="clearfix"></div>' : ''; ?>

						<?php wp_reset_postdata(); ?>
					<?php endforeach; ?>
				</div>
			</div>
		</div>

		<div class="clearfix hide-for-medium"></div>

		<div class="services columns small-12 medium-4 medium-pull-8">
			<?php foreach ( $services as $post ) : ?>
				<?php setup_postdata( $post ); ?>
				<?php $color = rbm_get_field( 'service_color', false, array( 'sanitization' => 'esc_attr' ) ); ?>
				<div id="service-<?php the_ID(); ?>"
				     class="service <?php echo $post->ID === $services[0]->ID ? 'active' : ''; ?>"
				     data-color="<?php echo $color; ?>" style="color: <?php echo $color; ?>;">
					<h1 class="service-title">
						<?php if ( $icon = rbm_get_field( 'service-icon' ) ) : ?>
							<span class="service-icon <?php echo esc_attr( $icon ); ?>"
							      style="background-color: <?php echo $color; ?>"></span>
						<?php endif; ?>

						<?php the_title(); ?>
					</h1>

					<hr/>

					<div class="service-excerpt">
						<?php the_excerpt(); ?>
					</div>

					<a href="<?php the_permalink(); ?>" class="service-read-more button"
					   style="background-color: <?php echo $color; ?>">
						More
						<span class="fa fa-angle-double-right"></span>
					</a>
				</div>
				<?php wp_reset_postdata(); ?>
			<?php endforeach; ?>
		</div>
	</section>

	<div class="clearfix"></div>
<?php endif; ?>

	<section class="home-about row expanded">
		<div class="columns small-12 medium-6">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo_alt.png" width="608" height="266"
			     alt="impact restoration" title="Impact Restoration" />
		</div>

		<div class="columns small-12 medium-6">
			<h2>
				<?php echo $about_header; ?>
			</h2>

			<p>
				<?php echo $about_content; ?>
			</p>
		</div>
	</section>

	<section class="home-phone callout-section primary right row expanded">
		<div class="callout-content columns small-12 medium-6 medium-push-6 large-5 large-push-7">
			<div class="container">
				<h2 class="callout-content-title">Give us a call today!</h2>

				<div class="callout-content-text">
					<span class="fa fa-quote-left"></span>
					<p>
						<?php echo esc_attr( $phone_blurb ); ?>
					</p>
				</div>
			</div>
		</div>

		<div class="callout-prompt columns small-12 medium-6 medium-pull-6 large-7 large-pull-5">
			<div class="container">
				<a href="tel:<?php echo $phone; ?>">
					<span class="button"><span class="fa fa-mobile"></span></span>
					<span class="phone-number-text">
						<?php echo $phone; ?>
					</span>
				</a>
			</div>
		</div>
	</section>

<?php impactrestoration_load_template( 'partials/divider' ); ?>

<?php if ( $services_list ) : ?>
	<section class="home-services-list row">
		<div class="columns small-12">
			<h2>
				<span class="button dark fa fa-wrench"></span>
				All Services
			</h2>

			<?php
			$services_list_center = true;
			impactrestoration_load_template( 'partials/services-list' );
			?>
		</div>
	</section>
<?php endif; ?>


<?php if ( $about_sections ) : ?>
	<?php foreach ( $about_sections as $i => $about_section ) : ?>
		<?php $image = wp_get_attachment_image_src( $about_section['image'], 'full' ); ?>
		<section
			class="home-about-section row expanded <?php echo $i % 2 === 0 ? 'left primary' : 'right secondary'; ?>">
			<div class="home-about-section-image columns small-12 medium-6 large-7
			<?php echo $i % 2 === 0 ? 'medium-push-6 large-push-5' : ''; ?>"
			     style="background-image: url('<?php echo $image ? $image[0] : ''; ?>');">
			</div>

			<div class="home-about-section-content columns small-12 medium-6 large-5
			<?php echo $i % 2 === 0 ? 'medium-pull-6 large-pull-7' : ''; ?>">
				<div class="container">
					<h2><?php echo esc_attr( $about_section['title'] ); ?></h2>

					<div class="content">
						<?php echo do_shortcode( wpautop( $about_section['content'] ) ); ?>
					</div>
				</div>
			</div>
		</section>
	<?php endforeach; ?>
<?php endif; ?>

<?php impactrestoration_load_template( 'partials/divider' ); ?>

<?php if ( $getintouch_form && function_exists( 'gravity_form' ) ) : ?>
	<section class="home-getintouch callout-section secondary left row expanded">
		<div class="callout-content columns small-12 medium-6 large-5">
			<div class="container">
				<h2 class="callout-content-title">Get in touch with us</h2>

				<div class="callout-content-text">
					<span class="fa fa-quote-left"></span>
					<p>
						<?php echo esc_attr( $get_in_touch_blurb ); ?>
					</p>
				</div>
			</div>
		</div>

		<div class="callout-prompt columns small-12 medium-6 large-7">
			<div class="container">
				<?php gravity_form( $getintouch_form, false, false ); ?>
			</div>
		</div>
	</section>

	<div class="clearfix"></div>
<?php endif; ?>

<?php if ( $testimonials ) : ?>
	<section class="home-testimonials row expanded small-up-1 medium-up-2 large-up-4">
		<?php foreach ( $testimonials as $post ) : ?>
			<?php setup_postdata( $post ); ?>
			<div class="testimonial column">
				<h2 class="testimonial-title">
					<?php the_title(); ?>
				</h2>

				<div class="testimonial-content">
					<p>
						<span class="testimonial-quote-icon fa fa-quote-left"></span>
						<?php echo get_the_excerpt(); ?>
					</p>
				</div>
			</div>
		<?php endforeach; ?>
		<?php wp_reset_postdata(); ?>

		<div class="columns">
			<a href="<?php echo get_post_type_archive_link( 'testimonial' ); ?>" class="button dark">
				See More
				<span class="fa fa-angle-double-right"></span>
			</a>
		</div>
	</section>

	<div class="clearfix"></div>
<?php endif; ?>

<?php
get_footer();
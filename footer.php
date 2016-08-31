<?php
/**
 * The theme's footer file that appears on EVERY page.
 *
 * @since 1.0.0
 *
 * @package ImpactRestoration
 */

// Don't load directly
defined( 'ABSPATH' ) || die();

$phone = get_option( 'impactrestoration_phone', '​(317) 268-6375' );

$services = get_posts( array(
	'post_type'   => 'service',
	'numberposts' => 4,
) );
?>

</section><!-- #site-content -->

<footer id="site-footer">
	<div class="row">
		<div class="columns small-12 medium-6">
			<?php if ( $logo = get_theme_mod( 'footer_logo' ) ) : ?>
				<p class="logo">
					<a href="<?php bloginfo( 'url' ); ?>">
						<img src="<?php echo $logo; ?>"/>
					</a>
				</p>
			<?php endif; ?>

			<p class="phone">
				<a href="tel:<?php echo $phone; ?>">
					<?php echo $phone; ?>
				</a>
			</p>

			<?php if ( $address = get_theme_mod( 'footer_address' ) ) : ?>
				<div class="address">
					<?php echo do_shortcode( wpautop( $address ) ); ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="columns small-12 medium-6">
			<?php if ( $services ) : ?>
				<h3>Services</h3>

				<ul class="footer-services">
					<?php foreach ( $services as $service ) : ?>
						<li>
							<a href="<?php echo get_permalink( $service ); ?>" class="button medium">
								<?php echo get_the_title( $service ); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<?php if ( has_nav_menu( 'footer' ) ) : ?>
				<h3>Site</h3>

				<?php
				wp_nav_menu( array(
					'theme_location' => 'footer',
					'container'      => false,
				) );
				?>
			<?php endif; ?>
		</div>

		<div class="columns small-12">

			<p class="copyright">
				<small>
					&copy; <?php echo date( 'Y' ); ?> Impact Insurance Restoraction, Inc.
				</small>
			</p>

			<p class="credit">
				<small>
					Site by <a href="http://realbigmarketing.com">Real Big Marketing</a>
				</small>
			</p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
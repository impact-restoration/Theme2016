<?php
/**
 * Services list.
 *
 * @since {{VERSION}}
 *
 * @package ImpactRestoration
 */

// Don't load directly
defined( 'ABSPATH' ) || die();

/**
 * @var array $services_list
 * @var bool|null $services_list_center
 */
global $services_list, $services_list_center;
?>

<div class="services-list <?php echo isset( $services_list_center) && $services_list_center ? 'center' : ''; ?>">
	<span class="services-list-line"></span>

	<?php foreach ( $services_list as $i => $service ) : ?>
		<?php echo $i % 2 === 0 ? '<div class="services-row">' : ''; ?>

		<div class="services-row-item">
			<span class="services-tick fa fa-check-circle-o"></span>
			<?php echo esc_attr( $service ); ?>
		</div>

		<?php echo $i % 2 === 1 ? '</div>' : ''; ?>
	<?php endforeach; ?>
</div>

<?php
/**
 * Search index page.
 *
 * @since 1.0.0
 *
 * @package ImpactRestoration
 */

// Don't load directly
defined( 'ABSPATH' ) || die();

get_header();
?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : ?>
	<?php endwhile; ?>;
<?php else : ?>
<?php endif; ?>

<?php
get_footer();
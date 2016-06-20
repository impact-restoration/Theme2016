<?php
/**
 * Generic archive page.
 *
 * @since {{VERSION}}
 *
 * @package ImpactRestoration
 *
 * @global WP_Query $wp_query
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
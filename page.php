<?php
/**
 * The theme's page file use for displaying pages.
 *
 * @since {{VERSION}}
 *
 * @package ImpactRestoration
 */

// Don't load directly
defined( 'ABSPATH' ) || die();

get_header();

the_post();
?>

<?php
get_footer();
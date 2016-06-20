<?php
/**
 * The theme's single file use for displaying posts.
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
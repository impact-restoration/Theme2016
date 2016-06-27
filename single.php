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
	<header class="post-header callout-section black left row expand">
		<div class="callout-content columns small-12 medium-6 large-5">
			<div class="container">
				<h2 class="callout-content-title no-underline"><?php the_title(); ?></h2>
			</div>
		</div>

		<div class="callout-prompt columns small-12 medium-6 large-7">
		</div>
	</header>

	<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'row' ) ); ?>>
		<div class="post-content columns small-12">
			<?php the_content(); ?>
		</div>
	</article>

<?php
get_footer();
<?php
/**
 * The theme's search form.
 *
 * @since 1.0.0
 *
 * @package ImpactRestoration
 */

// Don't load directly
defined( 'ABSPATH' ) || die();
?>

<form role="search" method="get" class="search-form" action="<?php bloginfo( 'url' ); ?>">

	<label class="search-field-label">
		<span class="screen-reader-text">Search for:</span>
		<input type="search" class="search-field" value="<?php echo get_search_query(); ?>" name="s" title="search the site"/>
	</label>

	<button>
		<span class="fa fa-search"></span>
	</button>
</form>
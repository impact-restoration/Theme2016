<?php
/**
 * Theme settings page.
 *
 * @since 1.0.0
 *
 * @var array $tabs Page tabs.
 * @var string $current_tab The current tab of the page.
 *
 * @package ImpactRestoration
 */

// Don't load directly
defined( 'ABSPATH' ) || die();
?>

<div class="wrap">

	<h2>Impact Restoration Settings</h2>

	<h2 class="nav-tab-wrapper">
		<?php foreach ( $tabs as $tab_ID => $tab_title ) : ?>
			<a class="nav-tab <?php echo $tab_ID == $current_tab ? 'nav-tab-active' : ''; ?>"
			   href="?page=<?php echo $_GET['page']; ?>&tab=<?php echo $tab_ID; ?>">
				<?php echo $tab_title; ?>
			</a>
		<?php endforeach; ?>
	</h2>

	<!--suppress HtmlUnknownTarget -->
	<form method="post">
		<?php
		wp_nonce_field('impactrestoration-adminpage-settings', '_wpnonce-impactrestoration-adminpage-settings');

		switch ( $current_tab ) {
			case 'setting_section':
				?>
				<h3><?php echo $tabs[ $current_tab ]; ?></h3>

				<table class="form-table">
					<tr valign="top">
						<th scope="row">
							<label for="impactrestoration_setting">
								Setting
							</label>
						</th>
						<td>
							<input type="text" class=regular-text name="impactrestoration_setting"
							       id="impactrestoration_setting"
							       value="<?php echo esc_attr( get_theme_mod( 'impactrestoration_setting' ) ); ?>"/>
						</td>
					</tr>
				</table>
				<?php
				break;
		}
		?>

		<?php submit_button( 'Save Settings', 'button', 'impactrestoration-adminpage-settings' ); ?>
	</form>

</div>
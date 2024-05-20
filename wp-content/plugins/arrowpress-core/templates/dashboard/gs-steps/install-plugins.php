<?php
$plugins_required = Arrowpress_Plugins_Manager::get_required_plugins_inactive();
?>

<div class="top">
	<h2><?php esc_html_e( 'Install Required Plugins', 'arrowpress-core' ); ?></h2>

	<div class="caption">
		<p><?php esc_html_e( 'Below is the list of all the required and recommended plugins for the theme to run perfectly. Please choose all and click the button install and activate below.', 'arrowpress-core' ); ?></p>
	</div>

	<form class="arrowpress-table-plugins">
		<table class="wp-list-table widefat plugins arrowpress-plugins">
			<thead>
			<tr>
				<td id="cb" class="manage-column column-cb check-column">
					<input id="cb-select-all" type="checkbox" checked>
				</td>
				<th scope="col" id="name"
					class="manage-column column-name column-primary"><?php esc_html_e( 'Plugin', 'arrowpress-core' ); ?></th>
				<th scope="col" id="description"
					class="manage-column column-description"><?php esc_html_e( 'Require', 'arrowpress-core' ); ?></th>
				<th scope="col" id="status"
					class="manage-column column-status"><?php esc_html_e( 'Status', 'arrowpress-core' ); ?></th>
			</tr>
			</thead>

			<tbody>
			<?php
			foreach ( $plugins_required as $plugin ) :
				$slug_plugin = $plugin->get_slug();
				if ( $plugin->is_required() ) {
					$checked = ' checked="checked"';
				} else {
					$checked = '';
				}
				?>
				<tr class="inactive" data-plugin="<?php echo esc_attr( $slug_plugin ); ?>">
					<th scope="row" class="check-column">
						<input class="arrowpress-input" type="checkbox" name="<?php echo esc_attr( $slug_plugin ); ?>"
							   value="<?php echo esc_attr( $slug_plugin ); ?>"
							   data-status="<?php echo esc_attr( $plugin->get_status() ); ?>"<?php echo $checked; ?>>
					</th>
					<td class="plugin-title column-primary"><?php echo esc_html( $plugin->get_name() ); ?></td>
					<td class="column-description desc">
						<span
							class="info"><?php echo esc_html( $plugin->is_required() ? __( 'Required', 'arrowpress-core' ) : __( 'Recommend', 'arrowpress-core' ) ); ?></span>
					</td>
					<td class="column-status">
						<div class="import-php">
							<div class="updating-message"><?php echo esc_html( $plugin->get_text_status() ); ?></div>
						</div>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</form>
</div>

<div class="bottom">
	<a class="tc-skip-step"><?php esc_html_e( 'Skip', 'arrowpress-core' ); ?></a>
	<button class="button button-primary tc-button tc-run-step"
			data-request="yes"><?php esc_html_e( 'Install and activate', 'arrowpress-core' ); ?></button>
</div>

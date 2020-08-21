<?php
/**
 * Copyright (C) 2014-2020 ServMask Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * ███████╗███████╗██████╗ ██╗   ██╗███╗   ███╗ █████╗ ███████╗██╗  ██╗
 * ██╔════╝██╔════╝██╔══██╗██║   ██║████╗ ████║██╔══██╗██╔════╝██║ ██╔╝
 * ███████╗█████╗  ██████╔╝██║   ██║██╔████╔██║███████║███████╗█████╔╝
 * ╚════██║██╔══╝  ██╔══██╗╚██╗ ██╔╝██║╚██╔╝██║██╔══██║╚════██║██╔═██╗
 * ███████║███████╗██║  ██║ ╚████╔╝ ██║ ╚═╝ ██║██║  ██║███████║██║  ██╗
 * ╚══════╝╚══════╝╚═╝  ╚═╝  ╚═══╝  ╚═╝     ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Kangaroos cannot jump here' );
}
?>

<div class="ai1wm-container">
	<div class="ai1wm-row">
		<div class="ai1wm-left">
			<div class="ai1wm-holder">
				<h1><i class="ai1wm-icon-gear"></i> <?php _e( 'Google Drive Settings', AI1WMGE_PLUGIN_NAME ); ?></h1>
				<br />
				<br />

				<div class="ai1wm-field">
					<?php if ( $token ) : ?>
						<p id="ai1wmge-gdrive-details">
							<span class="spinner" style="visibility: visible;"></span>
							<?php _e( 'Retrieving Google Drive account details..', AI1WMGE_PLUGIN_NAME ); ?>
						</p>

						<div id="ai1wmge-gdrive-progress">
							<div id="ai1wmge-gdrive-progress-bar"></div>
						</div>

						<p id="ai1wmge-gdrive-space"></p>

						<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php?action=ai1wmge_gdrive_revoke' ) ); ?>">
							<button type="submit" class="ai1wm-button-red" name="ai1wmge_gdrive_logout" id="ai1wmge-gdrive-logout">
								<i class="ai1wm-icon-exit"></i>
								<?php _e( 'Sign Out from your Google Drive account', AI1WMGE_PLUGIN_NAME ); ?>
							</button>
						</form>

					<?php else : ?>

						<form method="post" action="<?php echo esc_url( AI1WMGE_REDIRECT_CREATE_URL ); ?>">
							<input type="hidden" name="ai1wmge_client" id="ai1wmge-client" value="<?php echo esc_url( network_admin_url( 'admin.php?page=ai1wmge_settings' ) ); ?>" />
							<button type="submit" class="ai1wm-button-blue" name="ai1wmge_gdrive_link" id="ai1wmge-gdrive-link">
								<i class="ai1wm-icon-enter"></i>
								<?php _e( 'Link your Google Drive account', AI1WMGE_PLUGIN_NAME ); ?>
							</button>
						</form>
					<?php endif; ?>
				</div>
			</div>

			<?php if ( $token ) : ?>
				<div id="ai1wmge-backups" class="ai1wm-holder">
					<h1><i class="ai1wm-icon-gear"></i> <?php _e( 'Google Drive Backups', AI1WMGE_PLUGIN_NAME ); ?></h1>
					<br />
					<br />

					<?php if ( Ai1wm_Message::has( 'settings' ) ) : ?>
						<div class="ai1wm-message ai1wm-success-message">
							<p><?php echo Ai1wm_Message::get( 'settings' ); ?></p>
						</div>
					<?php endif; ?>

					<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php?action=ai1wmge_gdrive_settings' ) ); ?>">
						<article class="ai1wmge-article">
							<h3><?php _e( 'Configure your backup plan', AI1WMGE_PLUGIN_NAME ); ?></h3>
							<p>
								<label for="ai1wmge-gdrive-cron-timestamp">
									<?php _e( 'Backup time:', AI1WMGE_PLUGIN_NAME ); ?>
									<input type="text" name="ai1wmge_gdrive_cron_timestamp" id="ai1wmge-gdrive-cron-timestamp" value="<?php echo esc_attr( get_date_from_gmt( date( 'Y-m-d H:i:s', $gdrive_cron_timestamp ), 'g:i a' ) ); ?>" autocomplete="off" />
									<code><?php echo ai1wm_get_timezone_string(); ?></code>
								</label>
							</p>
							<ul id="ai1wmge-gdrive-cron">
								<li>
									<label for="ai1wmge-gdrive-cron-hourly">
										<input type="checkbox" name="ai1wmge_gdrive_cron[]" id="ai1wmge-gdrive-cron-hourly" value="hourly" <?php echo in_array( 'hourly', $gdrive_backup_schedules ) ? 'checked' : null; ?> />
										<?php _e( 'Every hour', AI1WMGE_PLUGIN_NAME ); ?>
									</label>
								</li>
								<li>
									<label for="ai1wmge-gdrive-cron-daily">
										<input type="checkbox" name="ai1wmge_gdrive_cron[]" id="ai1wmge-gdrive-cron-daily" value="daily" <?php echo in_array( 'daily', $gdrive_backup_schedules ) ? 'checked' : null; ?> />
										<?php _e( 'Every day', AI1WMGE_PLUGIN_NAME ); ?>
									</label>
								</li>
								<li>
									<label for="ai1wmge-gdrive-cron-weekly">
										<input type="checkbox" name="ai1wmge_gdrive_cron[]" id="ai1wmge-gdrive-cron-weekly" value="weekly" <?php echo in_array( 'weekly', $gdrive_backup_schedules ) ? 'checked' : null; ?> />
										<?php _e( 'Every week', AI1WMGE_PLUGIN_NAME ); ?>
									</label>
								</li>
								<li>
									<label for="ai1wmge-gdrive-cron-monthly">
										<input type="checkbox" name="ai1wmge_gdrive_cron[]" id="ai1wmge-gdrive-cron-monthly" value="monthly" <?php echo in_array( 'monthly', $gdrive_backup_schedules ) ? 'checked' : null; ?> />
										<?php _e( 'Every month', AI1WMGE_PLUGIN_NAME ); ?>
									</label>
								</li>
							</ul>

							<p>
								<?php _e( 'Last backup date:', AI1WMGE_PLUGIN_NAME ); ?>
								<strong>
									<?php echo $last_backup_date; ?>
								</strong>
							</p>

							<p>
								<?php _e( 'Next backup date:', AI1WMGE_PLUGIN_NAME ); ?>
								<strong>
									<?php echo $next_backup_date; ?>
								</strong>
							</p>

							<p>
								<label for="ai1wmge-gdrive-ssl">
									<input type="checkbox" name="ai1wmge_gdrive_ssl" id="ai1wmge-gdrive-ssl" value="1" <?php echo empty( $ssl ) ? 'checked' : null; ?> />
									<?php _e( 'Disable connecting to Google Drive via SSL (only if export is failing)', AI1WMGE_PLUGIN_NAME ); ?>
								</label>
							</p>
						</article>

						<article class="ai1wmge-article">
							<h3><?php _e( 'Destination folder', AI1WMGE_PLUGIN_NAME ); ?></h3>
							<p id="ai1wmge-gdrive-folder-details">
								<span class="spinner" style="visibility: visible;"></span>
								<?php _e( 'Retrieving Google Drive folder details..', AI1WMGE_PLUGIN_NAME ); ?>
							</p>
							<p>
								<input type="hidden" name="ai1wmge_gdrive_folder_id" id="ai1wmge-gdrive-folder-id" />
								<input type="hidden" name="ai1wmge_gdrive_team_drive_id" id="ai1wmge-gdrive-team-drive-id" value="<?php echo esc_attr( $team_drive_id ); ?>" />

								<button type="button" class="ai1wm-button-gray" name="ai1wmge_gdrive_change" id="ai1wmge-gdrive-change">
									<i class="ai1wm-icon-folder"></i>
									<?php _e( 'Change', AI1WMGE_PLUGIN_NAME ); ?>
								</button>
							</p>
						</article>

						<article class="ai1wmge-article">
							<h3><?php _e( 'Notification settings', AI1WMGE_PLUGIN_NAME ); ?></h3>
							<p>
								<label for="ai1wmge-gdrive-notify-toggle">
									<input type="checkbox" id="ai1wmge-gdrive-notify-toggle" name="ai1wmge_gdrive_notify_toggle" <?php echo empty( $notify_ok_toggle ) ? null : 'checked'; ?> />
									<?php _e( 'Send an email when a backup is complete', AI1WMGE_PLUGIN_NAME ); ?>
								</label>
							</p>

							<p>
								<label for="ai1wmge-gdrive-notify-error-toggle">
									<input type="checkbox" id="ai1wmge-gdrive-notify-error-toggle" name="ai1wmge_gdrive_notify_error_toggle" <?php echo empty( $notify_error_toggle ) ? null : 'checked'; ?> />
									<?php _e( 'Send an email if a backup fails', AI1WMGE_PLUGIN_NAME ); ?>
								</label>
							</p>

							<p>
								<label for="ai1wmge-gdrive-notify-email">
									<?php _e( 'Email address', AI1WMGE_PLUGIN_NAME ); ?>
									<br />
									<input class="ai1wmge-email" style="width: 15rem;" type="email" id="ai1wmge-gdrive-notify-email" name="ai1wmge_gdrive_notify_email" value="<?php echo esc_attr( $notify_email ); ?>" />
								</label>
							</p>
						</article>

						<article class="ai1wmge-article">
							<h3><?php _e( 'Retention settings', AI1WMGE_PLUGIN_NAME ); ?></h3>
							<p>
								<div class="ai1wm-field">
									<label for="ai1wmge-gdrive-backups">
										<?php _e( 'Keep the most recent', AI1WMGE_PLUGIN_NAME ); ?>
										<input style="width: 4.5em;" type="number" min="0" name="ai1wmge_gdrive_backups" id="ai1wmge-gdrive-backups" value="<?php echo intval( $backups ); ?>" />
									</label>
									<?php _e( 'backups. <small>Default: <strong>0</strong> unlimited</small>', AI1WMGE_PLUGIN_NAME ); ?>
								</div>

								<div class="ai1wm-field">
									<label for="ai1wmge-gdrive-total">
										<?php _e( 'Limit the total size of backups to', AI1WMGE_PLUGIN_NAME ); ?>
										<input style="width: 4.5em;" type="number" min="0" name="ai1wmge_gdrive_total" id="ai1wmge-gdrive-total" value="<?php echo intval( $total ); ?>" />
									</label>
									<select style="margin-top: -2px;" name="ai1wmge_gdrive_total_unit" id="ai1wmge-gdrive-total-unit">
										<option value="MB" <?php echo strpos( $total, 'MB' ) !== false ? 'selected="selected"' : null; ?>><?php _e( 'MB', AI1WMGE_PLUGIN_NAME ); ?></option>
										<option value="GB" <?php echo strpos( $total, 'GB' ) !== false ? 'selected="selected"' : null; ?>><?php _e( 'GB', AI1WMGE_PLUGIN_NAME ); ?></option>
									</select>
									<?php _e( '<small>Default: <strong>0</strong> unlimited</small>', AI1WMGE_PLUGIN_NAME ); ?>
								</div>

								<div class="ai1wm-field">
									<label for="ai1wmge-gdrive-days">
										<?php _e( 'Remove backups older than ', AI1WMGE_PLUGIN_NAME ); ?>
										<input style="width: 4.5em;" type="number" min="0" name="ai1wmge_gdrive_days" id="ai1wmge-gdrive-days" value="<?php echo intval( $days ); ?>" />
									</label>
									<?php _e( 'days. <small>Default: <strong>0</strong> off</small>', AI1WMGE_PLUGIN_NAME ); ?>
								</div>
							</p>
						</article>

						<article class="ai1wmge-article">
							<h3><?php _e( 'Security Settings', AI1WMGE_PLUGIN_NAME ); ?></h3>
							<p>
								<label for="ai1wmge-gdrive-lock-mode">
									<input type="checkbox" id="ai1wmge-gdrive-lock-mode" name="ai1wmge_gdrive_lock_mode" <?php echo empty( $lock_mode ) ? null : 'checked'; ?> />
									<?php echo sprintf( __( 'Lock this page for all users except <strong>%s</strong>. <a href="https://help.servmask.com/knowledgebase/lock-settings-page/" target="_blank">More details</a>', AI1WMGE_PLUGIN_NAME ), $user_display_name ); ?>
								</label>
							</p>
						</article>

						<article class="ai1wmge-article">
							<h3><?php _e( 'Transfer settings', AI1WMGE_PLUGIN_NAME ); ?></h3>
							<div class="ai1wm-field">
								<label><?php _e( 'Slow Internet (Home)', AI1WMGE_PLUGIN_NAME ); ?></label>
								<input name="ai1wmge_gdrive_file_chunk_size" min="5242880" max="20971520" step="5242880" type="range" value="<?php echo $file_chunk_size; ?>" id="ai1wmge-gdrive-file-chunk-size" />
								<label><?php _e( 'Fast Internet (Internet Servers)', AI1WMGE_PLUGIN_NAME ); ?></label>
							</div>
						</article>

						<p>
							<button type="submit" class="ai1wm-button-blue" name="ai1wmge_gdrive_update" id="ai1wmge-gdrive-update">
								<i class="ai1wm-icon-database"></i>
								<?php _e( 'Update', AI1WMGE_PLUGIN_NAME ); ?>
							</button>
						</p>
					</form>
				</div>
			<?php endif; ?>

			<?php do_action( 'ai1wmge_settings_left_end' ); ?>

		</div>
		<div class="ai1wm-right">
			<div class="ai1wm-sidebar">
				<div class="ai1wm-segment">
					<?php if ( ! AI1WM_DEBUG ) : ?>
						<?php include AI1WM_TEMPLATES_PATH . '/common/share-buttons.php'; ?>
					<?php endif; ?>

					<h2><?php _e( 'Leave Feedback', AI1WMGE_PLUGIN_NAME ); ?></h2>

					<?php include AI1WM_TEMPLATES_PATH . '/common/leave-feedback.php'; ?>
				</div>
			</div>
		</div>
	</div>
</div>

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

// Include plugin bootstrap file
require_once dirname( __FILE__ ) .
	DIRECTORY_SEPARATOR .
	'all-in-one-wp-migration-gdrive-extension.php';

/**
 * Trigger Uninstall process only if WP_UNINSTALL_PLUGIN is defined
 */
if ( defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	global $wpdb, $wp_filesystem;

	// Reset cron schedules
	if ( ( $cron = get_option( 'cron', array() ) ) ) {
		foreach ( $cron as $timestamp => $hooks ) {
			unset( $cron[ $timestamp ]['ai1wmge_gdrive_hourly_export'] );
			unset( $cron[ $timestamp ]['ai1wmge_gdrive_daily_export'] );
			unset( $cron[ $timestamp ]['ai1wmge_gdrive_weekly_export'] );
			unset( $cron[ $timestamp ]['ai1wmge_gdrive_monthly_export'] );
		}

		update_option( 'cron', $cron );
	}

	// Delete any options or other data stored in the database here
	delete_option( 'ai1wmge_gdrive_cron_timestamp' );
	delete_option( 'ai1wmge_gdrive_cron' );
	delete_option( 'ai1wmge_gdrive_token' );
	delete_option( 'ai1wmge_gdrive_ssl' );
	delete_option( 'ai1wmge_gdrive_time' );
	delete_option( 'ai1wmge_gdrive_backups' );
	delete_option( 'ai1wmge_gdrive_total' );
	delete_option( 'ai1wmge_gdrive_days' );
	delete_option( 'ai1wmge_gdrive_file_chunk_size' );
	delete_option( 'ai1wmge_gdrive_notify_toggle' );
	delete_option( 'ai1wmge_gdrive_notify_error_toggle' );
	delete_option( 'ai1wmge_gdrive_notify_error_subject' );
	delete_option( 'ai1wmge_gdrive_notify_email' );
	delete_option( 'ai1wmge_gdrive_folder_id' );
	delete_option( 'ai1wmge_gdrive_team_drive_id' );
	delete_option( 'ai1wmge_gdrive_access_token' );
	delete_option( 'ai1wmge_gdrive_access_token_expires_in' );
	delete_option( 'ai1wmge_gdrive_lock_mode' );
}

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

class Ai1wmge_Settings_Controller {

	public static function index() {
		$model = new Ai1wmge_Settings;

		$gdrive_backup_schedules = get_option( 'ai1wmge_gdrive_cron', array() );
		$gdrive_cron_timestamp   = get_option( 'ai1wmge_gdrive_cron_timestamp', time() );
		$last_backup_timestamp   = get_option( 'ai1wmge_gdrive_timestamp', false );

		$last_backup_date = $model->get_last_backup_date( $last_backup_timestamp );
		$next_backup_date = $model->get_next_backup_date( $gdrive_backup_schedules );

		$user = wp_get_current_user();

		Ai1wm_Template::render(
			'settings/index',
			array(
				'gdrive_backup_schedules' => $gdrive_backup_schedules,
				'gdrive_cron_timestamp'   => $gdrive_cron_timestamp,
				'notify_ok_toggle'        => get_option( 'ai1wmge_gdrive_notify_toggle', false ),
				'notify_error_toggle'     => get_option( 'ai1wmge_gdrive_notify_error_toggle', false ),
				'notify_email'            => get_option( 'ai1wmge_gdrive_notify_email', get_option( 'admin_email', false ) ),
				'last_backup_date'        => $last_backup_date,
				'next_backup_date'        => $next_backup_date,
				'folder_id'               => get_option( 'ai1wmge_gdrive_folder_id', false ),
				'team_drive_id'           => get_option( 'ai1wmge_gdrive_team_drive_id', null ),
				'file_chunk_size'         => get_option( 'ai1wmge_gdrive_file_chunk_size', AI1WMGE_DEFAULT_FILE_CHUNK_SIZE ),
				'ssl'                     => get_option( 'ai1wmge_gdrive_ssl', true ),
				'timestamp'               => get_option( 'ai1wmge_gdrive_timestamp', false ),
				'token'                   => get_option( 'ai1wmge_gdrive_token', false ),
				'backups'                 => get_option( 'ai1wmge_gdrive_backups', false ),
				'total'                   => get_option( 'ai1wmge_gdrive_total', false ),
				'days'                    => get_option( 'ai1wmge_gdrive_days', false ),
				'lock_mode'               => get_option( 'ai1wmge_gdrive_lock_mode', false ),
				'user_display_name'       => $user->display_name,
			),
			AI1WMGE_TEMPLATES_PATH
		);
	}

	public static function picker() {
		Ai1wm_Template::render(
			'settings/picker',
			array(),
			AI1WMGE_TEMPLATES_PATH
		);
	}

	public static function settings( $params = array() ) {
		ai1wm_setup_environment();

		// Set params
		if ( empty( $params ) ) {
			$params = stripslashes_deep( $_POST );
		}

		// Google Drive update
		if ( isset( $params['ai1wmge_gdrive_update'] ) ) {
			$model = new Ai1wmge_Settings;

			// Cron timestamp update
			if ( ! empty( $params['ai1wmge_gdrive_cron_timestamp'] ) && ( $cron_timestamp = strtotime( $params['ai1wmge_gdrive_cron_timestamp'], current_time( 'timestamp' ) ) ) ) {
				$model->set_cron_timestamp( strtotime( get_gmt_from_date( date( 'Y-m-d H:i:s', $cron_timestamp ) ) ) );
			} else {
				$model->set_cron_timestamp( time() );
			}

			// Cron update
			if ( ! empty( $params['ai1wmge_gdrive_cron'] ) ) {
				$model->set_cron( (array) $params['ai1wmge_gdrive_cron'] );
			} else {
				$model->set_cron( array() );
			}

			// Set SSL mode
			if ( ! empty( $params['ai1wmge_gdrive_ssl'] ) ) {
				$model->set_ssl( 0 );
			} else {
				$model->set_ssl( 1 );
			}

			// Set number of backups
			if ( ! empty( $params['ai1wmge_gdrive_backups'] ) ) {
				$model->set_backups( (int) $params['ai1wmge_gdrive_backups'] );
			} else {
				$model->set_backups( 0 );
			}

			// Set size of backups
			if ( ! empty( $params['ai1wmge_gdrive_total'] ) && ! empty( $params['ai1wmge_gdrive_total_unit'] ) ) {
				$model->set_total( (int) $params['ai1wmge_gdrive_total'] . trim( $params['ai1wmge_gdrive_total_unit'] ) );
			} else {
				$model->set_total( 0 );
			}

			// Set age of backups
			if ( ! empty( $params['ai1wmge_gdrive_days'] ) ) {
				$model->set_days( (int) $params['ai1wmge_gdrive_days'] );
			} else {
				$model->set_days( 0 );
			}

			// Set file chunk size
			if ( ! empty( $params['ai1wmge_gdrive_file_chunk_size'] ) ) {
				$model->set_file_chunk_size( $params['ai1wmge_gdrive_file_chunk_size'] );
			} else {
				$model->set_file_chunk_size( AI1WMGE_DEFAULT_FILE_CHUNK_SIZE );
			}

			// Set folder ID
			$model->set_folder_id( trim( $params['ai1wmge_gdrive_folder_id'] ) );

			// Set team drive ID
			$model->set_team_drive_id( trim( $params['ai1wmge_gdrive_team_drive_id'] ) );

			// Set notify ok toggle
			$model->set_notify_ok_toggle( isset( $params['ai1wmge_gdrive_notify_toggle'] ) );

			// Set notify error toggle
			$model->set_notify_error_toggle( isset( $params['ai1wmge_gdrive_notify_error_toggle'] ) );

			// Set notify email
			$model->set_notify_email( trim( $params['ai1wmge_gdrive_notify_email'] ) );

			// Set lock mode
			if ( ! empty( $params['ai1wmge_gdrive_lock_mode'] ) ) {
				$model->set_lock_mode( 1 );
			} else {
				$model->set_lock_mode( 0 );
			}

			// Set GDrive settings capability
			$user = wp_get_current_user();
			$user->add_cap( AI1WMGE_SETTINGS_CAPABILITY, $model->get_lock_mode() );

			// Set message
			Ai1wm_Message::flash( 'settings', __( 'Your changes have been saved.', AI1WMGE_PLUGIN_NAME ) );
		}

		// Redirect to settings page
		wp_redirect( network_admin_url( 'admin.php?page=ai1wmge_settings' ) );
		exit;
	}

	public static function revoke( $params = array() ) {
		ai1wm_setup_environment();

		// Set params
		if ( empty( $params ) ) {
			$params = stripslashes_deep( $_POST );
		}

		// Google Drive logout
		if ( isset( $params['ai1wmge_gdrive_logout'] ) ) {
			$model = new Ai1wmge_Settings;
			$model->revoke();
		}

		// Redirect to settings page
		wp_redirect( network_admin_url( 'admin.php?page=ai1wmge_settings' ) );
		exit;
	}

	public static function account() {
		ai1wm_setup_environment();

		try {
			$model = new Ai1wmge_Settings;
			if ( ( $account = $model->get_account() ) ) {
				echo json_encode( $account );
				exit;
			}
		} catch ( Ai1wmge_Error_Exception $e ) {
			status_header( 400 );
			echo json_encode( array( 'message' => $e->getMessage() ) );
			exit;
		}
	}

	public static function selector( $params = array() ) {
		ai1wm_setup_environment();

		// Set params
		if ( empty( $params ) ) {
			$params = stripslashes_deep( $_GET );
		}

		// Set folder ID
		$folder_id = 'root';
		if ( ! empty( $params['folder_id'] ) ) {
			$folder_id = trim( $params['folder_id'] );
		}

		// Set team drive ID
		$team_drive_id = null;
		if ( ! empty( $params['team_drive_id'] ) ) {
			$team_drive_id = $params['team_drive_id'];
		}

		try {
			// Set GDrive client
			$gdrive = new Ai1wmge_GDrive_Client(
				get_option( 'ai1wmge_gdrive_token' ),
				get_option( 'ai1wmge_gdrive_ssl', true )
			);

			if ( $folder_id === 'drive' ) {
				// List drives
				$items = $gdrive->list_team_drives();
			} else {
				// List folder
				$items = $gdrive->list_folder_by_id( $folder_id, $team_drive_id, array( 'orderBy' => 'folder,title' ) );
			}
		} catch ( Ai1wmge_Error_Exception $e ) {
			status_header( 400 );
			echo json_encode( array( 'message' => $e->getMessage() ) );
			exit;
		}

		// Set folder structure
		$response = array( 'items' => array(), 'num_hidden_files' => 0 );

		// Set folder items
		foreach ( $items as $item ) {
			if ( in_array( $item['type'], array( 'application/vnd.google-apps.folder', 'drive' ) ) ) {
				$response['items'][] = array(
					'id'    => isset( $item['id'] ) ? $item['id'] : null,
					'name'  => isset( $item['name'] ) ? $item['name'] : null,
					'date'  => isset( $item['date'] ) ? human_time_diff( $item['date'] ) : null,
					'bytes' => isset( $item['bytes'] ) ? $item['bytes'] : null,
					'size'  => isset( $item['bytes'] ) ? ai1wm_size_format( $item['bytes'] ) : null,
					'type'  => isset( $item['type'] ) ? $item['type'] : null,
					'ext'   => isset( $item['ext'] ) ? $item['ext'] : null,
				);
			} else {
				$response['num_hidden_files']++;
			}
		}

		echo json_encode( $response );
		exit;
	}

	public static function folder() {
		ai1wm_setup_environment();

		try {
			// Set GDrive client
			$gdrive = new Ai1wmge_GDrive_Client(
				get_option( 'ai1wmge_gdrive_token' ),
				get_option( 'ai1wmge_gdrive_ssl', true )
			);

			// Get folder ID
			$folder_id = get_option( 'ai1wmge_gdrive_folder_id', false );

			// Get team drive ID
			$team_drive_id = get_option( 'ai1wmge_gdrive_team_drive_id', null );

			// Create folder
			if ( ! ( $folder_id = $gdrive->get_folder_id_by_id( $folder_id, $team_drive_id ) ) ) {
				if ( ! ( $folder_id = $gdrive->get_folder_id_by_name( ai1wm_archive_folder(), 'root', $team_drive_id ) ) ) {
					$folder_id = $gdrive->create_folder( ai1wm_archive_folder(), 'root', $team_drive_id );
				}
			}

			// Set folder ID
			update_option( 'ai1wmge_gdrive_folder_id', $folder_id );

			// Get folder name
			if ( ! ( $folder_name = $gdrive->get_folder_name_by_id( $folder_id, $team_drive_id ) ) ) {
				status_header( 400 );
				echo json_encode(
					array(
						'message' => __(
							'We were unable to retrieve your backup folder details. ' .
							'Google servers are overloaded at the moment. ' .
							'Please wait for a few minutes and try again by refreshing the page.',
							AI1WMGE_PLUGIN_NAME
						),
					)
				);
				exit;
			}
		} catch ( Ai1wmge_Error_Exception $e ) {
			status_header( 400 );
			echo json_encode( array( 'message' => $e->getMessage() ) );
			exit;
		}

		echo json_encode( array( 'id' => $folder_id, 'name' => $folder_name ) );
		exit;
	}

	public static function notify_ok_toggle() {
		$model = new Ai1wmge_Settings;
		if ( ( $notify_ok_toggle = $model->get_notify_ok_toggle() ) ) {
			return $notify_ok_toggle;
		}
	}

	public static function notify_error_toggle() {
		$model = new Ai1wmge_Settings;
		if ( ( $notify_error_toggle = $model->get_notify_error_toggle() ) ) {
			return $notify_error_toggle;
		}
	}

	public static function notify_error_subject() {
		$model = new Ai1wmge_Settings;
		if ( ( $notify_error_subject = $model->get_notify_error_subject() ) ) {
			return $notify_error_subject;
		}
	}

	public static function notify_email() {
		$model = new Ai1wmge_Settings;
		if ( ( $notify_email = $model->get_notify_email() ) ) {
			return $notify_email;
		}
	}
}

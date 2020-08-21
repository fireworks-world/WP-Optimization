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

class Ai1wmge_Import_Controller {

	public static function button() {
		return Ai1wm_Template::get_content(
			'import/button',
			array( 'token' => get_option( 'ai1wmge_gdrive_token', false ) ),
			AI1WMGE_TEMPLATES_PATH
		);
	}

	public static function picker() {
		Ai1wm_Template::render(
			'import/picker',
			array(),
			AI1WMGE_TEMPLATES_PATH
		);
	}

	public static function browser( $params = array() ) {
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
			$team_drive_id = trim( $params['team_drive_id'] );
		}

		// Set GDrive client
		$gdrive = new Ai1wmge_GDrive_Client(
			get_option( 'ai1wmge_gdrive_token', false ),
			get_option( 'ai1wmge_gdrive_ssl', true )
		);

		if ( $folder_id === 'drive' ) {
			// List drives
			$items = $gdrive->list_team_drives();
		} else {
			// List folder
			$items = $gdrive->list_folder_by_id( $folder_id, $team_drive_id, array( 'orderBy' => 'folder,title' ) );
		}

		// Set folder structure
		$response = array( 'items' => array(), 'num_hidden_files' => 0 );

		// Set folder items
		foreach ( $items as $item ) {
			if ( in_array( $item['type'], array( 'application/vnd.google-apps.folder', 'drive' ) ) || pathinfo( $item['name'], PATHINFO_EXTENSION ) === 'wpress' ) {
				$response['items'][] = array(
					'id'    => isset( $item['id'] ) ? $item['id'] : null,
					'name'  => isset( $item['name'] ) ? $item['name'] : null,
					'date'  => isset( $item['date'] ) ? human_time_diff( $item['date'] ) : null,
					'size'  => isset( $item['bytes'] ) ? ai1wm_size_format( $item['bytes'] ) : null,
					'bytes' => isset( $item['bytes'] ) ? $item['bytes'] : null,
					'ext'   => isset( $item['ext'] ) ? $item['ext'] : null,
					'type'  => isset( $item['type'] ) ? $item['type'] : null,
				);
			} else {
				$response['num_hidden_files']++;
			}
		}

		echo json_encode( $response );
		exit;
	}

	public static function pro() {
		return Ai1wm_Template::get_content( 'import/pro', array(), AI1WMGE_TEMPLATES_PATH );
	}
}

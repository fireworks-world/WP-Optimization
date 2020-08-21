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

class Ai1wmge_Export_Retention {

	/**
	 * GDrive client
	 *
	 * @var Ai1wmge_GDrive_Client
	 */
	private static $gdrive = null;

	/**
	 * Team Drive ID
	 *
	 * @var string
	 */
	private static $team_drive_id = null;

	/**
	 * Folder ID
	 *
	 * @var string
	 */
	private static $folder_id = null;

	public static function execute( $params, Ai1wmge_GDrive_Client $gdrive = null ) {

		// Set GDrive client
		if ( is_null( $gdrive ) ) {
			$gdrive = new Ai1wmge_GDrive_Client(
				get_option( 'ai1wmge_gdrive_token', false ),
				get_option( 'ai1wmge_gdrive_ssl', true )
			);
		}

		self::$gdrive        = $gdrive;
		self::$team_drive_id = $params['team_drive_id'];
		self::$folder_id     = $params['folder_id'];

		// No backups, no need to apply backup retention
		$backups = self::get_files();
		if ( count( $backups ) === 0 ) {
			return $params;
		}

		// The order is very important - we delete files by date, by size, and finally by total count
		self::delete_backups_older_than();
		self::delete_backups_when_total_size_over();
		self::delete_backups_when_total_count_over();

		return $params;
	}

	private static function delete_backups_older_than() {
		$backups = self::get_files();
		$days    = intval( get_option( 'ai1wmge_gdrive_days', 0 ) );
		if ( $days > 0 ) {
			foreach ( $backups as $backup ) {
				if ( $backup['date'] <= time() - $days * 86400 ) {
					self::delete_file( $backup );
				}
			}
		}
	}

	private static function delete_backups_when_total_size_over() {
		$backups        = self::get_files();
		$retention_size = ai1wm_parse_size( get_option( 'ai1wmge_gdrive_total', 0 ) );

		// Get the size of the latest backup before we remove it
		$size_of_backups = $backups[0]['bytes'];

		// Remove the latest backup, the user should have at least one backup
		array_shift( $backups );

		if ( $retention_size > 0 ) {
			foreach ( $backups as $backup ) {
				if ( $size_of_backups + $backup['bytes'] > $retention_size ) {
					self::delete_file( $backup );
				} else {
					$size_of_backups += $backup['bytes'];
				}
			}
		}
	}

	private static function delete_backups_when_total_count_over() {
		$backups = self::get_files();
		$limit   = intval( get_option( 'ai1wmge_gdrive_backups', 0 ) );

		if ( $limit > 0 ) {
			if ( count( $backups ) > $limit ) {
				for ( $i = $limit; $i < count( $backups ); $i++ ) {
					self::delete_file( $backups[ $i ] );
				}
			}
		}
	}

	private static function get_files() {
		$items = self::$gdrive->list_folder_by_id( self::$folder_id, self::$team_drive_id, array( 'orderBy' => 'createdDate' ) );

		$backups = array();
		foreach ( $items as $item ) {
			if ( $item['type'] === 'application/octet-stream' || pathinfo( $item['name'], PATHINFO_EXTENSION ) === 'wpress' ) {
				$backups[] = $item;
			}
		}

		usort( $backups, 'Ai1wmge_Export_Retention::sort_by_date_desc' );
		return $backups;
	}

	public static function sort_by_date_desc( $first_backup, $second_backup ) {
		return intval( $second_backup['date'] ) - intval( $first_backup['date'] );
	}

	private static function delete_file( $backup ) {
		return self::$gdrive->delete( $backup['id'] );
	}
}

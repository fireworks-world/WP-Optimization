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

class Ai1wmge_Export_Upload {

	public static function execute( $params, Ai1wmge_GDrive_Client $gdrive = null ) {

		$params['completed'] = false;

		// Validate upload URL
		if ( ! isset( $params['upload_url'] ) ) {
			throw new Ai1wm_Import_Exception( __( 'Google Drive Upload URL is not specified.', AI1WMGE_PLUGIN_NAME ) );
		}

		// Set archive offset
		if ( ! isset( $params['archive_offset'] ) ) {
			$params['archive_offset'] = 0;
		}

		// Set archive size
		if ( ! isset( $params['archive_size'] ) ) {
			$params['archive_size'] = ai1wm_archive_bytes( $params );
		}

		// Set file range start
		if ( ! isset( $params['file_range_start'] ) ) {
			$params['file_range_start'] = 0;
		}

		// Set file chunk size for upload
		$file_chunk_size = get_option( 'ai1wmge_gdrive_file_chunk_size', AI1WMGE_DEFAULT_FILE_CHUNK_SIZE );

		// Set file range end
		if ( ! isset( $params['file_range_end'] ) ) {
			$params['file_range_end'] = min( $params['archive_size'], $file_chunk_size ) - 1;
		}

		// Set upload retries
		if ( ! isset( $params['upload_retries'] ) ) {
			$params['upload_retries'] = 0;
		}

		// Set GDrive client
		if ( is_null( $gdrive ) ) {
			$gdrive = new Ai1wmge_GDrive_Client(
				get_option( 'ai1wmge_gdrive_token', false ),
				get_option( 'ai1wmge_gdrive_ssl', true )
			);
		}

		// Open the archive file for reading
		$archive = fopen( ai1wm_archive_path( $params ), 'rb' );

		// Read file chunk data
		if ( ( fseek( $archive, $params['archive_offset'] ) !== -1 )
				&& ( $file_chunk_data = fread( $archive, $file_chunk_size ) ) ) {

			$gdrive->load_upload_url( $params['upload_url'] );

			try {

				$params['upload_retries'] += 1;

				// Upload file chunk data
				$gdrive->upload_file_chunk( $file_chunk_data, $params['archive_size'], $params['file_range_start'], $params['file_range_end'] );

				// Unset upload retries
				unset( $params['upload_retries'] );

			} catch ( Ai1wmge_Connect_Exception $e ) {
				if ( $params['upload_retries'] <= 3 ) {
					return $params;
				}

				throw $e;
			}

			// Set archive offset
			$params['archive_offset'] = ftell( $archive );

			// Set file range start
			if ( $params['archive_size'] <= ( $params['file_range_start'] + $file_chunk_size ) ) {
				$params['file_range_start'] = $params['archive_size'] - 1;
			} else {
				$params['file_range_start'] = $params['file_range_start'] + $file_chunk_size;
			}

			// Set file range end
			if ( $params['archive_size'] <= ( $params['file_range_end'] + $file_chunk_size ) ) {
				$params['file_range_end'] = $params['archive_size'] - 1;
			} else {
				$params['file_range_end'] = $params['file_range_end'] + $file_chunk_size;
			}

			// Set archive details
			$name = ai1wm_archive_name( $params );
			$size = ai1wm_archive_size( $params );

			// Get progress
			$progress = (int) ( ( $params['archive_offset'] / $params['archive_size'] ) * 100 );

			// Set progress
			if ( defined( 'WP_CLI' ) ) {
				WP_CLI::log(
					sprintf(
						__( 'Uploading %s (%s) [%d%% complete]', AI1WMGE_PLUGIN_NAME ),
						$name,
						$size,
						$progress
					)
				);
			} else {
				Ai1wm_Status::info(
					sprintf(
						__(
							'<i class="ai1wmge-icon-gdrive"></i> ' .
							'Uploading <strong>%s</strong> (%s)<br />%d%% complete',
							AI1WMGE_PLUGIN_NAME
						),
						$name,
						$size,
						$progress
					)
				);
			}
		} else {

			// Set last backup date
			update_option( 'ai1wmge_gdrive_timestamp', time() );

			// Unset upload URL
			unset( $params['upload_url'] );

			// Unset archive offset
			unset( $params['archive_offset'] );

			// Unset archive size
			unset( $params['archive_size'] );

			// Unset file range start
			unset( $params['file_range_start'] );

			// Unset file range end
			unset( $params['file_range_start'] );

			// Unset completed
			unset( $params['completed'] );
		}

		// Close the archive file
		fclose( $archive );

		return $params;
	}
}

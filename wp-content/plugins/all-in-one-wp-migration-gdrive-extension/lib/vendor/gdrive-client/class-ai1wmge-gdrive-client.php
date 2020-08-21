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

class Ai1wmge_GDrive_Client {

	const API_URL         = 'https://www.googleapis.com/drive/v2';
	const API_UPLOAD_URL  = 'https://www.googleapis.com/upload/drive/v2';
	const API_ACCOUNT_URL = 'https://accounts.google.com/o/oauth2';

	/**
	 * OAuth refresh token
	 *
	 * @var string
	 */
	protected $refresh_token = null;

	/**
	 * Upload URL
	 *
	 * @var string
	 */
	protected $upload_url = null;

	/**
	 * Download URL
	 *
	 * @var string
	 */
	protected $download_url = null;

	/**
	 * SSL mode
	 *
	 * @var boolean
	 */
	protected $ssl = null;

	public function __construct( $refresh_token, $ssl = true ) {
		$this->refresh_token = $refresh_token;
		$this->ssl           = $ssl;
	}

	/**
	 * Load upload URL
	 *
	 * @param  string $url Upload URL
	 * @return void
	 */
	public function load_upload_url( $url ) {
		$this->upload_url = $url;
	}

	/**
	 * Load download URL
	 *
	 * @param  string $url Download URL
	 * @return void
	 */
	public function load_download_url( $url ) {
		$this->download_url = $url;
	}

	/**
	 * Upload file
	 *
	 * @param  string $file_data     File data
	 * @param  string $file_name     File name
	 * @param  string $parent_id     Parent ID
	 * @param  string $team_drive_id Team Drive ID
	 * @return array
	 */
	public function upload_file( $file_data, $file_name, $parent_id = 'root', $team_drive_id = null ) {
		$boundary = uniqid();

		if ( $parent_id === 'root' && ! empty( $team_drive_id ) ) {
			$parent_id = $team_drive_id;
		}

		$query = array(
			'title'   => $file_name,
			'parents' => array( array( 'id' => $parent_id ) ),
		);

		// Raw request
		$post  = sprintf( "--%s\r\n", $boundary );
		$post .= sprintf( "Content-Type: application/json\r\n\r\n" );
		$post .= sprintf( "%s\r\n", json_encode( $query ) );
		$post .= sprintf( "--%s\r\n", $boundary );
		$post .= sprintf( "Content-Type: application/octet-stream\r\n\r\n" );
		$post .= sprintf( "%s\r\n", $file_data );
		$post .= sprintf( "--%s\r\n", $boundary );

		// Upload file
		$api = new Ai1wmge_GDrive_Curl;
		$api->set_access_token( $this->get_access_token() );
		$api->set_ssl( $this->ssl );
		$api->set_base_url( self::API_UPLOAD_URL );
		$api->set_path( '/files' );
		$api->set_query(
			array(
				'uploadType'         => 'multipart',
				'supportsTeamDrives' => 'true',
			)
		);
		$api->set_option( CURLOPT_POST, true );
		$api->set_option( CURLOPT_POSTFIELDS, $post );
		$api->set_header( 'Content-Length', strlen( $post ) );
		$api->set_header( 'Content-Type', sprintf( 'multipart/related; boundary="%s"', $boundary ) );

		try {
			$response = $api->make_request( true );
		} catch ( Ai1wmge_Error_Exception $e ) {
			throw $e;
		}

		return $response;
	}

	/**
	 * Upload resumable file on Google Drive
	 *
	 * @param  string  $file_name     File name
	 * @param  integer $file_size     File size
	 * @param  string  $parent_id     Parent ID
	 * @param  string  $team_drive_id Team Drive ID
	 * @return string
	 */
	public function upload_resumable( $file_name, $file_size, $parent_id = 'root', $team_drive_id = null ) {
		if ( $parent_id === 'root' && ! empty( $team_drive_id ) ) {
			$parent_id = $team_drive_id;
		}
		$api = new Ai1wmge_GDrive_Curl;
		$api->set_header( 'Content-Type', 'application/json' );
		$api->set_header( 'X-Upload-Content-Type', 'application/octet-stream' );
		$api->set_header( 'X-Upload-Content-Length', $file_size );
		$api->set_access_token( $this->get_access_token() );
		$api->set_ssl( $this->ssl );
		$api->set_base_url( self::API_UPLOAD_URL );
		$api->set_path( '/files' );
		$api->set_query(
			array(
				'uploadType'         => 'resumable',
				'supportsTeamDrives' => 'true',
			)
		);
		$api->set_option( CURLOPT_POST, true );
		$api->set_option( CURLOPT_HEADER, true );
		$api->set_option(
			CURLOPT_POSTFIELDS,
			json_encode(
				array(
					'title'   => $file_name,
					'parents' => array( array( 'id' => $parent_id ) ),
				)
			)
		);

		try {
			$response = $api->make_request();
		} catch ( Ai1wmge_Error_Exception $e ) {
			throw $e;
		}

		if ( ( $headers = array_change_key_case( $response ) ) ) {
			if ( isset( $headers['location'] ) ) {
				return $headers['location'];
			}
		}
	}

	/**
	 * Upload file chunk
	 *
	 * @param  string  $file_chunk_data  File chunk data
	 * @param  integer $file_size        File size
	 * @param  integer $file_range_start File range start
	 * @param  integer $file_range_end   File range end
	 * @return array
	 */
	public function upload_file_chunk( $file_chunk_data, $file_size, $file_range_start = 0, $file_range_end = 0 ) {
		$api = new Ai1wmge_GDrive_Curl;
		$api->set_access_token( $this->get_access_token() );
		$api->set_ssl( $this->ssl );
		$api->set_base_url( $this->upload_url );
		$api->set_option( CURLOPT_CUSTOMREQUEST, 'PUT' );
		$api->set_option( CURLOPT_POSTFIELDS, $file_chunk_data );
		$api->set_header( 'Content-Length', strlen( $file_chunk_data ) );
		$api->set_header( 'Content-Range', sprintf( 'bytes %d-%d/%d', $file_range_start, $file_range_end, $file_size ) );

		try {
			$response = $api->make_request( true );
		} catch ( Ai1wmge_Error_Exception $e ) {
			throw $e;
		}

		return $response;
	}

	/**
	 * Get file download URL
	 *
	 * @param  string $file_id File ID
	 * @return string
	 */
	public function get_file_url( $file_id ) {
		$api = new Ai1wmge_GDrive_Curl;
		$api->set_access_token( $this->get_access_token() );
		$api->set_ssl( $this->ssl );
		$api->set_base_url( self::API_URL );
		$api->set_path( "/files/{$file_id}" );
		$api->set_query( array( 'supportsTeamDrives' => 'true' ) );

		try {
			$response = $api->make_request( true );
		} catch ( Ai1wmge_Error_Exception $e ) {
			throw $e;
		}

		if ( isset( $response['downloadUrl'] ) ) {
			return $response['downloadUrl'];
		}
	}

	/**
	 * Download file from Google Drive
	 *
	 * @param  resource $file_stream      File stream
	 * @param  integer  $file_range_start File range start
	 * @param  integer  $file_range_end   File range end
	 * @return boolean
	 */
	public function get_file( $file_stream, $file_range_start = 0, $file_range_end = 0 ) {
		$api = new Ai1wmge_GDrive_Curl;
		$api->set_access_token( $this->get_access_token() );
		$api->set_ssl( $this->ssl );
		$api->set_base_url( $this->download_url );
		$api->set_header( 'Range', sprintf( 'bytes=%d-%d', $file_range_start, $file_range_end ) );

		try {
			$file_chunk_data = $api->make_request();
		} catch ( Ai1wmge_Error_Exception $e ) {
			throw $e;
		}

		// Copy file chunk data into file stream
		if ( fwrite( $file_stream, $file_chunk_data ) === false ) {
			throw new Ai1wmge_Error_Exception( __( 'Unable to save the file from Google Drive', AI1WMGE_PLUGIN_NAME ) );
		}

		return true;
	}

	/**
	 * Create a folder
	 *
	 * @param  string $folder_name   Folder name
	 * @param  string $parent_id     Parent ID
	 * @param  string $team_drive_id Team Drive ID
	 * @return string
	 */
	public function create_folder( $folder_name, $parent_id = 'root', $team_drive_id = null ) {
		// Root folder for team drive is it's ID
		if ( $parent_id === 'root' && ! empty( $team_drive_id ) ) {
			$parent_id = $team_drive_id;
		}

		$api = new Ai1wmge_GDrive_Curl;
		$api->set_header( 'Content-Type', 'application/json' );
		$api->set_access_token( $this->get_access_token() );
		$api->set_ssl( $this->ssl );
		$api->set_base_url( self::API_URL );
		$api->set_path( '/files' );
		$api->set_query( array( 'supportsTeamDrives' => 'true' ) );
		$api->set_option( CURLOPT_POST, true );

		$api->set_option(
			CURLOPT_POSTFIELDS,
			json_encode(
				array(
					'title'    => $folder_name,
					'parents'  => array( array( 'id' => $parent_id ) ),
					'mimeType' => 'application/vnd.google-apps.folder',
				)
			)
		);

		try {
			$response = $api->make_request( true );
		} catch ( Ai1wmge_Error_Exception $e ) {
			throw $e;
		}

		if ( isset( $response['id'] ) ) {
			return $response['id'];
		}
	}

	/**
	 * Get folder ID by ID
	 *
	 * @param  string $folder_id     Folder ID
	 * @param  string $team_drive_id Team Drive ID
	 * @return string
	 */
	public function get_folder_id_by_id( $folder_id, $team_drive_id = null ) {
		if ( $folder_id === 'root' && ! empty( $team_drive_id ) ) {
			$folder_id = $team_drive_id;
		}

		$api = new Ai1wmge_GDrive_Curl;
		$api->set_access_token( $this->get_access_token() );
		$api->set_ssl( $this->ssl );
		$api->set_base_url( self::API_URL );
		$api->set_path( "/files/{$folder_id}" );
		$api->set_query( array( 'supportsTeamDrives' => 'true' ) );

		try {
			$response = $api->make_request( true );
		} catch ( Ai1wmge_Error_Exception $e ) {
			$response = array();
		}

		if ( empty( $response['explicitlyTrashed'] ) ) {
			if ( isset( $response['id'] ) ) {
				return $response['id'];
			}
		}
	}

	/**
	 * Get folder name by ID
	 *
	 * @param  string $folder_id     Folder ID
	 * @param  string $team_drive_id Team Drive ID
	 * @return string
	 */
	public function get_folder_name_by_id( $folder_id, $team_drive_id = null ) {
		$api = new Ai1wmge_GDrive_Curl;
		$api->set_access_token( $this->get_access_token() );
		$api->set_ssl( $this->ssl );
		$api->set_base_url( self::API_URL );
		$api->set_path( "/files/{$folder_id}" );
		$api->set_query( array( 'supportsTeamDrives' => 'true' ) );

		try {
			$response = $api->make_request( true );
		} catch ( Ai1wmge_Error_Exception $e ) {
			$response = array();
		}

		if ( empty( $response['explicitlyTrashed'] ) ) {
			if ( isset( $response['title'] ) ) {
				return $response['title'];
			}
		}
	}

	/**
	 * Get folder ID by name
	 *
	 * @param  string $folder_name   Folder name
	 * @param  array  $query         Query options
	 * @param  string $team_drive_id Team Drive ID
	 * @return string
	 */
	public function get_folder_id_by_name( $folder_name, $parent_id = 'root', $team_drive_id = null ) {
		if ( $parent_id === 'root' && ! empty( $team_drive_id ) ) {
			$parent_id = $team_drive_id;
		}

		$query = array(
			'q' => sprintf( "title = '%s' and trashed = false and '%s' in parents", $folder_name, $parent_id ),
		);

		if ( ! empty( $team_drive_id ) ) {
			$query = array_merge(
				$query,
				array(
					'supportsTeamDrives'    => 'true',
					'teamDriveId'           => $team_drive_id,
					'includeTeamDriveItems' => 'true',
					'corpora'               => 'teamDrive',
				)
			);
		}

		$api = new Ai1wmge_GDrive_Curl;
		$api->set_access_token( $this->get_access_token() );
		$api->set_ssl( $this->ssl );
		$api->set_base_url( self::API_URL );
		$api->set_path( '/files' );
		$api->set_query( $this->rawurlencode_query( $query ) );

		try {
			$response = $api->make_request( true );
		} catch ( Ai1wmge_Error_Exception $e ) {
			$response = array();
		}

		if ( isset( $response['items'][0]['id'] ) ) {
			return $response['items'][0]['id'];
		}
	}

	/**
	 * List Team Drives
	 *
	 * @return array
	 */
	public function list_team_drives() {
		$api = new Ai1wmge_GDrive_Curl;
		$api->set_access_token( $this->get_access_token() );
		$api->set_ssl( $this->ssl );
		$api->set_base_url( self::API_URL );
		$api->set_path( '/teamdrives' );
		$api->set_query( $this->rawurlencode_query( array( 'maxResults' => 100 ) ) );

		try {
			$response = $api->make_request( true );
		} catch ( Ai1wmge_Error_Exception $e ) {
			throw $e;
		}

		$items = array(
			array(
				'id'   => null,
				'name' => __( 'My Drive' ),
				'type' => 'drive',
			),
		);
		if ( isset( $response['items'] ) ) {
			foreach ( $response['items'] as $item ) {
				$items[] = array(
					'id'   => isset( $item['id'] ) ? $item['id'] : null,
					'name' => isset( $item['name'] ) ? $item['name'] : null,
					'type' => 'drive',
				);
			}
		}

		return $items;
	}

	/**
	 * Get Team Drive name by ID
	 *
	 * @param  string $team_drive_id Team Drive ID
	 * @return array
	 */
	public function get_team_drive_name_by_id( $team_drive_id ) {
		$api = new Ai1wmge_GDrive_Curl;
		$api->set_access_token( $this->get_access_token() );
		$api->set_ssl( $this->ssl );
		$api->set_base_url( self::API_URL );
		$api->set_path( "/teamdrives/{$team_drive_id}" );
		try {
			$response = $api->make_request( true );
		} catch ( Ai1wmge_Error_Exception $e ) {
			$response = array();
		}

		if ( isset( $response['name'] ) ) {
			return $response['name'];
		}
	}

	/**
	 * List folder by ID
	 *
	 * @param  string $folder_id     Folder ID
	 * @param  array  $query         Query options
	 * @param  string $team_drive_id Team Drive ID
	 * @return array
	 */
	public function list_folder_by_id( $folder_id = 'root', $team_drive_id = null, $query = array() ) {

		if ( $folder_id === 'root' && ! empty( $team_drive_id ) ) {
			$folder_id = $team_drive_id;
		}

		$query['q']          = sprintf( "'%s' in parents and trashed = false", $folder_id );
		$query['maxResults'] = 1000;

		if ( ! empty( $team_drive_id ) ) {
			$query['supportsTeamDrives']    = 'true';
			$query['teamDriveId']           = $team_drive_id;
			$query['includeTeamDriveItems'] = 'true';
			$query['corpora']               = 'teamDrive';
		}

		$api = new Ai1wmge_GDrive_Curl;
		$api->set_access_token( $this->get_access_token() );
		$api->set_ssl( $this->ssl );
		$api->set_base_url( self::API_URL );
		$api->set_path( '/files' );
		$api->set_query( $this->rawurlencode_query( $query ) );

		try {
			$response = $api->make_request( true );
		} catch ( Ai1wmge_Error_Exception $e ) {
			throw $e;
		}

		$items = array();
		if ( isset( $response['items'] ) ) {
			foreach ( $response['items'] as $item ) {
				$items[] = array(
					'id'    => isset( $item['id'] ) ? $item['id'] : null,
					'name'  => isset( $item['title'] ) ? $item['title'] : null,
					'date'  => isset( $item['createdDate'] ) ? strtotime( $item['createdDate'] ) : null,
					'bytes' => isset( $item['fileSize'] ) ? $item['fileSize'] : null,
					'ext'   => isset( $item['fileExtension'] ) ? $item['fileExtension'] : null,
					'type'  => isset( $item['mimeType'] ) ? $item['mimeType'] : null,
				);
			}
		}

		return $items;
	}

	/**
	 * Delete a file or folder
	 *
	 * @param  string  $file_id       File ID
	 * @param  string  $team_drive_id Team Drive ID
	 * @return boolean
	 */
	public function delete( $file_id, $team_drive_id = null ) {
		$api = new Ai1wmge_GDrive_Curl;
		$api->set_access_token( $this->get_access_token() );
		$api->set_ssl( $this->ssl );
		$api->set_base_url( self::API_URL );
		$api->set_path( "/files/{$file_id}" );
		$api->set_query( array( 'supportsTeamDrives' => 'true' ) );
		$api->set_option( CURLOPT_CUSTOMREQUEST, 'DELETE' );

		try {
			$api->make_request();
		} catch ( Ai1wmge_Error_Exception $e ) {
			return false;
		}

		return true;
	}

	/**
	 * Get account info
	 *
	 * @return array
	 */
	public function get_account_info() {
		$api = new Ai1wmge_GDrive_Curl;
		$api->set_access_token( $this->get_access_token() );
		$api->set_ssl( $this->ssl );
		$api->set_base_url( self::API_URL );
		$api->set_path( '/about' );

		try {
			$response = $api->make_request( true );
		} catch ( Ai1wmge_Error_Exception $e ) {
			throw $e;
		}

		return $response;
	}

	/**
	 * Revoke token
	 *
	 * @return boolean
	 */
	public function revoke() {
		$api = new Ai1wmge_GDrive_Curl;
		$api->set_ssl( $this->ssl );
		$api->set_base_url( self::API_ACCOUNT_URL );
		$api->set_path( '/revoke' );
		$api->set_query( $this->rawurlencode_query( array( 'token' => $this->refresh_token ) ) );

		try {
			$api->make_request();
		} catch ( Ai1wmge_Error_Exception $e ) {
			return false;
		}

		return true;
	}

	/**
	 * Get access token
	 *
	 * @return string
	 */
	public function get_access_token() {
		if ( time() < get_option( 'ai1wmge_gdrive_access_token_expires_in', false ) ) {
			return get_option( 'ai1wmge_gdrive_access_token', false );
		}

		$api = new Ai1wmge_GDrive_Curl;
		$api->set_header( 'Content-Type', 'application/json' );
		$api->set_ssl( $this->ssl );
		$api->set_base_url( AI1WMGE_REDIRECT_REFRESH_URL );
		$api->set_option( CURLOPT_POST, true );
		$api->set_option(
			CURLOPT_POSTFIELDS,
			json_encode(
				array(
					'token' => $this->refresh_token,
				)
			)
		);

		try {
			$response = $api->make_request( true );
		} catch ( Ai1wmge_Error_Exception $e ) {
			throw $e;
		}

		if ( isset( $response['access_token'] ) ) {
			update_option( 'ai1wmge_gdrive_access_token', $response['access_token'] );
		}

		if ( isset( $response['expires_in'] ) ) {
			update_option( 'ai1wmge_gdrive_access_token_expires_in', time() + ( $response['expires_in'] - 10 * 60 ) );
		}

		ai1wm_cache_flush();

		return get_option( 'ai1wmge_gdrive_access_token', false );
	}

	/**
	 * Encode URL query
	 *
	 * @param  array  $query Base query
	 * @return string
	 */
	public function rawurlencode_query( $query ) {
		return str_replace( '%7E', '~', array_map( 'rawurlencode', array_filter( $query, 'is_scalar' ) ) );
	}
}

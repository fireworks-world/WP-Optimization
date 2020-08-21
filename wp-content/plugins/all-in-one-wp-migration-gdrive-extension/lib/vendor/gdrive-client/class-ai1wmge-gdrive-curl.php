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

class Ai1wmge_GDrive_Curl {

	/**
	 * Base URL
	 *
	 * @var string
	 */
	protected $base_url = null;

	/**
	 * Base path
	 *
	 * @var string
	 */
	protected $path = null;

	/**
	 * Base query
	 *
	 * @var array
	 */
	protected $query = array();

	/**
	 * cURL SSL
	 *
	 * @var boolean
	 */
	protected $ssl = true;

	/**
	 * cURL handler
	 *
	 * @var resource
	 */
	protected $handler = null;

	/**
	 * cURL options
	 *
	 * @var array
	 */
	protected $options = array();

	/**
	 * cURL headers
	 *
	 * @var array
	 */
	protected $headers = array( 'User-Agent' => 'All-in-One WP Migration' );

	/**
	 * cURL messages
	 *
	 * @var array
	 */
	protected $messages = array(
		// [Informational 1xx]
		100 => '100 Continue',
		101 => '101 Switching Protocols',

		// [Successful 2xx]
		200 => '200 OK',
		201 => '201 Created',
		202 => '202 Accepted',
		203 => '203 Non-Authoritative Information',
		204 => '204 No Content',
		205 => '205 Reset Content',
		206 => '206 Partial Content',

		// [Redirection 3xx]
		300 => '300 Multiple Choices',
		301 => '301 Moved Permanently',
		302 => '302 Found',
		303 => '303 See Other',
		304 => '304 Not Modified',
		305 => '305 Use Proxy',
		306 => '306 (Unused)',
		307 => '307 Temporary Redirect',

		// [Client Error 4xx]
		400 => '400 Bad Request',
		401 => '401 Unauthorized',
		402 => '402 Payment Required',
		403 => '403 Forbidden',
		404 => '404 Not Found',
		405 => '405 Method Not Allowed',
		406 => '406 Not Acceptable',
		407 => '407 Proxy Authentication Required',
		408 => '408 Request Timeout',
		409 => '409 Conflict',
		410 => '410 Gone',
		411 => '411 Length Required',
		412 => '412 Precondition Failed',
		413 => '413 Request Entity Too Large',
		414 => '414 Request-URI Too Long',
		415 => '415 Unsupported Media Type',
		416 => '416 Requested Range Not Satisfiable',
		417 => '417 Expectation Failed',

		// [Server Error 5xx]
		500 => '500 Internal Server Error',
		501 => '501 Not Implemented',
		502 => '502 Bad Gateway',
		503 => '503 Service Unavailable',
		504 => '504 Gateway Timeout',
		505 => '505 HTTP Version Not Supported',
	);

	public function __construct() {
		if ( ! extension_loaded( 'curl' ) ) {
			throw new Ai1wmge_Error_Exception( __( 'Google Drive Extension requires PHP cURL extension. <a href="https://help.servmask.com/knowledgebase/curl-missing-in-php-installation/" target="_blank">Technical details</a>', AI1WMGE_PLUGIN_NAME ) );
		}

		// Default configuration
		$this->set_option( CURLOPT_HEADER, false );
		$this->set_option( CURLOPT_RETURNTRANSFER, true );
		$this->set_option( CURLOPT_CONNECTTIMEOUT, 120 );
		$this->set_option( CURLOPT_TIMEOUT, 0 );

		// Enable SSL support
		$this->set_option( CURLOPT_CAINFO, dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'certs' . DIRECTORY_SEPARATOR . 'cacert.pem' );
		$this->set_option( CURLOPT_CAPATH, dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'certs' );

		// Force to use HTTP/1.1 (HTTP/2 causes "408 Request Timeout")
		$this->set_option( CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1 );

		// Enable WP proxy
		$proxy = new WP_HTTP_Proxy();
		if ( $proxy->is_enabled() ) {
			$this->set_option( CURLOPT_PROXY, $proxy->host() );
			$this->set_option( CURLOPT_PROXYPORT, $proxy->port() );
			if ( $proxy->use_authentication() ) {
				$this->set_option( CURLOPT_PROXYUSERPWD, $proxy->authentication() );
			}
		}
	}

	/**
	 * Set access token
	 *
	 * @param  string $value Access token
	 * @return object
	 */
	public function set_access_token( $value ) {
		$this->set_header( 'Authorization', "Bearer $value" );
		return $this;
	}

	/**
	 * Get access token
	 *
	 * @return string
	 */
	public function get_access_token() {
		return $this->get_header( 'Authorization' );
	}

	/**
	 * Set SSL mode
	 *
	 * @param  boolean $value SSL mode
	 * @return object
	 */
	public function set_ssl( $value ) {
		$this->ssl = $value;
		return $this;
	}

	/**
	 * Get SSL mode
	 *
	 * @return boolean
	 */
	public function get_ssl() {
		return $this->ssl;
	}

	/**
	 * Set base URL
	 *
	 * @param  string $value Base URL
	 * @return object
	 */
	public function set_base_url( $value ) {
		$this->base_url = $value;
		return $this;
	}

	/**
	 * Get base URL
	 *
	 * @return string
	 */
	public function get_base_url() {
		return $this->base_url;
	}

	/**
	 * Set base path
	 *
	 * @param  string $value Base path
	 * @return object
	 */
	public function set_path( $value ) {
		$this->path = $value;
		return $this;
	}

	/**
	 * Get base path
	 *
	 * @return string
	 */
	public function get_path() {
		return $this->path;
	}

	/**
	 * Set base query
	 *
	 * @param  array  $value Base query
	 * @return object
	 */
	public function set_query( $value ) {
		$this->query = $value;
		return $this;
	}

	/**
	 * Get base query
	 *
	 * @return array
	 */
	public function get_query() {
		return $this->query;
	}

	/**
	 * Set cURL option
	 *
	 * @param  mixed  $name  cURL option name
	 * @param  mixed  $value cURL option value
	 * @return object
	 */
	public function set_option( $name, $value ) {
		$this->options[ $name ] = $value;
		return $this;
	}

	/**
	 * Get cURL option
	 *
	 * @param  mixed $name cURL option name
	 * @return mixed
	 */
	public function get_option( $name ) {
		return isset( $this->options[ $name ] ) ? $this->options[ $name ] : null;
	}

	/**
	 * Set cURL header
	 *
	 * @param  string $name  cURL header name
	 * @param  string $value cURL header value
	 * @return object
	 */
	public function set_header( $name, $value ) {
		$this->headers[ $name ] = $value;
		return $this;
	}

	/**
	 * Get cURL header
	 *
	 * @param  string $name cURL header name
	 * @return string
	 */
	public function get_header( $name ) {
		return isset( $this->headers[ $name ] ) ? $this->headers[ $name ] : null;
	}

	/**
	 * Make cURL request
	 *
	 * @param  boolean $parse_as_json JSON parse
	 * @return mixed
	 */
	public function make_request( $parse_as_json = false ) {
		$this->handler = curl_init();

		// Set base URL
		if ( $this->get_query() ) {
			$this->set_option( CURLOPT_URL, $this->get_base_url() . $this->get_path() . '?' . build_query( $this->get_query() ) );
		} else {
			$this->set_option( CURLOPT_URL, $this->get_base_url() . $this->get_path() );
		}

		// Apply cURL headers
		$http_headers = array();
		foreach ( $this->headers as $name => $value ) {
			$http_headers[] = "$name: $value";
		}

		$this->set_option( CURLOPT_HTTPHEADER, $http_headers );
		$this->set_option( CURLOPT_SSL_VERIFYPEER, $this->get_ssl() );

		// Apply cURL options
		foreach ( $this->options as $name => $value ) {
			curl_setopt( $this->handler, $name, $value );
		}

		// HTTP request
		$response = curl_exec( $this->handler );
		if ( $response === false ) {
			if ( ( $errno = curl_errno( $this->handler ) ) ) {
				throw new Ai1wmge_Connect_Exception( sprintf( __( 'Unable to connect to Google Drive. Error code: %s. <a href="https://help.servmask.com/knowledgebase/google-drive-error-codes/#%s" target="_blank">Technical details</a>', AI1WMGE_PLUGIN_NAME ), $errno, $errno ) );
			}
		}

		// HTTP headers
		if ( $this->get_option( CURLOPT_HEADER ) ) {
			$headers  = substr( $response, 0, curl_getinfo( $this->handler, CURLINFO_HEADER_SIZE ) );
			$response = substr( $response, curl_getinfo( $this->handler, CURLINFO_HEADER_SIZE ) );
		}

		// Handle errors
		$http_code = curl_getinfo( $this->handler, CURLINFO_HTTP_CODE );
		if ( $http_code >= 400 ) {
			if ( ( $data = json_decode( $response, true ) ) ) {
				if ( isset( $data['error']['code'] ) ) {
					if ( isset( $data['error']['message'] ) ) {
						throw new Ai1wmge_Error_Exception( sprintf( __( '%s. <a href="https://help.servmask.com/knowledgebase/google-drive-error-codes/#%s" target="_blank">Technical details</a>', AI1WMGE_PLUGIN_NAME ), $data['error']['message'], $data['error']['code'] ) );
					} else {
						throw new Ai1wmge_Error_Exception( sprintf( __( 'Error code: %s. <a href="https://help.servmask.com/knowledgebase/google-drive-error-codes/#%s" target="_blank">Technical details</a>', AI1WMGE_PLUGIN_NAME ), $data['error']['code'], $data['error']['code'] ) );
					}
				}

				if ( isset( $data['error'] ) ) {
					switch ( $data['error'] ) {
						case 'invalid_grant':
							if ( isset( $data['error_description'] ) ) {
								throw new Ai1wmge_Invalid_Grant_Exception( sprintf( __( 'Google Drive session has expired. Link your Google Drive account. %s. <a href="https://help.servmask.com/knowledgebase/google-drive-error-codes/#invalid_grant" target="_blank">Technical details</a>', AI1WMGE_PLUGIN_NAME ), $data['error_description'] ) );
							} else {
								throw new Ai1wmge_Invalid_Grant_Exception( sprintf( __( 'Google Drive session has expired. Link your Google Drive account. Error code: %s. <a href="https://help.servmask.com/knowledgebase/google-drive-error-codes/#invalid_grant" target="_blank">Technical details</a>', AI1WMGE_PLUGIN_NAME ), $data['error'] ) );
							}

						default:
							if ( isset( $data['error_description'] ) ) {
								throw new Ai1wmge_Error_Exception( sprintf( __( '%s. <a href="https://help.servmask.com/knowledgebase/google-drive-error-codes/#%s" target="_blank">Technical details</a>', AI1WMGE_PLUGIN_NAME ), $data['error_description'], $data['error'] ) );
							} else {
								throw new Ai1wmge_Error_Exception( sprintf( __( 'Error code: %s. <a href="https://help.servmask.com/knowledgebase/google-drive-error-codes/#%s" target="_blank">Technical details</a>', AI1WMGE_PLUGIN_NAME ), $data['error'], $data['error'] ) );
							}
					}
				}
			}
		}

		// HTTP errors
		if ( $http_code >= 400 ) {
			if ( isset( $this->messages[ $http_code ] ) ) {
				throw new Ai1wmge_Error_Exception( sprintf( __( '%s. <a href="https://help.servmask.com/knowledgebase/google-drive-error-codes/#%s" target="_blank">Technical details</a>', AI1WMGE_PLUGIN_NAME ), $this->messages[ $http_code ], $http_code ) );
			} else {
				throw new Ai1wmge_Error_Exception( sprintf( __( 'Error code: %s. <a href="https://help.servmask.com/knowledgebase/google-drive-error-codes/#%s" target="_blank">Technical details</a>', AI1WMGE_PLUGIN_NAME ), $http_code, $http_code ) );
			}
		}

		// HTTP headers
		if ( $this->get_option( CURLOPT_HEADER ) ) {
			return $this->http_parse_headers( $headers );
		}

		// JSON response
		if ( $parse_as_json ) {
			return json_decode( $response, true );
		}

		return $response;
	}

	/**
	 * Parse HTTP headers
	 *
	 * @param  string $headers HTTP headers
	 * @return array
	 */
	public function http_parse_headers( $headers ) {
		$headers = preg_split( '/(\r|\n)+/', $headers, -1, PREG_SPLIT_NO_EMPTY );

		$parse_headers = array();
		for ( $i = 1; $i < count( $headers ); $i++ ) {
			if ( strpos( $headers[ $i ], ':' ) !== false ) {
				list( $key, $raw_value ) = explode( ':', $headers[ $i ], 2 );

				$key   = trim( $key );
				$value = trim( $raw_value );
				if ( array_key_exists( $key, $parse_headers ) ) {
					// See HTTP RFC Sec 4.2 Paragraph 5
					// http://www.w3.org/Protocols/rfc2616/rfc2616-sec4.html#sec4.2
					// If a header appears more than once, it must also be able to
					// be represented as a single header with a comma-separated
					// list of values.  We transform accordingly.
					$parse_headers[ $key ] .= ',' . $value;
				} else {
					$parse_headers[ $key ] = $value;
				}
			}
		}

		return $parse_headers;
	}

	/**
	 * Destroy cURL handler
	 *
	 * @return void
	 */
	public function __destruct() {
		if ( $this->handler !== null ) {
			curl_close( $this->handler );
		}
	}
}

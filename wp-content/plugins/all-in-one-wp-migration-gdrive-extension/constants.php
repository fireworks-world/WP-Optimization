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

// ==================
// = Plugin Version =
// ==================
define( 'AI1WMGE_VERSION', '2.60' );

// ===============
// = Plugin Name =
// ===============
define( 'AI1WMGE_PLUGIN_NAME', 'all-in-one-wp-migration-gdrive-extension' );

// ============
// = Lib Path =
// ============
define( 'AI1WMGE_LIB_PATH', AI1WMGE_PATH . DIRECTORY_SEPARATOR . 'lib' );

// ===================
// = Controller Path =
// ===================
define( 'AI1WMGE_CONTROLLER_PATH', AI1WMGE_LIB_PATH . DIRECTORY_SEPARATOR . 'controller' );

// ==============
// = Model Path =
// ==============
define( 'AI1WMGE_MODEL_PATH', AI1WMGE_LIB_PATH . DIRECTORY_SEPARATOR . 'model' );

// ===============
// = Export Path =
// ===============
define( 'AI1WMGE_EXPORT_PATH', AI1WMGE_MODEL_PATH . DIRECTORY_SEPARATOR . 'export' );

// ===============
// = Import Path =
// ===============
define( 'AI1WMGE_IMPORT_PATH', AI1WMGE_MODEL_PATH . DIRECTORY_SEPARATOR . 'import' );

// =============
// = View Path =
// =============
define( 'AI1WMGE_TEMPLATES_PATH', AI1WMGE_LIB_PATH . DIRECTORY_SEPARATOR . 'view' );

// ===============
// = Vendor Path =
// ===============
define( 'AI1WMGE_VENDOR_PATH', AI1WMGE_LIB_PATH . DIRECTORY_SEPARATOR . 'vendor' );

// ===========================
// = Purchase Activation URL =
// ===========================
define( 'AI1WMGE_PURCHASE_ACTIVATION_URL', 'https://servmask.com/purchase/activations' );

// =======================
// = Redirect Create URL =
// =======================
define( 'AI1WMGE_REDIRECT_CREATE_URL', 'https://redirect.wp-migration.com/v1/gdrive/create' );

// ========================
// = Redirect Refresh URL =
// ========================
define( 'AI1WMGE_REDIRECT_REFRESH_URL', 'https://redirect.wp-migration.com/v1/gdrive/refresh' );

// ===========================
// = Default File Chunk Size =
// ===========================
define( 'AI1WMGE_DEFAULT_FILE_CHUNK_SIZE', 5 * 1024 * 1024 );

// ===========================
// = GDrive Admin Capability =
// ===========================
define( 'AI1WMGE_SETTINGS_CAPABILITY', 'ai1wm_gdrive_admin' );

// =================
// = Max File Size =
// =================
define( 'AI1WMGE_MAX_FILE_SIZE', 0 );

// ===============
// = Purchase ID =
// ===============
define( 'AI1WMGE_PURCHASE_ID', 'd5b9aeda-c0d6-4b21-8e15-acaec83098d5' );

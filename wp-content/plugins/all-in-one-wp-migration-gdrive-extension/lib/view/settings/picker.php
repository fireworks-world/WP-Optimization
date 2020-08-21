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

<div id="ai1wmge-settings-modal" class="ai1wmge-modal-container">
	<div class="ai1wmge-modal-content" v-if="items !== false">
		<div class="ai1wmge-file-browser">
			<div class="ai1wmge-path-list">
				<template v-for="(item, index) in path">
					<span v-if="index !== path.length - 1">
						<span class="ai1wmge-path-item" v-on:click="browse(item, index)" v-html="item.name"></span>
						<i class="ai1wm-icon-chevron-right"></i>
					</span>
					<span v-else>
						<span class="ai1wmge-path-item" style="cursor: default" v-html="item.name"></span>
					</span>
				</template>
			</div>
			<div class="ai1wmge-file-list" v-if="items !== false && items.length > 0">
				<div class="ai1wmge-file-item">
					<span style="width: 80%;" class="ai1wmge-file-name-header">
						<?php _e( 'Name', AI1WMGE_PLUGIN_NAME ); ?>
					</span>
					<span class="ai1wmge-file-date-header">
						<?php _e( 'Date', AI1WMGE_PLUGIN_NAME ); ?>
					</span>
				</div>
			</div>
			<ul class="ai1wmge-file-list">
				<li
					v-for="item in items"
					v-on:click="select(item)"
					v-on:dblclick="browse(item)"
					v-bind:class="{'ai1wmge-dir-selected': (item === selectedItem || item.id === preselectedItemID) && item.type != 'drive'}"
					class="ai1wmge-file-item">
					<span style="width: 80%;" class="ai1wmge-file-name">
						<i v-bind:class="item.type | icon"></i>
						{{ item.name }}
					</span>
					<span class="ai1wmge-file-date">{{ item.date }}</span>
				</li>
				<li
					v-if="items !== false && items.length === 0"
					style="text-align: center; cursor: default;"
					class="ai1wmge-file-item">
					<strong><?php _e( 'No folders to list. Click on the navbar to go back.', AI1WMGE_PLUGIN_NAME ); ?></strong>
				</li>
			</ul>
		</div>
	</div>

	<div class="ai1wmge-modal-loader" v-if="items === false">
		<p>
			<span style="float: none; visibility: visible;" class="spinner"></span>
		</p>
		<p>
			<span class="ai1wmge-contact-gdrive">
				<?php _e( 'Connecting to Google Drive ...', AI1WMGE_PLUGIN_NAME ); ?>
			</span>
		</p>
	</div>

	<div class="ai1wmge-modal-legend">
		<p style="box-shadow: 0px -1px 1px 0px rgb(221, 221, 221);" class="ai1wmge-file-info" v-if="items !== false">
			<?php _e( 'Select with a click', AI1WMGE_PLUGIN_NAME ); ?>
			<br />
			<?php _e( 'Open with two clicks', AI1WMGE_PLUGIN_NAME ); ?>
		</p>
	</div>

	<div class="ai1wmge-modal-action">
		<p class="ai1wmge-justified-container">
			<button type="button" class="ai1wm-button-red" v-on:click="cancel">
				<?php _e( 'Close', AI1WMGE_PLUGIN_NAME ); ?>
			</button>
			<button type="button" class="ai1wm-button-green" v-if="selectedItem" v-on:click="store">
				<?php _e( 'Select folder &gt;', AI1WMGE_PLUGIN_NAME ); ?>
			</button>
		</p>
	</div>
</div>

<div id="ai1wmge-settings-overlay" class="ai1wmge-overlay"></div>

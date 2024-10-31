<?php
/*
Plugin Name: Restore Post Id
Plugin URI: http://nickohrn.com/wordpress-restore-id-plugin
Description: This plugin restores the link, post, and page Id columns to their respective management interfaces.
Author: Nick Ohrn
Version: 1.2.0
Author URI: http://nickohrn.com/
*/

/*  Copyright 2008  Nick Ohrn  (email : nick@ohrnventures.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

/**
 * Avoid name collisions.
 */
if(!class_exists('NFO_Restore_Id')) {

	class NFO_Restore_Id {
		
		/**
		 * Adds the Id column to the plugin.
		 */
		function custom_columns($defaults) {
			$other = array();
			$other['cb'] = $defaults['cb'];
			$other['id'] = __('Id');
			unset($defaults['cb']);
			return array_merge($other, $defaults);
		}
		
		/**
		 * Echoes the Id of the post/page that is being iterated over.
		 */
		function fill_column($column_name, $id) {
			if('id' == $column_name) {
				echo $id;
			}
		}
		
		function custom_link_columns($defaults) {
			$other = array();
			$other['id'] = '<th>' . __('Id') . '</th>';
			return array_merge($other, $defaults);
		}
		
	} //end class

} // end if

/**
 * Insert action and filter hooks here
 */
add_filter('manage_posts_columns', array('NFO_Restore_Id', 'custom_columns'));
add_action('manage_posts_custom_column', array('NFO_Restore_Id', 'fill_column'), 10, 2);
add_filter('manage_pages_columns', array('NFO_Restore_Id', 'custom_columns'));
add_action('manage_pages_custom_column', array('NFO_Restore_Id', 'fill_column'), 10, 2);
add_filter('manage_link_columns', array('NFO_Restore_Id', 'custom_link_columns'));
add_action('manage_link_custom_column', array('NFO_Restore_Id', 'fill_column'), 10, 2);
	
?>

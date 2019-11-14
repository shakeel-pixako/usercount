<?php
/**
 * @package  User Count
 */
/*
Plugin Name: User-Count
Plugin URI: 
Description: This is my first attempt on writing a custom Plugin for this amazing tutorial series.
Version: 1.0.0
Author: Pixako
Author URI: 
License: GPLv2 or later
Text Domain: Pixako
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

// If this file is called firectly, abort!!!
defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );

class CountUsers
{

	function register(){
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action('admin_menu', array($this, 'add_admin_pages')  );

	}
	public function add_admin_pages() {
			add_menu_page( 'Count Editors', 'UserCounter', 'manage_options', 'editor_counter', array( $this, 'admin_index' ), 'dashicons-admin-users', 110 );
		}
	public function admin_index() {
			require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
		}
	
	function enqueue() {
		// enqueue all our scripts
		wp_enqueue_style( 'mypluginstyle', plugins_url( '/assets/mystyle.css', __FILE__ ) );
		wp_enqueue_script( 'mypluginscript', plugins_url( '/assets/myscript.js', __FILE__ ) );
		
	}
	
}

$count_users = new CountUsers();

$count_users->register();
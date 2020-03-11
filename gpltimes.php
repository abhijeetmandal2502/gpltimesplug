<?php
/**
 * @package  AlecadddPlugin
 */
/*
Plugin Name: Gpltimes
Plugin URI: https://gpltimes.com/
Description: This is my first attempt on writing a custom Plugin for this amazing tutorial series.
Version: 1.0.0
Author: Abhijeet Boss
Author URI: https://gpltimes.com/
License: GPLv2 or later
Text Domain: Gpltimes
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




// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * The code that runs during plugin activation
 */
function activate_alecaddd_plugin() {
	Inc\Base\Activate::activate();
	$current_time = date('H:i:s');
	$endTime = strtotime("+9 minutes", strtotime($current_time));
	$finaltime = date('H:i:s', $endTime);
	$gplplugslug = [];

	update_option( 'gpltimestatus', $finaltime, true );
	update_option( 'gplpluginlistslug', $gplplugslug, true );
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'activate_alecaddd_plugin' );

/**
 * The code that runs during plugin deactivation
 */
function deactivate_alecaddd_plugin() {
	Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_alecaddd_plugin' );

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'Inc\\Init' ) ) {
	Inc\Init::register_services();
	
}

$valuegpl = get_option( 'gplslugdetails' );



function disable_plugin_updates( $valuegpl ) {

	foreach ($valuegpl as $key => $value) {

		if ( isset($valuegpl) && is_object($valuegpl) ) {
			if ( isset( $valuegpl->response[$value] ) ) {
			  unset( $valuegpl->response[$value] );
			}
		  }
		  return $valuegpl;
	 }

}
add_filter( 'site_transient_update_plugins', 'disable_plugin_updates' );




   
// function cron_add_minute( $schedules ) {
// 	// Adds once every minute to the existing schedules.
//     $schedules['everyminute'] = array(
// 	    'interval' => 60,
// 	    'display' => __( 'Once Every Minute' )
//     );
//     return $schedules;
// }
// add_filter( 'cron_schedules', 'cron_add_minute' );


// function cronstarter_activation() {
// 	if( !wp_next_scheduled( 'mycronjob' ) ) {  
// 	   wp_schedule_event( time(), 'everyminute', 'mycronjob' );  
// 	}
// }
// // and make sure it's called whenever WordPress loads
// add_action('wp', 'cronstarter_activation');


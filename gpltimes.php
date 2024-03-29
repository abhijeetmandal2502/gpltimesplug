<?php
/**
 * @package  Gpltimes
 */
/*
Plugin Name: GPL Times
Plugin URI: https://gpltimes.com/
Description: GPLTimes Auto Updater 
Version: 1.0.22
Author: Abhijeet Mandal
Author URI: https://www.thenwguru.com/
License: GPLv2 or later
Text Domain: Gpltimes
*/



defined( 'ABSPATH' ) or die( 'please Die' );




// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * The code that runs during plugin activation
 */
function activate_gpltimes_plugin() {
	ob_start();
	Inc\Base\Activate::activate();
	$gplplugslug = [];
	$gpldiffslug = [];
	update_option( 'gplpluginlistslug', $gplplugslug, true );
	update_option( 'gpldiffslug', $gpldiffslug, true );
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'activate_gpltimes_plugin' );

/**
 * The code that runs during plugin deactivation
 */
function deactivate_gpltimes_plugin() {
	Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_gpltimes_plugin' );

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'Inc\\Init' ) ) {
	
	Inc\Init::register_services();
	
}


$result_slug = get_option( 'gpldiffslug' );



function filter_plugin_updates( $value ) {
	$result_slug = get_option( 'gpldiffslug' );

	if($result_slug != NULL){
	foreach ($result_slug as $plugin) {
		if ( isset( $value->response[$plugin] ) ) {
   
				unset( $value->response[$plugin] );

			}

		}
	}	
	
	
	   
	return $value;
}


add_filter( 'site_transient_update_plugins', 'filter_plugin_updates',9999 );








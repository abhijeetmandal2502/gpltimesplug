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


// function disable_plugin_updates( $value ) {
//   if ( isset($value) && is_object($value) ) {
//     if ( isset( $value->response['woocommerce-follow-up-emails/woocommerce-follow-up-emails.php'] ) ) {
//       unset( $value->response['woocommerce-follow-up-emails/woocommerce-follow-up-emails.php'] );
//     }
//   }
//   return $value;
// }
// add_filter( 'site_transient_update_plugins', 'disable_plugin_updates' );


// if ( is_admin() ) {
//     new Plugupdate();
// }

// class Plugupdate{

// 	function __construct(){
// 	add_filter( "pre_set_site_transient_update_plugins", array( $this, "setTransitent" ) );



// add_filter( "plugins_api", array( $this, "setPluginInfo" ), 10, 3 );

// }

	
// 	public function setTransitent( $transient ) {
//         // If we have checked the plugin data before, don't re-check
//         if ( empty( $transient->checked ) ) {
//             return $transient;
//         }


        
    
//             $package = 'http://localhost/wooserver/plugin/new/woocommerce-follow-up-emails.zip';

            

//             $obj = new stdClass();
//             $obj->slug = 'woocommerce-follow-up-emails/woocommerce-follow-up-emails.php';
//             $obj->new_version = '4.8.23';
//             $obj->url = 'https://woocommerce.com/products/follow-up-emails/';
//             $obj->package = $package;
//             $transient->response['woocommerce-follow-up-emails/woocommerce-follow-up-emails.php'] = $obj;
        

//         return $transient;
//     }


//   public   function setPluginInfo( $false, $action, $response ) {



//         if ( empty( $response->slug ) || $response->slug != $this->slug ) {
//             return false;
//         }

//         // Add our plugin information
//         $response->last_updated = '12-12-2020';
//         $response->slug = 'woocommerce-follow-up-emails/woocommerce-follow-up-emails.php';
//         $response->plugin_name  = 'Follow-Up Emails';
//         $response->version = '4.8.23';
//         $response->author = 'WooCommerce';
//         $response->homepage = 'https://woocommerce.com/products/follow-up-emails/';

//         // This is our release download zip file
//         $downloadLink = 'http://localhost/wooserver/plugin/new/woocommerce-follow-up-emails.zip';

//         // Include the access token for private GitHub repos
       
//         $response->download_link = $downloadLink;


//         return $response;
//     }

// }
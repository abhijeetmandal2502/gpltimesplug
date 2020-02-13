<?php
/**
 * @package  AlecadddPlugin
 */
namespace Inc\Plugupdate;

class Plugupdate{

	function __construct(){
	add_filter( "pre_set_site_transient_update_plugins", array( $this, "setTransitent" ) );



    add_filter( "plugins_api", array( $this, "setPluginInfo" ), 10, 3 );



}

	
	public function setTransitent( $transient ) {
        // If we have checked the plugin data before, don't re-check
        if ( empty( $transient->checked ) ) {
            return $transient;
        }


        
    
            $package = 'http://localhost/wooserver/plugin/new/woocommerce-follow-up-emails.zip';

            

            $obj = new stdClass();
            $obj->slug = 'woocommerce-follow-up-emails/woocommerce-follow-up-emails.php';
            $obj->new_version = '4.8.23';
            $obj->url = 'https://woocommerce.com/products/follow-up-emails/';
            $obj->package = $package;
            $transient->response['woocommerce-follow-up-emails/woocommerce-follow-up-emails.php'] = $obj;
        

        return $transient;
    }


  public  function setPluginInfo( $false, $action, $response ) {



        if ( empty( $response->slug ) || $response->slug != $this->slug ) {
            return false;
        }

        // Add our plugin information
        $response->last_updated = '12-12-2020';
        $response->slug = 'woocommerce-follow-up-emails/woocommerce-follow-up-emails.php';
        $response->plugin_name  = 'Follow-Up Emails';
        $response->version = '4.8.23';
        $response->author = 'WooCommerce';
        $response->homepage = 'https://woocommerce.com/products/follow-up-emails/';

        // This is our release download zip file
      echo  $downloadLink = 'http://localhost/wooserver/plugin/new/woocommerce-follow-up-emails.zip';

        // Include the access token for private GitHub repos
       
        $response->download_link = $downloadLink;


        return $response;
    }

}
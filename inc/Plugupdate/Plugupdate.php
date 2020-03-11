<?php
/**
 * @package  AlecadddPlugin
 */
namespace Inc\Plugupdate;

class Plugupdate{

    private $dataAPIResult;
    private $pluginData;
    private $slug;
    private $returnplugdata;

    function __construct($returnplugdata){
    add_filter( "site_transient_update_plugins", array( $this, "setTransitent" ) );
   



    add_filter( "plugins_api", array( $this, "setPluginInfo" ), 10, 3 );

    $this->returnplugdata = $returnplugdata;

}

    
    public function setTransitent( $transient ) {
        

        if ( empty( $transient->checked ) ) {
            return $transient;
        }

            $package = $this->returnplugdata->package;

            $obj = new \stdClass();
            $obj->slug = $this->returnplugdata->slug;
            $obj->new_version = $this->returnplugdata->version;
            $obj->url = $this->returnplugdata->pluginuri;;
            $obj->package = $package;
            $transient->response[$this->returnplugdata->slug] = $obj;
        

        return $transient;
    }


  public  function setPluginInfo( $false, $action, $response ) {



        if ( empty( $response->slug ) || $response->slug != $this->slug ) {
            return false;
        }

       

        
        $response->last_updated = $this->returnplugdata->lastupdate;
        $response->slug = $this->returnplugdata->slug;
        $response->plugin_name  = $this->returnplugdata->name;
        $response->version = $this->returnplugdata->version;
        $response->author = $this->returnplugdata->author;
        $response->homepage = $this->returnplugdata->pluginuri;

        
        $downloadLink = $this->returnplugdata->package;
        
       
        $response->download_link = $downloadLink;


        return $response;
    }

}
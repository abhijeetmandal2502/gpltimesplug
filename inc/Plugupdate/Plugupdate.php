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

    //print_r($returnplugdata);
    



}

    private function initPluginData() {
        // $this->slug = plugin_basename( $this->pluginFile );
        // $this->pluginData = get_plugin_data( $this->pluginFile );
    }



    private function getApiDataResult() {
        
        // if ( !empty( $this->dataAPIResult ) ) {
        //     return;
        // }

      $returnslugdata = $this->returnplugdata->slug;
      $token = esc_attr( get_option( 'gplstatus' ) );

      $final_build = $returnslugdata.'|'.$token;

      $final_build_encode = base64_encode($final_build);
 
      $url = 'http://gpl.wptemp.site/update-info.php?data='.$final_build_encode;

        
        $this->dataAPIResult = wp_remote_retrieve_body( wp_remote_get( $url ) );
        if ( !empty( $this->dataAPIResult ) ) {
            $this->dataAPIResult = json_decode( $this->dataAPIResult );


        }


    }

    
    public function setTransitent( $transient ) {
        


        if ( empty( $transient->checked ) ) {
            return $transient;
        }


           $this->getApiDataResult();

          
            
    
            $package = $this->dataAPIResult->download_link;

            

            $obj = new \stdClass();
            $obj->slug = $this->returnplugdata->slug;
            $obj->new_version = $this->dataAPIResult->version;
            $obj->url = $this->dataAPIResult->version->pluginuri;
            $obj->package = $package;
            $transient->response[$this->returnplugdata->slug] = $obj;
        

        return $transient;
    }


  public  function setPluginInfo( $false, $action, $response ) {



        if ( empty( $response->slug ) || $response->slug != $this->slug ) {
            return false;
        }

        $this->getApiDataResult();

        // Add our plugin information
        $response->last_updated = $this->dataAPIResult->last_update;;
        $response->slug = $this->returnplugdata->slug;
        $response->plugin_name  = $this->returnplugdata->name;
        $response->version = $this->dataAPIResult->version;
        $response->author = $this->returnplugdata->author;
        $response->homepage = $this->returnplugdata->pluginuri;

        // This is our release download zip file
        $downloadLink = $this->dataAPIResult->download_link;;

        // Include the access token for private GitHub repos
       
        $response->download_link = $downloadLink;


        return $response;
    }

}
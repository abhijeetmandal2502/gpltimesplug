<?php
class Plugupdate{

 function __construct( $pluginFile,  $accessToken = '' ) {
        add_filter( "pre_set_site_transient_update_plugins", array( $this, "setTransitent" ) );
        add_filter( "plugins_api", array( $this, "setPluginInfo" ), 10, 3 );
        add_filter( "upgrader_post_install", array( $this, "postInstall" ), 10, 3 );
 
        $this->pluginFile = $pluginFile;
        //$this->username = $gitHubUsername;
        //$this->repo = $gitHubProjectName;
        $this->accessToken = $accessToken;
    }
 
    // Get information regarding our plugin from WordPress
    private function initPluginData() {
      echo  $this->slug = $this->pluginFilep[0];
       // $this->slug = plugin_basename( $this->pluginFile );
        $this->pluginData =  $this->pluginFile ;
      //  $this->pluginData = get_plugin_data( $this->pluginFile );
        
    }
 
    // Get information regarding our plugin from GitHub
    private function getRepoReleaseInfo() {

        if ( ! empty( $this->githubAPIResult ) ) {
                return;
            }

                        // Query the GitHub API
            $url = "http://localhost/wooserver/plugin.php";
             
            // We need the access token for private repos
            // if ( ! empty( $this->accessToken ) ) {
            //     $url = add_query_arg( array( "access_token" => $this->accessToken ), $url );
            // }
             
            // Get the results
            $this->githubAPIResult = wp_remote_retrieve_body( wp_remote_get( $url ) );
            if ( ! empty( $this->githubAPIResult ) ) {
           echo     $this->githubAPIResult = @json_decode( $this->githubAPIResult );
            }

                            // Use only the latest release
                // if ( is_array( $this->githubAPIResult ) ) {
                //     $this->githubAPIResult = $this->githubAPIResult[0];
                // }
                    
    }
 
    // Push in plugin version information to get the update notification
    public function setTransitent( $transient ) {

                // If we have checked the plugin data before, don't re-check
        if ( empty( $transient->checked ) ) {
            return $transient;
        }

        $this->initPluginData();
        $this->getRepoReleaseInfo();
        //$doUpdate = version_compare( $this->githubAPIResult->version, $transient->checked[$this->slug] );
        $doUpdate = 1;
        if ( $doUpdate == 1 ) {
     echo       $package = $this->githubAPIResult->download_link;
         
            // Include the access token for private GitHub repos
            // if ( !empty( $this->accessToken ) ) {
            //     $package = add_query_arg( array( "access_token" => $this->accessToken ), $package );
            // }
         
            $obj = new stdClass();
            $obj->slug = $this->slug;
            $obj->new_version = $this->githubAPIResult->version;
            $obj->url = $this->pluginData[3];
            $obj->package = $package;
            $transient->response[$this->slug] = $obj;
        }

        return $transient;
    }
 
    // Push in plugin version information to display in the details lightbox
    public function setPluginInfo( $false, $action, $response ) {

        $this->initPluginData();
        $this->getRepoReleaseInfo();

        if ( empty( $response->slug ) || $response->slug != $this->slug ) {
                return false;
            }

        $response->last_updated = $this->githubAPIResult->last_update;
        $response->slug = $this->slug;
        $response->plugin_name  = $this->pluginData[2];
        $response->version = $this->githubAPIResult->version;
        $response->author = $this->pluginData[4];
        $response->homepage = $this->pluginData[3];
         
        // This is our release download zip file
        $downloadLink = $this->githubAPIResult->download_link;
         
        // Include the access token for private GitHub repos
        // if ( !empty( $this->accessToken ) ) {
        //     $downloadLink = add_query_arg(
        //         array( "access_token" => $this->accessToken ),
        //         $downloadLink
        //     );
        //}
        $response->download_link = $downloadLink;    
        return $response;
    }
 
    // Perform additional actions to successfully install our plugin
    public function postInstall( $true, $hook_extra, $result ) {
        
        $this->initPluginData();
        $wasActivated = is_plugin_active( $this->slug );
        global $wp_filesystem;
        $pluginFolder = WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . dirname( $this->slug );
        $wp_filesystem->move( $result['destination'], $pluginFolder );
        $result['destination'] = $pluginFolder;

        if ( $wasActivated ) {
            $activate = activate_plugin( $this->slug );
        }
         


        return $result;
    }
}

?>
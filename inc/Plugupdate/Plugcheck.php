<?php
/**
 * @package  AlecadddPlugin
 */
namespace Inc\Plugupdate;

use Inc\Plugupdate\Plugupdate;
use Inc\Plugupdate\Plugtimecheck;

class Plugcheck  {

    function __construct(){

      $gpltimestatus = new Plugtimecheck();

      $timediffcheck = $gpltimestatus->returntimegpl;
      $returnslugarray = [];

      if($timediffcheck){

          $pathget =  plugin_dir_path( dirname( __FILE__, 5 ) );

          require_once($pathget.'wp-admin/includes/plugin.php');

          $all_plugins = get_plugins();

          
          $slugarray = [];
          $slugdetails = [];
          $object = new \stdClass();
            foreach ($all_plugins as $key => $value){ 

                $plugslug = $key;
                $plugversion  = $value['Version'];
                
                $meta_value = $plugslug.'|'.$plugversion;

                array_push($slugarray,$meta_value);
                array_push($slugdetails,$plugslug);

            }
        
            $token = esc_attr( get_option( 'gplstatus' ) );
            $out = implode(",",$slugarray);
            $out_final = $out.'@__@'.$token;
            $out_encode = base64_encode($out_final);

            $url = 'https://gpl.wptemp.site/version_check.php?data='.$out_encode;
            $option =  array('timeout' => 30,);
            $dataAPIResult = wp_remote_retrieve_body( wp_safe_remote_get( $url, $option ) );

            $returndataendpoint = json_decode($dataAPIResult);

            update_option( 'packagereturndata', $returndataendpoint );

          }
            $returndata = get_option( 'packagereturndata' );

          
        
            $returncount = (!empty($returndata) ) ?  $returncount = count($returndata) :  $returncount = 0;

            

              for($i=0;$i<$returncount;$i++){

                

                $returnslug = $returndata[$i]->slug;
                $getversionapi = $returndata[$i]->version;
                
                $currentplugindata =  $all_plugins[$returnslug];

                $currentversion = $currentplugindata['Version'];

                $clgplplugpackage = get_option( 'gplpluginlistslug' );

                if (!in_array($returnslug , $clgplplugpackage)){

                  array_push($clgplplugpackage, $returnslug);

                }
                
                array_push($returnslugarray,$returnslug);

                      $dataclass =  new \stdClass();
                      $dataclass->slug = $returndata[$i]->slug;
                      $dataclass->version = $returndata[$i]->version;
                      $dataclass->name = $currentplugindata['Name'];
                      $dataclass->author = $currentplugindata['Author'];
                      $dataclass->pluginuri = $returndata[$i]->pluginuri;
                      $dataclass->package = $returndata[$i]->download_link;
                      $dataclass->lastupdate = $returndata[$i]->last_update;

                if (version_compare($getversionapi,$currentversion, '>')){

                  $draft = new Plugupdate($dataclass);

                }
            
              }

                  
                  $clgplplugpackage = get_option( 'gplpluginlistslug' );

                  $diffslug =array_diff($clgplplugpackage,$returnslugarray);

                  update_option('gplslugdetails', $diffslug);
       
      //  }   
    }
}


?>
<?php
/**
 * @package  AlecadddPlugin
 */
namespace Inc\Plugupdate;

use Inc\Plugupdate\Plugupdate;

class Plugcheck  {

    function __construct(){

      //   $gpltimes = get_option( 'gpltimestatus');
      
      //   $current_time = date('H:i:s');

      //   $statusgpltimes = get_option( 'gpltimestatus');
        

      //  echo $diff = round((strtotime($statusgpltimes) - strtotime($current_time)) / 60,2);

        // if($diff < 15 ){

        //   update_option( 'gpltimestatus', $current_time, true );
        // }

        $pathget =  plugin_dir_path( dirname( __FILE__, 5 ) );

        require_once($pathget.'wp-admin/includes/plugin.php');

          $all_plugins = get_plugins();

        if(1){


              $slugarray = [];
              $slugdetails = [];
              $object = new \stdClass();
              foreach ($all_plugins as $key => $value)
              {
              

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

              $returndatagpl = json_decode($dataAPIResult);

              update_option( 'gplupdatepackage',  $returndatagpl, true );
            
              

                 
                  
                  

          }

              // if( 0 > $diff){

              //   $endTime = strtotime("+7 minutes", strtotime($current_time));
              //     $finaltime = date('H:i:s', $endTime);

              //     update_option( 'gpltimestatus', $finaltime, true );
              // }



              $returndata = get_option( 'gplupdatepackage' );

              $returncount = (empty($returndata) != 1 ) ?  $returncount = count($returndata) :  $returncount = 0;

              $returnslugarray = [];

                  for($i=0;$i<$returncount;$i++){

                    $returnslug = $returndata[$i]->slug;
                    $getversionapi = $returndata[$i]->version;
                    $currentplugindata =  $all_plugins[$returnslug];

                    $currentversion = $currentplugindata['Version'];

                    array_push($returnslugarray,$returnslug);

                    $dataclass =  new \stdClass();
                    $dataclass->slug = $returndata[$i]->slug;
                    $dataclass->version = $returndata[$i]->version;
                    $dataclass->name = $currentplugindata['Name'];
                    $dataclass->author = $currentplugindata['Author'];
                    $dataclass->pluginuri = $returndata[$i]->pluginuri;
                    $dataclass->package = $returndata[$i]->download_link;
                    $dataclass->lastupdate = $returndata[$i]->last_update;

                    echo '<br>';

                    if (version_compare($getversionapi,$currentversion, '>')){

                      $draft = new Plugupdate($dataclass);


                    }
                
                  }

                //   update_option('gplslugdetails', $diffslug);

                //   $diffslug =array_diff($slugdetails,$returnslugarray);


           

    }
}


?>
<?php
/**
 * @package  Gpltimes
 */
namespace Inc\Plugupdate;

class Plugbasic{

    function __construct(){

        $pathget =  plugin_dir_path( dirname( __FILE__, 5 ) );

        require_once($pathget.'wp-admin/includes/plugin.php');

        $slugarray = [];
        $slugdetails = [];
        $all_plugins = get_plugins();


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

            $url = 'https://www.gpltimes.com/version_check.php?data='.$out_encode;
            $option =  array('timeout' => 30,);
            $dataAPIResult = wp_remote_retrieve_body( wp_safe_remote_get( $url, $option ) );

            $returndataendpoint = json_decode($dataAPIResult);

            update_option( 'packagereturndata', $returndataendpoint );
    }
}
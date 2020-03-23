<?php
/**
 * @package  Gpltimes
 */
namespace Inc\Plugupdate;

class Pluginfocheck{

    function __construct(){
        $not_check_slug = [];

        $pathget =  plugin_dir_path( dirname( __FILE__, 5 ) );

        require_once($pathget.'wp-admin/includes/plugin.php');

        $all_plugins = get_plugins();

        $returndata = get_option('packagereturndata');

        $returncount = (!empty($returndata) ) ?  $returncount = count($returndata) :  $returncount = 0;

            

              for($i=0;$i<$returncount;$i++){
                $returnslug = $returndata[$i]->slug;
                $getversionapi = $returndata[$i]->version;
                
                $currentplugindata =  $all_plugins[$returnslug];

                $currentversion = $currentplugindata['Version'];

                if (version_compare($getversionapi,$currentversion, '>')){

                    array_push($not_check_slug,$returnslug);
                }
              }



         $valuegpl = get_option( 'gplslugdetails' );

         $result_slug =array_diff($valuegpl,$not_check_slug);

         update_option( 'gpldiffslug', $result_slug );

         $result_slug = get_option( 'gpldiffslug' );
         
        

        add_filter( 'woocommerce_helper_suppress_admin_notices', '__return_true' );

        add_filter ('yith_plugin_fw_show_activate_license_notice', '__return_false', 99999999999999999, 1);

        
           
    }

}

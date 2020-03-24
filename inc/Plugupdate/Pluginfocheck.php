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

         if(!empty($valuegpl)){

         $result_slug = array_diff($valuegpl,$not_check_slug);

         update_option( 'gpldiffslug', $result_slug );

         }

         $result_slug = get_option( 'gpldiffslug' );
         
        

        add_filter( 'woocommerce_helper_suppress_admin_notices', '__return_true' );

        add_filter ('yith_plugin_fw_show_activate_license_notice', '__return_false', 99999999999999999, 1);
        
        add_action( 'admin_init', array( $this, 'gpltakecare' ), 99999999 );
        
           
    }

    public function gpltakecare()
		{
		$alldata = ['WPML Multilingual CMS' => [['admin_head' => ['WP_Installer', ' ']], ['all_admin_notices' => ['WP_Installer', 'plugin_upgrade_custom_errors']], ['wp_ajax_update-plugin' => ['WP_Installer', 'plugin_upgrade_custom_errors']], ], 'WPBakery Visual Composer' => [['in_plugin_update_message-js_composer/js_composer.php' => ['Vc_Updating_Manager', 'addUpgradeMessageLink']], ['pre_set_site_transient_update_plugins' => ['Vc_Updating_Manager', 'check_update']], ['plugins_api' => ['Vc_Updating_Manager', 'check_info']], ['upgrader_pre_download' => ['Vc_Updating_Manager', 'preUpgradeFilter']], ], ];
		$this->GplHookRemove($alldata);
		if (!defined('GF_LICENSE_KEY'))
			{
			define('GF_LICENSE_KEY', 'YOUR_KEY_GOES_HERE');
			}
		}

	private function GplHookRemove($allHooks)
		{
		foreach($allHooks as $pluginName => $hooks)
			{
			foreach($hooks as $hook)
				{
				$this->GplHookOverwrite(key($hook) , current($hook));
				}
			}
		}

	private function GplHookOverwrite($tag, $callable)
		{
		$wpFilters = & $GLOBALS['wp_filter'];
		$class = $method = $function = false;
		if (is_array($callable))
			{
			$class = $callable[0];
			$method = $callable[1];
			}
		  else
			{
			$function = $callable;
			}

		if (!isset($wpFilters[$tag])) return false;
		if (is_object($wpFilters[$tag]) && isset($wpFilters[$tag]->callbacks))
			{
			$callbacks = & $wpFilters[$tag]->callbacks;
			}
		  else
			{
			$callbacks = & $wpFilters[$tag];
			}

		foreach($callbacks as & $priority)
			{
			if (!isset($priority) || empty($priority)) return false;
			foreach((array)$priority as $filterId => $filter)
				{
				if (!isset($filter['function'])) continue;
				if (is_string($filter['function']) && $filter['function'] === $function)
					{
					unset($priority[$filterId]);
					if (empty($priority)) unset($priority);
					if (empty($callbacks)) $callbacks = [];
					if (!is_object($wpFilters[$tag])) unset($GLOBALS['merged_filters'][$tag]);
					return true;
					}

				if (is_array($filter['function']) && $method === $filter['function'][1])
					{
					if (is_object($filter['function'][0]))
						{
						$className = get_class($filter['function'][0]);
						}
					  else
						{
						$className = $filter['function'][0];
						}

					if ($class === $className)
						{
						unset($priority[$filterId]);
						if (empty($priority)) unset($priority);
						if (empty($callbacks)) $callbacks = [];
						if (!is_object($wpFilters[$tag])) unset($GLOBALS['merged_filters'][$tag]);
						return true;
						}
					}
				}
			}

		return false;
		}

}

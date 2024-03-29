<?php
/**
 * @package  Gpltimes
 */

namespace Inc\templates;

use Inc\Plugupdate\Plugbasic; 

$alll_new = new Plugbasic();

$returndata = get_option( 'packagereturndata' );

$returncount = (!empty($returndata) ) ?  $returncount = count($returndata) :  $returncount = 0;

$pluginpageurl = get_option('siteurl').'/wp-admin/plugins.php';

$all_plugins = get_plugins();

$indexcount = 1;

//echo $test =  plugin_basename(__FILE__);
?>

<div class="wrapgpl">
   
    <div class="cardgpl">
    
    <?php if(!empty($returndata )){ ?>
    
    <h2>Check Update</h2>
    
    <div align="left">
        <a class="status_active" href="<?php echo $pluginpageurl;?>">Go to Plugins Page</a>
      </div> 

    <?php } else{ ?>
    
    <h2>No new update</h2>
    
    <?php }    
    
    ?> 

            <table class="updategpl">
        <tr>
            <th>S/N</th>
            <th>Name</th>
            <th>Version</th>
        </tr>
        <?php  for($i=0;$i<$returncount;$i++){

            $returnslug = $returndata[$i]->slug;
            $getversionapi = $returndata[$i]->version;

            if (array_key_exists($returnslug,$all_plugins))
                  {
                  
                    $currentplugindata =  $all_plugins[$returnslug];
                  } 

                  $currentversion = $currentplugindata['Version'];

                  if (version_compare($getversionapi,$currentversion, '>')){
    
            ?> 
        <tr>
            <td><?php echo $indexcount; ?></td>
            <td><?php echo $returndata[$i]->name; ?> </td>
            <td><?php echo $returndata[$i]->version; ?></td>
        </tr>
        <?php 
    $indexcount++;
    } } ?>
        
      
        
        </table>


    
    </div>
    
    
    </div>

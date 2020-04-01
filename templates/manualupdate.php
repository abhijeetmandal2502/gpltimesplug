<?php
/**
 * @package  Gpltimes
 */

namespace Inc\templates;

use Inc\Plugupdate\Plugbasic; 

$alll_test = new Plugbasic();

$returndata = get_option( 'packagereturndata' );

$returncount = (!empty($returndata) ) ?  $returncount = count($returndata) :  $returncount = 0;

$pluginpageurl = get_option('siteurl').'/wp-admin/plugins.php';

//echo $test =  plugin_basename(__FILE__);
?>

<div class="wrapgpl">
    <h1>GPL Times</h1>
    <div class="cardgpl">
    
    <?php if(!empty($returndata )){ ?>
    
    <h2>sucessfully get update</h2>
    
    <div align="left">
        <a class="status_active" href="<?php echo $pluginpageurl;?>">Go to Plugin Page</a>
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
    
            ?> 
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $returndata[$i]->name; ?> </td>
            <td><?php echo $returndata[$i]->version; ?></td>
        </tr>
        <?php } ?>
        
      
        
        </table>


    
    </div>
    
    
    </div>

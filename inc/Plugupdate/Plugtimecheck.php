<?php
/**
 * @package  Gpltimes
 */
namespace Inc\Plugupdate;


class Plugtimecheck {

    public $returntimegpl;

    function __construct(){

        if(is_admin()){


        $retuenvalue = '';

        $gpltimes = get_option( 'gpltimestatus');

      
      
        $current_time = date('H:i:s');

        $statusgpltimes = get_option( 'gpltimestatus');
        
        

        $diff = round((strtotime($statusgpltimes) - strtotime($current_time)) / 60,2);

    
        if($diff <= 59 && $diff > 56){

            $retuenvalue = 1;

            $this->returntimegpl = $retuenvalue;

        }
            else{

                $retuenvalue = 0 ;

            $this->returntimegpl = $retuenvalue;

           
            }

                if( $retuenvalue == 0){

                    if($diff < 1 || $diff > 60){

                         $endTime = strtotime("+60 minutes", strtotime($current_time));
                         $finaltime = date('H:i:s', $endTime);
                         update_option( 'gpltimestatus', $finaltime, true );
                    }
                }
   
        }       
   
    }
}
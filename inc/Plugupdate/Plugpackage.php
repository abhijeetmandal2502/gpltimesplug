<?php
/**
 * @package  Gpltimes
 */
namespace Inc\Plugupdate;

class Plugpackage{

    
    function __construct($value){

        

       $all_package = get_option( 'gplslugdetails' );

       
      
       
       
       if(!in_array($value,$all_package)){

      
           array_push($all_package,$value);
           update_option( 'gplslugdetails', $all_package);
        }
        

            
    }

}
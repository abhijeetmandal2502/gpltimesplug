<div class="wrap">
	<h1>Gpltimes</h1>
	<?php settings_errors(); ?>
<h1>Deactive Plugin</h1>

<form method="get" action="">
<input type="hidden"  name="page" value="alecaddd_cpt">
<input type="hidden"  name="deactive" value="deactive">
<input type="submit" value="Deactive" name="deactive">
			</form>
      </div>
<?php

if(isset($_GET['deactive'])){
  //echo $_GET['deactive'];

  $username = get_option( 'text_example' );
  $password = get_option( 'first_name' );

    if( $username !='' && $password !=''){
      update_option( 'text_example', '' );
      update_option( 'first_name', '' );
      update_option('gplstatus', '');
    }

}

// $data = $returndata = get_option( 'gplupdatepackage' );

// print_r($data);

//  echo $current_time = date('H:i:s');

// $endTime = strtotime("+10 minutes", strtotime($current_time));
//  $finaltime = date('H:i:s', $endTime);

//     update_option( 'gpltimestatus', $current_time, true );
//     $data = get_option( 'gpltimestatus' );

// $valuegpl = get_option( 'gplslugdetails' );

// print_r($value);

// foreach ($valuegpl as $key => $value) {

//   echo $value;
//   echo '<br>';
//   # code...
// }
// update_user_meta(get_current_user_id(),'last_active_time','16:47:56');
  // $last_active_time = get_user_meta(get_current_user_id(),'last_active_time',true); 

  // print_r($last_active_time);
	
	// $username = esc_attr( get_option( 'text_example' ) );
	// $password = esc_attr( get_option( 'first_name' ) );

	//  $main_url = 'https://gpl.wptemp.site/wp-json/jwt-auth/v1/token';
     // $received_values = array();
     // $received_values['username'] = $username;
     // $received_values['password'] = $password;
     // $received_values += stripslashes_deep($_POST);
     // $options = array('timeout' => 20, 'body' => $received_values,);
     // $response = wp_remote_retrieve_body(wp_safe_remote_post($main_url, $options));

   	//  $response_decode = json_decode($response);



   	//  $response_token = $response_decode->token;

     // $statusurl = 'https://gpl.wptemp.site/get-details.php?data='.$response_token;
     // $package_status = wp_remote_retrieve_body(wp_remote_get($statusurl ));

     // print_r($package_status);

    //  $all_plugins = get_plugins();

    //  print_r($all_plugins);



// $all_plugins = get_plugins();


// $slugarray = [];
// $object = new stdClass();
// foreach ($all_plugins as $key => $value)
// {
   

//     $plugslug = $key;

//     array_push($slugarray,$plugslug);

// }

// $out = implode(",",$slugarray);

// $url = 'http://localhost/wooserver/versioncheck.php?data='.$out;

// $dataAPIResult = wp_remote_retrieve_body( wp_remote_get( $url ) );

// $returndata = json_decode($dataAPIResult);

// print_r($returndata);



?>
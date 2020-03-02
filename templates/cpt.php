<h1>Update Manager</h1>
<?php
	
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

     $all_plugins = get_plugins();

     print_r($all_plugins);



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
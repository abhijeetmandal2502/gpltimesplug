<?php 
/**
 * @package  AlecadddPlugin
 */
namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
	public function adminDashboard()
	{
		return require_once( "$this->plugin_path/templates/admin.php" );
	}

	public function adminCpt()
	{
		return require_once( "$this->plugin_path/templates/deactive.php" );
	}

	public function alecadddOptionsGroup( $input )
	{
		return $input;
	}

	public function alecadddAdminSection()
	{
		echo 'Enter your GPL Times username/email and password';
		
	}

	public function alecadddTextExample()
	{
		$value = esc_attr( get_option( 'username' ) );
		echo '<input type="text" class="regular-text" name="username" value="' . $value . '" placeholder="Username/Email">';
	}

	public function alecadddFirstName()
	{
		$value = esc_attr( get_option( 'password' ) );
		echo '<input type="password" class="regular-text" name="password" value="' . $value . '" placeholder="Password">';
	}

	public function gplsubscription(){
		$tokengpltime = '';
		$main_url = 'https://gpl.wptemp.site/wp-json/jwt-auth/v1/token';
		$received_values = array();
		$received_values['username'] = esc_attr( get_option( 'username' ) );;
		$received_values['password'] = esc_attr( get_option( 'password' ) );
		$received_values += stripslashes_deep($_POST);
		$options = array('timeout' => 20, 'body' => $received_values,);		
		$return_request = wp_safe_remote_post($main_url, $options);
		$retuen_response_code = $return_request['response']['code'];
		if($retuen_response_code == 200){
		$response = wp_remote_retrieve_body($return_request);
   
		$response_decode = json_decode($response);
		

		$tokengpltime = $response_decode->token;

		}

			if($tokengpltime != ''){

			echo	$gplpackage = '<div class="gplmyplugactive">Activated</div>';

			update_option('gplstatus', $tokengpltime);

			}
				else{

			echo	$gplpackage = '<div class="gplmyplugnotactive">Not Active</div>';

					update_option('gplstatus', '');
				}


	}

	
}
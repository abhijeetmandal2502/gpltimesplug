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

	public function adminTaxonomy()
	{
		return require_once( "$this->plugin_path/templates/taxonomy.php" );
	}

	public function adminWidget()
	{
		return require_once( "$this->plugin_path/templates/widget.php" );
	}

	public function alecadddOptionsGroup( $input )
	{
		return $input;
	}

	public function alecadddAdminSection()
	{
		echo 'Gpl Update settings! Enter Your GPltimes username password';
		
	}

	public function alecadddTextExample()
	{
		$value = esc_attr( get_option( 'text_example' ) );
		echo '<input type="text" class="regular-text" name="text_example" value="' . $value . '" placeholder="username of Gpltimes!">';
	}

	public function alecadddFirstName()
	{
		$value = esc_attr( get_option( 'first_name' ) );
		echo '<input type="password" class="regular-text" name="first_name" value="' . $value . '" placeholder="password">';
	}

	public function gplsubscription(){
		$tokengpltime = '';
		$main_url = 'https://gpl.wptemp.site/wp-json/jwt-auth/v1/token';
		$received_values = array();
		$received_values['username'] = esc_attr( get_option( 'text_example' ) );;
		$received_values['password'] = esc_attr( get_option( 'first_name' ) );
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
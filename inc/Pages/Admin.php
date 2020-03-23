<?php 
/**
 * @package  Gpltimes
 */
namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

/**
* 
*/
class Admin extends BaseController
{
	public $settings;

	public $callbacks;

	public $pages = array();

	public $subpages = array();

	public function register() 
	{
		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->setPages();

		$this->setSubpages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();

		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
	}

	public function setPages() 
	{
		$this->pages = array(
			array(
				'page_title' => 'GPL Times', 
				'menu_title' => 'GPL Times', 
				'capability' => 'manage_options', 
				'menu_slug' => 'gpltimes_plugin', 
				'callback' => array( $this->callbacks, 'adminDashboard' ), 
				'icon_url' => 'dashicons-admin-plugins', 
				'position' => 110
			)
		);
	}

	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'gpltimes_plugin', 
				'page_title' => 'Deactivate Plugin', 
				'menu_title' => 'Deactivate', 
				'capability' => 'manage_options', 
				'menu_slug' => 'gpltimes_deactive', 
				'callback' => array( $this->callbacks, 'adminCpt' )
			),
		);
	}

	public function setSettings()
	{
		$args = array(
			array(
				'option_group' => 'gpl_options_group',
				'option_name' => 'username',
				'callback' => array( $this->callbacks, 'gplOptionsGroup' )
			),
			array(
				'option_group' => 'gpl_options_group',
				'option_name' => 'password'
			)
		);

		$this->settings->setSettings( $args );
	}

	public function setSections()
	{
		$args = array(
			array(
				'id' => 'gpl_admin_index',
				'title' => 'Login to GPL Times',
				'callback' => array( $this->callbacks, 'gplAdminSection' ),
				'page' => 'gpltimes_plugin'
			)
		);

		$this->settings->setSections( $args );
	}

	public function setFields()
	{
		$args = array(
			array(
				'id' => 'username',
				'title' => 'User Name / Email',
				'callback' => array( $this->callbacks, 'gpltimesusername' ),
				'page' => 'gpltimes_plugin',
				'section' => 'gpl_admin_index',
				'args' => array(
					'label_for' => 'username',
					'class' => 'example-class'
				)
			),
			array(
				'id' => 'password',
				'title' => 'Password',
				'callback' => array( $this->callbacks, 'gpltimespassword' ),
				'page' => 'gpltimes_plugin',
				'section' => 'gpl_admin_index',
				'args' => array(
					'label_for' => 'password',
					'class' => 'example-class'
					)
				),
			array(
				'id' => 'gplstatus',
				'title' => 'Status',
				'callback' => array( $this->callbacks, 'gplsubscription' ),
				'page' => 'gpltimes_plugin',
				'section' => 'gpl_admin_index',
				'args' => array(
					'label_for' => 'gplstatus',
					'class' => 'gplmystatus'
				)
			),	

		);

		$this->settings->setFields( $args );
	}
}

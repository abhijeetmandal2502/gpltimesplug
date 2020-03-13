<?php 
/**
 * @package  AlecadddPlugin
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
				'page_title' => 'Gpltimes Update', 
				'menu_title' => 'Gpltime Update', 
				'capability' => 'manage_options', 
				'menu_slug' => 'alecaddd_plugin', 
				'callback' => array( $this->callbacks, 'adminDashboard' ), 
				'icon_url' => 'dashicons-store', 
				'position' => 110
			)
		);
	}

	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'alecaddd_plugin', 
				'page_title' => 'Deactive Plugin', 
				'menu_title' => 'Deactive', 
				'capability' => 'manage_options', 
				'menu_slug' => 'alecaddd_cpt', 
				'callback' => array( $this->callbacks, 'adminCpt' )
			),
			// array(
			// 	'parent_slug' => 'alecaddd_plugin', 
			// 	'page_title' => 'Custom Taxonomies', 
			// 	'menu_title' => 'Taxonomies', 
			// 	'capability' => 'manage_options', 
			// 	'menu_slug' => 'alecaddd_taxonomies', 
			// 	'callback' => array( $this->callbacks, 'adminTaxonomy' )
			// ),
			// array(
			// 	'parent_slug' => 'alecaddd_plugin', 
			// 	'page_title' => 'Custom Widgets', 
			// 	'menu_title' => 'Widgets', 
			// 	'capability' => 'manage_options', 
			// 	'menu_slug' => 'alecaddd_widgets', 
			// 	'callback' => array( $this->callbacks, 'adminWidget' )
			// )
		);
	}

	public function setSettings()
	{
		$args = array(
			array(
				'option_group' => 'alecaddd_options_group',
				'option_name' => 'text_example',
				'callback' => array( $this->callbacks, 'alecadddOptionsGroup' )
			),
			array(
				'option_group' => 'alecaddd_options_group',
				'option_name' => 'first_name'
			)
		);

		$this->settings->setSettings( $args );
	}

	public function setSections()
	{
		$args = array(
			array(
				'id' => 'alecaddd_admin_index',
				'title' => 'Gpltimes',
				'callback' => array( $this->callbacks, 'alecadddAdminSection' ),
				'page' => 'alecaddd_plugin'
			)
		);

		$this->settings->setSections( $args );
	}

	public function setFields()
	{
		$args = array(
			array(
				'id' => 'text_example',
				'title' => 'User Name',
				'callback' => array( $this->callbacks, 'alecadddTextExample' ),
				'page' => 'alecaddd_plugin',
				'section' => 'alecaddd_admin_index',
				'args' => array(
					'label_for' => 'text_example',
					'class' => 'example-class'
				)
			),
			array(
				'id' => 'first_name',
				'title' => 'Password',
				'callback' => array( $this->callbacks, 'alecadddFirstName' ),
				'page' => 'alecaddd_plugin',
				'section' => 'alecaddd_admin_index',
				'args' => array(
					'label_for' => 'first_name',
					'class' => 'example-class'
					)
				),
			array(
				'id' => 'gplstatus',
				'title' => 'Status',
				'callback' => array( $this->callbacks, 'gplsubscription' ),
				'page' => 'alecaddd_plugin',
				'section' => 'alecaddd_admin_index',
				'args' => array(
					'label_for' => 'gplstatus',
					'class' => 'gplmystatus'
				)
			),	

		);

		$this->settings->setFields( $args );
	}
}
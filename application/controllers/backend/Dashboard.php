<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dashboard Controller
 */
class Dashboard extends BE_Controller {

	/**
	 * set required variable and libraries
	 */
	function __construct() {
		parent::__construct( ROLE_CONTROL, 'DASHBOARD' );
	}

	/**
	 * Home page for the dashbaord controller
	 */
	function index($shop_id = 0) {
		$sess_array = array('shop_id' => $shop_id);
		$user_id = $this->session->userdata('user_id');
		$is_sys_admin = $this->session->userdata('is_sys_admin');

		if($is_sys_admin == 1){
			
			$this->session->set_userdata('selected_shop_id', $sess_array);

		 	$this->load_template( 'dashboard', false, false, true );
		} else {
			$conds_user_shop['shop_id'] = $shop_id;
			$conds_user_shop['user_id'] = $user_id;

			$user_shops = $this->User_shop->get_one_by($conds_user_shop);
			$is_empty_object = $user_shops->is_empty_object;
		
			if ($is_empty_object == 1) {
				redirect(site_url('logout'));
			
			} else {
				$this->session->set_userdata('selected_shop_id', $sess_array);

			 	$this->load_template( 'dashboard', false, false, true );
			}

		} 

	}

	function exports()
	{
		// Load the DB utility class
		$this->load->dbutil();
		
		// Backup your entire database and assign it to a variable
		$export = $this->dbutil->backup();
		
		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download('ps_news.zip', $export);
	}
}
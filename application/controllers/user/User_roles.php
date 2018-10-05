<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_roles extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		// load model, library or helper

		
	}

	public function index()
	{
		$data['user_roles'] = $this->dbh->get_all_data('user_roles_vw')->result();
		$this->render->view('user/user_roles_v', $data);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		// load model, library or helper

		
	}

	public function index()
	{
		$data['users'] = $this->dbh->get_all_data('users_vw')->result();
		$this->render->view('user/users_v', $data);
	}
}

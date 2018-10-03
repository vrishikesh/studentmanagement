<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_details extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		// load model, library or helper

		$this->load->model(MODEL_PATH . 'user/users_m');
	}

	public function index()
	{
		var_dump($this->dbh->get_all_data('users')->result());
		// $this->render->view('tables');
	}
}

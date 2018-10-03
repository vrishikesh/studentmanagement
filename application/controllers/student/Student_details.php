<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_details extends Admin_Controller {

<<<<<<< HEAD
	public function index()
	{
        $this->output->enable_profiler();
		$this->render->view('tables');
=======
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
>>>>>>> r
	}
}

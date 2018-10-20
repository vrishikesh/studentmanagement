<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller {

	public function __construct()
	{
		parent::__construct();
		// load model, library or helper

		
	}

	public function index()
	{
		$data['app_name'] = $this->lang->line('app_name');
		$this->render->view('login/login', $data);
	}
}

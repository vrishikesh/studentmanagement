<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller {

	public function index()
	{
		$this->render->view('tables');
	}
}

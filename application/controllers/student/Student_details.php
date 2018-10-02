<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_details extends Admin_Controller {

	public function index()
	{
        $this->output->enable_profiler();
		$this->render->view('tables');
	}
}

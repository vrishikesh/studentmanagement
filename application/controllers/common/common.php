<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends Admin_Controller {

	public function __construct() {

		parent::__construct();
		// load model, library or helper

		$this->load->model(Path::Model . 'common/common_m');
	
	}

	public function index() {
		
		echo 'hi';
	
    }

    public function get_table_data() {
        
        echo $this->common_m->get_table_data( $this->input->post() );

    }
    
}

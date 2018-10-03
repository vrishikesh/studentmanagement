<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Public_Controller {

    public function __construct()
    {
        parent::__construct();
        // load model, library or helper

        $this->load->model(MODEL_PATH . 'user/users_m');
    }

	public function index()
	{
		$this->render->view('login/login');
    }
    
    public function validate_login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('login/login');
            return;
        }
        
        $data = $this->users_m->validate_login( $email, $password );
        if ( empty( $data ) )
        {
            $this->load->view('login/login');
            return;
        }

        unset( $data['PASSWORD'] );
        $data['logged_in'] = TRUE;
        $this->session->set_userdata( $data );
        redirect('student/student_details');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login/login');
    }

}

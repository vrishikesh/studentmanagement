<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Public_Controller {

<<<<<<< HEAD
=======
    public function __construct()
    {
        parent::__construct();
        // load model, library or helper

        $this->load->model(Path::Model . 'user/users_m');
        $this->load->model(Path::Model . 'user/user_roles_m');
    }

>>>>>>> r
	public function index()
	{
		$this->render->view('login/login');
    }
    
    public function validate_login()
    {
<<<<<<< HEAD
        $this->load->model('user/users_m');
=======
>>>>>>> r
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
        $this->session->set_userdata( 'permission_list', $this->user_roles_m->get_module_list() );

        redirect('student/student_details');
<<<<<<< HEAD
        
=======
>>>>>>> r
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login/login');
    }

}

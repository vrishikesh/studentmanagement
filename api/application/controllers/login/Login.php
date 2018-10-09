<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Login extends REST_Controller {

	public function validate_login_post()
    {
        $this->load->model('user/users_m');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $data = $this->users_m->validate_login( $email, $password );
        if ( empty( $data ) )
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'No users were found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
        else
        {
            unset( $data['PASSWORD'] );
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function validate_login_get()
    {
        $data = $this->dbh->all('users')->result();
        if ( empty( $data ) )
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'No users were found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
        else
        {
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

}

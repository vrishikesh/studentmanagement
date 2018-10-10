<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_roles extends Admin_Controller {

	public function __construct() {

		parent::__construct();
		// load model, library or helper

		$this->load->model(Path::Model . 'user/user_roles_m');
	
	}

	public function index() {
		
		$data['user_roles'] = $this->dbh->all('user_roles_vw', 'ID, NAME, DESCRIPTION, BGCOLOR, PERMISSIONS, IS_ADMIN, USER_ID', [], '', 'ID DESC')->result();
		$data['generated_module_list'] = $this->generate_module_list();
		$this->render->view('user/user_roles_v', $data);
	
	}

	public function generate_module_list() {

		return $this->user_roles_m->generate_module_list( 0, unserialize( $this->user->permission_list() ), '' );

	}

	public function save() {

		$id = $this->input->post('id');
		$upsert_data = array(
			'NAME' => $this->input->post('role_name'),
			'DESCRIPTION' => $this->input->post('role_desc'),
			'PERMISSIONS' => implode(',', array_keys( $this->input->post('module') ))
		);
		if ( ! $id ) {

			$this->dbh->insert('user_roles', $upsert_data);

		} else {

			$this->dbh->update('user_roles', $upsert_data, ['ID' => $id]);

		}
		$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status' => TRUE)));

	}

	public function edit( $id ) {

		$row = $this->dbh->all('user_roles', '*', ['ID' => $id])->row_array();
		if ( $row ) {
			
			$row['status'] = TRUE;

		} else {

			$row['status'] = FALSE;

		}

		$this->output
				->set_content_type('application/json')
				->set_output(json_encode($row));

	}

	public function delete( $id ) {

		$this->dbh->delete('user_roles', ['ID' => $id]);
		$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status' => TRUE)));

	}
}

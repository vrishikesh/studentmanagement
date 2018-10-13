<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_roles extends Admin_Controller {

	public function __construct() {

		parent::__construct();
		// load model, library or helper

		$this->load->model(Path::Model . 'user/user_roles_m');
	
	}

	public function index() {
		
		$serialize['table_name'] = 'user_roles_vw';
		$table_columns = array( 
			'ID' => 'ID', 
			'NAME' => 'Name', 
			'DESCRIPTION' => 'Description', 
			'BGCOLOR' => 'Color', 
			'PERMISSIONS' => 'Permissions', 
			'USER_ID' => 'User' 
		);
		$data['table_columns'] = array_values( $table_columns );
		$serialize['table_columns'] = implode( ',', array_keys( $table_columns ) );
		$serialize['table_where'] = [];
		$serialize['table_group_by'] = '';
		$serialize['table_order_by'] = 'ID DESC';
		$data['serialized_table_data'] = urlencode( serialize( $serialize ) );
		
		$data['generated_module_list'] = $this->generate_module_list();
		$this->render->view('user/user_roles_v', $data);
	
	}

	public function generate_module_list() {

		return $this->user_roles_m->generate_module_list( 0, unserialize( $this->user->permission_list() ), '' );

	}

	public function save() {

		$id = $this->input->post('id');
		$module = $this->input->post('module');
		$permissions = '';
		if ( is_array( $module ) ) {
			
			$permissions = implode(',', array_keys( $module ));

		}
		$upsert_data = array(
			'NAME' => $this->input->post('role_name'),
			'DESCRIPTION' => $this->input->post('role_desc'),
			'PERMISSIONS' => $permissions
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

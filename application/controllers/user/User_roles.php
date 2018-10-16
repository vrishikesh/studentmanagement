<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_roles extends Admin_Controller {

	public function __construct() {

		parent::__construct();
		// load model, library or helper

		$this->load->model(Path::Model . 'user/user_roles_m');
		$this->lang->load('user/user_roles');
	
	}

	public function index() {
		
		// Generate Dynamic Listview
		$serialize['table_name'] = 'user_roles_vw';
		$table_columns = array( 
			'ID' => $this->lang->line('ID'), 
			'NAME' => $this->lang->line('NAME'), 
			'DESCRIPTION' => $this->lang->line('DESCRIPTION'), 
			'BGCOLOR' => $this->lang->line('BGCOLOR'), 
			'PERMISSIONS' => $this->lang->line('PERMISSIONS'), 
			'PRIORITY' => $this->lang->line('PRIORITY'), 
		);
		$data['table_columns'] = array_values( $table_columns );
		$serialize['table_columns'] = implode( ',', array_keys( $table_columns ) );
		$serialize['table_where'] = [];
		$serialize['table_group_by'] = '';
		$serialize['table_order_by'] = 'ID DESC';
		$data['serialized_table_data'] = urlencode( serialize( $serialize ) );

		// Load language
		$data['module_name'] = $this->lang->line('module_name');
		$data['page_title'] = $this->lang->line('page_title');
		$data['add_form_button'] = $this->lang->line('add_form_button');
		$data['home'] = $this->lang->line('home');

		// Generate Dynamic Form
		$data['generated_form'] = $this->generate_form( $data['add_form_button'], $this->generate_module_list() );

		$this->render->view('datatables', $data);
	
	}

	function generate_form( $modal_title, $generated_module_list ) {

		return $this->form->open( $modal_title, Url::Site . 'user/user_roles/save', array(
							'class' => 'submitForm'
						) )
						->row_open()
							->input(array(
								'name' => 'role_name',
								'id' => 'role_name',
								'class' => 'form-control',
								'placeholder' => "Enter Role Name",
							), 'Role Name')
							->input(array(
								'name' => 'priority',
								'id' => 'priority',
								'class' => 'form-control',
								'placeholder' => "Enter Priority",
							), 'Priority')
						->row_close()
						->row_open()
							->textarea(array(
								'name' => 'role_desc',
								'id' => 'role_desc',
								'class' => 'form-control',
								'placeholder' => "Enter Description",
								'rows' => 5,
								'parent_class' => 'form-group col-sm-12',
							), 'Description')
						->row_close()
						->row_open()
							->module_list( $generated_module_list )
						->row_close()
						->close()
						->to_html();

	}

	public function generate_module_list() {

		return $this->user_roles_m->generate_module_list( 0, unserialize( $this->user->permission_list() ), '' );

	}

	public function save() {

		$status = FALSE;
		$msg = '';
		$id = $this->input->post('id');
		$module = $this->input->post('module');
		$permissions = '';
		if ( is_array( $module ) ) {
			
			$permissions = implode(',', array_keys( $module ));

		}

		$this->form_validation->set_rules('role_name', $this->lang->line('NAME'), 'trim|required');
        $this->form_validation->set_rules('role_desc', $this->lang->line('DESCRIPTION'), 'trim');
		$this->form_validation->set_rules('priority',  $this->lang->line('PRIORITY'), 'trim|required');

        if ($this->form_validation->run() == FALSE) {

			$msg = validation_errors();
			
        } else {

			$upsert_data = array(
				'NAME' => $this->input->post('role_name'),
				'DESCRIPTION' => $this->input->post('role_desc'),
				'PERMISSIONS' => $permissions,
				'PRIORITY' => $this->input->post('priority'),
			);
			if ( ! $id ) {
	
				$status = $this->dbh->insert('user_roles', $upsert_data) ? TRUE : FALSE;
	
			} else {
	
				$status = $this->dbh->update('user_roles', $upsert_data, ['ID' => $id]);
	
			}

		}
		$this->output
				->set_content_type('application/json')
				->set_output(json_encode(compact('status', 'msg')));

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

		$status = $this->dbh->delete('user_roles', ['ID' => $id]);
		$this->output
				->set_content_type('application/json')
				->set_output(json_encode(compact('status')));

	}

}

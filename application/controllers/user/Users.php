<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		// load model, library or helper
		$this->lang->load('user/users');
		
	}

	public function index() {

		// Generate Dynamic Listview
		$serialize['table_name'] = 'users_vw';
		$table_columns = array( 
			'ID' => $this->lang->line('ID'), 
			'USERNAME' => $this->lang->line('USERNAME'), 
			'EMAIL' => $this->lang->line('EMAIL'), 
			'USER_ROLE' => $this->lang->line('USER_ROLE'), 
			'ACTIVE' => $this->lang->line('ACTIVE'), 
			'OA_BRAND_NM' => $this->lang->line('OA_BRAND_NM'), 
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
		$data['generated_form'] = $this->generate_form( $data['add_form_button'] );

		$this->render->view('datatables', $data);

	}

	function generate_form( $modal_title ) {

		$result = $this->dbh->all('user_roles', 'ID, NAME')->result();
		$options = [];
		foreach ($result as $row) $options[ $row->ID ] = $row->NAME;

		return $this->form->open( $modal_title, Url::Site . 'user/users/save', array(
							'class' => 'submitForm'
						) )
						->row_open()
							->input(array(
								'name' => 'user_name',
								'id' => 'user_name',
								'placeholder' => "Enter User Name",
								'required' => true,
							), $this->lang->line('USERNAME'))
							->input(array(
								'name' => 'password',
								'id' => 'password',
								'type' => 'password',
								'placeholder' => "Enter Password",
								'required' => true,
							), $this->lang->line('PASSWORD'))
						->row_close()
						->row_open()
							->input(array(
								'name' => 'email',
								'id' => 'email',
								'type' => 'email',
								'placeholder' => "Enter Email",
								'required' => true,
							), $this->lang->line('EMAIL'))
							->select(array(
								'name' => 'user_role',
								'id' => 'user_role',
								'placeholder' => "Select User Role",
								'options' => $options,
								'required' => true,
							), $this->lang->line('USER_ROLE'))
						->row_close()
						->close()
						->to_html();

	}

	public function save() {

		$status = FALSE;
		$msg = '';
		$id = $this->input->post('id');

		$this->form_validation->set_rules('user_name', $this->lang->line('USERNAME'), 'trim|required');
        $this->form_validation->set_rules('password', $this->lang->line('PASSWORD'), 'trim|required');
		$this->form_validation->set_rules('email',  $this->lang->line('EMAIL'), 'trim|required|valid_email|is_unique[users.EMAIL]');
		$this->form_validation->set_rules('user_role',  $this->lang->line('USER_ROLE'), 'trim|required');

        if ($this->form_validation->run() == FALSE) {

			$msg = validation_errors();
			
        } else {

			$upsert_data = array(
				'USERNAME' => $this->input->post('user_name'),
				'PASSWORD' => password_hash( $this->input->post('password'), PASSWORD_DEFAULT ),
				'EMAIL' => $this->input->post('email'),
				'USER_ROLE_ID' => $this->input->post('user_role'),
			);
			if ( ! $id ) {
	
				$status = $this->dbh->insert('users', $upsert_data) ? TRUE : FALSE;
	
			} else {
	
				$status = $this->dbh->update('users', $upsert_data, ['ID' => $id]);
	
			}

		}
		$this->output
				->set_content_type('application/json')
				->set_output(json_encode(compact('status', 'msg')));

	}

	public function edit( $id ) {

		$status = FALSE;
		$row  = [];
		if ( ! empty( $id ) ) {
			
			$row = $this->dbh->all('users', '*', ['ID' => $id])->row_array();
			if ( $row ) {
				
				$status = TRUE;

			}

		}
		$row['status'] = $status;

		$this->output
				->set_content_type('application/json')
				->set_output(json_encode($row));

	}

	public function delete( $id ) {

		$status = FALSE;
		if ( ! empty( $id ) ) {

			$status = $this->dbh->delete('users', ['ID' => $id]);

		}
		$this->output
				->set_content_type('application/json')
				->set_output(json_encode(compact('status')));

	}

}

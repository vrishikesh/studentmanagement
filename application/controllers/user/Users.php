<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		// load model, library or helper

		
	}

	public function index()
	{
		$data['title'] = 'Users';
		$data['short_desc'] = 'user list';

		$data['breadcrumb'] = array(
			array(
				'name' => '<i class="fa fa-dashboard"></i> Home',
				'class' => '',
				'url' => '#'
			),
			array(
				'name' => 'Administration',
				'class' => '',
				'url' => '#'
			),
			array(
				'name' => 'Users',
				'class' => 'active',
				'url' => '#'
			),
		);

		$data['listButtons'] = array(
			array(
				'type' => 'button',
				'text' => '<i class="fa fa-plus"></i> Add User',
				'attr' => 'data-toggle="modal" class="btn btn-sm btn-success" data-target="#modal-default"'
			)
		);

		$data['thead'] = array(
			'Username',
			'Email',
			'User Role',
			'Last Login',
			'Is Online',
			'Brand'
		);

		$data['tbody'] = $this->dbh->all('users_vw', 'USERNAME, EMAIL, USER_ROLE, LAST_LOGIN, ACTIVE, OA_BRAND_ID')->result_array();
		$this->render->view('datatables', $data);
	}
}

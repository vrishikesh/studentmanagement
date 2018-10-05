<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_roles extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		// load model, library or helper

		
	}

	public function index()
	{
		$data['title'] = 'User Roles';
		$data['short_desc'] = 'user role list';

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
				'name' => 'User Roles',
				'class' => 'active',
				'url' => '#'
			),
		);

		$data['listButtons'] = array(
			array(
				'type' => 'button',
				'text' => '<i class="fa fa-plus"></i> Add User Role',
				'attr' => 'data-toggle="modal" class="btn btn-sm btn-success" data-target="#modal-default"'
			)
		);

		$data['thead'] = array(
			'Role Name',
			'Description',
			'Color',
			'Permissions',
			'Is Admin',
			'User',
		);

		$data['tbody'] = $this->dbh->get_all_data('user_roles_vw', 'NAME, DESCRIPTION, BGCOLOR, PERMISSIONS, IS_ADMIN, USER_ID')->result_array();
		$this->render->view('datatables', $data);
	}
}

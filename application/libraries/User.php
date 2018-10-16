<?php

class User {

    protected $CI;

    public function __construct() {

        $this->CI = & get_instance();

    }

    public function logged_in() {

        return $this->CI->session->logged_in ?? FALSE;

    }

    public function is_admin() {

        return $this->CI->session->is_admin;

    }

    public function user_id() {

        return $this->CI->session->user_id;

    }
    
    public function user_role_id() {

        return $this->CI->session->user_role_id;

    }

    public function oa_id() {

        return $this->CI->session->oa_id;

    }

    public function oa_brand_id() {

        return $this->CI->session->oa_brand_id;

    }

    public function permission_list() {

        return $this->CI->session->permission_list;

    }
    
    public function priority() {

        return $this->CI->session->priority;

    }

    public function logout() {

        $this->CI->session->sess_destroy();

    }

}
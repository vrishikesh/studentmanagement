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

    public function brand_id() {

        return $this->CI->session->brand_id;

    }

    public function logout() {

        $this->CI->session->sess_destroy();

    }

}
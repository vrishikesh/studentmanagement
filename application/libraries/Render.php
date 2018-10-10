<?php

class Render {

    protected $CI;

    public function __construct() {

        $this->CI = & get_instance();

    }

    public function view( $path, $data = [] ) {

        if ( ! $this->CI->input->is_ajax_request() )
        {
            $this->CI->load->model(Path::Model . 'user/user_roles_m');
            $sidebar_data = $data['sidebar'] ?? [];
            $sidebar_data['module_list'] = $this->CI->user_roles_m->create_module_list();

            $header = $this->CI->load->view('include/header', $data['header'] ?? FALSE, TRUE);
            $sidebar = NULL;
            if ( $this->CI->user->logged_in() ) {
                $sidebar = $this->CI->load->view('include/sidebar', $sidebar_data ?? FALSE, TRUE);
            }
            $footer = $this->CI->load->view('include/footer', $data['footer'] ?? FALSE, TRUE);
            $body = $this->CI->load->view($path, $data, TRUE);
            $this->CI->load->view('include/render', compact(
                'header', 'sidebar', 'body', 'footer'
            ));
        }
        else
        {
            echo $this->CI->load->view($path, $data, TRUE);
        }
        
    }

}
<?php

class Render {

    protected $CI;

    public function __construct() {

        $this->CI = & get_instance();

    }

    public function view( $path, $data = [] ) {

        if ( ! $this->CI->input->is_ajax_request() )
        {
            $header = $this->CI->load->view('include/header', $data['header'] ?? FALSE, TRUE);
            $sidebar = $this->CI->load->view('include/sidebar', $data['sidebar'] ?? FALSE, TRUE);
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
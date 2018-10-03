<?php

class Populate_module extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        // load model, library or helper

        $this->load->model(MODEL_PATH . '_scripts/module_list_m');
    }

    public function index()
    {
        $files = [];
        foreach ( glob( APPPATH . 'controllers/*/*.php', GLOB_NOSORT ) as $file )
        {
            $matches = NULL;
            if ( preg_match("/controllers\/([^_][a-zA-Z-_\/]+)\.php$/", $file, $matches) )
                $files[] = $matches[1];
        }
        $this->module_list_m->insert_in_module_list( $files );
    }

}
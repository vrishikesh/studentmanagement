<?php

class Populate_module extends MY_Controller {

    public function index() {

        $this->load->model('_scripts/module_list_m');
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
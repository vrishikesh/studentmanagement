<?php

class Module_list_m extends CI_Model {

    public function insert_in_module_list( $files = [] ) {

        $data = [];
        foreach ($files as $file) {
            $url = strtolower( $file );
            if ( ! $this->check_if_exists( $url ) ) {
                $name = explode('/', $url)[1];
                $name = str_replace('_', ' ', $name );
                $name = str_replace('-', ' ', $name );
                $name = ucwords( $name );
                $data[] = array(
                    'NAME' => $name,
                    'URL' => $url,
                );
            }
        }
        if ( $data ) {
            $this->db->insert_batch('module_list', $data);
        }
        
    }

    public function check_if_exists( $url ) {

        return $this->db
                    ->where('URL', $url)
                    ->count_all_results('module_list');

    }

}
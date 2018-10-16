<?php

class Common_m extends CI_Model {

    public function get_table_data( array $data ) : string {

        $return = [];
        $return['draw'] = $data['draw'];
        $unserialized_table_data = unserialize( urldecode( $data['serialized_table_data'] ) );
        $return['recordsTotal'] = $return['recordsFiltered'] = $this->db->count_all( $unserialized_table_data['table_name'] );

        $search = $data['search'];
        $search_value = null;
        if( $search['value'] !== "" )
            $search_value = $search['value'];
        
        if ( ! is_null( $search_value ) ) {
            
            $table_columns = explode( ',', $unserialized_table_data['table_columns'] );
            $this->db->group_start();
            $this->db->or_like( array_combine( $table_columns, array_fill( 0, count( $table_columns ), $search_value ) ) );
            $this->db->group_end();

        }

        $result = $this->dbh->all(
            $unserialized_table_data['table_name'], 
            $unserialized_table_data['table_columns'], 
            $unserialized_table_data['table_where'], 
            $unserialized_table_data['table_group_by'], 
            $unserialized_table_data['table_order_by'], 
            $data['length'], 
            $data['start']
        )->result_array();
        $return['data'] = [];
        foreach ($result as $row) {
            
            $list = array_values( $row );
            $list[] = '<a href="#" onclick="edit_row(this, ' . $list[0] . ', \'' . Url::Site . 'user/user_roles/edit/' . $list[0] . '\', editCallback)"><i class="fa fa-edit"></i></a>
            <a href="#" onclick="delete_row(this, ' . $list[0] . ', \'' . Url::Site . 'user/user_roles/delete/' . $list[0] . '\', deleteCallback)"><i class="fa fa-trash-o"></i></a>';
            $return['data'][] = $list;
            
        }

        return json_encode( $return );
        
    }

}
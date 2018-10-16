<?php

class CI_Db_helper {

    protected $CI;

    public function __construct() {

        $this->CI = & get_instance();

    }

    /**
     * Get all data
     * 
     **/
    public function all( string $table, string $select = '*', 
                array $where = [], string $group_by = '', 
                string $order_by = '', int $length = null, int $offset = null )
    {
        if( substr($table, -3) !== '_vw' )
            $where['IS_DELETED'] = Deleted::No;
        
        if ( $this->CI->user->is_admin() == UserType::Organisation ) {
            
            $where['OA_ID'] = $this->CI->user->oa_id();

        } elseif ( $this->CI->user->is_admin() == UserType::Brand ) {
            
            $where['OA_BRAND_ID'] = $this->CI->user->oa_brand_id();

        } elseif ( $this->CI->user->is_admin() == UserType::User ) {
            
            $where['PRIORITY >='] = $this->CI->user->priority();

        }
        $this->CI->db->select($select);
        if ( $where ) {
            
            $this->CI->db->where($where);

        }
        if( $group_by ) {

            $this->CI->db->group_by($group_by);

        }
        if( $order_by ) {

            $this->CI->db->order_by($order_by);

        }
        if ( ! is_null( $length ) ) {
            
            $offset = is_null( $offset ) ? 0 : $offset;
            $this->CI->db->limit( $length, $offset );

        }
        return $this->CI->db->get($table);
    }

    /**
     * Get system data
     * 
     **/
    function sys($table, $select = '*', 
    $where = [], $group_by = '', $order_by = '')
    {
        $tableType = $this->field('common_type', 'TYP_CD', $where['TYP_CD'], 'TABLE_TYPE');

        $where['IS_DELETED'] = 0;
        $this->CI->db->select($select);
        $this->CI->db->where($where);
        if( ! $this->CI->user->is_admin() AND $tableType = 'USER' )
        {
            $this->CI->db->where('OA_BRAND_ID', $this->CI->user->oa_brand_id());
        }
    }

    /**
     * Get single field data
     * 
     **/
    public function field($table, $primary_column_name, $primary_column_value, $expected_column_value, $expected_return_value = NULL)
    {
        $query = $this->CI->db
                    ->select($expected_column_value)
                    ->where($primary_column_name, $primary_column_value)
                    ->limit(1)
                    ->get($table);
        return $query->num_rows() ? 
                    $query->row()->$expected_column_value : 
                    $expected_return_value;
    }

    /**
     * Insert data
     * 
     **/
    public function insert($table, $data = [], $audits = TRUE) {
        
        if ( $audits ) {
            
            $data['OA_ID'] = $this->CI->user->oa_id();
            $data['OA_BRAND_ID'] = $this->CI->user->oa_brand_id();
            $data['USER_ID'] = $this->CI->user->user_id();
            
        }
        $data['CREATED_BY'] = $this->CI->user->user_id();
        $this->CI->db->insert($table, $data);
        return $this->CI->db->insert_id();

    }

    /**
     * Update data
     * 
     **/
    public function update($table, $data = [], $where = []) {
        
        $data['UPDATED_BY'] = $this->CI->user->user_id();
        $this->CI->db->where($where);
        $this->CI->db->update($table, $data);
        return $this->CI->db->affected_rows();

    }

    /**
     * Delete data
     * 
     **/
    public function delete($table, $where = []) {

        $this->CI->db->where($where);
        $this->CI->db->update($table, ['IS_DELETED' => Deleted::Yes]);
        return $this->CI->db->affected_rows();

    }

}
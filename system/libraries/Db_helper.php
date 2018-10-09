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
    public function all($table, $select = '*', 
                $where = [], $group_by = '', $order_by = '')
    {
        $where['IS_DELETED'] = 0;
        return $this->CI->db
                    ->select($select)
                    ->where($where)
                    ->group_by($group_by)
                    ->order_by($order_by)
                    ->get($table);
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
    public function insert($table, $data = [])
    {
        $data['OA_ID'] = $this->CI->user->oa_id();
        $data['OA_BRAND_ID'] = $this->CI->user->oa_brand_id();
        $data['USER_ID'] = $this->CI->user->user_id();
        $data['CREATED_BY'] = $this->CI->user->user_id();
        return $this->CI->db->insert($table, $data);
    }

    /**
     * Update data
     * 
     **/
    public function update($table, $data = [], $where = [])
    {
        $data['UPDATED_BY'] = $this->CI->user->user_id();
        $this->CI->db->where($where);
        return $this->CI->db->update($table, $data);
    }

    /**
     * Delete data
     * 
     **/
    public function delete($table, $where = [])
    {
        $this->CI->db->where($where);
        return $this->CI->db->update($table, ['IS_DELETED' => 1]);
    }

}
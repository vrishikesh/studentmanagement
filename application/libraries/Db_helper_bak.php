<?php

class Db_helper {

    protected $CI;

    public function __construct() {

        $this->CI = & get_instance();

    }

    public function get_all_data($table, $select = '*', 
                $where = [], $group_by = '', $order_by = '')
    {
        return $this->CI->db
                    ->select($select)
                    ->where($where)
                    ->group_by($group_by)
                    ->order_by($order_by)
                    ->get($table);
    }

    function get_sys_data($table, $select = '*', 
    $where = [], $group_by = '', $order_by = '')
    {
        $tableType = $this->get_field('common_type', 'TYP_CD', $where['TYP_CD'], 'TABLE_TYPE');

        $this->CI->db->select($select);
        $this->CI->db->where($where);
        if( ! $this->CI->user->is_admin() AND $tableType = 'USER' )
        {
            $this->CI->db->where('OA_BRAND_ID', $this->CI->user->brand_id());
        }
    }

    public function get_field($table, $primary_column_name, $primary_column_value, $expected_column_value, $expected_return_value = NULL)
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

    public function insert_data($table, $data = [])
    {
<<<<<<< HEAD:application/libraries/Db_helper.php
        $data['USER_ID'] = $this->CI->session->user_id;
=======
        $data['USER_ID'] = $this->CI->user->user_id();
        $data['CREATED_BY'] = $this->CI->user->user_id();
>>>>>>> r:application/libraries/Db_helper_bak.php
        return $this->CI->db->insert($table, $data);
    }

    public function update_data($table, $data = [], $where = [])
    {
<<<<<<< HEAD:application/libraries/Db_helper.php
=======
        $data['UPDATED_BY'] = $this->CI->user->user_id();
>>>>>>> r:application/libraries/Db_helper_bak.php
        $this->CI->db->where($where);
        return $this->CI->db->update($table, $data);
    }

}
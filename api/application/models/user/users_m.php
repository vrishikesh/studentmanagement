<?php

class Users_m extends CI_Model {

    private $table = 'users';
    private $view = 'users_vw';

    public function validate_login( string $email, string $password ) : array {

        $row = $this->db
                ->select('ID as user_id, USERNAME as username, EMAIL as email, USER_ROLE_ID as user_role_id, LAST_LOGIN as last_login, OA_ID as oa_id, OA_BRAND_ID as oa_brand_id, PASSWORD')
                ->where('EMAIL', $email)
                ->limit(1)
                ->get($this->table)
                ->row_array();
        if ( empty( $row ) ) return [];

        return password_verify($password, $row['PASSWORD']) ? $row : [];
        
    }

}
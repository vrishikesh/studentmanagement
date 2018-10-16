<?php

class Users_m extends CI_Model {

    const TABLE = 'users';
    const VIEW = 'users_vw';

    public function validate_login( string $email, string $password ) : array {

        $row = $this->db
                ->select('ID as user_id, USERNAME as username, EMAIL as email, IS_ADMIN as is_admin, USER_ROLE_ID as user_role_id, LAST_LOGIN as last_login, OA_ID as oa_id, OA_BRAND_ID as oa_brand_id, PASSWORD')
                ->where('EMAIL', $email)
                ->or_where('USERNAME', $email)
                ->limit(1)
                ->get(self::TABLE)
                ->row_array();
        if ( empty( $row ) ) return [];

        return password_verify($password, $row['PASSWORD']) ? $row : [];
        
    }

}
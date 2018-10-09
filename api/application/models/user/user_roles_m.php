<?php

class User_roles_m extends CI_Model {

    private $table = 'user_roles';
    private $view = 'user_roles_vw';

    public function __construct() {

        // $this->load->model(Path::Model . 'user/users');

    }

    public function get_module_list() : array {

        $user_role_id = $this->user->user_role_id();
        $sql = "
            SELECT ml.* 
            FROM `user_roles` ur, `module_list` ml
            WHERE FIND_IN_SET( ml.ID, ur.`PERMISSIONS` )
            AND ur.`ID` = '{$user_role_id}'
        ";
        $result = $this->db->query($sql)->result_array();
        $return = [];
        if ( $result )
        {
            foreach ($result as $row)
            {
                $return[ $row[ 'PARENT' ] ][] = $row;
            }
        }
        return $return;
        
    }

    public function create_module_list() : string {

        $permission_list = $this->user->permission_list();
        return $this->create_child_list( 0, $permission_list, '' );

    }

    public function create_child_list( $parent, $permission_list, $str ) : string {

        if ( isset( $permission_list[ $parent ] ) ) {
            
            foreach ($permission_list[ $parent ] as $key => $row) {
                
                $isThisMultiMenu = $permission_list[ $row[ 'ID' ] ] ?? FALSE;
                $treeview = $isThisMultiMenu ? 'treeview' : '';
                $right_icon = $isThisMultiMenu ? '<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>' : '';
                $ul_open = '<ul class="treeview-menu">';
                $ul_close = '</ul>';
                $icon = $row[ 'CLASS' ] ?? 'fa fa-circle-o';
                $url = $row[ 'URL' ] == '#' ? $row[ 'URL' ] : Url::Site . $row[ 'URL' ];

                $str .= '<li class="'. $treeview .'">';
                    $str .= '<a href="'. $url .'"><i class="'. $icon .'"></i> <span>'. $row['NAME'] .'</span>' . $right_icon . '</a>';
                    $str .= $isThisMultiMenu ? $ul_open . $this->create_child_list( $row[ 'ID' ], $permission_list, '' ) . $ul_close : '';
                $str .= '</li>';
    
            }
            return $str;

        } else return '';

    }

    public function generate_module_list( $parent, $permission_list, $spaces ) {

		if ( isset( $permission_list[ $parent ] ) ) {
            
            $str = '';
            foreach ($permission_list[ $parent ] as $key => $row) {
                
                $isThisMultiMenu = $permission_list[ $row[ 'ID' ] ] ?? FALSE;
                
                $str .= '<div>' . $spaces . '<input type="checkbox" class="minimal" name="module['. $row[ 'ID' ] .']" value="1"> <label for="module['. $row[ 'ID' ] .']"><h5>'. $row['NAME'] .'</h5></label></div>';
                $str .= $isThisMultiMenu ? $this->generate_module_list( $row[ 'ID' ], $permission_list, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ) : '';
    
            }
            return $str;

        } else return '';

	}

}
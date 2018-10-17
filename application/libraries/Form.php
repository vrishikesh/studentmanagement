<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form {

    private $CI;
    private $_html;

    public function __construct() {	
        
        $this->CI =& get_instance();
        $this->_html = '';

    }

    function open($title, $action = '', $attributes = array(), $hidden = array()) {

        $this->_html .= '<div class="modal fade" id="modal-default"><div class="modal-dialog modal-lg"><div class="modal-content box">';
        $this->_html .= form_open($action, $attributes, $hidden);
        $this->_html .= '<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button><h4 class="modal-title">'. $title .'</h4></div><div class="modal-body">';
        $this->_html .= '<div class="row" style="display: none;">
            <div class="form-group col-sm-12">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                </div>
            </div>
        </div>';
        return $this;

    }

    function row_open() {

        $this->_html .= '<div class="row">';
        return $this;

    }

    function input(array $data = [], string $label_text = '') {

        $id = $data['id'] ?? '';
        $value = $data['value'] ?? '';
        $extra = $data['extra'] ?? '';
        $parent_class = $data['parent_class'] ?? 'form-group col-sm-6';
        $required = ( isset( $data['required'] ) AND $data['required'] ) ? ' <span style="color:red;">*</span>' : '';
        $data['class'] = $data['class'] ?? 'form-control';

        $this->_html .= '<div class="' . $parent_class . '"><label for="'. $id .'">'. $label_text . $required .'</label>'. form_input($data, $value, $extra) .'</div>';
        return $this;

    }
    
    function textarea(array $data = [], string $label_text = '') {

        $id = $data['id'] ?? '';
        $value = $data['value'] ?? '';
        $extra = $data['extra'] ?? '';
        $parent_class = $data['parent_class'] ?? 'form-group col-sm-6';
        $required = ( isset( $data['required'] ) AND $data['required'] ) ? ' <span style="color:red;">*</span>' : '';
        $data['class'] = $data['class'] ?? 'form-control';

        $this->_html .= '<div class="' . $parent_class . '"><label for="'. $id .'">'. $label_text . $required .'</label>'. form_textarea($data, $value, $extra) .'</div>';
        return $this;

    }
    
    function select(array $data = [], string $label_text = '') {

        $id = $data['id'] ?? '';
        $extra = $data['extra'] ?? '';
        $parent_class = $data['parent_class'] ?? 'form-group col-sm-6';
        $required = ( isset( $data['required'] ) AND $data['required'] ) ? ' <span style="color:red;">*</span>' : '';
        $data['class'] = $data['class'] ?? 'form-control select2';
        $data['style'] = $data['style'] ?? 'width: 100%;';

        $this->_html .= '<div class="' . $parent_class . '"><label for="'. $id .'">'. $label_text . $required .'</label>'. form_dropdown($data, [], [], $extra) .'</div>';
        return $this;

    }

    function row_close() {

        $this->_html .= '</div>';
        return $this;

    }

    function close($extra = '') {

        $this->_html .= '</div>
        <div class="modal-footer">
            <input type="hidden" id="id" name="id">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">' . $this->CI->lang->line('close') . '</button>
            <button type="submit" class="btn btn-primary">' . $this->CI->lang->line('save_changes') . '</button>
        </div></form>' . $extra . '<div class="overlay" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div></div></div></div>';
        return $this;

    }

    function to_html() {

        return $this->_html;

    }

    function module_list( $generated_module_list ) {

        //  To use this element please load the user_roles_lang file 
        $this->_html .= '
        <div class="form-group col-sm-6">
            <label for="assigned_list">'. $this->CI->lang->line('module_list') .'</label>
            <div class="form-control module-list">
                '. $generated_module_list .'
            </div>
        </div>
        <div class="form-group col-sm-6">
            <label for="assigned_list"></label>
            <div class="">
                <div><input type="checkbox" class="minimal" id="selectall"><label for="selectall"><h5>&nbsp;&nbsp;'. $this->CI->lang->line('select_all') .'</h5></label></div>
                <div><input type="checkbox" class="minimal" id="unselectall"><label for="unselectall"><h5>&nbsp;&nbsp;'. $this->CI->lang->line('unselect_all') .'</h5></label></div>
            </div>
        </div>';
        return $this;

    }

}

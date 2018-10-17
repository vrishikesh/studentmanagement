<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

        /* COMMON :: ADMIN & PUBLIC */
        /* Load */
        // $this->output->enable_profiler();
        $this->load->library(array('form_validation', 'user_agent', 'mobile_detect', 'page_title', 'breadcrumbs', 'session', 'user', 'render', 'form'));
        $this->load->helper(array('array', 'language', 'url', 'menu', 'constant', 'form'));
        $this->lang->load('common');
        $this->input->is_ajax_request()
            ? define('CURRENT_URL', $this->agent->referrer() . '/')
            : define('CURRENT_URL', current_url() . '/');
        
        /* Data */
        // $this->data['lang']           = element($this->config->item('language'), $this->config->item('language_abbr'));
        $this->data['charset']        = $this->config->item('charset');
        $this->data['frameworks_dir'] = $this->config->item('frameworks_dir');
        $this->data['plugins_dir']    = $this->config->item('plugins_dir');
        $this->data['avatar_dir']     = $this->config->item('avatar_dir');

        /* Any mobile device (phones or tablets) */
        if ($this->mobile_detect->isMobile())
        {
            $this->data['mobile'] = TRUE;

            if ($this->mobile_detect->isiOS()){
                $this->data['ios']     = TRUE;
                $this->data['android'] = FALSE;
            }
            else if ($this->mobile_detect->isAndroidOS())
            {
                $this->data['ios']     = FALSE;
                $this->data['android'] = TRUE;
            }
            else
            {
                $this->data['ios']     = FALSE;
                $this->data['android'] = FALSE;
            }

            if ($this->mobile_detect->getBrowsers('IE')){
                $this->data['mobile_ie'] = TRUE;
            }
            else
            {
                $this->data['mobile_ie'] = FALSE;
            }
        }
        else
        {
            $this->data['mobile']    = FALSE;
            $this->data['ios']       = FALSE;
            $this->data['android']   = FALSE;
            $this->data['mobile_ie'] = FALSE;
        }

	}
}


class Admin_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

        if ( ! $this->user->logged_in())
        {
            redirect('login/login', 'refresh');
        }
        else
        {
            /* Load library function  */
            // $this->breadcrumbs->unshift(0, 'Dashboard', 'admin/dashboard');

            /* Data */
            // $this->data['title']       = $this->config->item('title');
            // $this->data['title_lg']    = $this->config->item('title_lg');
            // $this->data['title_mini']  = $this->config->item('title_mini');
        }
    }
}


class Public_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

        if ($this->user->logged_in() AND $this->router->method !== 'logout')
        {
            redirect('student/student_details', 'refresh');
        }
	}
}

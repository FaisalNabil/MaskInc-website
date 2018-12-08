<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/29/2018
 * Time: 1:44 PM
 */

class My_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $CI = & get_instance();
        $CI->load->library('session');
        $CI->load->helper('url');
        if ( !$this->session->userdata('loggedin'))
        {
            redirect('login');
        }
        if($this->session->userdata('change_pass_status') == 0) {
            redirect('change_password');
        }
    }
}
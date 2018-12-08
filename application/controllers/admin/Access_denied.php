<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Access_denied extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->session->set_userdata('sub_menu', '');
        $data['main_content'] = 'vw_access_denied';
        $this->load->view('vw_master', $data);
    }
}
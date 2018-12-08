<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'core/My_Controller.php');

class Home extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->session->set_userdata('main_menu', 'admin/home');
        $this->load->model('config_model');
        
    }

    public function index() {

        $this->session->set_userdata('sub_menu', '');

        $data['main_content'] = 'vw_home/vw_home';
        $this->load->view('vw_master', $data);
    }

    public function error_404() {
        $this->session->set_userdata('sub_menu', '');
        $data['alert_msg'] = 'admin/inc/message.php';
        $data['main_content'] = 'vw_404';
        $this->load->view('vw_master', $data);
    }



}
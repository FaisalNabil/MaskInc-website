<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
    }

    public function index()
    {
        if($this->session->userdata('loggedin') == 1) {
            redirect('admin/home');
        } else {
            $this->load->view('vw_login');
        }
    }

    public function login_check()
    {
        $resp = array('accessGranted' => false, 'errors' => '');

        if(isset($_POST['do_login'])) {
            $userid = $this->input->post('userid');
            $passwd = $this->input->post('passwd');
            $result = $this->login_model->login_check($userid, $passwd);
            if($result->num_rows() > 0) { //user exist
                    $login = $result->row();
                    if($login->status == 1 /*&& $user*/) {
                        $this->login_model->update_login_status($userid);
                        $session_data = array(
                            'loggedin'=> true,
                            'login_id'=> $login->login_id,
                            'change_pass_status'=> $login->change_pass_status,
                            'user_id'=>$login->user_id,
                            'user_name'=>$login->user_name,
                            'designation'=>$login->designation,
                            'user_type_id'=> $login->group_id
                        );
                        $this->session->set_userdata($session_data);

                        // get all permission for current user group
                        // set all permission list in session

                        if($this->session->userdata('change_pass_status')==0)
                        {
                            $resp['changePassword'] = true;
                        }
                        else
                        {
                            $resp['accessGranted'] = true;
                        }
                        $resp['accessGranted'] = true;
                    } else {
                        $resp['errors'] = '<strong>Blocked</strong><br />Can not login. Please contact with the admin<br />';
                    }
            } else {
                // Failed Attempts
                $fa = isset($_COOKIE['failed-attempts']) ? $_COOKIE['failed-attempts'] : 0;
                $fa++;

                setcookie('failed-attempts', $fa);

                // Error message
                $resp['errors'] = '<strong>Invalid login!</strong><br />Please enter valid userid and password.<br />';
            }
        }
        echo json_encode($resp);
    }

    public function logout()
    {

        $this->session->sess_destroy();
        redirect(base_url().'admin/login');
    }

    public function session()
    {
        $this->output->enable_profiler(TRUE);
    }

}
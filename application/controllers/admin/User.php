<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Riyad
 * Date: 4/5/2018
 * Time: 12:38 PM
 */

include_once(APPPATH . 'core/My_Controller.php');

class User extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->session->set_userdata('main_menu', 'User');
        $this->load->model('user_model');
        //echo $method = $this->router->fetch_class();
        //echo $method = $this->router->fetch_method();

    }

    public function add_user()
    {
        $this->session->set_userdata('sub_menu', 'Add User');
        $data['alert_msg'] = 'inc/message.php';
        $data['groups'] = $this->aauth->list_groups();
        $data['main_content'] = 'vw_users/vw_add_user';
        $this->load->view('vw_master', $data);
    }

    public function manage_users()
    {
        $this->session->set_userdata('sub_menu', 'Manage Users');
        $data['alert_msg'] = 'inc/message.php';
        //$data['users'] = $this->user_model->get_all_records('user_id, user_name, gender, phone_number, email, designation, address, status', 'tbl_user');
        $data['users'] = $this->user_model->get_all_users();
        //echo '<pre>';print_r($data['users']);die();
        $data['main_content'] = 'vw_users/vw_manage_users';
        $this->load->view('vw_master', $data);
    }

    public function check_user_id()
    {
        $user_id = $this->input->post('user_id');
        $result = $this->user_model->get_user_records('user_id,user_name', "user_id='$user_id'", 'tbl_user');
        //echo '<pre>';print_r($result);die();
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function user_status_post()
    {
        $user_id = $this->input->post('user_id');
        if ($user_id) {
            $this->user_model->setTable('tbl_user');
            $this->user_model->setPrimaryKey('user_id');
            $this->user_model->setSelector('user_id, user_name, status');
            $get_status = $this->user_model->get($user_id);
            if ($get_status->row()) {
                if ($get_status->row()->status == 1) {
                    $data['status'] = 0;
                    $update_status = $this->user_model->update($user_id, $data);
                } else {
                    $data['status'] = 1;
                    $update_status = $this->user_model->update($user_id, $data);
                }
                if ($update_status) {
                    $this->session->set_flashdata('success', 'Status changed successfully.');
                    return redirect('manage_users');
                } else {
                    $this->session->set_flashdata('error', 'Status change failed! Please try again.');
                    return redirect('manage_users');
                }
            }
        } else {
            $this->session->set_flashdata('error', 'Status cannot be changed!');
            return redirect('manage_users');
        }
    }

    public function user_add_post()
    {
        $this->form_validation->set_rules('user_id', 'user_id', 'required');
        $this->form_validation->set_rules('user_name', 'user_name', 'required');
        $this->form_validation->set_rules('gender', 'gender', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required|min_length[7]|max_length[14]');
        $this->form_validation->set_rules('designation', 'designation', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('group_id', 'group_id', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('add_new_user');
        } else {
            $user_data = array();
            $user_data['user_id'] = $this->input->post('user_id');
            $user_data['user_name'] = $this->input->post('user_name');
            $user_data['gender'] = $this->input->post('gender');
            $user_data['phone_number'] = $this->input->post('phone_number');
            $user_data['email'] = $this->input->post('email');
            $user_data['designation'] = $this->input->post('designation');
            $user_data['address'] = $this->input->post('address');
            $user_data['status'] = 1;
            $user_data['group_id'] = $this->input->post('group_id');
            // echo '<pre>';print_r($data);
            $login_data = array();
            $login_data['password'] = md5('welcome');
            $login_data['status'] = 1;
            $login_data['change_pass_status'] = 0;
            $login_data['tbl_user_user_id'] = $user_data['user_id'];
            // echo '<pre>';print_r($login_data);die();
            //$is_inserted = $this->user_model->insert_user_data($user_data, $login_data);
            if ($this->user_model->insert_user_data($user_data, $login_data)) {
                $this->session->set_flashdata('success', 'User Added successfully.');
                return redirect('manage_users');
            } else {
                $this->session->set_flashdata('error', 'Status change failed! Please try again.');
                return redirect('manage_users');
            }
        }
    }

    public function edit_user($id)
    {
        $this->user_model->setTable('tbl_user');
        $this->user_model->setPrimaryKey('user_id');
        $this->user_model->setSelector('user_id, user_name, gender, phone_number, email, designation, address, group_id');
        $get_user_info = $this->user_model->get($id);
        if ($get_user_info->row()) {
            $data['user_info'] = $get_user_info->row();
            $this->session->set_userdata('sub_menu', 'Manage Users');
            $data['alert_msg'] = 'inc/message.php';
            $data['groups'] = $this->aauth->list_groups();
            $data['main_content'] = 'vw_users/vw_edit_user';
            //echo '<pre>';print_r($get_user_info->row());die();
            $this->load->view('vw_master', $data);
        } else {
            return redirect('error_404');
        }
    }

    public function user_edit_post()
    {
        $user_id = $this->input->post('user_id');
        if ($_POST['user_name'] && $_POST['email'] && $_POST['phone_number'] && $_POST['designation'] && $_POST['address']) {
            $this->form_validation->set_rules('user_name', 'user_name', 'required');
            $this->form_validation->set_rules('gender', 'gender', 'required');
            $this->form_validation->set_rules('email', 'email', 'required|valid_email');
            $this->form_validation->set_rules('phone_number', 'phone_number', 'required|min_length[7]|max_length[14]');
            $this->form_validation->set_rules('designation', 'designation', 'required');
            $this->form_validation->set_rules('address', 'address', 'required');
            $this->form_validation->set_rules('group_id', 'group_id', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                return redirect('edit_user/'.$user_id, 'refresh');
            } else {
                $user_data = array();
                $user_data['user_name'] = $this->input->post('user_name');
                $user_data['gender'] = $this->input->post('gender');
                $user_data['phone_number'] = $this->input->post('phone_number');
                $user_data['email'] = $this->input->post('email');
                $user_data['designation'] = $this->input->post('designation');
                $user_data['address'] = $this->input->post('address');
                $user_data['group_id'] = $this->input->post('group_id');
                //echo '<pre>';print_r($user_data).die();
                $this->user_model->setTable('tbl_user');
                $this->user_model->setPrimaryKey('user_id');
                $is_updated = $this->user_model->update($user_id, $user_data);
                if ($is_updated) {
                    $this->session->set_flashdata('success', 'User info updated successfully.');
                    return redirect('manage_users');
                } else {
                    $this->session->set_flashdata('error', 'No changes found! Please try again.');
                    return redirect('edit_user/'.$user_id, 'refresh');
                }
            }
        }
    }
}
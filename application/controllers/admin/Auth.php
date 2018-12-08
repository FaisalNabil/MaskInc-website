<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Tahmid
 * Date: 4/5/2018
 * Time: 3:19 PM
 */
//include_once(APPPATH.'core/My_Controller.php');
class Auth extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->session->set_userdata('main_menu', 'admin console');
        $this->load->model('auth_model');
        $group = $this->session->userdata('user_type_id');
        if(!in_array($group, array(1))) {
            redirect(base_url('access_denied'));
        }
    }

    public function group()
    {
        $this->session->set_userdata('sub_menu', 'group');
        $data['group_list'] = $this->aauth->list_groups();
        $data['alert_msg'] = 'inc/message.php';
        $data['main_content'] = 'vw_admin_console/vw_group';
        $this->load->view('vw_master', $data);
    }

    public function save_group()
    {
        $this->form_validation->set_rules('name', 'Group Name', 'trim|required');
        if($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
        } else {
            $name = $this->input->post('name');
            $definition = $this->input->post('definition');
            if($this->aauth->create_group($name, $definition)) {
                $this->session->set_flashdata('success', 'Saved successfully');
            } else {
                $this->session->set_flashdata('error', 'Save Failed');
            }
        }
        redirect(base_url().'auth/group');
    }

    public function update_group($group_id)
    {
        $this->form_validation->set_rules('name', 'Group Name', 'trim|required');
        if($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
        } else {
            $name = $this->input->post('name');
            $definition = $this->input->post('definition');
            if($this->aauth->update_group($group_id, $name, $definition)) {
                $this->session->set_flashdata('success', 'Updated successfully');
            } else {
                $this->session->set_flashdata('error', 'Update Failed');
            }
        }
        redirect(base_url().'auth/group');
    }

    public function delete_group($group_id) 
    {
        $res = $this->auth_model->delete_group($group_id);
        if($res) {
            $this->session->set_flashdata('success', 'Successfully deleted');
        } else {
            $this->session->set_flashdata('error', 'Delete Failed');
        }
        redirect(base_url().'auth/group');
    }

    public function menu()
    {
        $this->session->set_userdata('sub_menu', 'menu');
        $data['menu_list'] = $this->auth_model->list_menu();
        $data['alert_msg'] = 'inc/message.php';
        $data['main_content'] = 'vw_admin_console/vw_menu';
        $this->load->view('vw_master', $data);
    }

    public function save_menu()
    {
        $this->form_validation->set_rules('menu_label', 'Menu Label', 'trim|required');
        if($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', 'Menu Save Failed!');
        } else {
            if($this->auth_model->save_menu()) {
                $this->session->set_flashdata('success', 'Menu Saved Successfully');
            } else {
                $this->session->set_flashdata('error', 'Menu Save Failed!');
            }
        }
        redirect(base_url().'admin/auth/menu');
    }

    public function edit_menu($menu_id)
    {
        $this->session->set_userdata('sub_menu', 'menu');
        $data['menu_data'] = $this->auth_model->menu_data($menu_id);
        $data['menu_list'] = $this->auth_model->list_menu();
        $data['menu_id'] = $menu_id;
        $data['alert_msg'] = 'inc/message.php';
        $data['main_content'] = 'vw_admin_console/vw_menu_edit';
        $this->load->view('vw_master', $data);
    }

    public function update_menu()
    {
        $this->form_validation->set_rules('menu_label', 'Menu Label', 'trim|required');
        if($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', 'Menu Update Failed!');
        } else {
            if($this->auth_model->update_menu()) {
                $this->session->set_flashdata('success', 'Menu Updated Successfully');
            } else {
                $this->session->set_flashdata('error', 'Menu Update Failed!');
            }
        }
        redirect(base_url().'admin/auth/menu');
    }

    public function delete_menu($menu_id)
    {
        $res = $this->auth_model->delete_menu($menu_id);
        if($res) {
            $this->session->set_flashdata('success', 'Menu Deleted Successfully');
        } else {
            $this->session->set_flashdata('error', 'Menu Delete Failed!');
        }
        redirect(base_url().'admin/auth/menu');
    }

    public function permission()
    {
        $this->session->set_userdata('sub_menu', 'permission');
        $data['perm_list'] = $this->aauth->list_perms();
        $data['alert_msg'] = 'inc/message.php';
        $data['main_content'] = 'vw_admin_console/vw_permission';
        $this->load->view('vw_master', $data);
    }

    public function save_perm()
    {
        $this->form_validation->set_rules('name', 'Permission Name', 'trim|required');
        $name = $this->input->post('name');
        $definition = $this->input->post('definition');
        if($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', 'Permission Save Failed!');
        } else {
            if($this->aauth->create_perm($name, $definition)) {
                $this->session->set_flashdata('success', 'Permission Saved Successfully');
            } else {
                $this->session->set_flashdata('error', 'Permission Save Failed!');
            }
        }
        redirect(base_url().'admin/auth/permission');
    }

    public function update_perm()
    {
        $this->form_validation->set_rules('name', 'Permission Name', 'trim|required');
        $id = $this->input->post('perm_id');
        $name = $this->input->post('name');
        $definition = $this->input->post('definition');
        if($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', 'Permission Update Failed!');
        } else {
            if($this->aauth->update_perm($id, $name, $definition)) {
                $this->session->set_flashdata('success', 'Permission Updated Successfully');
            } else {
                $this->session->set_flashdata('error', 'Permission Update Failed!');
            }
        }
        redirect(base_url().'admin/auth/permission');
    }

    public function delete_perm($perm_id)
    {
        $res = $this->aauth->delete_perm($perm_id);
        if($res) {
            $this->session->set_flashdata('success', 'Permissoin Deleted Successfully');
        } else {
            $this->session->set_flashdata('error', 'Permission Delete Failed!');
        }
        redirect(base_url().'admin/auth/permission');
    }

    public function config_group($group_id)
    {
        $this->session->set_userdata('sub_menu', 'group');
        $data['group_data'] = $this->auth_model->group_data($group_id);
        $data['menu_list'] = $this->auth_model->group_menu_list($group_id);
        $data['perm_list'] = $this->auth_model->group_perm_list($group_id);
        $data['user_list'] = $this->auth_model->group_user_list($group_id);
        $data['group_id'] = $group_id;
        $data['alert_msg'] = 'inc/message.php';
        $data['main_content'] = 'vw_admin_console/vw_group_config';
        $this->load->view('vw_master', $data);
    }

    public function save_group_menu($group_id)
    {
        $res = $this->auth_model->save_group_menu($group_id);
        if($res) {
            $this->session->set_flashdata('success', 'Group Menu Saved Successfully');
        } else {
            $this->session->set_flashdata('error', 'Group Menu Save Failed!');
        }
        redirect(base_url().'admin/auth/config_group/'.$group_id);
    }

    public function save_group_perms($group_id)
    {
        /*$group_perm_list = $this->input->post('group_perm_list');
        echo '<pre>';
        print_r($group_perm_list); die();*/
        $res = $this->auth_model->save_group_perms($group_id);
        if($res) {
            $this->session->set_flashdata('success', 'Group Permissoin Saved Successfully');
        } else {
            $this->session->set_flashdata('error', 'Group Permission Save Failed!');
        }
        redirect(base_url().'auth/config_group/'.$group_id);
    }

    public function save_group_user($group_id)
    {
        $res = $this->auth_model->save_group_user($group_id);
        if($res) {
            $this->session->set_flashdata('success', 'Group Users Saved Successfully');
        } else {
            $this->session->set_flashdata('error', 'Group Users Save Failed!');
        }
        redirect(base_url().'auth/config_group/'.$group_id);
    }

    public function user()
    {
        $this->session->set_userdata('sub_menu', 'user');
        $data['user_list'] = $this->aauth->list_users();
        $data['alert_msg'] = 'inc/message.php';
        $data['main_content'] = 'vw_admin_console/vw_user';
        $this->load->view('vw_master', $data);
    }

    public function add_user()
    {
        $this->session->set_userdata('sub_menu', 'user');
        $data['alert_msg'] = 'inc/message.php';
        $data['main_content'] = 'vw_admin_console/vw_add_user';
        $this->load->view('vw_master', $data);
    }

}
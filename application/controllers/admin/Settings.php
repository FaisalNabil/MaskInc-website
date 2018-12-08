<?php defined('BASEPATH') OR exit('No direct script access allowed');

class settings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->session->set_userdata('main_menu', 'Settings');
        $this->load->model('Settings_model');
        if (!$this->session->userdata('loggedin')) {
            redirect('login');
        }
    }

    // ##### Password Change #####
    public function change_password()
    {
        //echo 'yes';die();
        $this->session->set_userdata('main_menu', '');
        $data['alert_msg'] = 'inc/message.php';
        $data['left_menu'] = $this->aauth->get_menu();
        $data['main_content'] = 'vw_settings/vw_change_password';
        $this->load->view('vw_master', $data);
    }

    public function check_pass()
    {
        $id = $this->input->post('id');
        $pass = $this->input->post('pass');

        $result = $this->Settings_model->get_user_by_id_and_password($id,$pass);
        //echo '<pre>';print_r($result);die();
        if ($result) {
            echo $result->login_id;
        } else {
            echo '';
        }
    }

    public function password_change()
    {
        $this->Settings_model->setTable('tbl_login');
        $this->Settings_model->setPrimaryKey('login_id');
        $repeat_p = $this->input->post('repeat_p');
        $login_id = $this->input->post('login_id2');
        //print_r($repeat_p.' '.$login_id);die();
        $result = $this->Settings_model->update($login_id, array('password' => md5('welcome'), 'change_pass_status' => 1));
        if ($result) {
            $this->session->set_userdata('change_pass_status', '1');
            $this->session->set_flashdata('success', 'Password Successfully Changed');
            redirect(base_url() . 'home', 'refresh');
        } else {
            $this->session->set_userdata('change_pass_status', '1');
            $this->session->set_flashdata('success', 'An error occurred! Please try again!');
            redirect(base_url() . 'change_password', 'refresh');
        }

    }
    // ##### Password Change Ends #####

    // ##### Company #####
    public function add_company()
    {
        $this->session->set_userdata('sub_menu', 'Manage Companies');
        $data['alert_msg'] = 'inc/message.php';
        $data['main_content'] = 'vw_settings/vw_add_organization';
        $this->load->view('vw_master', $data);
    }

    public function manage_companies()
    {
        $this->session->set_userdata('sub_menu', 'Manage Companies');
        $data['alert_msg'] = 'inc/message.php';
        $this->Settings_model->setTable('tbl_company_info');
        $this->Settings_model->setPrimaryKey('tbl_company_info_id');
        $this->Settings_model->setSelector('tbl_company_info_id, company_name,address,phone_number,email,website,description,status');
        $data['organizations'] = $this->Settings_model->get()->result();
        //echo '<pre>';print_r($data['organizations']);die();
        $data['main_content'] = 'vw_settings/vw_manage_organizations';
        $this->load->view('vw_master', $data);
    }

    public function company_add_post()
    {
        $this->Settings_model->setTable('tbl_company_info');
        $this->form_validation->set_rules('company_name', 'Company Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|min_length[7]|max_length[14]');
        $this->form_validation->set_rules('address', 'Address', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('add_new_company');
        } else {
            $org_data = array();
            $org_data['company_name'] = $this->input->post('company_name');
            $org_data['phone_number'] = $this->input->post('phone_number');
            $org_data['email'] = $this->input->post('email');
            $org_data['website'] = $this->input->post('website');
            $org_data['address'] = $this->input->post('address');
            $org_data['description'] = $this->input->post('description');
            //$org_data['organization_name'] = $this->input->post('organization_name');
            $org_data['status'] = 1;
            $org_data['created_on'] = date('Y-m-d');
            //echo '<pre>';print_r($org_data);die();
            $check_name = $this->Settings_model->get_all_records('tbl_company_info_id, company_name', "company_name='$org_data[organization_name]'", 'tbl_company_info');
            if ($check_name) {
                $this->session->set_flashdata('error', 'Company already exists! Please try again!');
                return redirect('add_new_company', 'refresh');
            } else {
                if ($_FILES['picture']['name']) {
                    if ($_FILES['picture']['size'] > 1048576) {
                        $this->session->set_flashdata('error', 'Picture size exceeds maximum size limit! Please try again!');
                        return redirect('add_new_company', 'refresh');
                    } else {
                        $image_ext = explode('.', $_FILES['picture']['name']);
                        $extension = end($image_ext);
                        if ($extension == 'jpg' || $extension == 'png' || $extension == 'JPEG' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'PNG') {
                            $target_path = 'uploads/organization/org_image_' . rand(10 * 10, 500 * 500) . '.' . $extension;
                            if (move_uploaded_file($_FILES['picture']['tmp_name'], $target_path)) {
                                $org_data['picture'] = $target_path;
                                //echo '<pre>';print_r($org_data);die();
                                $is_inserted = $this->Settings_model->insert($org_data);
                                //print_r($is_inserted);die();
                                if ($is_inserted) {
                                    $this->session->set_flashdata('success', 'Company Info Has Been Added Successfully!');
                                    return redirect('manage_companies', 'refresh');
                                } else {
                                    $this->session->set_flashdata('error', 'An error occurred! Please try again!');
                                    return redirect('add_new_company', 'refresh');
                                }
                            } else {
                                $this->session->set_flashdata('error', 'Server error occurred! Please try again!');
                                return redirect('add_new_company', 'refresh');
                            }
                        } else {
                            $this->session->set_flashdata('error', 'Image extension must be jpg/png/jpeg! Please try again.');
                            return redirect('add_new_company', 'refresh');
                        }
                    }
                } else {
                    //echo '<pre>';print_r($org_data);die();
                    $is_inserted = $this->Settings_model->insert($org_data);
                    if ($is_inserted) {
                        $this->session->set_flashdata('success', 'Company Info Has Been Added Successfully!');
                        return redirect('manage_companies', 'refresh');
                    } else {
                        $this->session->set_flashdata('error', 'An error occurred! Please try again!');
                        return redirect('add_new_company', 'refresh');
                    }
                }
            }
        }
    }

    public function company_status_post()
    {
        $org_id = $this->input->post('organization_id');
        if ($org_id) {
            $this->Settings_model->setTable('tbl_company_info');
            $this->Settings_model->setPrimaryKey('tbl_company_info_id');
            $this->Settings_model->setSelector('tbl_company_info_id, company_name, status');
            $get_status = $this->Settings_model->get($org_id);
            if ($get_status->row()) {
                if ($get_status->row()->status == 1) {
                    $data['status'] = 0;
                    $update_status = $this->Settings_model->update($org_id, $data);
                } else {
                    $data['status'] = 1;
                    $update_status = $this->Settings_model->update($org_id, $data);
                }
                if ($update_status) {
                    $this->session->set_flashdata('success', 'Company Status changed successfully.');
                    return redirect('manage_companies');
                } else {
                    $this->session->set_flashdata('error', 'Status change failed! Please try again.');
                    return redirect('manage_companies');
                }
            }
        } else {
            $this->session->set_flashdata('error', 'Status cannot be changed!');
            return redirect('manage_companies');
        }
    }

    public function edit_company($id)
    {
        $this->Settings_model->setTable('tbl_company_info');
        $this->Settings_model->setPrimaryKey('tbl_company_info_id');
        $this->Settings_model->setSelector('tbl_company_info_id, company_name, address, phone_number, email, website, description, picture');
        $get_org_info = $this->Settings_model->get($id);
        if ($get_org_info->row()) {
            $data['org_info'] = $get_org_info->row();
            $this->session->set_userdata('sub_menu', 'Manage Companies');
            $data['alert_msg'] = 'inc/message.php';
            $data['main_content'] = 'vw_settings/vw_edit_organization';
            //echo '<pre>';print_r($data['org_info']);die();
            $this->load->view('vw_master', $data);
        } else {
            return redirect('error_404');
        }
    }

    public function company_edit_post()
    {
        $org_id = $this->input->post('organization_id');
        $this->Settings_model->setTable('tbl_company_info');
        $this->form_validation->set_rules('company_name', 'Company Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|min_length[7]|max_length[14]');
        $this->form_validation->set_rules('address', 'Address', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('edit_company/' . $org_id, 'refresh');
        } else {
            $org_data = array();
            $org_data['company_name'] = $this->input->post('company_name');
            $org_data['phone_number'] = $this->input->post('phone_number');
            $org_data['email'] = $this->input->post('email');
            $org_data['website'] = $this->input->post('website');
            $org_data['address'] = $this->input->post('address');
            $org_data['description'] = $this->input->post('description');

            $this->Settings_model->setTable('tbl_company_info');
            $this->Settings_model->setPrimaryKey('tbl_company_info_id');
            //echo '<pre>';print_r($org_data);die();
            if (isset($_FILES['picture'])) {
                if ($_FILES['picture']['error'] == 4) {
                    $is_updated = $this->Settings_model->update($org_id, $org_data);
                    if ($is_updated) {
                        $this->session->set_flashdata('success', 'Company Info Has Been Updated Successfully!');
                        redirect('manage_companies', 'refresh');
                    } else {
                        $this->session->set_flashdata('error', 'No changes found! Please try again.');
                        return redirect('edit_company/' . $org_id, 'refresh');
                    }
                } else {
                    $old_img = $this->input->post('old_img');
                    $image_ext = explode('.', $_FILES['picture']['name']);
                    $extension = end($image_ext);
                    if ($extension == 'jpg' || $extension == 'png' || $extension == 'JPEG' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'PNG') {
                        $target_path = 'uploads/organization/org_image_' . rand(10 * 10, 500 * 500) . '.' . $extension;
                        if (move_uploaded_file($_FILES['picture']['tmp_name'], $target_path)) {
                            unlink($old_img);
                            $org_data['picture'] = $target_path;
                            //echo '<pre>';print_r($data);die();
                            $is_updated = $this->Settings_model->update($org_id, $org_data);
                            if ($is_updated) {
                                $this->session->set_flashdata('success', 'Company Info Has Been Updated Successfully!');
                                redirect('manage_companies', 'refresh');
                            } else {
                                $this->session->set_flashdata('error', 'An error occurred! Please Try Again.');
                                return redirect('edit_company/' . $org_id, 'refresh');
                            }
                        } else {
                            $this->session->set_flashdata('error', 'Server error occurred! Please Try Again.');
                            return redirect('edit_company/' . $org_id, 'refresh');
                        }
                    } else {
                        $this->session->set_flashdata('error', 'Image should be png/PNG/jpg/JPG/jpeg/JPEG/gif/GIF format and Image should be less than 1 MB.');
                        return redirect('edit_company/' . $org_id, 'refresh');
                    }
                }
            } else {
                $is_updated = $this->Settings_model->update($org_id, $org_data);
                if ($is_updated) {
                    $this->session->set_flashdata('success', 'Company Info Has Been Updated Successfully!');
                    redirect('manage_companies', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'No changes found! Please try again.');
                    return redirect('edit_company/' . $org_id, 'refresh');
                }
            }
        }
    }

    public function check_company_name()
    {
        $company_name = $this->input->post('company_name');
        $result = $this->Settings_model->get_all_records('tbl_company_info_id, company_name', "company_name='$company_name'", 'tbl_company_info');
        //print_r($result);die();
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }

    // ##### Company Ends #####

    // ##### Project Type #####

    public function manage_project_types()
    {
        $this->session->set_userdata('sub_menu', 'Manage Project Types');
        $data['alert_msg'] = 'inc/message.php';
        $this->Settings_model->setTable('tbl_project_type');
        $this->Settings_model->setPrimaryKey('tbl_project_type_id');
        $data['project_types'] = $this->Settings_model->get()->result();

//        echo '<pre>';print_r($data['project_types']);die();
        $data['main_content'] = 'vw_settings/vw_manage_project_types';
        $this->load->view('vw_master', $data);
    }

    public function project_type_add_post()
    {
        $this->Settings_model->setTable('tbl_project_type');
        $this->form_validation->set_rules('e_project_type_name', 'Project Type Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('manage_project_types');
        } else {
            $data = array();
            $data['project_type_name'] = $this->input->post('e_project_type_name');
            $data['status'] = 1;
            $data['created_on'] = date('Y-m-d');
            //echo '<pre>';print_r($org_data);die();
            $check_name = $this->Settings_model->get_all_records('tbl_project_type_id, project_type_name', "project_type_name='$data[project_type_name]'", 'tbl_project_type');
            if ($check_name) {
                $this->session->set_flashdata('error', 'Project type already exists! Please try again!');
                return redirect('manage_project_types', 'refresh');
            } else {
                $is_inserted = $this->Settings_model->insert($data);
                if ($is_inserted) {
                    $this->session->set_flashdata('success', 'Project Type Has Been Added Successfully!');
                    return redirect('manage_project_types', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'An error occurred! Please try again!');
                    return redirect('manage_project_types', 'refresh');
                }
            }
        }
    }

    public function project_type_edit_post()
    {
        $type_id = $this->input->post('type_id');
        $this->Settings_model->setTable('tbl_project_type');
        $this->Settings_model->setPrimaryKey('tbl_project_type_id');
        $this->form_validation->set_rules('project_type_name', 'Project Type Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('manage_project_types');
        } else {
            $data = array();
            $data['project_type_name'] = $this->input->post('project_type_name');
            //echo '<pre>';print_r($org_data);die();
            $check_name = $this->Settings_model->get_all_records('tbl_project_type_id, project_type_name', "project_type_name='$data[project_type_name]' AND tbl_project_type_id != $type_id", 'tbl_project_type');
            if ($check_name) {
                $this->session->set_flashdata('error', 'Project type already exists! Please try again!');
                return redirect('manage_project_types', 'refresh');
            } else {
                $is_updated = $this->Settings_model->update($type_id, $data);
                if ($is_updated) {
                    $this->session->set_flashdata('success', 'Project Type Has Been Updated Successfully!');
                    return redirect('manage_project_types', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'No changes found! Please try again.');
                    return redirect('manage_project_types', 'refresh');
                }
            }
        }
    }

    public function project_type_status_post()
    {
        $id = $this->input->post('project_type_id');
        if ($id) {
            $this->Settings_model->setTable('tbl_project_type');
            $this->Settings_model->setPrimaryKey('tbl_project_type_id');
            //$this->Settings_model->setSelector('tbl_organization_info_id, organization_name, status');
            $get_status = $this->Settings_model->get($id);
            if ($get_status->row()) {
                if ($get_status->row()->status == 1) {
                    $data['status'] = 0;
                    $update_status = $this->Settings_model->update($id, $data);
                } else {
                    $data['status'] = 1;
                    $update_status = $this->Settings_model->update($id, $data);
                }
                if ($update_status) {
                    $this->session->set_flashdata('success', 'Project Type Status changed successfully.');
                    return redirect('manage_project_types');
                } else {
                    $this->session->set_flashdata('error', 'Status change failed! Please try again.');
                    return redirect('manage_project_types');
                }
            }
        } else {
            $this->session->set_flashdata('error', 'Status cannot be changed!');
            return redirect('manage_project_types');
        }
    }

    public function check_project_type_name()
    {
        $type_name = $this->input->post('type_name');
        $result = $this->Settings_model->get_all_records('tbl_project_type_id, project_type_name', "project_type_name='$type_name'", 'tbl_project_type');
        //print_r($result);die();
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }

    // ##### Project Type Ends #####

    // ##### Vendor #####

    public function manage_vendors()
    {
        $this->session->set_userdata('sub_menu', 'Manage Vendors');
        $data['alert_msg'] = 'inc/message.php';
        $this->Settings_model->setTable('tbl_vendor');
        $this->Settings_model->setPrimaryKey('tbl_vendor_id');
        $data['vendors'] = $this->Settings_model->get()->result();
        //echo '<pre>';print_r($data['vendors']);die();
        $data['main_content'] = 'vw_settings/vw_manage_vendors';
        $this->load->view('vw_master', $data);
    }

    public function add_vendor()
    {
        $this->session->set_userdata('sub_menu', 'Manage Vendors');
        $data['alert_msg'] = 'inc/message.php';
        //echo '<pre>';print_r($data['vendors']);die();
        $data['main_content'] = 'vw_settings/vw_add_vendor';
        $this->load->view('vw_master', $data);
    }

    public function vendor_add_post()
    {
        // echo '<pre>';print_r($_FILES);die();
        if ($this->form_validation->run('add_vendor_form') == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('add_new_vendor');
        } else {
            //echo '<pre>';print_r($_POST);die();
            $data = array();
            $this->Settings_model->setTable('tbl_vendor');
            $this->Settings_model->setPrimaryKey('tbl_vendor_id');
            $name = $this->input->post('vendor_name');
            $check_name = $this->Settings_model->get_all_records('tbl_vendor_id, vendor_name', "vendor_name='$name'", 'tbl_vendor');
            if ($check_name) {
                $this->session->set_flashdata('error', 'Vendor already exists! Please try again!');
                return redirect('add_new_vendor', 'refresh');
            } else {
                if ($_FILES['picture']['name']) {
                    if ($_FILES['picture']['size'] > 1048576) {
                        $this->session->set_flashdata('error', 'Picture size exceeds maximum size limit! Please try again!');
                        return redirect('add_new_vendor', 'refresh');
                    } else {
                        $image_ext = explode('.', $_FILES['picture']['name']);
                        $extension = end($image_ext);
                        if ($extension == 'jpg' || $extension == 'png' || $extension == 'JPEG' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'PNG') {
                            $target_path = 'uploads/vendor/vendor_image_' . rand(10 * 10, 500 * 500) . '.' . $extension;
                            if (move_uploaded_file($_FILES['picture']['tmp_name'], $target_path)) {
                                $data['vendor_name'] = $this->input->post('vendor_name');
                                if ($this->input->post('email')) {
                                    $data['email'] = $this->input->post('email');
                                }
                                $data['picture'] = $target_path;
                                $data['phone_number'] = $this->input->post('phone_number');
                                $data['address'] = $this->input->post('address');
                                $data['status'] = 1;
                                $data['created_on'] = date('Y-m-d');
                                //echo '<pre>';print_r($data);die();
                                $is_inserted = $this->Settings_model->insert($data);
                                if ($is_inserted) {
                                    $this->session->set_flashdata('success', 'Vendor Info Added successfully.');
                                    return redirect('manage_vendors');
                                } else {
                                    $this->session->set_flashdata('error', 'An error occurred! Please try Again.');
                                    return redirect('add_new_vendor');
                                }
                            } else {
                                $this->session->set_flashdata('error', 'Server error occurred! Please try again!');
                                return redirect('add_new_vendor', 'refresh');
                            }
                        } else {
                            $this->session->set_flashdata('error', 'Image extension must be jpg/png/jpeg! Please try again.');
                            return redirect('add_new_vendor', 'refresh');
                        }
                    }
                } else {
                    $data['vendor_name'] = $this->input->post('vendor_name');
                    if ($this->input->post('email')) {
                        $data['email'] = $this->input->post('email');
                    }
                    $data['phone_number'] = $this->input->post('phone_number');
                    $data['address'] = $this->input->post('address');
                    $data['status'] = 1;
                    $data['created_on'] = date('Y-m-d');
                    //echo '<pre>';print_r($data);die();
                    $is_inserted = $this->Settings_model->insert($data);
                    if ($is_inserted) {
                        $this->session->set_flashdata('success', 'Vendor Info Added successfully.');
                        return redirect('manage_vendors');
                    } else {
                        $this->session->set_flashdata('error', 'An error occurred! Please try Again.');
                        return redirect('add_new_vendor');
                    }
                }
            }
        }
    }

    public function vendor_status_post()
    {
        $id = $this->input->post('vendor_id');
        if ($id) {
            $this->Settings_model->setTable('tbl_vendor');
            $this->Settings_model->setPrimaryKey('tbl_vendor_id');
            //$this->Settings_model->setSelector('tbl_organization_info_id, organization_name, status');
            $get_status = $this->Settings_model->get($id);
            if ($get_status->row()) {
                if ($get_status->row()->status == 1) {
                    $data['status'] = 0;
                    $update_status = $this->Settings_model->update($id, $data);
                } else {
                    $data['status'] = 1;
                    $update_status = $this->Settings_model->update($id, $data);
                }
                if ($update_status) {
                    $this->session->set_flashdata('success', 'Vendor Status changed successfully.');
                    return redirect('manage_vendors');
                } else {
                    $this->session->set_flashdata('error', 'Status change failed! Please try again.');
                    return redirect('manage_vendors');
                }
            }
        } else {
            $this->session->set_flashdata('error', 'Status cannot be changed!');
            return redirect('manage_vendors');
        }
    }

    public function edit_vendor($id)
    {
        $this->Settings_model->setTable('tbl_vendor');
        $this->Settings_model->setPrimaryKey('tbl_vendor_id');
        $get_vendor_info = $this->Settings_model->get($id);
        if ($get_vendor_info->row()) {
            $data['vendor_info'] = $get_vendor_info->row();
            $this->session->set_userdata('sub_menu', 'Manage Vendors');
            $data['alert_msg'] = 'inc/message.php';
            $data['main_content'] = 'vw_settings/vw_edit_vendor';
            //echo '<pre>';print_r($data['org_info']);die();
            $this->load->view('vw_master', $data);
        } else {
            return redirect('error_404');
        }
    }

    public function vendor_edit_post()
    {
        // echo '<pre>';print_r($_FILES);die();
        $id = $this->input->post('vendor_id');
        if ($this->form_validation->run('add_vendor_form') == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('edit_vendor/') . $id;
        } else {
            //echo '<pre>';print_r($_POST);die();
            $data = array();
            $data['vendor_name'] = $this->input->post('vendor_name');
            $check_name = $this->Settings_model->get_all_records('tbl_vendor_id, vendor_name', "vendor_name='$data[vendor_name]' AND tbl_vendor_id != $id", 'tbl_vendor');
            if ($check_name) {
                $this->session->set_flashdata('error', 'Vendor already exists! Please try again!');
                return redirect('edit_vendor/' . $id, 'refresh');
            } else {
                if ($this->input->post('email')) {
                    $data['email'] = $this->input->post('email');
                }
                $data['phone_number'] = $this->input->post('phone_number');
                $data['address'] = $this->input->post('address');

                $this->Settings_model->setTable('tbl_vendor');
                $this->Settings_model->setPrimaryKey('tbl_vendor_id');
                //echo '<pre>';print_r($data);die();
                if (isset($_FILES['picture'])) {
                    if ($_FILES['picture']['error'] == 4) {
                        $is_updated = $this->Settings_model->update($id, $data);
                        if ($is_updated) {
                            $this->session->set_flashdata('success', 'Vendor Info Has Been Updated Successfully!');
                            return redirect('manage_vendors', 'refresh');
                        } else {
                            $this->session->set_flashdata('error', 'No changes found! Please try again.');
                            return redirect('edit_vendor/' . $id, 'refresh');
                        }
                    } else {
                        $old_img = $this->input->post('old_img');
                        $image_ext = explode('.', $_FILES['picture']['name']);
                        $extension = end($image_ext);
                        if ($extension == 'jpg' || $extension == 'png' || $extension == 'JPEG' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'PNG') {
                            $target_path = 'uploads/vendor/vendor_image_' . rand(10 * 10, 500 * 500) . '.' . $extension;
                            if (move_uploaded_file($_FILES['picture']['tmp_name'], $target_path)) {
                                if ($old_img) {
                                    unlink($old_img);
                                }
                                $data['picture'] = $target_path;
                                //echo '<pre>';print_r($data);die();
                                $is_updated = $this->Settings_model->update($id, $data);
                                if ($is_updated) {
                                    $this->session->set_flashdata('success', 'Vendor Info Has Been Updated Successfully!');
                                    return redirect('manage_vendors', 'refresh');
                                } else {
                                    $this->session->set_flashdata('error', 'An error occurred! Please Try Again.');
                                    return redirect('edit_vendor/' . $id, 'refresh');
                                }
                            } else {
                                $this->session->set_flashdata('error', 'Server error occurred! Please Try Again.');
                                return redirect('edit_vendor/' . $id, 'refresh');
                            }
                        } else {
                            $this->session->set_flashdata('error', 'Image should be png/PNG/jpg/JPG/jpeg/JPEG/gif/GIF format and Image should be less than 1 MB.');
                            return redirect('edit_vendor/' . $id, 'refresh');
                        }
                    }
                } else {
                    $is_updated = $this->Settings_model->update($id, $data);
                    if ($is_updated) {
                        $this->session->set_flashdata('success', 'Vendor Info Has Been Updated Successfully!');
                        return redirect('manage_vendors', 'refresh');
                    } else {
                        $this->session->set_flashdata('error', 'No changes found! Please try again.');
                        return redirect('edit_vendor/' . $id, 'refresh');
                    }
                }
            }
        }
    }

    public function check_vendor_name()
    {
        $type_name = $this->input->post('vendor_name');
        $result = $this->Settings_model->get_all_records('tbl_vendor_id, vendor_name', "vendor_name='$type_name'", 'tbl_vendor');
        //print_r($company_name);die();
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }

    // ##### Vendor Ends #####

    // ##### Product Type #####

    public function manage_product_types()
    {
        $this->session->set_userdata('sub_menu', 'Manage Product Types');
        $data['alert_msg'] = 'inc/message.php';
        $this->Settings_model->setTable('tbl_product_type');
        $this->Settings_model->setPrimaryKey('tbl_product_type_id');
        $data['product_types'] = $this->Settings_model->get()->result();

//        echo '<pre>';print_r($data['project_types']);die();
        $data['main_content'] = 'vw_settings/vw_manage_product_types';
        $this->load->view('vw_master', $data);
    }

    public function product_type_add_post()
    {
        $this->Settings_model->setTable('tbl_product_type');
        $this->form_validation->set_rules('e_product_type_name', 'Product Type Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('manage_product_types');
        } else {
            $data = array();
            $data['product_type_name'] = $this->input->post('e_product_type_name');
            $data['status'] = 1;
            $data['created_on'] = date('Y-m-d');
            //echo '<pre>';print_r($org_data);die();
            $check_name = $this->Settings_model->get_all_records('tbl_product_type_id, product_type_name', "product_type_name='$data[product_type_name]'", 'tbl_product_type');
            if ($check_name) {
                $this->session->set_flashdata('error', 'Product type already exists! Please try again!');
                return redirect('manage_product_types', 'refresh');
            } else {
                $is_inserted = $this->Settings_model->insert($data);
                if ($is_inserted) {
                    $this->session->set_flashdata('success', 'Product Type Has Been Added Successfully!');
                    return redirect('manage_product_types', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'An error occurred! Please try again!');
                    return redirect('manage_product_types', 'refresh');
                }
            }
        }
    }

    public function product_type_edit_post()
    {
        $type_id = $this->input->post('type_id');
        $this->Settings_model->setTable('tbl_product_type');
        $this->Settings_model->setPrimaryKey('tbl_product_type_id');
        $this->form_validation->set_rules('product_type_name', 'Product Type Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('manage_product_types');
        } else {
            $data = array();
            $data['product_type_name'] = $this->input->post('product_type_name');
            //echo '<pre>';print_r($org_data);die();
            $check_name = $this->Settings_model->get_all_records('tbl_product_type_id, product_type_name', "product_type_name='$data[product_type_name]' AND tbl_product_type_id != $type_id", 'tbl_product_type');
            if ($check_name) {
                $this->session->set_flashdata('error', 'Product type already exists! Please try again!');
                return redirect('manage_product_types', 'refresh');
            } else {
                $is_updated = $this->Settings_model->update($type_id, $data);
                if ($is_updated) {
                    $this->session->set_flashdata('success', 'Product Type Has Been Updated Successfully!');
                    return redirect('manage_product_types', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'No changes found! Please try again.');
                    return redirect('manage_product_types', 'refresh');
                }
            }
        }
    }

    public function product_type_status_post()
    {
        $id = $this->input->post('product_type_id');
        if ($id) {
            $this->Settings_model->setTable('tbl_product_type');
            $this->Settings_model->setPrimaryKey('tbl_product_type_id');
            //$this->Settings_model->setSelector('tbl_organization_info_id, organization_name, status');
            $get_status = $this->Settings_model->get($id);
            if ($get_status->row()) {
                if ($get_status->row()->status == 1) {
                    $data['status'] = 0;
                    $update_status = $this->Settings_model->update($id, $data);
                } else {
                    $data['status'] = 1;
                    $update_status = $this->Settings_model->update($id, $data);
                }
                if ($update_status) {
                    $this->session->set_flashdata('success', 'Product Type Status changed successfully.');
                    return redirect('manage_product_types');
                } else {
                    $this->session->set_flashdata('error', 'Status change failed! Please try again.');
                    return redirect('manage_product_types');
                }
            } else {
                $this->session->set_flashdata('error', 'Product type not found! Status change failed!');
                return redirect('manage_product_types');
            }
        } else {
            $this->session->set_flashdata('error', 'Status cannot be changed!');
            return redirect('manage_product_types');
        }
    }

    public function check_product_type_name()
    {
        $type_name = $this->input->post('type_name');
        $result = $this->Settings_model->get_all_records('tbl_product_type_id, product_type_name', "product_type_name='$type_name'", 'tbl_product_type');
        //print_r($company_name);die();
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }

    // ##### Product Type Ends #####

    // ##### Brand #####
    public function manage_brands()
    {
        $this->session->set_userdata('sub_menu', 'Manage Brands');
        $data['alert_msg'] = 'inc/message.php';
        $this->Settings_model->setTable('tbl_brand');
        $this->Settings_model->setPrimaryKey('tbl_brand_id');
        $data['brands'] = $this->Settings_model->get()->result();

//        echo '<pre>';print_r($data['project_types']);die();
        $data['main_content'] = 'vw_settings/vw_manage_brands';
        $this->load->view('vw_master', $data);
    }

    public function brand_status_post()
    {
        $id = $this->input->post('brand_id');
        if ($id) {
            $this->Settings_model->setTable('tbl_brand');
            $this->Settings_model->setPrimaryKey('tbl_brand_id');
            $get_status = $this->Settings_model->get($id);
            if ($get_status->row()) {
                if ($get_status->row()->status == 1) {
                    $data['status'] = 0;
                    $update_status = $this->Settings_model->update($id, $data);
                } else {
                    $data['status'] = 1;
                    $update_status = $this->Settings_model->update($id, $data);
                }
                if ($update_status) {
                    $this->session->set_flashdata('success', 'Brand Status changed successfully.');
                    return redirect('manage_brands');
                } else {
                    $this->session->set_flashdata('error', 'Status change failed! Please try again.');
                    return redirect('manage_brands');
                }
            }
        } else {
            $this->session->set_flashdata('error', 'Status cannot be changed!');
            return redirect('manage_brands');
        }
    }

    public function brand_add_post()
    {
        $this->Settings_model->setTable('tbl_brand');
        $this->form_validation->set_rules('a_brand_name', 'Brand Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('manage_brands');
        } else {
            $data = array();
            $data['brand_name'] = $this->input->post('a_brand_name');
            $data['description'] = $this->input->post('description');
            $data['status'] = 1;
            $data['created_on'] = date('Y-m-d');
            //echo '<pre>';print_r($org_data);die();
            $check_name = $this->Settings_model->get_all_records('tbl_brand_id, brand_name', "brand_name='$data[brand_name]'", 'tbl_brand');
            if ($check_name) {
                $this->session->set_flashdata('error', 'Brand already exists! Please try again!');
                return redirect('manage_brands', 'refresh');
            } else {
                $is_inserted = $this->Settings_model->insert($data);
                if ($is_inserted) {
                    $this->session->set_flashdata('success', 'Brand Has Been Added Successfully!');
                    return redirect('manage_brands', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'An error occurred! Please try again!');
                    return redirect('manage_brands', 'refresh');
                }
            }
        }
    }

    public function check_brand_name()
    {
        $brand_name = $this->input->post('brand_name');
        $result = $this->Settings_model->get_all_records('tbl_brand_id, brand_name', "brand_name='$brand_name'", 'tbl_brand');
        //print_r($brand_name);die();
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function check_brand_name_edit_availability()
    {
        $brand_id = $this->input->post('brand_id');
        $brand_name = $this->input->post('brand_name');
        $result = $this->Settings_model->get_all_records('tbl_brand_id, brand_name', "brand_name='$brand_name' AND tbl_brand_id != '$brand_id'", 'tbl_brand');
        //print_r($brand_name);die();
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function brand_edit_post()
    {
        $brand_id = $this->input->post('brand_id');

        $this->Settings_model->setTable('tbl_brand');
        $this->Settings_model->setPrimaryKey('tbl_brand_id');

        $this->form_validation->set_rules('brand_name', 'Brand Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('manage_brands');
        } else {
            $data = array();
            $data['brand_name'] = $this->input->post('brand_name');
            $data['description'] = $this->input->post('description');
            //echo '<pre>';print_r($org_data);die();
            $check_name = $this->Settings_model->get_all_records('tbl_brand_id, brand_name', "brand_name='$data[brand_name]' AND tbl_brand_id != $brand_id", 'tbl_brand');
            if ($check_name) {
                $this->session->set_flashdata('error', 'Brand already exists! Please try again!');
                return redirect('manage_brands', 'refresh');
            } else {
                $is_updated = $this->Settings_model->update($brand_id, $data);
                if ($is_updated) {
                    $this->session->set_flashdata('success', 'Brand Has Been Updated Successfully!');
                    return redirect('manage_brands', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'No changes found! Please try again.');
                    return redirect('manage_brands', 'refresh');
                }
            }
        }
    }

    // ##### Brand Ends #####

    // ##### Sample #####

    public function manage_sample_types()
    {
        $this->session->set_userdata('sub_menu', 'Manage Sample Types');
        $data['alert_msg'] = 'inc/message.php';
        $this->Settings_model->setTable('tbl_sample_type');
        $this->Settings_model->setPrimaryKey('tbl_sample_type_id');
        $data['sample_types'] = $this->Settings_model->get()->result();

//        echo '<pre>';print_r($data['project_types']);die();
        $data['main_content'] = 'vw_settings/vw_manage_sample_types';
        $this->load->view('vw_master', $data);
    }

    public function check_sample_type_name()
    {
        $sample_type_name = $this->input->post('sample_type_name');
        $result = $this->Settings_model->get_all_records('tbl_sample_type_id, sample_type_name', "sample_type_name='$sample_type_name'", 'tbl_sample_type');
        // print_r($sample_type_name);die();
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function sample_type_add_post()
    {
        $this->Settings_model->setTable('tbl_sample_type');
        $this->form_validation->set_rules('sample_type_name', 'Sample Type Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('manage_sample_types');
        } else {
            $data = array();
            $data['sample_type_name'] = $this->input->post('sample_type_name');
            $data['status'] = 1;
            $data['created_on'] = date('Y-m-d');
            //echo '<pre>';print_r($org_data);die();
            $check_name = $this->Settings_model->get_all_records('tbl_sample_type_id, sample_type_name', "sample_type_name='$data[sample_type_name]'", 'tbl_sample_type');
            if ($check_name) {
                $this->session->set_flashdata('error', 'Sample Type already exists! Please try again!');
                return redirect('manage_sample_types', 'refresh');
            } else {
                $is_inserted = $this->Settings_model->insert($data);
                if ($is_inserted) {
                    $this->session->set_flashdata('success', 'Sample Type Has Been Added Successfully!');
                    return redirect('manage_sample_types', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'An error occurred! Please try again!');
                    return redirect('manage_sample_types', 'refresh');
                }
            }
        }
    }

    public function sample_type_status_post()
    {
        $id = $this->input->post('sample_type_id');
        if ($id) {
            $this->Settings_model->setTable('tbl_sample_type');
            $this->Settings_model->setPrimaryKey('tbl_sample_type_id');
            $get_status = $this->Settings_model->get($id);
            if ($get_status->row()) {
                if ($get_status->row()->status == 1) {
                    $data['status'] = 0;
                    $update_status = $this->Settings_model->update($id, $data);
                } else {
                    $data['status'] = 1;
                    $update_status = $this->Settings_model->update($id, $data);
                }
                if ($update_status) {
                    $this->session->set_flashdata('success', 'Sample type Status changed successfully.');
                    return redirect('manage_sample_types');
                } else {
                    $this->session->set_flashdata('error', 'Status change failed! Please try again.');
                    return redirect('manage_sample_types');
                }
            } else {
                $this->session->set_flashdata('error', 'Status cannot be changed!');
                return redirect('manage_sample_types');
            }
        } else {
            $this->session->set_flashdata('error', 'Status cannot be changed!');
            return redirect('manage_sample_types');
        }
    }

    public function sample_type_edit_post()
    {
        $type_id = $this->input->post('type_id');
        //print_r($type_id);die();
        $this->Settings_model->setTable('tbl_sample_type');
        $this->Settings_model->setPrimaryKey('tbl_sample_type_id');
        $this->form_validation->set_rules('e_sample_type_name', 'Sample Type Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('manage_sample_types');
        } else {
            $data = array();
            $data['sample_type_name'] = $this->input->post('e_sample_type_name');
            //echo '<pre>';print_r($org_data);die();
            //print_r($type_id.' '.$data['sample_type_name']);die();
            $check_name = $this->Settings_model->get_all_records('tbl_sample_type_id, sample_type_name', "sample_type_name='$data[sample_type_name]' AND tbl_sample_type_id != $type_id", 'tbl_sample_type');
            //print_r($check_name);die();
            if ($check_name) {
                $this->session->set_flashdata('error', 'Sample type already exists! Please try again!');
                return redirect('manage_sample_types', 'refresh');
            } else {
                $is_updated = $this->Settings_model->update($type_id, $data);
                if ($is_updated) {
                    $this->session->set_flashdata('success', 'Sample Type Has Been Updated Successfully!');
                    return redirect('manage_sample_types', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'No changes found! Please try again.');
                    return redirect('manage_sample_types', 'refresh');
                }
            }
        }
    }

    // ##### Sample Ends #####
}
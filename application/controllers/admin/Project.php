<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH . 'core/My_Controller.php');

class Project extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->session->set_userdata('main_menu', 'Projects');
        $this->load->model('Config_model');

    }

    public function manage_project()
    {
        $this->session->set_userdata('sub_menu', 'Manage Projects');
        $data['alert_msg'] = 'inc/message.php';
        $data['main_content'] = 'vw_project/vw_manage_projects';
        $this->load->view('vw_master', $data);
    }
    public function add_new_project()
    {
        $this->session->set_userdata('sub_menu', 'Add New Project');
        $data['alert_msg'] = 'inc/message.php';
        $data['main_content'] = 'vw_project/vw_add_project';
        $this->load->view('vw_master', $data);
    }

    public function upload_project(){


        if($this->form_validation->run('add_project_form') === FALSE) {
            $this->session->set_flashdata('error', 'Project Validation Failed!');
        } else {
            $data = array();
            $data['PROJECT_TITLE'] = $this->input->post('project_title');
            $data['PROJECT_START_DATE'] = strtotime($this->input->post('start_date')) * 1000;

            if($this->input->post('end_date') == null){
                $data['	PROJECT_IS_RUNNING'] = 1;
            }
            $data['PROJECT_IS_VISIBLE'] = $this->input->post('status');
            $data['CREATED_BY'] = $this->session->userdata('user_id');
            $data['CREATED_DATE'] = strtotime(date('Y-m-d')) * 1000;

            echo '<pre>';
            print_r($data);
            die();
        }
    }

    public function category()
    {
        $this->session->set_userdata('sub_menu', 'Project Category');
        $data['alert_msg'] = 'inc/message.php';
        $data['main_content'] = 'vw_project/vw_project_category';
        $this->load->view('vw_master', $data);
    }

    public function add_new_category(){
        $cat_name =$this->input->post('cat_name');
        $status =$this->input->post('status');
        $type =$this->input->post('type');
        $this->Config_model->setTable('project_categories');
        if($cat_name != null){


            if ($type == 'add'){
                $data = array(
                    'PROJECT_CATEGORY_NAME'=>$cat_name,
                    'IS_VISIBLE'=>$status,
                    'CREATED_BY'=>$this->session->userdata('user_id'),
                    'CREATED_DATE'=>strtotime(date('Y-m-d')) * 1000,
                    'MODIFIED_DATE'=>strtotime(date('Y-m-d')) * 1000
                );

                $this->Config_model->insert($data);
            }else{


                $cat_id =$this->input->post('category_id');

                $data = array(
                    'PROJECT_CATEGORY_NAME'=>$cat_name,
                    'IS_VISIBLE'=>$status,
                    'MODIFIED_BY'=>$this->session->userdata('user_id'),
                    'MODIFIED_DATE'=>strtotime(date('Y-m-d')) * 1000,
                );

                $this->Config_model->update(array('PROJECT_CATEGORY_ID'=>$cat_id),$data);
            }

        }

        // load all category
        $result = $this->Config_model->get()->result();

        $x = array();
        $i = 1;
        foreach ($result as $row){
            $data = array();
            $data[0] = $i++ ;
            $data[1] = $row->PROJECT_CATEGORY_NAME;
            $data[2] = $row->CREATED_BY;
            $data[3] = date("d-m-Y", ($row->CREATED_DATE / 1000));
            if ($row->IS_VISIBLE == 1){
                $lavel = "<span class=\"label label-info\">Active</span>";
            }else{
                $lavel = "<span class=\"label label-danger\">Deactive</span>";
            }
            $data[4] = $lavel;
            $data[5] = '<a href="javascript:void(0)" onclick="edit_category('.$row->PROJECT_CATEGORY_ID.');" class="fa fa-edit"></a> 
                        <a href="#" onclick="return delete_category('.$row->PROJECT_CATEGORY_ID.');" class="fa fa-trash"></a>
                      ';
            array_push($x,$data);
        }
        echo json_encode(array('data'=>$x));

    }

    public function individual_project_cat(){
        $id = $this->input->post('id');
        $this->Config_model->setTable('project_categories');
        $result = $this->Config_model->get(array('PROJECT_CATEGORY_ID'=>$id))->row();

        $data[0] = $result->PROJECT_CATEGORY_ID;
        $data[1] = $result->PROJECT_CATEGORY_NAME;

        $data[2] = "<option value='1' $result->IS_VISIBLE == '1' ? 'selected' : ''>Active</option>
                    <option value='0' $result->IS_VISIBLE == '0' ? 'selected' : '' >Deactive</option>";

        echo json_encode($data);
    }

    public function delete_category(){
        $id = $this->input->post('id');
        $this->Config_model->setTable('project_categories');
        $result = $this->Config_model->delete(array('PROJECT_CATEGORY_ID'=>$id));
        if($result){
            $this->session->set_flashdata('success', 'Deleted Successfully.');
        }else{
            $this->session->set_flashdata('success', 'Problem when Successfully.');
        }

        echo 'success';
    }



}
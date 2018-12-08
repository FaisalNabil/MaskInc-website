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
        $this->Config_model->setTable('project_categories');
        if($cat_name != null){
            $data = array(
                'PROJECT_CATEGORY_NAME'=>$cat_name,
                'IS_VISIBLE'=>$status,
                'CREATED_BY'=>$this->session->userdata('user_id'),
                'CREATED_DATE'=>strtotime(date('Y-m-d')) * 1000,
                'MODIFIED_DATE'=>strtotime(date('Y-m-d')) * 1000
            );

            $this->Config_model->insert($data);
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
            $data[5] = '<a href="javascript:void(0)" onclick="jQuery(\'#edit_project_cat\').modal(\'show\', {backdrop: \'fade\'});" class="fa fa-edit"></a> 
                        <a href="#" class="fa fa-trash"></a>
                        <a href="#" class="fa fa-thumbs-o-down"></a>';
            array_push($x,$data);
        }
        echo json_encode(array('data'=>$x));

    }



}
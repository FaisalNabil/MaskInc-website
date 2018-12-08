<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array (
    'add_project_form' => array (
        array(
            'field' => 'project_title',
            'label' => 'Project Title',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'start_date',
            'label' => 'Project Start Date',
            'rules' => 'required'
        )
    )

);

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array (
    'add_project_form' => array (
        array(
            'field' => 'project_name',
            'label' => 'Project Name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'project_type_id',
            'label' => 'Project Type',
            'rules' => 'required|numeric'
        ),
        array(
            'field' => 'location',
            'label' => 'Location',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'start_date',
            'label' => 'Start Date',
            'rules' => 'required'
        )
    ),
    'add_vendor_form' => array (

        array(
            'field' => 'vendor_name',
            'label' => 'Vendor Name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'phone_number',
            'label' => 'Phone Number',
            'rules' => 'required|numeric|min_length[7]|max_length[14]'
        ),
        array(
            'field' => 'address',
            'label' => 'Address',
            'rules' => 'trim|required'
        )
    ),
    'add_product_form' => array (

        array(
            'field' => 'product_name',
            'label' => 'Product Name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'product_type_id',
            'label' => 'Product Type',
            'rules' => 'required|numeric'
        ),
        array(
            'field' => 'inventory_house_id',
            'label' => 'Inventory House',
            'rules' => 'required|numeric'
        ),
        array(
            'field' => 'vendor_id',
            'label' => 'Vendor ID',
            'rules' => 'required|numeric'
        ),
        array(
            'field' => 'project_id',
            'label' => 'Project ID',
            'rules' => 'required|numeric'
        )

    ),
    'add_sample_form' => array (

        array(
            'field' => 'sample_name',
            'label' => 'Sample Name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'sample_type_id',
            'label' => 'Sample Type',
            'rules' => 'required|numeric'
        ),
        array(
            'field' => 'brand_id',
            'label' => 'Brand',
            'rules' => 'numeric'
        ),
        array(
            'field' => 'broad_forwarding',
            'label' => 'Broad Forwarding',
            'rules' => 'numeric'
        )

    ),
    'add_inventory_house_form' => array (

        array(
            'field' => 'inventory_house_name',
            'label' => 'Inventory House Name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'address',
            'label' => 'Address',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'size',
            'label' => 'Size',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'contact_person_name',
            'label' => 'Contact Person Name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'phone_number_1',
            'label' => 'Contact Number',
            'rules' => 'required|callback_number_length_check'
        )
    ),
    'add_stock_form' => array (

        array(
            'field' => 'project_id',
            'label' => 'Project ID',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'product_id',
            'label' => 'Product ID',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'quantity',
            'label' => 'Quantity',
            'rules' => 'required|numeric'
        )
    ),
    'save_user' => array (

        array(
            'field' => 'user_pin',
            'label' => 'Staff Pin',
            'rules' => 'trim|required|is_unique[tbl_user.user_id]|is_unique[tbl_login.tbl_user_user_id]'
        ),
        array(
            'field' => 'user_name',
            'label' => 'Staff Name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'phone_number',
            'label' => 'Phone Number',
            'rules' => 'trim|required|min_length[11]|max_length[11]'
        ),
        array(
            'field' => 'division',
            'label' => 'Division',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'district',
            'label' => 'District',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'upazilla_id',
            'label' => 'Upazilla',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'organization_id',
            'label' => 'organization name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'status',
            'label' => 'status',
            'rules' => 'trim|required'
        )

    ),
    'update_user' => array (

        array(
            'field' => 'user_id',
            'label' => 'Staff Pin',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'user_name',
            'label' => 'Staff Name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'phone_number',
            'label' => 'Phone Number',
            'rules' => 'trim|required|min_length[11]|max_length[11]'
        ),
        array(
            'field' => 'division',
            'label' => 'Division',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'district',
            'label' => 'District',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'upazilla_id',
            'label' => 'Upazilla',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'organization_id',
            'label' => 'organization name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'status',
            'label' => 'status',
            'rules' => 'trim|required'
        )

    ),
    'save_grading_policy' => array (
        array(
            'field' => 'name',
            'label' => 'Policy Name',
            'rules' => 'trim|required'
        )
    ),
    'save_grade_range' => array (
        array(
            'field' => 'max_range',
            'label' => 'Max Range',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'min_range',
            'label' => 'Minium Range',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'range_grade',
            'label' => 'Range Grade',
            'rules' => 'trim|required'
        )
    ),

);

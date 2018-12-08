<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6/10/2018
 * Time: 1:04 PM
 */

class Home_model extends CRUD_model
{
    protected $_table='tbl_qc_form';
    protected $_primary_key='qc_form_id';

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->_table = $table;
    }

    /**
     * @param string $primary_key
     */
    public function setPrimaryKey($primary_key)
    {
        $this->_primary_key = $primary_key;
    }

    public function form_report($form_id)
    {
        $query = "SELECT f.`division_id`, f.`division_en_name`, COUNT(b.`qc_assign_id`) AS total_assigned, SUM(CASE WHEN b.`started_on` IS NOT NULL AND b.`submitted_on` IS NULL THEN 1 ELSE 0 END) AS total_started,
        SUM(CASE WHEN b.`submitted_on` IS NOT NULL THEN 1 ELSE 0 END) AS total_submitted,
        SUM(CASE WHEN b.`started_on` IS NOT NULL THEN 0 ELSE 1 END) AS total_not_started
        FROM tbl_qc_form a
        INNER JOIN tbl_qc_assign b ON a.`qc_form_id`=b.`tbl_qc_form_qc_form_id`
        INNER JOIN tbl_office c ON b.`tbl_office_office_id`=c.`office_id`
        INNER JOIN tbl_upazilla d ON c.`tbl_upazilla_upazilla_id`=d.`upazilla_id`
        INNER JOIN tbl_district e ON d.`tbl_district_district_id`=e.`district_id`
        INNER JOIN tbl_division f ON e.`tbl_division_division_id`=f.`division_id`
        WHERE a.`qc_form_id`='$form_id'
        GROUP BY f.`division_id`";
        $res = $this->db->query($query);
        return $res->result_array();
    }

    public function get_divisions()
    {
        //$this->db->select('division_en_name');
        $data = $this->db->get('tbl_division');
        return $data->result_array();
    }

    public function over_all_product_status(){

    }

}
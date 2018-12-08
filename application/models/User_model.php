<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CRUD_model
{
    protected $_table='tbl_user';
    protected $_primary_key='user_id';
    protected $_selector='*';

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

    public function setSelector($selector)
    {
        $this->_selector = $selector;
    }

    public function get_all_records($selector,$table_name)
    {
        if($table_name == 'tbl_user'){
            $this->db->select($selector);
            $this->db->where('user_id !=', 'appinion');
            $result = $this->db->get($table_name);
            return $result->result();
        }else{
            $this->db->select($selector);
            $result = $this->db->get($table_name);
            return $result->result();
        }
    }

    public function insert_user_data($user_data, $login_data)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_user',$user_data);
        $this->db->insert('tbl_login',$login_data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }

    }

    public function get_all_users()
    {
        $this->db->select('tb.user_id, tb.user_name, tb.gender, tb.phone_number, tb.email, tb.designation, tb.address, tb.status, ag.id, ag.name');
        $this->db->from('tbl_user tb');
        $this->db->join('aauth_groups ag', 'ag.id = tb.group_id');
        $this->db->where('tb.user_id !=', 'appinion');
        $this->db->where('tb.status', 1);
        return $this->db->get()->result();
    }

    public function get_user_records($selector, $condition, $table_name)
    {
        //echo $condition;die();
        $this->db->select($selector);
        $this->db->from($table_name);
        $this->db->where($condition);
        $result = $this->db->get();
        return $result->result();
    }

}




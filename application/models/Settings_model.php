<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings_model extends CRUD_model
{
    protected $_table='';
    protected $_primary_key='';
    protected $_selector='';

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

    public function get_all_records($selector, $condition, $table_name)
    {
        //echo $condition;die();
        $this->db->select($selector);
        $this->db->from($table_name);
        $this->db->where($condition);
        $result = $this->db->get();
        return $result->result();
    }

    public function get_user_by_id_and_password($id,$pass){
        $this->db->select('l.*');
        $this->db->from('tbl_login l');
        $this->db->where('l.login_id',$id);
        $this->db->where('l.password',md5($pass));
        $result = $this->db->get();
        return $result->row();
    }

}




<?php
/**
 * Created by PhpStorm.
 * User: Sudipta
 * Date: 5/19/2018
 * Time: 12:03 PM
 */

class Config_model extends CRUD_model
{
    protected $_table=null;
    protected $_primary_key=null;

    public function __construct()
    {
        parent::__construct();
    }
    public function set($table=null,$primary_key=null)
    {
        $this->_table = $table;
        $this->_primary_key = $primary_key;
    }

    /**
     * @param string $table
     */
    public function setTable($table=null)
    {
        $this->_table = $table;
    }
    /**
     * @param string $primary_key
     */
    public function setPrimaryKey($primary_key=null)
    {
        $this->_primary_key = $primary_key;
    }

    public function count_records($table_name)
    {
        $this->db->where("$table_name.status=1");
        return $this->db->count_all_results($table_name);
    }
    public function count_records_without_status($table_name)
    {
        //$this->db->where("$table_name.status=1");
        return $this->db->count_all_results($table_name);
    }



}




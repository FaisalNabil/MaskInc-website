<?php
/**
 * Created by PhpStorm.
 * User: Sudipta
 * Date: 5/19/2018
 * Time: 11:39 AM
 */

class CRUD_model extends CI_Model
{
    protected $_table=null;
    protected $_primary_key=null;

    public function __construct()
    {
        parent::__construct();
    }

    public function get($id=null,$order_by=null)
    {
        if($id==null){

        }elseif(is_array($id)) {
            foreach ($id as $_key => $_value){
                $this->db->where($_key,$_value);
            }
        }else{
            $this->db->where($this->_primary_key,$id);
        }

        if(is_array($order_by)){
            foreach ($order_by as $_key => $_value){
                $this->db->order_by($_key,$_value);
            }
        }else{
            $this->db->order_by($this->_primary_key,$order_by);
        }
        $q=$this->db->get($this->_table);
        return $q;
    }

    public function insert($data)
    {
        $this->db->trans_start();
        $this->db->insert($this->_table,$data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $insert_id = $this->db->insert_id();
            $this->db->trans_commit();
            return $insert_id;
        }

    }

    public function update($id=null,$data)
    {

        if(is_array($id)){
            foreach ($id as $_key => $_value){
                $this->db->where($_key,$_value);
            }
        }else{
            $this->db->where($this->_primary_key,$id);
        }
        $this->db->update($this->_table,$data);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        if(is_array($id)){
            foreach ($id as $_key => $_value){
                $this->db->where($_key,$_value);
            }
        }else{
            $this->db->where($this->_primary_key,$id);
        }
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }

}
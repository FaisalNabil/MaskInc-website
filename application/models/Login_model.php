<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Sudipta
 * Date: 5/16/2018
 * Time: 1:49 PM
 */

class Login_model extends CRUD_model
{
    protected $_table='tbl_login';
    protected $_primary_key='login_id';

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

    public function login_check($userid, $passwd)
    {
        //print_r(password_hash($passwd, PASSWORD_ARGON2I));die();
        $this->db->select('tl.login_id, tl.password, tl.status, tl.change_pass_status, tl.last_login, tb.user_id, tb.user_name,tb.designation, tb.group_id');
        $this->db->join('tbl_user tb', 'tb.user_id = tl.tbl_user_user_id');
        $this->db->where('tl.tbl_user_user_id', $userid);
        $this->db->where('password', md5($passwd));
        $this->db->where('tl.status', 1);
        $data = $this->db->get('tbl_login tl');
        return $data;
    }

    public function update_login_status($user_id)
    {
        $data = array(
            'last_login'=> date('Y-m-d H:i:s')
        );
        $this->db->where('tbl_user_user_id', $user_id);
        if($this->db->update('tbl_login', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}




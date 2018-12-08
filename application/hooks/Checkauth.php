<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/29/2018
 * Time: 12:33 PM
 */

class Checkauth extends CI_Controller
{
    private $CI;
    public function __construct()
    {
        //session_start();
        $this->CI =& get_instance();
    }

    public function is_loggedin()
    {
        $class = $this->CI->router->fetch_class();
        $method = $this->CI->router->fetch_method();
        $directory = $this->CI->router->fetch_directory();
        $currentURL = current_url();
        //echo $method;
        $class_methods=get_class_methods($class);
       // print_r($directory);
        /*if(!in_array('$method', $class_methods)){
            //redirect(base_url().'access_denied');
        } else {
            echo 'Not found';
        }*/
    }
}
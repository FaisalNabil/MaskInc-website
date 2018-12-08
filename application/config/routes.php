<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'admin/home';
$route['login'] = 'admin/login/index';
$route['change_password'] = 'settings/change_password';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['error_404'] = 'Home/error_404';

$route['add_new_user'] = 'User/add_user';
$route['manage_users'] = 'User/manage_users';
$route['check_user_id'] = 'User/check_user_id';
$route['user_status_post'] = 'User/user_status_post';
$route['user_add_post'] = 'User/user_add_post';
$route['edit_user/(:any)'] = 'User/edit_user/$1';
$route['user_edit_post'] = 'User/user_edit_post';

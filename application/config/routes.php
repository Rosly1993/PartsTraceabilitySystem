<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'user';
$route['home'] = 'user/home';
// $route['areas'] = 'areas/index';
$route['login_page'] = 'auth/login';
// $route['areas/add_area'] = 'Areas/add_area';
// $route['areas/get_areas'] = 'areas/get_areas';
// $route['items/add_item'] = 'Items/add_item';
// $route['lines/add_item'] = 'Lines/add_item';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

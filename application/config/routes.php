<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['games/show/(:any)'] = 'games/show/$1';
$route['games/secretdata'] = 'games/secretdata';

$route['default_controller'] = 'games';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

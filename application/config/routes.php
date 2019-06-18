<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
/*$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;*/

//$route['importar/items'] = 'importar/items';
//$route['importar/'] = 'importar/items';
//$route['importar/items'] = 'importar/items';


$route['abonos/create'] = 'abonos/create';
$route['abonos/get_saldo'] = 'abonos/get_saldo';
$route['abonos/(:any)'] = 'abonos/view/$1';
$route['abonos/edit/(:any)'] = 'abonos/edit/$1';
$route['abonos'] = 'abonos';

//$route['abonos/create'] = 'abonos/create';
//$route['abonos/(:any)'] = 'abonos/view/$1';
//$route['abonos/edit/(:any)'] = 'abonos/edit/$1';
$route['notas'] = 'notas';

$route['ventas/create'] = 'ventas/create';
$route['ventas/create1'] = 'ventas/create1';
$route['ventas/create_cliente'] = 'ventas/create_cliente';
//$route['ventas/(:any)'] = 'ventas/view/$1';
$route['ventas'] = 'ventas';

$route['reporte/(:any)'] = 'reporte/index/$1';

$route['existencias/create'] = 'existencias/create';
$route['existencias/(:any)'] = 'existencias/view/$1';
$route['existencias'] = 'existencias';

$route['entradas/create'] = 'entradas/create';
$route['entradas/(:any)'] = 'entradas/view/$1';
$route['entradas'] = 'entradas';

$route['salidas/create'] = 'salidas/create';
$route['salidas/(:any)'] = 'salidas/view/$1';
$route['salidas'] = 'salidas';

$route['proveedores/create'] = 'proveedores/create';
$route['proveedores/(:any)'] = 'proveedores/view/$1';
$route['proveedores/edit/(:any)'] = 'proveedores/edit/$1';
$route['proveedores'] = 'proveedores';

$route['usuarios/create'] = 'usuarios/create';
$route['usuarios/(:any)'] = 'usuarios/view/$1';
$route['usuarios/edit/(:any)'] = 'usuarios/edit/$1';
$route['usuarios'] = 'usuarios';

$route['categorias/create'] = 'categorias/create';
$route['categorias/(:any)'] = 'categorias/view/$1';
$route['categorias/edit/(:any)'] = 'categorias/edit/$1';
$route['categorias'] = 'categorias';

$route['items/create'] = 'items/create';
$route['items/import'] = 'items/import';
$route['items/(:any)'] = 'items/view/$1';
$route['items/edit/(:any)'] = 'items/edit/$1';
$route['items'] = 'items';

$route['clientes/create'] = 'clientes/create';
$route['clientes/(:any)'] = 'clientes/view/$1';
$route['clientes/edit/(:any)'] = 'clientes/edit/$1';
$route['clientes'] = 'clientes';

$route['login/cerrar'] = 'login/cerrar';
$route['login'] = 'login/login';

$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';

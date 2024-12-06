<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'UsuarioController::login');


$routes->get('login', 'UsuarioController::login');
$routes->post('login', 'UsuarioController::authenticate');
$routes->get('signup', 'UsuarioController::signup');
$routes->post('signup', 'UsuarioController::register');
$routes->get('logout', 'UsuarioController::logout');

$routes->group('admin', ['filter' => 'auth:1'], function($routes) {
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('especies', 'EspeciesController::index');
    $routes->get('especies/create', 'EspeciesController::create');
    $routes->post('especies', 'EspeciesController::store');
    $routes->get('especies/edit/(:num)', 'EspeciesController::edit/$1');
    $routes->post('especies/update/(:num)', 'EspeciesController::update/$1');
    $routes->get('especies/delete/(:num)', 'EspeciesController::delete/$1');
    $routes->get('arboles', 'ArbolesController::index');
    $routes->get('arboles/create', 'ArbolesController::create');
    $routes->post('arboles', 'ArbolesController::store');
    $routes->get('arboles/edit/(:num)', 'ArbolesController::edit/$1');
    $routes->post('arboles/update/(:num)', 'ArbolesController::update/$1');
    $routes->get('arboles/delete/(:num)', 'ArbolesController::delete/$1');
    $routes->get('amigos', 'AmigoController::index');
    $routes->get('amigos/arboles/(:num)', 'AmigoController::verArboles/$1');
    $routes->get('amigos/actualizar-arbol/(:num)', 'AmigoController::actualizarArbol/$1');
    $routes->post('amigos/actualizar-arboles', 'AmigoController::guardarActualizacion');
    $routes->get('amigos/historial/(:num)', 'AmigoController::historial/$1');
    $routes->get('staff', 'UsuarioController::staffList');
    $routes->get('staff/create', 'UsuarioController::createStaff');
    $routes->get('staff/edit/(:num)', 'UsuarioController::editStaff/$1');
    $routes->post('staff/edit/(:num)', 'UsuarioController::editStaff/$1');
    $routes->get('staff/delete/(:num)', 'UsuarioController::deleteStaff/$1');
    $routes->get('historial', 'HistorialController::index');
});

$routes->group('operador', ['filter' => 'auth:2'], function($routes) {
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('historial', 'HistorialController::index');
});

$routes->group('', ['filter' => 'auth:1,2'], function($routes) {
    $routes->get('historial', 'HistorialController::index');

});
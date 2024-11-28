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
});
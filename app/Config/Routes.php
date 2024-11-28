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
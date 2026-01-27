<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/test', 'Test::index');

$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::register');
$routes->match(['get', 'post'], 'login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

$routes->get('dashboard', 'Dashboard::index');
$routes->get('homepage','Home::homepage');


$routes->group('psp-keys',['filter'=>'auth'],function($routes){
    $routes->get('/','PspKeyController::index');
    $routes->get('create','PspKeyController::create');
    $routes->post('store','PspKeyController::store');
    $routes->get('toggle/(:num)','PspKeyController::toggle/$1');
});


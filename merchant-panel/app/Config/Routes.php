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

$routes->group('checkout', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Checkout::index');
    $routes->post('pay', 'Checkout::pay');
});

$routes->group('transactions', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Transactions::index');
});

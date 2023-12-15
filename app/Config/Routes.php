<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Redirect::order');

// service('auth')->routes($routes);


$routes->resource('order');
$routes->resource('staff');
$routes->resource('assignment', ['controller' => 'OrderAssignment']);

$routes->get('/api/assignment/(:num)', 'OrderAssignment::info/$1');

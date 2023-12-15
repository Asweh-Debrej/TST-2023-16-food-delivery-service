<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Redirect::order');

// service('auth')->routes($routes);


$routes->resource('order');
$routes->resource('staff');
$routes->resource('order-assignment', ['controller' => 'OrderAssignment']);

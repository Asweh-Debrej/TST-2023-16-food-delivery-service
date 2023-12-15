<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'ListOrder::index');

// service('auth')->routes($routes);

$routes->group('api', function ($routes) {
    $routes->resource('order');
    $routes->resource('staff');
    $routes->resource('order-assignment', ['controller' => 'OrderAssignment']);
});

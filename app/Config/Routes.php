<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Redirect::order');

service('auth')->routes($routes);


$routes->resource('order', ['only' => ['index', 'show']]);
$routes->resource('assignment', ['controller' => 'OrderAssignment', 'only' => ['create']]);

$routes->get('/api/order/(:num)', 'Order::apiGetSingle/$1');
$routes->get('/api/order/(:num)/status', 'Order::apiGetStatus/$1');

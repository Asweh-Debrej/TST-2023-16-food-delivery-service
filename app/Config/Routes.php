<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Redirect::order');

service('auth')->routes($routes);


// $routes->resource('order', ['only' => ['index', 'show'], 'as' => 'order']);
// $routes->resource('assignment', ['controller' => 'OrderAssignment', 'only' => ['create']]);
$routes->get('/order', 'Order::index', ['as' => 'order']);
$routes->get('/order/(:num)', 'Order::show/$1', ['as' => 'order.detail']);
$routes->post('/assignment', 'OrderAssignment::create', ['as' => 'assignment.create']);


$routes->get('/api/order/(:num)', 'Order::apiGetSingle/$1', ['as' => 'api.order.single', 'filter' => 'tokens']);
$routes->get('/api/order/(:num)/status', 'Order::apiGetStatus/$1', ['as' => 'api.order.status', 'filter' => 'tokens']);
$routes->post('/api/order', 'Order::apiCreate', ['as' => 'api.order.create', 'filter' => 'tokens']);


$routes->post('/api/auth/token', 'Auth::token', ['as' => 'auth.token']);
$routes->get('/api/auth/info', 'Auth::info', ['as' => 'auth.info', 'filter' => 'tokens']);


// health
$routes->get('/health', function () {
  return 'OK';
});

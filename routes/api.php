<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->delete('/', 'AuthController@destroy');
});

$router->group(['prefix' => 'user'], function () use ($router) {
    $router->get('/', 'UserController@index');
    $router->get('/{id}', 'UserController@show');
    $router->post('/', 'UserController@store');
    $router->put('/{id}', 'UserController@update');
    $router->delete('/{id}', 'UserController@destroy');
});

$router->group(['prefix' => 'transaction'], function () use ($router) {
    $router->get('/', 'TransactionController@index');
    $router->get('/{id}', 'TransactionController@show');
    $router->post('/', 'TransactionController@store');
});

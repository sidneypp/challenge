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

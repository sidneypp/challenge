<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/', 'AuthController@store');
});

<?php

include_once "../vendor/autoload.php";

use App\Routing\Router;
use App\Routing\RouterInterface;

// TODO
// @see https://www.php.net/manual/ru/function.yaml-parse.php
$router = new Router();
foreach ($routes as $route) {
    $router->addRoute($route);
}

assert($router->match('/users/123/view')->getName() === 'view_user');
assert($router->match('/users/123/edit')->getName() === 'edit_user');
assert($router->match('/contacts')->getName() === 'contacts');
assert($router->match('/users/345/view')->getName() === 'view_user');
assert($router->resolve('/users/345/view') === 'view 345');
assert($router->resolve('/contacts') === 'phone: 12345');
assert($router->resolve('/users/123/edit') === 'edit 123');
assert($router->resolve('/users/345/edit') === 'edit 345');
assert($router instanceof RouterInterface);

<?php

use Phalcon\Mvc\Router;

$router = new Router();

//customer
$router->add('customer/adddie', ['controller'=>'Customer', 'action'=>'add']);
$router->add('customer/addd/submit', ['controller'=>'Customer', 'action'=>'addSubmit']);
$router->add('customer/list', ['controller'=>'Customer', 'action'=>'list']);
$router->add('customer/edit', ['controller'=>'Customer', 'action'=>'edit']);
$router->add('customer/edit-submit', ['controller'=>'Customer', 'action'=>'editSubmit']);

$router->handle($_SERVER['REQUEST_URI']);


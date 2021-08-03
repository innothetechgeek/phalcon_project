<?php

$router = $di->getRouter();

// Define your routes here
$router->add('/', ['controller'=>'Customer', 'action'=>'list']);

//customer
$router->add('customer/add', ['controller'=>'Customer', 'action'=>'add']);
$router->add('customer/add-submit', ['controller'=>'Customer', 'action'=>'addSubmit']);
$router->add('customer/list', ['controller'=>'Customer', 'action'=>'list']);
$router->add('customer/edit', ['controller'=>'Customer', 'action'=>'edit']);
$router->add('customer/edit-submit', ['controller'=>'Customer', 'action'=>'editSubmit']);

$router->handle($_SERVER['REQUEST_URI']);

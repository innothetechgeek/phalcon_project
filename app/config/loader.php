<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir
    ]
)->register();

$loader->registerNamespaces(
    [
        'App\CustomORM' => APP_PATH . '/CustomORM/',
        'App\Forms' => APP_PATH . '/Forms',
        'App\Controllers' => APP_PATH .'/Controllers',
    ]
);

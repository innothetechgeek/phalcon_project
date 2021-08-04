<?php
namespace App\CustomORM;
use Phalcon\Db\Adapter\Pdo\Mysql as PDOConnection;

use Phalcon\Di;
use Phalcon\Config;

function getdbconnection(){

    $databaseConfig = getConfigData()->database;

    $servername =  $databaseConfig['host'];
    $username =  $databaseConfig['username'];
    $password = $databaseConfig['password'];
    $dbname = $databaseConfig['dbname'];

    try{
        $connection = new PDOConnection(
            [
                "host"     =>  $servername,
                "username" => $username,
                "password" => $password,
                "dbname"   => $dbname,
            ]
        );

        return $connection;

    }catch(PDOException $e){

        echo "Connection failed: " . $e->getMessage();

    }
}

function getConfigData(){
    $args = func_get_args();
        $config = Di::getDefault()->getShared('config');

        if (empty($args)) {
        return $config;
        }

        return call_user_func_array(
            [$config, 'path'],
            $args
        );
}
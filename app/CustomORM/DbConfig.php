<?php
namespace App\CustomORM;
use Phalcon\Db\Adapter\Pdo\Mysql as MysqlConnection;

function getdbconnection(){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "MMS";

    try{
        $connection = new MysqlConnection(
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
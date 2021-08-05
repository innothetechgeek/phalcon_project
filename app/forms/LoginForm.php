<?php

namespace App\Forms;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use \App\CustomORM\Crud;

class LoginForm extends Form{

    
    public function initialize($entity = null, $options = []){
        

        $username = new Text('username', [

            "class" => "form-control",           
            "placeholder" => "username",
            "name"=>"username",
             "value" => $balance_value,

        ]);

        $password = new Password('password', [

            "class" => "form-control",           
            "placeholder" => "password",
            "name"=>"password",
             "value" => $balance_value,

        ]);
        
        $this->add($username);
        $this->add($password);
       

    }
   
}


?>
<?php

namespace App\Forms;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Forms\Element\Submit;

class CustomerForm extends Form{

    public function initialize($entity = null, $options = []){

       
        $name_value = $this->view->customer != null ? $this->view->customer[0]['mv_title'] : "";      
        $name = new Text('name', [
            "class" => "form-control",
             "value" =>  $name_value,
            "placeholder" => "Name"
        ]);

       
        $name->addValidators([
            new PresenceOf(['message' => 'The customer name is required']),
        ]);

         //=======================================================================

        $last_name = new Text('last_name', [
            "class" => "form-control",
           
            "placeholder" => "Last Name"
        ]);

       
        $last_name->addValidators([
            new PresenceOf(['message' => 'The customer lastname is required']),
        ]);

         //=======================================================================

        $address = new Text('address', [
            "class" => "form-control",
           
            "placeholder" => "Home Address"
        ]);

       
        $address->addValidators([
            new PresenceOf(['message' => 'The address is required']),
        ]);

        //========================================================================
        $address = new Text('address', [
            "class" => "form-control",
           
            "placeholder" => "Home Address"
        ]);

        
       
        $address->addValidators([
            new PresenceOf(['message' => 'The address is required']),
        ]);

        //========================================================================

        $balance = new Text('balance', [

            "class" => "form-control",           
            "placeholder" => "Balance"

        ]);

       
        $balance->addValidators([
            new PresenceOf(['message' => 'The balance is required']),
        ]);

        //========================================================================

        $username = new Text('username', [

            "class" => "form-control",           
            "placeholder" => "username"

        ]);

       
        $username->addValidators([
            new PresenceOf(['message' => 'The username is required']),
        ]);
        
        //========================================================================

        $password = new Password('password', [

            "class" => "form-control",           
            "placeholder" => "password"

        ]);

       
        $password->addValidators([
            new PresenceOf(['message' => 'The password is required']),
        ]);

        $update = new Submit('update', [
            "name" => "update",
            "value" => "Update Customer",
            "class" => "btn btn-primary btn-block",
        ]);


        $this->add($update);
        $this->add($password);
        $this->add($username);
        $this->add($balance);
        $this->add($address);
        $this->add($last_name);        
        $this->add($name);

    }
   
}


?>
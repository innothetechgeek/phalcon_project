<?php

namespace App\Forms;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Forms\Element\Submit;
use \App\CustomORM\Crud;

class InvoiceForm extends Form{

    
    public function initialize($entity = null, $options = []){
        

        $crud = new Crud(); 
        $customers = $crud->read("SELECT id,name FROM customers");
        $new_customer_arr = [];
        foreach($customers as $key => $customer){
            foreach($customer as $key => $value){
                 $customer_id = $customer['id'];
                if(!is_numeric($key) && $key != 'id' ) $new_customer_arr[$customer_id] = $value;
            }
        }
     
        $customer =  new Select(
                'customer',
                $new_customer_arr , ["class" => "form-control"]
        );
     

        $products = $crud->read("SELECT id,name FROM products");
        $new_products_arr = [];
        foreach($products as $key => $product){
            foreach($product as $key => $value){
                 $product_id = $product['id'];
                if(!is_numeric($key) && $key != 'id' ) $new_products_arr[$product_id] = $value;
            }
        }
          $product =  new Select(
                'product',
                $new_products_arr ,
                ["class" => "form-control"]
          );

        
        $amount = new Numeric('amount', [

            "class" => "form-control",           
            "placeholder" => "Amount due",
            "name"=>"amount",
             

        ]);

        $description = new textArea('description', [
            "class" => "form-control",
            // "required" => true,
            "placeholder" => "Article Description",
            "rows" => "5"
        ]);
        

        $btn_value = empty($this->view->invoice_details) ? "Add" : "Pay";
        $save = new Submit('update', [
            "name" => "update",
            "value" => $btn_value,
            "class" => "btn btn-primary btn-block",
        ]);
        

        $this->add($save);
        $this->add($amount);
        $this->add($customer);
        $this->add($description);
        $this->add($product);

    }
   
}


?>
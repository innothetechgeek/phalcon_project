<?php
declare(strict_types=1);

use \App\CustomORM\Crud;
use Phalcon\Assets\Manager; 
use Phalcon\Assets\Asset\Css;
use Phalcon\Url;
use App\Forms\CustomerForm;
use Phalcon\Http\Response;


class CustomerController extends ControllerBase
{   
    private $crud = "";

    public function initialize(){

        $this->crud = new Crud();        

    }

    public function listAction()
    {
        
        $customers = $this->crud->read('SELECT * FROM customers');
        $this->view->customers = $customers;        

    }

    public function editAction($id){

        $customer = $this->crud->read("SELECT * FROM customers where id = $id");

        $this->view->customer = $customer;
        $this->view->form = new CustomerForm();

    }

    public function addAction(){

        $this->view->form = new CustomerForm();

    }

    public function addSubmitAction(){

        $customer_data = $this->getCustomerData();
        
        $this->crud->create($customer_data,'customers');
        
        $this->view->form = new CustomerForm();

        $this->redirectBackWithMessage('Customer added successfully!');

    }

    public function editSubmitAction($id){

        $customer_data = $this->getCustomerData();

        //construct a sql update statement based on the customer data from the view
        $sql_query = $this->constructSqlUpdateSmt($customer_data,$id);

        //execute the query
        $this->crud->update($sql_query);

        $this->redirectBackWithMessage('Customer updated successfully!');

    }

    public function deleteAction($id){

        $this->crud->delete("DELETE FROM customers where id = $id");

        $this->redirectBackWithMessage('Customer deleted successfully!');

    }

    public function constructSqlUpdateSmt($customer_data,$id){

        $sql_query = "UPDATE customers ";
        $j = 0;
        foreach($customer_data as $field => $value){

            $j++;
            $value = trim($value);
            if($j == 1){
                $sql_query .= "SET $field = '$value'";
            }else{
                $sql_query .= ",$field = '$value'";
            }
        }

        $sql_query .= " WHERE id = $id";

        return $sql_query;

    }

    public function redirectBackWithMessage($message){

        $this->session->set(
            'message', $message
        );

        $this->response->redirect('customer/list');
        
    }

    public function getCustomerData(){

        return  [

            'name' => $this->request->getPost('name'). " ".$this->request->getPost('last_name'),
            'address' => $this->request->getPost('address'),
            'username' => $this->request->getPost('username'),
            'balance' => $this->request->getPost('balance'),
            'date_created' => date("Y-m-d"),
            'password' => $this->request->getPost('password'),

        ];
    }

}

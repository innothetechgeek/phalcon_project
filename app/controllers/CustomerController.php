<?php
declare(strict_types=1);

use \App\CustomORM\Crud;
use Phalcon\Assets\Manager; 
use Phalcon\Assets\Asset\Css;
use Phalcon\Url;
use App\Forms\CustomerForm;

class CustomerController extends ControllerBase
{

    public function listAction()
    {
        $crud = new Crud();

        $url = new Url();

        //$css1 = new Css('css/bootstrap.min.css'); 
        $this->assets->addCss('public/assets/css/bootstrap.min.css');
        $this->assets->addCss('public/assets/css/now-ui-dashboard.css?v=1.5.0');
        
        $movies = $crud->read('SELECT * FROM movies');
        $this->view->movies = $movies;        

    }

    public function editAction($id){
        
        $this->assets->addCss('public/assets/css/bootstrap.min.css');
        $this->assets->addCss('public/assets/css/now-ui-dashboard.css?v=1.5.0');

        $crud = new Crud();
        $customer = $crud->read("SELECT * FROM movies where mv_id = $id");

        $this->view->customer = $customer;
        $this->view->form = new CustomerForm();

    }

    public function addAction(){

        $this->assets->addCss('public/assets/css/bootstrap.min.css');
        $this->assets->addCss('public/assets/css/now-ui-dashboard.css?v=1.5.0');

        $this->view->form = new CustomerForm();

    }

    public function addSubmitAction(){

        $customer_data = $this->getCustomerData();

    }

    public function editSubmitAction(){

        $this->assets->addCss('public/assets/css/bootstrap.min.css');
        $this->assets->addCss('public/assets/css/now-ui-dashboard.css?v=1.5.0');

        $customer_data = $this->getCustomerData();

    }

    public function getCustomerData(){

        return  [

            'name' => $this->request->getPost('name'). " ".$this->request->getPost('lastname'),
            'address' => $this->request->getPost('address'),
            'username' => $this->request->getPost('username'),
            'balance' => $this->request->getPost('balance'),
            'password' => $this->request->getPost('password'),

        ];
    }

}

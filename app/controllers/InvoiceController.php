<?php
declare(strict_types=1);

use \App\CustomORM\Crud;
use Phalcon\Assets\Manager; 
use Phalcon\Assets\Asset\Css;
use Phalcon\Url;
use App\Forms\CustomerForm;
use Phalcon\Http\Response;


class InvoiceController extends ControllerBase{

    private $crud = "";

    public function initialize(){

        $this->crud = new Crud();        

    }

    public function listAction()
    {
        
        $invoices = $this->crud->read('SELECT * FROM invoices');
        $this->view->invoices = $invoices;        

    }

}
<?php
declare(strict_types=1);

use \App\CustomORM\Crud;
use Phalcon\Assets\Manager; 
use Phalcon\Assets\Asset\Css;
use Phalcon\Url;
use App\Forms\InvoiceForm;
use Phalcon\Http\Response;


class InvoiceController extends ControllerBase{

    private $crud = "";

    public function initialize(){

        $this->crud = new Crud();        

    }

    public function listAction()
    {
        $sql_query = "SELECT customers.name as customer_name,
                        products.name as product_name,invoices.description,
                        invoices.date_created,invoices.amount as amount_due,
                        IFNULL(payment.amount, 'Unpaid') as amount_paid
                        FROM invoices
                        JOIN customers on invoices.customer_id = customers.id
                        JOIN invoices_line on invoices_line.invoice_id = invoices.id
                        JOIN products on products.id = invoices_line.product_id
                        LEFT join payment on invoices.id = payment.invoice_id";

        $invoices = $this->crud->read($sql_query);   
        
       
        $this->view->invoices = $invoices;        

    }

    public function addAction(){

        $this->view->form = new InvoiceForm();

    }

}
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
                        sum(IFNULL(payment.amount, 'Unpaid')) as amount_paid,invoices.id as invoice_id
                        FROM invoices
                        JOIN customers on invoices.customer_id = customers.id
                        JOIN invoice_lines on invoice_lines.invoice_id = invoices.id
                        JOIN products on products.id = invoice_lines.product_id
                        LEFT join payment on invoices.id = payment.invoice_id
                        GROUP BY payment.customer_id,invoice_id
                        ORDER BY invoices.id DESC";

        $invoices = $this->crud->read($sql_query);   
        
       
        $this->view->invoices = $invoices;        

    }

    public function addAction(){

        $this->view->form = new InvoiceForm();

    }

    public function addSubmitAction(){

        $invoice =  [

            'customer_id' => $this->request->getPost('customer'),            
            'date_created' => date("Y-m-d"),

            /*
                I'm not exactly sure why we need these fields in the invoices table
                    when we have them on the invice line. I see this as redundant data
                    but I have them in my invoice table since the invoice table on the 
                    project instructrucation has them.
                */
            'description' => $this->request->getPost('description'),
            'amount' => $this->request->getPost('amount'),
        ];

        //create invoice
        $invoice_id = $this->crud->create($invoice,'invoices');

        $invoice_line = [
            
            'invoice_id' => $invoice_id,
            'product_id' => $this->request->getPost('product'),
            'description' => $this->request->getPost('description'),
            'amount' => $this->request->getPost('amount'),
            'date_created' => date("Y-m-d"),

        ];

        $this->crud->create($invoice_line,'invoice_lines');

        $this->redirectBackWithMessage('Invoice Added successfully !');

    }

    public function payAction($id){

        $query = "SELECT invoice_id,product_id,products.name as product_name,customers.id as customer_id,
                    invoices.amount as amount_due
                    FROM invoices
                    JOIN invoice_lines ON invoice_lines.invoice_id = invoices.id
                    JOIN customers ON invoices.customer_id = customers.id
                    JOIN products ON products.id = invoice_lines.product_id
                    WHERE invoice_id = $id";
        
       $invoice_details =  $this->crud->read($query);

       $this->view->invoice_details =  $invoice_details;
       $this->view->form = new InvoiceForm();

    }

    public function paySubmitAction($invoice_id){

       $query = "SELECT customers.id as customer_id
                FROM invoice_lines
                JOIN invoices ON invoices.id = invoice_lines.invoice_id
                JOIN customers on invoices.customer_id = customers.id
                where invoice_lines.invoice_id = $invoice_id";

    
        $customer_id = $this->crud->read($query)[0]['customer_id'];

        $payment = [
                    'invoice_id' => $invoice_id,
                    'customer_id' =>  $customer_id,
                    'amount' => $this->request->getPost('amount'),
                    'date_created' => date("Y-m-d")
        ];

       $this->crud->create($payment,'payment');

            

    }

    public function redirectBackWithMessage($message){

        $this->session->set(
            'message', $message
        );

        $this->response->redirect('invoice/list');
        
    }

}
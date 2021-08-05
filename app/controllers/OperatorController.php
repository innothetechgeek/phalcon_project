<?php
declare(strict_types=1);

use Phalcon\Http\Request;
use App\Forms\LoginForm;
use \App\CustomORM\Crud;

use Phalcon\Security;

class OperatorController extends ControllerBase{

    private $crud = "";

    public function initialize(){

        $this->crud =  new Crud();

    }
    
    public function loginAction(){

        $this->view->form = new LoginForm();

    }

    public function loginSubmitAction(){

         // login with database
         $email    = $this->request->getPost('email');
         $password =  $this->security->hash($this->request->getPost('password'));

         var_dump($password); die();

         $query = "SELECT * from users 
                    where username = '$email' AND password = '$password'";


        $operator = $this->crud->read($query);

        if(!empty($operator)){

            $this->session->set('AUTH_ID', $user->id);
            $this->session->set('AUTH_NAME', $user->name);
            $this->session->set('IS_LOGIN', 1);

            return $this->response->redirect('customer/list');
        }

    }
    
}
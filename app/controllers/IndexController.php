<?php
declare(strict_types=1);
use \App\CustomORM\Crud;

class IndexController extends ControllerBase
{


    public function indexAction()
    {
        return $this->dispatcher->forward(
            [
                'controller' => 'customer',
                'action'     => 'list',
            ]
        );
    }

}


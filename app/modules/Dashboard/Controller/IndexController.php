<?php

namespace Dashboard\Controller;

use Application\Mvc\Controller;
use Dashboard\Form\LoginForm;
use Phalcon\Mvc\View;


class IndexController extends Controller
{

    public function indexAction() {
        
    }

    public function loginAction() {
        $form = new LoginForm();
        $this->view->form = $form;  
    }

}

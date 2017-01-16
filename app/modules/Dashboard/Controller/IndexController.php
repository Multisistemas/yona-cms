<?php

namespace Dashboard\Controller;

use Application\Mvc\Controller;
use Dashboard\Form\LoginForm;
use Dashboard\Form\RegisterForm;
use Phalcon\Mvc\View;


class IndexController extends Controller
{

    public function indexAction() {
        
    }

    public function loginAction() {
        $loginform = new LoginForm();
        $registerform = new RegisterForm();

        $this->view->loginform = $loginform;
        $this->view->registerform = $registerform;
    }

}

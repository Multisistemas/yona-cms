<?php

namespace Dashboard\Controller;

use Application\Mvc\Controller;
use Dashboard\Form\LoginForm;
use Dashboard\Form\RegisterForm;
use Phalcon\Mvc\View;


class IndexController extends Controller
{

    public function indexAction() {
        if ($this->session->has('manual')) {
        	$auth = $this->session->get('manual');
        	$this->view->auth = $manual;
        } else if ($this->session->has('opauth')) {
        	$auth = $this->session->get('opauth');
        	$this->view->auth = $auth;
        }
    }

    public function loginAction() {
        $loginform = new LoginForm();
        $registerform = new RegisterForm();

        $this->view->loginform = $loginform;
        $this->view->registerform = $registerform;
    }

    public function successAction() {
        $auths = $this->session->get('opauth');

        $response = new Response;

        $response->redirect("index/index")->auths = $auths;

        //$this->view->auths = $auths;
    }

}

<?php

namespace Auth\Controller;

use Application\Mvc\Controller;
use Auth\Form\LoginForm;
use Phalcon\Mvc\View;

class IndexController extends Controller
{

    public function indexAction() {
    	
    }

    public function loginAction() {
        $form = new LoginForm();
        $this->view->form = $form;  
    }

    public function googleAction() {
        $this->view->google =   $this->session->get('opauth');
    }

    public function logoutAction() {
        if ($this->request->isPost()) {
            if ($this->security->checkToken()) {
                $this->session->remove('auth');
            } else {
                $this->flash->error("Security errors");
            }
        } else {
            $this->flash->error("Security errors");
        }
        $this->redirect($this->url->get());
    }

}

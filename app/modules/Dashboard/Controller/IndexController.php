<?php

namespace Dashboard\Controller;

use Application\Mvc\Controller;
use Dashboard\Form\LoginForm;
use Dashboard\Form\RegisterForm;
use Phalcon\Mvc\View;
use Dashboard\Model\CompanyUser;
use Dashboard\Model\CompanySystem;
use Dashboard\Model\System;
use Dashboard\Model\User;


class IndexController extends Controller
{

    public function indexAction($system = null) {
        $this->view->system = $system;
    }

    public function loginAction() {

        if ($this->session->has('opauth') || $this->session->has('manual')) {
            $this->redirect($this->url->get() . '/');
        } else {

            $loginform = new LoginForm();
            $registerform = new RegisterForm();

            $this->view->loginform = $loginform;
            $this->view->registerform = $registerform;
        }
    }

    public function showAction(){
    	
        if ($this->session->has('manual')) {
            $auth = $this->session->get('manual');
            $user = User::findFirstById($auth->id);
        } else if($this->session->has('opauth')) {
            $auth = $this->session->get('opauth');
            $user = User::findFirstByEmail($auth['auth']['raw']['email']);
        }

    	foreach ($user->companyUser as $userCom) {
            $company = $userCom->company;
        }

        $companySys = CompanySystem::findFirstByCompanyId($company->getId());

        $system = $companySys->system->shortname;

    	$this->dispatcher->forward(
            [
                "controller"    => "index",
                "action"        => "index",
                "params"        => [$system],
            ]
        );
    }

}

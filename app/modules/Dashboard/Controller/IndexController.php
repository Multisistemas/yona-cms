<?php

namespace Dashboard\Controller;

use Application\Mvc\Controller;
use Dashboard\Form\LoginForm;
use Dashboard\Form\RegisterForm;
use Phalcon\Mvc\View;
use Dashboard\Model\CompanyUser;
use Dashboard\Model\CompanySystem;
use Dashboard\Model\System;


class IndexController extends Controller
{

    public function indexAction($system = null) {
        if ($this->session->has('manual')) {
        	$manual = $this->session->get('manual');
        	$this->view->auth = $manual;
        } else if ($this->session->has('opauth')) {
        	$opauth = $this->session->get('opauth');
        	$this->view->auth = $opauth;
        } 

        if ($system != null) {
        	$systemUser = $system->getShortname();
        	$this->view->system = $systemUser;
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

    }

    public function showAction(){

    	$user = $this->session->get('manual');
    	
    	$companyUser = CompanyUser::findFirstByUserId($user->id);

    	$companySys = CompanySystem::findFirstByCompanyId($companyUser->getCompanyId());
    	
    	$system = System::findFirstById($companySys->getSystemId());

    	$this->dispatcher->forward(
            [
                "controller"    => "index",
                "action"        => "index",
                "params"        => [$system],
            ]
        );
    }

}

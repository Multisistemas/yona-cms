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

    public function showAction($user){

    	$user = User::findFirstByEmail($user->getEmail());
    	
    	$companyUser = CompanyUser::findFirstByUserId($user->getId());

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

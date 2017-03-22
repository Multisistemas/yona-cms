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
use Dashboard\Model\RoleUser;

class IndexController extends Controller
{

    public function indexAction($system = null, $user = null) {
        if ($system != null && $user != null) {
            $role = RoleUser::findFirstByUserId($user->getId());
            
            $therole = $role->getRoleId();
            
            $users = $this->searchForCompany($user);
            $systems = $this->searchForSystem($user);

            if ($therole == 1){
                $this->adminAction($system, $user, $role, $users, $systems);
            } else if ($therole == 2) {
                $this->guestAction($system, $user, $role, $systems);
            }
        }
    }

    public function adminAction($system, $user, $role, $users, $systems){
        $this->view->setVars(
            [
                "system"    => $system,
                "user"      => $user,
                "role"      => $role,
                "users"     => $users,
                "systems"   => $systems,
            ]
        );
    }

    public function guestAction($system, $user, $role, $systems){
        $this->view->setVars(
            [
                "system"    => $system,
                "user"      => $user,
                "role"      => $role,
                "systems"   => $systems,
            ]
        );
    }

    public function searchForCompany($user) {
        
        foreach ($user->companyUser as $userCom) {
            $companyId = $userCom->company->id;
        }

        $users_company = CompanyUser::find(
            [
                "company_id" => $companyId,
            ]
        );

        foreach ($users_company as $user_comp) {
            $users[] = User::findFirstById($user_comp->getId());    
        }

        $get_out_user_admin = array_shift($users);

        if (!empty($users)) {
            return $users;
        } else {
            return false;
        }
    }

    public function searchForSystem($user) {
        
        foreach ($user->companyUser as $userCom) {
            $companyId = $userCom->company->id;
        }

        $systems_company = CompanySystem::find(
            [
                "company_id" => $companyId,
            ]
        );

        if (!empty($systems_company)) {
            return $systems_company;
        } else {
            return false;
        }
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

            foreach ($user->companyUser as $userCom) {
            $company = $userCom->company;
            }

            $companySys = CompanySystem::findFirstByCompanyId($company->getId());

            $system = $companySys->system->shortname;

            $this->dispatcher->forward(
                [
                    "controller"    => "index",
                    "action"        => "index",
                    "params"        => [$system, $user],
                ]
            );
        } else if($this->session->has('opauth')) {
            $auth = $this->session->get('opauth');

            $user = User::findFirstByEmail($auth['auth']['raw']['email']);

            foreach ($user->companyUser as $userCom) {
            $company = $userCom->company;
            }

            $companySys = CompanySystem::findFirstByCompanyId($company->getId());

            $system = $companySys->system->shortname;

            $this->dispatcher->forward(
                [
                    "controller"    => "index",
                    "action"        => "index",
                    "params"        => [$system, $user],
                ]
            );
            
        } else {
            $this->indexAction();
        }

    	
    }

}
//Just a comment

